<?php
	include_once 'header.php';

	echo'
    <script>document.title = "مكتبة دار الحديث - حساب المستخدم";</script>
		<div class="container">

            <div class="contentpanel">
                <!--
                        <div class="status-bar">
                            <p>الحساب مفعل، يمكنك الاستفادة من خدمات المكتبة</p>
                            <img src="pics/icons/ok.png" alt="">
                        </div>
-->
                
                    <div class="title">الكتب الّتي بحوزتك</div>
                <div class="books">
                    <div class="borrowed-books">
                        <div class="book-list-head">عنوان الكتاب</div>
                        <div class="book-list-head">تاريخ الإعارة</div>
                        <div class="book-list-head">تاريخ الإعادة</div>
                        <div class="book-list-head">تجاوز</div>
	';

	$sql = "
            SELECT article_titel,borrow_date,borrow_returndate,
           		(CASE WHEN borrow_returndate < now() and (copy_state = 'معار' or copy_state = 'مسروق') THEN true ELSE false END) as past from article,copy,borrow
            where article.article_id = copy.article_id
	            and copy.copy_id = borrow.copy_id
                and (copy_state = 'معار' or copy_state = 'مسروق')
	            and libuser_id = ".$_SESSION['userid']." 
	            and borrow_returned = false
	            order by article_titel asc"
        ;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
	    while ($row = $result->fetch_assoc()) {
	    	if ($row['past']) {
	    		$state = '../pics/icons/warning.png';
	    	}else{
	    		$state = '../pics/icons/ok.png';
	    	}
	    	echo'
	    		<div class="title-value books-list-content">'.$row["article_titel"].'</div>
                <div class="borrow-value books-list-content">'.$row["borrow_date"].'</div>
                <div class="return-value books-list-content">'.$row["borrow_returndate"].'</div>
                <img src="'.$state.'" alt="">
	        ';
	    }
	}else{
		echo "ليس بحوزتك أي كتاب";
	}
    

?>
                                
                                </div>

                            </div>
                            <div class="title">الكتب المحجوزة</div>

                            <div class="books">
                                <div class="borrowed-books">
                                   
                                    <div class="book-list-head">عنوان الكتاب</div>
                                    <div class="book-list-head">تاريخ الحجز</div>
                                    <div class="book-list-head">تاريخ انتهاء الحجز</div>
                                    <div class="book-list-head">الغاء الحجز</div>

                                    <?php 

                                        $sql = "
                                            SELECT copy.copy_id as copyid,article_titel,reservation_date,reservation_returndate
                                            ,reservation_id
                                            from article,copy,reservation
                                            where article.article_id = copy.article_id
                                                and copy.copy_id = reservation.copy_id
                                                and copy_state = 'محجز'
                                                and libuser_id = ".$_SESSION['userid']." 
                                                and reservation_done = false
                                                order by article_titel asc
                                             "
                                        ;

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo'
                                                <div class="title-value books-list-content">'.$row['article_titel'].'</div>
                                                <div class="borrow-value books-list-content">'.$row['reservation_date'].'</div>
                                                <div class="return-value books-list-content">'.$row['reservation_returndate'].'</div>
                                                <form class="cancelBtn" action = "inc/cancel_reservation.inc.php" method = "get">
                                                    <input value="'.$row['copyid'].'" style="display:none;" name = "copyid">
                                                    <input value="'.$row['reservation_id'].'" style="display:none;" name = "reservationid">
                                                    <input type="submit" value="الغاء" name="submit">
                                                </form>
                                            ';
                                        }
                                    }else{
                                        echo "لا توجد كتب محجوزة";
                                    }

                                    ?>

                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>