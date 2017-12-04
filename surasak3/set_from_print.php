<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<style type="text/css">
.font1 {
	font-family:"TH SarabunPSK";
	font-size:16pt;
	src: url("surasak3/TH SarabunPSK.ttf");
}
.font2 {
	font-family:"TH SarabunPSK";
	font-size:14pt;
	src: url("surasak3/TH SarabunPSK.ttf");
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
.font11 {	font-family:"TH SarabunPSK";
	font-size:20px;
}
</style>
<div id="no_print">
<h1 class="font1">&nbsp;</h1>

<fieldset class="font1" style="width:80%">
  <legend>ใบ SET ผ่าตัด </legend>
  <form id="form1" name="form1" method="post"  onSubmit="JavaScript:return fncSubmit();">
  <table border="0" align="center">
    <tr>
      <td>เดือน/ปี</td>
      <td>
        <select name="m_start" class="font11">
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
				?></td>
      </tr>
    <tr>
      <td>หน่วย</td>
      <td><select name="ward" class="font1" id="ward">
        <option value="">----กรุณาเลือก----</option>
        <option value="OPD">OPD</option>
        <option value="ER">ER</option>
        <option value="หอผู้ป่วยรวม">หอผู้ป่วยรวม</option>
        <option value="หอผู้ป่วยสูติ">หอผู้ป่วยสูติ</option>
        <option value="หอผู้ป่วยพิเศษ">หอผู้ป่วยพิเศษ</option>
        <option value="หอผู้ป่วยหนัก">หอผู้ป่วยหนัก</option>
        <option value="ไม่ระบุ">ไม่ระบุ</option>
      </select></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font1" id="button" value="ตกลง" />
      <a target=_self  href='../nindex.htm'> ไปเมนู </a></td>
    </tr>
  </table>
</form>
</fieldset>
<br />
</div>
<? 
if($_POST['button']){
include("connect.inc");

$y_start=($_POST['y_start']-543);
$datenow=date("Y-m-d");
$thidate=$y_start.'-'.$_POST['m_start'];
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
	if($_POST['ward']=="OPD"){
		
	$where="and ward='OPD' or  ward='ห้องตรวจโรค' ";	
	}else{
	
	$where="and ward='".$_POST['ward']."'";	
	}

$sqlnow="SELECT * FROM `set_or` WHERE date_surg like '$thidate%'  $where ";
$querynow=mysql_query($sqlnow);

$rownow=mysql_num_rows($querynow);


 $dateshow=$printmonth." ".($_POST['y_start']);

if($rownow){
	 
?>
<br />
<br />
<h1 class="font1" align="center">ใบ SET ผ่าตัด  เดือน <?=$dateshow;?></h1>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="font1" style="border-collapse:collapse; border-color:#000;">
  <tr>
    <td bgcolor="#0099CC"><div align="center">หน่วย</div></td>
    <td bgcolor="#0099CC"><div align="center">วัน/เดือน/ปี</div></td>
    <td bgcolor="#0099CC">เวลา</td>
    <td bgcolor="#0099CC"><div align="center">hn</div></td>
    <td bgcolor="#0099CC"><div align="center">an</div></td>
    <td bgcolor="#0099CC"><div align="center">ชื่อ-สกุล</div></td>
    <td bgcolor="#0099CC"><div align="center">อายุ</div></td>
    <td bgcolor="#0099CC"><div align="center">สิทธิ	</div></td>
    <td bgcolor="#0099CC"><div align="center">การวินิจฉัย</div></td>
    <td bgcolor="#0099CC"><div align="center">การผ่าตัด</div></td>
    <td bgcolor="#0099CC"><div align="center">แพทย์</div></td>
    <td bgcolor="#0099CC"><div align="center">ชนิดดมยา</div></td>
    <td bgcolor="#0099CC">หมายเหตุ</td>
  </tr>
  <? 
    $r=0;
  while($arr=mysql_fetch_array($querynow)){
	  
	  $exd=explode('-',$arr['date_surg']);
	  $exd[0]=$exd[0]+543;
	  $date_surg=$exd[2].'-'.$exd[1].'-'.$exd[0];
    
	$r++;
	
 if($r=='26'){
$r=1;
	echo "</table>";
		echo "<div style='page-break-after: always'> ";
		echo "<div style='page-break-before: always'> ";
		echo "<table  width='100%' border='1' style='border-collapse:collapse; border-color:#000;' cellpadding='0' cellspacing='0' class='font1' align='center'>
  <tr>
    <td bgcolor='#0099CC'><div align='center'>หน่วย</div></td>
    <td bgcolor='#0099CC'><div align='center'>วัน/เดือน/ปี</div></td>
    <td bgcolor='#0099CC'>เวลา</td>
    <td bgcolor='#0099CC'><div align='center'>hn</div></td>
    <td bgcolor='#0099CC'><div align='center'>an</div></td>
    <td bgcolor='#0099CC'><div align='center'>ชื่อ-สกุล</div></td>
    <td bgcolor='#0099CC'><div align='center'>อายุ</div></td>
    <td bgcolor='#0099CC'><div align='center'>สิทธิ	</div></td>
    <td bgcolor='#0099CC'><div align='center'>การวินิจฉัย</div></td>
    <td bgcolor='#0099CC'><div align='center'>การผ่าตัด</div></td>
    <td bgcolor='#0099CC'><div align='center'>แพทย์</div></td>
    <td bgcolor='#0099CC'><div align='center'>ชนิดดมยา</div></td>
    <td bgcolor='#0099CC'>หมายเหตุ</td>
  </tr>";
  
  
 }
  ?>
  <tr>
    <td><?=$arr['ward'];?></td>
    <td><?=$date_surg;?>    </td>
    <td><?=$arr['time'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['an'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['age'];?></td>
    <td><?=$arr['ptright'];?></td>
    <td><?=$arr['diag'];?></td>
    <td><?=$arr['surg'];?>    </td>
    <td><?=$arr['doctor'];?></td>
    <td><?=$arr['inhalation_type'];?></td>
    <td><?=$arr['comment'];?></td>
  </tr>
  
  <?  } 
//echo "</div>";
echo "</div>";
  ?>
</table>

<?

} else {
	
 echo "<div align='center' class='font1'>ไม่มีข้อมูลของเดือน </div>";	
}
} 
?>