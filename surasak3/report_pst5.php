<?
$today = date("Y-m-d H:i:s");
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
$thmonth=$thyear."-".$month;
?>
<div align="center">
<p><strong>รายงานจำนวนผู้ป่วยนอกจำแนกตามสาเหตุป่วย ( รง.ผสต.5 )<br>
หน่วยงาน  โรงพยาบาลค่ายสุรศักดิ์มนตรี <br>
ประจำเดือน <?=$mon;?>&nbsp;ปี <?=$thyear;?>
</strong></p>
  <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td width="6%" rowspan="2" align="center"><strong>กลุ่มโรคที่</strong></td>
      <td width="11%" rowspan="2" align="center"><strong>รหัสโรค</strong></td>
      <td width="62%" rowspan="2" align="center"><strong>สาเหตุการป่วย (ชื่อโรค)</strong></td>
      <td colspan="3" align="center"><strong>จำนวนผู้ป่วยนอก</strong></td>
    </tr>
    <tr>
      <td width="7%" align="center"><strong>ก</strong></td>
      <td width="7%" align="center"><strong>ข</strong></td>
      <td width="7%" align="center"><strong>ค</strong></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>1</p></td>
      <td align="center" valign="top"><p>A00 - A09 <br />
      B00 - B99 </p></td>
      <td align="left" valign="top"><p>โรคติดเชื้อและปรสิต<br />
      Cetain infectious and parasitic diseases</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and (diag.icd10 like 'A%' or diag.icd10 like 'B%') and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	  //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 // echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag1="โรคติดเชื้อและปรสิต Cetain infectious and parasitic diseases";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag1)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag1'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag1', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag1'";
				$query=mysql_query($edit);
			}
	  } 
	  ?>
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>2</p></td>
      <td align="center" valign="top"><p>C00 - C97<br />
      D00 - D48</p></td>
      <td align="left" valign="top"><p>เนื้องอก (รวมมะเร็ง)<br />
      Neopiasms</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and (diag.icd10 like 'C%' or diag.icd10 like 'D0%' or  diag.icd10 like 'D1%' or diag.icd10 like 'D2%' or diag.icd10 like 'D3%' or diag.icd10 like 'D4%') and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag2="เนื้องอก (รวมมะเร็ง) Neopiasms";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag2)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag2'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag2', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag2'";
				$query=mysql_query($edit);
			}
	  } 
	  ?> 
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>3</p></td>
      <td align="center" valign="top"><p>D50 - D89</p></td>
      <td align="left" valign="top"><p>โรคเลือดและอวัยวะสร้างเลือดและความผิดปกติเกี่ยวกับภูมิคุ้มกัน<br />
      Diseases of the blood forming organs and certain disorders involving the immune mechanism</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and (diag.icd10 like 'D5%' or  diag.icd10 like 'D6%' or diag.icd10 like 'D7%' or diag.icd10 like 'D8%') and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag3="โรคเลือดและอวัยวะสร้างเลือดและความผิดปกติเกี่ยวกับภูมิคุ้มกัน Diseases of the blood forming organs and certain disorders involving the immune mechanism";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag3)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag3'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag3', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag3'";
				$query=mysql_query($edit);
			}
	  } 	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>4</p></td>
      <td align="center" valign="top"><p>E00 - E90</p></td>
      <td align="left" valign="top"><p>โรคเกี่ยวกับต่อมไร้ท่อ โภชนาการ และเมตะบอลิสัม<br />
      Endocnine,nutritional and metabolic diseases</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'E%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag4="โรคเกี่ยวกับต่อมไร้ท่อ โภชนาการ และเมตะบอลิสัม Endocnine,nutritional and metabolic diseases";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag4)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag4'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag4', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag4'";
				$query=mysql_query($edit);
			}
	  } 	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>5</p></td>
      <td align="center" valign="top"><p>F00 - F99</p></td>
      <td align="left" valign="top"><p>ภาวะแปรปรวนทางจิตและพฤติกรรม<br />
      Mental and belhavioural disorders</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'F%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag5="ภาวะแปรปรวนทางจิตและพฤติกรรม Mental and belhavioural disorders";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag5)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag5'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag5', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag5'";
				$query=mysql_query($edit);
			}
	  } 	  	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>6</p></td>
      <td align="center" valign="top"><p>G00 - G99</p></td>
      <td align="left" valign="top"><p>โรคระบบประสาท<br />
      Diseases of the nervous system</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'G%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag6="โรคระบบประสาท Diseases of the nervous system";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag6)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag6'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag6', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag6'";
				$query=mysql_query($edit);
			}
	  } 	  	  	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>7</p></td>
      <td align="center" valign="top"><p>H00 - H59</p></td>
      <td align="left" valign="top"><p>โรคตารวมส่วนประกอบของตา<br />
      Diseases of the eye and adnexa</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and (diag.icd10 like 'H0%' or diag.icd10 like 'H1%' or diag.icd10 like 'H2%'  or diag.icd10 like 'H3%'  or diag.icd10 like 'H4%'  or diag.icd10 like 'H5%') and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag7="โรคตารวมส่วนประกอบของตา Diseases of the eye and adnexa";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag7)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag7'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag7', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag7'";
				$query=mysql_query($edit);
			}
	  } 		  
	  ?>       
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>8</p></td>
      <td align="center" valign="top"><p>H60 - H95</p></td>
      <td align="left" valign="top"><p>โรคหูและปุ่มกกหู<br />
      Diseases of the ear and mastoid process</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and (diag.icd10 like 'H6%' or diag.icd10 like 'H7%' or diag.icd10 like 'H8%'  or diag.icd10 like 'H9%') and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag8="โรคหูและปุ่มกกหู Diseases of the ear and mastoid process";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag8)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag8'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag8', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag8'";
				$query=mysql_query($edit);
			}
	  } 		  	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>9</p></td>
      <td align="center" valign="top"><p>I00 - I99</p></td>
      <td align="left" valign="top"><p>โรคระบบไหลเวียนเลือด<br />
      Diseases of the circulatory system</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'I%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag9="โรคระบบไหลเวียนเลือด Diseases of the circulatory system";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag9)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag9'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag9', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag9'";
				$query=mysql_query($edit);
			}
	  } 		  	  	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>10</p></td>
      <td align="center" valign="top"><p>J00 - J99</p></td>
      <td align="left" valign="top"><p>โรคระบบหายใจ<br />
      Diseases of the respiratory system</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'J%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag10="โรคระบบหายใจ Diseases of the respiratory system";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag10)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag10'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag10', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag10'";
				$query=mysql_query($edit);
			}
	  } 		  	  	  	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>11</p></td>
      <td align="center" valign="top"><p>K00 - K93</p></td>
      <td align="left" valign="top"><p>โรคระบบย่อยอาหาร รวมโรคในช่องปาก<br />
      Diseases of the digestive system</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'K%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag11="โรคระบบย่อยอาหาร รวมโรคในช่องปาก Diseases of the digestive system";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag11)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag11'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag11', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag11'";
				$query=mysql_query($edit);
			}
	  } 		  	  	  	  	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>12</p></td>
      <td align="center" valign="top"><p>L00 - L99</p></td>
      <td align="left" valign="top"><p>โรคผิวหนังและเนื้อเยื้อใต้ผิวหนัง<br />
      Diseases of the skin and subcutaneous tissue</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'L%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag12="โรคผิวหนังและเนื้อเยื้อใต้ผิวหนัง Diseases of the skin and subcutaneous tissue";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag12)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag12'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag12', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag12'";
				$query=mysql_query($edit);
			}
	  } 		  		  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>13</p></td>
      <td align="center" valign="top"><p>M00 - M99</p></td>
      <td align="left" valign="top"><p>โรคระบบกล้ามเนื้อ รวมโครงร่าง และเนื้อยึดเสริม<br />
      Diseases of the musculoskeletal system and connective tissue</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'M%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag13="โรคระบบกล้ามเนื้อ รวมโครงร่าง และเนื้อยึดเสริม Diseases of the musculoskeletal system and connective tissue";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag13)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag13'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag13', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag13'";
				$query=mysql_query($edit);
			}
	  } 		  		  	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>14</p></td>
      <td align="center" valign="top"><p>N00 - N99</p></td>
      <td align="left" valign="top"><p>โรคระบบสืบพันธุ์ร่วมปัสสาวะ<br />
      Diseases of the genitouninary system</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'N%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag14="โรคระบบสืบพันธุ์ร่วมปัสสาวะ Diseases of the genitouninary system";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag14)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag14'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag14', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag14'";
				$query=mysql_query($edit);
			}
	  } 		  	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>15</p></td>
      <td align="center" valign="top"><p>O00 - O99</p></td>
      <td align="left" valign="top"><p>ภาวะแทรกในการตั้งครรภ์ การคลอด และระยะคลอด<br />
      Complication of pregnancy,childbirth and the puerpeium</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'O%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag15="ภาวะแทรกในการตั้งครรภ์ การคลอด และระยะคลอด Complication of pregnancy,childbirth and the puerpeium";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag15)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag15'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag15', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag15'";
				$query=mysql_query($edit);
			}
	  }	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>16</p></td>
      <td align="center" valign="top"><p>P00 - P96</p></td>
      <td align="left" valign="top"><p>ภาวะผิดปกติของทารกที่เกิดขึ้นในระยะปริกำเนิด( อายุครรภ์ 22 สัปดาห์ขึ้นไปจนถึง 7 วัน หลังคลอด ) <br />
      Centain conditions orginating in the perinatal period</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'P%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag16="ภาวะผิดปกติของทารกที่เกิดขึ้นในระยะปริกำเนิด( อายุครรภ์ 22 สัปดาห์ขึ้นไปจนถึง 7 วัน หลังคลอด ) Centain conditions orginating in the perinatal period";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag16)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag16'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag16', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag16'";
				$query=mysql_query($edit);
			}
	  }	  	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>17</p></td>
      <td align="center" valign="top"><p>Q00 - Q99</p></td>
      <td align="left" valign="top"><p>รูปร่างผิดปกติแต่กำเนิด การพิการจนผิดรูปแต่กำเนิด และ โครโมโซมผิดปกต<br />
      ิCongential malformations,deformations and chromosomal abnormalities</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'Q%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag17="รูปร่างผิดปกติแต่กำเนิด การพิการจนผิดรูปแต่กำเนิด และ โครโมโซมผิดปกติ Congential malformations,deformations and chromosomal abnormalities";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag17)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag17'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag17', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag17'";
				$query=mysql_query($edit);
			}
	  }	 	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>18</p></td>
      <td align="center" valign="top"><p>R00 - R99</p></td>
      <td align="left" valign="top"><p>อาการ,อาการแสดง และสิ่งปกติที่พบได้จากการตรวจทางคลินิกและทางห้องปฏิบัติการที่ไม่สามารถจำแนกโรคในกลุ่มอื่น<br />
      Symptoms,signs and abnormal clinical and laboratory finding,not elssewhere classified</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'R%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag18="อาการ,อาการแสดง และสิ่งปกติที่พบได้จากการตรวจทางคลินิกและทางห้องปฏิบัติการที่ไม่สามารถจำแนกโรคในกลุ่มอื่น Symptoms,signs and abnormal clinical and laboratory finding,not elssewhere classified";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag18)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag18'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag18', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag18'";
				$query=mysql_query($edit);
			}
	  }	 	  	  
	  ?>            
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>19</p></td>
      <td align="center" valign="top"><p>X40 - X49<br />
        X60 - X69<br />
      X85 - X90<br />
      Y10 - Y19</p></td>
      <td align="left" valign="top"><p>การเป็นพิษและผลที่ตามมา<br />
      Poisoning,toxic effect,and their sequelae</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and (diag.icd10 like 'X6%' or  diag.icd10 like 'X85%' or  diag.icd10 like 'X86%' or  diag.icd10 like 'X87%' or  diag.icd10 like 'X88%' or  diag.icd10 like 'X89%' or  diag.icd10 like 'X90%' or  diag.icd10 like 'Y1%') and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag19="การเป็นพิษและผลที่ตามมา Poisoning,toxic effect,and their sequelae";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag19)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag19'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag19', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag19'";
				$query=mysql_query($edit);
			}
	  }	 	  
	  ?>       
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td align="center" valign="top"><p>20</p></td>
      <td align="center" valign="top"><p>V01 - V99</p></td>
      <td align="left" valign="top"><p>อุบัติเหตุจากการขนส่ง และผลที่ตามมา<br />
      Transport accidents and their sequelae</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and diag.icd10 like 'V%' and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag20="อุบัติเหตุจากการขนส่ง และผลที่ตามมา Transport accidents and their sequelae";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag20)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag20'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag20', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag20'";
				$query=mysql_query($edit);
			}
	  }	 	  
	  ?>       
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td height="80" align="center" valign="top"><p>21</p></td>
      <td align="center" valign="top"><p>W00 - W99<br />
        X00 - X19<br />
        X20 - X29<br />
        X30 - X39<br />
      </p></td>
      <td align="left" valign="top"><p>สาเหตุจากภายนอกอื่นๆ ที่ทำให้ป่วยหรือตาย<br />
      Qther external cause of morbidity and mortality(eg.accidentinjuries,intentional self-harm,assault,animals and plants,Complications of medical and surgical care and other unsepecified causes )</p></td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and (diag.icd10 like 'W0%' or diag.icd10 like 'W1%' or diag.icd10 like 'W2%' or diag.icd10 like 'W3%' or diag.icd10 like 'W4%' or diag.icd10 like 'W5%' or diag.icd10 like 'W6%' or diag.icd10 like 'W7%' or diag.icd10 like 'W8%' or diag.icd10 like 'W9%' or diag.icd10 like 'X0%' or  diag.icd10 like 'X1%' or  diag.icd10 like 'X2%' or  diag.icd10 like 'X3%') and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag21="สาเหตุจากภายนอกอื่นๆ ที่ทำให้ป่วยหรือตาย Qther external cause of morbidity and mortality(eg.accidentinjuries,intentional self-harm,assault,animals and plants,Complications of medical and surgical care and other unsepecified causes)";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag21)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag21'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag21', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag21'";
				$query=mysql_query($edit);
			}
	  }	 	  
	  ?>       
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td height="100" align="center" valign="top">22</td>
      <td align="center" valign="top">X50 - X99<br />
Y00 - Y09<br />
Y20 - Y36<br />
Y40 - Y84<br />
Y86 - Y89</td>
      <?
	  $sql="select * from diag left join opcard on diag.hn=opcard.hn where diag.type='PRINCIPLE' and (diag.icd10 like 'X5%' or  diag.icd10 like 'X6%' or  diag.icd10 like 'X7%' or  diag.icd10 like 'X8%' or  diag.icd10 like 'X9%' or  diag.icd10 like 'Y2%' or  diag.icd10 like 'Y31%' or  diag.icd10 like 'Y32%' or  diag.icd10 like 'Y33%' or  diag.icd10 like 'Y34%' or  diag.icd10 like 'Y35%' or  diag.icd10 like 'Y36%' or  diag.icd10 like 'Y4%' or  diag.icd10 like 'Y5%' or  diag.icd10 like 'Y6%' or  diag.icd10 like 'Y7%' or  diag.icd10 like 'Y81%' or  diag.icd10 like 'Y82%' or  diag.icd10 like 'Y83%' or  diag.icd10 like 'Y84%' or  diag.icd10 like 'Y86%' or  diag.icd10 like 'Y87%' or  diag.icd10 like 'Y88%' or  diag.icd10 like 'Y89%') and  diag.regisdate between '$thyear-$month-01 00:00:00' and '$thyear-$month-31 23:59:59'";
	 //echo $sql."<br>";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  //echo $num."<br>";
	  $ab1=0;
	  $ab2=0;
	  $ab3=0;
	  while($rows=mysql_fetch_array($query)){
	  $group=substr($rows["goup"],0,2);
	  $an=substr($rows["an"],2,1);
	 //echo "--->".$an."<br>";
	 // echo "--->".$group."<br>";
		 if($an !="/"){
			if($group=="G1"){
				$ab1++;
			}
			if($group=="G2"){
				$ab2++;		
			}
			if($group=="G3" || $group=="G4"){
				$ab3++;	
			}
		  }  //close if an
	  }  //close while
	  $diag21="สาเหตุจากภายนอกอื่นๆ ที่ทำให้ป่วยหรือตาย Qther external cause of morbidity and mortality(eg.accidentinjuries,intentional self-harm,assault,animals and plants,Complications of medical and surgical care and other unsepecified causes)";
	  $case1=$ab1;
	  $case2=$ab2;
	  $case3=$ab3;
	  $sumcase=$ab1+$ab2+$ab3;
	  if(!empty($diag21)){
		$tbsql="select * from pstmax where yrmonth= '$thmonth' && diag='$diag21'";
		$result=mysql_query($tbsql);
		$num=mysql_num_rows($result);
			if($num < 1){	  
				$add="insert into pstmax set date_time='$today', yrmonth='$thmonth', diag='$diag21', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' ";
				$query=mysql_query($add);
			}else{
				$edit="update pstmax set date_time='$today', case1='$case1', case2='$case2', case3='$case3', sumcase='$sumcase' where yrmonth= '$thmonth' && diag='$diag21'";
				$query=mysql_query($edit);
			}
	  }	 	  
	  ?>       

      <td align="left" valign="top">&nbsp;</td>
      <td align="center"><?=$ab1;?></td>
      <td align="center"><?=$ab2;?></td>
      <td align="center"><?=$ab3;?></td>
    </tr>
    <tr>
      <td height="20" align="center" valign="top">&nbsp;</td>
      <td align="center" valign="top">&nbsp;</td>
      <td align="left" valign="top">สาเหตุป่วยอื่นๆ ที่มิได้จัดจำแนกไว้ในกลุ่มโรคที่ 1-21 ดังกล่าวข้างต้น</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
  <table width="71%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="6%">หมายเหตุ </td>
      <td width="94%" align="left">- รหัสโรค S00-T95 ไม่ใช้รายงาน รง.ผสต.5 นี้ เพราะให้ใช้รหัส V01-Y89 แล้ว</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="left">- กลุ่มโรคลำดับที่ 19 ไม่รวมการถูกพิษจากสัตว์หรือพืช </td>
    </tr>
  </table>
</div>
