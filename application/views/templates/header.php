<?php 
	$CI = & get_instance();
	$CI->load->library(array('datas'));
	$today = $CI->datas->getFullDateExtenso();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<title><?php echo $title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>imagens/favicon.ico" />
<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('bootstrap/css/bootstrap-theme.min.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('bootstrap/css/bootstrap-select.min.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('bootstrap/css/bootstrap-responsive.min.css');?>" rel="stylesheet" />

<link type="text/css" href="<?php echo base_url('css/global.css');?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/bootstrap-datepicker.css';?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/bootstrap-multiselect.css';?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/dataTables.css';?>" />

<script type="text/javascript" src="<?php echo base_url();?>js/cidades-estados-1.2-utf8.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.11.1.js"></script>
<script type="text/javascript"src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.maskedinput-1.3.1.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dataTables.bootstrap.js"></script>

<?php if (isset($js1)) { echo $js1; }?>
<?php if (isset($js2)) { echo $js2; }?>
<?php  error_reporting(0); ?>

</head>
<body>
	<div>
		<nav class="navbar navbar-default" role="navigation" id="menu">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed"
						data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
					<div class="navbar-brand" id="menuData">
						<?php echo $today; ?>
					</div>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				
						<?php
						if ($this->session->userdata('codperfil') == '1') {
						?>
							<ul class="nav nav-pills" style="margin-top: 4px; font-weight:bold;">
								<li role="presentation"><?php echo anchor('/admin/', 'Home'); ?></li>
								<li role="presentation" class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
								      Cinema<span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu">
										<li role="presentation"><?php echo anchor('/admin/inserir_cinema', '<span>Inserir</span>',array('onclick'=>'carregandoView();'));?></li>
										<li role="presentation"><?php echo anchor('/admin/visualizar_cinema', '<span>Visualizar</span>',array('onclick'=>'carregandoView();'));?></li>
									</ul>
								</li>
								
								<li role="presentation" class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
								      Sessão <span class="caret"></span>
									</a>
									<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
										<li role="presentation"><?php echo anchor('/admin/inserir_sessao', '<span>Inserir</span>',array('onclick'=>'carregandoView();'));?></li>
										<li role="presentation"><?php echo anchor('/admin/visualizar_sessao', '<span>Visualizar</span>',array('onclick'=>'carregandoView();'));?></li>
									</ul>
								</li>
								
							<?php
						}
						else{
							?>
							<ul class="nav nav-pills" style="margin-top: 4px; font-weight:bold;">
								<li role="presentation"><?php echo anchor('/cliente/', 'Home'); ?></li>
							
								<li role="presentation"><?php echo anchor('/cliente/selecionar_cinema', 'Comprar Ingressos'); ?></li>
								
								<li role="presentation"><?php echo anchor('/cliente/visualizar_compras', 'Visualizar Compras'); ?></li>
								
								<li role="presentation"><?php echo anchor('/cliente/editar_cadastro', 'Editar Cadastro'); ?></li>
											
							<?php 
							}
							?>
							<li role="presentation"><?php echo anchor('/login/logout/', 'Sair');?></li>
							<div style="float: right;" class="navbar-brand" id="pagina-menu-nome">
								<b>Bem-vindo(a),</b>&nbsp;<?php echo mb_strtoupper($this->session->userdata('nome'),'UTF-8'); ?>
							</div>
						</ul>
			</div>
			<!-- /.navbar-collapse -->
		</nav>
	</div>
	<!-- /.container-fluid -->