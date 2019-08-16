<?php 
	include_once 'header.php';
?>
        <script>document.title = "مكتبة دار الحديث";</script>
		<form action="search.php" method="get">
	        <div class="search-bar-container">
	            <div class="search-input"><input type="text" placeholder="عنوان الكتاب" name="search"></div>
	            <div class="search-submit"><input type="submit" value="ابحث" name="submit"></div>
	        </div>
        </form>
        <h3>الكتب الأكثر قراءة</h3>
        <div class="books-div">
            <div class="books-list">
            	<?php 
            		include_once 'inc/most_read_books.inc.php'	            		
            	?>
            </div>
        </div>
    </div>
</body>

</html>