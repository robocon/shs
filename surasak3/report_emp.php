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
    <td align="center">รายงานการตรวจร่างกายประจำปีลูกจ้าง</td>
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
	
	//echo "<span class='ppo'>".$_GET['click']."</span><br>";
	echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	echo "<td align='center'>#</td>
	<td align='center'>HN</td>
	<td align='center'>ชื่อ-สกุล</td>
	<td align='center'>อายุ</td>
	<td align='center'>นน.</td>
	<td align='center'>สส.</td>
	<td align='center'>BMI</td>
	<td align='center'>BP</td>
	<td align='center'>ร่างกาย</td>
	<td align='center'>UA</td>
	<td align='center'>CBC</td>
	<td align='center'>CXR</td>
	<td align='center' colspan='3'>HB</td>
	<td align='center'>AST</td>
	<td align='center'>ALT</td>
	<td align='center'>ALK</td>
	<td align='center'>การได้ยิน</td>
	<td align='center'>สายตา</td>
	<td align='center'>ปอด</td>
	<td align='center'>ฟัน</td>
	<td align='center'>Pap</td>
	<td align='center'>BS</td>
	<td align='center'>CHOL</td>
	<td align='center'>Uric</td>
	<td align='center'>BUN</td>
	<td align='center'>Cr</td>
	<td align='center'>แพทย์</td>";
	$sql2 = "select * from chk_mouth where yearchk='".$_POST['year']."' order by hn asc";
	$row2 = mysql_query($sql2);
	$numrow = mysql_num_rows($row2);
	$z=0;
	$p=0;
	while($result = mysql_fetch_array($row2)){
		$p++;
		$z++;
		
		$sql3 = "select * from condxofyear_emp where  hn='".$result['hn']."' and yearcheck='".$_POST['year']."' order by row_id desc";
		$row3 = mysql_query($sql3);
		if(mysql_num_rows($row3)>0){
			$result3 = mysql_fetch_array($row3);
		}else{
			$sql4 = "select * from condxofyear_so where hn='".$result['hn']."' and yearchk ='".substr($_POST['year'],2,2)."' order by row_id desc ";
			$row4 = mysql_query($sql4);
			if(mysql_num_rows($row4)>0){
				$result3 = mysql_fetch_array($row4);
			}else{
				$sql5 = "select * from dxofyear where hn='".$result['hn']."' and yearchk ='".substr($_POST['year'],2,2)."' order by row_id desc ";
				$row5 = mysql_query($sql5);
				$result3 = mysql_fetch_array($row5);
			}
		}
		
		$select6 = "select * from chk_hb where hn = '".$result['hn']."' ";
		$row6 = mysql_query($select6);
		$result6 = mysql_fetch_array($row6);
		
		$select7 = "select * from chk_pap where hn = '".$result['hn']."' ";
		$row7 = mysql_query($select7);
		$result7 = mysql_fetch_array($row7);
		
		$select8 = "select * from chk_eye where hn = '".$result['hn']."' ";
		$row8 = mysql_query($select8);
		$result8 = mysql_fetch_array($row8);
		

		
		$select10 = "select * from chk_hear where hn = '".$result['hn']."' ";
		$row10 = mysql_query($select10);
		$result10 = mysql_fetch_array($row10);
		
		$select11 = "select * from chk_chest where hn = '".$result['hn']."' ";
		$row11 = mysql_query($select11);
		$result11 = mysql_fetch_array($row11);
		$stat_mouth="";
		 if($result['stat']!=''){ $stat_mouth.=$result['stat'];}
         if($result['stat2']!=''){ $stat_mouth.=",".$result['stat2'];}
         if($result['stat3']!=''){ $stat_mouth.=",".$result['stat3'];}
         if($result['stat4']!=''){ $stat_mouth.=",".$result['stat4'];}
		 
		//$stat_mouth=$result['stat']." ".$result['stat2']." ".$result['stat3']." ".$result['stat4'];
		//$stat_mouth=str_replace(" ",",",$stat_mouth);
		echo "<tr valign='top'><td>".$z."</td><td>".$result['hn']."</td><td>".$result['ptname']."</td><td>".$result['age']."</td><td>".$result3['weight']."</td><td>".$result3['height']."</td><td>".$result3['bmi']."</td><td>".$result3['bp1']."/".$result3['bp2']."</td><td>".$result3['general']."<br>".$result3['reason_general']."</td><td>".$result3['stat_ua']."</td><td>".$result3['stat_cbc']."</td><td>".$result3['cxr']."</td><td>".$result6['hbsag']."</td><td>".$result6['hbsab']."</td><td>".$result6['hbcab']."</td><td>".$result3['stat_sgot']."</td><td>".$result3['stat_sgpt']."</td><td>".$result3['stat_alk']."</td><td>".$result10['Lowright']."</td><td>".$result8['stat_eye']."</td><td>".$result11['reason']."</td><td>".$stat_mouth."</td><td>".$result7['stat']."</td>";
		if($result3['stat_bs']!=""){//เบาหวาน
				echo "<td>".$result3['stat_bs']."</td>";	
		}
		else{
				echo "<td></td>";
		}
		
		/*if($result['stat_chol']!=""||$result['stat_tg']!=""){//ไขมัน
			if($result['stat_chol']=="ผิดปกติ"||$result['stat_tg']=="ผิดปกติ"){
				echo "<td>ผิดปกติ</td>";
			}else{
				echo "<td>ปกติ</td>";
			}
		}
		else{
				echo "<td>-</td>";
		}*/
		echo "<td>".$result3['stat_chol']."</td><td>".$result3['stat_uric']."</td><td>".$result3['stat_bun']."</td><td>".$result3['stat_cr']."</td>";
		
		/*if($result['stat_sgot']!=""||$result['stat_sgpt']!=""||$result['stat_alk']!=""){//ตับ
			if($result['stat_sgot']=="ผิดปกติ"||$result['stat_sgpt']=="ผิดปกติ"||$result['stat_alk']=="ผิดปกติ"){
				echo "<td>ผิดปกติ</td>";
			}else{
				echo "<td>ปกติ</td>";
			}
		}else{
				echo "<td>-</td>";
		}*/
		/*if($result['stat_bun']!=""||$result['stat_cr']!=""){//ไต
			if($result['stat_bun']=="ผิดปกติ"||$result['stat_cr']=="ผิดปกติ"){
				echo "<td>ผิดปกติ</td>";
			}else{
				echo "<td>ปกติ</td>";
			}
		}else{
				echo "<td>-</td>";
		}*/
		/*if($result['stat_uric']!=""){//เก๊าท์
			if($result['stat_uric']=="ผิดปกติ"){
				echo "<td>ผิดปกติ</td>";
			}else{
				echo "<td>ปกติ</td>";
			}			
		}
		else{
				echo "<td>-</td>";
		}*/
		echo "<td>".$result3['doctor']." </td>";
		echo "</tr>";
		if($p==18){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
			echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	echo "<td align='center'>#</td>
	<td align='center'>HN</td>
	<td align='center'>ชื่อ-สกุล</td>
	<td align='center'>อายุ</td>
	<td align='center'>นน.</td>
	<td align='center'>สส.</td>
	<td align='center'>BMI</td>
	<td align='center'>BP</td>
	<td align='center'>ร่างกาย</td>
	<td align='center'>UA</td>
	<td align='center'>CBC</td>
	<td align='center'>CXR</td>
	<td align='center' colspan='3'>HB</td>
	<td align='center'>AST</td>
	<td align='center'>ALT</td>
	<td align='center'>ALK</td>
	<td align='center'>การได้ยิน</td>
	<td align='center'>สายตา</td>
	<td align='center'>ปอด</td>
	<td align='center'>ฟัน</td>
	<td align='center'>Pap</td>
	<td align='center'>BS</td>
	<td align='center'>CHOL</td>
	<td align='center'>Uric</td>
	<td align='center'>BUN</td>
	<td align='center'>Cr</td>
	<td align='center'>แพทย์</td>";
			$p=0;
		}		
	}
	echo "</table>";
	//}
}
?>

</body>
</html>