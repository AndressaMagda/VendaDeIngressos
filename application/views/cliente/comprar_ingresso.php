<div class="text-center">

	<div class="container" style="width: 100%; margin: 0 auto;">

		<div class="panel panel-success" id="inserirCinemaPainel"
			style="width: 70%; margin: 0 auto;">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<strong>Comprar Ingressos</strong>
				</h3>
			</div>

			<div class="panel-body">
	
				<?php echo form_open('cliente/comprar_ingresso/'.$dadosFilme[0]['codsessao'], array('class'=> 'form-horizontal', 'id'=>'form', 'name'=>'form')); ?>
				<div class="panel panel-default">
					<div class="panel-body" style="font-size: 80%; text-align: center;">
						<p class="text-muted">
							<label style="font-weigth: bold; font-size: large;">Cinema:&nbsp;</label><?php echo $dadosFilme[0]['cinemaNome']; ?></p>
						<p class="text-muted">
							<label style="font-weigth: bold; font-size: large;">Filme:&nbsp;</label><?php echo $dadosFilme[0]['filme']; ?></p>
						<p class="text-muted">
							<label style="font-weigth: bold; font-size: large;">Horário:&nbsp;</label><?php echo $dadosFilme[0]['horario']; ?></p>
						<p class="text-muted">
							<label style="font-weigth: bold; font-size: large;">Data:&nbsp;</label><?php echo date('d/m/Y', strtotime($dadosFilme[0]['dia'])); ?></p>
					</div>
				</div>


				<div class="form-group">
					<label for="inputNome" class="col-sm-3 control-label">Quantidade de
						Ingressos</label>
					<div class="input-group col-sm-4">
						<span class="input-group-addon"><span
							class="glyphicon glyphicon-question-sign"></span></span> <select
							id="qtd_ingresso" name="qtd_ingresso" class="form-control"
							data-live-search="true" onChange="calcula_valor(); esconder();" required>
							<option value="">Selecione uma opção</option>
							<?php
							        $qtd_assentos_disponiveis = 3 - $dadosFilme[0]['ingressos_vendidos']; //Quando chegar a 40 a sessão lota
							        if ($qtd_assentos_disponiveis < 4) $limite = $qtd_assentos_disponiveis;
							        else $limite = 4;
							        for ($i = 1; $i <= $limite; $i++) {
							         echo '<option value='.$i.'>'.$i.'</option>';
						        } 
						       ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="valor" class="col-sm-3 control-label">Valor a ser pago</label>
					<div class="input-group col-sm-3">
						<p id="valor" class="form-control-static">$</p>
					</div>
				</div>

				<div class="form-group">
					<label for="inputNome" class="col-sm-3 control-label">Deseja
						escolher o assento?</label>
					<div class="input-group col-sm-4">
						<span class="input-group-addon"><span
							class="glyphicon glyphicon-question-sign"></span></span> <select
							id="assento" name="assento" class="form-control"
							data-live-search="true" onChange="esconderAssento();" required>
							<option value="">Selecione uma opção</option>
							<option value="1">Sim</option>
							<option value="2">Não</option>
						</select>
					</div>
				</div>

				<div class="form-group" id="assento_disponivel_container">
					<label for="inputNome" class="col-sm-3 control-label">Assentos
						Disponiveis</label>
					<div class="input-group">
						<select id="assento_disponivel" name="assento_disponivel[]"
							class="form-control" data-live-search="true" multiple="multiple">
							<?php 
								for($i = 1; $i <= 3; $i ++) {
								$assento_disponível = TRUE;
								for($j = 0; $j < count ( $assentos_comprados ); $j++) {
									if ($assentos_comprados[$j] == $i) {
										$assento_disponível = FALSE;
										break;
									}
								}
								if ($assento_disponível) {
									echo '<option value=' . $i . '>' . $i . '</option>';
								}
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="inputNome" class="col-sm-3 control-label">Forma de
						pagamento</label>
					<div class="input-group col-sm-4">
						<span class="input-group-addon"><span
							class="glyphicon glyphicon-question-sign"></span></span> <select
							id="pagamento" name="pagamento" class="form-control"
							data-live-search="true" onChange="esconderParcela();" required>
							<option value="">Selecione uma opção</option>
							<option value="Crédito">Crédito</option>
							<option value="Débito">Débito</option>
						</select>
					</div>
				</div>

				<input type="number" value=<?php echo $dadosFilme[0]['preco'];?>
					hidden id="valor_escondido" disabled></input>

				<div class="form-group" id="parcelamento_container">
					<label for="inputNome" class="col-sm-3 control-label">Parcelas</label>
					<div class="input-group col-sm-4">
						<span class="input-group-addon">Quantidade</span>
						<select id="parcelamento" name="parcelamento" class="form-control"
							data-live-search="true">
							<option value="" disabled="disabled">Selecione uma opção</option>
							<option value="1">1</option>
							<option value="2">2</option>
						</select>
					</div>
				</div>

				<div class="form-group text-center" style="margin-top: 2%;">
					<div class="col-sm-6">
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

					<div class="col-sm-6">
						<button type="submit" id="btnFim" class="btn btn-success">
							<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
							Finalizar Compra
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

<script type="text/javascript">

	var valor_ingresso = 0;
						
	$(document).ready(function() {
		valor_ingresso = document.getElementById('valor_escondido').value;
		calcula_valor();
		
		$('#assento_disponivel').multiselect({maxHeight: 180,
	        onChange: function(option, checked) {
	            // Get selected options.
	            var selectedOptions = $('#assento_disponivel option:selected');
				var qtd_ingressos = document.getElementById("qtd_ingresso").value;
	            if (selectedOptions.length >= qtd_ingressos) {
	                // Disable all other checkboxes.
	                var nonSelectedOptions = $('#assento_disponivel option').filter(function() {
	                    return !$(this).is(':selected');
	                });

	                var dropdown = $('#assento_disponivel').siblings('.multiselect-container');
	                nonSelectedOptions.each(function() {
	                    var input = $('input[value="' + $(this).val() + '"]');
	                    input.prop('disabled', true);
	                    input.parent('li').addClass('disabled');
	                });
		            alert("Pode proseguir com a sua compra.");
	                document.getElementById('btnFim').disabled=false;
	            }
	            else {
	                // Enable all checkboxes.
	                var dropdown = $('#assento_disponivel').siblings('.multiselect-container');
	                $('#assento_disponivel option').each(function() {
	                    var input = $('input[value="' + $(this).val() + '"]');
	                    input.prop('disabled', false);
	                    input.parent('li').addClass('disabled');
	                });
	                
	            }
	        }
	    });
		esconderAssento();
		esconderParcela();
		esconder();
		
	} );
	
	<?php echo 'function cancel(){document.location = "'.base_url().'index.php/cliente";}';?>
	
	function esconder(){
		$('#parcelamento_container').hide();
	}

	function esconderAssento(){
		var escolha_assento = document.getElementById("assento").value;
		
		if(escolha_assento == 1){
			$('#assento_disponivel_container').show();

		  	$('#assento').on('change', function() {
		        $('option', $('#assento_disponivel')).each(function(element) {
		            $(this).removeAttr('selected').prop('selected', false);
		        });
		        $('#assento_disponivel').multiselect('refresh');
		    });
		  	document.getElementById('btnFim').disabled=true;
		}
		else{
			$('#assento_disponivel_container').hide();
			document.getElementById('btnFim').disabled=false;
		}
		
	}

	function esconderParcela(){
		var pagamento = document.getElementById("pagamento").value;
		var quantidade_ingressos = document.getElementById('qtd_ingresso').value;
		var valor = Number(valor_ingresso * quantidade_ingressos);

		if(pagamento == "Crédito" && valor>50){
			$('#parcelamento_container').show();
		}
		else{
			$('#parcelamento_container').hide();
		}
	}


  	$('#qtd_ingresso').on('change', function() {
        $('option', $('#assento_disponivel')).each(function(element) {
            $(this).removeAttr('selected').prop('selected', false);
        });
        $('#assento_disponivel').multiselect('refresh');
    });

  	function calcula_valor() {
  	  var quantidade_ingressos = document.getElementById('qtd_ingresso').value;
  	  var valor = Number(valor_ingresso * quantidade_ingressos);
  	  var valor_string = "R$ " + valor + ",00";
  	  if (valor_string.search(".5") != -1) {
  	   valor_string = valor_string.replace(".5,00",",50");
  	  }
  	  document.getElementById('valor').firstChild.nodeValue = valor_string;
   }


</script>