<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<body>

<style type="text/css">
* { margin:0;
    padding:0;
}
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright {
    font:11px 'Trebuchet MS';
    color:#fff;
    text-indent:30px;
    padding:40px 0 0 0;
}
td,th {
	font-family:"TH SarabunPSK";
	font-size: 20 px;
}
.fontsara {
	font-family:"TH SarabunPSK";
	font-size: 18 px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 

/*div#copyright a { color:#00bfff; }
div#copyright a:hover { color:#fff; }*/
</style>
<div id="no_print">
<div id="menu">
<ul class="menu">
  <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าแรก</span></a></li>
  <li><a href="gward_report_doctor.php" class="parent"><span>รายงานผู้ป่วยในตามแพทย์</span></a></li>
  <li><a href="report_wardlog.php" class="parent"><span>รายงานการเปลี่ยนข้อมูลผู้ป่วย</span></a></li>

  <li>
    <a href="#"><span>สถิติหอผู้ป่วยประจำเดือน</span></a>
    <ul>
      <li class="last"><a href="report_fward.php"><span>หอผู้ป่วยรวม</span></a></li>
      <li class="last"><a href="report_gward.php"><span>หอผู้ป่วยสูติ</span></a></li>
      <li class="last"><a href="report_icuward.php"><span>หอผู้ป่วยหนัก</span></a></li>
      <li class="last"><a href="report_vipward.php"><span>หอผู้ป่วยพิเศษ</span></a></li>
    </ul>
  </li>
     
  <li>
    <a href="#"><span>Diagnosis ประจำปี</span></a>
    <ul>
      <li class="last"><a href="report_icd10_ofyear.php?code=42"><span>หอผู้ป่วยรวม</span></a></li>
      <li class="last"><a href="report_icd10_ofyear.php?code=43"><span>หอผู้ป่วยสูติ</span></a></li>
      <li class="last"><a href="report_icd10_ofyear.php?code=44"><span>หอผู้ป่วยหนัก</span></a></li>
      <li class="last"><a href="report_icd10_ofyear.php?code=45"><span>หอผู้ป่วยพิเศษ</span></a></li>
    </ul>
  </li>

  <li>
    <a href="#"><span>Diagnosis Top5 ประจำปี</span></a>
    <ul>
      <li class="last"><a href="report_icd10_top5.php?code=42"><span>หอผู้ป่วยรวม</span></a></li>
      <li class="last"><a href="report_icd10_top5.php?code=43"><span>หอผู้ป่วยสูติ</span></a></li>
      <li class="last"><a href="report_icd10_top5.php?code=44"><span>หอผู้ป่วยหนัก</span></a></li>
      <li class="last"><a href="report_icd10_top5.php?code=45"><span>หอผู้ป่วยพิเศษ</span></a></li>
    </ul>
  </li>
     
  <li>
    <a href="#"><span>รายงานผู้ป่วยเสียชีวิต</span></a>
    <ul>
      <li class="last"><a href="report_dead.php?code=42"><span>หอผู้ป่วยรวม</span></a></li>
      <li class="last"><a href="report_dead.php?code=43"><span>หอผู้ป่วยสูติ</span></a></li>
      <li class="last"><a href="report_dead.php?code=44"><span>หอผู้ป่วยหนัก</span></a></li>
      <li class="last"><a href="report_dead.php?code=45"><span>หอผู้ป่วยพิเศษ</span></a></li>
    </ul>
  </li>
  <li><a href="report_age15.php" class="parent"><span>รายชื่อเด็กอายุต่ำกว่า 15ปี</span></a></li>
  </ul>
</div>

<div style="visibility: hidden">
 <br />
 <a href="http://apycom.com/">a</a><br />
</div>

</div>


<div><!-- InstanceBeginEditable name="detail" -->
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.fornbody {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<div id="no_print">
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">รายงานสถิติ หอผู้ป่วย</td>
    </tr>
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">เดือน/ปี</span></td>
    <td >
	<? $m=date('m'); ?>
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
        </select><? 
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
      <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">--></td>
  </tr>
</table>
</form>
<HR>
</div>
<?php
if($_POST['submit']){
	
?>
<script>
window.print() ;
</script>
<?	
	
include("../connect.inc"); 
$month=$_POST['m_start'];

$year1=$_POST['y_start'];
$year2=$_POST['y_start']-543;

$date1=$year1.'-'.$month;

$date2=$year2.'-'.$month.'-01';
$daysleep=0;

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

/////  ward สูติ //










$w='43';

$tsql1="CREATE TEMPORARY TABLE   fward  Select * from   ipcard  WHERE bedcode  like '$w%' AND (dcdate = '0000-00-00 00:00:00' OR dcdate
LIKE '$date1%') ";
$tquery1 = mysql_query($tsql1);

$tsql2="CREATE TEMPORARY TABLE   fward2  Select * from   ipcard  WHERE bedcode  like '$w%' ";
$tquery2 = mysql_query($tsql2);
	
	$sql1="SELECT  substring(date,1,7)as  subdate FROM  fward  order by date ASC limit 1 ";
	$query1 = mysql_query($sql1);
	$arr1=mysql_fetch_array($query1);
	
	
	$lastmonth =date('Y-m-d', strtotime("-1 month",strtotime($date2)));

	$sublastmounth=substr($lastmonth,0,7);
	
	$mounth1=explode("-",$sublastmounth);
	
	$datemounth=($mounth1[0]+543).'-'.$mounth1[1];
	
	$sql2="SELECT * FROM fward  WHERE  date between  '$arr1[subdate]' and '$datemounth' ";
	$query2 = mysql_query($sql2);
	
	$row2=mysql_num_rows($query2);
	
	$sql3="SELECT * FROM fward2  WHERE  date like '$date1%' ";
	$query3 = mysql_query($sql3);
	$row3=mysql_num_rows($query3);
	
	
	$total1=$row2+$row3;
	$calday = cal_days_in_month(CAL_GREGORIAN , $month, $year1);
	
	
	$sql4="SELECT * FROM fward  WHERE  date like '$date1%' and dctype like '%transfer%' ";
	$query4 = mysql_query($sql4);
	$row4=mysql_num_rows($query4);
	
	$sql5="SELECT * FROM fward  WHERE  dcdate != '0000-00-00 00:00:00'  ";
	$query5 = mysql_query($sql5);
	$row5=mysql_num_rows($query5);

/*	$sql4="SELECT * FROM fward  WHERE dcdate like '$date1%' and date between  '$arr1[subdate]' and '$datemounth'";
	$query4 = mysql_query($sql4);
	echo $sql;
	while($row4=mysql_fetch_array($query4)){
		
		
		$daysleep1+=substr($row4['dcdate'],8,2);
		
	
	}*/

/*	$sql5="SELECT * FROM fward  WHERE dcdate not like '$date1%' and date between  '$arr1[subdate]' and '$datemounth'";
	$query5 = mysql_query($sql5);
	while($row5=mysql_fetch_array($query5)){
		$daysleep+=$calday;
	}
	
	$sql4="SELECT * FROM fward2  WHERE  date like '$date1%' and dcdate like '$date1%' ";
	$query4 = mysql_query($sql4);
	while($row4=mysql_fetch_array($query4)){
		$daysleep2+=substr($row4['dcdate'],8,2); 
	}
	
	$sql5="SELECT * FROM fward2  WHERE  date like '$date1%' and dcdate not like '$date1%' ";
	$query5 = mysql_query($sql5);
	while($row5=mysql_fetch_array($query5)){
	$daysleep2+=$calday;
	}
*/
	?>
<table width="100%" border="0" class="forntsarabun">
  <tr>
    <td align="center">แบบรายงานสถิติ หอผู้ป่วยสูติ ประจำเดือน  <?=$dateshow;?></td>
  </tr>
  <tr>
    <td align="center">โรงพยาบาลค่ายสุรศักดิ์มนตรี จ.ลำปาง</td>
  </tr>
</table>

<table width="100%" border="0" class="fornbody">
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">1.จำนวนผู้ป่วยในทั้งหมด..........<?=$total1;?>........คน</td>
  </tr>
  <tr>
    <td colspan="6">1.1 ผู้ป่วยในที่ค้างจากเดือนก่อน ..........<?=$row2;?>........คน</td>
  </tr>
  <tr>
    <td colspan="6">1.2 รับใหม่ในเดือนนี้..........<?=$row3;?>........คน</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">2. จำนวนวันนอนโรงพยาบาล...........................................วัน</td>
  </tr>
  <tr>
    <td colspan="6">2.1 จำนวนวันนอน ร.พ. ของผู้ป่วยในที่ค้างจากเดือนก่อน............<!--<?//=$daysleep1;?>-->...................................วัน.</td>
  </tr>
  <tr>
    <td colspan="6">2.2 จำนวนวันนอน ร.พ. ของผู้ป่วยในที่รับใหม่ในเดือนนี้............<!--<?//=$daysleep2;?>-->...........................................วัน</td>
  </tr>
  <tr>
    <td colspan="6">(วันนอน ร.พ. ในวันที่จำหน่ายลบด้วยวันที่รับ เช่น รับวันที่ 8 จำหน่ายวันที่ 12 จำนวนวันนอน ร.พ. คือ 4 โดยไม่ต้องคำนึงถึงเวลาที่รับหรือจำหน่าย การนับวันแต่ละวัน ถ้าเลยเที่ยงคืน ถือว่าเป็นวันใหม่)</td>
  </tr>
  <tr>
    <td colspan="6">3. อัตราครองเตียง................................................... %</td>
  </tr>
  <tr>
    <td colspan="6">4.จำนวนเตียงของหอผู้ป่วย...........................................เตียง</td>
  </tr>
  <tr>
    <td colspan="6">5.จำนวนผู้ป่วย Refer ......................<?=$row4;?>........................ราย</td>
  </tr>
  <tr>
    <td colspan="6">6.จำนวนผู้ป่วยจำหน่าย  .................<?=$row5;?>.......................ราย</td>
  </tr>
  <tr>
    <td colspan="6">7. ผู้ป่วยที่เสียชีวิตภายในเดือนนี้ ( ไม่รวมมารดาที่เสียชีวิตจากการคลอด , ทารกแรกเกิดที่เสียชีวิตภานใน 7 วันวันแรก , ผู้ป่วยที่เสียชีวิตระหว่างการผ่าตัด )</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <? 	$sql6="SELECT * FROM fward  WHERE  dctype like '%Dead%'";
		$query6 = mysql_query($sql6);
$no=1;
	while($row6=mysql_fetch_array($query6)){
		
		
		
 ?>
  <tr>
    <td align="center"> 7.<?=$no;?>  &nbsp;ชื่อ-สกุล</td>
    <td><?=$row6['ptname'];?></td>
    <td align="center">HN</td>
    <td><?=$row6['hn'];?></td>
    <td align="center">AN</td>
    <td><?=$row6['an'];?></td>
  </tr>
  <? 
  $no++;
  } ?>
</table>

<? } ?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>