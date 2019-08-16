<?php 
	include_once '../../inc/db.inc.php';
	session_start();

	$target_dir = "../../pics/books/";
	$target_file = $target_dir . basename($_FILES["imageinput"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$cover = "pics/books/".basename($_FILES["imageinput"]["name"]);
    
    $borrowable = $_POST['borrow']=='borrow_yes'?1:0;
	if (empty(basename($_FILES["imageinput"]["name"]))) {
		
		$sql = " 
			insert into article(article_titel,article_author,article_pages,article_publishingdate,article_category,article_keywords,article_synopsis,article_borrowable,article_tags,article_publisher)	
			values('".$_POST['titel']."','".$_POST['author']."',".$_POST['pages'].",'".$_POST['publishingdate']."','".$_POST['category']."','".$_POST['keywords']."','".$_POST['synopsis']."','".$borrowable."','".$_POST['tags']."','".$_POST['publisher']."')
		";
		if ($conn->query($sql)) {
			$_SESSION['errormsg'] = "نجاح";
			header('Location: ../edit/book_add.php').$_SESSION['errormsg'] ;
			exit();
		}else{
			$_SESSION['errormsg'] = "عذرًا ، لقد ظهر خطأ ، يجب عليك المحاولة مرة أخرى";
			header('Location: ../edit/book_add.php?'.$_SESSION['errormsg']);
			exit();
		}

	}


	if (isset($_POST['submit'])) {
		$check = getimagesize($_FILES["imageinput"]["tmp_name"]);
		if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        $uploadOk = 0;
	        $_SESSION['errormsg'] = "الملف ليس صورة";
	        header('Location: ../edit/book_add.php?'.$_POST["errormsg"]);
			exit();
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    $_SESSION['errormsg'] =  "عذرًا ، الصورة موجودة";
	    $uploadOk = 0;
	    header('Location: ../edit/book_add.php?'.$_POST['articleid']);
		exit();
	}
	// Check file size
	if ($_FILES["imageinput"]["size"] > 500000) {
	     $_SESSION['errormsg'] = "عذرًا ، صورتك كبيرة جدًا.";
	    $uploadOk = 0;
	    header('Location: ../edit/book_add.php?'.$_POST['articleid']);
		exit();
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $_SESSION['errormsg'] = "يسمح فقط JPG, JPEG, PNG & GIF";
	    $uploadOk = 0;
	    header('Location: ../edit/book_add.php?'.$_POST['articleid']);
		exit();
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (!move_uploaded_file($_FILES["imageinput"]["tmp_name"], $target_file)) {
	    	$_SESSION['errormsg'] = "عذرًا ، حدث خطأ أثناء تحميل صورتك.";
	        header('Location: ../edit/book_add.php?'.$_POST['articleid']);
			exit();
	    }
	}

	$sql = " 
			insert into article(article_titel,article_author,article_pages,article_publishingdate,article_category,article_keywords,article_synopsis,article_borrowable,article_tags,article_publisher,article_cover)	
			values('".$_POST['titel']."','".$_POST['author']."',".$_POST['pages'].",'".$_POST['publishingdate']."','".$_POST['category']."','".$_POST['keywords']."','".$_POST['synopsis']."','".$borrowable."','".$_POST['tags']."','".$_POST['publisher']."','".$cover."')
		";

	if ($conn->query($sql)) {
		$_SESSION['errormsg'] = "نجاح";
		header('Location: ../edit/book_add.php?'.$_POST['articleid']);
		exit();
	}else{
		$_SESSION['errormsg'] = "عذرًا ، لقد ظهر خطأ ، يجب عليك المحاولة مرة أخرى";
		header('Location: ../edit/book_add.php?'.$_POST['articleid']);
		exit();
	}