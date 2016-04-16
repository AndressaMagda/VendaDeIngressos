<?php
class Recuperar_senha_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function check_email_usuario_inexistence($email)
	{
		$this->db->where('email', $email );
		$this->db->limit(1);
		$query = $this->db->get('usuario');
		if($query->num_rows() == 1){
			return TRUE;//já existe
		}
		return FALSE;//ainda não existe
	}
	
	public function update_usuario_senha($email, $nova_senha)
	{
		$result = self::pesquisar_usuario($email);
		
		foreach($result as $result_item){
			$data = array('senha' => md5($nova_senha));
			$this->db->where('codusuario', $result_item['codusuario']);
			
			$query = $this->db->update('usuario', $data);
		}
		
		if($query){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function pesquisar_usuario($email)
	{
		$this->db->select('codusuario, email');
		$this->db->where('email', $email );
		$query = $this->db->get('usuario');
		
		return $query->result_array();
	}
}	