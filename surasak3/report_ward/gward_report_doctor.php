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
	font-size: 22px;
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
.forntsarabun1 {	font-family:"Angsana New";
	font-size: 18px;
}
-->
</style>
<div id="no_print" >

<a name="head" id="head"></a>
<form name="f1" action="" method="post">
  <table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
  <tr class="forntsarabun">
    <td colspan="2" bgcolor="#99CC99">รายงานผู้ป่วยในตามแพทย์</td>
  </tr>
  <tr class="forntsarabun">
    <td  align="right">ช่วงเวลา</td>
    <td >
	<select name='d_start' class="forntsarabun">
	<? 
				$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					?>
      
        <option value="<?=$d;?>"> <?=$d;?></option>
        <?	
				}
		?>
               </select> 
                
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
      </select>
      <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
				?>
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
        <?=$i;?>
        </option>
      <?
				}
				echo "<select>";
				?>
      ถึง
      <select name='d_end' class="forntsarabun">
      <? 
				$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					?>
      
        <option value="<?=$d;?>">
          <?=$d;?>
          </option>
        <?	
				}
				?>
                </select>
        <? $m2=date('m'); ?>
        <select name="m_end" class="forntsarabun">
        <option value="01" <? if($m2=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m2=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m2=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m2=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m2=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m2=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m2=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m2=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m2=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m2=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m2=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m2=='12'){ echo "selected"; }?>>ธันวาคม</option>
      </select>
      <? 
			   $Y2=date("Y")+543;
			   $date2=date("Y")+543+5;
			  
				$dates2=range(2547,$date2);
				echo "<select name='y_end' class='forntsarabun'>";
				foreach($dates2 as $i2){
				?>
      <option value='<?=$i2?>' <? if($Y2==$i2){ echo "selected"; }?>>
        <?=$i2;?>
        </option>
      <?
				}
				echo "<select>";
				?></td>
  </tr>
  <tr class="forntsarabun">
    <td  align="right">แพทย์</td>
    <td ><select name="doctor" id="doctor">
      <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		include("../connect.inc"); 
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
      </select>&nbsp;</td>
  </tr>
  <tr class="forntsarabun">
    <td  align="right">Ward</td>
    <td >
      <select name="ward" id="ward">
      <option value="42">หอผู้ป่วยรวม</option>
      <option value="43">หอผู้ป่วยสูติ</option>
      <option value="44">หอผู้ป่วยICU</option>
      <option value="45">หอผู้ป่วยพิเศษ</option>
      </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
    <!--<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">-->
      <a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
      </td>
  </tr>
  <tr>
    <td colspan="2" align="center">&nbsp;</td>
  </tr>
  </table>
</form>

</div>

<?php

if($_POST['submit']){

include("../connect.inc.php"); 

$date1=$_POST['y_start'].'-'.$_POST['m_start'];

$start_date=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'].' 00:00:00';
$end_date=$_POST['y_end'].'-'.$_POST['m_end'].'-'.$_POST['d_end'].' 23:59:59';

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
	switch($_POST['m_end']){
		case "01": $printmonth2 = "มกราคม"; break;
		case "02": $printmonth2 = "กุมภาพันธ์"; break;
		case "03": $printmonth2 = "มีนาคม"; break;
		case "04": $printmonth2 = "เมษายน"; break;
		case "05": $printmonth2 = "พฤษภาคม"; break;
		case "06": $printmonth2 = "มิถุนายน"; break;
		case "07": $printmonth2 = "กรกฏาคม"; break;
		case "08": $printmonth2 = "สิงหาคม"; break;
		case "09": $printmonth2 = "กันยายน"; break;
		case "10": $printmonth2 = "ตุลาคม"; break;
		case "11": $printmonth2 = "พฤศจิกายน"; break;
		case "12": $printmonth2 = "ธันวาคม"; break;
	}
	  $dateshow=$_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];
	  $dateshow2=$_POST['d_end'].' '.$printmonth2." ".$_POST['y_end'];

  function DateDiff($strDate1,$strDate2)
	 {
	return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
	 }
 
 
$sql1="CREATE TEMPORARY TABLE  bed1  Select * from  ipcard  WHERE date
BETWEEN  '$start_date' AND '$end_date'  AND doctor like '".substr($_POST['doctor'],0,5)."%'  AND bedcode  LIKE  '".$_POST['ward']."%' ";
$query1 = mysql_query($sql1);

$sql="SELECT * FROM bed1";
$objq=mysql_query($sql);
$row=mysql_num_rows($objq);


if($row){
	
	 print "<div><font class='forntsarabun' >รายงานผู้ป่วยในตามแพทย์  ระหว่าง  $dateshow  ถึง $dateshow2 </font></div><br>";
 ?>
<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun">
  <tr bgcolor="#0099FF">
    <td align="center">ลำดับ</td>
    <td align="center">HN</td>
    <td align="center">AN</td>
    <td align="center" bgcolor="#0099FF">ชื่อ-สกุล</td>
    <td align="center">สิทธิ</td>
    <td align="center">Diag</td>
    <td align="center">แพทย์</td>
    <td align="center">รับป่วย</td>
    <td align="center">จำน่าย</td>
    <td align="center">วันนอน</td>
  </tr>
  <?
  $i=0;
  while($array=mysql_fetch_array($objq)){
	  
	
	  
	  $y1=substr($array['date'],0,4)-543;
	  $m1=substr($array['date'],5,2);
	  $d1=substr($array['date'],8,2);
	  $datediff1=$y1.'-'.$m1.'-'.$d1;
	  
	  
	  $y2=substr($array['dcdate'],0,4)-543;
	  $m2=substr($array['dcdate'],5,2);
	  $d2=substr($array['dcdate'],8,2);
	  $dcdate=$y2.'-'.$m2.'-'.$d2;
	  
	 if($array['dcdate'] != '0000-00-00 00:00:00'){
	  $admit=DateDiff("$datediff1","$dcdate"); 
	 }else{
	  $admit="0";
	 }
	  
  ?>
  

  <tr>
    <td align="center"><?=++$i;?></td>
    <td><?=$array['hn'];?></td>
    <td><?=$array['an'];?></td>
    <td><?=$array['ptname'];?></td>
    <td><?=$array['ptright'];?></td>
    <td><?=$array['diag'];?></td>
    <td><?=$array['doctor'];?></td>
    <td><?=substr($array['date'],0,10);?></td>
    <td><?=substr($array['dcdate'],0,10);?></td>
    <td align="center"> <?=$admit;?></td>
  </tr>
  <?
  }
  ?>
</table>

<br /><!--<a href="#head" class="forntsarabun">ขึ้นข้างบน</a>-->
<a name="top" id="top"></a><h1 class="forntsarabun">Top 5 โรค</h1> 
<?

$sqltop="SELECT  icd10, COUNT(`icd10`) AS  `top` 
FROM bed1
WHERE  icd10 !=''
GROUP BY icd10
ORDER BY  `top` DESC 
LIMIT 5";
$objtop=mysql_query($sqltop);

$i=0;
 ?>
 <table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun">
  <tr align="center">
    <td bgcolor="#0099FF">ลำดับ</td>
    <td bgcolor="#0099FF">icd10</td>
    <td bgcolor="#0099FF">diag</td>
    <td bgcolor="#0099FF">จำนวน</td>
  </tr>
  <?
  while($array2=mysql_fetch_array($objtop)){
	  
	  $icd="select detail  from icd10 Where code='$array2[icd10]' ";
	  $q=mysql_query($icd);
	  $r=mysql_fetch_array($q);

  ?>
  <tr>
    <td align="center"><?=++$i;?></td>
    
    <td><a href="detail.php?do=view&icd10=<?=$array2['icd10'];?>&date=<?=$date1;?>" title="คลิกเพื่่อดูรายละเอียด"><?=$array2['icd10'];?></a></td>
    <td><?=$r['detail'];?></td>
  <td align="center"><?=$array2['top'];?></td>
    
  </tr>
  <?
  }
  ?>
</table>

<?


}else{
	echo "<font class=\"forntsarabun\">ไม่มีข้อมูลของเดือน  $dateshow</font>";
}

}// if($_POST['submit'])
?>
<!-- InstanceEndEditable -->

</div>



</body>
<!-- InstanceEnd --></html>