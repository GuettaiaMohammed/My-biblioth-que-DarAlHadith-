<?php 
	include_once '../../inc/db.inc.php';
	session_start();
	if (isset($_GET['newposition'])) {
		$rownumber = count($_GET['newposition']);

		for ($i=0; $i < $rownumber; $i++) { 

			$sql = " 
				insert into copy(article_id,copy_position,copy_source,copy_enteringdate,copy_price,copy_state) 
				values(".$_GET['articleid'].",'".$_GET['newposition'][$i]."','".$_GET['newsource'][$i]."','".$_GET['newdate'][$i]."',".$_GET['newprice'][$i].",'".$_GET['newselection'][$i]."')";

			$conn->query($sql);	
		}
	}
	
	if (isset($_GET['position'])) {
		$rownumber = count($_GET['position']);

		for ($i=0; $i < $rownumber; $i++) { 
			$sql = " 
				update copy 
				set copy_position = ".$_GET['position'][$i].",
					copy_source = '".$_GET['source'][$i]."',
					copy_enteringdate = '".$_GET['date'][$i]."',
					copy_price = ".$_GET['price'][$i].",
					copy_state = '".$_GET['selection'][$i]."'
				where copy_id = ".$_GET['copyid'][$i];
			if ($conn->query($sql)) {
			}
		}
	}
	
	header('Location: ../edit/book_edit.php?bookid='.$_GET['articleid']);
	exit();