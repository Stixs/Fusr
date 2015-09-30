<?php
session_start();
require('./controllers/functies.php');
require('./connection.php');
$pdo = ConnectDB();

if(isset($_GET['paginanr']))
{
	$paginanr = $_GET['paginanr'];
}
else
{
	$paginanr = 1;
}

?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Transportplaza</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/Transportplaza.css" rel="stylesheet">
	<script src="./ckeditor/ckeditor.js"></script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
	<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	<?php include_once("analyticstracking.php"); ?>
	<div class="container">
		<div class="box-shadow">
			<div class="row">
				<div class="col-xs-12">
					<div class="LoginLink">
						<?php
							if(LoginCheck($pdo))
							{
						?>
						<li><a href="uitloggen.php">Logout</a></li>	
						<?php
							}
							else
							{
						?>
						<li><a href="inloggen.php">Login</a></li>	
						<?php
							}
						?>
					</div>
					<div id="TPE_Logo" class="col-xs-12 col-sm-3">
						<div class="row">
							<a href="index.php"><span class="sr-only">Back to home</span></a>
						</div>
					</div>
					<nav class="navbar navbar-default col-sm-5 Hoofdmenu">
						<div class="row">
							<!-- toggle get grouped for better mobile display -->
							<div class="navbar-header">
							  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							  </button>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							  <ul class="nav navbar-nav col-sm-12">
								<li class="active"><a href="index.php">Home</a></li>
								<li><a href="gids.php">Bedrijven gids</a></li>
								<li><a href="#">Contact</a></li>
							  </ul>
							</div><!-- /.navbar-collapse -->
						</div>

					</nav>
					<div class="col-xs-12 col-sm-4 Hoofdmenu">
						<form id="TitleOpnaam" method="post" action="index.php?paginanr=3">
							<div>
								<input class="col-xs-10 col-sm-8" type="text" name="trefwoord" placeholder="zoek hier op bedrijfsnaam of specialisme">
								<input type="hidden" name="type"  value="">
								<input type="hidden" name="bereik"  value="">
								<input type="hidden" name="specialiteit"  value="">
								<input class="col-xs-2 col-sm-4" type="submit" name="Zoek" value="zoeken"/>
							</div>
							<?php 
								//include 'controllers/ZoekVeld.php';
							?>
						</form>
					</div>
				</div>
			</div>
			<?php
			
			if(LoginCheck($pdo))
			{
			?>
			<div class="row">
				<div class="col-xs-12">
					<nav class="navbar navbar-default col-sm-12 BeheerNav">
						<div class="row">
							<!-- toggle get grouped for better mobile display -->
							<div class="navbar-header">
							  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							  </button>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse BeheerNav" id="bs-example-navbar-collapse-2">
								<ul class="nav navbar-nav col-sm-12">
									<li><a href="toevoegenbedrijf.php">Bedrijf toevoegen</a></li>
									<li><a href="wijzigen.php">Bedrijf wijzigen</a></li>

									<li class="pull-right"><a href="advertenties.php">Beheer Advertenties</a></li>
									<li class="pull-right"><a href="beheer.php">Beheer</a></li>
							</ul>
							</div><!-- /.navbar-collapse -->
						</div>
					</nav>
				</div>
			</div>
<?php
}

		