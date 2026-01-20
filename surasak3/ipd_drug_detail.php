<?php
session_start();
include("connect.inc"); // ตรวจสอบชื่อไฟล์เชื่อมต่อให้ถูกต้อง

// รับค่าจากฟอร์ม (ส่งมาจากหน้าค้นหาเดียวกับไฟล์สรุป)
$date1 = $_POST["date1"];
$month1 = $_POST["month1"];
$year1 = $_POST["year1"];
$date2 = $_POST["date2"];
$month2 = $_POST["month2"];
$year2 = $_POST["year2"];

$showdate1 = "$date1/$month1/$year1";
$showdate2 = "$date2/$month2/$year2";


$chkdate1 = $year1."-".$month1."-".$date1." 00:00:00";
$chkdate2 = $year2."-".$month2."-".$date2." 23:59:59";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>รายละเอียดค่ายาผู้ป่วยใน</title>
    <style>
        body { font-family: TH SarabunPSK; font-size: 22px; }
        table { border-collapse: collapse; width: 90%; margin: 0 auto; }
        th, td { border: 1px solid #000; padding: 3px 8px; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>  
</head>

<body>
<div align="center" style="margin-top: 20px;">
    <strong>รายละเอียดค่ายา/เวชภัณฑ์ และอุปกรณ์ (ผู้ป่วยใน)</strong><br />
    ลูกหนี้ : <?=$showcredit?>&nbsp;&nbsp;ระหว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?>
</div>

<table align="center" style="margin-top: 15px;">
  <thead>
    <tr>
      <th width="5%">ลำดับ</th>
      <th width="12%">วันที่ (DC)</th>
      <th width="10%">HN</th>
      <th width="10%">AN</th>
      <th>ชื่อ-นามสกุล</th>
      <th width="15%">ลูกหนี้</th>
      <th width="12%">จำนวนเงิน</th>
    </tr>
  </thead>
  <tbody>
<?php
// สร้าง Query ตามเงื่อนไขเดียวกับไฟล์สรุป
$condition = "WHERE date >= '$chkdate1' AND date <= '$chkdate2' AND dcdate != '' AND days != '0' AND (credit !='' OR credit is null OR credit !='ยกเลิก' OR credit !='ยกเว้น' )";

$query = "SELECT t1.* FROM ipmonrep t1
          INNER JOIN (
              SELECT MAX(row_id) as last_id 
              FROM ipmonrep 
              $condition
              GROUP BY an
          ) t2 ON t1.row_id = t2.last_id
          ORDER BY t1.dcdate ASC";

echo $Query;
$result = mysql_query($query) or die("Query failed: " . mysql_error());
$num = 0;
$total_all = 0;

while($rows = mysql_fetch_array($result)){
    
    // ตรวจสอบเงื่อนไขลูกหนี้ (เลียนแบบตรรกะจากไฟล์สรุป)
    $is_valid_credit = ($rows["credit"] != "" && $rows["credit"] != "ยกเลิก" && $rows["credit"] != "ยกเว้น");
    
    if($is_valid_credit) {
        // คำนวณเงิน: ตามโจทย์ ddl+ddy+dn 
        // (หมายเหตุ: ในไฟล์สรุปเดิมของคุณใช้ ddl+ddy+dpy+dsy+ddn+dpn+dsn ถ้าต้องการให้ตรงกันเป๊ะสามารถเพิ่มฟิลด์ได้)
        $drug_amount = $rows["ddl"] + $rows["ddy"] + $rows["ddn"];
    } else {
        // ถ้าเป็นเงินสด/เงินโอน หรือสถานะอื่นๆ ตามไฟล์สรุปค่ายาจะเป็น 0
        $drug_amount = 0;
    }

    // แสดงผลเฉพาะรายการที่มียอดเงินมากกว่า 0
    if($drug_amount > 0) {
        $num++;
        $total_all += $drug_amount;
        
        // จัดรูปแบบวันที่ (พ.ศ. จากฐานข้อมูล)
        $date_part = substr($rows["dcdate"], 0, 10);
        $ex = explode("-", $date_part);
        $show_dcdate = $ex[2]."/".$ex[1]."/".$ex[0];
		
		if($rows["credit"]=="อื่นๆ"){
			$credit=$rows["credit_detail"];	
		}else{
			$credit=$rows["credit"];
		}		
?>
    <tr>
      <td class="text-center"><?=$num;?></td>
      <td class="text-center"><?=$show_dcdate;?></td>
      <td class="text-center"><?=$rows["hn"];?></td>
      <td class="text-center"><?=$rows["an"];?></td>
      <td><?=$rows["ptname"];?></td>
      <td class="text-center"><?=$credit;?></td>
      <td class="text-right"><?=number_format($drug_amount, 2);?></td>
    </tr>
<?php
    } // end if drug > 0
} // end while
?>
  </tbody>
  <tfoot>
    <tr style="font-weight: bold; background-color: #f9f9f9;">
      <td colspan="6" align="right">รวมค่ายาทั้งสิ้น</td>
      <td class="text-right"><?=number_format($total_all, 2);?></td>
    </tr>
  </tfoot>
</table>

<div align="center" style="margin-top: 20px;">
    <input type="button" value="พิมพ์รายงาน" onclick="window.print();" />
    <input type="button" value="ปิดหน้าต่าง" onclick="window.close();" />
</div>

</body>
</html>