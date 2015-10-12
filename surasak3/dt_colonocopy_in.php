<?php
session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}

$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");

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
.table_font2{font-family:"MS Sans Serif"; font-size:18px;}
.colo_fil{background-color:#006633; color:#C2FEFE;}
-->
</style>
</head>

<body>

<FORM METHOD=POST ACTION="">
<TABLE>
<TR>
	<TD>AN : </TD>
	<TD><INPUT TYPE="text" NAME="an" size="6"></TD>
</TR>
<TR>
	<TD colspan="2"><INPUT TYPE="submit" value="ตกลง">&nbsp;&nbsp;<A HREF="../nindex.htm">&lt;&lt; เมนู</A>&nbsp;&nbsp;<A HREF="dt_colonocopy_list.php" target="_blank"> ดูข้อมูลย้อนหลัง</A></TD>
</TR>
</TABLE>
</FORM>
<?php


if(!empty($_POST["an"]) && trim($_POST["an"]) != ""){

	$sql = "Select an, ptname, ptright, age, hn, left(bedcode,2) From ipcard where an='".$_POST["an"]."' limit 0,1";
	$result = mysql_query($sql);
	if(mysql_num_rows($result) <= 0){
		echo "<CENTER>ไม่พบหมายเลข AN ที่ท่านระบุ</CENTER>";
		exit();
	}
	list($p_an, $p_ptname, $p_ptright, $p_age, $p_hn, $bedcode) = mysql_fetch_row($result);
?>

<TABLE  border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#FFFF33; border-style:inherit;">
<TR>
	<TD>
<TABLE width="900">
<TR>
	<TD colspan="8" align="center"><font class="table_font2">ข้อมูลผู้ป่วย</font></TD>
</TR>
<TR>
	<TD align="right" class="colo_fil">AN : </TD>
	<TD><?php echo $p_an;?></TD>
	<TD align="right" class="colo_fil">ชื่อ-สกุล : </TD>
	<TD><?php echo $p_ptname;?></TD>
	<TD align="right" class="colo_fil">อายุ : </TD>
	<TD><?php echo $p_age;?></TD>
	<TD align="right" class="colo_fil">สิทธิ์การรักษา : </TD>
	<TD><?php echo $p_ptright;?></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<br />
<form name="f_colon" action="dt_colonocopy_print.php" target="_blank" method="post">
<table border="1" align="center" cellpadding="0" cellspacing="0" style="border-color:#FFFF33; border-style:inherit;">
  <tr>
    <td align="center"><strong class="table_font">Colonoscopy</strong> </td>
  </tr>
  <tr>
    <td><table border="0" align="center">
      <tr valign="top">
        <td colspan="2"><table class="table_font" width="368" border="0" align="center" >
            <tr>
              <td width="111" align="right" class="colo_fil">Financial : </td>
              <td width="247"><input name="financial" type="text" id="financial" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Endoscopist- 1 : </td>
              <td><input name="endoscopist-1" type="text" id="endoscopist-1" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Endoscopist- 2 : </td>
              <td><input name="endoscopist-2" type="text" id="endoscopist-2" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Consultant : </td>
              <td><input name="consultant" type="text" id="consultant" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Anesthesist : </td>
              <td><input name="anesthesist" type="text" id="anesthesist" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Instrument : </td>
              <td><input name="instrument" type="text" id="instrument" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Anesthesia : </td>
              <td><input name="anesthesia" type="text" id="anesthesia" /></td>
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
            <tr>
              <td align="right" valign="top" class="colo_fil">Consent : </td>
              <td><textarea name="consent" cols="35" rows="6" id="consent"></textarea></td>
            </tr>
        </table></td>
        <td width="331"><table border="0" align="center" class="table_font">
            <tr align="right" class="colo_fil">
              <td colspan="2" align="left">Finding # </td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Anal Canal : </td>
              <td><input name="anal_canal" type="text" id="anal_canal" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Rectun : </td>
              <td><input name="rectun" type="text" id="rectun" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Sigmoid colon : </td>
              <td><input name="sigmoid_colon" type="text" id="sigmoid_colon" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Descending colon : </td>
              <td><input name="descending_colon" type="text" id="descending_colon" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Splenic flexure : </td>
              <td><input name="splenic_flexure" type="text" id="splenic_flexure" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Transverse colon : </td>
              <td><input name="transverse_colon" type="text" id="transverse_colon" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Hepatic flexure : </td>
              <td><input name="hepatic_flexure" type="text" id="hepatic_flexure" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Ascending colon : </td>
              <td><input name="ascending_colon" type="text" id="ascending_colon" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Cecum : </td>
              <td><input name="cecum" type="text" id="cecum" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Terminal ileum : </td>
              <td><input name="terminal_ileum" type="text" id="terminal_ileum" /></td>
            </tr>
            <tr>
              <td align="right" class="colo_fil">Bowel preparation : </td>
              <td><input name="bowel_preparation" type="text" id="bowel_preparation" /></td>
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
        <td width="109" align="right" class="colo_fil">SIGNATURE : </td>
        <td width="326"><input name="signature" type="text" id="signature" /></td>
        <td >&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><input name="submit" type="submit" id="submit" value="ตกลง" />&nbsp;&nbsp;
      <input type="reset" name="Reset" value="ลบข้อมูล" /><input name="p_ptright" type="hidden" id="p_ptright"  value="<?php echo $p_ptright;?>"/></td>
  </tr>
</table>
<?php
	$sql = "Select (case when sex='ช' then 'ชาย' else 'หญิง' end) as sex_d From opcard where hn='".$p_hn."' limit 0,1";
	$result = mysql_query($sql);
	list($sex_d) = mysql_fetch_row($result);
?>
<input name="sex" type="hidden" id="sex" value="<?php echo $sex_d;?>"/>
<input name="ward" type="hidden" id="ward"  value="<?php echo $build[$bedcode];?>"/>
<input name="p_an" type="hidden" id="p_an"  value="<?php echo $_POST["an"];?>"/>
<input name="p_hn" type="hidden" id="p_an"  value="<?php echo $p_hn;?>"/>
<input name="p_name" type="hidden" id="p_name"  value="<?php echo $p_ptname;?>"/>
<input name="p_age" type="hidden" id="p_age"  value="<?php echo $p_age;?>"/>

<?php
	}	
?>
</form>
</body>
</html>
<?php include("unconnect.inc");?>