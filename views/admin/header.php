<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?=$title?></title>
		<meta name="description" content="Sapientia Canteen website.">
		<meta name="viewport" content="width=device-width, initial-scale=1">
<? if ($redirect): ?>
		<meta http-equiv="refresh" content="2; url=<?=$redirect?>">
<? endif; ?>
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
		<link rel="stylesheet" href="css/main.css">
		<!--[if lt IE 9]>
				<script src="js/vendor/html5-respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index"><i class="fa fa-cogs"></i>&nbsp; Canteen Administration</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="admin-foods"><i class="fa fa-cutlery"></i> Foods</a></li>
						<li><a href="admin-menu"><i class="fa fa-calendar"></i> Menu</a></li>
						<li><a href="admin-passes"><i class="fa fa-ticket"></i> Passes</a></li>
						<li><a href="admin-orders"><i class="fa fa-credit-card"></i> Orders</a></li>
						<li><a href="admin-reserves"><i class="fa fa-th-list"></i> Reserves</a></li>
						<li><a href="admin-users"><i class="fa fa-group"></i> Users</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="login" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$user?> <b class="caret"></b></a>
							<ul class="login-dropdown dropdown-menu">
								<li>
									<div class="container header-user-container">
										<a href="logout" class="btn btn-danger btn-block">Sign Out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
