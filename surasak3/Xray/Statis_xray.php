<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<!--<h1 class="forntsarabun">สถิติแผนกรังสีกรรม</h1>-->
<div id="no_print" >
<? include('xray_menu.php'); ?><br />


<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">ช่วงเดือน</span></td>
    <td ><? $m=date('m'); ?>
      <select name="m_start" class="forntsarabun">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select>
      <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
    <input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">
      <a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
      </td>
  </tr>
</table>
</form>
</div>
<?php
if($_POST['submit']=="ค้นหา"){

include("../Connections/connect.inc.php"); 

$date1=$_POST['y_start'].'-'.$_POST['m_start'];

switch($_POST['m_start']){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
	
   $dateshow=$printmonth." ".$_POST['y_start'];

 print "<div align='center'><font class='forntsarabun' >สถิติแผนกรังสีกรรมเดือน  $dateshow </font></div><br>";
 
 
 
$sql1="CREATE TEMPORARY TABLE  xray1  Select * from  xray_stat  WHERE date  LIKE  '$date1%' ";
$query1 = mysql_query($sql1); 

$sql2="CREATE TEMPORARY TABLE  patdata1  SELECT * FROM patdata
WHERE DATE  LIKE  '$date1%' and  depart='XRAY' and status ='Y' and amount ='1' ";
$query2 = mysql_query($sql2); 

 /////////////////  XRAY ทั่วไป /////////////////////
  
$sql="SELECT count(DISTINCT DATE ,hn,an,ptname)as call1
FROM  patdata1
WHERE  code like '41%' and an =' ' ";
    $query = mysql_query($sql); 
	$dball1=mysql_fetch_array($query);


$sql1="SELECT Count(DISTINCT DATE ,hn,an,ptname)as call2 FROM  patdata1 WHERE  code
LIKE  '41%' AND an !='' ";
    $query1 = mysql_query($sql1); 
	$dball2=mysql_fetch_array($query1);
	
 /////////////////  BMD  /////////////////////
 
 $sqlbmd="SELECT Count(DISTINCT DATE ,hn,an,ptname) as bmd FROM  patdata1 WHERE  code
= '42703' AND an =' '  ";
    $querybmd = mysql_query($sqlbmd); 
	$dbbmd=mysql_fetch_array($querybmd);


$sqlbmd1="SELECT Count(DISTINCT DATE ,hn,an,ptname)as bmd1 FROM  patdata1 WHERE  code
= '42703' AND an !=' '  ";
    $querybmd1 = mysql_query($sqlbmd1); 
	$dbbmd1=mysql_fetch_array($querybmd1);


/////////////////  IVP  /////////////////////
 
 $sqlivp="SELECT Count(DISTINCT DATE ,hn,an,ptname)as ivp FROM  patdata1 WHERE  code
= '42601' AND an=' '  ";
    $queryivp = mysql_query($sqlivp); 
	$dbivp=mysql_fetch_array($queryivp);

$sqlivp1="SELECT Count(DISTINCT DATE ,hn,an,ptname)as ivp1 FROM  patdata1 WHERE  code
= '42601' AND an !=' ' ";
    $queryivp1 = mysql_query($sqlivp1); 
	$dbivp1=mysql_fetch_array($queryivp1);


/////////////////  Ultrasound  /////////////////////
 
 $sqlUl="SELECT Count(DISTINCT DATE ,hn,an,ptname) as Cul FROM  patdata1 WHERE code
LIKE  '43%' AND an =' ' ";
    $queryUl= mysql_query($sqlUl); 
	$dbUl=mysql_fetch_array($queryUl);
	

$sqlUl1="SELECT Count(DISTINCT DATE ,hn,an,ptname)as Cul1 FROM  patdata1 WHERE code
LIKE  '43%' AND an !=' ' ";
    $queryUl1= mysql_query($sqlUl1); 
	$dbUl1=mysql_fetch_array($queryUl1);

	
	/////////////////  ECHO  /////////////////////
 
 $sqlecho="SELECT Count(DISTINCT DATE ,hn,an,ptname)as echo FROM  patdata1 WHERE code
= '11251' AND an =' ' ";
    $queryecho= mysql_query($sqlecho); 
	$dbecho=mysql_fetch_array($queryecho);



$sqlecho1="SELECT Count(DISTINCT DATE ,hn,an,ptname)as echo1 FROM  patdata1 WHERE code
= '11251' AND an !=''  ";
     $queryecho1= mysql_query($sqlecho1); 
	$dbecho1=mysql_fetch_array($queryecho1);
   ?>
<br>
   <table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" class="forntsarabun" style="border-collapse:collapse" align="center">
   <tr bgcolor=#ffffcc>
	<td colspan='2' align="center">เอกซเรย์ทั่วไป</td>
	<td colspan='2' align="center">BMD</td>
	<td colspan='2' align="center">IVP</td>
	<td colspan='2' align="center">Ultrasund</td>
	<td colspan='2' align="center">Echo</td>
	<td rowspan='2' align="center">รวม</td>
   </tr>
   <tr>
	<td align="center">นอก</td>
	<td align="center">ใน</td>
	<td align="center">นอก</td>
	<td align="center">ใน</td>
	<td align="center">นอก</td>
	<td align="center">ใน</td>
	<td align="center">นอก</td>
	<td align="center">ใน</td>
	<td align="center">นอก</td>
	<td align="center">ใน</td>
   </tr>
<tr>
	<td><?=$dball1['call1'];?></td>
	<td><?=$dball2['call2'];?></td>
	<td><?=$dbbmd['bmd'];?></td>
	<td><?=$dbbmd1['bmd1'];?></td>
	<td><?=$dbivp['ivp'];?></td>
	<td><?=$dbivp1['ivp1'];?></td>
	<td><?=$dbUl['Cul'];?></td>
	<td><?=$dbUl1['Cul1'];?></td>
	<td><?=$dbecho['echo'];?></td>
	<td><?=$dbecho1['echo1'];?></td>
	<td><?=$dball1['call1']+$dball2['call2']+$dbbmd['bmd']+$dbbmd1['bmd1']+$dbivp['ivp']+$dbivp1['ivp1']+$dbUl['Cul']+$dbUl1['Cul1']+$dbecho['echo']+$dbecho1['echo1'];?></td>
   </tr>
   </table>
<br>
<?

/*$i=1;
while($i<=31){*/
	
$morning1=$date1."-$i 08:00:00";
$morning2=$date1."-$i 16:00:00";

$after1=$date1."-$i 16:00:01";
$after2=$date1."-$i 23:59:59";

$evening1=$date1."-$i 00:00:00";
$evening2=$date1."-$i 07:59:59";

//detail not like '%CT%' and 
$query="SELECT sum(digital)as digital  FROM  xray1  WHERE  detail not like '%CT%' AND ( date_format( `date` , '%H:%i:%s' )  BETWEEN '08:00:00' AND '16:00:00' ) ";
$result = mysql_query($query); 
$row=mysql_num_rows($result);
$dbarr=mysql_fetch_array($result);
$morning=$dbarr['digital'];

$sum+=$morning;

//detail not like '%CT%' and
$query1="SELECT  sum(digital)as digital1  FROM  xray1  WHERE  detail not like '%CT%' AND ( date_format( `date` , '%H:%i:%s' )  BETWEEN '16:00:01' AND '23:59:59' )";
$result1 = mysql_query($query1); 
$row1=mysql_num_rows($result1);
$dbarr1=mysql_fetch_array($result1);
$after=$dbarr1['digital1'];
$sum1+=$after;

//detail not like '%CT%' and

$query2="SELECT  sum(digital)as digital2  FROM  xray1  WHERE   detail not like '%CT%'  AND ( date_format( `date` , '%H:%i:%s' )  BETWEEN '00:00:00' AND '07:59:59' )";
$result2 = mysql_query($query2); 
$row2=mysql_num_rows($result2);
$dbarr2=mysql_fetch_array($result2);
$evening=$dbarr2['digital2'];
$sum2+=$evening;

$total=$sum+$sum1+$sum2;

//echo $query2."<br/>";

/*$i++;
}*/


/*for($i=1;$i<=31;$i++){*/
	
$morning1=$date1."-$i 08:00:00";
$morning2=$date1."-$i 16:00:00";

$after1=$date1."-$i 16:00:01";
$after2=$date1."-$i 23:59:59";

$evening1=$date1."-$i 00:00:00";
$evening2=$date1."-$i 07:59:59";

//detail not like '%CT%' and
	
$filmbkk1="SELECT sum(filmbk) as filmbkk1  FROM   xray_stat  WHERE   date BETWEEN  '$morning1' AND  '$morning2' ";
$result = mysql_query($filmbkk1); 
$dbarr=mysql_fetch_array($result);
$morning=$dbarr['filmbkk1'];
$sumf1+=$morning;

//echo $filmbkk1."</br>";

$filmbkk2="SELECT  sum(filmbk) as filmbkk2  FROM  xray_stat  WHERE    date BETWEEN '$after1' AND  '$after2' ";
$result1 = mysql_query($filmbkk2); 
$dbarr1=mysql_fetch_array($result1);
$after=$dbarr1['filmbkk2'];
$sumf2+=$after;

$filmbkk3="SELECT  sum(filmbk) as filmbkk3  FROM  xray_stat  WHERE  date BETWEEN  '$evening1' AND  '$evening2' ";
$result2 = mysql_query($filmbkk3); 
$dbarr2=mysql_fetch_array($result2);
$evening=$dbarr2['filmbkk3'];
$sumf3+=$evening;

$totalf1=$sumf1+$sumf2+$sumf3;

//}
?>

   <table border="1" align="center" cellpadding="3" cellspacing="0"  bordercolor="#000000" class="forntsarabun" style="border-collapse:collapse">
   <tr bgcolor=#ffffcc>
	<td align="center">เวร</td>
	<td colspan='2' align="center">digital</td>
	</tr>
   <tr>
	<td align="center">&nbsp;</td>
	<td align="center">จำนวนใช้</td>
	<td align="center">จำนวนเสีย</td>
	</tr>
<tr>
	<td>เช้า</td>
	<td><?=$sum;?></td>
	<td><?=$sumf1;?></td>
	</tr>
<tr>
	<td>บ่าย</td>
	<td><?=$sum1;?></td>
	<td><?=$sumf2;?></td>
	</tr>
<tr>
	<td>ดึก</td>
	<td><?=$sum2;?></td>
	<td><?=$sumf3;?></td>
	</tr>
<tr>
	<td>รวม</td>
	<td><?=$total;?></td>
	<td><?=$totalf1;?></td>
	</tr>
   </table><br />
<?
$yth=date("Y")+543;
$yth=substr($yth,2,2);
?>
<div align="right"><table width="40%" border="0" class="forntsarabun">
  <tr>
    <td height="45" colspan="3">ตรวจถูกต้อง พ.ต.</td>
    </tr>
  <tr>
    <td width="167">&nbsp;</td>
    <td colspan="2">ปิยบุตร บุญมี</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="73">&nbsp;</td>
    <td width="252"><?=$yth;?></td>
  </tr>
</table>
</div>
<? } ?>