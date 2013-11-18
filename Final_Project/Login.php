<?php
	//start session
	session_start();
	
	//credentials
	$host = 'localhost';
	$user ='user';
	$pass = 'pwd';
	$db = 'FinalProject';
	
	//status message
	$status = '';
	
	//generic connection no database
	$con = mysqli_connect($host, $user, $pass);
	$selected = mysqli_select_db($con, $db);
	//can't find database.. so create it then connect to it
	if (!$selected) {
		$sql = 'CREATE DATABASE ' . $db;
		mysqli_query($con, $sql);
		$con = mysqli_connect($host, $user, $pass, $db);
	} else {//found the database, so connect to it
		$con = mysqli_connect($host, $user, $pass, $db);
	}
	//create tables if needed
	$sql = 'CREATE TABLE IF NOT EXISTS myUsers(id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name VARCHAR(40) NOT NULL, pass VARCHAR(40) NOT NULL, 
	background VARCHAR(20) DEFAULT "None", last_login VARCHAR(60) DEFAULT "Never", created VARCHAR(60) NOT NULL)';
	mysqli_query($con, $sql);
	
	if (isset($_SESSION['user'])) {
		header('Location: Index.php');
		die();
	} elseif (isset($_SESSION['status'])) {
		$status = $_SESSION['status'];
	}
?>

<!-- HTML -->
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
		<!-- Css -->
		<link href="css/login.css" rel="stylesheet" media="screen">
		<!-- Ajax -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<!-- JavaScript -->
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/myScripts.js"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../../assets/js/html5shiv.js"></script>
		<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<script language='javascript'>changeStatus('invalid');</script>
		<div class="container">
		<div class="content">
		<div class="row">
		<div class="login-form">
		<h2>Login</h2>
		<form action="Index.php" method="post">
		<fieldset>
		<div class="form-group">
		<input type="text" name="user" placeholder="Username">
		</div>
		<div class="form-group">
		<input type="password" name="pass" placeholder="Password">
		</div>
		<button class="btn btn-primary" name="submit" type="submit">Sign in</button>
		<input type="button" class="btn btn-primary" value="Register" name="register" onclick="window.location='/Final_Project/Register.php';"></button>
		</fieldset>
		<h4 id="status"><?php echo $status; ?></h4>
		</form> <!-- /form -->
		</div>
		</div>
		</div>
		</div><!-- /container -->
	</body>
</html>