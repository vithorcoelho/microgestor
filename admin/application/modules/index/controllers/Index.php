<?php
class Index extends MX_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model(array('Fluxo_model', 'Vendas_model', 'Clientes_model'));

		login_verify();
	}

	public function index()
	{
		$dados['page_titulo'] = 'Home';
		$dados['titulo_header'] = 'Resumo';
		
		$dados['css'] = array(
			base_url('assets/styles/widgets/panels.min.css')
		);

		$mensal = $this->Fluxo_model->getFluxo(null, array('month(data)'=>date('m')));

		$dados['customensal'] = 0;
		$dados['receitamensal'] = 0;

		foreach ($mensal as $v)
		{
			if($v->tipo == 'Receita')
			{
				$dados['receitamensal'] = $dados['receitamensal'] + str_replace(',', '.', ($v->valor));;
			}
			else
			{
				$dados['customensal'] = $dados['customensal'] + str_replace(',', '.', ($v->valor));
			}
		}

		$dados['grafico'] = $this->DadosGrafico();
		$dados['pedidos'] = $this->PedidosRecentes(10);
		$dados['qtdvendas'] = $this->Vendas_model->countAll(array('month(data)'=>date('m')));

		$this->load->view('index', $dados);
	}

	private function PedidosRecentes($n = 5)
	{
		$vendas = $this->Vendas_model->getVendas('idcliente, data, chave, total', array('status'=>'Em andamento'), array('id'=>'DESC'), $n);

		if($vendas)
		{
			foreach ($vendas as $c)
			{
				$cliente = $this->Clientes_model->getClientes('nome', array('id' => $c->idcliente), null, 1);
				$pedidos[] = array(
					'cliente' 	=> $cliente[0]->nome,
					'data' 		=> $c->data,
					'chave'		=> $c->chave,
					'total' 	=> $c->total);
			}

			return $pedidos;
		}
	}

	private function DadosGrafico()
	{
		$voltaAno = 0; 

	    for($m=0;$m<=5;$m++){
	        
	        $numMes = date('n')-$m;
	        $ano = date('Y');
	        
	        if(!empty($voltaAno)) $numMes = $numMes+($voltaAno*12);     
	        if($numMes==0){ $numMes = 12; $voltaAno++;  }       # INCREMENTO CADA VEZ QUE O ANO MUDA
	        if(!empty($voltaAno)) $ano = date('Y')-$voltaAno;  
	        
	        $nome_meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
	        $numMes_nome = $numMes - 1;

	        $receita = $this->Fluxo_model->getFluxo('valor', array('month(data)'=>$numMes, 'tipo' => 'Receita'));
	        $despesa = $this->Fluxo_model->getFluxo('valor', array('month(data)'=>$numMes, 'tipo' => 'Despesa'));

	        $total_receita = 0;
	        $total_despesa = 0;

	        foreach ($receita as $s)
	        {
	        	$total_receita = $total_receita + $s->valor;
	        }

	        foreach ($despesa as $s)
	        {
	        	$total_despesa = $total_despesa + $s->valor;
	        }

	        $objMeses[] = array('mes' => $numMes, 'ano' => $ano, 'nome_mes' => $nome_meses[$numMes_nome], 'receita' => $total_receita, 'despesa' => $total_despesa);
	    }

	    return $objMeses;
	}
}