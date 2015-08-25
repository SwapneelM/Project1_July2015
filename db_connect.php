<!DOCTYPE html>
<html>
<head><title></title></head>
<body>

	<?php
		$server_name = "localhost";
		$server_username = "root";
		$server_password = "";
		$db_name="user_list";
		try 
		{
	    	$connect = new PDO("mysql:host=$server_name;dbname=$db_name", $server_username, $server_password);
	    	
	    	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    	echo "Connected successfully"; 
	    }
		catch(PDOException $e)
	    {
	    	echo "Connection failed: " . $e->getMessage();
	    }
	    //#3
	?>
</body>
</html>