<?php
	//start session
	session_start();
	
	//credentials
	$host = 'localhost';
	$user ='user';
	$pass = 'pwd';
	$db = 'myUsers';
	
	//status message
	$status = '';
	
	//generic connection no database
	$con = mysqli_connect($host, $user, $pass, $db);
	//try to login
	if (isset($_POST['submit'])) {
		$myUser = mysql_real_escape_string($_POST['user']);
		$myUser = stripslashes($myUser);
		$myUser = strip_tags($myUser);
		$myUserPass = mysql_real_escape_string($_POST['pass']); 
		$myUserPass = stripslashes($myUserPass);
		$myUserPass = strip_tags($myUserPass);
		$sql = "SELECT name, pass FROM myUsers WHERE name = '".$myUser."' AND pass = '".$myUserPass."';";
		$result = mysqli_query($con, $sql);
		//user found
		if (mysqli_num_rows($result) === 1) {
			$_SESSION['active'] = 1;
			$_SESSION['user'] = $myUser;
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
		$status = $_SESSION['active'];
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
		<!-- Ajax -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<!-- JavaScript -->
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../../assets/js/html5shiv.js"></script>
		<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
		
		<style type="text/css">
			html, body {
				background-color: #505050;
			}
			body {
				padding-top: 40px;
			}
			
			.navbar-header {
				color: #404040;
			}
			
			.navbar .nav > li > a {
				color: #505050;
			}
		</style>
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
		<li class="active"><a href="">Home</a></li>
		<li class="icon-user"><a href="#about">Web Technologies</a></li>
		<li class="icon-user"><a href="#contact">File Maker</a></li>
		</ul>
		<form class="navbar-form navbar-right" action="Main.php" method="post">
		<button type="submit" name="logout" class="btn btn-primary">Logout</button>
		</form>
		</div>
		</div> <!-- container -->
		</div>
		</div> <!-- container -->
		</div> <!-- wrapper -->
	</body>
	
</html>