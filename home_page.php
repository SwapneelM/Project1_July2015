<?php
	require_once'verify_login.php';
?>
<!DOCTYPE html>
<html>

<head><title></title></head>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

<body>
<div class="container">
	<?php
		include('header.php');
		
			/*try 
			{	
					$_SESSION["db_name"]="user_list";
					include('db_connect.php');

					$username = $_SESSION["username"];

				    $sql="SELECT * FROM users where username = '$username'";
					$q=$connect->prepare($sql);
					$q1=$q->execute();
					$result=$q->rowCount();
					//echo "<br>"."Number of rows in result of query : " . $result;
					$q2=$q->fetch(PDO::FETCH_ASSOC);
					$id=$q2['id'];
					$name=$q2['name'];
					//echo "<br>" . "Database retrieved name : " . $name;
					//echo "<br>" . "Database retrieved id : " . $id;
					$_SESSION["name"]=$name;
					$_SESSION["id"]=$id;
			} 
			catch (PDOException $e) 
			{
				echo "<br>"."Connection failed: " . $e->getMessage();
			}*/

		//echo $_SESSION["message"]."<br>";
		?>
		
		<?echo "<br>Hey ".$_SESSION["username"].", you have reached the home page<br>";?>
	

	<h1>Welcome</h1>

	<header><!--insert css, logos for newsfeed, friend requests and user profile here--></header>

	<h4> Create a Post! <h4>
		<div>
		<form>
			<textarea name="status_update" height="200px" width="400px" style="overflow:scroll"></textarea>
			<button type="submit" name="submit" value="Submit" formmethod="POST" formaction="home_page.php">Post</button>
		</form>
		<div>
	<?php 

		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{	//echo "<br>" . $_POST["status_update"] . "<br>";

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
			
		}

		try 
			{	
				$_SESSION["db_name"]="post_list";
				include('db_connect.php');
				 
			   		$sql="SELECT content FROM posts ORDER BY time DESC";
					$q=$connect->prepare($sql);
					$q1=$q->execute();
					$result=$q->rowCount();
					//echo "<br>"."Number of rows in result of query : " . $result . "<br>";
					while($q2=$q->fetch(PDO::FETCH_ASSOC))
						foreach ($q2 as $key => $value) 
						{?>
					<div>
						<?php	echo "<br>" . $key . " => " . $value . "<br>";
						}
						?>
					</div>	
			<?php
			} 
			catch (PDOException $e) 
			{
				echo "<br>"."Connection failed: " . $e->getMessage();
			}
	?>

	<?php
		$link1="img/1/image2";
		$name="/image2";
		$link="img";
	?>
	<img src="<?php echo $link;echo $name;?>">
	<img src="<?php echo $link1;?>">
	<img src="/opt/lampp/htdocs/Project1_July2015/image2">
	<img src="UK_Creative_462809583">
	<img src="http://www.gettyimages.in/gi-resources/images/Homepage/Category-Creative/UK/UK_Creative_462809583.jpg">
</div>
</body>
</html>