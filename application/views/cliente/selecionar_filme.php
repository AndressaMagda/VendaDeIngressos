<div class="text-center">

	<div class="container" style="width: 100%; margin: 0 auto;">

		<div class="panel panel-default" id="visualizarCinemaPainel" style="width: 90%; margin: 0 auto;">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<strong>Filmes com Horários</strong>
				</h3>
			</div>

			<div class="panel-body"> 
		
				<?php echo form_open('cliente/selecionar_cinema/', array('class'=> 'form-horizontal', 'id'=>'form', 'name'=>'form')); ?>
				<div class="table-responsive" style="width: 95%; margin: 0 auto;">
					<table id="tabFilmes" class="table table-striped table-bordered dataTable" cellspacing="0">
						<thead>
							<tr>
								<th style="text-align: center;">Índice</th>
								<th style="text-align: center;">Filme</th>
								<th style="text-align: center;">Dia</th>
								<th style="text-align: center;">Horário</th>
								<th style="text-align: center;">Classificação</th>
								<th style="text-align: center;">Preço</th>
								<th style="text-align: center;">Ações</th>
							</tr>
						</thead>

						<tbody>
		                    <?php
			                    $data_nascimento = date('d-m-Y', strtotime($this->session->userdata('data_nascimento')));
			                    
			                    $data_atual = date("d-m-Y");

			                    $data_nascimento_tempo = new DateTime($data_nascimento);
			                    $idade = $data_nascimento_tempo->diff(new DateTime($data_atual));
			                    $idade = $idade->format('%Y');
		                    	
		                    
								for($i = 0; $i < count ( $dadosCinemas ); $i ++) {
									echo "<tr value= ".$dadosCinemas[$i]['codsessao']." >"; 
									
									echo "<td style='font-weight: bold;'>".($i+1)."</td>";
									echo "<td value= ".$dadosCinemas[$i]['codsessao']." >".$dadosCinemas[$i]['filme']."</td>";
									echo "<td value= ".$dadosCinemas[$i]['codsessao']." >".date('d/m/Y', strtotime($dadosCinemas[$i]['dia']))."</td>";
									echo "<td value= ".$dadosCinemas[$i]['codsessao']." >".$dadosCinemas[$i]['horario']."</td>";
									echo "<td value= ".$dadosCinemas[$i]['codsessao']." >".$dadosCinemas[$i]['classificacao']." anos"."</td>";
									echo "<td value= ".$dadosCinemas[$i]['codsessao']." >"."$".$dadosCinemas[$i]['preco'].".00"."</td>";
									
									if($dadosCinemas[$i]['classificacao']>$idade)
										echo "<td value= ".$dadosCinemas[$i]['codsessao']." ><a href='#' class='btn btn-default btn-sm' role='button' disabled><b>Você deve ter no minimo ".$dadosCinemas[$i]['classificacao']." anos para ver esse filme<b></a></td>";
									else{ 
										//echo "<td value= ".$dadosCinemas[$i]['codsessao']." ><a href='".base_url()."index.php/cliente/comprar_ingresso/".$dadosCinemas[$i]['codsessao']."'  class='btn btn-success btn-sm' role='button'><b>Comprar</b></a></td>";
										$botao = "";
										if ($dadosCinemas[$i]['esgotado'] == true) $botao = "<a class='btn btn-danger btn-sm' href='#' role='button' disabled>Ingressos Esgotados</a>";
										else $botao = "<a class='btn btn-success btn-sm' href='".base_url()."index.php/cliente/comprar_ingresso/".$dadosCinemas[$i]['codsessao']."' role='button'>Comprar</a>";
											
										echo  "<td value= ".$dadosCinemas[$i]['codsessao']." >$botao</td>";
									}
									echo "</tr>";
								}
							?>
						</tbody>

						<tfoot>
							<tr>
								<th style="text-align: center;">Índice</th>
								<th style="text-align: center;">Filme</th>
								<th style="text-align: center;">Dia</th>
								<th style="text-align: center;">Horário</th>
								<th style="text-align: center;">Classificação</th>
								<th style="text-align: center;">Preço</th>
								<th style="text-align: center;">Ações</th>
							</tr>
						</tfoot>
					</table>
				</div>

				<div class="form-group text-center" style="margin-top: 2%;">
					<div class="col-sm-4">
						<button type="button" name="button"
							class="btn btn-warning btn-large" onClick="history.go(-1)">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							Voltar
						</button>
												<button type="button" name="button"
							class="btn btn-danger btn-large" onClick="cancel();">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							Cancelar
						</button>
				</div>
				
			</div>
				
				<?php echo form_close(); ?>
			
			</div><!-- Fim do body do painel -->
	</div><!-- Fim do painel -->
</div><!-- fim da div container -->
</div>

<script type="text/javascript">

	$(document).ready(function() {
	    $('#tabFilmes').dataTable();
	} );

	<?php echo 'function cancel(){document.location = "'.base_url().'index.php/cliente";}';?>
				
</script>
