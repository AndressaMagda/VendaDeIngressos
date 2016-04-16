<?php
Class Admin_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function add_cinema($input){ //Insere um cinema no banco
		$query = $this->db->insert('cinema', $input);
		
		if ($query)
			return TRUE;
		return FALSE;
	}		
	
	public function dropdown_cidades_cinema(){ //Pega do banco as cidades que tem cinemas cadastrados
		$this->db->select('cidade, codcinema');
		$this->db->from('cinema');
		$this->db->order_by('cidade', 'ASC');
		$query = $this->db->get();
		
		$cidades = array();
		
		
		foreach ($query->result_array() as $row)
		{
			$cidades[$row['codcinema']] = $row['cidade'];
		}
		
		$cidades = array(''=>'Escolha a opção') + array_unique($cidades);
		
		return $cidades;
	}
	
	public function get_cinema_cidade($codcidade){
		$this->db->select('cidade');
		$this->db->from('cinema');
		$this->db->where('codcinema', $codcidade);
		$cidade = $this->db->get();
		$cidade = $cidade->row_array();
		if (count($cidade)>0){
			$cidade = $cidade['cidade'];
		}
		else{
			$cidade = null;
		} 
			
		$this->db->select('*');
		$this->db->from('cinema');
		$this->db->where('cidade', $cidade);
		$this->db->order_by('nome', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function removerLinhaCinema($codcinema){
		
		$permissao = FALSE; //não existe esse codcinema na tabela sessao
		$this->db->where('codcinema', $codcinema );
		$this->db->limit(1);
		$query = $this->db->get('sessao');
		if($query->num_rows() == 1){
			$permissao = TRUE;// existe
		}
		
		if($permissao==FALSE){
			$this->db->where('codcinema', $codcinema);
			$query = $this->db->delete('cinema');
			if($query) return true;
		}

	}
	
	public function getDadosCinema($codcinema){
		$this->db->select('*');
		$this->db->from('cinema');
		$this->db->where('codcinema', $codcinema);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function alterarLinhaCinema($codcinema, $input){
		$this->db->where('codcinema', $codcinema);
		$query = $this->db->update('cinema', $input);
		
		if($query)
			return true;
		return false;
	}
	
	public function add_sessao( $input ){
		
		for($i=0; $i<count($input['codcinema']); $i++){
			
			for($j=0; $j<count($input['dia']); $j++){
				
				$this->db->set('codcinema', $input['codcinema'][$i]);
				$this->db->set('dia', $input['dia'][$j]);
				
				$this->db->set('horario', $input['horario']);
				$this->db->set('filme', $input['filme']);
				$this->db->set('classificacao', $input['classificacao']);
				$this->db->set('preco', $input['preco']);
				
				$query = $this->db->insert('sessao');
			}
		}
		
		if ($query)
			return TRUE;
		return FALSE;
	}
	
	public function dropdown_cinemas_cadastrados(){
		$this->db->select('nome, codcinema');
		$this->db->from('cinema');
		$this->db->order_by('nome', 'ASC');
		$query = $this->db->get();
		
		$cinemas = array();
		
		
		foreach ($query->result_array() as $row)
		{
			$cinemas[$row['codcinema']] = $row['nome'];
		}
		
		return array_unique($cinemas);
	}
	
	public function dropdown_sessoes(){
		$this->db->select('horario, codsessao');
		$this->db->from('sessao');
		$this->db->order_by('horario', 'ASC');
		$query = $this->db->get();
		
		$sessoes = array();
		
		
		foreach ($query->result_array() as $row)
		{
			$sessoes[$row['codsessao']] = $row['horario'];
		}
		
		$sessoes = array(''=>'Escolha a opção') + array_unique($sessoes);
		
		return $sessoes;
	}
	
	public function get_filme_sessao($codsessao){
		
		$this->db->select('horario');
		$this->db->from('sessao');
		$this->db->where('codsessao', $codsessao);
		$horario = $this->db->get();
		$horario = $horario->row_array();
		
		if (count($horario)>0){
			$horario = $horario['horario'];
		}
		else{
			$horario = null;
		}
		
		$this->db->select('*');
		$this->db->from('sessao');
		$this->db->where('horario', $horario);
		$this->db->order_by('dia', 'ASC');
		$dados_sessao = $this->db->get();
		$dados_sessao = $dados_sessao->result_array();
		
		$nomeCinema = array();
		
		for ($i=0; $i<count($dados_sessao); $i++){ ///Busca na tabela cinema o nome pelo seu codigo
			$this->db->select('nome');
			$this->db->from('cinema');
			$this->db->where('codcinema', $dados_sessao[$i]['codcinema']);
			$query = $this->db->get();
			$query = $query->row_array();
			$dados_sessao[$i]['cinemaNome'] = $query['nome'];
		}
		
		return $dados_sessao;
	}
	
	public function removerLinhaSessao($codsessao){
	
			$this->db->where('codsessao', $codsessao);
			$query = $this->db->delete('sessao');
			
			if($query) return true;
			return false;
	}
	
	public function getDadosSessao($codsessao){
		$this->db->select('*');
		$this->db->from('sessao');
		$this->db->where('codsessao', $codsessao);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function alterarLinhaSessao($codsessao, $input){
		$this->db->where('codsessao', $codsessao);
		$query = $this->db->update('sessao', $input);
		
		if($query)
			return true;
		return false;
	}
	
	
}