<?php
	require "user_db.php";
	
	if($_POST){
		if(isset($_POST['hotel_id'])){
			$sql = "UPDATE `hotel` SET `hotelName` = '".$_POST['hotelName']."', `type` = '".$_POST['type']."', `hotelDescript` = '".$_POST['hotelDescript']."', `hotelAddress` = '".$_POST['hotelAddress']."', `hotelStartTime` = '".$_POST['hotelStartTime']."', `hotelEndTime` = '".$_POST['hotelEndTime']."', `town_id` = ".$_POST['town_id']." WHERE `hotel_id` = '".$_POST['hotel_id']."'";
			mysqli_query($conn, $sql);
		} else{
			$sql = "INSERT INTO `hotel`(`hotelName`,`type`,`hotelDescript`,`hotelAddress`,`hotelStartTime`,`hotelEndTime`,`town_id`) VALUES ('".$_POST['hotelName']."', '".$_POST['type']."', '".$_POST['hotelDescript']."', '".$_POST['hotelAddress']."', '".$_POST['hotelStartTime']."', '".$_POST['hotelEndTime']."', '".$_POST['town_id']."')";
			mysqli_query($conn, $sql);
		}
		header("Location: /admin/home.php#edit");
	}
?>