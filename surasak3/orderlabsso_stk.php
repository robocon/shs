<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$hn = $_REQUEST['hn'];
$type = $_REQUEST['type'];
$thaiDate = (date('Y')+543).date('-m-d');
$enDate = date('Y-m-d');

$sql = sprintf("SELECT `date`,`hn`,`ptname`,`tvn`,`lab` FROM `depart` WHERE `date` LIKE '%s%%' AND `hn` = '%s' AND `depart` = 'PATHO' ", $thaiDate, $hn);
$q = $dbi->query($sql);
if($q->num_rows > 0){ 

    $chk_year = get_year_checkup();
    $clinical = 'ตรวจสุขภาพประจำปี'.$chk_year;
    $sql_orderhead = sprintf("SELECT SUBSTRING(`labnumber`,7,3) AS `lab` 
    FROM `orderhead` 
    WHERE `date` LIKE '$enDate%' 
    AND `hn` = '$hn' 
    AND `clinicalinfo` = '$clinical' ");
    $q_orderhead = $dbi->query($sql);
    $odhead = $q_orderhead->fetch_assoc();
    $user_number = sprintf('%03d', $odhead['lab']);

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ปริ้นสติกเกอร์</title>
    </head>
    <body onload="window.print();">
        <style>
            *{
                font-family: "Cordia New";
            }
            body{
                margin: 0;
                padding: 0;
            }
        </style>

        <?php
        $l = $q->fetch_assoc();
        $ptname = $l['ptname'];
        $hn = $l['hn'];
        $date = $l['date'];
        $tvn = $l['tvn'];
        $user_number = sprintf('%03d', $l['lab']);
        if($type=='cbc' OR $type=='all'){
            $code_exam_cbc = date('ymd').$user_number.'01';
            ?>
            <!-- CBC -->
            <div style="font-size:12pt; font-weight: normal; left:0; top:0; height:15px;"><b>HN</b>:<?=$hn;?>(<?=$tvn;?>) <?=$date;?></div>
            <div style="font-size:17pt; font-weight:bold; left:0; top:15px; height:25px;"><?=$ptname;?></div>
            <!-- <div style="font-size:15pt; font-weight: normal; left:0; top:0; height:18px;">CBC</div> -->
            <div>
                <span style="font-size:17pt;">CBC</span>
                <span ><img src="barcode/labstk.php?cLabno=<?=$code_exam_cbc;?>"></span>
                <span style="font-size:18pt; font-weight:bold;"><?=$user_number;?></span>
            </div>
            <div style="page-break-before: always;"></div>
            <?php
        }

        if($type=='ua' OR $type=='all'){ 
            $ua_code = date('ymd').$user_number.'03';
            ?>
            <div style="font-size:12pt; font-weight: normal; left:0; top:0; height:15px;"><b>HN</b>:<?=$hn;?>(<?=$tvn;?>) <?=$date;?></div>
            <div style="font-size:17pt; font-weight:bold; left:0; top:15px; height:25px;"><?=$ptname;?></div>
            <!-- <div style="font-size:15pt; font-weight: normal; left:0; top:0; height:18px;">CBC</div> -->
            <div>
                <span style="font-size:17pt;">UA</span>
                <span ><img src="barcode/labstk.php?cLabno=<?=$ua_code;?>"></span>
                <span style="font-size:18pt; font-weight:bold;"><?=$user_number;?></span>
            </div>
            <div style="page-break-before: always;"></div>
            <?php
        }

        if($type=='chem' OR $type=='all'){ 
            $chem_code = date('ymd').$user_number.'02';
            ?>
            <div style="font-size:12pt; font-weight: normal; left:0; top:0; height:15px;"><b>HN</b>:<?=$hn;?>(<?=$tvn;?>) <?=$date;?></div>
            <div style="font-size:17pt; font-weight:bold; left:0; top:15px; height:25px;"><?=$ptname;?></div>
            <div>
                <span style="font-size:14pt;">CHEM</span>
                <span ><img src="barcode/labstk.php?cLabno=<?=$chem_code;?>"></span>
                <span style="font-size:18pt; font-weight:bold;"><?=$user_number;?></span>
            </div>
            <div style="page-break-before: always;"></div>

            <!--
            <div style="font-size:12pt; font-weight: normal; left:0; top:0; height:15px;"><b>HN</b>:<?=$hn;?>(<?=$tvn;?>) <?=$date;?></div>
            <div style="font-size:17pt; font-weight:bold; left:0; top:15px; height:25px;"><?=$ptname;?></div>
            <div>
                <span style="font-size:14pt;">CHEM</span>
                <span ><img src="barcode/labstk.php?cLabno=<?=$chem_code;?>"></span>
                <span style="font-size:20pt; font-weight:bold;">C</span>
            </div>
            <div style="page-break-before: always;"></div>
            -->
            <?php
        }
        ?>

        <script>
            function CloseWindowsInTime(t){
                t = t*1000;
                setTimeout("window.close()",t);
            }
            CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
        </script>
    </body>
    </html>
    <?php
}else{
    ?><p>บันทึกค่าใช้จ่ายก่อนปริ้นสติกเกอร์</p><?php
}
?>