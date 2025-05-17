<?
session_start();
include("connect.inc");
?>
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
      <? $sql="SELECT * FROM `departments` WHERE sOr = 'y' ";
	  		$query=mysql_query($sql);
				
	  	while($arr=mysql_fetch_array($query)){	
		
	  ?>
      <option value="<?=$arr['name']?>"><?=$arr['name']?></option>
	  <? } ?>
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
	if($_POST['ward']=="OPD" || $_POST['ward']=="ห้องตรวจโรค"){
		
	$where="and ward='OPD' or  ward='ห้องตรวจโรค' ";	
	}else if($_POST['ward']=="ER" || $_POST['ward']=="ห้องฉุกเฉิน"){
	$where="and ward='ER' or  ward='ห้องฉุกเฉิน' ";	
	}else{
	
	$where="and ward='".$_POST['ward']."'";	
	}
if(!empty($_POST['ward'])){
	$sqlnow="SELECT * FROM `surgery_set` WHERE date_surg like '$thidate%'  $where ";
}else{
	$sqlnow="SELECT * FROM `surgery_set` WHERE date_surg like '$thidate%'";	  //ดูรายเดือน
}	
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
    <td bgcolor="#0099CC"><div align="center">ลำดับ</div></td>
	<td bgcolor="#0099CC"><div align="center">หน่วย</div></td>
    <td width='8%' bgcolor="#0099CC"><div align="center">วัน/เดือน/ปี</div></td>
    <td bgcolor="#0099CC">เวลา</td>
    <td width='7%' bgcolor="#0099CC"><div align="center">hn</div></td>
    <td bgcolor="#0099CC"><div align="center">an</div></td>
    <td width='15%' bgcolor="#0099CC"><div align="center">ชื่อ-สกุล</div></td>
    <td width='8%' bgcolor="#0099CC"><div align="center">อายุ</div></td>
    <td width='8%' bgcolor="#0099CC"><div align="center">สิทธิ	</div></td>
    <td width='10%' bgcolor="#0099CC"><div align="center">การวินิจฉัย</div></td>
    <td width='15%' bgcolor="#0099CC"><div align="center">การผ่าตัด</div></td>
    <td width='15%' bgcolor="#0099CC"><div align="center">แพทย์</div></td>
    <td bgcolor="#0099CC"><div align="center">ชนิดดมยา</div></td>
    <td bgcolor="#0099CC">หมายเหตุ</td>
  </tr>
  <? 
    $r=0;
  while($arr=mysql_fetch_array($querynow)){
	$sql1="SELECT date_surg,hn, count(*) as count FROM surgery_set where hn='".$arr["hn"]."' and date_surg = '".$arr["date_surg"]."' group by date_surg,hn having count(*) > 1";
	//echo $sql1."<br>";
	$query1=mysql_query($sql1);
	$rows1=mysql_fetch_array($query1);	
	//echo $rows1["count"]."<br>";
	if($rows1["count"] > 1){
		$bgcolor="#FADBD8";
	}else{
		$bgcolor="#FFFFFF";
	}		
	  $exd=explode('-',$arr['date_surg']);
	  $exd[0]=$exd[0]+543;
	  $date_surg=$exd[2].'-'.$exd[1].'-'.$exd[0];
    
	if($arr['inhalation_ga']=="y"){
		$inhalation_ga="GA ";	
	}else{
		$inhalation_ga="";
	}	
	if($arr['inhalation_sa']=="y"){
		$inhalation_sa="SA ";	
	}else{
		$inhalation_sa="";
	}	
	if($arr['inhalation_bb']=="y"){
		$inhalation_bb="BB ";	
	}else{
		$inhalation_bb="";
	}
	if($arr['inhalation_iva']=="y"){
		$inhalation_iva="IVA ";	
	}else{
		$inhalation_iva="";
	}
	if($arr['inhalation_la']=="y"){
		$inhalation_la="LA ";	
	}else{
		$inhalation_la="";
	}
	if($arr['inhalation_ta']=="y"){
		$inhalation_ta="TA";	
	}else{
		$inhalation_ta="";
	}	
	if($arr['inhalation_other']=="y"){
		$inhalation_other=$arr['inhalation_detail'];	
	}else{
		$inhalation_other="";
	}

	$inhalation_type="$inhalation_ga$inhalation_sa$inhalation_bb$inhalation_iva$inhalation_la$inhalation_ta$inhalation_other";	

	
	$r++;
	
 if($r=='26'){
$r=1;
	echo "</table>";
		echo "<div style='page-break-after: always'> ";
		echo "<div style='page-break-before: always'> ";
		echo "<table  width='100%' border='1' style='border-collapse:collapse; border-color:#000;' cellpadding='0' cellspacing='0' class='font1' align='center'>
  <tr>
    <td bgcolor='#0099CC'><div align='center'>ลำดับ</div></td>
	<td bgcolor='#0099CC'><div align='center'>หน่วย</div></td>
    <td width='8%' bgcolor='#0099CC'><div align='center'>วัน/เดือน/ปี</div></td>
    <td bgcolor='#0099CC'>เวลา</td>
    <td width='7%' bgcolor='#0099CC'><div align='center'>hn</div></td>
    <td bgcolor='#0099CC'><div align='center'>an</div></td>
    <td width='15%' bgcolor='#0099CC'><div align='center'>ชื่อ-สกุล</div></td>
    <td width='8%' bgcolor='#0099CC'><div align='center'>อายุ</div></td>
    <td width='8%' bgcolor='#0099CC'><div align='center'>สิทธิ	</div></td>
    <td width='10%' bgcolor='#0099CC'><div align='center'>การวินิจฉัย</div></td>
    <td width='15%' bgcolor='#0099CC'><div align='center'>การผ่าตัด</div></td>
    <td width='15%' bgcolor='#0099CC'><div align='center'>แพทย์</div></td>
    <td width='10%'bgcolor='#0099CC'><div align='center'>ชนิดดมยา</div></td>
    <td bgcolor='#0099CC'>หมายเหตุ</td>
  </tr>";
  
  
 }
  ?>
  <tr bgcolor='<?=$bgcolor;?>'>
    <td align="center"><?=$r;?></td>
	<td><?=$arr['ward'];?></td>
    <td align="center"><?=$date_surg;?>    </td>
    <td><?=$arr['surgery_time'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['an'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['age'];?></td>
    <td><?=$arr['ptright'];?></td>
    <td><?=$arr['diag'];?></td>
    <td><?=$arr['operation'];?>    </td>
    <td><?=$arr['doctor'];?></td>
    <td><?=$inhalation_type;?></td>
    <td><?=$arr['comment'];?></td>
  </tr>
  
  <?  } 
//echo "</div>";
echo "</div>";
  ?>
</table>
<?php
$sqltype="SELECT * FROM (
  SELECT max(row_id) as row_id,inhalation_ga,inhalation_sa,inhalation_bb,inhalation_iva,inhalation_la,inhalation_other 
  FROM surgery_set WHERE date_surg like '$thidate%' GROUP BY date_surg,hn) surgery_set";
//echo $sqltype."<br>";
$querytype=mysql_query($sqltype);
$count_inhalation_ga=0;
$total_inhalation_ga=0;
$count_inhalation_sa=0;
$total_inhalation_sa=0;
$count_inhalation_iva=0;
$total_inhalation_iva=0;
$count_inhalation_bb=0;
$total_inhalation_bb=0;
$count_inhalation_la=0;
$total_inhalation_la=0;
$count_inhalation_ta=0;
$total_inhalation_ta=0;
$count_inhalation_other=0;
$total_inhalation_other=0;
while($result=mysql_fetch_array($querytype)){
$sqltype1="SELECT * FROM surgery_set WHERE row_id = '".$result["row_id"]."' ";
//echo $sqltype1."<br>";
$querytype1=mysql_query($sqltype1);
$rows=mysql_fetch_array($querytype1);
	
	//echo $rows["row_id"]."==>".$rows["inhalation_ga"]."<br>";	
	if($rows["inhalation_ga"]=="y"){
		$count_inhalation_ga++;
	}
	if($rows["inhalation_sa"]=="y"){
		$count_inhalation_sa++;
	}
	if($rows["inhalation_bb"]=="y"){
		$count_inhalation_bb++;
	}
	if($rows["inhalation_iva"]=="y"){
		$count_inhalation_iva++;
	}
	if($rows["inhalation_la"]=="y"){
		$count_inhalation_la++;
	}
	if($rows["inhalation_ta"]=="y"){
		$count_inhalation_ta++;
	}	
	if($rows["inhalation_other"]=="y"){
		$count_inhalation_other++;
	}	
}
$total_inhalation_ga=$total_inhalation_ga+$count_inhalation_ga;	
$total_inhalation_sa=$total_inhalation_sa+$count_inhalation_sa;	
$total_inhalation_bb=$total_inhalation_bb+$count_inhalation_bb;	
$total_inhalation_iva=$total_inhalation_iva+$count_inhalation_iva;	
$total_inhalation_la=$total_inhalation_la+$count_inhalation_la;	
$total_inhalation_ta=$total_inhalation_ta+$count_inhalation_ta;	
$total_inhalation_other=$total_inhalation_other+$count_inhalation_other;	
?>
<div style="margin-top:30px;" class="font1">
<div align="center"><strong>สรุปข้อมูลชนิดการใช้ยาระงับความรู้สึก</strong></div>
<div style="margin-left:650px;">1. ชนิด GA จำนวน <span style="margin-left:15px; margin-right:5px;"><?php echo $total_inhalation_ga;?></span> รายการ</div>
<div style="margin-left:650px;">2. ชนิด SA จำนวน <span style="margin-left:15px; margin-right:5px;"><?php echo $total_inhalation_sa;?></span> รายการ</div>
<div style="margin-left:650px;">3. ชนิด BB จำนวน <span style="margin-left:15px; margin-right:5px;"><?php echo $total_inhalation_bb;?></span> รายการ</div>
<div style="margin-left:650px;">4. ชนิด IVA จำนวน <span style="margin-left:15px; margin-right:5px;"><?php echo $total_inhalation_iva;?></span> รายการ</div>
<div style="margin-left:650px;">5. ชนิด LA จำนวน <span style="margin-left:15px; margin-right:5px;"><?php echo $total_inhalation_la;?></span> รายการ</div>
<div style="margin-left:650px;">6. ชนิด TA จำนวน <span style="margin-left:15px; margin-right:5px;"><?php echo $total_inhalation_ta;?></span> รายการ</div>
<div style="margin-left:650px;">7. ชนิด อื่นๆ จำนวน <span style="margin-left:15px; margin-right:5px;"><?php echo $total_inhalation_other;?></span> รายการ</div>
<div align="center" style="color:red; margin-bottom:30px;">หมายเหตุ :  ข้อมูลผู้ป่วยที่ SET ผ่าตัด ในวันเดียวกัน ระบบจะนับเอาเฉพาะข้อมูลล่าสุด</div>
</div>
<?

} else {
	
 echo "<div align='center' class='font1'>ไม่มีข้อมูลของเดือน </div>";	
}
} 
?>