<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>พิมพ์ใบตรวจสุขภาพสำนักงานทรัพย์สินส่วนพระมหากษัตริย์</title>
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
	font-size: 16px;
}
.text4 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
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
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
</head>

<body onload="document.getElementById("hn").focus();">
<div id="no_print">
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">พิมพ์ใบตรวจสุขภาพสำนักงานทรัพย์สินส่วนพระมหากษัตริย์</span><br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;กรอก HN : </span>
    <input name="hn" type="text" size="10" class="tet1" id="hn">
   &nbsp; 
   <input type="submit" name="ok" value="  ตกลง  " class="pdxhead"/>
  <br />
  <br />
  
</center>
</form>
</div>
<? 
if(isset($_POST['hn'])){
	
	?>
    <script>
	window.print() 
	</script>
    <?
	
	include("connect.inc");


		
	$select2 = "select * from opcardchk  where HN='".$_POST['hn']."' ";
	$row2 = mysql_query($select2)or die (mysql_error());
	$Row=mysql_num_rows($row2);
	if($Row < 1){
	$select2 = "select * from opcard  where hn='".$_POST['hn']."' ";
	$row2 = mysql_query($select2)or die (mysql_error());	
	}	
	$result2 = mysql_fetch_array($row2);
	$result2['HN']=$result2['hn'];
	
	
	$select = "select * from out_result_chkup  where hn='".$result2['HN']."' and year_chk = '58'";
	$row = mysql_query($select)or die (mysql_error());	
	$result = mysql_fetch_array($row);
	
	$ht = $result['height']/100;
	$bmi=number_format($result['weight'] /($ht*$ht),2);
	
	//and clinicalinfo ='ตรวจสุขภาพตำรวจ' 
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result2['HN']."' and clinicalinfo ='ตรวจสุขภาพประจำปี58' and orderdate like '2015-10-28%' ";
$query1 = mysql_query($sql1); 


?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพสำนักงานทรัพย์สินส่วนพระมหากษัตริย์</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่ 28 ตุลาคม 2558</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%"   class="text1" >
                <tr>
                  <td  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>ข้อมูลผู้ตรวจสุขภาพ </u></strong> <strong>&nbsp;&nbsp;&nbsp;HN : <?=$result['hn']?> 
                    &nbsp;&nbsp;</strong><strong>ชื่อ :</strong> <span style="font-size:24px"><strong>
                    <?=$result['ptname']?>
                    </strong></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วัน/เดือน/ปี เกิด</strong>
                    <?=$result2['dbirth']?></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%"  class="text1" >
                <tr>
                  <td width="588" valign="top"><strong class="text" style="font-size:20px"><u>ตรวจร่างกายทั่วไป</u></strong>&nbsp;&nbsp;<span class="text3"><strong>น้ำหนัก: </strong>
                      <?=$result['weight']?>
กก. <strong>ส่วนสูง:</strong>
<?=$result['height']?>
ซม. <strong>BMI: </strong> <u>
<?=$bmi?> </u><strong>BP:<u>
<?=$result['bp1']?>
/
<?=$result['bp2']?>
mmHg. </u></strong><span class="text3"><strong>P: </strong> <u>
                      <?=$result['pause']?> ครั้ง/นาที

                  </u></span></span></td>
                </tr>
                <tr>
                  <td valign="top"><strong style="font-size:20px;">ผลตรวจ : </strong><span style="font-size:16px;"> ดัชนีมวลกาย 
				  <?  if($bmi == '0.00' ){
				  			echo "'ไม่ได้รับการตรวจ";
						}
						 else if($bmi >= 18.5 && $bmi <= 22.99){
				  			
							echo "มีน้ำหนักตามเกณฑ์";
							
						}else{
							if($bmi < 18.5){ echo "มีน้ำหนักต่ำกว่าเกณฑ์";}
							if($bmi >= 23 && $bmi <= 24.99){ echo "เริ่มมีน้ำหนักเกินเกณฑ์";}
							if($bmi >= 25 && $bmi <= 29.99){ echo "มีน้ำหนักเกินเกณฑ์";}
							if($bmi >= 30 && $bmi <= 34.99){ echo "มีภาวะอ้วนค่อนข้างมาก";}
							if($bmi >= 35){ echo "มีภาวะอ้วนมาก";}
						}

				 ?>
				/ ความดันโลหิต  
                  <? if($result["bp1"] =='NO'){
							echo "ไม่ได้รับการตรวจ";
						}else  if($result["bp1"] <= 130){
							echo "ปกติ";
						}else{
							if($result["bp1"] >=140){ 
								echo "มีความดันโลหิตสูง ควรต้องควบคุมอาหารอย่างเคร่งครัด โดยเฉพาะอาหารที่มีรสเค็มและออกกำลังกาย";
							}else if($result["bp1"] >=131 && $result["bp1"] < 140){
								echo "เริ่มมีภาวะความดันโลหิตสูง ควรตรวจซ้ำหรือออกกำลังกายอย่างสม่ำเสมอ";
							}
						}
				  ?>
				  </span>
                  </td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="50%"  valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="text3" style="border-collapse:collapse;">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>CBC : การตรวจเม็ดเลือด</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
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
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
 <?
 		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode != 'ATYP' && labcode !='BAND' && labcode !='OTHER' && labcode !='NRBC') ";
		//echo "---->".$strSQL;
		$objQuery = mysql_query($strSQL);
 ?>         
          <tr>
            <td height="19" colspan="3"><strong>ผลตรวจ :</strong> <? while($objResult = mysql_fetch_array($objQuery)){
																			 if($objResult["labcode"]=="WBC"){
																						if($objResult["result"] >= 5.0 && $objResult["result"] <= 10.0){
																							$chkwbc = "ปกติ";
																						}else{
																							if($objResult["result"] < 5.0){
																								$chkwbc = "ผิดปกติ มีระดับเม็ดเลือดขาวต่ำกว่าปกติ ควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ";
																							}else if($objResult["result"] > 10.0){
																								$chkwbc = "ผิดปกติ มีระดับเม็ดเลือดขาวสูงกว่าปกติ ควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ";
																							}
																						}
																					}
																					
																					if($objResult["labcode"]=="HCT"){
																						if($objResult["result"] >= 35 && $objResult["result"] <= 51){
																							$chkhct = "ปกติ";
																						}else{
																							if($objResult["result"] < 35){
																								$chkhct = "ผิดปกติ มีระดับเม็ดเลือดแดงต่ำกว่าปกติ บ่งบอกถึงภาวะซีดควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ";
																							}else if($objResult["result"] > 51){
																								$chkhct = "ผิดปกติ มีระดับเม็ดเลือดแดงสูงกว่าปกติ ควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ";
																							}
																						}
																					}
																					
																					if($objResult["labcode"]=="PLTC"){
																						if($objResult["result"] >= 140 && $objResult["result"] <= 400){
																							$chkpltc = "ปกติ";
																						}else{
																							if($objResult["result"] < 140){
																								$chkpltc = "ผิดปกติ ปริมาณเกร็ดเลือดมีค่าต่ำกว่าปกติ ควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ";
																							}else if($objResult["result"] > 400){
																								$chkpltc = "ผิดปกติ ปริมาณเกร็ดเลือดมีค่าสูงเกินปกติ ควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ";
																							}
																						}
																					}
																	
																			
																			 if($objResult["labcode"]=="EOS"){
																						if($objResult["result"] >= 0 && $objResult["result"] <= 5.0){
																							$chkeos = "ปกติ";
																						}else{
																							if($objResult["result"] > 5.0){
																								$chkeos = "ผิดปกติ EOS สูง ควรตรวจซ้ำ/พบแพทย์";
																							}
																						}
																					}
																					
			}
			
		
			
	if($chkwbc=="ปกติ" && $chkhct=="ปกติ" && $chkpltc=="ปกติ"&& $chkeos=="ปกติ"){	
	
		if($objResult['flag']=='L' || $objResult['flag']=='H'){
			   echo "ควรตรวจซ้ำหรือพบแพทย์";			}else{																																		
																						echo "ปกติ";		}
																				
																				
																				}
																				
																				
																				else{
																						if($chkwbc=="ปกติ"){
																							echo "";
																						}else{
																							echo $chkwbc.", ";
																						}
																						
																						if($chkhct=="ปกติ"){
																							echo "";
																						}else{
																							echo $chkhct.", ";
																						}
																						
																						if($chkpltc=="ปกติ"){
																							echo "";
																						}else{
																							echo $chkpltc;
																						}	
																						if($chkeos=="ปกติ"){
																							echo "";
																						}else{
																							echo $chkeos;
																						}																						
																				}
																				
																			
																		?>
				</td>
            </tr>
        </table></td>
        
      </tr>
    </table>
    </td>
    <td width="50%"  valign="top"><table width="100%" border="1" style="border-collapse:collapse" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text3">
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
            <td height="27" colspan="3"><strong>ผลตรวจ :</strong> <? if($result['hn']=="52-5762"){ echo "ผิดปกติ ควรพบแพทย์เพื่อตรวจซ้ำหรือรับการรักษา";}else{ echo "ปกติ";}?></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><table width="100%" border="1" style="border-collapse:collapse; border-bottom-style:none;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:20px"><u>LAB : อื่นๆ</u></strong></td>
        </tr>
      <tr>
        <td height="52" valign="top"><table width="95%" border="0" cellpadding="0" cellspacing="0" class="text3">
  <? /*$sql="SELECT * FROM result1 WHERE profilecode='METAMP'";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////
		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		$objResult = mysql_fetch_array($objQuery);

$sql1="SELECT * FROM result1 WHERE profilecode='VDRL'";
	$query1 = mysql_query($sql1);
	$arrresult1 = mysql_fetch_array($query1);
/////
		$strSQL1 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult1['autonumber']."' ";
		$objQuery1 = mysql_query($strSQL1);
		$objResult1= mysql_fetch_array($objQuery1);

$sql2="SELECT * FROM result1 WHERE profilecode='HIV'";
	$query2 = mysql_query($sql1);
	$arrresult2 = mysql_fetch_array($query1);
/////
		$strSQL2 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult2['autonumber']."' ";
		$objQuery2 = mysql_query($strSQL2);*/
?>
<?
$sql="SELECT * FROM result1 WHERE profilecode='GLU' or profilecode='CREA' or profilecode='BUN' or profilecode='URIC' or profilecode='CHOL' or profilecode='TRIG' or  profilecode='HDL' or  profilecode='LDL' or  profilecode='AST' or profilecode='ALT' or profilecode='LIPID' or profilecode='ALP' or profilecode='ANTIHB' or profilecode='HBSAG' or profilecode='HIV'";
$query = mysql_query($sql);
while($arrresult = mysql_fetch_array($query)){
		

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";

$objQuery = mysql_query($strSQL);

while($objResult = mysql_fetch_array($objQuery)){
			if($objResult["labname"]=="Blood Sugar"){
				$labmean="(ระดับน้ำตาลในเลือด)";
					}else if($objResult["labname"]=="BUN"){
				$labmean="(การทำงานของไต)";
			}else if($objResult["labname"]=="Creatinine"){
				$labmean="(การทำงานของไต)";
			}else if($objResult["labname"]=="Uric acid"){
				$labmean="(ยูริคในเลือด)";
			}else if($objResult["labname"]=="Cholesterol"){
				$labmean="(ไขมันในเลือด)";
			}else if($objResult["labname"]=="Triglyceride"){
				$labmean="(ไขมันในเลือด)";
			}else if($objResult["labname"]=="HDL"){
				$labmean="(ไขมันดี)";	
			}else if($objResult["labname"]=="LDL"){
				$labmean="(ไขมันเลว)";																		
			}else if($objResult["labname"]=="SGOT(AST)"){
				$labmean="(การทำงานของตับ)";
			}else if($objResult["labname"]=="SGPT(ALT)"){
				$labmean="(การทำงานของตับ)";
			}else if($objResult["labname"]=="Alkaline phosphatase"){
				$labmean="(การทำงานของตับ)";
			}else if($objResult["labname"]=="Anti-HBs"){
				$labmean="(เชื้อไวรัสตับอักเสบบี)";
			}else if($objResult["labname"]=="HBsAg"){
				$labmean="(เชื้อไวรัสตับอักเสบบี)";
			}else if($objResult["labname"]=="HIV Ab screening"){
				$labmean="(เชื้อไวรัสเอดส์)";
			}
			

$authorisename = $objResult["authorisename"];
$authorisedate  = $objResult["authorisedate2"];


if($objResult["labcode"]=='GLU'){
	if($objResult["result"]<110){
		$app="ระดับน้ำตาลในเลือดอยู่ในเกณฑ์ปกติ ควรตรวจซ้ำภายใน 1-3 ปี";
	}else if($objResult["result"]>=110 && $objResult["result"]<=125){
		$app="ระดับน้ำตาลในเลือดสูงเกินค่าปกติ มีความเสี่ยงสูงต่อการเกิดเบาหวานในอนาคต ควรเริ่มต้นควบคุมอาหารจำพวกข้าว,แป้ง อาหารที่มีรสชาติหวานและตรวจซ้ำใน 1-2 ปี ";
	}else if($objResult["result"]>=126){
		$app="อาจเป็นโรคเบาหวาน ควรพบแพทย์เพื่อประเมินและให้การรักษา";	
	}
}

if($objResult["labcode"]=='BUN'){
	if($objResult["result"]>21){
		$app="การทำงานของไตสูงกว่าปกติ ควรพบแพทย์ เพื่อรับการประเมินและการรักษา";	
	}else if($objResult["result"]<=21 ){
		$app="การทำงานของไตอยู่ในระดับที่ปกติ ควรติดตามซ้ำทุก1ปี";	
	
	}
}

if($objResult["labcode"]=='CREA'){
	if($objResult["result"]>1.4){
		$app="การทำงานของไตสูงกว่าปกติ ควรพบแพทย์ เพื่อรับการประเมินและการรักษา";	
	}else if($objResult["result"]<=1.4){
		$app="การทำงานของไตอยู่ในระดับที่ปกติ ควรติดตามซ้ำทุก1ปี";	
	}
}

if($objResult["labcode"]=='URIC'){
	if($objResult["result"]>7.0){
		$app="ระดับกรดยูริคสูงกว่าปกติ ควรพบแพทย์ เพื่อรับการประเมินและการรักษา";	
	}else if($objResult["result"]<=7.0){
		$app="ระดับกรดยูริคอยู่ในระดับที่ปกติ ควรตรวจซ้ำทุก1ปี";	
	}
}


if($objResult["labcode"]=='CHOL'){
	if($objResult["result"]<=200){
		$app="ระดับไขมันในเลือดอยู่ระดับปกติ ควรติดตามซ้ำทุก1ปี";	
	}else	if($objResult["result"]>200 && $objResult["result"]<300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติเล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกายและตรวจซ้ำใน 3-6 เดือน";	
	}else	if($objResult["result"]>300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก สมควรพบแพทย์เพื่อรับการประเมินและให้การรักษา";	
	}
}

if($objResult["labcode"]=='TRIG'){
	if($objResult["result"]>=30 && $objResult["result"]<=135){
		$app="ระดับไขมันในเลือดอยู่ระดับปกติ ควรติดตามซ้ำทุก1ปี";	
	}else	if($objResult["result"]>135 && $objResult["result"]<300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกายและตรวจซ้ำใน 3-6 เดือน";	
	}else	if($objResult["result"]>300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}else	if($objResult["result"]<30){
		$app="ระดับไขมันในเลือดมีค่าต่ำผิดปกติ";	
	}
}

if($objResult["labcode"]=='HDL'){
	if($objResult["result"]>=30 && $objResult["result"]<=75){
		$app="ระดับไขมันในเลือดอยู่ระดับปกติ";	
	}else	if($objResult["result"]>135 && $objResult["result"]<300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกายและตรวจซ้ำใน 3-6 เดือน";	
	}else	if($objResult["result"]>300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";			
	}else	if($objResult["result"]<30){
		$app="ระดับไขมันในเลือดมีค่าต่ำผิดปกติ";	
	}
}

if($objResult["labcode"]=='LDL'){
	if($objResult["result"]>=0 && $objResult["result"]<=137){
		$app="ระดับไขมันในเลือดอยู่ระดับปกติ";	
	}else	if($objResult["result"]>137 && $objResult["result"]<300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกายและตรวจซ้ำใน 3-6 เดือน";	
	}else	if($objResult["result"]>300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";			
	}
}

if($objResult["labcode"]=='10001'){
	if($objResult["result"]>=0 && $objResult["result"]<=137){
		$app="ระดับไขมันในเลือดอยู่ระดับปกติ";	
	}else	if($objResult["result"]>137 && $objResult["result"]<300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกายและตรวจซ้ำใน 3-6 เดือน";	
	}else	if($objResult["result"]>300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";			
	}
}

if($objResult["labcode"]=='AST'){
	if($objResult["result"]>=0 && $objResult["result"]<=40){
		$app="การทำงานของตับปกติ";		
	}else{
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}
}
if($objResult["labcode"]=='ALT'){
	if($objResult["result"]>=0 && $objResult["result"]<=50){
		$app="การทำงานของตับปกติ";		
	}else{
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}
}

if($objResult["labcode"]=='ALP'){
	if($objResult["result"]>=34 && $objResult["result"]<=123){
		$app="การทำงานของตับปกติ";	
	}else	if($objResult["result"]>123){
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}else	if($objResult["result"]<34){
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}
}

if($objResult["labcode"]=='ANTIHB'){
	if($objResult["result"]=="Positive"){
		$app="ผิดปกติ ควรพบแพทย์เพื่อตรวจซ้ำหรือรับการรักษา";		
	}else if($objResult["result"]=="Negative"){
		$app="ปกติ";
	}else{
		$app="";
	}
}

if($objResult["labcode"]=='HBSAG'){
	if($objResult["result"]=="Positive"){
		$app="ผิดปกติ ควรพบแพทย์เพื่อตรวจซ้ำหรือรับการรักษา";		
	}else if($objResult["result"]=="Negative"){
		$app="ปกติ";
	}else{
		$app="";
	}
}

if($objResult["labcode"]=='HIV'){
	if($objResult["result"]=="Positive"){
		$app="ผิดปกติ ควรพบแพทย์เพื่อตรวจซ้ำหรือรับการรักษา";		
	}else if($objResult["result"]=="Negative"){
		$app="ปกติ";
	}else{
		$app="";
	}
}

			if($objResult['flag']=='L' || $objResult['flag']=='H'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}

		if($objResult["labcode"]=='ANTIHB' || $objResult["labcode"]=='HBSAG' || $objResult["labcode"]=='HIV'){					
		?>
          <tr>
            <td width="37%"><?=$objResult["labname"]." ".$labmean;?></td>
            <td colspan="2" width="6%"><?=$objResult["result"];?></td>
            <td width="49%" style="font-size:12px;"><?=$app;?></td>
            </tr>
          <? 
		  }else{
		  ?>
          <tr>
            <td width="37%"><?=$objResult["labname"]." ".$labmean;?></td>
            <td width="6%"><?=$objResult["result"];?></td>
            <td width="8%"><?=$objResult["normalrange"];?></td>
            <td width="49%" style="font-size:12px;"><?=$app;?></td>
            </tr>		  
          <?
		  }  // close if labcode antihb hbsag hiv 
		  } 
		}
	?> 
           <tr>
            <td width="37%">ตรวจสมรรถนะการมองเห็น</td>
            <td width="6%">ปกติ</td>
            <td width="8%"></td>
            <td width="49%" style="font-size:12px;">ปกติ</td>
            </tr>	     
<?
$outsql="SELECT * FROM `out_result_chkup` WHERE hn='".$result2['HN']."' and year_chk='58'";
//echo $sqlchk;
$outquery=mysql_query($outsql) or die (mysql_error());
$outarr=mysql_fetch_array($outquery);
?>    
<?
if(!empty($outarr["afp"])){
	if($outarr["afp"] <= 12 || $outarr["afp"]=="ปกติ"){
		$comment="ปกติ";
	}else{
		$comment="ผิดปกติ ควรพบแพทย์เพื่อตรวจซ้ำหรือรับการรักษา";
	}
	echo "<tr>
				<td>สารชี้บ่งมะเร็งตับ</td>
				<td>$outarr[afp]</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$comment</td>
		   </tr>";
}

if(!empty($outarr["cea"])){
	if($outarr["cea"] <= 4.7 || $outarr["cea"]=="ปกติ"){
		$comment="ปกติ";
	}else{
		$comment="ผิดปกติ ควรพบแพทย์เพื่อตรวจซ้ำหรือรับการรักษา";
	}
	echo "<tr>
				<td>CEA (สารชี้บ่งมะเร็งลำไส้)</td>
				<td>$outarr[cea]</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$comment</td>
		   </tr>";
}

if(!empty($outarr["psa"])){
	if($outarr["psa"] <= 4 || $outarr["psa"]=="ปกติ"){
		$comment="ปกติ";
	}else{
		$comment="ผิดปกติ ควรพบแพทย์เพื่อตรวจซ้ำหรือรับการรักษา";
	}
	echo "<tr>
				<td>PSA (สารชี้บ่งมะเร็งต่อมลูกหมาก)</td>
				<td>$outarr[psa]</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$comment</td>
		   </tr>";
}

if(!empty($outarr["ca125"])){
	if($outarr["ca125"] <= 35 || $outarr["ca125"]=="ปกติ"){
		$comment="ปกติ";
	}else{
		$comment="ผิดปกติ ควรพบแพทย์เพื่อตรวจซ้ำหรือรับการรักษา";
	}
	echo "<tr>
				<td>CA125 (สารชี้บ่งมะเร็งรังไข่)</td>
				<td>$outarr[ca125]</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$comment</td>
		   </tr>";
}

if(!empty($outarr["testolerone"])){
	if(($outarr["testolerone"] >= 2.8 && $outarr["testolerone"] <= 8) || $outarr["testolerone"]=="ปกติ"){
		$comment="ปกติ";
	}else{
		$comment="ผิดปกติ ควรพบแพทย์เพื่อตรวจซ้ำหรือรับการรักษา";
	}
	echo "<tr>
				<td>Testolerone (ระดับฮอร์โมนเพศชาย)</td>
				<td>$outarr[testolerone]</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$comment</td>
		   </tr>";
}

if(!empty($outarr["estradiol"])){
	if(($outarr["estradiol"] >= 13.5 && $outarr["estradiol"] <= 59) || $outarr["estradiol"]=="ปกติ"){
		$comment="ปกติ";
	}else{
		$comment="ผิดปกติ ควรพบแพทย์เพื่อตรวจซ้ำหรือรับการรักษา";
	}
	echo "<tr>
				<td>Estradiol (ระดับฮอร์โมนเพศหญิง)</td>
				<td>$outarr[estradiol]</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$comment</td>
		   </tr>";
}

if(!empty($outarr["hpv"])){
	echo "<tr>
				<td>PAP SMEAR (มะเร็งปากมดลูก)</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$outarr[hpv]</td>
		   </tr>";
}

if(!empty($outarr["mammogram"])){
	echo "<tr>
				<td>แมมโมแกรมและอัลตราซาวด์ (เต้านม)</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$outarr[mammogram]</td>
		   </tr>";
}

if(!empty($outarr["ekg"])){
	echo "<tr>
				<td>(EKG) ตรวจคลื่นไฟฟ้าหัวใจ</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$outarr[ekg]</td>
		   </tr>";
}

if(!empty($outarr["cxrdigit"])){
	echo "<tr>
				<td>เอ็กเรย์ปอดละทรวงอกแบบดิจิตอล</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$outarr[cxrdigit]</td>
		   </tr>";
}

if(!empty($outarr["altra"])){
	echo "<tr>
				<td>อัลตร้าซาวด์ช่องท้องส่วนบน</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$outarr[altra]</td>
		   </tr>";
}

if(!empty($outarr["altradown"])){
	echo "<tr>
				<td>อัลตร้าซาวด์ช่องท้องส่วนล่าง</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style='font-size:12px;'>$outarr[altradown]</td>
		   </tr>";
}
?>       
          </table>          </td>
        </tr>
      </table>
      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none">
        <tr>
        <?
		$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$result2['HN']."'";
		//echo $sqlchk;
		$querychk=mysql_query($sqlchk) or die (mysql_error());
		$arr=mysql_fetch_array($querychk);	
		?>      
          <td><strong class="text" style="font-size:18px"><u>X-RAY</u>&nbsp;&nbsp;&nbsp;&nbsp;</u>CXR : <strong><? if($arr["cxr"]==""){ echo "NORMAL (ปกติ)"; }else{ echo $arr["cxr"]; } ?> </strong></u></strong></td>
        </tr>
    </table></td>
  </tr>
</table>
<? 
/*$sql = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
$result2= mysql_query($sql);
$arr2 = mysql_fetch_assoc($result2);	
$authorisename = $arr2["authorisename"];
$authorisedate  = $arr2["authorisedate2"];*/
?>
<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center"><strong>Authorise  LAB:</strong><?=$authorisename?> <strong> (<?=$authorisedate?>) </strong><strong> <span><strong> CXR : </strong>ร.ท.วริทธิ์ พสุธาดล (ว.38228) รังสีแพทย์<strong> (28-10-2015)</strong></span></strong><strong> Doctor : พ.ท.เลอปรัชญ์ มังกรกนกพงศ์ (ว.32166) (28-10-2015)</strong></td>
    
  </tr>
</table>
<? } ?>
</body>
</html>