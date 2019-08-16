<?php
//    if (!isset($_SESSION['accountname']) or $_SESSION["role"] != 'admin') {
//        header('Location: ../../index.php');
//        exit();
//    }
  require("PHPMailer.php");
  require("SMTP.php");
  require("Exception.php");
date_default_timezone_set('Africa/Algiers');
function sendMail($email,$userid,$__id){
    $email = (string)$email;
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);                              
    try {
        $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ));
        $mail->SMTPDebug = 0; 
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'daoudomardz@gmail.com';
        $mail->Password = 'elibudajnznntshr'; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('daoudomardz@gmail.com', 'DAR EL HADITH TLEMCEN');
        $mail->addAddress($email, 'dar hadith');

        $mail->isHTML(true);
        $mail->Subject = 'Your userid man -_-';
        $mail->Body    = 'Here is your userid so u can complete your registration<br>userid = <b>'.$userid.'</b>';
        $mail->AltBody = 'Here is your userid so u can complete your registration<br>userid = <b>'.$userid.'</b>';

        if ($mail->Send()) { 
        header("Location: ../edit/user-add.php");//echo "Message Sent!";            
    }
        
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        return 1;
    }
}


function testMail($email,$pass,$smtp,$tls){
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ));
        $mail->SMTPDebug = 0; 
        $mail->isSMTP();
        $mail->Host = $smtp;
        $mail->SMTPAuth = true;
        $mail->Username = $email;
        $mail->Password = $pass; 
        $mail->SMTPSecure = 'tls';
        $mail->Port = $tls;
  


    if($mail->smtpConnect()){
        $mail->smtpClose();
       return 0;
    }
    else{
        return 1;
    }
}