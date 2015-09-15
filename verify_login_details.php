<?php
	session_start();
	echo session_id()."<br>";
?>
<!DOCTYPE html>
<html>
<head><title></title></head>
<body>
	<?php
		
		require_once'db_connect.php';

		$username=$_SESSION["username"];
		$password=$_SESSION["password"];
		
		echo "<br> Username provided is ". $username ."<br>";
		

		//#1
		
		
		try 
		{	
			//#5
			
		    $sql="SELECT password FROM users where username = '$username'";
			$q=$connect->prepare($sql);
			$q1=$q->execute();
			$result=$q->rowCount();
			echo "<br>Number of rows in result of query : " . $result;
			$q2=$q->fetch(PDO::FETCH_ASSOC);
			$db_password=$q2['password'];
			echo "<br>" . $db_password;
			
			} 
		catch (PDOException $e) 
		{
			echo "Connection failed: " . $e->getMessage();
		}
			
		if ($db_password===$password) : 
			//$_SESSION["login"]=1; 
			$_SESSION["message"]="Logged in successfully";
			?>
			<script type="text/javascript">
			window.location = "home_page.php";
			</script>
	<?php else : 
			//$_SESSION["login"]=0; 
			$_SESSION["message"]="Unsuccessful Login";
			?>
			<script type="text/javascript">
			window.location = "sign_up.php";
			</script>
	<?php endif;
	
	//#2

	?>
</body>
</html>
