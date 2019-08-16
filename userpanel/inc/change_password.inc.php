<?php 
	include_once '../../inc/db.inc.php';
	session_start();
	$oldpassword = $_POST['oldpassword'];
	$newpassword  = $_POST['new'];

	if (empty($oldpassword) || empty($newpassword)) {
		header('Location: ../userinfo_passwd.php?fieldempty');
		$_SESSION['errormsg'] = 'fields empty';
		exit();
	}

	$sql = "SELECT * from `account` where account_name = ?";

	if ($stmt = $conn->prepare($sql)) {
		$stmt->bind_param('s',$_SESSION['accountname']);
		$stmt->execute();
	}else {
	    $error = $conn->errno . ' ' . $conn->error;
	    $_SESSION['errormsg'] = 'error';
	    header('Location: ../userinfo_passwd.php?error1');
		exit();
	}
	$result = $stmt->get_result();
	$data = $result->fetch_assoc();


	if(!password_verify($oldpassword, $data['account_password'])) {
		$_SESSION['errormsg'] = 'password incorrect';
		header('Location: ../userinfo_passwd.php?incorrectpassword');	
		exit();
	}

	$sql = "update account set account_password = ? where account_name = ?";

	$hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

	if ($stmt = $conn->prepare($sql)) {
		$stmt->bind_param('ss',$hashed_password,$_SESSION['accountname']);
		$stmt->execute();
	}else {
	    $error = $conn->errno . ' ' . $conn->error;
	    $_SESSION['errormsg'] = 'didn\'t change';
	    header('Location: ../userinfo_passwd.php?error2');
		exit();
	}
	header('Location: ../index.php');
	exit();