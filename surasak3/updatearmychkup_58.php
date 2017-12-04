<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.forminput {
	font-family: TH SarabunPSK;
	font-size: 20px;	
}
.profilehead {	font-family: "TH Sarabun New";
	font-size: 18px;
	color: #00F;
	font-weight: bold;
}
.profilevalue {	font-family: "TH Sarabun New";
	font-size: 18px;
}
.tb_font_1 {font-family:"TH Sarabun New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
.fgn {	font-family: "TH Sarabun New";
	font-size: 18px;
	color: #00F;
	font-weight: bold;
}
.labfont {	font-family:"TH Sarabun New";
	font-size: 18px;
}
.profilelab {	font-family: "TH Sarabun New";
	font-size: 18px;
	color: #000;
	font-weight: bold;
}
.tb_font {font-family:"TH Sarabun New"; font-size:24px;}
.tb_font_2 {	font-family:"TH Sarabun New";
	color: #333;
	font-weight: bold;
	font-size: 18px;
}
.labfontlab {	font-family:"TH Sarabun New";
	font-size: 18px;
	font-weight:bold;
	color:#FFFFFF;
}
.style1 {color: #FFFFFF}
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 20px;
}
-->
</style>
<?
if($_POST["act"]=="add"){
include("connect.inc");
	$thidate=date("Y-m-d H:i:s");
	$date=date("Y-m-d");
	$thdatehn=$date.$_POST["hn"];
	
	$add="insert into condxofyear_so set thidate='$thidate',
															    thdatehn='$thdatehn',
															    hn='$_POST[hn]',
															    ptname='$_POST[ptname]',
															    age='$_POST[age]',
															    camp='$_POST[camp]',
																height='$_POST[height]',
																weight='$_POST[weight]',
																round_='$_POST[round_]',
																temperature='$_POST[temperature]',
																pause='$_POST[pause]',
																rate='$_POST[rate]',
																bmi='$bmi',
																bp1='$_POST[bp1]',
																bp2='$_POST[bp2]',
																drugreact='$_POST[drugreact]',
																prawat='$_POST[prawat]',
																congenital_disease='$_POST[congenital_disease]',
																type='$_POST[type]',
																organ='$_POST[organ]',
																doctor='$_POST[doctor]',
																clinic='$_POST[clinic]',
																cigarette='$_POST[cigarette]',
																alcohol='$_POST[alcohol]',
																exercise='$_POST[exercise]',
																stat_pressure='$_POST[stat_pressure]',
																reason_pressure='$_POST[reason_pressure]',
																stat_bmi='$_POST[stat_bmi]',
																reason_bmi ='$_POST[reason_bmi]',																
																ua_color='$_POST[color]',
																ua_appear='$_POST[appear]',
																ua_spgr='$_POST[spgr]',
																ua_phu='$_POST[phu]',
																ua_bloodu='$_POST[bloodu]',
																ua_prou='$_POST[prou]',
																ua_gluu='$_POST[gluu]',
																ua_ketu='$_POST[ketu]',
																ua_urobil='$_POST[urobil]',
																ua_bili='$_POST[bili]',
																ua_nitrit='$_POST[nitrit]',
																ua_wbcu='$_POST[wbcu]',
																ua_rbcu='$_POST[rbcu]',
																ua_epiu='$_POST[epiu]',
																ua_bactu='$_POST[bactu]',
																ua_yeast='$_POST[yeast]',
																ua_mucosu='$_POST[mucosu]',
																ua_amopu='$_POST[amopu]',
																ua_castu='$_POST[castu]',
																ua_crystu='$_POST[crystu]',
																ua_otheru='$_POST[otheru]',
																stat_ua='$_POST[stat_ua]',
																reason_ua='$_POST[reason_ua]',
																cbc_wbc='$_POST[wbc]',
																stat_wbc='$_POST[stat_wbc]',
																reason_wbc='$_POST[reason_wbc]',
																wbcrange='$_POST[wbcrange]',
																cbc_rbc='$_POST[rbc]',
																cbc_hb='$_POST[hb]',
																cbc_hct='$_POST[hct]',
																stat_hct='$_POST[stat_hct]',
																reason_hct='$_POST[reason_hct]',																
																hctrange='$_POST[hctrange]',
																cbc_mcv='$_POST[mcv]',
																cbc_mch='$_POST[mch]',
																cbc_mchc='$_POST[mchc]',
																cbc_pltc='$_POST[pltc]',
																stat_pltc='$_POST[stat_pltc]',
																reason_pltc='$_POST[reason_pltc]',																		
																pltcrange='$_POST[pltcrange]',
																cbc_plts='$_POST[plts]',
																cbc_neu='$_POST[neu]',
																cbc_lymp='$_POST[lymp]',
																cbc_mono='$_POST[mono]',
																cbc_eos='$_POST[eos]',
																cbc_baso='$_POST[baso]',
																cbc_band='$_POST[band]',
																cbc_atyp='$_POST[atyp]',
																cbc_nrbc='$_POST[nrbc]',
																cbc_rbcmor='$_POST[rbcmor]',
																cbc_other='$_POST[other]',
																cxr='$_POST[cxr]',
																reason_cxr='$_POST[reason_cxr]',
																bs='$_POST[bs]',
																stat_bs='$_POST[stat_bs]',
																reason_bs='$_POST[reason_bs]',	
																bsrange='$_POST[bsrange]',
																bun='$_POST[bun]',
																stat_bun='$_POST[stat_bun]',
																reason_bun='$_POST[reason_bun]',																	
																bunrange='$_POST[bunrange]',
																cr='$_POST[cr]',
																stat_cr='$_POST[stat_cr]',
																reason_cr='$_POST[reason_cr]',																	
																crrange='$_POST[crrange]',
																uric='$_POST[uric]',
																stat_uric='$_POST[stat_uric]',
																reason_uric='$_POST[reason_uric]',																	
																uricrange='$_POST[uricrange]',
																chol='$_POST[chol]',
																stat_chol='$_POST[stat_chol]',
																reason_chol='$_POST[reason_chol]',																	
																cholrange='$_POST[cholrange]',
																tg='$_POST[tg]',
																stat_tg='$_POST[stat_tg]',
																reason_tg='$_POST[reason_tg]',																	
																tgrange='$_POST[tgrange]',
																sgot='$_POST[sgot]',
																stat_sgot='$_POST[stat_sgot]',
																reason_sgot='$_POST[reason_sgot]',																	
																sgotrange='$_POST[sgotrange]',
																sgpt='$_POST[sgpt]',
																stat_sgpt='$_POST[stat_sgpt]',
																reason_sgpt='$_POST[reason_sgpt]',																	
																sgptrange='$_POST[sgptrange]',
																alk='$_POST[alk]',
																stat_alk='$_POST[stat_alk]',
																reason_alk='$_POST[reason_alk]',																		
																alkrange='$_POST[alkrange]',																			
																anemia='$_POST[anemia]',	
																cirrhosis='$_POST[cirrhosis]',	
																hepatitis='$_POST[hepatitis]',	
																cardiomegaly='$_POST[cardiomegaly]',	
																allergy='$_POST[allergy]',	
																gout='$_POST[gout]',	
																waistline='$_POST[waistline]',	
																asthma='$_POST[asthma]',	
																muscle='$_POST[muscle]',	
																ihd='$_POST[ihd]',	
																thyroid='$_POST[thyroid]',	
																heart='$_POST[heart]',	
																emphysema='$_POST[emphysema]',	
																herniated='$_POST[herniated]',	
																conjunctivitis='$_POST[conjunctivitis]',	
																cystitis='$_POST[cystitis]',	
																epilepsy='$_POST[epilepsy]',	
																fracture='$_POST[fracture]',	
																cardiac='$_POST[cardiac]',	
																spine='$_POST[spine]',	
																dermatitis='$_POST[dermatitis]',	
																degeneration='$_POST[degeneration]',	
																alcoholic='$_POST[alcoholic]',	
																copd='$_POST[copd]',	
																bph='$_POST[bph]',	
																kidney='$_POST[kidney]',	
																pterygium='$_POST[pterygium]',	
																tonsil='$_POST[tonsil]',	
																paralysis='$_POST[paralysis]',	
																blood='$_POST[blood]',	
																conanemia='$_POST[conanemia]',	
																ht='$_POST[ht]',
																sol1='$_POST[sol1]',	
																sol2='$_POST[sol2]',	
																sol3='$_POST[sol3]',	
																sum1='$_POST[sum1]',	
																sum2='$_POST[sum2]',	
																rs_sum21='$_POST[rs_sum21]',
																rs_sum22='$_POST[rs_sum22]',
																rs_sum23='$_POST[rs_sum23]',
																rs_sum24='$_POST[rs_sum24]',
																rs_sum25='$_POST[rs_sum25]',
																sum3='$_POST[sum3]',	
																sum4='$_POST[sum4]',	
																sum5='$_POST[sum5]',	
																rs_sum51='$_POST[rs_sum51]',	
																rs_sum52='$_POST[rs_sum52]',	
																rs_sum53='$_POST[rs_sum53]',	
																dx='$_POST[dx]',																
																camp1='$_POST[camp]',
																chunyot1='$_POST[chunyot]',															  																yearcheck='$_POST[yearcheck]',
																keymanual='$_POST[keymanual]'";
		//echo $add;
		if(mysql_query($add)){
			echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location='addarmychkup_58.php?thdatehn=$thdatehn&hn=$_POST[hn]&year=$_POST[yearchk]';</script>";
		}else{
			echo "<script>alert('!!! ผิดพลาดบันทึกข้อมูลไม่สำเร็จ');window.location='addarmychkup_58.php?thdatehn=$thdatehn&hn=$_POST[hn]&year=$_POST[year]'';</script>";
		}	

}
?>
<a href ="../nindex.htm" >&lt;&lt; กลับหน้าหลัก</a> || <a href ="addarmychkup_58.php" >&lt;&lt; ไปหน้าก่อนนี้</a>
<p align="center"><strong>วิเคราะห์ผลการตรวจสุขภาพทหารที่ไปรับการตรวจจากโรงพยาบาลอื่น</strong></p>
<?
include("connect.inc");
$sql = "Select * From  `dxofyear` where thdatehn='$_GET[thdatehn]' AND yearchk = '$_GET[year]' AND hn='$_GET[hn]' order by row_id DESC limit 0,1";
//echo $sql;
$result = mysql_query($sql);
$arr_dxofyear = mysql_fetch_array($result);
$bmi=$arr_dxofyear["bmi"];
?>
<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<form name="dxdrform" method="post" action="updatearmychkup_58.php">
<input name="act" type="hidden" value="add">
<input name="age" type="hidden" id="age"  value="<?php echo $arr_dxofyear["age"];?>" />
<input name="yearcheck" type="hidden" id="yearcheck" value="2558">
<input name="year" type="hidden" id="year" value="58">
<input name="keymanual" type="hidden" value="y">
<input name="prawat" type="hidden" id="prawat" value="<?php echo $arr_dxofyear["prawat"];?>">
<input type="hidden" name="type" id="type" value="<?php echo $arr_dxofyear["type"];?>">
<br />
<p align="center" class="head_font1"><strong>บันทึกผลการตรวจสุขภาพทหาร</strong></p>
<table  width="100%" border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
  <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
      <td align="left" bgcolor="#0099CC" class="tb_font_1" colspan="12">&nbsp;&nbsp;&nbsp;ข้อมูลผู้ตรวจสุขภาพ</td>
    </tr>
    <tr>
      <td align="left" class="profilehead"><strong>HN </strong></td>
      <td align="left" class="profile">:</td>
      <td class="profileheadvalue">&nbsp;<?php echo $arr_dxofyear["hn"];?>
          <input name="hn" type="hidden" id="hn"  value="<?php echo $arr_dxofyear["hn"];?>" /></td>
      <td width="91" rowspan="2" align="left" valign="bottom" class="profilehead"><strong>ชื่อ-สกุล </strong></td>
      <td width="10" rowspan="2" align="left" valign="bottom" class="profile">:</td>
      <td width="217" rowspan="2" valign="bottom" class="profileheadvalue">&nbsp;<?php echo $arr_dxofyear["ptname"];?>
        <input name="ptname" type="hidden" id="ptname"  value="<?php echo $arr_dxofyear["ptname"];?>" /></td>
      <td width="145" rowspan="2" align="left" valign="bottom" class="profilehead"><strong>สังกัด </strong></td>
      <td width="10" rowspan="2" align="left" valign="bottom" class="profile">:</td>
      <td width="211" rowspan="2" valign="bottom" class="profileheadvalue">&nbsp;<?php echo $arr_dxofyear["camp"];?>
        <input name="camp" type="hidden" id="camp"  value="<?php echo $arr_dxofyear["camp"];?>" /></td>
      <input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_dxofyear["ptname"];?>"/>
      <td width="89" rowspan="2" align="left" valign="bottom" class="profilehead"><strong>อายุ</strong></td>
      <td width="9" rowspan="2" align="left" valign="bottom" class="profile">:</td>
      <td width="216" rowspan="2" valign="bottom" class="profileheadvalue">&nbsp;<?php echo $arr_dxofyear["age"];?>
        <input name="age" type="hidden" id="age"  value="<?php echo $arr_dxofyear["age"];?>" /></td>
    </tr>
    <tr>
      <td align="left" class="profilehead"><strong>ชั้นยศ</strong></td>
      <td align="left" class="profile">&nbsp;</td>
      <td class="profileheadvalue"><select name="chunyot" class="forminput" id="chunyot">
        <option value="CH01 นายทหารชั้นสัญญาบัตร">นายทหารชั้นสัญญาบัตร</option>
        <option value="CH02 นายทหารชั้นประทวน" selected="selected">นายทหารชั้นประทวน</option>
        <option value="CH04 ลูกจ้างประจำ" >ลูกจ้างประจำ</option>
      </select></td>
    </tr>
    <tr>
      <td align="left" class="profilehead"><strong>ส่วนสูง </strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["height"]; ?><input name="height" type="hidden" id="height"  value="<?php echo $arr_dxofyear["height"];?>" /> ซม.</td>
      <td align="left" class="profilehead"><strong>น้ำหนัก</strong></td>
      <td align="left" class="profile">:</td>
      <td align="left" class="profilevalue">&nbsp;<?php echo $arr_dxofyear["weight"];?> <input name="weight" type="hidden" id="weight"  value="<?php echo $arr_dxofyear["weight"];?>" />
        กก. </td>
      <td align="left" class="profilehead"><strong>รอบเอว </strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["round_"]; ?> <input name="round_" type="hidden" id="round_"  value="<?php echo $arr_dxofyear["round_"];?>" />
        ซม.</td>
      <td align="left" class="profilehead"><strong>BMI</strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><span style="color:#F00">&nbsp;<?php echo $arr_dxofyear["bmi"]; ?>
        <input name="bmi" type="hidden" id="bmi"  value="<?php echo $arr_dxofyear["bmi"];?>" />
      </span></td>
    </tr>
    <tr>
      <td align="left" class="profilehead"><strong>T </strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["temperature"]; ?> <input name="temperature" type="hidden" id="temperature"  value="<?php echo $arr_dxofyear["temperature"];?>" />
        C&deg;</td>
      <td align="left" class="profilehead"><strong>P </strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["pause"]; ?> <input name="pause" type="hidden" id="pause"  value="<?php echo $arr_dxofyear["pause"];?>" /> ครั้ง/นาที</td>
      <td align="left" class="profilehead"><strong>R </strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["rate"]; ?> <input name="rate" type="hidden" id="rate"  value="<?php echo $arr_dxofyear["rate"];?>" /> ครั้ง/นาที</td>
      <td align="left" class="profilehead"><strong>BP </strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["bp1"]; ?> / <?php echo $arr_dxofyear["bp2"]; ?>
        <input name="bp1" type="hidden" id="bp1"  value="<?php echo $arr_dxofyear["bp1"];?>" />
        <input name="bp2" type="hidden" id="bp2"  value="<?php echo $arr_dxofyear["bp2"];?>" /> mmHg</td>
    </tr>
    <tr>
      <td align="left" class="profilehead"><strong>บุหรี่ </strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<? if($arr_dxofyear['cigarette']=="0"){ echo "ไม่เคยสูบบุหรี่";}else if($arr_dxofyear['cigarette']=="1"){ echo "เคยสูบ แต่เลิกแล้ว";}else if($arr_dxofyear['cigarette']=="2"){ echo "สูบบุหรี่ เป็นครั้งคราว";}else if($arr_dxofyear['cigarette']=="3"){ echo "สูบบุหรี่ เป็นประจำ";} ?> <input name="cigarette" type="hidden" id="cigarette"  value="<?php echo $arr_dxofyear["cigarette"];?>" /></td>
      <td align="left" class="profilehead"><strong>สุรา</strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<? if($arr_dxofyear['alcohol']=="0"){ echo "ไม่เคยดื่ม";}else if($arr_dxofyear['alcohol']=="1"){ echo "เคยดื่ม แต่เลิกแล้ว";}else if($arr_dxofyear['alcohol']=="2"){ echo "ดื่ม เป็นครั้งคราว";}else if($arr_dxofyear['alcohol']=="3"){ echo "ดื่ม เป็นประจำ";} ?> <input name="alcohol" type="hidden" id="alcohol"  value="<?php echo $arr_dxofyear["alcohol"];?>" /></td>
      <td align="left" class="profilehead"><strong>ออกกำลังกาย</strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"> &nbsp;
        <? if($arr_dxofyear['exercise']=="0"){ echo "ไม่เคยออกกำลังกาย";} else if($arr_dxofyear['exercise']=="1"){ echo "ออกกำลังกาย ต่ำกว่าเกณฑ์";} else{ echo "ออกกำลังกาย ตามเกณฑ์";} ?> <input name="exercise" type="hidden" id="exercise"  value="<?php echo $arr_dxofyear["exercise"];?>" /></td>
      <td align="left" class="profilehead"><strong>แพ้ยา</strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;
          <? if($arr_dxofyear['drugreact']=="0"){ echo "ไม่แพ้ยา";}else{ echo "<span style='color:#F00'>".$arr_dxofyear['drugreact']."</span>";} ?> <input name="drugreact" type="hidden" id="drugreact"  value="<?php echo $arr_dxofyear["drugreact"];?>" /></td>
    </tr>
    <tr>
      <td align="left" class="profilehead"><strong>โรคประจำตัว</strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["congenital_disease"];?> <input name="congenital_disease" type="hidden" id="congenital_disease"  value="<?php echo $arr_dxofyear["congenital_disease"];?>" /></td>
      <td align="left" class="profilehead"><strong>อาการ </strong></td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear['organ'];?> <input name="organ" type="hidden" id="organ"  value="<?php echo $arr_dxofyear["organ"];?>" /></td>
      <td align="left" class="profilehead"><strong>แพทย์ </strong></td>
      <td align="left" class="profile">:</td>
      <td colspan="4" class="profilevalue">&nbsp;
          <?php 
		echo $arr_dxofyear["doctor"];
		?>
          <input name="doctor" type="hidden" id="doctor"  value="<?php echo $arr_dxofyear["doctor"];?>" />
          <input name="clinic" type="hidden" id="clinic"  value="<?php echo $arr_dxofyear["clinic"];?>" /></td>
      </tr>
    <tr bgcolor="#CCCCFF">
      <td bgcolor="#FFCC99" class="profile"  style="color:#000"><strong>ค่าความดัน</strong></td>
	    <td bgcolor="#FFCC99"><span class="profile">:</span></td>
	    <td bgcolor="#FFCC99" class="profilevalue"><input name='stat_pressure' type='radio' value='ปกติ' onclick="togglediv2('acnormal55')" <?  if($arr_dxofyear["bp1"] < 129 && $arr_dxofyear["bp2"] < 89){ echo "checked";}?>/>
ปกติ
<input name='stat_pressure' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal55')"  <?  if(($arr_dxofyear["bp1"] >= 130 && $arr_dxofyear["bp2"] >= 90) || ($arr_dxofyear["bp1"] >= 129 && $arr_dxofyear["bp2"] <= 89) || ($arr_dxofyear["bp1"] <= 129 && $arr_dxofyear["bp2"] >= 89)){ echo "checked";}?>/>
	      <?  
		  if(($arr_dxofyear["bp1"] >= 130 && $arr_dxofyear["bp2"] >= 90) || ($arr_dxofyear["bp1"] >= 129 && $arr_dxofyear["bp2"] <= 89) || ($arr_dxofyear["bp1"] <= 129 && $arr_dxofyear["bp2"] >= 89)){
		  	echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
		  }else{
		  	echo "ผิดปกติ";
		  }
		  ?>        </td>
	    <td colspan="9" bgcolor="#FFCC99" class="profilevalue"><input name="reason_pressure" type="text" class="forminput" size="50"></td>
	    </tr>
    <tr bgcolor="#FFCC99">
      <td class="profile"  style="color:#000"><strong>ค่า BMI</strong></td>
      <td><span class="profile">:</span></td>
      <td class="profilevalue"><input name='stat_bmi' type='radio' value='ปกติ' id="stat_bmi"  <?  if($bmi >= 18.5 && $bmi <= 22.99){ echo "checked";}?>/>
        ปกติ
        <input name='stat_bmi' type='radio' value='ผิดปกติ' id="stat_bmi"  <?  if($bmi < 18.5 || $bmi > 22.99){ echo "checked";}?>/>
	      <?  
		  if($bmi < 18.5 || $bmi > 22.99){
		  	echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
		  }else{
		  	echo "ผิดปกติ";
		  }
		  ?>      </td>
      <td colspan="9" bgcolor="#FFCC99" class="profilevalue">
      <div id="acnormal56" <? if($bmi >= 18.5 && $bmi <= 22.99){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <label>
        <input name="reason_bmi" type="text" class="forminput" id="reason_bmi" size="50">
        </label>
</div></td>
      </tr>
  </table></td></tr>
</table>
<BR>
<TABLE border="2" cellpadding="2" cellspacing="0" bordercolor="#000000"  width="100%">
  <TR>
    <TD><TABLE border="0" cellpadding="0" cellspacing="0"  width="100%" bgcolor="#FFFFCC">
      <TR>
        <TD align="left" class="tb_font_1" bgcolor="#339999">&nbsp;&nbsp;&nbsp;ผลการตรวจทางพยาธิ</TD>
      </TR>
      <TR class="tb_font">
        <TD ><strong>&nbsp;&nbsp; UA :</strong>
              <table width="100%" border="0">
                <tr>
                  <td width="8%" align="right" class="profilelab">Color:</td>
                  <td width="10%" class="fgn" ><strong>
                    <?=$arr_dxofyear['ua_color']?>
                    <input type="hidden" name="color" id="color" value="<?=$arr_dxofyear['ua_color']?>">
                  </strong></td>
                  <td width="10%" align="right" class="profilelab">SP.Gr:</td>
                  <td width="9%" class="fgn"><strong>
                    <?=$arr_dxofyear['ua_spgr']?>
                    <input type="hidden" name="spgr" id="spgr" value="<?=$arr_dxofyear['ua_spgr']?>">
                  </strong></td>
                  <td width="13%"  align="right" class="profilelab">PH:</td>
                  <td width="10%" class="fgn" ><strong>
                    <?=$arr_dxofyear['ua_phu']?>
                    <input type="hidden" name="phu" id="phu" value="<?=$arr_dxofyear['ua_phu']?>">
                  </strong></td>
                  <td width="10%"  align="right" class="profilelab">Blood:</td>
                  <td width="11%" class="fgn"  ><strong>
                    <?=$arr_dxofyear['ua_bloodu']?>
                    <input type="hidden" name="bloodu" id="bloodu" value="<?=$arr_dxofyear['ua_bloodu']?>">
                  </strong></td>
                  <td width="10%" align="right" class="profilelab">Protien:</td>
                  <td width="9%" class="fgn"><strong>
                    <?=$arr_dxofyear['ua_prou']?>
                    <input type="hidden" name="prou" id="prou" value="<?=$arr_dxofyear['ua_prou']?>">
                  </strong></td>
                </tr>
                <tr>
                  <td align="right" class="profilelab">Sugar:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_gluu']?>
                    <input type="hidden" name="gluu" id="gluu" value="<?=$arr_dxofyear['ua_gluu']?>">
                  </strong></td>
                  <td align="right" class="profilelab">Ketone:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_ketu']?>
                    <input type="hidden" name="ketu" id="ketu" value="<?=$arr_dxofyear['ua_ketu']?>">
                  </strong></td>
                  <td align="right" class="profilelab">Urobillinogen:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_urobil']?>
                    <input type="hidden" name="urobil" id="urobil" value="<?=$arr_dxofyear['ua_urobil']?>">
                  </strong></td>
                  <td align="right" class="profilelab">Billirubin</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_bili']?>
                    <input type="hidden" name="bili" id="bili" value="<?=$arr_dxofyear['ua_bili']?>">
                  </strong></td>
                  <td align="right" class="profilelab">Nitrite</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_nitrit']?>
                    <input type="hidden" name="nitrit" id="nitrit" value="<?=$arr_dxofyear['ua_nitrit']?>">
                  </strong></td>
                </tr>
                <tr>
                  <td align="right" class="profilelab">Crystal:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_crystu']?>
                    <input type="hidden" name="crystu" id="crystu" value="<?=$arr_dxofyear['ua_crystu']?>">
                  </strong></td>
                  <td align="right" class="profilelab">Casts:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_castu']?>
                    <input type="hidden" name="castu" id="castu" value="<?=$arr_dxofyear['ua_castu']?>">
                  </strong></td>
                  <td align="right" class="profilelab">Epithelial:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_epiu']?>
                    <input type="hidden" name="epiu" id="epiu" value="<?=$arr_dxofyear['ua_epiu']?>">
                  </strong></td>
                  <td align="right" class="profilelab">WBC:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_wbcu']?>
                    <input type="hidden" name="wbcu" id="wbcu" value="<?=$arr_dxofyear['ua_wbcu']?>">
                  </strong></td>
                  <td align="right" class="profilelab">RBC:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_rbcu']?>
                    <input type="hidden" name="rbcu" id="rbcu" value="<?=$arr_dxofyear['ua_rbcu']?>">
                  </strong></td>
                </tr>
                <tr>
                  <td align="right" class="profilelab">Amorphous:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_amopu']?>
                    <input type="hidden" name="amopu" id="amopu" value="<?=$arr_dxofyear['ua_amopu']?>">
                  </strong></td>
                  <td align="right" class="profilelab">Bacteria:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_bactu']?>
                    <input type="hidden" name="bactu" id="bactu" value="<?=$arr_dxofyear['ua_bactu']?>">
                  </strong></td>
                  <td align="right" class="profilelab">Mucus:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_mucosu']?>
                    <input type="hidden" name="mucosu" id="mucosu" value="<?=$arr_dxofyear['ua_mucosu']?>">
                  </strong></td>
                  <td align="right" class="profilelab">Yeast:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_yeast']?>
                    <input type="hidden" name="yeast" id="yeast" value="<?=$arr_dxofyear['ua_yeast']?>">
                  </strong></td>
                  <td align="right" class="profilelab">Appear:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_appear']?>
                    <input type="hidden" name="appear" id="appear" value="<?=$arr_dxofyear['ua_appear']?>">
                  </strong></td>
                </tr>
                <tr>
                  <td align="right" class="profilelab">Otheru:</td>
                  <td class="fgn"><strong>
                    <?=$arr_dxofyear['ua_otheru']?>
                    <input type="hidden" name="otheru" id="otheru" value="<?=$arr_dxofyear['ua_otheru']?>">
                  </strong></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
                <tr bgcolor="#CCCCFF">
                  <td colspan="4" align="center" bgcolor="#FFCC99"><strong>ผลการตรวจ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                      <input name='stat_ua' type='radio' value='ปกติ' onclick="togglediv2('acnormal')" id="normal98" />
                    ปกติ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name='stat_ua' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal')" id="normal99" />
                    ผิดปกติ </td>
                  <td colspan="6" bgcolor="#FFCC99">
                  <input name="reason_ua" type="text" class="forminput" id="reason_ua" size="50"></td>
                </tr>
                <?
	/*if($i%5==0) echo "<tr></tr>";
	$i++;*/
	
			//}
			?>
              </table>
          <hr />
          <strong>&nbsp;&nbsp; CBC :</strong>
          <table width="100%" border="0">
            <?php
	  //$i=1;
	  /*$lab_cbcvalue = array();
	  $lab_cbcrange = array();
	  $lab_cbcflag = array();
	  if(mysql_num_rows($result_cbc)>0){
	  	while(list($labname,$labresult, $unit,$normalrange,$flag) = mysql_fetch_row($result_cbc)){
		array_push($lab_cbcvalue,$labresult);
		array_push($lab_cbcrange,$normalrange);
		array_push($lab_cbcflag,$flag);
		/*		if($labname == "OTHER" || $labname == "PLTS"){
			$size="13";
		}else{
			$size="6";
		}
		}*/

		/*if(!empty($arr_dxofyear[$list_cbc[$labname]]))
			$labresult = $arr_dxofyear[$list_cbc[$labname]];*/
	  ?>
            <tr>
              <td width="10%"  align="right" class="profilelab">WBC :</td>
              <td width="8%" class="fgn" ><strong>
                <?=$arr_dxofyear['cbc_wbc']?>
                <input type="hidden" name="wbc" id="wbc" value="<?=$arr_dxofyear['cbc_wbc']?>">
              </strong></td>
              <td width="9%"  align="right" class="profilelab">HCT : </td>
              <td width="10%" class="fgn" ><strong>
                <?=$arr_dxofyear['cbc_hct']?>
                <input type="hidden" name="hct" id="hct" value="<?=$arr_dxofyear['cbc_hct']?>">
              </strong></td>
              <td width="10%"  align="right" class="profilelab">NEU :</td>
              <td width="8%" class="fgn" ><strong>
                <?=$arr_dxofyear['cbc_neu']?>
                <input type="hidden" name="neu" id="neu" value="<?=$arr_dxofyear['cbc_neu']?>">
              </strong></td>
              <td width="12%"  align="right" class="profilelab">LYMP : </td>
              <td width="10%" class="fgn" ><strong>
                <?=$arr_dxofyear['cbc_lymp']?>
                <input type="hidden" name="lymp" id="lymp" value="<?=$arr_dxofyear['cbc_lymp']?>">
              </strong></td>
              <td width="10%"  align="right" class="profilelab">MONO : </td>
              <td width="13%" class="fgn" ><strong>
                <?=$arr_dxofyear['cbc_mono']?>
                <input type="hidden" name="mono" id="mono" value="<?=$arr_dxofyear['cbc_mono']?>">
              </strong></td>
            </tr>
            <tr>
              <td align="right" class="profilelab">EOS : </td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_eos']?>
                <input type="hidden" name="eos" id="eos" value="<?=$arr_dxofyear['cbc_eos']?>">
              </strong></td>
              <td align="right" class="profilelab">MCV :</td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_mcv']?>
                <input type="hidden" name="mcv" id="mcv" value="<?=$arr_dxofyear['cbc_mcv']?>">
              </strong></td>
              <td align="right" class="profilelab">MCH :</td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_mch']?>
                <input type="hidden" name="mch" id="mch" value="<?=$arr_dxofyear['cbc_mch']?>">
              </strong></td>
              <td align="right" class="profilelab">MCHC : </td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_mchc']?>
                <input type="hidden" name="mchc" id="mchc" value="<?=$arr_dxofyear['cbc_mchc']?>">
              </strong></td>
              <td align="right" class="profilelab">PLTS :</td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_plts']?>
                <input type="hidden" name="plts" id="plts" value="<?=$arr_dxofyear['cbc_plts']?>">
              </strong></td>
            </tr>
            <tr>
              <td align="right" class="profilelab">OTHER : </td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_other']?>
                <input type="hidden" name="other" id="other" value="<?=$arr_dxofyear['cbc_other']?>">
              </strong></td>
              <td align="right" class="profilelab">NRBC : </td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_nrbc']?>
                <input type="hidden" name="nrbc" id="nrbc" value="<?=$arr_dxofyear['cbc_nrbc']?>">
              </strong></td>
              <td align="right" class="profilelab">RBC :</td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_rbc']?>
                <input type="hidden" name="rbc" id="rbc" value="<?=$arr_dxofyear['cbc_rbc']?>">
              </strong></td>
              <td align="right" class="profilelab">RBCMOR : </td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_rbcmor']?>
                <input type="hidden" name="rbcmor" id="rbcmor" value="<?=$arr_dxofyear['cbc_rbcmor']?>">
              </strong></td>
              <td align="right" class="profilelab">HB :</td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_hb']?>
                <input type="hidden" name="hb" id="hb" value="<?=$arr_dxofyear['cbc_hb']?>">
              </strong></td>
            </tr>
            <tr>
              <td align="right" class="profilelab">BASO :</td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_baso']?>
                <input type="hidden" name="baso" id="baso" value="<?=$arr_dxofyear['cbc_baso']?>">
              </strong></td>
              <td align="right" class="profilelab">ATYP :</td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_atyp']?>
                <input type="hidden" name="atyp" id="atyp" value="<?=$arr_dxofyear['cbc_atyp']?>">
              </strong></td>
              <td align="right" class="profilelab">BAND :</td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_band']?>
                <input type="hidden" name="band" id="band" value="<?=$arr_dxofyear['cbc_band']?>">
              </strong></td>
              <td align="right" class="profilelab">PLTC : </td>
              <td class="fgn"><strong>
                <?=$arr_dxofyear['cbc_pltc']?>
                <input type="hidden" name="pltc" id="pltc" value="<?=$arr_dxofyear['cbc_pltc']?>">
              </strong></td>
              <td align="right" class="tb_font_2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="10"></td>
            </tr>
            <?
	//  }
		  ?>
          </table>
          <table border="0" width="100%">
            <tr>
              <td align="right" class="profilelab" width="80">HCT : </td>
              <td width="44" class="fgn"><? 
			if($arr_dxofyear['cbc_hct'] < 37){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[cbc_hct]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[cbc_hct]</span>";
			}
			?>              </td>
              <td class="labfont"  width="101">(
                    <?=$arr_dxofyear['hctrange']?>
                )<strong>
                <input type="hidden" name="hctrange" id="hctrange" value="<?=$arr_dxofyear['hctrange']?>">
                </strong></td>
              <td width="32" align="center" class="labfont" ><span <? if($arr_dxofyear['hctflag']!="N") echo " style='color:#F00'";?>>
                <?=$arr_dxofyear['hctflag']?>
              </span></td>
              <td width="202" class="labfont"><input name='stat_hct' type='radio' value='ปกติ' onclick="togglediv2('acnormal31')" <? if($arr_dxofyear['cbc_hct'] >= 37) echo "checked";?> />
                ปกติ
                <input name='stat_hct' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal31')" <? if($arr_dxofyear['cbc_hct'] < 37) echo "checked";?>/>
                    <? 
			  if($arr_dxofyear['cbc_hct'] < 37){
			  	echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			  }else{
			  	echo "ผิดปกติ";
			  }
			  ?>              </td>
              <td width="877"><label>
                <input name="reason_hct" type="text" class="forminput" id="reason_hct" size="50">
              </label></td>
            </tr>
            <tr>
              <td align="right" class="profilelab" width="80">WBC : </td>
              <td width="44" class="fgn"><? 
			if($arr_dxofyear['cbc_wbc'] < 3 || $arr_dxofyear['cbc_wbc'] > 15){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[cbc_wbc]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[cbc_wbc]</span>";
			}
			?>              </td>
              <td class="labfont" width="101">(
                    <?=$arr_dxofyear['wbcrange']?>
                )<strong>
                <input type="hidden" name="wbcrange" id="wbcrange" value="<?=$arr_dxofyear['wbcrange']?>">
                </strong></td>
              <td align="center" class="labfont" width="32" ><span <? if($arr_dxofyear['wbcflag']!="N"){ echo " style='color:#F00'";}?>>
                <?=$arr_dxofyear['wbcflag'];?>
              </span></td>
              <td width="202" class="labfont"><input name='stat_wbc' type='radio' value='ปกติ' onclick="togglediv2('acnormal32')" <? if($arr_dxofyear['cbc_wbc'] >= 3 &&  $arr_dxofyear['cbc_wbc'] <= 15){ echo "checked";}?>/>
                ปกติ
                <input name='stat_wbc' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal32')" <? if($arr_dxofyear['cbc_wbc'] < 3 || $arr_dxofyear['cbc_wbc'] > 15){ echo "checked";}?>/>
                    <? 
			  if($arr_dxofyear['cbc_wbc'] < 3 || $arr_dxofyear['cbc_wbc'] > 15){
			  	echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			  }else{
			  	echo "ผิดปกติ";
			  }
			  ?>              </td>
              <td><label>
                <input name="reason_wbc" type="text" class="forminput" id="reason_wbc" size="50">
              </label></td>
            </tr>
            <tr>
              <td align="right" class="profilelab" width="80">PLTC : </td>
              <td width="44" class="fgn"><? 
			if($arr_dxofyear['cbc_pltc'] < 120 || $arr_dxofyear['cbc_pltc'] > 500){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[cbc_pltc]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[cbc_pltc]</span>";
			}
			?>              </td>
              <td class="labfont" width="101">(
                    <?=$arr_dxofyear['pltcrange']?>
                )<strong>
                <input type="hidden" name="pltcrange" id="pltcrange" value="<?=$arr_dxofyear['pltcrange']?>">
                </strong></td>
              <td align="center" class="labfont" width="32"><span <? if($arr_dxofyear['pltcflag']!="N"){ echo " style='color:#F00'";}?>>
                <?=$arr_dxofyear['pltcflag']?>
              </span></td>
              <td width="202" class="labfont"><input name='stat_pltc' type='radio' value='ปกติ' onclick="togglediv2('acnormal33')" <? if($arr_dxofyear['cbc_pltc'] >= 120 &&  $arr_dxofyear['cbc_pltc'] <= 500){ echo "checked";}?>/>
                ปกติ
                <input name='stat_pltc' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal33')" <? if($arr_dxofyear['cbc_pltc'] < 120 || $arr_dxofyear['cbc_pltc'] > 500){ echo "checked";}?>/>
                    <? 
			  if($arr_dxofyear['cbc_pltc'] < 120 || $arr_dxofyear['cbc_pltc'] > 500){
			  	echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			  }else{
			  	echo "ผิดปกติ";
			  }
			  ?>              </td>
              <td><input name="reason_pltc" type="text" class="forminput" id="reason_pltc" size="50"></td>
            </tr>
            <tr bgcolor="#CCCCFF">
              <td colspan="5" align="center" bgcolor="#FFCC99"><strong>ผลการตรวจ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                    <input name='stat_cbc' type='radio' value='ปกติ' onclick="togglediv2('acnormal81')" id="normal97" />
                ปกติ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name='stat_cbc' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal81')" id="normal96" />
                ผิดปกติ </td>
              <td bgcolor="#FFCC99"><div id="acnormal81" style='display: none;'>
                <select name='ch81'>
                  <option value='ควรพบแพทย์เพื่อหาสาเหตุ'>ควรพบแพทย์เพื่อหาสาเหตุ</option>
                </select>
              </div>
                <input name="reason_cbc" type="text" class="forminput" id="reason_cbc" size="50"></td>
            </tr>
          </table></TD>
      </TR>
    </TABLE></TD>
  </TR>
</TABLE>
<br>
<table border="2" cellpadding="2" cellspacing="0" bordercolor="#000000"  width="100%" bgcolor="#FFCCCC">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="10%" align="right" class="tb_font_2">&nbsp;</td>
        <td width="6%" align="center" bgcolor="#339999" class="profilelab"><strong>
          <?="2558";?>
        </strong></td>
        <td width="10%" class="labfont">&nbsp;</td>
        <td width="16%" class="labfont">&nbsp;</td>
        <td width="58%">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" class="profilelab">GLU :</td>
        <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($arr_dxofyear['bs'] >= 110){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[bs]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[bs]</span>";
			}
			?>        <strong>
          <input type="hidden" name="bs" id="bs" value="<?=$arr_dxofyear['bs']?>">
        </strong></td>
        <td class="labfont">(
              <?=$arr_dxofyear['bsrange']?>
          )<strong>
          <input type="hidden" name="bsrange" id="bsrange" value="<?=$arr_dxofyear['bsrange']?>">
          </strong></td>
        <td class="labfont"><input name='stat_bs' type='radio' value='ปกติ' onclick="togglediv2('acnormal47');" <?  if($arr_dxofyear['bs'] < 110){ echo "checked";}?>/>
          ปกติ
          <input name='stat_bs' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal47');" <? if($arr_dxofyear['bs'] >= 110){ echo "checked";}?>/>
              <? 
			if($arr_dxofyear['bs'] >= 110){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
        <td><label>
          <input name="reason_bs" type="text" class="forminput" id="reason_bs" size="50">
        </label></td>
      </tr>
      <tr>
        <td align="right" class="profilelab">CHOL :</td>
        <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($arr_dxofyear['chol'] >= 201){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[chol]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[chol]</span>";
			}
			?>        <strong>
          <input type="hidden" name="chol" id="chol" value="<?=$arr_dxofyear['chol']?>">
        </strong></td>
        <td class="labfont">(
              <?=$arr_dxofyear['cholrange']?>
          )<strong>
          <input type="hidden" name="cholrange" id="cholrange" value="<?=$arr_dxofyear['cholrange']?>">
          </strong></td>
        <td class="labfont"><input name='stat_chol' type='radio' value='ปกติ' onclick="togglediv2('acnormal46');" <? if($arr_dxofyear['chol'] < 200){ echo "checked";}?> />
          ปกติ
          <input name='stat_chol' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal46');" <? if($arr_dxofyear['chol'] >= 201){ echo "checked";}?>/>
              <? 
			if($arr_dxofyear['chol'] >= 201){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
        <td><input name="reason_chol" type="text" class="forminput" id="reason_chol" size="50"></td>
      </tr>
      <tr>
        <td align="right" class="profilelab">TRIG :</td>
        <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($arr_dxofyear['tg'] >= 150){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[tg]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[tg]</span>";
			}
			?>        <strong>
          <input type="hidden" name="tg" id="tg" value="<?=$arr_dxofyear['tg']?>">
        </strong></td>
        <td class="labfont">(
              <?=$arr_dxofyear['tgrange']?>
          )<strong>
          <input type="hidden" name="tgrange" id="tgrange" value="<?=$arr_dxofyear['tgrange']?>">
          </strong></td>
        <td class="labfont"><input name='stat_tg' type='radio' value='ปกติ' onclick="togglediv2('acnormal48');" <? if($arr_dxofyear['tg'] < 150){ echo "checked";}?> />
          ปกติ
          <input name='stat_tg' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal48');"  <? if($arr_dxofyear['tg'] >= 150){ echo "checked";}?>/>
              <? 
			if($arr_dxofyear['tg'] >= 150){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
        <td><input name="reason_tg" type="text" class="forminput" id="reason_tg" size="50"></td>
      </tr>
      <tr>
        <td align="right" class="profilelab">BUN :</td>
        <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($arr_dxofyear['bun'] > 20){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[bun]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[bun]</span>";
			}
			?>        <strong>
          <input type="hidden" name="bun" id="bun" value="<?=$arr_dxofyear['bun']?>">
        </strong></td>
        <td class="labfont">(
              <?=$arr_dxofyear['bunrange']?>
          )<strong>
          <input type="hidden" name="bunrange" id="bunrange" value="<?=$arr_dxofyear['bunrange']?>">
          </strong></td>
        <td class="labfont"><input name='stat_bun' type='radio' value='ปกติ' onclick="togglediv2('acnormal44');" <? if($arr_dxofyear['bun'] <= 20){ echo "checked";}?>/>
          ปกติ
          <input name='stat_bun' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal44');" <? if($arr_dxofyear['bun'] > 20){ echo "checked";}?>/>
              <? 
			if($arr_dxofyear['bun'] > 20){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
        <td><input name="reason_bun" type="text" class="forminput" id="reason_bun" size="50"></td>
      </tr>
      <tr>
        <td align="right" class="profilelab">CREA :</td>
        <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($arr_dxofyear['cr'] > 1.5){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[cr]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[cr]</span>";
			}
			?>        <strong>
          <input type="hidden" name="cr" id="cr" value="<?=$arr_dxofyear['cr']?>">
        </strong></td>
        <td class="labfont">(
              <?=$arr_dxofyear['crrange']?>
          )<strong>
          <input type="hidden" name="crrange" id="crrange" value="<?=$arr_dxofyear['crrange']?>">
          </strong></td>
        <td class="labfont"><input name='stat_cr' type='radio' value='ปกติ' onclick="togglediv2('acnormal45');" <? if($arr_dxofyear['cr'] <= 1.5){ echo "checked";}?> />
          ปกติ
          <input name='stat_cr' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal45');" <? if($arr_dxofyear['cr'] > 1.5){ echo "checked";}?>/>
              <? 
			if($arr_dxofyear['cr'] > 1.5){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
        <td><input name="reason_cr" type="text" class="forminput" id="reason_cr" size="50"></td>
      </tr>
      <tr>
        <td align="right" class="profilelab">SGOT (AST) :</td>
        <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($arr_dxofyear['sgot'] < 15 || $arr_dxofyear['sgot'] > 37){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[sgot]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[sgot]</span>";
			}
			?>
          <strong>
          <input type="hidden" name="sgot" id="sgot" value="<?=$arr_dxofyear['sgot']?>">
          </strong></td>
        <td class="labfont">(
          <?=$arr_dxofyear['sgotrange']?>
          )<strong>
            <input type="hidden" name="sgotrange" id="sgotrange" value="<?=$arr_dxofyear['sgotrange']?>">
          </strong></td>
        <td class="labfont"><input name='stat_sgot' type='radio' value='ปกติ' onclick="togglediv2('acnormal43');" <? if($arr_dxofyear['sgot'] >= 15 && $arr_dxofyear['sgot'] <= 37){ echo "checked";}?>/>
          ปกติ
          <input name='stat_sgot' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal43');" <? if($arr_dxofyear['sgot'] < 15 || $arr_dxofyear['sgot'] > 37){ echo "checked";}?>/>
      <? 
			if($arr_dxofyear['sgot'] < 15 || $arr_dxofyear['sgot'] > 37){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>
        </td>
        <td><input name="reason_sgot" type="text" class="forminput" id="reason_alk3" size="50"></td>
      </tr>
      <tr>
        <td align="right" class="profilelab">SGPT (ALT) :</td>
        <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($arr_dxofyear['sgpt'] > 50){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[sgpt]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[sgpt]</span>";
			}
			?>        <strong>
          <input type="hidden" name="sgpt" id="sgpt" value="<?=$arr_dxofyear['sgpt']?>">
        </strong></td>
        <td class="labfont">(
              <?=$arr_dxofyear['sgptrange']?>
          )<strong>
          <input type="hidden" name="sgptrange" id="sgptrange" value="<?=$arr_dxofyear['sgptrange']?>">
          </strong></td>
        <td class="labfont"><input name='stat_sgpt' type='radio' value='ปกติ' onclick="togglediv2('acnormal42');" <? if($arr_dxofyear['sgpt'] <= 50){ echo "checked";}?>/>
          ปกติ
          <input name='stat_sgpt' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal42');" <? if($arr_dxofyear['sgpt'] > 50){ echo "checked";}?>/>
              <? 
			if($arr_dxofyear['sgpt'] > 50){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
        <td><input name="reason_sgpt" type="text" class="forminput" id="reason_sgpt" size="50"></td>
      </tr>
      <tr>
        <td align="right" class="profilelab"> ALK (ALP) : </td>
        <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($arr_dxofyear['alk'] < 46 || $arr_dxofyear['alk'] > 116){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[alk]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[alk]</span>";
			}
			?>
          <strong>
          <input type="hidden" name="alk" id="alk" value="<?=$arr_dxofyear['alk']?>">
          </strong></td>
        <td class="labfont">(
          <?=$arr_dxofyear['alkrange']?>
          )<strong>
            <input type="hidden" name="alkrange" id="alkrange" value="<?=$arr_dxofyear['alkrange']?>">
          </strong></td>
        <td class="labfont"><input name='stat_alk' type='radio' value='ปกติ' onclick="togglediv2('acnormal41');"  <? if($arr_dxofyear['alk'] >= 46 && $arr_dxofyear['alk'] <= 116){ echo "checked";}?>/>
          ปกติ
          <input name='stat_alk' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal41');" <? if($arr_dxofyear['alk'] < 46 || $arr_dxofyear['alk'] > 116){ echo "checked";}?>/>
      <? 
			if($arr_dxofyear['alk'] < 46 || $arr_dxofyear['alk'] > 116){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
        <td><input name="reason_alk" type="text" class="forminput" id="reason_alk" size="50"></td>
      </tr>
      <tr>
        <td align="right" class="profilelab">URIC :</td>
        <td align="center" bgcolor="#FFFFFF" class="profilehead"><? 
			if($arr_dxofyear['uric'] > 7){
				echo "<span style='color:#F00'><strong>$arr_dxofyear[uric]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$arr_dxofyear[uric]</span>";
			}
			?>        <strong>
          <input type="hidden" name="uric" id="uric" value="<?=$arr_dxofyear['uric']?>">
        </strong></td>
        <td class="labfont">(
              <?=$arr_dxofyear['uricrange']?>
          )<strong>
          <input type="hidden" name="uricrange" id="uricrange" value="<?=$arr_dxofyear['uricrange']?>">
          </strong></td>
        <td class="labfont"><input name='stat_uric' type='radio' value='ปกติ' onclick="togglediv2('acnormal49');" <? if($arr_dxofyear['uric'] >= 2.6 && $arr_dxofyear['uric'] <= 7.2){ echo "checked";}?>/>
          ปกติ
          <input name='stat_uric' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal49');"<? if($arr_dxofyear['uric'] < 2.6 || $arr_dxofyear['uric'] > 7.2){ echo "checked";}?>/>
              <? 
			if($arr_dxofyear['uric'] < 2.6 || $arr_dxofyear['uric'] > 7.2){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>        </td>
        <td><input name="reason_uric" type="text" class="forminput" id="reason_uric" size="50"></td>
      </tr>
      <?php 
	/*$i++;
			}*/?>
    </table>
        <hr />
    </TD>
  </TR>
</TABLE>
<br>
<table border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" width="100%">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCCCC">
      <tr>
        <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="5">&nbsp;&nbsp;&nbsp;ป่วยเป็นโรค</td>
      </tr>
      <tr>
        <td width="30%" class="tb_font_2"><span class="labfont">
          <input name='anemia' type='checkbox' value='Y' id="normal"/>
          โลหิตจาง (Anemia)
        </span></td>
        <td width="32%" class="tb_font_2"><span class="labfont">
          <input name='cirrhosis' type='checkbox' value='Y' id="cirrhosis"/>
          ตับแข็ง (Cirrhosis) </span></td>
        <td width="38%" class="tb_font_2"><span class="labfont">
          <input name='hepatitis' type='checkbox' value='Y' id="hepatitis"/>
          โรคตับอักเสบ (Hepatitis) </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='cardiomegaly' type='checkbox' value='Y' id="cardiomegaly"/>
          หัวใจโต </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='allergy' type='checkbox' value='Y' id="allergy"/>
          ภูมิแพ้ </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='gout' type='checkbox' value='Y' id="gout"/>
          โรคเก๊าท์ </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name="waistline" type='checkbox' id="waistline" value='Y'/>
          รอบเอวเกิน (ชาย &gt; 90 ซ.ม. , หญิง &gt; 80 ซ.ม.)</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='asthma' type='checkbox' value='Y' id="asthma"/>
          หอบหืด (Asthma) </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='muscle' type='checkbox' value='Y' id="muscle"/>
          กล้ามเนื้ออักเสบ</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='ihd' type='checkbox' value='Y' id="ihd"/>
          โรคหัวใจขาดเลือดเรื้อรัง (IHD)</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='thyroid' type='checkbox' value='Y' id="thyroid"/>
          ไทรอยด์</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='heart' type='checkbox' value='Y' id="heart"/>
          โรคหัวใจ </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='emphysema' type='checkbox' value='Y' id="emphysema"/>
          ถุงลมโป่งพอง</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='herniated' type='checkbox' value='Y' id="herniated"/>
          หมอนรองกระดูกทับเส้นประสาท</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='conjunctivitis' type='checkbox' value='Y' id="conjunctivitis"/>
          เยื่อบุตาอักเสบ (Conjunctivitis)</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='cystitis' type='checkbox' value='Y' id="cystitis"/>
          กระเพาะปัสสาวะอักเสบ (Cystitis) </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='epilepsy' type='checkbox' value='Y' id="epilepsy"/>
          ลมชัก (Epilepsy) </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='fracture' type='checkbox' value='Y' id="fracture"/>
          กระดูกหักเลื่อน</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='cardiac' type='checkbox' value='Y' id="cardiac"/>
          หัวใจเต้นผิดจังหวะ (Cardiac arrhythmia)</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='spine' type='checkbox' value='Y' id="spine"/>
          กระดูกสันหลัง (อก) คด</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='dermatitis' type='checkbox' value='Y' id="dermatitis"/>
          ผิวหนังอักเสบ</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='degeneration' type='checkbox' value='Y' id="degeneration"/>
          หัวเข่าเสื่อม</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='alcoholic' type='checkbox' value='Y' id="alcoholic"/>
          ความผิดปกติจากแอลกอฮอล์</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='copd' type='checkbox' value='Y' id="copd"/>
          COPD</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='bph' type='checkbox' value='Y' id="bph"/>
          BPH</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='kidney' type='checkbox' value='Y' id="kidney"/>
          ไตผิดปกติ</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='pterygium' type='checkbox' value='Y' id="pterygium"/>
          ต้อเนื้อ</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='tonsil' type='checkbox' value='Y' id="tonsil"/>
          ต่อมทอนซิลโต</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='paralysis' type='checkbox' value='Y' id="paralysis"/>
          อัมพาตซีกซ้าย/ขวา </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='blood' type='checkbox' value='Y' id="blood"/>
          เม็ดเลือดผิดปกติ </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='conanemia' type='checkbox' value='Y' id="conanemia"/>
          ภาวะซีด</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='ht' type='checkbox' value='Y' id="ht"/>
          ความดันโลหิตสูง </span></td>
        <td class="tb_font_2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
<table border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" width="100%">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCCCC">
      <tr>
        <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="5">&nbsp;&nbsp;&nbsp;สรุปผลการตรวจ</td>
      </tr>
      <tr>
        <td width="9%" align="right" class="tb_font_2"><span class="profilelab">ผลเอ็กซเรย์</span></td>
        <td width="25%" class="tb_font_2">
          <input name='cxr' type='radio' value='ปกติ' onclick="togglediv2('acnormal51')" id="normal58"/>
ปกติ
&nbsp;&nbsp;&nbsp;
<input name='cxr' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal51')" id="normal57"/>
ผิดปกติ 
&nbsp;&nbsp;&nbsp;
&nbsp;
<input name='cxr' type='radio' value='ไม่ได้ตรวจ' onclick="togglediv1('acnormal51')" id="normal2"/>
ไม่ได้ตรวจ
        </td>
        <td class="tb_font_2"><input name="reason_cxr" type="text" class="forminput" id="reason_cxr" size="50"  /></td>
      </tr>
      <tr>
        <td colspan="2" class="tb_font_2"><span class="labfont">
          <input name='sum1' type='checkbox' value='ปกติ (ไม่พบความเสี่ยง)' id="sum1"/>
          ปกติ (ไม่พบความเสี่ยง)</span></td>
        <td width="66%" class="labfont">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="left" class="tb_font_2"><span class="labfont">
          <input name='sum2' type='checkbox' value='พบความเสี่ยงเบื้องต้นต่อโรค' id="sum2" <? if($arr_dxofyear['bs'] >= 110 || $result_dx['chol'] > 200 || $result_dx['tg'] >= 150 || $arr_dxofyear['uric'] < 2.6 || $arr_dxofyear['uric'] > 7.2 || $result_dx['sgpt'] > 50 || $result_dx['sgot'] > 40 || $result_dx['alk'] < 46 || $result_dx['alk'] > 123 || $result_dx['bun'] > 20 || $result_dx['cr'] < 0.6 || $result_dx['cr'] > 1.5){ echo "checked='checked'";}?> />
          พบความเสี่ยงมีผลเลือดเกินค่าปกติ</span></td>
        <td class="labfont">
<input name='rs_sum21' type='checkbox' value='น้ำตาล' id="rs_sum21" <? if($arr_dxofyear['bs'] >= 110){ echo "checked='checked'";}?> />
น้ำตาล
<input name='rs_sum22' type='checkbox' value='ไขมัน' id="rs_sum22" <? if($result_dx['chol'] > 200 || $result_dx['tg'] >= 150){ echo "checked='checked'";}?> />
ไขมัน
<input name='rs_sum23' type='checkbox' value='ยูริค' id="rs_sum23" <? if($arr_dxofyear['uric'] < 2.6 || $arr_dxofyear['uric'] > 7.2){ echo "checked='checked'";}?> />
ยูริค
<input name='rs_sum24' type='checkbox' value='ตับ' id="rs_sum24" <? if($result_dx['sgot'] < 15 || $result_dx['sgot'] > 50 || $result_dx['sgpt'] > 50 || $result_dx['alk'] < 46 || $result_dx['alk'] > 123){ echo "checked='checked'";}?>/>
ตับ
<input name='rs_sum25' type='checkbox' id="rs_sum25" value='ไต' <? if($result_dx['bun'] > 20 || $result_dx['cr'] < 0.6 || $result_dx['cr'] > 1.5){ echo "checked='checked'";}?>/> 
ไต        
        </td>
      </tr>
      <tr>
        <td colspan="2" class="tb_font_2"><span class="labfont">
          <input name='sum3' type='checkbox' value='มีภาวะน้ำหนักเกิน' id="sum3" <? if($bmi > 22.99){ echo "checked='checked'";}?>/>
          มีภาวะน้ำหนักเกิน</span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" class="tb_font_2"><span class="labfont">
          <input name='sum4' type='checkbox' id="sum4" value='มีค่าความดันโลหิตเกินค่าปกติ' <? if(($arr_dxofyear["bp1"] >= 130 && $arr_dxofyear["bp2"] >= 90) || ($arr_dxofyear["bp1"] >= 129 && $arr_dxofyear["bp2"] <= 89) || ($arr_dxofyear["bp1"] <= 129 && $arr_dxofyear["bp2"] >= 89)){ echo "checked='checked'";}?>/>
          มีค่าความดันโลหิตเกินค่าปกติ</span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" class="tb_font_2"><span class="labfont">
          <input name='sum5' type='checkbox' value='ป่วยด้วยโรคเรื้อรัง' id="sum5" <? if($arr_dxofyear["prawat"] !=0){ echo "checked='checked'";}?>/>
          ป่วยด้วยโรคเรื้อรัง </span></td>
        <td><span class="labfont">
          <input name='rs_sum51' type='checkbox' id="rs_sum51" value='DM' <? if($arr_dxofyear["prawat"] ==2){ echo "checked='checked'";}?>/>
          DM
          <input name='rs_sum52' type='checkbox' id="rs_sum52" value='HT' <? if($arr_dxofyear["prawat"] ==1){ echo "checked='checked'";}?>/>
          HT
          <input name='rs_sum53' type='checkbox' id="rs_sum53" value='DLP' <? if($arr_dxofyear["prawat"] ==3){ echo "checked='checked'";}?>/>
          DLP </span></td>
      </tr>
      
    </table></td>
  </tr>
</table>
<br>
<table width="100%" border="2" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCCCC">
      <tr>
        <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="3">&nbsp;&nbsp;&nbsp;การดำเนินงาน</td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='sol1' type='checkbox' value='1 แนะนำเรื่องพฤติกรรมสุขภาพเพื่อป้องกันความเสี่ยง' id="sol1"/>
          แนะนำเรื่องพฤติกรรมสุขภาพเพื่อป้องกันความเสี่ยง </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='sol2' type='checkbox' value='2 แนะนำเรื่องการควบคุมอาหาร ลดน้ำหนัก' id="sol2"/>
          แนะนำเรื่องการควบคุมอาหาร ลดน้ำหนัก</span></td>
      </tr>
      <tr>
        <td align="left" class="tb_font_2"><span class="labfont">
          <input name='sol3' type='checkbox' value='3 แนะนำปรับพฤติกรรมการรับประทานอาหารและออกกำลังกายที่เหมาะสมกับวัย และการมาพบแพทย์ตามนัด' id="sol3"/>
          แนะนำปรับพฤติกรรมการรับประทานอาหารและออกกำลังกายที่เหมาะสมกับวัย และการมาพบแพทย์ตามนัด </span></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<TABLE border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" bgcolor="#FFCCCC">
  <TR>
    <TD><TABLE border="0" cellpadding="0" cellspacing="0" >
      <TR>
        <TD align="left" class="tb_font_1" bgcolor="#339999">&nbsp;&nbsp;&nbsp;บันทึกการวินิฉัยจากแพทย์</TD>
      </TR>
      <TR class="tb_font">
        <TD><table height="60" border="0" bordercolor="#FFFFFF" bgcolor="#FFCCCC" class="tb_font">
          <tr>
            <td valign="top"><textarea name="dx" cols="60" rows="8" id="dx"><?php echo $arr_dxofyear["dx"]; ?></textarea>
              &nbsp;&nbsp;</td>
          </tr>
        </table></TD>
      </TR>
    </TABLE></TD>
  </TR>
</TABLE>
<p align="center"><input name="Submit" type="submit" class="forminput" value="บันทึกผลการตรวจ">
</p>
</form>

