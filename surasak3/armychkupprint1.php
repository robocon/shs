<?
session_start();
if (isset($sIdname)){} else {die;} //for security
include("connect.inc");

$row_id=$_GET["id"];
$yearchkup=$_GET["chkyear"];
$nPrefix2="25".$yearchkup;
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
.text211 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.textsub {
	font-size: 15px;
}
.text31 {	font-family: "TH SarabunPSK";
	font-size: 16px;
	}
.text311 {	font-family: "TH SarabunPSK";
	font-size: 13px;
}
-->
</style>
<?
$select = "select * from armychkup where row_id='".$row_id."'";
$row = mysql_query($select);
$result = mysql_fetch_array($row);

$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result['hn']."' and clinicalinfo ='ตรวจสุขภาพประจำปี$chkyear' ";
$query1 = mysql_query($sql1); 
?>
<table width="100%">
<tr>
  <td colspan="2">
<table width="100%">
<tr>
  <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" width="87" height="83" /></td>
  <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพประจำปี <?=$nPrefix2;?></strong></td>
  <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
  <td align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่ 
  <?
  $da = explode(" ",$result["registerdate"]);
  $daten = explode("-",$da[0]);
  ?>
    <?=$daten[2]?>/<?=$daten[1]?>/<?=$daten[0]+543;?>&nbsp;<?=$da[1]?>
  </span></span></span></td>
  <td align="center" valign="top" class="text3">&nbsp;</td>
</tr>
</table></td></tr>
<tr>
  <td colspan="2" valign="top">
  <table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" width="100%" >
  <tr><td>
  <table width="100%" class="text1"><tr><td width="14%" valign="top" class="text2"><strong>HN :</strong>    <?=$result['hn']?></td>
  <td colspan="2" valign="top" class="text2"><strong>ชื่อ :</strong>    <span style="font-size:20px"><strong><?=$result['yot']." ".$result['ptname']?></strong></span></td>
  <td width="18%" valign="top" class="text2"><strong>อายุ :</strong>
    <?=$result['age']?></td>
  <td colspan="2" valign="top" class="text2"><span class="text3"><strong>สังกัด : </strong> <span style="font-size:18px"><strong>
  <?= substr($result['camp'],4)?>
  </strong></span></span></td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>น้ำหนัก: </strong>
      <?=$result['weight']?>
      กก.</span></td>
  <td width="18%" valign="top"><span class="text3"><strong>ส่วนสูง:</strong>
      <?=$result['height']?>
ซม.</span></td>
  <td width="12%" valign="top"><span class="text3"><strong>BMI: </strong> <u>
    <?=$result['bmi']?>
  </u></span></td>
  <td valign="top"><span class="text3"><strong>รอบเอว:</strong>
      <?=$result['waist']?>
นิ้ว</span></td>
  <td width="22%" valign="top"><span class="text3"><strong>BP:</strong> <u>
  <?=$result['bp1']?>
mmHg.</u>
      <? if(!empty($result['bp2'])){ ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BP2:</strong> <u>
<?=$result['bp2']?>
mmHg.</u>
<? } ?>
  </span></td>
  <td width="16%" valign="top"><span class="text3"><strong>อุณหภูมิ:</strong> <u>
  <?=$result['temperature']?>
  </u> C ํ</span></td>
</tr>
<tr>
  <td valign="top"><span class="text3"><strong>ชีพจร: </strong>
      <?=$result['pulse']?>
ครั้ง/นาที</span></td>
  <td valign="top"><span class="text3"><strong>หายใจ: </strong>
      <?=$result['rate']?>
ครั้ง/นาที</span></td>
  <td valign="top"><span class="text3"><strong>บุหรี่: </strong>
      <? if($result['cigarette']=="0"){ echo "ไม่เคยสูบ";}else if($result['cigarette']=="1"){ echo "เคยสูบ แต่เลิกแล้ว";}else if($result['cigarette']=="2"){ echo "สูบเป็นครั้งคราว";}else if($result['cigarette']=="3"){ echo "สูบเป็นประจำ";}?>
  </span></td>
  <td valign="top"><span class="text3"><strong>สุรา: </strong>
      <? if($result['alcohol']=="0"){ echo "ไม่เคยดื่ม";}else if($result['alcohol']=="1"){ echo "เคยดื่ม แต่เลิกแล้ว";}else if($result['alcohol']=="2"){ echo "ดื่มเป็นครั้งคราว";}else if($result['alcohol']=="3"){ echo "ดื่มเป็นประจำ";}?>
  </span></td>
  <td colspan="2" valign="top"><span class="text3"><strong>ออกกำลังกาย: </strong>
      <? if($result['exercise']=="0"){ echo "ไม่เคยออกกำลังกาย";}else if($result['exercise']=="1"){ echo "ออกกำลังกายต่ำกว่าเกณฑ์";}else if($result['exercise']=="2"){ echo "ออกกำลังกายตามเกณฑ์";}?>
  </span></td>
  </tr>
<tr>
  <td colspan="2" valign="top"><span class="text3"><strong>ประวัติโรคประจำตัว: </strong>
      <? if($result['prawat']=="0"){ echo "ไม่มีโรคประจำตัว";}
	  		else if($result['prawat']=="1"){  echo "ความดันโลหิตสูง";}
			else if($result['prawat']=="2"){  echo "เบาหวาน";}
			else if($result['prawat']=="3"){  echo "โรคหัวใจและหลอดเลือด";}
			else if($result['prawat']=="4"){  echo "ไขมันในเลือดสูง";}
			else if($result['prawat']=="5"){  echo "โรคที่กำหนดไว้ตั้งแต่ 2 โรคขึ้นไป";}
			else if($result['prawat']=="6"){  echo "โรคประจำตัวอื่นๆ...".$result['congenital_disease'];}
			 ?>
  </span></td>
  <td colspan="2" valign="top"><span class="text3"><strong>เข้ารับการรักษาที่ : </strong>
      <? if($result['hospital']==""){ echo ""; }else if(($result['prawat']!="0" || $result['prawat']!="") && $result['hospital']==""){ echo "ไม่ได้ระบุ";}else{ echo $result['hospital'];} ?>
  </span></td>
  <td colspan="2" valign="top"><span class="text3"><strong>แพ้ยา:</strong>
      <? if($result['hospitaldrugreact']=="0" || $result['hospitaldrugreact']==""){ echo "ไม่แพ้ยา"; }else{
		$sql55 = "Select  drugreact From opcard  where hn = '".$result['hn']."' ";
		$result55 = mysql_query($sql55);
		$arr55 = mysql_fetch_array($result55);
			echo $arr55["drugreact"];
		}	
	?>
  </span></td>
</tr>
  </table></td></tr></table></td>
  </tr>
<tr class="text3">
  <td align="center" valign="top" ><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td align="center"><strong class="text" style="font-size:22px"><u>CBC : การตรวจเม็ดเลือด</u></strong></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text31">
        <tr>
          <td width="61%" align="center" bgcolor="#CCCCCC">labcode </td>
          <td width="19%" align="center" bgcolor="#CCCCCC">result</td>
          <td width="20%" align="center" bgcolor="#CCCCCC">normalrange</td>
        </tr>
        <? $sql="SELECT * FROM result1 WHERE profilecode='CBC' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode != 'ATYP' && labcode !='BAND' && labcode !='OTHER' && labcode !='NRBC') ";
		//echo "---->".$strSQL;
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			if($objResult["labcode"]=="WBC"){
				$labmean="(การตรวจนับเม็ดเลือดขาว)";
			}else if($objResult["labcode"]=="NEU"){
				$labmean="(การติดเชื้อแบคทีเรีย)";
			}else if($objResult["labcode"]=="LYMP"){
				$labmean="(การติดเชื้อไวรัส หรือมะเร็งเม็ดเลือด)";
			}else if($objResult["labcode"]=="MONO"){
				$labmean="(โรคเกี่ยวกับการแพ้ หรือมะเร็งเม็ดเลือด)";
			}else if($objResult["labcode"]=="EOS"){
				$labmean="(อาการของโรคภูมแพ้ หรือพยาธิ)";
			}else if($objResult["labcode"]=="BASO"){
				$labmean="(กลุ่มโรคมะเร็งเม็ดเลือดขาว)";
			}else if($objResult["labcode"]=="ATYP"){
				$labmean="(***)";
			}else if($objResult["labcode"]=="BAND"){
				$labmean="(***)";
			}else if($objResult["labcode"]=="OTHER"){
				$labmean="(***)";
			}else if($objResult["labcode"]=="NRBC"){
				$labmean="(***)";
			}else if($objResult["labcode"]=="RBC"){
				$labmean="(เม็ดเลือดแดง)";
			}else if($objResult["labcode"]=="HB"){
				$labmean="(การตรวจวัดความเข้มข้นของฮีโมโกลบิน)";
			}else if($objResult["labcode"]=="HCT"){
				$labmean="(การวัดเม็ดเลือดแดงอัดแน่น)";
			}else if($objResult["labcode"]=="MCV"){
				$labmean="(การวัดปริมาตรเม็ดเลือดแดงในแต่ละเม็ด)";
			}else if($objResult["labcode"]=="MCH"){
				$labmean="(น้ำหนักของฮีโมโกลบินในเม็ดเลือดแดง)";
			}else if($objResult["labcode"]=="MCHC"){
				$labmean="(ความเข้มข้นฮีโมโกลบินในเม็ดเลือดแดง)";
			}else if($objResult["labcode"]=="PLTC"){
				$labmean="(การตรวจนับเกล็ดเลือดในเลือด)";
			}else if($objResult["labcode"]=="PLTS"){
				$labmean="";
			}else if($objResult["labcode"]=="RBCMOR"){
				$labmean="(รูปร่างเม็ดเลือดแดง)";
			}
			
			
				if($objResult['flag']=='L' || $objResult['flag']=='H'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}
		?>
        <tr>
          <td><?=$objResult["labcode"]." ".$labmean;?></td>
          <td align="center"><?=$objResult["result"];?></td>
          <td align="center"><?=$objResult["normalrange"];?></td>
        </tr>
        <?  } ?>
      
        <?
 		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode != 'ATYP' && labcode !='BAND' && labcode !='OTHER' && labcode !='NRBC') ";
		//echo "---->".$strSQL;
		$objQuery = mysql_query($strSQL);
 ?>
        <tr>
          <td colspan="3"><span>ผลการตรวจ :</span><strong>
          <?=$result['cbc_lab']?>
          </strong></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <td align="center" valign="top" ><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td align="center"><strong class="text" style="font-size:22px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong></td>
    </tr>
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text311">
        <tr>
          <td width="44%" align="center" bgcolor="#CCCCCC">labcode </td>
          <td width="15%" align="center" bgcolor="#CCCCCC">result</td>
          <td width="41%" align="center" bgcolor="#CCCCCC">normalrange</td>
        </tr>
        <? $sql="SELECT * FROM result1 WHERE profilecode='UA' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			if($objResult["labcode"]=="COLOR"){
				$labmean="(สีของปัสสาวะ)";
			}else if($objResult["labcode"]=="APPEAR"){
				$labmean="(ความใส)";
			}else if($objResult["labcode"]=="SPGR"){
				$labmean="(ความถ่วงจำเพาะ)";
			}else if($objResult["labcode"]=="PHU"){
				$labmean="(ความเป็นกรด)";
			}else if($objResult["labcode"]=="BLOODU"){
				$labmean="(เลือดในปัสสาวะ)";
			}else if($objResult["labcode"]=="PROU"){
				$labmean="(โปรตีนในปัสสาวะ)";
			}else if($objResult["labcode"]=="GLUU"){
				$labmean="(น้ำตาลในปัสสาวะ)";
			}else if($objResult["labcode"]=="KETU"){
				$labmean="(คีโตนในปัสสาวะ)";
			}else if($objResult["labcode"]=="UROBIL"){
				$labmean="(การทำลายเม็ดเลือดแดงสูง)";
			}else if($objResult["labcode"]=="BILI"){
				$labmean="(บิลิรูบินในปัสสาวะ)";
			}else if($objResult["labcode"]=="NITRIT"){
				$labmean="(ไนไตรท์ในปัสสาวะ)";
			}else if($objResult["labcode"]=="WBCU"){
				$labmean="(เม็ดเลือดขาว)";
			}else if($objResult["labcode"]=="RBCU"){
				$labmean="(เม็ดเลือดแดง)";
			}else if($objResult["labcode"]=="EPIU"){
				$labmean="(เซลล์เยื่อบุ)";
			}else if($objResult["labcode"]=="BACTU"){
				$labmean="(แบคทีเรีย)";
			}else if($objResult["labcode"]=="YEAST"){
				$labmean="(ยีสต์)";
			}else if($objResult["labcode"]=="MUCOSU"){
				$labmean="";
			}else if($objResult["labcode"]=="AMOPU"){
				$labmean="";
			}else if($objResult["labcode"]=="CASTU"){
				$labmean="(แท่งโปรตีน)";
			}else if($objResult["labcode"]=="CRYSTU"){
				$labmean="(ผลึก)";
			}else if($objResult["labcode"]=="OTHERU"){
				$labmean="(อื่นๆ)";
			}
						
			if($objResult['flag']=='L' || $objResult['flag']=='H'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}
		?>
        <tr>
          <td><?=$objResult["labcode"]." ".$labmean;?></td>
          <td ><?=$objResult["result"];?></td>
          <td align="center"><?=$objResult["normalrange"];?></td>
        </tr>
        <?  } ?>
        <tr>
          <td colspan="3">ผลตรวจ : <strong>
        <?=$result['ua_lab']?></strong></td>
        </tr>
      </table></td>
    </tr>
  </table>    </tr>
<tr>
  <td colspan="2" valign="top" class="text">
  <table width="100%"  bordercolor="#FFFFFF" border="0"  cellpadding="0" cellspacing="0">  
    <tr>
      <td valign="middle" class="text3"><strong>ผลการตรวจ&nbsp;</strong></td>
      <!--<td valign="top" width="4%"  class="text3" bordercolor="#000000"><strong>2555</strong></td>-->
      <td width="10%" align="right" valign="middle" bordercolor="#000000"  class="text3"><strong>result</strong></td>
      <td width="1%" align="center" valign="middle" bordercolor="#000000"  class="text3">&nbsp;</td>
      <td valign="middle" class="text">&nbsp;</td>
      <td valign="middle" class="text">&nbsp;</td>
    </tr>
    <? if($result['glu_result']!=""){?>
    <tr>
      <td width="43%" valign="middle" class="text3"><strong>GLU(เบาหวาน) :</strong></td>
     <!-- <td width="4%" align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['bs']?>
      </strong></td>-->
        <td width="10%" align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['glu_result']?>
        </strong></td>
        <td width="1%" align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td width="18%" valign="middle" class="text"><strong>
          <?=$result['glu_lab']?>
        </strong></td>
        <td width="28%" valign="middle" class="text">&nbsp;</td>
      </tr>
      <? } 
	  if($result['chol_result']!=""){
	  ?>
      <tr>
        <td valign="middle" class="text3"><strong>CHOL(การตรวจไขมัน) :</strong></td>
        <!--<td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['chol']?>
        </strong></td>-->
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['chol_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong>
          <?=$result['chol_lab']?></strong>        </td>
        <td valign="middle" class="text">&nbsp;</td>
      </tr>
      <? } 
	  if($result['trig_result']!=""){
	  ?>
      <tr>
        <td valign="middle" class="text3"><strong>TRIG(การตรวจไขมัน) :</strong></td>
       <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['tg']?>
        </strong></td>-->
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['trig_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong>
          <?=$result['trig_lab']?>
        </strong></td>
        <td valign="middle" class="text">&nbsp;</td>
      </tr>
      
      
       <? 
	   }
	  if($result['hdl_result']!=""){
	  ?>     
      <tr>
        <td valign="middle" class="text3"><strong>HDL(การตรวจไขมันดี) :</strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['hdl_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong><strong>
          <?=$result['hdl_lab']?>
        </strong></strong></td>
        <td valign="middle" class="text">&nbsp;</td>
        </tr>

        
      <? } 
	  if($result['ldl_result']!=""){
	  ?>        
      <tr>
        <td valign="middle" class="text3"><strong>LDL(การตรวจไขมันเลว) :</strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['ldl_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong>
          <?=$result['ldl_lab']?>
        </strong></td>
        <td valign="middle" class="text">&nbsp;</td>
        </tr>
        
        
      <? } 
	  if($result['bun_result']!=""){
	  ?>
      <tr>
        <td valign="middle" class="text3"><strong>BUN(การทำงานของไต) :</strong></td>
        <!--<td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['bun']?>
        </strong></td>-->
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['bun_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong>
          <?=$result['bun_lab']?>
        </strong></td>
        <td valign="middle" class="text">&nbsp;</td>
      </tr>
      <? } 
	  if($result['crea_result']!=""){
	  ?>
      <tr>
        <td valign="middle" class="text3"><strong>CREA(การทำงานของไต) :</strong></td>
       <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
          <?//=$result5['cr']?>
        </strong></td>-->
        <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
          <?=$result['crea_result']?>
        </strong></td>
        <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
        <td valign="middle" class="text"><strong>
          <?=$result['crea_lab']?>
        </strong></td>
        <td valign="middle" class="text">&nbsp;</td>
      </tr>
      <? } 
	  if($result['alp_result']!=""){
	  ?>
    <tr>
      <td valign="middle" class="text3"><strong>ALP(ตับ,กระดูก) :</strong></td>
     <!-- <td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['alk']?>
      </strong></td>-->
      <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
        <?=$result['alp_result']?>
      </strong></td>
      <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="middle" class="text"><strong>
        <?=$result['alp_lab']?>
      </strong></td>
      <td valign="middle" class="text">&nbsp;</td>
      </tr>
      <? } 
	  if($result['alt_result']!=""){
	  ?>
    <tr>
      <td valign="middle" class="text3"><strong>ALT(การทำงานของตับ) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['sgpt']?>
      </strong></td>-->
      <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
        <?=$result['alt_result']?>
      </strong></td>
      <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="middle" class="text"><strong>
        <?=$result['alt_lab']?>
      </strong></td>
      <td valign="middle" class="text">&nbsp;</td>
    </tr>
    <? } 
	  if($result['ast_result']!=""){
	  ?>
    <tr>
      <td valign="middle" class="text3"><strong>AST(การทำงานของตับ) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['sgot']?>
      </strong></td>-->
      <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
        <?=$result['ast_result']?>
      </strong></td>
      <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="middle" class="text"><strong>
        <?=$result['ast_lab']?>
      </strong></td>
      <td valign="middle" class="text">&nbsp;</td>
    </tr>
    <? } 
	  if($result['uric_result']!=""){
	  ?>
    <tr>
      <td valign="middle" class="text3"><strong>URIC(โรคเก๊าท์) :</strong></td>
      <!--<td align="right" valign="top" bordercolor="#000000"><strong>
        <?//=$result5['uric']?>
      </strong></td>-->
      <td align="right" valign="middle" bordercolor="#000000" class="text3"><strong>
        <?=$result['uric_result']?>
      </strong></td>
      <td align="right" valign="middle" bordercolor="#000000" class="text3">&nbsp;</td>
      <td valign="middle" class="text"><strong>
        <?=$result['uric_lab']?>
      </strong></td>
      <td valign="middle" class="text">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" align="center" valign="top" style="line-height:1px;"> <hr /></td>
    </tr>
	<? }
	?>     
    <tr>
      <td valign="top" class="text3"><strong>ค่าการวัด % ใต้ผิวหนัง :</strong></td>
      <td align="right" valign="top" class="text3"><strong>
        <?=$result['fat']." %";?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
      <td align="left" valign="top"><strong>
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
			echo "ไม่มีผล";
		}
		?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="text3"><strong>ความแข็งแรงของกล้ามเนื้อด้วยวัดแรงบีบมือ :</strong></td>
      <td align="right" valign="top" class="text3"><strong>
        <?=$result['hand2']." กก./นน.";?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
      <td align="left" valign="top"><strong>
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
			echo "ไม่มีผล";
		}
		?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="text3"><strong>ความแข็งแรงของกล้ามเนื้อด้วยแรงเหยียดขา :</strong></td>
      <td align="right" valign="top" class="text3"><strong>
        <?=$result['leg2']." กก./นน.";?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
      <td align="left" valign="top"><strong>
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
			echo "ไม่มีผล";
		}
		?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top" class="text3"><strong>ความแข็งแรงของระบบทางเดินหายใจและระบบไหลเวียนโลหิต :</strong></td>
      <td align="right" class="text3"><strong>
        <?=$result['steptest3']." ครั้ง/นาที";?>
      </strong></td>
      <td align="left" class="text3">&nbsp;</td>
      <td align="left"><strong>
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
			echo "ไม่มีผล";
		}
		?>
      </strong></td>
      <td align="left" valign="top" class="text3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="6" align="center" valign="top" style="line-height:1px;"> <hr /></td>
    </tr> 
    <tr>
      <td valign="top" class="text3"><strong>CXR การตรวจเอ็กซ์เรย์ปอด :</strong></td>
      <td colspan="4" align="left" valign="top" class="text3"><strong>
        <?=$result['xray']?>
        </strong>
          <? if($result['xray']=="ผิดปกติ") echo "คำแนะนำ...".$result['xray_detail']."...";?></td>
      </tr>
    <tr>
      <td colspan="6" align="center" valign="top" style="line-height:1px;"> <hr /></td>
    </tr>        
    <tr>
      <td valign="top" class="text3" width="43%"><strong>การตรวจสุขภาพช่องปาก :</strong></td>
      <td colspan="4" align="left" valign="top" class="text3"><strong><?=$result['dental_result'];?></strong></td>
      </tr>
    <tr>
      <td valign="top" class="text3"><strong>โรคฟัน :</strong></td>
      <td colspan="4" align="left" valign="top" class="text3"><strong>
        <?
        if($result['dental_disease1']==1){
			echo "ฟันผุ ";
		}
		if($result['dental_disease2']==1){
			echo " ฟันสึก ";
		}
		if($result['dental_disease3']==1){
			echo "โรคปริทันต์อักเสบ";
		}
		?>
      </strong></td>
    </tr>
    <tr>
      <td valign="top" class="text3"><strong>โรคเหงือก :</strong></td>
      <td colspan="4" align="left" valign="top" class="text3">
        <?
        if($result['gum_disease1']==1){
			echo "โรคเหงือกอักเสบ ";
		}
		if($result['gum_disease2']==1){
			echo " ฟันคุด";
		}
		?>      </td>
    </tr>
    <tr align="left">
      <td colspan="6" valign="top" ><hr /></td>
    </tr>
    <tr>
      <td height="27" colspan="6" align="center" class="text1">
        <strong>สรุปผลการตรวจสุขภาพ : </strong>
		<?
        if($result['resultdiag_normal']=="1"){
			echo "ไม่พบความเสี่ยงต่อโรค NCDs";
		}
		if($result['resultdiag_risk']=="1"){
			echo "พบความเสี่ยงเบื้องต้นต่อโรค ";
			if($result['risk_dm']=="1"){
				echo "DM ";
			}
			if($result['risk_ht']=="1"){
				echo " HT ";
			}
			if($result['risk_stroke']=="1"){
				echo " Stroke ";
			}			
			if($result['risk_obesity']=="1"){
				echo " Obesity";
			}			
		}
		if($result['resultdiag_diseases']=="1"){
			echo " ป่วยด้วยโรคเรื้อรัง ";
			if($result['diseases_dm']=="1"){
				echo "DM ";
			}
			if($result['diseases_ht']=="1"){
				echo " HT ";
			}
			if($result['diseases_stroke']=="1"){
				echo " Stroke ";
			}			
			if($result['diseases_obesity']=="1"){
				echo " Obesity";
			}			
		}
		?>
      </td>
    </tr>    
</table>
</td>
</tr>
</table>
