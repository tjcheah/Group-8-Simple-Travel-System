<?php
	require "user_db.php";
	
	if($_POST){
		if(isset($_POST['restaurant_id'])){
			$sql = "UPDATE `restaurant` SET `restaurantName` = '".$_POST['restaurantName']."', `type` = '".$_POST['type']."', `restaurantDescript` = '".$_POST['restaurantDescript']."', `restaurantAddress` = '".$_POST['restaurantAddress']."', `restaurantStartTime` = '".$_POST['restaurantStartTime']."', `restaurantEndTime` = '".$_POST['restaurantEndTime']."', `town_id` = ".$_POST['town_id']." WHERE `restaurant_id` = '".$_POST['restaurant_id']."'";
			mysqli_query($conn, $sql);
		} else{
			$sql = "INSERT INTO `restaurant`(`restaurantName`,`type`,`restaurantDescript`,`restaurantAddress`,`restaurantStartTime`,`restaurantEndTime`,`town_id`) VALUES ('".$_POST['restaurantName']."', '".$_POST['type']."', '".$_POST['restaurantDescript']."', '".$_POST['restaurantAddress']."', '".$_POST['restaurantStartTime']."', '".$_POST['restaurantEndTime']."', '".$_POST['town_id']."')";
			mysqli_query($conn, $sql);
		}
		header("Location: /admin/home.php#edit");
	}
?>