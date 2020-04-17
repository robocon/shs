<?php
include 'bootstrap.php';
$Conn = mysql_connect("192.168.1.2", "remoteuser", "") or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");
mysql_select_db("smdb", $Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานค่าใช้จ่ายตรวจสุขภาพ</title>
    <style type="text/css">
    /* 
    https://css-tricks.com/fixing-tables-long-strings/
    */
    * {font-family: "TH Sarabun New","TH SarabunPSK";font-size: 18px;}
    .chk_table{border-collapse: collapse;}
    .chk_table th, .chk_table td{padding: 3px; border: 1px solid black;}
    /* .chk_table td{white-space: nowrap; text-overflow: ellipsis;} */
    </style>
</head>
<body>
<?php 

$camp = $_GET['camp'];
$type = $_GET['sso'];

$sql = "SELECT *,CONCAT(`name`,' ',`surname`) AS `ptname` FROM `opcardchk` WHERE `part` = '$camp' ORDER BY `row` ASC ";
$qOpcardchk = mysql_query($sql) or die ( mysql_error() );
$num = mysql_num_rows($qOpcardchk);
if ( mysql_num_rows($qOpcardchk) == false ) {
    echo "ไม่พบข้อมูลบริษัท";
    exit;
}

$qCompanyList = mysql_query("SELECT `date_checkup` AS `show_date`, `name` AS `company_name` FROM `chk_company_list` WHERE `code` = '$camp' ") or die ( mysql_error() );
$company = mysql_fetch_assoc($qCompanyList);

// รายการตรวจทั้งหมดของบริษัท
$allLabItems = array();
$sqlOrder = "SELECT b.`labcode` 
FROM `opcardchk` AS a 
LEFT JOIN `orderdetail` AS b ON b.`labnumber` = a.`exam_no` 
WHERE a.`part` = '$camp' 
AND b.`labcode` <> '' 
GROUP BY b.`labcode` 
ORDER BY b.`labcode1` ";

$testQLab = mysql_query($sqlOrder);
while ($testLabName = mysql_fetch_assoc($testQLab)) {
    $allLabItems[] = $testLabName['labcode'];
}

// $allLabItems = array();
// $sql = "SELECT b.`hn`,b.`ptname`,CONCAT(b.`item_sso`,',',a.`item_sso`) AS `allcode` 
// FROM ( 
// 	SELECT * FROM `chk_lab_items` WHERE `part` = '$camp' AND `item_sso` = 'bs' 
// ) AS a 
// LEFT JOIN ( 
// 	SELECT * FROM `chk_lab_items` WHERE `part` = '$camp' AND `item_sso` != 'bs' 
// ) AS b ON b.`hn` = a.`hn`";
// $q = mysql_query($sql);
// while ($item = mysql_fetch_assoc($q)) {
//     $testExplod = explode(',', $item['allcode']);
//     foreach ($testExplod as $key => $value) {

//         if (!in_array($value, $allLabItems)) {
//             $allLabItems[] = $value;
//         }
        

//     }
// }

$countItem = count($allLabItems);

?>
<div align="center"><strong>ค่าใช้จ่ายทางพยาธิวิทยาและรังษีกรรม <?=$company['company_name'];?> </strong></div>
<div align="center"><strong>ระหว่างวันที่ <?=$company['show_date'];?> จำนวน <?=$num;?> ราย</strong></div>

<table class="chk_table">
    <tr>
        <th width="2%" rowspan="2">ลำดับ</th>
        <th width="4%" rowspan="2">HN</th>
        <th width="10%" rowspan="2">ชื่อ - สกุล</th>
        <th width="4%" rowspan="2">X-RAY</th>

        <?php 
        if (!empty($countItem)) {
            ?><th colspan="<?=$countItem;?>">รายการแลป</th><?php
        }
        ?>
        

        <th width="8%" rowspan="2">รวมราคาต่อคน</th>
    </tr>
    <tr>
        <?php 
        foreach ($allLabItems as $key => $value) { 
            $qlab = mysql_query("SELECT `codelab` FROM `labcare` WHERE `code` = '$value' ");
            $testName = mysql_fetch_assoc($qlab);
            ?><th><?=$testName['codelab'];?></th><?php
        }
        ?>
    </tr>
<?php 
$i=1; 
$total = 0.00;

while($result = mysql_fetch_array($qOpcardchk)){ 
    
    $totalPerUser = 0.00;

    $hn = $result['HN'];
    $exam_no = $result['exam_no'];

    $sqlOutResult = "SELECT * FROM `out_result_chkup` WHERE `part` = '$camp' AND `hn` = '$hn' ";
    $qOutChk = mysql_query($sqlOutResult);

    $xray = '170.00';
    if ($type == 'sso') {
        $xray = '200.00';
    }

    $colorResult = '';
    if ( mysql_num_rows($qOutChk) == 0 ) {
        // $colorResult = 'style="background-color: yellow;"';
        $xray = '0.00';
    }

    

    $totalPerUser += (int)$xray;

    ?>
    <tr <?=$colorResult;?>>
        <td align="right"><?=$i;?></td>
        <td><?=$result['HN'];?></td>
        <td><?=$result['ptname'];?></td>
        <td align="right"><?=$xray;?></td>
        
        <?php 
        
        // เอารายการทั้งหมดของบริษัท ไปหาดูใน orderdetail อีกทีว่าแต่ละคน(exam_no) มีรายการอะไรบ้าง
        foreach ($allLabItems as $key => $value) {

            $sqlResulthead = "SELECT `labcode` FROM `orderdetail` WHERE `labnumber` = '$exam_no' AND `labcode` = '$value'; ";
            $testDetail = mysql_query($sqlResulthead);
            $price = 0.00;
            if ( mysql_num_rows($testDetail) > 0 ) {
                
                $qLabcare = mysql_query("SELECT `price` FROM `labcare` WHERE `code` = '$value' ");
                $labcareItem = mysql_fetch_assoc($qLabcare);
                $price = (int)$labcareItem['price'];
            }

            ?><td align="right"><?=number_format($price,2);?></td><?php

            $totalPerUser += $price;
        }
        ?>
        <td align="right"><?=number_format($totalPerUser,2);?></td>
    </tr>
    <?php
    $total += $totalPerUser;
    
    $i++;
}
?>
<tr>
    <td colspan="<?=($countItem + 4);?>" align="center"><b>รวมค่าใช้จ่ายทั้งหมด</b></td>
    <td align="right"><?=number_format($total,2);?></td>
</tr>
</table>
</body>
</html>