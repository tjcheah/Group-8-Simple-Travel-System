<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		header("Location: /login.php");exit;
	}
	require "php/user_db.php";
	$sql = "SELECT * FROM user_detail WHERE user_id = ".$_SESSION['user_id'];
	$user = mysqli_query($conn, $sql);

	$sql1 = "SELECT * FROM day WHERE user_id = ".$_SESSION['user_id'];
	$day = mysqli_query($conn, $sql1);

	$sql2 = "SELECT * FROM itinerary WHERE day_id = 1 AND user_id = ".$_SESSION['user_id'];
	$itinerary = mysqli_query($conn, $sql2); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Home</title>
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
		<a class="nav-link active" id="itinerary-tab" data-toggle="tab" href="#itinerary" role="tab" aria-controls="itinerary" aria-selected="true">
			<i class="fas fa-chart-bar fa-2x"></i><br>
			<b>Itinerary</b>
		</a>
	  </li>
	  <li class="nav-item col-md-4">
		<a class="nav-link" id="discover-tab" data-toggle="tab" href="#discover" role="tab" aria-controls="discover" aria-selected="false">
			<i class="fas fa-edit fa-2x"></i><br>
			<b>Discover</b>
		</a>
	  </li>
	  <li class="nav-item col-md-4">
		<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
			<i class="fas fa-users fa-2x"></i><br>
			<b>Profile</b>
		</a>
	  </li>
	</ul>
</nav>

<div class="container">
	<div class="tab-content" id="myTabContent">
		<div class="tab-pane fade show active" id="itinerary" role="tabpanel" aria-labelledby="itinerary-tab">
			<div class="row my-4">
				<div class="col-2 text-center">
					<div class="nav flex-column nav-pills" id="v-pills-tab1" aria-orientation="vertical" style="min-height:60vh;">
						<?php while($row = mysqli_fetch_array($day)){ ?>
						  <button class="nav-link day<?php echo $row['day_id']; ?> btn my-1" onclick="change_day(<?php echo $row['day_id']; ?>)">
							<span><?php echo $row['dayName']; ?></span>
						  </button>
						<?php } ?>
					</div>
					<a href="add_day.php" class="btn btn-success active my-1" role="button" aria-pressed="true">New Day</a>
					<a href="delete_day.php" class="btn btn-danger active my-1" role="button" aria-pressed="true">Delete Day</a>
			  </div>  
			  <div class="col-10">
					<div id="itinerary_list" class="list-group col-12">
						<?php while($row = mysqli_fetch_array($itinerary)){ ?>
							<a href="edit_itinerary.php?itinerary_id=<?php echo $row['itinerary_id'] ?>" class="list-group-item my-2 bg-light">
								<span class="my-4" style="float: right;"><?php echo $row['itineraryTime']; ?></span>
								<h4 class="my-4"><?php echo $row['itineraryName']; ?></h4>
								<p><?php echo $row['note']; ?></p>
							</a>
						<?php } ?>
					  </div>
			  </div>
		  </div>
		</div>
		<div class="tab-pane fade" id="discover" role="tabpanel" aria-labelledby="discover-tab">
			<input class="col-8 offset-2 py-2 my-4 search_town_bar" type="text" name="search" placeholder="Search Town Bar...." />
			<div class="row my-4">
			  <div class="col-2 text-center">
				<div class="nav flex-column nav-pills" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
				  <a class="nav-link active" id="v-pills-entertainment-tab" data-toggle="pill" href="#v-pills-entertainment" role="tab" aria-controls="v-pills-entertainment" aria-selected="false">
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
					<div class="tab-content" id="town_bar_list">
				  </div>
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
			<div class="row">
				<div class="ml-2 mr-5 my-5 pt-5 col-2">
					<i class="fas fa-user fa-6x mb-3 mt-3 p-4 bg-light" style="border: 1px solid grey"></i>
					<a href="/php/logout.php" onclick="return confirm('Do you want to logout?');" class="btn btn-danger active m-4" role="button" aria-pressed="true">
						Logout
					</a>
				</div>
				<div class="my-5 col-8">
					<?php $row = mysqli_fetch_array($user); ?>
<<<<<<< HEAD
					<?php
						include("config.php");

						if(!empty('file') && isset($_POST['but_upload'])){
							$name = $_FILES['file']['name'];
							$target_dir = "upload/";
							$target_file = $target_dir . basename($_FILES["file"]["name"]);
							// Select file type
							$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
							// Valid file extensions
							$extensions_arr = array("jpg","jpeg","png","gif");
							// Check extension
							if( in_array($imageFileType,$extensions_arr) ){
								// Convert to base64 
								$image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
								$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
								// Insert record
								$id = $row['user_id'];
								$query = "update user_detail set images = '".$image."' where user_id = '".$id."' ";
								mysqli_query($con,$query);
							}
						} 
					?>

					<form method="post" action="" enctype='multipart/form-data'>
					<input type='file' name='file' />
					<input type='submit' value='Save name' name='but_upload'>
					</form>
					
=======
>>>>>>> main
					<form method="POST" action="/php/update_user.php">
					  <div class="form-group">
						<label for="user_id">UserID: </label>
						<input type="text" class="form-control" value="<?php echo $row['user_id']; ?>" disabled readonly>
					  </div>
					  <div class="form-group">
						<label for="user_name">Username: </label>
						<input type="text" class="form-control" value="<?php echo $row['user_name']; ?>" disabled readonly>
					  </div>
					  <div class="form-group">
						<label for="real_name">Name: </label>
						<input type="text" class="form-control" value="<?php echo $row['real_name']; ?>"disabled readonly>
					  </div>
					  <div class="form-group">
						<label for="pass_word">Password: </label>
						<input type="password" class="form-control" id="pass_word" name="pass_word" value="<?php echo $row['pass_word']; ?>" required>
					  </div>
					  <div class="form-group">
						<label for="email">Email: </label>
						<input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
					  </div>
					  <div class="form-group">
						<label for="phoneNum">Phone Number: </label>
						<input type="tel" class="form-control" id="phoneNum" name="phoneNum" value="<?php echo $row['phoneNum']; ?>" required>
					  </div>
					  <div class="text-right">
						<input type="hidden" class="form-control" id="user_id" name="user_id" value="<?php echo $row['user_id']; ?>">
						  <button type="submit" class="btn btn-primary col-2">Update</button>
					  </div>
					</form>
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
var url = window.location.href;
var activeTab = url.substring(url.indexOf("#") + 1);
var now = window.location.origin+window.location.pathname;
if(activeTab != now){
	$("#" + activeTab).addClass("active");
	$('a[href="#'+ activeTab +'"]').tab('show');
}
var active = $("#v-pills-tab1 .day1");
active.addClass("btn-primary");

function change_day(day_id){
	$.ajax({
		url: "/php/search_itinerary.php",
		method: "POST",
		data: {
			id: day_id
		},
		success: function(data){
			$('#itinerary_list').html(data);
			active.removeClass("btn-primary");
			active = $("#v-pills-tab1 .day"+day_id);
			active.addClass("btn-primary");
		}
	});
}

$(".search_town_bar").keyup(function(){
	var search_town_bar_data = $(this).val().trim() //replace is added to remove empty space (JackNa0928)
	$.ajax({
		url: "/php/search_town_bar.php",
		method: "POST",
		data: {
			data: search_town_bar_data //replace is added to remove empty space (JackNa0928)
		},
		success: function(data){
			$('#town_bar_list').html(data);
		}
	});
});
</script>
</html>
