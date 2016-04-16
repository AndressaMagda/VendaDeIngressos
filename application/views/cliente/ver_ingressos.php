<div class="text-center">

	<div class="container" style="width: 100%; margin: 0 auto;">

		<div class="panel panel-info" id="verIngressosPainel"
			style="width: 70%; margin: 0 auto;">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<strong>Ingressos Comprados</strong>
				</h3>
			</div>

			<div class="panel-body">
		
				<?php echo form_open('cliente/ver_ingressos/', array('class'=> 'form-horizontal', 'id'=>'form', 'name'=>'form')); ?>
				
				<div class="form-group">
					<div class="input-group" style="margin: 0 auto;">
						<?php echo $ingresso;?>
					</div>
				</div>
				

				<div class="col-sm-12">
					<button type="button" name="button" style="float: left;"
						class="btn btn-warning btn-large" onClick="history.go(-1)">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						Voltar
					</button>
				</div>

			</div>
				
				<?php echo form_close(); ?>
			
			</div>
		<!-- Fim do body do painel -->
	</div>
	<!-- Fim do painel -->
</div>
<!-- fim da div container -->
</div>