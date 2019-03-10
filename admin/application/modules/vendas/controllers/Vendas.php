<?php
class Vendas extends MX_Controller
{
	private $tabela_order = array('id'=>'DESC');
	private $tabela_limit = 50;

	function __construct()
	{
		parent::__construct();

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model(array('Vendas_model', 'Produtos_model', 'Clientes_model', 'Listavendas_model', 'Fluxo_model'));

		login_verify();
	}

	public function index()
	{
		$dados['page_titulo'] = 'Vendas';

		$dados['paginacao'] = $this->PaginacaoVendas();

		$rota_start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$tabela_vendas = $this->Vendas_model->getVendas('id, idcliente, data, chave, status, total, frete', null,  array('id' => 'DESC'), $this->tabela_limit, $rota_start);
			
		// Pega os registros de vendas e busca os clientes pelo id da tabela clientes

		if($tabela_vendas)
		{
			foreach ($tabela_vendas as $colunas_vendas)
		    {
				$tabela_cliente = $this->Clientes_model->getClientes(null, array('id'=>$colunas_vendas->idcliente));
				
				if($tabela_cliente)
				{
					$colunas_vendas->nome = $tabela_cliente[0]->nome;
					$vendas[] = $colunas_vendas;
				}
			}
			$dados['vendas'] = $vendas;
		}

		$this->load->view('vendas', $dados);
	}

	public function CookieFiltroProduto(){}

	public function PaginacaoVendas()
	{
		$this->load->helper('paginacao');
		
		return createPaginate('vendas/index/', $this->Vendas_model->countAll(), $this->tabela_limit, 3);
	}

	public function DadosVenda()
	{
		$dados['page_titulo'] = 'Dados Pedido';

		$dados['venda'] = $this->Vendas_model->getVendas(null, array('chave'=>$this->uri->segment(3)), null, 1);
		$dados['cliente'] = $this->Clientes_model->getClientes(null, array('id'=>$dados['venda'][0]->idcliente), null, 1);
		$dados['produtos'] = $this->Listavendas_model->getLista(array('chave'=>$this->uri->segment(3)));

		$total_venda = 0.00;

		foreach($dados['produtos'] as $multiplicar)
		{
			$total = ($multiplicar->preco * $multiplicar->quantidade);

			$total_venda += $total;
		}

		$dados['total_venda'] = number_format($total_venda, 2, ',', '.');
		
		$this->load->view('dadosvenda', $dados);
	}

	public function Ajax_ModalCadastraVenda()
	{
		$dados['clientes'] = $this->Clientes_model->getClientes('id, nome', null, array('nome' => 'ASC'));
		
		$this->load->view('include_addvendas', $dados);
	}

	public function Ajax_BuscarProdutos()
	{
		if($this->input->post())
		{
			$produtos = $this->Produtos_model->getProdutos(null, null, null, null, null, array('nome'=>$this->input->post()['texto']));

			$dados['qtd'] = $this->Produtos_model->countAll();

			$dados['dados'] = '';
			foreach ($produtos as $value)
			{
				$sku = ($value->ref != '') ? " <i style=font-size:10px>SKU: {$value->ref}</i>" : null;
				$dados['dados'] .= '<a class="produto" id="'.$value->id.':'.$value->preco.'">'.$value->nome . $sku .'  </a>';
			}

			echo json_encode($dados);
		}
	}

	public function AjaxAdicionaLinhaProduto()
	{
		if($this->input->post()['idproduto'])
		{
			$produtos = $this->Produtos_model->getProdutos(null, array('id'=>$this->input->post()['idproduto']));

			$retorno['dados'] = '';

			foreach ($produtos as $value)
			{
				$value->preco = number_format($value->preco, 2, ',', '.');

				$retorno['dados'] .= 
				'<tr class='.$value->id.'>
				<td><input type="hidden" value="'.$value->ref.'" name="ref[]">
				<input type="hidden" value="'.$value->id.'" name="idproduto[]"><input type="hidden" value="'.$value->nome.'" name="produtos[]">'.$value->nome.'</td>
				<td><input type="text" id="preco" value="'.$value->preco.'" class="form-control form-control-sm money" data-thousands="." data-decimal="," name="preco[]"></td>
				<td><input type="text" class="qtdproduto form-control form-control-sm" value="1" name="quantidade[]"></td>
				<td width=2><a href=#'.$value->id.' class="excluirproduto btn"><label class="la la-trash ks-icon" style="color: #ef6161; cursor: pointer"></label></a></td>
				</tr>';
			}
			
			$retorno['idproduto'] = $value->id;

			echo json_encode($retorno);
		}
	}

	public function Ajax_CadastrarVenda()
	{
		$post = $this->input->post();

		$total = 0;
		$chave = date('Ymdhis');

		foreach ($post['produtos'] as $key => $value)
		{
			$source = array('.', ',');
			$replace = array('', '.');

			$total += str_replace($source, $replace, $post['preco'][$key]) * $post['quantidade'][$key];

			$query_venda = array(
				'idcliente' => $post['cliente'],
				'idproduto' => $post['idproduto'][$key],
				'ref' => $post['ref'][$key],
				'produto' => $value, 
				'preco' => str_replace($source, $replace, $post['preco'][$key]), 
				'quantidade' => $post['quantidade'][$key], 
				'chave' => $chave
			);

			$this->Listavendas_model->insertLista($query_venda);
		}

		$this->Vendas_model->insertVenda(array(
			'idcliente'=>$post['cliente'], 
			'data'=>date('Y-m-d'), 
			'chave'=>0, 
			'status'=>$post['status'], 
			'frete'=> str_replace($source, $replace, $post['frete']),
			'pagamento'=>$post['pagamento'],
			'total'=>$total,
			'chave'=>$chave));

		$this->Fluxo_model->inFluxo(array(
			'tipo'=>'Receita', 
			'data'=>date('Y-m-d'),
			'descricao'=>'Venda de mercadoria', 
			'valor'=>($total), 
			'SKU'=>$chave));

		echo json_encode('Venda cadastrada com sucesso!');
	}

	public function DeletarVenda()
	{
		$this->Vendas_model->deleteVenda(array('chave'=>$this->uri->segment(3)));
		$this->Listavendas_model->deleteLista(array('chave'=>$this->uri->segment(3)));
		$this->Fluxo_model->deleteFluxo(array('SKU'=>$this->uri->segment(3)));

		redirect('vendas');
	}

	public function ResumoPedido()
	{
		$dados['venda'] = $this->Vendas_model->getVendas(null, array('chave'=>$this->uri->segment(3)), null, 1);
		$dados['cliente'] = $this->Clientes_model->getClientes(null, array('id'=>$dados['venda'][0]->idcliente), null, 1);
		$dados['produtos'] = $this->Listavendas_model->getLista(array('chave'=>$this->uri->segment(3)));

		$total_venda = 0.00;

		foreach($dados['produtos'] as $multiplicar)
		{
			$total = ($multiplicar->preco * $multiplicar->quantidade);

			$total_venda += $total;
		}

		$dados['total_venda'] = number_format($total_venda, 2, ',', '.');

		//$this->load->view('construcao');
		$this->load->view('gerarpdf_pedido', $dados);
	}
	
	public function Ajax_AtualizarVenda()
	{
		if ($this->input->post())
		{
			$query = array(
				'status'	=> $this->input->post()['status'],
				'pagamento'	=> $this->input->post()['pagamento'],
				'frete'		=> $this->input->post()['frete']);

			$this->Vendas_model->updateVendas($query, array('chave'=>$this->input->post()['chave']));
			
			set_message_cookie('<script>msg_flutuante("Informações atualizadas com sucesso", "success", "bottomCenter")</script>');

			redirect('vendas/dadosvenda/'.$this->input->post()['chave']);
		}
	}

	public function SalvarVenda()
	{
		$post = $this->input->post();

		$totalupdate = 0;

		foreach ($post['up_produtos'] as $key => $value)
		{
			$source = array('.', ',');
			$replace = array('', '.');

			$totalupdate += str_replace($source, $replace, $post['up_preco'][$key]) * $post['up_quantidade'][$key];

			$query_venda = array(
				'ref' => $post['up_ref'][$key],
				'produto' => $value, 
				'preco' => str_replace($source, $replace, $post['up_preco'][$key]), 
				'quantidade' => $post['up_quantidade'][$key]
			);

			$this->Listavendas_model->updateLista($query_venda, array('chave' => $post['chave'], 'produto' => $value));
		}

		$this->Vendas_model->updateVendas(array('total'=>$totalupdate), array('chave'=>$post['chave']));

		$novototal = 0;

		// CADASTRA PRODUTOS ADICIONADOS
		if($post['produtos'])
		{
			foreach ($post['produtos'] as $key => $value)
			{
				$source = array('.', ',');
				$replace = array('', '.');

				$novototal += str_replace($source, $replace, $post['preco'][$key]) * $post['quantidade'][$key];

				$query_venda = array(
					'idcliente' => $post['idcliente'],
					'idproduto' => $post['idproduto'][$key],
					'ref' => $post['ref'][$key],
					'produto' => $value, 
					'preco' => str_replace($source, $replace, $post['preco'][$key]), 
					'quantidade' => $post['quantidade'][$key], 
					'chave' => $post['chave']
				);
				$this->Listavendas_model->insertLista($query_venda);
			}
		}

		$queryupdatevenda = array(
				'status'	=> $this->input->post()['status'],
				'pagamento'	=> $this->input->post()['pagamento'],
				'frete'		=> $this->input->post()['frete'],
				'total' 	=> $totalupdate+$novototal);

		$this->Vendas_model->updateVendas($queryupdatevenda, array('chave'=>$post['chave']));
		$this->Fluxo_model->updateFluxo(array('valor' => $totalupdate+$novototal+$this->input->post()['frete']), array('SKU'=>$post['chave']));

		redirect('vendas/dadosvenda/'.$post['chave']);

	}

	public function DeletarListaProdutos()
	{
		if($this->input->post())
		{
			$this->Listavendas_model->deleteLista(array('id'=>$this->input->post()['id']));

			echo json_encode('Excluido');
		}
	}
}