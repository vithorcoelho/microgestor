<?php
class Configuracoes extends MX_Controller
{
	private $user_id;

	function __construct()
	{
		parent::__construct();

		login_verify();

		$this->load->model('Configuracoes_model');
		$this->load->library('security');

		$this->user_id = $this->session->userdata('admin_id');
	}

	public function index()
	{
		$dados['page_titulo'] = 'Configurações';

		$dados['config'] = $this->Configuracoes_model->getConfig(null, array('user_id'=>$this->user_id));

		$dados['css'] = array(str_replace('admin/', '', base_url('assets/styles/profile/settings.min.css')));
		$this->load->view('configuracoes', $dados);
	}

	public function SalvarConfig()
	{
		// Salva dados tabela sys_config
		if(!$this->Configuracoes_model->getConfig(null, array('user_id'=>$this->user_id)))
		{
			foreach ($this->input->post() as $key => $value)
			{
				$query[$key] = $this->security->xss_clean(strip_tags(trim($value)));
			}

			$query['user_id'] = $this->user_id;

			$this->Configuracoes_model->insertConfig($query);
		}
		else
		{
			foreach ($this->input->post() as $key => $value)
			{
				$query[$key] = $this->security->xss_clean(strip_tags(trim($value)));
			}

			$query['user_id'] = $this->user_id;

			$this->Configuracoes_model->UpdateConfig($query, array('user_id'=>$this->user_id));
		}

		redirect('configuracoes');
	}
}