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
<?
$doctorcode=$_GET["doctorcode"];
$mdcode=$_GET["doctorid"];
?>
<p align="center"><strong>รายละเอียดการจ่ายยาของ <?=$_GET["doctor"];?> เดือน กันยายน 2562</strong></p>
<table width="80%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center">#</td>
    <td align="center"><strong>รายการ</strong></td>
    <td align="center"><strong>จำนวนคน</strong></td>
    <td align="center"><strong>จำนวนเงิน</strong></td>
    <td align="center"><strong>เฉลี่ย</strong></td>
  </tr>
<?
$sql="select a.hn, sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date` >= '2562-09-01 00:00:00' AND a.`date` <= '2562-09-30 23:59:59' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
$sumrx=0;
$countrx=0;
while($rows=mysql_fetch_array($query)){
$date=substr($rows["date"],0,10);
$sqlrx="SELECT * FROM `appoint` AS a INNER JOIN opcard AS b ON a.hn = b.hn WHERE a.hn='".$rows["hn"]."' AND a.`date`
LIKE '2562-09%' AND (a.`doctor` LIKE '%$doctorcode%' OR a.`doctor` LIKE '$mdcode%') AND a.`doctor` NOT REGEXP '^HD' AND b.ptright LIKE 'R07%' AND (a.apptime NOT LIKE '%ยกเลิก%')";
//echo "--->".$sqlrx."<br>";
$queryrx=mysql_query($sqlrx);
$numrx=mysql_num_rows($queryrx);
	if($numrx < 1){
		$countrx++;
		$rowsrx=mysql_fetch_array($queryrx);
		$sumrx=$sumrx+$rows["sumprice"];	
	}
}
//echo $countrx."==>".$sumrx;
$avg=$sumrx/$countrx;
$avgrx=number_format($avg,2);
?>    
  <tr>
    <td>1</td>
    <td>สั่งจ่ายยา กรณีไม่มีนัด</td>
    <td align="center"><?=$countrx;?></td>
    <td align="right"><?=number_format($sumrx,2);?></td>
    <td align="right"><?=$avgrx;?></td>
  </tr>  
<?
$sql1="SELECT *
FROM `appoint` AS a
INNER JOIN opcard AS b ON a.hn = b.hn
WHERE a.`date`
LIKE '2562-09%' AND (
a.`doctor`
LIKE '%$doctorcode%' OR a.`doctor`
LIKE '$mdcode%'
) AND a.`doctor` NOT
REGEXP '^HD' AND b.ptright
LIKE 'R07%' AND (
a.appdate
LIKE '%กันยายน 2562' AND a.apptime NOT
LIKE '%ยกเลิก%'
)";
$query1=mysql_query($sql1);
$num1=mysql_num_rows($query1);
$sumrx1=0;
$countrx1=0;
while($rows1=mysql_fetch_array($query1)){
$date=substr($rows1["date"],0,10);
$sqlrx1="select sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date`LIKE '$date%' and a.hn='".$rows1["hn"]."' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo "--->".$sqlrx1."<br>";
$queryrx1=mysql_query($sqlrx1);
$numrx1=mysql_num_rows($queryrx1);
	if($numrx1 > 0){
		$countrx1++;
		$rowsrx1=mysql_fetch_array($queryrx1);
		$sumrx1=$sumrx1+$rowsrx1["sumprice"];	
	}
}
//echo $countrx1."==>".$sumrx1;
$avg1=$sumrx1/$countrx1;
$avgrx1=number_format($avg1,2);
?>    
  <tr>
    <td>2</td>
    <td>สั่งจ่ายยา นัดเดือนกันยายน 2562</td>
    <td align="center"><?=$countrx1;?></td>
    <td align="right"><?=number_format($sumrx1,2);?></td>
    <td align="right"><?=$avgrx1;?></td>
  </tr>
<?
$sql2="SELECT *
FROM `appoint` AS a
INNER JOIN opcard AS b ON a.hn = b.hn
WHERE a.`date`
LIKE '2562-09%' AND (
a.`doctor`
LIKE '%$doctorcode%' OR a.`doctor`
LIKE '$mdcode%'
) AND a.`doctor` NOT
REGEXP '^HD' AND b.ptright
LIKE 'R07%' AND (
a.appdate
LIKE '%ตุลาคม 2562' AND a.apptime NOT
LIKE '%ยกเลิก%'
)";
$query2=mysql_query($sql2);
$num2=mysql_num_rows($query2);
$sumrx2=0;
$countrx2=0;
while($rows2=mysql_fetch_array($query2)){
$date=substr($rows2["date"],0,10);
$sqlrx2="select sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date`LIKE '$date%' and a.hn='".$rows2["hn"]."' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo "--->".$sqlrx2."<br>";
$queryrx2=mysql_query($sqlrx2);
$numrx2=mysql_num_rows($queryrx2);
	if($numrx2 > 0){
		$countrx2++;
		$rowsrx2=mysql_fetch_array($queryrx2);
		$sumrx2=$sumrx2+$rowsrx2["sumprice"];	
	}
}
//echo $countrx2."==>".$sumrx2;
$avg2=$sumrx2/$countrx2;
$avgrx2=number_format($avg2,2);
?>    
  <tr>
    <td>3</td>
    <td>สั่งจ่ายยา นัดเดือนตุลาคม 2562</td>
    <td align="center"><?=$countrx2;?></td>
    <td align="right"><?=number_format($sumrx2,2);?></td>
    <td align="right"><?=$avgrx2;?></td>
  </tr>
<?
$sql3="SELECT *
FROM `appoint` AS a
INNER JOIN opcard AS b ON a.hn = b.hn
WHERE a.`date`
LIKE '2562-09%' AND (
a.`doctor`
LIKE '%$doctorcode%' OR a.`doctor`
LIKE '$mdcode%'
) AND a.`doctor` NOT
REGEXP '^HD' AND b.ptright
LIKE 'R07%' AND (
a.appdate
LIKE '%พฤศจิกายน 2562' AND a.apptime NOT
LIKE '%ยกเลิก%'
)";
$query3=mysql_query($sql3);
$num3=mysql_num_rows($query3);
$sumrx3=0;
$countrx3=0;
while($rows3=mysql_fetch_array($query3)){
$date=substr($rows3["date"],0,10);
$sqlrx3="select sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date`LIKE '$date%' and a.hn='".$rows3["hn"]."' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo "--->".$sqlrx3."<br>";
$queryrx3=mysql_query($sqlrx3);
$numrx3=mysql_num_rows($queryrx3);
	if($numrx3 > 0){
		$countrx3++;
		$rowsrx3=mysql_fetch_array($queryrx3);
		$sumrx3=$sumrx3+$rowsrx3["sumprice"];	
	}
}
//echo $countrx3."==>".$sumrx3;
$avg3=$sumrx3/$countrx3;
$avgrx3=number_format($avg3,2);
?>    
  <tr>
    <td>4</td>
    <td>สั่งจ่ายยา นัดเดือนพฤศจิกายน 2562</td>
    <td align="center"><?=$countrx3;?></td>
    <td align="right"><?=number_format($sumrx3,2);?></td>
    <td align="right"><?=$avgrx3;?></td>
  </tr>
<?
$sql4="SELECT *
FROM `appoint` AS a
INNER JOIN opcard AS b ON a.hn = b.hn
WHERE a.`date`
LIKE '2562-09%' AND (
a.`doctor`
LIKE '%$doctorcode%' OR a.`doctor`
LIKE '$mdcode%'
) AND a.`doctor` NOT
REGEXP '^HD' AND b.ptright
LIKE 'R07%' AND (
a.appdate
LIKE '%ธันวาคม 2562' AND a.apptime NOT
LIKE '%ยกเลิก%'
)";
$query4=mysql_query($sql4);
$num4=mysql_num_rows($query4);
$sumrx4=0;
$countrx4=0;
while($rows4=mysql_fetch_array($query4)){
$date=substr($rows4["date"],0,10);
$sqlrx4="select sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date`LIKE '$date%' and a.hn='".$rows4["hn"]."' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo "--->".$sqlrx4."<br>";
$queryrx4=mysql_query($sqlrx4);
$numrx4=mysql_num_rows($queryrx4);
	if($numrx4 > 0){
		$countrx4++;
		$rowsrx4=mysql_fetch_array($queryrx4);
		$sumrx4=$sumrx4+$rowsrx4["sumprice"];	
	}
}
//echo $countrx4."==>".$sumrx4;
$avg4=$sumrx4/$countrx4;
$avgrx4=number_format($avg4,2);
?>    
  <tr>
    <td>5</td>
    <td>สั่งจ่ายยา นัดเดือนธันวาคม 2562</td>
    <td align="center"><?=$countrx4;?></td>
    <td align="right"><?=number_format($sumrx4,2);?></td>
    <td align="right"><?=$avgrx4;?></td>
  </tr>
<?
$sql5="SELECT *
FROM `appoint` AS a
INNER JOIN opcard AS b ON a.hn = b.hn
WHERE a.`date`
LIKE '2562-09%' AND (
a.`doctor`
LIKE '%$doctorcode%' OR a.`doctor`
LIKE '$mdcode%'
) AND a.`doctor` NOT
REGEXP '^HD' AND b.ptright
LIKE 'R07%' AND (
a.appdate
LIKE '%มกราคม 2563' AND a.apptime NOT
LIKE '%ยกเลิก%'
)";
$query5=mysql_query($sql5);
$num5=mysql_num_rows($query5);
$sumrx5=0;
$countrx5=0;
while($rows5=mysql_fetch_array($query5)){
$date=substr($rows5["date"],0,10);
$sqlrx5="select sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date`LIKE '$date%' and a.hn='".$rows5["hn"]."' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo "--->".$sqlrx5."<br>";
$queryrx5=mysql_query($sqlrx5);
$numrx5=mysql_num_rows($queryrx5);
	if($numrx5 > 0){
		$countrx5++;
		$rowsrx5=mysql_fetch_array($queryrx5);
		$sumrx5=$sumrx5+$rowsrx5["sumprice"];	
	}
}
//echo $countrx5."==>".$sumrx5;
$avg5=$sumrx5/$countrx5;
$avgrx5=number_format($avg5,2);
?>    
  <tr>
    <td>6</td>
    <td>สั่งจ่ายยา นัดเดือนมกราคม 2563</td>
    <td align="center"><?=$countrx5;?></td>
    <td align="right"><?=number_format($sumrx5,2);?></td>
    <td align="right"><?=$avgrx5;?></td>
  </tr>
<?
$sql6="SELECT *
FROM `appoint` AS a
INNER JOIN opcard AS b ON a.hn = b.hn
WHERE a.`date`
LIKE '2562-09%' AND (
a.`doctor`
LIKE '%$doctorcode%' OR a.`doctor`
LIKE '$mdcode%'
) AND a.`doctor` NOT
REGEXP '^HD' AND b.ptright
LIKE 'R07%' AND (
a.appdate
LIKE '%กุมภาพันธ์ 2563' AND a.apptime NOT
LIKE '%ยกเลิก%'
)";
$query6=mysql_query($sql6);
$num6=mysql_num_rows($query6);
$sumrx6=0;
$countrx6=0;
while($rows6=mysql_fetch_array($query6)){
$date=substr($rows6["date"],0,10);
$sqlrx6="select sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date`LIKE '$date%' and a.hn='".$rows6["hn"]."' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo "--->".$sqlrx6."<br>";
$queryrx6=mysql_query($sqlrx6);
$numrx6=mysql_num_rows($queryrx6);
	if($numrx6 > 0){
		$countrx6++;
		$rowsrx6=mysql_fetch_array($queryrx6);
		$sumrx6=$sumrx6+$rowsrx6["sumprice"];	
	}
}
//echo $countrx6."==>".$sumrx6;
$avg6=$sumrx6/$countrx6;
$avgrx6=number_format($avg6,2);
?>    
  <tr>
    <td>7</td>
    <td>สั่งจ่ายยา นัดเดือนกุมภาพันธ์ 2563</td>
    <td align="center"><?=$countrx6;?></td>
    <td align="right"><?=number_format($sumrx6,2);?></td>
    <td align="right"><?=$avgrx6;?></td>
  </tr>
<?
$sql7="SELECT *
FROM `appoint` AS a
INNER JOIN opcard AS b ON a.hn = b.hn
WHERE a.`date`
LIKE '2562-09%' AND (
a.`doctor`
LIKE '%$doctorcode%' OR a.`doctor`
LIKE '$mdcode%'
) AND a.`doctor` NOT
REGEXP '^HD' AND b.ptright
LIKE 'R07%' AND (
a.appdate
LIKE '%มีนาคม 2563' AND a.apptime NOT
LIKE '%ยกเลิก%'
)";
$query7=mysql_query($sql7);
$num7=mysql_num_rows($query7);
$sumrx7=0;
$countrx7=0;
while($rows7=mysql_fetch_array($query7)){
$date=substr($rows7["date"],0,10);
$sqlrx7="select sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date`LIKE '$date%' and a.hn='".$rows7["hn"]."' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo "--->".$sqlrx7."<br>";
$queryrx7=mysql_query($sqlrx7);
$numrx7=mysql_num_rows($queryrx7);
	if($numrx7 > 0){
		$countrx7++;
		$rowsrx7=mysql_fetch_array($queryrx7);
		$sumrx7=$sumrx7+$rowsrx7["sumprice"];	
	}
}
//echo $countrx7."==>".$sumrx7;
$avg7=$sumrx7/$countrx7;
$avgrx7=number_format($avg7,2);
?>    
  <tr>
    <td>8</td>
    <td>สั่งจ่ายยา นัดเดือนมีนาคม 2563</td>
    <td align="center"><?=$countrx7;?></td>
    <td align="right"><?=number_format($sumrx7,2);?></td>
    <td align="right"><?=$avgrx7;?></td>
  </tr> 
<?
$sql8="SELECT *
FROM `appoint` AS a
INNER JOIN opcard AS b ON a.hn = b.hn
WHERE a.`date`
LIKE '2562-09%' AND (
a.`doctor`
LIKE '%$doctorcode%' OR a.`doctor`
LIKE '$mdcode%'
) AND a.`doctor` NOT
REGEXP '^HD' AND b.ptright
LIKE 'R07%' AND (
a.appdate
LIKE '%เมษายน 2563' AND a.apptime NOT
LIKE '%ยกเลิก%'
)";
$query8=mysql_query($sql8);
$num8=mysql_num_rows($query8);
$sumrx8=0;
$countrx8=0;
while($rows8=mysql_fetch_array($query8)){
$date=substr($rows8["date"],0,10);
$sqlrx8="select sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date`LIKE '$date%' and a.hn='".$rows8["hn"]."' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo "--->".$sqlrx8."<br>";
$queryrx8=mysql_query($sqlrx8);
$numrx8=mysql_num_rows($queryrx8);
	if($numrx8 > 0){
		$countrx8++;
		$rowsrx8=mysql_fetch_array($queryrx8);
		$sumrx8=$sumrx8+$rowsrx8["sumprice"];	
	}
}
//echo $countrx8."==>".$sumrx8;
$avg8=$sumrx8/$countrx8;
$avgrx8=number_format($avg8,2);
?>    
  <tr>
    <td>9</td>
    <td>สั่งจ่ายยา นัดเดือนเมษายน 2563</td>
    <td align="center"><?=$countrx8;?></td>
    <td align="right"><?=number_format($sumrx8,2);?></td>
    <td align="right"><?=$avgrx8;?></td>
  </tr>
<?
$sql9="SELECT *
FROM `appoint` AS a
INNER JOIN opcard AS b ON a.hn = b.hn
WHERE a.`date`
LIKE '2562-09%' AND (
a.`doctor`
LIKE '%$doctorcode%' OR a.`doctor`
LIKE '$mdcode%'
) AND a.`doctor` NOT
REGEXP '^HD' AND b.ptright
LIKE 'R07%' AND (
a.appdate
LIKE '%พฤษภาคม 2563' AND a.apptime NOT
LIKE '%ยกเลิก%'
)";
$query9=mysql_query($sql9);
$num9=mysql_num_rows($query9);
$sumrx9=0;
$countrx9=0;
while($rows9=mysql_fetch_array($query9)){
$date=substr($rows9["date"],0,10);
$sqlrx9="select sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date`LIKE '$date%' and a.hn='".$rows9["hn"]."' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo "--->".$sqlrx9."<br>";
$queryrx9=mysql_query($sqlrx9);
$numrx9=mysql_num_rows($queryrx9);
	if($numrx9 > 0){
		$countrx9++;
		$rowsrx9=mysql_fetch_array($queryrx9);
		$sumrx9=$sumrx9+$rowsrx9["sumprice"];	
	}
}
//echo $countrx9."==>".$sumrx9;
$avg9=$sumrx9/$countrx9;
$avgrx9=number_format($avg9,2);
?>    
  <tr>
    <td>10</td>
    <td>สั่งจ่ายยา นัดเดือนพฤษภาคม 2563</td>
    <td align="center"><?=$countrx9;?></td>
    <td align="right"><?=number_format($sumrx9,2);?></td>
    <td align="right"><?=$avgrx9;?></td>
  </tr>
<?
$sql10="SELECT *
FROM `appoint` AS a
INNER JOIN opcard AS b ON a.hn = b.hn
WHERE a.`date`
LIKE '2562-09%' AND (
a.`doctor`
LIKE '%$doctorcode%' OR a.`doctor`
LIKE '$mdcode%'
) AND a.`doctor` NOT
REGEXP '^HD' AND b.ptright
LIKE 'R07%' AND (
a.appdate
LIKE '%มิถุนายน 2563' AND a.apptime NOT
LIKE '%ยกเลิก%'
)";
$query10=mysql_query($sql10);
$num10=mysql_num_rows($query10);
$sumrx10=0;
$countrx10=0;
while($rows10=mysql_fetch_array($query10)){
$date=substr($rows10["date"],0,10);
$sqlrx10="select sum(b.price) as sumprice from phardep as a left join drugrx as b on b.idno = a.row_id where (a.ptright like 'R07%'  AND a.cashok =  'ประกันสังคม') and (b.part='DDL' OR b.part='DDY') and a.`date`LIKE '$date%' and a.hn='".$rows10["hn"]."' and (a.doctor like '%$doctorcode%'  OR `doctor` LIKE '$mdcode%') and a.doctor NOT REGEXP '^HD' and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') and b.amount >0 group by a.hn";
//echo "--->".$sqlrx10."<br>";
$queryrx10=mysql_query($sqlrx10);
$numrx10=mysql_num_rows($queryrx10);
	if($numrx10 > 0){
		$countrx10++;
		$rowsrx10=mysql_fetch_array($queryrx10);
		$sumrx10=$sumrx10+$rowsrx10["sumprice"];	
	}
}
//echo $countrx10."==>".$sumrx10;
$avg10=$sumrx10/$countrx10;
$avgrx10=number_format($avg10,2);
?>    
  <tr>
    <td>11</td>
    <td>สั่งจ่ายยา นัดเดือนมิถุนายน 2563</td>
    <td align="center"><?=$countrx10;?></td>
    <td align="right"><?=number_format($sumrx10,2);?></td>
    <td align="right"><?=$avgrx10;?></td>
  </tr>
  <tr>
    <td>12</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>13</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>          
</table>



