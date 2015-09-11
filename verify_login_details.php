<?php

if(session_start())
	echo "New session start successful";
?>
<!DOCTYPE html>
<html>
<head><title></title></head>
<body>
	<?php

		require_once'db_connect.php';
		$username=$_POST["username"];
		
		$_SESSION["username"]=$_POST["username"];
		$_SESSION["password"]=$_POST["password"];

		echo "<br> Username provided for session is ".$_SESSION["username"]/*$_POST["username"]*/."<br>";
		echo "<br> Username provided is ". $username /*$_POST["username"]*/."<br>";
		//$username=$_POST["username"];
		//$password=$_POST["password"];

		//#1
		
		
		/*try 
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
			$_SESSION["login"]=0; ?>
			<script type="text/javascript">
			window.location = "home_page.php";
			</script>
	<?php else : 
			$_SESSION["login"]=0; ?>
			<script type="text/javascript">
			window.location = "sign_up.php";
			</script>
	<?php endif;*/
	
	//#2

	?>
</body>
</html>