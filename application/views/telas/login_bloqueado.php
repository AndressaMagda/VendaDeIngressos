<div id="conteudo">

s	<div class="container" style="width: 70%; margin-top: 3%;">

		<div class="panel panel-warning" id="painelSessao">
			
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<strong>ATENÇÃO</strong>
				</h3>
			</div><!-- Fim do panel-heading -->
			
			<div class="panel-body">
				
				<h2 style="text-align: center; color: #8A6D3B;">E-Mail não cadastrado.</h2>
			
				<div class="col-lg-12 text-center" style="padding-top: 7px;">
					<p style="font-size: 12pt; line-height: 200%;">O usuário não está cadastrado no Sistema de Venda de Ingressos. <br> Para ter acesso ao sistema se inscreva na tela anterior.</p>
				</div>
				
				<div class="col-lg-12" style="text-align: center; margin-top: 2%;">
					<button type="button" class="btn btn-warning" onclick="login();"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar</button>
				</div>
			
			</div><!-- Fim do panel-body -->
		
		</div><!-- Fim do painel -->
	
	</div> <!-- fim da div container -->

</div><!-- fim da div conteudo -->


<script type="text/javascript">

	<?php echo 'function login(){document.location = "'.base_url().'index.php/";}';?>

</script>