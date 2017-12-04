<?
session_start();
include("connect.inc");
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
if(isset($_POST['hn'])){
	$select = "select * from opcard where idcard = '".$_POST['hn']."'";
	$row = mysql_query($select);
	$num = mysql_num_rows($row);
	if($num==0){
		$select = "select * from condxofyear_so where hn = '".$_POST['hn']."' order by thidate desc";
		//echo $select; thidate like '".($_POST['year']-543)."-".$_POST['month']."-".$_POST['day']."%' ";
		$row = mysql_query($select);
		$num = mysql_num_rows($row);
	}else{
		$numn = mysql_fetch_array($row);
		$select = "select * from condxofyear_so where hn = '".$numn['hn']."' order by thidate desc";
		//echo $select; thidate like '".($_POST['year']-543)."-".$_POST['month']."-".$_POST['day']."%' ";
		$row = mysql_query($select);
		$num = mysql_num_rows($row);
	}
	if($num>0){
	?>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a> , <a href ="report_dxofyear.php" >[ HN ใหม่ ]</a>
<table width="524" border="1" cellpadding="0" cellspacing="0"><tr>
    <td width="101" align="center"><span class="tet">วันที่ตรวจ</span></td>
    <td width="197" align="center"><span class="tet">ชื่อ-สกุล</span></td>
    <td width="37" align="center"><span class="tet">ปี</span></td>
    <td width="37" align="center">&nbsp;</td>
    <td width="53" align="center">&nbsp;</td>
    <td width="46" align="center">&nbsp;</td>
    <td width="37" align="center">&nbsp;</td>
</tr>
    <?
    
		$i=0;
		while($result = mysql_fetch_array($row)){
			if($i==1){
					$i=0;
					$bgcolor = "#FFFFA6";
				}else{
					$bgcolor = "#FFFFFF";
					$i=1;
				}
		?>
		<tr bgcolor=<?=$bgcolor?>><td><span class="tet">
		  <?=$result["thidate"]?>
		</span></td>
		  <td><span class="tet">
		  <?=$result["ptname"]?>
		  </span></td>
		  <td align="center"><span class="tet">
		    <?=$result["yearcheck"]?>
		  </span></td>
		  <td align="center"><span class="tet"><a href="report_dxofyear.php?id=<?=$result["row_id"]?>&chkyear=<?=$result["yearcheck"]?>" target="_blank">พิมพ์</a></span></td>
          <td align="center"><span class="tet"><a href="report_dxofyear.php?id=<?=$result["row_id"]?>&no" target="_blank">ดูข้อมูล</a></span></td>
		  <td align="center"><span class="tet"><a href="report_dxofyear.php?ids=<?=$result["row_id"]?>" target="_blank">Stricker</a></span></td>
		  <td align="center"><span class="tet"><a href="report_dxofyear2013.php?id=<?=$result["row_id"]?>" target="_blank">OLD</a></span></td>
		</tr>
		<?
		}
	}else{
		?>
        <meta content="1" http-equiv="refresh"  />
		<?
	}
	?>
</table>
<?
}elseif(isset($_GET['ids'])){
	$detail = "select * from condxofyear_so where row_id = '".$_GET['ids']."' ";
	$result = Mysql_Query($detail);
	$arrs = Mysql_fetch_assoc($result);
	?>
<script language="javascript">
		window.print();
	</script>
	<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
	<tr>
	  <td>ผลการตรวจสุขภาพประจำปี</td>
	  </tr>
	<tr>
		<td>ชื่อ : <?php echo $arrs["ptname"];?> HN :<?php echo $arrs["hn"];?></td>
	  </tr>
	<tr>
	  <td>วันที่ตรวจ : <?php echo $arrs["thidate"];?></td>
	  </tr>
	  <tr>
		<td>ผลการตรวจ : 
		<?php 
		if($arrs["anemia"] =="" && $arrs["cirrhosis"] =="" && $arrs["hepatitis"] =="" && $arrs["cardiomegaly"] =="" && $arrs["allergy"] =="" && $arrs["gout"] =="" && $arrs["waistline"] =="" && $arrs["asthma"] =="" && $arrs["muscle"] =="" && $arrs["ihd"] =="" && $arrs["thyroid"] =="" && $arrs["heart"] =="" && $arrs["emphysema"] =="" && $arrs["herniated"] =="" && $arrs["conjunctivitis"] =="" && $arrs["cystitis"] =="" && $arrs["epilepsy"] =="" && $arrs["fracture"] =="" && $arrs["cardiac"] =="" && $arrs["spine"] =="" && $arrs["dermatitis"] =="" && $arrs["degeneration"] =="" && $arrs["alcoholic"] =="" && $arrs["copd"] =="" && $arrs["bph"] =="" && $arrs["kidney"] ==""  && $arrs["pterygium"]  =="" && $arrs["tonsil"]  =="" && $arrs["paralysis"]  =="" && $arrs["blood"]  =="" && $arrs["conanemia"]  ==""){
		echo "ปกติ";
		}else{
		echo "ป่วยเป็นโรค...";
			if($arrs["anemia"] =="Y"){
				echo "โลหิตจาง, ";
			}
			if ($arrs["cirrhosis"] =="Y"){
				echo "ตับแข็ง, ";
			}
			if($arrs["hepatitis"] =="Y"){
				echo "โรคตับอักเสบ, ";	
			}
			if($arrs["cardiomegaly"] =="Y"){
				echo "หัวใจโต, ";
			}
			if($arrs["allergy"] =="Y"){
				echo "ภูมิแพ้, ";
			}
			if($arrs["gout"] =="Y"){
				echo "โรคเก๊าท์, ";
			}
			if($arrs["waistline"] =="Y"){
				echo "รอบเอวเกิน, ";
			}
			if($arrs["asthma"] =="Y"){
				echo "หอบหืด, ";
			}
			if($arrs["muscle"] =="Y"){
				echo "กล้ามเนื้ออักเสบ, ";	
			}
			if($arrs["ihd"] =="Y"){
				echo "โรคหัวใจขาดเลือดเรื้อรัง, ";
			}
			if($arrs["thyroid"] =="Y"){
				echo "ไทรอยด์, ";
			}
			if($arrs["heart"] =="Y"){
				echo "โรคหัวใจ, ";
			}
			if($arrs["emphysema"] =="Y"){
				echo "ถุงลมโป่งพอง, ";
			}
			if($arrs["herniated"] =="Y"){
				echo "หมอนรองกระดูกทับเส้นประสาท, ";
			}
			if($arrs["conjunctivitis"] =="Y"){
				echo "เยื่อบุตาอักเสบ, ";
			}
			if($arrs["cystitis"] =="Y"){
				echo "กระเพาะปัสสาวะอักเสบ, ";	
			}
			if($arrs["epilepsy"] =="Y"){
				echo "ลมชัก, ";
			}
			if($arrs["fracture"] =="Y"){
				echo "กระดูกหักเลื่อน, ";
			}
			if($arrs["cardiac"] =="Y"){
				echo "หัวใจเต้นผิดจังหวะ, ";
			}
			if($arrs["spine"] =="Y"){
				echo "กระดูกสันหลัง (อก) คด, ";
			}
			if($arrs["dermatitis"] =="Y"){
				echo "ผิวหนังอักเสบ, ";
			}
			if($arrs["degeneration"] =="Y"){
				echo "หัวเข่าเสื่อม, ";
			}
			if($arrs["alcoholic"] =="Y"){
				echo "ความผิดปกติจากแอลกอฮอล์, ";
			}
			if($arrs["copd"] =="Y"){
				echo "COPD, ";
			}
			if($arrs["bph"] =="Y"){
				echo "BPH, ";	
			}
			if($arrs["kidney"] =="Y"){
				echo "ไตผิดปกติ, ";
			}
			if($arrs["pterygium"] =="Y"){
				echo "ต้อเนื้อ, ";
			}
			if($arrs["tonsil"] =="Y"){
				echo "ต่อมทอนซิลโต, ";
			}
			if($arrs["paralysis"] =="Y"){
				echo "อัมพาตซีกซ้าย/ขวา, ";
			}
			if($arrs["blood"] =="Y"){
				echo "เม็ดเลือดผิดปกติ, ";
			}
			if($arrs["conanemia"] =="Y"){
				echo "ภาวะซีด";
			}
			if($arrs["ht"] =="Y"){
				echo "ความดันโลหิตสูง";
			}			
		}
		?>
        
        </td>
	  </tr>
      <?
      	if($_POST['normal41']=="ผิดปกติ"|$_POST['normal42']=="ผิดปกติ"|$_POST['normal43']=="ผิดปกติ") $text41="ตับ";
		if($_POST['normal44']=="ผิดปกติ"|$_POST['normal45']=="ผิดปกติ") $text44="ไต";
		if($_POST['normal46']=="ผิดปกติ"|$_POST['normal48']=="ผิดปกติ") $text46="ไขมัน";
		if($_POST['normal47']=="ผิดปกติ") $text47="เบาหวาน";
		if($_POST['normal49']=="ผิดปกติ") $text49="URIC";
		if($_POST['normal81']=="ผิดปกติ") $text81="CBC";
		if($_POST['normal']=="ผิดปกติ") $text="UA";
	  ?>
	  <? if($arrs["summary"]=="ผิดปกติ"){?>
	  <tr>
	    <td>Diag: <?=$arrs["diag"]?></td>
      </tr>
      <tr>
	    <td>บันทึกจากแพทย์: <?=$arrs["dx"]?></td>
      </tr>
      <tr>
	    <td>ความผิดปกติ: <?=$text41?> <?=$text44?> <?=$text46?> <?=$text47?> <?=$text49?> <?=$text81?> <?=$text?></td>
      </tr>
      <? }?>
	  <tr>
		<td>แพทย์ : <?php echo $arrs["doctor"];?></td>
	  </tr>
</table>
<?
}elseif(isset($_GET['mid'])){
	$select = "select * from condxofyear_so where hn = '".$_GET['mid']."' and thidate like '".$_SESSION['pdate']."%' order by row_id desc limit 1";
	//echo $select;
	$row = mysql_query($select);
	$result = mysql_fetch_array($row);
	?>
	<script>
		window.opener.location.href='dx_ofyear_manual.php';
    	window.location.href="report_dxofyear.php?id=<?=$result["row_id"]?>";
		
    </script>
	<?
}elseif(isset($_GET['id'])){
	
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
////*runno ตรวจสุขภาพ*/////////

	//ปีล่าสุด
	$select = "select * from condxofyear_so where row_id='".$_GET['id']."'";
	$row = mysql_query($select);
	$result = mysql_fetch_array($row);
	
	//ปีก่อน
	$select5 = "select * from condxofyear_so where hn='".$result['hn']."' and yearcheck='".($nPrefix2-1)."' order by row_id desc";
	$row5 = mysql_query($select5);
	$result5 = mysql_fetch_array($row5);
	if(!isset($_GET['no'])){
	?>
<script language="javascript">
		window.print();
	</script>
    <?
	}
	

	?>
<table width="100%">
<tr>
  <td>
<table width="100%">
<tr>
  <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" width="87" height="83" /></td>
  <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพประจำปี <?=$nPrefix?></strong></td>
  <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
  <td align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่ 
  <?
  $da = explode(" ",$result["thidate"]);
  $daten = explode("-",$da[0]);
  ?>
    <?=$daten[2]?>-<?=$daten[1]?>-<?=$daten[0]?>&nbsp;<?=$da[1]?>
  </span></span></span></td>
  <td align="center" valign="top" class="text3">&nbsp;</td>
</tr>
</table>
</td></tr>
<tr>
  <td valign="top">
  <table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" width="100%" >
  <tr><td>
  <table width="100%" class="text1">
    <tr><td width="17%" valign="top" class="text2"><strong>HN :</strong>    <?=$result['hn']?></td>
  <td colspan="3" valign="top" class="text2"><strong>ชื่อ :</strong>    <span style="font-size:24px"><strong><?=$result['ptname']?></strong></span></td>
  <td valign="top" class="text2"><strong>อายุ :</strong>
    <?=$result['age']?></td>
  <td valign="top" class="text3"><strong>สังกัด : </strong>
    <span style="font-size:18px"><strong><?= substr($result['camp'],6)?></strong></span>  </td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>น้ำหนัก: </strong>
  <?=$result['weight']?>กก.</span></td>
  <td width="16%" valign="top"><span class="text3"><strong>ส่วนสูง:</strong>
    <?=$result['height']?>
ซม.</span></td>
  <td width="10%" valign="top"><span class="text3"><strong>BMI: </strong>
    <u><?=$result['bmi']?></u>
  </span></td>
  <td width="13%" valign="top"><span class="text3"><strong>รอบเอว:</strong>
    <?=$result['round_']?>
ซม.</span></td>
  <td width="22%" valign="top"><span class="text3"><strong>แพ้ยา:</strong> 
    <? if($result['drugreact']=="0" || $result['drugreact']==""){ echo "ไม่แพ้ยา"; }else{
		$sql55 = "Select  drugreact From opcard  where hn = '".$result['hn']."' ";
		$result55 = mysql_query($sql55);
		$arr55 = mysql_fetch_array($result55);
			echo $arr55["drugreact"];
		}	
	?>
  </span></td>
  <td width="22%" valign="top"><span class="text3"><strong>โรคประจำตัว:
  </strong>
    <? if($result['congenital_disease']=="") echo "ไม่มี"; else echo $result['congenital_disease']; ?>
  </span></td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>บุหรี่: </strong>
    <? if($result['cigarette']=="0"){ echo "ไม่เคยสูบ";}else if($result['cigarette']=="1"){ echo "เคยสูบ แต่เลิกแล้ว";}else if($result['cigarette']=="2"){ echo "สูบเป็นครั้งคราว";}else if($result['cigarette']=="3"){ echo "สูบเป็นประจำ";}?>
  </span></td>
  <td valign="top"><span class="text3"><strong>สุรา: </strong>
    <? if($result['alcohol']=="0"){ echo "ไม่เคยดื่ม";}else if($result['alcohol']=="1"){ echo "เคยดื่ม แต่เลิกแล้ว";}else if($result['alcohol']=="2"){ echo "ดื่มเป็นครั้งคราว";}else if($result['alcohol']=="3"){ echo "ดื่มเป็นประจำ";}?>  
  </span></td>
  <td valign="top"><span class="text3"><strong>T:</strong>
<u><?=$result['temperature']?></u>
C ํ</span></td>
  <td valign="top"><span class="text3"><strong>P:
  </strong>
    <?=$result['pause']?>
ครั้ง/นาที</span></td>
  <td valign="top"><span class="text3"><strong>R: </strong>
    <?=$result['rate']?>
ครั้ง/นาที</span></td>
  <td valign="top"><span class="text3"><strong>BP:</strong>
    <u><?=$result['bp1']?>
/
<?=$result['bp2']?>
mmHg.</u></span></td>
</tr>
<tr>
  <td colspan="6" valign="top" class="text2"><strong class="text2">ค่าความดัน : </strong><?=$result['stat_pressure']?>
    <? if($result['stat_pressure']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_pressure']."...";?></td>
</tr>
<tr>
  <td colspan="6" valign="top" class="text2"><strong class="text2">ค่า BMI : </strong>
    <?=$result['stat_bmi']?>
    <? if($result['stat_bmi']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_bmi']."...";?></td>
</tr>
  </table></td></tr></table></td>
  </tr>
<tr class="text3">
  <td align="center" valign="top" ><strong class="text" style="font-size:22px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong>
    <table width="100%">
      <tr>
      <td width="95" valign="top"><strong class="text3">COL :</strong>      <?=$result['ua_color']?></td>
      <td width="126" valign="top"><strong class="text3"> SPGR  :</strong>
        <?=$result['ua_spgr']?></td>
      <td width="101" valign="top"><strong class="text3">PH :</strong>
        <?=$result['ua_phu']?></td>
      <td width="107" valign="top"><strong class="text3">BLO :</strong>
        <?=$result['ua_bloodu']?></td>
      <td width="111" valign="top"><strong class="text3">PROU :</strong>
        <?=$result['ua_prou']?></td>
      <td width="154" valign="top"><strong class="text3">GLUU :</strong>
        <?=$result['ua_gluu']?></td>
    </tr>
      <tr>
        <td valign="top"><strong class="text3"> KETU  :</strong>
          <?=$result['ua_ketu']?></td>
        <td valign="top"><strong class="text3"> UROBIL  :</strong>
          <?=$result['ua_urobil']?></td>
        <td valign="top"><strong class="text3"> BILI :</strong>
          <?=$result['ua_bili']?></td>
        <td valign="top"><strong class="text3"> NITRIT  :</strong>
          <?=$result['ua_nitrit']?></td>
        <td valign="top"><strong class="text3"> CRYSTU  :</strong>
          <?=$result['ua_crystu']?></td>
        <td valign="top"><strong class="text3"> CASTU  :</strong>
          <?=$result['ua_castu']?></td>
      </tr>
      <tr>
        <td height="21" valign="top"><strong class="text3">EPIU :</strong>
          <?=$result['ua_epiu']?></td>
          <td valign="top"><strong class="text3">WBC :</strong>
          <?=$result['ua_wbcu']?></td>
          <td valign="top"><strong class="text3">RBC :</strong>
          <?=$result['ua_rbcu']?></td>
          <td valign="top"><strong class="text3"> AMOPU  :</strong>
          <?=$result['ua_amopu']?></td>
          <td valign="top"><strong class="text3"> BACTU  :</strong>
          <?=$result['ua_bactu']?></td>
          <td valign="top"><strong class="text3"> MUCOSU  :</strong>
          <?=$result['ua_mucosu']?></td>
      </tr>
      <tr>
          <td height="21" valign="top"><strong class="text3"> YEAST  :</strong>
          <?=$result['ua_yeast']?></td>
          <td valign="top"><strong class="text3"> APPEAR  :</strong>
          <?=$result['ua_appear']?></td>
          <td valign="top"><strong class="text3"> OTHERU  :</strong>
          <?=$result['ua_otheru']?></td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
      <tr>
        <td height="41" colspan="6" valign="top"><span class="text2">ผลการตรวจ :</span><strong> <span class="text2">
        <?=$result['stat_ua']?>
        <? if($result['stat_ua']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_ua']."...";?>
        </span></strong><hr /></td>
        </tr>
        
    </table>
</tr>
<tr class="text3">
  <td align="center" valign="top" ><strong class="text" style="font-size:22px"><u>CBC : การตรวจเม็ดเลือด</u></strong>
    <table width="100%"><tr>
      <td width="101" valign="top"><strong class="text3">WBC :</strong>
        <?=$result['cbc_wbc']?></td>
      <td width="132" valign="top"><strong class="text3">HCT : </strong>
        <?=$result['cbc_hct']?></td>
      <td width="118" valign="top"><strong class="text3">NEU :</strong>
        <?=$result['cbc_neu']?></td>
      <td width="117" valign="top"><strong class="text3">LYMP :</strong>
        <?=$result['cbc_lymp']?></td>
      <td width="119" valign="top"><strong class="text3">MONO	:</strong>
        <?=$result['cbc_mono']?></td>
      <td width="107" valign="top"><strong class="text3">EOS :</strong>
        <?=$result['cbc_eos']?></td></tr><tr>
          <td valign="top"><span class="text"><strong class="text3">MCV :</strong>
              <?=$result['cbc_mcv']?>
          </span></td>
        <td valign="top"><span class="text"><strong class="text3">MCH :</strong>
            <?=$result['cbc_mch']?>
        </span></td>
        <td valign="top"><strong class="text3">MCHC :</strong>
          <?=$result['cbc_mchc']?></td>
        <td valign="top"><strong class="text3">PLTS :</strong>
          <?=$result['cbc_plts']?></td>
        <td valign="top"><strong class="text3">OTHERr :</strong>
          <?=$result['cbc_other']?></td>
        <td valign="top"><strong class="text3">NRBC :</strong>
          <?=$result['cbc_nrbc']?></td></tr><tr>
            <td height="21" valign="top"><strong class="text3">RBC :</strong>
            <?=$result['cbc_rbc']?></td>
          <td valign="top"><strong class="text3">RBCMOR :</strong>
            <?=$result['cbc_rbcmor']?></td>
          <td valign="top"><strong class="text3">HB :</strong>
            <?=$result['cbc_hb']?></td>
          <td valign="top"><span class="text"><strong class="text3">Baso :</strong>
              <?=$result['cbc_baso']?>
          </span></td>
          <td valign="top"><strong class="text3">ATYP : </strong>
            <?=$result['cbc_atyp']?></td>
          <td valign="top"><strong class="text3">BAND : </strong>
            <?=$result['cbc_band']?></td></tr>
          <tr>
            <td height="21" valign="top"><strong class="text3">HCT : </strong>
            <?=$result['cbc_hct']?>&nbsp;</td>
            <td colspan="5" valign="top" class="text">
            (
              <?=$result['hctrange']?>
) 
<strong>
&nbsp;&nbsp;<?=$result['stat_hct']?>
</strong> 
            <? if($result['stat_hct']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_hct']."...";?></td>
        </tr>
          <tr>
            <td height="21" valign="top"><strong class="text3">WBC :</strong>
            <?=$result['cbc_wbc']?>&nbsp;</td>
            <td colspan="5" valign="top" class="text">
              (
                <?=$result['wbcrange']?>
)
<strong>
&nbsp;&nbsp;<?=$result['stat_wbc']?>
</strong>
            <? if($result['stat_wbc']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_wbc']."...";?></td>
          </tr>
          <tr>
            <td height="21" valign="top" class="text3"><strong>PLTC :</strong>
            <?=$result['cbc_pltc']?>&nbsp;</td>
            <td colspan="5" valign="top" class="text">
              (
                <?=$result['pltcrange']?>
)
<strong>
&nbsp;&nbsp;<?=$result['stat_pltc']?>
</strong>
            <? if($result['stat_pltc']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_pltc']."...";?></td>
          </tr>
          <tr>
            <td height="21" colspan="6" valign="top" class="text3"><span class="text2">ผลการตรวจ :</span><strong> <span class="text2">
        <?=$result['stat_cbc']?>
        <? if($result['stat_cbc']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_cbc']."...";?>
        </span></strong>
            </td>
          </tr>
  </table>    <hr /></td></tr>
<tr>
  <td valign="top" class="text">
  <table width="100%"  bordercolor="#FFFFFF" border="0"  cellpadding="0" cellspacing="0">
  
    <tr>
      <td valign="top" class="text3"><strong>ผลการตรวจ&nbsp;</strong></td>
      <!--<td valign="top" width="4%"  class="text3" bordercolor="#000000"><strong>2555</strong></td>-->
      <td width="6%" align="center" valign="top" bordercolor="#000000"  class="text3"><strong><?=$nPrefix2;?></strong></td>
      <td width="1%" align="center" valign="top" bordercolor="#000000"  class="text3">&nbsp;</td>
      <td valign="top" class="text">&nbsp;</td>
      <td valign="top" class="text">&nbsp;</td>
    </tr>
    <? if($result['bs']!=""){?>
    <tr>
      <td width="21%" valign="top" class="text3"><strong>GLU(เบาหวาน) :</strong></td>
     <!-- <td width="4%" align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['bs']?>
      </strong></td>-->
        <td width="6%" align="right" valign="top" bordercolor="#000000" class="text3"><strong>
          <?=$result['bs']?>
        </strong></td>
        <td width="1%" align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td width="6%" valign="top" class="text">(<?=$result['bsrange']?>)</td>
        <td width="66%" valign="top" class="text"><strong>
          <?=$result['stat_bs']?>
        </strong>
          <? if($result['stat_bs']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_bs']."...";?></td>
      </tr>
      <? } 
	  if($result['chol']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>CHOL(การตรวจไขมัน) :</strong></td>
        <!--<td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['chol']?>
        </strong></td>-->
        <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
          <?=$result['chol']?>
        </strong></td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['cholrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_chol']?>
        </strong>
          <? if($result['stat_chol']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_chol']."...";?></td>
      </tr>
      <? } 
	  if($result['tg']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>TRIG(การตรวจไขมัน) :</strong></td>
       <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['tg']?>
        </strong></td>-->
        <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
          <?=$result['tg']?>
        </strong></td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['tgrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_tg']?>
        </strong>
          <? if($result['stat_tg']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_tg']."...";?></td>
      </tr>
      <? } 
	  if($result['bun']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>BUN(การทำงานของไต) :</strong></td>
        <!--<td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['bun']?>
        </strong></td>-->
        <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
          <?=$result['bun']?>
        </strong></td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['bunrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_bun']?>
        </strong>
          <? if($result['stat_bun']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_bun']."...";?></td>
      </tr>
      <? } 
	  if($result['cr']!=""){
	  ?>
      <tr>
        <td valign="top" class="text3"><strong>CREA(การทำงานของไต) :</strong></td>
       <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['cr']?>
        </strong></td>-->
        <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
          <?=$result['cr']?>
        </strong></td>
        <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="top" class="text">(<?=$result['crrange']?>)</td>
        <td valign="top" class="text"><strong>
          <?=$result['stat_cr']?>
        </strong>
          <? if($result['stat_cr']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_cr']."...";?></td>
      </tr>
      <? } 
	  if($result['alk']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>ALP(การทำงานของตับ,กระดูก) :</strong></td>
     <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['alk']?>
      </strong></td>-->
      <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
        <?=$result['alk']?>
      </strong></td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['alkrange']?>)</td>
      <td valign="top" class="text"><strong><strong>
        <?=$result['stat_sgot']?>
      </strong></strong><? if($result['stat_sgot']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_sgot']."...";?></td>
      </tr>
      <? } 
	  if($result['sgpt']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>ALT(การทำงานของตับ) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['sgpt']?>
      </strong></td>-->
      <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
        <?=$result['sgpt']?>
      </strong></td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['sgptrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result['stat_sgpt']?>
      </strong>
        <? if($result['stat_sgpt']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_sgpt']."...";?></td>
    </tr>
    <? } 
	  if($result['sgot']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>AST(การทำงานของตับ) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['sgot']?>
      </strong></td>-->
      <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
        <?=$result['sgot']?>
      </strong></td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['sgotrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result['stat_alk']?>
      </strong>
        <? if($result['stat_alk']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_alk']."...";?></td>
    </tr>
    <? } 
	  if($result['uric']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>URIC(โรคเก๊าท์) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['uric']?>
      </strong></td>-->
      <td align="right" valign="top" bordercolor="#000000" class="text3"><strong>
        <?=$result['uric']?>
      </strong></td>
      <td align="right" valign="top" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="top" class="text">(<?=$result['uricrange']?>)</td>
      <td valign="top" class="text"><strong>
        <?=$result['stat_uric']?>
      </strong>
        <? if($result['stat_uric']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_uric']."...";?></td>
    </tr>
    <tr>
      <td colspan="6" align="center" valign="top"> <hr /></td>
    </tr>
	<? }
	?>
    
    <tr>
      <td valign="top" class="text3" width="21%"><strong>CXR การตรวจเอ็กซ์เรย์ปอด :</strong></td>
     <!-- <td align="left" valign="top" class="text3" width="4%"><strong>
        <?//=$result5['cxr']?>
      </strong></td>-->
      <td colspan="4" align="left" valign="top" class="text3"><strong>
        <?=$result['cxr']?>
      </strong>
        <? if($result['cxr']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_cxr']."...";?></td>
      </tr>
      <? 
	  if($result['pap']!=""){
	  ?>
    <tr>
      <td valign="top" class="text3"><strong>PAP การตรวจมะเร็งปากมดลูก :</strong></td>
      <td colspan="5" align="left" valign="top" class="text3"><strong>
        <?=$result['pap']?>
        </strong>
        <? if($result['pap']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_pap']."...";?></td>
      </tr>
    <? }
	if($result['other1']!=""){?>
    <tr>
      <td colspan="6" valign="top"><strong>การตรวจพิเศษอื่น ๆ </strong></td>
    </tr>
    <tr>
      <td width="21%" valign="top" class="text3"><strong>
        <?=$result['other1']?>
      :</strong></td>
      <td colspan="5" valign="top" class="text3"><span class="text3">
        <?=$result['stat_other1']?>
        <? if($result['stat_other1']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other1']."...";?>
      </span></td>
      </tr>
      <? }
	if($result['other2']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other2']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other2']?>
        <? if($result['stat_other2']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other2']."...";?>
      </span></td>
      </tr>
	<? }
	if($result['other3']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other3']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other3']?>
        <? if($result['stat_other3']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other3']."...";?>
      </span></td>
      </tr>
	<? }
	if($result['other4']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other4']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other4']?>
        <? if($result['stat_other4']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other4']."...";?>
      </span></td>
      </tr>
      <? }
	if($result['other5']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other5']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other5']?>
        <? if($result['stat_other5']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other5']."...";?>
      </span></td>
      </tr>
      <? }
	if($result['other6']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other6']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other6']?>
        <? if($result['stat_other6']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other6']."...";?>
      </span></td>
      </tr>
      <? }
	if($result['other7']!=""){?>
    <tr>
      <td valign="top"><span class="text3"><strong>
        <?=$result['other7']?> :
      </strong>      </span></td>
      <td colspan="5" valign="top"><span class="text3">
        <?=$result['stat_other7']?>
        <? if($result['stat_other7']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other7']."...";?>
      </span></td>
      </tr>
      <? }?>
    <tr>
      <td height="27" colspan="6" align="center" valign="top" class="text1"><hr /><strong>สรุปผลการตรวจสุขภาพ</strong>&nbsp;<u>
	  <?
	  $summary="";
	  if($result['sum1']!=""){ 
	  
	  echo $summary=$result['sum1'];
	  
	  }else{
		  for($p=2;$p<6;$p++){
			 if($result['sum'.$p]!=''){
				 if($p==2){
				 	$summary .= $result['sum'.$p]."(".$result['rs_sum21']." ".$result['rs_sum22']." ".$result['rs_sum23']." ".$result['rs_sum24']." ".$result['rs_sum25']."),";
				 }elseif($p==5){
				 	$summary .= $result['sum'.$p]."(".$result['rs_sum51']." ".$result['rs_sum52']." ".$result['rs_sum53']."),";
				 }elseif($p==6){
				 	$summary .= $result['sum'.$p]."(".$result['rs_sum61'].")";
				 }else{
			 		$summary .= $result['sum'.$p].",";
				 }
				// if($result['sum'.($p+1)]!=''){$summary .= ",";}
			 }
		  }
		  echo $summary;
	  }
	  
	 ?></u>      </td>
    </tr>
</table></td></tr>
    <tr>
  <td valign="top" class="text2"><strong>Diag</strong> :
<?=$result['diag']?>&nbsp;<strong > ความคิดเห็นจากแพทย์</strong>
&nbsp;<?=$result['dx']?>
  </td>
  </tr>
  <?
  $dr =explode(" ",$result['doctor']);
  ?>
    <tr>
      <td align="right" valign="top" class="text2"><span class="text1">แพทย์ <?=$result['doctor']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
    </tr>
</table>

<span class="text">
<?
}else{

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
////*runno ตรวจสุขภาพ*/////////
?>
</span>
<!--<a href="report_dxofyear_emp.php">พิมพ์ใบตรวจสุขภาพลูกจ้าง</a>-->
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">พิมพ์ใบตรวจสุขภาพประจำปี <?=$nPrefix2;?></span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;กรอก HN : </span>
    <input name="hn" type="text" size="10" class="tet1" value="<?=$_GET["hn"];?>">
  &nbsp;&nbsp;
  <input name="ok" type="submit" class="texthead" value="ตกลง">
  <br />
  <br />

<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a> 
</center>
</form>

<table border="1" width="30%" class="text1" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
<?	
//	$Aquery = "select * from condxofyear_so where yearcheck='$nPrefix2' and printok='N' group by hn order by row_id desc";
	$rw = mysql_query($Aquery);
	while($fet = mysql_fetch_array($rw)){
		$Bquery = "select * from condxofyear_so where hn = '".$fet['hn']."' and  yearcheck='$nPrefix2' order by row_id desc";
		$rw2 = mysql_query($Bquery);
		$fet2 = mysql_fetch_array($rw2);
		?>
		<tr><td><a href="report_dxofyear.php?id=<?=$fet2["row_id"]?>" target="_blank"><?=$fet2['hn']?></a></td><td><?=$fet2['ptname']?></td></tr>
		<?
	}
	echo "</table>";
}
?>
