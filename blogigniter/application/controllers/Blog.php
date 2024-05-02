<?php

class Blog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('parser');

		$this->load->helper('url');
		$this->load->helper('text');

		$this->load->helper('Post_helper');

		$this->load->model('Post');
	}

	public function index($num_page = 1)
	{
		$num_page--;
		$num_post = $this->Post->count();
		$last_page = ceil($num_post / PAGE_SIZE);

		if ($num_page < 0) {
			$num_page = 0;
		} else if ($num_page > $last_page) {
			$num_page = 0;
		}

		$offset = $num_page * PAGE_SIZE; // Registros que vamos a traer

		$data['last_page'] = $last_page;
		$data['current_page'] = $num_page;
		$data['posts'] = $this->Post->get_pagination($offset);

		$view['body'] = $this->load->view("blog/index", $data, TRUE);

		$this->parser->parse('blog/template/body', $view);
	}

}
