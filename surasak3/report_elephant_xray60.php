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
	font-size: 20px;
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
<body>
<div id="no_print">
<form name="formdx" action="<? $_SERVER['PHP_SELF'];?>" method="post">
<center>
<span class="tet1">พิมพ์ใบตรวจสุขภาพ XRAY มูลนิธิคืนช้างสู่ธรรมชาติ</span><br />
  <input type="submit" name="ok" value="พิมพ์ผล XRAY" style="width:200px; height:40px; font:'TH SarabunPSK'; font-size:20px;">
  <br />
  <br /> 
</center>
</form>
</div>
<!--แสดงเนื้อหา-->
<? 
if(isset($_POST['ok'])){
?>
<?
	include("connect.inc");	
	$sql="SELECT * 
FROM  `opcardchk` 
WHERE `HN` !=  '60-3341' AND  `part` 
LIKE  'มูลนิธิคืนช้างสู่ธรรมชาติ60' AND  `branch` 
LIKE  'ประกันสังคม'  order by row";
	//echo $sql;
	$cquery=mysql_query($sql);
	$num=mysql_num_rows($cquery);
	while($result=mysql_fetch_array($cquery)){
		$ht = $result['height']/100;
		$bmi=number_format($result['weight'] /($ht*$ht),2);
		
		$sql21="select * from out_result_chkup where hn='".$result["HN"]."' and part='".$result["part"]."'";
		//echo $sql2;
		$query21=mysql_query($sql21);
		$result21=mysql_fetch_array($query21);		
?>
<div id="divprint">
<p></p><p></p>
<table width="100%" border="0">
  <tr>
    <td><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="101" height="96" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานผลการตรวจสุขภาพประจำปี 2560<br>หน่วยงาน : มูลนิธิคืนช้างสู่ธรรมชาติ</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong class="text2">โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305 ต่อ 1132</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่ 2 เดือน สิงหาคม พ.ศ. 2560</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"   class="text1"  style="border-collapse:collapse; border-top-style:none">
      <tr>
        <td  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>ข้อมูลผู้ตรวจสุขภาพ </u></strong> <strong>&nbsp;&nbsp;&nbsp;HN : <?=$result['HN'];?>&nbsp;&nbsp;ชื่อ : <?=$result['name']." ".$result["surname"];?></strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top">   
    
<?
$sql1="SELECT * FROM resulthead WHERE hn='".$result['HN']."' and clinicalinfo='ตรวจสุขภาพประจำปี60' and profilecode='XYLENE' order by autonumber desc";
//echo $sql1;
$query = mysql_query($sql1);
$arrresult = mysql_fetch_array($query);
	
$sql2 = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
//echo $sql2;
$result2= mysql_query($sql2);
$arr2 = mysql_fetch_assoc($result2);	
$authorisename = $arr2["authorisename"];
$authorisedate  = $arr2["authorisedate2"];
$labcode  = $arr2["labcode"];
$labname  = $arr2["labname"];
//$result  = $arr2["result"];

?>      
      <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none;">
        <tr>
          <td align="center"><strong class="text" style="font-size:20px"><u>ผลการตรวจ</u></strong></td>
        </tr>
        <tr>
          <td><strong class="text" style="font-size:18px">ผลการตรวจเอกซ์เรย์ (X-RAY) : &nbsp;<? if(empty($result21["cxr"])){ echo "ปกติ";}else{ echo $result21["cxr"];}?></strong></td>
        </tr>        
        <tr>        </tr>
    </table>    </td>
  </tr>
</table>
<table width="100%" border="0" class="text4">
  <tr>
    <td width="50%" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
        <td width="40%" class="text3">&nbsp;</td>
        <td width="13%" class="text3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="40%" class="text3">&nbsp;</td>
        <td width="13%" class="text3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="left" class="text3">ตรวจถูกต้อง พ.ท.</td>
        <td class="text3">&nbsp;</td>
      </tr>
      <tr>
        <td width="47%">&nbsp;</td>
        <td align="center" class="text3">(วรวิทย์ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วงษ์มณี)</td>
        <td class="text3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" class="text3">กุมารแพทย์</td>
        <td class="text3">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center" class="text3">ปฏิบัติหน้าที่ประธานฝ่ายตรวจสุขภาพ โรงพยาบาลค่ายสุรศักดิ์มนตรี</td>
        <td class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>

</div>
<? 
	}
}
?>
<!--ปิดการแสดงเนื้อหา-->
</body>
</html>