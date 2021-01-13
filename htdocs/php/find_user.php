<?php
	require "user_db.php";
	
	$text = "";
	if(empty($_POST['id'])){
		$sql2 = "SELECT * FROM user_detail WHERE 1";
		$result = mysqli_query($conn, $sql2);
	} else{
		$sql = "SELECT * FROM user_detail WHERE user_id LIKE '%" . $_POST['id'] . "%' OR user_name LIKE '%" . $_POST['id'] . "%' OR  real_name LIKE '%" . $_POST['id'] . "%'";
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
						'<span>UserID: '. $row["user_id"] . '</span><br>'.
						'<span>Username: '. $row["user_name"] . '</span><br>'.
						'<span>Name: '. $row["real_name"] . '</span>'.
					'</div>'.
				'</li>';
	}
	echo $text;
?>