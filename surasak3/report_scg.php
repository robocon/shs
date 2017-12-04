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
-->
</style>
</head>
 
<body>
<?
for($i=1;$i<20;$i++){
	$sql = "select * from condxofyear where type_check LIKE 'กลุ่มที่ $i %'";
	//$sql = "SELECT  ptname FROM  `condxofyear` WHERE 1  AND type_check LIKE  'กลุ่มที่ 16 %' AND (  `LowRight`  !=  'ปกติ' OR  `LowLeft`  !=  'ปกติ' OR  `HighRight`  !=  'ปกติ' OR  `HighLeft`  !=  'ปกติ' )";
	$row = mysql_query($sql);
	$numrow = mysql_num_rows($row);
	$result = mysql_fetch_array($row);
	//echo "<div style='page-break-before: always'></div>";
	
	if($i==11){
		echo "<span class='ppo'>บ. พี.วาย.เมตัล งานสัญญาบำรุงรักษาเครื่องจักรชุด Clinker Production</span><br>";
	}
	elseif($i==12||$i==13){
		echo "<span class='ppo'>หจก.เอ็ม.เควี.ลำปางเซอร์วิส</span><br>";
	}
	elseif($i==14||$i==15){
		echo "<span class='ppo'>หจก.พลีบัตรลำปางรวมช่าง</span><br>";
	}
	elseif($i==16){
		echo "<span class='ppo'>บ.บ้านแพรกเอ็นจิเนียริ่ง</span><br>";
	}
	elseif($i==17){
		echo "<span class='ppo'>บ.บ้านสาเจริญกิจ</span><br>";
	}
	elseif($i==18){
		echo "<span class='ppo'>หจก.เมืองเหนือเทคนิค</span><br>";
	}
	elseif($i==19){
		echo "<span class='ppo'>หจก.ม.รวมช่างลำปาง</span><br>";
	}
	else{
		echo "<span class='ppo'>".$result['type_check']."</span><br>";
	}
	$p=0;
	$k=0;
	$z=0;
	$row = mysql_query($sql);
	echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	//echo "<td align='center'>ชื่อ-สกุล</td><td align='center'>กลุ่ม</td>";
	echo "<td align='center'>#</td><td align='center'>ชื่อ-สกุล</td><td align='center'>วันที่ตรวจ</td><td align='center'>อายุ</td><td align='center'>ผลตรวจร่างกาย</td>";
	//echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
	if($i==1){
	echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==2){
	echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==3){
	echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
	}
	elseif($i==4){
		echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td>";
	}
	elseif($i==5){
	echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
	}
	elseif($i==6){
	echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==7){
	echo "<td align='center'>การได้ยิน</td>";
	}
	elseif($i==8){
	echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
	}
	elseif($i==9){
	echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td>";
	}
	elseif($i==10){
	echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==11){
	echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==12){
	echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td>";
	}
	elseif($i==13){
	echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==14){
	echo "<td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==15){
	echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==16){
	echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==17){
	echo "<td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==18){
	echo "<td align='center'>สมรรถภาพปอด</td>";
	}
	elseif($i==19){
	echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
	}
	echo "<td align='center'>บันทึกจากแพทย์</td>";
	while($result = mysql_fetch_array($row)){
		$z++;
		$k++;
		$p++;
		$dd = explode(" ",$result['thidate']);
		$date = explode("-",$dd[0]);
		$date_ch = $date[2]."/".$date[1]."/".$date[0];
		//echo "<tr valign='top'><td>".$result['ptname']."</td><td>".$result['type_check']."</td>";
		echo "<tr valign='top'><td>".$z."</td><td>".$result['ptname']."</td><td>".$date_ch."</td><td>".$result['age']."</td>";
		if($result['general']=='ปกติ'){
			echo "<td>".$result['general']." </td>";
		}
		elseif($result['general']=='ผิดปกติ'){
			echo "<td>";//.$result['general'];
			echo " ".$result['reason_general']." </td>";
		}else{
			echo "<td>-</td>";
			}
		
		if($result['cxr']!=''){
			echo "<td>".$result['cxr']." </td>";
		}
		
		if($result['stat_ua']!=''){
			echo "<td>".$result['stat_ua']." </td>";
		}
		
		if($result['stat_cbc']!=''){
			echo "<td>".$result['stat_cbc']." </td>";
		}
		
		if($result['stat_bun']!=''){
			echo "<td>".$result['stat_bun']." </td>";
		}
		
		if($result['stat_sgot']!=''){
			echo "<td>".$result['stat_sgot']." </td>";
		}
		
		if($result['LowRight']!=''){
				echo "<td>";
				if($result['LowRight']=="ปกติ"&$result['LowLeft']=="ปกติ"&$result['HighRight']=="ปกติ"&$result['HighLeft']=="ปกติ"){ 
					echo "ปกติ";
				}
				elseif($result['LowRight']=="ไม่มีการตรวจ"){
					echo "ไม่มีการตรวจ";
				}
				elseif($result['LowRight']!="ปกติ"|$result['LowLeft']!="ปกติ"|$result['HighRight']!="ปกติ"|$result['HighLeft']!="ปกติ"){
					echo "ผิดปกติ";
				}
				echo " </td>";
		}
		if($result['stat_chest']!=''){
		echo "<td>".$result['stat_chest']." </td>";
		}
		if($result['resultlead']!=''){
		echo "<td>".$result['resultlead']." </td>";
		}
		if($result['resultcadmium']!=''){
		echo "<td>".$result['resultcadmium']." </td>";
		}
		if($result['resultchromium']!=''){
		echo "<td>".$result['resultchromium']." </td>";
		}
		if($result['resultarsenic']!=''){
		echo "<td>".$result['resultarsenic']." </td>";
		}
		if($result['resultmercury']!=''){
		echo "<td>".$result['resultmercury']." </td>";
		}
		if($result['resultcopper']!=''){
		echo "<td>".$result['resultcopper']." </td>";
		}
		if($result['resultnickel']!=''){
		echo "<td>".$result['resultnickel']." </td>";
		}
		if($result['resultantimony']!=''){
		echo "<td>".$result['resultantimony']." </td>";
		}
		
		//echo "<td>".$result['summary']." </td>";
	
		if($result['dx']!=''){
			echo "<td>".nl2br($result['dx'])." </td>";
		}else{
			echo "<td>ปกติ</td>";
		}
		echo "</tr>";
		if($i==3||$i==8){
			if($p==10){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
			echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
			echo "<td align='center'>#</td><td align='center'>ชื่อ-สกุล</td><td align='center'>วันที่ตรวจ</td><td align='center'>อายุ</td><td align='center'>ผลตรวจร่างกาย</td>";
			if($i==1){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==2){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==3){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
			}
			elseif($i==4){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td>";
			}
			elseif($i==5){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
			}
			elseif($i==6){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==7){
			echo "<td align='center'>การได้ยิน</td>";
			}
			elseif($i==8){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
			}
			elseif($i==9){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td>";
			}
			elseif($i==10){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==11){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==12){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td>";
			}
			elseif($i==13){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==14){
			echo "<td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==15){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==16){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==17){
			echo "<td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==18){
			echo "<td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==19){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			echo "<td align='center'>บันทึกจากแพทย์</td>";
			$p=0;
			}
		}elseif($i==5){
			if($p==15){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
			echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
			echo "<td align='center'>#</td><td align='center'>ชื่อ-สกุล</td><td align='center'>วันที่ตรวจ</td><td align='center'>อายุ</td><td align='center'>ผลตรวจร่างกาย</td>";
			if($i==1){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==2){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==3){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
			}
			elseif($i==4){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td>";
			}
			elseif($i==5){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
			}
			elseif($i==6){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==7){
			echo "<td align='center'>การได้ยิน</td>";
			}
			elseif($i==8){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
			}
			elseif($i==9){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td>";
			}
			elseif($i==10){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==11){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==12){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td>";
			}
			elseif($i==13){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==14){
			echo "<td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==15){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==16){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==17){
			echo "<td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==18){
			echo "<td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==19){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			echo "<td align='center'>บันทึกจากแพทย์</td>";
			$p=0;
			}
		}
		else{
			if($p==26){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
			echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
			echo "<td align='center'>#</td><td align='center'>ชื่อ-สกุล</td><td align='center'>วันที่ตรวจ</td><td align='center'>อายุ</td><td align='center'>ผลตรวจร่างกาย</td>";
			if($i==1){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==2){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==3){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
			}
			elseif($i==4){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td>";
			}
			elseif($i==5){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
			}
			elseif($i==6){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==7){
			echo "<td align='center'>การได้ยิน</td>";
			}
			elseif($i==8){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td><td align='center'>สารตะกั่วในเลือด</td><td align='center'>สารแคดเมียมในเลือด</td><td align='center'>โครเมียมในปัสสาวะ</td><td align='center'>สารหนูในปัสสาวะ</td><td align='center'>ปรอทในเลือด</td><td align='center'>ทองแดงในเลือด</td><td align='center'>นิกเกิลในปัสสาวะ</td><td align='center'>สารพลวงในปัสสาวะ</td>";
			}
			elseif($i==9){
			echo "<td align='center'>ผลUA (ปัสสาวะ)</td><td align='center'>ผลCBC (เลือด)</td><td align='center'>ไต</td><td align='center'>ตับ</td><td align='center'>การได้ยิน</td>";
			}
			elseif($i==10){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==11){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==12){
			echo "<td align='center'>เอ็กซ์เรย์</td><td align='center'>การได้ยิน</td>";
			}
			elseif($i==13){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==14){
			echo "<td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==15){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==16){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==17){
			echo "<td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==18){
			echo "<td align='center'>สมรรถภาพปอด</td>";
			}
			elseif($i==19){
			echo "<td align='center'>การได้ยิน</td><td align='center'>สมรรถภาพปอด</td>";
			}
			echo "<td align='center'>บันทึกจากแพทย์</td>";
			$p=0;
			}
		}	
		if($k==$numrow){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
		}
	}echo "</table>";
	
	
}
?>

</body>
</html>