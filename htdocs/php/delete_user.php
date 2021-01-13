<?php
	require "user_db.php";
	
	if(!empty($_GET['user_id'])){
		$sql = "DELETE FROM user_detail WHERE user_id = '".$_GET['user_id']."'";
		$del = mysqli_query($conn, $sql);
		header("Location: /admin/home.php#profile");
	}
?>