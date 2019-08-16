<?php 
	include_once 'db.inc.php';
	session_start();
	if (!isset($_POST["submit"])) {
		header('Location: ../login.php');
		exit();
	}
	$accountname = $_POST["accountname"];
	$password = $_POST["password"];


	//start log file

	$log  = 
		"-------------------------".PHP_EOL.
		"User: ".$_SERVER['REMOTE_ADDR'].' - '.date("F j, Y, g:i a").PHP_EOL.
        "Username: ".$accountname.PHP_EOL
        ;

	file_put_contents('../log/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);

	//end logfile

	if (empty($password) || empty($accountname)) {
		header('Location: ../login.php?fieldempty');
		exit();
	}

	$sql = "SELECT * from `account` where account_name = ?";
	
	if ($stmt = $conn->prepare($sql)) {
		$stmt->bind_param('s',$accountname);
		$stmt->execute();
	}else {
	    $error = $conn->errno . ' ' . $conn->error;
	    header('Location: ../login.php?error');
		exit();
	}
	$result = $stmt->get_result();
	if($result->num_rows  === 0){
		$_SESSION['errormsg'] = 'اسم المستخدم أو كلمة المرور خاطئة';
		$log  = 
        "Attempt: FAILED".PHP_EOL;
        ;
		file_put_contents('../log/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
		header('Location: ../login.php?notregistred');

		exit();
	}
	$data = $result->fetch_assoc();

	$sql = "SELECT libuser_blocked from `account`,`libuser` where account_id = ".$data['libuser_id']."
				and libuser.libuser_id = account.libuser_id";

	$result = $conn->query($sql);

	$row = $result->fetch_assoc();

	if ($row["libuser_blocked"]) {
		$log  = 
        "Attempt: BLOCKED".PHP_EOL;
        ;
		file_put_contents('../log/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
		header('Location: ../login.php?notregistred');
		$_SESSION['errormsg'] = 'you are blocked';
		exit();
	}

	if(password_verify($password, $data['account_password'])) {
		$_SESSION["userid"] =$data['libuser_id'];
		$_SESSION["accountname"] = $accountname;
		$_SESSION["password"] = $data['account_password'];
		$_SESSION["role"] = $data['account_role'];



		$log  = 
        "UserID: ".$_SESSION["userid"].PHP_EOL.
        "UserRole: ".$_SESSION["role"].PHP_EOL.
        "Attempt: SUCCESS".PHP_EOL;

		file_put_contents('../log/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);



		$sql = "update account set account_isonline = true
				where account_name = ?
  		";
  		if ($stmt = $conn->prepare($sql)) {
			$stmt->bind_param('s',$accountname);
			$stmt->execute();
		}else {
		    $error = $conn->errno . ' ' . $conn->error;
		    header('Location: ../login.php?error');
			exit();
		}
		if ($_SESSION['role'] === 'admin') {
			header('Location: ../adminpanel');
			exit();
		}else{
			header('Location: ../userpanel');
			exit();
		}
 		header('Location: ../index.php?loggedin');
 		exit();
	} else{
		$_SESSION['errormsg'] = 'اسم المستخدم أو كلمة المرور خاطئة';
		header('Location: ../login.php?wronginformation');	
		exit();
	}