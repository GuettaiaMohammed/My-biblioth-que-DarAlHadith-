<?php 
	include_once '../../inc/db.inc.php';
if(isset($_GET['renew'])){
    $sql = "
		update libuser set
			libuser_blocked = 0
		where libuser_id = ".$_GET['userid']
	;

	if ($conn->query($sql)) {
		header('Location: ../edit/user-edit.php?userid='.$_GET['userid']);
		exit();
	}else{
		echo "error";
	}
}else if(isset($_GET['block'])){
    $sql = "
		update libuser set
			libuser_blocked = 1
		where libuser_id = ".$_GET['userid']
	;

	if ($conn->query($sql)) {
		header('Location: ../edit/user-edit.php?userid='.$_GET['userid']);
		exit();
	}else{
		echo "error";
	}
}else{
	list($a, $b) = explode(',', $_GET['name']);
    
	$sql = "
		update libuser set
			libuser_firstname = '".$a."',
			libuser_lastname = '".$b."',
			libuser_birthdate = '".$_GET['birthday']."',
			libuser_birthplace = '".$_GET['birthplace']."',
			libuser_adress = '".$_GET['adress']."',
			libuser_email = '".$_GET['email']."',
			libuser_phonenumber = '".$_GET['number']."',
			libuser_speciality = '".$_GET['speciality']."',
			libuser_memo = '".$_GET['memo']."'
		where libuser_id = ".$_GET['userid']
	;

    $sql2 = "
        update account set
            account_role = '".$_GET['role']."'
            where libuser_id=".$_GET['userid'];

	if ($conn->query($sql) && $conn->query($sql2)) {
		header('Location: ../edit/user-edit.php?userid='.$_GET['userid']);
		exit();
	}else{
		echo "error";
	}
}