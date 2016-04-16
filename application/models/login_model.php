<?php

Class Login_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function validar_acesso($email, $senha, $codperfil){
		
		$this->db->select('*'); 
		$this->db->where('codperfil',$codperfil);
    	$this->db->where('email',$email);
    	$this->db->where('senha',$senha);
    	$query = $this->db->get('usuario');
    	
    	if ($query->num_rows() == 1) {
    			
    			$this->db->select('codusuario');
                $this->db->where( 'email', $email);
                
    			$data = array(
    				'codusuario' => $query->row()->codusuario,
					'nome' => $query->row()->nome,
    				'data_nascimento' => $query->row()->data_nascimento,
    				'estudante' => $query->row()->estudante,
    				'email'	=>$query->row()->email,
    				'senha'	=>$query->row()->senha,
					'logado' => true,
    				'codperfil' =>$query->row()->codperfil,
				);
    			
				$this->session->set_userdata($data);
				return TRUE;
				
    		} else {
    			return FALSE;
    		}
	}
	
	
	public function add_usuario_cliente($input){

		$this->db->where('email', $input['email']);
		$this->db->where('codperfil', $input['codperfil']);
		$query = $this->db->get('usuario');

		//se existir
		if ($query->num_rows() > 0) {
			return print "<script type='text/javascript'>
							alert('E-Mail ja cadastrado!');
						</script>";
		}
		
		$query = $this->db->insert('usuario', $input);
		
		if ($query) return TRUE;
		
		return FALSE;
	}
	
		
	public function check_email_usuario_inexistence($str)
	{
    	$this->db->where('email', $str );
    	$this->db->limit(1);
    	$query = $this->db->get('usuario');
    	if($query->num_rows() == 1){
    		return TRUE;//já existe
    	}
    	return FALSE;//ainda não existe
    }
    
	public function check_usuario_senha($str)
	{
    	$this->db->where('senha',$str);
    	$this->db->limit(1);
    	$query = $this->db->get('usuario');
    	if($query->num_rows() == 1){
    		return TRUE;//já existe
    	}
    	return FALSE;//ainda não existe
    }
}
