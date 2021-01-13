<?php
	require "user_db.php";
	
	if($_POST){
		if(isset($_POST['event_id'])){
			$sql = "UPDATE `event` SET `eventName` = '".$_POST['eventName']."', `time` = '".$_POST['time']."', `note` = '".$_POST['note']."', `town_id` = '".$_POST['town_id']."' WHERE `event_id` = '".$_POST['event_id']."'";
			mysqli_query($conn, $sql);
		} else{
			$sql = "INSERT INTO `event`(`eventName`,`time`,`note`,`town_id`) VALUES ('".$_POST['eventName']."', '".$_POST['time']."', '".$_POST['note']."', '".$_POST['town_id']."')";
			mysqli_query($conn, $sql);
		}
		header("Location: /admin/home.php#edit");
	}
?>