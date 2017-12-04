<?
session_start();
//if (isset($sIdname)){} else {die;} //for security
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
	font-size: 14px;
	font-family: AngsanaUPC;
}
.style1 {
	font-size: 16px;
	font-weight: bold;
}
.fontbig {font-size: 14px}
.fontbig3 {font-size: 18px}
.style3 {font-size: 14px; font-weight: bold; }
.style4 {font-size: 18px; font-weight: bold; }

@media print{
	#none_print { display:none;}
}

-->
</style>
<title>พิมพ์ผลตรวจสุขภาพทหารประจำปีแบบกลุ่ม</title>
<div id="none_print">
<p align="center"><strong>พิมพ์ผลตรวจสุขภาพทหารประจำปี <?=$newPrefix;?></strong></p>
<form name="form1" method="post" action="<? $PHP_SELF;?>" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">หน่วย :
        <label>      
        <select name="camp" id="camp">
		 <?
		 $sql="select distinct(camp) as camp from armychkup where yearchkup = '$nPrefix'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=substr($rows["camp"],4);
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <input type="submit" name="button" id="button" value="พิมพ์รายงาน">
        </label></td>
    </tr>
  </table>
</form>
</div>
<?
if($_POST["act"]=="show"){

$camp=$_POST["camp"];
$chkcamp=substr($camp,0,3);
$select = "select * from armychkup where status_print is null and typechkup!='out' and yearchkup='$nPrefix' and camp !='' and camp !='D34 กทพ.33' order by chunyot asc, age desc";
//echo $select;
$row = mysql_query($select);
while($result = mysql_fetch_array($row)){
if($chkcamp=="D01"){
	$datechkup="วันที่ 18 เดือน ตุลาคม พ.ศ. 2559";
}else if($chkcamp=="D02" || $chkcamp=="D11" || $chkcamp=="D12" || $chkcamp=="D03" || $chkcamp=="D08" || $chkcamp=="D16" || $chkcamp=="D05" || $chkcamp=="D06" || $chkcamp=="D07" || $chkcamp=="D15" || $chkcamp=="D10" || $chkcamp=="D27" || $chkcamp=="D28" || $chkcamp=="21"){  //
	$datechkup="วันที่ 15 เดือน พฤศจิกายน พ.ศ. 2559";
}else if($chkcamp=="D13" || $chkcamp=="D29" || $chkcamp=="D25"){  //
	$datechkup="วันที่ 16 เดือน พฤศจิกายน พ.ศ. 2559";	
}else if($chkcamp=="D26" || $chkcamp=="D22" || $chkcamp=="D09" || $chkcamp=="D35"){  //
	$datechkup="วันที่ 17 เดือน พฤศจิกายน พ.ศ. 2559";	
}else if($chkcamp=="D23" || $chkcamp=="D24" || $chkcamp=="D20" || $chkcamp=="D18" || $chkcamp=="D14" || $chkcamp=="D17"){  //
	$datechkup="วันที่ 18 เดือน พฤศจิกายน พ.ศ. 2559";	
}else if($chkcamp=="D04" || $chkcamp=="D32"){  //สง.สด. ร้อย.ฝรพ.
	$datechkup="วันที่ 21 เดือน พฤศจิกายน พ.ศ. 2559";
}else if($chkcamp=="D30"){  //ร.17
	$datechkup="วันที่ 23 เดือน พฤศจิกายน พ.ศ. 2559";
}else if($chkcamp=="D31"){  //ช.พัน4
	$datechkup="วันที่ 25 เดือน พฤศจิกายน พ.ศ. 2559";
}
?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4" align="center" valign="top"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" ><img src="logo.jpg" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" ><span class="style1" style="font-size:22px;">แบบรายงานการตรวจสุขภาพประจำปี
            <?=$newPrefix;?>
        </span></td>
        <td width="14%" align="center" valign="top" >&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" ><span class="style1">โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</span></td>
        <td align="center" valign="top" >&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" ><span class="style1"><? echo $datechkup; ?></span>        </td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr style="line-height:3px;">
    <td colspan="4" align="center" valign="top">
    <table width="100%" class="fonthead">
      <tr>
        <td width="17%" valign="top"><strong>HN :</strong>
            <span style="font-size:16px;"><?=$result['hn']?></span></td>
        <td colspan="2" valign="top"><strong>ชื่อ :</strong>
          <span style="font-size:16px;"><?=$result['yot']." ".$result['ptname']?></span></td>
        <td width="12%" valign="top"><strong>อายุ :</strong>
            <span style="font-size:16px;"><?=$result['age']?></span></td>
        <td colspan="2" valign="top"><strong>สังกัด : </strong>
          <span style="font-size:16px;"><?= substr($result['camp'],4)?></span></td>
      </tr>
      <tr>
        <td valign="top"><strong>น้ำหนัก : </strong>
              <?=$result['weight']?>&nbsp;กก.</td>
        <td width="18%" valign="top"><strong>ส่วนสูง :</strong>
              <?=$result['height']?>&nbsp;ซม.</td>
        <td width="15%" valign="top"><strong>รอบเอว :</strong>
            <?=$result['waist']?>&nbsp;นิ้ว</td>
        <td valign="top"><strong>อุณหภูมิ :</strong>
        <?=$result['temperature']?>
        C</td>
        <td width="22%" valign="top"><strong>ชีพจร : </strong>
            <?=$result['pulse']?>&nbsp;ครั้ง/นาที</td>
        <td width="16%" valign="top"><strong>หายใจ : </strong>
            <?=$result['rate']?>&nbsp;ครั้ง/นาที</td>
      </tr>
      <tr>
        <td valign="top"><strong>บุหรี่ : </strong>
            <? if($result['cigarette']=="0"){ echo "ไม่เคยสูบ";}else if($result['cigarette']=="1"){ echo "เคยสูบ แต่เลิกแล้ว";}else if($result['cigarette']=="2"){ echo "สูบเป็นครั้งคราว";}else if($result['cigarette']=="3"){ echo "สูบเป็นประจำ";}?>        </td>
        <td valign="top"><strong>สุรา : </strong>
            <? if($result['alcohol']=="0"){ echo "ไม่เคยดื่ม";}else if($result['alcohol']=="1"){ echo "เคยดื่ม แต่เลิกแล้ว";}else if($result['alcohol']=="2"){ echo "ดื่มเป็นครั้งคราว";}else if($result['alcohol']=="3"){ echo "ดื่มเป็นประจำ";}?>        </td>
        <td colspan="2" valign="top"><strong>ออกกำลังกาย : </strong>
            <? if($result['exercise']=="0"){ echo "ไม่เคยออกกำลังกาย";}else if($result['exercise']=="1"){ echo "ออกกำลังกายต่ำกว่าเกณฑ์";}else if($result['exercise']=="2"){ echo "ออกกำลังกายตามเกณฑ์";}?>        </td>
        <td colspan="2" valign="top"><strong>แพ้ยา :</strong>
            <?=$result['hospitaldrugreact'];?>        </td>
      </tr>
      <tr>
        <td colspan="3" valign="top"><strong>ประวัติโรคประจำตัว : </strong>
              <? if($result['prawat']=="0"){ echo "ไม่มีโรคประจำตัว";}
	  		else if($result['prawat']=="1"){  echo "ความดันโลหิตสูง";}
			else if($result['prawat']=="2"){  echo "เบาหวาน";}
			else if($result['prawat']=="3"){  echo "โรคหัวใจและหลอดเลือด";}
			else if($result['prawat']=="4"){  echo "ไขมันในเลือดสูง";}
			else if($result['prawat']=="5"){
				if(!empty($result['prawat_ht'])){
					echo "ความดันโลหิตสูง ";
				}
				if(!empty($result['prawat_dm'])){
					echo " เบาหวาน ";
				}
				if(!empty($result['prawat_cad'])){

					echo " โรคหัวใจและหลอดเลือด ";
				}
				if(!empty($result['prawat_dlp'])){
					echo " ไขมันในเลือดสูง";
				}
			}
			echo " ".$result['congenital_disease'];
			 ?>        </td>
        <td colspan="3" valign="top"><strong>รับการรักษาที่ : </strong>
          <? if($result['hospital']==""){ echo ""; }else if(($result['prawat']!="0" || $result['prawat']!="") && $result['hospital']==""){ echo "ไม่ได้ระบุ";}else{ echo $result['hospital'];} ?></td>
        </tr>
    </table>
    <hr style="border:#000000 solid 1px;" />    </td>
  </tr>
  <tr>
    <td align="center" valign="top" width="25%"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td colspan="3" align="center" bgcolor="#999999"><strong>ประเมินความแข็งแรง</strong></td>
        </tr>
      <tr>
        <td width="38%" align="center"><strong>รายการ</strong></td>
        <td width="31%" align="center"><strong>ผล</strong></td>
        <td width="31%" align="center"><strong>สรุป</strong></td>
      </tr>
      <tr>
        <td>BMI</td>
        <td align="center">
          <?=$result['bmi']?>        </td>
        <td><?
        if($result['bmi'] > 0 && $result['bmi'] < 18.5){
			echo "ผอม";
		}else  if($result['bmi'] >=18.5 && $result['bmi'] <=23.4){
			echo "สมส่วน";
		}else  if($result['bmi'] >=23.5 && $result['bmi'] <=28.4){
			echo "น้ำหนักเกิน";
		}else  if($result['bmi'] >=28.5 && $result['bmi'] <=34.9){
			echo "ค่อนข้างอ้วน";
		}else  if($result['bmi'] >=35.0 && $result['bmi'] <=39.9){
			echo "อ้วนมาก";
		}else  if($result['bmi'] >=40.0){
			echo "โรคอ้วน";
		}else{
			echo "ไม่ได้ตรวจ";
		}
		?></td>
      </tr>
      <tr>
        <td>%Fat</td>
        <td align="center">
          <?=$result['fat']." %";?>        </td>
        <td>
          <?
        if($result['result_fat']==1){
			echo "ผอม";
		}else  if($result['result_fat']==2){
			echo "ค่อนข้างผอม";
		}else  if($result['result_fat']==3){
			echo "สมส่วน";
		}else  if($result['result_fat']==4){
			echo "ค่อนข้างอ้วน";
		}else  if($result['result_fat']==5){
			echo "อ้วน";
		}else{
			echo "ไม่ได้ตรวจ";
		}
		?>        </td>
      </tr>
      <tr>
        <td>Fat Mass</td>
        <td align="center"><?=$result['fat_mass'];?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Muscle Mass</td>
        <td align="center"><?=$result['muscle_mass'];?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>แรงบีบมือ</td>
        <td align="center">
          <?=$result['hand2']." กก./นน.";?>        </td>
        <td>
          <?
        if($result['result_hand']==1){
			echo "ต่ำ";
		}else  if($result['result_hand']==2){
			echo "ค่อนข้างต่ำ";
		}else  if($result['result_hand']==3){
			echo "พอใช้";
		}else  if($result['result_hand']==4){
			echo "ดี";
		}else  if($result['result_hand']==5){
			echo "ดีมาก";
		}else{
			echo "ไม่ได้ตรวจ";
		}
		?>        </td>
      </tr>
      <tr>
        <td>แรงเหยียดขา</td>
        <td align="center">
          <?=$result['leg2']." กก./นน.";?>        </td>
        <td>
          <?
        if($result['result_leg']==1){
			echo "ต่ำ";
		}else  if($result['result_leg']==2){
			echo "ค่อนข้างต่ำ";
		}else  if($result['result_leg']==3){
			echo "พอใช้";
		}else  if($result['result_leg']==4){
			echo "ดี";
		}else  if($result['result_leg']==5){
			echo "ดีมาก";
		}else{
			echo "ไม่ได้ตรวจ";
		}
		?>        </td>
      </tr>
      
      <tr>
        <td>3 Minute Test</td>
        <td align="center">
          <?=$result['steptest3']." ครั้ง/นาที";?>        </td>
        <td>
          <?
        if($result['result_steptest']==1){
			echo "ต่ำ";
		}else  if($result['result_steptest']==2){
			echo "ค่อนข้างต่ำ";
		}else  if($result['result_steptest']==3){
			echo "พอใช้";
		}else  if($result['result_steptest']==4){
			echo "ดี";
		}else  if($result['result_steptest']==5){
			echo "ดีมาก";
		}else{
			echo "ไม่ได้ตรวจ";
		}
		?>        </td>
      </tr>
    </table>
    <div align="center" style="margin: 20px 20px 20px 20px;">
    <img src="doctor.jpg" width="148" height="139" border="0" />    </div>    </td>
    <td align="center" valign="top" width="29%"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td colspan="3" align="center" bgcolor="#999999"><strong>ประเมินสุขภาพ</strong></td>
      </tr>
      <tr>
        <td width="39%" align="center"><strong>รายการ</strong></td>
        <td width="28%" align="center"><strong>ผล</strong></td>
        <td width="33%" align="center"><strong>สรุป</strong></td>
      </tr>
      <tr>
        <td>ความดันโลหิต</td>
        <td align="center">
          <? if(empty($result['bp2'])){ echo $result['bp1'];}else{ echo $result['bp2'];} ?>&nbsp;mmHg.        </td>
        <td align="left">
		<? 
		if(empty($result['bp2'])){
			$bp1=substr($result['bp1'],0,3);
			if($bp1 >=140){
				echo "ผิดปกติ";
			}else{
				echo "ปกติ";
			}
		}else{
			$bp2=substr($result['bp2'],0,3);
			if($bp2 >=140){
				echo "ผิดปกติ";
			}else{
				echo "ปกติ";
			}
		}
		?></td>
      </tr>
      <tr>
        <td>ปัสสาวะ</td>
        <td align="center">-</td>
        <td align="left"><?=$result['ua_lab']?></td>
      </tr>
      <tr>
        <td>เม็ดเลือด</td>
        <td align="center">-</td>
        <td align="left"><?=$result['cbc_lab']?></td>
      </tr>
<? if($result['age'] >=35){?>      
      <tr>
        <td>น้ำตาล</td>
        <td align="center"><?=$result['glu_result']?></td>
        <td align="left"><?=$result['glu_lab']?></td>
      </tr>
      <tr>
        <td>ยูริก</td>
        <td align="center"><?=$result['uric_result']?></td>
        <td align="left"><?=$result['uric_lab']?></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#CCCCCC">ไขมัน</td>
        </tr>
      <tr>
        <td>&nbsp;CHOL</td>
        <td align="center"><?=$result['chol_result']?></td>
        <td align="left"><?=$result['chol_lab']?></td>
      </tr>
      <tr>
        <td>&nbsp;TRIG</td>
        <td align="center"><?=$result['trig_result']?></td>
        <td align="left"><?=$result['trig_lab']?></td>
      </tr>
      <tr>
        <td>&nbsp;HDL</td>
        <td align="center"><?=$result['hdl_result']?></td>
        <td align="left"><? if(!empty($result['hdl_lab'])){ echo $result['hdl_lab'];}else{ echo "ไม่ได้ตรวจ";}?></td>
      </tr>
      <tr>
        <td> &nbsp;LDL</td>
        <td align="center"><?=$result['ldl_result']?></td>
        <td align="left"><? if(!empty($result['ldl_lab'])){ echo $result['ldl_lab'];}else{ echo "ไม่ได้ตรวจ";}?></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#CCCCCC">ไต</td>
        </tr>
      <tr>
        <td>&nbsp;BUN</td>
        <td align="center"><?=$result['bun_result']?></td>
        <td align="left"><?=$result['bun_lab']?></td>
      </tr>
      <tr>
        <td>&nbsp;CREA</td>
        <td align="center"><?=$result['crea_result']?></td>
        <td align="left"><?=$result['crea_lab']?></td>
      </tr>
      <tr>
        <td colspan="3" bgcolor="#CCCCCC">ตับ</td>
        </tr>
      <tr>
        <td>&nbsp;ALP</td>
        <td align="center"><?=$result['alp_result']?></td>
        <td align="left"><?=$result['alp_lab']?></td>
      </tr>
      <tr>
        <td>&nbsp;ALT</td>
        <td align="center"><?=$result['alt_result']?></td>
        <td align="left"><?=$result['alt_lab']?></td>
      </tr>
      <tr>
        <td>&nbsp;AST</td>
        <td align="center"><?=$result['ast_result']?></td>
        <td align="left"><?=$result['ast_lab']?></td>
      </tr>
      <? }  //ปิดเช็คอายุ ?>
    </table></td>
    <td align="center" valign="top" width="32%"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td colspan="3" align="center" bgcolor="#999999"><strong>ประเมินพฤติกรรม/ภาวะเสี่ยง</strong></td>
      </tr>
      <tr>
        <td width="40%" align="center"><strong>รายการ</strong></td>
        <td width="29%" align="center"><strong>ผล</strong></td>
        <td width="31%" align="center"><strong>สรุป</strong></td>
      </tr>
      <tr>
        <td>โรคประจำตัว</td>
        <td><? if($result['prawat']=="0"){ echo "ไม่มี";}else{ echo "มี";} ?></td>
        <td><? if($result['prawat']=="0"){ echo "ปกติ";}else{ echo "เป็นโรค";} ?></td>
      </tr>
      <tr>
        <td>แพ้ยา</td>
        <td><? if($result['drugreact']==0){ echo "ไม่แพ้";}else if($result['drugreact']==1){ echo "แพ้";}else{ echo "ไม่ทราบ";} ?></td>
        <td><? if($result['drugreact']==0){ echo "ไม่เสี่ยง";}else if($result['drugreact']==1){ echo "เสี่ยง";}else{ echo "ไม่ทราบ";} ?></td>
      </tr>
      <tr>
        <td>ออกกำลังกาย</td>
        <td><? if($result['exercise']=="0"){ echo "ไม่เคย";}else if($result['exercise']=="1"){ echo "ต่ำกว่าเกณฑ์";}else if($result['exercise']=="2"){ echo "ตามเกณฑ์";}?></td>
        <td><? if($result['exercise']=="0"){ echo "เสี่ยง";}else if($result['exercise']=="1"){ echo "เสี่ยง";}else if($result['exercise']=="2"){ echo "ไม่เสี่ยง";}?></td>
      </tr>
      <tr>
        <td>อาชีวอนามัย</td>
        <td><? if(!empty($result['health_risk'])){ echo $result['health_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['health_risk']=="มี"){ echo "เสี่ยง";}else if($result['health_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>อุบัติเหตุ/จราจร</td>
        <td><? if(!empty($result['accident_risk'])){ echo $result['accident_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['accident_risk']=="มี"){ echo "เสี่ยง";}else if($result['accident_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>ยาเสพติด/อบายมุข</td>
        <td><? if(!empty($result['addictive_risk'])){ echo $result['addictive_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['addictive_risk']=="มี"){ echo "เสี่ยง";}else if($result['addictive_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>สุขภาพจิต</td>
        <td><? echo $result['score_stress']; ?></td>
        <td><? echo $result['result_stress']; ?></td>
      </tr>
      <tr>
        <td>เบาหวาน</td>
        <td><? if(!empty($result['diabetes_risk'])){ echo $result['diabetes_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['diabetes_risk']=="มี"){ echo "เสี่ยง";}else if($result['diabetes_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>ไต</td>
        <td><? if(!empty($result['kidney_risk'])){ echo $result['kidney_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['kidney_risk']=="มี"){ echo "เสี่ยง";}else if($result['kidney_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>วัณโรค</td>
        <td><? if(!empty($result['tb_risk'])){ echo $result['tb_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['tb_risk']=="มี"){ echo "เสี่ยง";}else if($result['tb_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>หัวใจ</td>
        <td><? if(!empty($result['heart_risk'])){ echo $result['heart_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['heart_risk']=="มี"){ echo "เสี่ยง";}else if($result['heart_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>มะเร็ง</td>
        <td><? if(!empty($result['cancer_risk'])){ echo $result['cancer_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['cancer_risk']=="มี"){ echo "เสี่ยง";}else if($result['cancer_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>HIV</td>
        <td><? if(!empty($result['hiv_risk'])){ echo $result['hiv_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['hiv_risk']=="มี"){ echo "เสี่ยง";}else if($result['hiv_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>ตับ</td>
        <td><? if(!empty($result['liver_risk'])){ echo $result['liver_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['liver_risk']=="มี"){ echo "เสี่ยง";}else if($result['liver_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>หลอดเลือดสมอง</td>
        <td><? if(!empty($result['stroke_risk'])){ echo $result['stroke_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['stroke_risk']=="มี"){ echo "เสี่ยง";}else if($result['stroke_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>เก๊าท์</td>
        <td><? if(!empty($result['gout_risk'])){ echo $result['gout_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['gout_risk']=="มี"){ echo "เสี่ยง";}else if($result['gout_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>ข้อเข่าเสื่อม</td>
        <td><? if(!empty($result['knee_risk'])){ echo $result['knee_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['knee_risk']=="มี"){ echo "เสี่ยง";}else if($result['knee_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
      <tr>
        <td>กระดูกทับเส้น</td>
        <td><? if(!empty($result['bone_risk'])){ echo $result['bone_risk'];}else{ echo "&nbsp;";} ?></td>
        <td><? if($result['bone_risk']=="มี"){ echo "เสี่ยง";}else if($result['bone_risk']=="ไม่มี"){ echo "ไม่เสี่ยง";}else{ echo "&nbsp;";} ?></td>
      </tr>
    </table></td>
    <td valign="top" width="14%"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999"><strong>สุขภาพช่องปาก</strong></td>
        </tr>
      <tr>
        <td><div style="margin-left:5px; margin-bottom:20px;"><input name="checkbox3" type="checkbox" id="checkbox3" <?php if($result["result_dental"]=="ปกติ"){ echo "checked"; } ?> >
ปกติ<br>
<input type="checkbox" name="checkbox3" id="checkbox4" <?php  if($result["result_dental"]=="ผิดปกติ"){ echo "checked"; } ?> >
ผิดปกติ...ควรพบทันตแพทย์<br>
<div style="margin-left:15px;"><input name="" type="checkbox" value="" <?php if($result["dental_disease1"]==1){ echo "checked"; } ?> >
ฟันผุ</div>
<div style="margin-left:15px;"><input name="" type="checkbox" value="" <?php if($result["dental_disease2"]==1){ echo "checked"; } ?> >
  ฟันสึก</div>
<div style="margin-left:15px;"><input name="" type="checkbox" value="" <?php if($result["dental_disease3"]==1){ echo "checked"; } ?> >
  โรคปริทันต์อักเสบ</div>
<div style="margin-left:15px;"><input name="" type="checkbox" value="" <?php if($result["gum_disease1"]==1){ echo "checked"; } ?> >
  โรคเหงือกอักเสบ</div>
<div style="margin-left:15px;"><input name="" type="checkbox" value="" <?php if($result["gum_disease2"]==1){ echo "checked"; } ?> >
  ฟันคุด</div>
  </div>
  </td>
        </tr>
    </table>
      <br>
      <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
        <tr>
          <td bgcolor="#999999"><strong>ผล X-Ray</strong></td>
        </tr>
        <tr>
          <td><div style="margin-left:5px; margin-bottom:20px;"><input name="checkbox" type="checkbox" id="checkbox" <?php if($result["xray"]=="ปกติ"){ echo "checked"; } ?> >
            ปกติ<br>
            <input name="checkbox" type="checkbox" id="checkbox" <?php if($result["xray"]=="ผิดปกติ"){ echo "checked"; } ?> >
            ผิดปกติเล็กน้อย<br>
            <input type="checkbox" name="checkbox2" id="checkbox2" <?php if($result["xray"]=="ผิดปกติควรพบแพทย์"){ echo "checked"; } ?> >
            ผิดปกติ...ควรพบแพทย์
            <? if(!empty($result["xray_detail"])){ ?>
            <div><strong>ความผิดปกติ : </strong><? echo $result["xray_detail"]; ?></div>
			<? } ?>
          </div></td>
        </tr>
      </table>      </td>
  </tr>
  <tr style="line-height:3px;">
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">สรุปผล</td>
      </tr>
      <tr>
        <td height="80" valign="top">
        <div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
		<?
        if($result['bmi'] > 0 && $result['bmi'] < 18.5){
			echo "- ผอม<br>";
		}else  if($result['bmi'] >=18.5 && $result['bmi'] <=23.4){
			echo "- สมส่วน<br>";
		}else  if($result['bmi'] >=23.5 && $result['bmi'] <=28.4){
			echo "- น้ำหนักเกิน<br>";
		}else  if($result['bmi'] >=28.5 && $result['bmi'] <=34.9){
			echo "- ค่อนข้างอ้วน<br>";
		}else  if($result['bmi'] >=35.0 && $result['bmi'] <=39.9){
			echo "- อ้วนมาก<br>";
		}else  if($result['bmi'] >=40.0){
			echo "- โรคอ้วน<br>";
		}else{
			echo "&nbsp;";
		}

		if($result["gender"]=="1"){
			if($result["waist"] >=35.4){
				echo "- เส้นรอบเอวเกินมาตรฐาน<br>";
			}
		}else if($result["gender"]=="2"){
			if($result["waist"] >=31.5){
				echo "- เส้นรอบเอวเกินมาตรฐาน<br>";
			}		
		}

        if($result['result_fat']==4 || $result['result_fat']==5){
			echo "- ระดับปริมาณไขมันเกินเกณฑ์<br>";
		}

        if($result['result_hand']==1 || $result['result_leg']==1){
			echo "- กล้ามเนื้อไม่แข็งแรง<br>";
		}else  if($result['result_hand']==2 || $result['result_leg']==2){
			echo "- กล้ามเนื้อไม่ค่อยแข็งแรง<br>";
		}else  if($result['result_hand']==3 || $result['result_leg']==3){
			echo "- กล้ามเนื้อแข็งแรงระดับปานกลาง<br>";
		}else  if($result['result_hand']==4 || $result['result_leg']==4){
			echo "- กล้ามเนื้อแข็งแรงดี<br>";
		}else  if($result['result_hand']==5 || $result['result_leg']==5){
			echo "- กล้ามเนื้อแข็งแรงดีมาก<br>";
		}

        if($result['result_steptest']==1 || $result['result_steptest']==2 || $result['result_steptest']==3){
			echo "- ระบบไหลเวียนเลือดต่ำ<br>";
		}
		?>        
        </div></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">สรุปผล</td>
      </tr>
      <tr>
        <td height="80" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
        <?
		if(empty($result['bp2'])){
			$bp1=substr($result['bp1'],0,3);
			if($bp1 >=140 && $result['prawat']!="1"){
				echo "- ความดันโลหิตสูง<br>";
			}
		}else{
			$bp2=substr($result['bp2'],0,3);
			if($bp2 >=140 && $result['prawat']!="1"){
				echo "- ความดันโลหิตสูง<br>";
			}
		}
		
		if($result['bp1'] < 140 || ($result['bp2'] > 0 && $result['bp2'] < 140)){
			if($result['age'] < 35){  //อายุน้อยกว่า 35
				if($result['prawat']=="0" && $result['ua_lab']=="ปกติ" && $result['cbc_lab']=="ปกติ"){
					echo "- สุขภาพแข็งแรง<br>";
				}
			}else{  //อายุมากกว่า 35 
				if($result['prawat']=="0"  && $result['ua_lab']=="ปกติ" && $result['cbc_lab']=="ปกติ" && $result['glu_lab']=="ปกติ" && $result['chol_lab']=="ปกติ" && $result['trig_lab']=="ปกติ" && $result['hdl_lab']=="ปกติ" && $result['ldl_lab']=="ปกติ" && $result['bun_lab']=="ปกติ" && $result['crea_lab']=="ปกติ" && $result['uric_lab']=="ปกติ" && $result['alp_lab']=="ปกติ" && $result['alt_lab']=="ปกติ" && $result['ast_lab']=="ปกติ"){
					echo "- สุขภาพแข็งแรงสมบูรณ์<br>";
				}
			}
		}
				
        if($result['ua_lab']=="ผิดปกติ"){
			echo "- ผลปัสสาวะพบความผิดปกติ<br>";
		}
		
		if($result['cbc_lab']=="ผิดปกติ"){
			echo "- ผลตรวจเม็ดเลือดพบความผิดปกติ<br>";
		}

        if($result['glu_flag']=="H"){
			echo "- น้ำตาลในเลือดสูง<br>";
		}else if($result['glu_flag']=="L"){
			echo "- น้ำตาลในเลือดต่ำ<br>";
		}
		?>
        <?
        if($result['chol_flag']=="H" || $result['trig_flag']=="H" || $result['hdl_flag']=="H" || $result['ldl_flag']=="H"){
			echo "- ไขมันในเลือดสูง<br>";
        }else if($result['chol_flag']=="L" || $result['trig_flag']=="L" || $result['hdl_flag']=="L" || $result['ldl_flag']=="L"){
			echo "- ไขมันในเลือดต่ำ<br>";
		}
		?>        
        <?
        if($result['bun_lab']=="ผิดปกติ" || $result['crea_lab']=="ผิดปกติ"){
			echo "- การทำงานของไตผิดปกติ<br>";
		}
		?> 
        <?
        if($result['alp_lab']=="ผิดปกติ" || $result['alt_lab']=="ผิดปกติ" || $result['ast_lab']=="ผิดปกติ"){
			echo "- การทำงานของตับผิดปกติ<br>";
		}
		?>      
        <?
        if($result['uric_flag']=="H"){
			echo "- กรดยูริกในเลือดสูง<br>";
		}else if($result['uric_flag']=="L"){
			echo "- กรดยูริกในเลือดต่ำ<br>";
		}
		?>        
        
        </div></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">สรุปผล</td>
      </tr>
      <tr>
        <td height="80" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
          <?
		   	if($result['prawat']=="0" || $result['prawat']==""){
				echo "- ไม่มีโรคประจำตัว<br>";
			}else{
				echo "- มีโรคประจำตัว<br>";
			}
			
			if($result['exercise']=="0" || $result['exercise']=="1"){
				echo "- ออกกำลังกายต่ำกว่าเกณฑ์<br>";
			}
			?>
        </div></td>
      </tr>
    </table></td>
    <td rowspan="3" valign="top"><div align="center" style="margin: 20px 20px 20px 20px;"> <img src="doctor1.jpg" width="148" height="139" border="0" /> </div></td>
  </tr>
  <tr style="line-height:3px;">
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">คำแนะนำ/กิจกรรม</td>
      </tr>
      <tr>
        <td height="65" valign="top">
        <div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
        <?
        if($result['bmi'] > 0 && $result['bmi'] < 18.5){  //ผอม
			echo "- เพิ่มการบริโภคอาหารระหว่างมื้อ<br>";
		}
				
		if($result['result_hand']==1 || $result['result_leg']==1 || $result['result_steptest']==1){
			echo "- Fitness และ Exercise";
		}else  if($result['result_hand']==2 || $result['result_leg']==2 || $result['result_steptest']==2){
			echo "- Fitness และ Exercise";
		}else  if($result['result_hand']==3 || $result['result_leg']==3 || $result['result_steptest']==3){
			echo "- Fitness และ Exercise";
		}else{
			echo "&nbsp;";
		}
		?>                
        </div></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">คำแนะนำ/กิจกรรม</td>
      </tr>
      <tr>
        <td height="65" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
        <?		
        if($result["glu_lab"]=="ผิดปกติ" || $result["chol_lab"]=="ผิดปกติ" || $result["trig_lab"]=="ผิดปกติ" || $result["hdl_lab"]=="ผิดปกติ" || $result["ldl_lab"]=="ผิดปกติ" || $result["bun_lab"]=="ผิดปกติ" || $result["crea_lab"]=="ผิดปกติ"){
			echo "- จัดการด้านโภชนาการ<br>";
		}else if($result["uric_lab"]=="ผิดปกติ"){  //ไต
			echo "- จัดการด้านโภชนาการ<br>";
		}
		
		if(($result['alcohol']=="2" || $result['alcohol']=="3") && ($result["alp_lab"]=="ผิดปกติ" || $result["alt_lab"]=="ผิดปกติ" || $result["ast_lab"]=="ผิดปกติ")){  //2=ดื่มเป็นครั้งคราว, 3=ดื่มเป็นประจำ
			echo "- ปรับการรับประทานอาหาร หรือ การดื่มเครื่องดื่มแอลกอฮอล์<br>";
		}else if(($result['alcohol']=="0" || $result['alcohol']=="1") && ($result["alp_lab"]=="ผิดปกติ" || $result["alt_lab"]=="ผิดปกติ" || $result["ast_lab"]=="ผิดปกติ")){
			 if($result["glu_lab"]=="ผิดปกติ" || $result["chol_lab"]=="ผิดปกติ" || $result["trig_lab"]=="ผิดปกติ" || $result["hdl_lab"]=="ผิดปกติ" || $result["ldl_lab"]=="ผิดปกติ" || $result["bun_lab"]=="ผิดปกติ" || $result["crea_lab"]=="ผิดปกติ" || $result["uric_lab"]=="ผิดปกติ"){
				echo "";
			}else{
				echo "- จัดการด้านโภชนาการ<br>";
			}
		}	
			
		?>
        </div></td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="style3">คำแนะนำ/กิจกรรม</td>
      </tr>
      <tr>
        <td height="65" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig">
          <?
		   	if($result['prawat']!="0"){
				echo "- รักษาโรคอย่างต่อเนื่อง<br>";
			}
		
			if($result['exercise']=="0" || $result['exercise']=="1"){
				echo "- ปรับพฤติกรรมสุขภาพ และการออกกำลังกาย<br>";
			}	
		?>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr style="line-height:3px;">
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top"><table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td bgcolor="#999999" class="fontbig3">สรุป กิจกรรมที่พึงทำเพื่อสุขภาพ</td>
      </tr>
      <tr>
        <td height="130" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig3">
        <?
        if($result['bmi'] > 0 && $result['bmi'] < 18.5){  //ผอม
			echo "- ควรเพิ่มการบริโภคอาหารระหว่างมื้อ<br>";
		}	
		
        if($result['result_hand']==1 || $result['result_leg']==1 || $result['result_steptest']==1){
			echo "- ควรออกกำลังกายอย่างสม่ำเสมอ เพื่อเสริมสร้างสมรรถภาพ<br>";
		}else  if($result['result_hand']==2 || $result['result_leg']==2 || $result['result_steptest']==2){
			echo "- ควรออกกำลังกายอย่างสม่ำเสมอ เพื่อเสริมสร้างสมรรถภาพ<br>";
		}else  if($result['result_hand']==3 || $result['result_leg']==3 || $result['result_steptest']==3){
			echo "- ควรออกกำลังกายอย่างสม่ำเสมอ เพื่อเสริมสร้างสมรรถภาพ<br>";
		}else{
			if($result['bmi'] >=28.5){
				if($result['exercise']=="0" || $result['exercise']=="1"){
					echo "- ควรออกกำลังกายอย่างสม่ำเสมอ<br>";
				}			
			}
		}
		
        if($result["glu_lab"]=="ผิดปกติ" || $result["chol_lab"]=="ผิดปกติ" || $result["trig_lab"]=="ผิดปกติ" || $result["hdl_lab"]=="ผิดปกติ" || $result["ldl_lab"]=="ผิดปกติ" || $result["bun_lab"]=="ผิดปกติ" || $result["crea_lab"]=="ผิดปกติ"){
			echo "- ควรปรับการรับประทานอาหาร ลดหวาน มัน เค็ม เพิ่มผักในมื้ออาหาร<br>";
		}
		
		if($result["uric_lab"]=="ผิดปกติ"){
			echo "- ควรปรับการรับประทานอาหาร งดสัตว์ปีก เครื่องในสัตว์ ยอดผักต่างๆ<br>";
		}
		
		if(($result['alcohol']=="2" || $result['alcohol']=="3") && ($result["alp_lab"]=="ผิดปกติ" || $result["alt_lab"]=="ผิดปกติ" || $result["ast_lab"]=="ผิดปกติ")){  //2=ดื่มเป็นครั้งคราว, 3=ดื่มเป็นประจำ
			echo "- ควรปรับการรับประทานอาหาร หรือ การดื่มเครื่องดื่มแอลกอฮอล์<br>";
		}else if(($result['alcohol']=="0" || $result['alcohol']=="1") && ($result["alp_lab"]=="ผิดปกติ" || $result["alt_lab"]=="ผิดปกติ" || $result["ast_lab"]=="ผิดปกติ")){
			echo "- ควรรับประทานอาหารที่มีไขมันต่ำ เพิ่มอาหาร เช่น ข้าวกล้อง ข้าวซ้อมมือ และผักผลไม้<br>";
		}	
				
        if($result["result_dental"]=="ผิดปกติ" && $result["hn"]!="58-8936"){
			echo "- ควรเข้ารับการตรวจทางทันตกรรม<br>";
		}
        if($result["xray"]=="ผิดปกติควรพบแพทย์"){
			echo "- ควรพบแพทย์เพื่อทำการรักษา หรือ X-Ray ซ้ำอีกครั้ง<br>";
		}
        if($result["prawat"]!="0" && $result["prawat"]!="6"){
			if($result["diagtype"]=="control"){
				echo "- รักษาโรคตามแผนการรักษาของแพทย์ (Control)<br>";
			}else if($result["diagtype"]=="uncontrol"){
				echo "- รักษาโรคตามแผนการรักษาของแพทย์อย่างต่อเนื่อง (Un Control)<br>";
			}else if($result["diagtype"]=="newcase"){
				echo "- ควรพบแพทย์เพื่อทำการรักษาโรค (New Case)<br>";
			}
		}else if($result["prawat"]=="6"){
			echo "- ควรรักษาโรคประจำตัวอย่างต่อเนื่อง";
		}			
		?>
        </div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top" height="5"><hr style="border:#000000 solid 1px;"/></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top" class="fontbig3"><div style="border-bottom:3px double; width:150px;"><strong>สรุปผลการตรวจสุขภาพ</strong></div></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top"><div style="margin-left:5px; margin-bottom:10px;" class="fontbig3">
      <input name="resultdiagnormal" type="checkbox" id="resultdiagnormal" <?php if($result["resultdiag_normal"]==1){ echo "checked"; } ?>  />
       <? if($result['prawat']=="5"){ 
	   			if($result['prawat_ht']=="1" && $result['prawat_dm']=="1" && $result['prawat_dlp']=="1" && $result['prawat_cad']=="1"){ 
					echo "ปกติ";
				}else{
					echo "ปกติ ไม่พบความเสี่ยงต่อโรค NCDs";
				}
			}else{ 
				echo "ปกติ ไม่พบความเสี่ยงต่อโรค NCDs";
			}
		?>
       &nbsp;&nbsp;&nbsp;
      <input name='resultdiagrisk' type='checkbox' value='1' id="resultdiagrisk" <?php if($result["resultdiag_risk"]==1){ echo "checked"; } ?> />
      มีความเสี่ยงภาวะสุขภาพ &nbsp;&nbsp;&nbsp;
      <input name='resultdiagdiseases' type='checkbox' value='1' id="resultdiagdiseases" <?php if($result["resultdiag_diseases"]==1){ echo "checked"; } ?> />
      ป่วยด้วยโรคเรื้อรัง...
  <?
        if($result['prawat']=="1"){
			echo "ความดันโลหิตสูง";
		}else if($result['prawat']=="2"){
			echo "เบาหวาน";
		}else if($result['prawat']=="3"){
			echo "โรคหัวใจและหลอดเลือด";
		}else if($result['prawat']=="4"){
			echo "ไขมันในเลือดสูง";
		}else if($result['prawat']=="5"){
			if(!empty($result['prawat_ht'])){
				echo "ความดันโลหิตสูง ";
			}
			if(!empty($result['prawat_dm'])){
				echo " เบาหวาน ";
			}
			if(!empty($result['prawat_cad'])){
				echo " โรคหัวใจและหลอดเลือด ";
			}
			if(!empty($result['prawat_dlp'])){
				echo " ไขมันในเลือดสูง";
			}									
		}
		?>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <?
    if($result['typediag']=="newcase"){
	?>
  <input name='followup' type='checkbox' value='1' id="followup" checked="checked"/>
      พบประวัติการป่วยด้วยโรคเรื้อรัง ให้มาพบแพทย์เพื่อทำการรักษา
  <?
	}
	?>
    </div></td>
  </tr>
</table>
<?
	 	echo "<div style='page-break-after : always; position: fixed; top:0; left:0;'>&nbsp;</div>";
	}  //close while	
}  //close if show
?>

