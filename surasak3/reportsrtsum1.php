<?php
session_start();
include("connect.inc");

// รับค่าวันที่
$start_year = $_POST["start_year"];
$start_month = $_POST["start_month"];
$start_day = $_POST["start_day"];
$end_year = $_POST["end_year"];
$end_month = $_POST["end_month"];
$end_day = $_POST["end_day"];

$sql = "Select a.depart, sum(a.price), sum(a.paidcscd) 
        From opacc as a 
        Where (a.date between '".$start_year."-".$start_month."-".$start_day." 00:00:00' 
        AND '".$end_year."-".$end_month."-".$end_day." 23:59:59') 
        AND a.credit ='รฟท' 
        Group by a.depart";

$result = mysql_query($sql) or die(mysql_error());

$list = array();
$PHAR=0; $PATHO=0; $XRAY=0; $DENTA=0; $PHYSI=0; $EMER=0; $SURG=0; $NID=0; $HEMO=0; $OTHER=0; $OTHER2=0;

while($row = mysql_fetch_row($result)){
    $depart = $row[0];
    $price = $row[1];
    $paidcscd = $row[2];

    switch($depart){
        case "PHAR" : $list["PHAR"] = $price; break;
        case "PATHO" : $list["PATHO"] = $paidcscd; break;
        case "XRAY" : $list["XRAY"] = $paidcscd; break;
        case "DENTA" : $list["DENTA"] = $paidcscd; break;
        case "PHYSI" : $list["PHYSI"] = $paidcscd; break;
        case "EMER" : $list["EMER"] = $paidcscd; break;
        case "SURG" : $list["SURG"] = $paidcscd; break;
        case "NID" : $list["NID"] = $paidcscd; break;
        case "HEMO" : $list["HEMO"] = $paidcscd; break;
        case "OTHER" : $list["OTHER"] = $paidcscd; break;
        default: $list["OTHER2"] += $paidcscd; break;
    }
}

// รวมยอดเงิน
$sum = array_sum($list);


// --- Baht Text Function (ยกมาจากของเดิมเพื่อความต่อเนื่อง) ---
function bahtText($number) {
    $number = str_replace(",", "", $number);
    $number = number_format($number, 2, ".", "");
    $parts = explode(".", $number);
    $integer = $parts[0];
    $fraction = $parts[1];

    $txt_num = array("ศูนย์", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $txt_pos = array("", "สิบ", "ร้อย", "พัน", "หมื่น", "แสน", "ล้าน");

    $convert = "";

    // --- จัดการส่วนบาท (Integer) ---
    if ($integer == 0 || $integer == "0" || $integer == "00") {
        $convert .= "ศูนย์";
    } else {
        $intLen = strlen($integer);
        for ($i = 0; $i < $intLen; $i++) {
            $digit = substr($integer, $i, 1);
            $pos = ($intLen - $i - 1) % 6; // ตำแหน่งในแต่ละรอบ 6 หลัก
            
            if ($digit != 0) {
                if ($pos == 1 && $digit == 1) {
                    $convert .= ""; // สิบ (ไม่พูดหนึ่งสิบ)
                } elseif ($pos == 1 && $digit == 2) {
                    $convert .= "ยี่"; // ยี่สิบ
                } elseif ($pos == 0 && $digit == 1 && $i > 0 && ($intLen > 1)) {
                    // กรณี "เอ็ด" : อยู่หลักหน่วย, ไม่ใช่เลขตัวเดียว, และมีเลขหน้าหลักล้านหรือหลักสิบ
                    // เช็คว่าหลักก่อนหน้า (สิบ) ไม่เป็นศูนย์ หรือถ้าเป็นศูนย์แต่ไม่ใช่หลักเดียว
                    $convert .= "เอ็ด";
                } else {
                    $convert .= $txt_num[$digit];
                }
                $convert .= $txt_pos[$pos];
            }
            
            // เติมคำว่า "ล้าน" ทุกๆ 6 หลัก
            if ($pos == 0 && ($intLen - $i - 1) > 0) {
                $convert .= "ล้าน";
            }
        }
    }
    $convert .= "บาท";

    // --- จัดการส่วนสตางค์ (Fraction) ---
    if ($fraction == "00") {
        $convert .= "ถ้วน";
    } else {
        $intLen = strlen($fraction);
        for ($i = 0; $i < $intLen; $i++) {
            $digit = substr($fraction, $i, 1);
            $pos = ($intLen - $i - 1) % 6;
            if ($digit != 0) {
                if ($pos == 1 && $digit == 1) {
                    $convert .= ""; 
                } elseif ($pos == 1 && $digit == 2) {
                    $convert .= "ยี่";
                } elseif ($pos == 0 && $digit == 1 && $i > 0) {
                    $convert .= "เอ็ด";
                } else {
                    $convert .= $txt_num[$digit];
                }
                $convert .= $txt_pos[$pos];
            }
        }
        $convert .= "สตางค์";
    }

    return $convert;
}
// ---------------------------------------------------------

$sum_display = number_format($sum, 2);
$cbaht = bahtText($sum); // เรียกใช้ฟังก์ชันเดิม
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สรุปลูกหนี้การรถไฟแห่งประเทศไทย</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap');
        
        body {
            font-family: 'Sarabun', sans-serif;
            font-size: 14px;
            color: #333;
            background-color: #f5f5f5;
        }

        .report-container {
            background-color: white;
            padding: 30px;
            margin: 20px auto;
            max-width: 1200px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .table-report {
            border: 1px solid #000 !important;
        }

        .table-report th {
            background-color: #f8f9fa !important;
            border: 1px solid #000 !important;
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
            font-size: 12px;
        }

        .table-report td {
            border: 1px solid #000 !important;
            padding: 5px;
        }

        .baht-text {
            border: 1px solid #000;
            padding: 10px;
            margin-top: -1px;
            font-weight: bold;
            text-align: center;
        }

        .signature-section {
            margin-top: 40px;
        }

        @media print {
            @page { size: landscape; margin: 1cm; }
            body { background-color: white; }
            .report-container { box-shadow: none; margin: 0; padding: 0; max-width: 100%; }
            .no-print { display: none; }
            .page-break { page-break-before: always; }
        }
    </style>
</head>
<body>

<div class="container no-print mt-3 text-end">
    <button onclick="window.print()" class="btn btn-primary btn-lg">พิมพ์รายงาน (Print)</button>
</div>

<div class="report-container">
    <div class="text-center mb-4">
        <h4 class="fw-bold">สรุปลูกหนี้การรถไฟแห่งประเทศไทย</h4>
        <h5>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</h5>
        <p class="mb-1">ประจำวันที่ <?php echo "$start_day/$start_month/$start_year"; ?> ถึง <?php echo "$end_day/$end_month/$end_year"; ?></p>
        <small class="text-muted">รายงานเมื่อวันที่: <?php echo date("d/m/").(date("Y")+543)." ".date("H:i:s"); ?></small>
    </div>

    <table class="table table-report mb-0">
        <thead>
            <tr>
                <th>ช่วงวันที่</th>
                <th>ประเภท</th>
                <th>ยา</th>
                <th>พยาธิ</th>
                <th>เอกซเรย์</th>
                <th>ทันตกรรม</th>
                <th>กายภาพ</th>
                <th>ฉุกเฉิน</th>
                <th>ผ่าตัด</th>
                <th>ฝังเข็ม/นวด</th>
                <th>ไตเทียม</th>
                <th>ค่าบริการฯ</th>
                <th>ตา</th>
                <th>รวมทั้งสิ้น</th>
            </tr>
        </thead>
        <tbody>
            <tr class="text-end">
                <td class="text-center"><?php echo "$start_day/$start_month/$start_year"; ?></td>
                <td class="text-center fw-bold">รวมทั้งหมด</td>
                <td><?php echo number_format($list["PHAR"], 2); ?></td>
                <td><?php echo number_format($list["PATHO"], 2); ?></td>
                <td><?php echo number_format($list["XRAY"], 2); ?></td>
                <td><?php echo number_format($list["DENTA"], 2); ?></td>
                <td><?php echo number_format($list["PHYSI"], 2); ?></td>
                <td><?php echo number_format($list["EMER"], 2); ?></td>
                <td><?php echo number_format($list["SURG"], 2); ?></td>
                <td><?php echo number_format($list["NID"], 2); ?></td>
                <td><?php echo number_format($list["HEMO"], 2); ?></td>
                <td><?php echo number_format($list["OTHER"], 2); ?></td>
                <td><?php echo number_format($list["OTHER2"], 2); ?></td>
                <td class="fw-bold bg-light"><?php echo $sum_display; ?></td>
            </tr>
        </tbody>
    </table>
    
    <div class="baht-text italic text-center">
        ( ตัวอักษร: <?php echo $cbaht; ?> )
    </div>

    <div class="row signature-section">
        <div class="col-6 text-center">
            </div>
        <div class="col-6 text-center">
            <?php
                $sql_off = "Select yot,fullname From officers where mancode = 'headmonysub' limit 1";
                $res_off = mysql_query($sql_off);
                list($yot,$fullname) = mysql_fetch_row($res_off);
            ?>
            <p style='margin-left:20px;'><?php echo "$yot"; ?><span style='margin-left:180px;'>ผู้ตรวจสอบ</span></p>
            <p>( <?php echo "$fullname"; ?> )</p>
            <p>........../........../..........</p>
            <br><br>
            <p>ลงชื่อ..........................................................ผู้บันทึก</p>
            <p>( .......................................................... )</p>
            <p>........../........../..........</p>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="mt-5">
        <h5 class="text-center fw-bold mb-3">รายละเอียดลูกหนี้ประจำวัน</h5>
        <table class="table table-report table-sm text-end">
            <thead class="text-center">
                <tr>
                    <th style="width: 100px;">วันที่</th>
                    <th>ยา</th>
                    <th>พยาธิ</th>
                    <th>เอกซเรย์</th>
                    <th>ทันตกรรม</th>
                    <th>กายภาพ</th>
                    <th>ฉุกเฉิน</th>
                    <th>ผ่าตัด</th>
                    <th>ฝังเข็ม</th>
                    <th>ไตเทียม</th>
                    <th>บริการฯ</th>
                    <th>ตา</th>
                    <th>รวมรายวัน</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query รายวัน
                $sql_daily = "Select date_format(a.date, '%d-%m-%Y') AS d2, a.depart, sum(a.paidcscd), sum(a.price) 
                              From opacc as a 
                              Where (a.date between '".$start_year."-".$start_month."-".$start_day."' AND '".$end_year."-".$end_month."-".$end_day." 23:59:59') 
                              AND a.credit ='รฟท' 
                              Group by d2, a.depart Order by a.date ASC";
                $res_daily = mysql_query($sql_daily);
                
                $daily_data = array();
                while($r = mysql_fetch_row($res_daily)){
                    $d = $r[0];
                    $dep = $r[1];
                    $val = ($dep == "PHAR") ? $r[3] : $r[2];
                    $daily_data[$d][$dep] = $val;
                }

                foreach($daily_data as $date_key => $values){
                    $row_sum = array_sum($values);
                    echo "<tr>";
                    echo "<td class='text-center'>$date_key</td>";
                    echo "<td>".number_format($values['PHAR'],2)."</td>";
                    echo "<td>".number_format($values['PATHO'],2)."</td>";
                    echo "<td>".number_format($values['XRAY'],2)."</td>";
                    echo "<td>".number_format($values['DENTA'],2)."</td>";
                    echo "<td>".number_format($values['PHYSI'],2)."</td>";
                    echo "<td>".number_format($values['EMER'],2)."</td>";
                    echo "<td>".number_format($values['SURG'],2)."</td>";
                    echo "<td>".number_format($values['NID'],2)."</td>";
                    echo "<td>".number_format($values['HEMO'],2)."</td>";
                    echo "<td>".number_format($values['OTHER'],2)."</td>";
                    echo "<td>".number_format($values['OTHER2'],2)."</td>";
                    echo "<td class='fw-bold'>".number_format($row_sum, 2)."</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>