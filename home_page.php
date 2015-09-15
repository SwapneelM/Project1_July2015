<?php
	session_start();
	echo session_id()."<br>";
?>
<!DOCTYPE html>
<html>
<head><title></title></head>
<body>


	<?php 
		echo $_SESSION["message"]."<br>";
		echo "Hey ".$_SESSION["username"].", you have reached the home page";
	?>

	<h1>Welcome</h1>

	<header><!--insert css, logos for newsfeed, friend requests and user profile here--></header>

	<h4> Create a Post! <h4>

		<form>
			<textarea name="status_update" height="200px" width="400px"></textarea>
			<button type="submit" name="submit" value="Submit" formmethod="POST" formaction="home_page.php">Post</button>
		</form>

	<?php 

		try 
				{	
					$_SESSION["db_name"]="user_list";
					include('db_connect.php');

					$username = $_SESSION["username"];

				    $sql="SELECT * FROM users where username = '$username'";
					$q=$connect->prepare($sql);
					$q1=$q->execute();
					$result=$q->rowCount();
					echo "<br>"."Number of rows in result of query : " . $result;
					$q2=$q->fetch(PDO::FETCH_ASSOC);
					$id=$q2['id'];
					$name=$q2['name'];
					echo "<br>" . "Database retrieved name : " . $name;
					echo "<br>" . "Database retrieved id : " . $id;
					$_SESSION["name"]=$name;
					$_SESSION["id"]=$id;
				} 
				catch (PDOException $e) 
				{
					echo "<br>"."Connection failed: " . $e->getMessage();
				}

		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{	echo "<br>" . $_POST["status_update"] . "<br>";

			try 
			{	
				$_SESSION["db_name"]="post_list";
				include('db_connect.php');
				 
			    $stmt = $connect->prepare("INSERT INTO posts (id, content) VALUES (:id, :post)");
					$stmt->bindParam(':post', $_POST["status_update"]);
					$stmt->bindParam(':id', $id);
				$stmt->execute();
				
			} 
			catch (PDOException $e) 
			{
				echo "<br>"."Connection failed: " . $e->getMessage();
			}
			$_SESSION["db_name"]="user_list";
		}

		try 
			{	
				$_SESSION["db_name"]="post_list";
				include('db_connect.php');
				 
			   		$sql="SELECT content FROM posts /*where id = '$id'*/ORDER by 'postnumber'";
					$q=$connect->prepare($sql);
					$q1=$q->execute();
					$result=$q->rowCount();
					echo "<br>"."Number of rows in result of query : " . $result . "<br>";
					while($q2=$q->fetch(PDO::FETCH_ASSOC))
						foreach ($q2 as $key => $value) 
						{
							echo "<br>" . $key . " => " . $value . "<br>";
						}

					
			
				} 
			catch (PDOException $e) 
			{
				echo "<br>"."Connection failed: " . $e->getMessage();
			}
	?>

	<a href="/Project1_July2015/wall.php"><?php echo "<br>" . $_SESSION["name"];?>'s Wall</a>




</body>
</html>