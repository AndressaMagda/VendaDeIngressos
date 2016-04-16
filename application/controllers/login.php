<?php 

Class Login extends CI_Controller {

	public function __construct(){
			parent:: __construct();
			$this->load->helper(array('form','url','array','date'));
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->library('user_agent');
			$this->load->model('Login_model');
	}

	public function index(){
			
		$data ['title'] = "..::CINEMA::.. | Login";
		$this->form_validation->set_error_delimiters ( '<div class="error">', '</div>' );
		
		if ($this->form_validation->run ( 'login/index' ) == FALSE) {
			$this->load->view ( 'templates/header_login', $data );
			$this->load->view ( 'telas/login', $data );
			$this->load->view ( 'templates/footer' );
		} else {
			$codperfil = $this->input->post ( 'funcao' ); //Administrador=1 e Cliente=2
			$email = $this->input->post ( 'email' );
			$senha = $this->input->post ( 'senha' );
			
			if ($this->Login_model->validar_acesso ( $email, md5($senha), $codperfil ) === TRUE) {
				echo "login validado";
				if ($codperfil==1) redirect ( '/admin' );
				else 
					redirect ( '/cliente' );
				
			} else {
				
				$data ['title'] = "..::CINEMA::..";
				
				$this->load->view ( 'templates/header_login', $data );
				$this->load->view ( 'telas/login_bloqueado', $data );
				$this->load->view ( 'templates/footer' );
			}
		}
		
	}
	
	public function cadastro(){
		$data ['title'] = "..::CINEMA::.. | CADASTRO";
		
		if ($this->form_validation->run( 'login/cadastro' ) == FALSE) {
			$this->load->view ( 'templates/header_login', $data );
			$this->load->view ( 'telas/cadastro', $data );
			$this->load->view ( 'templates/footer' );
		} else {
			$nome = $this->input->post ( 'nome' );
			$dNascimento = $this->input->post ( 'datanascimento' );
			$email = $this->input->post ( 'email' );
			$senha = $this->input->post ( 'senha' );
			$estudante = $this->input->post ( 'estudante' );
			
			if($estudante == 1) $estudante = 't';
			else $estudante = 'f';
			
			$input = array(
						'nome' 				=> $nome,
						'data_nascimento'	=> $dNascimento,
						'email'				=> $email,
						'senha'				=> md5($senha),
						'codperfil'			=> 2, //Cliente
						'estudante' 		=> $estudante
					);
			
			if ($this->Login_model->add_usuario_cliente( $input ) === TRUE) {
				echo '<script>
						alert("Cadastro realizado com sucesso.");
					  	window.location="'.base_url()."index.php/login/index".'"
					  </script>';
			} else {
				echo '<script>
						alert("Cadastro Invalido! Tente novamente.");
					  	window.location="'.base_url()."index.php/login/cadastro".'"
					  </script>';
			}
		}
	}
	
	public function _valid_data($data)
	{
		$this->form_validation->set_message('_valid_data', '%s inválida');
		if ( $data != "" ) {
			$data = preg_replace('/[^0-9]/','',$data);
	
			if ( strlen($data) < 8) {
				return FALSE;
			}
	
			$mes = substr($data,2,2);
			$dia = substr($data,0,2);
			$ano = substr($data,4,4);
			$valid = checkdate($mes,$dia,$ano);
			return  $valid;
		}
	}
	
	public function _check_email_usuario_inexistence($email)
	{
		$this->form_validation->set_message('_check_email_usuario_inexistence', 'O %s informado não está cadastrado');

		return $this->Login_model->check_email_usuario_inexistence($email);
	}
	
	public function _check_usuario_senha($str)
	{
		$this->form_validation->set_message('_check_usuario_senha', 'O %s informada está incorreta');
		return $this->Login_model->check_usuario_senha(md5($str));
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
		
	}


}