<?php
	require "user_db.php";
	
	if($_POST){
		session_start();
		if(isset($_SESSION['admin_id'])){
			if(isset($_POST['old_user_id'])){
				$sql = "UPDATE `user_detail` SET `user_id` = '".$_POST['user_id']."', `user_name` = '".$_POST['user_name']."', `real_name` = '".$_POST['real_name']."', `email` = '".$_POST['email']."', `phoneNum` = '".$_POST['phoneNum']."' WHERE `user_id` = '".$_POST['old_user_id']."'";
				$r = mysqli_query($conn, $sql);
				if($r == false){
					$previous = "javascript:history.go(-1)";
					if(isset($_SERVER['HTTP_REFERER'])) {
						$previous = $_SERVER['HTTP_REFERER'];
					}
					header("Location: ".$previous);exit;
				}
			} else{
				$sql = "INSERT INTO `user_detail`(`user_id`,`user_name`,`real_name`,`pass_word`,`email`,`phoneNum`) VALUES ('".$_POST['user_id']."', '".$_POST['user_name']."', '".$_POST['real_name']."', '".$_POST['pass_word']."', '".$_POST['email']."', '".$_POST['phoneNum']."')";
				mysqli_query($conn, $sql);
			}
			header("Location: /admin/home.php#profile");exit;
		}
		if(isset($_SESSION['user_id'])){
			$sql = "UPDATE `user_detail` SET `pass_word` = '".$_POST['pass_word']."', `email` = '".$_POST['email']."', `phoneNum` = '".$_POST['phoneNum']."' WHERE `user_id` = '".$_POST['user_id']."'";
			$r = mysqli_query($conn, $sql);
			if($r == false){
				$previous = "javascript:history.go(-1)";
				if(isset($_SERVER['HTTP_REFERER'])) {
					$previous = $_SERVER['HTTP_REFERER'];
				}
				header("Location: ".$previous);exit;
			}
			header("Location: /index.php#profile");
		}
	}
?>