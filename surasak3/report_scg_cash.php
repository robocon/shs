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
	echo "<span class='ppo'>".$result['type_check']."</span><br>";
	//echo "<span class='ppo'>หจก.เอ็ม.เควี.ลำปางเซอร์วิส</span><br>";
	//echo "<span class='ppo'>หจก.พลีบัตรลำปางรวมช่าง</span><br>";
	//echo "<span class='ppo'>หจก.ม.รวมช่างลำปาง</span><br>";
	//echo "<span class='ppo'>บ.บ้านแพรกเอ็นจิเนียริ่ง</span><br>";
	//echo "<span class='ppo'>บ.บ้านสาเจริญกิจ</span><br>";
	//echo "<span class='ppo'>หจก.เมืองเหนือเทคนิค</span><br>";
	//echo "<span class='ppo'>บ. พี.วาย.เมตัล งานสัญญาบำรุงรักษาเครื่องจักรชุด Clinker Production</span><br>";
	$p=0;
	$k=0;
	$z=0;
	$row = mysql_query($sql);
	$sum2=0;
	echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	//echo "<td align='center'>ชื่อ-สกุล</td><td align='center'>กลุ่ม</td>";
	echo "<td align='center'>#</td><td align='center'>ชื่อ-สกุล</td><td align='center'>วันที่ตรวจ</td>";
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
	echo "<td align='center'>ราคารวม</td>";
	$sumcxr=0;
	$sumua=0;
	$sumcbc=0;
	$sumbun=0;
	$sumsgot=0;
	$sumsound=0;
	$sumchest=0;
	$sumlead=0;
	$sumcad=0;
	$sumchro=0;
	$sumar=0;
	$summer=0;
	$sumcop=0;
	$sumnic=0;
	$sumanti=0;
	$sumall=0;
	while($result = mysql_fetch_array($row)){
		$sum=0;
		$z++;
		$k++;
		$p++;
		$dd = explode(" ",$result['thidate']);
		$date = explode("-",$dd[0]);
		$date_ch = $date[2]."/".$date[1]."/".$date[0];
		//echo "<tr valign='top'><td>".$result['ptname']."</td><td>".$result['type_check']."</td>";
		echo "<tr valign='top'><td>".$z."</td><td>".$result['ptname']."</td><td>".$date_ch."</td>";

		if($result['cxr']=='ปกติ'||$result['cxr']=='ผิดปกติ'){
			echo "<td align='right'>180</td>";
			$sum+=180;
			$sumcxr+=180;
		}else if($result['cxr']=='-'){
			echo "<td align='right'>0</td>";
			$sumcxr+=0;
		}
		
		if($result['stat_ua']=='ปกติ'||$result['stat_ua']=='ผิดปกติ'){
			echo "<td align='right'>40</td>";
			$sum+=40;
			$sumua+=40;
		}else if($result['stat_ua']=='ไม่มีการตรวจ'){
			echo "<td align='right'>0</td>";
			$sumua+=0;
		}
		
		if($result['stat_cbc']=='ปกติ'||$result['stat_cbc']=='ผิดปกติ'){
			echo "<td align='right'>50</td>";
			$sum+=50;
			$sumcbc+=50;
		}else if($result['stat_cbc']=='ไม่มีการตรวจ'){
			echo "<td align='right'>0</td>";
			$sumcbc+=0;
		}
		
		if($result['stat_bun']=='ปกติ'||$result['stat_bun']=='ผิดปกติ'){
			echo "<td align='right'>50</td>";
			$sum+=50;
			$sumbun+=50;
		}else if($result['stat_bun']=='ไม่มีการตรวจ'){
			echo "<td align='right'>0</td>";
			$sumbun+=0;
		}
		
		if($result['stat_sgot']=='ปกติ'||$result['stat_sgot']=='ผิดปกติ'){
			echo "<td align='right'>100</td>";
			$sum+= 100;
			$sumsgot+=100;
		}
		else if($result['stat_sgot']=='ไม่มีการตรวจ'){
			echo "<td align='right'>0</td>";
			$sumsgot+=0;
		}
		
		if($result['LowRight']!=''){
				echo "<td align='right'>";
				if($result['LowRight']=="ปกติ"&$result['LowLeft']=="ปกติ"&$result['HighRight']=="ปกติ"&$result['HighLeft']=="ปกติ"){ 
					echo "40";
					$sum+=40;
					$sumsound+=40;
				}
				elseif($result['LowRight']=="ไม่มีการตรวจ"){
					echo "0";
					$sum+=0;
					$sumsound+=0;
				}
				elseif($result['LowRight']!="ปกติ"|$result['LowLeft']!="ปกติ"|$result['HighRight']!="ปกติ"|$result['HighLeft']!="ปกติ"){
					echo "40";
					$sum+=40;
					$sumsound+=40;
				}
				echo " </td>";
		}
		if($result['stat_chest']=='ปกติ'||$result['stat_chest']=='ผิดปกติ'){
		echo "<td align='right'>40</td>";
		$sum+=40;
		$sumchest+=40;
		}
		else if($result['stat_chest']=='ไม่มีการตรวจ'){
			echo "<td align='right'>0</td>";
			$sumchest+=0;
		}
		if($result['resultlead']!=''){
		echo "<td align='right'>120</td>";
		$sum+=120;
		$sumlead+=120;
		}
		if($result['resultcadmium']!=''){
		echo "<td align='right'>200</td>";
		$sum+=200;
		$sumcad+=200;
		}
		if($result['resultchromium']!=''){
		echo "<td align='right'>200</td>";
		$sum+= 200;
		$sumchro+=200;
		}
		if($result['resultarsenic']!=''){
		echo "<td align='right'>200</td>";
		$sum+=200;
		$sumar+=200;
		}
		if($result['resultmercury']!=''){
		echo "<td align='right'>200</td>";
		$sum+=200;
		$summer+=200;
		}
		if($result['resultcopper']!=''){
		echo "<td align='right'>200</td>";
		$sum+=200;
		$sumcop+=200;
		}
		if($result['resultnickel']!=''){
		echo "<td align='right'>200</td>";
		$sum+=200;
		$sumnic+=200;
		}
		if($result['resultantimony']!=''){
		echo "<td align='right'>200</td>";
		$sum+=200;
		$sumanti+=200;
		}
		echo "<td align='right'>".$sum." </td>";

		echo "</tr>";
		if($k==$numrow){
			echo "<td colspan='3' align='center'>รวม</td>";
			if($i==1){
			echo "<td align='right'>".number_format($sumcxr)."</td>
			<td align='right'>".number_format($sumsgot)."</td>
			<td align='right'>".number_format($sumsound)."</td>
			<td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==2){
			echo "<td align='right'>".number_format($sumcxr)."</td>
			<td align='right'>".number_format($sumua)."</td>
			<td align='right'>".number_format($sumcbc)."</td>
			<td align='right'>".number_format($sumbun)."</td>
			<td align='right'>".number_format($sumsgot)."</td>
			<td align='right'>".number_format($sumsound)."</td>
			<td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==3){
			echo "<td align='right'>".number_format($sumcxr)."</td>
			<td align='right'>".number_format($sumua)."</td>
			<td align='right'>".number_format($sumcbc)."</td>
			<td align='right'>".number_format($sumbun)."</td>
			<td align='right'>".number_format($sumsgot)."</td>
			<td align='right'>".number_format($sumsound)."</td>
			<td align='right'>".number_format($sumchest)."</td>
			<td align='right'>".number_format($sumlead)."</td>
			<td align='right'>".number_format($sumcad)."</td>
			<td align='right'>".number_format($sumchro)."</td>
			<td align='right'>".number_format($sumar)."</td>
			<td align='right'>".number_format($summer)."</td>
			<td align='right'>".number_format($sumcop)."</td>
			<td align='right'>".number_format($sumnic)."</td>
			<td align='right'>".number_format($sumanti)."</td>";
			}
			elseif($i==4){
			echo "<td align='right'>".number_format($sumua)."</td>
			<td align='right'>".number_format($sumcbc)."</td>
			<td align='right'>".number_format($sumbun)."</td>
			<td align='right'>".number_format($sumsgot)."</td>";
			}
			elseif($i==5){
			echo "<td align='right'>".number_format($sumua)."</td>
			<td align='right'>".number_format($sumcbc)."</td>
			<td align='right'>".number_format($sumbun)."</td>
			<td align='right'>".number_format($sumsgot)."</td>
			<td align='right'>".number_format($sumlead)."</td>
			<td align='right'>".number_format($sumcad)."</td>
			<td align='right'>".number_format($sumchro)."</td>
			<td align='right'>".number_format($sumar)."</td>
			<td align='right'>".number_format($summer)."</td>
			<td align='right'>".number_format($sumcop)."</td>
			<td align='right'>".number_format($sumnic)."</td>
			<td align='right'>".number_format($sumanti)."</td>";
			}
			elseif($i==6){
			echo "<td align='right'>".number_format($sumcxr)."</td>
			<td align='right'>".number_format($sumsound)."</td>
			<td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==7){
			echo "<td align='right'>".number_format($sumsound)."</td>";
			}
			elseif($i==8){
			echo "<td align='right'>$sumua</td><td align='right'>$sumcbc</td><td align='right'>$sumbun</td><td align='right'>$sumsgot</td><td align='right'>$sumsound</td><td align='right'>$sumlead</td><td align='right'>$sumcad</td><td align='right'>$sumchro</td><td align='right'>$sumar</td><td align='right'>$summer</td><td align='right'>$sumcop</td><td align='right'>$sumnic</td><td align='right'>$sumanti</td>";
			}
			elseif($i==9){
			echo "<td align='right'>".number_format($sumua)."</td>
			<td align='right'>".number_format($sumcbc)."</td>
			<td align='right'>".number_format($sumbun)."</td>
			<td align='right'>".number_format($sumsgot)."</td>
			<td align='right'>".number_format($sumsound)."</td>";
			}
			elseif($i==10){
			echo "<td align='right'>".number_format($sumcxr)."</td><td align='right'>".number_format($sumsound)."</td><td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==11){
			echo "<td align='right'>".number_format($sumsound)."</td><td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==12){
			echo "<td align='right'>".number_format($sumcxr)."</td><td align='right'>".number_format($sumsound)."</td>";
			}
			elseif($i==13){
			echo "<td align='right'>".number_format($sumsound)."</td><td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==14){
			echo "<td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==15){
			echo "<td align='right'>".number_format($sumsound)."</td><td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==16){
			echo "<td align='right'>".number_format($sumsound)."</td><td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==17){
			echo "<td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==18){
			echo "<td align='right'>".number_format($sumchest)."</td>";
			}
			elseif($i==19){
			echo "<td align='right'>".number_format($sumsound)."</td><td align='right'>".number_format($sumchest)."</td>";
			}
			$sumall=$sumcxr+$sumua+$sumcbc+$sumbun+$sumsgot+$sumsound+$sumchest+$sumlead+$sumcad+$sumchro+$sumar+$summer+$sumcop+$sumnic+$sumanti;
			echo "<td align='right'>".number_format($sumall)."</td>";
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
		}
		if($p==50){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
			echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
			echo "<td align='center'>#</td><td align='center'>ชื่อ-สกุล</td><td align='center'>วันที่ตรวจ</td>";
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
			echo "<td align='center'>ราคารวม</td>";
			$p=0;
		}		
		
	}echo "</table>";
	
	
}
?>

</body>
</html>