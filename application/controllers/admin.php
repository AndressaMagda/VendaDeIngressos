<?php if (! defined('BASEPATH')) exit('Sem permissão de acesso direto ao script');

Class Admin extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form','url','array','date','html'));
		$this->load->library(array('session','calendar','table','form_validation', 'URLify'));
		$this->load->model("Admin_model");

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
	
	public function inserir_cinema(){
		$data['title'] = '..::CINEMA::.. | INSERIR CINEMA';
		
		if ($this->form_validation->run( 'admin/inserir_cinema' ) == FALSE) {
			$this->load->view ( 'templates/header', $data );
			$this->load->view ( 'admin/inserir_cinema', $data );
			$this->load->view ( 'templates/footer' );
		} else {
			$nome = $this->input->post ( 'nome' );
			$estado = $this->input->post ( 'estado' );
			$cidade = $this->input->post ( 'cidade' );
			$localizacao = $this->input->post ( 'localizacao' );

			$input = array(
						'nome' 		  => mb_strtoupper($nome, 'UTF-8'),
						'estado'	  => $estado,
						'cidade'	  => $cidade,
						'localizacao' => $localizacao,
					);
			
			if ($this->Admin_model->add_cinema( $input ) === TRUE) {
				echo '<script>
						alert("Cadastro realizado com sucesso.");
					  	window.location="'.base_url()."index.php/admin/inserir_cinema".'"
					  </script>';
			} else {
				echo '<script>
						alert("Cadastro Inv\u00e1lido! Tente novamente.");
					  	window.location="'.base_url()."index.php/admin/inserir_cinema".'"
					  </script>';
			}
		}
		
	}
	
	public function visualizar_cinema($codcidade = 0){
		$data['title'] = '..::CINEMA::.. | VISUALIZAR CINEMA';
		
		$data['cidade'] = $this->Admin_model->dropdown_cidades_cinema();
 		$data['cidade_atual'] = '';
 		$data['tabelaCinemas'] = '';
		
		if($codcidade != ""){
			$data['tabelaCinemas'] = $this->tabelaCinemasCidade($codcidade);
			$data['cidade_atual'] = $codcidade;
		}
		
		
		if ($this->form_validation->run( 'admin/visualizar_cinema' ) == FALSE) {
			$this->load->view ( 'templates/header', $data );
			$this->load->view ( 'admin/visualizar_cinema', $data );
			$this->load->view ( 'templates/footer' );
		} else {
 			
			$codcidade = ($this->input->post('cidade')) ? $this->input->post('cidade') : $_SESSION['cidade_atual'];
			$codcidade = $this->input->post('cidade');
			
			session_start();
			$_SESSION['cidade_atual'] = $codcidade;
		}
	}
	
 	public function tabelaCinemasCidade($codcidade){
 		
 		$dados = $this->Admin_model->get_cinema_cidade($codcidade);
		
		$tabela = '';
		
		if (count($dados)>0){
			$tabela .= 
			'
			<div class="panel panel-info" id="painel-atividade">
				<div class="panel-heading text-center"><strong>Cinemas Cadastrados em '.$dados[0]['cidade'].'</strong></div>
							<table class="table" id="tabelaCinemas">
			';
			$tabela .= '<tr>
							<th style="text-align: center;">Nome</th>
							<th style="text-align: center;">Localização</th>
							<th style="text-align: center;">Estado</th>
							<th> </th>
					 	</tr>';
			
			for($i = 0; $i < sizeof ( $dados ); $i ++) {
				
				$tabela .= '<tr">
							<td>' . $dados [$i] ['nome'] . '</td>
							<td>' . $dados [$i] ['localizacao'] . '</td>
							<td>' . $dados [$i] ['estado'] . '</td>
							<td><a href="' . base_url () . 'index.php/admin/removerLinhaCinema/' . $dados [$i] ['codcinema'] . '"><button type="button" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a>
							<a href="' . base_url () . 'index.php/admin/alterarLinhaCinema/' . $dados [$i] ['codcinema'] . '"><button type="button" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
							</tr>';
			}
			$tabela .= 
			'
							<tfoot>
							</tfoot>
						</table>
				</div>
			</div>
			
			';
			
			if ($codcidade and $codcidade != '' or $codcidade != null) {
				session_start ();
				$_SESSION ['cidade_atual'] = $codcidade;
			} 
		}
		
		return $tabela;
	}
	
	public function removerLinhaCinema($codcinema){
		session_start();
		if($this->Admin_model->removerLinhaCinema($codcinema) == TRUE) {
			if($codcinema == $_SESSION['cidade_atual']) $_SESSION['cidade_atual']='';
			echo '<script>
						alert("Cinema removido com sucesso!");
						window.location="'.base_url()."index.php/admin/visualizar_cinema/".$_SESSION['cidade_atual'].'"
					</script>';
		} else {
			echo '<script>
						alert("N\u00e3o foi poss\u00edvel remover o cinema. O mesmo possui sess\u00f5es cadastradas.");
						window.location="'.base_url()."index.php/admin/visualizar_cinema/".$_SESSION['cidade_atual'].'"
					</script>';
		}
	}
	
	public function alterarLinhaCinema($codcinema){
		$data['title'] = '..::CINEMA::.. | ALTERAR CINEMA';
		
		$data['dadosCinema'] = $this->Admin_model->getDadosCinema($codcinema);
		
		if ($this->form_validation->run( 'admin/alterar_cinema' ) == FALSE) {
			$this->load->view ( 'templates/header', $data );
			$this->load->view ( 'admin/alterar_cinema', $data );
			$this->load->view ( 'templates/footer' );
		} else {
			$nome = $this->input->post('nome');
			$estado = $this->input->post('estado');
			$cidade = $this->input->post('cidade');
			$localizacao = $this->input->post('localizacao');
			
			$input = array(
					'nome' 		  => $nome,
					'estado' 	  => $estado,
					'cidade' 	  => $cidade,
					'localizacao' => $localizacao
			);
			
			if($this->Admin_model->alterarLinhaCinema($codcinema, $input)){
				echo '<script>
						alert("Cinema alterado com sucesso!");
						window.location="'.base_url()."index.php/admin/visualizar_cinema/".$codcinema.'"
					</script>';
			}
			else{
				echo '<script>
						alert("N\u00e3o foi poss\u00edvel alterar o cinema. Tente Novamente.");
						window.location="'.base_url()."index.php/admin/visualizar_cinema/".$codcinema.'"
					</script>';
			}
		}
		
	}
	
	
	public function inserir_sessao(){
		$data['title'] = '..::CINEMA::.. | INSERIR SESSÃO';
		
		$data['cinema'] = $this->Admin_model->dropdown_cinemas_cadastrados();
		
		if ($this->form_validation->run( 'admin/inserir_sessao' ) == FALSE) {
			$this->load->view ( 'templates/header', $data );
			$this->load->view ( 'admin/inserir_sessao', $data );
			$this->load->view ( 'templates/footer' );
		} else {
			$cinema = $this->input->post ( 'cinema' );
			$dia = $this->input->post ( 'dia' );
			$dia = explode(",", $dia);
			$horario = $this->input->post ( 'hora' );
			$filme = $this->input->post ( 'filme' );
			$classificacao = $this->input->post ( 'classificacao' );
			$preco = $this->input->post ( 'preco' );
			$input = array(
					'codcinema'	  => $cinema,
					'dia' 		  => $dia,
					'horario'	  => $horario,
					'filme'	  => mb_strtoupper($filme, 'UTF-8'),
					'classificacao' => $classificacao,
					'preco'	  => $preco
			);
			
			if ($this->Admin_model->add_sessao( $input ) === TRUE) {
				echo '<script>
						alert("Sess\u00e3o cadastrada com sucesso.");
					  	window.location="'.base_url()."index.php/admin/inserir_sessao".'"
					  </script>';
			} else {
				echo '<script>
						alert("Sess\u00e3o Inv\u00e1lida! Tente novamente.");
					  	window.location="'.base_url()."index.php/admin/inserir_sessao".'"
					  </script>';
			}
		}
	
	}
	
	public function visualizar_sessao($codsessao = 0){
		$data['title'] = '..::CINEMA::.. | VISUALIZAR SESSÕES';
	
		$data['sessao'] = $this->Admin_model->dropdown_sessoes();
		$data['$sessao_atual'] = '';
		$data['tabelaSessoes'] = '';
	
		if($codsessao != 0){
			$data['tabelaSessoes'] = $this->tabelaSessao($codsessao);
			$data['sessao_atual'] = $codsessao;
		}
	
	
		if ($this->form_validation->run( 'admin/visualizar_sessao' ) == FALSE) {
			$this->load->view ( 'templates/header', $data );
			$this->load->view ( 'admin/visualizar_sessao', $data );
			$this->load->view ( 'templates/footer' );
		} else {
	
			$codsessao = ($this->input->post('sessao')) ? $this->input->post('sessao') : $_SESSION['sessao_atual'];
			$codsessao = $this->input->post('sessao');
				
			session_start();
			$_SESSION['sessao_atual'] = $codsessao;
		}
	}
	
	public function tabelaSessao($codsessao){
			
		$dados = $this->Admin_model->get_filme_sessao($codsessao);
		
		$tabela = '';
		
		if (count($dados)>0){
			$tabela .=
			'
			<div class="panel panel-info" id="painel-atividade">
				<div class="panel-heading text-center"><strong>FILMES CADASTRADOS NA SESSÃO</strong></div>
							<table class="table" id="tabelaCinemas">
			';
			$tabela .= '<tr>
							<th style="text-align: center;">DIA</th>
							<th style="text-align: center;">CINEMA</th>
							<th style="text-align: center;">FILME</th>
							<th style="text-align: center;">CLASSIFICAÇÃO</th>
							<th style="text-align: center;">PREÇO</th>
							<th style="text-align: center;"> </th>
							<th> </th>
					 	</tr>';
		
			for($i = 0; $i < sizeof ( $dados ); $i ++) {
				
				$tabela .= '<tr">
							<td>' . date('d/m/Y', strtotime($dados [$i] ['dia'])) . '</td>
							<td>' . $dados [$i]['cinemaNome'] . '</td>
							<td>' . $dados [$i] ['filme'] . '</td>
							<td>' . $dados [$i] ['classificacao']." anos" . '</td>
							<td>' . "$".$dados [$i] ['preco']. ".00" . '</td>
							<td><a href="' . base_url () . 'index.php/admin/removerLinhaSessao/' . $dados [$i] ['codsessao'] . '"><button type="button" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a>
							<a href="' . base_url () . 'index.php/admin/alterarLinhaSessao/' . $dados [$i] ['codsessao'] . '"><button type="button" class="btn btn-sm btn-warning"><span class="glyphicon glyphicon-pencil"></span></button></a></td>
							</tr>';
			}
			$tabela .=
			'
							<tfoot>
							</tfoot>
						</table>
				</div>
			</div>
		
			';
		
			if ($codsessao and $codsessao != '' or $codsessao != null) {
				session_start ();
				$_SESSION ['sessao_atual'] = $codsessao;
			}
		}
	
		return $tabela;
	}
	
	public function removerLinhaSessao($codsessao){
		session_start();
		if($this->Admin_model->removerLinhaSessao($codsessao) == TRUE) {
			echo '<script>
						alert("Sess\u00e3o removida com sucesso!");
						window.location="'.base_url()."index.php/admin/visualizar_sessao/".$_SESSION['sessao_atual'].'"
					</script>';
		} else {
			echo '<script>
						alert("N\u00e3o foi poss\u00edvel remover a sess\u00e3o.");
						window.location="'.base_url()."index.php/admin/visualizar_sessao/".$_SESSION['sessao_atual'].'"
					</script>';
		}
	}
	
	public function alterarLinhaSessao($codsessao){
		$data['title'] = '..::CINEMA::.. | ALTERAR SESSÃO';
		
		$data['cinemas'] = $this->Admin_model->dropdown_cinemas_cadastrados();
		$data['dadosSessao'] = $this->Admin_model->getDadosSessao($codsessao);
	
		if ($this->form_validation->run( 'admin/alterar_sessao' ) == FALSE) {
			$this->load->view ( 'templates/header', $data );
			$this->load->view ( 'admin/alterar_sessao', $data );
			$this->load->view ( 'templates/footer' );
		} else {
			$cinema = $this->input->post ( 'cinema' );
			$dia = $this->input->post ( 'dia' );
			$horario = $this->input->post ( 'hora' );
			$filme = $this->input->post ( 'filme' );
			$classificacao = $this->input->post ( 'classificacao' );
			$preco = $this->input->post ( 'preco' );
			$input = array(
					'codcinema'	  => $cinema,
					'dia' 		  => $dia,
					'horario'	  => $horario,
					'filme'	  => mb_strtoupper($filme, 'UTF-8'),
					'classificacao' => $classificacao,
					'preco'	  => $preco
			);
				
			if($this->Admin_model->alterarLinhaSessao($codsessao, $input)){
				echo '<script>
						alert("Sess\u00e3o alterada com sucesso!");
						window.location="'.base_url()."index.php/admin/visualizar_sessao/".$codsessao.'"
					</script>';
			}
			else{
				echo '<script>
						alert("N\u00e3o foi poss\u00edvel alterar a sess\u00e3o. Tente Novamente.");
						window.location="'.base_url()."index.php/admin/visualizar_sessao/".$codsessao.'"
					</script>';
			}
		}
	
	}
	
	
	
}