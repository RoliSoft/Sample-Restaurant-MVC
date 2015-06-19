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
<? if ($signedIn && $this->app->path == 'week'): ?>
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
<? endif; ?>
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
					<a class="navbar-brand" href="index"><i class="fa fa-cutlery"></i>&nbsp; Sapientia Canteen</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
<? if ($signedIn && $isAdmin): ?>
						<li><a href="admin"><i class="fa fa-cogs"></i> Administration</a></li>
<? endif; ?>
						<li><a href="today"><i class="fa fa-calendar-o"></i> Today</a></li>
						<li><a href="week"><i class="fa fa-calendar"></i> Week</a></li>
						<li><a href="passes"><i class="fa fa-ticket"></i> Passes</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
<? if ($signedIn): ?>
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
<? else: ?>
						<li><a href="register"><i class="fa fa-pencil-square-o"></i> Sign Up</a></li>
						<li class="dropdown">
							<a href="login" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sign-in"></i> Sign In <b class="caret"></b></a>
							<ul class="login-dropdown dropdown-menu">
								<li>
									<div class="row">
										<div class="col-md-12">
											<form class="form" method="post" action="login">
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
													<input type="text" class="form-control" name="user" placeholder="Email" required />
												</div>
												<div class="input-group">
													<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
													<input type="password" class="form-control" name="pass" placeholder="Password" required />
												</div>
												<div class="right">
													<label>
														<a href="reset"><i class="glyphicon glyphicon-envelope"></i>Reset pass.</a>
													</label>
												</div>
												<div class="checkbox remember-checkbox">
													<label>
														<input type="checkbox" name="remember" checked="checked" /> Remember me
													</label>
												</div>
												<div class="form-group">
													<input type="hidden" name="token" value="<?=$_SESSION['lgn_csrf']?>" />
													<button type="submit" class="btn btn-success btn-block">Sign In</button>
												</div>
											</form>
										</div>
									</div>
								</li>
							</ul>
						</li>
<? endif; ?>
					</ul>
				</div>
			</div>
		</nav>
