<?php 
	include_once '../../inc/db.inc.php';
	session_start();
    if(!isset($_GET['boox']) || !isset($_GET['userid'])){
        header('Location: ../borrow/borrow_user_selection.php?boox='.$_GET['boox'].'&userid='.$_GET['userid']);
        exit();
    }
//	$array = explode(",", $_GET['copyid']);
//	$length = count($array);
    if( ! ini_get('date.timezone') )
    {
        date_default_timezone_set('Africa/Algiers');
    }

    $array = explode(",", $_GET['boox']);


	$length = count($array);
    
	$numberofdays = $_GET['numberofdays'];
    
	$sql = "
        select *
        from config
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $maxbooks = $row["config_number_max"];

    $sql = "
        select libuser.libuser_id ,sum(case when copy_state = 'معار' and borrow_returned = false then 1 else 0 end) as books
        from copy,borrow,libuser
        where copy.copy_id = borrow.copy_id
        and borrow.libuser_id = libuser.libuser_id
        and libuser.libuser_id = ".$_GET["userid"]."
        group by libuser.libuser_id";
    ;
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $currentbooks = $row["books"]+$length-1;

    echo $maxbooks."<br>";
    echo $currentbooks."<br>";
    

    if ((int)$maxbooks < (int)$currentbooks) {
		$_SESSION['errormsg'] = "لا يمكنك الحصول على أكثر من ".$maxbooks." كتب";
		header('Location: ../borrow/borrow_book_selection.php?');
	    exit();
    }
	for ($i=0; $i < $length; $i++) { 
		$sql = "
			insert into borrow(copy_id,libuser_id,borrow_returndate)
			values(".$array[$i].",".$_GET['userid'].",'".date('Y-m-d H:i:s',strtotime('+'.$numberofdays.' day',strtotime(date('Y-m-d H:i:s'))))."')";
		$conn->query($sql);
		
		$sql = "update copy 
			set copy_state = 'معار'
			where copy_id = ".$array[$i]
			;
		$conn->query($sql);
	}
	
	$_SESSION['errormsg'] = "نجاح";
	header('Location: ../borrow/borrow_book_selection.php?');
    exit();