<?
session_start();
include("connect.inc");

		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;
		$newPrefix="25".$nPrefix;
		
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<title>รายงานสรุปตรวจร่างกายทหารประจำปี</title>
<p align="center"><strong>รายงานสรุปตรวจร่างกายทหารประจำปี <?=$newPrefix;?></strong></p>
<form name="form1" method="post" action="<? $PHP_SELF;?>" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">หน่วย :
        <label>      
        <select name="camp" id="camp">
        <option value="all">ทั้งหมดทุกหน่วย</option>
		 <?
		 $sql="select distinct(camp) as camp from armychkup where yearchkup='$nPrefix' and camp !='' and camp !='D34 กทพ.33'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=substr($rows["camp"],4);
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <input type="submit" name="button" id="button" value="ดูรายงาน">
        </label></td>
    </tr>
  </table>
</form>
<?
if($_POST["act"]=="show"){
if($_POST["camp"]=="all"){ $showcamp="ทุกหน่วย";}else{ $showcamp=$_POST["camp"];}
$camp=$_POST["camp"];
$chkcamp=substr($camp,0,3);
?>
<div align="center"><strong>รายงานผลตรวจสุขภาพทหารประจำปี 2560</strong></div>
<div align="center"><strong>หน่วย : <?=$showcamp;?></strong></div>
<div style="margin-left:30px;"><strong>ประเมินสภาวะร่างกาย</strong></div>
<div style="margin-left:40px;">/ คือ อยู่ในเกณฑ์มาตรฐาน</div>
<div style="margin-left:40px;">X คือ เกินเกณฑ์มาตรฐาน</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" align="center" bgcolor="#FF9999"><strong>ลำดับ</strong></td>
    <td width="32%" align="center" bgcolor="#FF9999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="7%" align="center" bgcolor="#FF9999"><strong>สังกัด</strong></td>
    <td width="7%" align="center" bgcolor="#FF9999"><strong>อายุ</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>BMI</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>ผล</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>เส้นรอบเอว</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>ผล</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>% FAT</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>Fat Mass</strong></td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>Muscle Mass</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
	$sql = "select * from armychkup where yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}else{
	$sql = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}		
		//echo $sql;
		$query = mysql_query($sql);  		
		$i=0;
		while($result=mysql_fetch_array($query)){
		$i++;
		$ptname=$result["yot"]." ".$result["ptname"];
		$age=$result["age"];
		$fatmass=$result["fat_mass"];
		$musclemass=$result["muscle_mass"];
			if($result['bmi'] >=25.0){
				$chkbmi="X";
			}else{
				$chkbmi="/";
			}
		
			if($result["gender"]=="1"){
				if($result["waist"] >=35.4){
					$chkwaist="X";
				}else{
					$chkwaist="/";
				}
			}else if($result["gender"]=="2"){
				if($result["waist"] >=31.5){
					$chkwaist="X";
				}else{
					$chkwaist="/";
				}	
			}
			
			if($result['result_fat'] >=4){
				$chkfat="X";
			}else{
				$chkfat="/";
			}
			
//เก็บสถิติ
$gender1=$result['gender'];  //เพศ
if($age < 35){  //อายุน้อยกว่า 35 ปี
$totalgender34++;
$sumbmi++;	
$sumwaist++;
$sumfat++;	
		
	if($result['bmi'] >=25.0){  //bmi ไม่ผ่าน
		$sumbmi34++;
		if($gender1 == 1){  //ชาย
			$sumbmim34++;
		}else{
			$sumbmif34++;
		}
	}else{  //bmi ผ่าน
		$oksumbmi34++;
		if($gender1 == 1){  //ชาย
			$oksumbmim34++;
		}else{
			$oksumbmif34++;
		}
	}

	if($result["gender"]=="1"){  //ชาย
		if($result["waist"] >=35.4){  //เส้นรอบเอวไม่ผ่าน
			$sumwaist34++;  //รวม
			$sumwaistm34++;  //จำนวน
		}else{//เส้นรอบเอวผ่าน
			$oksumwaist34++;  //รวม
			$oksumwaistm34++;  //จำนวน
		}
	}else if($result["gender"]=="2"){ //หญิง
		if($result["waist"] >=31.5){  //เส้นรอบเอวไม่ผ่าน
			$sumwaist34++;  //รวม
			$sumwaistf34++;  //จำนวน
		}else{//เส้นรอบเอวผ่าน
			$oksumwaist34++;  //รวม
			$oksumwaistf34++;  //จำนวน
		}
	}
	
	if($result['result_fat']=="4" || $result['result_fat']=="5"){  //fat ไม่ผ่าน
		$sumfat34++;
		if($gender1 == 1){  //ชาย
			$sumfatm34++;
		}else{
			$sumfatf34++;
		}
	}else{  //fat ผ่าน
		$oksumfat34++;
		if($gender1 == 1){  //ชาย
			$oksumfatm34++;
		}else{
			$oksumfatf34++;
		}
	}			
	
}else{  //อายุ >=35
$totalgender35++;
$sumbmi++;	
$sumwaist++;
$sumfat++;	

	if($result['bmi'] >=25.0){  //bmi ไม่ผ่าน
		$sumbmi35++;
		if($gender1 == 1){  //ชาย
			$sumbmim35++;
		}else{
			$sumbmif35++;
		}
	}else{  //bmi ผ่าน
		$oksumbmi35++;
		if($gender1 == 1){  //ชาย
			$oksumbmim35++;
		}else{
			$oksumbmif35++;
		}
	}

	if($result["gender"]=="1"){  //ชาย
		if($result["waist"] >=35.4){  //เส้นรอบเอวไม่ผ่าน
			$sumwaist35++;  //รวม
			$sumwaistm35++;  //จำนวน
		}else{//เส้นรอบเอวผ่าน
			$oksumwaist35++;  //รวม
			$oksumwaistm35++;  //จำนวน
		}
	}else if($result["gender"]=="2"){ //หญิง
		if($result["waist"] >=31.5){  //เส้นรอบเอวไม่ผ่าน
			$sumwaist35++;  //รวม
			$sumwaistf35++;  //จำนวน
		}else{//เส้นรอบเอวผ่าน
			$oksumwaist35++;  //รวม
			$oksumwaistf35++;  //จำนวน
		}
	}
	
		
	if($result['result_fat']=="4" || $result['result_fat']=="5"){  //fat ไม่ผ่าน
		$sumfat35++;
		if($gender1 == 1){  //ชาย
			$sumfatm35++;
		}else{
			$sumfatf35++;
		}
	}else{  // fat ผ่าน
		$oksumfat35++;
		if($gender1 == 1){  //ชาย
			$oksumfatm35++;
		}else{
			$oksumfatf35++;
		}
	}	
	
}			
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname;?></div></td>
    <td align="center"><?=substr($result['camp'],4);?></td>
    <td align="center"><?=$age;?></td>
    <td align="center"><strong>
      <?=$chkbmi;?>
    </strong></td>
    <td align="center"><?=$result['bmi'];?></td>
    <td align="center"><strong>
      <?=$chkwaist;?>
    </strong></td>
    <td align="center"><?=$result['waist'];?></td>
    <td align="center"><strong>
      <?=$chkfat;?>
    </strong></td>
    <td align="center"><strong>
      <?=$fatmass;?>
    </strong></td>
    <td align="center"><strong>
      <?=$musclemass;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<div align="center"><strong>สรุปผลการประเมินสภาวะร่างกาย</strong></div>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="16%" rowspan="4" align="center"><strong>สภาวะร่างกาย</strong></td>
    <td colspan="13" align="center"><strong>จำนวนกำลังพล/ราย</strong></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><strong>อายุไม่เกิน 35 ปีบริบูรณ์</strong></td>
    <td colspan="6" align="center"><strong>อายุมากกว่า 35 ปีบริบูรณ์</strong></td>
    <td width="8%" rowspan="3" align="center"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center">เกณฑ์มาตรฐาน</td>
    <td colspan="3" align="center">เกินเกณฑ์</td>
    <td colspan="3" align="center">เกณฑ์มาตรฐาน</td>
    <td colspan="3" align="center">เกินเกณฑ์</td>
  </tr>
  <tr>
    <td align="center">ชาย</td>
    <td align="center">หญิง</td>
    <td align="center">รวม</td>
    <td width="6%" align="center">ชาย</td>
    <td width="6%" align="center">หญิง</td>
    <td width="6%" align="center">รวม</td>
    <td align="center">ชาย</td>
    <td align="center">หญิง</td>
    <td align="center">รวม</td>
    <td width="7%" align="center">ชาย</td>
    <td width="7%" align="center">หญิง</td>
    <td width="7%" align="center">รวม</td>
  </tr>
  <tr>
    <td><strong>BMI</strong></td>
    <td align="center"><? if(empty($oksumbmim34)){ echo "0";}else{ echo $oksumbmim34;}?></td>
    <td align="center"><? if(empty($oksumbmif34)){ echo "0";}else{ echo $oksumbmif34;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumbmi34)){ echo "0";}else{ echo $oksumbmi34;}?>
    </strong></td>
    <td align="center"><? if(empty($sumbmim34)){ echo "0";}else{ echo $sumbmim34;}?></td>
    <td align="center"><? if(empty($sumbmif34)){ echo "0";}else{ echo $sumbmif34;}?></td>
    <td align="center"><strong>
      <? if(empty($sumbmi34)){ echo "0";}else{ echo $sumbmi34;}?>
    </strong></td>
    <td align="center"><? if(empty($oksumbmim35)){ echo "0";}else{ echo $oksumbmim35;}?></td>
    <td align="center"><? if(empty($oksumbmif35)){ echo "0";}else{ echo $oksumbmif35;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumbmi35)){ echo "0";}else{ echo $oksumbmi35;}?>
    </strong></td>
    <td align="center"><? if(empty($sumbmim35)){ echo "0";}else{ echo $sumbmim35;}?></td>
    <td align="center"><? if(empty($sumbmif35)){ echo "0";}else{ echo $sumbmif35;}?></td>
    <td align="center"><strong>
      <? if(empty($sumbmi35)){ echo "0";}else{ echo $sumbmi35;}?>
    </strong></td>
    <td align="center"><strong>
      <? if(empty($sumbmi)){ echo "0";}else{ echo $sumbmi;}?>
    </strong></td>
  </tr>
  <tr>
    <td><strong>เส้นรอบเอว</strong></td>
    <td align="center"><? if(empty($oksumwaistm34)){ echo "0";}else{ echo $oksumwaistm34;}?></td>
    <td align="center"><? if(empty($oksumwaistf34)){ echo "0";}else{ echo $oksumwaistf34;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumwaist34)){ echo "0";}else{ echo $oksumwaist34;}?>
    </strong></td>
    <td align="center"><? if(empty($sumwaistm34)){ echo "0";}else{ echo $sumwaistm34;}?></td>
    <td align="center"><? if(empty($sumwaistf34)){ echo "0";}else{ echo $sumwaistf34;}?></td>
    <td align="center"><strong>
      <? if(empty($sumwaist34)){ echo "0";}else{ echo $sumwaist34;}?>
    </strong></td>
    <td align="center"><? if(empty($oksumwaistm35)){ echo "0";}else{ echo $oksumwaistm35;}?></td>
    <td align="center"><? if(empty($oksumwaistf35)){ echo "0";}else{ echo $oksumwaistf35;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumwaist35)){ echo "0";}else{ echo $oksumwaist35;}?>
    </strong></td>
    <td align="center"><? if(empty($sumwaistm35)){ echo "0";}else{ echo $sumwaistm35;}?></td>
    <td align="center"><? if(empty($sumwaistf35)){ echo "0";}else{ echo $sumwaistf35;}?></td>
    <td align="center"><strong>
      <? if(empty($sumwaist35)){ echo "0";}else{ echo $sumwaist35;}?>
    </strong></td>
    <td align="center"><strong>
      <? if(empty($sumwaist)){ echo "0";}else{ echo $sumwaist;}?>
    </strong></td>
  </tr>
  <tr>
    <td><strong>% FAT</strong></td>
    <td align="center"><? if(empty($oksumfatm34)){ echo "0";}else{ echo $oksumfatm34;}?></td>
    <td align="center"><? if(empty($oksumfatf34)){ echo "0";}else{ echo $oksumfatf34;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumfat34)){ echo "0";}else{ echo $oksumfat34;}?>
    </strong></td>
    <td align="center"><? if(empty($sumfatm34)){ echo "0";}else{ echo $sumfatm34;}?></td>
    <td align="center"><? if(empty($sumfatf34)){ echo "0";}else{ echo $sumfatf34;}?></td>
    <td align="center"><strong>
      <? if(empty($sumfat34)){ echo "0";}else{ echo $sumfat34;}?>
    </strong></td>
    <td align="center"><? if(empty($oksumfatm35)){ echo "0";}else{ echo $oksumfatm35;}?></td>
    <td align="center"><? if(empty($oksumfatf35)){ echo "0";}else{ echo $oksumfatf35;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumfat35)){ echo "0";}else{ echo $oksumfat35;}?>
    </strong></td>
    <td align="center"><? if(empty($sumfatm35)){ echo "0";}else{ echo $sumfatm35;}?></td>
    <td align="center"><? if(empty($sumfatf35)){ echo "0";}else{ echo $sumfatf35;}?></td>
    <td align="center"><strong>
      <? if(empty($sumfat35)){ echo "0";}else{ echo $sumfat35;}?>
    </strong></td>
    <td align="center"><strong>
      <? if(empty($sumfat)){ echo "0";}else{ echo $sumfat;}?>
    </strong></td>
  </tr>
</table>
<br />
<?
$avggender34=($totalgender34*100)/$i;
$avggender35=($totalgender35*100)/$i;
?>
<div style="margin-left: 70px;"><strong>กำลังพล รวมทั้งสิ้น 
  <?=$i;?> 
ราย</strong></div>
<div style="margin-left: 70px;">อายุไม่เกิน 35 ปีบริบูรณ์ <span style="margin-left: 40px;"><?=$totalgender34;?> ราย</span><span style="margin-left: 30px;">คิดเป็น <?=number_format($avggender34,2);?> %</span></div>
<div style="margin-left: 70px;">อายุมากกว่า 35 ปีบริบูรณ์ <span style="margin-left: 25px;"><?=$totalgender35;?> ราย</span><span style="margin-left: 30px;">คิดเป็น <?=number_format($avggender35,2);?> %</span></div>
<?
$perbmi34=($oksumbmi34*100)/$totalgender34;
$perwaist34=($oksumwaist34*100)/$totalgender34;
$perfat34=($oksumfat34*100)/$totalgender34;

$perbmi35=($oksumbmi35*100)/$totalgender35;
$perwaist35=($oksumwaist35*100)/$totalgender35;
$perfat35=($oksumfat35*100)/$totalgender35;
?>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="19%" align="center"><strong>สภาวะร่างกาย/ตามเกณฑ์มาตรฐาน</strong></td>
    <td align="center"><strong>อายุไม่เกิน 35 ปีบริบูรณ์</strong></td>
    <td align="center"><strong>อายุมากกว่า 35 ปีบริบูรณ์</strong></td>
  </tr>
  
  <tr>
    <td bordercolor="#000000"><strong>BMI</strong></td>
    <td width="16%" align="center"><? if(empty($perbmi34)){ echo "0";}else{ echo number_format($perbmi34,2);}?> %</td>
    <td width="16%" align="center"><? if(empty($perbmi35)){ echo "0";}else{ echo number_format($perbmi35,2);}?>
      %</td>
  </tr>
  <tr>
    <td bordercolor="#000000"><strong>เส้นรอบเอว</strong></td>
    <td align="center"><? if(empty($perwaist34)){ echo "0";}else{ echo number_format($perwaist34,2);}?> %</td>
    <td align="center"><? if(empty($perwaist35)){ echo "0";}else{ echo number_format($perwaist35,2);}?>
      %</td>
  </tr>
  <tr>
    <td bordercolor="#000000"><strong>% FAT</strong></td>
    <td align="center"><? if(empty($perfat34)){ echo "0";}else{ echo number_format($perfat34,2);}?> %</td>
    <td align="center"><? if(empty($perfat35)){ echo "0";}else{ echo number_format($perfat35,2);}?>
      %</td>
  </tr>
</table>
<br />
<div style="page-break-after: always"></div>


<div style="margin-left:30px;"><strong>ทดสอบสมรรถนะ/ความแข็งแรงของร่างกาย</strong></div>
<div style="margin-left:40px;">/ คือ อยู่ในเกณฑ์มาตรฐาน</div>
<div style="margin-left:40px;">X คือ น้อยกว่าเกณฑ์มาตรฐาน</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="3%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="26%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="6%" rowspan="2" align="center" bgcolor="#66CC99"><strong>สังกัด</strong></td>
    <td width="6%" rowspan="2" align="center" bgcolor="#66CC99"><strong>อายุ</strong></td>
    <td width="11%" rowspan="2" align="center" bgcolor="#66CC99"><strong>แรงบีบมือ</strong></td>
    <td width="11%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ผล</strong></td>
    <td width="11%" rowspan="2" align="center" bgcolor="#66CC99"><strong>แรงเหยียดขา</strong></td>
    <td width="11%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ผล</strong></td>
    <td width="12%" rowspan="2" align="center" bgcolor="#66CC99"><strong>3 Minute Test</strong></td>
    <td width="11%" rowspan="2" align="center" bgcolor="#66CC99"><strong>ผล</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>ทดสอบร่างกาย อายุน้อยกว่า 35 ป</strong>ี</td>
  </tr>
  <tr>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>ดันพื้น</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>ลุก-นั่ง</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>วิ่ง</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){		
	$sql1 = "select * from armychkup where yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}else{
	$sql1 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}	
		//echo $sql;
		$query1 = mysql_query($sql1);  		
		$i=0;
		while($result1=mysql_fetch_array($query1)){
		$i++;
		$ptname1=$result1["yot"]." ".$result1["ptname"];
		$age1=$result1["age"];
		if($result1['result_hand'] ==1){
			$hand="ต่ำ";
		}else if($result1['result_hand'] ==2){
			$hand="ค่อนข้างต่ำ";
		}else if($result1['result_hand'] ==3){
			$hand="พอใช้";
		}else if($result1['result_hand'] ==4){
			$hand="ดี";
		}else if($result1['result_hand'] ==5){
			$hand="ดีมาก";
		}else{
			$hand="ไม่ได้ทดสอบ";
		}
		
		if($result1['result_leg'] ==1){
			$leg="ต่ำ";
		}else if($result1['result_leg'] ==2){
			$leg="ค่อนข้างต่ำ";
		}else if($result1['result_leg'] ==3){
			$leg="พอใช้";
		}else if($result1['result_leg'] ==4){
			$leg="ดี";
		}else if($result1['result_leg'] ==5){
			$leg="ดีมาก";
		}else{
			$leg="ไม่ได้ทดสอบ";
		}	
		
		
		if($result1['result_steptest'] ==1){
			$steptest="ต่ำ";
		}else if($result1['result_steptest'] ==2){
			$steptest="ค่อนข้างต่ำ";
		}else if($result1['result_steptest'] ==3){
			$steptest="พอใช้";
		}else if($result1['result_steptest'] ==4){
			$steptest="ดี";
		}else if($result1['result_steptest'] ==5){
			$steptest="ดีมาก";
		}else{
			$steptest="ไม่ได้ทดสอบ";
		}
		
				
			if($result1['result_hand'] <=3){
				$chkhand="X";
			}else if($result1['result_hand'] >3){
				$chkhand="/";
			}else{
				$chkhand="-";
			}
			
			if($result1['result_leg'] <=3){
				$chkleg="X";
			}else if($result1['result_leg'] > 3){
				$chkleg="/";
			}else{
				$chkleg="-";
			}
			
			if($result1['result_steptest'] <=3){
				$chksteptest="X";
			}else if($result1['result_steptest'] > 3){
				$chksteptest="/";
			}else{
				$chksteptest="-";
			}
					
			if($result1['age'] < 35){
			
				if($result1['pressure_result'] =="ไม่ผ่าน"){
					$chkpressure="X";
				}else if($result1['pressure_result'] =="ผ่าน"){
					$chkpressure="/";
				}else{
					$chkpressure="รอทดสอบ";
				}
				
				if($result1['situp_result'] =="ไม่ผ่าน"){
					$chksitup="X";
				}else if($result1['situp_result'] =="ผ่าน"){
					$chksitup="/";
				}else{
					$chksitup="รอทดสอบ";
				}
				
				if($result1['run_result'] =="ไม่ผ่าน"){
					$chkrun="X";
				}else if($result1['run_result'] =="ผ่าน"){
					$chkrun="/";
				}else{
					$chkrun="รอทดสอบ";
				}								
			
			}else if($result1['age'] >= 35){
			
				if($result1['pressure_result'] =="ไม่ผ่าน"){
					$chkpressure="X";
				}else if($result1['pressure_result'] =="ผ่าน"){
					$chkpressure="/";
				}else{
					$chkpressure="-";
				}	
				
				if($result1['situp_result'] =="ไม่ผ่าน"){
					$chksitup="X";
				}else if($result1['situp_result'] =="ผ่าน"){
					$chksitup="/";
				}else{
					$chksitup="-";
				}
				
				if($result1['run_result'] =="ไม่ผ่าน"){
					$chkrun="X";
				}else if($result1['run_result'] =="ผ่าน"){
					$chkrun="/";
				}else{
					$chkrun="-";
				}				
						
			}else{
				$chkpressure="&nbsp;";
				$chksitup="&nbsp;";
				$chkrun="&nbsp;";
			}
			
			
//เก็บสถิติ
$gender1=$result1['gender'];  //เพศ
if($age1 < 35){  //อายุน้อยกว่า 35 ปี
$numgender34++;
$sumhand++;	
$sumleg++;
$sumsteptest++;	
/*$sumpressure++;		
$sumsitup++;
$sumrun++;*/
		
	if($result1['result_hand']=="1" || $result1['result_hand']=="2" || $result1['result_hand']=="3"){  //ดึงแขนไม่ผ่าน
		$sumhand34++;
		if($gender1 == 1){  //ชาย
			$sumhandm34++;
		}else{
			$sumhandf34++;
		}
	}else{  //ดึงแขนผ่าน
		$oksumhand34++;
		if($gender1 == 1){  //ชาย
			$oksumhandm34++;
		}else{
			$oksumhandf34++;
		}
	}

	if($result1['result_leg']=="1" || $result1['result_leg']=="2" || $result1['result_leg']=="3"){  //เหยีดขาไม่ผ่าน
		$sumleg34++;
		if($gender1 == 1){  //ชาย
			$sumlegm34++;
		}else{
			$sumlegf34++;
		}
	}else{  //เหยีดขาผ่าน
		$oksumleg34++;
		if($gender1 == 1){  //ชาย
			$oksumlegm34++;
		}else{
			$oksumlegf34++;
		}
	}
	
	if($result1['result_steptest']=="1" || $result1['result_steptest']=="2" || $result1['result_steptest']=="3"){  //3นาทีไม่ผ่าน
		$sumsteptest34++;
		if($gender1 == 1){  //ชาย
			$sumsteptestm34++;
		}else{
			$sumsteptestf34++;
		}
	}else{  //3นาทีผ่าน
		$oksumsteptest34++;
		if($gender1 == 1){  //ชาย
			$oksumsteptestm34++;
		}else{
			$oksumsteptestf34++;
		}
	}	
	
	if($result1['pressure_result']=="ไม่ผ่าน"){  //ดันพื้นไม่ผ่าน
		$sumpressure34++;
		if($gender1 == 1){  //ชาย
			$sumpressurem34++;
		}else{
			$sumpressuref34++;
		}
	}else if($result1['pressure_result']=="ผ่าน"){  //ดันพื้นผ่าน
		$oksumpressure34++;
		if($gender1 == 1){  //ชาย
			$oksumpressurem34++;
		}else{
			$oksumpressuref34++;
		}
	}	
	
	if($result1['situp_result']=="ไม่ผ่าน"){  //ลุกนั่งไม่ผ่าน
		$sumsitup34++;
		if($gender1 == 1){  //ชาย
			$sumsitupm34++;
		}else{
			$sumsitupf34++;
		}
	}else if($result1['situp_result']=="ผ่าน"){  //ลุกนั่งผ่าน
		$oksumsitup34++;
		if($gender1 == 1){  //ชาย
			$oksumsitupm34++;
		}else{
			$oksumsitupf34++;
		}
	}	
	
	if($result1['run_result']=="ไม่ผ่าน"){  //วิ่งไม่ผ่าน
		$sumrun34++;
		if($gender1 == 1){  //ชาย
			$sumrunm34++;
		}else{
			$sumrunf34++;
		}
	}else if($result1['run_result']=="ผ่าน"){  //วิ่งผ่าน
		$oksumrun34++;
		if($gender1 == 1){  //ชาย
			$oksumrunm34++;
		}else{
			$oksumrunf34++;
		}
	}			
	
}else{  //อายุ >=35
$numgender35++;
$sumhand++;	
$sumleg++;
$sumsteptest++;	
/*$sumpressure++;		
$sumsitup++;
$sumrun++;*/

	if($result1['result_hand']=="1" || $result1['result_hand']=="2" || $result1['result_hand']=="3"){  //ดึงแขนไม่ผ่าน
		$sumhand35++;
		if($gender1 == 1){  //ชาย
			$sumhandm35++;
		}else{
			$sumhandf35++;
		}
	}else{  //ดึงแขนผ่าน
		$oksumhand35++;
		if($gender1 == 1){  //ชาย
			$oksumhandm35++;
		}else{
			$oksumhandf35++;
		}
	}

	if($result1['result_leg']=="1" || $result1['result_leg']=="2" || $result1['result_leg']=="3"){  //เหยีดขาไม่ผ่าน
		$sumleg35++;
		if($gender1 == 1){  //ชาย
			$sumlegm35++;
		}else{
			$sumlegf35++;
		}
	}else{  //เหยีดขาผ่าน
		$oksumleg35++;
		if($gender1 == 1){  //ชาย
			$oksumlegm35++;
		}else{
			$oksumlegf35++;
		}
	}
	
	if($result1['result_steptest']=="1" || $result1['result_steptest']=="2" || $result1['result_steptest']=="3"){  //3นาทีไม่ผ่าน
		$sumsteptest35++;
		if($gender1 == 1){  //ชาย
			$sumsteptestm35++;
		}else{
			$sumsteptestf35++;
		}
	}else{  //3นาทีผ่าน
		$oksumsteptest35++;
		if($gender1 == 1){  //ชาย
			$oksumsteptestm35++;
		}else{
			$oksumsteptestf35++;
		}
	}	
	
	if($result1['pressure_result']=="ไม่ผ่าน"){  //ดันพื้นไม่ผ่าน
		$sumpressure35++;
		if($gender1 == 1){  //ชาย
			$sumpressurem35++;
		}else{
			$sumpressuref35++;
		}
	}else if($result1['pressure_result']=="ผ่าน"){  //ดันพื้นผ่าน
		$oksumpressure35++;
		if($gender1 == 1){  //ชาย
			$oksumpressurem35++;
		}else{
			$oksumpressuref35++;
		}
	}	
	
	if($result1['situp_result']=="ไม่ผ่าน"){  //ลุกนั่งไม่ผ่าน
		$sumsitup35++;
		if($gender1 == 1){  //ชาย
			$sumsitupm35++;
		}else{
			$sumsitupf35++;
		}
	}else if($result1['situp_result']=="ผ่าน"){  //ลุกนั่งผ่าน
		$oksumsitup35++;
		if($gender1 == 1){  //ชาย
			$oksumsitupm35++;
		}else{
			$oksumsitupf35++;
		}
	}	
	
	if($result1['run_result']=="ไม่ผ่าน"){  //วิ่งไม่ผ่าน
		$sumrun35++;
		if($gender1 == 1){  //ชาย
			$sumrunm35++;
		}else{
			$sumrunf35++;
		}
	}else if($result1['run_result']=="ผ่าน"){  //วิ่งผ่าน
		$oksumrun35++;
		if($gender1 == 1){  //ชาย
			$oksumrunm35++;
		}else{
			$oksumrunf35++;
		}
	}
}	
	
				
					
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname1;?></div></td>
    <td align="center"><?=substr($result1['camp'],4);?></td>
    <td align="center"><?=$age1;?></td>
    <td align="center"><strong>
      <?=$chkhand;?>
    </strong></td>
    <td align="center"><strong>
      <?=$hand;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chkleg;?>
    </strong></td>
    <td align="center"><strong>
      <?=$leg;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chksteptest;?>
    </strong></td>
    <td align="center"><strong>
      <?=$steptest;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chkpressure;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chksitup;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chkrun;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<div align="center"><strong>สรุปผลการทดสอบสมรรถนะ/ความแข็งแรงของร่างกาย</strong></div>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="16%" rowspan="4" align="center"><strong>การทดสอบ</strong></td>
    <td colspan="13" align="center"><strong>จำนวนกำลังพล/ราย</strong></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><strong>อายุไม่เกิน 35 ปีบริบูรณ์</strong></td>
    <td colspan="6" align="center"><strong>อายุมากกว่า 35 ปีบริบูรณ์</strong></td>
    <td width="8%" rowspan="3" align="center"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center">ผ่านเกณฑ์</td>
    <td colspan="3" align="center">ไม่ผ่านเกณฑ์</td>
    <td colspan="3" align="center">ผ่านเกณฑ์</td>
    <td colspan="3" align="center">ไม่ผ่านเกณฑ์</td>
  </tr>
  <tr>
    <td align="center">ชาย</td>
    <td align="center">หญิง</td>
    <td align="center">รวม</td>
    <td width="6%" align="center">ชาย</td>
    <td width="6%" align="center">หญิง</td>
    <td width="6%" align="center">รวม</td>
    <td align="center">ชาย</td>
    <td align="center">หญิง</td>
    <td align="center">รวม</td>
    <td width="7%" align="center">ชาย</td>
    <td width="7%" align="center">หญิง</td>
    <td width="7%" align="center">รวม</td>
  </tr>
  <tr>
    <td><strong>แรงบีบมือ</strong></td>
    <td align="center"><? if(empty($oksumhandm34)){ echo "0";}else{ echo $oksumhandm34;}?></td>
    <td align="center"><? if(empty($oksumhandf34)){ echo "0";}else{ echo $oksumhandf34;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumhand34)){ echo "0";}else{ echo $oksumhand34;}?>
    </strong></td>
    <td align="center"><? if(empty($sumhandm34)){ echo "0";}else{ echo $sumhandm34;}?></td>
    <td align="center"><? if(empty($sumhandf34)){ echo "0";}else{ echo $sumhandf34;}?></td>
    <td align="center"><strong>
      <? if(empty($sumhand34)){ echo "0";}else{ echo $sumhand34;}?>
    </strong></td>
    <td align="center"><? if(empty($oksumhandm35)){ echo "0";}else{ echo $oksumhandm35;}?></td>
    <td align="center"><? if(empty($oksumhandf35)){ echo "0";}else{ echo $oksumhandf35;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumhand35)){ echo "0";}else{ echo $oksumhand35;}?>
    </strong></td>
    <td align="center"><? if(empty($sumhandm35)){ echo "0";}else{ echo $sumhandm35;}?></td>
    <td align="center"><? if(empty($sumhandf35)){ echo "0";}else{ echo $sumhandf35;}?></td>
    <td align="center"><strong>
      <? if(empty($sumhand35)){ echo "0";}else{ echo $sumhand35;}?>
    </strong></td>
    <td align="center"><strong>
      <? if(empty($sumhand)){ echo "0";}else{ echo $sumhand;}?>
    </strong></td>
  </tr>
  <tr>
    <td><strong>แรงเหยียดขา</strong></td>
    <td align="center"><? if(empty($oksumlegm34)){ echo "0";}else{ echo $oksumlegm34;}?></td>
    <td align="center"><? if(empty($oksumlegf34)){ echo "0";}else{ echo $oksumlegf34;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumleg34)){ echo "0";}else{ echo $oksumleg34;}?>
    </strong></td>
    <td align="center"><? if(empty($sumlegm34)){ echo "0";}else{ echo $sumlegm34;}?></td>
    <td align="center"><? if(empty($sumlegf34)){ echo "0";}else{ echo $sumlegf34;}?></td>
    <td align="center"><strong>
      <? if(empty($sumleg34)){ echo "0";}else{ echo $sumleg34;}?>
    </strong></td>
    <td align="center"><? if(empty($oksumlegm35)){ echo "0";}else{ echo $oksumlegm35;}?></td>
    <td align="center"><? if(empty($oksumlegf35)){ echo "0";}else{ echo $oksumlegf35;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumleg35)){ echo "0";}else{ echo $oksumleg35;}?>
    </strong></td>
    <td align="center"><? if(empty($sumlegm35)){ echo "0";}else{ echo $sumlegm35;}?></td>
    <td align="center"><? if(empty($sumlegf35)){ echo "0";}else{ echo $sumlegf35;}?></td>
    <td align="center"><strong>
      <? if(empty($sumleg35)){ echo "0";}else{ echo $sumleg35;}?>
    </strong></td>
    <td align="center"><strong>
      <? if(empty($sumleg)){ echo "0";}else{ echo $sumleg;}?>
    </strong></td>
  </tr>
  <tr>
    <td><strong>3 Minute Test</strong></td>
    <td align="center"><? if(empty($oksumsteptestm34)){ echo "0";}else{ echo $oksumsteptestm34;}?></td>
    <td align="center"><? if(empty($oksumsteptestf34)){ echo "0";}else{ echo $oksumsteptestf34;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumsteptest34)){ echo "0";}else{ echo $oksumsteptest34;}?>
    </strong></td>
    <td align="center"><? if(empty($sumsteptestm34)){ echo "0";}else{ echo $sumsteptestm34;}?></td>
    <td align="center"><? if(empty($sumsteptestf34)){ echo "0";}else{ echo $sumsteptestf34;}?></td>
    <td align="center"><strong>
      <? if(empty($sumsteptest34)){ echo "0";}else{ echo $sumsteptest34;}?>
    </strong></td>
    <td align="center"><? if(empty($oksumsteptestm35)){ echo "0";}else{ echo $oksumsteptestm35;}?></td>
    <td align="center"><? if(empty($oksumsteptestf35)){ echo "0";}else{ echo $oksumsteptestf35;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumsteptest35)){ echo "0";}else{ echo $oksumsteptest35;}?>
    </strong></td>
    <td align="center"><? if(empty($sumsteptestm35)){ echo "0";}else{ echo $sumsteptestm35;}?></td>
    <td align="center"><? if(empty($sumsteptestf35)){ echo "0";}else{ echo $sumsteptestf35;}?></td>
    <td align="center"><strong>
      <? if(empty($sumsteptest35)){ echo "0";}else{ echo $sumsteptest35;}?>
    </strong></td>
    <td align="center"><strong>
      <? if(empty($sumsteptest)){ echo "0";}else{ echo $sumsteptest;}?>
    </strong></td>
  </tr>
  <tr>
    <td><strong>ดันพื้น</strong></td>
    <td align="center"><? if(empty($oksumpressurem34)){ echo "0";}else{ echo $oksumpressurem34;}?></td>
    <td align="center"><? if(empty($oksumpressuref34)){ echo "0";}else{ echo $oksumpressuref34;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumpressure34)){ echo "0";}else{ echo $oksumpressure34;}?>
    </strong></td>
    <td align="center"><? if(empty($sumpressurem34)){ echo "0";}else{ echo $sumpressurem34;}?></td>
    <td align="center"><? if(empty($sumpressuref34)){ echo "0";}else{ echo $sumpressuref34;}?></td>
    <td align="center"><strong>
      <? if(empty($sumpressure34)){ echo "0";}else{ echo $sumpressure34;}?>
    </strong></td>
    <td align="center"><? if(empty($oksumpressurem35)){ echo "0";}else{ echo $oksumpressurem35;}?></td>
    <td align="center"><? if(empty($oksumpressuref35)){ echo "0";}else{ echo $oksumpressuref35;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumpressure35)){ echo "0";}else{ echo $oksumpressure35;}?>
    </strong></td>
    <td align="center"><? if(empty($sumpressurem35)){ echo "0";}else{ echo $sumpressurem35;}?></td>
    <td align="center"><? if(empty($sumpressuref35)){ echo "0";}else{ echo $sumpressuref35;}?></td>
    <td align="center"><strong>
      <? if(empty($sumpressure35)){ echo "0";}else{ echo $sumpressure35;}?>
    </strong></td>
    <td align="center"><strong>
      <? if(empty($sumpressure)){ echo "0";}else{ echo $sumpressure;}?>
    </strong></td>
  </tr>
  <tr>
    <td><strong>ลุก-นั่ง</strong></td>
    <td align="center"><? if(empty($oksumsitupm34)){ echo "0";}else{ echo $oksumsitupm34;}?></td>
    <td align="center"><? if(empty($oksumsitupf34)){ echo "0";}else{ echo $oksumsitupf34;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumsitup34)){ echo "0";}else{ echo $oksumsitup34;}?>
    </strong></td>
    <td align="center"><? if(empty($sumsitupm34)){ echo "0";}else{ echo $sumsitupm34;}?></td>
    <td align="center"><? if(empty($sumsitupf34)){ echo "0";}else{ echo $sumsitupf34;}?></td>
    <td align="center"><strong>
      <? if(empty($sumsitup34)){ echo "0";}else{ echo $sumsitup34;}?>
    </strong></td>
    <td align="center"><? if(empty($oksumsitupm35)){ echo "0";}else{ echo $oksumsitupm35;}?></td>
    <td align="center"><? if(empty($oksumsitupf35)){ echo "0";}else{ echo $oksumsitupf35;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumsitup35)){ echo "0";}else{ echo $oksumsitup35;}?>
    </strong></td>
    <td align="center"><? if(empty($sumsitupm35)){ echo "0";}else{ echo $sumsitupm35;}?></td>
    <td align="center"><? if(empty($sumsitupf35)){ echo "0";}else{ echo $sumsitupf35;}?></td>
    <td align="center"><strong>
      <? if(empty($sumsitup35)){ echo "0";}else{ echo $sumsitup35;}?>
    </strong></td>
    <td align="center"><strong>
      <? if(empty($sumsitup)){ echo "0";}else{ echo $sumsitup;}?>
    </strong></td>
  </tr>
  <tr>
    <td><strong>วิ่ง</strong></td>
    <td align="center"><? if(empty($oksumrunm34)){ echo "0";}else{ echo $oksumrunm34;}?></td>
    <td align="center"><? if(empty($oksumrunf34)){ echo "0";}else{ echo $oksumrunf34;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumrun34)){ echo "0";}else{ echo $oksumrun34;}?>
    </strong></td>
    <td align="center"><? if(empty($sumrunm34)){ echo "0";}else{ echo $sumrunm34;}?></td>
    <td align="center"><? if(empty($sumrunf34)){ echo "0";}else{ echo $sumrunf34;}?></td>
    <td align="center"><strong>
      <? if(empty($sumrun34)){ echo "0";}else{ echo $sumrun34;}?>
    </strong></td>
    <td align="center"><? if(empty($oksumrunm35)){ echo "0";}else{ echo $oksumrunm35;}?></td>
    <td align="center"><? if(empty($oksumrunf35)){ echo "0";}else{ echo $oksumrunf35;}?></td>
    <td align="center"><strong>
      <? if(empty($oksumrun35)){ echo "0";}else{ echo $oksumrun35;}?>
    </strong></td>
    <td align="center"><? if(empty($sumrunm35)){ echo "0";}else{ echo $sumrunm35;}?></td>
    <td align="center"><? if(empty($sumrunf35)){ echo "0";}else{ echo $sumrunf35;}?></td>
    <td align="center"><strong>
      <? if(empty($sumrun35)){ echo "0";}else{ echo $sumrun35;}?>
    </strong></td>
    <td align="center"><strong>
      <? if(empty($sumrun)){ echo "0";}else{ echo $sumrun;}?>
    </strong></td>
  </tr>
</table>
<br />
<?
$avggender34=($totalgender34*100)/$i;
$avggender35=($totalgender35*100)/$i;
?>
<div style="margin-left: 70px;"><strong>กำลังพล รวมทั้งสิ้น 
  <?=$i;?> 
ราย</strong></div>
<div style="margin-left: 70px;">อายุไม่เกิน 35 ปีบริบูรณ์ <span style="margin-left: 40px;"><?=$totalgender34;?> ราย</span><span style="margin-left: 30px;">คิดเป็น <?=number_format($avggender34,2);?> %</span></div>
<div style="margin-left: 70px;">อายุมากกว่า 35 ปีบริบูรณ์ <span style="margin-left: 25px;"><?=$totalgender35;?> ราย</span><span style="margin-left: 30px;">คิดเป็น <?=number_format($avggender35,2);?> %</span></div>
<?
$perhand34=($oksumhand34*100)/$numgender34;
$perleg34=($oksumleg34*100)/$numgender34;
$persteptest34=($oksumsteptest34*100)/$numgender34;

$perhand35=($oksumhand35*100)/$numgender35;
$perleg35=($oksumleg35*100)/$numgender35;
$persteptest35=($oksumsteptest35*100)/$numgender35;
?>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="19%" align="center"><strong>การทดสอบ/ผ่านเกณฑ์มาตรฐาน</strong></td>
    <td align="center"><strong>อายุไม่เกิน 35 ปีบริบูรณ์</strong></td>
    <td align="center"><strong>อายุมากกว่า 35 ปีบริบูรณ์</strong></td>
  </tr>
  
  <tr>
    <td bordercolor="#000000"><strong>แรงบีบมือ</strong></td>
    <td width="16%" align="center"><? if(empty($perhand34)){ echo "0";}else{ echo number_format($perhand34,2);}?> %</td>
    <td width="16%" align="center"><? if(empty($perhand35)){ echo "0";}else{ echo number_format($perhand35,2);}?>
      %</td>
  </tr>
  <tr>
    <td bordercolor="#000000"><strong>แรงเหยียดขา</strong></td>
    <td align="center"><? if(empty($perleg34)){ echo "0";}else{ echo number_format($perleg34,2);}?> %</td>
    <td align="center"><? if(empty($perleg35)){ echo "0";}else{ echo number_format($perleg35,2);}?>
      %</td>
  </tr>
  <tr>
    <td bordercolor="#000000"><strong>3 Minute Test</strong></td>
    <td align="center"><? if(empty($persteptest34)){ echo "0";}else{ echo number_format($persteptest34,2);}?> %</td>
    <td align="center"><? if(empty($persteptest35)){ echo "0";}else{ echo number_format($persteptest35,2);}?>
      %</td>
  </tr>
  <tr>
    <td><strong>ดันพื้น</strong></td>
    <td align="center">-</td>
    <td align="center">-</td>
  </tr>
  <tr>
    <td><strong>ลุก-นั่ง</strong></td>
    <td align="center">-</td>
    <td align="center">-</td>
  </tr>
  <tr>
    <td><strong>วิ่ง</strong></td>
    <td align="center">-</td>
    <td align="center">-</td>
  </tr>
</table>
<br />
<div style="page-break-after: always"></div>


<div style="margin-left:30px;"><strong>การตรวจโดยห้องปฏิบัติการพยาธิวิทยา</strong> <strong><u>กลุ่มเม็ดเลือด</u></strong></div>
<div style="margin-left:40px;">/ คือ อยู่ในเกณฑ์ปกติ</div>
<div style="margin-left:40px;">X คือ อยู่ในเกณฑ์ผิดปกติ</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" rowspan="2" align="center" bgcolor="#009999"><strong>ลำดับ</strong></td>
    <td width="63%" rowspan="2" align="center" bgcolor="#009999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="10%" rowspan="2" align="center" bgcolor="#009999"><strong>อายุ</strong></td>
    <td align="center" bgcolor="#009999">เม็ดเลือด</td>
  </tr>
  <tr>
    <td width="20%" align="center" bgcolor="#009999"><strong>CBC</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
		$sql2 = "select * from armychkup where yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}else{
		$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";

}		
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		$age2=$result2["age"];
			
			if($result2['cbc_lab']=="ผิดปกติ"){
				$chkcbc="X";
			}else if($result2['cbc_lab']=="ปกติ"){
				$chkcbc="/";
			}else{
				$chkcbc="";
			}	
			
	//เก็บสถิติ
	$gender2=$result2['gender'];
	if($result2['cbc_lab']=="ปกติ"){  //ปกติทั้งหมด
		$total1++;	
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$sum1ch01++;
			if($gender2==1){  //ชาย
				$sum1ch01m++;
			}else{
				$sum1ch01f++;
			}			
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$sum1ch02++;
			if($gender2==1){  //ชาย
				$sum1ch02m++;
			}else{
				$sum1ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$sum1ch04++;
			if($gender2==1){  //ชาย
				$sum1ch04m++;
			}else{
				$sum1ch04f++;
			}				
		}
		
	}else if($result2['cbc_lab']=="ผิดปกติ"){  // กลุ่ม ผิดปกติ
		$total2++;
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$sum2ch01++;
			if($gender2==1){  //ชาย
				$sum2ch01m++;
			}else{
				$sum2ch01f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$sum2ch02++;
			if($gender2==1){  //ชาย
				$sum2ch02m++;
			}else{
				$sum2ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$sum2ch04++;
			if($gender2==1){  //ชาย
				$sum2ch04m++;
			}else{
				$sum2ch04f++;
			}			
		}		
	}																				
			
																			
		
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><strong>
      <?=$chkcbc;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<div align="center"><strong>สรุปผลการตรวจโดยห้องปฏิบัติการพยาธิวิทยา </strong><strong><u>กลุ่มเม็ดเลือด</u></strong></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="13%" rowspan="3" align="center"><strong>ประเภท</strong></td>
    <td colspan="10" align="center"><strong>จำนวนกำลังพล/ราย</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>นายทหารชั้นสัญญาบัตร</strong></td>
    <td colspan="3" align="center"><strong>นายทหารชั้นประทวน</strong></td>
    <td colspan="3" align="center"><strong>ลูกจ้างประจำ</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td width="9%" align="center">ชาย</td>
    <td width="10%" align="center">หญิง</td>
    <td width="11%" align="center">รวม</td>
    <td width="7%" align="center">ชาย</td>
    <td width="8%" align="center">หญิง</td>
    <td width="10%" align="center">รวม</td>
    <td align="center">ชาย</td>
    <td align="center">หญิง</td>
    <td align="center">รวม</td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ปกติ</strong></td>
    <td align="center"><? if(empty($sum1ch01m)){ echo "0";}else{ echo $sum1ch01m;}?></td>
    <td align="center"><? if(empty($sum1ch01f)){ echo "0";}else{ echo $sum1ch01f;}?></td>
    <td align="center"><? if(empty($sum1ch01)){ echo "0";}else{ echo $sum1ch01;}?></td>
    <td align="center"><? if(empty($sum1ch02m)){ echo "0";}else{ echo $sum1ch02m;}?></td>
    <td align="center"><? if(empty($sum1ch02f)){ echo "0";}else{ echo $sum1ch02f;}?></td>
    <td align="center"><? if(empty($sum1ch02)){ echo "0";}else{ echo $sum1ch02;}?></td>
    <td align="center"><? if(empty($sum1ch04m)){ echo "0";}else{ echo $sum1ch04m;}?></td>
    <td align="center"><? if(empty($sum1ch04f)){ echo "0";}else{ echo $sum1ch04f;}?></td>
    <td align="center"><? if(empty($sum1ch04)){ echo "0";}else{ echo $sum1ch04;}?></td>
    <td align="center"><? if(empty($total1)){ echo "0";}else{ echo $total1;}?></td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ผิดปกติ</strong></td>
    <td align="center"><? if(empty($sum2ch01m)){ echo "0";}else{ echo $sum2ch01m;}?></td>
    <td align="center"><? if(empty($sum2ch01f)){ echo "0";}else{ echo $sum2ch01f;}?></td>
    <td align="center"><? if(empty($sum2ch01)){ echo "0";}else{ echo $sum2ch01;}?></td>
    <td align="center"><? if(empty($sum2ch02m)){ echo "0";}else{ echo $sum2ch02m;}?></td>
    <td align="center"><? if(empty($sum2ch02f)){ echo "0";}else{ echo $sum2ch02f;}?></td>
    <td align="center"><? if(empty($sum2ch02)){ echo "0";}else{ echo $sum2ch02;}?></td>
    <td align="center"><? if(empty($sum2ch04m)){ echo "0";}else{ echo $sum2ch04m;}?></td>
    <td align="center"><? if(empty($sum2ch04f)){ echo "0";}else{ echo $sum2ch04f;}?></td>
    <td align="center"><? if(empty($sum2ch04)){ echo "0";}else{ echo $sum2ch04;}?></td>
    <td align="center"><? if(empty($total2)){ echo "0";}else{ echo $total2;}?></td>
  </tr>
  <tr>
    <td colspan="10" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center"><?=$i;?></td>
  </tr>
</table>
<br />
<div style="page-break-after: always"></div>
<div style="margin-left:30px;"><strong>การตรวจโดยห้องปฏิบัติการพยาธิวิทยา เฉพาะผู้ที่มีอายุ &gt;=35 ปี </strong><strong><u>กลุ่มน้ำตาล</u></strong></div>
<div style="margin-left:40px;">/ คือ อยู่ในเกณฑ์ปกติ</div>
<div style="margin-left:40px;">X คือ อยู่ในเกณฑ์ผิดปกติ</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" rowspan="2" align="center" bgcolor="#009999"><strong>ลำดับ</strong></td>
    <td width="63%" rowspan="2" align="center" bgcolor="#009999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="10%" rowspan="2" align="center" bgcolor="#009999"><strong>อายุ</strong></td>
    <td align="center" bgcolor="#009999">น้ำตาล</td>
  </tr>
  <tr>
    <td width="20%" align="center" bgcolor="#009999"><strong>GLU</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
	$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' and age >=35 order by chunyot asc, age desc";
}else{
	$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' and age >=35 order by chunyot asc, age desc";
}		
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		$age2=$result2["age"];
			
			if($result2['glu_lab']=="ผิดปกติ"){
				$chkglu="X";
			}else if($result2['glu_lab']=="ปกติ"){
				$chkglu="/";
			}else{
				$chkglu="";
			}																	
			
	//เก็บสถิติ
	$gender2=$result2['gender'];
	if($result2['glu_lab']=="ปกติ"){  //ปกติทั้งหมด
		$glutotal1++;	
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$glusum1ch01++;
			if($gender2==1){  //ชาย
				$glusum1ch01m++;
			}else{
				$glusum1ch01f++;
			}			
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$glusum1ch02++;
			if($gender2==1){  //ชาย
				$glusum1ch02m++;
			}else{
				$glusum1ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$glusum1ch04++;
			if($gender2==1){  //ชาย
				$glusum1ch04m++;
			}else{
				$glusum1ch04f++;
			}				
		}
		
	}else if($result2['glu_lab']=="ผิดปกติ"){  // กลุ่ม ผิดปกติ
		$glutotal2++;
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$glusum2ch01++;
			if($gender2==1){  //ชาย
				$glusum2ch01m++;
			}else{
				$glusum2ch01f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$glusum2ch02++;
			if($gender2==1){  //ชาย
				$glusum2ch02m++;
			}else{
				$glusum2ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$glusum2ch04++;
			if($gender2==1){  //ชาย
				$glusum2ch04m++;
			}else{
				$glusum2ch04f++;
			}			
		}		
	}																			
		
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><strong>
      <?=$chkglu;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<div align="center"><strong>สรุปผลการตรวจโดยห้องปฏิบัติการพยาธิวิทยา </strong>  <strong> เฉพาะผู้ที่มีอายุ &gt;=35 ปี</strong> <strong><u>กลุ่มน้ำตาล</u></strong></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="13%" rowspan="3" align="center"><strong>ประเภท</strong></td>
    <td colspan="10" align="center"><strong>จำนวนกำลังพล/ราย</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>นายทหารชั้นสัญญาบัตร</strong></td>
    <td colspan="3" align="center"><strong>นายทหารชั้นประทวน</strong></td>
    <td colspan="3" align="center"><strong>ลูกจ้างประจำ</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td width="9%" align="center">ชาย</td>
    <td width="10%" align="center">หญิง</td>
    <td width="11%" align="center">รวม</td>
    <td width="7%" align="center">ชาย</td>
    <td width="8%" align="center">หญิง</td>
    <td width="10%" align="center">รวม</td>
    <td align="center">ชาย</td>
    <td align="center">หญิง</td>
    <td align="center">รวม</td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ปกติ</strong></td>
    <td align="center"><? if(empty($glusum1ch01m)){ echo "0";}else{ echo $glusum1ch01m;}?></td>
    <td align="center"><? if(empty($glusum1ch01f)){ echo "0";}else{ echo $glusum1ch01f;}?></td>
    <td align="center"><? if(empty($glusum1ch01)){ echo "0";}else{ echo $glusum1ch01;}?></td>
    <td align="center"><? if(empty($glusum1ch02m)){ echo "0";}else{ echo $glusum1ch02m;}?></td>
    <td align="center"><? if(empty($glusum1ch02f)){ echo "0";}else{ echo $glusum1ch02f;}?></td>
    <td align="center"><? if(empty($glusum1ch02)){ echo "0";}else{ echo $glusum1ch02;}?></td>
    <td align="center"><? if(empty($glusum1ch04m)){ echo "0";}else{ echo $glusum1ch04m;}?></td>
    <td align="center"><? if(empty($glusum1ch04f)){ echo "0";}else{ echo $glusum1ch04f;}?></td>
    <td align="center"><? if(empty($glusum1ch04)){ echo "0";}else{ echo $glusum1ch04;}?></td>
    <td align="center"><? if(empty($glutotal1)){ echo "0";}else{ echo $glutotal1;}?></td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ผิดปกติ</strong></td>
    <td align="center"><? if(empty($glusum2ch01m)){ echo "0";}else{ echo $glusum2ch01m;}?></td>
    <td align="center"><? if(empty($glusum2ch01f)){ echo "0";}else{ echo $glusum2ch01f;}?></td>
    <td align="center"><? if(empty($glusum2ch01)){ echo "0";}else{ echo $glusum2ch01;}?></td>
    <td align="center"><? if(empty($glusum2ch02m)){ echo "0";}else{ echo $glusum2ch02m;}?></td>
    <td align="center"><? if(empty($glusum2ch02f)){ echo "0";}else{ echo $glusum2ch02f;}?></td>
    <td align="center"><? if(empty($glusum2ch02)){ echo "0";}else{ echo $glusum2ch02;}?></td>
    <td align="center"><? if(empty($glusum2ch04m)){ echo "0";}else{ echo $glusum2ch04m;}?></td>
    <td align="center"><? if(empty($glusum2ch04f)){ echo "0";}else{ echo $glusum2ch04f;}?></td>
    <td align="center"><? if(empty($glusum2ch04)){ echo "0";}else{ echo $glusum2ch04;}?></td>
    <td align="center"><? if(empty($glutotal2)){ echo "0";}else{ echo $glutotal2;}?></td>
  </tr>
  <tr>
    <td colspan="10" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center"><?=$i;?></td>
  </tr>
</table>
<br />
<div style="page-break-after: always"></div>


<div style="margin-left:30px;"><strong>การตรวจโดยห้องปฏิบัติการพยาธิวิทยา </strong> <strong> เฉพาะผู้ที่มีอายุ &gt;=35 ปี</strong> <strong><u>กลุ่มกรดยูริก</u></strong></div>
<div style="margin-left:40px;">/ คือ อยู่ในเกณฑ์ปกติ</div>
<div style="margin-left:40px;">X คือ อยู่ในเกณฑ์ผิดปกติ</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" rowspan="2" align="center" bgcolor="#009999"><strong>ลำดับ</strong></td>
    <td width="63%" rowspan="2" align="center" bgcolor="#009999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="10%" rowspan="2" align="center" bgcolor="#009999"><strong>อายุ</strong></td>
    <td align="center" bgcolor="#009999">กรดยูริก</td>
  </tr>
  <tr>
    <td width="20%" align="center" bgcolor="#009999"><strong>URIC</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
		$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' and age >=35 order by chunyot asc, age desc";
		//echo $sql;
}else{
		$sql2 = "select * from armychkup where camp='".$camp."' and  yearchkup='$nPrefix' and camp !='' and age >=35 order by chunyot asc, age desc";
}		
		$query2 = mysql_query($sql2);  		
		$i=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		$age2=$result2["age"];	
			
			if($result2['uric_lab']=="ผิดปกติ"){
				$chkuric="X";
			}else if($result2['uric_lab']=="ปกติ"){
				$chkuric="/";
			}else{
				$chkuric="";
			}
			
	//เก็บสถิติ
	$gender2=$result2['gender'];
	if($result2['uric_lab']=="ปกติ"){  //ปกติทั้งหมด
		$urictotal1++;	
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$uricsum1ch01++;
			if($gender2==1){  //ชาย
				$uricsum1ch01m++;
			}else{
				$uricsum1ch01f++;
			}			
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$uricsum1ch02++;
			if($gender2==1){  //ชาย
				$uricsum1ch02m++;
			}else{
				$uricsum1ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$uricsum1ch04++;
			if($gender2==1){  //ชาย
				$uricsum1ch04m++;
			}else{
				$uricsum1ch04f++;
			}				
		}
		
	}else if($result2['uric_lab']=="ผิดปกติ"){  // กลุ่ม ผิดปกติ
		$urictotal2++;
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$uricsum2ch01++;
			if($gender2==1){  //ชาย
				$uricsum2ch01m++;
			}else{
				$uricsum2ch01f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$uricsum2ch02++;
			if($gender2==1){  //ชาย
				$uricsum2ch02m++;
			}else{
				$uricsum2ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$uricsum2ch04++;
			if($gender2==1){  //ชาย
				$uricsum2ch04m++;
			}else{
				$uricsum2ch04f++;
			}			
		}		
	}																					
			
																			
		
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><strong>
      <?=$chkuric;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<div align="center"><strong>สรุปผลการตรวจโดยห้องปฏิบัติการพยาธิวิทยา </strong>  <strong> เฉพาะผู้ที่มีอายุ &gt;=35 ปี</strong> <strong><u>กลุ่มกรดยูริก</u></strong></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="13%" rowspan="3" align="center"><strong>ประเภท</strong></td>
    <td colspan="10" align="center"><strong>จำนวนกำลังพล/ราย</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>นายทหารชั้นสัญญาบัตร</strong></td>
    <td colspan="3" align="center"><strong>นายทหารชั้นประทวน</strong></td>
    <td colspan="3" align="center"><strong>ลูกจ้างประจำ</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td width="9%" align="center">ชาย</td>
    <td width="10%" align="center">หญิง</td>
    <td width="11%" align="center">รวม</td>
    <td width="7%" align="center">ชาย</td>
    <td width="8%" align="center">หญิง</td>
    <td width="10%" align="center">รวม</td>
    <td align="center">ชาย</td>
    <td align="center">หญิง</td>
    <td align="center">รวม</td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ปกติ</strong></td>
    <td align="center"><? if(empty($uricsum1ch01m)){ echo "0";}else{ echo $uricsum1ch01m;}?></td>
    <td align="center"><? if(empty($uricsum1ch01f)){ echo "0";}else{ echo $uricsum1ch01f;}?></td>
    <td align="center"><? if(empty($uricsum1ch01)){ echo "0";}else{ echo $uricsum1ch01;}?></td>
    <td align="center"><? if(empty($uricsum1ch02m)){ echo "0";}else{ echo $uricsum1ch02m;}?></td>
    <td align="center"><? if(empty($uricsum1ch02f)){ echo "0";}else{ echo $uricsum1ch02f;}?></td>
    <td align="center"><? if(empty($uricsum1ch02)){ echo "0";}else{ echo $uricsum1ch02;}?></td>
    <td align="center"><? if(empty($uricsum1ch04m)){ echo "0";}else{ echo $uricsum1ch04m;}?></td>
    <td align="center"><? if(empty($uricsum1ch04f)){ echo "0";}else{ echo $uricsum1ch04f;}?></td>
    <td align="center"><? if(empty($uricsum1ch04)){ echo "0";}else{ echo $uricsum1ch04;}?></td>
    <td align="center"><? if(empty($urictotal1)){ echo "0";}else{ echo $urictotal1;}?></td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ผิดปกติ</strong></td>
    <td align="center"><? if(empty($uricsum2ch01m)){ echo "0";}else{ echo $uricsum2ch01m;}?></td>
    <td align="center"><? if(empty($uricsum2ch01f)){ echo "0";}else{ echo $uricsum2ch01f;}?></td>
    <td align="center"><? if(empty($uricsum2ch01)){ echo "0";}else{ echo $uricsum2ch01;}?></td>
    <td align="center"><? if(empty($uricsum2ch02m)){ echo "0";}else{ echo $uricsum2ch02m;}?></td>
    <td align="center"><? if(empty($uricsum2ch02f)){ echo "0";}else{ echo $uricsum2ch02f;}?></td>
    <td align="center"><? if(empty($uricsum2ch02)){ echo "0";}else{ echo $uricsum2ch02;}?></td>
    <td align="center"><? if(empty($uricsum2ch04m)){ echo "0";}else{ echo $uricsum2ch04m;}?></td>
    <td align="center"><? if(empty($uricsum2ch04f)){ echo "0";}else{ echo $uricsum2ch04f;}?></td>
    <td align="center"><? if(empty($uricsum2ch04)){ echo "0";}else{ echo $uricsum2ch04;}?></td>
    <td align="center"><? if(empty($urictotal2)){ echo "0";}else{ echo $urictotal2;}?></td>
  </tr>
  <tr>
    <td colspan="10" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center"><?=$i;?></td>
  </tr>
</table>
<br />
<div style="page-break-after: always"></div>

<div style="margin-left:30px;"><strong>การตรวจโดยห้องปฏิบัติการพยาธิวิทยา<strong> </strong> <strong> เฉพาะผู้ที่มีอายุ &gt;=35 ปี</strong> <u>กลุ่ม ไต, ปัสสาวะ</u></strong></div>
<div style="margin-left:40px;">/ คือ อยู่ในเกณฑ์ปกติ</div>
<div style="margin-left:40px;">X คือ อยู่ในเกณฑ์ผิดปกติ</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" rowspan="2" align="center" bgcolor="#009999"><strong>ลำดับ</strong></td>
    <td width="51%" rowspan="2" align="center" bgcolor="#009999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="8%" rowspan="2" align="center" bgcolor="#009999"><strong>อายุ</strong></td>
    <td align="center" bgcolor="#009999">ปัสสาวะ</td>
    <td colspan="2" align="center" bgcolor="#009999">ไต</td>
  </tr>
  <tr>
    <td width="12%" align="center" bgcolor="#009999"><strong>UA</strong></td>
    <td width="12%" align="center" bgcolor="#009999"><strong>BUN</strong></td>
    <td width="10%" align="center" bgcolor="#009999"><strong>CREA</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
		$sql2 = "select * from armychkup where yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}else{
		$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}		
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		$age2=$result2["age"];
			if($result2['ua_lab']=="ผิดปกติ"){
				$chkua="X";
			}else if($result2['ua_lab']=="ปกติ"){
				$chkua="/";
			}else{
				$chkua="";
			}
			
			if($result2['bun_lab']=="ผิดปกติ"){
				$chkbun="X";
			}else if($result2['bun_lab']=="ปกติ"){
				$chkbun="/";
			}else{
				$chkbun="-";
			}
			
			if($result2['crea_lab']=="ผิดปกติ"){
				$chkcrea="X";
			}else if($result2['crea_lab']=="ปกติ"){
				$chkcrea="/";
			}else{
				$chkcrea="-";
			}																	
			
	//เก็บสถิติ
	$gender2=$result2['gender'];
	if($result2['bun_lab']=="ปกติ" && $result2['crea_lab']=="ปกติ"){  //ปกติทั้งหมด
		$buntotal1++;	
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$bunsum1ch01++;
			if($gender2==1){  //ชาย
				$bunsum1ch01m++;
			}else{
				$bunsum1ch01f++;
			}			
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$bunsum1ch02++;
			if($gender2==1){  //ชาย
				$bunsum1ch02m++;
			}else{
				$bunsum1ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$bunsum1ch04++;
			if($gender2==1){  //ชาย
				$bunsum1ch04m++;
			}else{
				$bunsum1ch04f++;
			}				
		}
		
	}else{  // กลุ่ม ผิดปกติ
		$buntotal2++;
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$bunsum2ch01++;
			if($gender2==1){  //ชาย
				$bunsum2ch01m++;
			}else{
				$bunsum2ch01f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$bunsum2ch02++;
			if($gender2==1){  //ชาย
				$bunsum2ch02m++;
			}else{
				$bunsum2ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$bunsum2ch04++;
			if($gender2==1){  //ชาย
				$bunsum2ch04m++;
			}else{
				$bunsum2ch04f++;
			}			
		}		
	}																			
		
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><strong>
      <?=$chkua;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chkbun;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chkcrea;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<div align="center"><strong>สรุปผลการตรวจโดยห้องปฏิบัติการพยาธิวิทยา </strong>  <strong> เฉพาะผู้ที่มีอายุ &gt;=35 ปี</strong> <strong><u>กลุ่มไต, ปัสสาวะ</u></strong></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="13%" rowspan="3" align="center"><strong>ประเภท</strong></td>
    <td colspan="10" align="center"><strong>จำนวนกำลังพล/ราย</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>นายทหารชั้นสัญญาบัตร</strong></td>
    <td colspan="3" align="center"><strong>นายทหารชั้นประทวน</strong></td>
    <td colspan="3" align="center"><strong>ลูกจ้างประจำ</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td width="9%" align="center">ชาย</td>
    <td width="10%" align="center">หญิง</td>
    <td width="11%" align="center">รวม</td>
    <td width="7%" align="center">ชาย</td>
    <td width="8%" align="center">หญิง</td>
    <td width="10%" align="center">รวม</td>
    <td align="center">ชาย</td>
    <td align="center">หญิง</td>
    <td align="center">รวม</td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ปกติ</strong></td>
    <td align="center"><? if(empty($bunsum1ch01m)){ echo "0";}else{ echo $bunsum1ch01m;}?></td>
    <td align="center"><? if(empty($bunsum1ch01f)){ echo "0";}else{ echo $bunsum1ch01f;}?></td>
    <td align="center"><? if(empty($bunsum1ch01)){ echo "0";}else{ echo $bunsum1ch01;}?></td>
    <td align="center"><? if(empty($bunsum1ch02m)){ echo "0";}else{ echo $bunsum1ch02m;}?></td>
    <td align="center"><? if(empty($bunsum1ch02f)){ echo "0";}else{ echo $bunsum1ch02f;}?></td>
    <td align="center"><? if(empty($bunsum1ch02)){ echo "0";}else{ echo $bunsum1ch02;}?></td>
    <td align="center"><? if(empty($bunsum1ch04m)){ echo "0";}else{ echo $bunsum1ch04m;}?></td>
    <td align="center"><? if(empty($bunsum1ch04f)){ echo "0";}else{ echo $bunsum1ch04f;}?></td>
    <td align="center"><? if(empty($bunsum1ch04)){ echo "0";}else{ echo $bunsum1ch04;}?></td>
    <td align="center"><? if(empty($buntotal1)){ echo "0";}else{ echo $buntotal1;}?></td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ผิดปกติ</strong></td>
    <td align="center"><? if(empty($bunsum2ch01m)){ echo "0";}else{ echo $bunsum2ch01m;}?></td>
    <td align="center"><? if(empty($bunsum2ch01f)){ echo "0";}else{ echo $bunsum2ch01f;}?></td>
    <td align="center"><? if(empty($bunsum2ch01)){ echo "0";}else{ echo $bunsum2ch01;}?></td>
    <td align="center"><? if(empty($bunsum2ch02m)){ echo "0";}else{ echo $bunsum2ch02m;}?></td>
    <td align="center"><? if(empty($bunsum2ch02f)){ echo "0";}else{ echo $bunsum2ch02f;}?></td>
    <td align="center"><? if(empty($bunsum2ch02)){ echo "0";}else{ echo $bunsum2ch02;}?></td>
    <td align="center"><? if(empty($bunsum2ch04m)){ echo "0";}else{ echo $bunsum2ch04m;}?></td>
    <td align="center"><? if(empty($bunsum2ch04f)){ echo "0";}else{ echo $bunsum2ch04f;}?></td>
    <td align="center"><? if(empty($bunsum2ch04)){ echo "0";}else{ echo $bunsum2ch04;}?></td>
    <td align="center"><? if(empty($buntotal2)){ echo "0";}else{ echo $buntotal2;}?></td>
  </tr>
  <tr>
    <td colspan="10" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center"><?=$i;?></td>
  </tr>
</table>
<br />
<div style="page-break-after: always"></div>

<div style="margin-left:30px;"><strong>การตรวจโดยห้องปฏิบัติการพยาธิวิทยา </strong>  <strong> เฉพาะผู้ที่มีอายุ &gt;=35 ปี</strong> <strong><u>กลุ่มไขมัน</u></strong></div>
<div style="margin-left:40px;">/ คือ อยู่ในเกณฑ์ปกติ</div>
<div style="margin-left:40px;">X คือ อยู่ในเกณฑ์ผิดปกติ</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" rowspan="2" align="center" bgcolor="#009999"><strong>ลำดับ</strong></td>
    <td width="51%" rowspan="2" align="center" bgcolor="#009999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="8%" rowspan="2" align="center" bgcolor="#009999"><strong>อายุ</strong></td>
    <td colspan="4" align="center" bgcolor="#009999">ไขมัน</td>
  </tr>
  <tr>
    <td width="8%" align="center" bgcolor="#009999"><strong>CHOL</strong></td>
    <td width="8%" align="center" bgcolor="#009999"><strong>TRIG</strong></td>
    <td width="8%" align="center" bgcolor="#009999"><strong>HDL</strong></td>
    <td width="10%" align="center" bgcolor="#009999"><strong>LDL</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
		$sql2 = "select * from armychkup where yearchkup='$nPrefix' and camp !='' and age >=35 order by chunyot asc, age desc";
}else{
		$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' and age >=35 order by chunyot asc, age desc";
}		
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		$age2=$result2["age"];
			
			if($result2['chol_lab']=="ผิดปกติ"){
				$chkchol="X";
			}else if($result2['chol_lab']=="ปกติ"){
				$chkchol="/";
			}else{
				$chkchol="";
			}	

			if($result2['trig_lab']=="ผิดปกติ"){
				$chktrig="X";
			}else if($result2['trig_lab']=="ปกติ"){
				$chktrig="/";
			}else{
				$chktrig="";
			}
			
			if($result2['hdl_lab']=="ผิดปกติ"){
				$chkhdl="X";
			}else if($result2['hdl_lab']=="ปกติ"){
				$chkhdl="/";
			}else{
				$chkhdl="";
			}	
			
			if($result2['ldl_lab']=="ผิดปกติ"){
				$chkldl="X";
			}else if($result2['ldl_lab']=="ปกติ"){
				$chkldl="/";
			}else{
				$chkldl="";
			}																		
			
	//เก็บสถิติ
	$gender2=$result2['gender'];
	if($result2['chol_lab']=="ปกติ" && $result2['trig_lab']=="ปกติ" && $result2['hdl_lab']=="ปกติ" && $result2['ldl_lab']=="ปกติ"){  //ปกติทั้งหมด
		$choltotal1++;	
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$cholsum1ch01++;
			if($gender2==1){  //ชาย
				$cholsum1ch01m++;
			}else{
				$cholsum1ch01f++;
			}			
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$cholsum1ch02++;
			if($gender2==1){  //ชาย
				$cholsum1ch02m++;
			}else{
				$cholsum1ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$cholsum1ch04++;
			if($gender2==1){  //ชาย
				$cholsum1ch04m++;
			}else{
				$cholsum1ch04f++;
			}				
		}
		
	}else{  // กลุ่ม ผิดปกติ
		$choltotal2++;
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$cholsum2ch01++;
			if($gender2==1){  //ชาย
				$cholsum2ch01m++;
			}else{
				$cholsum2ch01f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$cholsum2ch02++;
			if($gender2==1){  //ชาย
				$cholsum2ch02m++;
			}else{
				$cholsum2ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$cholsum2ch04++;
			if($gender2==1){  //ชาย
				$cholsum2ch04m++;
			}else{
				$cholsum2ch04f++;
			}			
		}		
	}																			
		
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><strong>
      <?=$chkchol;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chktrig;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chkhdl;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chkldl;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<div align="center"><strong>สรุปผลการตรวจโดยห้องปฏิบัติการพยาธิวิทยา </strong>  <strong> เฉพาะผู้ที่มีอายุ &gt;=35 ปี</strong> <strong><u>กลุ่มไขมัน</u></strong></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="13%" rowspan="3" align="center"><strong>ประเภท</strong></td>
    <td colspan="10" align="center"><strong>จำนวนกำลังพล/ราย</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>นายทหารชั้นสัญญาบัตร</strong></td>
    <td colspan="3" align="center"><strong>นายทหารชั้นประทวน</strong></td>
    <td colspan="3" align="center"><strong>ลูกจ้างประจำ</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td width="9%" align="center">ชาย</td>
    <td width="10%" align="center">หญิง</td>
    <td width="11%" align="center">รวม</td>
    <td width="7%" align="center">ชาย</td>
    <td width="8%" align="center">หญิง</td>
    <td width="10%" align="center">รวม</td>
    <td align="center">ชาย</td>
    <td align="center">หญิง</td>
    <td align="center">รวม</td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ปกติ</strong></td>
    <td align="center"><? if(empty($cholsum1ch01m)){ echo "0";}else{ echo $cholsum1ch01m;}?></td>
    <td align="center"><? if(empty($cholsum1ch01f)){ echo "0";}else{ echo $cholsum1ch01f;}?></td>
    <td align="center"><? if(empty($cholsum1ch01)){ echo "0";}else{ echo $cholsum1ch01;}?></td>
    <td align="center"><? if(empty($cholsum1ch02m)){ echo "0";}else{ echo $cholsum1ch02m;}?></td>
    <td align="center"><? if(empty($cholsum1ch02f)){ echo "0";}else{ echo $cholsum1ch02f;}?></td>
    <td align="center"><? if(empty($cholsum1ch02)){ echo "0";}else{ echo $cholsum1ch02;}?></td>
    <td align="center"><? if(empty($cholsum1ch04m)){ echo "0";}else{ echo $cholsum1ch04m;}?></td>
    <td align="center"><? if(empty($cholsum1ch04f)){ echo "0";}else{ echo $cholsum1ch04f;}?></td>
    <td align="center"><? if(empty($cholsum1ch04)){ echo "0";}else{ echo $cholsum1ch04;}?></td>
    <td align="center"><? if(empty($choltotal1)){ echo "0";}else{ echo $choltotal1;}?></td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ผิดปกติ</strong></td>
    <td align="center"><? if(empty($cholsum2ch01m)){ echo "0";}else{ echo $cholsum2ch01m;}?></td>
    <td align="center"><? if(empty($cholsum2ch01f)){ echo "0";}else{ echo $cholsum2ch01f;}?></td>
    <td align="center"><? if(empty($cholsum2ch01)){ echo "0";}else{ echo $cholsum2ch01;}?></td>
    <td align="center"><? if(empty($cholsum2ch02m)){ echo "0";}else{ echo $cholsum2ch02m;}?></td>
    <td align="center"><? if(empty($cholsum2ch02f)){ echo "0";}else{ echo $cholsum2ch02f;}?></td>
    <td align="center"><? if(empty($cholsum2ch02)){ echo "0";}else{ echo $cholsum2ch02;}?></td>
    <td align="center"><? if(empty($cholsum2ch04m)){ echo "0";}else{ echo $cholsum2ch04m;}?></td>
    <td align="center"><? if(empty($cholsum2ch04f)){ echo "0";}else{ echo $cholsum2ch04f;}?></td>
    <td align="center"><? if(empty($cholsum2ch04)){ echo "0";}else{ echo $cholsum2ch04;}?></td>
    <td align="center"><? if(empty($choltotal2)){ echo "0";}else{ echo $choltotal2;}?></td>
  </tr>
  <tr>
    <td colspan="10" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center"><?=$i;?></td>
  </tr>
</table>
<br />
<div style="page-break-after: always"></div>

<div style="margin-left:30px;"><strong>การตรวจโดยห้องปฏิบัติการพยาธิวิทยา </strong>  <strong> เฉพาะผู้ที่มีอายุ &gt;=35 ปี</strong> <strong><u>กลุ่มตับ</u></strong></div>
<div style="margin-left:40px;">/ คือ อยู่ในเกณฑ์ปกติ</div>
<div style="margin-left:40px;">X คือ อยู่ในเกณฑ์ผิดปกติ</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" rowspan="2" align="center" bgcolor="#009999"><strong>ลำดับ</strong></td>
    <td width="51%" rowspan="2" align="center" bgcolor="#009999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="8%" rowspan="2" align="center" bgcolor="#009999"><strong>อายุ</strong></td>
    <td colspan="3" align="center" bgcolor="#009999">ตับ</td>
  </tr>
  <tr>
    <td width="10%" align="center" bgcolor="#009999"><strong>ALP</strong></td>
    <td width="12%" align="center" bgcolor="#009999"><strong>ALT/SGPT</strong></td>
    <td width="12%" align="center" bgcolor="#009999"><strong>AST/SGOT</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
		$sql2 = "select * from armychkup where yearchkup='$nPrefix' and camp !='' and age >=35 order by chunyot asc, age desc";
}else{
		$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' and age >=35 order by chunyot asc, age desc";
}		
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		$age2=$result2["age"];
			
			if($result2['alp_lab']=="ผิดปกติ"){
				$chkalp="X";
			}else if($result2['alp_lab']=="ปกติ"){
				$chkalp="/";
			}else{
				$chkalp="";
			}		
			
			if($result2['alt_lab']=="ผิดปกติ"){
				$chkalt="X";
			}else if($result2['alt_lab']=="ปกติ"){
				$chkalt="/";
			}else{
				$chkalt="";
			}	
			
			if($result2['ast_lab']=="ผิดปกติ"){
				$chkast="X";
			}else if($result2['ast_lab']=="ปกติ"){
				$chkast="/";
			}else{
				$chkast="";
			}
			
			
	//เก็บสถิติ
	$gender2=$result2['gender'];
	if($result2['alp_lab']=="ปกติ" && $result2['alt_lab']=="ปกติ" && $result2['ast_lab']=="ปกติ"){  //ปกติทั้งหมด
		$alptotal1++;	
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$alpsum1ch01++;
			if($gender2==1){  //ชาย
				$alpsum1ch01m++;
			}else{
				$alpsum1ch01f++;
			}			
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$alpsum1ch02++;
			if($gender2==1){  //ชาย
				$alpsum1ch02m++;
			}else{
				$alpsum1ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$alpsum1ch04++;
			if($gender2==1){  //ชาย
				$alpsum1ch04m++;
			}else{
				$alpsum1ch04f++;
			}				
		}
		
	}else{  // กลุ่ม ผิดปกติ
		$alptotal2++;
		if(substr($result2['chunyot'],0,4)=="CH01"){
			$alpsum2ch01++;
			if($gender2==1){  //ชาย
				$alpsum2ch01m++;
			}else{
				$alpsum2ch01f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH02"){
			$alpsum2ch02++;
			if($gender2==1){  //ชาย
				$alpsum2ch02m++;
			}else{
				$alpsum2ch02f++;
			}				
		}else if(substr($result2['chunyot'],0,4)=="CH04"){
			$alpsum2ch04++;
			if($gender2==1){  //ชาย
				$alpsum2ch04m++;
			}else{
				$alpsum2ch04f++;
			}			
		}		
	}																			
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><strong>
      <?=$chkalp;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chkalt;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chkast;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<div align="center"><strong>สรุปผลการตรวจโดยห้องปฏิบัติการพยาธิวิทยา </strong>  <strong> เฉพาะผู้ที่มีอายุ &gt;=35 ปี</strong> <strong><u>กลุ่มตับ</u></strong></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="13%" rowspan="3" align="center"><strong>ประเภท</strong></td>
    <td colspan="10" align="center"><strong>จำนวนกำลังพล/ราย</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>นายทหารชั้นสัญญาบัตร</strong></td>
    <td colspan="3" align="center"><strong>นายทหารชั้นประทวน</strong></td>
    <td colspan="3" align="center"><strong>ลูกจ้างประจำ</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td width="9%" align="center">ชาย</td>
    <td width="10%" align="center">หญิง</td>
    <td width="11%" align="center">รวม</td>
    <td width="7%" align="center">ชาย</td>
    <td width="8%" align="center">หญิง</td>
    <td width="10%" align="center">รวม</td>
    <td align="center">ชาย</td>
    <td align="center">หญิง</td>
    <td align="center">รวม</td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ปกติ</strong></td>
    <td align="center"><? if(empty($alpsum1ch01m)){ echo "0";}else{ echo $alpsum1ch01m;}?></td>
    <td align="center"><? if(empty($alpsum1ch01f)){ echo "0";}else{ echo $alpsum1ch01f;}?></td>
    <td align="center"><? if(empty($alpsum1ch01)){ echo "0";}else{ echo $alpsum1ch01;}?></td>
    <td align="center"><? if(empty($alpsum1ch02m)){ echo "0";}else{ echo $alpsum1ch02m;}?></td>
    <td align="center"><? if(empty($alpsum1ch02f)){ echo "0";}else{ echo $alpsum1ch02f;}?></td>
    <td align="center"><? if(empty($alpsum1ch02)){ echo "0";}else{ echo $alpsum1ch02;}?></td>
    <td align="center"><? if(empty($alpsum1ch04m)){ echo "0";}else{ echo $alpsum1ch04m;}?></td>
    <td align="center"><? if(empty($alpsum1ch04f)){ echo "0";}else{ echo $alpsum1ch04f;}?></td>
    <td align="center"><? if(empty($alpsum1ch04)){ echo "0";}else{ echo $alpsum1ch04;}?></td>
    <td align="center"><? if(empty($alptotal1)){ echo "0";}else{ echo $alptotal1;}?></td>
  </tr>
  <tr>
    <td><strong>กลุ่ม ผิดปกติ</strong></td>
    <td align="center"><? if(empty($alpsum2ch01m)){ echo "0";}else{ echo $alpsum2ch01m;}?></td>
    <td align="center"><? if(empty($alpsum2ch01f)){ echo "0";}else{ echo $alpsum2ch01f;}?></td>
    <td align="center"><? if(empty($alpsum2ch01)){ echo "0";}else{ echo $alpsum2ch01;}?></td>
    <td align="center"><? if(empty($alpsum2ch02m)){ echo "0";}else{ echo $alpsum2ch02m;}?></td>
    <td align="center"><? if(empty($alpsum2ch02f)){ echo "0";}else{ echo $alpsum2ch02f;}?></td>
    <td align="center"><? if(empty($alpsum2ch02)){ echo "0";}else{ echo $alpsum2ch02;}?></td>
    <td align="center"><? if(empty($alpsum2ch04m)){ echo "0";}else{ echo $alpsum2ch04m;}?></td>
    <td align="center"><? if(empty($alpsum2ch04f)){ echo "0";}else{ echo $alpsum2ch04f;}?></td>
    <td align="center"><? if(empty($alpsum2ch04)){ echo "0";}else{ echo $alpsum2ch04;}?></td>
    <td align="center"><? if(empty($alptotal2)){ echo "0";}else{ echo $alptotal2;}?></td>
  </tr>
  <tr>
    <td colspan="10" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center"><?=$i;?></td>
  </tr>
</table>
<br />
<div style="page-break-after: always"></div>

<div style="margin-left:30px;"><strong>การประเมินผู้ป่วยโรคเรื้อรัง (เบาหวาน (DM), ความดันโลหิตสูง (HT), ไขมันในเลือดสูง (DLP))</strong></div>
<div style="margin-left:40px;">/ คือ อยู่เป็นผู้ป่วยประเภทนั้น</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" align="center" bgcolor="#FFCC33"><strong>ลำดับ</strong></td>
    <td width="31%" align="center" bgcolor="#FFCC33"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="10%" align="center" bgcolor="#FFCC33"><strong>อายุ</strong></td>
    <td width="16%" align="center" bgcolor="#FFCC33"><strong>โรคเรื้อรัง</strong></td>
    <td width="13%" align="center" bgcolor="#FFCC33"><strong>Control</strong></td>
    <td width="13%" align="center" bgcolor="#FFCC33"><strong>Un Control</strong></td>
    <td width="13%" align="center" bgcolor="#FFCC33"><strong>New Case</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
		$sql2 = "select * from armychkup where yearchkup='$nPrefix' and camp !='' and diagtype !='' order by chunyot asc, age desc";
}else{
		$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' and diagtype !='' order by chunyot asc, age desc";
}		
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		$sumcontrol=0;
		$sumuncontrol=0;
		$sumnewcase=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		//$ptname2="นามสมมุติ";
		$age2=$result2["age"];
		$gender2=$result2["gender"];
		
		
			if($result2['diagtype']=="control"){
				$chkcontrol="/";
				//เก็บสถิติ
				$sumcontrol++;  //จำนวน control
				if($age2 >= 35){
					$sumcontrol35++;
					if($gender2==1){  //ชาย
						$sumcontrolm35++;
					}else{
						$sumcontrolf35++;
					}
				}else{  //อายุ < 35
					$sumcontrol34++; 
					if($gender2==1){  //ชาย
						$sumcontrolm34++;
					}else{
						$sumcontrolf34++;
					}					
				}
			}else{
				$chkcontrol="";
			}
			if($result2['diagtype']=="uncontrol"){
				$chkuncontrol="/";
				//เก็บสถิติ
				$sumuncontrol++;  //จำนวน uncontrol
				if($age2 >= 35){
					$sumuncontrol35++;
					if($gender2==1){  //ชาย
						$sumuncontrolm35++;
					}else{
						$sumuncontrolf35++;
					}					
				}else{  //อายุ < 35
					$sumuncontrol34++;
					if($gender2==1){  //ชาย
						$sumuncontrolm34++;
					}else{
						$sumuncontrolf34++;
					}					
				}				
			}else{
				$chkuncontrol="";
			}
			
			if($result2['diagtype']=="newcase"){
				$chknewcase="/";
				//เก็บสถิติ
				$sumnewcase++;  //จำนวน control
				if($age2 >= 35){
					$sumnewcase35++;
					if($gender2==1){  //ชาย
						$sumnewcasem35++;
					}else{
						$sumnewcasef35++;
					}					
				}else{  //อายุ < 35
					$sumnewcase34++;
					if($gender2==1){  //ชาย
						$sumnewcasem34++;
					}else{
						$sumnewcasef34++;
					}					
				}				
			}else{
				$chknewcase="";
			}
			
			if($result2['diagtype']==""){
				$chknormal="/";
			}else{
				$chknormal="";
			}						
			
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><? if($result2['diseases_dm']=="1"){ echo "DM ";} if($result2['diseases_ht']=="1"){ echo "HT ";} if($result2['diseases_dlp']=="1"){ echo "DLP ";} if($result2['diseases_obesity']=="1"){ echo "Obesity";} ?></td>
    <td align="center"><strong>
      <?=$chkcontrol;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chkuncontrol;?>
    </strong></td>
    <td align="center"><strong>
      <?=$chknewcase;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<div align="center"><strong>สรุปผลการประเมินผู้ป่วยโรคเรื้อรัง (เบาหวาน (DM), ความดันโลหิตสูง (HT), ไขมันในเลือดสูง (DLP))</strong></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="14%" rowspan="3" align="center"><strong>ประเภท</strong></td>
    <td colspan="7" align="center"><strong>จำนวนกำลังพล/ราย</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>อายุไม่เกิน 35 ปีบริบูรณ์</strong></td>
    <td colspan="3" align="center"><strong>อายุมากกว่า 35 ปีบริบูรณ์</strong></td>
    <td width="12%" rowspan="2" align="center"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td width="12%" align="center">ชาย</td>
    <td width="12%" align="center">หญิง</td>
    <td width="12%" align="center">รวม</td>
    <td width="12%" align="center">ชาย</td>
    <td width="13%" align="center">หญิง</td>
    <td width="13%" align="center">รวม</td>
  </tr>
  <tr>
    <td><strong>Control</strong></td>
    <td align="center"><? if(empty($sumcontrolm34)){ echo "0";}else{ echo $sumcontrolm34;}?></td>
    <td align="center"><? if(empty($sumcontrolf34)){ echo "0";}else{ echo $sumcontrolf34;}?></td>
    <td align="center"><? if(empty($sumcontrol34)){ echo "0";}else{ echo $sumcontrol34;}?></td>
    <td align="center"><? if(empty($sumcontrolm35)){ echo "0";}else{ echo $sumcontrolm35;}?></td>
    <td align="center"><? if(empty($sumcontrolf35)){ echo "0";}else{ echo $sumcontrolf35;}?></td>
    <td align="center"><? if(empty($sumcontrol35)){ echo "0";}else{ echo $sumcontrol35;}?></td>
    <td align="center"><? if(empty($sumcontrol)){ echo "0";}else{ echo $sumcontrol;}?></td>
  </tr>
  <tr>
    <td><strong>Un Control</strong></td>
    <td align="center"><? if(empty($sumuncontrolm34)){ echo "0";}else{ echo $sumuncontrolm34;}?></td>
    <td align="center"><? if(empty($sumuncontrolf34)){ echo "0";}else{ echo $sumuncontrolf34;}?></td>
    <td align="center"><? if(empty($sumuncontrol34)){ echo "0";}else{ echo $sumuncontrol34;}?></td>
    <td align="center"><? if(empty($sumuncontrolm35)){ echo "0";}else{ echo $sumuncontrolm35;}?></td>
    <td align="center"><? if(empty($sumuncontrolf35)){ echo "0";}else{ echo $sumuncontrolf35;}?></td>
    <td align="center"><? if(empty($sumuncontrol35)){ echo "0";}else{ echo $sumuncontrol35;}?></td>
    <td align="center"><? if(empty($sumuncontrol)){ echo "0";}else{ echo $sumuncontrol;}?></td>
  </tr>
  <tr>
    <td><strong>New Case</strong></td>
    <td align="center"><? if(empty($sumnewcasem34)){ echo "0";}else{ echo $sumnewcasem34;}?></td>
    <td align="center"><? if(empty($sumnewcasef34)){ echo "0";}else{ echo $sumnewcasef34;}?></td>
    <td align="center"><? if(empty($sumnewcase34)){ echo "0";}else{ echo $sumnewcase34;}?></td>
    <td align="center"><? if(empty($sumnewcasem35)){ echo "0";}else{ echo $sumnewcasem35;}?></td>
    <td align="center"><? if(empty($sumnewcasef35)){ echo "0";}else{ echo $sumnewcasef35;}?></td>
    <td align="center"><? if(empty($sumnewcase35)){ echo "0";}else{ echo $sumnewcase35;}?></td>
    <td align="center"><? if(empty($sumnewcase)){ echo "0";}else{ echo $sumnewcase;}?></td>
  </tr>
  <tr>
    <td colspan="7" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center"><?=$i;?></td>
  </tr>
</table>
<br />
<div style="page-break-after: always"></div>
<div style="margin-left:30px;"><strong>การประเมินผู้ป่วยที่มีความเสี่ยงโรคเรื้อรัง (เบาหวาน (DM), ความดันโลหิตสูง (HT), ไขมันในเลือดสูง (DLP))</strong></div>
<div style="margin-left:40px;">/ คือ อยู่เป็นผู้ป่วยประเภทนั้น</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" align="center" bgcolor="#FF3366"><strong>ลำดับ</strong></td>
    <td width="31%" align="center" bgcolor="#FF3366"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="10%" align="center" bgcolor="#FF3366"><strong>อายุ</strong></td>
    <td width="16%" align="center" bgcolor="#FF3366"><strong>โรคเรื้อรัง</strong></td>
  </tr>  
<?
if($_POST["camp"]=="all"){
		$sql2 = "select * from armychkup where yearchkup='$nPrefix' and camp !='' and resultdiag_risk !='' order by chunyot asc, age desc";
}else{
		$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' and resultdiag_risk !='' order by chunyot asc, age desc";
}		
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		$sumcontrol=0;
		$sumuncontrol=0;
		$sumnewcase=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		//$ptname2="นามสมมุติ";
		$age2=$result2["age"];
		$gender2=$result2["gender"];
		
		
			if($result2['diagtype']=="control"){
				$chkcontrol="/";
				//เก็บสถิติ
				$sumcontrol++;  //จำนวน control
				if($age2 >= 35){
					$sumcontrol35++;
					if($gender2==1){  //ชาย
						$sumcontrolm35++;
					}else{
						$sumcontrolf35++;
					}
				}else{  //อายุ < 35
					$sumcontrol34++; 
					if($gender2==1){  //ชาย
						$sumcontrolm34++;
					}else{
						$sumcontrolf34++;
					}					
				}
			}else{
				$chkcontrol="";
			}
			if($result2['diagtype']=="uncontrol"){
				$chkuncontrol="/";
				//เก็บสถิติ
				$sumuncontrol++;  //จำนวน uncontrol
				if($age2 >= 35){
					$sumuncontrol35++;
					if($gender2==1){  //ชาย
						$sumuncontrolm35++;
					}else{
						$sumuncontrolf35++;
					}					
				}else{  //อายุ < 35
					$sumuncontrol34++;
					if($gender2==1){  //ชาย
						$sumuncontrolm34++;
					}else{
						$sumuncontrolf34++;
					}					
				}				
			}else{
				$chkuncontrol="";
			}
			
			if($result2['diagtype']=="newcase"){
				$chknewcase="/";
				//เก็บสถิติ
				$sumnewcase++;  //จำนวน control
				if($age2 >= 35){
					$sumnewcase35++;
					if($gender2==1){  //ชาย
						$sumnewcasem35++;
					}else{
						$sumnewcasef35++;
					}					
				}else{  //อายุ < 35
					$sumnewcase34++;
					if($gender2==1){  //ชาย
						$sumnewcasem34++;
					}else{
						$sumnewcasef34++;
					}					
				}				
			}else{
				$chknewcase="";
			}
			
			if($result2['diagtype']==""){
				$chknormal="/";
			}else{
				$chknormal="";
			}						
			
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><? if($result2['risk_dm']=="1"){ echo "DM ";} if($result2['risk_ht']=="1"){ echo "HT ";} if($result2['risk_dlp']=="1"){ echo "DLP ";} if($result2['risk_obesity']=="1"){ echo "Obesity";} ?></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<div align="center"><strong>สรุปผลการประเมินผู้ป่วยที่มีความเสี่ยงโรคเรื้อรัง (เบาหวาน (DM), ความดันโลหิตสูง (HT), ไขมันในเลือดสูง (DLP))</strong></div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="14%" rowspan="3" align="center"><strong>ประเภท</strong></td>
    <td colspan="7" align="center"><strong>จำนวนกำลังพล/ราย</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>อายุไม่เกิน 35 ปีบริบูรณ์</strong></td>
    <td colspan="3" align="center"><strong>อายุมากกว่า 35 ปีบริบูรณ์</strong></td>
    <td width="12%" rowspan="2" align="center"><strong>รวม (ราย)</strong></td>
  </tr>
  <tr>
    <td width="12%" align="center">ชาย</td>
    <td width="12%" align="center">หญิง</td>
    <td width="12%" align="center">รวม</td>
    <td width="12%" align="center">ชาย</td>
    <td width="13%" align="center">หญิง</td>
    <td width="13%" align="center">รวม</td>
  </tr>
  <tr>
    <td><strong>Control</strong></td>
    <td align="center"><? if(empty($sumcontrolm34)){ echo "0";}else{ echo $sumcontrolm34;}?></td>
    <td align="center"><? if(empty($sumcontrolf34)){ echo "0";}else{ echo $sumcontrolf34;}?></td>
    <td align="center"><? if(empty($sumcontrol34)){ echo "0";}else{ echo $sumcontrol34;}?></td>
    <td align="center"><? if(empty($sumcontrolm35)){ echo "0";}else{ echo $sumcontrolm35;}?></td>
    <td align="center"><? if(empty($sumcontrolf35)){ echo "0";}else{ echo $sumcontrolf35;}?></td>
    <td align="center"><? if(empty($sumcontrol35)){ echo "0";}else{ echo $sumcontrol35;}?></td>
    <td align="center"><? if(empty($sumcontrol)){ echo "0";}else{ echo $sumcontrol;}?></td>
  </tr>
  <tr>
    <td><strong>Un Control</strong></td>
    <td align="center"><? if(empty($sumuncontrolm34)){ echo "0";}else{ echo $sumuncontrolm34;}?></td>
    <td align="center"><? if(empty($sumuncontrolf34)){ echo "0";}else{ echo $sumuncontrolf34;}?></td>
    <td align="center"><? if(empty($sumuncontrol34)){ echo "0";}else{ echo $sumuncontrol34;}?></td>
    <td align="center"><? if(empty($sumuncontrolm35)){ echo "0";}else{ echo $sumuncontrolm35;}?></td>
    <td align="center"><? if(empty($sumuncontrolf35)){ echo "0";}else{ echo $sumuncontrolf35;}?></td>
    <td align="center"><? if(empty($sumuncontrol35)){ echo "0";}else{ echo $sumuncontrol35;}?></td>
    <td align="center"><? if(empty($sumuncontrol)){ echo "0";}else{ echo $sumuncontrol;}?></td>
  </tr>
  <tr>
    <td><strong>New Case</strong></td>
    <td align="center"><? if(empty($sumnewcasem34)){ echo "0";}else{ echo $sumnewcasem34;}?></td>
    <td align="center"><? if(empty($sumnewcasef34)){ echo "0";}else{ echo $sumnewcasef34;}?></td>
    <td align="center"><? if(empty($sumnewcase34)){ echo "0";}else{ echo $sumnewcase34;}?></td>
    <td align="center"><? if(empty($sumnewcasem35)){ echo "0";}else{ echo $sumnewcasem35;}?></td>
    <td align="center"><? if(empty($sumnewcasef35)){ echo "0";}else{ echo $sumnewcasef35;}?></td>
    <td align="center"><? if(empty($sumnewcase35)){ echo "0";}else{ echo $sumnewcase35;}?></td>
    <td align="center"><? if(empty($sumnewcase)){ echo "0";}else{ echo $sumnewcase;}?></td>
  </tr>
  <tr>
    <td colspan="7" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center"><?=$i;?></td>
  </tr>
</table>
<br />
<div style="page-break-after: always"></div>

<div style="margin-left:30px;"><strong>การตรวจทางรังสีกรรม</strong></div>
<div style="margin-left:40px;">/ คือ อยู่ในเกณฑ์ปกติ</div>
<div style="margin-left:40px;">X คือ อยู่ในเกณฑ์ผิดปกติ</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" rowspan="2" align="center" bgcolor="#009999"><strong>ลำดับ</strong></td>
    <td width="63%" rowspan="2" align="center" bgcolor="#009999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="10%" rowspan="2" align="center" bgcolor="#009999"><strong>อายุ</strong></td>
    <td align="center" bgcolor="#009999"><strong>ผลการตรวจ</strong></td>
  </tr>
  <tr>
    <td width="20%" align="center" bgcolor="#009999"><strong>X-Ray</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
		$sql2 = "select * from armychkup where yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}else{
		$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}		
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		$age2=$result2["age"];
			
			if($result2['xray']=="ผิดปกติ"){
				$chkxray="X";
			}else if($result2['xray']=="ปกติ"){
				$chkxray="/";
			}else{
				$chkxray="";
			}																	
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><strong>
      <?=$chkxray;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<br />
<div style="page-break-after: always"></div>
<div style="margin-left:30px;"><strong>การตรวจทางทันตกรรม</strong></div>
<div style="margin-left:40px;">/ คือ อยู่ในเกณฑ์ปกติ</div>
<div style="margin-left:40px;">X คือ อยู่ในเกณฑ์ผิดปกติ</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" rowspan="2" align="center" bgcolor="#009999"><strong>ลำดับ</strong></td>
    <td width="63%" rowspan="2" align="center" bgcolor="#009999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="10%" rowspan="2" align="center" bgcolor="#009999"><strong>อายุ</strong></td>
    <td align="center" bgcolor="#009999"><strong>ผลการตรวจ</strong></td>
  </tr>
  <tr>
    <td width="20%" align="center" bgcolor="#009999"><strong>สภาวะช่องปาก</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
		$sql2 = "select * from armychkup where yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}else{
		$sql2 = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' and camp !='' order by chunyot asc, age desc";
}		
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		$age2=$result2["age"];
			
			if($result2['result_dental']=="ผิดปกติ"){
				$chkdental="X";
			}else if($result2['result_dental']=="ปกติ"){
				$chkdental="/";
			}else{
				$chkdental="";
			}																	
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><strong>
      <?=$chkdental;?>
    </strong></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<? } ?>
