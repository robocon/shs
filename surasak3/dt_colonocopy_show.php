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

$sql = "Select *,date_format(thidate,'%d-%m-') as date_d, date_format(thidate,'%H:%i') as date_h, date_format(thidate,'%Y') as date_y From dr_colonoscopy where row_id = '".$_GET["id"]."' limit 0,1";
$arr = mysql_fetch_assoc(mysql_query($sql));

?>

<center>
  <span class="style1"><u>Colonoscopy Report</u></span>
</center>
<table class="table_font" width="681" border="0" align="center" style="line-height:0.8;">
  <tr>
    <td align="right">Name : </td>
    <td width="156"><?php echo $arr['ptname'];?></td>
    <td width="70" align="right">Age : </td>
    <td width="125"><?php echo $arr['age'];?></td>
    <td width="48" align="right">Sex : </td>
    <td width="108"><?php echo $arr['gender'];?></td>
  </tr>
  <tr>
    <td align="right">HN : </td>
    <td><?php echo $arr['hn'];?></td>
    <td align="right">Data/Time : </td>
    <td><?php echo $arr["date_d"].($arr["date_y"]+543)." ".$arr["date_h"];?></td>
    <td align="right">Ward : </td>
    <td><?php echo $arr["ward"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Financial : </td>
    <td colspan="5"><?php echo $arr["financial"];?></td>
  </tr>
  <tr>
    <td align="right">Endoscopist- 1 : </td>
    <td colspan="5"><?php echo $arr["endo1"];?></td>
  </tr>
  <tr>
    <td align="right">Endoscopist- 2 : </td>
    <td colspan="5"><?php echo $arr["endo2"];?></td>
  </tr>
  <tr>
    <td align="right">Consultant : </td>
    <td colspan="5"><?php echo $arr["consul"];?></td>
  </tr>
  <tr>
    <td align="right">Anesthesist : </td>
    <td colspan="5"><?php echo $arr["anesthesist"];?></td>
  </tr>
  <tr>
    <td align="right">Instrument : </td>
    <td colspan="5"><?php echo $arr["instrument"];?></td>
  </tr>
  <tr>
    <td align="right">Anesthesia : </td>
    <td colspan="5"><?php echo $arr["anesthesiaa"];?></td>
  </tr>
  <tr>
    <td align="right">Medication : </td>
    <td colspan="5"><?php echo $arr["medication"];?></td>
  </tr>
  <tr>
    <td align="right">Indication : </td>
    <td colspan="5"><?php echo $arr["indication"];?></td>
  </tr>
  <tr>
    <td align="right">Pre-Diagnosis : </td>
    <td colspan="5"><?php echo $arr["pre-diagnosis"];?></td>
  </tr>
  <tr>
    <td align="right">Brief History : </td>
    <td colspan="5"><?php echo $arr["brief"];?></td>
  </tr>
  <tr>
    <td align="right">Consent : </td>
    <td colspan="5"><?php echo $arr["consent"];?></td>
  </tr>
</table>
<br />
<table width="681" border="0" align="center" class="table_font"  style="line-height:0.8;">
  <tr align="right">
    <td colspan="2" align="left">Finding # </td>
  </tr>
  <tr>
    <td width="148" align="right">Anal Canal : </td>
    <td width="523"><?php echo $arr["anal"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Rectun : </td>
    <td><?php echo $arr["rectun"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Sigmoid colon : </td>
    <td><?php echo $arr["sigmoid"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Descending colon : </td>
    <td><?php echo $arr["desending"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Splenic flexure : </td>
    <td><?php echo $arr["splenic"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Transverse colon : </td>
    <td><?php echo $arr["transverse"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Hepatic flexure : </td>
    <td><?php echo $arr["hepatic"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Ascending colon : </td>
    <td><?php echo $arr["ascending"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Cecum : </td>
    <td><?php echo $arr["cecum"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Terminal ileum : </td>
    <td><?php echo $arr["terminal"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Bowel preparation : </td>
    <td><?php echo $arr["bowel"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Post-Diagnosis(DX1) : </td>
    <td><?php echo $arr["post_diag"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Complication : </td>
    <td><?php echo $arr["complication"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Histopathology : </td>
    <td><?php echo $arr["histopatho"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">therapy : </td>
    <td><?php echo $arr["therapy"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">recommendation : </td>
    <td><?php echo $arr["recommen"];?></td>
  </tr>
  <tr>
    <td width="148" align="right">Notes/Comments : </td>
    <td><?php echo $arr["notes"];?></td>
  </tr>
</table>
<br />

<table width="681" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>SIGNATURE : <?php echo $arr["signature"]?></td>
  </tr>
  <tr>
    <td>ห้องตรวจทางเดินอาหารและลำไส้ รพ.ค่ายสุรศักดิ์มนตรี</td>
  </tr>
</table>
<font class="tb_search"><CENTER><A HREF="Javascript:window.print();" >พิมพ์หน้านี้</A></CENTER></font>
</body>
</html>
<?php include("unconnect.inc");?>