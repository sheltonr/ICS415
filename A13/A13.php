<?php
echo '
<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>A13</title>
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
$str = file_get_contents('comments.txt');
if(isset($_POST['submit'])) { 
	$str = file_get_contents('comments.txt');
	$var = $_POST['comment'];
	$str .= htmlspecialchars($var) . '</br>';
	file_put_contents('comments.txt', $str);
}
echo ($str);
echo '
	</div>
	<form name="commentForm" action=a13.php method="post">
		Comment:<br/>
		<textarea name="comment" id="comment" </></textarea><br/>
		<input name="submit" type="submit">
		</form>
	

</body>
</html>';
?>