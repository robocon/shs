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
.text4 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
.text {
	font-family: "TH SarabunPSK";
	font-size: 16px;
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
if(isset($_POST['ok'])){
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
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a> , <a href ="report_dxofyear_new.php" >[ HN ใหม่ ]</a>
<table width="446" border="1" cellpadding="0" cellspacing="0"><tr>
    <td width="101" align="center"><span class="tet">วันที่ตรวจ</span></td>
    <td width="197" align="center"><span class="tet">ชื่อ-สกุล</span></td>
    <td width="37" align="center">&nbsp;</td>
    <td width="53" align="center">&nbsp;</td>
    <td width="46" align="center">&nbsp;</td></tr>
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
		  <td align="center"><span class="tet"><a href="report_dxofyear_new.php?id=<?=$result["row_id"]?>" target="_blank">พิมพ์</a></span></td>
          <td align="center"><span class="tet"><a href="report_dxofyear_new.php?id=<?=$result["row_id"]?>&no" target="_blank">ดูข้อมูล</a></span></td>
		  <td align="center"><span class="tet"><a href="report_dxofyear_new.php?ids=<?=$result["row_id"]?>" target="_blank">Stricker</a></span></td>
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
		<td>ผลการตรวจ : <?php echo $arrs["summary"];?></td>
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
}elseif(isset($_GET['id'])){
	$select = "select * from condxofyear_so where row_id='".$_GET['id']."'";
	$row = mysql_query($select);
	$result = mysql_fetch_array($row);
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
  <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพ</strong></td>
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
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse"width="92%" >
  <tr><td>
  <table width="100%" class="text1"><tr><td width="15%" valign="top" class="text2"><strong>HN :</strong>    <?=$result['hn']?></td>
  <td colspan="5" valign="top" class="text2"><strong>ชื่อ :</strong>    <span style="font-size:22px"><strong><?=$result['ptname']?></strong></span><strong>&nbsp;&nbsp;อายุ :</strong>
    <?=$result['age']?>    &nbsp;&nbsp;<strong>สังกัด : </strong>
    <span style="font-size:22px"><strong><?=$result['camp']?></strong></span>  </td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>น้ำหนัก: </strong>
  <?=$result['weight']?>กก.</span></td>
  <td width="14%" valign="top"><span class="text3"><strong>ส่วนสูง:</strong>
    <?=$result['height']?>
ซม.</span></td>
  <td width="10%" valign="top"><span class="text3"><strong>BMI: </strong>
    <u><?=$result['bmi']?></u>
  </span></td>
  <td width="14%" valign="top"><span class="text3"><strong>รอบเอว:</strong>
    <?=$result['round_']?>
ซม.</span></td>
  <td width="16%" valign="top"><span class="text3"><strong>แพ้ยา:</strong> 
    <? if($result['drugreact']=="0"|$result['drugreact']=="") echo "ไม่แพ้ยา"; else echo $result['drugreact']; ?>
  </span></td>
  <td width="31%" valign="top"><span class="text3"><strong>โรคประจำตัว:
  </strong>
    <? if($result['congenital_disease']=="") echo "ไม่มี"; else echo $result['congenital_disease']; ?>
  </span></td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>บุหรี่: </strong>
    <? if($result['cigarette']=="1") echo "สูบ"; else echo "ไม่สูบ";?>
  </span></td>
  <td valign="top"><span class="text3"><strong>สุรา: </strong>
    <? if($result['alcohol']=="1") echo "ดื่ม"; else echo "ไม่ดื่ม";?>
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
  <td colspan="6" valign="top" class="text2"><strong class="text2">ผลการตรวจร่างกายทั่วไป</strong>
      <?=$result['general']?>
        <? if($result['general']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_general']."...";?></td>

  </tr>
  </table></td></tr></table></td>
  </tr>
<tr class="text3">
  <td valign="top" >
    <table width="92%"><tr>
      <td width="333" valign="top">
        <table width="332" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" ><tr><td width="328" valign="top">
          <table width="86%" class="text4">
            <tr style='line-height:10px;'>
              <td colspan="2" valign="top"><strong class="text" style="font-size:16px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td valign="top">&nbsp;</td>
              <td width="123" align="center" valign="top" class="text"><strong>ผล</strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td width="122"><strong class="text4">COL</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_color']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">SPGR</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_spgr']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">PH</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_phu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">YEAST</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_yeast']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">KETU</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_ketu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">EPIU</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_epiu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">UROBIL</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_urobil']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">WBC</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_wbcu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">APPEAR</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_appear']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">BILI</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_bili']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">RBC</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_rbcu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">BLO</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_bloodu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">NITRIT</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_nitrit']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">MUCOSU</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_mucosu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">CASTU</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_castu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">GLUU</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_gluu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">PROU</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_prou']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">CRYSTU</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_crystu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">BACTU</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_bactu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">AMOPU</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_amopu']?>
              </strong></td>
              </tr>
            <tr style='line-height:10px;'>
              <td><strong class="text4">OTHERU</strong></td>
              <td align="center" class="text"><strong>
                <?=$result['ua_otheru']?>
              </strong></td>
              </tr>
            <tr>
              <td colspan="2" valign="top" class="text2"><strong>สรุปผลการตรวจ</strong> :
               <span class="text"> <strong><?=$result['stat_ua']?></strong>
                <? if($result['stat_ua']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_ua']."...";?></span>
                </td>
              </tr>
            </table>
          </td></tr></table><br /></td>
      <td width="320" valign="top">
        <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
          <tr>
            <td valign="top"><table width="100%" class="text">
              <tr style='line-height:10px;'>
                <td colspan="4" valign="top"><strong class="text" style="font-size:16px"><u>CBC : การตรวจเม็ดเลือด</u></strong></td>
              </tr>
              <tr style='line-height:10px;'>
                <td valign="top">&nbsp;</td>
                <td width="62" align="center" valign="top" class="text"><strong>ผล</strong></td>
                <td align="center" valign="top" class="text"><strong>หน่วย</strong></td>
                <td align="center" valign="top" class="text"><strong>ค่าปกติ</strong></td>
              </tr>
              <tr style='line-height:10px;'>
                <td width="50"><strong class="text4">RBC</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_rbc']?>
                </strong></td>
                <td width="76" align="center" class="text">X10^6/uL</td>
                <td width="102" align="center" class="text">3.5-5.7</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><span class="text"><strong class="text4">HB</strong></span></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_hb']?>
                </strong></td>
                <td align="center" class="text">gm%</td>
                <td align="center" class="text">12.0-16.0</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><span class="text"><strong class="text4">HCT</strong></span></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_hct']?>
                </strong></td>
                <td align="center" class="text">Vol%</td>
                <td align="center" class="text">36.0-50.0</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><span class="text"><strong class="text4">MCV</strong></span></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_mcv']?>
                </strong></td>
                <td align="center" class="text">Fl</td>
                <td align="center" class="text">82.2-97.4</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><span class="text"><strong class="text4">MCH</strong></span></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_mch']?>
                </strong></td>
                <td align="center" class="text">Fg</td>
                <td align="center" class="text">27.6-33.3</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">MCHC</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_mchc']?>
                </strong></td>
                <td align="center" class="text">g/dl</td>
                <td align="center" class="text">33.0-34.8</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">RBCMOR</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_rbcmor']?>
                </strong></td>
                <td align="center" class="text">&nbsp;</td>
                <td align="center" class="text">&nbsp;</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">WBC</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_wbc']?>
                </strong></td>
                <td align="center" class="text">&nbsp;</td>
                <td align="center" class="text">4.5-11.0</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">NEU</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_neu']?>
                </strong></td>
                <td align="center" class="text">%</td>
                <td align="center" class="text">37.0-72.0</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">LYMP</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_lymp']?>
                </strong></td>
                <td align="center" class="text">%</td>
                <td align="center" class="text">20.0-50.0</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><span class="text"><strong class="text4">MONO</strong></span></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_mono']?>
                </strong></td>
                <td align="center" class="text">%</td>
                <td align="center" class="text">0.0-14.0</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">EOS</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_eos']?>
                </strong></td>
                <td align="center" class="text">%</td>
                <td align="center" class="text">0.0-6.0</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">Baso</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_baso']?>
                </strong></td>
                <td align="center" class="text">%</td>
                <td align="center" class="text">0.0-1.0</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">PLTS</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_plts']?>
                </strong></td>
                <td align="center" class="text">&nbsp;</td>
                <td align="center" class="text">&nbsp;</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">PLTC</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_pltc']?>
                </strong></td>
                <td align="center" class="text">10^3/Ul</td>
                <td align="center" class="text">140-400</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">OTHER</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_other']?>
                </strong></td>
                <td align="center" class="text">&nbsp;</td>
                <td align="center" class="text">&nbsp;</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">ATYP</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_atyp']?>
                </strong></td>
                <td align="center" class="text">&nbsp;</td>
                <td align="center" class="text">&nbsp;</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">NRBC</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_nrbc']?>
                </strong></td>
                <td align="center" class="text">&nbsp;</td>
                <td align="center" class="text">&nbsp;</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">BAND</strong></td>
                <td align="center" class="text"><strong>
                  <?=$result['cbc_band']?>
                </strong></td>
                <td class="text">&nbsp;</td>
                <td class="text">&nbsp;</td>
              </tr>
              <tr style='line-height:12px;'>
                <td  colspan="4" valign="top" class="text3"><strong>ความเข้มข้นของเลือด</strong> :&nbsp;<span class="text"><strong>
                  <?=$result['stat_hct']?>
                  </strong>
                  <? if($result['stat_hct']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_hct']."...";?></span></td>
              </tr>
              <tr style='line-height:12px;'>
                <td  colspan="4" valign="top" class="text3"><strong>จำนวนเม็ดเลือดขาว</strong>
                 <span class="text"> <strong><?=$result['stat_wbc']?></strong>
                  <? if($result['stat_wbc']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_wbc']."...";?></span></td>
              </tr>
              <tr style='line-height:12px;'>
                <td  colspan="4" valign="top" class="text3"><strong>จำนวนเกร็ดเลือด</strong>
                  <span class="text"><?=$result['stat_pltc']?>
                  <? if($result['stat_pltc']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_pltc']."...";?></span></td>
              </tr>
              <tr>
                <td height="21" colspan="4" valign="top"><span class="text2"><strong>สรุปผลการตรวจ :</strong></span> <span class="text">
                  <strong><?=$result['stat_cbc']?></strong>
                  <? if($result['stat_cbc']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_cbc']."...";?>
                </span></td>
              </tr>
            </table></td>
          </tr>
        </table><br /></td>
    </tr>
      <tr>
        <td width="333" valign="top"><table width="302" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" >
          <tr>
            <td valign="top"><table width="100%">
              <tr style='line-height:14px;'>
                <td colspan="2" valign="top"><strong class="text" style="font-size:16px"><u>ระดับน้ำตาลในเลือด</u></strong></td>
                <td valign="top">ค่าปกติ</td>
              </tr>
              <tr style='line-height:10px;'>
                <td width="84"><strong class="text4">BS</strong></td>
                <td width="93" valign="top"><strong>
                  <?=$result['bs']?>
                </strong></td>
                <td width="105" class="text">(70-100)</td>
              </tr>
              <tr>
                <td height="21" colspan="3" valign="top"><span class="text2"><strong>สรุปผลการตรวจ</strong> :<span class="text"><strong>
                  <?=$result['stat_bs']?>
                  </strong>
                  <? if($result['stat_bs']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_bs']."...";?>
                </span></span></td>
              </tr>
            </table></td>
          </tr>
        </table>
          <table width="302" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
            <tr>
              <td valign="top"><table width="100%">
                <tr style='line-height:12px;'>
                  <td colspan="2" valign="top"><u><strong class="text" style="font-size:16px">ระดับไขมันในเลือด</strong></u></td>
                  <td valign="top">ค่าปกติ</td>
                </tr>
                <tr style='line-height:10px;'>
                  <td width="99"><strong class="text4">Cholesterol</strong></td>
                  <td width="104" valign="top"><strong>
                    <?=$result['chol']?>
                  </strong></td>
                  <td width="105" class="text">(0-200)</td>
                </tr>
                <tr style='line-height:10px;'>
                  <td><strong class="text4">Triglyceride</strong></td>
                  <td valign="top"><strong>
                    <?=$result['tg']?>
                  </strong></td>
                  <td class="text">(0-150)</td>
                </tr>
                <tr>
                  <td height="21" colspan="3" valign="top"><span class="text2"><strong>สรุปผลการตรวจ </strong>:<span class="text"><strong>
                    <?=$result['stat_chol']?>
                    </strong>
                    <? if($result['stat_chol']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_chol']."...";?>
                  </span></span></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <br />
          <table width="302" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
            <tr>
              <td valign="top"><table width="100%">
                <tr style='line-height:13px;'>
                  <td colspan="2" valign="top"><u><strong class="text" style="font-size:16px">ระดับกรดยูริคในเลือด</strong></u></td>
                  <td valign="top">ค่าปกติ</td>
                </tr>
                <tr style='line-height:10px;'>
                  <td width="99"><strong class="text4">Uric Acid</strong></td>
                  <td width="104" valign="top"><strong>
                    <?=$result['uric']?>
                  </strong></td>
                  <td width="105" class="text">(3.5-7.2)</td>
                </tr>
                <tr>
                  <td height="21" colspan="3" valign="top"><span class="text2"><strong>สรุปผลการตรวจ</strong> :<span class="text"><strong>
                    <?=$result['stat_uric']?>
                    </strong>
                    <? if($result['stat_uric']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_uric']."...";?>
                  </span></span></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        <td valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
          <tr>
            <td valign="top"><table width="100%">
              <tr style='line-height:12px;'>
                <td colspan="2" valign="top"><strong class="text" style="font-size:16px"><u>การทำงานของไต</u></strong></td>
                <td valign="top">ค่าปกติ</td>
              </tr>
              <tr style='line-height:10px;'>
                <td width="85"><strong class="text4">BUN</strong></td>
                <td width="79" valign="top"><strong>
                  <?=$result['bun']?>
                </strong></td>
                <td width="87" class="text">(5.0-25.0)</td>
              </tr>
              <tr style='line-height:10px;'>
                <td><strong class="text4">Cr</strong></td>
                <td valign="top"><strong>
                  <?=$result['cr']?>
                </strong></td>
                <td class="text">(0.7-1.6)</td>
              </tr>
              <tr>
                <td height="21" colspan="3" valign="top"><span class="text2"><strong>สรุปผลการตรวจ</strong> :<span class="text"><strong>
                  <?=$result['stat_bun']?>
                  </strong>
                  <? if($result['stat_bun']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_bun']."...";?>
                </span></span></td>
              </tr>
            </table></td>
          </tr>
        </table>
          <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
            <tr>
              <td valign="top"><table width="100%">
                <tr style='line-height:12px;'>
                  <td colspan="2" valign="top"><u><strong class="text" style="font-size:16px">การทำงานของตับ</strong></u></td>
                  <td valign="top">ค่าปกติ</td>
                </tr>
                <tr style='line-height:10px;'>
                  <td width="99"><strong class="text4">AST(SGOT)</strong></td>
                  <td width="104"><strong>
                    <?=$result['sgot']?>
                  </strong></td>
                  <td width="105" class="text3">(<?=$result['sgotrange']?>)</td>
                </tr>
                <tr style='line-height:10px;'>
                  <td><strong class="text4">ALT(SGPT)</strong></td>
                  <td><strong>
                    <?=$result['sgpt']?>
                  </strong></td>
                  <td class="text3">(<?=$result['sgptrange']?>)</td>
                </tr>
                <tr style='line-height:10px;'>
                  <td><strong class="text4">ALP(ALK)</strong></td>
                  <td><strong>
                    <?=$result['alk']?>
                  </strong></td>
                  <td class="text3">(<?=$result['alkrange']?>)</td>
                </tr>
                <tr>
                  <td colspan="3" valign="top"><span class="text2"><strong>สรุปผลการตรวจ</strong> :<span class="text"><strong>
                    <?=$result['stat_sgot']?>
                    </strong>
                    <? if($result['stat_sgot']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_sgot']."...";?>
                  </span></span></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <br />
          <? if($result['pap']!=''){?>
          <table width="271" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
            <tr>
              <td valign="top"><table width="100%">
                <tr style='line-height:12px;'>
                  <td width="308" height="18" valign="top"><u><strong class="text" style="font-size:16px">การตรวจมะเร็งปากมดลูก</strong></u></td>
                </tr>
                <tr style='line-height:10px;'>
                  <td height="21" valign="top"><span class="text2"><strong>สรุปผลการตรวจ</strong> :<strong class="text">
                    <?=$result['pap']?>
                    </strong>
                    <? if($result['pap']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_pap']."...";?>
                  </span></td>
                </tr>
              </table></td>
            </tr>
          </table><br />
          <? }?>
          
          <table width="271" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" >
            <tr>
              <td valign="top"><table width="100%">
                <tr style='line-height:12px;'>
                  <td width="308" valign="top"><u><strong class="text" style="font-size:16px">เอกซเรย์ทรวงอก (Chest X-ray)</strong></u></td>
                </tr>
                <tr>
                  <td height="21" valign="top"><span class="text2"><strong>สรุปผลการตรวจ</strong> :</span><span class="text"><strong>
                    <?=$result['cxr']?>
                    </strong>
                    <? if($result['cxr']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_cxr']."...";?>
                  </span></td>
                </tr>
              </table></td>
            </tr>
          </table>
          <?
			if($result['other1']!=""){?>
          <table width="271" border="1" cellpadding="0" cellspacing="0" >
            <tr>
              <td  valign="top"><table width="100%">
                <tr>
                  <td colspan="2" valign="top"><strong class="text" style="font-size:16px">การตรวจพิเศษอื่น ๆ </strong></td>
                </tr>
                <tr>
                  <td width="26%" valign="top" class="text3"><strong>
                    <?=$result['other1']?>
                    :</strong></td>
                  <td valign="top"><?=$result['stat_other1']?>
                    <? if($result['stat_other1']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other1']."...";?></td>
                </tr>
                <? }
	if($result['other2']!=""){?>
                <tr>
                  <td valign="top"><strong>
                    <?=$result['other2']?>
                    : </strong></td>
                  <td valign="top"><?=$result['stat_other2']?>
                    <? if($result['stat_other2']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other2']."...";?></td>
                </tr>
                <? }
	if($result['other3']!=""){?>
                <tr>
                  <td valign="top"><strong>
                    <?=$result['other3']?>
                    : </strong></td>
                  <td valign="top"><?=$result['stat_other3']?>
                    <? if($result['stat_other3']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other3']."...";?></td>
                </tr>
                <? }
	if($result['other4']!=""){?>
                <tr>
                  <td valign="top"><strong>
                    <?=$result['other4']?>
                    : </strong></td>
                  <td valign="top"><?=$result['stat_other4']?>
                    <? if($result['stat_other4']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other4']."...";?></td>
                </tr>
                <? }
	if($result['other5']!=""){?>
                <tr>
                  <td valign="top"><strong>
                    <?=$result['other5']?>
                    : </strong></td>
                  <td valign="top"><?=$result['stat_other5']?>
                    <? if($result['stat_other5']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other5']."...";?></td>
                </tr>
                <? }
	if($result['other6']!=""){?>
                <tr>
                  <td valign="top"><strong>
                    <?=$result['other6']?>
                    : </strong></td>
                  <td valign="top"><?=$result['stat_other6']?>
                    <? if($result['stat_other6']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other6']."...";?></td>
                </tr>
                <? }
	if($result['other7']!=""){?>
                <tr>
                  <td height="21" valign="top"><strong>
                    <?=$result['other7']?>
                    : </strong></td>
                  <td valign="top"><?=$result['stat_other7']?>
                    <? if($result['stat_other7']=="ผิดปกติ") echo "คำแนะนำ...".$result['reason_other7']."...";?></td>
                </tr>
                <? }?>
              </table></td>
            </tr>
        </table></td>
      </tr>
      </table>
    <table width="100%">
      <tr>
        <td height="44" colspan="2" align="center" valign="top" class="text1"><hr /><strong>สรุปผลการตรวจสุขภาพ</strong>&nbsp;<u><?=$result['summary']?></u>
        </td>
      </tr>
<tr>
  <td valign="top" ><strong class="text2">Diag</strong> :
  <span class="text2"><?=$result['diag']?></span>&nbsp;<strong class="text2"> ความคิดเห็นจากแพทย์</strong>
  <span class="text2">&nbsp;<?=$result['dx']?></span></td>
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
?>
</span>
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">พิมพ์ใบตรวจสุขภาพประจำปี</span> <br />
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
