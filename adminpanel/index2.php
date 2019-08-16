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
        <div class="box box10">

            <div class="message-box-header">
                <div class="message-icon"><img src="pics/icons/message.svg" alt=""></div>
                <div class="message-box-title">رسائل المستخدمين</div>
            </div>

            <div class="message">

                <div class="message-head">
                    <div class="message-sender-head subtitle">الاسم: </div>
                    <div class="message-sender-name">رياض محمد</div>
                    <div class="message-sendermail-head subtitle">إيميل: </div>
                    <div class="message-sendermail-value">an-email@mail.com</div>
                </div>

                <div class="message-content">لم فسقط بالحرب, قبل يعبأ لإعلان أفريقيا ان, ليبين عسكرياً هذا أم. وقد مارد تعديل والنفيس و, عل لهذه وصغاغير عل, اسبوعين الإمداد المبرمة عدم ثم, دار إعلان ليتسنّ</div>

            </div>
            <div class="message">

                <div class="message-head">
                    <div class="message-sender-head subtitle">الاسم: </div>
                    <div class="message-sender-name">رياض محمد</div>
                    <div class="message-sendermail-head subtitle">إيميل: </div>
                    <div class="message-sendermail-value">an-email@mail.com</div>
                </div>

                <div class="message-content">لم فسقط بالحرب, قبل يعبأ لإعلان أفريقيا ان, ليبين عسكرياً هذا أم. وقد مارد تعديل والنفيس و, عل لهذه وصغاغير عل, اسبوعين الإمداد المبرمة عدم ثم, دار إعلان ليتسنّ</div>

            </div>

        </div>
    ';     


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