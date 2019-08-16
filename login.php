<?php 
	include_once 'header.php';
	if (isset($_SESSION['accountname'])) {
        header('Location: index.php?alreadyloggedin');
        exit();
    }
?>
	
	<link href="css/login.css" rel="stylesheet" type="text/css">
<script>document.title = "مكتبة دار الحديث - دخول";</script>
		
	<form  action="inc/login.inc.php" method="post" >
        <div class="login-form-container">
            <h3>تسجيــل الدخول</h3>
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
//                    echo '<h4 style="color:white;">اسم المستخدم أو كلمة المرور خاطئة</h4>';
				}
			?>
           
           
            <div class="login-buttons">
                <div class="login-submit search-submit">
                    <input type="submit" value="دخول" name="submit">
                </div>
                <div class="register search-submit">
                    <input type="button" value="نسيت كلمة المرور" onclick="window.location='forgotpassword.php';"">
                </div>
            </div>
        </div>
    </form>

</body>

</html>