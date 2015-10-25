<!DOCTYPE html>
<html>
<head><title></title></head>
<body>

<?php 
	session_start();
	if($_SESSION["logged_in"]!=true)
	{
	header("Location: logout.php");
	}
?>

</body>
</html>