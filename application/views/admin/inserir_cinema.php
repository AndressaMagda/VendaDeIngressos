<div class="text-center">

	<div class="container" style="width: 900px; margin: 0 auto;">

		<div class="panel panel-primary" id="inserirCinemaPainel" style="margin-top: 5%;">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					<strong>CADASTRAR CINEMA</strong>
				</h3>
			</div>

			<div class="panel-body">
	
				<?php echo form_open('admin/inserir_cinema/', array('class'=> 'form-horizontal', 'id'=>'form', 'name'=>'form')); ?>
		
				<div class="form-group">
					<label for="inputNome" class="col-sm-3 control-label">Nome</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span class="glyphicon glyphicon-facetime-video"></span></span>
						<input type="text" class="form-control text-left" id="nome" name="nome" value="<?php echo set_value('nome');?>" autofocus required>
					</div>
				</div>
		
				<div class="form-group">
					<label for="inputEstado" class="col-sm-3 control-label">Estado</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
						<select id="estado" name="estado" class="form-control" data-live-search="true" required>
						</select>
					</div>
				</div>
		
				<div class="form-group">
					<label for="inputCidade" class="col-sm-3 control-label">Cidade</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span class="glyphicon glyphicon-globe"></span></span>
						<select id="cidade" name="cidade" class="form-control"
							data-live-search="true" required>
						</select>
					</div>
				</div>
		
				<div class="form-group">
					<label for="inputLocalização" class="col-sm-3 control-label">Localização</label>
					<div class="input-group col-sm-7">
						<span class="input-group-addon"><span class="glyphicon glyphicon-question-sign"></span></span>
						<input type="text" class="form-control text-left" id="localizacao"
							name="localizacao" value="<?php echo set_value('localizacao');?>"
							required>
					</div>
				 </div>
		
				<div class="form-group text-center">
					<div class="col-sm-6">
						<button type="button" name="button" class="btn btn-warning btn-large" onClick="history.go(-1)">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Voltar
						</button>
					</div>
					<div class="col-sm-6">
						<button type="submit" class="btn btn-primary">
							<span class="glyphicon glyphicon-save" aria-hidden="true"></span>Cadastrar
						</button>
					</div>
				</div>
		
				<?php echo form_close();?>
	
			</div><!-- Fim do body do painel -->
			
		</div><!-- Fim do painel -->
		
	</div> <!-- fim da div container -->
	
</div>

<script type="text/javascript">
						
// 	window.onload = function() {
// 	  new dgCidadesEstados({
// 	    estado: document.getElementById('estado'),
// 	    cidade: document.getElementById('cidade')
// 	  });
// 	}
	$(function() {
	  new dgCidadesEstados({
	    estado: $('#estado').get(0),
	    cidade: $('#cidade').get(0)
	  });
	});

</script>
