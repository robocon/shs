<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
$yrmonth="$thyear-$month";

$sql="CREATE TEMPORARY TABLE ipgroup SELECT b.icd10, a.date, a.dcdate, a.days, a.an, a.result, a.camp, a.goup
FROM ipcard AS a, diag AS b WHERE a.an = b.an   AND b.type = 'PRINCIPLE' AND a.date LIKE '$yrmonth%' 
ORDER BY `b`.`icd10` ASC";
$query = mysql_query($sql) or die("Query failed,ipgroup");
$numrows=mysql_num_rows($query);

?>
<p align="center"><strong>รายงานจำนวนผู้ป่วยในจำแนกตามสาเหตุป่วย ( รง.ผสต.2 )<br>
  หน่วยงาน   โรงพยาบาลค่ายสุรศักดิ์มนตรี <br>
  ประจำเดือน <?=$mon;?> &nbsp;ปี <?=$thyear;?></strong></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr align="center">
    <td width="3%" rowspan="2"><strong>ลำดับ</strong></td>
    <td width="19%" rowspan="2"><strong>ประเภทบุคคล</strong></td>
    <td width="14%" rowspan="2"><strong>รหัสโรคที่ 1</strong></td>
    <td width="14%" rowspan="2"><strong>รหัสโรคที่ 2</strong></td>
    <td colspan="3"><strong>รับ</strong></td>
    <td colspan="4"><strong>จำหน่าย</strong></td>
  </tr>
  <tr align="center">
    <td width="7%"><strong>ยกมา</strong></td>
    <td width="9%"><strong>รับใหม่</strong></td>
    <td width="5%"><strong>รวม</strong></td>
    <td width="12%"><strong>ปลดพิการ</strong></td>
    <td width="5%"><strong>ตาย</strong></td>
    <td width="6%"><strong>อื่นๆ</strong></td>
    <td width="6%"><strong>รวม</strong></td>
  </tr>
<?
	//------------ ก.1 นายทหารประจำการ ------------//
    $sql1 = "SELECT *, count(icd10) as icount  FROM ipgroup where goup like 'G11%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql1."<br>";
	$query1 = mysql_query($sql1) or die("Query failed G11");
	$numrows1=mysql_num_rows($query1);
	//echo "--->".$numrows1."<br>";
	$num1=0;	
	while($rows1=mysql_fetch_array($query1)){
    $num1++;
	$goup=substr($rows1["goup"],4,3);
	$icount1=$rows1["icount"];
	$icd10=$rows1["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G11%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved1=0;
    $dead1=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved1++;
		}
		if($rows["result"]=="9 Dead"){
			$dead1++;
		}	
	}	
	$sumdc1=$improved1+$dead1;
	$sumcount1=$icount1;
?>  
  <tr>
    <td align="center"><?=$num1;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows1["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="left">&nbsp;</td>
    <td align="center"><?=$icount1;?></td>
    <td align="center"><?=$sumcount1;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead1==0){ echo "-";}else{ echo $dead1;}?></td>
    <td align="center"><? if($improved1==0){ echo "-";}else{ echo $improved1;}?></td>
    <td align="center"><?=$sumdc1;?></td>
  </tr>
<?
	}  //close while rows1
	
	//------------ ก.2 นายสิบ พลทหารประจำการ ------------//
    $sql2= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G12%' GROUP BY icd10  ORDER BY goup asc, icd10 asc"; 
	//echo $sql2."<br>";
	$query2 = mysql_query($sql2) or die("Query failed G12");
	$numrows2=mysql_num_rows($query2);
	//echo "--->".$numrows2."<br>";
	if(!empty($numrows2)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	$num2=0;
	while($rows2=mysql_fetch_array($query2)){
    $num2++;
	$goup=substr($rows2["goup"],4,3);
	$icount2=$rows2["icount"];
	$icd10=$rows2["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G12%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 101");
	$improved2=0;
    $dead2=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved2++;
		}
		if($rows["result"]=="9 Dead"){
			$dead2++;
		}	
	}		
	$sumdc2=$improved2+$dead2;	
	$sumcount2=$icount2;
?>   
  <tr>
    <td align="center"><?=$num2;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows2["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount2;?></td>
    <td align="center"><?=$sumcount2;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead2==0){ echo "-";}else{ echo $dead2;}?></td>
    <td align="center"><? if($improved2==0){ echo "-";}else{ echo $improved2;}?></td>
    <td align="center"><?=$sumdc2;?></td>
  </tr>
<?
		}  //close while rows2
	}  //close numrows2
	
	//------------ ก.3 ข้าราชการกลาโหมพลเรือน ------------//
    $sql3= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G13%' GROUP BY icd10  ORDER BY goup asc, icd10 asc"; 
	//echo $sql3."<br>";
	$query3 = mysql_query($sql3) or die("Query failed G13");
	$numrows3=mysql_num_rows($query3);
	//echo "--->".$numrows3."<br>";
	$num3=0;
	if(!empty($numrows3)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows3=mysql_fetch_array($query3)){
    $num3++;
	$goup=substr($rows3["goup"],4,3);
	$icount3=$rows3["icount"];
	$icd10=$rows3["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G13%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 152");
	$improved3=0;
    $dead3=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved3++;
		}
		if($rows["result"]=="9 Dead"){
			$dead3++;
		}	
	}	
	$sumdc3=$improved3+$dead3;	
	$sumcount3=$icount3;
?>   
  <tr>
    <td align="center"><?=$num3;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows3["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount3;?></td>
    <td align="center"><?=$sumcount3;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead3==0){ echo "-";}else{ echo $dead3;}?></td>
    <td align="center"><? if($improved3==0){ echo "-";}else{ echo $improved3;}?></td>
    <td align="center"><?=$sumdc3;?></td>
  </tr>
<?
		}  //close while rows3
	}  //close numrows3
	
	//------------ ก.4 ลูกจ้างประจำ ------------//
    $sql4= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G14%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql4."<br>";
	$query4 = mysql_query($sql4) or die("Query failed G14");
	$numrows4=mysql_num_rows($query4);
	//echo "--->".$numrows4."<br>";
	$num4=0;
	if(!empty($numrows4)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows4=mysql_fetch_array($query4)){
    $num4++;
	$goup=substr($rows4["goup"],4,3);
	$icount4=$rows4["icount"];
	$icd10=$rows4["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G14%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 203");
	$improved4=0;
    $dead4=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved4++;
		}
		if($rows["result"]=="9 Dead"){
			$dead4++;
		}	
	}	
	$sumdc4=$improved4+$dead4;	
	$sumcount4=$icount4;	
?>   
  <tr>
    <td align="center"><?=$num4;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows4["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount4;?></td>
    <td align="center"><?=$sumcount4;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead4==0){ echo "-";}else{ echo $dead4;}?></td>
    <td align="center"><? if($improved4==0){ echo "-";}else{ echo $improved4;}?></td>
    <td align="center"><?=$sumdc4;?></td>
  </tr>
<?
		}  //close while rows4
	}  //close numrows4

	//------------ ก.5 ลูกจ้างชั่วคราว ------------//
    $sql5= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G15%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql5."<br>";
	$query5 = mysql_query($sql5) or die("Query failed G15");
	$numrows5=mysql_num_rows($query5);
	//echo "--->".$numrows5."<br>";
	$num5=0;
	if(!empty($numrows5)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows5=mysql_fetch_array($query5)){
    $num5++;
	$lengoup=strlen($rows5["goup"]);
	if($lengoup =="24"){
	$goup=substr($rows5["goup"],5,3);	
	}else{
	$goup=substr($rows5["goup"],4,3);
	}
	$icount5=$rows5["icount"];
	$icd10=$rows5["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G15%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 259");
	$improved5=0;
    $dead5=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved5++;
		}
		if($rows["result"]=="9 Dead"){
			$dead5++;
		}	
	}	
	$sumdc5=$improved5+$dead5;
	$sumcount5=$icount5;		
?>   
  <tr>
    <td align="center"><?=$num5;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows5["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount5;?></td>
    <td align="center"><?=$sumcount5;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead5==0){ echo "-";}else{ echo $dead5;}?></td>
    <td align="center"><? if($improved5==0){ echo "-";}else{ echo $improved5;}?></td>
    <td align="center"><?=$sumdc5;?></td>
  </tr>
<?
		}  //close while rows5
	}  //close numrows5	
?>  
  <tr>
    <td colspan="11" align="center" bgcolor="#FFCC99">&nbsp;</td>
  </tr>
<?
	//------------ ข.1 นายสิบ พลทหารประจำการ ------------//
    $sql1 = "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G21%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql1."<br>";
	$query1 = mysql_query($sql1) or die("Query failed G21");
	$numrows1=mysql_num_rows($query1);
	//echo "--->".$numrows1."<br>";
	$num1=0;
	while($rows1=mysql_fetch_array($query1)){
    $num1++;
	$goup=substr($rows1["goup"],4,3);
	$icount1=$rows1["icount"];		
	$icd10=$rows1["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G21%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 313");
	$improved1=0;
    $dead1=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved1++;
		}
		if($rows["result"]=="9 Dead"){
			$dead1++;
		}	
	}	
	$sumdc1=$improved1+$dead1;
	$sumcount1=$icount1;	
		
?>  
  <tr>
    <td align="center"><?=$num1;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows1["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount1;?></td>
    <td align="center"><?=$sumcount1;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead1==0){ echo "-";}else{ echo $dead1;}?></td>
    <td align="center"><? if($improved1==0){ echo "-";}else{ echo $improved1;}?></td>
    <td align="center"><?=$sumdc1;?></td>
  </tr>
<?
	}  //close while rows1
	
	//------------ ก.2 นายสิบ พลทหารประจำการ ------------//
    $sql2= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G22%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql2."<br>";
	$query2 = mysql_query($sql2) or die("Query failed G22");
	$numrows2=mysql_num_rows($query2);
	//echo "--->".$numrows2."<br>";
	$num2=0;
	if(!empty($numrows2)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows2=mysql_fetch_array($query2)){
    $num2++;
	$goup=substr($rows2["goup"],4,3);
	$icount2=$rows2["icount"];
	$icd10=$rows2["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G22%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 343");
	$improved2=0;
    $dead2=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved2++;
		}
		if($rows["result"]=="9 Dead"){
			$dead2++;
		}	
	}		
	$sumdc2=$improved2+$dead2;
	$sumcount2=$icount2;			
?>   
  <tr>
    <td align="center"><?=$num2;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows2["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount2;?></td>
    <td align="center"><?=$sumcount2;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead2==0){ echo "-";}else{ echo $dead2;}?></td>
    <td align="center"><? if($improved2==0){ echo "-";}else{ echo $improved2;}?></td>
    <td align="center"><?=$sumdc2;?></td>
  </tr>
<?
		}  //close while rows2
	}  //close numrows2
	
	//------------ ก.3 ข้าราชการกลาโหมพลเรือน ------------//
    $sql3= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G23%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql3."<br>";
	$query3 = mysql_query($sql3) or die("Query failed G23");
	$numrows3=mysql_num_rows($query3);
	//echo "--->".$numrows3."<br>";
	$num3=0;
	if(!empty($numrows3)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows3=mysql_fetch_array($query3)){
    $num3++;
	$goup=substr($rows3["goup"],4,3);
	$icount3=$rows3["icount"];
	$icd10=$rows3["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G23%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 394");
	$improved3=0;
    $dead3=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved3++;
		}
		if($rows["result"]=="9 Dead"){
			$dead3++;
		}	
	}	
	$sumdc3=$improved3+$dead3;
	$sumcount3=$icount3;			
?>   
  <tr>
    <td align="center"><?=$num3;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows3["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount3;?></td>
    <td align="center"><?=$sumcount3;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead3==0){ echo "-";}else{ echo $dead3;}?></td>
    <td align="center"><? if($improved3==0){ echo "-";}else{ echo $improved3;}?></td>
    <td align="center"><?=$sumdc3;?></td>
  </tr>
<?
		}  //close while rows3
	}  //close numrows3
	
	//------------ ก.4 ลูกจ้างประจำ ------------//
    $sql4= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G24%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql4."<br>";
	$query4 = mysql_query($sql4) or die("Query failed G24");
	$numrows4=mysql_num_rows($query4);
	//echo "--->".$numrows4."<br>";
	$num4=0;
	if(!empty($numrows4)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows4=mysql_fetch_array($query4)){
    $num4++;
	$goup=substr($rows4["goup"],4,3);
	$icount4=$rows4["icount"];
	$icd10=$rows4["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G24%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 445");
	$improved4=0;
    $dead4=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved4++;
		}
		if($rows["result"]=="9 Dead"){
			$dead4++;
		}	
	}	
	$sumdc4=$improved4+$dead4;	
	$sumcount4=$icount4;	
?>   
  <tr>
    <td align="center"><?=$num4;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows4["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount4;?></td>
    <td align="center"><?=$sumcount4;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead4==0){ echo "-";}else{ echo $dead4;}?></td>
    <td align="center"><? if($improved4==0){ echo "-";}else{ echo $improved4;}?></td>
    <td align="center"><?=$sumdc4;?></td>
  </tr>
<?
		}  //close while rows4
	}  //close numrows4

	//------------ ก.5 ลูกจ้างชั่วคราว ------------//
    $sql5= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G25%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql5."<br>";
	$query5 = mysql_query($sql5) or die("Query failed G25");
	$numrows5=mysql_num_rows($query5);
	//echo "--->".$numrows5."<br>";
	$num5=0;
	if(!empty($numrows5)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows5=mysql_fetch_array($query5)){
    $num5++;
	$goup=substr($rows5["goup"],5,3);
	$icount5=$rows5["icount"];
	$icd10=$rows5["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G25%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 259");
	$improved5=0;
    $dead5=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved5++;
		}
		if($rows["result"]=="9 Dead"){
			$dead5++;
		}	
	}	
	$sumdc5=$improved5+$dead5;
	$sumcount5=$icount5;				
?>   
  <tr>
    <td align="center"><?=$num5;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows5["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount5;?></td>
    <td align="center"><?=$sumcount5;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead5==0){ echo "-";}else{ echo $dead5;}?></td>
    <td align="center"><? if($improved5==0){ echo "-";}else{ echo $improved5;}?></td>
    <td align="center"><?=$sumdc5;?></td>
  </tr>
<?
		}  //close while rows5
	}  //close numrows5	
?>  
  <tr>
    <td colspan="11" align="center" bgcolor="#FFCC99">&nbsp;</td>
  </tr>
<?
	//------------ ค.1 ครอบครัวทหาร ------------//
    $sql1 = "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G31%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql1."<br>";
	$query1 = mysql_query($sql1) or die("Query failed G31");
	$numrows1=mysql_num_rows($query1);
	//echo "--->".$numrows1."<br>";
	$num1=0;
	while($rows1=mysql_fetch_array($query1)){
    $num1++;
	$goup=substr($rows1["goup"],4,3);
	$icount1=$rows1["icount"];	
	$icd10=$rows1["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G31%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed");
	$improved1=0;
    $dead1=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved1++;
		}
		if($rows["result"]=="9 Dead"){
			$dead1++;
		}	
	}	
	
	$sumdc1=$improved1+$dead1;	
		
?>  
  <tr>
    <td align="center"><?=$num1;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows1["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount1;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead1==0){ echo "-";}else{ echo $dead1;}?></td>
    <td align="center"><? if($improved1==0){ echo "-";}else{ echo $improved1;}?></td>
    <td align="center"><?=$sumdc1;?></td>
  </tr>
<?
	}  //close while rows1
	
	//------------ ค.2 ทหารนอกประจำการ ------------//
    $sql2= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G32%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql2."<br>";
	$query2 = mysql_query($sql2) or die("Query failed G32");
	$numrows2=mysql_num_rows($query2);
	//echo "--->".$numrows2."<br>";
	$num2=0;
	if(!empty($numrows2)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows2=mysql_fetch_array($query2)){
    $num2++;
	$goup=substr($rows2["goup"],4,3);
	$icount=$rows2["icount"];
	$icd10=$rows2["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G32%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 597");
	$improved2=0;
    $dead2=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved2++;
		}
		if($rows["result"]=="9 Dead"){
			$dead2++;
		}	
	}		
	$sumdc2=$improved2+$dead2;		
?>   
  <tr>
    <td align="center"><?=$num2;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows2["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount2;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead2==0){ echo "-";}else{ echo $dead2;}?></td>
    <td align="center"><? if($improved2==0){ echo "-";}else{ echo $improved2;}?></td>
    <td align="center"><?=$sumdc2;?></td>
  </tr>
<?
		}  //close while rows2
	}  //close numrows2
	
	//------------ ค.3 นักศึกษาวิชาทหาร ------------//
    $sql3= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G33%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql3."<br>";
	$query3 = mysql_query($sql3) or die("Query failed G33");
	$numrows3=mysql_num_rows($query3);
	//echo "--->".$numrows3."<br>";
	$num3=0;
	if(!empty($numrows3)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows3=mysql_fetch_array($query3)){
    $num3++;
	$goup=substr($rows3["goup"],4,3);
	$icount3=$rows3["icount"];
	$icd10=$rows3["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G23%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 648");
	$improved3=0;
    $dead3=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved3++;
		}
		if($rows["result"]=="9 Dead"){
			$dead3++;
		}	
	}	
	$sumdc3=$improved3+$dead3;		
?>   
  <tr>
    <td align="center"><?=$num3;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows3["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount3;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead3==0){ echo "-";}else{ echo $dead3;}?></td>
    <td align="center"><? if($improved3==0){ echo "-";}else{ echo $improved3;}?></td>
    <td align="center"><?=$sumdc3;?></td>
  </tr>
<?
		}  //close while rows3
	}  //close numrows3
	
	//------------ ค.4 วิวัฒน์พลเมือง ------------//
    $sql4= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G34%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql4."<br>";
	$query4 = mysql_query($sql4) or die("Query failed G34");
	$numrows4=mysql_num_rows($query4);
	//echo "--->".$numrows4."<br>";
	$num4=0;
	if(!empty($numrows4)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows4=mysql_fetch_array($query4)){
    $num4++;
	$goup=substr($rows4["goup"],4,3);
	$icount4=$rows4["icount"];
	$icd10=$rows4["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G34%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 699");
	$improved4=0;
    $dead4=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved4++;
		}
		if($rows["result"]=="9 Dead"){
			$dead4++;
		}	
	}	
	$sumdc4=$improved4+$dead4;		
?>   
  <tr>
    <td align="center"><?=$num4;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows4["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount4;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead4==0){ echo "-";}else{ echo $dead4;}?></td>
    <td align="center"><? if($improved4==0){ echo "-";}else{ echo $improved4;}?></td>
    <td align="center"><?=$sumdc4;?></td>
  </tr>
<?
		}  //close while rows4
	}  //close numrows4

	//------------ ค.5 พลเรือนใช้บัตรประกันสังคม ------------//
    $sql5= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G35%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql5."<br>";
	$query5 = mysql_query($sql5) or die("Query failed G35");
	$numrows5=mysql_num_rows($query5);
	//echo "--->".$numrows5."<br>";
	$num5=0;
	if(!empty($numrows5)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows5=mysql_fetch_array($query5)){
    $num5++;
	$goup=substr($rows5["goup"],4,3);
	$icount5=$rows5["icount"];
	$icd10=$rows5["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G35%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 750");
	$improved5=0;
    $dead5=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved5++;
		}
		if($rows["result"]=="9 Dead"){
			$dead5++;
		}	
	}	
	$sumdc5=$improved5+$dead5;		
?>   
  <tr>
    <td align="center"><?=$num5;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows5["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount5;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead5==0){ echo "-";}else{ echo $dead5;}?></td>
    <td align="center"><? if($improved5==0){ echo "-";}else{ echo $improved5;}?></td>
    <td align="center"><?=$sumdc5;?></td>
  </tr>
<?
		}  //close while rows5
	}  //close numrows5	
	
	//------------ ค.6 พลเรือนใช้บัตรประกันสุขภาพ ------------//
    $sql6= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G36%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql6."<br>";
	$query6 = mysql_query($sql6) or die("Query failed G36");
	$numrows6=mysql_num_rows($query6);
	//echo "--->".$numrows6."<br>";
	$num6=0;
	if(!empty($numrows6)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows6=mysql_fetch_array($query6)){
    $num6++;
	$goup=substr($rows6["goup"],4,3);
	$icount6=$rows6["icount"];
	$icd10=$rows6["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G36%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 801");
	$improved6=0;
    $dead6=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved6++;
		}
		if($rows["result"]=="9 Dead"){
			$dead6++;
		}	
	}	
	$sumdc6=$improved6+$dead6;		
?>   
  <tr>
    <td align="center"><?=$num6;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows6["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount6;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead6==0){ echo "-";}else{ echo $dead6;}?></td>
    <td align="center"><? if($improved6==0){ echo "-";}else{ echo $improved6;}?></td>
    <td align="center"><?=$sumdc6;?></td>
  </tr>
<?
		}  //close while rows6
	}  //close numrows6
	
	//------------ ค.7 ข้าราชการพลเรือน ------------//
    $sql7= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G37%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql7."<br>";
	$query7 = mysql_query($sql7) or die("Query failed G37");
	$numrows7=mysql_num_rows($query7);
	//echo "--->".$numrows7."<br>";
	$num7=0;
	if(!empty($numrows7)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows7=mysql_fetch_array($query7)){
    $num7++;
	$goup=substr($rows7["goup"],4,3);
	$icount7=$rows7["icount"];
	$icd10=$rows7["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G37%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 852");
	$improved7=0;
    $dead7=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved7++;
		}
		if($rows["result"]=="9 Dead"){
			$dead7++;
		}	
	}	
	$sumdc7=$improved7+$dead7;			
?>   
  <tr>
    <td align="center"><?=$num7;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows7["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount7;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead7==0){ echo "-";}else{ echo $dead7;}?></td>
    <td align="center"><? if($improved7==0){ echo "-";}else{ echo $improved7;}?></td>
    <td align="center"><?=$sumdc7;?></td>
  </tr>
<?
		}  //close while rows7
	}  //close numrows7	
	
	//------------ ค.8 พลเรือน (ไม่เบิกต้นสังกัด) ------------//
    $sql8= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G38%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql8."<br>";
	$query8 = mysql_query($sql8) or die("Query failed G38");
	$numrows8=mysql_num_rows($query8);
	//echo "--->".$numrows8."<br>";
	$num8=0;
	if(!empty($numrows8)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows8=mysql_fetch_array($query8)){
    $num8++;
	$goup=substr($rows8["goup"],4,3);
	$icount8=$rows8["icount"];
	$icd10=$rows8["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G38%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 903");
	$improved8=0;
    $dead8=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved8++;
		}
		if($rows["result"]=="9 Dead"){
			$dead8++;
		}	
	}	
	$sumdc8=$improved8+$dead8;	
?>   
  <tr>
    <td align="center"><?=$num8;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows8["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount8;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead8==0){ echo "-";}else{ echo $dead8;}?></td>
    <td align="center"><? if($improved8==0){ echo "-";}else{ echo $improved8;}?></td>
    <td align="center"><?=$sumdc8;?></td>
  </tr>
<?
		}  //close while rows8
	}  //close numrows8	
	
	//------------ ค.9 อื่นๆ ไม่ระบุ ------------//
    $sql9= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G39%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql9."<br>";
	$query9 = mysql_query($sql9) or die("Query failed G39");
	$numrows9=mysql_num_rows($query9);
	//echo "--->".$numrows9."<br>";
	$num9=0;
	if(!empty($numrows9)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows9=mysql_fetch_array($query9)){
    $num9++;
	$goup=substr($rows9["goup"],4,3);
	$icount9=$rows9["icount"];
	$icd10=$rows9["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G39%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 954");
	$improved9=0;
    $dead9=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved9++;
		}
		if($rows["result"]=="9 Dead"){
			$dead9++;
		}	
	}	
	$sumdc9=$improved9+$dead9;		
?>   
  <tr>
    <td align="center"><?=$num9;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows9["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount9;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead9==0){ echo "-";}else{ echo $dead9;}?></td>
    <td align="center"><? if($improved9==0){ echo "-";}else{ echo $improved9;}?></td>
    <td align="center"><?=$sumdc9;?></td>
  </tr>
<?
		}  //close while rows9
	}  //close numrows9	

	//------------ ค.10 ญาติสายตรงกับกำลังพล ทบ ------------//
    $sql10= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G40%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql10."<br>";
	$query10 = mysql_query($sql10) or die("Query failed G40");
	$numrows10=mysql_num_rows($query10);
	//echo "--->".$numrows10."<br>";
	$num10=0;
	if(!empty($numrows10)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows10=mysql_fetch_array($query10)){
    $num10++;
	$goup=substr($rows10["goup"],4,3);
	$icount10=$rows10["icount"];
	$icd10=$rows10["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G40%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 1005");
	$improved10=0;
    $dead10=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved10++;
		}
		if($rows["result"]=="9 Dead"){
			$dead10++;
		}	
	}	
	$sumdc10=$improved10+$dead10;	
?>   
  <tr>
    <td align="center"><?=$num10;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows10["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount10;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead10==0){ echo "-";}else{ echo $dead10;}?></td>
    <td align="center"><? if($improved10==0){ echo "-";}else{ echo $improved10;}?></td>
    <td align="center"><?=$sumdc10;?></td>
  </tr>
<?
		}  //close while rows10
	}  //close numrows10	
	
	//------------ ค.11 บุคคลที่มีความสัมพันธกับกำลังพล ทบ ------------//
    $sql11= "SELECT *, count(icd10) as icount FROM ipgroup where goup like 'G41%' GROUP BY icd10 ORDER BY goup asc, icd10 asc"; 
	//echo $sql11."<br>";
	$query11 = mysql_query($sql11) or die("Query failed G41");
	$numrows11=mysql_num_rows($query11);
	//echo "--->".$numrows11."<br>";
	$num11=0;
	if(!empty($numrows11)){
?>	
  <tr>
    <td colspan="11" align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
	while($rows11=mysql_fetch_array($query11)){
    $num11++;
	$goup=substr($rows11["goup"],4,3);
	$icount11=$rows11["icount"];
	$icd10=$rows11["icd10"];
	
	$sql="select icd10,result from ipgroup where goup like 'G41%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 1056");
	$improved11=0;
    $dead11=0;	
	while($rows=mysql_fetch_array($query)){
	//echo "-->".$rows["icd10"]." - ".$rows["result"]."<br>";
		if($rows["result"]=="2 Improved" || $rows["result"]=="1 Complete Recov" || $rows["result"]=="3 Not Improved"){
			$improved11++;
		}
		if($rows["result"]=="9 Dead"){
			$dead11++;
		}	
	}	
	$sumdc11=$improved11+$dead11;	
?>   
  <tr>
    <td align="center"><?=$num11;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$rows11["icd10"];?></td>
    <td align="left">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$icount11;?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead11==0){ echo "-";}else{ echo $dead11;}?></td>
    <td align="center"><? if($improved11==0){ echo "-";}else{ echo $improved11;}?></td>
    <td align="center"><?=$sumdc11;?></td>
  </tr>
<?
		}  //close while rows11
	}  //close numrows11	
?>	   					   				
  <tr>
    <td colspan="11" align="center" bgcolor="#FFCC99">&nbsp;</td>
  </tr>  
</table>
