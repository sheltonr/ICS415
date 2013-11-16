<?php
	//start session
	session_start();
	date_default_timezone_set('Pacific/Honolulu');
	$dateTime = date('l jS \of F Y h:i:s A');
	$date = date('l jS \of F Y');
	//try to login
	if (isset($_POST['submit'])) {
		//credentials
		$host = 'localhost';
		$user ='user';
		$pass = 'pwd';
		$db = 'myUsers';
		
		//status message
		$status = '';
		
		//generic connection no database
		$con = mysqli_connect($host, $user, $pass, $db);
		
		//santization
		$myUser = mysql_real_escape_string($_POST['user']);
		$myUser = stripslashes($myUser);
		$myUser = strip_tags($myUser);
		$myUserPass = mysql_real_escape_string($_POST['pass']); 
		$myUserPass = stripslashes($myUserPass);
		$myUserPass = strip_tags($myUserPass);
		//user name or pass not given
		if ($myUser == '' || $myUserPass == '') {
			$_SESSION['status'] = 'Requires username and password';
			header('Location: Login.php');
			die();
		}
		$sql = "SELECT name, pass, created, last_login FROM myUsers WHERE name = '".$myUser."' AND pass = '".$myUserPass."';";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
		//user found
		if (mysqli_num_rows($result) === 1) {
			$_SESSION['active'] = 1;
			$_SESSION['user'] = $myUser;
			$_SESSION['created'] = $row{'created'};
			$_SESSION['last_login'] = $row{'last_login'};
			$sql = "UPDATE myUsers SET last_login = '".$dateTime."' WHERE name = '".$myUser."' AND pass = '".$myUserPass."';";
			mysqli_query($con, $sql);
			//homepage trivia stuff
			$_SESSION['trivia_questions'] = read('Trivia/Trivia_Questions.txt');
			$_SESSION['trivia_answers'] = read('Trivia/Trivia_Answers.txt');
		} elseif (mysqli_num_rows($result) === 0) {
			$_SESSION['status'] = 'Invalid user name or password';
			header('Location: Login.php');
			die();
		}	
	}
	//logout
	if (isset($_POST['logout'])) {
		session_unset();
		session_destroy();
	}
	
	//check for session
	if (isset($_SESSION['active'])) {
		//active session
	} else {
		header('Location: Login.php');
		die();
	}
	/**************************************FUNCTIONS**********************************/
	function read($filename) {
		$fp = @fopen($filename, 'r');
		if ($fp) {
			return $array = explode("\n", fread($fp, filesize($filename)));
		}	
	}
	function random() {
		if (isset($_SESSION['trivia_answers'])) {
				$numbers = range(0, count($_SESSION['trivia_answers']) - 1);
				shuffle($numbers);
				return $numbers;
		} else {
			return null;
		}
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
	<!-- PHP/Javascript together -->
	<script>
	$(function() {
		var curr = 0;
		var answers = <?php echo json_encode($_SESSION['trivia_answers']); ?>;
		var questions = <?php echo json_encode($_SESSION['trivia_questions']); ?>;
		var random = <?php echo json_encode(random()); ?>;
		next();
		function next() {
			if (curr < answers.length) {
				$('#answer').text(answers[random[curr]]);
				$('#question').text(questions[random[curr]]);
				curr++;
			} else {
				$('#answer').hide('slow');
				$('#question').text('Trivia done!');
				$('#answer').text('Yes, it is true.');
			}
		}
		
		$('#toggle').click(function() {
			if ($('#answer').is(':visible')) {
				$('#answer').hide('fast', 'linear', next());
				$('#toggle').text('Show answer');
				$('#toggle').attr('class', 'btn btn-success btn-sm');
			} else {
				$('#answer').show();
				$('#toggle').text('Next question');
				$('#toggle').attr('class', 'btn btn-danger btn-sm');
			}
		});
	});
	</script>
	</head>
	<body>
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
		<li><a href="About.php">About</a></li>
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
			<div class ="jumbotron" id="myheader">
			<div class ="header"><h2>Home</h2></div>
			</div>
			<div class ="jumbotron">
				<div class="row">
					<div class="col-md-6">
						<h2>Daily Trivia
							<button type="button" id="toggle" class="btn btn-sm btn-success">Show answer</button>
						</h2>
						<ul>
							<li id="question"><strong>Question</strong></li>
							<p id="answer"><strong>Answer</strong></p>
						</ul>
					</div>
					<div class="col-md-4 col-md-offset-2">
						<h3> Current date: </br> </h3> 
						<h4> <?php echo $date;?> </br> </h4>
						<h3> Member since: </br> </h3> 
						<h4> <?php echo $_SESSION['created'];?> </br> </h4>
						<h3> Last session: </br> </h3>
						<h4> <?php echo $_SESSION['last_login'];?> </br> </h4>
					</div>
				</div>
			</div>
		</div>
	</body>
	
</html>