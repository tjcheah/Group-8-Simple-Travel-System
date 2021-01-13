<?php
	session_start();
	require "user_db.php";
	
	$text = "";
	if(empty($_POST['data'])){
			echo $text;
			exit;
	} else{
		$sql = "SELECT town_id FROM town WHERE town_name = '".$_POST['data']."'";
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) <= 0){
			$sql = "SELECT town_id FROM town WHERE town_name LIKE '%".$_POST['data']."%' LIMIT 1";
			$result = mysqli_query($conn, $sql);
		}
		if(mysqli_num_rows($result) > 0){
			$result = mysqli_query($conn, $sql);
			$town_id  = mysqli_fetch_array($result);
			$town_id  = $town_id['town_id'];
			$sql = "SELECT * FROM entertainment WHERE town_id = ".$town_id;
			$result = mysqli_query($conn, $sql);
			
			$text .= 	'<div class="tab-pane fade show active" id="v-pills-entertainment" role="tabpanel" aria-labelledby="v-pills-entertainment-tab">';
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
					$text .= 	'<div class="list-group-item my-2 bg-light">'.
									'<div style="float: right">'.
										'<a href="edit_itinerary.php?town_id='.$row['town_id'].'&db=entertainment" class="btn btn-info active mx-3" role="button" aria-pressed="true">Add Itinerary</a>'.
									'</div>'.
									'<span class="my-4">Entertainment Name: ' . $row['enternName'] . '</span>'.
									'<p>'.$row['enternDescript'].'</p>'.
								'</div>';
				}
			}
			$text .= '</div>';
			
			$sql = "SELECT * FROM restaurant WHERE town_id = ".$town_id;
			$result = mysqli_query($conn, $sql);
			
			$text .= 	'<div class="tab-pane fade" id="v-pills-restaurant" role="tabpanel" aria-labelledby="v-pills-restaurant-tab">';
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
					$text .= 	'<div class="list-group-item my-2 bg-light">'.
									'<div style="float: right">'.
										'<a href="edit_itinerary.php?town_id='.$row['town_id'].'&db=restaurant" class="btn btn-info active mx-3" role="button" aria-pressed="true">Add Itinerary</a>'.
									'</div>'.
									'<span class="my-4">Restaurant Name: ' . $row['restaurantName'] . '</span>'.
									'<p>'.$row['restaurantDescript'].'</p>'.
								'</div>';
				}
			}
			$text .= '</div>';
			$sql = "SELECT * FROM hotel WHERE town_id = ".$town_id;
			$result = mysqli_query($conn, $sql);
			
			$text .= 	'<div class="tab-pane fade" id="v-pills-accommodation" role="tabpanel" aria-labelledby="v-pills-accommodation-tab">';
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
					$text .= '<div class="list-group-item my-2 bg-light">'.
								'<div style="float: right">'.
									'<a href="edit_itinerary.php?town_id='.$row['town_id'].'&db=hotel" class="btn btn-info active mx-3" role="button" aria-pressed="true">Add Itinerary</a>'.
								'</div>'.
								'<span class="my-4">Accommodation Name: ' . $row['hotelName'] . '</span>'.
								'<p>'.$row['hotelDescript'].'</p>'.
							'</div>';
				}
			}
			$text .= '</div>';
			$sql = "SELECT * FROM event WHERE town_id = ".$town_id;
			$result = mysqli_query($conn, $sql);
			
			$text .= 	'<div class="tab-pane fade" id="v-pills-package" role="tabpanel" aria-labelledby="v-pills-package-tab">';
			if(mysqli_num_rows($result) > 0){
				while($row = mysqli_fetch_array($result)){
					$text .= '<div class="list-group-item my-2 bg-light">'.
								'<div style="float: right">'.
									'<a href="edit_itinerary.php?town_id='.$row['town_id'].'&db=event" class="btn btn-info active mx-3" role="button" aria-pressed="true">Add Itinerary</a>'.
								'</div>'.
								'<span class="my-4">Package Name: ' . $row['eventName'] . '</span>'.
								'<p>'.$row['note'].'</p>'.
							'</div>';
				}
			}
			$text .= '</div>';
			echo $text;
		}
	}
?>