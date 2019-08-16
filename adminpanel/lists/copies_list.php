<?php 
    include_once'header.php';
 ?>
 <script>document.title = "مكتبة دار الحديث - قائمة النسخ";</script>
<div class="panel-title">قائمة النسخ المتوفرة</div>
<form method="get">
    

<div class="panel-search" >
    <input type="text" placeholder="ابحث" name ="search">
    <select class="selector" id="genre" name="selector">
        <option value="العنوان"> العنوان  </option>
        <option value="الترقيم"> الترقيم  </option>
        <option value="الكاتب"> الكاتب  </option>
        <option value="التخصص"> التخصص  </option>
        <option value="دار النشر"> دار النشر  </option>
    </select>
    <input type="image" src="../pics/icons/searchBlack.svg" id="search-icon" name="submit">
</div>
<div class="container">
                   <script>
                    
                       
                       function all_(){
                           for( var i = 1 ; i<4 ; i++){
                               var id = "ch"+i;
                               document.getElementById(id).checked = false;
                           }
                       }
                       function change(k){
                           var n = 0;
                           for( var i = 1 ; i<4 ; i++){
                               var id = "ch"+i;
//                               document.getElementById(id).checked = false;
                               if(document.getElementById(id).checked == true){
                                   n++;
                               }
                           }
                           console.log(n);
                           if(n==0){
                               document.getElementById('checkbox_all').checked = true;
                           }else{
                               
                               document.getElementById('checkbox_all').checked = false;
                           }
                           if(k==1){
                               if(document.getElementById('ch1').checked){
                                   document.getElementById('print').href=document.getElementById('print').href+"&checkbox_idle=";
                               }else{document.getElementById('print').href=document.getElementById('print').href.replace("&checkbox_idle=","");
                               }
                           }else if(k==2){
                               if(document.getElementById('ch2').checked){
                                   document.getElementById('print').href=document.getElementById('print').href+"&checkbox_damaged=";
                               }else{document.getElementById('print').href=document.getElementById('print').href.replace("&checkbox_damaged=","");
                               }
                           }else if(k==3){
                               if(document.getElementById('ch3').checked){
                                   document.getElementById('print').href=document.getElementById('print').href+"&checkbox_stolen=";
                               }else{document.getElementById('print').href=document.getElementById('print').href.replace("&checkbox_stolen=","");
                               }
                           }
                       }
                       
                       
                    </script>
                    <div class="checkBoxes">
                       <div class="checkBox">
                        <input type="checkbox" id="checkbox_all" name="checkbox_all" value=""  onchange="all_();" checked> كل الكتب 
                       </div>
                       
                       <div class="checkBox">
                        <input type="checkbox" id="ch1" name="checkbox_idle" value="متوفر" onchange="change(1);"> 
                        حالة عادية  
                       </div>
                       
                       <div class="checkBox">
                        <input type="checkbox" id="ch2" name="checkbox_damaged" value="متلف" onchange="change(2);"> الكتب المتلفة 
                       </div>
                       
                       <div class="checkBox">
                        <input type="checkbox" id="ch3" name="checkbox_stolen" value="مسروق" onchange="change(3);"> الكتب المسروقة 
                       </div>
                    </div>
</div>
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
            
            
           <a href="copies_list_print.php?" id="print">طباعة قائمة الكتب</a>
            
        </div>



    </div>




</div>
<div class="panel-content_">


    <div class="t2" style="overflow-x:auto;">

        <table width="100%">

            <tr>
                <th> </th>
                <!--<th>الترقيم</th>-->
                <th>الترقيم</th>
                <th>العنوان </th>
                <th>الكاتب</th> 
                <th>الحالة</th>
                <th>متوفر</th>
                <th>الرف</th>
                <th>التخصص</th>
                <th>دار النشر</th>
            </tr>
            <?php    
                $abc ='';
                if(!isset($_GET['search']) or empty($_GET['search'])){
                    $search = "'%'";
                }else{
                    $search = "'%".$_GET['search']."%'"; 
                    $abc =$_GET['search'];
                }

                $selector = '';
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
            
            
                $sql_like = "";
                if(isset($_GET['checkbox_all'])){
                    $sql_like.="and copy.copy_state like '%'";
                    $checkbox =  "checkbox_all=";
                }else{
                    if(isset($_GET['checkbox_idle'])){
                        $sql_like.="and copy.copy_state like '%متوفر%'";
                        $checkbox =  "checkbox_idle=".$_GET['checkbox_idle'];
                    }
                    
                    if(isset($_GET['checkbox_damaged'])){
                        $sql_like.="and copy.copy_state like '%متلف%'";
                        $checkbox =  "checkbox_damaged=".$_GET['checkbox_damaged'];
                    }
                    
                    if(isset($_GET['checkbox_stolen'])){
                        $sql_like.="and copy.copy_state like '%مسروق%'";
                        $checkbox =  "checkbox_stolen=".$_GET['checkbox_stolen'];
                    }
                }                             
                    
                //start pagination
                $sql = "
                SELECT 
                article.article_id,
                copy.copy_id,
                article.article_titel,
                article.article_author,
                copy.copy_state,
                copy.copy_position,
                article.article_category,
                article.article_publisher
                FROM 
                copy,article
                WHERE
                copy.article_id = article.article_id
                AND 
                $type  like $search
                ";
                $sql .= $sql_like;
//                echo $sql;
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
                $sql .= "
                    order by article_titel asc
                    limit $offset , $limit 
                    ";
        
//                echo $sql;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {  
                        //<td>'.$row["copy_id"].'</td>
                        if($row["copy_state"] == 'متوفر' || $row["copy_state"]=='معار')
                            $the_state = 'عادي';
                        else
                            $the_state = $row["copy_state"];
                        
                        if($row["copy_state"] == 'متوفر'){
                            $icon = '<img src="../pics/icons/ok.png" alt="">';
                        }else{
                            $icon = '<img src="../pics/icons/warning.png" alt="">';
                        }
                        
                            
                        echo'

                            <tr>
                                <td class="btn-tab"><a class="edit-btn" href="../edit/book_edit.php?bookid='.$row["article_id"].'">تعديل</a></td>
                                <td>'.$row["copy_id"].'</td>
                                <td>'.$row["article_titel"].'</td>
                                <td>'.$row["article_author"].'</td>              
                                <td>'.$the_state.'</td>
                                <td>'.$icon.'</td>
                                <td>'.$row["copy_position"].'</td>
                                <td>'.$row["article_category"].'</td>
                                <td>'.$row["article_publisher"].'</td>
                            </tr>
                        ';
                    }
                }else{
                    echo "<tr><td colspan ='9'>لا توجد نسائخ</td></tr>";
                }
                echo '
                     </table>


                        </div>

                    </div>
                ';

                // The "back" link
                $prevlink = ($page > 1) ? '<a href="?submit=ابحث&page=1&selector='.$selector.'&'.$checkbox.'&search='.$abc.'" title="First page">&laquo;</a> <a href="?submit=ابحث&page=' . ($page - 1) . '&selector='.$selector.'&'.$checkbox.'&search='.$abc.'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                // The "forward" link
                $nextlink = ($page < $pages) ? '<a href="?submit=ابحث&page=' . ($page + 1) . '&selector='.$selector.'&'.$checkbox.'&search='.$abc.'" title="Next page">&rsaquo;</a> <a href="?submit=ابحث&page=' . $pages . '&selector='.$selector.'&'.$checkbox.'&search='.$abc.'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

                echo '   <div class="search-results container">
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