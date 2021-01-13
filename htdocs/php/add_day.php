<?php
	session_start();
	require "user_db.php";
	
	if($_POST){
			$sql = "INSERT INTO `day`(`dayName`,`user_id`) VALUES ('".$_POST['dayName']."', '".$_SESSION['user_id']."')";
			mysqli_query($conn, $sql);
			header("Location: /index.php#itinerary");
	}
?>