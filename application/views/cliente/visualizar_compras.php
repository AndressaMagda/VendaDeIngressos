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
								<th style="text-align: center;">Compra</th>
								<th style="text-align: center;">Quantidade de Ingressos</th>
								<th style="text-align: center;">Cinema</th>
								<th style="text-align: center;">Filme</th>
								<th style="text-align: center;">Data</th>
								<th style="text-align: center;">Horário</th>
								<th style="text-align: center;">Valor Pago</th>
								<th style="text-align: center;">Forma de Pagamento</th>
								<th style="text-align: center;">Parcelas</th>
								<th style="text-align: center;">Visualizar Compra</th>
								<th style="text-align: center;">Enviar Compra por E-Mail</th>
							</tr>
						</thead>

						<tbody>
		                    <?php
								for($i = 0; $i < count ( $dadosCompras ); $i ++) {
									echo "<tr value= ".$dadosCompras[$i]['codcompra']." >";
									
									echo "<td style='font-weight: bold;'>".($i+1)."</td>";
									echo "<td value= ".$dadosCompras[$i]['codcompra']." >".$dadosCompras[$i]['qtd_ingresso']."</td>";
									echo "<td value= ".$dadosCompras[$i]['codcompra']." >".$dadosCompras[$i]['cinema']."</td>";
									echo "<td value= ".$dadosCompras[$i]['codcompra']." >".$dadosCompras[$i]['filme']."</td>";
									echo "<td value= ".$dadosCompras[$i]['codcompra']." >".date('d/m/Y', strtotime($dadosCompras[$i]['dia']))."</td>";
									echo "<td value= ".$dadosCompras[$i]['codcompra']." >".$dadosCompras[$i]['horario']."</td>";
									echo "<td value= ".$dadosCompras[$i]['codcompra']." >".$dadosCompras[$i]['valor_pago']."</td>";
									echo "<td value= ".$dadosCompras[$i]['codcompra']." >".$dadosCompras[$i]['forma_pagamento']."</td>";
									echo "<td value= ".$dadosCompras[$i]['codcompra']." >".$dadosCompras[$i]['parcelas']."</td>";
									echo "<td value= ".$dadosCompras[$i]['codcompra']." ><a href='".base_url()."index.php/cliente/ver_ingressos/".$dadosCompras[$i]['codcompra']."'  class='btn btn-info btn-md' role='button'><span class='glyphicon glyphicon-eye-open' aria-hidden='true'></span></a></td>";
									echo "<td value= ".$dadosCompras[$i]['codcompra']." ><a href='".base_url()."index.php/cliente/verifica_envio/".$dadosCompras[$i]['codcompra']."'  class='btn btn-warning btn-md' role='button'><span class='glyphicon glyphicon-envelope' aria-hidden='true'></span></a></td>";
									echo "</tr>";
								}
							?>
						</tbody>

						<tfoot>
							<tr>
								<th style="text-align: center;">Compra</th>
								<th style="text-align: center;">Quantidade de Ingressos</th>
								<th style="text-align: center;">Cinema</th>
								<th style="text-align: center;">Filme</th>
								<th style="text-align: center;">Data</th>
								<th style="text-align: center;">Horário</th>
								<th style="text-align: center;">Valor Pago</th>
								<th style="text-align: center;">Forma de Pagamento</th>
								<th style="text-align: center;">Parcelas</th>
								<th style="text-align: center;">Visualizar Compra</th>
								<th style="text-align: center;">Enviar Compra por E-Mail</th>
							
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
