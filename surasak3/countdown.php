<?php 
/**
 * MySQL LOG
 * 
ALTER TABLE `trauma_inject` ADD `toborow` VARCHAR( 255 ) NULL ,
ADD `status_c19` VARCHAR( 5 ) NULL ,
ADD `countdown_c19` DATETIME NULL ;

 */
include 'bootstrap.php';
$action = $_REQUEST['action'];
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES tis620");
if($action == 'get_user')
{
    $thai_date = (date('Y')+543).date('-m-d');
    $sql = "SELECT * 
    FROM `trauma_inject` 
    WHERE `thidate` LIKE '$thai_date%' 
    AND `drugcode` = 'C19' 
    AND `toborow` LIKE 'EX52%' 
    AND `status_c19` = 'N' 
    ORDER BY `row_id` DESC 
    LIMIT 7";
    $q = $dbi->query($sql);

    ?>
    <table class="w3-table w3-striped w3-xlarge">
        <tr>
            <th>HN</th>
            <th>����-ʡ��</th>
            <th>����</th>
        </tr>
    <?php 
    
    $time_now = strtotime(date('Y-m-d H:i:s'));
    while ($item = $q->fetch_assoc()) {

        $countdown_c19 = strtotime(date($item['countdown_c19']));

        $difference2 = $countdown_c19 - $time_now;
        $min = date('i', $difference2);
        $sec = date('s', $difference2);

        if( ( $time_now >= $countdown_c19 ))
        {
            $display_time = "�ú 30�ҷ�";
        }
        else
        {
            $display_time = "$min �ҷ� $sec �Թҷ�";
        }
        ?>
        <tr>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$display_time;?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
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


    <title>�Ѻ���ҩմ�Ѥ�չ</title>
</head>
<body>

    <div class="w3-container w3-teal">
        <h1>�Ѻ���ҩմ�Ѥ�չ</h1>
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
    </script>
</body>
</html>