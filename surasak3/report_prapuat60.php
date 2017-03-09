<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>พิมพ์ใบตรวจสุขภาพสำนักงานคุมประพฤติจังหวัดลำปาง</title>
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
@media print{
#no_print{display:none;}
}
#divprint{ 
  page-break-after:always; 
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
<form name="formdx" action="<? $_SERVER['PHP_SELF'];?>" method="post">
<center>
<span class="tet1">พิมพ์ใบตรวจสุขภาพสำนักงานคุมประพฤติจังหวัดลำปาง</span><br />
  <br />
  <input type="submit" name="ok" value="ตกลง" style="width:60px; height:40px; font:'TH SarabunPSK'; font-size:20px;">
  <br />
  <br /> 
</center>
</form>
</div>
<!--แสดงเนื้อหา-->
<? 
if(isset($_POST['ok'])){
	
	?>
<!--    <script>
	window.print() 
	</script>-->
    <?
	
	include("connect.inc");	
	$sql="SELECT  * FROM opcardchk  WHERE part='คุมประพฤติ60' and active='y' order by row";
	//echo $sql;
	$row2 = mysql_query($sql)or die ("Query Fail line 83");
	while($result2 = mysql_fetch_array($row2)){

	
	
	$select = "select * from out_result_chkup  where hn='".$result2['HN']."'";
	
	
	$row = mysql_query($select)or die ("Query Fail line 91");
	$result = mysql_fetch_array($row);
	
	$ht = $result['height']/100;
	$bmi=number_format($result['weight'] /($ht*$ht),2);
?>
<div id="divprint">
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพสำนักงานคุมประพฤติจังหวัดลำปาง</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่ 9 กุมภาพันธ์ 2560</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0">
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%"   class="text1" >
                <tr>
                  <td  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>ข้อมูลผู้ตรวจสุขภาพ</u> </strong><strong>HN : <?=$result['hn']?> 
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
                      <?=$result['p']?> ครั้ง/นาที

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
								echo "มีความดันโลหิตสูง ควรออกกำลังอย่างสม่ำเสมอ ลดอาหารที่มีรสเค็ม หรือพบแพทย์เพื่อทำการรักษา";
							}else if($result["bp1"] >=131 && $result["bp1"] < 140){
								echo "เริ่มมีภาวะความดันโลหิตสูง ควรออกกำลังกายอย่างสม่ำเสมอ";
							}
						}
				  ?>
				  </span>                  </td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td width="50%"  valign="top"><table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" class="text3" style="border-collapse:collapse;">
      <tr>
        <td height="30" align="center"><strong class="text" style="font-size:22px"><u>CBC : การตรวจเม็ดเลือด</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="61%" align="center" bgcolor="#CCCCCC"><strong>การตรวจเม็ดเลือด </strong></td>
            <td width="19%" align="left" bgcolor="#CCCCCC"><strong>ผลการตรวจ</strong></td>
            <td width="20%" align="center" bgcolor="#CCCCCC"><strong>ค่าปกติ</strong></td>
          </tr>
 <? $sql="SELECT * FROM resulthead WHERE profilecode='CBC' and hn='".$result2['HN']."' and clinicalinfo ='ตรวจสุขภาพประจำปี60' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode = 'WBC' || labcode ='EOS' || labcode ='HCT' || labcode ='PLTC') ";
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
          <tr height="25">
            <td><?=$objResult["labcode"]." ".$labmean;?></td>
            <td align="left"><?=$objResult["result"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
                <?  } ?>                   
          <tr height="25">
            <td colspan="3"><strong>สรุปผลการตรวจเม็ดเลือด</strong></td>
            </tr>
          <tr>
            <td colspan="3">            
            <table width="100%" border="0" cellpadding="1" cellspacing="0">
              <tr height="25">
                <td width="5%">&nbsp;</td>
                <td width="56%"><strong>จำนวนเม็ดเลือด (WBC)</strong></td>
                <td width="39%">
				<? 
				$strSQL1 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and labcode= 'WBC'";
				//echo "---->".$strSQL1;
				$objQuery1 = mysql_query($strSQL1);
				$objResult1 = mysql_fetch_array($objQuery1);				
				if($objResult1["labcode"]=="WBC"){
					if($objResult1["result"] >= 5.0 && $objResult1["result"] <= 10.0){
						echo "ปกติ";
					}else if($objResult1["result"] == "*"){
						echo "*";
					}else{
						echo "ผิดปกติ ควรปรึกษาแพทย์";
					}
				}
				?></td>
              </tr>
              <tr height="25">
                <td>&nbsp;</td>
                <td><strong>ความเข้มข้นของเลือด (HCT)</strong></td>
                <td>
				<? 
				$strSQL2 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and labcode= 'HCT'";
				//echo "---->".$strSQL2;
				$objQuery2 = mysql_query($strSQL2);
				$objResult2 = mysql_fetch_array($objQuery2);					
				if($objResult2["labcode"]=="HCT"){
					if($objResult2["result"] >= 37 && $objResult2["result"] <= 49){
						echo "ปกติ";
					}else if($objResult2["result"] == "*"){
						echo "*";
					}else{
						echo "ผิดปกติ ควรปรึกษาแพทย์";
					}
				}
				?>                </td>
              </tr>
              <tr height="25">
                <td>&nbsp;</td>
                <td><strong>เกร็ดเลือด (PLTC)</strong></td>
                <td>
				<? 
				$strSQL4 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'PLTC'";
				//echo "---->".$strSQL4;
				$objQuery4 = mysql_query($strSQL4);
				$objResult4 = mysql_fetch_array($objQuery4);					
				if($objResult4["labcode"]=="PLTC"){
					if($objResult4["result"] >= 140 && $objResult4["result"] <= 400){
						echo "ปกติ";
					}else if($objResult4["result"] == "*"){
						echo "*";
					}else{
						echo "ผิดปกติ ควรปรึกษาแพทย์";
					}
				}
				?>                </td>
              </tr>

              <tr height="25">
                <td>&nbsp;</td>
                <td><strong>อาการโรคภูมิแพ้หรือพยาธิ (EOS)</strong></td>
                <td><? 
				$strSQL3 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'EOS'";
				//echo "---->".$strSQL3;
				$objQuery3 = mysql_query($strSQL3);
				$objResult3 = mysql_fetch_array($objQuery3);					
				if($objResult3["labcode"]=="EOS"){
					if($objResult3["result"] >= 0 && $objResult3["result"] <= 5.0){
						echo "ปกติ";
					}else if($objResult3["result"] == "*"){
						echo "*";
					}else{
						echo "ผิดปกติ ควรปรึกษาแพทย์";
					}
				}
				?>                </td>
              </tr>
              <tr height="25">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr height="25">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr style="line-height:23px;">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
    <td width="50%"  valign="top"><table width="100%" height="111" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
      <tr>
        <td height="30" align="center"><strong class="text" style="font-size:22px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="text3">
          <tr>
            <td width="53%" align="center" bgcolor="#CCCCCC"><strong>การตรวจปัสสาวะ</strong></td>
            <td width="17%" align="left" bgcolor="#CCCCCC"><strong>ผลการตรวจ</strong></td>
            <td width="30%" align="center" bgcolor="#CCCCCC"><strong>ค่าปกติ</strong></td>
          </tr>
          <? $sql="SELECT * FROM resulthead WHERE profilecode='UA' and hn='".$result2['HN']."' and clinicalinfo ='ตรวจสุขภาพประจำปี60'";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////

$strSQL1 = "SELECT authorisename, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'";
//echo "===>".$strSQL1;
$objQuery1 = mysql_query($strSQL1);
list($authorisename,$authorisedate)=mysql_fetch_array($objQuery1);


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' and (labcode ='COLOR' || labcode ='APPEAR' || labcode ='GLUU' || labcode ='PROU' || labcode ='WBCU' || labcode ='RBCU' ) ";
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
			}else if($objResult["labcode"]=="BLOODU"){  //เลือดในปัสสาวะ
				$labmean="(เลือดในปัสสาวะ)";
				if($objResult["result"]=="Negative" || $objResult["result"]=="Trace"){
					$blooduvalue="ปกติ";
				}else{
					$blooduvalue="ผิดปกติ";
				}
			}else if($objResult["labcode"]=="PROU"){  //โปรตีนในปัสสาวะ
				$labmean="(โปรตีนในปัสสาวะ)";
				$provalue=$objResult["result"];
			}else if($objResult["labcode"]=="GLUU"){  //น้ำตาลในปัสสาวะ
				$labmean="(น้ำตาลในปัสสาวะ)";
				$gluuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="KETU"){
				$labmean="(คีโตนในปัสสาวะ)";
			}else if($objResult["labcode"]=="UROBIL"){
				$labmean="(การทำลายเม็ดเลือดแดงสูง)";
			}else if($objResult["labcode"]=="BILI"){
				$labmean="(บิลิรูบินในปัสสาวะ)";
			}else if($objResult["labcode"]=="NITRIT"){
				$labmean="(ไนไตรท์ในปัสสาวะ)";
			}else if($objResult["labcode"]=="WBCU"){  //เม็ดเลือดขาว
				$labmean="(เม็ดเลือดขาว)";
				$wbcuvalue=$objResult["result"];
			}else if($objResult["labcode"]=="RBCU"){  //เม็ดเลือดแดง
				$labmean="(เม็ดเลือดแดง)";
				$rbcuvalue=$objResult["result"];
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
						
			if($objResult['flag']=='L' || $objResult['flag']=='H' || $objResult['result']=='1+'|| $objResult['result']=='2+'|| $objResult['result']=='3+'|| $objResult['result']=='4+'|| $objResult['result']=='5+'|| $objResult['result']=='6+'|| $objResult['result']=='7+'|| $objResult['result']=='8+'|| $objResult['result']=='9+'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}
		?>
          <tr height="25">
            <td><?=$objResult["labcode"]." ".$labmean;?></td>
            <td ><?=$objResult["result"];?></td>
            <? if($objResult["labcode"]=="PROU" || $objResult["labcode"]=="GLUU"){ ?>
            <td align="center">Negative</td>
            <? }else{ ?>
			<td align="center"><?=$objResult["normalrange"];?></td>
			<? } ?>
          </tr>
          
          <?  }
		  
		   ?>        
          <tr height="25">             
            <td colspan="3"><strong>สรุปผลการตรวจปัสสาวะ</strong></td>
            </tr>
          <tr>
            <td colspan="3"><table width="100%" border="0" cellpadding="1" cellspacing="0">

              <tr height="25">
                <td width="7%">&nbsp;</td>
                <td width="46%"><strong>เม็ดเลือดขาว (WBCU)</strong></td>
                <td width="47%"><? 
				$strSQL1 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'WBCU'";
				//echo "---->".$strSQL1;
				$objQuery1 = mysql_query($strSQL1);
				$objResult1 = mysql_fetch_array($objQuery1);					
				if($objResult1["labcode"]=="WBCU"){
					$wbculen=strlen($objResult1["result"]);
					if($wbculen >=5){
						$wbcu1=substr($objResult1["result"],0,2);
						$wbcu2=substr($objResult1["result"],3,2);
					}else if($wbculen ==4){
						$wbcu1=substr($objResult1["result"],0,1);
						$wbcu2=substr($objResult1["result"],2,2);							
					}else{
						$wbcu1=substr($objResult1["result"],0,1);
						$wbcu2=substr($objResult1["result"],2,1);
					}
					//echo $objResult1["result"];
					if($objResult1["result"] == "Negative" || ($wbcu1 >=0 && $wbcu2 <=5) && $objResult1["result"] != "*"){
						echo "ปกติ";
					}else if($objResult1["result"] == "*"){
						echo "*";
					}else{
						echo "ผิดปกติ ควรปรึกษาแพทย์";
					}	
				}
				?></td>
              </tr>
              <tr height="25">
                <td>&nbsp;</td>
                <td><strong>เม็ดเลือดแดง (RBCU)</strong></td>
                <td><? 
				$strSQL2 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'RBCU'";
				//echo "---->".$strSQL2;
				$objQuery2 = mysql_query($strSQL2);
				$objResult2 = mysql_fetch_array($objQuery2);					
				if($objResult2["labcode"]=="RBCU"){
					$rbculen=strlen($objResult2["result"]);
					if($rbculen >=5){
						$rbcu1=substr($objResult2["result"],0,2);
						$rbcu2=substr($objResult2["result"],3,2);
					}else if($rbculen ==4){
						$rbcu1=substr($objResult2["result"],0,1);
						$rbcu2=substr($objResult2["result"],2,2);						
					}else{
						$rbcu1=substr($objResult2["result"],0,1);
						$rbcu2=substr($objResult2["result"],2,1);
					}
					if($objResult2["result"] == "Negative" || ($rbcu1 >=0 && $rbcu2 <=1) && $objResult1["result"] != "*"){
						echo "ปกติ";
					}else if($objResult2["result"] == "*"){
						echo "*";
					}else{
						echo "ผิดปกติ ควรปรึกษาแพทย์";
					}	
				}
				?></td>
              </tr>
			  <?php /* ?>
              <tr height="25">
                <td width="5%">&nbsp;</td>
                <td width="48%"><strong>เลือดในปัสสาวะ (BLOODU)</strong></td>
                <td width="47%">
				<?php
				$strSQL3 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'BLOODU'";
				//echo "---->".$strSQL3;
				$objQuery3 = mysql_query($strSQL3);
				$objResult3 = mysql_fetch_array($objQuery3);					
				if($objResult3["labcode"]=="BLOODU"){
					if($objResult3["result"]=="Negative"){
						echo "ปกติ";
					}else if($objResult3["result"] == "*"){
						echo "*";
					}else{
						echo "ผิดปกติ ควรปรึกษาแพทย์";
					}
				}
				?>
				</td>
              </tr>
			  <?php */ ?>
              <tr height="25">
                <td>&nbsp;</td>
                <td><strong>น้ำตาล (GLUU)</strong></td>
                <td><? 
				$strSQL4 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'GLUU'";
				//echo "---->".$strSQL4;
				$objQuery4 = mysql_query($strSQL4);
				$objResult4 = mysql_fetch_array($objQuery4);					
				if($objResult4["labcode"]=="GLUU"){
					if($objResult4["result"] == "Negative"){
						echo "ปกติ";
					}else if($objResult1["result"] == "*"){
						echo "*";
					}else{
						echo "ผิดปกติ ควรปรึกษาแพทย์";
					}
				}
				?>                </td>
              </tr>
              <tr height="25">
                <td>&nbsp;</td>
                <td><strong>โปรตีน (PROU)</strong></td>
                <td><? 
				$strSQL5 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."'  and labcode= 'PROU'";
				//echo "---->".$strSQL5;
				$objQuery5 = mysql_query($strSQL5);
				$objResult5 = mysql_fetch_array($objQuery5);		
				if($objResult5["labcode"]=="PROU"){
					if($objResult5["result"] == "Negative"){
						echo "ปกติ";
					}else if($objResult5["result"] == "*"){
						echo "*";
					}else{
						echo "ผิดปกติ ควรปรึกษาแพทย์";
					}
				}
				?></td>
              </tr>
			  <tr height="25">
			  	<td rowspan="3"></td>
			  </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top">
 <? 
 if($result2["agey"] >= 35){ 
 // echo "==>".$result2["agey"];
 ?></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><table width="100%" border="1" style="border-collapse:collapse; border-bottom-style:none;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:20px"><u>ผลการตรวจทางห้องปฏิบัติการ : อื่นๆ</u></strong></td>
      </tr>
      <tr>
        <td height="52" valign="top"><table width="98%" border="0" class="text3">
            <tr height="25">
              <td width="32%" valign="top" bgcolor="#CCCCCC"><strong>รายการตรวจ</strong></td>
              <td width="9%" valign="top" bgcolor="#CCCCCC"><strong>ผลการตรวจ</strong></td>
              <td width="9%" valign="top" bgcolor="#CCCCCC"><strong>ค่าปกติ</strong></td>
              <td width="50%" valign="top" bgcolor="#CCCCCC" style="font-size:16px;"><strong>สรุปผลการตรวจ</strong></td>
            </tr>
            <?
$sql1="SELECT * FROM resulthead WHERE (profilecode='GLU' or profilecode='CREA' or profilecode='BUN' or profilecode='URIC' or profilecode='CHOL' or profilecode='TRIG' or  profilecode='AST' or profilecode='ALT' or profilecode='LIPID' or profilecode='ALP' or profilecode='HBSAG') and hn='".$result2['HN']."' and clinicalinfo ='ตรวจสุขภาพประจำปี60' ";
//echo $sql1;
$query1 = mysql_query($sql1);
$i=0;
while($arrresult = mysql_fetch_array($query1)){
		$i++;
		//echo $i;

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
//echo $strSQL;
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
			}else if($objResult["labname"]=="HBsAg"){
				$labmean="(ไวรัสตับอักเสบบี)";
			}
			
if($objResult["labcode"]=='GLU'){
	if($objResult["result"]>=74 && $objResult["result"]<=106){
		$app="ระดับน้ำตาลในเลือดมีค่าอยู่ในเกณฑ์ปกติ";
	}else if($objResult["result"]>106 && $objResult["result"]<=125){
		$app="ระดับน้ำตาลในเลือดมีค่าสูงผิดปกติ ควรพบแพทย์เพื่อการรักษา";
	}else if($objResult["result"]>125){
		$app="ระดับน้ำตาลในเลือดมีค่าสูงมากผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
}

if($objResult["labcode"]=='BUN'){
	if($objResult["result"]>18){
		$app="ผิดปกติ ควรควบคุมอาหาร แป้ง น้ำตาล ผลไม้รสหวาน ร่วมกับออกกำลังกาย และควรพบแพทย์เพื่อการรักษา";	
	}else if($objResult["result"]>=7 && $objResult["result"]<=18){
		$app="การทำงานของไตมีค่าอยู่ในเกณฑ์ปกติ";	
	}else if($objResult["result"]<7 ){
		$app="ผิดปกติ การทำงานของไตต่ำกว่าปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
	
}

if($objResult["labcode"]=='CREA'){
	if($objResult["result"]>1.3){
		$app="ผิดปกติ ควรควบคุมอาหารที่มีโซเดียมสูง และโซเดียมสูง เช่น นม ถั่วลิสง ของเค็มทุกชนิด และควรพบแพทย์เพื่อการรักษา";	
	}else if($objResult["result"]>=0.6 && $objResult["result"]<=1.3){
		$app="การทำงานของไตมีค่าอยู่ในเกณฑ์ปกติ";	
	}else if($objResult["result"]<0.6){
		$app="ผิดปกติ การทำงานของไตต่ำกว่าปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
}

if($objResult["labcode"]=='URIC'){
	if($objResult["result"]>7.2){
		$app="ผิดปกติ ควรงดเครื่องดื่มที่มีแอลกอฮอล์ เครื่องในสัตว์ สัตว์ปีก และควรพบแพทย์เพื่อการรักษา";	
	}else if($objResult["result"] >=2.6 && $objResult["result"] <=7.2){
		$app="ระดับกรดยูริคมีค่าอยู่ในเกณฑ์ปกติ";	
	}else if($objResult["result"]<2.6){
		$app="ผิดปกติ ระดับกรดยูริคต่ำกว่าปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
}


if($objResult["labcode"]=='CHOL'){
	if($objResult["result"]<=200){
		$app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
	}else	if($objResult["result"]>200){
		$app="ผิดปกติ ควรควบคุมอาหารพวกเครื่องในสัตว์ อาหารทะเล ไข่แดง ไข่นกกระทา กะทิ ไขมันสัตว์ ร่วมกับการออกกำลังกาย และควรพบแพทย์เพื่อการรักษา";	
	}else	if($objResult["result"]>300){
		$app="ผิดปกติ ระดับไขมันในเลือดสูงมากผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
}

if($objResult["labcode"]=='TRIG'){
	if($objResult["result"]<=150){
		$app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
	}else	if($objResult["result"]>150 && $objResult["result"]<250){
		$app="ผิดปกติ ควรควบคุมอาหารพวกแป้ง น้ำตาล อาหารหวาน ครีมเทียม กะทิ งดเครื่องดื่มแอลกอฮอล์ ร่วมกับการออกกำลังกาย และควรพบแพทย์เพื่อการรักษา";	
	}else	if($objResult["result"]>250){
		$app="ผิดปกติ ระดับไขมันในเลือดสูงมากผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
}

if($objResult["labcode"]=='HDL'){
	if($objResult["result"]>=40 && $objResult["result"]<=60){
		$app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
	}else	if($objResult["result"]>60){  //สูงดี
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}else	if($objResult["result"]<40){  //ต่ำไม่ดี
		$app="ระดับไขมันในเลือดมีค่าต่ำผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
}

if($objResult["labcode"]=='10001'){
	if($objResult["result"]>=0 && $objResult["result"]<=100){
		$app="ระดับไขมันในเลือดมีค่าอยู่ในเกณฑ์ปกติ";	
	}else	if($objResult["result"]>100){
		$app="ผิดปกติ ควรควบคุมอาหารพวกเครื่องในสัตว์ อาหารทะเล ไข่แดง กะทิ น้ำมันสัตว์ งดสูบบุหรี่ ร่วมกับการออกกำลังกาย และควรพบแพทย์เพื่อการรักษา";	
	}
}

if($objResult["labcode"]=='AST'){  //SGOT
	if($objResult["result"]>=15 && $objResult["result"]<=37){
		$app="การทำงานของตับปกติ";	
	}else	if($objResult["result"]>37){
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}else	if($objResult["result"]<15){
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
}
if($objResult["labcode"]=='ALT'){  //SGPT
	if($objResult["result"]>=0 && $objResult["result"]<=50){
		$app="การทำงานของตับปกติ";		
	}else{
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
}

if($objResult["labcode"]=='ALP'){  //ALK
	if($objResult["result"]>=46 && $objResult["result"]<=116){
		$app="การทำงานของตับปกติ";	
	}else	if($objResult["result"]>116){
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}else	if($objResult["result"]<46){
		$app="การทำงานของตับผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
}

if($objResult["labcode"]=='HBSAG'){  //HBSAG
	if($objResult["result"]=="Negative"){
		$app="ปกติ";	
	}else if($objResult["result"]=="Positive"){
		$app="ผิดปกติ ควรพบแพทย์เพื่อการรักษา";	
	}
}

		?>
            <tr height="25">
              <td width="34%" valign="top"><strong>
                <?=$objResult["labname"]." ".$labmean;?>
              </strong></td>
              <td width="8%" valign="top"><? if($objResult["flag"]!="N" || $objResult['result']=='Positive'){ echo "<strong>".$objResult["result"]."</strong>";}else{ echo $objResult["result"];}?></td>
              <td width="9%" valign="top"><?=$objResult["normalrange"];?></td>
              <td width="49%" valign="top" style="font-size:16px;"><?=$app;?></td>
            </tr>
            <? 
		  } 
		}
	?>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><? } ?></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none">
      <? if($result["hn"]=="52-2543"){  ?>
      <tr>
        <td><strong class="text" style="font-size:18px"><u>ผลการตรวจมะเร็งปากมดลูก (Pap Smear)</u></strong><strong class="text" style="margin-left: 9px;"> :
          <? if($result["cxr"]==""){ echo "ปกติ"; }else{ echo "ผิดปกติเล็กน้อย...".$result["cxr"]; } ?>
        </strong></td>
      </tr>
      <? } ?>
      <tr>
        <td><strong class="text" style="font-size:18px"><u>ผลการตรวจเอกซ์เรย์ (X-RAY)</u></strong><strong class="text" style="margin-left: 9px;"> :
          <? if($result["cxr"]==""){ echo "ปกติ"; }else{ echo "ผิดปกติเล็กน้อย...".$result["cxr"]; } ?>
        </strong></td>
      </tr>
    </table></td>
  </tr>
  </table>
<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center"><strong>Authorise  LAB:</strong><?=$authorisename?> <strong> (<?=$authorisedate?>) </strong><strong>CXR : </strong>พ.ต.วริทธิ์ พสุธาดล (ว.38228) รังสีแพทย์<strong> (20-02-2017) Doctor : </strong>พ.อ.วรวิทย์ วงษ์มณี (ว.27035) <strong>(23-02-2017)</strong></td>
    
  </tr>
</table>
</div>
<? } } ?>
</body>
</html>