<?php
class Header extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$dados['config_header'] = $this->config_header();

		$this->load->view('header', $dados);
	}

	public function config_header()
	{
		$dados['titulo'] = 'microGestor';

		$dados['navlogo'] = array(
			//'Dashboard' 	=> array(base_url('assets/img/menu-grid/dashboard.png'), base_url('#')),
			'Projetos' 		=> array(base_url('assets/img/menu-grid/flask.png'), base_url('projetos')),
			'Agenda' 	=> array(base_url('assets/img/menu-grid/calendar.png'), base_url('agenda')),
			//'Profile' 		=> array(base_url('assets/img/menu-grid/profile.png'), base_url('#')),
			//'Tickets' 		=> array(base_url('assets/img/menu-grid/ticket.png'), base_url('#')),
			'Configurações' => array(base_url('assets/img/menu-grid/settings.png'), base_url('configuracoes')),
			'Sair' 			=> array(base_url('assets/img/menu-grid/logout.png'), base_url('login/logout'))
		);

		$dados['nav'] = array(
			'Resumo' 		=> base_url(),
			'Clientes'		=> base_url('clientes'),
			'Produtos'		=> base_url('produtos'),
			'Vendas'		=> base_url('vendas'),
			//'Estoque'		=> base_url('estoque'),
			'Fluxo de caixa' => base_url('fluxo')
			//'Nota fiscal'	=> base_url('notafiscal'),
			//'Financeiro' 	=> array('Movimentações' => base_url('fluxo'), 'DRE' => '#'),
		);

		return $dados;
	}
}