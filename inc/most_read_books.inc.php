<?php
	$sql = "SELECT  article.article_id,article.article_titel,article_cover,count(article.article_id) from article,borrow,copy 
			where article.article_id = copy.article_id and copy.copy_id = borrow.copy_id
			group by article.article_id,article.article_id,article_cover
			order by count(article.article_id) DESC
			LIMIT 5";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
	        if(empty($row['article_cover'])) {
	           $cover = "pics/books/standard.jpg";
	        }else{
	           $cover = $row['article_cover'];
	        }
	        $articleid = $row['article_id'];
	        echo'<div class="book">
	                <img src="'.$cover.'" alt="">
	                <a class="book-link" href="book_information.php?articleid='.$articleid.'">
	                    <div class="book-title">'.$row['article_titel'].'</div>
	                </a>
	            </div>';
	    }

	} else {
	    echo "0 results";
	}