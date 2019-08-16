<?php 
	include_once '../../inc/db.inc.php';
    include_once '../mail/phpmailer/mail.php';
    session_start();
     $_SESSION['errormsg']='';

     

    if(isset($_POST['delete'])){
        $sql="update config
        set
        config_email_address = '',
        config_email_password ='',
        config_email_smtp = '',
        config_email_tls = 0 
        WHERE config_id=''";
        if ($conn->query($sql)) {
            $_SESSION['errormsg'] = "تم حذف معلومات البريد الإلكتروني بنجاح "   ;
    		header('Location: ../setting.php');
    		exit();
	   }else{
		  echo "error";
	   }
    }else{
        
    

    $sql = "
		update config
        set
        config_number_max=".$_POST['max_borrow_books'].",
        config_reservation_max = ".$_POST['max_reservation_books'].",
        config_days_max = ".$_POST['max_borrow_days'].",
        config_reservation_number = ".$_POST['max_reservation_days'].",
        config_insc = '".$_POST['inscri']."'" ;
	;
    if (!empty($_POST['email_address']) || !empty($_POST['email_pass']) || !empty($_POST['email_smtp']) || !empty($_POST['email_tls'])) {
        if(!testMail($_POST['email_address'],$_POST['email_pass'],$_POST['email_smtp'],$_POST['email_tls'])){
            $sql.=",
            config_email_address = '".$_POST['email_address']."',
            config_email_password ='".$_POST['email_pass']."',
            config_email_smtp = '".$_POST['email_smtp']."',
            config_email_tls = '".$_POST['email_tls']."' 
            WHERE config_id=1";   
        }else{
             $_SESSION['errormsg'] ='email information is wrong';
            $sql.="WHERE config_id=1";
        } 
    }
    echo $sql; 
    if ($conn->query($sql)) {
        $_SESSION['errormsg'] .=' تم تحديث المعلومات بنجاح';
		header('Location: ../setting.php');
		exit();
   }else{
	echo "error";
   }
}