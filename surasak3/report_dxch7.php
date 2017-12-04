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
div{
	height:2px;
}
</style>
</head>

<body>
<div id="no_print">
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">พิมพ์ใบตรวจสุขภาพพนักงานช่อง7</span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;กรอก HN : </span>
    <input name="hn" type="text" size="10" class="tet1">
  <input type="submit" name="ok" value="ตกลง">
  <br />
  <br />
  
</center>
</form>
</div>
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

if(isset($_POST['hn'])){
	
	include("connect.inc");

	$select = "select *,concat(address,' ต.',tambol,' อ.',ampur,' จ.',changwat)as address,concat(yot,name,' ',surname)as ptname,date_format(dbirth,'%d-%m-%Y') as dbirth2 from opcard  where hn='".$_POST['hn']."'";
	$row = mysql_query($select);
	$result = mysql_fetch_array($row);
		
/*	$select2 = "select *,date_format(dbirth,'%d-%m-%Y') as dbirth2 from opcardchk  where hn='".$result['hn']."'";
	$row2 = mysql_query($select2);
	$result2 = mysql_fetch_array($row2);*/
	

	
	
	//and clinicalinfo ='ตรวจสุขภาพตำรวจ' 
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result['hn']."' and clinicalinfo ='ตรวจสุขภาพช่อง7' and orderdate like '2013%' ";
$query1 = mysql_query($sql1); 

$str1="Select * from  result1 ";
$strquery1 = mysql_query($str1); 
$strar=mysql_fetch_assoc($strquery1);
$dateser=explode("-",substr($strar['orderdate'],0,10));

switch($dateser[1]){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฎาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}

$datesershow= $dateser[2].' '.$printmonth.'  '.($dateser[0]+543);




$opd="SELECT * FROM opd WHERE  hn  ='".$result['hn']."' ORDER BY `thidate` DESC limit 1 ";
$opdquery = mysql_query($opd)or die (mysql_error());
$opdarr=mysql_fetch_assoc($opdquery);

	$ht = $opdarr['height']/100;
	$bmi=number_format($opdarr['weight'] /($ht*$ht),2);

?>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพพนักงานสถานีโทรทัศน์สีกองทัพบกช่อง 7</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่ <?=$datesershow;?> </span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0">
        <tr>
          <td><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
            <tr>
              <td><table   class="text1" >
                <tr>
                  <td colspan="3"  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>ข้อมูลผู้ตรวจสุขภาพ</u></strong></td>
                </tr>
                <tr>
                  <td width="102"  valign="top" class="text2"><strong>HN :</strong>
                    <?=$result['hn']?></td>
                  <td width="202" valign="top" class="text2"><strong>ชื่อ :</strong> <span style="font-size:24px"><strong>
                    <?=$result['ptname']?>
                  </strong></span></td>
                  <td  width="300" valign="top" class="text3"><strong>วัน/เดือน/ปี เกิด</strong>
                    <?=$result['dbirth2']?> <strong>
อายุ :</strong>
                    <?=calcage($result['dbirth']);?></td>
                </tr>
                <tr>
                  <td colspan="2" valign="top" class="text2"><span class="text3"><strong>ที่อยู่ : </strong></span><strong>
                    <?=$result['address']?>
                  </strong></td>
                  <td valign="top" class="text2"><span class="text3"><strong>โทรศัพท์ : <strong>
                 <?=$result['phone']?>
                  </strong></strong></span></td>
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
                    <?=$opdarr['weight']?>
                    กก.</span></td>
                  <td width="109"  valign="top"><span class="text3"><strong>ส่วนสูง:</strong>
                    <?=$opdarr['height']?>
                    ซม.</span></td>
                  <td width="118" valign="top"><span class="text3"><strong>BMI: </strong> <u>
                    <?=$bmi?>
                  </u></span></td>
                  <td width="130" valign="top"><span class="text3"><strong>BP:<u>
                    <?=$opdarr['bp1']?>
                    /
                    <?=$opdarr['bp2']?>

                    mmHg.</u></strong></span></td>

    <td width="118" valign="top"><span class="text3"><strong>P: </strong> <u>
                    <?=$opdarr['pause']?>

                  </u></span></td>
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
        <td><table width="100%" border="0">
          <tr>
            <td align="center" bgcolor="#CCCCCC">labcode </td>
            <td align="center" bgcolor="#CCCCCC">result</td>
            <td align="center" bgcolor="#CCCCCC">unit </td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
          </tr>
          <? $sql="SELECT * FROM result1 WHERE profilecode='CBC' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			
				if($objResult['flag']=='L' || $objResult['flag']=='H'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}
		?>
          <tr>
            <td><?=$objResult["labcode"];?></td>
            <td align="center"><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
                <?  } ?>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">ผลตรวจ..ปกติ</td>
            </tr>
          
    
          
        </table></td>
        
      </tr>
    </table></td>
    <td width="50%"  valign="top"><table width="100%" border="1" style="border-collapse:collapse" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" class="text3">
          <tr>
            <td align="center" bgcolor="#CCCCCC">labcode </td>
            <td align="center" bgcolor="#CCCCCC">result</td>
            <td align="center" bgcolor="#CCCCCC">unit</td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
          </tr>
          <? $sql="SELECT * FROM result1 WHERE profilecode='UA' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			
			if($objResult['flag']=='L' || $objResult['flag']=='H'){
				$objResult["result"]="<strong>".$objResult["result"]."</strong>";
			}else{
				$objResult["result"]=$objResult["result"];
			}
		?>
          <tr>
            <td><?=$objResult["labcode"];?></td>
            <td ><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
          <?  } ?>
          <tr>
            <td colspan="4">ผลตรวจ..มีโปรตีนรั่วในปัสสาวะ บ่งบอกการทำงานของไตแย่ลง</td>
            </tr>
          
          
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>LAB : อื่นๆ</u></strong></td>
      </tr>
      <tr>
        <td height="52" valign="top"><table width="95%" border="0" class="text3">
  
<? 
/*$sql="SELECT * FROM result1 WHERE profilecode='CHOL' or profilecode='TRIG' or profilecode='HDL' or profilecode='LDL' or profilecode='GLU' or profilecode='HBSAG' or profilecode='AST' or profilecode='ALT' or profilecode='ALP' or profilecode='URIC'";*/
$sql="SELECT * FROM result1 WHERE  profilecode='GLU' or profilecode='HBSAG' or profilecode='AST' or profilecode='ALT' or profilecode='ALP' or profilecode='URIC' or profilecode='BUN'  or profilecode='CREA'";
	$query = mysql_query($sql);
	while($arrresult = mysql_fetch_array($query)){

$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

 /*$sql1="SELECT * FROM result1 WHERE profilecode='TRIG'";
	$query1 = mysql_query($sql1);
	$arrresult1 = mysql_fetch_array($query1);
/////
		$strSQL1 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult1['autonumber']."' ";
		$objQuery1 = mysql_query($strSQL1);
		$objResult1= mysql_fetch_array($objQuery1);

        
 $sql2="SELECT * FROM result1 WHERE profilecode='CHOL'";
	$query2 = mysql_query($sql1);
	$arrresult2 = mysql_fetch_array($query1);
/////
		$strSQL2 = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult2['autonumber']."' ";
		$objQuery2 = mysql_query($strSQL2);
		$objResult2= mysql_fetch_array($objQuery2);*/
		
		if($objResult["labcode"]=='GLU' ){
		//	$ac='สูงกว่าปกติ ควรปรึกษาแพทย์ เรื่องคุมอาหารหรือปรับยาเบาหวาน';
		
		$ac='สูงกว่าค่าปกติสำหรับผู้เป็นเบาหวาน';
		}else{
			$ac='ปกติ';
		}
		?>
<tr>
<td width="36%" valign="top"><?=$objResult["labcode"];?> : <?=$objResult["result"];?></td>
<td width="64%" valign="top">ผลตรวจ..<?=$ac;?></td>
</tr>
  <? } 
  if($result['hn']=='47-13413'){ 
	 $psa='0.551';
  }else if($result['hn']=='47-13411'){
	 $psa='0.541';
  }else if($result['hn']=='47-13582'){
	 $psa='0.690';
  }else if($result['hn']=='47-13420'){
	 $psa='1.566';
  }else if($result['hn']=='47-3875'){
	 $psa='0.633';
  }else if($result['hn']=='47-13421'){
	 $psa='0.805';
  }else if($result['hn']=='47-13417'){
	 $psa='0.721';
  }
 
  ?>
<tr>
<td  valign="top">PSA : <?=$psa;?></td>
<td  valign="top">ผลตรวจ..ปกติ</td>
</tr>
        </table></td>
      </tr>
    </table></td>
    <td  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>LIPID: การตรวจระดับไขมันในเลือด</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" class="text3">
          <tr>
            <td align="center" bgcolor="#CCCCCC">labcode </td>
            <td align="center" bgcolor="#CCCCCC">result</td>
            <td align="center" bgcolor="#CCCCCC">unit </td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
          </tr>
<?
$sql="SELECT * FROM result1 WHERE profilecode='CHOL' or profilecode='TRIG' or profilecode='HDL' or profilecode='LDL' ";
	$query = mysql_query($sql);
	while($arrresult = mysql_fetch_array($query)){

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

$authorisename = $objResult["authorisename"];
$authorisedate  = $objResult["authorisedate2"];
		?>
          <tr>
            <td><?=$objResult["labcode"];?></td>
            <td><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
           <?  } ?>
          <tr>
            <td colspan="4">ผลตรวจ..สูงกว่าปกติ</td>
            </tr>
         
        </table></td>
      </tr>
    </table>
      <table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center"><strong class="text" style="font-size:22px"><u>X-RAY</u></strong></td>
        </tr>
        <tr>
          <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" class="text3">
            <tr>
              <td>CXR :  หัวใจโต
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
</table>
<? 
/*$sql = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
		$result2= mysql_query($sql);
		$arr2 = mysql_fetch_assoc($result2);	
		$authorisename = $arr2["authorisename"];
		$authorisedate  = $arr2["authorisedate2"];*/
?>
<table width="100%" border="0" class="text3">
  <tr>
    <td  width="50%"><strong>LAB:Authorise name :</strong>      <?=$authorisename?>      <span class="text3"><strong>Authorise date :</strong></span><strong>
<?=$authorisedate?>
    </strong></td>
    
  </tr>
  <tr>
    <td><strong>DOCTOR: Authorise name </strong>ร.ต.วิชญ์พล ศรีคุณะซ้าย  (ว.45992) <strong>Authorise date : 16-09-2013</strong></td>
  </tr>
  <!--<tr>
    <td><strong>CXR:Authorise name :</strong>พ.ต.ภูภูมิ วุฒิธาดา รังสีแพทย์<span class="text3"><strong>Authorise date :</strong><strong>12 กันยายน 2556 </strong></td>
    </tr>-->
</table>
<? } ?>
</body>
</html>