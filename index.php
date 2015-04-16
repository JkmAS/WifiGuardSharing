<?php
    require_once("php/Router.php");
    $router = new Router();
    //extract($router->__getData());    
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="description" content="Web application to store the results of WifiGuard app.">
		<meta name="keywords" content="WifiGuardSharing, WifiGuard">
		<meta name="author" content="JkmAS">
		<!-- Title -->
		<title>WifiGuard Sharing - Login</title>	
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
	<body class="container">
		<div class="row">
			<header>
				<h1>WifiGuard Sharing</h1>
			</header>		
			
			<div class="console-log">
				<div class="console-log-panel">
					<div class="panel-heading">
						<h2 class="panel-title">Login</h2>
					</div>
					<div class="panel-body">
						<form class="form-horizontal">
							<div class="form-group">
								<label class="col-sm-2 control-label">Console</label>
								<div class="col-sm-10">
									<span class="info-log">Please, log in</span>
								</div>
								<label class="col-sm-2 control-label">E-mail</label>
								<div class="col-sm-10">
									<input type="email" placeholder="Email" name="email">
								</div>	
								<label class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10">
									<input type="password" placeholder="Password" name="password">
								</div>											
								<div class="collapse" id="registr">
									<label class="col-sm-2 control-label">Confirm</label>
									<div class="col-sm-10">
										<input type="password" placeholder="Confirm password" name="confirmPassword">
									</div>
								</div>
								<label class="col-sm-2 control-label">Action</label>					
								<div class="col-sm-5">
									<button class="button-log" name="login">Login</button>	
								</div>
								<div class="col-sm-5">
									<button class="button-log" data-toggle="collapse" href="#registr">Registration</button>	
								</div>
							</div>	
						</form>										
					</div>
				</div>
			</div>
			
		</div>
		
		<!-- JavaScript -->
		<script src="lib/jquery/dist/jquery.min.js"></script>
		<script src="lib/bootstrap/dist/js/bootstrap.min.js"></script>
	</body>
</html>