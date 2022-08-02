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
    <h3>ข้อมูลการจ่ายยาเฉลี่ย 12 เดือนย้อนหลัง</h3>
</div>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000" class="chk_table">
  <tr>
    <td width="2%" rowspan="2" align="center"><strong>#</strong></td>
    <td width="17%" rowspan="2" align="center"><strong>ชื่อแพทย์</strong></td>
    <td colspan="3" align="center"><strong>ก.ค.</strong></td>
	<td colspan="3" align="center"><strong>ส.ค.</strong></td>
	<td colspan="3" align="center"><strong>ก.ย.</strong></td>
	<td colspan="3" align="center"><strong>ต.ค.</strong></td>
	<td colspan="3" align="center"><strong>พ.ย.</strong></td>
	<td colspan="3" align="center"><strong>ธ.ค.</strong></td>
    <td colspan="3" align="center"><strong>ม.ค.</strong></td>
    <td colspan="3" align="center"><strong>ก.พ.</strong></td>
    <td colspan="3" align="center"><strong>มี.ค.</strong></td>
	<td colspan="3" align="center"><strong>เม.ย.</strong></td>
    <td colspan="3" align="center"><strong>พ.ค.</strong></td>
    <td colspan="3" align="center"><strong>มิ.ย.</strong></td>
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
			AND a.doctorcode IN ('12891','12456','16633','19364','37533','29760','38701','45985','50807')
            ORDER BY a.`row_id` ";			//echo $sql;
 $query=mysql_query($sql);
 $i=0;
 while($rows=mysql_fetch_array($query)){
 $i++;
 $doctor_code=$rows["doctorcode"];
 $doctor_id=substr($rows["ptname"],0,5);
 //echo $i."==>".$doctor_code."<br>";


/// มกราคม /// 
$sql1="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2565-01-01 00:00:00' AND `date` <= '2565-01-31 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql1."<br>";
$query1=mysql_query($sql1);
$num1=mysql_num_rows($query1);

$sql11="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2565-01-01 00:00:00' AND a.`date` <= '2565-01-31 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql11."<br>";
$query11=mysql_query($sql11);
list($doctor,$sumprice1)=mysql_fetch_array($query11);
$avg1=$sumprice1/$num1;
$avg1=number_format($avg1,2);



/// กุมภาพันธ์ ///
$sql2="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2565-02-01 00:00:00' AND `date` <= '2565-02-28 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql2."<br>";
$query2=mysql_query($sql2);
$num2=mysql_num_rows($query2);

$sql21="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2565-02-01 00:00:00' AND a.`date` <= '2565-02-28 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql21."<br>";
$query21=mysql_query($sql21);
list($doctor,$sumprice2)=mysql_fetch_array($query21);
$avg2=$sumprice2/$num2;
$avg2=number_format($avg2,2);




/// มีนาคม ///
$sql3="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2565-03-01 00:00:00' AND `date` <= '2565-03-31 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql3."<br>";
$query3=mysql_query($sql3);
$num3=mysql_num_rows($query3);

$sql31="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2565-03-01 00:00:00' AND a.`date` <= '2565-03-31 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql31."<br>";
$query31=mysql_query($sql31);
list($doctor,$sumprice3)=mysql_fetch_array($query31);
$avg3=$sumprice3/$num3;
$avg3=number_format($avg3,2);



/// เมษายน ///
$sql4="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2565-04-01 00:00:00' AND `date` <= '2565-04-30 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql4."<br>";
$query4=mysql_query($sql4);
$num4=mysql_num_rows($query4);

$sql41="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2565-04-01 00:00:00' AND a.`date` <= '2565-04-30 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql41."<br>";
$query41=mysql_query($sql41);
list($doctor,$sumprice4)=mysql_fetch_array($query41);
$avg4=$sumprice4/$num4;
$avg4=number_format($avg4,2);




/// พฤษภาคม ///
$sql5="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2565-05-01 00:00:00' AND `date` <= '2565-05-31 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql5."<br>";
$query5=mysql_query($sql5);
$num5=mysql_num_rows($query5);

$sql51="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2565-05-01 00:00:00' AND a.`date` <= '2565-05-31 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql51."<br>";
$query51=mysql_query($sql51);
list($doctor,$sumprice5)=mysql_fetch_array($query51);
$avg5=$sumprice5/$num5;
$avg5=number_format($avg5,2);



/// มิถุนายน ///
$sql6="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2565-06-01 00:00:00' AND `date` <= '2565-06-30 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql6."<br>";
$query6=mysql_query($sql6);
$num6=mysql_num_rows($query6);

$sql61="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2565-06-01 00:00:00' AND a.`date` <= '2565-06-30 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
list($doctor,$sumprice6)=mysql_fetch_array($query61);
$avg6=$sumprice6/$num6;
$avg6=number_format($avg6,2);


/// กรกฎาคม ///
$sql7="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2564-07-01 00:00:00' AND `date` <= '2564-07-31 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql7."<br>";
$query7=mysql_query($sql7);
$num7=mysql_num_rows($query7);

$sql71="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2564-07-01 00:00:00' AND a.`date` <= '2564-07-31 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql71."<br>";
$query71=mysql_query($sql71);
list($doctor,$sumprice7)=mysql_fetch_array($query71);
$avg7=$sumprice7/$num7;
$avg7=number_format($avg7,2);



/// สิงหาาคม ///
$sql8="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2564-08-01 00:00:00' AND `date` <= '2564-08-31 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql8."<br>";
$query8=mysql_query($sql8);
$num8=mysql_num_rows($query8);

$sql81="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2564-08-01 00:00:00' AND a.`date` <= '2564-08-31 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql81."<br>";
$query81=mysql_query($sql81);
list($doctor,$sumprice8)=mysql_fetch_array($query81);
$avg8=$sumprice8/$num8;
$avg8=number_format($avg8,2);



/// กันยายน ///
$sql9="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2564-09-01 00:00:00' AND `date` <= '2564-09-31 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql9."<br>";
$query9=mysql_query($sql9);
$num9=mysql_num_rows($query9);

$sql91="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2564-09-01 00:00:00' AND a.`date` <= '2564-09-31 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql91."<br>";
$query91=mysql_query($sql91);
list($doctor,$sumprice9)=mysql_fetch_array($query91);
$avg9=$sumprice9/$num9;
$avg9=number_format($avg9,2);


/// ตุลาคม ///
$sql10="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2564-10-01 00:00:00' AND `date` <= '2564-10-31 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql10."<br>";
$query10=mysql_query($sql10);
$num10=mysql_num_rows($query10);

$sql101="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2564-10-01 00:00:00' AND a.`date` <= '2564-10-31 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql101."<br>";
$query101=mysql_query($sql101);
list($doctor,$sumprice10)=mysql_fetch_array($query101);
$avg10=$sumprice10/$num10;
$avg10=number_format($avg10,2);



/// พฤศจิกายน ///
$sql11="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2564-11-01 00:00:00' AND `date` <= '2564-11-30 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql11."<br>";
$query11=mysql_query($sql11);
$num11=mysql_num_rows($query11);

$sql111="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2564-11-01 00:00:00' AND a.`date` <= '2564-11-30 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql111."<br>";
$query111=mysql_query($sql111);
list($doctor,$sumprice11)=mysql_fetch_array($query111);
$avg11=$sumprice11/$num11;
$avg11=number_format($avg11,2);


/// ธันวาคม ///
$sql12="select * from phardep where doctor like '%$doctor_code%' and `date` >= '2564-12-01 00:00:00' AND `date` <= '2564-12-31 23:59:59' and (ptright like 'R07%' and cashok ='ประกันสังคม') and (an is null || an='') and doctor NOT REGEXP '^HD' group by substring(date,1,10), hn";
//echo $sql12."<br>";
$query12=mysql_query($sql12);
$num12=mysql_num_rows($query12);

$sql121="select a.doctor, sum(b.price) as sumprice
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') 
    and a.`date` >= '2564-12-01 00:00:00' AND a.`date` <= '2564-12-31 23:59:59'
    and a.doctor like '%$doctor_code%'  and a.doctor NOT REGEXP '^HD'
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by doctor";
//echo $sql121."<br>";
$query121=mysql_query($sql121);
list($doctor,$sumprice12)=mysql_fetch_array($query121);
$avg12=$sumprice12/$num12;
$avg12=number_format($avg12,2);

$avg=($sumprice1+$sumprice2+$sumprice3+$sumprice4+$sumprice5+$sumprice6+$sumprice7+$sumprice8+$sumprice9+$sumprice10+$sumprice11+$sumprice12)/($num1+$num2+$num3+$num4+$num5+$num6+$num7+$num8+$num9+$num10+$num11+$num12);

 ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["doctor_name"];?></td>
    <td align="center"><?=$num7;?></td>
    <td align="right"><?=number_format($sumprice7,2);?></td>
    <td align="right"><?=$avg7;?></td>
    <td align="center"><?=$num8;?></td>
    <td align="right"><?=number_format($sumprice8,2);?></td>
    <td align="right"><?=$avg8;?></td>
    <td align="center"><?=$num9;?></td>
    <td align="right"><?=number_format($sumprice9,2);?></td>
    <td align="right"><?=$avg9;?></td>
    <td align="center"><?=$num10;?></td>
    <td align="right"><?=number_format($sumprice10,2);?></td>
    <td align="right"><?=$avg10;?></td>
    <td align="center"><?=$num11;?></td>
    <td align="right"><?=number_format($sumprice11,2);?></td>
    <td align="right"><?=$avg11;?></td>
    <td align="center"><?=$num12;?></td>
    <td align="right"><?=number_format($sumprice12,2);?></td>
    <td align="right"><?=$avg12;?></td>	
	<td align="center"><?=$num1;?></td>
    <td align="right"><?=number_format($sumprice1,2);?></td>
    <td align="right"><?=$avg1;?></td>
    <td align="center"><?=$num2;?></td>
    <td align="right"><?=number_format($sumprice2,2);?></td>
    <td align="right"><?=$avg2;?></td>
    <td align="center"><?=$num3;?></td>
    <td align="right"><?=number_format($sumprice3,2);?></td>
    <td align="right"><?=$avg3;?></td>
    <td align="center"><?=$num4;?></td>
    <td align="right"><?=number_format($sumprice4,2);?></td>
    <td align="right"><?=$avg4;?></td>
    <td align="center"><?=$num5;?></td>
    <td align="right"><?=number_format($sumprice5,2);?></td>
    <td align="right"><?=$avg5;?></td>
    <td align="center"><?=$num6;?></td>
    <td align="right"><?=number_format($sumprice6,2);?></td>
    <td align="right"><?=$avg6;?></td>
	<td align="right"><?=number_format($avg,2);?></td>   
  </tr>
<?
}
?>  
</table>
