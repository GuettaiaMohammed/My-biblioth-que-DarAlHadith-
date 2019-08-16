<?php 
    include_once '../inc/db.inc.php';
    session_start();
    if (!isset($_SESSION['accountname']) or $_SESSION["role"] != 'admin') {
        header('Location: ../index.php');
        exit();
    }
    date_default_timezone_set('Africa/Algiers');
    include_once'Ifsnop/Mysqldump/Mysqldump.php';
    $dump = new Ifsnop\Mysqldump\Mysqldump('mysql:host=localhost;dbname=daralhadith', 'root', '+213796302584');
    $dump->start('storage/work/dump.sql');
 ?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/setting.css" rel="stylesheet" type="text/css">
    <link href="css/admin.css" rel="stylesheet" type="text/css">
    <title> مكتبة دار الحديث - إعدادات النظام</title>

</head>

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
                        echo '<a href="../register.php">تسجيل <img src="../pics/icons/password.svg" alt=""></a>';
                        echo "<a href=\"../login.php\">دخول <img src=\"../pics/icons/members.svg\" alt=\"\"></a>";
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
                    <a href="index.php"> <img src="../pics/icons/home.svg" alt="">  البداية</a>
                    <a href="borrow/borrow_book_selection.php"><img src="../pics/icons/borrow.svg" alt="">إعارة</a>
                    <a href="return_book.php"><img src="../pics/icons/return.svg" alt="">إرجاع</a>
                    <a href="reserved_book.php"><img src="../pics/icons/reserve.svg" alt="">الحجز</a>
                    <a href="lists/member_list.php"><img src="../pics/icons/members.svg" alt="">الأعضاء</a>
                    <a href="lists/books_list.php"><img src="../pics/icons/books.svg" alt="">الكتب</a>
<!--                    <a href=""><img src="../pics/icons/statistics.svg" alt="">الإحصاءات</a>-->
	                <a href="setting.php"><img src="../pics/icons/settings.svg " alt=" ">إعدادات</a>

                </div>
            </div>
        </div>

        <div class="container">

<!--            <div class="user-info">-->
                <?php 
                    
                    $sql = ' 
                        SELECT config_number_max,config_days_max,config_reservation_number,config_reservation_max,config_insc,config_email_address,config_email_smtp,config_email_tls FROM config';

                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    
                ?>

                <div class="contentpanel">
                    <div class="panel-title">
                        <p>إعدادات النّظام</p>
                    </div>
                    
                    <div class="panel-title1">
                        <p>تعاملات الكتب</p>
                    </div>
                    <!--
                        <div class="status-bar">
                            <p>الحساب مفعل، يمكنك الاستفادة من خدمات المكتبة</p>
                            <img src="pics/icons/ok.png" alt="">
                        </div>
-->
                       
                   <?php 
                    if (isset($_SESSION["errormsg"])) {
                        echo "<h4>".$_SESSION['errormsg']."</h4>";
                        unset($_SESSION["errormsg"]);
                    }
                ?>  
                    <form  action="inc/update_setting.php" method="post">
                   <div class="personal-info">
                        <div class="p-info">
                            <div class="info-head"> أقصى مدة للإعارة  (أيام): </div>
                            <div class="info-input">
                                <input required name="max_borrow_days" type="number" class="edit-user" value="<?=$row['config_days_max'] ?>">
                            </div>
                        </div>
                        <div class="p-info">
                            <div class="info-head">أكبر عدد كتب معارة: </div>
                            <div class="info-input">
                                <input required name="max_borrow_books" type="number" class="edit-user" value="<?=$row['config_number_max'] ?>">
                            </div>
                        </div>
                        <div class="p-info">
                            <div class="info-head">أقصى مدة حجز (أيام): </div>
                            <div class="info-input">
                                <input required name="max_reservation_days" type="number" class="edit-user" value="<?=$row['config_reservation_number'] ?>">
                            </div>
                        </div>
                        
                        <div class="p-info">
                            <div class="info-head">أكبر عدد كتب محجوزة: </div>
                            <div class="info-input">
                                <input required name="max_reservation_books" type="number" class="edit-user" value="<?=$row['config_reservation_max'] ?>">
                            </div>
                        </div>
                        <?php 
                        date_default_timezone_set('Africa/Algiers'); 
                        ?>
                        <div class="p-info">
                            <div class="info-head">تاريخ إعادة التسجيل من كل سنة: </div>
                            <div class="info-input">
                                <input required name="inscri" type="date" class="edit-user" value="<?=date( "Y-m-d", strtotime($row['config_insc']))?>">
                            </div>
                        </div>

                        <div class="panel-title1">
                            <p>البريد الإلكتروني</p>
                        </div>
                        <div class="p-info">
                            <div class="info-head"> عنوان البريد: </div>
                            <div class="info-input">
                                <input name="email_address" type="email" class="edit-user" value="<?=$row['config_email_address'] ?>">
                            </div>
                        </div>
                        <script language='javascript' type='text/javascript'>
                            function check(input) {
                                if (input.value != document.getElementById('email_pass').value) {
                                    input.setCustomValidity('كلمة المرور يجب أن تتطابق');
                                } else {
                                    // input is valid -- reset the error message
                                    input.setCustomValidity('');
                                }
                            }
                        </script>
                        
                        <div class="p-info">
                            <div class="info-head"> كلمة المرور: </div>
                            <div class="info-input">
                                <input name="email_pass" type="password" class="edit-user" id="email_pass" value="">
                            </div>
                        </div>
                        
                        <div class="p-info">
                            <div class="info-head"> تأكيد كلمة المرور: </div>
                            <div class="info-input">
                                <input name="email_pass_confirm" type="password" class="edit-user"  id="email_pass_confirm"  value="" oninput="check(this)">
                            </div>
                        </div>
                        
                        <div class="p-info">
                            <div class="info-head"> خادم SMTP: </div>
                            <div class="info-input">
                                <input name="email_smtp" type="text" class="edit-user" value="<?=$row['config_email_smtp'] ?>">
                            </div>
                        </div>
                        
                        <div class="p-info">
                            <div class="info-head"> منفد TLS: </div>
                            <div class="info-input">
                                <input name="email_tls" type="text" class="edit-user" value="<?=$row['config_email_tls'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="buttons-t">
                        <!--                            <div class="submit-btn">-->
                        <input id="submit-btn" type="submit" value="حفظ التغيير">
                        <!--                            </div>-->
                        <!--                            <div class="cancel-btn">-->
                        
                        <input id="cancel-btn" name="delete" type="submit" value="حذف البريد الإلكتروني" >
                        
                        <!--                            </div>-->
                    </div>
                    
            </form>
                
                </div>



            </div>

<!--        </div>-->



    </div>




</body>


</html>
