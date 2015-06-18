<?php
header('Content-Type: text/html; charset=tis-620');
session_start();
include("connect.inc");
// mysql_query("SET NAMES TIS620");
?>
<style type="text/css">
<!--
.tet {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.tet1 {
	font-family: "TH SarabunPSK";
	font-size: 36px;
}
.text3 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.text {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
.texthead {
	font-family: "TH SarabunPSK";
	font-size: 25px;
}
.text1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.text2 {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.textsub {
	font-size: 15px;
}
-->
</style>
<?
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

if(isset($_POST['hn'])||isset($_GET['hn'])){
	if(isset($_POST['hn'])){ $_GET['hn']=$_POST['hn'];}
	elseif(isset($_GET['hn'])){ $_POST['hn']=$_GET['hn'];}
?>
<script type="text/javascript">
	window.onload = function(){
		window.print();
		
		// 
		// window.onafterprint = function(){
		   // window.location.href='dx_ofyear_emp.php';
		// }
	}
</script>
<?
////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
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
	$nPrefix2="25".$nPrefix;
	
	// var_dump($nPrefix2);
////*runno ตรวจสุขภาพ*/////////

	$select = "select * from opcard where hn = '".$_GET['hn']."' ";
	$row = mysql_query($select);
	$result = mysql_fetch_array($row);
	
	
	$select9 = "select * from condxofyear_emp where hn = '".$_GET['hn']."' and yearcheck ='$nPrefix2' order by row_id desc limit 1";
	$row9 = mysql_query($select9);
	if(mysql_num_rows($row9)>0){
		$result1 = mysql_fetch_array($row9);
	}else{
		$select1 = "select * from dxofyear_emp where hn = '".$_GET['hn']."' and yearchk='$nPrefix' order by row_id desc limit 1";
		$row1 = mysql_query($select1);
		$result1 = mysql_fetch_array($row1);
	}
	
	
	//ปีล่าสุด
	
	$select2 = "select * from chk_hb where hn = '".$_GET['hn']."' AND yearchk = '$nPrefix2' ";
	$row2 = mysql_query($select2);
	$result2 = mysql_fetch_array($row2);
	
	$select3 = "select * from chk_stool where hn = '".$_GET['hn']."' AND yearchk = '$nPrefix2' ";
	$row3 = mysql_query($select3);
	$result3 = mysql_fetch_array($row3);
	
	$select4 = "select * from chk_pap where hn = '".$_GET['hn']."' AND yearchk = '$nPrefix2' ";
	$row4 = mysql_query($select4);
	$result4 = mysql_fetch_array($row4);
	
	$select5 = "select * from chk_eye where hn = '".$_GET['hn']."' AND yearchk = '$nPrefix2' ";
	$row5 = mysql_query($select5);
	$result5 = mysql_fetch_array($row5);
	
	$select6 = "select * from chk_mouth where hn = '".$_GET['hn']."' AND yearchk = '$nPrefix2' ";
	$row6 = mysql_query($select6);
	$result6 = mysql_fetch_array($row6);
	
	$select7 = "select * from chk_hear where hn = '".$_GET['hn']."' AND yearchk = '$nPrefix2' ";
	$row7 = mysql_query($select7);
	$result7 = mysql_fetch_array($row7);
	
	$select8 = "select * from chk_chest where hn = '".$_GET['hn']."' AND yearchk = '$nPrefix2' ";
	$row8 = mysql_query($select8);
	$result8 = mysql_fetch_array($row8);
	
	
	

	?>
<table width="100%">
<tr>
  <td>
<table width="100%">
<tr>
  <td width="9%" rowspan="3" align="center" valign="top" class="texthead">
	<img src="logo.jpg" width="87" height="83" />
	</td>
  <td align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพลูกจ้างประจำปี <?=$nPrefix?></strong></td>
  </tr>
<tr>
  <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
  </tr>
</table>
</td></tr>
<tr>
  <td valign="top">
  <table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" width="100%" >
  <tr><td>
  <table width="100%" class="text1"><tr><td width="15%" valign="top" class="text2"><strong>HN :</strong>    <?=$result['hn']?></td>
  <td colspan="3" valign="top" class="text2"><strong>ชื่อ :</strong>    <span style="font-size:24px"><strong><?=$result['yot']."  ".$result['name']."  ".$result['surname']?></strong></span></td>
  <td valign="top" class="text2"><strong>อายุ :</strong>
    <?=calcage($result['dbirth'])?></td>
  <td valign="top" class="text3"><strong>สังกัด : </strong>
    <span style="font-size:24px"><strong><?=$result['camp']?></strong></span>
  </td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>น้ำหนัก: </strong>
  <?=$result1['weight']?>กก.</span></td>
  <td width="14%" valign="top"><span class="text3"><strong>ส่วนสูง:</strong>
    <?=$result1['height']?>
ซม.</span></td>
  <td width="10%" valign="top"><span class="text3"><strong>BMI: </strong>
    <u><?=$result1['bmi']?></u>
  </span></td>
  <td width="14%" valign="top"><span class="text3"><strong>รอบเอว:</strong>
    <?=$result1['round_']?>
ซม.</span></td>
  <td width="19%" valign="top"><span class="text3"><strong>แพ้ยา:</strong> 
    <? if($result1['drugreact']=="0"|$result1['drugreact']=="") echo "ไม่แพ้ยา"; else echo $result1['drugreact']; ?>
  </span></td>
  <td width="28%" valign="top"><span class="text3"><strong>โรคประจำตัว:
  </strong>
    <? if($result1['congenital_disease']=="") echo "ไม่มี"; else echo $result1['congenital_disease']; ?>
  </span></td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>บุหรี่: </strong>
    <? if($result1['cigarette']=="1") echo "สูบ"; else echo "ไม่สูบ";?>
  </span></td>
  <td valign="top"><span class="text3"><strong>สุรา: </strong>
    <? if($result1['alcohol']=="1") echo "ดื่ม"; else echo "ไม่ดื่ม";?>
  </span></td>
  <td valign="top"><span class="text3"><strong>T:</strong>
<u><?=$result1['temperature']?></u>
C ํ</span></td>
  <td valign="top"><span class="text3"><strong>P:
  </strong>
    <?=$result1['pause']?>
ครั้ง/นาที</span></td>
  <td valign="top"><span class="text3"><strong>R: </strong>
    <?=$result1['rate']?>
ครั้ง/นาที</span></td>
  <td valign="top"><span class="text3"><strong>BP:</strong>
    <u><?=$result1['bp1']?>
/
<?=$result1['bp2']?>
mmHg.</u></span></td>
</tr>
<!--<tr>
  <td colspan="6" valign="top" class="text2"><strong class="text2">ผลการตรวจร่างกายทั่วไป :</strong>
       <?$result3['general']?>
        <?if($result3['general']=="ผิดปกติ") echo "คำแนะนำ...".$result3['reason_general']."...";?></td>

  </tr>-->
  </table></td></tr></table></td>
  </tr>
<tr>
  <td valign="top"><strong class="text" style="font-size:22px"><u>CBC : การตรวจเม็ดเลือด</u></strong>
    <table width="100%">
      <tr>
        <td width="101" valign="top"><strong class="text3">WBC :</strong>
          <span class="text"><?=$result1['cbc_wbc']?></span></td>
        <td width="132" valign="top"><strong class="text3">HCT : </strong>
          <span class="text"><?=$result1['cbc_hct']?></span></td>
        <td width="118" valign="top"><strong class="text3">NEU :</strong>
          <span class="text"><?=$result1['cbc_neu']?></span></td>
        <td width="117" valign="top"><strong class="text3">LYMP :</strong>
          <span class="text"><?=$result1['cbc_lymp']?></span></td>
        <td width="119" valign="top"><strong class="text3">MONO	:</strong>
          <span class="text"><?=$result1['cbc_mono']?></span></td>
        <td width="107" valign="top"><strong class="text3">EOS :</strong>
          <span class="text"><?=$result1['cbc_eos']?></span></td>
      </tr>
      <tr>
        <td valign="top"><strong class="text3">MCV :</strong>
          <span class="text"><?=$result1['cbc_mcv']?></span></td>
        <td valign="top"><strong class="text3">MCH :</strong>
          <span class="text"><?=$result1['cbc_mch']?></span></td>
        <td valign="top"><strong class="text3">MCHC :</strong>
          <span class="text"><?=$result1['cbc_mchc']?></span></td>
        <td valign="top"><strong class="text3">PLTS :</strong>
          <span class="text"><?=$result1['cbc_plts']?></span></td>
        <td valign="top"><strong class="text3">OTHERr :</strong>
          <span class="text"><?=$result1['cbc_other']?></span></td>
        <td valign="top"><strong class="text3">NRBC :</strong>
          <span class="text"><?=$result1['cbc_nrbc']?></span></td>
      </tr>
      <tr>
        <td height="21" valign="top"><strong class="text3">RBC :</strong>
          <span class="text"><?=$result1['cbc_rbc']?></span></td>
        <td valign="top"><strong class="text3">RBCMOR :</strong>
          <span class="text"><?=$result1['cbc_rbcmor']?></span></td>
        <td valign="top"><strong class="text3">HB :</strong>
          <span class="text"><?=$result1['cbc_hb']?></span></td>
        <td valign="top"><strong class="text3">Baso :</strong>
          <span class="text"><?=$result1['cbc_baso']?></span></td>
        <td valign="top"><strong class="text3">ATYP : </strong>
          <span class="text"><?=$result1['cbc_atyp']?></span></td>
        <td valign="top"><strong class="text3">BAND : </strong>
          <span class="text"><?=$result1['cbc_band']?></span></td>
      </tr>
      <tr>
        <td height="21" colspan="6" valign="top" class="text3"><strong class="text3">HCT : </strong>
          <span class="text"><?=$result1['cbc_hct']?> ( <?=$result1['hctrange']?> ) </span><strong> &nbsp;&nbsp;<?=$result1['stat_hct']?></strong>
          <? if($result1['stat_hct']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_hct']."...";?></td>
        </tr>
      <tr>
        <td height="21" colspan="6" valign="top" class="text3"><strong class="text3">WBC :</strong>
          <span class="text"><?=$result1['cbc_wbc']?> ( <?=$result1['wbcrange']?> )</span> <strong> &nbsp;&nbsp;<?=$result1['stat_wbc']?></strong>
          <? if($result1['stat_wbc']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_wbc']."...";?></td>
        </tr>
      <tr>
        <td height="21" colspan="6" valign="top" class="text3"><strong>PLTC :</strong>
          <span class="text"><?=$result1['cbc_pltc']?> ( <?=$result1['pltcrange']?> )</span> <strong> &nbsp;&nbsp;<?=$result1['stat_pltc']?></strong>
          <? if($result1['stat_pltc']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_pltc']."...";?></td>
        </tr>
      <tr>
        <td height="21" colspan="6" valign="top" class="text3"><span class="text2">ผลการตรวจ :</span><strong> <span class="text2">
          <?=$result1['stat_cbc']?>
          <? if($result1['stat_cbc']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_cbc']."...";?>
        </span></strong></td>
      </tr>
    </table></td>
</tr>
<tr class="text3">
  <td valign="top" ><strong class="text" style="font-size:22px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong>
    <table width="100%">
      <tr>
      <td width="95" valign="top"><strong class="text3">COL :</strong>      <?=$result1['ua_color']?></td>
      <td width="126" valign="top"><strong class="text3"> SPGR  :</strong>
        <?=$result1['ua_spgr']?></td>
      <td width="101" valign="top"><strong class="text3">PH :</strong>
        <?=$result1['ua_phu']?></td>
      <td width="107" valign="top"><strong class="text3">BLO :</strong>
        <?=$result1['ua_bloodu']?></td>
      <td width="111" valign="top"><strong class="text3">PROU :</strong>
        <?=$result1['ua_prou']?></td>
      <td width="154" valign="top"><strong class="text3">GLUU :</strong>
        <?=$result1['ua_gluu']?></td>
    </tr>
      <tr>
        <td valign="top"><strong class="text3"> KETU  :</strong>
          <?=$result1['ua_ketu']?></td>
        <td valign="top"><strong class="text3"> UROBIL  :</strong>
          <?=$result1['ua_urobil']?></td>
        <td valign="top"><strong class="text3"> BILI :</strong>
          <?=$result1['ua_bili']?></td>
        <td valign="top"><strong class="text3"> NITRIT  :</strong>
          <?=$result1['ua_nitrit']?></td>
        <td valign="top"><strong class="text3"> CRYSTU  :</strong>
          <?=$result1['ua_crystu']?></td>
        <td valign="top"><strong class="text3"> CASTU  :</strong>
          <?=$result1['ua_castu']?></td>
      </tr>
      <tr>
        <td height="21" valign="top"><strong class="text3">EPIU :</strong>
          <?=$result1['ua_epiu']?></td>
          <td valign="top"><strong class="text3">WBC :</strong>
          <?=$result1['ua_wbcu']?></td>
          <td valign="top"><strong class="text3">RBC :</strong>
          <?=$result1['ua_rbcu']?></td>
          <td valign="top"><strong class="text3"> AMOPU  :</strong>
          <?=$result1['ua_amopu']?></td>
          <td valign="top"><strong class="text3"> BACTU  :</strong>
          <?=$result1['ua_bactu']?></td>
          <td valign="top"><strong class="text3"> MUCOSU  :</strong>
          <?=$result1['ua_mucosu']?></td>
      </tr>
      <tr>
          <td height="21" valign="top"><strong class="text3"> YEAST  :</strong>
          <?=$result1['ua_yeast']?></td>
          <td valign="top"><strong class="text3"> APPEAR  :</strong>
          <?=$result1['ua_appear']?></td>
          <td valign="top"><strong class="text3"> OTHERU  :</strong>
          <?=$result1['ua_otheru']?></td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
      <tr>
        <td colspan="6" valign="top"><span class="text2">ผลการตรวจ :</span><strong> <span class="text2">
        <?=$result1['stat_ua']?>
        <? if($result1['stat_ua']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_ua']."...";?>
        </span></strong></td>
        </tr>
        
    </table>
</tr>
<tr class="text3">
  <td align="center" valign="top" ><hr /></td>
</tr>
<tr>
  <td valign="top" class="text">
  <table width="100%"  bordercolor="#FFFFFF" border="0"  cellpadding="0" cellspacing="0">
  <? if($result1['bs']!=''){?>
    <tr>
      <td width="27%" valign="top" class="text3"><strong>GLU(เบาหวาน) :</strong></td>
      
      <td width="5%" valign="top" class="text3" bordercolor="#000000"><strong>
        <?=$result1['bs']?>
        </strong></td>
      <td width="7%" valign="top" class="text">(<?=$result1['bsrange']?>)</td>
      <td width="61%" valign="top" class="text"><strong>
        <?=$result1['stat_bs']?>
        </strong>
        <? if($result1['stat_bs']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_bs']."...";?></td>
    </tr>
 <!--     <tr>
        <td valign="top" class="text3"><strong>CHOL(การตรวจไขมัน) :</strong></td>

        <td valign="top" class="text3" bordercolor="#000000"><strong>
          <?//=$result1['chol']?>
        </strong></td>
        <td valign="top" class="text">(<?//=$result1['cholrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?//=$result1['stat_chol']?>
        </strong>
          <?//if($result1['stat_chol']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_chol']."...";?></td>
      </tr>
      <tr>
        <td valign="top" class="text3"><strong>TRIG(การตรวจไขมัน) :</strong></td>

        <td valign="top" class="text3" bordercolor="#000000"><strong>
          <?//=$result1['tg']?>
        </strong></td>
        <td valign="top" class="text">(<?//=$result1['tgrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?//=$result1['stat_tg']?>
        </strong>
          <?// if($result1['stat_tg']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_tg']."...";?></td>
      </tr>-->
      <tr>
        <td valign="top" class="text3"><strong>BUN(การทำงานของไต) :</strong></td>

        <td valign="top" class="text3" bordercolor="#000000"><strong>
          <?=$result1['bun']?>
        </strong></td>
        <td valign="top" class="text">(<?=$result1['bunrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result1['stat_bun']?>
        </strong>
          <? if($result1['stat_bun']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_bun']."...";?></td>
      </tr>
      <tr>
        <td valign="top" class="text3"><strong>CREA(การทำงานของไต) :</strong></td>
        <td valign="top" class="text3" bordercolor="#000000"><strong>
          <?=$result1['cr']?>
        </strong></td>
        <td valign="top" class="text">(<?=$result1['crrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result1['stat_cr']?>
        </strong>
          <? if($result1['stat_cr']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_cr']."...";?></td>
      </tr>
    <tr>
      <td valign="top" class="text3"><strong>ALP(การทำงานของตับ,กระดูก) :</strong></td>
      <td valign="top" class="text3" bordercolor="#000000"><strong>
        <?=$result1['alk']?>
      </strong></td>
      <td valign="top" class="text">(<?=$result1['alkrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result1['stat_alk']?>
      </strong>
        <? if($result1['stat_alk']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_alk']."...";?></td>
      </tr>
    <tr>
      <td valign="top" class="text3"><strong>ALT(การทำงานของตับ) :</strong></td>

      <td valign="top" class="text3" bordercolor="#000000"><strong>
        <?=$result1['sgpt']?>
      </strong></td>
      <td valign="top" class="text">(<?=$result1['sgptrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result1['stat_sgpt']?>
      </strong>
        <? if($result1['stat_sgpt']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_sgpt']."...";?></td>
    </tr>
    <tr>
      <td valign="top" class="text3"><strong>AST(การทำงานของตับ) :</strong></td>
      <td valign="top" class="text3" bordercolor="#000000"><strong>
        <?=$result1['sgot']?>
      </strong></td>
      <td valign="top" class="text">(<?=$result1['sgotrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result1['stat_sgot']?>
      </strong>
        <? if($result1['stat_sgot']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_sgot']."...";?></td>
    </tr>
    <tr>
      <td valign="top" class="text3"><strong>URIC(โรคเก๊าท์) :</strong></td>
      <td valign="top" class="text3" bordercolor="#000000"><strong>
        <?=$result1['uric']?>
      </strong></td>
      <td valign="top" class="text">(<?=$result1['uricrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result1['stat_uric']?>
      </strong>
        <? if($result1['stat_uric']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_uric']."...";?></td>
    </tr>
	<tr>
		<td valign="top" class="text3"><strong>LDL(ตรวจระดับไขมันความหนาแน่นต่ำในเลือด) :</strong></td>
		<td valign="top" class="text3" bordercolor="#000000"><strong>
		<?=$result1['ldl']?>
		</strong></td>
		<td valign="top" class="text">(<?=$result1['ldlrange']?>)</td>
		<td valign="top" class="text"><strong>
		<?=$result1['stat_ldl']?>
		</strong>
		<? if($result1['stat_ldl']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_ldl']."...";?></td>
	</tr>
    <tr>
      <td colspan="4" align="center" valign="top"> <hr /></td>
    </tr>
	<? }
	?>
        <tr>
          <td width="27%" height="24" valign="top" class="text3"><strong>CXR การตรวจเอ็กซ์เรย์ปอด :</strong></td>
          <td colspan="3" align="left" valign="top" class="text3">
            <?=$result1['cxr']?>

            <? if($result1['cxr']=="ผิดปกติ") echo "คำแนะนำ...".$result1['reason_cxr']."...";?></td>
        </tr>
        <tr>
          <td valign="top" class="text3"><strong>ผลการตรวจ HB Profile :</strong></td>
          <td colspan="3" align="left" valign="top" class="text3">
		  <? if($result2['hbsab']!=''){
		  ?><strong>HbsAg :</strong> <?=$result2['hbsag']?><br />
 				<strong>HbsAb:</strong> <?=$result2['hbsab']?> 	<br />
				<strong>HbcAb :</strong> <?=$result2['hbcab']?>
          <? }else{ echo "ไม่มีผลการตรวจ";}?>
          </td>
        </tr>
        <tr>
          <td valign="top" class="text3"><strong>ผลการตรวจ Stool exam Culture :</strong></td>
          <td colspan="3" align="left" valign="top" class="text3"><? if($result3['colour']!=''){ }else{ echo "ไม่มีผลการตรวจ";}?>&nbsp;</td>
        </tr>
        <tr>
          <td valign="top" class="text3"><strong>PAP การตรวจมะเร็งปากมดลูก :</strong></td>
          <td colspan="3" align="left" valign="top" class="text3">
            <? if($result4['stat']!=''){ echo $result4['stat'];}else{ echo "ไม่มีผลการตรวจ";}?>
</td>
        </tr>
        <tr>
          <td valign="top" class="text3"><strong>ผลการตรวจสมรรถภาพการมองเห็น :</strong></td>
          <td colspan="3" align="left" valign="top" class="text3">
            <? if($result5['stat_eye']!=''){ echo $result5['stat_eye'];}else{ echo "ไม่มีผลการตรวจ";}?>
            </td>
        </tr>
        <tr>
          <td valign="top" class="text3"><strong>ผลการตรวจสุขภาพช่องปาก : </strong></td>
          <td colspan="3" align="left" valign="top" class="text3"><? if($result6['hn']!=''){?>
		  <? if($result6['stat']!=''){ echo $result6['stat']." คำแนะนำ : ".$result6['advice1']." ".$result6['advice2']."<br>";}?>
          <? if($result6['stat2']!=''){ echo $result6['stat2']." คำแนะนำ : ".$result6['advice3']." ".$result6['advice4']."<br>";}?>
          <? if($result6['stat3']!=''){ echo $result6['stat3']." คำแนะนำ : ".$result6['advice5']." ".$result6['advice6']."<br>";}?>
          <? if($result6['stat4']!=''){ echo $result6['stat4']." คำแนะนำ : ".$result6['advice7']." ".$result6['advice8']."<br>";}?>
		  <? }else{
			  echo "ไม่มีผลการตรวจ";
			  }?></td>
        </tr>
        <tr>
          <td valign="top" class="text3"><strong>ผลการตรวจสมรรถภาพการได้ยิน :</strong></td>
          <td colspan="3" align="left" valign="top" class="text3">
            <? if($result7['Lowright']!=''){ echo $result7['Lowright'];}else{ echo "ไม่มีผลการตรวจ";}?>
          </td>
        </tr>
            <tr>
              <td valign="top" class="text3"><strong>ผลการตรวจสมรรถภาพปอด :</strong></td>
              <td colspan="3" align="left" valign="top" class="text3">
              <? if($result8['reason']!=''){ echo $result8['reason'];}else{ echo "ไม่มีผลการตรวจ";}?>
              </td>
        </tr>
        <? if($result1['summary']!=''){?>
    <tr>
      <td height="27" colspan="5" align="center" valign="top" class="text1"><hr /><strong>สรุปผลการตรวจสุขภาพ</strong>&nbsp;<u><?=$result1['summary']?></u>
      </td>
    </tr>
    <? }?>
</table></td></tr>
    <tr>
  <td valign="top" class="text2"><? if($result1['summary']!=''){?><strong>Diag</strong> :
<?=$result1['diag']?><? }?>&nbsp;<? if($result1['summary']!=''){?><strong > ความคิดเห็นจากแพทย์</strong>
&nbsp;<?=$result1['dx']?><? }?>
  </td>
  </tr>
  <?
  $dr =explode(" ",$result1['doctor']);
  ?>
    <tr>
      <td align="right" valign="top" class="text2"><? if($result1['doctor']!=''){?><span class="text1">แพทย์ <?=$result1['doctor']?><? }?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
    </tr>
</table>

<?
}else{
?>
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post" target="_blank">
<center>
<span class="tet1">พิมพ์ใบตรวจสุขภาพประจำปีลูกจ้าง</span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;กรอก HN : </span>
    <input name="hn" type="text" size="10" class="tet1">
  <input type="submit" name="ok" value="ตกลง">
  <br />
  <br />

<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a> 
</center>
</form>
<?
}
?>
