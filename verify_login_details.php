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
			echo "<br>Number of rows in result of password query : " . $result;
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
			//$_SESSION["message"]="Logged in successfully";
			$password_Err="";
			?>
			



			<script type="text/javascript">
			window.location = "home_page.php";
			</script>




	<?php else : 
			//$_SESSION["login"]=0; 
			$password_Err="Incorrect Password";
			$ip_add=$_SERVER['REMOTE_ADDR'];
				
			try 
			{	
				
			   		$sql="SELECT attempts FROM login_attempts where ip_address = '$ip_add'";
					$q=$connect->prepare($sql);
					$q1=$q->execute();
					$result=$q->rowCount();
					echo "<br>"."Number of rows in result of login attempt query : " . $result . "<br>";
					$q2=$q->fetch(PDO::FETCH_ASSOC);
					//if(!isset($_SESSION["attempt"])
					$_SESSION["attempt"]=$q2['attempts'];
					$_SESSION["attempt"]=$_SESSION["attempt"]+1;
					echo "<br>" . "Login attempt ". $_SESSION["attempt"] . "<br>";
						
				
					try
					{	
						if(!isset($_SESSION["attempt"]))
							$_SESSION["attempt"]=1;
						if($result==0)
						{
							$sql="INSERT INTO login_attempts (ip_address, attempts) VALUES (:ip_add, :attempt)";
							$stmt = $connect->prepare($sql);
							$stmt->bindParam(':ip_add', $ip_add);
						}
						else
						{
							$sql="UPDATE login_attempts SET attempts = :attempt WHERE ip_address = '$ip_add'";
							$stmt = $connect->prepare($sql);
						}
						
						

						
						$stmt->bindParam(':attempt', $_SESSION["attempt"]);
						
						$stmt->execute();

						echo "<br><b> Login attempt table link Successful Login attempts = ". $_SESSION["atttempt"] . "</b><br>";
					}
					catch(PDOException $f)
					{
						echo "<br>"."Connection failed: " . $f->getMessage();
					}	
			} 
			catch (PDOException $e) 
			{
				echo "<br>"."Connection failed: " . $e->getMessage();
			}
			

			//$_SESSION["login_attempt"]=$_SESSION["login_attempt"]+1;
			//if($_SESSION["login_attempt"]>5) : ?>
			<!--<script type="text/javascript">
			window.location = "index.php";
			</script>
			<?php //else : ?>-->





			<script type="text/javascript">
			window.location = "index.php";
			</script>




	<?php endif; ?>

	<?php //endif;
	
	//#2

	?>
</body>
</html>
