<?php
    require_once("php/Router.php");
    $router = new Router();
    extract($router->__getData());    
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="author" content="JkmAS">
		<!-- Title -->
		<title>WifiGuard Sharing - App</title>	
		<!-- CSS style -->
		<link href="css/styles.css" rel="stylesheet">
		<!-- HTML5 IE8 support -->		
		<!--[if lt IE 9]>
			<script src="lib/dist/html5shiv.min.js"></script>
			<script src="lib/dest/respond.min.js"></script>
		<![endif]-->
		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">
		<!-- Font -->
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
	</head>
	<body class="container body-navbar-fixed">
		<nav class="navigation">
			<div>
				<div>
					<div class="navbar-header">
						<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Menu</a>
					</div>

					<div class="collapse navbar-collapse" id="navigation">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#">Show records</a></li>
							<li><a href="#">Upload</a></li>
							<li><a href="#">Log out</a></li>
						</ul>
					</div>
				</div>
			</div>
		</nav>
				
		<div class="row">					
			<header>
				<h1>WifiGuard Sharing</h1>
			</header>		
			
			<div class="dropdown-panel">
				<div class="dropdown">
					<button class="btn-dropdown dropdown-toggle" data-toggle="dropdown">
						Dropdown <span class="badge">4</span>
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li><a href="#">Separated link</a></li>
					</ul>
				</div>		
			</div>
			
			<div class="tbl-panel">
				<table>
					<tr>
						<th>Firstname</th>
						<th>Lastname</th> 
						<th>Points</th>
					</tr>
					<tr>
						<td>Eve</td>
						<td>Jackson</td> 
						<td>94</td>
					</tr>
				</table>	
			</div>			
			
		</div>
		
		<!-- JavaScript -->
		<script src="lib/jquery/dist/jquery.min.js"></script>
		<script src="lib/bootstrap/dist/js/bootstrap.min.js"></script>
	</body>
</html>
