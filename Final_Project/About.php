<?php
	//start session
	session_start();
	
	//logout
	if (isset($_POST['logout'])) {
		session_unset();
		session_destroy();
	}
	
	//check for session
	if (isset($_SESSION['active'])) {
		//session active
	} else {
		header('Location: Login.php');
		die();
	}
?>

<!-- HTML -->
<!DOCTYPE html>
<html>
	<head>
		<title>Final Project</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
		<!-- Css -->
		<link href="css/custom.css" rel="stylesheet" media="screen">
		<!-- Ajax -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<!-- JavaScript -->
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/myscript.js"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../../assets/js/html5shiv.js"></script>
		<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="navbar-wrapper">
		<div class="container">
		<div class="navbar navbar-default" role="navigation">
		<div class="container">
		<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href=""><strong>Welcome <?php echo $_SESSION['user']; ?></strong></a>
		</div>
		<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
		<li><a href="Index.php">Home</a></li>
		<li class="active"><a href="">About</a></li>
		<li><a href="">Unknown</a></li>
		</ul>
		<form class="navbar-form navbar-right" action="Index.php" method="post">
		<button type="submit" name="logout" class="btn btn-primary">Logout</button>
		</form>
		</div> <!-- collapse -->
		</div> <!-- container -->
		</div>
		</div> <!-- container -->
		</div> <!-- wrapper -->
		
		<!-- Content -->
		<div class="container">
			<div class="jumbotron" id="myheader">
			<div class="header"><h2>About</h2></div>
			</div>
			<div class="jumbotron">
				<div class="header" id="title"><h2>Web Technologies</h2></div>
				<div id="Carousel" class="carousel slide">
				<ol class="carousel-indicators">
				<li data-target="Carousel" data-slide-to="0" class="active"></li>
				<li data-target="Carousel" data-slide-to="1"></li>
				<li data-target="Carousel" data-slide-to="2"></li>
				<li data-target="Carousel" data-slide-to="3"></li>
				<li data-target="Carousel" data-slide-to="4"></li>
				</ol>
				<div class="carousel-inner">
				<div class="item active">
				<img src="images/body-bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<button type="button" class="btn btn-md btn-primary"><h1>Make</h1></button>
							<button type="button" class="btn btn-md btn-success"><h1>responsive</h1></button>
							<button type="button" class="btn btn-md btn-info"><h1>webpages</h1></button>
							<button type="button" class="btn btn-md btn-warning"><h1>with</h1></button>
							<button type="button" class="btn btn-md btn-danger"><h1>Bootstrap!</h1></button>
							<h1> Bootstrap </h1>
							
						</div>
					</div>
				</div> <!-- item 0 -->
				<div class="item">
				<img src="images/body-bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<img src="images/php.jpg" class="img-rounded img-responsive">
							<h1> PHP </h1>
						</div>
					</div>
				</div> <!-- item 1 -->
				<div class="item">
				<img src="images/body-bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<img src="images/mysql.jpg" class="img-thumbnail img-responsive">
							<h1> MySQL </h1>
						</div>
					</div>
				</div> <!-- item 2 -->
				<div class="item">
				<img src="images/body-bg.jpg">
					<div class="container">
						<div class="carousel-caption">
						<img src="images/javascript.jpg" class="img-thumbnail img-responsive">
							<h1> Javascript </h1>
						</div>
					</div>
				</div> <!-- item 3 -->
				<div class="item">
				<img src="images/body-bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<img src="images/jquery.jpg" class="img-thumbnail img-responsive">
							<h1> AJAX </h1>
						</div>
					</div>
				</div> <!-- item 4 -->
				</div>
				<a class="left carousel-control" href="#Carousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#Carousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
				</div>
			</div>
		</div>
	</body>
</html>