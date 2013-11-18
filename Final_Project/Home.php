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
		if($_SESSION['background'] != 'none') {
			echo'
			<style type="text/css">
				html, body {
					background-image:url(images/' . $_SESSION['background'] . '.jpg);
					background-repeat:repeat;
				}
			</style>';
		}
	}
?>

<!-- HTML -->
<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
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
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href=""><strong>Welcome <?php echo $_SESSION['user']; ?></strong></a>
		</div>
		<div class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
		<li class="active"><a href="">Home</a></li>
		<li><a href="Trivia.php">Trivia</a></li>
		<li><a href="About.php">About</a></li>
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
			<div class ="jumbotron" id="myheader">
			<div class ="header"><h2>Home</h2></div>
			</div>
			<div class ="jumbotron">
				<div class="row">
					<div class="col-md-6">
						<p id="avatar">
						<a href="#" class="img-responsive">
						<img src="images/black.jpg" alt="..." class="img-responsive" width="171" height="180" />
						</a>
						Me
						</p>
						
						<h2>My Background:</h2>
							<button type="button" name="background" class="btn btn-default" onclick="background('None')">
								<img src="images/default.jpg" alt="..." class="img-responsive" width="71" height="80" />
								None
							</button>
							<button type="button" name="background" class="btn btn-default" onclick="background('Black')">
								<img src="images/black.jpg" alt="..." class="img-responsive" width="71" height="80" />
								Black
							</button>
							<button type="button" name="background" class="btn btn-default" onclick="background('Textured')">
								<img src="images/textured.jpg" alt="..." class="img-responsive" width="71" height="80" />
								Textured
							</button>
							<button type="button" name="background" class="btn btn-default" onclick="background('Yellow')">
								<img src="images/yellow.jpg" alt="..." class="img-responsive" width="71" height="80" />
								Yellow
							</button>
						<form action="Index.php" method="post">
						<button type="submit" class="btn btn-primary" onclick="selected()">Save changes</button>
						<input type="hidden" id="background" name="background" value="None" </input>
						</form>
					</div>
					<div class="col-md-4 col-md-offset-2">
						<h3> Current date: </br> </h3> 
						<h4> <?php echo $_SESSION['date'];?> </br> </h4>
						<h3> Member since: </br> </h3> 
						<h4> <?php echo $_SESSION['created'];?> </br> </h4>
						<h3> Last session: </br> </h3>
						<h4> <?php echo $_SESSION['last_login'];?> </br> </h4>
						<h3> Current background: </br> </h3>
						<h4> <?php echo $_SESSION['background'];?> </br> </h4>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>