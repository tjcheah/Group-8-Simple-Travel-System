<?php
	require "user_db.php";
	
	$text = "";
	if(empty($_POST['data'])){
		$sql = "SELECT * FROM event WHERE 1";
		$result = mysqli_query($conn, $sql);
	} else{
		$sql = 	"SELECT * FROM event WHERE event_id LIKE '%" . $_POST['data'] . "%' OR eventName LIKE '%" . $_POST['data'] . "%' OR note LIKE '%" . $_POST['data'] . "%' OR town_id LIKE '%" . $_POST['data'] . "%'";
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) <= 0){
			echo $text;
			exit;
		}
	}
	while($row = mysqli_fetch_array($result)){
		$text .= 	'<div class="list-group-item my-2 bg-light">'.
						'<span class="my-4">Package Name: ' . $row['eventName'] . '</span>'.
						'<div style="float: right">'.
							'<a href="/admin/edit_package?id=' . $row['event_id'] . '" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Package</a>'.
							'<a href="#" onclick="delete_package(' . $row['event_id'] . ')" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Package</a>'.
						'</div>'.
					'</div>';
	}
	echo $text;
?>