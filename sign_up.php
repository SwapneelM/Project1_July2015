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
		//if($_SESSION["login"]==0)
		echo $_SESSION["message"]."<br>";
		$username=$password=$mobile_no=$name=$email="";
		$username_Err=$password_Err=$mobile_no_Err=$name_Err=$email_Err="";
		
		function test_input($data) 
		{
		   $data = trim($data);
		   $data = stripslashes($data);
		   $data = htmlspecialchars($data);
		   return $data;
		}

		if ($_SERVER["REQUEST_METHOD"]=="POST") 
		{
			$username=$_POST["username"];
			$password=$_POST["password"];
			$name=$_POST["name"];
			$mobile_no=$_POST["mobile_no"];
			$email=$_POST["email"];

			if (empty($_POST["username"])) 
		   {
				$username_Err = "Username is required";
		   	} 
		   else 
		   {
		   		$username = test_input($_POST["username"]);
		     	// check if name only contains letters and whitespace
		   		if (!preg_match("/^[a-zA-Z ]*$/",$username)) 
		   		{
		       	$username_Err = "Only letters and white space allowed"; 
		    	}
		    }

		    if (empty($_POST["password"])) 
		    {
		    	$password_Err = "Password is required";
		   	} 
		   	else 
		   	{
		     	$password=$_POST["password"];
			}

			if (empty($_POST["name"])) 
		    {
		    	$name_Err = "Name is required";
		   	} 
		   	else 
		   	{
		     	$name = test_input($_POST["name"]);
			}
			
			if (empty($_POST["email"])) 
			{
     			$email_Err = "Email is required";
   			} 
   			else 
   			{
     			$email = $_POST["email"];
     			// check if e-mail address is well-formed
     			/*if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
     			{
       				$email_Err = "Invalid email format"; 
     			}*/
			}
		}
	?>
	
	<!--#6-->
	
	<h3>Sign Up</h3>
	<form name="sign_up_details" onsubmit="document.getElementById('submit_button').disabled = 1;">
		<p><sup>&nbsp;*&nbsp;</sup>denotes required fields</p>
		<p>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" placeholder="Enter your name"></input><sup>&nbsp;*</sup><?php echo $name_Err;?></p>

		<p>Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="username" placeholder="Choose your username"></input><sup>&nbsp;*</sup><?php echo $username_Err;?></p>
		
		<p>Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" placeholder="Choose your password"></input><sup>&nbsp;*</sup><?php echo $password_Err;?></p>
		
		<!--<p>Date of Birth:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input></input></p>-->
		
		<p>Mobile Number:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="mobile_no" placeholder="Enter your mobile no."></input></p><!--<?php echo $mobile_no_Err;?>-->

		<p>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email" placeholder="Enter email address"></input><sup>&nbsp;*</sup><?php echo $email_Err;?></p>

		<p><input type="submit" name="submit" value="Submit" formmethod="POST" formaction="sign_up.php"></input>

	</form>

	<!--#4-->

	<?php

		echo "Username : ". $username . "<br> Password : " . $password . "<br> Name : " . $name . "<br> Email : " . $email . "<br> Mobile no : " . $mobile_no . "<br>";

		//echo "<br> EMAIL ERR" . $email_Err . "???<br>";
		if ($_SERVER["REQUEST_METHOD"]=="POST")
		{
			if($username_Err==""&&$password_Err==""&&$name_Err=="")//&&$email_Err="")
			{
				
				echo "<br>Creating user " . $name . "<br>";
				$stmt = $connect->prepare("INSERT INTO users (name, username, password, email, mob_no) VALUES (:name, :username, :password, :email, :mobile_no)");
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':username', $username);
				$stmt->bindParam(':password', $password);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':mobile_no', $mobile_no);
				
				$stmt->execute();
				echo "<b> Registration Successful</b><br>";

				try 
				{	

				    $sql="SELECT password FROM users where username = '$username'";
					$q=$connect->prepare($sql);
					$q1=$q->execute();
					$result=$q->rowCount();
					echo "<br>Number of rows in result of query : " . $result;
					$q2=$q->fetch(PDO::FETCH_ASSOC);
					$db_password=$q2['password'];
					echo "<br><b>" . $db_password . "</b>";
					} 
				catch (PDOException $e) 
				{
					echo "<br>"."Connection failed: " . $e->getMessage();
				}
			}
					else
					{
						echo "<br> Invalid Email format. " . $email_Err . "<br>";
						echo "<br> Unable to process details.<br>";
					}
		}
	?>

</body>
</html>