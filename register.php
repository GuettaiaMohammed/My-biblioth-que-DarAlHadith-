<?php 
    include_once 'header.php';
    if (isset($_SESSION['accountname'])) {
        header('Location: index.php?alreadyloggedin');
        exit();
    }
?>
    <link href="css/login.css" rel="stylesheet" type="text/css">


	<script>document.title = "مكتبة دار الحديث - تسجيل";</script>


    <form  action="inc/register.inc.php" method="post" >
        <div class="login-form-container">
            <h3>تسجيـل حساب جديـد</h3>

            <div class="username-input search-input">
                <input type="text" name="userid" placeholder="رقم المستخدم" required>
            </div>

            <div class="username-input search-input">
                <input type="text" name="accountname" placeholder="اسم المستخدم" required>
            </div>
            <div class="password-input search-input">
                <input type="password" name="password" placeholder="كلمة المرور" required>
            </div>
            <?php 
                if (isset($_SESSION['errormsg'])) {
                    echo '<h4 style="color:white;">.'.$_SESSION['errormsg'].'</h4>';
                    unset($_SESSION['errormsg']);
                }
            ?>
            <div class="login-buttons">
            	<div class="login-submit search-submit">
                    <input type="submit" value="تسجيل" name="submit">
                </div>
            </div>
            
    </form>


</body>
</html>