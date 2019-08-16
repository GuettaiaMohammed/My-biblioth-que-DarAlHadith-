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
        <div class="head"> قائمة الكتب المعارة</div>
        <table width="100%">
        <tr>
            
            <td> <b>عدد الكتب:</b></td>
            <td><?php 
                    $sql = 'select * from borrow WHERE borrow.borrow_returned = false ';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> كتابا</td>
            <td> <b>عدد التجاوزات :</b></td>
            <td><?php 
                    $sql = 'select * from borrow WHERE borrow_returndate < now() AND borrow_returned = false';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> مجالا</td>
        </tr>
        </table>
        <br>
        <table width="100%" border=1>
        <tr>
                                    <th>ترقيم الكتاب</th>
                                    <th>عنوان الكتاب</th>
                                    <th>اسم المشترك </th>
                                    <th>تاريخ الإعارة </th>
                                    <th>تاريخ الإعادة </th>
                                    <th>عدد أيام الاستخدام </th>
                                    <th>تجاوز</th>
        </tr>
        <?php
        
            $sql= "
                   SELECT copy.copy_id as copy_id,libuser_firstname,libuser_lastname,article_titel,borrow_id,copy_position
                                            ,borrow_date,borrow_returndate,DATEDIFF(now(),borrow_date) as days
                                            ,(CASE WHEN borrow_returndate < now()  and borrow_returned = false THEN true ELSE false END) as past
                                        from copy,article,libuser,borrow
                                        where copy.article_id = article.article_id
                                            and copy.copy_id = borrow.copy_id
                                            and libuser.libuser_id = borrow.libuser_id 
                                            and copy_state = 'معار'
                                            AND borrow_returned = false
                ";    

        $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {  
                        //<td>'.$row["copy_id"].'</td>
                        $pos = implode(',',array_unique(explode(',', $row["copy_position"])));
                        
                        if ($row['past'] ) {
                                                $state = "تجاوز";
                                            }else{
                                                $state = 'عادي';
                                            }
                        echo'

                            <tr>
                                <td>'.$row['copy_id'].'</td>
                                                    
                                                    <td>'.$row['article_titel'].'</td>
                                                    <td>'.$row['libuser_firstname'].','.$row['libuser_lastname'].'</td>
                                                    <td>'.$row['borrow_date'].'</td>
                                                    <td>'.$row['borrow_returndate'].'</td>
                                                    
                                                    <td>'.$row['days'].'</td>
                                                    <td>'.$state.'</td>
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