<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
    <link href="../css/borrow.css" rel="stylesheet" type="text/css">
    <link href="../css/borrow_user_selection.css" rel="stylesheet" type="text/css">
    <title>مكتبة دار الحديث</title>


    <meta http-equiv="content-type" content="text/html; charset=UTF-8">






</head>

<body>

    <div class="body-container">
         <?php 
            include_once 'header.php';
        if(!isset($_GET['boox']) || empty($_GET['boox']) ){
            header('Location: borrow_book_selection.php');
            exit();
        }
        ?>


        <div class="content-container">

            <div class="content">

                <div class="panel">
                    <div class="panel-title">إعارة الكتب</div>
                    <div class="panel-title1">قائمة المشتركين</div>
                    <form class="panel-search">
                        <input type="hidden" placeholder="ابحث" name="checkbox_" value="<?php?>">
                        <input type="text" placeholder="ابحث" name="search">
                        <select class="selector" id="user-selection" name="selector">
                            <option value="الاسم"> الاسم  </option>
                            <option value="تاريخ الميلاد"> تاريخ الميلاد  </option>
                        </select>
                        <input type="image" src="../pics/icons/searchBlack.svg" id="search-icon">
                        <input type="text" name="boox" id="boox1" style="display:none;" value="<?php echo $_GET['boox'];?>">
                    </form>
                    <form class="panel-content " action="../inc/borrow.inc.php" method="get">

                        <input type="text" name="boox" id="boox1" style="display:none;" value="<?php echo $_GET['boox'];?>">
                        <div class="t2" style="overflow-x:auto;">

                            <table width="100%">
                                <tr>
                                    <th>اختيار</th>
                                    <th>الاسم الكامل</th>
                                    <th>تاريخ الميلاد</th>
                                    <th>مكان الميلاد</th>
                                    <th>العنوان</th>
                                    <th>عدد الكتب</th>
                                    <th>تجاوز</th>
                                </tr>

                                <?php 
                                    
                                    
                                    $nextsearch  ='';
                                    if(!isset($_GET['search'])){
                                        $search = "'%'";
                                    }else{
                                        $search = "'%".$_GET['search']."%'"; 
                                        $nextsearch = $_GET['search'];
                                    }
                                    $selector = '';
                                    if (isset($_GET["selector"])) {
                                        if ($_GET["selector"] == "الاسم") {
                                            $type = "CONCAT( libuser_firstname,  ' ', libuser_lastname )";
                                        }
                                        if ($_GET["selector"] == "تاريخ الميلاد") {
                                            $type = "libuser_birthdate";
                                        }
                                        $selector = $_GET["selector"];

                                    }else{
                                        $type = "CONCAT(libuser_firstname,  ' ', libuser_lastname)";
                                    }

                                    $sql= "
                                        SELECT libuser.libuser_id,libuser_firstname,libuser_lastname,libuser_birthdate
                                            ,libuser_birthplace,libuser_adress                    
                                            ,sum(case when copy_state = 'معار' and borrow_returned = false  then 1 else 0 end) as available_copies
                                            ,sum(CASE WHEN (borrow_returndate < now() and borrow_returned = false)THEN 1 ELSE 0 END) as past
                                        from libuser left join 
                                            borrow on libuser.libuser_id = borrow.libuser_id
                                            left join copy on copy.copy_id = borrow.copy_id
                                        where $type like $search
                                        group by libuser.libuser_id
                                    ";

                                    $result = $conn->query($sql);

                                    $total  = $result->num_rows ;

                                    if ($total == 0) {
                                        echo'no results';
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
                                        SELECT libuser.libuser_id as userid,libuser_firstname,libuser_lastname,libuser_birthdate
                                            ,libuser_birthplace,libuser_adress,libuser_blocked                   
                                            ,sum(case when copy_state = 'معار' and borrow_returned = false then 1 else 0 end) as available_copies
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
                                        while ($row = $result->fetch_assoc()) {  
                                            $disabled ="";
                                            if ($row["libuser_blocked"]) {
                                                $disabled = " disabled";
                                            }                                            
                                            if ($row['past'] > 0) {
                                                $state = '../pics/icons/warning.png';
                                            }else{
                                                $state = '../pics/icons/ok.png';
                                            }
                                            echo'
                                                <tr>
                                                <td><input type="radio" name="userid" value="'.$row["userid"].'"'.$disabled.'></td>
                                                <td>'.$row["libuser_firstname"].' ,'.$row["libuser_lastname"].'</td>
                                                <td>'.$row["libuser_birthdate"].'</td>
                                                <td>'.$row["libuser_birthplace"].'</td>
                                                <td>'.$row["libuser_adress"].'</td>
                                                <td>'.$row["available_copies"].'</td>
                                                <td><img src="'.$state.'" alt=""></td>
                                                </tr>
                                            ';
                                        }
                                    }

                                   // The "back" link
//                                    $prevlink = ($page > 1) ? '<a href=",submit=ابحث'.$query.'&page=1" title="First page">&laquo;</a> <a href=",submit=ابحث'.$query.'&page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
//
//                                    // The "forward" link
//                                    $nextlink = ($page < $pages) ? '<a href=",submit=ابحث'.$query.'&page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href=",submit=ابحث'.$query.'&page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';


                                ?>

                                <?php 
                                $prevlink = sprintf(($page > 1) ? '<a class="link" href="?search='.$nextsearch.'&submit=ابحث&page=1&boox='.$_GET['boox'].'&selector='.$selector.'" title="First page">&laquo;</a> <a class="link" href="?search='.$nextsearch.'&submit=ابحث&page=' . ($page - 1) . '&boox='.$_GET['boox'].'&selector='.$selector.'" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>');
                                ?>
                                <?php 
                                $nextlink = ($page < $pages) ? '<a class="link" href="?search='.$nextsearch.'&submit=ابحث&page=' . ($page + 1) . '&boox='.$_GET['boox'].'&selector='.$selector.'" title="Next page">&rsaquo;</a> <a class="link" href="?search='.$nextsearch.'&submit=ابحث&page=' . $pages . '&boox='.$_GET['boox'].'&selector='.$selector.'" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
                                ?>
                                
                            </table>


                        </div>
                        <div class="container  ">
                           
                            <div class="container2">
                                <p>عدد أيام الإعارة</p>
                                <?php 
                                    $sql = "
                                        select *
                                        from config
                                    ";
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc();
                                ?>
                                <input class="daynumber" name="numberofdays" type="number" value="<?=$row['config_days_max']?>">
                            </div> 
                            <div class="container2">
                                <input class="borrowsbtn" type="submit" value="إعارة الكتاب">       
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