<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
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
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
.textsub1 {	font-size: 16px;
}
-->
</style>
</head>

<body onload="document.getElementById("hn").focus();">
<div id="no_print">
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">พิมพ์ใบตรวจสุขภาพอินทราเซรามิค</span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;กรอก HN : </span>
    <input name="hn" type="text" size="10" class="tet1" id="hn">
  <input type="submit" name="ok" value="ตกลง">
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
	$result2 = mysql_fetch_array($row2);

	
	
	$select = "select * from out_result_chkup  where hn='".$result2['HN']."'";
	
	
	$row = mysql_query($select)or die (mysql_error());
	$result = mysql_fetch_array($row);
	
	$ht = $result['height']/100;
	$bmi=number_format($result['weight'] /($ht*$ht),2);
	
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result2['HN']."' and clinicalinfo ='ตรวจสุขภาพอินทราเซรามิค' ";
$query1 = mysql_query($sql1); 


?>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพอินทราเซรามิค</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่ 21 ตุลาคม 2558</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
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
&nbsp;กก. <strong>ส่วนสูง:</strong>
<?=$result['height']?>
&nbsp;ซม. <strong>BMI: </strong> <u>
<?=$bmi?> </u><strong>BP:<u>
<?=$result['bp1']?>
/
<?=$result['bp2']?>
mmHg. </u></strong><span class="text3"><strong>P: </strong> <u>
                      <?=$result['p']?> &nbsp;ครั้ง/นาที
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
  <tr>
    <td width="52%"  valign="top"><table width="100%" height="111" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
      <tr>
        <td height="33" align="center"><strong class="text" style="font-size:22px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text3">
          <tr>
            <td width="53%" align="left" bgcolor="#CCCCCC"><strong>labcode </strong></td>
            <td width="17%" align="left" bgcolor="#CCCCCC"><strong>result</strong></td>
            <td width="30%" align="center" bgcolor="#CCCCCC"><strong>normalrange</strong></td>
          </tr>
<? $sql="SELECT * FROM result1 WHERE profilecode='UA' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////

$strSQL1 = "SELECT authorisename, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'";
//echo "===>".$strSQL1."<br>";
$objQuery1 = mysql_query($strSQL1);
list($authorisename,$authorisedate)=mysql_fetch_array($objQuery1);


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		//echo $strSQL;
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
				$bloodvalue=$objResult["result"];
			}else if($objResult["labcode"]=="PROU"){
				$labmean="(โปรตีนในปัสสาวะ)";
				$provalue=$objResult["result"];
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
            <td height="27" colspan="3"><strong>ผลตรวจ :</strong>              <? if($bloodvalue=="Negative" || $provalue=="Negative"){ echo "ปกติ";}else{ echo "ผิดปกติ ควรตรวจซ้ำหรือพบแพทย์เพื่อหาสาเหตุ";}?></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top">
<? if($result['hn']!="58.128" && $result['hn']!="58.110" && $result['hn']!="58.109" && $result['hn']!="58.114" && $result['hn']!="58.115" && $result['hn']!="58.121" && $result['hn']!="58.129" && $result['hn']!="58.134"){?>  
<table width="100%" border="1" style="border-collapse:collapse; border-bottom-style:none;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:20px"><u>LAB : อื่นๆ</u></strong></td>
        </tr>
      <tr>
        <td height="52" valign="top"><table width="95%" border="0" class="text3">
<?
$sql="SELECT * FROM result1 WHERE profilecode='GLU' or profilecode='CREA' or profilecode='BUN' or profilecode='URIC' or profilecode='CHOL' or profilecode='TRIG' or  profilecode='AST' or profilecode='ALT' or profilecode='LIPID' or profilecode='ALP'";
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
			}else if($objResult["labname"]=="LDLC"){
				$labmean="(ไขมันเลว)";												
			}else if($objResult["labname"]=="SGOT(AST)"){
				$labmean="(การทำงานของตับ)";
			}else if($objResult["labname"]=="SGPT(ALT)"){
				$labmean="(การทำงานของตับ)";
			}else if($objResult["labname"]=="Alkaline phosphatase"){
				$labmean="(การทำงานของตับ)";
			}
			
if($objResult["labcode"]=='GLU'){
	if($objResult["result"]>=74 && $objResult["result"]<=106){
		$app="ระดับน้ำตาลในเลือดอยู่ในเกณฑ์ปกติ ควรตรวจซ้ำภายใน 1-3 ปี";
	}else if($objResult["result"]<74){
		$app="ระดับน้ำตาลในเลือดต่ำกว่าค่าปกติ ควรปรึกษาแพทย์และตรวจซ้ำใน 3-6 เดือน";	
	}else if($objResult["result"]>106 && $objResult["result"]<=125){
		$app="ระดับน้ำตาลในเลือดสูงเกินค่าปกติ มีความเสี่ยงสูงต่อการเกิดเบาหวานในอนาคต ควรเริ่มต้นควบคุมอาหารจำพวกข้าว,แป้ง อาหารที่มีรสชาติหวานและตรวจซ้ำใน 1-2 ปี ";
	}else if($objResult["result"]>125){
		$app="อาจเป็นโรคเบาหวาน ควรพบแพทย์เพื่อประเมินและให้การรักษา";	
	}
}

if($objResult["labcode"]=='BUN'){
	if($objResult["result"]>18){
		$app="การทำงานของไตสูงกว่าปกติ ควรพบแพทย์ เพื่อรับการประเมินและการรักษา";	
	}else if($objResult["result"]>=7 && $objResult["result"]<=18){
		$app="การทำงานของไตอยู่ในระดับที่ปกติ ควรติดตามซ้ำทุก1ปี";	
	}else if($objResult["result"]<7 ){
		$app="การทำงานของไตต่ำกว่าปกติ ควรพบแพทย์ เพื่อรับการประเมินและการรักษา";	
	}
	
}

if($objResult["labcode"]=='CREA'){
	if($objResult["result"]>1.3){
		$app="การทำงานของไตสูงกว่าปกติ ควรพบแพทย์ เพื่อรับการประเมินและการรักษา";	
	}else if($objResult["result"]>=0.6 && $objResult["result"]<=1.3){
		$app="การทำงานของไตอยู่ในระดับที่ปกติ ควรติดตามซ้ำทุก1ปี";	
	}else if($objResult["result"]<0.6){
		$app="การทำงานของไตต่ำกว่าปกติ ควรพบแพทย์ เพื่อรับการประเมินและการรักษา";	
	}
}

if($objResult["labcode"]=='URIC'){
	if($objResult["result"]>7.2){
		$app="ระดับกรดยูริคสูงกว่าปกติ ควรพบแพทย์ เพื่อรับการประเมินและการรักษา";	
	}else if($objResult["result"] >=2.6 && $objResult["result"] <=7.2){
		$app="ระดับกรดยูริคอยู่ในระดับที่ปกติ ควรตรวจซ้ำทุก1ปี";	
	}else if($objResult["result"]<2.6){
		$app="ระดับกรดยูริคต่ำกว่าปกติ ควรพบแพทย์ เพื่อรับการประเมินและการรักษา";	
	}
}


if($objResult["labcode"]=='CHOL'){
	if($objResult["result"]<=200){
		$app="ระดับไขมันในเลือดอยู่ระดับปกติ ควรติดตามซ้ำทุก1ปี";	
	}else	if($objResult["result"]>200){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติเล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกายและตรวจซ้ำใน 3-6 เดือน";	
	}else	if($objResult["result"]>300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก สมควรพบแพทย์เพื่อรับการประเมินและให้การรักษา";	
	}
}

if($objResult["labcode"]=='TRIG'){
	if($objResult["result"]>=30 && $objResult["result"]<=150){
		$app="ระดับไขมันในเลือดอยู่ระดับปกติ ควรติดตามซ้ำทุก1ปี";	
	}else	if($objResult["result"]>150 && $objResult["result"]<250){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกายและตรวจซ้ำใน 3-6 เดือน";	
	}else	if($objResult["result"]>250){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรควบคุมอาหารกลุ่มไขมัน ควรพบแพทย์เพื่อทำการรักษา";	
	}else	if($objResult["result"]<30){
		$app="ระดับไขมันในเลือดมีค่าต่ำผิดปกติ";	
	}
}

if($objResult["labcode"]=='HDL'){
	if($objResult["result"]>=30 && $objResult["result"]<=75){
		$app="ระดับไขมันในเลือดอยู่ระดับปกติ";	
	}else	if($objResult["result"]>75){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกายและตรวจซ้ำใน 3-6 เดือน";	
	}else	if($objResult["result"]<30){
		$app="ระดับไขมันในเลือดมีค่าต่ำผิดปกติ";	
	}
}

if($objResult["labcode"]=='10001'){
	if($objResult["result"]>=0 && $objResult["result"]<=137){
		$app="ระดับไขมันในเลือดอยู่ระดับปกติ";	
	}else	if($objResult["result"]>137){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกายและตรวจซ้ำใน 3-6 เดือน";	
	}
}

if($objResult["labcode"]=='AST'){  //SGOT
	if($objResult["result"]>=15 && $objResult["result"]<=37){
		$app="การทำงานของตับปกติ";	
	}else	if($objResult["result"]>37){
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}else	if($objResult["result"]<15){
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}
}
if($objResult["labcode"]=='ALT'){  //SGPT
	if($objResult["result"]>=0 && $objResult["result"]<=50){
		$app="การทำงานของตับปกติ";		
	}else{
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}
}

if($objResult["labcode"]=='ALP'){  //ALK
	if($objResult["result"]>=46 && $objResult["result"]<=116){
		$app="การทำงานของตับปกติ";	
	}else	if($objResult["result"]>116){
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}else	if($objResult["result"]<46){
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}
}
		?>
          <tr>
            <td width="30%"><?=$objResult["labname"]." ".$labmean;?></td>
            <td width="7%"><? if($objResult["flag"]!="N"){ echo "<strong>".$objResult["result"]."</strong>";}else{ echo $objResult["result"];}?></td>
            <td width="7%"><?=$objResult["normalrange"];?></td>
            <td width="56%" style="font-size:12px;"><?=$app;?></td>
            </tr>
          <? 
		  } 
		}
	?>
          </table>      
          </td>
        </tr>
      </table>
 	<? } ?>    
         <?
		$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$result2['HN']."' and row_id between 3981 and 4262";
		//echo $sqlchk;
		$querychk=mysql_query($sqlchk) or die (mysql_error());
		$arrnum=mysql_num_rows($querychk);
		$arr=mysql_fetch_array($querychk);	
		if($arrnum > 0){
		?>       
      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none">
        <tr>  
          <td><strong class="text" style="font-size:18px"><u>X-RAY</u>&nbsp;&nbsp;&nbsp;&nbsp;</u>CXR : <strong><? if($arr["cxr"]==""){ echo "NORMAL (ปกติ)"; }else{ echo "ผิดปกติ...".$arr["cxr"]; } ?> </strong></u></strong></td>
        </tr>
<!--        <tr>
          <td><strong class="text" style="font-size:18px">สรุปผลการตรวจ/คำแนะนำของแพทย์ : </strong><span class="text" style="font-size:16px;"><?$arr["doctor_result"];?></span></td>
        </tr>-->
    </table>
    <?
	}
	?>
    </td>
  </tr>
</table>
<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center"><strong>Authorise  LAB : </strong><?=$authorisename?> <strong> (<?=$authorisedate?>) <span><strong> CXR : </strong>ร.ท.วริทธิ์ พสุธาดล (ว.38228) รังสีแพทย์<strong> (15-11-2015)</strong></span></strong><strong> Doctor : พ.ต.เลอปรัชญ์ มังกรกนกพงศ์ (ว.32166) (20-11-2015)</strong></td>
    
  </tr>
</table>
<? } ?>
</body>
</html>