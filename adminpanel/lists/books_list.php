<?php 
    include_once'header.php';
 ?>
 <script>document.title = "مكتبة دار الحديث - قائمة الكتب";</script>
<div class="panel-title">قائمة الكتب</div>
<form class="panel-search" method ="get">
    <input type="text" placeholder="ابحث" name ="search">
    <select class="selector" id="genre" name="selector">
        <option value="العنوان"> العنوان  </option>
        <option value="الترقيم"> الترقيم  </option>
        <option value="الكاتب"> الكاتب  </option>
        <option value="التخصص"> التخصص  </option>
        <option value="دار النشر"> دار النشر  </option>
    </select>
    <input type="image" src="../pics/icons/searchBlack.svg" id="search-icon" name="submit">
</form>
<div class="container">
    <div class="panel-footer">
        <div class="selected-books">
            <p>عدد الكتب:</p>
            <div id="selectedValue">
                <?php 
                    $sql = 'select * from copy';
                    $result = $conn->query($sql);
                    echo $result->num_rows;
                ?>
            </div>
        </div>
        <div>
        
        <input id="add" type="button" value="إضافة كتاب" onclick="location.href='../edit/book_add.php';" >
        <input id="edit" class="edit-btn" type="button" value="قائمة النسخ" onclick="location.href='../lists/copies_list.php';">
           <a href="books_list_print.php?" id="print">طباعة قائمة الكتب</a>
            
        </div>



    </div>




</div>
<div class="panel-content_" >


    <div class="t2" style="overflow-x:auto;">

        <table width="100%" id="printable">

            <tr>
                <th> </th>
                <!--<th>الترقيم</th>-->
                <th>العنوان</th>
                <th>عدد النسخ </th>
                <th>النسخ المتوفرة</th> 
                <th>الكاتب</th>
                <th>الرف</th>
                <th>التخصص</th>
                <th>دار النشر</th>
            </tr>
            <?php    
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
                

                
                //start pagination
                $sql = "SELECT 
                    article.article_id
                    ,copy_id
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
                    ,count(copy_id) as article_copies
                    ,sum(case when copy_state = 'متوفر' then 1 else 0 end) as available_copies
                    
                    
                from `article` left join `copy` on
                    copy.article_id = article.article_id 
                    
                where $type  like $search

                group by  article.article_id
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
                        ,count(copy_id) as article_copies
                        ,sum(case when copy_state = 'متوفر' then 1 else 0 end) as available_copies
                        ,GROUP_CONCAT(copy_position) as copy_position
                        
                        
                    from `article` left join `copy` on
                        copy.article_id = article.article_id 
                        
                    where $type like $search

                    group by  article.article_id
                    order by article_titel asc
                    limit $offset , $limit 
                    ";
        

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {  
                        //<td>'.$row["copy_id"].'</td>
                        $pos = implode(',',array_unique(explode(',', $row["copy_position"])));
                        echo'

                            <tr>
                                <td class="btn-tab"><a class="edit-btn" href="../edit/book_edit.php?bookid='.$row["article_id"].'">تعديل</a></td>
                                <td>'.$row["article_titel"].'</td>
                                <td>'.$row["article_copies"].'</td>
                                <td>'.$row["available_copies"].'</td>              
                                <td>'.$row["article_author"].'</td>
                                <td>'.$pos.'</td>
                                <td>'.$row["article_category"].'</td>
                                <td>'.$row["article_publisher"].'</td>
                            </tr>
                        ';
                    }
                }else{
                    echo "<tr><td colspan ='9'>لا توجد كتب</td></tr>";
                }
                echo '
                     </table>


                        </div>

                    </div>
                ';

                // The "back" link
                $prevlink = ($page > 1) ? '<a href="?submit=ابحث&page=1&selector='.$selector.'&search='.$abc.'" title="First page">&laquo;</a> <a href="?submit=ابحث&page=' . ($page - 1) . '&selector='.$selector.'&search='.$abc.'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                // The "forward" link
                $nextlink = ($page < $pages) ? '<a href="?submit=ابحث&page=' . ($page + 1) . '&selector='.$selector.'&search='.$abc.'" title="Next page">&rsaquo;</a> <a href="?submit=ابحث&page=' . $pages . '&selector='.$selector.'&search='.$abc.'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

               echo '    <div class="search-result container">
                <div id="paging" class="pagination">', $prevlink, ' الصفحة '.$page.' من '.$pages.$nextlink, '</div>
                </div>
                ';
            ?>
            
                    
                    
        
                </div>

            </div>

        </div>


    </div>


</body>

</html>