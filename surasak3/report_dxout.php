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
<span class="tet1">พิมพ์ใบตรวจสุขภาพตำรวจ</span> <br />
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
             }
      else{
            $pAge="$ageY ปี $ageM เดือน";
                        }
      return $pAge;
          }

		
	$select2 = "select * from opcardchk  where HN='".$_POST['hn']."' ";
	$row2 = mysql_query($select2)or die (mysql_error());
	$result2 = mysql_fetch_array($row2);
	
	$subbirt=explode("/",$result2['dbirth']);
	$newdbirth=$subbirt[2]."-".$subbirt[1]."-".$subbirt[0];

	$age=calcage($newdbirth);
	
	$select = "select * from out_result_chkup  where hn='".$result2['HN']."'";
	
	
	$row = mysql_query($select)or die (mysql_error());
	$result = mysql_fetch_array($row);
	
	$ht = $result['height']/100;
	$bmi=number_format($result['weight'] /($ht*$ht),2);
	
	//and clinicalinfo ='ตรวจสุขภาพตำรวจ' 
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result2['HN']."' and clinicalinfo ='ตรวจสุขภาพเบียร์ช้าง' ";
$query1 = mysql_query($sql1); 


?>
<table width="100%" border="0">
  <tr>
    <td><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพ</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่  6-7 พฤศจิกายน 2556</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%"   class="text1" >
                <tr>
                  <td colspan="2"  valign="top" class="text2"><strong class="text" style="font-size:20px"><u>ข้อมูลทั่วไป</u></strong>&nbsp;&nbsp;<strong>HN :</strong>
                   <strong> <?=$result['hn']?></strong>
                &nbsp;&nbsp;<strong>ชื่อ :</strong> <span style="font-size:22px"><strong>
                    <?=$result['ptname']?>
                    </strong></span><strong>&nbsp;&nbsp;&nbsp;วัน/เดือน/ปี เกิด</strong>
                    <?=$result2['dbirth']?> <strong><br><strong>เลขประชาชน : <strong>
                      <?=$result2['idcard']?>
                    </strong>
                      อายุ :</strong>
                    <?=$age;?></td>
               </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table  class="text1" >
                <tr>
                  <td colspan="5" valign="top"><strong class="text" style="font-size:22px"><u>ตรวจร่างกายทั่วไป</u></strong></td>
                </tr>
                <tr>
                  <td width="113" valign="top"><span class="text3"><strong>น้ำหนัก: </strong>
                    <?=$result['weight']?>
                    กก.</span></td>
                  <td width="109"  valign="top"><span class="text3"><strong>ส่วนสูง:</strong>
                    <?=$result['height']?>
                    ซม.</span></td>
                  <td width="118" valign="top"><span class="text3"><strong>BMI: </strong> <u>
                    <?=$bmi?>
                  </u></span></td>
                  <td width="130" valign="top"><span class="text3"><strong>BP:<u>
                    <?=$result['bp1']?>
                    /
                    <?=$result['bp2']?>

                    mmHg.</u></strong></span></td>

    <td width="118" valign="top"><span class="text3"><strong>P: </strong> <u>
                      <?=$result['p']?> ครั้ง/นาที

                  </u></span></td>
                </tr>
                <tr>
                  <td colspan="5" valign="top"><span class="text3">
				ค่าความดัน:
                 <?
				if(($result['bp1'] <=129  &&  $result['bp2'] <=85)){ 
						$bp="ความดันโลหิตเหมาะสม"; 
				}else if(($result["bp1"] >129 && $result["bp1"] <=139) || ($result["bp2"]>80 && $result["bp2"] <= 89)){
					$bp="ความดันโลหิต เกือบสูง Pre-HT ควรต้องควบคุมอาหารโดยเฉพาะ อาหารที่มีรสเค็มและออกกำลังกาย"; 
				}else if($result["bp1"] >=140 ||  $result["bp1"] <=90){
					$bp="ความดันโลหิตสูง ควรต้องควบคุมอาหารอย่างเคร่งครัดโดยเฉพาะ อาหารที่มีรสเค็มและออกกำลังกาย";
				} else {$bp="ความดันโลหิตเหมาะสม"; }
				
				 
				echo $bp;
				?></span> </td>
                  </tr>
                <tr>
                  <td colspan="5" valign="top"><span class="text3">ค่า BMI : 
                  <? 
				  if($bmi<18.5){
					$showbmi="ท่านมีน้ำหนักน้อยเกินไป";  
				  }else if($bmi>=18.5 && $bmi<23){
					$showbmi="ท่านมีน้ำหนักปกติ";    
				  }else if($bmi>=23 && $bmi<25){
					$showbmi="ท่านมีภาวะน้ำหนักเกิน";  
			 	  }else if($bmi>=25 && $bmi<31){	 
				   $showbmi="ท่านมีน้ำหนักเกินหรือภาวะอ้วน";  
				  }else if($bmi>=31 && $bmi<35){	
				  $showbmi="ท่านมีภาวะอ้วนรุนแรงค่อนข้างมาก";
				  }else if($bmi>35){	  
				  	$showbmi="ท่านมีภาวะอ้วนรุนแรง";
				  }
				 echo $showbmi;
				 
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
    <td  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td height="52" valign="top"><table width="95%" border="0" class="text3">
          <tr>
            <td bgcolor="#CCCCCC">labcode </td>
            <td bgcolor="#CCCCCC">result</td>
            <td bgcolor="#CCCCCC">unit </td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
            <td bgcolor="#CCCCCC">สรุปผลการตรวจ</td>
            </tr>
          
          <?
$sql="SELECT * FROM result1 WHERE profilecode='GLU' or profilecode='CREA' or profilecode='CHOL' or profilecode='AST' or profilecode='ALT' ";
$query = mysql_query($sql);
while($arrresult = mysql_fetch_array($query)){

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

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
if($objResult["labcode"]=='CREA'){
	if($objResult["result"]>1.4){
		$app="ค่าการทำงานของไตสูงกว่าค่าปกติ ควรพบแพทย์ เพื่อรับการประเมินและการรักษา";	
	}else if($objResult["result"]<=1.4){
		$app="ค่าการทำงานของไตอยู่ในระดับที่เหมาะสมตามอายุ ควรติดตามซ้ำทุก1ปี";	
	}
}
if($objResult["labcode"]=='CHOL'){
	if($objResult["result"]<=200){
		$app="ระดับไขมันในเลือดอยู่ระดับปกติ ควรติดตามซ้ำทุก1ปี";	
	}else	if($objResult["result"]>200){
		$app="ระดับไขมันในเลือดมีค่าผิดปกติ เล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกายและตรวจซ้ำใน 3-6 เดือน";	
	}else	if($objResult["result"]>300){
		$app="ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก สมควรพบแพทย์เพื่อรับการประเมินและให้การรักษา";	
	}
}
if($objResult["labcode"]=='AST'){
	if($objResult["result"]>40){
		$app="ค่าการทำงานของตับ ผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}else{
		$app="ค่าการทำงานของตับ ปกติ";	
	}
}
if($objResult["labcode"]=='ALT'){
	if($objResult["result"]>50){
		$app="ค่าการทำงานของตับ ผิดปกติ ควรพบแพทย์เพื่อประเมินและรับการรักษา";	
	}else{
		$app="ค่าการทำงานของตับ ปกติ";	
	}
}

?>
          
          <tr>
            <td><?=$objResult["labcode"];?></td>
            <td><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
            <td><?=$app;?></td>
            </tr>
          <?  } ?>
          
          
          </table></td>
      </tr>
      </table>
      <table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" class="text3">
            <tr>
              <td>CXR : <strong>
                <?=$result['cxr']?>
                </strong></td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              </tr>
            <tr>
              <td>&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
  <tr class="text">
  
    <td  valign="top"><strong>LAB:Authorise name :</strong>
      <?=$authorisename?>
      &nbsp;&nbsp; <strong>Authorise date :</strong> <strong>
      <?=$authorisedate?>
    CXR:Authorise name :</strong>พ.ต.ภูภูมิ วุฒิธาดา (ว.33906) &nbsp;รังสีแพทย์<strong>&nbsp;Authorise date :</strong><strong>10-11-2013</strong></td>
  </tr>
</table>


<? } ?>
</body>
</html>