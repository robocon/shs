<?php
// ป้องกัน error notice สำหรับ PHP ต่ำกว่า 5.4
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include("connect.inc");

$act = $_POST["act"];
$start_date_raw = $_POST['start_date'];
$end_date_raw = $_POST['end_date'];
$doctor_post = $_POST['doctor'];

if($act == "show"){
    // แปลงวันที่เป็น พ.ศ. สำหรับ Query (ตามโครงสร้างฐานข้อมูลเดิมของคุณ)
    list($year, $month, $day) = explode('-', $start_date_raw);
    $start_date = ($year + 543) . '-' . $month . '-' . $day;

    list($year1, $month1, $day1) = explode('-', $end_date_raw);
    $end_date = ($year1 + 543) . '-' . $month1 . '-' . $day1;

    if($doctor_post != "all"){
        // แยกชื่อแพทย์เพื่อใช้ในการค้นหา
        // สมมติในฐานข้อมูลเก็บชื่อ-นามสกุล หรือชื่ออย่างเดียว
        $doctorname = $doctor_post; 
        $where_vip = "AND v.doctor LIKE '%$doctorname%'";
    } else {
        $where_vip = "";
    }

    // --- 1. Query หลัก: ดึงข้อมูลคลินิกพิเศษ ---
    $sql = "
    SELECT
        v.hn,
        v.ptname AS full_name,
        v.doctor AS doctor_name,
        v.time AS service_time,
        v.thidate AS service_date,
        p.ptright,
        SUM(CASE WHEN p.code IN ('clinic','clinic50','clinic100','clinic300','doctor100') THEN p.price ELSE 0 END) AS clinic_fee
    FROM clinic_vip v
    LEFT JOIN patdata p ON p.hn = v.hn AND SUBSTRING(p.date,1,10) = SUBSTRING(v.thidate,1,10)
    WHERE v.thidate >= '$start_date' AND v.thidate <= '$end_date'
      AND v.status = 'Y'
      $where_vip
    GROUP BY v.hn, v.time, v.ptname, v.doctor, v.thidate
    HAVING SUM(p.price) > 0
    ORDER BY v.thidate ASC, v.time ASC
    ";
    $result = mysql_query($sql) or die(mysql_error());

    // เตรียมตัวแปรสำหรับเก็บข้อมูลไปเช็ค Overlap
    $data_list = array();
    $daily_range = array(); // เก็บเวลาเริ่ม-เลิก ของแต่ละวัน
    $vip_hns = array();     // เก็บ HN ที่เป็น VIP เพื่อไม่ให้แสดงซ้ำในตารางเช็ค
    
    while($row = mysql_fetch_assoc($result)){
        $data_list[] = $row;
        $date_key = $row['service_date'];
        $time_val = $row['service_time'];
        $vip_hns[$date_key][] = $row['hn'];

        // หาเวลา Min/Max ของแต่ละวัน
        if(!isset($daily_range[$date_key]['start'])) $daily_range[$date_key]['start'] = $time_val;
        $daily_range[$date_key]['end'] = $time_val; 
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>รายงานค่าบริการและตรวจสอบภาระงานทับซ้อน</title>
    <style>
        body { font-family: "TH SarabunPSK", sans-serif; font-size: 16pt; margin:20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 5px; text-align: center; }
        th { background-color: #f2f2f2; }
        .summary-row { background-color: #eee; font-weight: bold; }
        .overlap-section { margin-top: 40px; border: 2px solid #d9534f; padding: 15px; border-radius: 8px; }
        .overlap-header { color: #d9534f; font-weight: bold; font-size: 20pt; border-bottom: 2px solid #d9534f; }
        @media print { .no-print { display: none; } }
    </style>
</head>
<body>

<div class="no-print">
    <h2>รายงานค่าบริการผู้ป่วยคลินิกพิเศษ</h2>
    <form method="post">
        <input type="hidden" name="act" value="show">
        แพทย์: 
        <select name="doctor">
            <option value="all">--- ทั้งหมด ---</option>
            <?php
            $q_doc = mysql_query("SELECT name FROM doctor WHERE status='y' AND name NOT REGEXP '^HD' ORDER BY name ASC");
            while($r_doc = mysql_fetch_array($q_doc)){
                $sel = ($doctor_post == $r_doc['name']) ? "selected" : "";
                echo "<option value='".$r_doc['name']."' $sel>".$r_doc['name']."</option>";
            }
            ?>
        </select>
        วันที่: <input type="date" name="start_date" value="<?=$start_date_raw?>" required> 
        ถึง: <input type="date" name="end_date" value="<?=$end_date_raw?>" required>
        <button type="submit">แสดงรายงาน</button>
    </form>
</div>

<?php if(!empty($data_list)): ?>
    <h3 align="center">ตารางค่าบริการคลินิกพิเศษ นอกเวลาราชการ<br>
    แพทย์: <?=$doctor_post?> ช่วงวันที่: <?=$start_date?> ถึง <?=$end_date?></h3>
    
    <table>
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>วันที่</th>
                <th>เวลาตรวจ</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>สิทธิ</th>
                <th>แพทย์</th>
                <th>ค่าคลินิก (100%)</th>
                <th>แพทย์ (80%)</th>
                <th>รพ. (20%)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total_all = 0; $total_doc = 0; $total_hos = 0;
            foreach($data_list as $i => $row): 
                $fee = $row['clinic_fee'];
                $d_fee = $fee * 0.8;
                $h_fee = $fee * 0.2;
                $total_all += $fee; $total_doc += $d_fee; $total_hos += $h_fee;
            ?>
            <tr>
                <td><?=($i+1)?></td>
                <td><?=$row['service_date']?></td>
                <td><?=$row['service_time']?></td>
                <td><?=$row['hn']?></td>
                <td align="left"><?=$row['full_name']?></td>
                <td><?=$row['ptright']?></td>
                <td><?=$row['doctor_name']?></td>
                <td><?=number_format($fee,2)?></td>
                <td><?=number_format($d_fee,2)?></td>
                <td><?=number_format($h_fee,2)?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="summary-row">
                <td colspan="7">รวมทั้งสิ้น</td>
                <td><?=number_format($total_all,2)?></td>
                <td><?=number_format($total_doc,2)?></td>
                <td><?=number_format($total_hos,2)?></td>
            </tr>
        </tbody>
    </table>

    <div class="overlap-section">
        <div class="overlap-header">⚠️ ตรวจสอบรายชื่อผู้ป่วยที่ตรวจในแผนกปกติ (ช่วงเวลาเดียวกัน)</div>
        <p>ระบบตรวจสอบจากเวลาของคนแรก ถึงคนสุดท้าย ของคลินิกพิเศษในแต่ละวัน</p>
        
        <table>
            <thead>
                <tr style="background-color: #fff0f0;">
                    <th>วันที่</th>
                    <th>ช่วงเวลาคลินิกพิเศษ</th>
                    <th>HN</th>
                    <th>ชื่อผู้ป่วย (แผนกปกติ)</th>
                    <th>เวลาที่ตรวจ</th>
                    <th>จุดตรวจ/สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $found_overlap = false;
                foreach($daily_range as $date => $range){
                    $st = $range['start'];
                    $en = $range['end'];
                    $exclude = implode("','", $vip_hns[$date]);

                    // Query ไปยังตาราง opday เพื่อหาคนที่ไม่อยู่ในรายชื่อ VIP แต่ตรวจในช่วงเวลาเดียวกัน
                    $sql_overlap = "
                        SELECT o.hn, o.name, o.time1, o.vstplace
                        FROM opday o
                        WHERE o.thidate = '$date'
                          AND o.doctor LIKE '%$doctorname%'
                          AND o.time1 BETWEEN '$st' AND '$en'
                          AND o.hn NOT IN ('$exclude')
                        ORDER BY o.time1 ASC
                    ";
					echo $sql_overlap."<br>";
                    $res_overlap = mysql_query($sql_overlap);
                    
                    if(mysql_num_rows($res_overlap) > 0){
                        $found_overlap = true;
                        while($ov = mysql_fetch_assoc($res_overlap)){
                            echo "<tr>
                                    <td>$date</td>
                                    <td>$st - $en</td>
                                    <td>{$ov['hn']}</td>
                                    <td align='left'>{$ov['name']}</td>
                                    <td style='color:red;'>{$ov['time1']}</td>
                                    <td>{$ov['vstplace']}</td>
                                  </tr>";
                        }
                    }
                }
                
                if(!$found_overlap){
                    echo "<tr><td colspan='6' style='color:green;'>ไม่พบภาระงานทับซ้อนในช่วงเวลาดังกล่าว</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

<?php endif; ?>

<br><br>
<center><button class="no-print" onclick="window.print()">พิมพ์รายงาน</button></center>

</body>
</html>