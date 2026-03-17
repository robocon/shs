<?php
// 1. ตั้งค่าการเชื่อมต่อฐานข้อมูล (PHP 5.2)
include("connect.inc");

// 2. ฟังก์ชัน Query ข้อมูล (ตัด result_status และเลือกเฉพาะ Record ล่าสุด)
function getReportData() {
    // ใช้ INNER JOIN เพื่อหา ID ล่าสุดของแต่ละคน (HN) ก่อน แล้วค่อยดึงข้อมูลมาคำนวณ
    $sql = "SELECT 
                CASE 
                    WHEN t.camp LIKE 'M04%' THEN 'รพ.ค่ายสุรศักดิ์มนตรี'
                    WHEN t.camp = 'M0325' OR t.camp LIKE 'M0325%' THEN 'ศูนย์ฝึกนักศึกษาวิชาทหาร'
                    WHEN t.camp LIKE 'M03%' THEN 'มทบ.32'
                    WHEN t.camp LIKE 'M02%' THEN 'ร.17 พัน 2'
                    WHEN t.camp LIKE 'M06%' THEN 'ร้อย.ฝรพ.3'
                    WHEN t.camp LIKE 'M08%' THEN 'สัสดีจังหวัดลำปาง'
                    WHEN t.camp LIKE 'M05%' THEN 'ช.พัน.4 พล.ร.4 ร้อย.4'
                    ELSE 'อื่นๆ'
                END AS unit_group,
                COUNT(t.row_id) as total_checked,
                SUM(IF(t.bmi > 30, 1, 0)) as obese,
                SUM(IF(t.bp1 > 140 OR t.bp2 > 90, 1, 0)) as hypertension,
                SUM(IF(t.bs > 125, 1, 0)) as diabetes,
                SUM(IF(t.chol > 240 OR t.tg > 500, 1, 0)) as lipid,
                SUM(IF(t.gfr > 0 AND t.gfr < 59, 1, 0)) as ckd,
                SUM(IF(t.cvd_risk >= 3, 1, 0)) as cvd_risk_high
            FROM (
                SELECT MAX(row_id) as max_id 
                FROM condxofyear_so 
                WHERE yearcheck = '2569' 
                GROUP BY hn
            ) as latest
            INNER JOIN condxofyear_so t ON t.row_id = latest.max_id
            GROUP BY unit_group
            ORDER BY FIELD(unit_group, 'รพ.ค่ายสุรศักดิ์มนตรี', 'มทบ.32', 'ศูนย์ฝึกนักศึกษาวิชาทหาร', 'สัสดีจังหวัดลำปาง', 'ร.17 พัน 2', 'ร้อย.ฝรพ.3', 'ช.พัน.4 พล.ร.4 ร้อย.4')";
            
    $result = mysql_query($sql);
    if (!$result) {
        die('SQL Error: ' . mysql_error());
    }
    return $result;
}

// 3. ส่วนการจัดการ Export
if(isset($_GET['export']) && $_GET['export'] == 'excel'){
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=HealthReport2569.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>สรุปผลการตรวจสุขภาพ 2569</title>
    <style>
        body { font-family: Tahoma, Geneva, sans-serif; font-size: 14px; padding: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: center; }
        th { background-color: #E2EFDA; }
        .red-cell { background-color: #FFC7CE; color: #9C0006; font-weight: bold; }
        .btn-export { 
            background-color: #28a745; color: white; padding: 10px 20px; 
            text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px; 
        }
    </style>
</head>
<body>
    <h2>รายงานสรุปผลการตรวจสุขภาพประจำปี 2569 (ข้อมูลล่าสุดรายบุคคล)</h2>
    <a href="?export=excel" class="btn-export">ดาวน์โหลดไฟล์ Excel (.xls)</a>
<?php } ?>

    <table border="1">
        <thead>
            <tr bgcolor="#E2EFDA">
                <th rowspan="2">ลำดับ</th>
                <th rowspan="2">รพ.ทบ.ในพื้นที่ ทภ.3</th>
                <th rowspan="2">ยอดรับการตรวจสุขภาพ (นาย)</th>
                <th colspan="7">ยอดกำลังพลกลุ่มป่วย ตามกำหนด พบ. (แดง) (นาย)</th>
                <th rowspan="2">รวมความผิดปกติ<br>ระดับป่วย (แดง)</th>
            </tr>
            <tr bgcolor="#E2EFDA">
                <th>ภาวะอ้วน BMI > 30</th>
                <th>ความดันโลหิตสูง</th>
                <th>น้ำตาลในเลือดสูง</th>
                <th>ไขมันในเลือดสูง</th>
                <th>ไตทำงานผิดปกติ</th>
                <th>CVD Risk สูง</th>
                <th>หมายเหตุ</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $result = getReportData();
        $i = 1;
        $total_all = 0; $sum_obese = 0; $sum_ht = 0; $sum_dm = 0; $sum_lip = 0; $sum_ckd = 0; $sum_cvd = 0;
        
        while($row = mysql_fetch_array($result)) { 
            $sum_red = $row['obese'] + $row['hypertension'] + $row['diabetes'] + $row['lipid'] + $row['ckd'] + $row['cvd_risk_high'];
            
            // เก็บยอดรวมท้ายตาราง
            $total_all += $row['total_checked'];
            $sum_obese += $row['obese'];
            $sum_ht += $row['hypertension'];
            $sum_dm += $row['diabetes'];
            $sum_lip += $row['lipid'];
            $sum_ckd += $row['ckd'];
            $sum_cvd += $row['cvd_risk_high'];
        ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td align="left"><?php echo $row['unit_group']; ?></td>
                <td><?php echo number_format($row['total_checked']); ?></td>
                <td><?php echo $row['obese']; ?></td>
                <td><?php echo $row['hypertension']; ?></td>
                <td><?php echo $row['diabetes']; ?></td>
                <td><?php echo $row['lipid']; ?></td>
                <td><?php echo $row['ckd']; ?></td>
                <td><?php echo $row['cvd_risk_high']; ?></td>
                <td></td>
                <td class="red-cell"><?php echo $sum_red; ?></td>
            </tr>
        <?php } ?>
        </tbody>
        <tr style="background-color: #D9D9D9; font-weight: bold;">
            <td colspan="2">รวมทั้งสิ้น</td>
            <td><?php echo number_format($total_all); ?></td>
            <td><?php echo $sum_obese; ?></td>
            <td><?php echo $sum_ht; ?></td>
            <td><?php echo $sum_dm; ?></td>
            <td><?php echo $sum_lip; ?></td>
            <td><?php echo $sum_ckd; ?></td>
            <td><?php echo $sum_cvd; ?></td>
            <td></td>
            <td><?php echo ($sum_obese+$sum_ht+$sum_dm+$sum_lip+$sum_ckd+$sum_cvd); ?></td>
        </tr>
    </table>

<?php if(!isset($_GET['export'])) { ?>
</body>
</html>
<?php } ?>