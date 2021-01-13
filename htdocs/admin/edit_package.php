<?php
	session_start();
	if(!isset($_SESSION['admin_id'])){
		header("Location: /login.php");exit;
	}
	require "../php/user_db.php";
	if($_GET){
		$sql = "SELECT * FROM event WHERE event_id = ".$_GET['id'];
		$event = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($event);
		$title = "Update Package";
	} else{
		$row['eventName'] = "";
		$row['note'] = "";
		$title = "Add Package";
	}
	$sql = "SELECT * FROM town WHERE 1";
	$town = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?> - Admin</title>
<link type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css">
<link type="text/css" rel="stylesheet" href="/assets/css/fontawesome.min.css">
<link type="text/css" rel="stylesheet" href="/assets/css/solid.min.css">
<style>
	html, body{
		background-color: #ededed;
		font-family: sans-serif;
	}
	.header{
		background-color: #bab2b5;
	}
	.tab{
		background-color: #bab2b5;
		width: 30%;
		margin: 0 1px;
		text-align: center;
		display: inline-block;
	}
	a{
		color: #000;
	}
	a:hover{
		color: #555;
	}
</style>
</head>
<body>
<nav class="header">
	<ul class="nav nav-tabs text-center" id="myTab" role="tablist">
	  <li class="nav-item col-md-4">
		<a class="nav-link" href="/admin/home.php#statistic">
			<i class="fas fa-chart-bar fa-2x"></i><br>
			<b>Statistic</b>
		</a>
	  </li>
	  <li class="nav-item col-md-4">
		<a class="nav-link active" href="/admin/home.php#edit">
			<i class="fas fa-edit fa-2x"></i><br>
			<b>Edit</b>
		</a>
	  </li>
	  <li class="nav-item col-md-4">
		<a class="nav-link" href="/admin/home.php#profile">
			<i class="fas fa-users fa-2x"></i><br>
			<b>View User's Profile</b>
		</a>
	  </li>
	</ul>
</nav>
<div class="container">
	<div class="tab-pane fade show active" id="edit" role="tabpanel" aria-labelledby="edit-tab">
		<div class="row my-4">
		  <div class="col-10">
			<div class="tab-content" id="v-pills-tabContent">
			  <div class="tab-pane fade show active" id="v-pills-accommodation" role="tabpanel" aria-labelledby="v-pills-package-tab">
				<h2><?php echo $title; ?></h2>
				<form method="POST" action="../php/update_package.php">
					<?php if(isset($row['event_id'])){?>
						<input type="hidden" name="event_id" value="<?php echo $row['event_id'] ?>">
					<?php } ?>
				  <div class="form-group">
					<label for="eventName">Package Name: </label>
					<input type="text" class="form-control" id="eventName" name="eventName" value="<?php echo $row['eventName']; ?>" required>
				  </div>
				  <div class="form-group">
					<label for="town_id">Town ID: </label>
					<select class="form-control" id="town_id" name="town_id">
						<?php while($row2 = mysqli_fetch_array($town)){?>
							<option value="<?php echo $row2['town_id']; ?>"><?php echo $row2['town_name']; ?></option>
						<?php } ?>
					</select>
				  </div>
				  <div class="form-group">
					<label for="time">Time: </label>
					<select class="form-control" id="time" name="time">
						<option value="12:00am">12:00am</option>
						<option value="1:00am">1:00am</option>
						<option value="2:00am">2:00am</option>
						<option value="3:00am">3:00am</option>
						<option value="4:00am">4:00am</option>
						<option value="5:00am">5:00am</option>
						<option value="6:00am">6:00am</option>
						<option value="7:00am">7:00am</option>
						<option value="8:00am">8:00am</option>
						<option value="9:00am">9:00am</option>
						<option value="10:00am">10:00am</option>
						<option value="11:00am">11:00am</option>
						<option value="12:00pm">12:00pm</option>
						<option value="1:00pm">1:00pm</option>
						<option value="2:00pm">2:00pm</option>
						<option value="3:00pm">3:00pm</option>
						<option value="4:00pm">4:00pm</option>
						<option value="5:00pm">5:00pm</option>
						<option value="6:00pm">6:00pm</option>
						<option value="7:00pm">7:00pm</option>
						<option value="8:00pm">8:00pm</option>
						<option value="9:00pm">9:00pm</option>
						<option value="10:00pm">10:00pm</option>
						<option value="11:00pm">11:00pm</option>
					</select>
				  </div>
				  <div class="form-group">
					<label for="note">Note: </label>
					<textarea class="form-control" rows="5" id="note" name="note" required><?php echo $row['note']; ?></textarea>
				  </div>
				  <div class="text-right">
					  <button type="submit" class="btn btn-primary col-1 mr-2">Save</button>
					  <a href="/admin/home.php#edit" class="btn btn-light col-1">Back</a>
				  </div>
				</form>
			  </div>
			</div>
		  </div>
		</div>
	</div>
</div>
</body>
<script src="/assets/js/jquery-3.3.1.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/solid.min.js"></script>
<script>
<?php if(isset($row['time'])){?>
	$("#time").val("<?php echo $row['time']; ?>");
<?php } ?>
<?php if(isset($row['town_id'])){?>
	$("#town_id").val("<?php echo $row['town_id']; ?>");
<?php } ?>
</script>
</html>