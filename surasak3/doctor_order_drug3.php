<?php
session_start();
include("../connect.inc");
if( $_SESSION["smenucode"] != 'ADM' && ( $_SESSION["smenucode"] != 'ADMSSO' && $_SESSION['sIdname'] != 'สุมนา1' ) ){
    echo "ไม่สามารถเข้าใช้งานได้";
    exit;
}

?>
<style>
/* ตาราง */
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
    <a href="../nindex.htm">&lt;&lt;&nbsp;กลับหน้าหลัก ร.พ.</a> | <a href="doctor_order_drug.php">ข้อมูลยา</a> | <a href="doctor_order_drug2.php">ข้อมูลยาที่มีมูลค่าการใช้สูง</a> | <a href="doctor_order_drug3.php">ข้อมูลการจ่ายยาเฉลี่ย 3 เดือนย้อนหลัง</a>
</div>
<div>
    <h3>ข้อมูลการจ่ายยาเฉลี่ย 3 เดือนย้อนหลัง</h3>
</div>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000" class="chk_table">
  <tr>
    <td width="2%" rowspan="2" align="center"><strong>#</strong></td>
    <td width="17%" rowspan="2" align="center"><strong>ชื่อแพทย์</strong></td>
    <td colspan="3" align="center"><strong>เม.ย.</strong></td>
    <td colspan="3" align="center"><strong>พ.ค.</strong></td>
    <td colspan="3" align="center"><strong>มิ.ย.</strong></td>
    <td width="15%" rowspan="2" align="center"><strong>หมายเหตุ</strong></td>
  </tr>
  <tr>
    <td width="6%" align="center"><strong>PT</strong></td>
    <td width="7%" align="center"><strong>เงิน</strong></td>
    <td width="9%" align="center"><strong>เฉลี่ย</strong></td>
    <td width="6%" align="center"><strong>PT</strong></td>
    <td width="7%" align="center"><strong>เงิน</strong></td>
    <td width="9%" align="center"><strong>เฉลี่ย</strong></td>
    <td width="6%" align="center"><strong>PT</strong></td>
    <td width="7%" align="center"><strong>เงิน</strong></td>
    <td width="9%" align="center"><strong>เฉลี่ย</strong></td>
  </tr>
 <?
 $sql = "SELECT CONCAT(a.`yot`,b.`name`) AS `doctor_name`,a.`doctorcode`, b.`name` 
            FROM `doctor` AS a 
            LEFT JOIN `inputm` AS b ON b.`codedoctor` = a.`doctorcode`
            WHERE a.`status` = 'y'  and b.`status` = 'y'
            AND ( a.`menucode` = 'ADM' OR a.`menucode` = 'ADMNID' ) 
            AND ( 
                a.`doctorcode` IS NOT NULL 
                AND a.`doctorcode` != '00000' 
                AND a.`doctorcode` != '0000' 
            ) 
            AND ( b.`name` NOT REGEXP '^HD' AND b.`name` NOT REGEXP '^NID' ) 
			AND ( a.`name` NOT REGEXP '^HD' AND a.`name` NOT REGEXP '^NID' ) 
			AND a.doctorcode NOT IN ('10212','17321','44155','714','819','41751','40252','61248','61219','61252','61241','61217','1254','907')
            ORDER BY a.`row_id` ";
			//echo $sql;
 $query=mysql_query($sql);
 $i=0;
 while($rows=mysql_fetch_array($query)){
 $i++;
 $doctor_code=$rows["doctorcode"];
 
$sql1="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2562-04-01 00:00:00' AND `date` <= '2562-04-30 23:59:59' and ptright like 'R07%' and (an is null || an='')";
//echo $sql1."<br>";
$query1=mysql_query($sql1);
$num1=mysql_num_rows($query1);

$sql11="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where a.ptright like 'R07%' 
    and b.part like 'dd%' 
    and a.`date` >= '2562-04-01 00:00:00' AND a.`date` <= '2562-04-30 23:59:59'
    and a.doctor like '%$doctor_code%' 
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') group by doctor";
//echo $sql11."<br>";
$query11=mysql_query($sql11);
list($doctor,$sumprice1)=mysql_fetch_array($query11);
$avg1=$sumprice1/$num1;
$avg1=number_format($avg1,2);



$sql2="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2562-05-01 00:00:00' AND `date` <= '2562-05-31 23:59:59' and ptright like 'R07%' and (an is null || an='')";
//echo $sql2."<br>";
$query2=mysql_query($sql2);
$num2=mysql_num_rows($query2);

$sql21="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where a.ptright like 'R07%' 
    and b.part like 'dd%' 
    and a.`date` >= '2562-05-01 00:00:00' AND a.`date` <= '2562-05-31 23:59:59'
    and a.doctor like '%$doctor_code%' 
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') group by doctor";
//echo $sql21."<br>";
$query21=mysql_query($sql21);
list($doctor,$sumprice2)=mysql_fetch_array($query21);
$avg2=$sumprice2/$num2;
$avg2=number_format($avg2,2);




$sql3="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2562-06-01 00:00:00' AND `date` <= '2562-06-30 23:59:59' and ptright like 'R07%' and (an is null || an='')";
//echo $sql3."<br>";
$query3=mysql_query($sql3);
$num3=mysql_num_rows($query3);

$sql31="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where a.ptright like 'R07%' 
    and b.part like 'dd%' 
    and a.`date` >= '2562-06-01 00:00:00' AND a.`date` <= '2562-06-30 23:59:59'
    and a.doctor like '%$doctor_code%' 
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') group by doctor";
//echo $sql31."<br>";
$query31=mysql_query($sql31);
list($doctor,$sumprice3)=mysql_fetch_array($query31);
$avg3=$sumprice3/$num3;
$avg3=number_format($avg3,2);
 ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["doctor_name"];?></td>
    <td align="center"><?=$num1;?></td>
    <td align="right"><?=$sumprice1;?></td>
    <td align="right"><?=$avg1;?></td>
    <td align="center"><?=$num2;?></td>
    <td align="right"><?=$sumprice2;?></td>
    <td align="right"><?=$avg2;?></td>
    <td align="center"><?=$num3;?></td>
    <td align="right"><?=$sumprice3;?></td>
    <td align="right"><?=$avg3;?></td>
    <td>&nbsp;</td>
  </tr>
<?
}
?>  
</table>
