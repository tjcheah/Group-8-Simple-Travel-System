<?php
	session_start();
	if(!isset($_SESSION['admin_id'])){
		header("Location: /login.php");exit;
	}
	require "../php/user_db.php";
	if($_GET){
		$sql = "SELECT * FROM entertainment WHERE entern_id = ".$_GET['id'];
		$entertainment = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($entertainment);
		$title = "Update Entertainment";
	} else{
		$row['enternName'] = "";
		$row['enternDescript'] = "";
		$row['enternAddress'] = "";
		$row['enternStartTime'] = "";
		$row['enternEndTime'] = "";
		$row['type'] = "";
		$title = "Add Entertainment";
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
			  <div class="tab-pane fade show active" id="v-pills-entertainment" role="tabpanel" aria-labelledby="v-pills-town-tab">
				<h2><?php echo $title; ?></h2>
				<form method="POST" action="../php/update_entern.php">
					<?php if(isset($row['entern_id'])){?>
						<input type="hidden" name="entern_id" value="<?php echo $row['entern_id'] ?>">
					<?php } ?>
				  <div class="form-group">
					<label for="enternName">Entertainment Name: </label>
					<input type="text" class="form-control" id="enternName" name="enternName" value="<?php echo $row['enternName']; ?>" required>
				  </div>
				  <div class="form-group">
					<label for="type">Entertainment Type: </label>
					<input type="text" class="form-control" id="type" name="type" value="<?php echo $row['type']; ?>" required>
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
					<label for="enternAddress">Address: </label>
					<textarea type="text" class="form-control" rows="5" id="enternAddress" name="enternAddress" required><?php echo $row['enternAddress']; ?></textarea>
				  </div>
				  <div class="form-group">
					<label for="enternOperationHours">Operation Hours: </label></br>
					<label for="enternStartTime">Start Time: </label>
					<input type="time" class="form-control" id="enternStartTime" name="enternStartTime" value="<?php echo date('H:i:s', strtotime($row['enternStartTime'])); ?>" required></br>
					<label for="enternEndTime">End Time: </label>
					<input type="time" class="form-control" id="enternEndTime" name="enternEndTime" value="<?php echo date('H:i:s', strtotime($row['enternEndTime'])); ?>" required>
				  </div>
				  <div class="form-group">
					<label for="enternDescript">Description: </label>
					<textarea type="text" class="form-control" rows="5" id="enternDescript" name="enternDescript" required><?php echo $row['enternDescript']; ?></textarea>
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
<?php if(isset($row['town_id'])){?>
	$("#town_id").val("<?php echo $row['town_id']; ?>");
<?php } ?>
</script>
</html>