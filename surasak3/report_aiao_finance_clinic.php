<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include("connect.inc");

$act = $_POST["act"];
if($act == "show"){
    // รับช่วงวันที่และแปลงเป็น พ.ศ.
    list($year, $month, $day) = explode('-', $_POST['start_date']);
    $start_date = ($year + 543) . '-' . $month . '-' . $day;
    list($year1, $month1, $day1) = explode('-', $_POST['end_date']);
    $end_date = ($year1 + 543) . '-' . $month1 . '-' . $day1;

    $doctor_post = $_POST['doctor'];
    $where = ($doctor_post != "all") ? "AND v.doctor LIKE '%$doctor_post%'" : "";

    // 1. ดึงรายชื่อหลักจาก clinic_vip
    $sql_main = "
        SELECT v.hn, v.ptname, v.doctor, v.thidate, v.time, v.update_r
        FROM clinic_vip v
        WHERE v.thidate BETWEEN '$start_date' AND '$end_date'
          AND v.status = 'Y'
          $where
        GROUP BY v.hn, v.thidate, v.doctor
        ORDER BY v.thidate ASC, v.update_r ASC
    ";
    $res_main = mysql_query($sql_main) or die(mysql_error());

    $data_rows = array();

    while($row = mysql_fetch_assoc($res_main)){
        $hn = trim($row['hn']);
        $date = trim($row['thidate']);
        $doctor_name = $row['doctor'];

        // 2. [Step A] หาค่าคลินิกพิเศษ (แบบระบุชื่อแพทย์)
        $sql_fee = "
            SELECT 
                MAX(p.date) AS pat_date,
                SUBSTRING(p.date, 12) AS pat_time, 
                SUM(p.price) as total_fee, 
                MAX(p.ptright) as right_name
            FROM patdata p
            WHERE p.hn = '$hn' 
              AND p.date LIKE '$date%'
              AND (
                  (p.code = 'clinic100' AND p.doctor LIKE '%$doctor_name%') 
                  OR 
                  (p.code = 'clinic300' AND p.doctor LIKE '%$doctor_name%') 
                  OR 
                  (p.code = 'doctor100' AND p.doctor LIKE '%$doctor_name%') 
              )
        ";
		//echo $sql_fee."<br>";
        $res_fee = mysql_query($sql_fee);
        $fee_data = mysql_fetch_assoc($res_fee);

        // 3. [Step B] ถ้า Step A ไม่เจอ (ยอดเป็น 0) ให้หาค่าคลินิกนอกเวลา (doctor100 ไม่สนชื่อแพทย์)
        if (empty($fee_data['total_fee']) || $fee_data['total_fee'] == 0) {
            $sql_off_hour = "
                SELECT 
                    MAX(p.date) AS pat_date,
                    SUBSTRING(p.date, 12) AS pat_time, 
                    SUM(p.price) as total_fee, 
                    MAX(p.ptright) as right_name
                FROM patdata p
                WHERE p.hn = '$hn' 
                  AND p.date LIKE '$date%'
                  AND p.code = 'doctor100'
            ";
            $res_off = mysql_query($sql_off_hour);
            $fee_data = mysql_fetch_assoc($res_off);
            
            // ถ้าดึงจากนอกเวลา ให้ระบุหมายเหตุในสิทธิ (ถ้าต้องการ)
            if ($fee_data['total_fee'] > 0 && empty($fee_data['right_name'])) {
                $fee_data['right_name'] = "คลินิกนอกเวลา";
            }
        }

        // 4. ดึงข้อมูลบัญชี (opacc)
        $pat_date = $fee_data['pat_date'];
        if ($pat_date) {
            $sql_credit = "SELECT credit AS credit_info FROM opacc WHERE hn='$hn' AND txdate='$pat_date' LIMIT 1";
            $res_credit = mysql_query($sql_credit);
            $credit_data = mysql_fetch_assoc($res_credit);
            $row['credit'] = ($credit_data['credit_info']) ? $credit_data['credit_info'] : "-";
        } else {
            $row['credit'] = "ไม่พบลูกหนี้";
        }

        // กำหนดค่าลงใน $row
        $row['clinic_fee'] = ($fee_data['total_fee']) ? $fee_data['total_fee'] : 0;
        $row['ptright']    = ($fee_data['right_name']) ? $fee_data['right_name'] : "ไม่มีข้อมูลค่าคลินิก";
        $row['pat_time']   = ($fee_data['pat_time']) ? $fee_data['pat_time'] : "";

        // 5. หาเวลาตรวจจาก opd
        $sql_time = "SELECT dc_diag FROM opd WHERE thidate LIKE '$date%' 
            AND hn = '$hn' 
            AND doctor LIKE '%$doctor_name%' LIMIT 1";
        $res_time = mysql_query($sql_time);
        list($dc_diag) = mysql_fetch_array($res_time);
        
        if(!empty($dc_diag)) {
            $row['display_time'] = $dc_diag;
        } elseif(!empty($row['pat_time'])) {
            $row['display_time'] = $row['pat_time'];
        } else {
            $row['display_time'] = $row['time'];
        }

        $data_rows[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>รายงานค่าบริการผู้ป่วย</title>
    <style>
        body { font-family: TH SarabunPSK; font-size: 16pt; margin:20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 5px; text-align: center; }
        th { background-color: #f4f4f4; }
        .total-row { background-color: #f9f9f9; font-weight: bold; }
        .no-fee { color: #999; font-style: italic; }
    </style>
</head>
<body>

    <h2 align="center">รายงานค่าบริการผู้ป่วยคลินิกพิเศษ/นอกเวลา</h2>
    
    <form method="post" align="center">
        <input type="hidden" name="act" value="show">
        แพทย์: <select name="doctor">
            <option value="all">--- ทั้งหมด ---</option>
            <?php
            $q_doc = mysql_query("SELECT name FROM doctor WHERE status='y' AND name NOT REGEXP '^HD'");
            while($r = mysql_fetch_array($q_doc)) {
                $selected = ($doctor_post == $r['name']) ? "selected" : "";
                echo "<option value='{$r['name']}' $selected>{$r['name']}</option>";
            }
            ?>
        </select>
        วันที่เริ่ม: <input type="date" name="start_date" value="<?=$_POST['start_date']?>" required> 
        ถึง: <input type="date" name="end_date" value="<?=$_POST['end_date']?>" required>
        <button type="submit">แสดงผล</button>
    </form>

    <?php if(!empty($data_rows)): ?>
    <table>
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>วันที่</th>
                <th>เวลา</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>สิทธิ</th>
                <th>แพทย์</th>
                <th>บัญชี</th>
                <th>ค่าคลินิก</th>                
                <th>แพทย์ (80)</th>
                <th>รพ. (20)</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=0; $sum_all=0; $sum_doc=0; $sum_hos=0;
            foreach($data_rows as $row): 
                $i++;
                $clinic_fee = $row['clinic_fee'];
				if($clinic_fee=="200"){
					$f= 100;	
				}else{
					$f=$clinic_fee;
				}		
                $d = $f * 0.8; 
                $h = $f * 0.2;
                $sum_all += $f; $sum_doc += $d; $sum_hos += $h;
                $row_style = ($f == 0) ? "class='no-fee'" : "";
            ?>
            <tr <?=$row_style?>>
                <td><?=$i?></td>
                <td><?=$row['thidate']?></td>
                <td><?=$row['display_time']?></td>
                <td><?=$row['hn']?></td>
                <td align="left"><?=$row['ptname']?></td>
                <td><?=$row['ptright']?></td>
                <td><?=$row['doctor']?></td>
                <td><?=$row['credit']?></td>
                <td><?=number_format($f,2)?></td>
                <td><?=number_format($d,2)?></td>
                <td><?=number_format($h,2)?></td>
            </tr>
            <?php endforeach; ?>
            <tr class="total-row">
                <td colspan="8" align="right">รวมทั้งหมด</td>
                <td><?=number_format($sum_all,2)?></td>
                <td><?=number_format($sum_doc,2)?></td>
                <td><?=number_format($sum_hos,2)?></td>
            </tr>
        </tbody>
    </table>
    <?php endif; ?>

</body>
</html>