<?php
	session_start();
	echo session_id()."<br>";

	echo "<br>" . "Welcome " . $_SESSION["name"];

	try 
			{	
				$_SESSION["db_name"]="post_list";
				include('db_connect.php');
				 
			   		$sql="SELECT content FROM posts where id = '$id' ORDER by 'postnumber'";
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

