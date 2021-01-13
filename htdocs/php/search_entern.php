<?php
	require "user_db.php";
	
	$text = "";
	if(empty($_POST['data'])){
		$sql = "SELECT * FROM entertainment WHERE 1";
		$result = mysqli_query($conn, $sql);
	} else{
		$sql = 	"SELECT * FROM entertainment WHERE entern_id LIKE '%" . $_POST['data'] . "%' OR enternName LIKE '%" . $_POST['data'] . "%' OR enternDescript LIKE '%" . $_POST['data'] . "%' OR type LIKE '%" . $_POST['data'] . "%'";	
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result) <= 0){
			echo $text;
			exit;
		}
	}
	while($row = mysqli_fetch_array($result)){
		$text .= 	'<div class="list-group-item my-2 bg-light">'.
						'<span class="my-4">Entertainment Name: ' . $row['enternName'] . '</span>'.
						'<div style="float: right">'.
							'<a href="/admin/edit_entertainment.php?id='.$row['entern_id'].'" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Entertainment</a>'.
							'<a href="#" onclick="delete_entern(' . $row['entern_id'] . ')" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Entertainment</a>'.
						'</div>'.
					'</div>';
	}
	echo $text;
?>