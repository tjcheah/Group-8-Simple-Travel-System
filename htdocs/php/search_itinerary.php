<?php
	session_start();
	require "user_db.php";
	
	$text = "";
	if(empty($_POST['id'])){
		$sql = "SELECT * FROM itinerary WHERE day_id = 1 AND user_id = " . $_SESSION['user_id'];
		$result = mysqli_query($conn, $sql);
	} else{
		$sql = 	"SELECT * FROM itinerary WHERE day_id = " . $_POST['id'] . " AND user_id = " . $_SESSION['user_id'];
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) <= 0){
			echo $text;
			exit;
		}
	}
	while($row = mysqli_fetch_array($result)){
		$text .= 		'<a href="edit_itinerary.php?itinerary_id='.$row['itinerary_id'].'" class="list-group-item my-2 bg-light">'.
								'<span class="my-4" style="float: right;">'.$row["itineraryTime"].'</span>'.
								'<h4 class="my-4">'.$row["itineraryName"].'</h4>'.
								'<p>'.$row['note'].'</p>'.
							'</a>';
	}
	echo $text;
?>