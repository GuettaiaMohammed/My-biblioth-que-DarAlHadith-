<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
    <link href="../css/borrow.css" rel="stylesheet" type="text/css">
    <link href="../css/borrow_book_selection.css" rel="stylesheet" type="text/css">
    <title>مكتبة دار الحديث</title>


    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

</head>

<body>

    <div class="body-container">
        <?php 
            include_once 'header.php';
     		if (isset($_SESSION["errormsg"])) {
     			echo'<script type="text/javascript" language="Javascript">  
				alert("'.$_SESSION["errormsg"].'") 
				</script>  ';
				unset($_SESSION["errormsg"]);
     		}	

            
		?>



        <div class="content-container">

            <div class="content">

                <div class="panel">
                    <div class="panel-title">إعارة الكتب</div>
                    <div class="panel-title1">قائمة الكتب</div>
                    <form class="panel-search">
                        <input type="text" placeholder="ابحث" name="search">
                        <select class="selector" id="genre" name="selector">
                            <option value="العنوان"> العنوان  </option>
                            <option value="الترقيم"> الترقيم  </option>
                            <option value="الكاتب"> الكاتب  </option>
                            <option value="التخصص"> التخصص  </option>
                            <option value="دار النشر"> دار النشر  </option>
                        </select>
                        <input type="text" name="boox" id="boox2" style="display:none;" value="<?php echo $_GET['selectedvalue']?>">
                        <input type="image" src="../pics/icons/searchBlack.svg" id="search-icon">
                    </form>
                    <form class="panel-content " action="borrow_user_selection.php" method="get">

                        <input type="text" name="boox" id="boox1" style="display:none;" value="<?php echo $_GET['selectedvalue']?>">
                        <div class="t2" style="overflow-x:auto;">

                            <table width="100%">

                                <tr>
                                    <th>اختيار</th>
                                    <th>الترقيم</th>
                                    <th>العنوان</th>
                                    <th>الكاتب</th>
                                    <th>الرف</th>
                                    <th>التخصص</th>
                                    <th>دار النشر</th>
                                </tr>
                                <script>
                                    
                                    function storedata(book_id) {
                                        console.log(book_id);
                                        var links = document.getElementsByClassName('link');
                                        var i = links.length;
                                        if (document.getElementById("check__" + book_id).checked) {
                                            console.log("ok");
                                            document.getElementById("boox1").value = document.getElementById("boox1").value + "," + book_id;
                                            document.getElementById("boox2").value = document.getElementById("boox2").value + "," + book_id;
                                            var i = links.length;
                                            while(i--){
                                                links[i].href= links[i].href +"," + book_id;
                                            }
                                        
                                        } else {
                                            document.getElementById("boox1").value = document.getElementById("boox1").value.replace("," + book_id, "");
                                            document.getElementById("boox2").value = document.getElementById("boox2").value.replace("," + book_id, "");
                                            var i = links.length;
                                            while(i--){
                                                links[i].href= links[i].href.replace("," + book_id, "");
                                            }
                                        }
                                        
                                        var i = links.length;
                                        while(i--){
                                            links[i].href= string_table[i] + document.getElementById("boox1").value;
                                        }
                                    }
                                </script>
                                <?php 
                                
                                    
                                    if(!isset($_GET['selectedvalue'])){
                                        $selectedvalue = "";
                                    }else{
                                        $selectedvalue = $_GET['selectedvalue']; 
                                    }
                                    
                                
                                    $abc = ''; 
                                    if(!isset($_GET['search'])){
                                        $search = "'%'";
                                    }else{
                                        $search = "'%".$_GET['search']."%'"; 
                                        $abc =$_GET['search'];
                                    }

                                    $selector = "";
                                    $type = 'article_titel';
                                    if (isset($_GET['selector'])) {

                                        if ($_GET['selector'] == 'العنوان') {
                                            $type = 'article_titel'; 
                                        }

                                        elseif ($_GET['selector'] == 'الترقيم') {
                                            $type = 'copy_id';
                                        }

                                        elseif ($_GET['selector'] == 'الكاتب') {
                                            $type = 'article_author';
                                        }

                                        elseif ($_GET['selector'] == 'التخصص') {
                                            $type = 'article_category';
                                        }

                                        elseif ($_GET['selector'] == 'دار النشر') {
                                            $type = 'article_publisher';
                                        }

                                        $selector = $_GET['selector'];
                                    }
//                                echo $_GET['boox'];
                                    
                                
                                    $sql = "SELECT 
                                        article.article_id
                                        ,copy_id
                                        ,article_titel
                                        ,article_category
                                        ,article_publisher
                                        ,article_author
                                        ,copy_position
                                        ,copy_state
                                        
                                        
                                    from `article` , `copy` 
                                    where copy.article_id = article.article_id 
                                        
                                    and $type  like $search

                                        ";
                            

                                    $result = $conn->query($sql);

                                    $total  = $result->num_rows ;

                                    if ($total == 0) {
                                       $total = 1;
                                    }


                                    $limit = 10;

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





                                    //end pagination    
                                    $sql = "
                                        SELECT 
                                        article.article_id
                                        ,copy_id
                                        ,article_titel
                                        ,article_category
                                        ,article_publisher
                                        ,article_author
                                        ,copy_position
                                        ,copy_state
                                        ,article_borrowable
                                        
                                        
                                    from `article` , `copy` 
                                    where copy.article_id = article.article_id 
                                        
                                    and $type  like $search

                                        limit $offset , $limit 
                                        ";
                            

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {  
                                            if ($row['copy_state'] == 'متوفر') {
                                                $check = '';
                                            }else{
                                                $check = ' disabled';
                                            }
                                            if (!$row["article_borrowable"]) {
                                                $check = ' disabled';
                                            }
                                            echo'
                                                <tr>
                                                    <td><input type="checkbox" name="checkbox_[]"'.$check.' value="'.$row["copy_id"].'"  onclick="storedata('.$row["copy_id"].');"'.'    id="check__'.$row["copy_id"].'"'.'></td>
                                                    <td>'.$row["copy_id"].'</td>
                                                    <td>'.$row["article_titel"].'</td>
                                                    <td>'.$row["article_author"].'</td>
                                                    <td>'.$row["copy_position"].'</td>
                                                    <td>'.$row["article_category"].'</td>
                                                    <td>'.$row["article_publisher"].'</td>
                                                </tr>
                                            ';
                                        }
                                    }else{
                                         echo "<tr><td colspan ='9'>لا توجد كتب</td></tr>";
                                         exit();
                                    }
                                    
                                    
                                    // The "back" link
//                                    $prevlink = ($page > 1) ? '<a href="?search='.$nextsearch.'&submit=ابحث&page=1" title="First page">&laquo;</a> <a href="?search='.$nextsearch.'&submit=ابحث&page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                                    // The "forward" link
//                                    $nextlink = ($page < $pages) ? '<a href="?search='.$nextsearch.'&submit=ابحث&page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?search='.$nextsearch.'&submit=ابحث&page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
//                                echo $a;
                                ?>

                                <?php 
                                $prevlink = sprintf(($page > 1) ? '<a class="link" href="?search='.$abc.'&submit=ابحث&page=1&selectedvalue=&selector='.$selector.'" title="First page">&laquo;</a> <a class="link" href="?search='.$abc.'&submit=ابحث&page=' . ($page - 1) . '&selectedvalue=&selector='.$selector.'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>');
                                ?>
                                <?php 
                                $nextlink = ($page < $pages) ? '<a class="link" href="?search='.$abc.'&submit=ابحث&page=' . ($page + 1) . '&selectedvalue=&selector='.$selector.'" title="Next page">&rsaquo;</a> <a class="link" href="?search='.$abc.'&submit=ابحث&page=' . $pages . '&selectedvalue=&selector='.$selector.'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
                                ?>
<!--
<script>
    document.write(document.getElementById("boox1").value);
   
</script>
-->

                            </table>


                        </div>
                        <div class="container">
                            <div class="panel-footer">
<!--
                                <div class="selected-books">
                                    <p>عدد الكتب:</p>
                                    <div id="selectedValue">0</div>
                                </div>
-->
                               <div></div>
                                <script>
                                    function uncheck() {
                                        var checkboxList = document.getElementsByName('checkbox_[]');

                                        for (var i = 0; i < checkboxList.length; i++) {
                                            checkboxList[i].checked = false;
                                        }
                                    }

                                    function submit() {
                                        var temp = document.getElementById('boox');
                                        temp.value = temp.value.slice(0, temp.value.length - 1);
                                        console.log(temp.value);
                                    }
                                </script>
                                <div>

                                    <input id="cancel" type="button" value="الغاء" onclick="uncheck()">
                                    <input onclick="submit();" id="submit-book" type="submit" value="تأكيد">
                                </div>

                            </div>
                        </div>
                    </form>

                    <?php
                        echo '   <div class="container ">
                            <div id="paging" class="pagination"><span>', $prevlink, ' الصفحة '.$page.' من '.$pages.$nextlink, '</span></div>
                            </div>
                            ';
                    ?>
                </div>


            </div>

        </div>


    </div>


</body>

</html>