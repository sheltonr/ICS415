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
	//try to register
	if (isset($_POST['register'])) {
		$myUser = mysql_real_escape_string($_POST['user']);
		$myUser = stripslashes($myUser);
		$myUser = strip_tags($myUser);
		$myUserPass = mysql_real_escape_string($_POST['pass']); 
		$myUserPass = stripslashes($myUserPass);
		$myUserPass = strip_tags($myUserPass);
		$confirmPass = mysql_real_escape_string($_POST['confirm']); 
		$confirmPass = stripslashes($confirmPass);
		$confirmPass = strip_tags($confirmPass);
		$sql = "SELECT name, pass FROM myUsers WHERE name = '".$myUser."' AND pass = '".$myUserPass."';";
		$result = mysqli_query($con, $sql);
		//user not found
		if (mysqli_num_rows($result) === 0 && $myUserPass === $confirmPass) {
				$sql = "INSERT INTO myUsers(name, pass) VALUES('".$myUser."', '".$myUserPass."');";
				mysqli_query($con, $sql);
				$_SESSION['status'] = 'Account successfully created.';
				sleep(2);
				header('Location: Login.php');
				die();
		} elseif ($myUserPass != $confirmPass) {
			$status = 'Passwords do not match.';
		} else {
			$status = 'User already exists.';
		}
	}
	
	//check for session
	if (isset($_SESSION['active'])) {
		header('Location: Main.php');
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
		<script type="text/javascript" src="js/myScripts.js"></script>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../../assets/js/html5shiv.js"></script>
		<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->

		<!-- Login form overrides -->
		<style type="text/css">
			html, body {
				background-color: #505050;
			}
			body {
				padding-top: 140px;
			}
			.container {
				width: 300px;
			}
			/* The white background content wrapper */
			.container > .content {
				background-color: #fff;
				padding: 20px;
				margin: 0 -20px;
				-webkit-border-radius: 10px 10px 10px 10px;
				-moz-border-radius: 10px 10px 10px 10px;
				border-radius: 10px 10px 10px 10px;
				-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
				-moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
				box-shadow: 0 1px 2px rgba(0,0,0,.15);
			}
			.login-form {
				margin-left: 65px;
			}
			legend {
				margin-right: -50px;
				font-weight: bold;
				color: #404040;
			}
		</style>
	</head>
	<body>
		<script language='javascript'>changeStatus('invalid');</script>
		<div class="container">
		<div class="content">
		<div class="row">
		<div class="login-form">
		<h2>Register</h2>
		<form action="Register.php" method="post">
		<fieldset>
		<div class="form-group">
		<input type="text" name="user" placeholder="Username">
		</div>
		<div class="form-group">
		<input type="password" name="pass" placeholder="Password">
		</div>
		<div class="form-group">
		<input type="password" name="confirm" placeholder="Confirm password">
		</div>
		<button class="btn btn-primary" name="register" type="submit">Register</button>
		<input type="button" class="btn btn-primary" value="Cancel" name="cancel" onclick="window.location='/Final_Project/Login.php';"></button>
		</fieldset>
		<h4 id="status"><?php echo $status;?></h4>
		</form> <!-- /form -->
		</div>
		</div>
		</div>
		</div><!-- /container -->
	</body>
</html>