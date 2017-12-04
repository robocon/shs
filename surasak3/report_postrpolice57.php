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
	font-size: 27px;
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
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">พิมพ์ซองผลตรวจสุขภาพตำรวจ57</span><br />
  <input name="ok" type="submit" class="texthead" value="ตกลง">
  <br />
  <br />
  <hr />
</center>
</form>
</div>
<? 
if(isset($_POST['ok'])){
	
	include("connect.inc");

	$select2 = "SELECT  b.hn, b.ptname, b.weight, b.height, b.bp1, b.bp2, b.p FROM opcardchk AS a INNER  JOIN out_result_chkup AS b ON a.HN = b.hn WHERE a.part ='สอบตำรวจ57' order by b.hn limit 0,100  ";
	$row2 = mysql_query($select2)or die (mysql_error());
	while($result2 = mysql_fetch_array($row2)){

?>
<div id="divprint">
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<table width="100%" border="0">
  <tr>
    <td width="100%"><table width="100%">
      <tr>
        <td width="77%" align="center" valign="top" class="texthead"><strong>ผลตรวจร่างกาย</strong></td>
        </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><span class="text1"><span style="font-size:24px"><strong>
           <?=$result2['ptname']?></strong>
          &nbsp;<strong>HN:</strong> <strong><?=$result2['hn']?>
         </strong></span></span></td>
      </tr>
    
      <tr>
        <td align="center" valign="top" class="text1"><strong> <br />
         ตรวจเมื่อวันที่ 12 กันยายน 2557<br> โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง </strong></td>
        </tr>
    </table></td>
  </tr>
</table>
</div>
<? }} ?>
</body>
</html>