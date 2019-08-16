<?php 
    include_once'header.php';
 ?>
                   <script>document.title = "مكتبة دار الحديث - قائمة المشتركين";</script>
                    <div class="panel-title">قائمة المشتركين</div>
                    <form class="panel-search" method="get">
                        <input type="text" placeholder="ابحث" name="search">
                        <select class="selector" id="genre" name="selector">
                            <option value="الاسم"> الاسم  </option>
                            <option value="تاريخ الميلاد"> تاريخ الميلاد  </option>
                        </select>
                        <input type="image" src="../pics/icons/searchBlack.svg" id="search-icon">
                    </form>
                    <div class="container">
                        <div class="panel-footer">
                            <div class="selected-books">
                                <p>عدد المشتركين:</p>
                                <div id="selectedValue">
                                    <?php 
                                        $sql = 'select * from libuser';
                                        $result = $conn->query($sql);
                                        echo $result->num_rows;
                                    ?>
                                </div>
                            </div>
                            <div>

                                <input id="add" type="button" value="إضافة مشترك" onclick="location.href='../edit/user-add.php';">
                            <a href="member_list_print.php" id="print"> طباعة قائمة المشتركين</a>

                            </div>



                        </div>




                    </div>
                    <div class="panel-content_">


                        <div class="t2" style="overflow-x:auto;">

                            <table>
                                
                                <?php 
                                    $selector ='';
                                    $abc = '';
                                    if(!isset($_GET['search']) or empty($_GET['search'])){
                                        $search = "'%'";
                                    }else{
                                        $search = "'%".$_GET['search']."%'"; 
                                        $abc =$_GET['search'];
                                    }
                                    $type = "CONCAT(libuser_firstname,  ' ', libuser_lastname)";
                                    if (isset($_GET["selector"])) {
                                        if ($_GET["selector"] == "الاسم") {
                                            $type = "CONCAT( libuser_firstname,  ' ', libuser_lastname )";
                                        }
                                        if ($_GET["selector"] == "تاريخ الميلاد") {
                                            $type = "libuser_birthdate";
                                        }
                                        $selector = $_GET["selector"];

                                    }

                                    $sql= "
                                         SELECT libuser.libuser_id,libuser_firstname,libuser_lastname,libuser_birthdate
                                            ,libuser_birthplace,libuser_adress,libuser_speciality
                                            ,libuser_susbcriptiondate,libuser_email,libuser_phonenumber
                                            ,sum(case when copy_state = 'معار' and borrow_returned = false then 1 else 0 end) as available_copies
                                            ,sum(CASE WHEN (borrow_returndate < now() and borrow_returned = false) THEN 1 ELSE 0 END) as past
                                        from libuser left join 
                                            borrow on libuser.libuser_id = borrow.libuser_id
                                            left join copy on copy.copy_id = borrow.copy_id
                                        where $type like $search
                                        group by libuser.libuser_id
                                    ";

                                     $result = $conn->query($sql);

                                    $total  = $result->num_rows ;

                                    if ($total == 0) {
                                        echo'لا يوجد منخرطون';
                                        exit();
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


                                    $sql= "
                                         SELECT libuser.libuser_id,libuser_firstname,libuser_lastname,libuser_birthdate
                                            ,libuser_birthplace,libuser_adress,libuser_speciality
                                            ,libuser_susbcriptiondate,libuser_email,libuser_phonenumber
                                            ,sum(case when copy_state = 'معار'and borrow_returned = false then 1 else 0 end) as available_copies
                                            ,sum(CASE WHEN (borrow_returndate < now() and borrow_returned = false)THEN 1 ELSE 0 END) as past
                                        from libuser left join 
                                            borrow on libuser.libuser_id = borrow.libuser_id
                                            left join copy on copy.copy_id = borrow.copy_id
                                        where $type like $search
                                        group by libuser.libuser_id
                                            order by libuser_firstname asc
                                            limit $offset , $limit 
                                    ";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        echo '<tr>
                                    <th></th>
                                    <th>الاسم الكامل</th>
                                    <th>تاريخ الميلاد</th>
                                    <th>مكان الميلاد</th>
                                    <th>العنوان</th>
                                    <th>عدد الكتب</th>
                                    <th>تجاوز</th>
                                    <th>المهنة</th>
                                    <th>تاريخ التسجيل</th>
                                    <th>إيميل</th>
                                    <th>الهاتف</th>
                                </tr>';
                                        while ($row = $result->fetch_assoc()) {  
                                            if ($row['past'] > 0) {
                                                $state = '../pics/icons/warning.png';
                                            }else{
                                                $state = '../pics/icons/ok.png';
                                            }
                                            echo'
                                                <tr>
                                                <td class="btn-tab"><a class="edit-btn" href="../edit/user-edit.php?userid='.$row["libuser_id"].'">تعديل</a></td>
                                                <td>'.$row["libuser_firstname"].' ,'.$row["libuser_lastname"].'</td>
                                                <td>'.$row["libuser_birthdate"].'</td>
                                                <td>'.$row["libuser_birthplace"].'</td>
                                                <td>'.$row["libuser_adress"].'</td>
                                                <td>'.$row["available_copies"].'</td>
                                                <td><img src="'.$state.'" alt=""></td>
                                                <td>'.$row["libuser_speciality"].'</td>
                                                <td>'.$row["libuser_susbcriptiondate"].'</td>
                                                <td>'.$row["libuser_email"].'</td>
                                                <td>'.$row["libuser_phonenumber"].'</td>
                                                </tr>
                                            ';
                                        }
                                    }

                                   // The "back" link
                                    $prevlink = ($page > 1) ? '<a href="?submit=ابحث&page=1&selector='.$selector.'&search='.$abc.'" title="First page">&laquo;</a> <a href="?submit=ابحث&page=' . ($page - 1) . '&selector='.$selector.'&search='.$abc.'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                                    // The "forward" link
                                    $nextlink = ($page < $pages) ? '<a href="?submit=ابحث&page=' . ($page + 1) . '&selector='.$selector.'&search='.$abc.'" title="Next page">&rsaquo;</a> <a href="?submit=ابحث&page=' . $pages . '&selector='.$selector.'&search='.$abc.'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';


                                ?>

                            </table>

                        </div>

                    </div>
                    
                             <?php echo '   <div class=" container">
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