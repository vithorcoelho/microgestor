<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MX_Controller {

	public function __construct()
	{
		parent::__construct();

	}
	public function index()
	{
		$dados['titulo'] = 'microGestor | Sistema de gestão simples e gratuito';
		$this->load->view('home', $dados);
	}
}
