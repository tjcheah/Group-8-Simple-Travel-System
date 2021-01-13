<?php
	session_start();
	if(!isset($_SESSION['admin_id'])){
		header("Location: /login.php");exit;
	}
	require "../php/user_db.php";
	if($_GET){
		$sql = "SELECT * FROM town WHERE town_id = ".$_GET['id'];
		$town = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($town);
		$title = "Update Town";
	} else{
		$row['town_name'] = "";
		$row['town_description'] = "";
		$title = "Add Town";
	}
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
			  <div class="tab-pane fade show active" id="v-pills-town" role="tabpanel" aria-labelledby="v-pills-town-tab">
				<h2><?php echo $title; ?></h2>
				<form method="POST" action="../php/update_town.php">
					<?php if(isset($row['town_id'])){?>
						<input type="hidden" name="town_id" value="<?php echo $row['town_id'] ?>">
					<?php } ?>
				  <div class="form-group">
					<label for="town_name">Town Name: </label>
					<input type="text" class="form-control" id="town_name" name="town_name" value="<?php echo $row['town_name']; ?>">
				  </div>
				  <div class="form-group">
					<label for="town_description">Description: </label>
					<textarea type="text" class="form-control" rows="5" id="town_description" name="town_description"><?php echo $row['town_description']; ?></textarea>
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
</html>