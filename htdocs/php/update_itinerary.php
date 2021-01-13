<?php
	require "user_db.php";
	
	if($_POST){
		if(isset($_POST['itinerary_id'])){
			$sql = "UPDATE `itinerary` SET `itineraryTime` = '".$_POST['itineraryTime']."', `note` = '".$_POST['note']."', `day_id` = '".$_POST['day_id']."' WHERE `itinerary_id` = '".$_POST['itinerary_id']."'";
			mysqli_query($conn, $sql);
		} else{
			session_start();
			$sql = "INSERT INTO `itinerary`(`itineraryName`,`itineraryTime`,`note`,`user_id`,`day_id`,`data`) VALUES ('".$_POST['itineraryName']."', '".$_POST['itineraryTime']."', '".$_POST['note']."', '".$_SESSION['user_id']."', '".$_POST['day_id']."', '".$_POST['data']."')";
			mysqli_query($conn, $sql);
		}
		header("Location: /index.php");
	}
?>