<?php
	session_start();
	if(!isset($_SESSION['admin_id'])){
		header("Location: /login.php");exit;
	}
	require "../php/user_db.php";

	$sql = "SELECT * FROM user_detail WHERE 1";
	$user = mysqli_query($conn, $sql);
	$num_user = mysqli_num_rows($user);

	$sql2 = "SELECT * FROM town WHERE 1";
	$town = mysqli_query($conn, $sql2);

	$sql3 = "SELECT * FROM entertainment WHERE 1";
	$entertainment = mysqli_query($conn, $sql3);

	$sql4 = "SELECT * FROM restaurant WHERE 1";
	$restaurant = mysqli_query($conn, $sql4);
	
	$sql5 = "SELECT * FROM hotel WHERE 1";
	$accommodation = mysqli_query($conn, $sql5);

	$sql6 = "SELECT * FROM event WHERE 1";
	$event = mysqli_query($conn, $sql6);
?>
<!DOCTYPE html>
<html>
<head>
<title>Home - Admin</title>
<link type="text/css" rel="stylesheet" href="/assets/css/bootstrap.css" />
<link type="text/css" rel="stylesheet" href="/assets/css/fontawesome.min.css" />
<link type="text/css" rel="stylesheet" href="/assets/css/solid.min.css" />
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
		<a class="nav-link active" id="statistic-tab" data-toggle="tab" href="#statistic" role="tab" aria-controls="statistic" aria-selected="true">
			<i class="fas fa-chart-bar fa-2x"></i><br>
			<b>Statistic</b>
		</a>
	  </li>
	  <li class="nav-item col-md-4">
		<a class="nav-link" id="edit-tab" data-toggle="tab" href="#edit" role="tab" aria-controls="edit" aria-selected="false">
			<i class="fas fa-edit fa-2x"></i><br>
			<b>Edit</b>
		</a>
	  </li>
	  <li class="nav-item col-md-4">
		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
			<i class="fas fa-users fa-2x"></i><br>
			<b>View User's Profile</b>
		</a>
	  </li>
	</ul>
</nav>

<div class="container">
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="statistic" role="tabpanel" aria-labelledby="statistic-tab">
			<div id="chart-container" class="col-12">
				<canvas id="graphCanvas"></canvas>
			</div>
			<span>Number of the user using this program: <?php echo $num_user; ?></span>
		</div>
		<div class="tab-pane fade" id="edit" role="tabpanel" aria-labelledby="edit-tab">
			<div class="row my-4">
			  <div class="col-2 text-center">
				<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				  <a class="nav-link active" id="v-pills-town-tab" data-toggle="pill" href="#v-pills-town" role="tab" aria-controls="v-pills-town" aria-selected="true">
					<i class="fas fa-home fa-2x"></i><br>
					<span>Town</span>
				  </a>
				  <a class="nav-link" id="v-pills-entertainment-tab" data-toggle="pill" href="#v-pills-entertainment" role="tab" aria-controls="v-pills-entertainment" aria-selected="false">
					<i class="fas fa-basketball-ball"></i><br>
					<span>Entertainment</span>
				  </a>
				  <a class="nav-link" id="v-pills-restaurant-tab" data-toggle="pill" href="#v-pills-restaurant" role="tab" aria-controls="v-pills-restaurant" aria-selected="false">
					<i class="fas fa-utensils"></i><br>
					<span>Restaurant</span>
				  </a>
				  <a class="nav-link" id="v-pills-accommodation-tab" data-toggle="pill" href="#v-pills-accommodation" role="tab" aria-controls="v-pills-accommodation" aria-selected="false">
					<i class="fas fa-hotel"></i><br>
					<span>Accommodation</span>
				  </a>
				  <a class="nav-link" id="v-pills-package-tab" data-toggle="pill" href="#v-pills-package" role="tab" aria-controls="v-pills-package" aria-selected="false">
					<i class="fas fa-calendar-alt"></i><br>
					<span>Package</span>
				  </a>
				</div>
			  </div>
			  <div class="col-10">
				<div class="tab-content" id="v-pills-tabContent">
				  <div class="tab-pane fade show active" id="v-pills-town" role="tabpanel" aria-labelledby="v-pills-town-tab">
					<a href="/admin/edit_town.php" class="btn btn-light active mx-3" role="button" aria-pressed="true">
						<i class="fas fa-plus"></i> New Town
					</a>
					<input class="col-8 py-2 my-4 search_town" type="text" name="search" placeholder="Search Town" />
					<div id="town_list" class="list-group col-12">
						<?php while($row = mysqli_fetch_array($town)){ ?>
							<div class="list-group-item my-2 bg-light">
								<span class="my-4">Town Name: <?php echo $row['town_name'] ?></span>
								<div style="float: right">
									<a href="/admin/edit_town.php?id=<?php echo $row['town_id'] ?>" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Town</a>
									<a href="#edit" onclick="delete_town(<?php echo $row['town_id'] ?>)" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Town</a>
								</div>
							</div>
						<?php } ?>
					</div>
				  </div>
				  <div class="tab-pane fade" id="v-pills-entertainment" role="tabpanel" aria-labelledby="v-pills-entertainment-tab">
					<a href="/admin/edit_entertainment.php" class="btn btn-light active mx-3" role="button" aria-pressed="true">
						<i class="fas fa-plus"></i> New Entertainment
					</a>
					<input class="col-8 py-2 my-4 search_entern" type="text" name="search" placeholder="Search Entertainment" />
					<div id="entern_list" class="list-group col-12">
						<?php while($row = mysqli_fetch_array($entertainment)){ ?>
							<div class="list-group-item my-2 bg-light">
								<span class="my-4">Entertainment Name: <?php echo $row['enternName'] ?></span>
								<div style="float: right">
									<a href="/admin/edit_entertainment.php?id=<?php echo $row['entern_id'] ?>" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Entertainment</a>
									<a href="#edit" onclick="delete_entern(<?php echo $row['entern_id'] ?>)" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Entertainment</a>
								</div>
							</div>
						<?php } ?>
					</div>
				  </div>
				  <div class="tab-pane fade" id="v-pills-restaurant" role="tabpanel" aria-labelledby="v-pills-restaurant-tab">
					<a href="/admin/edit_restaurant.php" class="btn btn-light active mx-3" role="button" aria-pressed="true">
						<i class="fas fa-plus"></i> New Restaurant
					</a>
					<input class="col-8 py-2 my-4 search_restaurant" type="text" name="search" placeholder="Search Restaurant" />
					<div id="restaurant_list" class="list-group col-12">
						<?php while($row = mysqli_fetch_array($restaurant)){ ?>
							<div class="list-group-item my-2 bg-light">
								<span class="my-4">Restaurant Name: <?php echo $row['restaurantName'] ?></span>
								<div style="float: right">
									<a href="/admin/edit_restaurant.php?id=<?php echo $row['restaurant_id'] ?>" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Restaurant</a>
									<a href="#edit" onclick="delete_restaurant(<?php echo $row['restaurant_id'] ?>)" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Restaurant</a>
								</div>
							</div>
						<?php } ?>
					</div>
				  </div>
				  <div class="tab-pane fade" id="v-pills-accommodation" role="tabpanel" aria-labelledby="v-pills-accommodation-tab">
					<a href="/admin/edit_accommodation.php" class="btn btn-light active mx-3" role="button" aria-pressed="true">
						<i class="fas fa-plus"></i> New Accommodation
					</a>
					<input class="col-8 py-2 my-4 search_accommodation" type="text" name="search" placeholder="Search Accommodation" />
					<div id="accommodation_list" class="list-group col-12">
						<?php while($row = mysqli_fetch_array($accommodation)){ ?>
							<div class="list-group-item my-2 bg-light">
								<span class="my-4">Accommodation Name: <?php echo $row['hotelName'] ?></span>
								<div style="float: right">
									<a href="/admin/edit_accommodation.php?id=<?php echo $row['hotel_id'] ?>" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Accommodation</a>
									<a href="#edit" onclick="delete_accommodation(<?php echo $row['hotel_id'] ?>)" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Accommodation</a>
								</div>
							</div>
						<?php } ?>
					</div>
				  </div>
				  <div class="tab-pane fade" id="v-pills-package" role="tabpanel" aria-labelledby="v-pills-package-tab">
					<a href="/admin/edit_package.php" class="btn btn-light active mx-3" role="button" aria-pressed="true">
						<i class="fas fa-plus"></i> New Package
					</a>
					<input class="col-8 py-2 my-4 search_event"text" name="search" placeholder="Search Package" />
					<div id="package_list" class="list-group col-12">
						<?php while($row = mysqli_fetch_array($event)){ ?>
							<div class="list-group-item my-2 bg-light">
								<span class="my-4">Package Name: <?php echo $row['eventName'] ?></span>
								<div style="float: right">
									<a href="/admin/edit_package.php?id=<?php echo $row['event_id'] ?>" class="btn btn-info active mx-3" role="button" aria-pressed="true">Update Package</a>
									<a href="#edit" onclick="delete_package(<?php echo $row['event_id'] ?>)" class="btn btn-danger active mx-3" role="button" aria-pressed="true">Delete Package</a>
								</div>
							</div>
						<?php } ?>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
			<a href="/admin/edit_user.php" class="btn btn-light active mx-3" role="button" aria-pressed="true">
				<i class="fas fa-plus"></i> New User
			</a>
			<input class="col-md-8 py-2 my-4 search_user" type="text" name="search" placeholder="Search User" />
			<div id="user_list" class="list-group">
				<?php while($row = mysqli_fetch_array($user)){ ?>
					<a href="/admin/edit_user?id=<?php echo $row['user_id']; ?>" class="list-group-item my-2">
						<div class="ml-2 mr-5 my-3" style="float: left;">
							<i class="fas fa-user fa-3x"></i>
						</div>
						<div class="mx-5">
							<span>UserID: <?php echo $row['user_id']; ?></span><br>
							<span>Username: <?php echo $row['user_name']; ?></span><br>
							<span>Name: <?php echo $row['real_name']; ?></span>
						</div>
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<a href="/php/logout.php" onclick="return confirm('Do you want to logout?');" class="btn btn-danger active m-5" role="button" aria-pressed="true" style="position: absolute; bottom: 0; right: 0;">
	Logout
</a>
</body>
<script src="/assets/js/jquery-3.3.1.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/solid.min.js"></script>
<script src="/assets/js/chart.min.js"></script>
<script>
var url = window.location.href;
var activeTab = url.substring(url.indexOf("#") + 1);
var now = window.location.origin+window.location.pathname;
if(activeTab != now){
	$("#" + activeTab).addClass("active");
	$('a[href="#'+ activeTab +'"]').tab('show');
}
	$(".search_town").keyup(function(){
		$.ajax({
			url: "/php/search_town.php",
			method: "POST",
			data: {
				data: $(this).val(),
				db: "town"
			},
			success: function(data){
				$('#town_list').html(data);
			}
		});
	});
	$(".search_entern").keyup(function(){
		$.ajax({
			url: "/php/search_entern.php",
			method: "POST",
			data: {
				data: $(this).val()
			},
			success: function(data){
				$('#entern_list').html(data);
			}
		});
	});
	$(".search_restaurant").keyup(function(){
		$.ajax({
			url: "/php/search_restaurant.php",
			method: "POST",
			data: {
				data: $(this).val()
			},
			success: function(data){
				$('#restaurant_list').html(data);
			}
		});
	});
	$(".search_accommodation").keyup(function(){
		$.ajax({
			url: "/php/search_accommodation.php",
			method: "POST",
			data: {
				data: $(this).val()
			},
			success: function(data){
				$('#accommodation_list').html(data);
			}
		});
	});
	$(".search_event").keyup(function(){
		$.ajax({
			url: "/php/search_event.php",
			method: "POST",
			data: {
				data: $(this).val()
			},
			success: function(data){
				$('#package_list').html(data);
			}
		});
	});
	$(".search_user").keyup(function(){
		$.ajax({
			url: "/php/search_user.php",
			method: "POST",
			data: {
				id: $(this).val()
			},
			success: function(data){
				$('#user_list').html(data);
			}
		});
	});
	function delete_town(id){
		$del = confirm("Do you want to delete this town?");
		if($del){
			event.preventDefault();
			$.ajax({
				url: "/php/delete_town.php",
				method: "POST",
				data: {
					id: id
				},
				success: function(data){
					$('#town_list').html(data);
					alert("Delete Successful");
				}
			});
		}
	}
	function delete_entern(id){
		$del = confirm("Do you want to delete this entertainment?");
		if($del){
			event.preventDefault();
			$.ajax({
				url: "/php/delete_entern.php",
				method: "POST",
				data: {
					id: id
				},
				success: function(data){
					$('#entern_list').html(data);
					alert("Delete Successful");
				}
			});
		}
	}
	function delete_restaurant(id){
		$del = confirm("Do you want to delete this restaurant?");
		if($del){
			event.preventDefault();
			$.ajax({
				url: "/php/delete_restaurant.php",
				method: "POST",
				data: {
					id: id
				},
				success: function(data){
					$('#restaurant_list').html(data);
					alert("Delete Successful");
				}
			});
		}
	}
	function delete_accommodation(id){
		$del = confirm("Do you want to delete this accommodation?");
		if($del){
			event.preventDefault();
			$.ajax({
				url: "/php/delete_accommodation.php",
				method: "POST",
				data: {
					id: id
				},
				success: function(data){
					$('#accommodation_list').html(data);
					alert("Delete Successful");
				}
			});
		}
	}
	function delete_package(id){
		$del = confirm("Do you want to delete this package?");
		if($del){
			event.preventDefault();
			$.ajax({
				url: "/php/delete_package.php",
				method: "POST",
				data: {
					id: id
				},
				success: function(data){
					$('#package_list').html(data);
					alert("Delete Successful");
				}
			});
		}
	}
	
	$(document).ready(function () {
		show_chart();
	});


	function show_chart()
	{
		{
			$.post("/php/show_chart.php",
			function (data)
			{
				data = jQuery.parseJSON(data);
				console.log(data);
				 var name = [];
				var num = [];
				
				for (var i in data) {
					name.push(data[i].date);
					num.push(data[i].num);
				}

				var chartdata = {
					labels: name,
					datasets: [
						{
							label: 'Number of user',
							backgroundColor: '#49e2ff',
							borderColor: '#46d5f1',
							hoverBackgroundColor: '#CCCCCC',
							hoverBorderColor: '#666666',
							data: num
						}
					]
				};

				var graphTarget = $("#graphCanvas");

				var barGraph = new Chart(graphTarget, {
					type: 'bar',
					data: chartdata
				});
			});
		}
	}
</script>
</html>