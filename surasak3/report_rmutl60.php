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
<span class="tet1">พิมพ์ใบตรวจสุขภาพนักศึกษาใหม่ราชมงคล 2560</span><br />
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
<?
	include("connect.inc");	
	$sql="SELECT  a.course, a.branch, b.hn, b.ptname, b.weight, b.height, b.bp1, b.bp2, b.p FROM opcardchk AS a INNER  JOIN out_result_chkup AS b ON a.HN = b.hn WHERE a.part='ราชมงคลลำปาง60' and a.active='y'  order by a.row";
	//echo $sql;
	$cquery=mysql_query($sql);
	$num=mysql_num_rows($cquery);
	while($result=mysql_fetch_array($cquery)){
		$ht = $result['height']/100;
		$bmi=number_format($result['weight'] /($ht*$ht),2);
?>
<div id="divprint">
<p></p><p></p>
<table width="100%" border="0">
  <tr>
    <td><table width="100%">
      <tr>
        <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" alt="" width="87" height="83" /></td>
        <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพนักศึกษาใหม่ มทร.ล้านนา ลำปาง</strong></td>
        <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305 ต่อ 1132</strong></td>
        <td align="center" valign="top" class="texthead">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่ 29-30 เดือน มิถุนายน พ.ศ. 2560</span></span></span></td>
        <td align="center" valign="top" class="text3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"   class="text1"  style="border-collapse:collapse; border-top-style:none">
      <tr>
        <td  valign="top" class="text2"><strong class="text" style="font-size:22px"><u>ข้อมูลผู้ตรวจสุขภาพ </u></strong> <strong>&nbsp;&nbsp;&nbsp;HN : <?=$result['hn'];?>&nbsp;&nbsp;ชื่อ : <?=$result['ptname'];?>&nbsp;&nbsp;<?=$result['course'];?></strong></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000"  class="text1"  style="border-collapse:collapse; border-top-style:none">
      <tr>
        <td width="588" valign="top"><strong class="text" style="font-size:20px"><u>ตรวจร่างกายทั่วไป</u></strong>&nbsp;&nbsp;<span class="text3"><strong>น้ำหนัก: </strong>
              <?=$result['weight'];?>
          กก. <strong>ส่วนสูง:</strong>
          <?=$result['height'];?>
          ซม. <strong>BMI: </strong> <u>
            <?=$bmi?>
            </u><strong>BP:<u>
              <?=$result['bp1'];?>
              /
              <?=$result['bp2'];?>
              mmHg. </u></strong><strong>P: </strong> <u>
                <?=$result['p'];?>
                ครั้ง/นาที </u></span></td>
      </tr>
      <tr>
        <td valign="top"><strong style="font-size:20px;">ผลตรวจ : </strong><span style="font-size:16px;"> ดัชนีมวลกาย
          <? if($bmi == 'na'  ){
				  			echo "NA";
						}else if($bmi >= 18.5 && $bmi <= 22.99){
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
          <? if($result["bp1"]=='na'){
							echo "NA";
						}elseif($result["bp1"] <= 130){
							echo "ปกติ";
						}else{
							if($result["bp1"] >=140){ 
								echo "มีความดันโลหิตสูง ควรต้องควบคุมอาหารอย่างเคร่งครัด โดยเฉพาะอาหารที่มีรสเค็มและออกกำลังกาย";
							}else if($result["bp1"] >=131 && $result["bp1"] < 140){
								echo "เริ่มมีภาวะความดันโลหิตสูง ควรตรวจซ้ำหรือออกกำลังกายอย่างสม่ำเสมอ";
							}
						}
				  ?>
        </span> </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td  valign="top">
<?
$sql="SELECT * FROM resulthead WHERE hn='".$result['hn']."' and profilecode='METAMP' and clinicalinfo='ตรวจสุขภาพราชมงคลลำปาง60'";
$query = mysql_query($sql);
$arrresult = mysql_fetch_array($query);
	
$sql = "Select *, date_format(authorisedate,'%d-%m-%Y') as authorisedate2 From resultdetail where autonumber = '".$arrresult['autonumber']."' ";
$result2= mysql_query($sql);
$arr2 = mysql_fetch_assoc($result2);	
$authorisename = $arr2["authorisename"];
$authorisedate  = $arr2["authorisedate2"];
$labcode  = $arr2["labcode"];
$labname  = $arr2["labname"];

if($arr2["result"]=="Negative"){
	$labresult="Negative (ปกติ)";
}else if($arr2["result"]=="Positive"){
	$labresult="Positive (ผิดปกติ)";
}else{
	$labresult="ไม่มีผลการตรวจ";
}

?>    
      <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; border-top-style:none;">
        <tr>
          <td align="center"><strong class="text" style="font-size:20px"><u>ผลการตรวจ</u></strong></td>
        </tr>
        <tr>
          <td><strong class="text" style="font-size:18px"><u>LAB </u>&nbsp;&nbsp;&nbsp;&nbsp;</u>Metamphetamine : &nbsp;<strong><?="Negative";?></strong> <? echo " (ปกติ)";?></strong></td>
        </tr>
        <tr>   
          <td><strong class="text" style="font-size:18px"><u>X-RAY</u>&nbsp;&nbsp;&nbsp;&nbsp;</u>CXR : <? if($result2["cxr"]==""){ echo "รอผล"; }else{ echo $result2["cxr"]; }?></strong>
          </td>
        </tr>
        <tr>  
        </tr>
    </table>    </td>
  </tr>
</table>
<table width="100%" border="0" class="text4">
  <tr>
    <td  width="50%" align="center"><strong>Authorise  LAB : </strong><?=$authorisename;?> <strong> (<?=$authorisedate;?>) CXR : </strong>พ.ต.วริทธิ์ พสุธาดล (ว.38228) รังสีแพทย์<strong> (30-07-2560)</strong></td>
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