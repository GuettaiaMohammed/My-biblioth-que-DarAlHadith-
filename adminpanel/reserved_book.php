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
    <title> مكتبة دار الحديث - قائمة الكتب المحجوزة</title>
    

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
                    <a href="return_book.php"><img src="../pics/icons/return.svg" alt="">إرجاع</a>
                    <a href="#"><img src="../pics/icons/reserve.svg" alt="">الحجز</a>
                    <a href="lists/member_list.php"><img src="../pics/icons/members.svg" alt="">الأعضاء</a>
                    <a href="lists/books_list.php"><img src="../pics/icons/books.svg" alt="">الكتب</a>
<!--                    <a href=""><img src="../pics/icons/statistics.svg" alt="">الإحصاءات</a>-->
	                <a href="setting.php "><img src="../pics/icons/settings.svg " alt=" ">إعدادات</a>

                </div>
            </div>
        </div>


        <div class="content-container">

            <div class="content">

                <div class="panel">
                    <div class="panel-title">قائمة الكتب المحجوزة</div>
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
                                        $sql = "select * from copy
                                            where copy_state = 'محجز'
                                        ";
                                        $result = $conn->query($sql);
                                        echo $result->num_rows;
                                    ?></div>
                            </div>
                            <div>
                                
                                
                                
                            </div>



                        </div>




                    </div>
                    <div class="panel-content_">


                        <div class="t2" style="overflow-x:auto;">

                            <table width="100%">
                                
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

                                    $sql = "
                                        SELECT reservation_id,copy.copy_id as copyid,article_titel,reservation_date,reservation_returndate,
                                        libuser_firstname,libuser_lastname
                                        from article,copy,reservation,libuser
                                        where article.article_id = copy.article_id
                                            and copy.copy_id = reservation.copy_id
                                            and reservation.libuser_id = libuser.libuser_id
                                            and copy_state = 'محجز'
                                            and reservation_done = false
                                            and $type like $search
                                            order by article_titel asc
                                         "
                                    ;

                                    $result = $conn->query($sql);

                                    $total  = $result->num_rows ;

                                    if ($total == 0) {
                                        echo "لا يوجد كتب  محجوزة.";
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

                                    $sql = "
                                        SELECT reservation_id,copy.copy_id as copyid,article_titel,reservation_date,reservation_returndate,
                                        libuser_firstname,libuser_lastname
                                        from article,copy,reservation,libuser
                                        where article.article_id = copy.article_id
                                            and copy.copy_id = reservation.copy_id
                                            and reservation.libuser_id = libuser.libuser_id
                                            and copy_state = 'محجز'
                                            and reservation_done = false
                                            and $type like $search
                                            order by article_titel asc
                                            limit $offset , $limit 
                                         "
                                    ;

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        echo '
                                        <tr>
                                            <th> </th>
                                            <th>ترقيم الكتاب</th>
                                            <th>عنوان الكتاب</th>
                                            <th>اسم المشترك </th>
                                            <th>تاريخ الإعارة </th>
                                            <th>تاريخ الإعادة </th>
                                        </tr>
                                        ';
                                        while ($row = $result->fetch_assoc()) {
                                            echo'

                                                <tr>
                                                    <td class="btn-tab"><a class="return-btn" href="inc/cancel_reservation.inc.php?copyid='.$row['copyid'].'&reservationid='.$row['reservation_id'].'">إلغاء</a></td>
                                                    <td>'.$row['copyid'].'</td>
                                                    <td>'.$row['article_titel'].'</td>
                                                    <td>'.$row['libuser_firstname'].', '.$row['libuser_lastname'].'</td>
                                                    <td>'.$row['reservation_date'].'</td>
                                                    <td>'.$row['reservation_returndate'].'</td>
                                                </tr>'
                                            ;
                                        }
                                    }else{
                                        echo "لا يوجد كتب  محجوزة.";
                                    }
                                    // The "back" link
                                    $prevlink = ($page > 1) ? '<a href="?submit=ابحث&page=1&selector='.$selector.'&search='.$abc.'" title="First page">&laquo;</a> <a href="?submit=ابحث&page=' . ($page - 1) . '&selector='.$selector.'&search='.$abc.'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

                                    // The "forward" link
                                    $nextlink = ($page < $pages) ? '<a href="?submit=ابحث&page=' . ($page + 1) . '&selector='.$selector.'&search='.$abc.'" title="Next page">&rsaquo;</a> <a href="?submit=ابحث&page=' . $pages . '&selector='.$selector.'&search='.$abc.'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

                                    
                                 ?>
                            </table>


                        </div>

                    </div>
                    
                    <!--  pagination  -->
                    <?php 

                        echo '   <div class="container">
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