<?php

class App extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('parser');
		$this->load->library('form_validation');
		$this->load->library('session');

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('text');

		$this->load->helper('Post_helper');
		$this->load->helper('Date_helper');
		$this->load->helper('User_helper');

		$this->load->model('User');
	}

	public function login()
	{
		if ($this->uri->uri_string() == 'app/login') {
			show_404();
		}

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$username = $this->input->post('username');
			$password_user = $this->input->post('password');
			$password = $this->User->validatePassword($username);

			if (password_verify($password_user, $password)) {
				$user = $this->User->findUser($username, $password);

				$this->session->set_userdata('id', $user->user_id);
				$this->session->set_userdata('username', $user->username);
				$this->session->set_userdata('auth_level', $user->auth_level);
				$this->session->set_userdata('email', $user->email);

				if ($user) {
					$auth_level = $this->User->getAuthLevel($username);
					if ($auth_level == 9) {
						redirect("/admin");
					} else {
						redirect("/blog");

					}
				}
			}

		}
		$view["body"] = $this->load->view('app/login', NULL, TRUE);
		$this->parser->parse('admin/template/body_format_2', $view);
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect("/login");
	}

	public function register()
	{
		if ($this->uri->uri_string() == 'app/register') {
			show_404();
		}

		$data['name'] = $data['surname'] = $data['username'] = $data['email'] = '';

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_rules('username', 'usuario', 'max_length[12]|is_unique[' . config_item('user_table') . '.username]|required');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[' . config_item('user_table') . '.email]');
			$this->form_validation->set_rules('passwd', 'contraseña', 'min_length[8]|trim|required|max_length[72]');
			$this->form_validation->set_rules('name', 'nombre', 'max_length[100]|required');
			$this->form_validation->set_rules('surname', 'apellido', 'max_length[100]|required');
			$this->form_validation->set_message('is_unique', 'El %s ya está registrado');

			$data['name'] = $this->input->post('name');
			$data['surname'] = $this->input->post('surname');
			$data['username'] = $this->input->post('username');
			$data['email'] = $this->input->post('email');

			if ($this->form_validation->run()) {
				$save = array(
					'name' => $data['name'],
					'surname' => $data['surname'],
					'username' => $data['username'],
					'email' => $data['email'],
					'passwd' => password_hash($this->input->post("passwd"), PASSWORD_DEFAULT),
					'user_id' => $this->User->get_unused_id(),
					'created_at' => date('Y-m-d H:i:s'),
					'auth_level' => 1
				);

				$this->User->insert($save);

				$this->session->set_flashdata('text', "Registro exitoso");
				$this->session->set_flashdata('type', 'success');
				redirect('login');
			} else {
				echo form_error('username');
				echo form_error('email');
			}
		}

		$view["body"] = $this->load->view('app/register', $data, TRUE);
		$this->parser->parse('admin/template/body_format_2', $view);
	}

	public function profile()
	{
		if ($this->session->userdata("auth_level") != NULL) {
			$data['user'] = $this->User->find($this->session->userdata('id'));

			$this->form_validation->set_rules('old_pass', 'Contraseña actual', 'required|callback_validate_same_passwd', array(
				'validate_same_passwd' => 'La contraseña actual no es correcta'));
			$this->form_validation->set_rules('new_pass', 'Contraseña nueva', 'required|min_length[8]|max_length[72]');
			$this->form_validation->set_rules('new_pass_veri', 'Repita la nueva contraseña', 'required|matches[new_pass]');

			if ($this->input->server('REQUEST_METHOD') == 'POST') {
				if ($this->form_validation->run()) {

					$save = array(
						'passwd' => password_hash($this->input->post("new_pass"), PASSWORD_DEFAULT),
					);

					$this->User->update($this->session->userdata('id'), $save);
					$this->session->sess_destroy();
					$this->session->set_flashdata('text', 'Contraseña actualizada');
					$this->session->set_flashdata('type', 'danger');
					redirect('/login');
				}
			}

			$view["body"] = $this->load->view("app/profile", $data, TRUE);

			if ($this->session->userdata("auth_level") == 9) {
				$view["title"] = 'Perfil';
				$this->parser->parse("admin/template/body", $view);
			} else {
				$this->parser->parse("blog/template/body", $view);
			}
		}
	}

	public function load_avatar()
	{
		$this->avatar_upload();
		$this->session->set_flashdata('type', 'success');
		$this->session->set_flashdata('text', 'Avatar cambiado con éxito.');
		redirect('/app/profile');
	}

	private function avatar_upload()
	{

		$id = $this->session->userdata('id');

		$image = 'image';
		$config['upload_path'] = 'uploads/user/';
		$config['file_name'] = 'imagen_' . $id;
		$config['allowed_types'] = "jpg|jpeg|png";
		$config['overwrite'] = TRUE;

		$this->load->library('upload', $config);
		if (!$this->upload->do_upload($image)) {
			$this->session->set_flashdata('type', 'danger');
			$this->session->set_flashdata('text', $this->upload->display_errors());
			return;
		}
		$this->upload->do_upload($image);
		$data = $this->upload->data();
		$save = array('avatar' => 'imagen_' . $id . $data['file_ext']);

		$this->User->update($id, $save);
		$this->session->set_userdata('avatar', $save['avatar']);
		$this->resize_avatar($data['full_path'], $save['avatar']);
	}

	private function resize_avatar($ruta, $nombre)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $ruta;
		$config['new_image'] = 'uploads/avatar/user/' . $nombre;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 300;
		$config['height'] = 300;

		$this->load->library('image_lib', $config);

		if (!$this->image_lib->resize()) {
			echo $this->image_lib->display_errors();
		}
	}

	public function validate_same_passwd($passwd)
	{
		$user = $this->User->find($this->session->userdata('id'));

		$password = $this->User->validatePassword($user->username);
		if (password_verify($passwd, $password)) {
			return true;
		} else {
			return false;
		}
	}
}
