<div class="text-center">

	<div class="container" style="width: 100%; margin: 0 auto;">

		<div class="panel panel-default" id="visualizarCinemaPainel" style="width: 90%; margin: 0 auto;">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<strong>Cinemas com Sessões Cadastradas</strong>
				</h3>
			</div>

			<div class="panel-body">
		
				<?php echo form_open('cliente/selecionar_cinema/', array('class'=> 'form-horizontal', 'id'=>'form', 'name'=>'form')); ?>
				
				<div class="table-responsive" style="width: 95%; margin: 0 auto;">
					<table class="table table-striped table-bordered dataTable" cellspacing="0" id="tabCinemas">
						<thead>
							<tr>
								<th style="text-align: center;">Índice</th>
								<th style="text-align: center;">Estado</th>
								<th style="text-align: center;">Cidade</th>
								<th style="text-align: center;">Cinema</th>
								<th style="text-align: center;">Localização</th>
								<th style="text-align: center;">Ações</th>
							</tr>
						</thead>

						<tbody>
		                    <?php
								for($i = 0; $i < count ( $dadosCinemas ); $i ++) {
									echo "<tr value= ".$dadosCinemas[$i]['codcinema']." >";
									
									echo "<td style='font-weight: bold;'>".($i+1)."</td>";
									echo "<td value= ".$dadosCinemas[$i]['codcinema']." >".$dadosCinemas[$i]['cinemaEstado']."</td>";
									echo "<td value= ".$dadosCinemas[$i]['codcinema']." >".$dadosCinemas[$i]['cinemaCidade']."</td>";
									echo "<td value= ".$dadosCinemas[$i]['codcinema']." >".$dadosCinemas[$i]['cinemaNome']."</td>";
									echo "<td value= ".$dadosCinemas[$i]['codcinema']." >".$dadosCinemas[$i]['cinemaLocalizacao']."</td>";
									echo "<td value= ".$dadosCinemas[$i]['codcinema']." ><a href='".base_url()."index.php/cliente/selecionar_filme/".$dadosCinemas[$i]['codcinema']."'  class='btn btn-success btn-sm' role='button'>Ver Filmes <span class='glyphicon glyphicon-chevron-right' aria-hidden='true'></span></a></td>";
									
									echo "</tr>";
								}
							?>
						</tbody>

						<tfoot>
							<tr>
								<th style="text-align: center;">Índice</th>
								<th style="text-align: center;">Estado</th>
								<th style="text-align: center;">Cidade</th>
								<th style="text-align: center;">Cinema</th>
								<th style="text-align: center;">Localização</th>
								<th style="text-align: center;">Ações</th>
							</tr>
						</tfoot>
					</table>
				</div>

				<div class="col-sm-12" style="margin-top: 2%;">
					<button type="button" name="button" style="float: left;"
						class="btn btn-warning btn-large" onClick="back();">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						Voltar
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
	    $('#tabCinemas').dataTable();
	} );

	<?php echo 'function back(){document.location = "'.base_url().'index.php/cliente/";}';?>
				
</script>
