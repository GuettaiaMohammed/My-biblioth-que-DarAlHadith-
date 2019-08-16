<?php 
    include_once '../inc/db.inc.php';
    session_start();
    if (!isset($_SESSION['accountname'])) {
        header('Location: ../index.php');
        exit();
    }
 ?>

 <!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href="../css/userinfo.css" rel="stylesheet" type="text/css">
    <title>مكتبة دار الحديث</title>

</head>

<body>

    <div class="body-container">

        <div class="nav-bar">
            <a href="../"><img class="logo" src="../pics/darelhadith_white.svg" alt="logo"></a>
            <div class="nav-bar-list">
                <a href="../">المكتبة<img src="../pics/icons/home.svg" alt=""></a>
                <a href="../aboutus.php">معلومات عنا<img src="../pics/icons/aboutus.svg" alt=""></a>
                
                <?php 
                    if (!isset($_SESSION["accountname"])) {
                        echo '<a href="register.php">تسجيل <img src="../pics/icons/password.svg" alt=""></a>';
                        echo "<a href=\"login.php\">دخول <img src=\"../pics/icons/members.svg\" alt=\"\"></a>";
                    }else{
                        
                        echo'<a href="#">حساب المستخدم<img src="../pics/icons/account.svg" alt=""></a>';
                        if ($_SESSION["role"] == 'admin') {
                        	echo "<a href=\"../adminpanel\">إدارة المكتبة<img src=\"../pics/icons/settings.svg\" alt=\"\"></a>";
                        }
                        echo'<a href="../inc/logout.inc.php">خروج<img src="../pics/icons/logout.svg" alt=""></a>';
                    }
                 ?>  
            </div>
        </div>

        <div class="container">
        	<?php 

        		$sql = "
        			SELECT * from borrow 
        			where libuser_id = ".$_SESSION['userid']
        		;
				$result1 = $conn->query($sql);
				$sql = "
        			SELECT * from borrow,copy 
        			where borrow.copy_id = copy.copy_id
        			and libuser_id = ".$_SESSION['userid']."
        			and copy_state = 'معار'
                    and borrow_returned = false;
        		";
				$result2 = $conn->query($sql);

				
                $sql = '
                    SELECT Concat(libuser.libuser_firstname," ",libuser.libuser_lastname) as username,libuser.libuser_id from libuser WHERE libuser.libuser_id = (SELECT account.libuser_id FROM account WHERE account.libuser_id ='.$_SESSION['userid'].' )
                ';
//            echo $sql;
                $result4= $conn->query($sql);
                $row = $result4->fetch_assoc();
            $sql = '
        			SELECT * FROM borrow WHERE borrow_returndate < now() and borrow_returned = false AND libuser_id ='.$_SESSION['userid'];
				$result3 = $conn->query($sql);
//            echo $row['username'];
            ?>
            <div class="user-info">
                <div class="sidepanel">
                    <div class="fullname"><?= $row['username'] ?></div>
                    <div class="user-stat">
                        <div class="box box1"><?= $result3->num_rows ?>
                            <span class="tooltiptext1 tooltiptext">عدد التجاوزات</span>
                        </div>
                        <div class="box box2"><?= $result2->num_rows ?>
                            <span class="tooltiptext2 tooltiptext">عدد الكتب بحوزتك</span>
                        </div>
                        <div class="box box3"><?= $result1->num_rows ?>
                            <span class="tooltiptext3 tooltiptext">عدد الكتب التي استعرتها</span>
                        </div>
                        <div class="boxt">تجاوزات</div>
                        <div class="boxt">كتب</div>
                        <div class="boxt">استعرت</div>
                    </div>
                    <div class="buttons">

                        <a class="sidepanel-btn btn" href="index.php">حالة الحساب</a>
                        <a class="sidepanel-btn btn" href="userinfo_personal.php">معلومات شخصية</a>
                        <a class="sidepanel-btn btn" href="userinfo_passwd.php">تغيير كلمة السر</a>
                        <a class="sidepanel-btn btn" href="../inc/logout.inc.php">خروج</a>
                    </div>



                </div>