<?php
	require "user_db.php";
	
	if($_POST){
		if(isset($_POST['town_id'])){
			$sql = "UPDATE `town` SET `country` = '".$_POST['country']."',`town_name` = '".$_POST['town_name']."',`town_address` = '".$_POST['town_address']."', `town_description` = '".$_POST['town_description']."' WHERE `town_id` = '".$_POST['town_id']."'";
			mysqli_query($conn, $sql);
		} else{
			$sql = "INSERT INTO `town`(`country`,`town_name`,`town_address`,`town_description`) VALUES ('".$_POST['country']."','".$_POST['town_name']."','".$_POST['town_address']."', '".$_POST['town_description']."')";
			mysqli_query($conn, $sql);
		}
		header("Location: /admin/home.php#edit");
	}
?>