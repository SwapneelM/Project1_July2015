<?php 
include('verify_blacklisted.php');
?>
	<!--<script type="text/javascript">
		window.location = "error_404.php";	
	</script>-->

<!DOCTYPE html>
<html>
<head><title></title></head>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

<?php include('index_header.php');?>

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
	<div class="container-fluid">
		<div class="col-md-4"></div>	
			<div class="col-md-6">	
				

				<form class="form-horizontal" name="login_details" method="POST" target="_self" action="index.php" onsubmit="document.getElementById('submit_button').disabled = 1;">
					<div class="form-group">
						<div class="row"><div class=" col-md-6"><center><h2>Share your talent now!</h2></center></div></div><br>
						<div class="row"><!--<div class="col-md-2"><label for="username">Username:</label></div>-->
						<div class=" col-md-6"><input class="form-control" type="text" name="username" placeholder="Enter your Username"></input><div class="pull-right"><span style="color:red;"><?php echo $username_Err;?></span></div></div>
						</div><br>
						<div class="row"><!--<div class="col-md-2"><label for="password">Password:</label></div>-->
						<div class=" col-md-6"><input class="form-control" type="password" name="password" placeholder="Enter your Password"></input><div class="pull-right"><span style="color:red;"><?php echo $password_Err;?></span></div></div>
						</div><br>
						<!--id="submit_button" label to be added-->
						<div class="row col-md-6"><center><button class="btn btn-default" type="submit" name="submit" value="Submit" formmethod="POST" formaction="index.php">Login</button></center></div>
					</div>
				</form>
			</div>
		<div class="col-md-2"></div>
	</div>
</body>
</html>