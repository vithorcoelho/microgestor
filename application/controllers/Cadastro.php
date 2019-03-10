<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends MX_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'css_html', 'functions'));
		$this->load->library('form_validation');
		$this->load->model('Cadastro_model');
	}

	public function index()
	{
		$dados['titulo'] = 'Cadastro Grátis';

		$this->load->model('Setup_model');
		$this->load->helper('setup_usuario');
		$this->load->library('email');

		// Regras de validação
		$this->form_validation->set_rules('nome', 'nome', 'trim|required|alpha_numeric_spaces');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('senha', 'senha', 'trim|required|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('nome_empresa', 'nome da empresa', 'trim|required');
		$this->form_validation->set_rules('CNPJ', 'CNPJ', 'trim');
		$this->form_validation->set_rules('telefone', 'telefone', 'trim');
		$this->form_validation->set_rules('senha2', 'confirmar senha', 'trim|required|min_length[6]|max_length[12]|matches[senha]');

		// Veririca a validação
		if($this->form_validation->run() == FALSE)
		{
			if(validation_errors())
			{
				set_message_cookie(alert_red(validation_errors()));
				redirect(base_url());
			}
		}
		else
		{
			$dados_form = $this->input->post();

			$this->session->unset_userdata('logged');
			$this->session->unset_userdata('admin_id');
			$this->session->unset_userdata('admin_email');
			$this->session->unset_userdata('admin_nome');

			if($this->Cadastro_model->getUser('email', array('email'=>$dados_form['email'])))
			{
				set_message_cookie(alert_red('Este email já está sendo utilizado!'));
				redirect(base_url());
			}
			else
			{
				$dados = array(
					'nome'=>$dados_form['nome'], 
					'email'=>$dados_form['email'],
					'nome_empresa' => $dados_form['nome_empresa'],
					'cpf' => $dados_form['cnpj'],
					'telefone' => $dados_form['telefone'],
					'senha'=>password_hash($dados_form['senha'], PASSWORD_DEFAULT));

				$inserido = $this->Cadastro_model->insertUser($dados);

				// Envia email de cadastro
				$this->email->from('cadastro@microgestor.me', 'João Vithor Coelho');
				$this->email->to($dados_form['email']);
				$this->email->subject('microGestor');
				$this->email->message('Seu cadastro foi realizado com sucesso.');
				$this->email->send();

				if($inserido)
				{
					$this->Setup_model->CriarTabela('erp_clientes_' . $inserido);
					$this->Setup_model->CriarTabela('erp_produtos_' . $inserido);
					$this->Setup_model->CriarTabela('erp_vendas_' . $inserido);
					$this->Setup_model->CriarTabela('erp_listavendas_' . $inserido);
					$this->Setup_model->CriarTabela('erp_fluxocaixa_' . $inserido);
					$this->Setup_model->CriarTabela('erp_dadosempresa_' . $inserido);

					$this->Setup_model->AdicionarColunasTabela('erp_clientes_' . $inserido, TabelaClientes());
					$this->Setup_model->AdicionarColunasTabela('erp_produtos_' . $inserido, TabelaProdutos());
					$this->Setup_model->AdicionarColunasTabela('erp_vendas_' . $inserido, TabelaVendas());
					$this->Setup_model->AdicionarColunasTabela('erp_listavendas_' . $inserido, TabelaListavendas());
					$this->Setup_model->AdicionarColunasTabela('erp_fluxocaixa_' . $inserido, TabelaFluxocaixa());
					$this->Setup_model->AdicionarColunasTabela('erp_dadosempresa_' . $inserido, TabelaDadosEmpresa());

					set_message_cookie(alert_success('Cadastrado realizado com sucesso!'));

					redirect('login');
				}
			}
		}

		// Carrega a view do Painel ADM
		$this->load->view('setup', $dados);
	}
}
