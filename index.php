<?php
	session_start();
	echo "New session start successful";
	echo "<br>".session_id()."<br>";
	$_SESSION["db_name"]="user_list";
?>
<!DOCTYPE html>
<html>
<head><title></title></head>
<body>
<?php
	$username=$password="";
	$username_Err=$password_Err="";

	function test_input($data) 
	{
   		$data = trim($data);
   		$data = stripslashes($data);
   		$data = htmlspecialchars($data);
   		return $data;
	}


	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{

		   	//#noideawhatnumber

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
	

		if($username_Err==""&&$password_Err!="")
			echo "Incorrect Password";
		if($username_Err!=""&&$password_Err=="") 
			echo "Please reenter valid username";
		if($username_Err==""&&$password_Err=="") :
			$_SESSION["username"]=$username;
			$_SESSION["password"]=$password;
?>
			<script type="text/javascript">
				window.location = "verify_login_details.php";
			</script> 
<?php endif; 
	}
?>

<h2>Login</h2>

	<form name="login_details" method="POST" target="_self" action="index.php" onsubmit="document.getElementById('submit_button').disabled = 1;">
		<p><br>Username:
		<input type="text" name="username" placeholder="Enter your Username"></input>&nbsp;<?php echo $username_Err;?></p>
		<p><br>Password:
		<input type="password" name="password" placeholder="Enter your Password"></input>&nbsp;<?php echo $password_Err;?></p>

		<button type="submit" name="submit" value="Submit" formmethod="POST" formaction="index.php">Login</button>
	</form>

</body>
</html>