<?php 
include 'bootstrap.php';
$action = $_REQUEST['action'];
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES tis620");
if($action == 'get_user')
{
    $thai_date = date('Y-m-d');
    $sql = "SELECT * 
    FROM `c19_patients` 
    WHERE `date` LIKE '$thai_date%' 
    AND `toborow` LIKE 'EX52%' 
    ORDER BY `id` DESC 
    LIMIT 10";
    $q = $dbi->query($sql);
    if ($q->num_rows > 0) {
    
        ?>
        <table class="w3-table w3-striped w3-xlarge">
            <tr>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>อายุ</th>
                <th>เวลา(นับถอยหลัง)</th>
            </tr>
        <?php 
        
        $time_now = strtotime(date('Y-m-d H:i:s'));
        while ($item = $q->fetch_assoc()) {

            $countdown_c19 = strtotime(date($item['countdown_c19']));

            $difference2 = $countdown_c19 - $time_now;
            $min = date('i', $difference2);
            $sec = date('s', $difference2);
            $display_time = '';
            if( ( $time_now >= $countdown_c19 ))
            {
                $display_time = "ครบ 30นาที";
            }
            else
            {
                if((int)$min > 0)
                {
                    $display_time .= "$min นาที";
                }
                $display_time .= " $sec วินาที";
            }
            ?>
            <tr>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['age'];?></td>
                <td><?=$display_time;?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php
    }
    else{
        ?>
        <p>ยังไม่มีข้อมูล</p>
        <?php
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="w3.css">


    <title>รายชื่อผู้ฉีดวัคซีนโควิด 19 โรงพยาบาลค่ายสุรศักดิ์มนตรี</title>
</head>
<body>

    <div class="w3-container w3-teal w3-bar">
        <h2 class="w3-bar-item" style="text-shadow: 2px 2px 2px #444;">รายชื่อผู้ฉีดวัคซีนโควิด 19 โรงพยาบาลค่ายสุรศักดิ์มนตรี</h2>
        <!-- <h2><a href="javascript:void(0);" id="test_data" class="w3-bar-item w3-right w3-button">ทดสอบเพิ่มข้อมูล</a></h2> -->
    </div>

    <div class="w3-container">
        <div id="main_container"></div>
    </div>
    
    <script>
        // Set the date we're counting down to
        // var countDownDate = new Date("Jan 5, 2022 15:37:25").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() { 

            /*
            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
            */

            var request = new XMLHttpRequest();
            request.open('GET', 'countdown.php?action=get_user', true);

            request.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status >= 200 && this.status < 400) {
                        // Success!
                        document.getElementById("main_container").innerHTML = this.responseText;
                        // var data = JSON.parse(this.responseText);
                        // console.log(data);

                    } else {
                        // Error :(
                    }
                }
            };

            request.send();
            request = null;

        }, 1000);

        function addEventListener(el, eventName, handler) {
            if (el.addEventListener) {
                el.addEventListener(eventName, handler);
            } else {
                el.attachEvent('on' + eventName, function(){
                    handler.call(el);
                });
            }
        }

        // addEventListener(document.getElementById("test_data"), "onclick", function(){ 
        //     alert('1234');
        //     var request = new XMLHttpRequest();
        //     request.open('POST', 'test_add_trauma_inject.php', true);
        //     request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        //     request.send(data);
        // });

        document.getElementById("test_data").addEventListener("click", function() {
            // document.getElementById("demo").innerHTML = "Hello World";
            // alert(1234);
            var request = new XMLHttpRequest();
            request.open('POST', 'test_add_trauma_inject.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status >= 200 && this.status < 400) {
                        // Success!
                        // document.getElementById("main_container").innerHTML = this.responseText;
                        // var data = JSON.parse(this.responseText);
                        console.log(this.responseText);

                    } else {
                        // Error :(
                    }
                }
            };
            request.send();


        });



    </script>
</body>
</html>