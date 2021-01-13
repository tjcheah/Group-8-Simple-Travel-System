<?php
	require "user_db.php";
	
	if($_POST){
		if(isset($_POST['town_id'])){
			$sql = "UPDATE `town` SET `town_name` = '".$_POST['town_name']."', `town_description` = '".$_POST['town_description']."' WHERE `town_id` = '".$_POST['town_id']."'";
			mysqli_query($conn, $sql);
		} else{
			$sql = "INSERT INTO `town`(`town_name`,`town_description`) VALUES ('".$_POST['town_name']."', '".$_POST['town_description']."')";
			mysqli_query($conn, $sql);
		}
		header("Location: /admin/home.php#edit");
	}
?>