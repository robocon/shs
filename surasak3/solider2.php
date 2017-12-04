<?php
include("connect.inc");
?>
<STYLE>
.font1 {
	font-family: "Angsana New";
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
</STYLE>
</head>

<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form id="form1" name="form1" method="post" action="solider2.php">
  <a href="abnormal_dx_all.php">รายงานสรุปทุกหน่วย</a>
<table width="42%" border="0" align="center">
  <tr>
    <td height="31" align="center"><strong>รายงานการตรวจร่างกายประจำปี ทบ.</strong></td>
  </tr>
  <tr>
    <td height="36" align="center">
          กลุ่ม :  
<select  name='camp'>
<option value='' >--เลือกสังกัด--</option>
<option value='พลเรือน'>พลเรือน</option>
<option value='ร.17 พัน2'>ร.17 พัน2</option>
<option value='มณฑลทหารบกที่32'>มณฑลทหารบกที่32</option>
<option value='ร.พ.ค่ายสุรศักดิ์มนตรี'>ร.พ.ค่ายสุรศักดิ์มนตรี</option>
<option value='ช.พัน4'>ช.พัน4</option>
<option value='ร้อยฝึกรบพิเศษประตูผา'>ร้อยฝึกรบพิเศษประตูผา</option>
<option value='บก.มทบ.32'>บก.มทบ.32</option>
<option value='กกพ.มทบ.32'>กกพ.มทบ.32</option>
<option value='กขว.,ฝผท.มทบ.32'>กขว.,ฝผท.มทบ.32</option>
<option value='กยก.มทบ.32'>กยก.มทบ.32</option>
<option value='กกบ.มทบ.32'>กกบ.มทบ.32</option>
<option value='กกร.มทบ.32'>กกร.มทบ.32</option>
<option value='ฝคง.มทบ.32'>ฝคง.มทบ.32</option>
<option value='ฝกง.มทบ.32'>ฝกง.มทบ.32</option>
<option value='ฝสก.มทบ.32'>ฝสก.มทบ.32</option>
<!--<option value='ฝปบฝ.มทบ.32'>ฝปบฝ.มทบ.32</option>-->
<option value='ผพธ.มทบ.32'>ผพธ.มทบ.32</option>
<option value='อก.ศาล มทบ.32'>อก.ศาล มทบ.32</option>
<option value='ฝสวส.มทบ.32'>ฝสวส.มทบ.32</option>
<option value='ฝธน.มทบ.32'>ฝธน.มทบ.32</option>
<option value='อศจ.มทบ.32'>อศจ.มทบ.32</option>
<option value='ร้อย.มทบ.32'>ร้อย.มทบ.32</option>
<option value='สขส.มทบ.32'>สขส.มทบ.32</option>
<option value='รจ.มทบ.32'>รจ.มทบ.32</option>
<option value='ผยย.มทบ.32'>ผยย.มทบ.32</option>
<option value='ฝสส.มทบ.32'>ฝสส.มทบ.32</option>
<option value='ฝสห.มทบ.32'>ฝสห.มทบ.32</option>
<option value='ร้อย.สห.มทบ.32'>ร้อย.สห.มทบ.32</option>
<option value='มว.ดย.มทบ.32'>มว.ดย.มทบ.32</option>
<option value='ผสพ.มทบ.32'>ผสพ.มทบ.32</option>
<option value='สรรพกำลัง มทบ.32'>สรรพกำลัง มทบ.32</option>
<option value='ศฝ.นศท.มทบ.32'>ศฝ.นศท.มทบ.32</option>
<option value='ศาล.มทบ.32'>ศาล.มทบ.32</option>
<option value='ศูนย์โทรศัพท์ มทบ.32'>ศูนย์โทรศัพท์ มทบ.32</option>
<option value='ผปบ.มทบ.32'>ผปบ.มทบ.32</option>
<option value='สัสดีจังหวัดลำปาง'>สัสดีจังหวัดลำปาง</option>
<option value='มว.คลัง สป.๓ฯ'>มว.คลัง สป.๓ฯ</option>
<option value='กรม ทพ.33'>กรม ทพ.33</option>
<option value='หน่วยทหารอื่นๆ'>หน่วยทหารอื่นๆ</option>
<option value='aaug'>-----ตกค้างตั้งแต่ สค.------</option>
<option value='aร.17 พัน2'>ร.17 พัน2</option>
<option value='aหน่วยทหารอื่นๆ'>หน่วยทหารอื่นๆ</option>
</select>
&nbsp;ปี :
<select name="year" id="yr">
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
	$bmi1=0;
	$bmi2=0;
	$bmi3=0;
	$bmi4=0;
	$bmi5=0;
	$bpcount1=0;
	$bpcount2=0;
	$cxrcount1=0;
	$cxrcount2=0;
	$stat_uacount1=0;
	$stat_uacount2=0;
	$stat_hctcount1=0;
	$stat_hctcount2=0;
	$stat_bscount2=0;
	$stat_cholcount2=0;
	$stat_tgcount2=0;
	$stat_buncount2=0;
	$stat_crcount2=0;
	$stat_sgotcount2=0;
	$stat_sgptcount2=0;
	$stat_alkcount2=0;
	$stat_uriccount2=0;
	$tahan1=0;
	$tahan2=0;
	$tahan3=0;
	$y1 = $_POST['year']-543;
	$y2=$y1+1;
	if($_POST['camp']=='ฝสส.มทบ.32') $_POST['camp']="M0319";
	if($_POST['camp']=='ฝสห.มทบ.32') $_POST['camp']="M0320";
	if($_POST['camp']=='aaug'||$_POST['camp']=='aร.17 พัน2'||$_POST['camp']=='aหน่วยทหารอื่นๆ'){
		$query2 = "select camp,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and (thidate between '$y1-10-01 00:00:00' and '$y2-02-28 23:59:59' ) and camp like '%".substr($_POST['camp'],1)."%' ";
		$ok=1;
	}
	elseif($_POST['camp']==''){
		$query2 = "select camp,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and substr(left(camp,3),2) between '02' and '10'  ";
	}else{
		$query2 = "select camp,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and camp like '%".$_POST['camp']."%'  ";
	}
	//echo $query2;
	$aa2 = mysql_query($query2);
	$count = mysql_num_rows($aa2);
	while(list($camp,$bmi,$age,$bp1,$bp2,$cxr,$stat_ua,$nhn,$stat_hct,$stat_bs,$stat_chol,$stat_tg,$stat_bun,$stat_cr,$stat_sgot,$stat_sgpt,$stat_alk,$stat_uric) = mysql_fetch_array($aa2)){
		$query = "select goup from opcard where hn='".$nhn."'";
		$aa = mysql_query($query);
		$result = mysql_fetch_array($aa);
		$code = substr($result['goup'],0,3);
		
		if($code=="G11"){
			$tahan1++;//นายทหาร
			//echo $result['yot']."<br>";
			//echo $nhn."<br>";
		}
		elseif($code=="G12" || $code=="G21" || $code=="G37"){
			$tahan2++;//นายสิบ
			//echo $result['yot']."<br>";
			//echo $nhn."<br>";
		}
		/*elseif($code=="G14"){
			$tahan3++;//ลูกจ้างประจำ
		}*/
		else{
			$tahan3++;
			//echo $nhn."<br>";
		}
		
		if($bmi<18.50){
			$bmi1++;
		}
		elseif($bmi>=18.50&&$bmi<=22.99){
			$bmi2++;
		}
		elseif($bmi>=23.00&&$bmi<=24.99){
			$bmi3++;
		}
		elseif($bmi>=25.00&&$bmi<=29.99){
			$bmi4++;
		}
		elseif($bmi>=30.00){
			$bmi5++;
		}
		$age = substr($age,0,2);
		if($age<=35){
			$count2++; 
			if($bp1>140||$bp2>90){
				$bpcount1++;
			}
			if($cxr=="ผิดปกติ"){
				$cxrcount1++;
			}
			if($stat_ua=="ผิดปกติ"){
				$stat_uacount1++;
			}
			if($stat_hct=="ผิดปกติ"){
				$stat_hctcount1++;
			}
		}
		elseif($age>35){
			$count3++;
			if($bp1>140||$bp2>90){
				$bpcount2++;
			}
			if($cxr=="ผิดปกติ"){
				$cxrcount2++;
			}
			if($stat_ua=="ผิดปกติ"){
				$stat_uacount2++;
			}
			if($stat_hct=="ผิดปกติ"){
				$stat_hctcount2++;
			}
			if($stat_bs=="ผิดปกติ"){
				$stat_bscount2++;
			}
			if($stat_chol=="ผิดปกติ"){
				$stat_cholcount2++;
			}
			if($stat_tg=="ผิดปกติ"){
				$stat_tgcount2++;
			}
			if($stat_bun=="ผิดปกติ"){
				$stat_buncount2++;
			}
			if($stat_cr=="ผิดปกติ"){
				$stat_crcount2++;
			}
			if($stat_sgot=="ผิดปกติ"){
				$stat_sgotcount2++;
			}
			if($stat_sgpt=="ผิดปกติ"){
				$stat_sgptcount2++;
			}
			if($stat_alk=="ผิดปกติ"){
				$stat_alkcount2++;
			}
			if($stat_uric=="ผิดปกติ"){
				$stat_uriccount2++;
			}
		}
		$_POST['camp']=$camp;
	}
	if($_POST['camp']=='M0319') $_POST['camp']="ฝสส.มทบ.32";
	if($_POST['camp']=='M0320') $_POST['camp']="ฝสห.มทบ.32";

	$allcount = $count;
	?>
	<table width="100%" class="font1">
    	<tr>
    	  <td colspan="3" align="center"><strong>แบบรายงานสรุปผลการตรวจร่างกาย ประจำปี <?=$_POST['year']?></strong></td>
   	    </tr>
        <tr>
        <td colspan="3" align="center"><strong>รพ.ที่ทำการตรวจ ..................โรงพยาบาลค่ายสุรศักดิ์มนตรี...........................</strong></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><strong>นามหน่วยที่มารับการตรวจ................<?=$_POST['camp']?>...................</strong></td>
        </tr>
        <tr>
          <td>1. จำนวนผู้มารับการตรวจ</td>
          <td width="29%" align="center"><?=$count?></td>
          <td width="28%">ราย  แบ่งเป็น</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;1.1 นายทหารสัญญาบัตร</td>
          <td align="center"><?=$tahan1?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;1.2 นายทหารชั้นประทวน</td>
          <td align="center"><?=$tahan2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;1.3 ลูกจ้างประจำ</td>
          <td align="center"><?=$tahan3?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center"><?=$other?></td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="43%">2. ค่าดัชนีมวลกาย (BMI)</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.1 Under weight (น้อยกว่า 18.5)</td>
          <td align="center"><?=$bmi1?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.2 Normal weight (18.5-22.9)</td>
          <td align="center"><?=$bmi2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.3 Over weight (23.0-24.9)</td>
          <td align="center"><?=$bmi3?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.4 Obesity ระดับ1(25-29.9)</td>
          <td align="center"><?=$bmi4?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.5 Obesity ระดับ2(มากกว่าหรือเท่ากับ30)</td>
          <td align="center"><?=$bmi5?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><p>3. ผู้ที่อายุไม่เกิน 35 ปีบริบูรณ์</p></td>
          <td align="center"><?=$count2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.1 BP (ต่าปกติ 140-90 mmHg)</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BP ผิดปกติ</td>
          <td align="center"><?=$bpcount1?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.2 Chest X-Ray ผิดปกติ</td>
          <td align="center"><?=$cxrcount1?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.3 Urine Examination ปกติ</td>
          <td align="center"><?=$stat_uacount1?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.4 Hct(ค่าปกติ ชาย=40-54,หญิง 36-47)</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hct ผิดปกติ</td>
          <td align="center"><?=$stat_hctcount1?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.5 โรคอื่นๆ</td>
          <td align="center">-</td>
          <td>ราย</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ระบุ................................................................................................</td>
        </tr>
        </table>
        <div style="page-break-before:always;"></div>
       	<table width="100%" class="font1">
        <tr>
          <td width="43%" align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>4. ผู้ที่มีอายุมากกว่า 35 ปี บริบูรณ์ขึ้นไป</td>
          <td width="29%" align="center"><?=$count3?></td>
          <td width="28%">ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.1 BP (ค่าปกติ 140/90 mmHg)</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BP ผิดปกติ</td>
          <td align="center"><?=$bpcount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.2 Chest X-Ray ผิดปกติ</td>
          <td align="center"><?=$cxrcount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.3 Urine Examination ผิดปกติ</td>
          <td align="center"><?=$stat_uacount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.4 Hct(ค่าปกติ ชาย=40-54,หญิง=36-47)</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hct ผิดปกติ</td>
          <td align="center"><?=$stat_hctcount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.5 Glucose</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Glucose</td>
          <td align="center"><?=$stat_bscount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.6 Cholesterol</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cholesterol</td>
          <td align="center"><?=$stat_cholcount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.7 Triglycerides</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Triglycerides</td>
          <td align="center"><?=$stat_tgcount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.8 HDL-C</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HDL-C</td>
          <td align="center">ไม่มีการตรวจ</td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.9 LDL-C</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LDL-C</td>
          <td align="center">ไม่มีการตรวจ</td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.10 BUN</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BUN</td>
          <td align="center"><?=$stat_buncount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.11 Creatinine</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Creatinine</td>
          <td align="center"><?=$stat_crcount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.12 SGOT</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SGOT</td>
          <td align="center"><?=$stat_sgotcount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.13 SGPT</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SGPT</td>
          <td align="center"><?=$stat_sgptcount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.14 ALK Phosphatase</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ALK Phosphatase</td>
          <td align="center"><?=$stat_alkcount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.15 Uric acid</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Uric acid</td>
          <td align="center"><?=$stat_uriccount2?></td>
          <td>ราย</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.16 โรคอื่นๆ</td>
          <td align="center">0</td>
          <td>ราย</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ระบุ................................................................................................</td>
        </tr>
	</table><br><br>
    <div style="page-break-after:always;"></div>
	<?
	include("abnormal_dx.php");
	?>
	<div style="page-break-after:always;"></div>
	<?
	//echo "ทดสอบโปรแกรมอยู่ค่ะ ยังไม่เปิดใช้งาน";
	include("abnormal_dx_list.php");
}

?>
</body>
</html>