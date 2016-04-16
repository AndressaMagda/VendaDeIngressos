<div class="text-center">

	<div class="container" style="width: 900px; margin: 0 auto;">

		<div class="panel panel-primary" id="inserirSessaoPainel" style="margin-top: 5%;">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<strong>ALTERAR SESSÃO</strong>
				</h3>
			</div>

			<div class="panel-body">
	
				<?php echo form_open('admin/alterarLinhaSessao/'.$dadosSessao[0]['codsessao'], array('class'=> 'form-horizontal', 'id'=>'form', 'name'=>'form')); ?>
				
				<div class="form-group">
					<label for="formCinema" class="col-sm-3 control-label">Cinema</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
						<select  id="cinema" name="cinema" class="form-control" data-live-search="true" required autofocus>
							 <option disabled>Escolha a opção</option>
		                    <?php 
		                    	foreach ($cinemas as $key => $value):
		                    		if($key == $dadosSessao[0]['codcinema']) 
		                    			echo "<option value=\"$key\" selected>$value</option>"; 
		                         	else 
		                         		echo "<option value=\"$key\" >$value</option>"; 
		                    	 endforeach; 
		                     ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="inputDia" class="col-sm-3 control-label">Dia</label>
					<div class="input-group col-sm-7">
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						<input type="text" class="form-control text-left" id="dia" name="dia" value="<?php echo date("d/m/Y", strtotime($dadosSessao[0]['dia']));?>" maxlength="0" required>
					</div>
				</div>
					
				<div class="form-group">
					<label for="inputHorario" class="col-sm-3 control-label">Horário</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
						<input type="text" class="form-control text-left" value="<?php echo $dadosSessao[0]['horario'];?>" id="hora" name="hora" OnKeyUp="Mascara_Hora(this.value);" required>
					</div>
				</div>
		
				<div class="form-group">
					<label for="inputFilme" class="col-sm-3 control-label">Filme</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span class="glyphicon glyphicon-film"></span></span>
						<input type="text" class="form-control text-left" id="filme" name="filme" value="<?php echo $dadosSessao[0]['filme'];?>" required>
					</div>
				</div>
		
				<div class="form-group">
					<label for="inputClassificacao" class="col-sm-3 control-label">Classificação</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span class="glyphicon glyphicon-question-sign"></span></span>
						<input type="text" class="form-control text-left" id="classificacao" name="classificacao" onkeypress="return SomenteNumero(event)" value="<?php echo $dadosSessao[0]['classificacao'];?>" required>
						<span class="input-group-addon"><b>anos</b></span>
					</div>
				 </div>
				 
				 <div class="form-group">
					<label for="inputPreco" class="col-sm-3 control-label">Preço</label>
					<div class="input-group col-sm-7">
						 <span class="input-group-addon"><b>$</b></span>
						<input type="text" class="form-control text-left" id="preco" name="preco" onkeypress="return SomenteNumero(event)" value="<?php echo $dadosSessao[0]['preco'];?>" required>
						<span class="input-group-addon"><b>.00</b></span>
					</div>
				 </div>
		
				<div class="form-group text-center" style="margin-top: 4%;">
					<div class="col-sm-6">
						<button type="button" name="button" class="btn btn-warning btn-large" onClick="history.go(-1)">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar
						</button>
					</div>
					<div class="col-sm-6">
						<button type="submit" class="btn btn-primary">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>Alterar
						</button>
					</div>
				</div>
		
				<?php echo form_close();?>
	
			</div><!-- Fim do body do painel -->
			
		</div><!-- Fim do painel -->
		
	</div> <!-- fim da div container -->
	
</div>

<script type="text/javascript">

	$(document).ready(function(){
		$('#dia').datepicker({
		    format: "dd/mm/yyyy",
		    startView: 2,
		    todayBtn: "linked",
		    clearBtn: true,
		    language: "pt-BR",
		    multidate: false
		});
		
		$("#hora").mask('99:99');
	});	

	function SomenteNumero(e){
	    var tecla=(window.event)?event.keyCode:e.which;   
	    if((tecla>47 && tecla<58)) return true;
	    else{
	    	if (tecla==8 || tecla==0) return true;
		else  return false;
	    }
	}
				
	function Mascara_Hora(hora){ 
		var hora01 = ''; 
		hora01 = hora01 + hora; 
		if (hora01.length == 2){ 
			hora01 = hora01 + ':'; 
			document.forms[0].hora.value = hora01; 
		} 
		if (hora01.length == 5){ 
			Verifica_Hora(); 
		} 
	} 
	           
	function Verifica_Hora(){ 
		hrs = (document.forms[0].hora.value.substring(0,2)); 
		min = (document.forms[0].hora.value.substring(3,5)); 
		               
		estado = ""; 
		if ((hrs < 00 ) || (hrs > 23) || ( min < 00) ||( min > 59)){ 
			estado = "errada"; 
		} 
		               
		if (document.forms[0].hora.value == "") { 
			estado = "errada"; 
		} 
		 
		if (estado == "errada") { 
			alert("Hora inválida!"); 
			document.forms[0].hora.focus();
			$("#hora").val(" ");
		} 
	}

</script>
