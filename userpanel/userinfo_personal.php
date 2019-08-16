<?php 
    include_once 'header.php';

    $sql = "
            SELECT * from libuser 
            where libuser_id = ".$_SESSION['userid']
        ;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc()
?>


                <div class="container">
                    <script>document.title = "مكتبة دار الحديث - معلومات شخصية";</script>
                    <div class="contentpanel">
<!--
                        <div class="status-bar">
                            <p>الحساب مفعل، يمكنك الاستفادة من خدمات المكتبة</p>
                            <img src="pics/icons/ok.png" alt="">
                        </div>
-->
                        <div class="personal-info">
                            <div class="p-info">

                                <div class="info-head">الاسم الكامل: </div>
                                <div class="info-value"><?= $row['libuser_firstname'] ?>,<?= $row['libuser_lastname'] ?></div>
                            </div>
                            <div class="p-info">

                                <div class="info-head">تاريخ الميلاد: </div>
                                <div class="info-value"><?= $row['libuser_birthdate'] ?></div>
                            </div>
                            <div class="p-info">

                                <div class="info-head">العنوان: </div>
                                <div class="info-value"><?= $row['libuser_adress'] ?></div>
                            </div>
                            <div class="p-info">

                                <div class="info-head">مكان الميلاد: </div>
                                <div class="info-value"><?= $row['libuser_birthplace'] ?></div>
                            </div>
                            <div class="p-info">

                                <div class="info-head">المهنـة: </div>
                                <div class="info-value"><?= $row['libuser_speciality'] ?></div>
                            </div>
                            <div class="p-info">

                                <div class="info-head">تاريخ التسجيل: </div>
                                <div class="info-value"><?= $row['libuser_susbcriptiondate'] ?></div>
                            </div>
                            <div class="p-info">

                                <div class="info-head">إيميل: </div>
                                <div class="info-value"><?= $row['libuser_email'] ?></div>
                            </div>
                            <div class="p-info">

                                <div class="info-head">رقم الهاتف: </div>
                                <div class="info-value"><?= $row['libuser_phonenumber'] ?></div>
                            </div>
                            
                        </div>


                    </div>

                </div>

            </div>

        </div>



    </div>




</body>


</html>