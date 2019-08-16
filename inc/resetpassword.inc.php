<?php 
	include_once 'db.inc.php';
	include_once '../adminpanel/mail/phpmailer/mail.php';

	session_start();
	if (!isset($_POST["submit"])) {
		header('Location: ../forgotpassword.php');
		exit();
	}

	$email = $_POST['email'];

	if (empty($email)) {
		header('Location: ../forgotpassword.php?fieldempty');
		exit();
	}

	$sql = "SELECT libuser_id from `libuser` where libuser_email = '$email'";
	
	

	$result = $conn->query($sql);
	$data = $result->fetch_assoc();

	if($result->num_rows  === 0){
		$_SESSION['errormsg'] = 'خطأ في البريد الإلكتروني';
		header('Location: ../forgotpassword.php');
		exit();
	}


	$userid = $data["libuser_id"];


	$sql = "SELECT * from `account` where libuser_id =".$userid;

	$result = $conn->query($sql);
	if($result->num_rows  === 0){
		header('Location: ../forgotpassword.php');
		exit();
	}


	$password = substr(md5(date('Y-m-d H:i:s')),0,16);

	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	$sql ="
		update account 
		set account_password = '".$hashed_password."'
		where libuser_id = ".$userid;

	$conn->query($sql);
	sendMail($_POST['email']."",$password."");
	
	header('Location: ../login.php?ok');
