<?php
	require "user_db.php";
	
	if(!empty($_POST['id'])){
		$sql = "DELETE FROM event WHERE event_id = ".$_POST['id'];
		$del = mysqli_query($conn, $sql);
		if($del){
			$text = "";
			$sql2 = "SELECT * FROM event WHERE 1";
			$event = mysqli_query($conn, $sql2);
			while($row = mysqli_fetch_array($event)){
				$text .= 	'<div class="list-group-item my-2 bg-light">'.
								'<span class="my-4">Package Name: ' . $row['eventName'] . '</span>'.
								'<div style="float: right">'.
									'<a href="/admin/update_package?id=' . $row['event_id'] . ')" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Package</a>'.
									'<a href="#" onclick="delete_package(' . $row['event_id'] . ')" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Package</a>'.
								'</div>'.
							'</div>';
			}
			echo $text;
		}
	}
?>