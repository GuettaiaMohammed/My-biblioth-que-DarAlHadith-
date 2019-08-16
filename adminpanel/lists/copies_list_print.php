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
        <div class="head">قائمة نسخ الكتب</div>
        <br>
        <table width="100%" style="border:1px solid black">
        <tr>
            
            <td> <b>عدد النسخ:</b></td>
            <td><?php 
                    $sql = 'select * from copy';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> كتابا</td>
            <td> <b>عدد النسخ المتوفرة :</b></td>
            <td><?php 
                    $sql = 'SELECT 
                article.article_id,
                copy.copy_id,
                article.article_titel,
                article.article_author,
                copy.copy_state,
                copy.copy_position,
                article.article_category,
                article.article_publisher,
                copy.copy_source,
                copy.copy_price,
                copy_enteringdate
                FROM 
                copy,article
                WHERE
                copy.article_id = article.article_id
                and copy.copy_state like "%متوفر%"
                ';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> نسخة</td>
                
            <td> <b>عدد النسخ المسروقة :</b></td>
            <td><?php 
                    $sql = 'SELECT 
                article.article_id,
                copy.copy_id,
                article.article_titel,
                article.article_author,
                copy.copy_state,
                copy.copy_position,
                article.article_category,
                article.article_publisher,
                copy.copy_source,
                copy.copy_price,
                copy_enteringdate
                FROM 
                copy,article
                WHERE
                copy.article_id = article.article_id
                and copy.copy_state like "%مسروق%"
                ';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> نسخة</td>
            
        </tr>
        <tr>
            
            <td> <b>عدد النسخ المعارة:</b></td>
            <td><?php 
                    $sql = 'SELECT 
                article.article_id,
                copy.copy_id,
                article.article_titel,
                article.article_author,
                copy.copy_state,
                copy.copy_position,
                article.article_category,
                article.article_publisher,
                copy.copy_source,
                copy.copy_price,
                copy_enteringdate
                FROM 
                copy,article
                WHERE
                copy.article_id = article.article_id
                and copy.copy_state like "%معار%"
                ';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> كتابا</td>
            <td> <b>عدد النسخ المحجوزة :</b></td>
            <td><?php 
                    $sql = 'SELECT 
                article.article_id,
                copy.copy_id,
                article.article_titel,
                article.article_author,
                copy.copy_state,
                copy.copy_position,
                article.article_category,
                article.article_publisher,
                copy.copy_source,
                copy.copy_price,
                copy_enteringdate
                FROM 
                copy,article
                WHERE
                copy.article_id = article.article_id
                and copy.copy_state like "%محجز%"
                ';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> نسخة</td>
                <td> <b>عدد النسخ المتلفة :</b></td>
            <td><?php 
                    $sql = 'SELECT 
                article.article_id,
                copy.copy_id,
                article.article_titel,
                article.article_author,
                copy.copy_state,
                copy.copy_position,
                article.article_category,
                article.article_publisher,
                copy.copy_source,
                copy.copy_price,
                copy_enteringdate
                FROM 
                copy,article
                WHERE
                copy.article_id = article.article_id
                and copy.copy_state like "%متلف%"
                ';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> نسخة</td>
            
            
        </tr>
        </table>
        <br>
        <table width="100%" border=1>
        <tr>
                <th>الترقيم</th>
                <th>العنوان </th>
                <th>الكاتب</th> 
                <th>الحالة</th>
                <th>الرف</th>
                <th>التخصص</th>
                <th>دار النشر</th>
                <th>المصدر</th>
                <th>الثمن</th>
                <th>تاريخ الاقتناء</th>
        </tr>
        <?php
                    $sql_like="and copy.copy_state like '%'";
                if(isset($_GET['checkbox_idle']) || isset($_GET['checkbox_damaged']) || isset($_GET['checkbox_stolen'])){
                    
                    
                
                    if(isset($_GET['checkbox_idle'])){
                        $sql_like.="and copy.copy_state like '%متوفر%'";
                    }else{
                        $sql_like.="and not copy.copy_state like '%متوفر%'";
                        $checking++;
                    }
                    
                    if(isset($_GET['checkbox_damaged'])){
                        $sql_like.="and copy.copy_state like '%متلف%'";
                    }else{
                        $sql_like.="and not copy.copy_state like '%متلف%'";
                        $checking++;
                    }
                    
                    if(isset($_GET['checkbox_stolen'])){
                        $sql_like.="and copy.copy_state like '%مسروق%'";
                    }else{
                        $sql_like.="and not copy.copy_state like '%مسروق%'";
                        $checking++;
                    }
                }
            $sql = "SELECT 
                article.article_id,
                copy.copy_id,
                article.article_titel,
                article.article_author,
                copy.copy_state,
                copy.copy_position,
                article.article_category,
                article.article_publisher,
                copy.copy_source,
                copy.copy_price,
                copy_enteringdate
                FROM 
                copy,article
                WHERE
                copy.article_id = article.article_id
                ";  
//            echo $sql_like;
        $sql .= $sql_like;
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
                                <td>'.$row["copy_id"].'</td>
                                <td>'.$row["article_titel"].'</td>
                                <td>'.$row["article_author"].'</td>              
                                <td>'.$row["copy_state"].'</td>
                                <td>'.$row["copy_position"].'</td>
                                <td>'.$row["article_category"].'</td>
                                <td>'.$row["article_publisher"].'</td>
                                <td>'.$row["copy_source"].'</td>
                                <td>'.$row["copy_price"].'</td>
                                <td>'.$row["copy_enteringdate"].'</td>
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