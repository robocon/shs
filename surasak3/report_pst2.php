<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
$yrmonth="$thyear-$month";
$chkyrmonth2="$thyear-$month-01"; 
$chkyrmonth3="$thyear-$month-31"; 

?>
<p align="center"><strong>รายงานจำนวนผู้ป่วยในจำแนกตามสาเหตุป่วย ( รง.ผสต.2 )<br>
  หน่วยงาน   โรงพยาบาลค่ายสุรศักดิ์มนตรี <br>
  ประจำเดือน <?=$mon;?> &nbsp;ปี <?=$thyear;?></strong></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr align="center">
    <td width="38" rowspan="2"><strong>ลำดับ</strong></td>
    <td width="149" height="66" rowspan="2" align="center"><strong>ประเภท<br />
      บุคคลย่อย</strong></td>
    <td width="197" rowspan="2" align="center"><strong>รหัสโรค ที่ 1<br />
      (ICD10)</strong></td>
    <td width="199" rowspan="2" align="center"><strong>รหัสโรค ที่ 2<br />
      (ICD10)</strong></td>
    <td colspan="3"><strong>รับ</strong></td>
    <td colspan="4"><strong>จำหน่าย</strong></td>
  </tr>
  <tr align="center">
    <td width="97"><strong>ยกมา</strong></td>
    <td width="97"><strong>รับใหม่</strong></td>
    <td width="102"><strong>รวม</strong></td>
    <td width="96"><strong>ปลดพิการ</strong></td>
    <td width="100"><strong>ตาย</strong></td>
    <td width="98"><strong>อื่นๆ</strong></td>
    <td width="167"><strong>รวม</strong></td>
  </tr>
<?
	//------------ ก.1 นายทหารประจำการ ------------//
    $sql1 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G11%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query1 = mysql_query($sql1) or die("Query failed G11");
	$numrows1=mysql_num_rows($query1);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows1)){	
	$num=0;
	while($rows1=mysql_fetch_array($query1)){
    $num++;
	$goup=substr($rows1["goup"],4,3);
	$icd10=$rows1["icd10"];
	if(!empty($rows1["comorbid"])){
		$comorbid=$rows1["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G11%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved11=0;
    $dead11=0;
	$old11=0;
	$new11=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new11++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old11++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin11=$old11+$new11;
	$sumdc11=$improved11+$dead11;
?>  
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old11;?></td>
    <td align="center"><?=$new11;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin11;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead11==0){ echo "-";}else{ echo $dead11;}?></td>
    <td align="center"><? if($improved11==0){ echo "-";}else{ echo $improved11;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc11;?></td>
  </tr>
<?
		}  //close while rows1
	}
	
	//------------ ก.2 นายสิบ พลทหารประจำการ ------------//
    $sql2= "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G12%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql2."<br>";
	$query2 = mysql_query($sql2) or die("Query failed G12");
	$numrows2=mysql_num_rows($query2);
	//echo "--->".$numrows2."<br>";
	if(!empty($numrows2)){
	while($rows2=mysql_fetch_array($query2)){
    $num++;
	$goup=substr($rows2["goup"],4,3);
	$icd10=$rows2["icd10"];
	if(!empty($rows2["comorbid"])){
		$comorbid=$rows2["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G12%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 101");
	$improved12=0;
    $dead12=0;	
	$old12=0;
	$new12=0;
	while($rows=mysql_fetch_array($query)){

		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new12++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old12++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){		
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
	}	
	$sumin12=$old12+$new12;	
	$sumdc12=$improved12+$dead12;	
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old12;?></td>
    <td align="center"><?=$new12;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin12;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead12==0){ echo "-";}else{ echo $dead12;}?></td>
    <td align="center"><? if($improved12==0){ echo "-";}else{ echo $improved12;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc12;?></td>
  </tr>
<?
		}  //close while rows2
	}  //close numrows2
	
	//------------ ก.3 ข้าราชการกลาโหมพลเรือน ------------//
    $sql3= "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G13%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql3."<br>";
	$query3 = mysql_query($sql3) or die("Query failed G13");
	$numrows3=mysql_num_rows($query3);
	//echo "--->".$numrows3."<br>";
	if(!empty($numrows3)){
	while($rows3=mysql_fetch_array($query3)){
    $num++;
	$goup=substr($rows3["goup"],4,3);
	$icd10=$rows3["icd10"];
	if(!empty($rows3["comorbid"])){
		$comorbid=$rows3["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G13%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 101");
	$improved13=0;
    $dead13=0;	
	$old13=0;
	$new13=0;
	while($rows=mysql_fetch_array($query)){

		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new13++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old13++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){		
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}	
	}	
	$sumin13=$old13+$new13;	
	$sumdc13=$improved13+$dead13;	
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old13;?></td>
    <td align="center"><?=$new13;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin13;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead13==0){ echo "-";}else{ echo $dead13;}?></td>
    <td align="center"><? if($improved13==0){ echo "-";}else{ echo $improved13;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc13;?></td>
  </tr>
<?
		}  //close while rows3
	}  //close numrows3
	
	//------------ ก.4 ลูกจ้างประจำ ------------//		
    $sql4= "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G14%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql4."<br>";
	$query4 = mysql_query($sql4) or die("Query failed G14");
	$numrows4=mysql_num_rows($query4);
	//echo "--->".$numrows4."<br>";
	if(!empty($numrows4)){
	while($rows4=mysql_fetch_array($query4)){
    $num++;
	$goup=substr($rows4["goup"],4,3);
	$icd10=$rows4["icd10"];
	if(!empty($rows4["comorbid"])){
		$comorbid=$rows4["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G14%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 101");
	$improved14=0;
    $dead14=0;	
	$old14=0;
	$new14=0;
	while($rows=mysql_fetch_array($query)){

		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new14++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old14++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}	
	}	
	$sumin14=$old14+$new14;	
	$sumdc14=$improved14+$dead14;	
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old14;?></td>
    <td align="center"><?=$new14;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin14;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead14==0){ echo "-";}else{ echo $dead14;}?></td>
    <td align="center"><? if($improved14==0){ echo "-";}else{ echo $improved14;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc14;?></td>
  </tr>
<?
		}  //close while rows4
	}  //close numrows4

	//------------ ก.5 ลูกจ้างชั่วคราว ------------//	
    $sql5= "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G15%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql5."<br>";
	$query5 = mysql_query($sql5) or die("Query failed G15");
	$numrows5=mysql_num_rows($query5);
	//echo "--->".$numrows5."<br>";
	if(!empty($numrows5)){
	while($rows5=mysql_fetch_array($query5)){
    $num++;
	$goup=substr($rows5["goup"],4,3);
	$icd10=$rows5["icd10"];
	if(!empty($rows5["comorbid"])){
		$comorbid=$rows5["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G15%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 101");
	$improved15=0;
    $dead15=0;	
	$old15=0;
	$new15=0;
	while($rows=mysql_fetch_array($query)){

		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new15++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old15++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}	
	}	
	$sumin15=$old15+$new15;	
	$sumdc15=$improved15+$dead15;	
	?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old15;?></td>
    <td align="center"><?=$new15;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin15;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead15==0){ echo "-";}else{ echo $dead15;}?></td>
    <td align="center"><? if($improved15==0){ echo "-";}else{ echo $improved15;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc5;?></td>
  </tr>
<?
		}  //close while rows5
	}  //close numrows5	

	//------------ ข.1 นายสิบ พลทหารประจำการ ------------//
    $sql21 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G21%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query21 = mysql_query($sql21) or die("Query failed G21");
	$numrows21=mysql_num_rows($query21);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows21)){	
	while($rows21=mysql_fetch_array($query21)){
    $num++;
	$goup=substr($rows21["goup"],4,3);
	$icd10=$rows21["icd10"];
	if(!empty($rows21["comorbid"])){
		$comorbid=$rows21["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G21%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved21=0;
    $dead21=0;
	$old21=0;
	$new21=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new21++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old21++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin21=$old21+$new21;
	$sumdc21=$improved21+$dead21;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old21;?></td>
    <td align="center"><?=$new21;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin21;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead21==0){ echo "-";}else{ echo $dead21;}?></td>
    <td align="center"><? if($improved21==0){ echo "-";}else{ echo $improved21;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc21;?></td>
  </tr>
<?
		}  //close while rows21
	}  //close numrows21
		
	//------------ ก.2 นายสิบ พลทหารประจำการ ------------//
    $sql22 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G22%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query22 = mysql_query($sql22) or die("Query failed G22");
	$numrows22=mysql_num_rows($query22);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows22)){	
	while($rows22=mysql_fetch_array($query22)){
    $num++;
	$goup=substr($rows22["goup"],4,3);
	$icd10=$rows22["icd10"];
	if(!empty($rows22["comorbid"])){
		$comorbid=$rows22["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G22%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved22=0;
    $dead22=0;
	$old22=0;
	$new22=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new22++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old22++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin22=$old22+$new22;
	$sumdc22=$improved22+$dead22;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old22;?></td>
    <td align="center"><?=$new22;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin22;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead22==0){ echo "-";}else{ echo $dead22;}?></td>
    <td align="center"><? if($improved22==0){ echo "-";}else{ echo $improved22;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc22;?></td>
  </tr>
<?
		}  //close while rows22
	}  //close numrows22
	
	//------------ ก.3 ข้าราชการกลาโหมพลเรือน ------------//
    $sql23 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G23%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query23 = mysql_query($sql23) or die("Query failed G23");
	$numrows23=mysql_num_rows($query23);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows23)){	
	while($rows23=mysql_fetch_array($query23)){
    $num++;
	$goup=substr($rows23["goup"],4,3);
	$icd10=$rows23["icd10"];
	if(!empty($rows23["comorbid"])){
		$comorbid=$rows23["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G23%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved23=0;
    $dead23=0;
	$old23=0;
	$new23=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new23++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old23++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin23=$old23+$new23;
	$sumdc23=$improved23+$dead23;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old23;?></td>
    <td align="center"><?=$new23;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin23;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead23==0){ echo "-";}else{ echo $dead23;}?></td>
    <td align="center"><? if($improved23==0){ echo "-";}else{ echo $improved23;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc23;?></td>
  </tr>
<?
		}  //close while rows23
	}  //close numrows23
	
	//------------ ก.4 ลูกจ้างประจำ ------------//
    $sql24 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G24%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query24 = mysql_query($sql24) or die("Query failed G24");
	$numrows24=mysql_num_rows($query24);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows24)){	
	while($rows24=mysql_fetch_array($query24)){
    $num++;
	$goup=substr($rows24["goup"],4,3);
	$icd10=$rows24["icd10"];
	if(!empty($rows24["comorbid"])){
		$comorbid=$rows24["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G24%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved24=0;
    $dead24=0;
	$old24=0;
	$new24=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new24++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old24++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin24=$old24+$new24;
	$sumdc24=$improved24+$dead24;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old24;?></td>
    <td align="center"><?=$new24;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin24;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead24==0){ echo "-";}else{ echo $dead24;}?></td>
    <td align="center"><? if($improved24==0){ echo "-";}else{ echo $improved24;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc24;?></td>
  </tr>
<?
		}  //close while rows24
	}  //close numrows24

	//------------ ก.5 ลูกจ้างชั่วคราว ------------//
    $sql25 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G25%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query25 = mysql_query($sql25) or die("Query failed G25");
	$numrows25=mysql_num_rows($query25);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows25)){	
	while($rows25=mysql_fetch_array($query25)){
    $num++;
	$goup=substr($rows25["goup"],4,3);
	$icd10=$rows25["icd10"];
	if(!empty($rows25["comorbid"])){
		$comorbid=$rows25["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G25%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved25=0;
    $dead25=0;
	$old25=0;
	$new25=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new25++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old25++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin25=$old25+$new25;
	$sumdc25=$improved25+$dead25;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old25;?></td>
    <td align="center"><?=$new25;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin25;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead25==0){ echo "-";}else{ echo $dead25;}?></td>
    <td align="center"><? if($improved25==0){ echo "-";}else{ echo $improved25;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc25;?></td>
  </tr>
<?
		}  //close while rows25
	}  //close numrows25
?>  
<?
	//------------ ค.1 ครอบครัวทหาร ------------//
    $sql31 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G31%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query31 = mysql_query($sql31) or die("Query failed G31");
	$numrows31=mysql_num_rows($query31);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows31)){	
	while($rows31=mysql_fetch_array($query31)){
    $num++;
	$goup=substr($rows31["goup"],4,3);
	$icd10=$rows31["icd10"];
	if(!empty($rows31["comorbid"])){
		$comorbid=$rows31["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G31%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved31=0;
    $dead31=0;
	$old31=0;
	$new31=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new31++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old31++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin31=$old31+$new31;
	$sumdc31=$improved31+$dead31;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old31;?></td>
    <td align="center"><?=$new31;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin31;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead31==0){ echo "-";}else{ echo $dead31;}?></td>
    <td align="center"><? if($improved31==0){ echo "-";}else{ echo $improved31;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc31;?></td>
  </tr>
<?
		}  //close while rows31
	}  //close numrows31
	
	//------------ ค.2 ทหารนอกประจำการ ------------//
    $sql32 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G32%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query32 = mysql_query($sql32) or die("Query failed G32");
	$numrows32=mysql_num_rows($query32);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows32)){	
	while($rows32=mysql_fetch_array($query32)){
    $num++;
	$goup=substr($rows32["goup"],4,3);
	$icd10=$rows32["icd10"];
	if(!empty($rows32["comorbid"])){
		$comorbid=$rows32["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G32%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved32=0;
    $dead32=0;
	$old32=0;
	$new32=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new32++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old32++;
			//echo "ยกมา";
		}
		
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin32=$old32+$new32;
	$sumdc32=$improved32+$dead32;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old32;?></td>
    <td align="center"><?=$new32;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin32;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead32==0){ echo "-";}else{ echo $dead32;}?></td>
    <td align="center"><? if($improved32==0){ echo "-";}else{ echo $improved32;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc32;?></td>
  </tr>
<?
		}  //close while rows32
	}  //close numrows32
	
	//------------ ค.3 นักศึกษาวิชาทหาร(รด.) ระหว่างฝึก ------------//
    $sql33 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G33%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query33 = mysql_query($sql33) or die("Query failed G33");
	$numrows33=mysql_num_rows($query33);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows33)){	
	while($rows33=mysql_fetch_array($query33)){
    $num++;
	$goup=substr($rows33["goup"],4,3);
	$icd10=$rows33["icd10"];
	if(!empty($rows33["comorbid"])){
		$comorbid=$rows33["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G33%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved33=0;
    $dead33=0;
	$old33=0;
	$new33=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new33++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old33++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin33=$old33+$new33;
	$sumdc33=$improved33+$dead33;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old33;?></td>
    <td align="center"><?=$new33;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin33;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead33==0){ echo "-";}else{ echo $dead33;}?></td>
    <td align="center"><? if($improved33==0){ echo "-";}else{ echo $improved33;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc33;?></td>
  </tr>
<?
		}  //close while rows33
	}  //close numrows33
	
    //------------ ค.4 บุคคลที่เข้าร่วมโครงการวิวัฒน์พลเมือง ------------//
	$sql34 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G34%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query34 = mysql_query($sql34) or die("Query failed G34");
	$numrows34=mysql_num_rows($query34);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows34)){	
	while($rows34=mysql_fetch_array($query34)){
    $num++;
	$goup=substr($rows34["goup"],4,3);
	$icd10=$rows34["icd10"];
	if(!empty($rows34["comorbid"])){
		$comorbid=$rows34["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G34%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved34=0;
    $dead34=0;
	$old34=0;
	$new34=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new34++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old34++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin34=$old34+$new34;
	$sumdc34=$improved34+$dead34;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old34;?></td>
    <td align="center"><?=$new34;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin34;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead34==0){ echo "-";}else{ echo $dead34;}?></td>
    <td align="center"><? if($improved34==0){ echo "-";}else{ echo $improved34;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc34;?></td>
  </tr>
<?
		}  //close while rows34
	}  //close numrows34
	


	//------------ ค.5 พลเรือนใช้บัตรประกันสังคม ------------//
	$sql35 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G35%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query35 = mysql_query($sql35) or die("Query failed G35");
	$numrows35=mysql_num_rows($query35);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows35)){	
	while($rows35=mysql_fetch_array($query35)){
    $num++;
	$goup=substr($rows35["goup"],4,3);
	$icd10=$rows35["icd10"];
	if(!empty($rows35["comorbid"])){
		$comorbid=$rows35["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G35%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved35=0;
    $dead35=0;
	$old35=0;
	$new35=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new35++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old35++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin35=$old35+$new35;
	$sumdc35=$improved35+$dead35;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old35;?></td>
    <td align="center"><?=$new35;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin35;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead35==0){ echo "-";}else{ echo $dead35;}?></td>
    <td align="center"><? if($improved35==0){ echo "-";}else{ echo $improved35;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc35;?></td>
  </tr>
<?
		}  //close while rows35
	}  //close numrows35
		
	//------------ ค.6 พลเรือนใช้บัตรประกันสุขภาพ ------------//
	$sql36 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G36%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query36 = mysql_query($sql36) or die("Query failed G36");
	$numrows36=mysql_num_rows($query36);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows36)){	
	while($rows36=mysql_fetch_array($query36)){
    $num++;
	$goup=substr($rows36["goup"],4,3);
	$icd10=$rows36["icd10"];
	if(!empty($rows36["comorbid"])){
		$comorbid=$rows36["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G36%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved36=0;
    $dead36=0;
	$old36=0;
	$new36=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new36++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old36++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin36=$old36+$new36;
	$sumdc36=$improved36+$dead36;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old36;?></td>
    <td align="center"><?=$new36;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin36;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead36==0){ echo "-";}else{ echo $dead36;}?></td>
    <td align="center"><? if($improved36==0){ echo "-";}else{ echo $improved36;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc36;?></td>
  </tr>
<?
		}  //close while rows36
	}  //close numrows36
	
	//------------ ค.7 ข้าราชการพลเรือน ------------//
	$sql37 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G37%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query37 = mysql_query($sql37) or die("Query failed G37");
	$numrows37=mysql_num_rows($query37);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows37)){	
	while($rows37=mysql_fetch_array($query37)){
    $num++;
	$goup=substr($rows37["goup"],4,3);
	$icd10=$rows37["icd10"];
	if(!empty($rows37["comorbid"])){
		$comorbid=$rows37["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G37%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved37=0;
    $dead37=0;
	$old37=0;
	$new37=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new37++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old37++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin37=$old37+$new37;
	$sumdc37=$improved37+$dead37;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old37;?></td>
    <td align="center"><?=$new37;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin37;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead37==0){ echo "-";}else{ echo $dead37;}?></td>
    <td align="center"><? if($improved37==0){ echo "-";}else{ echo $improved37;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc37;?></td>
  </tr>
<?
		}  //close while rows37
	}  //close numrows37
	
	//------------ ค.8 พลเรือน (ไม่เบิกต้นสังกัด) ------------//
	$sql38 = "SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G38%' group by icd10 ORDER BY icd10 asc"; 
	//echo $sql1."<br>";
	$query38 = mysql_query($sql38) or die("Query failed G38");
	$numrows38=mysql_num_rows($query38);
	//echo "--->".$numrows1."<br>";
	if(!empty($numrows38)){	
	while($rows38=mysql_fetch_array($query38)){
    $num++;
	$goup=substr($rows38["goup"],4,3);
	$icd10=$rows38["icd10"];
	if(!empty($rows38["comorbid"])){
		$comorbid=$rows38["comorbid"];
	}else{
		$comorbid="&nbsp;";
	}
	
	
	$sql="SELECT *  FROM ipcard WHERE ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate like '$yrmonth%' OR dcdate > '$thyear-$month-31 23:59:59'))  AND goup like 'G38%' and icd10='$icd10'";
	$query = mysql_query($sql) or die("Query failed line 54");
	$improved38=0;
    $dead38=0;
	$old38=0;
	$new38=0;	
	while($rows=mysql_fetch_array($query)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new38++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old38++;
			//echo "ยกมา";
		}
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
		
	}	
	$sumin38=$old38+$new38;
	$sumdc38=$improved38+$dead38;
?>   
  <tr>
    <td align="center"><?=$num;?></td>
    <td align="left"><?=$goup;?></td>
    <td align="left"><?=$icd10;?></td>
    <td align="left"><?=$comorbid;?></td>
    <td align="center"><?=$old38;?></td>
    <td align="center"><?=$new38;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumin38;?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><? if($dead38==0){ echo "-";}else{ echo $dead38;}?></td>
    <td align="center"><? if($improved38==0){ echo "-";}else{ echo $improved38;}?></td>
    <td align="center" bgcolor="#FFCC99"><?=$sumdc38;?></td>
  </tr>
<?
		}  //close while rows38
	}  //close numrows38	
?>

<?
$sqlold= "SELECT * FROM ipcard where ((date >= '2560-01-01 00:00:00' AND date <= '$thyear-$month-31 23:59:59' AND icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate > '$thyear-$month-31 23:59:59' OR dcdate like '$yrmonth%')) AND (goup NOT LIKE 'G39%' AND goup NOT LIKE 'G40%')"; 


//$sqlold= "SELECT * FROM ipcard where ((date > '2560-01-01 00:00:00' AND date < '$thyear-$month-01 00:00:00' and icd10 !='') AND (dcdate = '0000-00-00 00:00:00' OR dcdate > '$thyear-$month-31 23:59:59')) OR (date < '$thyear-$month-01 00:00:00' AND dcdate like '$thyear-$month%') AND (goup NOT LIKE 'G39%' AND goup NOT LIKE 'G40%')";   //ยอดยกมา

//echo $sqlold;
$old=0;
$new=0;
$totalold=0;
$totalnew=0;
$totaloldnew=0;
$improved=0;
$dead=0;
$totalimproved=0;
$totaldead=0;
$totalimpdead=0;

$queryold = mysql_query($sqlold) or die("Query failed");
while($rows=mysql_fetch_array($queryold)){
		$chkyrmonth1=substr($rows["date"],0,10);
		$chkdcdate=substr($rows["dcdate"],0,10);
		//echo $chkyrmonth1;
		if($chkyrmonth1 >= $chkyrmonth2){  //รับใหม่
			$new++;
			//echo "รับใหม่";
		}else if($chkyrmonth1 < $chkyrmonth2){  //ยกมา
			$old++;
			//echo "ยกมา";
		}
		
		if($chkdcdate <= $chkyrmonth3){	
			if($rows["result"]=="1 Complete Recov" || $rows["result"]=="2 Improved" || $rows["result"]=="3 Not Improved"){
				$improved++;
			}else if($rows["result"]=="9 Dead"){
				$dead++;
			}else{
				$improved++;
			}
		}
				
}
$totalold=$totalold+$old;
$totalnew=$totalnew+$new;
$totaloldnew=$totalold+$totalnew;

$totalimproved=$totalimproved+$improved;
$totaldead=$totaldead+$dead;
$totalimpdead=$totalimproved+$totaldead;
?>
  <tr>
    <td colspan="4" align="center">จำนวนผู้ป่วยรวม  หรือยอดยกไป</td>
    <td align="center" bgcolor="#FFCC99"><?=$totalold;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$totalnew;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$totaloldnew;?></td>
    <td align="center" bgcolor="#FFCC99">&nbsp;</td>
    <td align="center" bgcolor="#FFCC99"><?=$totaldead;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$totalimproved;?></td>
    <td align="center" bgcolor="#FFCC99"><?=$totalimpdead;?></td>
  </tr>  
</table>
