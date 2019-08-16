<?php 
    include_once 'header.php';

   

    echo'
    <script>document.title = "مكتبة دار الحديث - بحث";</script>
    	<div class="container">

        	<form action="" method="get" class="search-panel">
           		<input id="search-input" type="text" name="search" placeholder="ابحث هنا">

                <div class="search-btn">
                    <select class="selector" id="specialty"  name="specialty">
		                <option value="الكل"> الكل  </option>';
		                $sql = "
					        select DISTINCT article_category from article
					    ";
					    $result = $conn->query($sql);
		                while ($row = $result->fetch_assoc()) {
		                	echo '<option value="'.$row['article_category'].'">'. $row['article_category']  .'</option>';
		                }

	echo'	         </select>
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

                <div class="search-result-head">
                    <p>نتائج البحث</p>
                    
                </div>

                <div class="search-result-content">
                    <div class="page" id="page1">
    ';

    /*<select class="selector filter" id="sortBy">
                        <option value="عنوان"> عنوان  </option>
                        <option value="الكاتب"> الكاتب  </option>
                        <option value="الكلمات المفتاحية"> الكلمات المفتاحية  </option>
                    </select>*/

    if(!isset($_GET['submit'])){
	    header('Location: index.php');
		exit();
	}


	if (!isset($_GET['specialty']) or  $_GET['specialty'] == 'الكل') {
		$specialty = 'article_category';
		$nextspeciality =  'الكل';
	}else{
		$specialty = "'".$_GET['specialty']."'";
		$nextspeciality = $_GET['specialty'];
	}

	$query = "&speciality=".$nextspeciality;

	if (!isset($_GET['genre']) or $_GET['genre'] == 'الكل') {
		$tag = 'article_tags' ;
		$nexttags = 'الكل';
	}else{
		$tag = "'".$_GET['genre']."'";
		$nexttags = $_GET['genre'];
	}

	$query.="&genre=".$nexttags;


	if (isset($_GET['searchby']) and $_GET['searchby'] == 'عنوان') {
		$type = 'article_titel';
		$nextsearchby = $_GET['searchby'];
	}
	elseif (isset($_GET['searchby']) and $_GET['searchby'] == 'الكلمات المفتاحية') {
		$type = 'article_keywords';
		$nextsearchby = $_GET['searchby'];
	}
	elseif (isset($_GET['searchby']) and $_GET['searchby'] == 'الكاتب') {
		$type = 'article_author';
		$nextsearchby = $_GET['searchby'];
	}else{
		$type = 'article_titel';
		$nextsearchby = 'الكل';
	}

	$query.="&searchby=".$nextsearchby;
	
	if (empty($_GET['search'])) {
		$search = "%";
	}else{
		$search = "%".$_GET['search']."%";
	}

	$query.="&search=".$_GET['search'];
	//TODO
	//start of pagination script
	$sql = "
		SELECT 
            article.article_id
            ,article_titel
            ,article_tags
            ,article_synopsis
            ,article_publisher
            ,article_cover
            ,article_category
            ,article_author
            ,sum(case when copy_state = 'متوفر' then 1 else 0 end) as available_copies
            
            
        from `article` left join `copy` on
            copy.article_id = article.article_id 
            
	    where $type LIKE ?
	    and article_category = $specialty
	    and article_tags = $tag

	    group by  article.article_id
            ,article_titel
            ,article_tags
            ,article_synopsis
            ,article_publisher
            ,article_cover
            ,article_category
            ,article_author  
	";



	if ($stmt = $conn->prepare($sql)) {
		$stmt->bind_param('s',$search);
		$stmt->execute();

	}else {
	    $error = $conn->errno . ' ' . $conn->error;

	    header('Location: index.php?error1');
		exit();
	}



	$result = $stmt->get_result();

	$total  = $result->num_rows ;

	if ($total == 0) {
		echo'لا توجد نتائج';
		exit();
	}


	$limit = 9;

    // How many pages will there be
    $pages = ceil($total / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 1;
    $end = min(($offset + $limit), $total);

    


	//end of pagination script
   

	$sql = "
		SELECT 
            article.article_id
            ,article_titel
            ,article_tags
            ,article_synopsis
            ,article_publisher
            ,article_cover
            ,article_category
            ,article_author
            ,sum(case when copy_state = 'متوفر' then 1 else 0 end) as available_copies
            ,sum(case when copy_state = 'معار' then 1 else 0 end) as borrowed
            
        from `article` left join `copy` on
            copy.article_id = article.article_id 
            
	    where $type LIKE ?
	    and article_category = $specialty
	    and article_tags = $tag

	    group by  article.article_id
            ,article_titel
            ,article_tags
            ,article_synopsis
            ,article_publisher
            ,article_cover
            ,article_category
            ,article_author  
	    	limit $offset , $limit
	    "
	   ;

	if ($stmt = $conn->prepare($sql)) {
		$stmt->bind_param('s',$search);
		$stmt->execute();
	}else {
	    $error = $conn->errno . ' ' . $conn->error;
	    header('Location: index.php?error2');
		exit();
	}
	// The "back" link
	    $prevlink = ($page > 1) ? '<a href="?submit=ابحث&page=1'.$query.'" title="First page">&laquo;</a> <a href="?submit=ابحث&page=' . ($page - 1) .$query.'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

	    // The "forward" link
	    $nextlink = ($page < $pages) ? '<a href="?submit=ابحث&page=' . ($page + 1) .$query.'" title="Next page">&rsaquo;</a> <a href="?submit=ابحث&page=' . $pages .$query.'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        if(empty($row['article_cover'])) {
	           $cover = "pics/books/standard.jpg";
	        }else{
	           $cover = $row['article_cover'];
	        }
	        $articleid = $row['article_id'];
	        echo'<div class="book-s">
	                <img class="cover" src="'.$cover.'" alt="">
	                <div class="book-info">
	                    <a href="book_information.php?articleid='.$articleid.'">'.$row['article_titel'].'</a>
	                    <p> اسم الكاتب -'.$row['article_author'].'</p>
	                    <p>النوع - '.$row['article_tags'].'</p>
	                    <p>المجال - '.$row['article_category'].'</p>
	                    <p>عدد الإعارات - '.$row['borrowed'].'</p>
	                    <p>عدد النسخ المتوفرة -'.$row['available_copies'].'</p>
	                </div>
	            </div>';

	    }

	    echo '
                </div>                
            </div>
        </div>
        ';

        
     	echo '	 <div class="search-result container">
     			<div id="paging" class="pagination">', $prevlink, ' الصفحة '.$page.' من '.$pages.$nextlink, '</div>
     			</div>
     			';


	} else {
	    echo "0 results";
	}
?>
                
            </div>
        </div>
    </div>
</body>

</html>