<?php
	require "user_db.php";
	
	if(!empty($_POST['day_id'])){
		$sql = "DELETE FROM day WHERE day_id = ".$_POST['day_id'];
		mysqli_query($conn, $sql);
		header("Location: /index.php");
	}
?>