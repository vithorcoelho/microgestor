<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function CriarTabela($table_name)
	{
		foreach ($this->db->list_tables() as $table)
		{
			if($table_name == $table)
			{
				return "A tabela {$table_name} já existe";
			}
		}

		$cria_tabela = 'CREATE TABLE ' . $table_name . '(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY)';

		$this->db->query($cria_tabela);
	}

	public function AdicionarColunasTabela($table_name, $campos)
	{
		foreach ($campos as $nome_coluna => $parametros_coluna)
		{
			if($this->db->field_exists($nome_coluna, $table_name))
			{
				echo 'Coluna ' . $nome_coluna . ' já existe!';
			}
			else
			{
				$query = "ALTER TABLE {$table_name} ADD {$nome_coluna} {$parametros_coluna}";

				$this->db->query($query);
			}
		}
	}
}