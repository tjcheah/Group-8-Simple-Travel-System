<?php
	session_start();
	if(!isset($_SESSION['admin_id'])){
		header("Location: /login.php");exit;
	}
	require "../php/user_db.php";
	if($_GET){

		$sql = "SELECT * FROM user_detail WHERE user_id = '".$_GET['id']."'";
		$user = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($user);
		$title = "Update User";
	} else{
		$row['user_id'] = "";
		$row['user_name'] = "";
		$row['pass_word'] = "";
		$row['real_name'] = "";
		$row['email'] = "";
		$row['phoneNum'] = "";
		$title = "Add User";
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
		<a class="nav-link" href="/admin/home.php#edit">
			<i class="fas fa-edit fa-2x"></i><br>
			<b>Edit</b>
		</a>
	  </li>
	  <li class="nav-item col-md-4">
		<a class="nav-link active" href="/admin/home.php#profile">
			<i class="fas fa-users fa-2x"></i><br>
			<b>View User's Profile</b>
		</a>
	  </li>
	</ul>
</nav>
<div class="container">
	<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
		<div class="row my-4">
		  <div class="col-10">
			<div class="tab-content" id="v-pills-tabContent">
			  <div class="tab-pane fade show active" id="v-pills-town" role="tabpanel" aria-labelledby="v-pills-town-tab">
				<?php if(isset($_GET['id'])){?>
					<a href="/php/delete_user.php?user_id=<?php echo $_GET['id']; ?>" onclick="return confirm('Do you want to delete this user?');" class="btn btn-danger" style="float: right;">Delete User</a>
				<?php } ?>
				<h2><?php echo $title; ?></h2>
				<form method="POST" action="../php/update_user.php">
					<?php if(isset($_GET['id'])){?>
						<input type="hidden" name="old_user_id" value="<?php echo $_GET['id'] ?>">
					<?php } ?>
				  <div class="form-group">
					<label for="user_id">UserID: </label>
					<input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $row['user_id']; ?>" required>
				  </div>
				  <div class="form-group">
					<label for="user_name">Username: </label>
					<input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $row['user_name']; ?>" required>
				  </div>
				  <div class="form-group">
					<label for="real_name">Name: </label>
					<input type="text" class="form-control" id="real_name" name="real_name" value="<?php echo $row['real_name']; ?>" required>
				  </div>
				  <div class="form-group">
					<label for="pass_word">Password: </label>
					<input type="text" class="form-control" id="pass_word" name="pass_word" value="<?php echo $row['pass_word']; ?>" required>
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
					  <button type="submit" class="btn btn-primary col-1 mr-2">Save</button>
					  <a href="/admin/home.php#profile" class="btn btn-light col-1">Back</a>
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