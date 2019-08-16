<?php 
    include_once 'inc/db.inc.php';
    session_start();
?>

<!DOCTYPE html>

<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=0.7">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/search.css" rel="stylesheet" type="text/css">
    <link href="css/aboutus.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8" /> 
    <title>مكتبة دار الحديث</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
    <div class="body-container">

        <div class="nav-bar">
            <a href="index.php"><img class="logo" src="pics/darelhadith_white.svg" alt="logo"></a>
            <div class="nav-bar-list">
                <a href="index.php">المكتبة<img src="pics/icons/home.svg" alt=""></a>
                <a href="aboutus.php">معلومات عنا<img src="pics/icons/aboutus.svg" alt=""></a>
                
                <?php 
                    if (!isset($_SESSION["accountname"])) {
                        echo '<a href="register.php">تسجيل <img src="pics/icons/password.svg" alt=""></a>';
                        echo "<a href=\"login.php\">دخول <img src=\"pics/icons/members.svg\" alt=\"\"></a>";
                    }else{
                        
                        echo'<a href="userpanel">حساب المستخدم<img src="pics/icons/account.svg" alt=""></a>';
                        if ($_SESSION["role"] == 'admin') {
                        	echo "<a href=\"adminpanel\">إدارة المكتبة<img src=\"pics/icons/settings.svg\" alt=\"\"></a>";
                        }
                        echo'<a href="inc/logout.inc.php">خروج<img src="pics/icons/logout.svg" alt=""></a>';
                    }
                 ?>  
            </div>
        </div>