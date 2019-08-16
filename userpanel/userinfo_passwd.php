<?php 
    include_once 'header.php';
?>
<script type="text/javascript">
    
    var check = function() {
          if (document.getElementById('new').value ==
            document.getElementById('confirm').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
             document.getElementById('submit').disabled = false;
          } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
            document.getElementById('submit').disabled = true;
          }
    }

</script>
               <script>document.title = "مكتبة دار الحديث - تغيير كلمة المرور";</script>
                <div class="container">

                    <div class="contentpanel">
<!--
                        <div class="status-bar">
                            <p>الحساب مفعل، يمكنك الاستفادة من خدمات المكتبة</p>
                            <img src="pics/icons/ok.png" alt="">
                        </div>
-->
                        <div class="container">
                            <form class="changepasswd" action="inc/change_password.inc.php" method="post">
                                <input type="password" name="oldpassword" placeholder="كلمة السر القديمة" required >
                                <input type="password" id="new" name="new" placeholder="كلمة السر الجديدة" required  onkeyup='check();'>
                                <input type="password" id="confirm" name = "confirm" placeholder="تأكيد كلمة السر " required  onkeyup='check();'>
                                <h4 id='message'></h4>
                                 <?php 
                                    if (isset($_SESSION['errormsg'])) {
                                        echo '<h4 style="color:white;">.'.$_SESSION['errormsg'].'</h4>';
                                        unset($_SESSION['errormsg']);
                                    }
                                ?>
                                <input id="submit" type="submit" value="تغيير">
                            </form>                
                           
                        </div>


                    </div>

                </div>

            </div>

        </div>



    </div>


</body>


</html>