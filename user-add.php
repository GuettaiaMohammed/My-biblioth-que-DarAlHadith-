<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href="../css/edit-user.css" rel="stylesheet" type="text/css">
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
    <link href="../css/user-add.css" rel="stylesheet" type="text/css">
    <title>مكتبة دار الحديث</title>

</head>

<body>

    <div class="body-container">
        <?php
            
                            include_once 'header.php';
        ?>
        
<!--
        
        <div class="nav">
            <div class="nav-bar">
                <img class="logo" src="pics/darelhadith_white.svg" alt="logo">
                <div class="nav-bar-list">
                    <a href="#">المكتبة</a>
                    <a href="#">المزيد</a>
                    <a href="login.html">دخول</a>
                    <a href="#">إعدادات</a>
                </div>
            </div>

            <div class="sub-nav-bar" id="sub-nav-bar">

                <div class="sub-nav-bar-list">
                    <a href="#"> <img src="pics/icons/home.svg" alt="">  البداية</a>
                    <a href="#"><img src="pics/icons/borrow.svg" alt="">إعارة</a>
                    <a href="#"><img src="pics/icons/return.svg" alt="">إرجاع</a>
                    <a href="#"><img src="pics/icons/reserve.svg" alt="">الحجز</a>
                    <a href="#"><img src="pics/icons/members.svg" alt="">الأعضاء</a>
                    <a href="#"><img src="pics/icons/books.svg" alt="">الكتب</a>
                    <a href="#"><img src="pics/icons/statistics.svg" alt="">الإحصاءات</a>

                </div>
            </div>
        </div>
-->

        <div class="container">

            <!--            <div class="user-info">-->


            <div class="contentpanel">
                <div class="title-bar">
                    <p>إضافة مشترك جديد</p>
                </div>
                <!--
                        <div class="status-bar">
                            <p>الحساب مفعل، يمكنك الاستفادة من خدمات المكتبة</p>
                            <img src="pics/icons/ok.png" alt="">
                        </div>
-->
                <form method="get" action="../inc/add_user.php">


                    <div class="personal-info">
                        <div class="p-info">

                            <div class="info-head">الاسم: </div>
                            <div class="info-input">
                                <input name="firstname" type="text" class="edit-user" value="" pattern="/^[a-zA-Z\s]+\,[a-zA-Z\s]+$/" required>
                            </div>
                        </div>
                        <div class="p-info">

                            <div class="info-head">اللقب: </div>
                            <div class="info-input">
                                <input name="lastname" type="text" class="edit-user" value="" pattern="/^[a-zA-Z\s]+\,[a-zA-Z\s]+$/" required>
                            </div>
                        </div>
                        <div class="p-info">

                            <div class="info-head">تاريخ الميلاد: </div>
                            <div class="info-input">
                                <input name="birthdate" type="date" class="edit-user" value="" required>
                            </div>
                        </div>
                        <div class="p-info">

                            <div class="info-head">العنوان: </div>
                            <div class="info-input">
                                <input name="adress" type="text" class="edit-user" value="" required>
                            </div>
                        </div>
                        <div class="p-info">

                            <div class="info-head">مكان الميلاد: </div>
                            <div class="info-input">
                                <input name="birthplace" type="text" class="edit-user" value="" required>
                            </div>
                        </div>
                        <div class="p-info">

                            <div class="info-head">المهنـة: </div>
                            <div class="info-input">
                                <input name="job" type="text" class="edit-user" value="" required>
                            </div>
                        </div>
                        <div class="p-info">

                            <div class="info-head">تاريخ التسجيل: </div>
                            <div class="info-input">
                                <input name="subdate" type="date" class="edit-user" value="" required>
                            </div>
                        </div>
                        <div class="p-info">

                            <div class="info-head">إيميل: </div>
                            <div class="info-input">
                                <input name="email" type="email" class="edit-user" value="" required>
                            </div>
                        </div>
                        <div class="p-info">

                            <div class="info-head">رقم الهاتف: </div>
                            <div class="info-input">
                                <input name="phone" type="text" class="edit-user" value="" pattern="[0-9]*" required>
                            </div>
                        </div>
                        <div></div>

                        





                    </div>
                    <div class="buttons-t">
                        <!--                            <div class="submit-btn">-->
                        <input id="submit-btn" type="submit" value="إضافة">
                        <!--                            </div>-->
                        <!--                            <div class="cancel-btn">-->
                        <!--                    <input id="cancel-btn" type="button" value="الغاء">-->
                        <!--                            </div>-->
                    </div>
                </form>

            </div>



        </div>

        <!--        </div>-->



    </div>




</body>


</html>