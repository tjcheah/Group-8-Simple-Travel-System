<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: /login.php");exit;
	}
	require "php/user_db.php";
	
	if(isset($_GET['db'])){
		
		if($_GET['db'] == "entertainment"){
			$sql = "SELECT * FROM ".$_GET['db']." WHERE town_id = ".$_GET['town_id']." AND entern_id = ".$_GET['entern_id'];
			$itinerary = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($itinerary);
			$name = "enternName";
		} else if ($_GET['db'] == "restaurant"){
			$sql = "SELECT * FROM ".$_GET['db']." WHERE town_id = ".$_GET['town_id']." AND restaurant_id = ".$_GET['restaurant_id'];
			$itinerary = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($itinerary);
			$name = "restaurantName";
		}else if ($_GET['db'] == "hotel"){
			$sql = "SELECT * FROM ".$_GET['db']." WHERE town_id = ".$_GET['town_id']." AND hotel_id = ".$_GET['hotel_id'];
			$itinerary = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($itinerary);
			$name = "hotelName";
		}else{
			$sql = "SELECT * FROM ".$_GET['db']." WHERE town_id = ".$_GET['town_id']." AND event_id = ".$_GET['event_id'];
			$itinerary = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($itinerary);
			$name = "eventName";
		}
		if($_GET['db'] != 'event'){
			$row['note'] = "";
		}
		$row['day_id'] = "";
		$title = "Add Itinerary";
	} else{
		$sql = "SELECT * FROM itinerary WHERE itinerary_id = ".$_GET['itinerary_id'];
		$itinerary = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($itinerary);
		$name= "itineraryName";
		$title = "Update Itinerary";
	}
	
	$sql = "SELECT * FROM day WHERE user_id = ".$_SESSION['user_id'];
	$day = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $title; ?></title>
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
			  <div class="tab-pane fade show active" id="v-pills-itinerary" role="tabpanel" aria-labelledby="v-pills-itinerary-tab">
				<?php if(isset($_GET['itinerary_id'])){?>
					<a href="/php/delete_itinerary.php?itinerary_id=<?php echo $_GET['itinerary_id']; ?>" onclick="return confirm('Do you want to delete this itinerary?');" class="btn btn-danger" style="float: right;">Delete Itinerary</a>
				<?php } ?>
				<?php if(isset($_GET['itineraryTime'])){?>
					<input type="hidden" name="itineraryTime" value="<?php echo $_GET['itineraryTime']; ?>">
				<?php } ?>
				<?php if(isset($_GET['note'])){?>
					<input type="hidden" name="note" value="<?php echo $_GET['note']; ?>">
				<?php } ?>
				<h2><?php echo $title; ?></h2>
				<form method="POST" action="/php/update_itinerary.php">
					<?php if(isset($_GET['db'])){?>
						<input type="hidden" name="data" value="<?php echo $_GET['db'] ?>">
					<?php } else{ ?>
						<input type="hidden" name="itinerary_id" value="<?php echo $_GET['itinerary_id'] ?>">
					<?php } ?>
				  <div class="form-group">
					<label for="itineraryName">Itinerary Name: </label>
					<input type="text" class="form-control" id="itineraryName" name="itineraryName" value="<?php echo $row[$name]; ?>" readonly>
				  </div>
				  <div class="form-group">
					<label for="itineraryTime">Day: </label>
					<select class="form-control" id="day_id" name="day_id">
						<?php while($row2 = mysqli_fetch_array($day)){ ?>
							<option value="<?php echo $row2['day_id']; ?>" <?php if($row2['day_id'] == $row['day_id']) echo "selected"; ?>><?php echo $row2['dayName']; ?></option>
						<?php } ?>
					</select>
				  </div>
				  <div class="form-group">
					<label for="itineraryTime">Time: </label>
					<select class="form-control" id="itineraryTime" name="itineraryTime" <?php if(isset($row['time'])) echo "disabled"; ?>>
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
					<label for="note">Notes: </label>
					<textarea type="text" class="form-control" rows="5" id="note" name="note" required <?php if(isset($row['time'])) echo "disabled"; ?>><?php echo $row['note']; ?></textarea>
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
<?php if(isset($row['itineraryTime'])){?>
	$("#itineraryTime").val("<?php echo $row['itineraryTime']; ?>");
<?php } ?>
<?php if(isset($row['time'])){?>
	$("#itineraryTime").val("<?php echo $row['time']; ?>");
<?php } ?>
</script>
</html>
