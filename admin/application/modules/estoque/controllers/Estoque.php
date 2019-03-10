<?php
class Estoque extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		login_verify();
	}
	 public function index()
	 {
	 	$this->load->view('construcao');
	 }
}