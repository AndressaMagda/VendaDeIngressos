<div id="conteudo" class="text-center">

	<div class="container"
		style="width: 900px; float: inherit; margin: 0 auto; margin-top: 2%;">

		<div class="panel panel-primary ">
			<div class="panel-heading">
				<h2 class="panel-title">
					<strong>LOGIN</strong>
				</h2>
			</div>
			<div class="panel-body">
				<div id="login_img" class="col-lg-8 text-center">
					<img width="250" height="150"
						src="<?php echo base_url();?>imagens/cinema_icon2.png" />
				</div>

			<?php echo form_open('/', array('class'=> 'form-horizontal text-center')); ?>
		
				<div class="col-sm-10">
					<div class="form-group">
						<label for="inputNivel" class="col-lg-3 control-label">Nível</label>
						<div class="input-group">
							<span class="input-group-addon"><span
								class="glyphicon glyphicon-question-sign"></span></span>
							<?php
							$opcao = array (
									"" => "Escolha a opção",
									"1" => "Administrador",
									"2" => "Cliente" 
							);
							$parametros = 'id="funcao" name="funcao" class="form-control" data-live-search="true" data-style="btn-default" autofocus required';
							echo form_dropdown ( 'funcao', $opcao, "", $parametros );
							?>
							</div>
					</div>

					<div class="form-group">
						<label for="inputEmail" class="col-lg-3 control-label">E-Mail</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span> 
							<input type="email" class="form-control text-left" id="email" name="email" value="<?php echo set_value('email');?>" required>
						</div>
						<div style="color: #B84842; font-weight:bold; font-size:90%;"> <?php echo form_error('email');?></div>
					</div>

					<div class="form-group">
						<label for="inputSenha" class="col-lg-3 control-label">Senha</label>
						<div class="input-group">
							<span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span> 
							<input type="password" class="form-control text-left" id="senha" name="senha" data-toggle="popover" title="Password Strength" data-content="Enter Password"
								value="<?php echo set_value('senha');?>" required>
						</div>
						<div style="color: #B84842; font-weight:bold; font-size:90%;"> <?php echo form_error('senha');?></div>
					</div>

					<div class="col-md-7 col-md-offset-4">
						<button type="submit" class="btn btn-md btn-primary btn-block">Entrar</button>
						<a href="http://localhost/trabalhoAps/index.php/login/cadastro">Se
							inscrever</a> ou <a href="http://localhost/trabalhoAps/index.php/recuperar_senha">Recuperar Senha</a>
					</div>

				</div>

			<?php echo form_close(); ?>	
			
			</div>

		</div>

	</div>

</div>