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
		header("Location: error.php");
?>