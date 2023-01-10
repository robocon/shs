<?php 
require_once 'bootstrap.php';
$Conn = mysql_connect(HOST, USER, PASS) or die( mysql_error() );
mysql_select_db(DB, $Conn) or die( mysql_error() );
mysql_query("SET NAMES UTF8", $Conn);

$today="$d-$m-$yr";
print "วันที่ $today  รายชื่อคนไข้ที่ทำหัตถการ  หรือตรวจวิเคราะห์โรค";
print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
$today="$yr-$m-$d";
?>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 18px;
    }
    th, td{
        padding: 4px;
    }
</style>

<?php

    $hd_name_list = array('FU18'=>'ไตเทียม1','FU39'=>'ไตเทียม2');
    $appdate_en = ($yr-543)."-$m-$d";
  
    $query = "SELECT a.*,b.`code`
    FROM ( 
        SELECT `date`,`ptname`,`hn`,`an`,`depart`,`detail`,`price`,`paid`,`row_id`,`accno`,`cashok`,`ptright`,SUBSTRING(`ptright`,1,3) AS `ptrightCode`, `tvn` 
        FROM `depart` 
        WHERE `date` LIKE '$today%' 
        AND `depart`='HEMO' 
    ) as a 
    RIGHT JOIN ( 
        SELECT `hn`, SUBSTRING(`detail`,1,4) AS `code` FROM `appoint` WHERE `appdate_en` = '$appdate_en' 
        AND ( SUBSTRING(`detail`,1,4) = 'FU18' OR SUBSTRING(`detail`,1,4) = 'FU39' ) 
        and apptime NOT LIKE '%ยกเลิก%'
    ) AS b ON a.`hn` = b.`hn` 
    WHERE a.`hn` IS NOT NULL
    ORDER BY b.`code` ASC, a.`ptright` ASC
    ";
    $result = mysql_query($query, $Conn) or die("Query failed:".mysql_error());

    $group_hd = array();

    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$cashok,$ptright,$ptrightCode,$vn, $code) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($date,11);

        // dphardep
        $shortDate = substr($date, 1,10);
        $sql_dp = "SELECT `row_id`,`date`,`ptname`,`hn`,`tvn`,`stkcutdate`,`price`
        FROM `dphardep` 
        WHERE `date` LIKE '$shortDate%' 
        AND `hn` = '$hn' 
        AND `tvn` = '$vn' 
        AND `price` > 0";
        $dp = mysql_query($sql_dp);
        $dpPrice = 0;
        if(mysql_num_rows($sql_db) > 0){
            $dpItem = mysql_fetch_assoc($dp);
            $dpPrice = $dpItem['price'];
        }
        // end dpahrdep

        $testPaid = (int) $paid;
        $bgcolor = (empty($testPaid)) ? 'FFC2EC' : 'A0DB9E' ;

        $hd_name = $hd_name_list[$code];

        if($hd_name != $last_hd){
            $num = 1;
        }

        $html = "<tr bgcolor='$bgcolor'>".
           "  <td>$num</td>".
        //    "  <td>$hd_name</td>".
           "  <td>$time</td>".
           "  <td><a target=_BLANK  href=\"invdetail.php?sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>".
           "  <td>$hn</td>".
           "  <td>$vn</td>".
           "  <td>$an</td>".
           "  <td>$depart</td>".
           "  <td>$detail</td>".
           "  <td>$price</td>".
           "  <td>$paid</td>".
           "  <td>$dpPrice</td>".
           "  <td>$ptright</td>".
           "</tr>";
        // echo $html;

        $last_hd = $hd_name;

        $group_hd[$code][] = htmlspecialchars($html, ENT_QUOTES);
    }

?>

<div>
    <h3 style="font-size:32px; font-weight:bold; margin:0;">ไตเทียม1</h3>
</div>
<table>
 <tr bgcolor="BDADFF">
  <th>#</th>
  <th>เวลา</th>
  <th>ชื่อ</th>
  <th>HN</th>
  <th>VN</th>
  <th>AN</th>
  <th>แผนก</th>
  <th>รายการ</th>
  <th>รวมเงิน</th>
  <th>จ่ายเงิน</th>
  <th>ค่ายา</th>
  <th>สิทธิ์</th>
  </tr>
<?php
$i = 0;
foreach ($group_hd['FU18'] as $key => $value) {
    echo htmlspecialchars_decode($value, ENT_QUOTES);
    $i++;
}
?>
</table>

<div>
    <h3 style="font-size:32px; font-weight:bold; margin:0;">ไตเทียม2</h3>
</div>
<table>
 <tr bgcolor="BDADFF">
  <th>#</th>
  <th>เวลา</th>
  <th>ชื่อ</th>
  <th>HN</th>
  <th>VN</th>
  <th>AN</th>
  <th>แผนก</th>
  <th>รายการ</th>
  <th>รวมเงิน</th>
  <th>จ่ายเงิน</th>
  <th>ค่ายา</th>
  <th>สิทธิ์</th>
  </tr>
<?php
foreach ($group_hd['FU39']as $key => $value) {
    echo htmlspecialchars_decode($value, ENT_QUOTES);
}
?>
</table>