<?php
	require "user_db.php";
	
	$text = "";
	if(empty($_POST['user'])){
		$sql2 = "SELECT * FROM user_detail WHERE 1";
		$result = mysqli_query($conn, $sql2);
	} else{
		$sql = "SELECT * FROM user_detail WHERE user_id = " . $_POST['user'] . " OR user_name = '" . $_POST['user'] . "'";
		$result = mysqli_query($conn, $sql);
	
		if(mysqli_num_rows($result) <= 0){
			$sql2 = "SELECT * FROM user_detail WHERE 1";
			$result = mysqli_query($conn, $sql2);
		}
	}
	while($row = mysqli_fetch_array($result)){
		$text .= '<li class="list-group-item my-2">'.
					'<div class="ml-2 mr-5 my-3" style="float: left;">'.
						'<i class="fas fa-user fa-3x"></i>'.
					'</div>'.
					'<div class="mx-5">'.
						'<label>UserID: '. $row["user_id"] . '</label><br>'.
						'<label>Username: '. $row["user_name"] . '</label><br>'.
						'<label>Name: '. $row["user_name"] . '</label>'.
					'</div>'.
				'</li>';
	}
	echo $text;
?>