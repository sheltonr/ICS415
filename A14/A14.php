<?php
echo '
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>A14</title>
	<style type="text/css">
			.comments {
				width: 480px;
				height: 320px;
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
	$sql = 'CREATE DATABASE comments';
	mysqli_query($con, $sql);
	$con = mysqli_connect($server, $user, $pass, $db);
}else { //found the database, so connect to it
	$con = mysqli_connect($server, $user, $pass, $db);
}
//create table if it doesn't exist...
$sql = 'CREATE TABLE IF NOT EXISTS myComments(postedComment VARCHAR(300) NOT NULL)';
mysqli_query($con, $sql);
//comment submitted, so insert into database.
if(isset($_POST['submit'])) { 
	$var = $_POST['comment'];
	$var = mysql_real_escape_string($var);
	$sql = "INSERT INTO myComments VALUES('".$var."');";
	mysqli_query($con, $sql);
}
//print the data to the comment field from the database..
$sql = "SELECT postedComment FROM myComments;";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)) {
	echo htmlspecialchars($row{'postedComment'}) . '</br>';
}
//close connection
mysqli_close($con);
echo '
	</div>
	<form name="commentForm" action="" method="post">
		Comment:<br/>
		<textarea name="comment" </></textarea><br/>
		<input name="submit" type="submit">
	</form>
</body>
</html>';
?>