<?php

class Recuperar_senha extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','array','date','html'));
		$this->load->library(array('session','calendar','table','form_validation','email'));
		$this->load->model('Recuperar_senha_model');
	}
	
	public function index()
	{
		$data['title'] = "Recuperar senha";
		
		if ($this->form_validation->run('recuperar_senha/index') == FALSE){
			$this->load->view('templates/header_login',$data);
			$this->load->view('telas/recuperar_senha');
			$this->load->view('templates/footer');
		} else {
			$email = $this->input->post('email');
			$senha = self::geraSenha(8,true,true,false);
			$nova_senha = trim($senha);
			$result_email = self::email($nova_senha, $email);
			
			$this->Recuperar_senha_model->update_usuario_senha($email,$nova_senha);
			
			if($result_email == TRUE AND $this->Recuperar_senha_model->update_usuario_senha($email,$nova_senha) == TRUE){
				
				$usuario = $this->Recuperar_senha_model->pesquisar_usuario($email);
				$usuario_email = $usuario[0]['email'];
				
				echo '<script>
						alert("Senha alterada com sucesso! Nova senha enviada para: '. $usuario_email .'");
						window.location="'.base_url()."index.php".'"
					</script>';
			}else{
				echo '<script>
						alert("N\u00e3o foi posivel alterar a senha! Tente novamente.");
						window.location="'.base_url()."index.php/recuperar_senha".'"
					</script>';
			}
		}
		
	}
	
	public function email($senha, $email){

		
		$usuario = $this->Recuperar_senha_model->pesquisar_usuario($email);
		
		$assunto = "SISTEMA DE VENDA DE INGRESSOS - Recuperação de Senha";
		$mensagem = '<div style="font-size: 11pt">';
		$mensagem .= 'Conforme solicitação, sua nova <b>Senha de Acesso</b> é: '. $senha .' <br/><br/>';
		$mensagem .= 'Não divulgue sua senha. Recomendamos trocá-la periodicamente.<br /><br/>';
		$mensagem .= '<b>Não responda esta mensagem</a></b><br /><br />';
		$mensagem .= '</div>';

        $usuario_email = $usuario[0]['email'];
			
		$this->email->to($usuario_email);
		$this->email->from('magdandressa@gmail.com', 'Administrador');
		$this->email->reply_to('magdandressa@gmail.com', 'Administrador');
		$this->email->subject($assunto);
		$this->email->message($mensagem);

		if ($this->email->send() ) {
			$email = TRUE;
		} else {
			$email = FALSE;
		}
		
		return $email;
	}
	
	public function _check_email_usuario_inexistence($email)
	{
		$this->form_validation->set_message('_check_email_usuario_inexistence', 'O %s informado não está cadastrado');
		return $this->Recuperar_senha_model->check_email_usuario_inexistence($email);
	}
	
	function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
		$lmin = 'abcdefghijklmnopqrstuvwxyz';
		$lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$num = '1234567890';
		$simb = '!@#$%';
		$retorno = '';
		$caracteres = '';
	
		$caracteres .= $lmin;
		if ($maiusculas){
			$caracteres .= $lmai;
		}
		if ($numeros){
			$caracteres .= $num;
		}
		if ($simbolos){
			$caracteres .= $simb;
		}
	
		$len = strlen($caracteres);
	
		for ($n = 1; $n <= $tamanho; $n++) {
			$rand = mt_rand(1, $len);
			$retorno .= $caracteres[$rand-1];
		}
	
		return $retorno;
	}
}