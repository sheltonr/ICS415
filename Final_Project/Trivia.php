<?php
	//start session
	session_start();
	
	//check for session
	if (!isset($_SESSION['user'])) {
		header('Location: Login.php');
		die();
	}
	
	/**************************************FUNCTIONS**********************************/
	function random() {
		if (isset($_SESSION['trivia_answers'])) {
				$numbers = range(0, count($_SESSION['trivia_answers']) - 1);
				shuffle($numbers);
				return $numbers;
		} else {
			return null;
		}
	}
	
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
		<title>Trivia</title>
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
	<!-- PHP/Javascript together -->
	<script>
	$(function() {
		var answers = <?php echo json_encode($_SESSION['trivia_answers']); ?>;
		var questions = <?php echo json_encode($_SESSION['trivia_questions']); ?>;
		var random = <?php echo json_encode(random()); ?>;
		set(answers, questions, random);
		next();	
	});
	</script>
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
		<li><a href="Home.php">Home</a></li>
		<li class="active"><a href="Trivia.php">Trivia</a></li>
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
			<div class ="header"><h2>Trivia</h2></div>
			</div>
			<div class ="jumbotron">
				<div class="row">
					<div class="col-md-8">
						<h2>Daily Trivia
							<button type="button" id="toggle" class="btn btn-sm btn-success">Show answer</button>
						</h2>
							<p class="alert alert-info" id="question"><strong>Question</strong></p>
							<p class="alert alert-success" id="answer"><strong>Answer</strong></p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>