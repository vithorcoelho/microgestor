<?php

class Fluxo_model extends CI_Model
{
	private $tabela = 'erp_fluxocaixa_';

	function __construct()
	{
		parent::__construct();

		$this->setTable('erp_fluxocaixa_' . $this->session->userdata('admin_id'));
	}

	public function setTable($table)
	{
		$this->tabela = $table;
	}

	public function inFluxo(array $dadostabela = null)
	{
		if(!$dadostabela)
		{
			return 'Erro: Os dados da tabela não foram informados';
		}
		if($dadostabela)
		{
			$insert = $this->db->insert($this->tabela, $dadostabela);

			if($insert)
			{
				return $this->db->insert_id();
			}
			else
			{
				return false;
			}
		}
	}

	public function getFluxo($select = null, $where = null, $ordem = array('id'=>'ASC'), $limit = null)
	{
		if($select)
		{
			$this->db->select($select);
		}
		if($limit)
		{
			$this->db->limit($limit);
		}
		if($where)
		{
			$this->db->where($where);
		}
		if($ordem)
		{
			$this->db->order_by(key($ordem), $ordem[key($ordem)]);
		}
		
		$dados = $this->db->get($this->tabela);

		return $dados->result();
	}

	public function deleteFluxo($reference)
	{
		$this->db->delete($this->tabela, $reference);
	}

	public function updateFluxo($data, $where)
	{
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update($this->tabela);
	}
}