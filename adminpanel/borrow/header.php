<?php 
    include_once'../../inc/db.inc.php';
    session_start();
    $_SESSION["checkbox_list"]="";
    if (!isset($_SESSION['accountname']) or $_SESSION["role"] != 'admin') {
        header('Location: ../../login.php');
        exit();
    }
?>
<script>document.title = "مكتبة دار الحديث - إعارة كتاب";</script>
<div class="nav">
    <div class="nav-bar">
                    <a href="../../index.php"><img class="logo" src="../pics/darelhadith_white.svg" alt="logo"></a>
                    <div class="nav-bar-list">
                        <a href="../../index.php">المكتبة<img src="../../pics/icons/home.svg" alt=""></a>
                        <a href="../../aboutus.php">معلومات عنا<img src="../../pics/icons/aboutus.svg" alt=""></a>

                        <?php 
                    if (!isset($_SESSION["accountname"])) {
                        echo '<a href="../../register.php">تسجيل <img src="../pics/icons/password.svg" alt=""></a>';
                        echo "<a href=\"login.php\">دخول <img src=\"../../pics/icons/members.svg\" alt=\"\"></a>";
                    }else{
                        
                        echo'<a href="../../userpanel">حساب المستخدم<img src="../../pics/icons/account.svg" alt=""></a>';
                        if ($_SESSION["role"] == 'admin') {
                        	echo "<a href=\"../../adminpanel\">إدارة المكتبة<img src=\"../../pics/icons/settings.svg\" alt=\"\"></a>";
                        }
                        echo'<a href="../../inc/logout.inc.php">خروج<img src="../../pics/icons/logout.svg" alt=""></a>';
                    }
                 ?>
                    </div>
                </div>

    <div class="sub-nav-bar" id="sub-nav-bar">

        <div class="sub-nav-bar-list">
            <a href="../index.php"> <img src="../pics/icons/home.svg" alt="">  البداية</a>
            <a href="borrow_book_selection.php"><img src="../pics/icons/borrow.svg" alt="">إعارة</a>                    
            <a href="../return_book.php"><img src="../pics/icons/return.svg" alt="">إرجاع</a>
            <a href="../reserved_book.php"><img src="../pics/icons/reserve.svg" alt="">الحجز</a>
            <a href="../lists/member_list.php"><img src="../pics/icons/members.svg" alt="">الأعضاء</a>
            <a href="../lists/books_list.php"><img src="../pics/icons/books.svg" alt="">الكتب</a>
<!--            <a href=""><img src="../pics/icons/statistics.svg" alt="">الإحصاءات</a>-->
	        <a href="../setting.php "><img src="../../pics/icons/settings.svg " alt=" ">إعدادات</a>
        </div>
    </div>
</div>