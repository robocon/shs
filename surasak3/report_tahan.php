<?php
    session_start();
	include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.ppo {
	font-family: "TH SarabunPSK";
	font-size:14px;
}
.ppo1 {
	font-family: "TH SarabunPSK";
	font-size:20px;
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
</head>
 
<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form id="form1" name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>">
<table width="42%" border="0" align="center">
  <tr>
    <td align="center">รายงานการตรวจร่างกายประจำปี ทบ.</td>
  </tr>
  <tr>
    <td align="center">
         
&nbsp;ปี :
<select name="year">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>
    </td>
    </tr>
  <tr>
    <td align="center"><input type="submit" name="button" id="button" value="ตกลง" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</div>
<?
if(isset($_POST['button'])){
	//$arrcamp = array('พลเรือน','ร.17 พัน2','มณฑลทหารบกที่32','ร.พ.ค่ายสุรศักดิ์มนตรี','ช.พัน4','ร้อยฝึกรบพิเศษประตูผา','บก.มทบ.32','กกพ.มทบ.32','กขว.,ฝผท.มทบ.32','กยก.มทบ.32','กกบ.มทบ.32','กกร.มทบ.32','ฝคง.มทบ.32','ฝกง.มทบ.32','ฝสก.มทบ.32','ฝปบฝ.มทบ.32','ผพธ.มทบ.32','อก.ศาล มทบ.32','ฝสวส.มทบ.32','ฝธน.มทบ.32','อศจ.มทบ.32','ร้อย.มทบ.32','สขส.มทบ.32','รจ.มทบ.32','ผยย.มทบ.32','สส.มทบ.32','ฝสห.มทบ.32','ร้อย.สห.มทบ.32','มว.ดย.มทบ.32','ผสพ.มทบ.32','สรรพกำลัง มทบ.32','ศฝ.นศท.มทบ.32','ศาล.มทบ.32','ศูนย์โทรศัพท์ มทบ.32','ผปบ.มทบ.32','สัสดีจังหวัดลำปาง','มว.คลัง สป.๓ฯ','กรม ทพ.33','หน่วยทหารอื่นๆ','อบต.นายาง');
	$arrcamp = array();
	$sql3 = "select distinct(camp) as name from condxofyear_so where status_dr = 'Y' order by camp";
	$row3 = mysql_query($sql3);
	while($result3 = mysql_fetch_array($row3)){
		array_push($arrcamp,$result3['name']);        
	}
	?>
    <table class='ppo1' border="1" style="border-collapse:collapse" align="center">
    <tr><td align="center">หน่วย</td><td align="center">จำนวน</td></tr>
    <?
    for($m=0;$m<count($arrcamp);$m++){
		$sql2 = "select count(*) as sum from condxofyear_so where status_dr='Y' and camp like '%".$arrcamp[$m]."%' and yearcheck='".$_POST['year']."'";
		$row2 = mysql_query($sql2);
		list($sum) = mysql_fetch_array($row2);
	?>
   		<tr><td><a target="_blank" href="report_tahan.php?click=<?=$arrcamp[$m]?>&y=<?=$_POST['year']?>"><?=$arrcamp[$m]?></a></td><td align="center"><?=$sum?></td></tr>
    <?
        }
    ?>
</table>
	<?
}
elseif(isset($_GET['click'])){
	echo "<span class='ppo'>".$_GET['click']."</span><br>";
	echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	echo "<td align='center'>#</td><td align='center'>HN</td><td align='center'>ชื่อ-สกุล</td><td align='center'>อายุ</td><td align='center'>น้ำหนัก</td><td align='center'>ส่วนสูง</td><td align='center'>รอบเอว</td><td align='center'>T</td><td align='center'>P</td><td align='center'>BMI</td><td align='center'>BP</td><td align='center'>ผลตรวจร่างกายทั่วไป</td><td align='center'>UA</td><td align='center'>CBC</td><td align='center'>เบาหวาน</td><td align='center'>ไขมัน</td><td align='center'>ตับ</td><td align='center'>ไต</td><td align='center'>เก๊าท์</td><td align='center'>เอ๊กซเรย์</td><td align='center'>แพทย์</td><td align='center'>สรุปผลการตรวจ</td><td align='center'>Diag</td><td align='center'>บันทึกจากแพทย์</td>";
	$sql2 = "select * from condxofyear_so where status_dr='Y' and camp like '%".$_GET['click']."%' and yearcheck='".$_GET['y']."' order by hn asc";
	$row2 = mysql_query($sql2);
	$numrow = mysql_num_rows($row2);
	$z=0;
	$p=0;
	while($result = mysql_fetch_array($row2)){
		$p++;
		$z++;
		echo "<tr valign='top'><td>".$z."</td><td>".$result['hn']."</td><td>".$result['ptname']."</td><td>".$result['age']."</td><td>".$result['weight']."</td><td>".$result['height']."</td><td>".$result['round_']."</td><td>".$result['temperature']."</td><td>".$result['pause']."</td><td>".$result['bmi']."</td><td>".$result['bp1']."/".$result['bp2']."</td><td>".$result['general']."<br>".$result['reason_general']."</td><td>".$result['stat_ua']."</td><td>".$result['stat_cbc']."</td>";
		if($result['stat_bs']!=""){//เบาหวาน
			if($result['stat_bs']=="ผิดปกติ"){
				echo "<td>ผิดปกติ</td>";
			}else{
				echo "<td>ปกติ</td>";
			}			
		}
		else{
				echo "<td>-</td>";
		}
		if($result['stat_chol']!=""||$result['stat_tg']!=""){//ไขมัน
			if($result['stat_chol']=="ผิดปกติ"||$result['stat_tg']=="ผิดปกติ"){
				echo "<td>ผิดปกติ</td>";
			}else{
				echo "<td>ปกติ</td>";
			}
		}
		else{
				echo "<td>-</td>";
		}
		if($result['stat_sgot']!=""||$result['stat_sgpt']!=""||$result['stat_alk']!=""){//ตับ
			if($result['stat_sgot']=="ผิดปกติ"||$result['stat_sgpt']=="ผิดปกติ"||$result['stat_alk']=="ผิดปกติ"){
				echo "<td>ผิดปกติ</td>";
			}else{
				echo "<td>ปกติ</td>";
			}
		}else{
				echo "<td>-</td>";
		}
		if($result['stat_bun']!=""||$result['stat_cr']!=""){//ไต
			if($result['stat_bun']=="ผิดปกติ"||$result['stat_cr']=="ผิดปกติ"){
				echo "<td>ผิดปกติ</td>";
			}else{
				echo "<td>ปกติ</td>";
			}
		}else{
				echo "<td>-</td>";
		}
		if($result['stat_uric']!=""){//เก๊าท์
			if($result['stat_uric']=="ผิดปกติ"){
				echo "<td>ผิดปกติ</td>";
			}else{
				echo "<td>ปกติ</td>";
			}			
		}
		else{
				echo "<td>-</td>";
		}
		echo "<td>".$result['cxr']."</td><td>".$result['doctor']." </td><td>".$result['summary']." </td><td>".$result['diag']." </td><td>".nl2br($result['dx'])." </td>";
		echo "</tr>";
		if($p==18){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
			echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	echo "<td align='center'>#</td><td align='center'>HN</td><td align='center'>ชื่อ-สกุล</td><td align='center'>อายุ</td><td align='center'>น้ำหนัก</td><td align='center'>ส่วนสูง</td><td align='center'>รอบเอว</td><td align='center'>T</td><td align='center'>P</td><td align='center'>BMI</td><td align='center'>BP</td><td align='center'>ผลตรวจร่างกายทั่วไป</td><td align='center'>UA</td><td align='center'>CBC</td><td align='center'>เบาหวาน</td><td align='center'>ไขมัน</td><td align='center'>ตับ</td><td align='center'>ไต</td><td align='center'>เก๊าท์</td><td align='center'>เอ๊กซเรย์</td><td align='center'>แพทย์</td><td align='center'>สรุปผลการตรวจ</td><td align='center'>Diag</td><td align='center'>บันทึกจากแพทย์</td>";
			$p=0;
		}		
	}
	echo "</table>";
	//}
}
?>

</body>
</html>