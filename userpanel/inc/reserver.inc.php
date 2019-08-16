<?php 
	include_once '../../inc/db.inc.php';
	session_start();

    $sql = "
        select * from config
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $days = $row["config_reservation_number"];
    $max = $row["config_reservation_max"];
    $todaysdate = date('Y-m-d H:i:s');
    $nextdate = date('Y-m-d H:i:s',strtotime('+'.$days.' day',strtotime(date('Y-m-d H:i:s'))));

    $sql = "
        select * from reservation,copy,article
        where reservation_done = false
        and article.article_id = ".$_GET['article_id']."
        and article.article_id = copy.article_id
        and reservation.copy_id = copy.copy_id
    ";
    $result = $conn->query($sql);
    if ($result->num_rows >= 1) {
        $_SESSION['errormsg'] = 'article is already in your possession';
        header('Location: ../../book_information.php?articleid='.$_GET['article_id']);
        exit();
    }


    $sql = "
        select * from reservation,copy
        where libuser_id = ".$_SESSION['userid']."
        and copy.copy_id = reservation.copy_id
        and copy_state = 'محجز'
        group by copy.copy_id
        "
    ;
    $result = $conn->query($sql);

    if ($result->num_rows >= $max) {
        $_SESSION['errormsg'] = 'تم الوصول إلى الحد الأقصى';
        header('Location: ../../book_information.php?articleid='.$_GET['article_id']);
        exit();
    }

	$sql = "
		select copy_id from article,copy
		where article.article_id = copy.article_id
		and copy_state = 'متوفر'
		and article.article_id = ".$_GET['article_id']
	;

	$result = $conn->query($sql);

    if ($result->num_rows < 1) {
    	$_SESSION['errormsg'] = 'لا توجد نسخ';
    	header('Location: ../../book_information.php?articleid='.$_GET['article_id']);
		exit();
    }
    $row = $result->fetch_assoc();
    $sql = "
        update copy
        set copy_state = 'محجز'
        where copy_id = ".$row['copy_id']
    ;
    $conn->query($sql);
    $sql = "
    	insert into reservation(copy_id,libuser_id,reservation_date,reservation_returndate)
    	values(".$row['copy_id'].",".$_SESSION['userid'].",'".$todaysdate."','".$nextdate."')"
    ;

    if ($conn->query($sql)) {
    	echo "success";
        $_SESSION['errormsg'] = 'نجاح';
        header('Location: ../../book_information.php?articleid='.$_GET['article_id']);
        exit();
    }
        
