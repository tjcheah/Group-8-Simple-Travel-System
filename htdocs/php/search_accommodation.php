<?php
	require "user_db.php";
	
	$text = "";
	if(empty($_POST['data'])){
		$sql = "SELECT * FROM hotel WHERE 1";
		$result = mysqli_query($conn, $sql);
	} else{
		$sql = 	"SELECT * FROM hotel WHERE hotel_id LIKE '%" . $_POST['data'] . "%' OR hotelName LIKE '%" . $_POST['data'] . "%' OR hotelDescript LIKE '%" . $_POST['data'] . "%' OR type LIKE '%" . $_POST['data'] . "%'";	
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) <= 0){
			echo $text;
			exit;
		}
	}
	while($row = mysqli_fetch_array($result)){
		$text .= 	'<div class="list-group-item my-2 bg-light">'.
						'<span class="my-4">Accommodation Name: ' . $row['hotelName'] . '</span>'.
						'<div style="float: right">'.
							'<a href="/admin/edit_accommodation.php?id=' . $row['hotel_id'] . '" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Accommodation</a>'.
							'<a href="#" onclick="delete_accommodation(' . $row['hotel_id'] . ')" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Accommodation</a>'.
						'</div>'.
					'</div>';
	}
	echo $text;
?>