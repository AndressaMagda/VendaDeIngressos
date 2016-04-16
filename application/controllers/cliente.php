<?php if (! defined('BASEPATH')) exit('Sem permissão de acesso direto ao script');

Class Cliente extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','array','date','html'));
		$this->load->library(array('session','calendar','table','form_validation', 'email'));
		$this->load->model("Cliente_model");

		if ($this->session->userdata('logado') != TRUE) {

			$data['title'] = "..::CINEMA::..";
				
			$this->load->view('templates/header',$data);
			$this->load->view('telas/sessao');
			$this->load->view('templates/footer');
			$this->output->_display();
			exit();
		}
	}
	
	public function index(){
		
		$data['title'] = '..::CINEMA::.. | HOME';
		$data['css'] = "";
		
		$this->load->view('templates/header', $data);
		$this->load->view('telas/home');
		$this->load->view('templates/footer');
	}
	
	public function editar_cadastro(){
		$data['title'] = '..::CINEMA::.. | ALTERAR DADOS';
		$codusuario=$this->session->userdata('codusuario');
		$dados = $this->Cliente_model->getDadosCliente($codusuario);
		
		if($dados[0]['estudante']=="t") $dados[0]['estudante']= 1;
		else $dados[0]['estudante']=2;
		
		$dados[0]['data_nascimento'] = date("d/m/Y", strtotime($dados[0]['data_nascimento']));
		$data['dados'] = $dados;

		if ($this->form_validation->run( 'cliente/editar_cadastro' ) == FALSE) {
			$this->load->view ( 'templates/header', $data );
			$this->load->view ( 'cliente/editar_cadastro', $data );
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
	
			if($this->Cliente_model->alterarDadosCliente($codusuario, $input)){
				echo '<script>
						alert("Dados alterados com Sucesso. Realize o login novamente.");
					  	window.location="'.base_url()."index.php/".'"
					  </script>';
			}
			else{
				echo '<script>
						alert("N\u00e3o foi poss\u00edvel alterar os dados. Tente Novamente.");
					  	window.location="'.base_url()."index.php/cliente/editar_cadastro".'"
					  </script>';
			}
		}
		
	}
	
	public function _check_email_usuario_existence($email)
	{
		$this->form_validation->set_message('_check_email_usuario_existence', 'O %s informado está cadastrado. Escolha outro.');

		return $this->Cliente_model->check_email_usuario_existence($email);
	}
	
	public function selecionar_cinema(){
		
		$data['title'] = '..::CINEMA::.. | SELECIONAR CINEMA';
		
		$data['dadosCinemas'] = $this->Cliente_model->get_dados_cinemas_cadastrados();
	
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'cliente/selecionar_cinema', $data );
		$this->load->view ( 'templates/footer' );
		
	}
	
	public function selecionar_filme($codcinema){
		$data['title'] = '..::CINEMA::.. | SELECIONAR FILME';
		$data['dadosCinemas'] = $this->Cliente_model->get_dados_cinema_selecionado($codcinema);
// 		echo '<pre>';
// 		print_r($data['dataNascimento']);
// 		echo '</pre>'; exit();
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'cliente/selecionar_filme', $data );
		$this->load->view ( 'templates/footer' );
	}
	
	
	public function comprar_ingresso($codsessao){
		$data['title'] = '..::CINEMA::.. | COMPRAR INGRESSO';
		
		$dadosFilme = $this->Cliente_model->get_dados_filme_selecionado($codsessao);
		
		$data['dadosFilme'] = $dadosFilme;
		
		$assentos_comprados = $this->Cliente_model->getAssentosIndisponiveis($codsessao);
		
		$data['assentos_comprados']=$assentos_comprados;
		
		if ($this->form_validation->run( 'cliente/comprar_ingresso' ) == FALSE) {
			$this->load->view ( 'templates/header', $data );
			$this->load->view ( 'cliente/comprar_ingresso', $data );
			$this->load->view ( 'templates/footer' );
		} else {
			$qtd_ingresso = $this->input->post ( 'qtd_ingresso' );
			$valor = $qtd_ingresso*$dadosFilme[0]['preco'];
			$assento = $this->input->post ( 'assento' );

			$concatena = true;
			
			if($assento==2){ //Caso o cliente opte por nao escolher os assentos, os assentos são atribuidos
							 //verificando os que já estão no banco, para não correr perigo de vender um mesmo 
							 // assento mais de uma vez
				$falta = $qtd_ingresso-1;
				$assento_escolhido = array();
				
				for ($i=1; $i<=40; $i++){
					for ($j=0; $j<count($assentos_comprados); $j++){
						if($assentos_comprados[$j]==$i){
							$concatena = false;
						}
					}
					if($concatena==true){
						$assento_escolhido[$falta] = $i;
						$falta = $falta-1;
						if($falta<0) break;
					}
					$concatena = true;
				}
					
			}
			else{
				$assento_escolhido = $this->input->post ( 'assento_disponivel' );
			}
				
			
			$forma_pagamento = $this->input->post ( 'pagamento' );
			
			$parcelamento=1;
			if($forma_pagamento=="Crédito" && $valor>50){ //O valor deve ser maior que 50, mas setei como 2 para teste
				$parcelamento = $this->input->post ( 'parcelamento' );
			}
			
			$inputSessao = array(
				'ingressos_vendidos' => $qtd_ingresso,
				'lugares_ocupados'	 => $assento_escolhido,
			);
			if($this->session->userdata('estudante')=="t") $valor = $valor/2;
			

			$inputCompra = array(
				'codusuario' => $this->session->userdata('codusuario'),
				'cinema' => $dadosFilme[0]['cinemaNome'],
				'filme' => $dadosFilme[0]['filme'],
				'dia' => $dadosFilme[0]['dia'],
				'horario' => $dadosFilme[0]['horario'],
				'qtd_ingresso' => $qtd_ingresso,
				'assentos' => $assento_escolhido,
				'valor_pago' => $valor,
				'forma_pagamento' => $forma_pagamento,
				'parcelas' => $parcelamento,
			);
			
				
			$this->Cliente_model->addCompraIngresso_tabCompras($inputCompra);
			$this->Cliente_model->addCompraIngresso_tabSessao($codsessao, $inputSessao);
			redirect('cliente/visualizar_compras');
			
		}
		
	}
	
	public function visualizar_compras(){
		$data['title'] = '..::CINEMA::.. | VISUALIZAR COMPRAS';
		$codusuario = $this->session->userdata('codusuario');
		$data['dadosCompras'] = $this->Cliente_model->get_compras_efetuadas($codusuario);
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'cliente/visualizar_compras', $data );
		$this->load->view ( 'templates/footer' );
	}
	
	public function ver_ingressos($codcompra){
		$data['title'] = '..::CINEMA::.. | INGRESSOS COMPRADAS';
		$codusuario = $this->session->userdata('codusuario');
		
		$dadosCompra = $this->Cliente_model->get_compra_selecionada($codcompra);
		
		$tipoEntrada = $this->session->userdata('estudante');
		if($tipoEntrada=="t") $tipoEntrada = "Meia Entrada";
		else $tipoEntrada = "Inteira";
		
		$assentos = explode(",", $dadosCompra['assentos']);
		$valor = $dadosCompra['valor_pago']/$dadosCompra['qtd_ingresso'];
		
		$ingresso = "";
		
		for($i = 0; $i < count($assentos); $i++) {
		
			$ingresso .=
			'
			<div style="margin-top:20px; text-align:center; background-color: #000; color: white; width:450px; font-size: large;">INGRESSO</div>
							<table cellspacing="0" style="border: solid black 1px; background-color: #F3F3F3; text-align:center; width:450px; height:150px;">
			';
			$ingresso .= '<tr >
							<th style="text-align: center;">Cinema</th>
							<th style="text-align: center;">Filme</th>
							<th style="text-align: center;">Data</th>
							<th style="text-align: center;">Horário</th>
							<th style="text-align: center;">Assento</th>
							<th style="text-align: center;">Tipo</th>
							<th style="text-align: center;">Valor</th>
					 	</tr>';
		
			$ingresso .= '<tr>
							<td>' . $dadosCompra['cinema']   					   . '</td>
							<td>' . $dadosCompra['filme']    					   . '</td>
							<td>' . date('d/m/Y', strtotime($dadosCompra['dia']))  . '</td>
							<td>' . $dadosCompra['horario']  					   . '</td>
							<td>' . "Cadeira ".$assentos[$i] 					   . '</td>
							<td>' .     $tipoEntrada        					   . '</td>
							<td>' .     "$ ".$valor." reais"         			   . '</td>
						</tr>';
		
			$ingresso .=
			'
					</table><br />
			';
		
		}//fim_for
		
		$data['ingresso'] = $ingresso;
		
		$this->load->view ( 'templates/header', $data );
		$this->load->view ( 'cliente/ver_ingressos', $data );
		$this->load->view ( 'templates/footer' );
	}
	
	public function verifica_envio($codcompra){
		
		if (self::enviar_ingressos($codcompra)==TRUE){
			echo '<script>
						alert("Ingresso(s) enviado(s) para: '. $this->session->userdata('email') .'");
						window.location="'.base_url()."index.php/cliente/visualizar_compras".'"
					</script>';
		}
		else {
			echo '<script>
						alert("Falha ao enviar ingressos. Tente novamente.");
						window.location="'.base_url()."index.php/cliente/visualizar_compras".'"
					</script>';
		}
	}
	
	public function enviar_ingressos($codcompra){
		$dadosCompra = $this->Cliente_model->get_compra_selecionada($codcompra);
		
		$tipoEntrada = $this->session->userdata('estudante');
		if($tipoEntrada=="t") $tipoEntrada = "Meia Entrada";
		else $tipoEntrada = "Inteira";

		$assentos = explode(",", $dadosCompra['assentos']);
		$valor = $dadosCompra['valor_pago']/$dadosCompra['qtd_ingresso'];
		
		$assunto = "SISTEMA DE VENDA DE INGRESSOS - Ingressos Comprados";
		
		$ingresso = "";
		
		for($i = 0; $i < count($assentos); $i++) {
				
			$ingresso .=
			'
			<div style="margin-top:20px; text-align:center; background-color: #000; color: white; width:450px; font-size: large;">INGRESSO</div>
							<table cellspacing="0" style="border: solid black 1px; background-color: #F3F3F3; text-align:center; width:450px; height:150px;">
			';
			$ingresso .= '<tr >
							<th style="text-align: center;">Cinema</th>
							<th style="text-align: center;">Filme</th>
							<th style="text-align: center;">Data</th>
							<th style="text-align: center;">Horário</th>
							<th style="text-align: center;">Assento</th>
							<th style="text-align: center;">Tipo</th>
							<th style="text-align: center;">Valor</th>
					 	</tr>';
		
			$ingresso .= '<tr>
							<td>' . $dadosCompra['cinema']   					   . '</td>
							<td>' . $dadosCompra['filme']    					   . '</td>
							<td>' . date('d/m/Y', strtotime($dadosCompra['dia']))  . '</td>
							<td>' . $dadosCompra['horario']  					   . '</td>
							<td>' . "Cadeira ".$assentos[$i] 					   . '</td>
							<td>' .     $tipoEntrada        					   . '</td>
							<td>' .     "$ ".$valor." reais"         			   . '</td>
						</tr>';
				
			$ingresso .=
			'
					</table><br />
			';
		
		}//fim_for

		
			
		$this->email->to($this->session->userdata('email'));
		$this->email->from('magdandressa@gmail.com', 'Administrador');
		$this->email->reply_to('magdandressa@gmail.com', 'Administrador');
		$this->email->subject($assunto);
		$this->email->message($ingresso);
		
		if ($this->email->send() ) {
			$email = TRUE;
		} else {
			$email = FALSE;
		}
		
		return $email;
		
	}//fim_function
	
}

