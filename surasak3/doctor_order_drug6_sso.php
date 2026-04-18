<?php
// เปิดเช็ก Error
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
include("../connect.inc");

if( $_SESSION["smenucode"] != 'ADM' && ( $_SESSION["smenucode"] != 'ADMSSO' && $_SESSION['sIdname'] != 'สุมนา1' ) ){
    echo "ไม่สามารถเข้าใช้งานได้";
    exit;
}

// --- ย้ายฟังก์ชันมาไว้ข้างนอกลูป เพื่อไม่ให้เกิดการ Redeclare ---
function getMonthData($d_code, $start_date, $end_date) {
    // นับคนไข้
    $s1 = "SELECT hn FROM phardep WHERE doctor LIKE '%$d_code%' AND `date` >= '$start_date 00:00:00' AND `date` <= '$end_date 23:59:59' AND (ptright LIKE 'R07%' AND cashok ='ประกันสังคม') AND (an IS NULL OR an='') AND doctor NOT REGEXP '^HD' GROUP BY SUBSTRING(date,1,10), hn";
    $q1 = mysql_query($s1);
    $num = ($q1) ? mysql_num_rows($q1) : 0;

    // รวมเงิน
    $s2 = "SELECT SUM(b.price) as sumprice FROM phardep as a LEFT JOIN drugrx as b ON b.idno = a.row_id WHERE (a.ptright LIKE 'R07%' AND a.cashok = 'ประกันสังคม') AND (b.part='DDL' OR b.part='DDY') AND a.`date` >= '$start_date 00:00:00' AND a.`date` <= '$end_date 23:59:59' AND a.doctor LIKE '%$d_code%' AND (a.an IS NULL OR a.an='') AND (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') AND b.amount > 0";
    $q2 = mysql_query($s2);
    $res = mysql_fetch_array($q2);
    $sum = ($res['sumprice']) ? $res['sumprice'] : 0;
    
    $avg = ($num > 0) ? ($sum / $num) : 0;
    return array("num" => $num, "sum" => $sum, "avg" => $avg);
}
// -------------------------------------------------------
?>

<style>
body, button{
    font-family: "TH SarabunPSK", "TH Sarabun New";
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}
.chk_table th{
    background-color: #b5b5b5;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
    font-size: 16pt;
}
</style>

<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;กลับหน้าหลัก ร.พ.</a> | <a href="doctor_order_drug.php">ข้อมูลยา</a>
</div>
<div>
    <h3>ข้อมูลการจ่ายยาเฉลี่ย 6 เดือนย้อนหลัง (ต.ค. 68 - มี.ค. 69)</h3>
</div>

<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000" class="chk_table">
  <tr>
    <td width="2%" rowspan="2" align="center"><strong>#</strong></td>
    <td width="17%" rowspan="2" align="center"><strong>ชื่อแพทย์</strong></td>
    <td colspan="3" align="center"><strong>มี.ค. 69</strong></td>
    <td colspan="3" align="center"><strong>ก.พ. 69</strong></td>
    <td colspan="3" align="center"><strong>ม.ค. 69</strong></td>
    <td colspan="3" align="center"><strong>ธ.ค. 68</strong></td>
    <td colspan="3" align="center"><strong>พ.ย. 68</strong></td>
    <td colspan="3" align="center"><strong>ต.ค. 68</strong></td>
    <td width="10%" rowspan="2" align="center"><strong>เฉลี่ยรวม 6ด.</strong></td>
  </tr>
  <tr>
    <?php for($k=0; $k<6; $k++){ ?>
    <td width="4%" align="center"><strong>PT</strong></td><td width="5%" align="center"><strong>เงิน</strong></td><td width="5%" align="center"><strong>เฉลี่ย</strong></td>
    <?php } ?>
  </tr>

<?php
$sql = "SELECT CONCAT(a.`yot`,b.`name`) AS `doctor_name`, a.`doctorcode` 
        FROM `doctor` AS a 
        LEFT JOIN `inputm` AS b ON b.`codedoctor` = a.`doctorcode`
        WHERE a.`status` = 'y' AND b.`status` = 'y'
        AND ( a.`menucode` = 'ADM' OR a.`menucode` = 'ADMNID' OR a.`menucode` = 'ADMHEM' ) 
        AND ( a.`doctorcode` IS NOT NULL AND a.`doctorcode` NOT IN ('00000','0000') )
        AND ( b.`name` NOT REGEXP '^HD' AND b.`name` NOT REGEXP '^NID' ) 
        AND a.doctorcode NOT IN ('10212','17321','44155','714','819','41751','40252','61248','61219','61252','61241','61217','1254','907','54854','53443','48734','58775','64978','61262','38701','45944','58031','50807')
        ORDER BY a.`row_id` ";

$query = mysql_query($sql);
$i = 0;

while($rows = mysql_fetch_array($query)){
    $i++;
    $doctor_code = $rows["doctorcode"];

    // ดึงข้อมูลแต่ละเดือน (ต.ค. 68 - มี.ค. 69)
    $m3_69 = getMonthData($doctor_code, '2569-03-01', '2569-03-31');
    $m2_69 = getMonthData($doctor_code, '2569-02-01', '2569-02-28');
    $m1_69 = getMonthData($doctor_code, '2569-01-01', '2569-01-31');
    $m12_68 = getMonthData($doctor_code, '2568-12-01', '2568-12-31');
    $m11_68 = getMonthData($doctor_code, '2568-11-01', '2568-11-30');
    $m10_68 = getMonthData($doctor_code, '2568-10-01', '2568-10-31');

    // คำนวณค่าเฉลี่ยรวม 6 เดือน
    $total_pt = $m3_69['num'] + $m2_69['num'] + $m1_69['num'] + $m12_68['num'] + $m11_68['num'] + $m10_68['num'];
    $total_sum = $m3_69['sum'] + $m2_69['sum'] + $m1_69['sum'] + $m12_68['sum'] + $m11_68['sum'] + $m10_68['sum'];
    $grand_avg = ($total_pt > 0) ? ($total_sum / $total_pt) : 0;
?>
  <tr>
    <td align="center"><?php echo $i; ?></td>
    <td><?php echo $rows["doctor_name"]; ?></td>
    
    <td align="center"><?php echo $m3_69['num']; ?></td>
    <td align="right"><?php echo number_format($m3_69['sum'], 2); ?></td>
    <td align="right"><?php echo number_format($m3_69['avg'], 2); ?></td>
    
    <td align="center"><?php echo $m2_69['num']; ?></td>
    <td align="right"><?php echo number_format($m2_69['sum'], 2); ?></td>
    <td align="right"><?php echo number_format($m2_69['avg'], 2); ?></td>
    
    <td align="center"><?php echo $m1_69['num']; ?></td>
    <td align="right"><?php echo number_format($m1_69['sum'], 2); ?></td>
    <td align="right"><?php echo number_format($m1_69['avg'], 2); ?></td>
    
    <td align="center"><?php echo $m12_68['num']; ?></td>
    <td align="right"><?php echo number_format($m12_68['sum'], 2); ?></td>
    <td align="right"><?php echo number_format($m12_68['avg'], 2); ?></td>
    
    <td align="center"><?php echo $m11_68['num']; ?></td>
    <td align="right"><?php echo number_format($m11_68['sum'], 2); ?></td>
    <td align="right"><?php echo number_format($m11_68['avg'], 2); ?></td>
    
    <td align="center"><?php echo $m10_68['num']; ?></td>
    <td align="right"><?php echo number_format($m10_68['sum'], 2); ?></td>
    <td align="right"><?php echo number_format($m10_68['avg'], 2); ?></td>

    <td align="right" style="background-color: #ffffcc;"><strong><?php echo number_format($grand_avg, 2); ?></strong></td>
  </tr>
<?php
}
?>
</table>