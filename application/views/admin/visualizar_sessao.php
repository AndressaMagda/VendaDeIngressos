<div class="text-center">

	<div class="container" style="width: 900px; margin: 0 auto;">

		<div class="panel panel-primary" id="visualizarSessaoPainel"
			style="margin-top: 5%;">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<strong>VISUALIZAR SESSÕES</strong>
				</h3>
			</div>

			<div class="panel-body">
		
				<?php echo form_open('admin/visualizar_sessao/', array('class'=> 'form-horizontal', 'id'=>'form', 'name'=>'form')); ?>
				
					<div class="form-group col-sm-12">
						<label for="inputSessao" class="col-sm-3 control-label">Sessões</label>
						<div class="input-group">
							<span class="input-group-addon"><span
								class="glyphicon glyphicon-time"></span></span>
							<?php
								$opcao = $sessao;
								$parametros = 'id="sessao" name="sessao" class="form-control" data-live-search="true" data-style="btn-default" required';
								echo form_dropdown ( 'sessao', $opcao, $sessao_atual, $parametros );
							?>
						</div>
					</div>
					


					<div class="form-group text-center">
						<div class="col-sm-12">
							<?php echo $tabelaSessoes; ?>
						</div>
						
						<div class="col-sm-12">
						<button type="button" name="button" style="float: left;" class="btn btn-warning btn-large" onClick="history.go(-1)">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar
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
<!-- fim da div conteudo -->

<script type="text/javascript">

	document.getElementById("sessao").onchange = function() {
     	var sessao = this.value;
     	window.location.href = "<?php echo base_url()?>index.php/admin/visualizar_sessao/" + sessao;
	}
	
</script>
