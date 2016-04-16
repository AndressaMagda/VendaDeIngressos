<?php 
	
	$config = array(

		/* Login */

		'login/index' => array(
				array(
						'field'=>'funcao',
						'label'=>'Função',
						'rules'=>'required'
				),
				array(
						'field'=>'email',
						'label'=>'E-Mail',
						'rules'=>'required|callback__check_email_usuario_inexistence'
				),
				array(
						'field'=>'senha',
						'label'=>'Senha',
						'rules'=>'required|callback__check_usuario_senha'
				),
				
		),
		
		/* Recuperar Senha */
		
		'recuperar_senha/index' => array(
				array(
						'field'=>'email',
						'label'=>'Email',
						'rules'=>'trim|required|callback__check_email_usuario_inexistence'
				),
		),
		
		/* Cadastro */
		'login/cadastro' => array(
				array(
						'field'=>'nome',
						'label'=>'Nome',
						'rules'=>'required|trim'
				),
				array(
						'field'=>'datanascimento',
						'label'=>'Data de Nascimento',
						'rules'=>'required'
				),
				array(
						'field'=>'email',
						'label'=>'E-Mail',
						'rules'=>'trim|required|is_unique[usuario.email]'
				),
				array(
						'field'=>'senha',
						'label'=>'Senha',
						'rules'=>'required|trim'
				),
				array(
						'field'=>'estudante',
						'label'=>'Estudante',
						'rules'=>'required'
				),
		
		),
		
		
		/* Administrador */
			
			/* Cinema */
		
		'admin/inserir_cinema' => array(
				array(
						'field'=>'nome',
						'label'=>'Nome',
						'rules'=>'required|trim'
				),
				array(
						'field'=>'estado',
						'label'=>'Estado',
						'rules'=>'required'
				),
				array(
						'field'=>'cidade',
						'label'=>'Cidade',
						'rules'=>'required'
				),
				array(
						'field'=>'localizacao',
						'label'=>'Localização',
						'rules'=>'required'
				),
		
			),
			
			'admin/alterar_cinema'=> array(
				array(
						'field'=>'nome',
						'label'=>'Nome',
						'rules'=>'required|trim'
				),
				array(
						'field'=>'estado',
						'label'=>'Estado',
						'rules'=>'required'
				),
				array(
						'field'=>'cidade',
						'label'=>'Cidade',
						'rules'=>'required'
				),
				array(
						'field'=>'localizacao',
						'label'=>'Localização',
						'rules'=>'required'
				),
		
			),
			
				/* Sessão */
			
			'admin/inserir_sessao' => array(
					array(
							'field'=>'cinema',
							'label'=>'Cinema',
							'rules'=>'required'
					),
					array(
							'field'=>'dia',
							'label'=>'Dia',
							'rules'=>'required'
					),
					array(
							'field'=>'hora',
							'label'=>'Horário',
							'rules'=>'required|trim'
					),
					array(
							'field'=>'filme',
							'label'=>'Filme',
							'rules'=>'required|trim'
					),
					array(
							'field'=>'classificacao',
							'label'=>'Classificação',
							'rules'=>'required'
					),
					array(
							'field'=>'preco',
							'label'=>'Preço',
							'rules'=>'required'
					),
			
			),
			
			'admin/alterar_sessao'=> array(
					array(
							'field'=>'cinema',
							'label'=>'Cinema',
							'rules'=>'required'
					),
					array(
							'field'=>'dia',
							'label'=>'Dia',
							'rules'=>'required'
					),
					array(
							'field'=>'hora',
							'label'=>'Horário',
							'rules'=>'required|trim'
					),
					array(
							'field'=>'filme',
							'label'=>'Filme',
							'rules'=>'required|trim'
					),
					array(
							'field'=>'classificacao',
							'label'=>'Classificação',
							'rules'=>'required'
					),
					array(
							'field'=>'preco',
							'label'=>'Preço',
							'rules'=>'required'
					),
			
			),
			
			/*Cliente*/
			
			'cliente/editar_cadastro'=> array(
				array(
						'field'=>'nome',
						'label'=>'Nome',
						'rules'=>'required|trim'
				),
				array(
						'field'=>'datanascimento',
						'label'=>'Data de Nascimento',
						'rules'=>'required'
				),
				array(
						'field'=>'email',
						'label'=>'E-Mail',
						'rules'=>'trim|required|callback__check_email_usuario_existence'
				),
				array(
						'field'=>'senha',
						'label'=>'Senha',
						'rules'=>'required|trim'
				),
				array(
						'field'=>'estudante',
						'label'=>'Estudante',
						'rules'=>'required'
				),
		
			),
			
			'cliente/comprar_ingresso'=> array(
					array(
							'field'=>'qtd_ingresso',
							'label'=>'Quantidade Ingressos',
							'rules'=>'required'
					),
					array(
							'field'=>'assento',
							'label'=>'Assento',
							'rules'=>'required'
					),
					array(
							'field'=>'pagamento',
							'label'=>'Forma de Pagamento',
							'rules'=>'required'
					),
			
			),
			
			
			
			
	);

?>