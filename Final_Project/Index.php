<?php
	//start session
	session_start();
	date_default_timezone_set('Pacific/Honolulu');
	$dateTime = date('l jS \of F Y h:i:s A');
	$date = date('l jS \of F Y');
	
	//credentials
	$host = 'localhost';
	$user ='user';
	$pass = 'pwd';
	$db = 'FinalProject';	
		
	//status message
	$status = '';
		
	//connection to database
	$con = mysqli_connect($host, $user, $pass, $db);
	//try to login
	if (isset($_POST['submit'])) {
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
		$sql = "SELECT id, name, created, last_login, background FROM myUsers WHERE name = '".$myUser."' AND pass = '".$myUserPass."';";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
		//user found get session info
		if (mysqli_num_rows($result) === 1) {
			$_SESSION['user'] = $myUser;
			$_SESSION['id'] = $row{'id'};
			$_SESSION['created'] = $row{'created'};
			$_SESSION['last_login'] = $row{'last_login'};
			$_SESSION['date'] = $date;
			$_SESSION['background'] = $row{'background'};
			$sql = "UPDATE myUsers SET last_login = '".$dateTime."' WHERE name = '".$myUser."' AND pass = '".$myUserPass."';";
			mysqli_query($con, $sql);
			//homepage trivia stuff
			$_SESSION['trivia_questions'] = read('Trivia/Trivia_Questions.txt');
			$_SESSION['trivia_answers'] = read('Trivia/Trivia_Answers.txt');
			//return homepage
			header('Location: Home.php');
			die();
		} elseif (mysqli_num_rows($result) === 0) {
			$_SESSION['status'] = 'Invalid user name or password';
			header('Location: Login.php');
			die();
		}	
	}
	
	//background
	if (isset($_POST['background'])) {
		if($_POST['background'] != '') {
			$sql = "UPDATE myUsers SET background = '".$_POST['background']."' WHERE id = '".$_SESSION['id']."';";
			mysqli_query($con, $sql);
			$_SESSION['background'] = $_POST['background'];
		}
	}
	
	//logout
	if (isset($_POST['logout'])) {
		session_unset();
		session_destroy();
	}
	
	//check for session
	if (isset($_SESSION['user'])) {
		header('Location: Home.php');
		die();
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
?>