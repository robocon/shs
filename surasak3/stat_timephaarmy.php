<?
include("connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {	font-family:AngsanaUPC;
	font-size: 20px;
}
-->
</style>
</head>

<body>
<form name="timeline" method="post" action="<? $_SERVER['PHP_SELF']?>">

<span class="font1"><a href="stat_timepha.php">โปรแกรมสรุปเวลาประจำวันทั้งหมด</a> || โปรแกรมสรุปเวลาประจำวันทหารและครอบครัว  || <a href="stat_timephaarmymount.php">สรุปเวลาประจำเดือนทหารและครอบครัว</a><br />
<br />
<?
$d=date("d");
$m=date("m");
$year=date("Y");
?>
วันที่ 
<select name="d1">
  <?
	for($a=1;$a<32;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
  <option value="<?=$ss?><?=$a?>" <? if($d==$a) echo "selected='selected'"?>>
  <?=$a?>
  </option>
  <? }?>
</select>
เดือน
<select name="m1">
  <?
	$month = array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	for($a=1;$a<13;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
  <option value="<?=$ss?><?=$a?>" <? if($m==$a) echo "selected='selected'"?>>
  <?=$month[$a]?>
  </option>
  <?
	}
	?>
</select>
พ.ศ.
<select name="yr1">
  <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
  <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'"?>>
  <?=$a?>
  </option>
  <?
	}
	?>
</select>
</span>
<a href="../nindex.htm" class="forntsarabun"><< ไปเมนูหลัก >></a>
<br />
<br />
<input name="okbtn" type="submit" value="  ตกลง  " class="font1"/>
</form>
<?
if(isset($_POST['okbtn'])){
?>
<center>โปรแกรมสรุปเวลาห้องจ่ายยาประจำวันที่ <?=$d1?>-<?=$m1?>-<?=$yr1?></center> 
<table width="100%" class="font1" border="1" cellpadding="0" cellspacing="0">
<tr>
  <td width="2%" rowspan="2" align="center">VN</td>
<td width="5%" rowspan="2" align="center">HN</td>
<td width="15%" rowspan="2" align="center">ชื่อ-สกุล</td>
<td colspan="5" align="center">เวลา</td>
<td width="6%" rowspan="2" align="center">รวมเวลา(3-1)</td>
</tr>
<tr>
   <td width="6%" height="22" align="center">แพทย์ตรวจเสร็จ</td>
  <td width="6%" align="center">รับใบสั่งยา(1)</td>
  <td width="6%" align="center">ตัดยา(2)</td>
    <td width="6%" align="center">เรียกรับ(3)</td>
  <td width="6%" align="center">จ่ายยา(4)</td>
  </tr>
<?
$sql = "SELECT * FROM opday as tb1 inner join opcard as tb2 on tb1.hn=tb2.hn where tb1.thidate like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%' and substring(tb2.idguard,1,4)='MX01' order by tb1.thidate asc ";
$rows = mysql_query($sql);
$n=0;
$hh=0;
$ii=0;
$ss=0;
while($result = mysql_fetch_array($rows)){
$sql2 = "select thidate,dc_diag from opd  where thidate like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%' and hn='".$result['hn']."' ";

$rows2 = mysql_query($sql2);
$result2 = mysql_fetch_array($rows2);

$sql3 = "select date,stkcutdate,pharout,pharout1 from dphardep where  dr_cancle is null and date like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%' and hn='".$result['hn']."' ";

$rows3 = mysql_query($sql3);
$result3 = mysql_fetch_array($rows3);

$sqlphar="select a.date as pharin from opacc as a inner join phardep as b ON a.txdate=b.date where depart='PHAR' and a.hn='".$result['hn']."' and a.txdate like '".$_POST['yr1']."-".$_POST['m1']."-".$_POST['d1']."%'";
//echo $sqlphar;
$rowsphar = mysql_query($sqlphar);
$resultphar = mysql_fetch_array($rowsphar);

	$Cidguard++;
	if($Cidguard==0){
		$Cidguard="0";
	}
	if($resultphar['pharin'] && $result3['pharout'] !=''){
		$starttime = substr($resultphar['pharin'],11,8);
		$lasttime = $result3['pharout'];
		if($starttime && $lasttime!=""){
			$n++;
			$stringtime3=strtotime($lasttime) - strtotime($starttime);
			$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
		}
	
	$cuttime=explode(':',$time3);
	
	if($cuttime[0]>00 || $cuttime[1]>30){
		
		$sumtime1++;
		if($sumtime1==0){
			$sumtime1="0";	
		}
	}
	if($cuttime[0]==00 && $cuttime[1]<30){
		
		$sumtime2++;
		if($sumtime2==0){
		$sumtime2="0";	
		}
	}
	
		$count1++;
		if($count1==0){
		$count1="0";	
		}
		
	$ss=$ss+$cuttime[2];
	$ii=$ii+$cuttime[1];
	$hh=$hh+$cuttime[0];
	//echo "$ii=$ii+$cuttime[1] <br>";
		
	}else{  // ถ้าใบสั่งและเรียกรับเป็นค่าว่าง
		$time3="-";
	}
?>
<tr>
  <td align="center"><?=$result['vn']?></td>
  <td><?=$result['hn']?></td>
  <td><?=$result['ptname']?></td>
  <td align="center"><? if(empty($result3['date'])){ echo "-";}else{ echo substr($result3['date'],11);}?></td>
  <td align="center"><? if(empty($resultphar['pharin'])){ echo "-";}else{ echo substr($resultphar['pharin'],11,8);}?></td>
  <td align="center"><? if(empty($result3['stkcutdate'])){ echo "-";}else{ echo $result3['stkcutdate'];}?></td>
  <td align="center"><? if(empty($result3['pharout'])){ echo "-";}else{ echo $result3['pharout'];}?></td>  
  <td align="center"><? if(empty($result3['pharout1'])){ echo "-";}else{ echo $result3['pharout1'];}?></td>  
  <td align="center"><? if(empty($time3)){ echo "-";}else{ echo $time3;}?></td>
</tr>
<?
}
//echo "$hh, $ii, $ss <br>";
$sumss=$ss/60;
$sumhh=$hh*60;
$sumtime=$sumhh+$ii+$sumss;
$avgtime=$sumtime/$count1;
?>
</table>
<BR />
<?
echo "แยกใบสั่งยา ผู้ป่วยที่เป็น MX01 ทหาร /ครอบครัว ".$Cidguard." คน";
echo "<br>";
echo "รับใบสั่งยา - เรียกรับ ".$count1." คน";
echo "<br>";
if($sumtime1){
echo "จำนวนใบสั่งยาที่ใช้เวลาเกิน 30 นาที  จำนวน ".$sumtime1." คน";
}else{
echo "จำนวนใบสั่งยาที่ใช้เวลาเกิน 30 นาที  จำนวน 0 คน";
}
echo "<br>";

echo "จำนวนใบสั่งยาที่ใช้เวลาไม่เกิน 30 นาที จำนวน ".$sumtime2." คน";
echo "<br>";
echo "เฉลี่ยใช้เวลาการให้บริการ/คน ".number_format($avgtime,2)." นาที";
}
?>
</body>
</html>