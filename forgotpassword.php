<?php 
	include_once 'header.php';
	if (isset($_SESSION['accountname'])) {
        header('Location: index.php?alreadyloggedin');
        exit();
    }
?>
	
	<link href="css/login.css" rel="stylesheet" type="text/css">
<script>document.title = "ارجاع كلمة المرور";</script>
		
	<form  action="inc/resetpassword.inc.php" method="post" >
        <div class="login-form-container">
            <h3>ارجاع كلمة المرور</h3>
            <div class="username-input search-input">
                <input type="text" name="email" placeholder="البريد الالكتروني" required>
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
                    <input type="submit" value="بعث" name="submit">
                </div>
            </div>
        </div>
    </form>

</body>

</html>