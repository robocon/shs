<?php
include("connect.inc");

$where = "drug_active='y'";
if(!empty($_POST["part"])) $where .= " AND part = '".$_POST["part"]."'";
else $where .= " AND part LIKE 'DD%'";

if(!empty($_POST["lock"])){
    if($_POST["lock"] == "OPD_Y") $where .= " AND `lock` ='Y'";
    if($_POST["lock"] == "OPD_N") $where .= " AND `lock` ='N'";
    if($_POST["lock"] == "IPD_Y") $where .= " AND `lock_ipd` ='Y'";
    if($_POST["lock"] == "IPD_N") $where .= " AND `lock_ipd` ='N'";
}

$result = mysql_query("SELECT * FROM druglst WHERE $where ORDER BY tradname ASC");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=drug_status_'.date('YmdHis').'.csv');

$output = fopen('php://output', 'w');
// ใส่ BOM สำหรับ UTF-8 เพื่อให้ Excel อ่านภาษาไทยออก
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// หัวตาราง
fputcsv($output, array('รหัสยา', 'ชื่อการค้า', 'ชื่อสามัญ', 'บัญชียา', 'สถานะ OPD', 'สถานะ IPD', 'ราคา'));

while($row = mysql_fetch_assoc($result)){
    fputcsv($output, array(
        $row['drugcode'],
        $row['tradname'],
        $row['genname'],
        ($row['part'] == 'DDL' ? 'ED' : 'NED'),
        ($row['lock'] == 'N' ? 'LOCKED' : 'OPEN'),
        ($row['lock_ipd'] == 'N' ? 'LOCKED' : 'OPEN'),
        number_format($row['salepri'], 2)
    ));
}
fclose($output);
exit();
?>