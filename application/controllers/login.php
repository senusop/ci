<?php
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("model_chat");
	}

	public function index()
	{
		
		$this->load->view("chat/login");
	}
}
