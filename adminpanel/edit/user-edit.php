<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.7" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet" type="text/css">
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
    <link href="../css/edit-user.css" rel="stylesheet" type="text/css">
    <title>مكتبة دار الحديث - تعديل معلومات المستخدم</title>

</head>

<body>

    <div class="body-container">

        <?php 
            include_once 'header.php';
            $sql= "
	             SELECT libuser.libuser_id,libuser_firstname,libuser_lastname,libuser_birthdate
	                ,libuser_birthplace,libuser_adress,libuser_speciality
	                ,libuser_susbcriptiondate,libuser_email,libuser_phonenumber,libuser_memo
	                ,sum(case when copy_state = 'idle' then 1 else 0 end) as available_copies
                    ,libuser_blocked,libuser_reference
	            from libuser left join 
	                borrow on libuser.libuser_id = borrow.libuser_id
	                left join copy on copy.copy_id = borrow.copy_id
	               	where libuser.libuser_id = ".$_GET['userid']."
	            group by libuser.libuser_id,libuser_firstname,libuser_lastname,libuser_birthdate
	                ,libuser_birthplace,libuser_adress,libuser_speciality
	                ,libuser_susbcriptiondate,libuser_email,libuser_phonenumber
	        ";

	        $result = $conn->query($sql);
	        $row = $result->fetch_assoc();
        
        
        $sql2 = "select account_role from account where libuser_id =".$_GET['userid'];
        $result2 = $conn->query($sql2);
        $row2 = $result2->num_rows;
        
        ?>

        <div class="container">

            <!--            <div class="user-info">-->


            <form class="contentpanel" method="get" action="../inc/update_user.php">
                <div class="title-bar">
                    <p>تعديل معلومات المستخدم</p>
                </div>
                <!--
                        <div class="status-bar">
                            <p>الحساب مفعل، يمكنك الاستفادة من خدمات المكتبة</p>
                            <img src="pics/icons/ok.png" alt="">
                        </div>
-->
                <div class="personal-info">
                    <div class="p-info">
                        <input name="userid" value="<?= $_GET['userid']?>" style="display: none;">
                        <div class="info-head">الاسم الكامل: </div>
                        <div class="info-input">
                            <input type="text" class="edit-user" value="<?php echo $row['libuser_firstname'].','.$row['libuser_lastname']?>" name="name" pattern="/^[a-zA-Z\s]+\,[a-zA-Z\s]+$/" required>
                        </div>
                    </div>
                    <div class="p-info">

                        <div class="info-head">تاريخ الميلاد: </div>
                        <div class="info-input">
                            <input type="date" class="edit-user" value="<?= $row['libuser_birthdate']?>" name="birthday" required>
                        </div>
                    </div>
                    
                    <div class="p-info">

                        <div class="info-head">مكان الميلاد: </div>
                        <div class="info-input">
                            <input type="text" class="edit-user" value="<?= $row['libuser_birthplace']?>" name="birthplace" required>
                        </div>
                    </div>
                    <div class="p-info">

                        <div class="info-head">العنوان: </div>
                        <div class="info-input">
                            <input type="text" class="edit-user" value="<?= $row['libuser_adress']?>" name="adress">
                        </div>
                    </div>
                    <div class="p-info">

                        <div class="info-head">المهنـة: </div>
                        <div class="info-input">
                            <select name="speciality" type="text" class="edit-user" required>

                                <?php 

                                    $job = $row['libuser_speciality'];
                                    $etudiant ="";
                                    $student ="";
                                    $etudiant ="";
                                    if ($job == 'تلميد') {
                                        $etudiant = " selected";
                                    }elseif ($job == 'عامل') {
                                        $worker = " selected";
                                    }elseif ($job == 'طالب') {
                                        $student = " selected";
                                    }
                                
                                echo '
                                <option value="تلميد" '.$etudiant.'>تلميد</option>
                                <option value="عامل" '.$worker.'>عامل</option>
                                <option value="طالب" '.$student.'>طالب</option> 
                                ';
                                ?>           
                            </select>
                        </div>
                    </div>
                    <div class="p-info">

                        <div class="info-head">رقم الهاتف: </div>
                        <div class="info-input">
                            <input type="text" class="edit-user" value="<?= $row['libuser_phonenumber']?>" name="number" pattern="[0-9]*" required>
                        </div>
                    </div>
                    <div class="p-info">

                        <div class="info-head">الشفرة </div>
                        <div class="info-input">
                            <input type="text" class="edit-user" value="<?= $row['libuser_reference']?>" name="subscriptiondate" required readonly="readonly">
                        </div>
                    </div>
                    <div class="p-info">

                        <div class="info-head">إيميل: </div>
                        <div class="info-input">
                            <input type="email" class="edit-user" value="<?= $row['libuser_email']?>" name="email" required>
                        </div>
                    </div>
                    <div class="p-info">

                        <div class="info-head">تاريخ التسجيل: </div>
                        <div class="info-input">
                            <input type="date" class="edit-user" value="<?= $row['libuser_susbcriptiondate']?>" readonly="readonly"	>
                        </div>
                    </div>
                    
                    <div class="memo_div">
                    
                    


                </div>
                   
                    <?php 
                        if($row2!= 0){
                            $admin = $user = " ";
                            ($row2['account_role']=='admin')?$admin="selected":$user="selected";
                            echo '<div class="p-info">

                        <div class="info-head"> دور المستخدم: </div>
                        <div class="info-input">
                            <select name="role" class="selector" id="account_role">
                            <option value="user"'.$user.'> مشترك  </option>
                            <option value="admin"'.$admin.'> مدير  </option>
                        </select>

                        </div>
                    </div>';
                        }
                    ?>
                    
                    
                   
                </div>
                <div class=" synopsis memo">
                    <div class="synopsis-title"> ملاحظات:</div>
                    <textarea name="memo" class="synopsis-content" ><?= $row['libuser_memo']?></textarea>
                    </div>
                <div class="buttons-t">

                
                    <!--                            <div class="submit-btn">-->
                    <input id="submit-btn" type="submit" value="حفظ التغيير" name="submit">
                    
                    <?php 
                        if($row['libuser_blocked']==1){
                            echo '<input id="print" name="renew" type="submit" value="تجديد الاشتراك" >';
                        }else{
                            echo '<input id="cancel-btn" name="block" type="submit" value="حجب المستخدم" >';
                        }
                    ?>
                    
                    
                </div>

            </form>



        </div>

        <!--        </div>-->



    </div>




</body>


</html>