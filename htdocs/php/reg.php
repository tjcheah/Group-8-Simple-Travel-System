<?php
	if (isset($_POST['register'])) {
		register();
	}
	if (isset($_POST['login'])) {
		login();
	}

	function register(){
		require "user_db.php";
		$previous = "javascript:history.go(-1)";
		if(isset($_SERVER['HTTP_REFERER'])) {
			$previous = $_SERVER['HTTP_REFERER'];
		}
		
		$sql = "SELECT * FROM user_detail WHERE user_name = '".$_POST['user_name']."'";
		$user = mysqli_query($conn, $sql);
		if(mysqli_num_rows($user) > 0){
			$error['user_name'] = "Username already exist";
		}
		
		if($_POST['pass_word'] != $_POST['cpass_word']){
			$error['pass_word'] = "Password Not Match";
		}
		if(!empty($error)){
			setcookie("error", serialize($error), time() + 3600, "/");
			header("Location: ".$previous);exit;
		} else{
			$sql2 = "INSERT INTO `user_detail`(`user_name`,`real_name`,`pass_word`,`email`,`phoneNum`) VALUES ('".$_POST['user_name']."', '".$_POST['real_name']."', '".$_POST['pass_word']."', '".$_POST['email']."', '".$_POST['phoneNum']."')";
			$r = mysqli_query($conn, $sql2);
			setcookie("register", "Register Successful", time() + 3600, "/");
			header("Location: /login.php");exit;
		}
	}
	function login(){
		require "user_db.php";
		$sql = "SELECT * FROM user_detail WHERE user_name = '".$_POST['user_name']."' AND pass_word = '".$_POST['pass_word']."'";
		$user = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($user);
		if($row){
			session_start();
			$_SESSION["user_id"] = $row['user_id'];
			header("Location: /index.php");exit;
		} else{
			$sql = "SELECT * FROM admin WHERE admin_name = '".$_POST['user_name']."' AND pass_word = '".$_POST['pass_word']."'";
			$admin = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($admin);
			if($row){
				session_start();
				$_SESSION["admin_id"] = $row['admin_id'];
				header("Location: /admin/home.php");exit;
			} else{
				setcookie("error", "Username or password error", time()+3600, "/");
				header("Location: /login.php");
			}
		}
	}

	
	session_start();
	
if(!empty($_POST["login"])) {
	$conn = mysqli_connect("localhost", "user_name", "pass_word", "database");
	$sql = "SELECT * FROM user_detail WHERE user_name = '".$_POST['user_name']."' AND pass_word = '".$_POST['pass_word']."'";
		$user = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($user);
        if(!isset($_COOKIE["login"])) {
            $sql .= " AND pass_word = '" . md5($_POST["pass_word"]) . "'";
	}
        $result = mysqli_query($conn,$sql);
	$user = mysqli_fetch_array($result);
	
	if($user) {
			$_SESSION["user_id"] = $user["user_id"];
			
			if(!empty($_POST["remember"])) {
				setcookie ("login",$_POST["user_name"],time()+ 3600, "/");
				setcookie ("login_password",$_POST["pass_word"],time()+ 3600, "/");
			} else {
				if(isset($_COOKIE["login"])) {
					setcookie ("login","");
					setcookie ("login_password","");
				}
			}
	} else {
		$message = "Invalid Login";
	}
	
}
?>

?>

