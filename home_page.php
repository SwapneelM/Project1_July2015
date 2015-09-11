<?php

if(session_start())
	echo "New session start successful";
?>
<!DOCTYPE html>
<html>
<head><title></title></head>
<body>


	<?php echo "Hey ".$_SESSION["username"].", you have reached the home page";?>

	<h1>Welcome</h1>

	<header><!--insert logos for newsfeed, friend requests and user profile here--></header>

	<h4> Create a Post! <h4>

		<form>
			<textarea name="status_update" height="200px" width="400px"></textarea>
			<button type="submit" name="submit" value="Submit" formmethod="POST" formaction="home_page.php">Post</button>
		</form>

	<?php 

	if ($_SERVER["REQUEST_METHOD"] == "POST")
			echo $_POST["status_update"];
	?>


</body>
</html>