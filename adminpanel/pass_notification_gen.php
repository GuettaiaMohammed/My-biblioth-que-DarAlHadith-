<?php 
    include_once '../inc/db.inc.php';
    session_start();
    if (!isset($_SESSION['accountname']) or $_SESSION["role"] != 'admin') {
        header('Location: ../index.php');
        exit();
    }
if (!isset($_GET['user'])) {
        header('Location: return_book.php');
        exit();
    }
    date_default_timezone_set('Africa/Algiers');


    $sql = '
            select borrow.copy_id,libuser.libuser_firstname,libuser.libuser_lastname,article.article_titel,article.article_author from borrow,copy,article,libuser where libuser.libuser_id = borrow.libuser_id and copy.article_id = article.article_id AND copy.copy_id = borrow.copy_id and borrow.libuser_id = '.$_GET['user'].' and borrow.borrow_returned = false and borrow.borrow_returndate<now()
    ';
    $result = $conn->query($sql);
    if($result->num_rows == 0){
        header('Location: return_book.php');
        exit();
    }
    
$row = $result->fetch_assoc();
$result = $conn->query($sql);
?>
<!DOCTYPE html>

<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link media="all" href="css/print.css" rel="stylesheet"  type="text/css" >
    <title>مكتبة دار الحديث - إشعار بالتأخير</title>
</head>
<body>
    
    <div class="page">
      <div class="sub-head">بسم الله الرحمن الرحيم</div>
       <div class="head">الجمعية دار الحديث للتربية و الثقافة و العلم </div>
       <div class="sub-head">01 نهج دار الحديث - تلمسان -</div>
       <p>رقم الاعتماد لدى ولاية تلمسان- مديرية التنظيم: 120 المؤرخ في 1989/05/02م</p>
       <p>هاتف/فاكس: 043265982</p>
        <hr>
        <div class="head" style="border: 1px solid black;"> اشعار بالتأخير</div>
        <b><p style="text-align:left;">تلمسان: <?=date("Y/m/d")?></p></b>
        <div class="content">
            <u><p>إلى السيد : <?=$row['libuser_firstname'].' '.$row['libuser_lastname'] ?></p></u>
            <b><center>السلام عليكم</center></b>
            <p>نذكركم أنكم استعرتم من مكتبتنا:</p>
            <?php
    
                if ($result->num_rows > 0) {
                    echo "<ol>";
                    while ($row = $result->fetch_assoc()) {
                        echo '<li>كتاب: '.$row['article_titel'].'- للكاتب: '.$row['article_author'].'</li>';
                    }
                    echo "</ol>";
                }
            ?>
           <p>و الله تعالى يقول: "" إِنَّ اللَّهَ يَأْمُرُكُمْ أَنْ تُؤَدُّوا الأَمَانَاتِ إِلَى أَهْلِهَا "" سورة النساء58</p>
           <p>و كما تعلمون فقد تجاوزتم المدة المسموح بها بكثيـر، و و عليه نرجـو منكم إعادتها في أقرب الآجال حتى تمكّنوا غيركم من الاستفادة منها.</p>
           <u><p>ملاحظة:  هذا آخر تنبيه قبل اللّجوء إلى العدالة.</p></u>
           <b><center>و شكرا</center></b>
            <u><b><p style="text-align:left;">مسؤول المكتبة</p></b></u>
        </div>
        
    </div>
    
</body>
</html>