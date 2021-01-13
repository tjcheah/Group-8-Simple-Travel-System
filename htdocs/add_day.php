<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: /login.php");exit;
	}
	require "php/user_db.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Day</title>
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
		<a class="nav-link" href="/index.php#itinerary">
			<i class="fas fa-chart-bar fa-2x"></i><br>
			<b>Itinerary</b>
		</a>
	  </li>
	  <li class="nav-item col-md-4">
		<a class="nav-link active" href="/index.php#discover">
			<i class="fas fa-edit fa-2x"></i><br>
			<b>Discover</b>
		</a>
	  </li>
	  <li class="nav-item col-md-4">
		<a class="nav-link" href="/index.php#profile">
			<i class="fas fa-users fa-2x"></i><br>
			<b>Profile</b>
		</a>
	  </li>
	</ul>
</nav>

<div class="container">
	<div class="tab-pane fade show active" id="itinerary" role="tabpanel" aria-labelledby="itinerary-tab">
		<div class="row my-4">
		  <div class="col-10">
			<div class="tab-content" id="v-pills-tabContent">
			  <div class="tab-pane fade show active" id="v-pills-day" role="tabpanel" aria-labelledby="v-pills-day-tab">
				<h2>Add Day</h2>
				<form method="POST" action="/php/add_day.php">
				  <div class="form-group">
					<label for="dayName">Day Name: </label>
					<input type="text" class="form-control" id="dayName" name="dayName" required>
				  </div>
				  <div class="text-right">
					  <button type="submit" class="btn btn-primary col-1 mr-2">Save</button>
					  <a href="/index.php#itinerary" class="btn btn-light col-1">Back</a>
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