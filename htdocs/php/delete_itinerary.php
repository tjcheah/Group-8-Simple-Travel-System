<?php
	require "user_db.php";
	
	if(!empty($_GET['itinerary_id'])){
		$sql = "DELETE FROM itinerary WHERE itinerary_id = ".$_GET['itinerary_id'];
		mysqli_query($conn, $sql);
		
		header("Location: /index.php#itinerary");
	}
?>