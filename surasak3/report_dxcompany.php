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
<span class="tet1">พิมพ์ใบตรวจสุขภาพ ธนภูมิโมบาย จำกัด</span><br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;กรอก HN : </span>
    <input name="hn" type="text" size="10" class="tet1" id="hn" >
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
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

		
	$select2 = "select *,concat(yot,name,' ',surname)as ptname from opcard  where hn='".$_POST['hn']."' ";
	$row2 = mysql_query($select2)or die (mysql_error());
	$result2 = mysql_fetch_array($row2);

	
	
/*	$select = "select * from out_result_chkup  where hn='".$result2['HN']."'";
	$row = mysql_query($select)or die (mysql_error());
	$result = mysql_fetch_array($row);*/
	
	$ht = $result['height']/100;
	$bmi=number_format($result['weight'] /($ht*$ht),2);
	
	//and clinicalinfo ='ตรวจสุขภาพตำรวจ' 
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result2['hn']."' and clinicalinfo ='ตรวจสุขภาพประจำปี56' ";
$query1 = mysql_query($sql1); 


?>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพ บริษัทธนภูมิโมบาย จำกัด</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่  11 กันยายน 2556 </span></span></span></td>
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
                  <td colspan="2"  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>ข้อมูลผู้ตรวจสุขภาพ</u></strong></td>
                </tr>
                <tr>
                  <td   valign="top" class="text2"><strong>HN :</strong>
                   <strong> <?=$result['hn']?></strong></td>
                  <td  valign="top" class="text2"><strong>ชื่อ :</strong> <span style="font-size:24px"><strong>
                    <?=$result['ptname']?>
                    </strong></span><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วัน/เดือน/ปี เกิด</strong>
                    <?=$result2['dbirth']?> <strong>
                      อายุ :</strong>
                    <?=calcage($result2['dbirth'])?></td>
                  </tr>
                <tr>
                  <td colspan="2" valign="top" class="text2">เลขประชาชน : <strong>
                      <?=$result2['idcard']?>
                    </strong></td>
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
            <td bgcolor="#CCCCCC">unit </td>
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
            <td bgcolor="#CCCCCC">result</td>
            <td bgcolor="#CCCCCC">unit</td>
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
$sql="SELECT * FROM result1 WHERE profilecode='METAMP' or profilecode='VDRL' or profilecode='HIV' ";
	$query = mysql_query($sql);
	while($arrresult = mysql_fetch_array($query)){

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

$authorisename = $objResult["authorisename"];
$authorisedate  = $objResult["authorisedate2"];

if($objResult["labcode"]=='VDRL'){
	
	$objResult["result"]='NON REACTIVE';
	
}else{
	$objResult["result"]='NEGATIVE';
	
}
		?>
          <tr>
            <td><?=$objResult["labcode"];?></td>
            <td><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
           <?  } ?>
 
         
        </table></td>
      </tr>
    </table><BR><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center"><strong class="text" style="font-size:22px"><u>X-RAY</u></strong></td>
        </tr>
        <tr>
          <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" class="text3">
            <tr>
              <td>CXR : <strong>NORMAL
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
            
            </table>
          </td>
        </tr>
    </table></td>
    <td  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>STOOL: การตรวจอุจาระ</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" class="text3">
          <tr>
            <td align="center" bgcolor="#CCCCCC">labcode </td>
            <td bgcolor="#CCCCCC">result</td>
            <td bgcolor="#CCCCCC">unit </td>
            <td align="center" bgcolor="#CCCCCC">normalrange</td>
          </tr>
          <? $sql="SELECT * FROM result1 WHERE profilecode='STOOL' ";
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
            <td><?=$objResult["result"];?></td>
            <td><?=$objResult["unit"];?></td>
            <td align="center"><?=$objResult["normalrange"];?></td>
          </tr>
          <?  } ?>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<? 
$sql = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
			$result2= mysql_query($sql);
	$arr2 = mysql_fetch_assoc($result2);	
		$authorisename = $arr2["authorisename"];
		$authorisedate  = $arr2["authorisedate2"];
?>
<table width="100%" border="0" class="text3">
  <tr>
    <td  width="50%"><strong>LAB:Authorise name :</strong>      <?=$authorisename?> &nbsp;&nbsp; <strong>Authorise date :</strong><strong>
<?=$authorisedate?>
    </strong></td>
    
  </tr>
  <tr class="text3">
    <td><strong>CXR:Authorise name :</strong>พ.ต.ภูภูมิ วุฒิธาดา (ว.33906) &nbsp;&nbsp;รังสีแพทย์<strong>&nbsp;&nbsp;Authorise date :</strong><strong>12-09-2013 </strong></td>
    </tr>
</table>
<? } ?>
</body>
</html>