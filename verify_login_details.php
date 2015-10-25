<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head><title></title></head>
<body>
	<?php
		
		require_once'db_connect.php';

		$username=$_SESSION["username"];
		$password=$_SESSION["password"];
		
		//echo "<br> Username provided is ". $username ."<br>";
		

		//#1
		
		
		try 
		{	
			//#5

			
		    $sql="SELECT * FROM users where username = '$username'";
			$q=$connect->prepare($sql);
			$q1=$q->execute();
			$result=$q->rowCount();
			echo "<br>Number of rows in result of password query : " . $result;
			$q2=$q->fetch(PDO::FETCH_ASSOC);
			$db_password=$q2['password'];
			$_SESSION["name"]=$q2['name'];
			$_SESSION["id"]=$q2['id'];
			echo "<br>" . $db_password;
			
			} 
		catch (PDOException $e) 
		{
			echo "Connection failed: " . $e->getMessage();
		}
			
		if ($db_password===$password) : 
			//$_SESSION["login"]=1; 
			//$_SESSION["message"]="Logged in successfully";
			$_SESSION["logged_in"]=true;
			$password_Err="";
			$_SESSION["attempt_count"]=0;
			
			//echo "<br>" . "Database retrieved name : " . $name;
			//echo "<br>" . "Database retrieved id : " . $id;

			?>
			



			<script type="text/javascript">
			window.location = "home_page.php";
			</script>




	<?php else :
				
				include ('login_limiter.php');
				//$_SESSION["message"]="Unable to login"; 
				$password_Err="Incorrect Password";
			
			endif; ?>	
	<!--#2-->
</body>
</html>
