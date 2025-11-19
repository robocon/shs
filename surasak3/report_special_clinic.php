<?php
// ป้องกัน error notice สำหรับ PHP ต่ำกว่า 5.4
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include("connect.inc");

if($_POST["act"]="show"){
// รับช่วงวันที่จากฟอร์ม
list($year, $month, $day) = explode('-', $_POST['start_date']);
// แปลงเป็น พ.ศ.
$thai_year = $year + 543;
$thai_date = $thai_year . '-' . $month . '-' . $day;

list($year1, $month1, $day1) = explode('-', $_POST['end_date']);
// แปลงเป็น พ.ศ.
$thai_year1 = $year1 + 543;
$thai_date1 = $thai_year1 . '-' . $month1 . '-' . $day1;


$start_date = $thai_date;
$end_date   = $thai_date1;


$doctor=$_POST['doctor'];
if($doctor !="all"){
list($mdcode,$doctorname,$doctorlastname)=explode(" ",$doctor);
$where="AND v.doctor LIKE '%$doctorname%'";
}else{
$where="";
}	
// 🔹 Query SQL ตามที่คุณให้มา (ปรับให้รับพารามิเตอร์วันที่)
/*$sql = "
SELECT 
    p.hn,
    CONCAT(c.yot, ' ', c.name, ' ', c.surname) AS full_name, p.ptright,
    p.date AS service_date,

    -- 1) แพทย์จาก patdata เฉพาะรายการที่ price > 0 (ไม่ถูกยกเลิก)
    -- 2) ถ้าไม่มี ให้ใช้ข้อมูลจาก opday
    COALESCE(
        (
            SELECT pd.doctor
            FROM patdata pd
            WHERE pd.hn = p.hn
              AND SUBSTRING(pd.date,1,10) = SUBSTRING(p.date,1,10)
              AND pd.price > 0
              AND pd.code IN ('clinic','clinic50','clinic100','clinic300','doctor100')
            LIMIT 1
        ),
        (
            SELECT d.doctor
            FROM opday d
            WHERE d.hn = p.hn
              AND SUBSTRING(d.thidate,1,10) = SUBSTRING(p.date,1,10)
            LIMIT 1
        )
    ) AS doctor_name,

    -- ค่าคลินิก
    SUM(CASE WHEN p.code IN ('clinic','clinic50','clinic100','clinic300')
             THEN p.price ELSE 0 END) AS special_clinic_fee,

    -- ค่าหมอนอกเวลา
    SUM(CASE WHEN p.code = 'doctor100' 
             THEN p.price ELSE 0 END) AS doctor_ot_fee,

    -- ค่ายา
    (SELECT SUM(a.price)
     FROM opacc a
     WHERE a.hn=p.hn
       AND SUBSTRING(a.date,1,10)=SUBSTRING(p.date,1,10)
       AND a.depart='PHAR' AND a.price>0) AS drug_fee,

    -- LAB
    (SELECT SUM(a.price)
     FROM opacc a
     WHERE a.hn=p.hn
       AND SUBSTRING(a.date,1,10)=SUBSTRING(p.date,1,10)
       AND a.depart='PATHO' AND a.price>0) AS lab_fee,

    -- XRAY
    (SELECT SUM(a.price)
     FROM opacc a
     WHERE a.hn=p.hn
       AND SUBSTRING(a.date,1,10)=SUBSTRING(p.date,1,10)
       AND a.depart='XRAY' AND a.price>0) AS xray_fee,

    -- 55020/55021
    (SELECT SUM(a.price)
     FROM opacc a
     WHERE a.hn=p.hn
       AND SUBSTRING(a.date,1,10)=SUBSTRING(p.date,1,10)
       AND a.detail LIKE '%55020/55021%' AND a.price=50) AS medical_service_fee,

    -- รวมทั้งหมด
    (SELECT SUM(a.price)
     FROM opacc a
     WHERE a.hn=p.hn
       AND SUBSTRING(a.date,1,10)=SUBSTRING(p.date,1,10)
       AND a.price>0) AS total_fee

FROM patdata p
JOIN opcard c ON p.hn = c.hn

WHERE 
    p.code IN ('clinic','clinic50','clinic100','clinic300','doctor100')
    AND p.date BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'

    -- ⭐ กรองชื่อแพทย์จาก patdata ที่ไม่ถูกยกเลิกเท่านั้น
    $patdata_where     -- ← ตรงนี้คุณเปลี่ยนเป็นแพทย์ที่ค้นหา

GROUP BY p.hn

-- ⭐ เลือกเฉพาะผู้ป่วยที่ยอดรวมรายการเป็นบวก (ไม่ถูกยกเลิก)
HAVING SUM(p.price) > 0

ORDER BY p.date ASC
";*/

$sql="
SELECT
    v.hn,
    v.ptname AS full_name,
    v.doctor AS doctor_name,
    v.time AS service_time,
    v.thidate AS service_date,
	p.ptright,
    -- รวมค่าบริการคลินิกพิเศษ/นอกเวลา
    SUM(
        CASE 
            WHEN p.code IN ('clinic','clinic50','clinic100','clinic300','doctor100') 
            THEN p.price ELSE 0 
        END
    ) AS clinic_fee,

    -- ค่ายา
    (SELECT SUM(a.price)
     FROM opacc a
     WHERE a.hn = v.hn
       AND SUBSTRING(a.date,1,10) = SUBSTRING(v.thidate,1,10)
       AND a.depart = 'PHAR'
       AND a.price > 0) AS drug_fee,

    -- LAB
    (SELECT SUM(a.price)
     FROM opacc a
     WHERE a.hn = v.hn
       AND SUBSTRING(a.date,1,10) = SUBSTRING(v.thidate,1,10)
       AND a.depart = 'PATHO'
       AND a.price > 0) AS lab_fee,

    -- XRAY
    (SELECT SUM(a.price)
     FROM opacc a
     WHERE a.hn = v.hn
       AND SUBSTRING(a.date,1,10) = SUBSTRING(v.thidate,1,10)
       AND a.depart = 'XRAY'
       AND a.price > 0) AS xray_fee,

    -- 55020/55021
    (SELECT SUM(a.price)
     FROM opacc a
     WHERE a.hn = v.hn
       AND SUBSTRING(a.date,1,10) = SUBSTRING(v.thidate,1,10)
       AND a.detail LIKE '%55020/55021%'
       AND a.price = 50) AS medical_service_fee,

	-- ⭐ ค่าบริการ/หัตถการอื่น ๆ จาก patdata (ไม่นับคลินิกพิเศษ/OT)
	(
		SELECT SUM(pp.price)
		FROM patdata pp
		WHERE pp.hn = v.hn
		  AND depart NOT IN ('PATHO','XRAY')	  
		  AND SUBSTRING(pp.date,1,10) = SUBSTRING(v.thidate,1,10)
		  AND pp.price > 0
		  AND pp.code NOT IN ('SERVICE','clinic','clinic50','clinic100','clinic300','doctor100')
	) AS other_fee,
	
    -- รวมทั้งหมด
    (SELECT SUM(a.price)
     FROM opacc a
     WHERE a.hn = v.hn
       AND SUBSTRING(a.date,1,10) = SUBSTRING(v.thidate,1,10)
       AND a.price > 0) AS total_fee

FROM clinic_vip v

LEFT JOIN patdata p 
    ON p.hn = v.hn
   AND SUBSTRING(p.date,1,10) = SUBSTRING(v.thidate,1,10)
   AND p.code IN ('clinic','clinic50','clinic100','clinic300','doctor100')

WHERE 
    v.thidate >= '$start_date'
    AND v.thidate <= '$end_date'
	AND v.status = 'Y'
	$where
GROUP BY v.hn, v.time, v.ptname, v.doctor, v.thidate

HAVING 
    SUM(p.price) > 0   -- ✔ แสดงเฉพาะคนที่คิดเงินจริง

ORDER BY v.time ASC
";
//echo $sql;
$result = mysql_query($sql) or die(mysql_error());
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>รายงานค่าบริการผู้ป่วย</title>
<style>
body { font-family: TH SarabunPSK; margin:20px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background-color: #f4f4f4; }
@media (max-width: 768px) {
    table, thead, tbody, th, td, tr { display: block; }
    th { display: none; }
    td { border: none; position: relative; padding-left: 50%; }
    td:before { position: absolute; top: 8px; left: 8px; width: 45%; white-space: nowrap; font-weight: bold; }
    td:nth-of-type(1):before { content: "วันที่ตรวจ"; }
	td:nth-of-type(2):before { content: "HN"; }
    td:nth-of-type(3):before { content: "ชื่อ-สกุล"; }
    td:nth-of-type(4):before { content: "แพทย์ผู้ตรวจ"; }
    td:nth-of-type(5):before { content: "ค่าคลินิกพิเศษ"; }
    td:nth-of-type(6):before { content: "ค่าราชการนอกเวลา"; }
    td:nth-of-type(7):before { content: "ค่ายา"; }
    td:nth-of-type(8):before { content: "ค่า LAB"; }
    td:nth-of-type(9):before { content: "ค่า XRAY"; }
    td:nth-of-type(10):before { content: "ค่าบริการทั่วไป"; }
    td:nth-of-type(11):before { content: "รวมทั้งหมด"; }
}
</style>
</head>
<body>

<h2>รายงานค่าบริการผู้ป่วย</h2>

<form method="post">
<input type="hidden" name="act" value="show">
<p align="center"><strong>เลือกแพทย์ : </strong>
    <select name="doctor" id="doctor" class="txt">
	<option value="all" selected>--- ทั้งหมด ---</option>
    <?
    $sql="select * from doctor where status='y' and name NOT REGEXP '^HD' ";
	$query=mysql_query($sql);
	while($rows=mysql_fetch_array($query)){
	?>
    <option value="<?=$rows["name"];?>"><?=$rows["name"];?></option>
    <?
	}
	?>
    </select></p>
 <p align="center">วันที่เริ่ม: <input type="date" name="start_date"  required>
    ถึง: <input type="date" name="end_date" required>
    <button type="submit">แสดงผล</button></p>
</form>

<table>
    <thead>
        <tr>
		    <th>ลำดับ</th>
			<th>วันที่ตรวจ</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>สิทธิการรักษา</th>
			<th>แพทย์ผู้ตรวจ</th>
            <th>ค่าคลินิกพิเศษ/นอกเวลาราชการ</th>
            <th>ค่ายา</th>
            <th>ค่า LAB</th>
            <th>ค่า XRAY</th>
            <th>ค่าบริการทั่วไป</th>
			<th>ค่าบริการอื่นๆ</th>
            <th>รวมทั้งหมด</th>
        </tr>
    </thead>
    <tbody>
        <?php 
		$i=0;
		$total=0;
		$total_clinic_fee = 0;
		$total_drug_fee = 0;
		$total_lab_fee = 0;
		$total_xray_fee = 0;
		$total_medical_service_fee = 0;
		$total_other_fee = 0;		
		while($row = mysql_fetch_assoc($result)): 
		$i++;
		// รวมยอดในแต่ละหมวด
		$total_clinic_fee += $row['clinic_fee'];
		$total_drug_fee += $row['drug_fee'];
		$total_lab_fee += $row['lab_fee'];
		$total_xray_fee += $row['xray_fee'];
		$total_medical_service_fee += $row['medical_service_fee'];
		$total_other_fee += $row['other_fee'];

		// รวมยอดทั้งหมด (จาก total_fee)
		$total += $row['total_fee'];
		?>
        <tr>
            <td><?php echo $i; ?></td>
			<td><?php echo $row['service_date']; ?></td>
			<td><?php echo $row['hn']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
			<td><?php echo $row['ptright']; ?></td>			
            <td><?php echo $row['doctor_name']; ?></td>
            <td><?php echo number_format($row['clinic_fee'],2); ?></td>
            <td><?php echo number_format($row['drug_fee'],2); ?></td>
            <td><?php echo number_format($row['lab_fee'],2); ?></td>
            <td><?php echo number_format($row['xray_fee'],2); ?></td>
            <td><?php echo number_format($row['medical_service_fee'],2); ?></td>
			<td><?php echo number_format($row['other_fee'],2); ?></td>
            <td align="rigth"><?php echo number_format($row['total_fee'],2); ?></td>
        </tr>
        <?php endwhile; ?>
		<tr>
			<td colspan="6" align="rigth">รวมทั้งหมด</td>
			<td align="rigth"><?php echo number_format($total_clinic_fee,2); ?></td>
			<td align="rigth"><?php echo number_format($total_drug_fee,2); ?></td>
			<td align="rigth"><?php echo number_format($total_lab_fee,2); ?></td>
			<td align="rigth"><?php echo number_format($total_xray_fee,2); ?></td>
			<td align="rigth"><?php echo number_format($total_medical_service_fee,2); ?></td>
			<td align="rigth"><?php echo number_format($total_other_fee,2); ?></td>
			<td align="rigth"><?php echo number_format($total,2); ?></td>
		</tr>
    </tbody>
</table>

</body>
</html>
