<?php
session_start();
include("alert_surgery_set.php");
?>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.f1{
	font-family: TH SarabunPSK;
	font-size:16pt;	
}
</style>
<a href="../nindex.htm">&lt;&lt;-เมนู</a> &nbsp;&nbsp;<a href="surgery_set_from_orlist_print.php" target="_blank">รายงานข้อมูลใบ SET ผ่าตัด </a>
<h1 align="center" style="margin-top:20px; font-weight:bold;">ข้อมูลใบ SET ผ่าตัด</h1>
<? 
include("connect.inc");

$datenow=date("Y-m-d");
for($i=0;$i<=1;$i++){
	
$tomorow=date('Y-m-d',strtotime("+$i day"));


$sqlnow="SELECT * FROM `surgery_set` WHERE date_surg='$tomorow' and active='รับทราบ'  order by date_surg,hn,an ASC";
$querynow=mysql_query($sqlnow)or die(mysql_error());

$rownow=mysql_num_rows($querynow);

if($rownow){
	
	if($i==0){
?>

<h1 class="f1" style="font-family:'TH SarabunPSK'; font-size:18px;" align="center">ใบ SET ผ่าตัด วันนี้ </h1>
<? 
	}else{
?>	
<h1 class="f1" style="font-family:'TH SarabunPSK'; font-size:18px;" align="center">ใบ SET ผ่าตัด พรุ่งนี้ </h1>	
	<?	
	}
?>
<table width="98%" border="1" style="border-collapse:collapse; border-color:#000;font-size:16pt;" cellpadding="0" cellspacing="0" class="f1" align="center">
  <tr>
    <td bgcolor="#76D7C4"><div align="center">ลำดับ</div></td>
	<td width="7%" bgcolor="#76D7C4"><div align="center">หอผู้ป่วย</div></td>
    <td width="7%" bgcolor="#76D7C4"><div align="center">วัน/เดือน/ปี</div></td>
    <td width="5%" bgcolor="#76D7C4">เวลา</td>
    <td width="5%" bgcolor="#76D7C4"><div align="center">hn</div></td>
    <td width="4%" bgcolor="#76D7C4"><div align="center">an</div></td>
    <td width="10%" bgcolor="#76D7C4"><div align="center">ชื่อ-สกุล</div></td>
    <td width="7%" bgcolor="#76D7C4"><div align="center">อายุ</div></td>
    <td width="10%" bgcolor="#76D7C4"><div align="center">สิทธิ	</div></td>
    <td width="10%" bgcolor="#76D7C4"><div align="center">การวินิจฉัย</div></td>
    <td width="10%" bgcolor="#76D7C4"><div align="center">การผ่าตัด</div></td>
    <td width="10%" bgcolor="#76D7C4"><div align="center">แพทย์</div></td>
	<td width="5%" bgcolor="#76D7C4"><div align="center">ชนิดดมยา</div></td>
    <td bgcolor="#76D7C4"><div align="center">หมายเหตุ</div></td>
	<td bgcolor="#76D7C4"><div align="center">สถานะ</div></td>
    <td align="center" width="5%" bgcolor="#76D7C4">เอกสาร</td>
	<td align="center" width="5%" bgcolor="#76D7C4">ปลดล็อค</td>
  </tr>
  <? 
  $j=0;
  while($arr=mysql_fetch_array($querynow)){
	$j++;  
	$sql2="SELECT date_surg,hn, count(*) as count FROM surgery_set where hn='".$arr["hn"]."' and date_surg = '".$arr["date_surg"]."' group by date_surg,hn having count(*) > 1";
	//echo $sql2."<br>";
	$query2=mysql_query($sql2);
	$rows2=mysql_fetch_array($query2);	
	//echo $rows2["hn"].">>>".$rows2["count"]."<br>";
	if($rows2["count"] > 1){
		$bgcolor="#FADBD8";
	}else{
		$bgcolor="#FFFFFF";
	}
	
	  $exd=explode('-',$arr['date_surg']);
	  $exd[0]=$exd[0]+543;
	  $date_surg=$exd[2].'-'.$exd[1].'-'.$exd[0];
	  $getid=$arr['row_id'];
	  
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
		$inhalation_bb="bb ";	
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
		$inhalation_ta="TA ";	
	}else{
		$inhalation_ta="";
	}	
	if($arr['inhalation_other']=="y"){
		$inhalation_other=$arr['inhalation_detail'];	
	}else{
		$inhalation_other="";
	}

	$inhalation_type="$inhalation_ga$inhalation_sa$inhalation_bb$inhalation_iva$inhalation_la$inhalation_ta$inhalation_other";		  
	if(empty($inhalation_type)){
		$inhalation_type="ไม่ระบุ";
	}

	if($arr['status'] =="Y"){
		$status="ใช้งาน";
	}else{
		$status="<div style='color:red;'>ยกเลิก</div>";
	}	
  ?>
  <tr bgcolor="<?=$bgcolor;?>">
    <td align='center'><?=$j;?></td>
	<td><?=$arr['ward'];?></td>
    <td><strong>
      <?=$date_surg;?>
    </strong></td>
    <td><?=$arr['surgery_time'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['an'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['age'];?></td>
    <td><?=$arr['ptright'];?></td>
    <td><?=$arr['diag'];?></td>
    <td><?=$arr['operation'];?></td>
    <td><?=$arr['doctor'];?></td>
    <td align="center"><a href="surgery_set_from_or_edit.php?row_id=<?=$getid;?>"><?=$inhalation_type;?></a></td>
	<td><?=$arr['detail'];?></td>
	<td><?=$status;?></td>
    <td align='center'><a href='surgery_set_from_print.php?id=<?=$getid;?>' target='_blank'><img src="images/print-green.png" height="32" width="32"></a></td>
	<td align='center'><a href='surgery_set_unlock.php?id=<?=$getid;?>' onclick="return confirm('ยืนยันการปลดล็อค เพื่อให้หน้างานแก้ไขข้อมูล');" target='_blank'><img src="images/unlock.png" height="32" width="32"></a></td>
  </tr>
  
  <?  } ?>
</table>

<? 
}
}
?>



<hr>
<h1 class="f1" style="font-family:'TH SarabunPSK'; font-size:16pt;" align="center">ใบ SET ผ่าตัด ทั้งหมด </h1>
<? 
	$sqlnow="SELECT * FROM `surgery_set` WHERE active='รับทราบ' order by date_surg,hn,an ASC";
	$querynow=mysql_query($sqlnow);

	$rownow=mysql_num_rows($querynow);
?>	
<table width="98%" border="1" style="border-collapse:collapse; border-color:#000;font-family:'TH SarabunPSK'; font-size:16pt;" cellpadding="0" cellspacing="0" class="f1" align="center">
  <tr>
    <td bgcolor="#0099CC"><div align="center">ลำดับ</div></td>
	<td width="7%" bgcolor="#0099CC"><div align="center">หอผู้ป่วย</div></td>
    <td width="7%" bgcolor="#0099CC"><div align="center">วัน/เดือน/ปี</div></td>
    <td width="5%" bgcolor="#0099CC">เวลา</td>
    <td width="5%" bgcolor="#0099CC"><div align="center">hn</div></td>
    <td width="4%" bgcolor="#0099CC"><div align="center">an</div></td>
    <td width="10%" bgcolor="#0099CC"><div align="center">ชื่อ-สกุล</div></td>
    <td width="7%" bgcolor="#0099CC"><div align="center">อายุ</div></td>
    <td width="10%" bgcolor="#0099CC"><div align="center">สิทธิ	</div></td>
    <td width="10%" bgcolor="#0099CC"><div align="center">การวินิจฉัย</div></td>
    <td width="10%" bgcolor="#0099CC"><div align="center">การผ่าตัด</div></td>
    <td width="10%" bgcolor="#0099CC"><div align="center">แพทย์</div></td>
	<td width="5%" bgcolor="#0099CC"><div align="center">ชนิดดมยา</div></td>
    <td bgcolor="#0099CC"><div align="center">หมายเหตุ</div></td>
	<td bgcolor="#0099CC"><div align="center">สถานะ</div></td>
    <td align="center" width="5%" bgcolor="#0099CC">เอกสาร</td>
	<td align="center" width="5%" bgcolor="#0099CC">ปลดล็อค</td>
  </tr>
  <? 
if($rownow < 1){
	echo "<tr><td colspan='16' align='center' style='color:red;'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
}else{	  
  $j=0;
  while($arr=mysql_fetch_array($querynow)){
	$j++;  
	
	$sql2="SELECT date_surg,hn, count(*) as count FROM surgery_set where hn='".$arr["hn"]."' and date_surg = '".$arr["date_surg"]."' group by date_surg,hn having count(*) > 1";
	//echo $sql2."<br>";
	$query2=mysql_query($sql2);
	$rows2=mysql_fetch_array($query2);	
	//echo $rows2["count"]."<br>";
	if($rows2["count"] > 1){
		$bgcolor="#FADBD8";
	}else{
		$bgcolor="#FFFFFF";
	}
	
	  $exd=explode('-',$arr['date_surg']);
	  $exd[0]=$exd[0]+543;
	  $date_surg=$exd[2].'-'.$exd[1].'-'.$exd[0];
	  
	  //$date_surg=$arr['date_surg'];
	  $getid=$arr['row_id'];
	  
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
		$inhalation_bb="bb ";	
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
		$inhalation_ta="TA ";	
	}else{
		$inhalation_ta="";
	}	
	if($arr['inhalation_other']=="y"){
		$inhalation_other=$arr['inhalation_detail'];	
	}else{
		$inhalation_other="";
	}

	$inhalation_type="$inhalation_ga$inhalation_sa$inhalation_bb$inhalation_iva$inhalation_la$inhalation_ta$inhalation_other";		  
	if(empty($inhalation_type)){
		$inhalation_type="ไม่ระบุ";
	}	
	
	if($arr['status'] =="Y"){
		$status="ใช้งาน";
	}else{
		$status="<div style='color:red;'>ยกเลิก</div>";
	}	
  ?>
  <tr bgcolor="<?=$bgcolor;?>">
    <td align='center'><?=$j;?></td>
	<td><?=$arr['ward'];?></td>
    <td><strong>
      <?=$date_surg;?>
    </strong></td>
    <td><?=$arr['surgery_time'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['an'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['age'];?></td>
    <td><?=$arr['ptright'];?></td>
    <td><?=$arr['diag'];?></td>
    <td><?=$arr['operation'];?></td>
    <td><?=$arr['doctor'];?></td>
    <td align="center"><a href="surgery_set_from_or_edit.php?row_id=<?=$getid;?>"><?=$inhalation_type;?></a></td>
	<td><?=$arr['detail'];?></td>
	<td><?=$status;?></td>
    <td align='center'><a href='surgery_set_from_print.php?id=<?=$getid;?>' target='_blank'><img src="images/print-green.png" height="32" width="32"></a></td>
	<td align='center'><a href='surgery_set_unlock.php?id=<?=$getid;?>' onclick="return confirm('ยืนยันการปลดล็อค เพื่อให้หน้างานแก้ไขข้อมูล');" target='_blank'><img src="images/unlock.png" height="32" width="32"></a></td>
  </tr>
  
<?  }} ?>
</table>

