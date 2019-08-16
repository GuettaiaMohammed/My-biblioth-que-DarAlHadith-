<?php 
	include_once '../../inc/db.inc.php';
	session_start();

	$sql = "
		update copy 
		set copy_state = 'متوفر'
		where copy_id = ".$_GET['copyid']
	;
	$result = $conn->query($sql);
	$sql = "
		update reservation 
		set reservation_done = true
		where reservation_id = ".$_GET['reservationid']
	;
	$result = $conn->query($sql);
	header('Location: ../reserved_book.php');
    exit();


