<div id="conteudo" class="text-center">

	<div class="container" style="width: 900px; float: inherit; margin: 0 auto; margin-top: 2%;">

		<div class="panel panel-primary ">
			<div class="panel-heading">
				<h2 class="panel-title">
					<strong>RECUPERAR SENHA</strong>
				</h2>
			</div>
			
			<div class="panel-body">

			<?php echo form_open('recuperar_senha/index', array('class'=> 'form-horizontal text-center')); ?>
		
				<div class="form-group">
					<label for="inputEmail" class="col-sm-3 control-label">E-Mail</label>
					<div class="col-sm-6 input-group">
						<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span> 
						<input type="email" class="form-control text-left" id="email" name="email" value="<?php echo set_value('email');?>" required>
					</div>
					<?php echo form_error('email');?>
				</div>
				
				<div class="form-group text-center" style="margin-top: 4%;">
					<div class="col-sm-6">
						<button type="button" name="button"
							class="btn btn-warning btn-large" onClick="history.go(-1)">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							Voltar
						</button>
					</div>

					<div class="col-sm-6">
						<button type="submit" class="btn btn-primary">
							Recuperar
						</button>
					</div>
				</div>

			</div>

			<?php echo form_close(); ?>	
			
			</div>

		</div>

	</div>

</div>