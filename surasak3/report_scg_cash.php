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
	$sql = "select * from condxofyear where type_check LIKE '�������� $i %'";
	//$sql = "SELECT  ptname FROM  `condxofyear` WHERE 1  AND type_check LIKE  '�������� 16 %' AND (  `LowRight`  !=  '����' OR  `LowLeft`  !=  '����' OR  `HighRight`  !=  '����' OR  `HighLeft`  !=  '����' )";
	$row = mysql_query($sql);
	$numrow = mysql_num_rows($row);
	$result = mysql_fetch_array($row);
	//echo "<div style='page-break-before: always'></div>";
	echo "<span class='ppo'>".$result['type_check']."</span><br>";
	//echo "<span class='ppo'>˨�.����.���.�ӻҧ�������</span><br>";
	//echo "<span class='ppo'>˨�.��պѵ��ӻҧ�����ҧ</span><br>";
	//echo "<span class='ppo'>˨�.�.�����ҧ�ӻҧ</span><br>";
	//echo "<span class='ppo'>�.��ҹ�á��繨�������</span><br>";
	//echo "<span class='ppo'>�.��ҹ����ԭ�Ԩ</span><br>";
	//echo "<span class='ppo'>˨�.���ͧ�˹��෤�Ԥ</span><br>";
	//echo "<span class='ppo'>�. ��.���.����� �ҹ�ѭ�Һ��ا�ѡ������ͧ�ѡêش Clinker Production</span><br>";
	$p=0;
	$k=0;
	$z=0;
	$row = mysql_query($sql);
	$sum2=0;
	echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	//echo "<td align='center'>����-ʡ��</td><td align='center'>�����</td>";
	echo "<td align='center'>#</td><td align='center'>����-ʡ��</td><td align='center'>�ѹ����Ǩ</td>";
	//echo "<td align='center'>��硫�����</td><td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td><td align='center'>��õС�������ʹ</td><td align='center'>���ᤴ���������ʹ</td><td align='center'>�������㹻������</td><td align='center'>���˹�㹻������</td><td align='center'>��ͷ����ʹ</td><td align='center'>�ͧᴧ����ʹ</td><td align='center'>�ԡ���㹻������</td><td align='center'>��þ�ǧ㹻������</td>";
	if($i==1){
	echo "<td align='center'>��硫�����</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==2){
	echo "<td align='center'>��硫�����</td><td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==3){
	echo "<td align='center'>��硫�����</td><td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td><td align='center'>��õС�������ʹ</td><td align='center'>���ᤴ���������ʹ</td><td align='center'>�������㹻������</td><td align='center'>���˹�㹻������</td><td align='center'>��ͷ����ʹ</td><td align='center'>�ͧᴧ����ʹ</td><td align='center'>�ԡ���㹻������</td><td align='center'>��þ�ǧ㹻������</td>";
	}
	elseif($i==4){
		echo "<td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td>";
	}
	elseif($i==5){
	echo "<td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>��õС�������ʹ</td><td align='center'>���ᤴ���������ʹ</td><td align='center'>�������㹻������</td><td align='center'>���˹�㹻������</td><td align='center'>��ͷ����ʹ</td><td align='center'>�ͧᴧ����ʹ</td><td align='center'>�ԡ���㹻������</td><td align='center'>��þ�ǧ㹻������</td>";
	}
	elseif($i==6){
	echo "<td align='center'>��硫�����</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==7){
	echo "<td align='center'>������Թ</td>";
	}
	elseif($i==8){
	echo "<td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td><td align='center'>��õС�������ʹ</td><td align='center'>���ᤴ���������ʹ</td><td align='center'>�������㹻������</td><td align='center'>���˹�㹻������</td><td align='center'>��ͷ����ʹ</td><td align='center'>�ͧᴧ����ʹ</td><td align='center'>�ԡ���㹻������</td><td align='center'>��þ�ǧ㹻������</td>";
	}
	elseif($i==9){
	echo "<td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td>";
	}
	elseif($i==10){
	echo "<td align='center'>��硫�����</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==11){
	echo "<td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==12){
	echo "<td align='center'>��硫�����</td><td align='center'>������Թ</td>";
	}
	elseif($i==13){
	echo "<td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==14){
	echo "<td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==15){
	echo "<td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==16){
	echo "<td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==17){
	echo "<td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==18){
	echo "<td align='center'>���ö�Ҿ�ʹ</td>";
	}
	elseif($i==19){
	echo "<td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
	}
	echo "<td align='center'>�Ҥ����</td>";
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

		if($result['cxr']=='����'||$result['cxr']=='�Դ����'){
			echo "<td align='right'>180</td>";
			$sum+=180;
			$sumcxr+=180;
		}else if($result['cxr']=='-'){
			echo "<td align='right'>0</td>";
			$sumcxr+=0;
		}
		
		if($result['stat_ua']=='����'||$result['stat_ua']=='�Դ����'){
			echo "<td align='right'>40</td>";
			$sum+=40;
			$sumua+=40;
		}else if($result['stat_ua']=='����ա�õ�Ǩ'){
			echo "<td align='right'>0</td>";
			$sumua+=0;
		}
		
		if($result['stat_cbc']=='����'||$result['stat_cbc']=='�Դ����'){
			echo "<td align='right'>50</td>";
			$sum+=50;
			$sumcbc+=50;
		}else if($result['stat_cbc']=='����ա�õ�Ǩ'){
			echo "<td align='right'>0</td>";
			$sumcbc+=0;
		}
		
		if($result['stat_bun']=='����'||$result['stat_bun']=='�Դ����'){
			echo "<td align='right'>50</td>";
			$sum+=50;
			$sumbun+=50;
		}else if($result['stat_bun']=='����ա�õ�Ǩ'){
			echo "<td align='right'>0</td>";
			$sumbun+=0;
		}
		
		if($result['stat_sgot']=='����'||$result['stat_sgot']=='�Դ����'){
			echo "<td align='right'>100</td>";
			$sum+= 100;
			$sumsgot+=100;
		}
		else if($result['stat_sgot']=='����ա�õ�Ǩ'){
			echo "<td align='right'>0</td>";
			$sumsgot+=0;
		}
		
		if($result['LowRight']!=''){
				echo "<td align='right'>";
				if($result['LowRight']=="����"&$result['LowLeft']=="����"&$result['HighRight']=="����"&$result['HighLeft']=="����"){ 
					echo "40";
					$sum+=40;
					$sumsound+=40;
				}
				elseif($result['LowRight']=="����ա�õ�Ǩ"){
					echo "0";
					$sum+=0;
					$sumsound+=0;
				}
				elseif($result['LowRight']!="����"|$result['LowLeft']!="����"|$result['HighRight']!="����"|$result['HighLeft']!="����"){
					echo "40";
					$sum+=40;
					$sumsound+=40;
				}
				echo " </td>";
		}
		if($result['stat_chest']=='����'||$result['stat_chest']=='�Դ����'){
		echo "<td align='right'>40</td>";
		$sum+=40;
		$sumchest+=40;
		}
		else if($result['stat_chest']=='����ա�õ�Ǩ'){
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
			echo "<td colspan='3' align='center'>���</td>";
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
			echo "<td align='center'>#</td><td align='center'>����-ʡ��</td><td align='center'>�ѹ����Ǩ</td>";
			if($i==1){
			echo "<td align='center'>��硫�����</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==2){
			echo "<td align='center'>��硫�����</td><td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==3){
			echo "<td align='center'>��硫�����</td><td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td><td align='center'>��õС�������ʹ</td><td align='center'>���ᤴ���������ʹ</td><td align='center'>�������㹻������</td><td align='center'>���˹�㹻������</td><td align='center'>��ͷ����ʹ</td><td align='center'>�ͧᴧ����ʹ</td><td align='center'>�ԡ���㹻������</td><td align='center'>��þ�ǧ㹻������</td>";
			}
			elseif($i==4){
			echo "<td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td>";
			}
			elseif($i==5){
			echo "<td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>��õС�������ʹ</td><td align='center'>���ᤴ���������ʹ</td><td align='center'>�������㹻������</td><td align='center'>���˹�㹻������</td><td align='center'>��ͷ����ʹ</td><td align='center'>�ͧᴧ����ʹ</td><td align='center'>�ԡ���㹻������</td><td align='center'>��þ�ǧ㹻������</td>";
			}
			elseif($i==6){
			echo "<td align='center'>��硫�����</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==7){
			echo "<td align='center'>������Թ</td>";
			}
			elseif($i==8){
			echo "<td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td><td align='center'>��õС�������ʹ</td><td align='center'>���ᤴ���������ʹ</td><td align='center'>�������㹻������</td><td align='center'>���˹�㹻������</td><td align='center'>��ͷ����ʹ</td><td align='center'>�ͧᴧ����ʹ</td><td align='center'>�ԡ���㹻������</td><td align='center'>��þ�ǧ㹻������</td>";
			}
			elseif($i==9){
			echo "<td align='center'>��UA (�������)</td><td align='center'>��CBC (���ʹ)</td><td align='center'>�</td><td align='center'>�Ѻ</td><td align='center'>������Թ</td>";
			}
			elseif($i==10){
			echo "<td align='center'>��硫�����</td><td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==11){
			echo "<td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==12){
			echo "<td align='center'>��硫�����</td><td align='center'>������Թ</td>";
			}
			elseif($i==13){
			echo "<td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==14){
			echo "<td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==15){
			echo "<td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==16){
			echo "<td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==17){
			echo "<td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==18){
			echo "<td align='center'>���ö�Ҿ�ʹ</td>";
			}
			elseif($i==19){
			echo "<td align='center'>������Թ</td><td align='center'>���ö�Ҿ�ʹ</td>";
			}
			echo "<td align='center'>�Ҥ����</td>";
			$p=0;
		}		
		
	}echo "</table>";
	
	
}
?>

</body>
</html>