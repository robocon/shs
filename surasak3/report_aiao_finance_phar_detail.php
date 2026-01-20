<?php
session_start();
require_once 'connect.php';

// รับค่าจาก Form
$chkdate1 = $_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2 = $_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

$credit = "phar"; // แนะนำให้รับจาก $_POST["credit"] หรือตัวแปรที่ส่งมา

if(empty($credit)){
    echo "กรุณาเลือกประเภทค่ารักษาพยาบาล";
    exit;
}

// กำหนดชื่อแผนก
if($credit=="phar"){ $chkdepart="PHAR"; $depart_name="ยา"; }

// SQL Query แบบเดิม
$sql = "SELECT 
    DATE(a.`date`) AS op_date,
    a.`hn`,
    CONCAT(b.`yot`, b.`name`, ' ', b.`surname`) AS full_name,
    a.`paid`,
    a.`paidcscd`,
    a.`credit`,
    a.`credit_detail`
FROM `opacc` AS a
INNER JOIN `opcard` AS b ON a.`hn` = b.`hn`
WHERE a.`date` BETWEEN '$chkdate1' AND '$chkdate2'
  AND a.`depart` = '$chkdepart'
  AND a.`credit` NOT IN ('','ยกเลิก', 'นอนโรงพยาบาล', 'อื่นๆ', 'ยกเว้น')
ORDER BY `op_date` ASC";

$result = mysql_query($sql) or die(mysql_error());
$list_data = array();

while($row = mysql_fetch_array($result)){
    
    // คำนวณยอดเงินตามเงื่อนไข (ต้องทำใน Loop)
    $showcredit = $row['credit'];
    $direct_pay = array("จ่ายตรง", "จ่ายตรง อปท.", "จ่ายตรง อปท. (HD)", "กทม", "กสทช", "ททท", "กฟผ");
    
    if(in_array($showcredit, $direct_pay)){
        $claim = $row['paidcscd'];
    } else {
        $claim = $row['paid'];
    }
	
$date_part = substr($row['op_date'], 0, 10); // ตัดเอาเฉพาะ "2568-01-01"
$ex_date = explode("-", $date_part); 
$formatted_date = $ex_date[2]."/".$ex_date[1]."/".$ex_date[0]; // จะได้ "01/01/2568"

    // เก็บข้อมูลลง Array เพื่อไปวน Loop แสดงผล
    $list_data[] = array(
        "date" => $formatted_date,
        "hn"   => $row['hn'],
        "name" => $row['full_name'],
        "cr"   => $showcredit,
        "amt"  => $claim
    );
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายงานส่งAudit <?=$depart_name;?></title>
    <style>
        body { font-family: TH SarabunPSK; font-size: 22px; }
        table { border-collapse: collapse; width: 90%; margin: 0 auto; }
        th, td { border: 1px solid #000; padding: 3px 8px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>    
</head>
<body>

<div style="text-align: center; font-weight: bold;">
    ลูกหนี้หมวด <?=$depart_name;?><br>
    โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง
</div>

<table>
    <thead>
        <tr style="font-weight: bold; background: #eee;">
            <td class="text-center" width="5%">#</td>
            <td class="text-center" width="12%">วันที่</td>
            <td class="text-center" width="10%">HN</td>
            <td class="text-center">ชื่อ - สกุล</td>
            <td class="text-center" width="15%">ลูกหนี้</td>
            <td class="text-center" width="12%">จำนวนเงิน</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $num = 0;
        $sumtotal = 0;
        if(count($list_data) > 0){
            foreach ($list_data as $item) {
                $num++;
                $sumtotal += $item['amt']; // บวกยอดเงินรวม
        ?>
            <tr>
                <td class="text-center"><?=$num;?></td>
                <td class="text-center"><?=$item['date'];?></td>
                <td class="text-center"><?=$item['hn'];?></td>
                <td><?=$item['name'];?></td>
                <td class="text-center"><?=$item['cr'];?></td>
                <td class="text-right"><?=number_format($item['amt'], 2);?></td>
            </tr>
        <?php 
            } // end foreach
        } else {
            echo "<tr><td colspan='6' class='text-center'>--- ไม่พบข้อมูลในช่วงเวลาที่เลือก ---</td></tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr style="font-weight: bold;">
            <td colspan="5" class="text-right">รวมทั้งหมด</td>
            <td class="text-right"><?=number_format($sumtotal, 2);?></td>
        </tr>
    </tfoot>
</table>

</body>
</html>