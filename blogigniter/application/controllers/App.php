<?php

class App extends CI_Controller
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
	}

	public function login()
	{
		$view["body"] = $this->load->view('app/login', null, TRUE);
		$this->parser->parse('admin/template/body_format_2', $view);
	}

}
