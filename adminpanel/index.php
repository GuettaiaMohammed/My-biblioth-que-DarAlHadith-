
<style type="text/css">
.book-s {
    width: 100%;
    height: 215px;
    background-color: rgba(239, 239, 239, .9);

}

.book-s img {
    height: 200px;
    padding-top: 7.5px;
    padding-right: 7.5px;
}

.book-info {
    padding-top: 40px;
    width: 180px;
    float :left;
}

.book-info > * {
    font-family: serif;
    color: #969696;
}

.book-info > a {
    text-decoration: none;
    width: 100%;
    height: auto;
    color: #4D4D4D;
    font-size: 25px;
}
.book-info > p {
    text-decoration: none;
    width: 100%;
    height: auto;
    font-size: 17px;
}


.mySlides {
    display: none;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}


</style>

<?php 
    include_once 'header.php';
    echo '<script>document.title = "مكتبة دار الحديث - إدارة المكتبة";</script>'; 
    $sql = "SELECT * FROM borrow WHERE borrow.borrow_returndate < now() and borrow.borrow_returned = 0";
    $result = $conn->query($sql);

    $number = $result->num_rows;
    echo
    '
    
        <div class="box box1">
            <div class="box-title">تجاوزات المدة</div>
            <div class="box-content">
                <div class="box-value">'.$number.'</div>
                <div class="box-tag">تجاوز</div>
            </div>
        </div>
    ';

    $sql = "SELECT * FROM borrow WHERE borrow.borrow_returned = 0
            ";
    $result = $conn->query($sql);

    $number = $result->num_rows;

    echo
    '
        <div class="box box2">
            <div class="box-title">الكتب المعارة</div>
            <div class="box-content">
                <div class="box-value">'.$number.'</div>
                <div class="box-tag">كتاب</div>
             </div>
         </div>
    ';

    $sql = 'select DATE_FORMAT(borrow_date, "%m") as borrow_month,count(*) as borrow_count
            from borrow
            WHERE DATE_FORMAT(borrow_date, "%Y") = DATE_FORMAT(CURRENT_DATE, "%Y")
            GROUP by  DATE_FORMAT(borrow_date, "%M") 
            order by  DATE_FORMAT(borrow_date, "%M")  asc
            ';
    $result = $conn->query($sql);

    $months = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
    while($row = $result->fetch_assoc()) { 
        $i = (int)intval($row['borrow_month']);
        $value = $row['borrow_count'];
        $months[$i] = $value;
    }

    $results = "";

    for ($i=1; $i < 13; $i++) { 
        if ($i == 12) {
            $results .= $months[$i];
        }else{   
            $results .= $months[$i].",";
        }  
    }
    echo"
        <div class=\"box box3\">
        <div  class=\"box-title chart-title\">الإعارات</div>
    
        <canvas id=\"graph\" id=\"graph\" style=\" margin: auto;\" width=\"198\" height=\"198\"></canvas>



        <script>
            var canvas1 = document.getElementById(\"graph\");
            var parent1 = document.getElementById(\"graph\").parentElement;
            canvas1.width = parent1.offsetWidth;

            var MONTHS = ['يناير', 'فبراير', 'مارس', 'أفريل', 'ماي', 'جوان', 'جويليا', 'أوت', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
            var config = {
                type: 'line',
                data: {
                    labels: MONTHS,
                    datasets: [{
                        label: 'إعارة',
                        backgroundColor: window.chartColors.blue,
                        borderColor: window.chartColors.blue,
                        data: [
                            ".$results."    
                        ],
                        fill: false,
                    }]
                },
                options: {

                    responsive: true,
                    legend: {
                        display: false,
                        labels: {
                            fontColor: \"white\"
                        }
                    },
                    title: {
                        display: false,
                        text: 'Chart.js Line Chart'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false

                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: 'Month'


                            },
                            ticks: {
                                fontColor: \"#969696\",
                                fontSize: 17,
                                fontFamily: 'Cairo',
                                stepSize: 1,
                                beginAtZero: true
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: 'Value'
                            }
                        }]
                    }
                }
            };



            var colorNames = Object.keys(window.chartColors);
        </script>





    </div>
    ";





    $sql = "SELECT * FROM libuser";
    $result = $conn->query($sql);

    $number = $result->num_rows;

    echo '
        <div class="box box4">
             <div class="box-title">المشتركون</div>
             <div class="box-content">
                   <div class="box-value">'.$number.'</div>
                   <div class="box-tag">مشترك</div>
              </div>
        </div>
               
    ';
    $sql = "SELECT * FROM copy where copy_state <> 'مسروق'";
    $result = $conn->query($sql);

    $number = $result->num_rows;

    echo '
         <div class="box box5">
             <div class="box-title">عدد الكتب</div>
             <div class="box-content">
                <div class="box-value">'.$number.'</div>
                   <div class="box-tag">كتاب</div>
              </div>
        </div>
    ';

    $sql = "SELECT * from libuser WHERE MONTH(libuser.libuser_susbcriptiondate) = MONTH(CURDATE()) AND YEAR(libuser.libuser_susbcriptiondate) = YEAR(CURDATE()) ";
    $result = $conn->query($sql);

    $number = $result->num_rows;

    echo '
        <div class=" box6 minibox">
            <div class="minibox-content">
                <div class="minibox-title">المشتركون الجدد</div>
                <div class="minibox-value">'.$number.'</div>
            </div>
            <div class="minibox-icon"><img src="pics/icons/newMember.svg" alt=""></div>
        </div>
    ';    

    $sql = "SELECT * FROM copy where MONTH(copy_enteringdate) = MONTH(CURDATE()) AND YEAR(copy_enteringdate) = YEAR(CURDATE())";
    $result = $conn->query($sql);

    $number = $result->num_rows;                

    echo'
        <div class="minibox box7">
            <div class="minibox-content">
                <div class="minibox-title">الكتب المضافة</div>
                <div class="minibox-value">'.$number.'</div>
            </div>
            <div class="minibox-icon"><img src="pics/icons/newBook.svg" alt=""></div>
        </div>

    ';

    $sql = "SELECT *from reservation
    		where reservation_done = false 
    ";

    $result = $conn->query($sql);
    $number = $result->num_rows;
     

    echo'
        <div class="minibox box8">
            <div class="minibox-content">
                <div class="minibox-title">عدد الحجزات</div>
                <div class="minibox-value">'.$number.'</div>
            </div>
            <div class="minibox-icon"><img src="pics/icons/reservationRed.svg" alt=""></div>
        </div>
    ';              

    $sql = "SELECT * FROM libuser
            where libuser_speciality like 'تلميد'
    ";
    $result = $conn->query($sql);
    $etudiant = $result->num_rows; 

    $sql = "SELECT * FROM libuser
            where libuser_speciality like 'طالب'
    ";
    $result = $conn->query($sql);
    $student = $result->num_rows ;

    $sql = "SELECT * FROM libuser
            where libuser_speciality like 'عامل'
    ";
    $result = $conn->query($sql);
    $worker = $result->num_rows ;

    echo"
        <div class=\"box box9\">

            <canvas id=\"donut\" width=\"198\" height=\"198\"></canvas>
            <script>
           

                var randomScalingFactor = function() {
                    return Math.round(Math.random() * 100);
                };

                var config1 = {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [
                                $etudiant,
                                $student,
                                $worker
                            ],
                            backgroundColor: [
                                'rgba(227,104,81,1)',
                                'rgba(1,137,255,1)',
                                'rgba(0,167,123,1)',
                            ],
                            label: 'Dataset 1'
                        }],
                        labels: [
                            'طلاب',
                            'تلاميذ',
                            'عمال'
                        ]
                    },
                    options: {
                        cutoutPercentage: 60,
                        responsive: true,
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                fontSize: 17,
                                fontFamily: 'Cairo',
                                boxWidth: 10,
                            }
                        },
                        title: {
                            fontSize: 20,
                            fontFamily: 'Cairo',
                            display: true,
                            text: 'اختصاصات المشتركين'
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                };
            </script>

        </div>
    ";     
    //TODO add messages table
    echo '
        <div class="box box10"style="background-color :rgba(17, 34, 51, .8);">
            <div class="box-title">آخر الكتب المضافة</div>
        '; 

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
                        ,sum(case when copy_state = 'متوفر' then 1 else 0 end) as available_copies
                        ,sum(case when copy_state = 'معار' then 1 else 0 end) as borrowed
                        
                        
                    from `article` left join `copy` on
                        copy.article_id = article.article_id 

                    group by  article.article_id
                        ,article_titel
                        ,article_tags
                        ,article_synopsis
                        ,article_publisher
                        ,article_cover
                        ,article_category
                        ,article_author  
                    order by article.article_id desc
                    limit 5
                ";
                $i = 1;
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    if(empty($row['article_cover'])) {
                       $cover = "../pics/books/standard.jpg";
                    }else{
                       $cover = '../'.$row['article_cover'];
                    };
                    echo '
                        <div class="book-s mySlides fade">
                            <img class="cover" src="'.$cover.'" alt="">
                            <div class="book-info">
                                <a href="../book_information.php?articleid='.$row['articleid'].'">'.$row['article_titel'].'</a>
                                <p> اسم الكاتب -'.$row['article_author'].'</p>
                                <p>النوع - '.$row['article_tags'].'</p>
                                <p>المجال - '.$row['article_category'].'</p>
                                <p>عدد الإعارات - '.$row['borrowed'].'</p>
                                <p>عدد النسخ المتوفرة -'.$row['available_copies'].'</p>
                            </div>
                        </div>';
                    $i++;
                }

                
                


            echo"</div>";
        


    $sql = "SELECT * from libuser WHERE libuser.libuser_id not in (SELECT account.libuser_id FROM account)";
    $result = $conn->query($sql);
    $account_ = $result->num_rows ;

    $sql = "SELECT * FROM account";
    $result = $conn->query($sql);
    $noaccount_ = $result->num_rows ;

    echo "
        <div class=\"box box11\">
                    <canvas id=\"donut2\" width=\"156\" height=\"156\"></canvas>
                    <script>
                        var canvas = document.getElementById(\"donut2\");
                        var parent = document.getElementById(\"donut2\").parentElement;
                        canvas.width = parent.offsetWidth;
                        canvas.height = parent.offsetHeight;


                        var randomScalingFactor = function() {
                            return Math.round(Math.random() * 100);
                        };

                        var config2 = {
                            type: 'doughnut',
                            data: {
                                datasets: [{
                                    data: [
                                        $account_,
                                        $noaccount_,
                                    ],
                                    backgroundColor: [
                                        'rgb(226,161,37,1)',
                                        'rgb(1,137,255,1)',
                                    ],
                                    label: 'Dataset 1'
                                }],
                                labels: [
                                    ' غير نشطاء  ',
                                    ' نشطاء',
                                ]
                            },
                            options: {
                                cutoutPercentage: 60,
                                responsive: true,
                                legend: {
                                    display: false,
                                    position: 'bottom',
                                    labels: {
                                        fontSize: 15,
                                        fontFamily: 'Cairo',
                                        boxWidth: 10,
                                    }
                                },
                                title: {
                                    fontSize: 15,
                                    fontFamily: 'Cairo',
                                    display: true,
                                    text: 'نسبة المشتركين النشطاء في الموقع'
                                },
                                animation: {
                                    animateScale: true,
                                    animateRotate: true
                                }
                            }
                        };
                    </script>
                </div>
    ";
?>


                
                
                
                
                
                
                
                
            </div>
        </div>


    </div>
    <script type="text/javascript">
        
        var slideIndex = 0;
        showSlides();

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none"; 
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1} 
            slides[slideIndex-1].style.display = "block"; 
            setTimeout(showSlides, 5000); // Change image every 2 seconds
        }
    </script>


</body>
<script>
    window.onload = function() {

        var ctx = document.getElementById('graph').getContext('2d');
        window.myLine = new Chart(ctx, config);
        console.log("wssal");
        var ctx1 = document.getElementById('donut').getContext('2d');
        window.myDoughnut = new Chart(ctx1, config1);

        var ctx2 = document.getElementById('donut2').getContext('2d');
        window.myDoughnut = new Chart(ctx2, config2);
    };
</script>
</html>