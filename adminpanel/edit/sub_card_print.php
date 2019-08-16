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
    <link media="all" href="../css/print2.css" rel="stylesheet"  type="text/css" >
    <title>مكتبة دار الحديث</title>
</head>
<body>
    
    <div class="page">
      <table width="100%" style="border:1px solid black"> 
          <tr>
              <td width="50%">sdfsdf</td>
              <td width="50%">
                  <div class="head">الجمعية الدينية و الثقافية لدار الحديث </div>
       <div class="sub-head">-تلمســان-</div>
        <hr>
        <div class="head">قائمة نسخ الكتب</div>
              </td>
          </tr>
      </table>
       
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
        
    
    </div>
    
</body>
<script>
     window.print();
    </script>
</html>