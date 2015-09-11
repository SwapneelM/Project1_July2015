<?php

if(session_start())
	echo "New session start successful";
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


		   	//$_SESSION["username"]=$username/*$_POST["username"]*/;
			//$_SESSION["password"]=$password/*$_POST["password"]*/;

		   	/*echo "Session Variable username : ".$_SESSION["username"]."<br>";
			echo "Session Variable password : ".$_SESSION["password"]."<br>";
			echo "username : ".$username;
			echo "password : ".$password;
			echo "Post Username : ".$_POST["username"];
			echo "Post password : ".$_POST["password"];*/

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
	}
?>


<h2>Login</h2>

	<form name="login_details" method="POST" target="_self" action="index.php" onsubmit="document.getElementById('submit_button').disabled = 1;">
		<p><br>Username:
		<input type="text" name="username" placeholder="Enter your Username"></input></p><?php echo $username_Err;?>
		<p><br>Password:
		<input type="password" name="password" placeholder="Enter your Password"></input><br></p><?php echo $password_Err;?>

		<button type="submit" name="submit" value="Submit" formmethod="POST" formaction="verify_login_details.php">Login</button>
	</form>

<!--after method="POST" line 55  ; target="_self"-->
</body>
</html>