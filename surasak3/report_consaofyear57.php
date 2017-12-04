<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
include("../connect.inc");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
  <form action="<? $PHP_SELF; ?>" method="post" name="form1" id="form1">
    <tr>
      <td align="right" valign="bottom"><span>หน่วยงาน :</span>
         <select  name="txtcamp">
         <option value="0">---------- เลือก ----------</option>
          <option value="M02">ร.17 พัน2</option>
          <option value="M04">ร.พ.ค่ายสุรศักดิ์มนตรี</option>
          <option value="M05">ช.พัน4</option>
          <option value="M06">ร้อยฝึกรบพิเศษประตูผา</option>
          <option value="M0301">บก.มทบ.32</option>
          <option value="M0302">กกพ.มทบ.32</option>
          <option value="M0303">กขว.,ฝผท.มทบ.32</option>
          <option value="M0304">กยก.มทบ.32</option>
          <option value="M0305">กกบ.มทบ.32</option>
          <option value="M0306">กกร.มทบ.32</option>
          <option value="M0307">ฝคง.มทบ.32</option>
          <option value="M0308">ฝกง.มทบ.32</option>
          <option value="M0309">ฝสก.มทบ.32</option>
          <option value="M0311">ผพธ.มทบ.32</option>
          <option value="อก.ศาล">อก.ศาล มทบ.32</option>
          <option value="ฝสวส">ฝสวส.มทบ.32</option>
          <option value="M0314">ฝธน.มทบ.32</option>
          <option value="M0315">อศจ.มทบ.32</option>
          <option value="M0316">ร้อย.มทบ.32</option>
          <option value="M0317">สขส.มทบ.32</option>
          <option value="รจ">รจ.มทบ.32</option>
          <option value="M0318">ผยย.มทบ.32</option>
          <option value="M0319">ฝสส.มทบ.32</option>
          <option value="M0320">ฝสห.มทบ.32</option>
          <option value="M0321">ร้อย.สห.มทบ.32</option>
          <option value="M0322">มว.ดย.มทบ.32</option>
          <option value="M0323">ผสพ.มทบ.32</option>
          <option value="M0324">สรรพกำลัง มทบ.32</option>
          <option value="M0325">ศฝ.นศท.มทบ.32</option>
          <option value="ศาล.มทบ.32">ศาล.มทบ.32</option>
          <option value="M0327">ศูนย์โทรศัพท์ มทบ.32</option>
          <option value="M0328">ผปบ.มทบ.32</option>
          <option value="M08">สัสดีจังหวัดลำปาง</option>
        </select>
        &nbsp;ปี :
        <select name="year" id="yr">
          <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
          <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
          <?php }?>
        </select>
        <input type="submit" class="formbutton" name="submit" value="ค้นหาข้อมูล" />
        <input type="hidden" name="page" value="1" /></td>
    </tr>
  </form>
</table>
<?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%'";		
		}
		$query=mysql_query($sql);
		$num=mysql_num_rows($query);
		$numht1=0;
		$tahan1=0;
		$tahan2=0;
		$tahan3=0;		
		$bmi1=0;
		$bmi2=0;
		$bmi3=0;
		$bmi4=0;
		$bmi5=0;	
		$personal34=0;
		$personal35=0;
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
		while($rows=mysql_fetch_array($query)){
		$camp = $rows["camp"];
		$age = substr($rows["age"],0,2);
		$bp1 = $rows["bp1"];
		$bp2 = $rows["bp2"];
		$cxr = $rows["cxr"];
		$stat_ua = $rows["stat_ua"];
		$stat_hct = $rows["stat_hct"];
		$stat_bs =  $rows["stat_bs"];
		$stat_chol =  $rows["stat_chol"];
		$stat_tg =  $rows["stat_tg"];
		$stat_bun =  $rows["stat_bun"];
		$stat_cr =  $rows["stat_cr"];
		$stat_sgot =  $rows["stat_sgot"];
		$stat_sgpt =  $rows["stat_sgpt"];
		$stat_alk =  $rows["stat_alk"];		
		$stat_uric =  $rows["stat_uric"];
			if($age<=35){
				$personal34++; 
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
				$personal35++;
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
			$nhn = $rows["hn"];
			$sql1 = "select goup from opcard where hn='".$nhn."'";
			//echo $sql1;
			$aa = mysql_query($sql1);
			$result = mysql_fetch_array($aa);			
			$code = substr($result['goup'],0,3);
			
			if($code=="G11"){
				$tahan1++;//นายทหาร
				//echo $result['yot']."<br>";
				//echo $nhn."<br>";
			}elseif($code=="G12" || $code=="G21" || $code=="G37"){
				$tahan2++;//นายสิบ
				//echo $result['yot']."<br>";
				//echo $nhn."<br>";
			}else{
				$tahan3++;
				//echo $nhn."<br>";
			}			
		
			$bmi = $rows["bmi"];		
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
		
		}  // while
		//echo $numht1;	
?>
<p>&nbsp;</p>
<p align="center"><span><strong>แบบรายงานสรุปผลการตรวจร่างกาย ประจำปี <?=$_POST["year"];?>
  <br>
</strong></span><strong>(ฉบับปรับปรุงใหม่ล่าสุด)</strong></p>
<p align="center"><strong>รพ.ที่ทำการตรวจ โรงพยาบาลค่ายสุรศักดิ์มนตรี<br>
</strong><strong>นามหน่วยที่มารับการตรวจ 
  <? if($_POST["txtcamp"]=="0"){ echo "รวมทุกหน่วย"; }else{ echo $camp; }?>
</strong></p>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><strong>1. กำลังพลของหน่วยทั้งหมด </strong></td>
    <td width="12%" align="right">
    <?
		if($_POST["txtcamp"]=="0"){
			$sqlchkup="SELECT *
			FROM chkup_solider";		
		}else{
			$sqlchkup="SELECT *
			FROM chkup_solider
			WHERE  camp
			LIKE  '%$_POST[txtcamp]%'";		
		}
		$querychkup=mysql_query($sqlchkup);
		$numchkup=mysql_num_rows($querychkup);
		echo $numchkup;
	?>    </td>
    <td width="32%"><strong>นาย</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>2. จำนวนผู้มารับการตรวจ</strong></td>
    <td align="right"><?=$num;?></td>
    <td><strong>ราย แบ่งเป็น</strong></td>
  </tr>
  <tr>
    <td width="3%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="53%"><strong>2.1 นายทหารสัญญาบัตร</strong></td>
    <td align="right"><?=$tahan1;?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>2.2 นายทหารชั้นประทวน</strong></td>
    <td align="right"><?=$tahan2;?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>2.3 ลูกจ้างประจำ</strong></td>
    <td align="right"><?=$tahan3;?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td colspan="4"><strong>3. ดัชนีมวลกาย (BMI)</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>3.1 Under weight (น้อยกว่า 18.5)</strong></td>
    <td align="right"><?=$bmi1;?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>3.2 Normal weight (18.5-22.9)</strong></td>
    <td align="right"><?=$bmi2;?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>3.3 Over weight (23.0-24.9)</strong></td>
    <td align="right"><?=$bmi3;?></td>
    <td><strong>ราย</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>3.4 Obesity ระดับ 1 (25-29.9)</strong></td>
    <td align="right"><?=$bmi4;?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>3.5 Obesity ระดับ 2 (มากกว่าหรือเท่ากับ 30)</strong></td>
    <td align="right"><?=$bmi5;?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>4. ผู้มารับการตรวจที่มีอายุไม่เกิน 35 ปี บริบูรณ์</strong></td>
    <td align="right"><?=$personal34;?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>4.1 BP (ค่าปกติ 140/90 mmHg)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BP ผิดปกติ</strong></td>
    <td align="right"><?=$bpcount1?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>4.2 Chest X-ray ผิดปกติ</strong></td>
    <td align="right"><?=$cxrcount1?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>4.3 Uric Examination ผิดปกติ</strong></td>
    <td align="right"><?=$stat_uacount1?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.4 Hct (ค่าปกติ ชาย = 40-45, หญิง = 36-47)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Hct ผิดปกติ</strong></td>
    <td align="right"><?=$stat_hctcount1?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.5 โรคอื่นๆ</strong></td>
    <td align="right">-</td>
    <td><strong>ราย</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ระบุ</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>5. ผู้มารับการตรวจที่มีอายมากกว่า 35 ปี บริบูรณ์ขึ้นไป</strong></td>
    <td align="right"><?=$personal35;?></td>
    <td align="left"><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>5.1 BP (ค่าปกติ 140/90 mmHg)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BP ผิดปกติ</strong></td>
    <td align="right"><?=$bpcount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>5.2 Chest X-ray ผิดปกติ</strong></td>
    <td align="right"><?=$cxrcount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>5.3 Uric Examination ผิดปกติ</strong></td>
    <td align="right"><?=$stat_uacount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.4 Hct (ค่าปกติ ชาย = 40-45, หญิง = 36-47)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Hct ผิดปกติ</strong></td>
    <td align="right"><?=$stat_hctcount2?></td>
    <td align="left"><strong>ราย</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.5 Glucose (ค่าปกติ 68-110)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Glucose ผิดปกติ</strong></td>
    <td align="right"><?=$stat_bscount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.6 Cholesterol (ค่าปกติ 120-200)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Cholesterol ผิดปกติ</strong></td>
    <td align="right"><?=$stat_cholcount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.7 Triglycerides (ค่าปกติ 50-160)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Triglycerides ผิดปกติ</strong></td>
    <td align="right"><?=$stat_tgcount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.8 HDL-C (ค่าปกติ มากกว่า 55)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>HDL-C ผิดปกติ</strong></td>
    <td align="right">ไม่มีการตรวจ</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.9 LDL-C (ค่าปกติ น้อยกว่า 130)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>LDL-C ผิดปกติ</strong></td>
    <td align="right">ไม่มีการตรวจ</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.10 BUN (ค่าปกติ 6-20)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;BUN ผิดปกติ</strong></td>
    <td align="right"><?=$stat_buncount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.11 Creatinine (ค่าปกติ 0.67-1.17)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Creatinine ผิดปกติ</strong></td>
    <td align="right"><?=$stat_crcount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.12 SGOT (ค่าปกติ 0-37)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>SGOT ผิดปกติ</strong></td>
    <td align="right"><?=$stat_sgotcount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.13 SGPT (ค่าปกติ 0-41)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>SGPT ผิดปกติ</strong></td>
    <td align="right"><?=$stat_sgptcount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.14 ALK Phoshatase (ค่าปกติ 40-129)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ALK</strong> <strong>Phoshatase ผิดปกติ</strong></td>
    <td align="right"><?=$stat_alkcount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.15 Uric acid (ค่าปกติ 2.47-8.40)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Uric acid ผิดปกติ</strong></td>
    <td align="right"><?=$stat_uriccount2?></td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.16 โรคอื่นๆ</strong></td>
    <td align="right">-</td>
    <td><strong>ราย</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ระบุ</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p align="left">&nbsp;</p>
