<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet" type="text/css">
    <link href="../css/borrow.css" rel="stylesheet" type="text/css">
    <link href="../css/book_edit.css" rel="stylesheet" type="text/css">
    <link href="../css/books_list.css" rel="stylesheet" type="text/css">
    <title>مكتبة دار الحديث</title>

    <script>document.title = "مكتبة دار الحديث - إضافة كتاب";</script>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">


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



            <form class="book-information2 container" action="../inc/add_book.inc.php" method="post"  enctype="multipart/form-data">

                <div class="title-bar">
                    <p>إضافة كتاب</p>
                </div>

                <div class="cover_ container">
              		<img class="coverb" src="../../<?= $row['article_cover']?>" alt="">
                    <input type="file" id="fileInput" name="imageinput" style="display:none;" />
                    <input name ="filefile" id="openfile" type="button" value="حمل غلاف الكتاب" onclick="document.getElementById('fileInput').click();" />
                </div>

                <div class="cover_ container">
                   
            
                    <div class="info">
                       
                                                     
                        <div class="spantoken">
                            <span>يمكن إعارة الكتاب: </span>
                            <select name="borrow" class="selector" id="account_role"  style="width:100%;">
                            <option value="borrow_yes"> نعم</option>
                            <option value="borrow_no">  لا يمكن </option>
                        </select>
                        </div>                             
                        <div class="spantoken">
                            <span>العنوان: </span>
                            <input id="search-input" type="text" name="titel" value="">
                        </div>
                        <div class=" spantoken">
                            <span>الكاتب: </span>
                            <input id="search-input" type="text" name="author" value="">
                        </div>
                        <div class="spantoken">
                            <span>عدد الصفحات: </span>
                            <input id="search-input" type="number" name="pages" value="">
                        </div>
                        <div class="spantoken">
                            <span>سنة النشر: </span>
                            <input id="search-input" type="date" name="publishingdate" value="">
                        </div>
                        <div class=" spantoken">
                            <span>دار النشر: </span>
                            <input id="search-input" type="text"  name="publisher" value="">
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
                            while ($row = $result->fetch_assoc()) {
                                echo '<option value="'.$row['article_category'].'">'. $row['article_category']  .'</option>';
                            }
                             ?>
                            </select>
                            <input name="category" id="search-input" type="text" style="flex:1;display:none;" class="spec_input" >
                            
                            <input class="addspec"  type="button" value="إضافة" onclick="spec_input();">
                            </div>
                        </div>
                        <div class=" spantoken">
                            <span>كلمات مفتاحية: </span>

                            <input id="search-input" type="text" name="keywords"  value="">

                        </div>
                        <div class=" spantoken">
                            <span>النوعية: </span>
                            <select  class="selector" name="tags" type="text" class="edit-user">
                                <option value="كتاب">كتاب</option>
                                <option value="مجلة">مجلة</option>
                                <option value="اخرى">اخرى</option>            
                            </select>
                        </div>
                        
                        
                        <script>
                            function updateUrl(i) {
                                document.getElementById(i + "_link").value = document.getElementById(i).files[0].name;
                            }
                        </script>
                       <!--
                    <div class=" spantoken">

                        <span><input id="openfile" type="button" value="حمل النسخة الالكترونية" onclick="document.getElementById('pdfupload').click();" />
                            <input id="pdfupload" type="file" style="display:none;" onchange="updateUrl('pdfupload');" />
							</span>
                        <input id="pdfupload_link" class="search-input" type="text" value="https://somewebsite.com/book.pdf">

                    </div>
                    <div class=" spantoken">
                        <script>
                        </script>

                        <span><input id="openfile" type="button" value="حمل النسخة المسموعة" onclick="document.getElementById('audioupload').click();" />
                            <input id="audioupload" type="file" style="display:none;" onchange="updateUrl('audioupload');" />
						</span>
                        <input id="audioupload_link" class="search-input" type="text" value="https://somewebsite.com/book.pdf">

                    </div>
                        	-->
                    </div>
                     <?php 
                    if (isset($_SESSION['errormsg'])) {
                        echo "<h4>".$_SESSION['errormsg']."</h4>";
                        unset($_SESSION['errormsg']);
                    }
                ?>
                </div>
                <div class=" synopsis">
                    <div class="synopsis-title">عن الكتاب:</div>
                    <textarea class="synopsis-content" rows="4" cols="50"  name="synopsis"></textarea>


                </div>



                        

					<input class="submit_book" id="add " name="submit" type="submit"  value="إضافة الكتاب" >
            </form>

        </div>


    </div>

    <!--
        </div>


    </div>
-->


</body>

</html>