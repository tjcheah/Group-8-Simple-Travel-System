<?php
	require "user_db.php";
	
	if(!empty($_POST['id'])){
		$sql = "DELETE FROM entertainment WHERE entern_id = ".$_POST['id'];
		$del = mysqli_query($conn, $sql);
		if($del){
			$text = "";
			$sql2 = "SELECT * FROM entertainment WHERE 1";
			$town = mysqli_query($conn, $sql2);
			while($row = mysqli_fetch_array($town)){
				$text .= 	'<div class="list-group-item my-2 bg-light">'.
								'<span class="my-4">Entertainment Name: ' . $row['enternName'] . '</span>'.
								'<div style="float: right">'.
									'<a href="#" onclick="update_entern(' . $row['entern_id'] . ')" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Entertainment</a>'.
									'<a href="#" onclick="delete_entern(' . $row['entern_id'] . ')" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Entertainment</a>'.
								'</div>'.
							'</div>';
			}
			echo $text;
		}
	}
?>