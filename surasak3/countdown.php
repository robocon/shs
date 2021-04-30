<?php 
include 'bootstrap.php';
$action = $_REQUEST['action'];
$dbi = new mysqli(HOST,USER,PASS,DB);
// $dbi->query("SET NAMES tis620");
if($action == 'get_user')
{
    $date = date('Y-m-d');
    $sql = "SELECT * FROM `c19_patients` WHERE `date` LIKE '$date%' ORDER BY `id` ASC ";
	
    $q = $dbi->query($sql);
    if ($q->num_rows > 0) {
    
        ?>
<div style="margin-left:25px;">        
        <table class="w3-table w3-striped w3-xlarge">
            <tr>
                <th width="5">#</th>
                <th>ชื่อ-สกุล</th>
                <th>คิว</th>
                <th>ระยะเวลา</th>
            </tr>
        <?php 
        
        $time_now = strtotime(date('Y-m-d H:i:s'));
		$i=0;
        while ($item = $q->fetch_assoc()) {
		$i++;
		
		$sql2="select * from queue_opd where register_date='".date('Y-m-d')."' and hn='".$item['hn']."' and queue_type='V' order by id desc limit 1";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		$result2=mysql_fetch_array($query2);		
		
            $countdown_c19 = strtotime(date($item['countdown_c19']));

            $difference2 = $countdown_c19 - $time_now;
            $min = date('i', $difference2);
            $sec = date('s', $difference2);
            $display_time = '';
            if( ( $time_now >= $countdown_c19 ))
            {
                // $display_time = "ครบ 30นาที";
                continue;
            }
            else
            {
                if((int)$min > 0)
                {
                    $display_time .= "$min นาที";
                }
                $display_time .= " $sec วินาที";
            }
			
			if($min <= 5){
				$color="#FF0000";
			}else{
				$color="#0000FF";
			}
            ?>
            <tr>
                <td align="center"><?=$i;?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$result2['queue_no'];?></td>
                <td style="color: <?=$color;?>;"><?=$display_time;?></td>
            </tr>
            <?php
        }
        ?>
        </table>
</div>        
        <?php
    }else{
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
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"><style type="text/css">
<!--
body,td,th {
	font-family: Tahoma;
	font-size: 36px;
}
body {
	background-color: #ddffdd;
}
-->
</style></head>
<body>
    <div class="w3-container w3-teal w3-bar">
        <h2 class="w3-bar-item" style="text-shadow: 2px 2px 2px #444; font:Tahoma; font-size:48px; margin-left:25px; margin-top: 45px;"><strong>รายชื่อผู้ฉีดวัคซีนโควิด 19 <br>โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></h2>
        <!-- <h2><a href="javascript:void(0);" id="test_data" class="w3-bar-item w3-right w3-button">ทดสอบเพิ่มข้อมูล</a></h2> -->
    </div>
    <div class="w3-container">
        <div id="main_container"></div>
    </div>
    <script>

        // Update the count down every 1 second
        var x = setInterval(function() { 
            var request = new XMLHttpRequest();
            request.open('GET', 'countdown.php?action=get_user', true);
            request.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status >= 200 && this.status < 400) {
                        // Success!
                        document.getElementById("main_container").innerHTML = this.responseText;
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

        document.getElementById("test_data").addEventListener("click", function() {
            var request = new XMLHttpRequest();
            request.open('POST', 'test_add_trauma_inject.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status >= 200 && this.status < 400) {
                        // Success!
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