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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>imagens/favicon.ico" />
		<link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">  
		<link href="<?php echo base_url('bootstrap/css/bootstrap-theme.min.css');?>" rel="stylesheet">  
		<link href="<?php echo base_url('bootstrap/css/bootstrap-select.min.css');?>" rel="stylesheet">  
		<link href="<?php echo base_url('bootstrap/css/bootstrap-responsive.min.css');?>" rel="stylesheet">
		
		<link href="<?php echo base_url('css/global.css');?>" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/bootstrap-datepicker.css';?>" />
		
		<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript"src="<?php echo base_url();?>js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-datepicker.js"></script>
		

	</head>
	<body>
		<div id="tudo">
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
				</div>
				<!-- /.container-fluid -->
			</nav>