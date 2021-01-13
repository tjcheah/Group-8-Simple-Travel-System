<?php
	require "user_db.php";
	
	$text = "";
	if(empty($_POST['data'])){
		$sql2 = "SELECT * " . $_POST['db'] . " town WHERE 1";
		$result = mysqli_query($conn, $sql2);
	} else{
		$sql = "SELECT * FROM " . $_POST['db'] . " WHERE town_id LIKE '%" . $_POST['data'] . "%' OR town_name LIKE '%" . $_POST['data'] . "%' OR town_description LIKE '%" . $_POST['data'] . "%'";
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) <= 0){
			$sql2 = "SELECT * FROM " . $_POST['db'] . " WHERE 1";
			$result = mysqli_query($conn, $sql2);
		}
	}
	while($row = mysqli_fetch_array($result)){
		$text .= 	'<div class="list-group-item my-2 bg-light">'.
						'<span class="my-4">Town Name: ' . $row['town_name'] . '</span>'.
						'<div style="float: right">'.
							'<a href="#" onclick="update_town(' . $row['town_id'] . ')" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Town</a>'.
							'<a href="#" onclick="delete_town(' . $row['town_id'] . ')" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Town</a>'.
						'</div>'.
					'</div>';
	}
	echo $text;
?>