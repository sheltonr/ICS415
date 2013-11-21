<?php
	//start session
	session_start();
	
	//check for session
	if (!isset($_SESSION['user'])) {
		header('Location: Login.php');
		die();
	}
	/**************************************FUNCTIONS**********************************/
	function background() {
		echo '<style type="text/css">';
		if($_SESSION['background'] != 'None') {
			echo '
			html, body {
				background-image:url(images/backgrounds/' . $_SESSION['background'] . '.jpg);
				background-repeat:repeat;
			}';
		}
		if($_SESSION['header'] != 'None') {
			echo '
			#myheader {
				background-image:url(images/headers/' . $_SESSION['header'] . '.jpg);
				font-color: #fff;
			}';
		}
		echo '</style>';
	}
?>

<!-- HTML -->
<!DOCTYPE html>
<html>
	<head>
		<title>About</title>
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
		<?php background(); ?>
	</head>
	<body>
		<!-- Navigation -->
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
		<li><a href="Home.php">Home</a></li>
		<li><a href="Trivia.php">Trivia</a></li>
		<li class="active"><a href="">About</a></li>
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
			<h2>About</h2>
			</div>
			<div class="jumbotron">
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
							<h1> Bootstrap </h1>
							<p>Make responsive pages with Bootstrap!</p>
						</div>
					</div>
				</div> <!-- item 0 -->
				<div class="item">
				<img src="images/body-bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<h1> PHP </h1>
							<h3> PHP Hypertext Preprocessor </h3>
						</div>
					</div>
				</div> <!-- item 1 -->
				<div class="item">
				<img src="images/body-bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<h1> MySQL </h1>
							<h3> Relational Database Management System </h3>
						</div>
					</div>
				</div> <!-- item 2 -->
				<div class="item">
				<img src="images/body-bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<h1> Javascript </h1>
							<h3> Scripting language </h3>
						</div>
					</div>
				</div> <!-- item 3 -->
				<div class="item">
				<img src="images/body-bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<h1> AJAX </h1>
							<h3> Asynchronous Javascript and XML </h3>
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