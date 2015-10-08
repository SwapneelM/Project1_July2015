<?php
	session_start();
	echo "New session start successful";
	echo "<br>".session_id()."<br>";
	echo "<br>".$_SERVER['REMOTE_ADDR']."<br>";
	if (isset($_SESSION["attempt_count"])) 
	{
		echo "<br>". "Login attempt " . $_SESSION["attempt_count"] ."<br>";
	}
	$_SESSION["db_name"]="user_list";

	$ip_add=$_SERVER['REMOTE_ADDR'];
	require_once'db_connect.php';
	$sql="SELECT blacklisted FROM login_attempts where ip_address = '$ip_add'";
	$q=$connect->prepare($sql);
	$q1=$q->execute();
	$result=$q->rowCount();
	//echo "<br>"."Number of rows in result of login attempt query : " . $result . "<br>";
	$q2=$q->fetch(PDO::FETCH_ASSOC);
	$_SESSION["blacklisted"]=$q2['blacklisted'];
	if($_SESSION["blacklisted"]!=NULL)
		$_SESSION["blacklisted"]=true;

	echo "<br>" . $_SESSION["blacklisted"] . "<br>";
	if($_SESSION["blacklisted"])
		header("Location: err.php?e=404");
?>
	<!--<script type="text/javascript">
		window.location = "error_404.php";	
	</script>-->

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
			echo "Please enter valid username";
		if($username_Err==""&&$password_Err=="") :
				$_SESSION["username"]=$username;
				$_SESSION["password"]=$password;
?>
				<script type="text/javascript">
						window.location = "verify_login_details.php";
				</script>
<?php endif; //above <script> can be replaced by => require_once'verify_login_details.php'; //check which is faster to load
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