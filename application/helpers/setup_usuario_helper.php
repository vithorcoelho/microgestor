<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	function TabelaClientes()
	{
		$campos = array(
			'nome' 		=> 'VARCHAR(55) NOT NULL',
			'email' 	=> 'VARCHAR(55) NOT NULL',
			'cpf' 		=> 'VARCHAR(24) NOT NULL',
			'cidade'	=> 'VARCHAR(24) NOT NULL',
			'endereco' 	=> 'VARCHAR(128) NOT NULL',
			'telefone' 	=> 'VARCHAR(24) NOT NULL',
			'celular' 	=> 'VARCHAR(24) NOT NULL',
			'pessoa'	=> 'VARCHAR(24) NOT NULL'
		);
		return $campos;
	}

	function TabelaProdutos()
	{
		$campos = array(
			'nome' 		=> 'VARCHAR(55) NOT NULL',
			'tipo'		=> 'VARCHAR(55)',
			'custo' 	=> 'DOUBLE',
			'preco' 	=> 'DOUBLE NOT NULL',
			'preco_atacado' => 'DOUBLE',
			'estoque_inicial' => 'INT',
			'estoque_maximo' => 'INT',
			'ref'		=> 'VARCHAR(55) NOT NULL',
		);
		return $campos;
	}

	function TabelaVendas()
	{
		$campos = array(
			'idcliente' => 'INT NOT NULL',
			'data' 		=> 'DATE',
			'status' 	=> 'VARCHAR(24)',
			'obs'		=> 'TEXT',
			'frete'		=> 'DOUBLE',
			'pagamento'	=> 'VARCHAR(55)',
			'chave'		=> 'VARCHAR(55)',
			'total'		=> 'DOUBLE'
		);
		return $campos;
	}

	function TabelaListavendas()
	{
		$campos = array(
			'produto' 		=> 'VARCHAR(55) NOT NULL',
			'idproduto'		=> 'INT',
			'ref'			=> 'VARCHAR(55)',
			'quantidade' 	=> 'INT',
			'preco' 		=> 'DOUBLE NOT NULL',
			'idcliente'		=> 'INT NOT NULL',
			'chave' 		=> 'VARCHAR(128) NOT NULL'
		);
		return $campos;
	}

	function TabelaFluxocaixa()
	{
		$campos = array(
			'descricao' => 'VARCHAR(55) NOT NULL',
			'valor'		=>	'DOUBLE NOT NULL',
			'data'		=> 'DATE NOT NULL',
			'tipo' 		=> 'VARCHAR(55) NOT NULL',
			'SKU'		=> 'VARCHAR(55)'
		);
		return $campos;
	}
	
	function TabelaDadosEmpresa()
	{
		$campos = array(
			'nome_empresa' 	=> 'VARCHAR(55) NOT NULL',
			'email_empresa'	=> 'VARCHAR(55)',
			'cnpj'			=> 'VARCHAR(55)',
			'cidade' 		=> 'VARCHAR(55)',
			'endereco'		=> 'VARCHAR(55)',
			'telefone'		=> 'VARCHAR(55)'
		);
		return $campos;
	}