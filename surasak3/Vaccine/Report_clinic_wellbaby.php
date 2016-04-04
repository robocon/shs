<? 
session_start();
?>
<html><!-- InstanceBegin template="/Templates/all_menu.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <!-- InstanceBeginEditable name="doctitle" -->
    <title>สมุดทะเบียนการรับบริการวัคซีนเด็ก</title>
    <!-- InstanceEndEditable -->
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script> 
    <!-- InstanceBeginEditable name="head" -->
    <!-- InstanceEndEditable -->
</head>
<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:20pt;
}
.table_font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
	font-weight:bold;
	color:#600;	
}
.table_font2{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
legend{
	
font-family:"TH SarabunPSK";
font-size: 18pt;
font-weight: bold;
color:#600;	
padding:0px 3px;

}
fieldset{

display:inline;
background-color:#FEFDDE;
/*width:300px;*/
border-color:#000;


}
</style>

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
<body>


<div id="no_print">
<div id="menu">
  <ul class="menu">
        <li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าหลัก</span></a></li>
        <li><a href="service.php"><span>สมุดทะเบียนวัคซีนเด็ก</span></a></li>
        <li><a href="clinic_well_baby.php"><span>คลินิก Well baby</span></a></li>
     	<li><a href="#"><span>รายงานการรับบริการวัคซีนเด็ก</span></a></li>
  	<ul>
	  	<li><a href="Report_m.php"><span>รายงานการรับบริการประจำเดือน</span></a></li>
        <li><a href="Report_vac.php"><span>รายงานการรับบริการตามวัคซีน</span></a></li>
        <li><a href="Report_all.php"><span>รายงานการรับบริการทั้งหมด</span></a></li>
        
    </ul>
    <li><a href="Report_clinic_wellbaby.php"><span>รายงาน คลินิก Well baby</span></a></li>
    <li><a href="show_edit.php"><span>แก้ไขข้อมูลวัคซีน</span></a></li>
     <li><a href="add_vac.php"><span>จัดการข้อมูลวัคซีน</span></a></li>
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
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<?
include("Connections/connect.inc.php"); 
include("Connections/all_function.php"); 

$showdate=date("Y-m");

$d=date('Y-m-d');
$dateN=explode("-",$d);

$mm=$dateN[0].'-'.$dateN[1];
?>

<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date1'));
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date2'));

};
</script>

<!--<p style='page-break-before: always'></p>-->

<div align="center" class="forntsarabun">
<div id="no_print">
<FORM METHOD="POST" ACTION="" name="FrmR" enctype="multipart/form-data" >
	<span class="style14">ตั้งแต่วันที่ : <!--&nbsp;&nbsp;
	 <input name="date1" type="text" class="forntsarabun" id="date1" size="10" />
&nbsp;&nbsp;&nbsp;&nbsp;ถึงวันที่ :   &nbsp;&nbsp;
	 <input name="date2" type="text" class="forntsarabun" id="date2" size="10" />
	</span>	&nbsp;&nbsp;&nbsp;&nbsp;--><select name='d_start' class="font1">
        <option value="" selected="selected">--ไม่เลือก---</option>
        <? 
				//$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					//if($dd==$d){
					?>
        <option value="<?=$d;?>"> <?=$d;?></option>
        <?
				//	}else{
				?>
    <!--    <option value="<?//=$d;?>"> <?//=$d;?> </option>-->
        <?
				//}
				}
				
				?>
      </select>
        <? $m=date('m'); ?>
        <select name="m_start" class="font1">
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
				echo "<select name='y_start' class='font1'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
          <?=$i;?>
        </option>
        <?
				}
				echo "</select>";
				?>
	<input  name="SubReoprt" type="submit" class="forntsarabun" value="View Report" />
	<input type="button" name="button"  class="forntsarabun" value="พิมพ์ใบรายงาน"  onClick="JavaScript:window.print();">
   <input type=button value='กลับเมนู'  class="forntsarabun" onClick="window.location='service.php'">&nbsp;
 <input type=button value='กลับหน้าแรก'  class="forntsarabun" onClick="window.location='../../nindex.htm'">
</FORM>
</div>
</div>
<?
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


$today=($_POST['y_start']-543).'-'.$_POST['m_start'].'-'.$_POST['d_start'];


if($_POST['d_start']!=""){
	$day="ประจำวันที่";
	$dateshow=$_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];
}else{
	$day="ประจำเดือน";
	
	$dateshow=$printmonth." ".$_POST['y_start'];
}

			  
if($_POST['SubReoprt']){
	
$sql="SELECT  `opcard`.`yot`,`opcard`.`name`,`opcard`.`surname`,`opcard`.`dbirth`,`well_baby`.`hn`,`well_baby`.`row_id`,`well_baby`.`weight` ,`well_baby`.`develop_age` ,`well_baby`.`growth`,`well_baby`.`breastmilk` FROM
  `opcard`  INNER JOIN
  `well_baby` ON `well_baby`.`hn` = `opcard`.`hn`  WHERE  `well_baby`.`thidate`  like  '$today%'  order by `well_baby`.`row_id` asc ";
  
}else{

$sql="SELECT  `opcard`.`yot`,`opcard`.`name`,`opcard`.`surname`,`opcard`.`dbirth`,`well_baby`.`hn`,`well_baby`.`row_id`,`well_baby`.`weight` ,`well_baby`.`develop_age` ,`well_baby`.`growth`,`well_baby`.`breastmilk`  FROM `opcard` INNER JOIN
  `well_baby` ON `well_baby`.`hn` = `opcard`.`hn` order by `well_baby`.`row_id` asc";
  
}


$result = mysql_query($sql)or die (mysql_error());
  
$rows=mysql_num_rows($result);


$n=1;
?>
<br>
<br>
<h3 align="center" class="forntsarabun">แบบฟอร์มการบันทึกข้อมูลภาวะสุขภาพเด็กอายุ 0-5 ปี คลินิก Well baby</h3>
<h3 align="center" class="forntsarabun"><span class="forntsarabun">ห้องตรวจโรคผู้ป่วยนอก โรงพยาบาลค่ายสุรศักดิ์มนตรี</span></h3>
<h3 align="center" class="forntsarabun"><span class="forntsarabun"><?=$day;?>  <?=$dateshow;?></span></h3>
<br /><table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse"   bordercolor="#000000">
 <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse"   bordercolor="#000000">
    <tr class="forntsarabun">
      <td  align="center" >ลำดับ</td>
      <td align="center">ชื่อ - สกุล</td>
      <td align="center">HN</td>
      <td align="center">อายุ</td>
      <td  align="center" >น้ำหนัก<br>
        (ก.ก)</td>
      <td align="center">พัฒนาการสมวัย<br>
      ด้านร่างกายและอารมณ์</td>
      <td align="center">การเจริญเติบโตตามมาตรฐานอายุและน้ำหนัก</td>
      <td align="center">นมแม่ในเด็ก 0-6 เดือน</td>
      <div id="no_print">
       <td align="center" id="no_print">แก้ไข</td>
       <td align="center" id="no_print">ลบ</td>
      </div>
      </tr>
  
<?
$r=0;
if($rows){

while($row= mysql_fetch_array($result)){
	  $r++;
	  

$y=$y+543;
/*switch($m){
		case "01": $printmonth = "ม.ค."; break;
		case "02": $printmonth = "ก.พ."; break;
		case "03": $printmonth = "มี.ค."; break;
		case "04": $printmonth = "เม.ย."; break;
		case "05": $printmonth = "พ.ค."; break;
		case "06": $printmonth = "มิ.ย."; break;
		case "07": $printmonth = "ก.ค."; break;
		case "08": $printmonth = "ส.ค."; break;
		case "09": $printmonth = "ก.ย."; break;
		case "10": $printmonth = "ต.ค."; break;
		case "11": $printmonth = "พ.ย."; break;
		case "12": $printmonth = "ธ.ค."; break;
	}
	
   $dateshow=$d." ".$printmonth." ".$y;*/
   
   
   if($row['growth']=="N"){
	   $growth="ตามเกณฑ์"; 
   }else  if($row['growth']=="L"){
	   $growth="ต่ำกว่าเกณฑ์"; 
   }else  if($row['growth']=="M"){
	   $growth="เกินกว่าเกณฑ์"; 
   }
	  

	  if($r=='21'){
		 $r=1;
		echo "</table>";
		echo "<div style='page-break-after: always'> ";
		echo "<div style='page-break-before: always'> ";
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse"   bordercolor="#000000">
    <tr class="forntsarabun">
      <td  align="center" >ลำดับ</td>
      <td  align="center" >ชื่อ - สกุล</td>
       <td align="center">HN</td>
      <td  align="center" >อายุ</td>
      <td  align="center" >น้ำหนัก<br>
        (ก.ก)</td>
      <td align="center">พัฒนาการสมวัย<br>
      ด้านร่างกายและอารมณ์</td>
      <td  align="center" >การเจริญเติบโตตามมาตรฐานอายุและน้ำหนัก</td>
      <td  align="center" >นมแม่ในเด็ก 2-6 เดือน</td>
      <td align="center" id="no_print">แก้ไข</td>
      </tr>

<? } ?>
 <tr class="forntsarabun">
      <td align="center"><?=$n++; ?></td>
      <td><?=$row['yot'].$row['name'].' '.$row['surname'];?></td>
      <td><?=$row['hn'];?></td>
      <td><?=calcage($row['dbirth']);?></td>
      <td align="center"><?=$row['weight']?></td>
      <td><?=$row['develop_age']?></td>
      <td><?= $growth;?></td>
      <td><?=$row['breastmilk'];?></td>
       
      <td align="center" id="no_print"><a href="javascript:MM_openBrWindow('clinic_well_baby_edit.php?row_id=<?=$row['row_id'];?>','','width=600,height=600')">แก้ไข</a></td>
      <td align="center"><a href="JavaScript:if(confirm('ยืนยันการลบข้อมูล?')==true){window.location='clinic_wellbaby_del.php?row_id=<?=$row["row_id"];?>';}">ลบ</a></td>
      </tr>
 <?  
}
} else {
	echo "<tr>";
 	echo "<td colspan='10' align=center class='forntsarabun'><font color=red>ยังไม่มีรายการ</font></td>";
	echo "</tr>";
}
echo "</div>";
echo "</div>";
?>

</table>
</table>

<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>