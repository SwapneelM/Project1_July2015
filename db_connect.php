<!--<!DOCTYPE html>
<html>
<head><title></title></head>
<body>-->

	<?php
		$server_name = "localhost";
		$server_username = "root";
		$server_password = "";
		$db_name=$_SESSION["db_name"];

		//echo "<br>"."Attempting connection to database " . $db_name . "<br>";
		try 
		{
	    	$connect = new PDO("mysql:host=$server_name;dbname=$db_name", $server_username, $server_password);
	    	
	    	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    	//echo "<br>"."Connected successfully to database " . $db_name . "<br>"; 
	    }
		catch(PDOException $e)
	    {
	    	echo "<br>" . "Connection failed: " . $e->getMessage() . "<br>";
	    }
	    //#3
	?>
<!--</body>
</html>-->