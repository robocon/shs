<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style>
	<!--
body,td,th {
	font-family: Angsana New;
	font-size: 22px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.table_font{font-family:"MS Sans Serif"; font-size:10px;}
.colo_fil{background-color:#006633; color:#C2FEFE;}
.style1 {
	font-size: 28px;
	font-weight: bold;
	font-weight:lighter;
}
-->
</style>
<style media="print">
	.tb_search{
		display:none;
	}
</style>
<SCRIPT LANGUAGE="JavaScript">

	window.onload = function(){
		//window.print();
		//window.close();
	}

</SCRIPT>

</head>

<body>
<?php
include("connect.inc");

//$_GET["id"] = $_GET["id"]*1;
if(!is_numeric ($_GET["id"]))
	exit();

$sql = "Select *,date_format(date,'%d-%m-') as date_d, date_format(date,'%H:%i') as date_h, date_format(date,'%Y') as date_y From dr_esophago where row_id = '".$_GET["id"]."' limit 0,1";
$arr = mysql_fetch_assoc(mysql_query($sql));

?>

<table class="table_font" width="722" border="0"  style="line-height:0.8;">
<tr>
    <td align="center" colspan="8"  class="style1"><u>EsophagoGastroDuodenoscopy Report</u></td>
  </tr>
  <tr>
    <td width="98" align="right">Name : </td>
    <td width="162"><?php echo $arr["ptname"];?></td>
    <td width="70" align="right">Age : </td>
    <td width="125"><?php echo $arr["age"];?></td>
    <td width="27" align="right">&nbsp;</td>
    <td width="70" align="right">&nbsp;</td>
    <td width="43" align="right">Sex : </td>
    <td width="93"><?php echo $arr["gender"];?></td>
  </tr>
  <tr>
    <td align="right">HN : </td>
    <td><?php echo $arr["hn"];?></td>
    <td align="right">Data/Time : </td>
    <td><?php echo $arr["date_d"].($arr["date_y"]+543)." ".$arr["date_h"];?></td>
    <td align="right">No.</td>
    <td align="left"><?php echo $arr["no"];?></td>
    <td align="right">Ward :</td>
    <td><?php echo $arr["ward"];?></td>
  </tr>
  <tr>
    <td align="right">Medication : </td>
    <td colspan="2"><?php echo $arr["medication"];?></td>
	<td colspan="5" rowspan="4"><!-- <IMG SRC="sac.gif" WIDTH="100" HEIGHT="173" BORDER="0" ALT=""> --></td>
  </tr>
  <tr>
    <td align="right">Indication : </td>
    <td colspan="2"><?php echo $arr["indication"];?></td>
  </tr>
  <tr>
    <td align="right">Pre-Diagnosis : </td>
    <td colspan="2"><?php echo $arr["pre_diagnosis"];?></td>
  </tr>
  <tr>
    <td align="right">Brief History : </td>
    <td colspan="2"><?php echo $arr["brief_history"];?></td>
  </tr>
</table>

<table  border="0" >
  <tr>
    <td  align="right" valign="top"><table  width="270" border="0" align="center" class="table_font"  style="line-height:0.8;">
      <tr align="right">
        <td colspan="2" align="left">Finding # </td>
      </tr>
      <tr>
        <td width="120" align="right">Oropha : </td>
        <td align="left"><?php echo $arr["oropha"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Esophagus : </td>
        <td align="left"><?php echo $arr["esophagus"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">EG Junction: </td>
        <td align="left"><?php echo $arr["eg_junction"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Stomach&nbsp;&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="120" align="right">Cardia : </td>
        <td align="left"><?php echo $arr["cardia"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Fundus : </td>
        <td align="left"><?php echo $arr["fundus"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Body : </td>
        <td align="left"><?php echo $arr["body"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Antrum : </td>
        <td align="left"><?php echo $arr["antrum"];?></td>
      </tr>
      <tr>
        <td width="120" align="right">Pylorus : </td>
        <td align="left"><?php echo $arr["pylorus"];?></td>
      </tr>
    </table></td>
    <td  valign="top">
	<table width="270" class="table_font"  style="line-height:0.8;">
      <tr>
        <td width="145" align="right">Duodenum&nbsp;&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td width="145" align="right">Bulb : </td>
        <td ><?php echo $arr["bulb"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">2nd Portion  : </td>
        <td ><?php echo $arr["2nd_portion"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">Post-Diagnosis(DX1) : </td>
        <td ><?php echo $arr["post_diagnosis_dx1"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">Complication : </td>
        <td ><?php echo $arr["complication"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">Histopathology : </td>
        <td ><?php echo $arr["histopathology"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">Clo-test : </td>
        <td ><?php echo $arr["clo_test"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">therapy : </td>
        <td ><?php echo $arr["therapy"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">recommendation : </td>
        <td ><?php echo $arr["recommendation"];?></td>
      </tr>
      <tr>
        <td width="145" align="right">Notes/Comments : </td>
        <td ><?php echo $arr["notes_comments"];?></td>
      </tr>
    </table></td>
	<td  valign="top">
	<IMG SRC="sac.gif" WIDTH="100" HEIGHT="173" BORDER="0" ALT="">
	</td>
  </tr>
</table>
<table width="681" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>Endoscopist : <?php echo $arr["endoscopist"]?></td>
  </tr>
  <tr>
    <td>ห้องตรวจทางเดินอาหารและลำไส้ รพ.ค่ายสุรศักดิ์มนตรี</td>
  </tr>
</table>
<font class="tb_search"><CENTER><A HREF="Javascript:window.print();" >พิมพ์หน้านี้</A></CENTER></font>
</body>
</html>
<?php include("unconnect.inc");?>