<?php 
	include_once '../../inc/db.inc.php';
    include_once '../mail/phpmailer/mail.php';

    $reference = substr(md5($_GET['phone'].$_GET['lastname'].date('Y-m-d H:i:s')),0,16);
	$sql = 
        "INSERT INTO libuser(libuser_firstname,libuser_lastname,libuser_adress,libuser_birthdate,libuser_birthplace,libuser_susbcriptiondate,libuser_speciality,libuser_phonenumber,libuser_email,libuser_reference) 
        VALUES (
            '".$_GET['firstname']."',
            '".$_GET['lastname']."',
            '".$_GET['adress']."',
            '".$_GET['birthdate']."',
            '".$_GET['birthplace']."',
            '".date('Y-m-d')."',
            '".$_GET['job']."',
            '".$_GET['phone']."',
            '".$_GET['email']."',
            '".$reference."'
        )"
	;

	$sql2= "
         select max(libuser_id) maxid from libuser
    ";


	if ($conn->query($sql)) {
        
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        sendMail($_GET['email']."",$reference."");
        $loc = 'Location: ../edit/user-edit.php?userid='.$row2['maxid'];
//        echo $loc;
//		header($loc);
		exit();
	}else{
		echo "error";
	}