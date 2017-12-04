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
<span class="tet1">พิมพ์หน้าซอง</span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;กรอก HN : </span>
    <input name="hn" type="text" size="10" class="tet1" id="hn">
  &nbsp;
  <input name="ok" type="submit" class="texthead" value="ตกลง">
  <br />
  <br />
  <hr />
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

	$select2 = "select * from opcardchk where HN='".$_POST['hn']."' ";
	$row2 = mysql_query($select2)or die (mysql_error());
	$result2 = mysql_fetch_array($row2);

?>
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
        <td width="77%" align="center" valign="top" class="texthead"><strong>ผลตรวจสุขภาพ</strong></td>
        </tr>
      <tr>
        <td align="center" valign="top" class="texthead"><span class="text1"><span style="font-size:24px"><strong>
           <?=$result2['yot']?><?=$result2['name']?> <?=$result2['surname']?></strong>
          &nbsp;<strong>HN:</strong> <strong><?=$result2['HN']?>
         </strong></span></span></td>
      </tr>
    
      <tr>
        <td align="center" valign="top" class="text1"><strong> <br />
         ตรวจเมื่อวันที่ 16 มีนาคม 2558<br> โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง </strong></td>
        </tr>
    </table></td>
  </tr>
</table>
<? } ?>
</body>
</html>