<?php

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('parser');
		$this->load->library('form_validation');

		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('text');

		$this->load->helper('Post_helper');
		$this->load->helper('Date_helper');

		$this->load->model('Post');
	}

	public function index()
	{
		$this->load->view('admin/test');
	}

	public function post_list()
	{
		$data["posts"] = $this->Post->findAll();
//        $this->load->view('admin/post_list');
		$view["body"] = $this->load->view('admin/post/list', $data, TRUE);
		$view["title"] = "Posts";

		$this->parser->parse('admin/template/body', $view);
	}

	public function post_save($post_id = null)
	{
		if ($post_id == null) {
//			Estamos creando un post
			$data['title'] = $data['content'] = $data['description'] = $data['posted'] = $data['url_clean'] = $data['image'] = "";

			$view["title"] = "Crear Post";
		} else {
//			Estamos editando un post
			$post = $this->Post->find($post_id);
			$data['title'] = $post->title;
			$data['content'] = $post->content;
			$data['description'] = $post->description;
			$data['posted'] = $post->posted;
			$data['url_clean'] = $post->url_clean;
			$data['image'] = $post->image;

			$view["title"] = "Actualizar Post";
		}

		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_rules('title', 'Título', 'required|min_length[10]|max_length[65]');
			$this->form_validation->set_rules('content', 'Contenido', 'required|min_length[10]');
			$this->form_validation->set_rules('description', 'Descripción', 'required|max_length[100]');
			$this->form_validation->set_rules('posted', 'Publicado', 'required');

			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('content');
			$data['description'] = $this->input->post('description');
			$data['posted'] = $this->input->post('posted');
			$data['url_clean'] = $this->input->post('url_clean');

			if ($this->form_validation->run()) {

				$url_clean = $this->input->post("url_clean");
				if ($url_clean == "") {
					$url_clean = clean_name($this->input->post("title"));
				}

				$save = array(
//					'content' => $_POST['content'],
					'title' => $this->input->post('title'),
					'content' => $this->input->post('content'),
					'description' => $this->input->post('description'),
					'posted' => $this->input->post('posted'),
					'url_clean' => $url_clean
				);

				if ($post_id == null) {
					$post_id = $this->Post->insert($save);
				} else {
					$this->Post->update($post_id, $save);
				}


				$this->upload($post_id, $this->input->post('title'));
			} else {
//				echo validation_errors();
			}

		}

		$data["data_posted"] = posted();
		$view["body"] = $this->load->view('admin/post/save', $data, TRUE);

		$this->parser->parse('admin/template/body', $view);
	}

	public function post_delete($post_id = null) // Si no se le pasa un parámetro, lo setea como null
	{
		if ($post_id == null) {
			echo 0;
		} else {
			$this->Post->delete($post_id);
			echo 1;
		}
	}

	function images_server()
	{
		$data["images"] = all_images();
		$this->load->view('admin/post/image', $data);
	}

	public function upload($post_id = null, $title = null)
	{
		$image = "upload";

		if ($title != null)
			$title = clean_name($title);

//		Configuraciones de carga
		$config['upload_path'] = 'uploads/post';
		if ($title != null)
			$config['file_name'] = $title;
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 5000; // 40mb
		$config['overwrite'] = TRUE;

//		Cargamos la librería
		$this->load->library('upload', $config);

		if ($this->upload->do_upload($image)) {

//			Datos del upload
			$data = $this->upload->data();

			if ($title != null && $post_id != null) {
				$save = array(
					'image' => $title . $data["file_ext"]
				);

				$this->Post->update($post_id, $save);
			} else {
				$title = $data["file_name"];
				echo json_encode(array("fileName" => $title, "uploaded" => 1, "url" => "/" . PROJECT_FOLDER . "/uploads/post/" . $title));
			}

			$this->resize_image($data['full_path']);
		}
	}

	function resize_image($path_image)
	{
		$config['image_library'] = 'gd2';
		$config['source_image'] = $path_image;
//		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 500;
		$config['height'] = 500;

		$this->load->library('image_lib', $config);

		$this->image_lib->resize();

	}
}
