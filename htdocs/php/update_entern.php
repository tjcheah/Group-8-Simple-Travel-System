<?php
	require "user_db.php";
	
	if($_POST){
		if(isset($_POST['entern_id'])){
			$sql = "UPDATE `entertainment` SET `enternName` = '".$_POST['enternName']."', `type` = '".$_POST['type']."', `enternDescript` = '".$_POST['enternDescript']."', `enternAddress` = '".$_POST['enternAddress']."', `enternStartTime` = '".$_POST['enternStartTime']."', `enternEndTime` = '".$_POST['enternEndTime']."', `town_id` = ".$_POST['town_id']." WHERE `entern_id` = '".$_POST['entern_id']."'";
			mysqli_query($conn, $sql);
		} else{
			$sql = "INSERT INTO `entertainment`(`enternName`,`type`,`enternDescript`,`enternAddress`,`enternStartTime`,`enternEndTime`,`town_id`) VALUES ('".$_POST['enternName']."', '".$_POST['type']."', '".$_POST['enternDescript']."', '".$_POST['enternAddress']."', '".$_POST['enternStartTime']."', '".$_POST['enternEndTime']."', '".$_POST['town_id']."')";
			mysqli_query($conn, $sql);
		}
		header("Location: /admin/home.php#edit");
	}
?>