<?php
	if(isset($_COOKIE['error'])){
		$data = unserialize($_COOKIE['error']);
		setcookie("error", "", time() - 3600, "/");
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
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
	.link{
		font-weight: bold;
		text-decoration: underline;
		color: #000;
	}
</style>
</head>
<body>
<div class="header grey-bg">
	<h1 align="center">Register</h1>
</div>
<div class="container">
	<form class="form" method="post" action="/php/reg.php">
		<div class="form-field">
			<label>Username</label>
			<input class="form-input" type="text" name="user_name" required />
			<small class="form-text text-muted">
			<?php
				if(isset($data['user_name'])){
					echo "<span class='text-danger'>".$data['user_name']."</span>";
				}
			?>
			</small>
		</div>
		<div class="form-field">
			<label>Password</label>
			<input class="form-input" type="password" name="pass_word" required />
			<small class="form-text text-muted">
			<?php
				if(isset($data['pass_word'])){
					echo "<span class='text-danger'>".$data['pass_word']."</span>";
				}
			?>
			</small>
		</div>
		<div class="form-field">
			<label>Confirm Password</label>
			<input class="form-input" type="password" name="cpass_word" required />
		</div>
		<div class="form-field">
			<label>Name</label>
			<input class="form-input" type="text" name="real_name" required />
		</div>
		<div class="form-field">
			<label>Email</label>
			<input class="form-input" type="email" name="email" required />
		</div>
		<div class="form-field">
			<label>Phone Number</label>
			<input class="form-input" type="tel" name="phoneNum" required />
		</div>
		<p>By clicking Register, you agree to our <a href="Terms and Conditions.php">Terms and Conditions</a>. </p>
		<div class="form-field">
			<input class="button" type="submit" name="register" value="Register">
		</div>
		<br>
		<div class="form-field">
			<span>Already a member?</span>&nbsp;<a href="/login.php" class="link">Sign in</a>
		</div>
	</form>
</div>
</body>
<script src="/assets/js/jquery.js"></script>
</html>