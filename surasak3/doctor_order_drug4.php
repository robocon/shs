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
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
</style>
<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;กลับหน้าหลัก ร.พ.</a> | <a href="doctor_order_drug.php">ข้อมูลยา</a> | <a href="doctor_order_drug2.php">ข้อมูลยาที่มีมูลค่าการใช้สูง</a> | <a href="doctor_order_drug3.php">ข้อมูลการจ่ายยาเฉลี่ย 4 เดือนย้อนหลัง</a> | <a href="doctor_order_drug4.php">ข้อมูลการจ่ายยาเฉลี่ย 4 เดือนย้อนหลัง (MED)</a> | <a href="doctor_order_drug5.php">ข้อมูลยาที่มีการจ่ายมูลค่าสูงสุด 10 อันดับ</a></div>
<div>
    <h3>ข้อมูลการจ่ายยาเฉลี่ย 9 เดือนย้อนหลัง</h3>
</div>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000" class="chk_table">
  <tr>
    <td width="2%" rowspan="2" align="center"><strong>#</strong></td>
    <td width="17%" rowspan="2" align="center"><strong>ชื่อแพทย์</strong></td>
    <td colspan="3" align="center"><strong>ก.ย.</strong></td>
    <td colspan="3" align="center"><strong>ต.ค.</strong></td>
    <td colspan="3" align="center"><strong>พ.ย.</strong></td>
    <td colspan="3" align="center"><strong>ธ.ค.</strong></td>    
    <td width="15%" rowspan="2" align="center"><strong>เฉลี่ย</strong></td>
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
    <td width="6%" align="center"><strong>PT</strong></td>
    <td width="7%" align="center"><strong>เงิน</strong></td>
    <td width="9%" align="center"><strong>เฉลี่ย</strong></td>    
  </tr>
 <?
 $sql = "SELECT CONCAT(a.`yot`,b.`name`) AS `doctor_name`,a.`name` as ptname,a.`doctorcode`, b.`name` 
            FROM `doctor` AS a 
            LEFT JOIN `inputm` AS b ON b.`codedoctor` = a.`doctorcode`
            WHERE a.`status` = 'y'  and b.`status` = 'y'
            AND ( b.`name` NOT REGEXP '^HD' AND b.`name` NOT REGEXP '^NID' ) 
			AND ( a.`name` NOT REGEXP '^HD' AND a.`name` NOT REGEXP '^NID' ) 
			AND a.doctorcode IN ('12891','12456','16633','19364','37533','29760','38701','45985')
            ORDER BY a.`row_id` ";			//echo $sql;
 $query=mysql_query($sql);
 $i=0;
 while($rows=mysql_fetch_array($query)){
 $i++;
 $doctor_code=$rows["doctorcode"];
 $doctor_id=substr($rows["ptname"],0,5);
 //echo $i."==>".$doctor_code."<br>";
 

$sql6="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2562-09-01 00:00:00' AND `date` <= '2562-09-30 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql6."<br>";
$query6=mysql_query($sql6);
$num6=mysql_num_rows($query6);

$sql61="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2562-09-01 00:00:00' AND a.`date` <= '2562-09-30 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
list($doctor,$sumprice6)=mysql_fetch_array($query61);
$avg6=$sumprice6/$num6;
$avg6=number_format($avg6,2);



$sql7="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2562-10-01 00:00:00' AND `date` <= '2562-10-31 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql7."<br>";
$query7=mysql_query($sql7);
$num7=mysql_num_rows($query7);

$sql71="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2562-10-01 00:00:00' AND a.`date` <= '2562-10-31 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql71."<br>";
$query71=mysql_query($sql71);
list($doctor,$sumprice7)=mysql_fetch_array($query71);
$avg7=$sumprice7/$num7;
$avg7=number_format($avg7,2);




$sql8="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2562-11-01 00:00:00' AND `date` <= '2562-11-30 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql8."<br>";
$query8=mysql_query($sql8);
$num8=mysql_num_rows($query8);

$sql81="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2562-11-01 00:00:00' AND a.`date` <= '2562-11-30 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql81."<br>";
$query81=mysql_query($sql81);
list($doctor,$sumprice8)=mysql_fetch_array($query81);
$avg8=$sumprice8/$num8;
$avg8=number_format($avg8,2);


$sql9="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2562-12-01 00:00:00' AND `date` <= '2562-12-31 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql9."<br>";
$query9=mysql_query($sql9);
$num9=mysql_num_rows($query9);

$sql91="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2562-12-01 00:00:00' AND a.`date` <= '2562-12-31 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql91."<br>";
$query91=mysql_query($sql91);
list($doctor,$sumprice9)=mysql_fetch_array($query91);
$avg9=$sumprice9/$num9;
$avg9=number_format($avg9,2);

$avg=($sumprice6+$sumprice7+$sumprice8+$sumprice9)/($num6+$num7+$num8+$num9);

 ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["doctor_name"];?></td>
    <td align="center"><?=$num6;?></td>
    <td align="right"><?=number_format($sumprice6,2);?></td>
    <td align="right"><?=$avg6;?></td>
    <td align="center"><?=$num7;?></td>
    <td align="right"><?=number_format($sumprice7,2);?></td>
    <td align="right"><?=$avg7;?></td>
    <td align="center"><?=$num8;?></td>
    <td align="right"><?=number_format($sumprice8,2);?></td>
    <td align="right"><?=$avg8;?></td>
    <td align="center"><?=$num9;?></td>
    <td align="right"><?=number_format($sumprice9,2);?></td>
    <td align="right"><?=$avg9;?></td>
    <td align="right"><?=number_format($avg,2);?></td>    
  </tr>
<?
}
?>  
</table>
