<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
	}

	public function index()
	{

		if ($this->session->userdata("auth_level") == 9) {
			redirect("/admin");
		} else {
			redirect("/blog");
		}

	}
}
