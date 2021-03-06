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
		<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
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
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href=""><strong>Welcome <?php echo $_SESSION['user']; ?></strong></a>
		</div>
		<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
		<li><a href="Home.php">Home &nbsp;<span class="glyphicon glyphicon-home"></span></a></li>
		<li><a href="Trivia.php">Trivia &nbsp;<span class="glyphicon glyphicon-glass"></a></li>
		<li class="active"><a href="About.php">About &nbsp;<span class="glyphicon glyphicon-cloud"></a></li>
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
				<img src="images/backgrounds/bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<h1> Bootstrap </h1>
						</div>
					</div>
				</div> <!-- item 0 -->
				<div class="item">
				<img src="images/backgrounds/bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<h1> PHP </h1>
						</div>
					</div>
				</div> <!-- item 1 -->
				<div class="item">
				<img src="images/backgrounds/bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<h1> MySQL </h1>
						</div>
					</div>
				</div> <!-- item 2 -->
				<div class="item">
				<img src="images/backgrounds/bg.jpg">
					<div class="container">
						<div class="carousel-caption">
							<h1> JavaScript </h1>
						</div>
					</div>
				</div> <!-- item 3 -->
				<div class="item">
				<img src="images/backgrounds/bg.jpg">
					<div class="container">
						<div class="carousel-caption">
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
				<h2 id="title"><strong>Web Technologies</strong></h2>
				<!-- Lists -->
				<h2> <strong> Bootstrap </strong> </h2>
				<ul>
					<li> All page layouts were made with bootstrap </li>
					<li> Makes responsive web pages easily
				</ul>
				<h2> <strong> PHP </strong> </h2>
				<ul>
					<li> PHP Hypertext Preprocessor </li>
					<li> Used for server-side communication </li>
					<li> Sessions to allow guest access </li>
				</ul> 
				<h2> <strong> MySQL </strong> </h2>
				<ul>
					<li> Relational Database Management System </li>
					<li> Used with PHP to store all user data </li>
				</ul>
				<h2> <strong> JavaScript and AJAX </strong> </h2>
				<ul>
					<li> Asynchronous JavaScript and XML 
					<li> Everything cool on the page is done with JavaScript and AJAX </li>
				</ul>
			</div> <!-- jumbotron -->	
		</div><!-- container -->
	</body>
</html>