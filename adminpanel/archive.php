<?php 
    include_once '../inc/db.inc.php';
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
    <link media="all" href="css/print.css" rel="stylesheet"  type="text/css" >
    <title>مكتبة دار الحديث</title>
</head>
<body>
    
    <div class="page">
       <div class="head">الجمعية الدينية و الثقافية لدار الحديث </div>
       <div class="sub-head">-تلمســان-</div>
        <hr>
        <div class="head">ارشيف الاعارات</div>
        <table width="100%">
        <tr>
            
            <td><b>عدد الاعارات:&nbsp&nbsp&nbsp</b>
            <?php 
                    $sql = 'select * from borrow';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?>&nbsp&nbsp&nbspكتابا            
            </td>
            
        </tr>
        </table>
        <br>
        <table width="100%" border=1>
        <tr>
                <th>رقم النسخة</th>
                <th>العنوان</th>
                <th>اسم المستخدم</th>
                <th>تاريخ الإعارة</th>
                <th>تاريخ الإعادة</th>
        </tr>
        <?php
        
            $sql = "SELECT 
                        borrow_id
                        ,copy.copy_id as copy_id         
                        ,article_titel
                        ,article_tags
                        ,article_publisher
                        ,article_category
                        ,borrow_date
                        ,borrow_returndate
                        ,copy_position
                        ,borrow_returned
                        ,CONCAT(libuser_firstname,' ',libuser_lastname) as name
                        
                        
                    from article,copy ,borrow,libuser
                    where
                         copy.article_id = article.article_id 
                     and copy.copy_id = borrow.copy_id
                     and libuser.libuser_id = borrow.libuser_id
                    order by borrow_id asc
                    ";    
        
        $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {  
                        echo'

                            <tr>
                                <td>'.$row["copy_id"].'</td>
                                <td>'.$row["name"].'</td>
                                <td>'.$row["article_titel"].'</td>
                                <td>'.$row["borrow_date"].'</td>
                                <td>'.$row["borrow_returndate"].'</td>
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