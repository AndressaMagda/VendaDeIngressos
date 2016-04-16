<?php
Class Cliente_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function getDadosCliente($codusuario){
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('codusuario', $codusuario);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function alterarDadosCliente($codusuario, $input){
		$this->db->where('codusuario', $codusuario);
		$query = $this->db->update('usuario', $input);
	
		if($query)
			return true;
		return false;
	}
	
	public function check_email_usuario_existence($email)
	{
		$this->db->where('email', $email );
		$query = $this->db->get('usuario');

		if($query->num_rows() == 1){
			$query = $query->row_array();
			if($email==$this->session->userdata('email')) return TRUE; //Ele pode alterar o email para o que já tem
			return FALSE;//já existe
		}
		return TRUE;//ainda não existe
	}
	
	public function get_dados_cinemas_cadastrados(){
		
		$this->db->select('*');
		$this->db->from('sessao');
		$this->db->order_by('dia', 'ASC');
		$dados_cinema = $this->db->get();
		$dados_cinema = $dados_cinema->result_array();
		
		for ($i=0; $i<count($dados_cinema); $i++){ //Busca na tabela cinema o nome pelo seu codigo, garantindo assim que só seja pego o cinema com sessões cadastradas
			$this->db->select('nome, estado, cidade, localizacao');
			$this->db->from('cinema');
			$this->db->where('codcinema', $dados_cinema[$i]['codcinema']);
			$query = $this->db->get();
			$query = $query->row_array();
			$dados_cinema[$i]['cinemaNome'] = $query['nome'];
			$dados_cinema[$i]['cinemaEstado'] = $query['estado'];
			$dados_cinema[$i]['cinemaCidade'] = $query['cidade'];
			$dados_cinema[$i]['cinemaLocalizacao'] = $query['localizacao'];
		}
		
		return $dados_cinema;
	}
	
	public function get_dados_cinema_selecionado($codcinema){
		$this->db->select('*');
		$this->db->where('codcinema', $codcinema);
		$this->db->from('sessao');
		$this->db->order_by('dia', 'ASC');
		$dados_cinema = $this->db->get();
		$dados_cinema = $dados_cinema->result_array();
		
		for ($i=0; $i<count($dados_cinema); $i++){ 
			$this->db->select('nome, estado, cidade, localizacao');
			$this->db->from('cinema');
			$this->db->where('codcinema', $codcinema);
			$query = $this->db->get();
			$query = $query->row_array();
			$dados_cinema[$i]['cinemaNome'] = $query['nome'];
			$dados_cinema[$i]['cinemaEstado'] = $query['estado'];
			$dados_cinema[$i]['cinemaCidade'] = $query['cidade'];
			$dados_cinema[$i]['cinemaLocalizacao'] = $query['localizacao'];
		}
		
		foreach ($dados_cinema as $key => $value) {
			if ($value['ingressos_vendidos'] < 3) {
				$dados_cinema[$key]['esgotado'] = false;
			} else {
				$dados_cinema[$key]['esgotado'] = true;
			}
		}
		
		return $dados_cinema;
		
	}
	
	public function get_dados_filme_selecionado($codsessao){
		$this->db->select('*');
		$this->db->from('sessao');
		$this->db->where('codsessao', $codsessao);
		$this->db->order_by('dia', 'ASC');
		$dados_cinema = $this->db->get();
		$dados_cinema = $dados_cinema->result_array();
		
		for ($i=0; $i<count($dados_cinema); $i++){ 
			$this->db->select('nome, estado, cidade, localizacao');
			$this->db->from('cinema');
			$this->db->where('codcinema', $dados_cinema[$i]['codcinema']);
			$query = $this->db->get();
			$query = $query->row_array();
			$dados_cinema[$i]['cinemaNome'] = $query['nome'];
			$dados_cinema[$i]['cinemaEstado'] = $query['estado'];
			$dados_cinema[$i]['cinemaCidade'] = $query['cidade'];
			$dados_cinema[$i]['cinemaLocalizacao'] = $query['localizacao'];
		}
		
		return $dados_cinema;
	}
	
	public function addCompraIngresso_tabSessao($codsessao, $inputSessao){
		
		$this->db->select('ingressos_vendidos, lugares_ocupados');
		$this->db->where('codsessao', $codsessao );
		$this->db->from('sessao');
		$query = $this->db->get();
		$query = $query->row_array();
		
		$ingressos_vendidos = 0;
		$lugares_ocupados = "";
		if(count($query)>0){
			$ingressos_vendidos = $query['ingressos_vendidos'];
			$lugares_ocupados =  $query['lugares_ocupados'];
		}
		$aux="";
		
		for ($i=0; $i<count($inputSessao['lugares_ocupados']);$i++){
			$aux.=$inputSessao['lugares_ocupados'][$i].",";
		}
		
		$aux = substr($aux, 0, -1);
		if ($lugares_ocupados=="")$inputSessao['lugares_ocupados'] = $aux.$lugares_ocupados;
		else $inputSessao['lugares_ocupados'] = $aux.",".$lugares_ocupados;
		
		$inputSessao['ingressos_vendidos']+=$ingressos_vendidos;
		
		$this->db->where('codsessao', $codsessao);
		$query = $this->db->update('sessao', $inputSessao);
		
	}
	
	public function getAssentosIndisponiveis($codsessao) {
		$this->db->select('lugares_ocupados');
		$this->db->where('codsessao', $codsessao);
		$this->db->from('sessao');
		$query = $this->db->get();
		$query = $query->row_array();
		
		$query = explode(",", $query['lugares_ocupados']);
		
		return $query;
	}
	
	public function addCompraIngresso_tabCompras($inputCompra){
		
		$lugares_ocupados = "";
		for($i=0; $i<count($inputCompra['assentos']); $i++){
			$lugares_ocupados.=$inputCompra['assentos'][$i].",";
		}
		$lugares_ocupados = substr($lugares_ocupados, 0, -1);
		$inputCompra['assentos'] = $lugares_ocupados;
		
		$this->db->insert('compras', $inputCompra);
		
	}
	
	public function get_compras_efetuadas($codusuario){
		$this->db->select('*');
		$this->db->where('codusuario', $codusuario);
		$this->db->from('compras');
		$this->db->order_by('codcompra', 'ASC');
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	public function get_compra_selecionada($codcompra){
		$this->db->select('*');
		$this->db->where('codcompra', $codcompra);
		$this->db->from('compras');
		$query = $this->db->get();
		
		return $query->row_array();
	}
	
	
}