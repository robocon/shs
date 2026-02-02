<?php
// 1. เชื่อมต่อฐานข้อมูล (MySQL Legacy)
include("connect.inc");

// 2. รับค่า VN (ตัวอย่าง: get_billing.php?vn=15)
//$vn = mysql_real_escape_string($_GET['vn']);
$vn="111";
$thdatevn= date("d-m-").(date("Y")+543).$vn;
$datechk= (date("Y")+543).date("-m-d");


// 3. ดึงข้อมูลสิทธิผู้ป่วยจากตาราง opday และวงเงินจาก runno
$sql_info = "SELECT o.vn, o.hn, o.ptname, o.ptright, r.runno as limit_amount 
             FROM opday o 
             LEFT JOIN runno r ON o.ptright LIKE CONCAT('%', r.title, '%')
             WHERE o.thdatevn = '$thdatevn'
			 LIMIT 1";
//echo $sql_info."<br>";			 
$res_info = mysql_query($sql_info);
$info = mysql_fetch_assoc($res_info);

if (!$info) {
    die(json_encode(array("error" => "VN not found")));
}

// 4. คำนวณค่ายาจาก dphardep
$sql_drug = "SELECT hn,tvn, SUM(price) as drug_total FROM dphardep WHERE date LIKE '$datechk%' AND tvn = '$vn'";
//echo $sql_drug."<br>";
$res_drug = mysql_query($sql_drug);
$row_drug = mysql_fetch_assoc($res_drug);
$drug_total = (float)$row_drug['drug_total'];

// 5. คำนวณค่ารักษาอื่นๆ จาก depart
$sql_other = "SELECT hn,tvn,SUM(price) as other_total FROM depart WHERE date LIKE '$datechk%' AND tvn = '$vn'";
//echo $sql_other."<br>";
$res_other = mysql_query($sql_other);
$row_other = mysql_fetch_assoc($res_other);
$other_total = (float)$row_other['other_total'];

// 6. สรุปผลยอดรวมและการเปรียบเทียบ
$total_spent = $drug_total + $other_total;
$limit_amount = (float)$info['limit_amount'];
$remaining = $limit_amount - $total_spent;

// 7. จัดรูปแบบข้อมูล JSON (สไตล์ PHP < 5.4)
$response = array(
    "vn" => $info['vn'],
    "hn" => $info['hn'],
	"ptname" => $info['ptname'],
    "ptright" => $info['ptright'],
    "limit_amount" => $limit_amount,
    "spent" => array(
        "drug" => $drug_total,
        "other" => $other_total,
        "total" => $total_spent
    ),
    "remaining" => $remaining,
    "is_over" => ($total_spent > $limit_amount) ? true : false
);

// 5. ส่งออกข้อมูล
header('Content-Type: application/json; charset=utf-8');
$json = json_encode($response);

if ($json === false) {
    // ถ้ายังไม่ออก แสดงว่ามีปัญหาเรื่องการ Encoding ภาษาไทย
    echo json_encode(array("error" => "JSON encoding failed: " . json_last_error_msg()));
} else {
    echo $json;
}

mysql_close($Conn);
?>