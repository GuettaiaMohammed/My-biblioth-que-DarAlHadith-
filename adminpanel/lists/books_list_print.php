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
        <div class="head">قائمة الكتب</div>
        <table width="100%">
        <tr>
            
            <td> <b>عدد الكتب:</b></td>
            <td><?php 
                    $sql = 'select * from article';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> كتابا</td>
            <td> <b>عدد المجالات :</b></td>
            <td><?php 
                    $sql = 'SELECT * FROM `article` GROUP BY article_category';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?> مجالا</td>
        </tr>
        </table>
        <br>
        <table width="100%" border=1>
        <tr>
                <th>العنوان</th>
                <th>عدد النسخ </th>
                <th>النسخ المتوفرة</th> 
                <th>الكاتب</th>
                <th>الرف</th>
                <th>التخصص</th>
                <th>دار النشر</th>
        </tr>
        <?php
        
            $sql = "SELECT 
                        article.article_id
                        ,copy_id
                        ,article_titel
                        ,article_tags
                        ,article_synopsis
                        ,article_publisher
                        ,article_cover
                        ,article_category
                        ,article_author
                        ,article_pages
                        ,article_synopsis
                        ,article_keywords
                        ,article_publishingdate
                        ,count(copy_id) as article_copies
                        ,sum(case when copy_state = 'متوفر' then 1 else 0 end) as available_copies
                        ,GROUP_CONCAT(copy_position) as copy_position
                        
                        
                    from `article` left join `copy` on
                        copy.article_id = article.article_id 
                        

                    group by  article.article_id
                    order by article_titel asc";    
        
        $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {  
                        //<td>'.$row["copy_id"].'</td>
                        $pos = implode(',',array_unique(explode(',', $row["copy_position"])));
                        echo'

                            <tr>
                                <td>'.$row["article_titel"].'</td>
                                <td>'.$row["article_copies"].'</td>
                                <td>'.$row["available_copies"].'</td>              
                                <td>'.$row["article_author"].'</td>
                                <td>'.$pos.'</td>
                                <td>'.$row["article_category"].'</td>
                                <td>'.$row["article_publisher"].'</td>
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