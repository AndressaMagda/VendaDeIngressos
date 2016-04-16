<div id="conteudo">
	
	<div class="container" style="width: 70%; margin-top: 3%;">

		<div class="panel panel-danger" id="painelSessao">
			
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<strong>ATENÇÃO</strong>
				</h3>
			</div><!-- Fim do panel-heading -->
			
			<div class="panel-body">
				
				<h2 style="text-align: center; color: #B84842;">Sessão Expirada ou Login não efetuado.</h2>
			
				<div class="col-lg-12 text-center">
					<p class="text-muted credit">Por questão de segurança o tempo de sessão é definido em 30(trinta) minutos a partir de sua última ação. Efetue o login de acesso ao sistema.</p>
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