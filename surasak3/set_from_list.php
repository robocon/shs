<? session_start();?>
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

<? 
include("connect.inc");

$menucode=$_SESSION["smenucode"];	

if($menucode=='ADMMAINOPD'){
	
	$where="and ward ='OPD' ";
	
}else if($menucode=='ADMER'){
	
	$where="and ward ='ER' ";
	
}else{
	
	$where="";
}



$datenow=date("Y-m-d");

for($i=0;$i<=1;$i++){
	
$tomorow=date('Y-m-d',strtotime("+$i day"));

$sqlnow="SELECT * FROM `set_or` WHERE date_surg='$tomorow' and status !='N' ".$where." ";
$querynow=mysql_query($sqlnow)or die(mysql_error());

$rownow=mysql_num_rows($querynow);

if($rownow){
	
	if($i==0){
?>

<h1 class="f1" style="font-family:'Angsana New'; font-size:18px;" align="center">ใบ SET ผ่าตัด วันนี้ </h1>
<? 
	}else{
?>	
<h1 class="f1" style="font-family:'Angsana New'; font-size:18px;" align="center">ใบ SET ผ่าตัด พรุ่งนี้ </h1>	
	<?	
	}
?>
<table border="1" style="border-collapse:collapse; border-color:#000;font-family:'Angsana New'; font-size:16pt;" cellpadding="0" cellspacing="0" class="f1" align="center">
  <tr>
    <td bgcolor="#0099CC"><div align="center">หอผู้ป่วย</div></td>
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
    <td bgcolor="#0099CC"><div align="center">แก้ไข</div></td>
    <td bgcolor="#0099CC">พิมพ์</td>
  </tr>
  <? 
  while($arr=mysql_fetch_array($querynow)){
	  
	  $exd=explode('-',$arr['date_surg']);
	  $exd[0]=$exd[0]+543;
	  $date_surg=$exd[2].'-'.$exd[1].'-'.$exd[0];
  ?>
  <tr>
    <td><?=$arr['ward'];?></td>
    <td><strong>
      <?=$date_surg;?>
    </strong></td>
    <td><?=$arr['time'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['an'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['age'];?></td>
    <td><?=$arr['ptright'];?></td>
    <td><?=$arr['diag'];?></td>
    <td><strong>
      <?=$arr['surg'];?>
    </strong></td>
    <td><?=$arr['doctor'];?></td>
    <td><?=$arr['inhalation_type'];?></td>
    <td><?=$arr['comment'];?></td>
    <td align="center"><a href="javascript:MM_openBrWindow('set_from_edit.php?row_id=<?=$arr['row_id'];?>','','toolbar=no,location=no,status=n o,menubar=no,scrollbars=no,resizable=yes,width=350, height=500')">แก้ไข</a></td>
    <td align="center"><a href="set_from_or_print2.php?id=<?=$arr['row_id'];?>" target="_blank">พิมพ์</a></td>
  </tr>
  
  <?  } ?>
</table>

<? 
}
}

echo "<br>";
$sqlGroup="SELECT substring(date_surg,1,7)as subdate FROM  `set_or` 
WHERE date_surg>='".$datenow."' and status !='N' ".$where."
GROUP  BY subdate
ORDER  BY subdate ASC";
$queryGroup=mysql_query($sqlGroup)or die(mysql_error());

while($arrG=mysql_fetch_array($queryGroup)){
	
	$sub1=explode('-',$arrG['subdate']);
	$sub1[0]=$sub1[0]+543;
	switch($sub1[1]){
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

 $dateshow=$printmonth." ".$sub1[0];
  $tomorow2=date('Y-m-d');
 $tomorow3=date('Y-m-d',strtotime("+1 day")); // นับจำนวนเพิ่ม 1 วัน 

	$sql1="SELECT * FROM `set_or` WHERE date_surg >='".$datenow."'  and  date_surg like '$arrG[subdate]%'  AND (date_surg!='$tomorow2' and date_surg!='$tomorow3') and status !='N'  ".$where." order by date_surg asc";
	$query1=mysql_query($sql1) or die(mysql_error());
?>

<h1 class="f1" style="font-family:'Angsana New'; font-size:18px;" align="center">ใบ SET ผ่าตัด  เดือน <?=$dateshow;?></h1>
<table border="1" style="border-collapse:collapse; border-color:#000;font-family:'Angsana New'; font-size:16pt;" cellpadding="0" cellspacing="0" class="f1" align="center">
  <tr>
    <td bgcolor="#FFCCCC"><div align="center">หอผู้ป่วย</div></td>
    <td bgcolor="#FFCCCC"><div align="center">วัน/เดือน/ปี</div></td>
    <td bgcolor="#FFCCCC">เวลา</td>
    <td bgcolor="#FFCCCC"><div align="center">hn</div></td>
    <td bgcolor="#FFCCCC"><div align="center">an</div></td>
    <td bgcolor="#FFCCCC"><div align="center">ชื่อ-สกุล</div></td>
    <td bgcolor="#FFCCCC"><div align="center">อายุ</div></td>
    <td bgcolor="#FFCCCC"><div align="center">สิทธิ	</div></td>
    <td bgcolor="#FFCCCC"><div align="center">การวินิจฉัย</div></td>
    <td bgcolor="#FFCCCC"><div align="center">การผ่าตัด</div></td>
    <td bgcolor="#FFCCCC"><div align="center">แพทย์</div></td>
    <td bgcolor="#FFCCCC"><div align="center">ชนิดดมยา</div></td>
    <td bgcolor="#FFCCCC">หมายเหตุ</td>
    <td bgcolor="#FFCCCC"><div align="center">แก้ไข</div></td>
    <td bgcolor="#FFCCCC">พิมพ์</td>
  </tr>
  <? 
  while($arr1=mysql_fetch_array($query1)){
	  
	  
	  $exd=explode('-',$arr1['date_surg']);
	  $exd[0]=$exd[0]+543;
	  $date_surg2=$exd[2].'-'.$exd[1].'-'.$exd[0];
  ?>
  <tr>
    <td><?=$arr1['ward'];?></td>
    <td><strong>
      <?=$date_surg2;?>
    </strong></td>
    <td><?=$arr1['time'];?></td>
    <td><?=$arr1['hn'];?></td>
    <td><?=$arr1['an'];?></td>
    <td><?=$arr1['ptname'];?></td>
    <td><?=$arr1['age'];?></td>
    <td><?=$arr1['ptright'];?></td>
    <td><?=$arr1['diag'];?></td>
    <td><strong>
      <?=$arr1['surg'];?>
    </strong></td>
    <td><?=$arr1['doctor'];?></td>
    <td><?=$arr1['inhalation_type'];?></td>
    <td><?=$arr1['comment'];?></td>
    <td align="center"><a href="javascript:MM_openBrWindow('set_from_edit.php?row_id=<?=$arr1['row_id'];?>','','toolbar=no,location=no,status=n o,menubar=no,scrollbars=no,resizable=yes,width=350, height=500')">แก้ไข</a></td>
    <td align="center"><a href="set_from_or_print2.php?id=<?=$arr['row_id'];?>" target="_blank">พิมพ์</a></td>
  </tr>
  
  <?  } ?>
</table>

<? } ?>