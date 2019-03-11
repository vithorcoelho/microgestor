<?php

class Configuracoes_model extends Mx_Controller
{
    private $tabela = 'sys_config';

	function __construct()
	{
		parent::__construct();
	}
	
	public function countAll()
	{
		return $this->db->count_all($this->tabela);
	}

	public function insertConfig(array $dadostabela = null)
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
	public function getConfig($select = null, $where = null, $ordem = array('id'=>'ASC'), $limit = null, $start = null, $like = null)
	{
		if($select)
		{
			$this->db->select($select);
		}
		if($where)
		{
			$this->db->where($where);
		}
		if($ordem)
		{
			$this->db->order_by(key($ordem), $ordem[key($ordem)]);
		}
		if($limit)
		{
			$this->db->limit($limit);
			
			if($start){
				$this->db->limit($limit, $start);
			}
		}
		if($like)
		{
			$this->db->like($like);
		}
		
		$dados = $this->db->get($this->tabela);

		return $dados->result();
	}

	public function deleteConfig($reference)
	{
		$this->db->delete($this->tabela, $reference);
	}

	public function updateConfig($data, $where)
	{
		$this->db->where($where);
		$this->db->set($data);
		$this->db->update($this->tabela);
	}	

}