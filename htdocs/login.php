<?php
	session_start();
	//session_destroy();
	if(isset($_SESSION['user_id'])){
		header("Location: /index.php");exit;
	}
	if(isset($_SESSION['admin_id'])){
		header("Location: /admin/home.php");exit;
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
	html, body{
		margin: 0;
		background-color: #ededed;
		font-family: sans-serif;
	}
	h1, h2, h3, h4, h5, h6{
		font-weight: normal;
	}
	.header{
		padding: 10px 20px;
		background-color: #bab2b5;
	}
	.container{
		padding: 10px;
	}
	.form{
		margin: 0 25%;
		padding: 20px;
	}
	.form-field{
		text-align: left;
		margin: 15px 30px;
	}
	.form-input{
		border: 0;
		height: 35px;
		padding-left: 15px;
		width: 100%;
	}
	.form-field label{
		padding: 15px 0;
		display: block;
	}
	.button{
		border: 0;
		padding: 12px 40px;
		margin-top: 10px;
		margin-left: 20px;
		background-color: #bab2b5;
		font-size: 16px;
	}
	.sign_up{
		font-weight: bold;
		text-decoration: underline;
		color: #000;
	}
</style>
</head>
<body>
<div class="header grey-bg">
	<h1 align="center">Login</h1>
</div>
<div class="container">
	<form class="form" method="post" action="/php/reg.php">
		<div class="form-field">
			<label>Username</label>
			<input class="form-input" type="text" name="user_name" required />
		</div>
		<div class="form-field">
			<label>Password</label>
			<input class="form-input" type="password" name="pass_word" required />
		</div>
		<div class="form-field">
			<input class="button" type="submit" name="login" value="Login">
			<?php 
			if(isset($_COOKIE['error'])){
				echo "<span style='color: red;'>".$_COOKIE['error']."</span>";
				setcookie("error", "", time() - 3600, "/");
			} 
			if(isset($_COOKIE['register'])){
				echo "<span style='color: green;'>".$_COOKIE['register']."</span>";
				setcookie("register", "", time() - 3600, "/");
			}
			?>
		</div>
		<br>
		<div class="form-field">
			<span>No yet a member?</span>&nbsp;<a href="/sign_up.php" class="sign_up">Sign up</a>
		</div>
	</form>
</div>
</body>
<script src="/assets/js/jquery-3.3.1.js"></script>
</html>

