<?php 
	include_once '../../inc/db.inc.php';
	session_start();

	if ($_GET['stat'] == 'عادي') {
		$stat = "متوفر";
	}else{
		$stat = "متلف";
	}

	$sql = "select libuser_id from borrow 
			where borrow_id = ".$_GET['borrowid'];
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();


	$sql = "
		update borrow set 
		borrow_returned = true
		where borrow_id = ".$_GET['borrowid']
	;
	if ($conn->query($sql)) {
		echo "sk:gjl";
		$sql = "
		update copy set 
		copy_state = '".$stat."'
		where copy_id = ".$_GET['copyid']
		;
		$conn->query($sql);

		$sql = "
			insert into libreturn(libuser_id,copy_id,libreturn_date)
			values(".$row['libuser_id'].",".$_GET['copyid'].",'".date('Y-m-d H:i:s')."')
		";
		$conn->query($sql);
	}
	header('Location: ../return_book.php');
	