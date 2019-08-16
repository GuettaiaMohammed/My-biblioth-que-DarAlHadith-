<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
    <link href="../css/borrow.css" rel="stylesheet" type="text/css">
    <link href="../css/book_edit.css" rel="stylesheet" type="text/css">
    <link href="../css/books_list.css" rel="stylesheet" type="text/css">
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>مكتبة دار الحديث - تعديل كتاب</title>
    <!--
    <script>
        window.onbeforeunload = function() {
            return true;
        };
    </script>
-->
    <script type="text/javascript" language="javascript">
        function enableAlert() {

            window.onbeforeunload = function() {
                return true;
            };
        }

        function disableAlert() {
            window.onbeforeunload = null;
        }
    </script>


</head>

<body>

        <?php 
            include_once 'header.php';


            $sql = "
                    SELECT 
                        article.article_id as articleid
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
                        ,article_memo       
                    from `article`
                    where article_id = ".$_GET['bookid'];

            $result = $conn->query($sql);
            $row = $result->fetch_assoc();


        ?>


        <!--
        <div class="content-container">

            <div class="content">
-->





        <div class="search-result container">


            <!--
                <div class="search-result-head">
                    <p>نتائج البحث</p>
                    <select class="selector filter" id="sortBy">
                        <option value="عنوان"> عنوان  </option>
                        <option value="الكاتب"> الكاتب  </option>
                        <option value="الكلمات المفتاحية"> الكلمات المفتاحية  </option>
                    </select>
                </div>
-->



            <form class="book-information2 container" action="../inc/update_book.php" method="post" enctype="multipart/form-data">

                <div class="title-bar">
                    <p>تعديل معلومات الكتاب</p>
                </div>

                <div class="cover_ container">
                    <img class="coverb" src="../../<?= $row['article_cover']?>" alt="">
                    <input type="file" id="fileInput" name="imageinput" style="display:none;" />
                    <input name ="filefile" id="openfile" type="button" value="حمل غلاف الكتاب" onclick="document.getElementById('fileInput').click();" />
                </div>

                <div class="cover_ container">
                   
            
                    <div class="info">
                        <!--      
                                                  <div class="title">فقه السنة و الحديث</div>-->
                        <input name="articleid" value="<?= $row['articleid']?>" style="display: none;">              

                        

                        
                    
                        <div class="spantoken">
                            <span><div class="info-head"> يمكن إعارة الكتاب: </div></span>
                            <div class="info-input">
                            <select name="borrow" class="selector" id="account_role"  style="width:100%;">
                            <option value="borrow_yes"> نعم</option>
                            <option value="borrow_no">  لا يمكن </option>
                        </select>

                        </div>
                        </div>
                        <div class="spantoken">
                            <span>العنوان: </span>
                            <input required id="search-input" type="text" name="titel" value="<?= $row['article_titel']?>">
                        </div>
                        <div class=" spantoken">
                            <span>الكاتب: </span>
                            <input required id="search-input" type="text" name="author" value="<?= $row['article_author']?>">
                        </div>
                        <div class="spantoken">
                            <span>عدد الصفحات: </span>
                            <input required id="search-input" type="number" name="pages" value="<?= $row['article_pages']?>">
                        </div>
                        <div class="spantoken">
                            <span>سنة النشر: </span>
                            <input required id="search-input" type="date" name="publishingdate" value="<?= $row['article_publishingdate']?>">
                        </div>
                        <div class=" spantoken">
                            <span>دار النشر: </span>
                            <input required id="search-input" type="text" name="publisher" value="<?= $row['article_publisher']?>">
                        </div>
                        <div class=" spantoken">
                            <span>الإختصاص: </span>

                           
                            <div class="spec" style="display:inline-flex;">
                                
                            <script>
                                    var i = 1;
                                    function spec_input(){
                                        if(i>0){
                                            document.getElementsByClassName("spec_select")[0].style.display  = "none";
                                            document.getElementsByClassName("spec_input")[0].style.display = "block";
                                        }else{
                                            document.getElementsByClassName("spec_select")[0].style.display  = "block";
                                            document.getElementsByClassName("spec_input")[0].style.display = "none";
                                        }
                                        i*=-1;
                                    }
                            </script>
                            <select name="category" class="selector spec_select" style="flex:1;">
                            <?php 
                                $sql = "
                                select DISTINCT article_category from article
                            ";
                            $result = $conn->query($sql);
                            while ($row2 = $result->fetch_assoc()) {
                                if($row2['article_category']==$row['article_category']){
                                    
                                echo '<option selected value="'.$row2['article_category'].'">'. $row2['article_category']  .'</option>';
                                }else{
                                    echo '<option value="'.$row2['article_category'].'">'. $row2['article_category']  .'</option>';
                                }
                            }
                             ?>
                            </select>
                            <input name="category" id="search-input" type="text" style="flex:1;display:none;" class="spec_input" >
                            
                            <input class="addspec"  type="button" value="إضافة" onclick="spec_input();">
                            </div>
                           
                           
                             

                        </div>
                        <div class=" spantoken">
                            <span>كلمات مفتاحية: </span>

                            <input required id="search-input" type="text" name="keywords" value="<?= $row['article_keywords']?>">

                        </div>
                        <div class=" spantoken">

                            <span>النوعية: </span>
                            <?php 
                                $tags = $row['article_tags'];
                                $book ="";
                                $magazin ="";
                                $other ="";
                                if ($tags == 'كتاب') {
                                    $book = " selected";
                                }elseif ($tags == 'مجلة') {
                                    $magazin = " selected";
                                }elseif ($tags == 'اخرى') {
                                    $other = " selected";
                                }
                                echo '
                                <select name="tags" class="selector edit-user" type="text" >
                                    <option value="كتاب" '.$book.'>كتاب</option>
                                    <option value="مجلة"'.$magazin.'>مجلة</option>
                                    <option value="اخرى"'.$other.'>اخرى</option>            
                                </select>
                                ';
                             ?>
                        </div>
                        
                    </div>
                <input class="submit_book" id="add " name="submit" type="submit" value="حفظ التغيير" >
                <?php 
                    if (isset($_SESSION['errormsg'])) {
                        echo "<h4>".$_SESSION['errormsg']."</h4>";
                        unset($_SESSION['errormsg']);
                    }
                ?>
                </div>
                <div class=" synopsis">
                    <div class="synopsis-title">عن الكتاب:</div>
                    <textarea name="synopsis" class="synopsis-content" rows="4" cols="50"><?= $row['article_synopsis']?></textarea>


                </div>
                   
                    <div class=" synopsis memo">
                    <div class="synopsis-title"> ملاحظات:</div>
                    <textarea name="memo" class="synopsis-content" rows="4" cols="50"><?= $row['article_memo']?></textarea>


                </div>
                        

            </form>
            <form class="book-information3 container" action="../inc/update_add_copy.php" method="get">
                <div class="title-bar">
                    <p>قائمة نسخ الكتاب</p>
                </div>
                <input value="<?= $row['articleid']?>" name="articleid" style="display: none;">
                <div class="panel-footer">
                    <div class="selected-books">
                        <p>عدد النسخ:</p>
                        <div id="selectedValue">     
                            <?php 
                                $sql = 'select * from copy
                                    where article_id = '.$row['articleid']
                                ;
                                $result = $conn->query($sql);
                                echo $result->num_rows;
                            ?>
                        </div>
                    </div>
                    <div>

                        <script>
                            function getTodayDate() {
                                var today = new Date();
                                var dd = today.getDate();
                                var mm = today.getMonth() + 1; //January is 0!
                                var yyyy = today.getFullYear();

                                if (dd < 10) {
                                    dd = '0' + dd
                                }

                                if (mm < 10) {
                                    mm = '0' + mm
                                }

                                today = yyyy + '-' + mm + '-' +dd ;
                                return today;
                            }

                            function addCopy() {
                                var t = document.getElementById('table');
                                var x = document.createElement("TR");
                                x.setAttribute("name", "newCopy");
                                x.setAttribute("class", "newCopy");
                                x.innerHTML = "<td><input name=\"newcopyid[]\" id=\"copyEdit\" type=\"number\" value=\"0\"></td>\
                                    <td><input name=\"newposition[]\" id=\"copyEdit\" type=\"text\" value=\"\" required></td>\
                                    <td><input name=\"newsource[]\" id=\"copyEdit\" type=\"text\" value=\"\ \" required></td>\
                                    <td><input name=\"newdate[]\" id=\"copyEdit\" type=\"date\" value="+getTodayDate()+" required></td>\
                                    <td><input name=\"newprice[]\" id=\"copyEdit\" type=\"number\" value=\"0\"step=\"0.01\" required></td>\
                                    <td><select id=\"availability\" id=\"copyEdit\" name=\"newselection[]\">\
                                            <option value=\"متوفر\"> متوفر  </option>\
                                            <option value=\"معار\"> معار  </option>\
                                            <option value=\"معار\"> مسروق  </option>\
                                            <option value=\"متلف\"> متلف  </option>\
                                        </select>\
                                    </td>";


                                t.appendChild(x);
                            }
                            
                            function cancelChanges(){
                                var parent = document.getElementById("table");
                                while(document.getElementsByClassName("newCopy").length){
                                    parent.removeChild(parent.lastChild);
                                }
                            }
                        </script>
                        <input id="print" type="button" value="إضافة نسخة" onclick="addCopy();enableAlert();">
                        <input id="cancelBtn" type="button" value="إلغاء التغيير" onclick="cancelChanges();disableAlert();">
                        <input id="add" type="submit" value="حفظ التغيير" >

                    </div>



                </div>
                <div class="panel">

                    <div class="panel-content_">



                        <div class="t2" style="overflow-x:auto;">

                            <table id="table">
                                <input name="articleid" value="<?= $row['articleid']?>" style="display: none;">    
                                <tr>
                                    <th>الترقيم</th>
                                    <th>الرف</th>
                                    <th>المصدر </th>
                                    <th>تاريخ الاقتناء </th>
                                    <th>الثمن</th>
                                    <th>الحالة</th>
                                </tr>
                                <?php 
                                    $sql = "
                                        select copy_id,copy_position,copy_source,copy_enteringdate,copy_price
                                        ,copy_state
                                        from copy
                                        where article_id = ".$row['articleid']
                                    ;

                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()){

                                        ($row['copy_state']== "متوفر")?$available=" selected ":$available="";
                                        ($row['copy_state']== "معار")?$borrowed=" selected ":$borrowed="";
                                        ($row['copy_state']== "مسروق")?$stolen=" selected ":$stolen="";
                                        ($row['copy_state']== "متلف")?$damaged=" selected ":$damaged="";
                                        ($row['copy_state']== "محجز")?$reserved=" selected ":$reserved="";

                                        echo '
                                            <tr>
                                                <td><input name="copyid[]" id="copyEdit" type="number" value="'.$row["copy_id"].'" required></td>
                                                <td><input name="position[]" id="copyEdit" type="text" value="'.$row["copy_position"].'" required></td>
                                                <td><input name="source[]" id="copyEdit" type="text" value="'.$row["copy_source"].'" required></td>
                                                <td><input name="date[]" id="copyEdit" type="date" value="'.$row["copy_enteringdate"].'" required></td>
                                                <td><input name="price[]" id="copyEdit" type="number" value="'.$row["copy_price"].'" step="0.01" required></td>
                                                <td><select id="availability" id="copyEdit" name="selection[]" >

                                                        <option value="متوفر"'.$available.'> متوفر  </option>
                                                        <option value="معار"'.$borrowed.'> معار  </option>
                                                        <option value="مسروق"'.$stolen.'> مسروق  </option>
                                                        <option value="متلف"'.$damaged.'> متلف  </option>
                                                        <option value="محجز"'.$reserved.'> محجز  </option>
                                                    </select>
                                                </td>
                                            </tr>
                                        ';
                                    }
                                ?>

                                
                                




                            </table>


                        </div>

                    </div>
                </div>
            </form>

        </div>


    </div>

    <!--
        </div>


    </div>
-->


</body>

</html>