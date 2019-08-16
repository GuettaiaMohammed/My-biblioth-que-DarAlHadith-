<?php 
    include_once '../inc/db.inc.php';
    session_start();
    if (!isset($_SESSION['accountname']) or $_SESSION["role"] != 'admin') {
        header('Location: ../index.php');
        exit();
    }
 ?>

<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet" type="text/css">
    <title>مكتبة دار الحديث</title>

    <script src="javascript/jquery.js"></script>
    <script src="javascript/snap.js"></script>

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Line Chart</title>
    <script async="" src="Line%20Chart_files/analytics.js"></script>
    <script src="Line%20Chart_files/Chart.js"></script>
    <style type="text/css">
        /* Chart.js */

        @-webkit-keyframes chartjs-render-animation {
            from {
                opacity: 0.99
            }
            to {
                opacity: 1
            }
        }

        @keyframes chartjs-render-animation {
            from {
                opacity: 0.99
            }
            to {
                opacity: 1
            }
        }

        .chartjs-render-monitor {
            -webkit-animation: chartjs-render-animation 0.001s;
            animation: chartjs-render-animation 0.001s;
        }
    </style>
    <script src="Line%20Chart_files/utils.js"></script>
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>

    <script>
        function refresh() {
            window.onresize = function() {
                location.reload();
            }
        }
    </script>
</head>

<body>

    <body>

        <div class="body-container">
            <div class="nav">
                <div class="nav-bar">
                    <a href="../index.php"><img class="logo" src="../pics/darelhadith_white.svg" alt="logo"></a>
                    <div class="nav-bar-list">
                        <a href="../index.php">المكتبة<img src="../pics/icons/home.svg" alt=""></a>
                        <a href="../aboutus.php">معلومات عنا<img src="../pics/icons/aboutus.svg" alt=""></a>

                        <?php 
                    if (!isset($_SESSION["accountname"])) {
                        echo '<a href="register.php">تسجيل <img src="../pics/icons/password.svg" alt=""></a>';
                        echo "<a href=\"login.php\">دخول <img src=\"../pics/icons/members.svg\" alt=\"\"></a>";
                    }else{
                        
                        echo'<a href="../userpanel">حساب المستخدم<img src="../pics/icons/account.svg" alt=""></a>';
                        if ($_SESSION["role"] == 'admin') {
                        	echo "<a href=\"../adminpanel\">إدارة المكتبة<img src=\"../pics/icons/settings.svg\" alt=\"\"></a>";
                        }
                        echo'<a href="../inc/logout.inc.php">خروج<img src="../pics/icons/logout.svg" alt=""></a>';
                    }
                 ?>
                    </div>
                </div>

                <div class="sub-nav-bar" id="sub-nav-bar">

                    <div class="sub-nav-bar-list">
                        <a href="index.php"><img src="pics/icons/home.svg" alt="">  البداية</a>
                        <a href="borrow/borrow_book_selection.php"><img src="pics/icons/borrow.svg" alt="">إعارة</a>
                        <a href="return_book.php"><img src="pics/icons/return.svg" alt="">إرجاع</a>
                        <a href="reserved_book.php"><img src="pics/icons/reserve.svg" alt="">الحجز</a>
                        <a href="lists/member_list.php "><img src="pics/icons/members.svg" alt="">الأعضاء</a>
	                    <a href="lists/books_list.php "><img src="pics/icons/books.svg " alt=" ">الكتب</a>
<!--	                    <a href="# "><img src="pics/icons/statistics.svg " alt=" ">الإحصاءات</a>-->
	                    <a href="setting.php "><img src="../pics/icons/settings.svg " alt=" ">إعدادات</a>

                    </div>
            </div>
        </div>
<script>
                // When the user scrolls the page, execute myFunction
                window.onscroll = function() {
                    myFunction()
                };

                // Get the navbar
                var navbar = document.getElementById("sub-nav-bar ");

                // Get the offset position of the navbar
                var sticky = navbar.offsetTop;

                // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky " when you leave the scroll position
                function myFunction() {
                    if (window.pageYOffset >= sticky) {
                        navbar.classList.add("sticky ")
                    } else {
                        navbar.classList.remove("sticky ");
                    }
                }
            </script>

        <div class="content-container ">
            <div class="content ">