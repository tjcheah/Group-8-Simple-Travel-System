<?php
	require('user_db.php');
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$now = date("Y-m-d H:i:s");
	$sql = "SELECT MONTH(create_time) AS month, YEAR(create_time) AS year, COUNT(*) AS num from user_detail where create_time BETWEEN DATE_SUB('".$now."', INTERVAL 1 YEAR) AND '".$now."' GROUP BY MONTH(create_time) ORDER BY create_time ASC";

	$result = mysqli_query($conn,$sql);

	$data = array();
	foreach ($result as $row) {
		switch($row['month']){
			case 1: $row['month'] = "Jan";
			break;
			case 2: $row['month'] = "Feb";
			break;
			case 3: $row['month'] = "Mar";
			break;
			case 4: $row['month'] = "Apr";
			break;
			case 5: $row['month'] = "May";
			break;
			case 6: $row['month'] = "Jun";
			break;
			case 7: $row['month'] = "Jul";
			break;
			case 8: $row['month'] = "Aug";
			break;
			case 9: $row['month'] = "Sept";
			break;
			case 10: $row['month'] = "Oct";
			break;
			case 11: $row['month'] = "Nov";
			break;
			case 12: $row['month'] = "Dec";
			break;
		}
		$row['date'] = $row['month'] . " " . $row['year'];
		$data[] = $row;
	}

	echo json_encode($data);
?>