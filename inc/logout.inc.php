<?php 
	include_once 'db.inc.php';
	session_start();

	$sql = "update account set account_isonline = false
		where account_name = '".$_SESSION['accountname']."'"
  	;

  	$result = $conn->query($sql);
	Session_unset();
	session_destroy();

	
	header('Location: ../index.php');
	exit();
