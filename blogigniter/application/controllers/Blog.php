<?php

class Blog extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('parser');

		$this->load->helper('url');

	}

	public function index()
	{
		$view["body"] = $this->load->view("blog/index", NULL, TRUE);

		$this->parser->parse('blog/template/body', $view);
	}

}
