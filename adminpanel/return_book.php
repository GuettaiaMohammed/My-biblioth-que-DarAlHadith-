<?php 
    include_once '../inc/db.inc.php';
    session_start();
    if (!isset($_SESSION['accountname']) or $_SESSION["role"] != 'admin') {
        header('Location: ../index.php');
        exit();
    }
 ?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="css/admin.css" rel="stylesheet" type="text/css">
    <link href="css/borrow.css" rel="stylesheet" type="text/css">
    <link href="css/books_list.css" rel="stylesheet" type="text/css">
    <link href="css/return_book.css" rel="stylesheet" type="text/css">
    <title> مكتبة دار الحديث - إعادة كتاب</title>
    

    <meta http-equiv="content-type" content="text/html; charset=UTF-8">






</head>

<body>

    <div class="body-container">
        
        <div class="nav">
            <div class="nav-bar">
                    <a href="../index.php"><img class="logo" src="../pics/darelhadith_white.svg" alt="logo"></a>
                    <div class="nav-bar-list">
                        <a href="../index.php">المكتبة<img src="../pics/icons/home.svg" alt=""></a>
                        <a href="../aboutus.php">معلومات عنا<img src="../pics/icons/aboutus.svg" alt=""></a>

                        <?php 
                    if (!isset($_SESSION["accountname"])) {
                        echo '<a href="../register.php">تسجيل <img src="../pics/icons/password.svg" alt=""></a>';
                        echo "<a href=\"../login.php\">دخول <img src=\"../pics/icons/members.svg\" alt=\"\"></a>";
                    }else{
                        
                        echo'<a href="../userpanel">حساب المستخدم<img src="../pics/icons/account.svg" alt=""></a>';
                        if ($_SESSION["role"] == 'admin') {
                        	echo "<a href=\"../adminpanel\">إدارة المكتبة<img src=\"../pics/icons/settings.svg\" alt=\"\"></a>";
                        }
                        echo'<a href="../inc/logout.inc.php">خروج<img src="../pics/icons/logout.svg" alt=""></a>';
                    }
                 ?>
                    </div>
                </div>

            <div class="sub-nav-bar" id="sub-nav-bar">

                <div class="sub-nav-bar-list">
                    <a href="index.php"> <img src="../pics/icons/home.svg" alt="">  البداية</a>
                    <a href="borrow/borrow_book_selection.php"><img src="../pics/icons/borrow.svg" alt="">إعارة</a>
                    <a href="#"><img src="../pics/icons/return.svg" alt="">إرجاع</a>
                    <a href="reserved_book.php"><img src="../pics/icons/reserve.svg" alt="">الحجز</a>
                    <a href="lists/member_list.php"><img src="../pics/icons/members.svg" alt="">الأعضاء</a>
                    <a href="lists/books_list.php"><img src="../pics/icons/books.svg" alt="">الكتب</a>
<!--                    <a href=""><img src="../pics/icons/statistics.svg" alt="">الإحصاءات</a>-->
	                <a href="setting.php"><img src="../pics/icons/settings.svg " alt=" ">إعدادات</a>

                </div>
            </div>
        </div>


        <div class="content-container">

            <div class="content">

                <div class="panel">
                    <div class="panel-title">قائمة الكتب المعارة</div>
                    <form class="panel-search" method="get ">
                        <input type="text" placeholder="ابحث" name="search">
                        <select class="selector" id="genre" name="selector">
                            <option value="العنوان"> العنوان  </option>
                            <option value="الترقيم"> الترقيم  </option>
                            <option value="الكاتب"> الكاتب  </option>
                            <option value="التخصص"> التخصص  </option>
                            <option value="دار النشر"> دار النشر  </option>
                        </select>
                        <input name="search" type="image" src="pics/icons/searchBlack.svg" id="search-icon">
                    </form>
                    <div class="container">
                        <div class="panel-footer">
                            <div class="selected-books">
                                <p> عدد الكتب المعارة:</p>
                                <div id="selectedValue"><?php 
                                        $sql = 'select * from borrow
                                            where borrow_returned = false
                                        ';
                                        $result = $conn->query($sql);
                                        echo $result->num_rows;
                                    ?></div>
                            </div>
                            <div>
                                
                                
                            <a href="return_book_print.php" id="print">طباعة</a>
                            <input id="edit" class="edit-btn" type="button" value="ارشيف" onclick="location.href='archive.php';">
                                
                            </div>



                        </div>




                    </div>
                    <div class="panel-content_">


                        <div class="t2" style="overflow-x:auto;">

                            <table width="100%">
                                <tr>
                                    <th> </th>
                                    <th> </th>
                                    <th>ترقيم الكتاب</th>
                                    <th>عنوان الكتاب</th>
                                    <th>اسم المشترك </th>
                                    <th>تاريخ الإعارة </th>
                                    <th>تاريخ الإعادة </th>
                                    <th>حالة الكتاب</th>
                                    <th>عدد أيام الاستخدام </th>
                                    <th>تجاوز</th>
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

                                    $sql= "
                                        SELECT copy.copy_id,libuser_firstname,libuser_lastname
                                            ,borrow_date,borrow_returndate,DATEDIFF(borrow_returndate,borrow_returndate)

                                        from copy,article,libuser,borrow
                                        where copy.article_id = article.article_id
                                            and copy.copy_id = borrow.copy_id
                                            and libuser.libuser_id = borrow.libuser_id 
                                            and copy_state = 'معار'
                                            and borrow_returned = false
                                            and $type like $search";
                                    
                                    $result = $conn->query($sql);

                                    $total  = $result->num_rows ;

                                    if ($total == 0) {
                                        echo'<tr><td colspan="10">لا توجد نتائج</td></tr><table>';
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
                                        SELECT copy.copy_id as copy_id,libuser_firstname,libuser_lastname,article_titel,borrow_id
                                            ,borrow_date,borrow_returndate,DATEDIFF(borrow_returndate,borrow_returndate) as days
                                            ,(CASE WHEN borrow_returndate < now()  and borrow_returned = false THEN true ELSE false END) as past,
                                            borrow.libuser_id
                                        from copy,article,libuser,borrow
                                        where copy.article_id = article.article_id
                                            and copy.copy_id = borrow.copy_id
                                            and libuser.libuser_id = borrow.libuser_id 
                                            and copy_state = 'معار'
                                            AND borrow_returned = false
                                            and $type like $search
                                        limit $offset , $limit 
                                    ";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {  
                                            if ($row['past']) {
                                                $state = '../pics/icons/warning.png';
                                                $notify = '<td class="btn-tab"><a href="pass_notification_gen.php?user='.$row['libuser_id'].'"  class="cancel-btn" >إشعار</a></td>';
                                            }else{
                                                $notify="<td></td>";
                                                $state = '../pics/icons/ok.png';
                                            }
                                            echo'
                                                <form action = "inc/return.inc.php" method="get">
                                                <tr>
                                                    '.$notify.'
                                                   
                                                    <td class="btn-tab"><input type ="submit" name = "submit" class="return-btn" value="ارجاع"></td>

                                                    <td>'.$row['copy_id'].'</td>
                                                    <input type = "hidden" value="'.$row['copy_id'].'" name="copyid">
                                                    <input type = "hidden" value="'.$row['borrow_id'].'" name="borrowid">
                                                    <td>'.$row['article_titel'].'</td>
                                                    <td>'.$row['libuser_firstname'].','.$row['libuser_lastname'].'</td>
                                                    <td>'.$row['borrow_date'].'</td>
                                                    <td>'.$row['borrow_returndate'].'</td>
                                                    <td>
                                                        <select name = "stat">
                                                            <option value="عادي">عادي</option>
                                                            <option value="متلف">متلف</option>
                                                        </select>
                                                    </td>
                                                    <td>'.$row['days'].'</td>
                                                    <td><img src="'.$state.'" alt=""></td>
                                                </tr>
                                                </form>
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
                    
                   <?php 

                        echo '   <div class="container">
                                    <div id="paging" class="pagination">'. $prevlink. ' الصفحة '.$page.' من '.$pages.$nextlink. '</div>
                                    </div>
                                    ';
                    ?>
                </div>

            </div>
            

        </div>


    </div>


</body>

</html>