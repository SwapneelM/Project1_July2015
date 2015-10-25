<!--<!DOCTYPE html>
<html>
<head><title></title></head>
<body>-->
	

	<?php

		$ip_add=$_SERVER['REMOTE_ADDR'];
				
			try 
			{	
				
			   		$sql="SELECT attempts FROM login_attempts where ip_address = '$ip_add'";
					$q=$connect->prepare($sql);
					$q1=$q->execute();
					$result=$q->rowCount();
					echo "<br>"."Number of rows in result of login attempt query : " . $result . "<br>";
					$q2=$q->fetch(PDO::FETCH_ASSOC);
					//if(!isset($_SESSION["attempt_count"])
					$_SESSION["attempt_count"]=$q2['attempts'];
					$_SESSION["attempt_count"]=$_SESSION["attempt_count"]+1;
					echo "<br>" . "Login attempt ". $_SESSION["attempt_count"] . "<br>";
						
				
					try
					{	
						if(!isset($_SESSION["attempt_count"]))
							$_SESSION["attempt_count"]=1;
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

						$stmt->bindParam(':attempt', $_SESSION["attempt_count"]);
						$stmt->execute();

						echo "<br><b> Login attempt table link Successful Login attempts = ". $_SESSION["attempt_count"] . "</b><br>";
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

			if($_SESSION["attempt_count"]>2)
			if($_SESSION["attempt_count"]>=4) 
			{
				try
				{
					$blacklist=true;

					$sql="UPDATE login_attempts SET blacklisted = :blacklist WHERE ip_address = '$ip_add'";					
					$stmt = $connect->prepare($sql);
					$stmt->bindParam(':blacklist', $blacklist);
					$stmt->execute();

					echo "<br><b> Login attempt table link Successful Login attempts = ". $_SESSION["attempt_count"] . "</b><br>";
				}
				catch(PDOException $f)
				{
					echo "<br>"."Connection failed: " . $f->getMessage();
				}	
			}
	?>
			<script type="text/javascript">
			window.location = "index.php";
			</script>
	<?php ?>
	<!--</body>
</html>-->