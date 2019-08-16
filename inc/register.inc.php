<?php 
	include_once 'db.inc.php';
	session_start();
	if (!isset($_POST["submit"])) {
		header('Location: ../register.php');
		exit();
	}
	$reference = $_POST["userid"];
	$accountname = $_POST["accountname"];
	$password = $_POST["password"];

	if (empty($reference) || empty($password) || empty($accountname)) {
		header('Location: ../register.php?fieldempty		exit();');

	}

	$sql = "SELECT * from `account`,`libuser` where 
		libuser.libuser_id = account.libuser_id
		and (account_name = ? or libuser_reference = ? )";
	
	if ($stmt = $conn->prepare($sql)) {
		$stmt->bind_param('ss',$accountname,$reference);
		$stmt->execute();
	}else {
	    $error = $conn->errno . ' ' . $conn->error;
	    echo $error;
	    header('Location: ../register.php?error');
	}

	$result = $stmt->get_result();
	if($result->num_rows  > 0){
		header('Location: ../register.php?useralreadyregistred'.$result->num_rows);
		$_SESSION['errormsg'] = 'رقم أو اسم المستخدم محجوز من قبل';
		exit();
	}

	$sql = "SELECT * from `libuser` where libuser_reference = ?";
	
	if ($stmt = $conn->prepare($sql)) {
		$stmt->bind_param('s',$reference);
		$stmt->execute();
	}else {
	    $error = $conn->errno . ' ' . $conn->error;
	    echo $error; 
	    header('Location: ../register.php');
	    exit();
	}
	$result = $stmt->get_result();

	if($result->num_rows  === 0){
		header('Location: ../register.php?notregistredinlibrary');
		$_SESSION['errormsg'] = 'رقم المستخدم خاطئ، لست مسجل في المكتبة';
		exit();
	}
	$row = $result->fetch_assoc();

	$sql = "insert into account(libuser_id,account_name,account_password) values(?,?,?)";
	
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	if ($stmt = $conn->prepare($sql)) {
		$stmt->bind_param('iss',$row['libuser_id'],$accountname,$hashed_password);
		$stmt->execute();
//		header('Location: ../index.php?registred'); //omar
        header('Location: ../login.php');
		exit();
	}else {
	    $error = $conn->errno . ' ' . $conn->error;
	    echo $error;
	    header('Location: ../register.php?'.$error);
	    exit();
	}
