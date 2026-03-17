<?php
session_start();
set_time_limit(0); // ปรับให้รันได้นานขึ้นกรณีข้อมูลเยอะ
include("connect.inc");
?>
<html>
<head>
<title>รายการยาขอคืนห้องไตเทียม (แยกตามรอบ)</title>
<style type="text/css">
    a:link {color:#000000; text-decoration:none;}
    a:visited {color:#000000; text-decoration:none;}
    a:active {color:#FF0000; text-decoration:underline;}
    a:hover {color:#FF0000; text-decoration:underline;}
    body,td,th { font-family: MS Sans Serif; font-size: 14px; }
    .font_title{ font-family: MS Sans Serif; font-size: 14px; color:#FFFFFF; font-weight: bold; }
    .ka-header { background-color: #6495ED; color: white; padding: 5px; margin-top: 15px; font-weight: bold; border: 1px solid #000; }
    .clearfix::after { content: ""; clear: both; display: table; }
</style>
</head>
<body>
<?php
// ฟังก์ชันกำหนดเวร ไตเทียม1
function echo_ka($time){
    if($time >= "07:31:00" && $time < "15:31:00"){
        return "เช้า";
    }else if($time >= "15:31:00" && $time < "23:31:00"){
        return "บ่าย";
    }else {
        return "ดึก";
    }
}

/// ไตเทียม2
function echo_ka2($time){
    if($time >= "06:00:00" && $time < "10:00:00"){
        return "เช้า";
    }else if($time >= "10:01:00" && $time < "14:00:00"){
        return "บ่าย";
    }else {
        return "ดึก";
    }
}

if(isset($_POST["submit"])){
    $day_now = $_POST["d"];
    $month_now = $_POST["m"];
    $year_now = $_POST["yr"];
}else{
    $day_now = date("d");
    $month_now = date("m");
    $year_now = (date("Y")+543);
}
$select_day = $year_now."-".$month_now."-".$day_now;
$today_en = ($year_now-543)."-".$month_now."-".$day_now;
?>

<form method='POST' action='<?php echo $_SERVER["PHP_SELF"]?>' id="submit_form">
    <table>
        <tr>
            <td>
                วันที่ <input type='text' name='d' size='2' value='<?php echo $day_now;?>'>
                เดือน <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>
                พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
                <input type='submit' name="submit" value='  ตกลง  '>
                <input type="button" value="print" onClick="window.print();">
                <a href='../nindex.htm'> << ไปเมนู</a>
            </td>
        </tr>
    </table>
</form>

<?php
if(isset($_POST["submit"])){
    // Query ข้อมูลทั้งหมดออกมาก่อนครั้งเดียว
    $sql_base = "SELECT a.hn, a.drugcode, a.tradname, a.amount, b.ptname, date_format(a.date, '%H:%i:%s') as time_in
                 FROM ddrugrx a
                 INNER JOIN dphardep b ON a.idno = b.row_id
                 WHERE a.date LIKE '$select_day%' AND b.doctor LIKE 'HD%' AND b.dr_cancle IS NULL
                 ORDER BY a.date ASC";
    
    $res = mysql_query($sql_base) or die(mysql_error());
    
    // เตรียมตัวแปรเก็บข้อมูลแยกตามหน่วยและตามเวร
    // โครงสร้าง: $data[หน่วย][เวร][] = ข้อมูลยา
    $hemo_data = array(
        "1" => array("เช้า" => array(), "บ่าย" => array(), "ดึก" => array()),
        "2" => array("เช้า" => array(), "บ่าย" => array(), "ดึก" => array())
    );

    while($row = mysql_fetch_assoc($res)){
        $ka = echo_ka($row['time_in']);
		$ka2 = echo_ka2($row['time_in']);
        $hn = $row['hn'];
        
        // เช็ค ไตเทียม 1 (FU18)
        $q1 = mysql_query("SELECT hn FROM appoint WHERE appdate_en = '$today_en' AND detail LIKE 'FU18%' AND apptime !='ยกเลิกการนัด' AND hn = '$hn'");
        if(mysql_num_rows($q1) > 0){
            $hemo_data["1"][$ka][] = $row;
            continue; 
        }

        // เช็ค ไตเทียม 2 (FU39)
        $q2 = mysql_query("SELECT hn FROM appoint WHERE appdate_en = '$today_en' AND detail LIKE 'FU39%' AND apptime !='ยกเลิกการนัด' AND hn = '$hn'");
        if(mysql_num_rows($q2) > 0){
            $hemo_data["2"][$ka2][] = $row;
        }
    }
?>

<div class="clearfix">
    <?php 
    // วนลูปแสดงผล 2 คอลัมน์ (ไตเทียม 1 และ 2)
    for($unit=1; $unit<=2; $unit++): 
    ?>
    <div style="float:left; width:50%;" id="hemo_item_<?php echo $unit; ?>">
        <h2 align="center">ไตเทียม <?php echo $unit; ?></h2>
        
        <?php 
        $summary_total = array(); // สรุปรวมท้ายหน่วย
        $ka_list = array("เช้า", "บ่าย", "ดึก");
        
        foreach($ka_list as $ka_name): 
            if(count($hemo_data[$unit][$ka_name]) > 0): // แสดงเฉพาะเวรที่มีข้อมูล
        ?>
            <div class="ka-header">รอบเวร: <?php echo $ka_name; ?></div>
            <table cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='width:98%; BORDER-COLLAPSE: collapse'>
                <tr bgcolor="#E0E0E0">
                    <td align="center" width="20%">HN</td>
                    <td align="center" width="40%">ชื่อผู้ป่วย</td>
                    <td align="center" width="30%">ชื่อยา</td>
                    <td align="center" width="10%">จำนวน</td>
                </tr>
                <?php 
                foreach($hemo_data[$unit][$ka_name] as $data): 
                    // เก็บข้อมูลสำหรับสรุปรวมท้ายหน่วย
                    $d_code = $data['drugcode'];
                    $summary_total[$d_code]['name'] = $data['tradname'];
                    $summary_total[$d_code]['amount'] += $data['amount'];
                ?>
                <tr>
                    <td align="center"><?php echo $data['hn']; ?></td>
                    <td><?php echo $data['ptname']; ?></td>
                    <td><?php echo $data['tradname']; ?></td>
                    <td align="center"><?php echo $data['amount']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php 
            endif;
        endforeach; 
        ?>

        <?php if(count($summary_total) > 0): ?>
            <p><b>[สรุปรวมยาทั้งหมด ไตเทียม <?php echo $unit; ?>]</b></p>
            <table cellpadding='2' cellspacing='0' border='1' bordercolor='#000000' style='width:90%; BORDER-COLLAPSE: collapse'>
                <tr bgcolor="#F2F2F2">
                    <td>รายการยา</td>
                    <td align="center" width="60">รวม</td>
                    <td width="100">หมายเหตุ</td>
                </tr>
                <?php foreach($summary_total as $s): ?>
                <tr>
                    <td><?php echo $s['name']; ?></td>
                    <td align="center"><?php echo $s['amount']; ?></td>
                    <td></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
    <?php endfor; ?>
</div>

<?php } // ปิด if submit ?>

</body>
</html>
<?php include("unconnect.inc"); ?>