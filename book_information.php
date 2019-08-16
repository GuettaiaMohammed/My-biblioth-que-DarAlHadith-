
<?php 
	include_once 'header.php';
	echo'<link href="css/bookinfo.css" rel="stylesheet" type="text/css">
    <script>document.title = "مكتبة دار الحديث - معلومات عن الكتاب";</script>
        <div class="container">

            <form action="search.php" method="get" class="search-panel">
           		<input id="search-input" type="text" name="search" placeholder="ابحث هنا">

                <div class="search-btn">
                    <select class="selector" id="specialty"  name="specialty">
		                <option value="الكل"> الكل  </option>'.
		                $sql = "
                            select DISTINCT article_category from article
                        ";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['article_category'].'">'. $row['article_category']  .'</option>';
                        }
                    echo '
		            </select>
	                <select class="selector" id="genr" name="genre">
		                <option value="الكل"> الكل  </option>
		                <option value="كتاب"> كتاب  </option>
		                <option value="مجلة"> مجلة  </option>
		                <option value="رسالة تخرج"> رسالة تخرج  </option>
		            </select>
	                <select class="selector" id="searchBy" name="searchby">
		                <option value="عنوان"> عنوان  </option>
		                <option value="الكاتب"> الكاتب  </option>
		                <option value="الكلمات المفتاحية"> الكلمات المفتاحية  </option>
		            </select>

                    <input value="ابحث" name="submit" type="image" src="pics/icons/searchRed.svg" id="search-icon">
                </div>
            </form>



            <div class="search-result container">
    ';

	if(!isset($_GET['articleid'])){
	    header('Location: index.php');
		exit();
	}
	$articleid = $_GET['articleid'];

	$sql = "SELECT 
            article.article_id
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
            ,sum(case when copy_state = 'متوفر' then 1 else 0 end) as available_copies
            ,article_borrowable
            
            
        from `article` left join `copy` on
            copy.article_id = article.article_id 
            
        where article.article_id = ?

        group by  article.article_id
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
			";


	if ($stmt = $conn->prepare($sql)) {
		$stmt->bind_param('i',$articleid);
		$stmt->execute();
	}else {
	    $error = $conn->errno . ' ' . $conn->error;
	    header('Location: index.php?error');
		exit();
	}
	$result = $stmt->get_result();
	if($result->num_rows  === 0){
		header('Location: ../login.php?notregistred');
		$_SESSION['errormsg'] = 'article not existing';
		exit();
	}

	$row = $result->fetch_assoc();

	if(is_null($row['article_cover'])) {
       $cover = "pics/books/standard.jpg";
    }else{
       $cover = $row['article_cover'];
    }

	
	echo '
    
		<div class="book-information container">

            <img class="coverb" src="'.$cover.'" alt="">

            <div class="container">
                <div class="info">
                    <div class="title">'.$row["article_titel"].'</div>
                    <div class="author spantoken">
                        <span>للكاتب: </span>
                        <span>'.$row["article_author"].'</span>
                    </div>
                    <div class="pages spantoken">
                        <span>عدد الصفحات: </span>
                        <span>'.$row["article_pages"].'</span>
                    </div>
                    <div class="pages spantoken">
                        <span>سنة النشر: </span>
                        <span>'.$row["article_publishingdate"].'</span>
                    </div>
                    <div class="publisher spantoken">
                        <span>دار النشر: </span>
                        <span>'.$row["article_publisher"].' </span>
                    </div>
                    <div class="copiesNumber spantoken">
                        <span>عدد النسخ المتوفرة: </span>
                        <span>'.$row["available_copies"].'</span>
                    </div>
                    <div class="categorie keywords spantoken">
                        <span>الإختصاص: </span>
                        <span>
                        <a href="">'.$row["article_category"].'</a>
                    </span>
                    </div>
                    <div class="keywords spantoken">
                        <span>كلمات مفتاحية: </span>
                        <span>
                        <a href="">'.$row["article_keywords"].'</a>
                    </span>
                    </div>
                </div>
            </div>
            <div class="synopsis">
                <div class="synopsis-title">عن الكتاب:</div>
                <div class="syn">
                <div class="synopsis-content">'.$row["article_synopsis"].'</div>
                    
                </div>

            </div>
	';
	?>
        
    	</div>
        <?php 
            
            
            
        	if ($row["article_borrowable"]) {
        		if (isset($_SESSION['accountname'])) {
                    if ($_SESSION["role"] == 'admin') {
                        echo '<hr><form action="adminpanel/edit/book_edit.php" methode="get" class="editBtn">
                        <input name="bookid" value="'.$articleid.'" style ="display:none;">
                        <input type="submit"  value="تعديل الكتاب">
                    </form>';
                    }
                    $sql = "
                    select *
                    from libuser,borrow
                    where libuser.libuser_id = borrow.libuser_id
                    and borrow_returndate < now() and borrow_returned = false
                    and libuser.libuser_id = ".$_SESSION["userid"];
                    $result = $conn->query($sql);
                    if ($result->num_rows == 0) {
                        echo '
                            <form action="userpanel/inc/reserver.inc.php" methode="get" class="reserveBtn">
                                <input name="article_id" value="'.$articleid.'" style ="display:none;">
                                <input type="submit" name="submit" value="حجز الكتاب">
                            </form>
                        ';
                    }
                
            	}
            	 
                if (isset($_SESSION['errormsg'])) {
                    echo "<h4>".$_SESSION['errormsg']."</h4>";
                    unset($_SESSION['errormsg']);
                }      
        	}            
        ?>
        


    </div> 
</div>

