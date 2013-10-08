<?php
echo '
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>A15</title>
	<style type="text/css">
			.comments {
				width: 480px;
				height: 320px;
				border-style: solid;
				border-color: black;
				overflow: auto;
			}
			.stats {
				width: 480px;
				height: 180px;
				border-style: solid;
				border-color: black;
				overflow: auto;
			}
	</style>
</head>
<body>
	<h3>Your comments here:</h3>
	<div class="comments">';
//credentials
$server = 'localhost';
$user = 'user';
$pass = 'pwd';
$db = 'comments';
//generic connection no database
$con = mysqli_connect($server, $user, $pass);
$selected = mysqli_select_db($con, $db);
//cant find database.. so create it then connect to it
if(!$selected) {
	$sql = 'CREATE DATABASE ' .$db;
	mysqli_query($con, $sql);
	$con = mysqli_connect($server, $user, $pass, $db);
}else { //found the database, so connect to it
	$con = mysqli_connect($server, $user, $pass, $db);
}
//create tables if it doesn't exist...
$sql = 'CREATE TABLE IF NOT EXISTS myUsers(id INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(id), name VARCHAR(20) NOT NULL)';
mysqli_query($con, $sql);
$sql = 'CREATE TABLE IF NOT EXISTS myComments(id INT NOT NULL, postedComment VARCHAR(300) NOT NULL)';
mysqli_query($con, $sql);

//comment submitted, so insert into database.
if(isset($_POST['submit'])) { 
	$name = $_POST['username'];
	$comment = $_POST['comment'];
	$name = mysql_real_escape_string($name);
	$comment = mysql_real_escape_string($comment);
	//check if user exists
	$sql = "SELECT name FROM myUsers WHERE name = '".$name."';";
	mysqli_query($con, $sql);
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$val = $row{'name'};
	if($val == $name) {//user exists
		$sql = "SELECT id FROM myUsers WHERE name = '".$name."';";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
		$val = $row{'id'};
		//insert into comment form
		$sql = "INSERT INTO myComments(id, postedComment) VALUES('".$val."','".$comment."');";
		mysqli_query($con, $sql);
		//cookie
		setcookie('user',$name);
	}else {
		$sql = "INSERT INTO myUsers(name) VALUES('".$name."');";
		mysqli_query($con, $sql);
		$sql = "SELECT id FROM myUsers WHERE name = '".$name."';";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_array($result);
		$val = $row{'id'};
		//insert into comment form
		$sql = "INSERT INTO myComments(id, postedComment) VALUES('".$val."','".$comment."');";
		mysqli_query($con, $sql);
		//cookie
		setcookie('user',$name);
	}	
}
//print the data to the comment field from the database..
$sql = "SELECT myUsers.id, myUsers.name, myComments.id, myComments.postedComment FROM myUsers, myComments WHERE myUsers.id = myComments.id;";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
	echo htmlspecialchars('user: ' . $row{'name'} . ' says: ' . $row{'postedComment'}) . '<br/>';
}
echo '
	</div>
	<form name="commentForm" action="" method="post">
		User:
		<input name="username" type="text" value=';
		if(isset($_COOKIE['user'])) {
			echo $_COOKIE['user'];
		}
		echo '><br/>
		Comment:<br/>
		<textarea name="comment" </></textarea><br/>
		<input name="submit" type="submit">
	</form>
	<h3>Your Statistics</h3>
	<div class="stats">';
if(isset($_COOKIE['user'])) {
	$name = $_COOKIE['user'];
	$sql = "SELECT id FROM myUsers WHERE name = '".$name."';";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$val = $row{'id'};
	$sql = "SELECT COUNT(id), postedComment from myComments WHERE id = '".$val."';";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$val = $row{'COUNT(id)'};
	echo('Hi ' . $name . ' you have posted ' . $val . ' comments.');
} else {
	echo('Hi welcome new user');
}
//close connection
mysqli_close($con);
echo '	
	</div>
</body>
</html>';
?>