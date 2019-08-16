<?php 
    include_once '../../inc/db.inc.php';
    session_start();
    if (!isset($_SESSION['accountname']) or $_SESSION["role"] != 'admin') {
        header('Location: ../index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link media="all" href="../css/print.css" rel="stylesheet"  type="text/css" >
    <title>مكتبة دار الحديث</title>
</head>
<body>
    
    <div class="page">
       <div class="head">الجمعية الدينية و الثقافية لدار الحديث </div>
       <div class="sub-head">-تلمســان-</div>
        <hr>
        <div class="head">قائمة المنخرطين</div>
        <br>
        <table width="100%" style="border:1px solid black">
        <tr>
            
            <td> <b>عدد المنخرطين:</b></td>
            <td><?php 
                    $sql = 'SELECT * FROM libuser';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> كتابا</td>
            
                
            <td> <b>عدد المنخرطين في الموقع :</b></td>
            <td><?php 
                    $sql = 'SELECT * FROM account';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> نسخة</td>
            
        </tr>
        
        </table>
        <br>
        <table width="100%" border=1>
        <tr>
            <th>رقم الانخراط</th>
            <th>الاسم الكامل</th>
            <th>تاريخ الميلاد</th>
            <th>مكان الميلاد</th>
            <th>العنوان</th>
            <th>المهنة</th>
            <th>تاريخ التسجيل</th>
            <th>إيميل</th>
            <th>الهاتف</th>
        </tr>
        <?php
                   
            $sql = "SELECT libuser.libuser_id,libuser_firstname,libuser_lastname,libuser_birthdate
                                            ,libuser_birthplace,libuser_adress,libuser_speciality
                                            ,libuser_susbcriptiondate,libuser_email,libuser_phonenumber
                                            ,copy_state
                                            
                                            
                                        from libuser left join 
                                            borrow on libuser.libuser_id = borrow.libuser_id
                                            left join copy on copy.copy_id = borrow.copy_id
                                        
                                        group by libuser.libuser_id
                ";
        $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {  
                        //<td>'.$row["copy_id"].'</td>
                        if($row["copy_state"] == 'متوفر' || $row["copy_state"]=='معار')
                            $the_state = 'عادي';
                        else
                            $the_state = $row["copy_state"];
                        
                        if($row["copy_state"] == 'متوفر'){
                            $icon = '<img src="../pics/icons/ok.png" alt="">';
                        }else{
                            $icon = '<img src="../pics/icons/warning.png" alt="">';
                        }
                        
                            
                        echo'

                            <tr>
                                <tr>
                                                
                                                <td>'.$row["libuser_id"].' </td>
                                                <td>'.$row["libuser_firstname"].' ,'.$row["libuser_lastname"].'</td>
                                                <td>'.$row["libuser_birthdate"].'</td>
                                                <td>'.$row["libuser_birthplace"].'</td>
                                                <td>'.$row["libuser_adress"].'</td>
                                                <td>'.$row["libuser_speciality"].'</td>
                                                <td>'.$row["libuser_susbcriptiondate"].'</td>
                                                <td>'.$row["libuser_email"].'</td>
                                                <td>'.$row["libuser_phonenumber"].'</td>
                                                </tr>
                            </tr>
                        ';
                    }
                }else{
                    echo "no results";
                }
            ?>
        </table>
    </div>
    
</body>
</html>