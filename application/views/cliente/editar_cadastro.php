<div id="conteudo" class="text-center">

	<div class="container"
		style="width: 900px; float: inherit; margin: 0 auto; margin-top: 2%;">

		<div class="panel panel-info" id="cadastroPainel">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<strong>Alterar Dados</strong>
				</h3>
			</div>
			<div class="panel-body">
		
		<?php echo form_open('cliente/editar_cadastro/', array('class'=> 'form-horizontal', 'id'=>'form', 'name'=>'form')); ?>
				
				<div class="form-group">
					<label for="inputNome" class="col-sm-3 control-label">Nome</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span
							class="glyphicon glyphicon-user"></span></span> <input
							type="text" class="form-control text-left" id="nome" name="nome"
							value="<?php echo $dados[0]['nome'];?>" autofocus required>
					</div>
				</div>

				<div class="form-group">
					<label for="inputDataNascimento" class="col-sm-3 control-label">Data
						de Nascimento</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span
							class="glyphicon glyphicon-calendar"></span></span> 
							<input type="text" class="form-control text-left" id="datanascimento"
							name="datanascimento" value="<?php echo $dados[0]['data_nascimento'];?>"  maxlength="0" required>
					</div>
				</div>

				<div class="form-group">
					<label for="inputEmail" class="col-sm-3 control-label">E-Mail</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span
							class="glyphicon glyphicon-envelope"></span></span> <input
							type="email" class="form-control text-left" id="email"
							name="email" value="<?php echo $dados[0]['email'];?>" required>
					</div>
					<div style="color: #B84842; font-weight:bold; font-size:90%;"><?php echo form_error ( 'email' ); ?></div>
				</div>

				<div class="form-group">
					<label for="inputSenha" class="col-sm-3 control-label">Senha</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span
							class="glyphicon glyphicon-lock"></span></span> <input
							type="password" class="form-control text-left" id="senha"
							name="senha" value="<?php echo set_value('senha');?>" required>
					</div>
				</div>

				<div class="form-group">
					<label for="inputEstudante" class="col-sm-3 control-label">Estudante</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span
							class="glyphicon glyphicon-question-sign"></span></span> 
						<select id="estudante" value="<?php echo $dados[0]['estudante'];?>" name="estudante" class="form-control" data-live-search="true" data-style="btn-default" required>
							<option disabled>Escolha a opção</option>
								<?php
									$op = array("1"=>"Sim", "2"=>"Não");
			                    	foreach ($op as $key => $value):
			                    		if($key == $dados[0]['estudante']) 
			                    			echo "<option value=\"$key\" selected>$value</option>"; 
			                         	else 
			                         		echo "<option value=\"$key\" >$value</option>"; 
			                    	 endforeach; 
			                     ?>
						</select>			
					</div>
				</div>

				<div class="form-group text-center" style="margin-top: 4%;">
					<div class="col-sm-6">
						<button type="button" name="button"
							class="btn btn-warning btn-large" onclick="back();">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							Voltar
						</button>
					</div>

					<div class="col-sm-6">
						<button type="submit" class="btn btn-success">
							<span class="glyphicon glyphicon-save" aria-hidden="true"></span>
							Alterar
						</button>
					</div>
				</div>
		
			<?php echo form_close();?>
			
			</div>
			<!-- Fim do body do painel -->
		</div>
		<!-- Fim do painel -->
	</div>
	<!-- fim da div container -->
</div>
<!-- fim da div conteudo -->

<script type="text/javascript">

	$(document).ready(function(){
		$('#datanascimento').datepicker({
		    format: "dd/mm/yyyy",
		    startView: 2,
		    todayBtn: "linked",
		    clearBtn: true,
		    language: "pt-BR",
		    multidate: false
		});
	});	

	<?php echo 'function back(){document.location = "'.base_url().'index.php/cliente";}';?>
	
</script>
