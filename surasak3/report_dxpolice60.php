<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
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
.textsub1 {
	font-size: 16px;
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
</style>
</head>

<body onload="document.getElementById("hn").focus();">
<div id="no_print">
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">พิมพ์ใบตรวจสุขภาพตำรวจ</span> <br />
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
	
	$select = "SELECT  a.row, a.pid, a.idcard, a.dbirth, a.agey, b.hn, b.ptname, b.weight, b.height, b.bp1, b.bp2, b.p, b.cxr 
  FROM opcardchk AS a 
  INNER  JOIN out_result_chkup AS b 
    ON a.HN = b.hn 
  WHERE a.part ='สอบตำรวจ60' 
  order by a.row";
	// echo $select;	
	$row = mysql_query($select)or die (mysql_error());
	$num = mysql_num_rows($row);
	//echo $num;
	//$i=0;
	while($result=mysql_fetch_array($row)){
	//$i++;
	//echo "==>".$i;
	$dob=explode("/",$result['dbirth']);
	list($d,$m,$y)=$dob;
	$showdob="$y-$m-$d";
	
	$ht = $result['height']/100;
	$bmi=number_format($result['weight'] /($ht*$ht),2);
	
	if($result['cxr']==""){
		$cxr="Normal";
	}else{
		$cxr=$result['cxr'];
	}
	
	//and clinicalinfo ='ตรวจสุขภาพตำรวจ' 
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result['hn']."' and clinicalinfo ='CBC ,UA ,ST ,HIV ,VDRL ,AMP ,'";
$query1 = mysql_query($sql1); 
?>
<div id="divprint">
<table width="100%" border="0">
  <tr>
    <td colspan="2"><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพสอบเข้ารับราชการตำรวจ หน่วย ภาค 5</strong></td>
        </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
        </tr>
      <tr>
        <td align="center" valign="top" class="text1">ตรวจเมื่อวันที่  12 กุมภาพันธ์ 2561</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"   class="text1" >
            <tr>
              <td colspan="2"  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>ข้อมูลผู้ตรวจสุขภาพ</u></strong></td>
            </tr>
            <tr>
              <td   valign="top" class="text2"><strong>HN :</strong> <strong>
                <?=$result['hn']?>
              </strong></td>
              <td  valign="top" class="text2"><strong>ชื่อ :</strong> <span style="font-size:24px"><strong>
                <?=$result['ptname']?>
              </strong></span></td>
            </tr>
            <tr>
              <td colspan="2" valign="top" class="text2"><span class="text3"><strong>เลขที่สอบ : </strong></span><strong>
                <?=$result['pid']?>
                </strong>
                  <!--ลำดับสอบ : <strong><?$result['row']?></strong><span class="text3"><strong>--></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr>
        <td><table width="100%"  class="text1" >
            <tr>
              <td colspan="5" valign="top"><strong class="text" style="font-size:22px"><u>ตรวจร่างกายทั่วไป</u></strong></td>
            </tr>
            <tr>
              <td width="205" valign="top"><span class="text3"><strong>น้ำหนัก: </strong>
                    <?=$result['weight']?>
                กก.</span></td>
              <td width="223"  valign="top"><span class="text3"><strong>ส่วนสูง:</strong>
                    <?=$result['height']?>
                ซม.</span></td>
              <td width="169" valign="top"><span class="text3"><strong>BMI: </strong> <u>
                <?=$bmi?>
              </u></span></td>
              <td width="372" valign="top"><span class="text3"><strong>ความดันโลหิต(BP):<u>
                <?=$result['bp1']?>
                /
                <?=$result['bp2']?>
                mmHg.</u></strong></span></td>
              <td width="379" valign="top"><span class="text3"><strong>อัตราการเต้นหัวใจ (P): </strong> <u>
                <?=$result['p']?>
                ครั้ง/นาที </u></span></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td width="50%"  valign="top"><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="text3" style="border-collapse:collapse;">
      <tr>
        <td align="center"><strong class="text" style="font-size:22px"><u>CBC : การตรวจนับเม็ดเลือด</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
          <tr class="text3">
            <td align="center" bgcolor="#CCCCCC"><strong>Labcode </strong></td>
            <td bgcolor="#CCCCCC"><strong>ผล/Result</strong></td>
            <td bgcolor="#CCCCCC"><strong>Unit</strong></td>
            <td align="center" bgcolor="#CCCCCC"><strong>ค่าปกติ/Normal</strong></td>
          </tr>
 <? $sql="SELECT * FROM  resulthead WHERE hn='".$result['hn']."'  and profilecode='CBC' and clinicalinfo ='CBC ,UA ,ST ,HIV ,VDRL ,AMP ,' order by labnumber desc, autonumber desc";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
	//echo $sql;
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			
				if($objResult['flag']=='L' || $objResult['flag']=='H'){
				$objResult["result"]="<strong style='color:red;'>".$objResult["result"]."</strong>";
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
            <td align="center" bgcolor="#CCCCCC"><strong>Labcode </strong></td>
            <td bgcolor="#CCCCCC"><strong>ผล/Result</strong></td>
            <td bgcolor="#CCCCCC"><strong>Unit</strong></td>
            <td align="center" bgcolor="#CCCCCC"><strong>ค่าปกติ/Normal</strong></td>
          </tr>
          <? $sql1="SELECT * FROM  resulthead WHERE hn='".$result['hn']."'  and profilecode='UA' and clinicalinfo ='CBC ,UA ,ST ,HIV ,VDRL ,AMP ,' order by labnumber desc, autonumber desc";
	$query1 = mysql_query($sql1);
	$arrresult = mysql_fetch_array($query1);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			
			if($objResult["result"]=='1+' || $objResult["result"]=='2+' || $objResult["result"]=='3+' || $objResult["result"]=='4+' || $objResult["result"]=='5+' || $objResult["result"]=='6+'){	
				$objResult["result"]="<strong style='color:red;'>".$objResult["result"]."</strong>";
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
        <td align="center"><strong class="text" style="font-size:22px"><u>LAB : การตรวจอื่นๆ</u></strong></td>
      </tr>      
      <tr>
        <td height="52" valign="top"><table width="100%" border="0" class="text3">
<?
$sql2="SELECT * FROM  resulthead WHERE hn='".$result['hn']."'  and ( profilecode='METAMP' or profilecode='VDRL' or profilecode='HIV') and clinicalinfo ='CBC ,UA ,ST ,HIV ,VDRL ,AMP ,' order by labnumber desc";
//echo $sql."<br>";
	$query2 = mysql_query($sql2);
?>	
          <tr class="text3">
            <td align="center" bgcolor="#CCCCCC"><strong>Labcode </strong></td>
            <td bgcolor="#CCCCCC"><strong>ผล/Result</strong></td>
            <td bgcolor="#CCCCCC"><strong>&nbsp;</strong></td>
            <td align="center" bgcolor="#CCCCCC"><strong>&nbsp;</strong></td>
          </tr> 
<?
while($arrresult = mysql_fetch_array($query2)){

$strSQL = "SELECT * ,date_format(authorisedate,'%d-%m-%Y') as authorisedate2 FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);

$authorisename = $objResult["authorisename"];
$authorisedate  = $objResult["authorisedate2"];

/*if($objResult["labcode"]=='VDRL'){
	
	$objResult["result"]='NON REACTIVE';
	
}else{
	$objResult["result"]='NEGATIVE';
}*/
if($objResult["result"]=='positive' || $objResult["result"]=='Positive' || $objResult["result"]=='POSITIVE'){	
	$objResult["result"]="<strong style='color:red;'>".$objResult["result"]."</strong>";
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
    </table><div style="margin-top: 5px;"></div><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
        <tr>
          <td align="center"><strong class="text" style="font-size:22px"><u>X-RAY : การตรวจเอ็กเรย์ทรวงอก</u></strong></td>
        </tr>
        <tr valign="top" >
          <td valign="top">
          <? if($cxr=="Normal"){ ?>
          <div style="line-height:42px;">
          	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="text3">
            	<tr>
               		<td colspan="4" valign="top"><strong>ผล CXR : </strong><?=$cxr;?></td>
              	</tr>
            </table>
            </div>
            <? }else{ ?>
          	<table width="100%" border="0" cellpadding="0" cellspacing="1" class="text3">
            	<tr>
               		<td colspan="4" valign="top" height="40"><strong>ผล CXR : </strong><?=$cxr;?></td>
              	</tr>
            </table>
            <? } ?>
            </td>
        </tr>
    </table></td>
    <td  valign="top"><table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
      <tr valign="top">
        <td align="center" valign="top"><strong class="text" style="font-size:22px"><u>STOOL: การตรวจอุจาระ</u></strong></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" class="text3">
          <tr>
            <td align="center" bgcolor="#CCCCCC"><strong>Labcode </strong></td>
            <td bgcolor="#CCCCCC"><strong>ผล/Result</strong></td>
            <td bgcolor="#CCCCCC"><strong>&nbsp;</strong></td>
            <td align="center" bgcolor="#CCCCCC"><strong>&nbsp;</strong></td>
          </tr>
          <? $sql3="SELECT * FROM  resulthead WHERE hn='".$result['hn']."'  and profilecode='STOOL' and clinicalinfo='CBC ,UA ,ST ,HIV ,VDRL ,AMP ,' order by labnumber desc, autonumber desc";
	$query3 = mysql_query($sql3);
	$arrresult = mysql_fetch_array($query3);
/////


		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		while($objResult = mysql_fetch_array($objQuery))
		{
			
			
			if($objResult["result"]=='positive' || $objResult["result"]=='Positive' || $objResult["result"]=='POSITIVE'){	
				$objResult["result"]="<strong style='color:red;'>".$objResult["result"]."</strong>";
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
          <tr>
          <td colspan="4" style="line-height:5px;">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<? 
$sql4 = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
			$result4= mysql_query($sql4);
	$arr4 = mysql_fetch_assoc($result4);	
		$authorisename = $arr4["authorisename"];
		$authorisedate  = $arr4["authorisedate2"];
?>
<table width="100%" border="0" class="text3">
  <tr>
    <td  width="50%" class="textsub1" align="center"><strong>LAB : Authorise name :</strong>      <?=$authorisename?> &nbsp;<strong>Authorise date :</strong><strong>
<?=$authorisedate?> CXR : </strong>พ.ต.วริทธิ์ พสุธาดล (ว.38228) รังสีแพทย์<strong> (22-12-2016)</strong></td>
    
  </tr>
 
</table>
<div style="margin-top: 30px;">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text3">
  <tr>
    <td colspan="2">&nbsp;</td>
    <td width="40%">พ.ท.</td>
  </tr>
  <tr>
    <td colspan="2" valign="bottom">&nbsp;</td>
    <td height="35" valign="bottom"><div style="margin-left:26px;">(วรวิทย์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วงษ์มณี)</div></td>
  </tr>
  <tr>
    <td width="36%">&nbsp;</td>
    <td colspan="2" align="center">ประธานงานตรวจสุขภาพ โรงพยาบาลค่ายสุรศักดิ์มนตรี</td>
    </tr>
  <tr>
    <td colspan="3"></td>
    </tr>
</table>
</div>
</div>
<? 
	}
}
?>
<!--ปิดการแสดงเนื้อหา-->
</body>
</html>