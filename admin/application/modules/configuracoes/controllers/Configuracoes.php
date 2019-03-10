<?php
class Configuracoes extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model('Configuracoes_model');

		login_verify();
	}

	public function index()
	{
		$dados['page_titulo'] = 'Configurações';
		$dados['css'] = array(str_replace('admin/', '', base_url('assets/styles/profile/settings.min.css')));
		$this->load->view('configuracoes', $dados);
	}
}