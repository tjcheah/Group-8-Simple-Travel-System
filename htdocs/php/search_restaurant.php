<?php
	require "user_db.php";
	
	$text = "";
	if(empty($_POST['data'])){
		$sql = "SELECT * FROM restaurant WHERE 1";
		$result = mysqli_query($conn, $sql);
	} else{
		$sql = 	"SELECT * FROM restaurant WHERE restaurant_id LIKE '%" . $_POST['data'] . "%' OR restaurantName LIKE '%" . $_POST['data'] . "%' OR restaurantDescript LIKE '%" . $_POST['data'] . "%' OR type LIKE '%" . $_POST['data'] . "%'";	
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) <= 0){
			echo $text;
			exit;
		}
	}
	while($row = mysqli_fetch_array($result)){
		$text .= 	'<div class="list-group-item my-2 bg-light">'.
						'<span class="my-4">Restaurant Name: ' . $row['restaurantName'] . '</span>'.
						'<div style="float: right">'.
							'<a href="/admin/edit_restaurant.php?id=' . $row['restaurant_id'] . '" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Restaurant</a>'.
							'<a href="#" onclick="delete_restaurant(' . $row['restaurant_id'] . ')" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Restaurant</a>'.
						'</div>'.
					'</div>';
	}
	echo $text;
?>