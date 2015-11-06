
<!DOCTYPE html>
<html>
<head><title></title></head>
<body>
<?php
	require_once'verify_login.php';
	require_once'header.php';
	
	?>

	<div class="container" style="margin-top:59px;">
	<?php	
	try {	
				$id=$_SESSION["id"];
				$_SESSION["db_name"]="post_list";
				include('db_connect.php');
				 
			   		$sql="SELECT content FROM posts WHERE id = '$id' ORDER BY timestamp DESC";
					$q=$connect->prepare($sql);
					$q1=$q->execute();
					$result=$q->rowCount();
					echo "<br>"."Number of rows in result of query : " . $result . "<br>";
					while($q2=$q->fetch(PDO::FETCH_ASSOC))
						foreach ($q2 as $key => $value) {?>
						<p>

							<span style="border:solid 5px;"><?php echo "<br>" . $key . " => " . $value . "<br>";?><span>
						
						</p>
						<?}

					
			
				} catch (PDOException $e) {
				echo "<br>"."Connection failed: " . $e->getMessage();
			}
?>
</div>
</body>
</html>

