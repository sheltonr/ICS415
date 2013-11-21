<?php
	//start session
	session_start();
	date_default_timezone_set('Pacific/Honolulu');
	$time =  date('M, j, Y');
	
	//credentials
	$host = 'localhost';
	$user ='user';
	$pass = 'pwd';
	$db = 'myWebsiteDatabase';
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
		$realUserPass = md5($myUserPass);
		$sql = "SELECT name, pass FROM myUsers WHERE name = '".$myUser."' AND pass = '".$realUserPass."';";
		$result = mysqli_query($con, $sql);
		//user not found
		if ($myUserPass != $confirmPass) {
			$status = 'Passwords do not match.';
		} elseif (strlen($_POST['pass']) < 7){
			$status = 'Password must be atleast 7 characters';
		} elseif (mysqli_num_rows($result) === 0 && $myUserPass === $confirmPass) {
				$sql = "INSERT INTO myUsers(name, pass) VALUES('".$myUser."', '".$realUserPass."');";
				mysqli_query($con, $sql);
				$sql = "INSERT INTO myUsersData(created) VALUES('".$time."');";
				mysqli_query($con, $sql);
				$_SESSION['status'] = 'Account successfully created.';
				header('Location: Login.php');
				die();
		} else {
			$status = 'User already exists.';
		}
	}
	
	//check for session
	if (isset($_SESSION['user'])) {
		header('Location: Index.php');
		die();
	}
?>

<!-- HTML -->
<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
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
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../../assets/js/html5shiv.js"></script>
		<script src="../../assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
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