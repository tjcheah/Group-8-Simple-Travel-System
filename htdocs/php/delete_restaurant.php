<?php
	require "user_db.php";
	
	if(!empty($_POST['id'])){
		$sql = "DELETE FROM restaurant WHERE restaurant_id = ".$_POST['id'];
		$del = mysqli_query($conn, $sql);
		if($del){
			$text = "";
			$sql2 = "SELECT * FROM restaurant WHERE 1";
			$restaurant = mysqli_query($conn, $sql2);
			while($row = mysqli_fetch_array($restaurant)){
				$text .= 	'<div class="list-group-item my-2 bg-light">'.
								'<span class="my-4">Restaurant Name: ' . $row['restaurantName'] . '</span>'.
								'<div style="float: right">'.
									'<a href="#" onclick="update_restaurant(' . $row['restaurant_id'] . ')" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Restaurant</a>'.
									'<a href="#" onclick="delete_restaurant(' . $row['restaurant_id'] . ')" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Restaurant</a>'.
								'</div>'.
							'</div>';
			}
			echo $text;
		}
	}
?>