<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}

//session_register("esophago_add");
//$_SESSION["esophago_add"] = true;
include("connect.inc");

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
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.table_font{font-family:"MS Sans Serif"; font-size:14px;}
.colo_fil{background-color:#006633; color:#C2FEFE;}
-->
</style>
</head>

<body>

<?php

include("dt_menu.php");
$style_menu="2";
include("dt_patient.php");

?>
<br />
<A HREF="dt_esophago_list.php" target="_blank">ดูข้อมูลย้อนหลัง</A>
<form name="f_colon" action="dt_esophago_print.php" target="_blank" method="post">
<table border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#FFFF33; border-style:inherit;">
  <tr>
    <td align="center"><strong class="table_font">Esophago</strong> </td>
  </tr>
  <tr>
    <td><table border="0" align="center">
      <tr valign="top">
        <td colspan="2"><table class="table_font" width="368" border="0" align="center" >
            <tr>
              <td width="111" align="right" class="colo_fil">No : </td>
              <td width="247"><input name="no" type="text" id="no" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Medication : </td>
              <td><input name="medication" type="text" id="medication" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Indication : </td>
              <td><input name="indication" type="text" id="indication" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Pre-Diagnosis : </td>
              <td><input name="pre-diagnosis" type="text" id="pre-diagnosis" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Brief History : </td>
              <td><input name="brief_history" type="text" id="brief_history" /></td>
            </tr>
        </table></td>
        <td width="331"><table border="0" align="center" class="table_font">
            <tr align="right" class="colo_fil">
              <td colspan="2" align="left">Finding # </td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">OROPHA : </td>
              <td><input name="oropha" type="text" id="oropha" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Esophagus : </td>
              <td><input name="esophagus" type="text" id="esophagus" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">EG junction  : </td>
              <td><input name="eg_junction" type="text" id="eg_junction" /></td>
            </tr>
            <tr>
              <td colspan="2" align="left" class="colo_fil">Stomach :</td>
              </tr>
            <tr>
              <td align="right" class="colo_fil">Cardia : </td>
              <td><input name="cardia" type="text" id="cardia" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Fundus : </td>
              <td><input name="fundus" type="text" id="fundus" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Body : </td>
              <td><input name="body" type="text" id="body" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Antrum : </td>
              <td><input name="antrum" type="text" id="antrum" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Pylorus : </td>
              <td><input name="pylorus" type="text" id="pylorus" /></td>
            </tr>
            <tr>
              <td colspan="2" align="left" class="colo_fil">Duooenum : </td>
              </tr>
            <tr>
              <td align="right" class="colo_fil">Bulb : </td>
              <td><input name="bulb" type="text" id="bulb" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">2nd Portion  : </td>
              <td><input name="2nd_portion" type="text" id="2nd_portion" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Post-Diagnosis(DX1) : </td>
              <td><input name="post-diagnosis" type="text" id="post-diagnosis" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Complication : </td>
              <td><input name="complication" type="text" id="complication" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Histopathology : </td>
              <td><input name="histopathology" type="text" id="histopathology" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Clo-test : </td>
              <td><input name="clo_test" type="text" id="clo_test" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">therapy : </td>
              <td><input name="therapy" type="text" id="therapy" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">recommendation : </td>
              <td><input name="recommendation" type="text" id="recommendation" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Notes/Comments : </td>
              <td><input name="notes/comments" type="text" id="notes/comments" /></td>
            </tr>
        </table></td>
      </tr>
      <tr valign="middle">
        <td width="109" align="right" class="colo_fil">Endoscopist : </td>
        <td width="326"><input name="signature" type="text" id="signature" /></td>
        <td >&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><input name="submit" type="submit" id="submit" value="ตกลง" />&nbsp;&nbsp;
      <input type="reset" name="Reset" value="ลบข้อมูล" /></td>
  </tr>
</table>
<?php
	$sql = "Select (case when sex='ช' then 'ชาย' else 'หญิง' end) as sex_d From opcard where hn='".$_SESSION["hn_now"]."' limit 0,1";
	$result = mysql_query($sql);
	list($sex_d) = mysql_fetch_row($result);
?>
<input name="sex" type="hidden" id="age" value="<?php echo $sex_d;?>"/>
<input name="ward" type="hidden" id="age"  value="OPD"/>
</form>
</body>
</html>
<?php include("unconnect.inc");?>