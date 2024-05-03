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

		$this->load->model('User');
	}

	public function login()
	{
		if ($this->uri->uri_string() == 'app/login') {
			show_404();
		}
		
		$view["body"] = $this->load->view('app/login', null, TRUE);
		$this->parser->parse('admin/template/body_format_2', $view);
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
					'passwd' => $this->hash_passwd($this->input->post("passwd")),
					'user_id' => $this->User->get_unused_id(),
					'created_at' => date('Y-m-d H:i:s'),
					'auth_level' => 1
				);

				$this->User->insert($save);

				echo 'B';

				$this->session->set_flashdata('text', "Registro exitoso");
				$this->session->set_flashdata('type', 'success');
				redirect('login');
			} else {
				echo form_error('username');
				echo form_error('email');

				echo 'M';
			}
		}

		$view["body"] = $this->load->view('app/register', $data, TRUE);
		$this->parser->parse('admin/template/body_format_2', $view);
	}

	public function hash_passwd($password, $random_salt = '')
	{
		// If no salt provided for older PHP versions, make one
		if (!is_php('5.5') && empty($random_salt))
			$random_salt = $this->random_salt();

		// PHP 5.5+ uses new password hashing function
		if (is_php('5.5')) {
			return password_hash($password, PASSWORD_BCRYPT, ['cost' => 11]);
		} // PHP < 5.5 uses crypt
		else {
			return crypt($password, '$2y$10$' . $random_salt);
		}
	}
}
