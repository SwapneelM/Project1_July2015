<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head><title></title></head>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

	<?php
		require_once'db_connect.php';
		include('index_header.php');
		//if($_SESSION["login"]==0)
		//echo $_SESSION["message"]."<br>";
		$username=$password=$mobile_no=$name=$email="";
		$username_Err=$password_Err=$mobile_no_Err=$name_Err=$email_Err="";
		
		function test_input($data) {
		   $data = trim($data);
		   $data = stripslashes($data);
		   $data = htmlspecialchars($data);
		   return $data;
		}

		if ($_SERVER["REQUEST_METHOD"]=="POST") {
			$username=$_POST["username"];
			$password=$_POST["password"];
			$name=$_POST["name"];
			$mobile_no=$_POST["mobile_no"];
			$email=$_POST["email"];

			if (empty($_POST["username"])) {
				$username_Err = "Username is required";
		   	} else {
		   		$username = test_input($_POST["username"]);
		     	// check if name only contains letters and whitespace
		   		if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
		       	$username_Err = "Only letters and white space allowed"; 
		    	}
		    }

		    if(empty($_POST["password"])) {
		    	$password_Err = "Password is required";
		   	} else {
		     	$password=$_POST["password"];
			}

			if (empty($_POST["name"])) {
		    	$name_Err = "Name is required";
		   	} else {
		     	$name = test_input($_POST["name"]);
			}
			
			if (empty($_POST["email"])) {
     			$email_Err = "Email is required";
   			} else {
     			$email = $_POST["email"];
     			// check if e-mail address is well-formed
     			/*if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
     			{
       				$email_Err = "Invalid email format"; 
     			}*/
			}
		}
	?>
	
	<body style="background-color:#bbffd2;"><br>
		<div class='container'>
		<!--#6-->
			<br><br>
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div>
					<br><center><h3 class="row"><b>Sign Up</b></h3></center><div class="pull-right"><span style="color:red"><sup>*</sup>&nbsp;denotes required fields</div></span><br>


					<form class="form-horizontal" name="sign_up_details" onsubmit="document.getElementById('submit').disabled = 1;">
						
						<div class="form-group">
							<div><span style="color:red;"><sup>*</sup></span><label for="name">Name:</label><span class="pull-right" style="color:red"><?php echo $name_Err;?></span><input class="form-control" type="text" name="name" placeholder="Enter your name"></input></div><br>

							<div><span style="color:red;"><sup>*</sup></span><label for="username">Username:</label><span class="pull-right" style="color:red"><?php echo $username_Err;?></span><input class="form-control" type="text" name="username" placeholder="Choose your username"></input></div><br>
							
							<div><span style="color:red;"><sup>*</sup></span><label for="password">Password:</label><span class="pull-right" style="color:red"><?php echo $password_Err;?></span><input class="form-control" type="password" name="password" placeholder="Choose your password"></input></div><br>
							
							<!--<p>Date of Birth:<input></input></p>-->
							
							<div><label for="mobile_no">Mobile Number:</label><input class="form-control" type="text" name="mobile_no" placeholder="Enter your mobile no."></input></div><br><!--<?php //echo $mobile_no_Err;?>-->

							<div><span style="color:red;"><sup>*</sup></span><label for="email">Email:</label><span class="pull-right" style="color:red"><?php echo $email_Err;?></span><input class="form-control" type="text" name="email" placeholder="Enter email address"></input></div><br>

							<div><center><input class="btn btn-default" type="submit" name="submit" value="Submit" formmethod="POST" formaction="sign_up.php"></input></center></div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-3"></div>			
		</div>
		<!--#4-->
		<div class="container-fluid">
			<?php
				$register="";
				echo "Username : ". $username . "<br> Password : " . $password . "<br> Name : " . $name . "<br> Email : " . $email . "<br> Mobile no : " . $mobile_no . "<br>";

				//echo "<br> EMAIL ERR" . $email_Err . "???<br>";
				if ($_SERVER["REQUEST_METHOD"]=="POST"){
					if($username_Err==""&&$password_Err==""&&$name_Err==""){
						$ip_add=$_SERVER['REMOTE_ADDR'];
						echo "<br>Creating user " . $name . "<br>";
						$stmt = $connect->prepare("INSERT INTO users (name, username, password, email, mobile_no, ip_address) VALUES (:name, :username, :password, :email, :mobile_no, :ip_add)");
						$stmt->bindParam(':name', $name);
						$stmt->bindParam(':username', $username);
						$stmt->bindParam(':password', $password);
						$stmt->bindParam(':email', $email);
						$stmt->bindParam(':mobile_no', $mobile_no);
						$stmt->bindParam(':ip_add', $ip_add);

						
						$stmt->execute();
						$registered="Registration Successful";

						try{	

						    $sql="SELECT password FROM users where username = '$username'";
							$q=$connect->prepare($sql);
							$q1=$q->execute();
							$result=$q->rowCount();
							echo "<br>Number of rows in result of query : " . $result;
							$q2=$q->fetch(PDO::FETCH_ASSOC);
							$db_password=$q2['password'];
							echo "<br><b>" . $db_password . "</b>";
							} 
						catch (PDOException $e){
							echo "<br>"."Connection failed: " . $e->getMessage();
						}
					}
							else{
								echo "<br> Invalid Email format. " . $email_Err . "<br>";
								echo "<br> Unable to process details.<br>";
							}
				}
			?>
		</div>
	</div>
</body>
</html>