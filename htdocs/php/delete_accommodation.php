<?php
	require "user_db.php";
	
	if(!empty($_POST['id'])){
		$sql = "DELETE FROM hotel WHERE hotel_id = ".$_POST['id'];
		$del = mysqli_query($conn, $sql);
		if($del){
			$text = "";
			$sql2 = "SELECT * FROM hotel WHERE 1";
			$hotel = mysqli_query($conn, $sql2);
			while($row = mysqli_fetch_array($hotel)){
				$text .= 	'<div class="list-group-item my-2 bg-light">'.
								'<span class="my-4">Accommodation Name: ' . $row['hotelName'] . '</span>'.
								'<div style="float: right">'.
									'<a href="/admin/update_accommodation?id=' . $row['hotel_id'] . ')" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Accommodation</a>'.
									'<a href="#" onclick="delete_accommodation(' . $row['hotel_id'] . ')" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Accommodation</a>'.
								'</div>'.
							'</div>';
			}
			echo $text;
		}
	}
?>