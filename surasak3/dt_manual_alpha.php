<?php 
session_start();
include("connect.inc");
?>
<html>
<head>
<title>วินิจฉัยโรค Manual</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_detail2 {background-color: #FFFFFF;  }

-->
</style>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	
	document.form_vn.vn_now.focus();

}

</SCRIPT>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"></head>
</body>
<a href='../nindex.htm'>&lt;&lt;ไปเมนู</a>
<BR>
<table width="100%" border="0">
  <tr>
    <td>
<FORM name="form_vn" METHOD=POST ACTION="dt_manual_alpha.php">
<input name="act" type="hidden" value="show">
<TABLE width="319">
<TR>
	<TD>
		<TABLE>
		<TR>
			<TD width="65"><strong>HN : </strong></TD>
			<TD width="160"><INPUT TYPE="text" NAME="hn_now"></TD>
			<TD width="70">&nbsp;</TD>
		</TR>
		<TR>
			<TD><strong>แพทย์ : </strong></TD>
			<TD>
<? 
$strSQL = "SELECT name FROM doctor  where status='y' order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<option value="MD089  เลอปรัชญ์ มังกรกนกพงศ์" selected="selected">MD089  เลอปรัชญ์ มังกรกนกพงศ์</option>
<?
while($objResult = mysql_fetch_array($objQuery)) {
	if($app1['doctor']==$objResult["name"]){
?>
<option value="<?=$objResult["name"]?>" selected="selected"><?=$objResult["name"]?></option>
<?
	}else{
?>
<option value="<?=$objResult["name"];?>" ><?=$objResult["name"];?></option>    
<?
	}
}
?>
</select></TD>
			<TD>&nbsp;</TD>
		</TR>
		<TR>
		  <TD>&nbsp;</TD>
		  <TD><INPUT TYPE="submit" value="ตกลง"></TD>
		  <TD>&nbsp;</TD>
		  </TR>
		</TABLE>
	</TD>
</TR>
</TABLE>
</FORM>
</td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
<?
if($_POST["act"]=="show"){
$sql="select * from dxofyear_out where hn='".$_POST["hn_now"]."'";
$query=mysql_query($sql);
?>
<table width="60%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>#</strong></td>
    <td width="19%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="29%" align="center" bgcolor="#66CC99"><strong>ชื่อสกุล</strong></td>
    <td width="32%" align="center" bgcolor="#66CC99"><strong>ชื่อหน่วยงาน</strong></td>
  </tr>
<?
if(mysql_num_rows($query) < 1){
	echo "<tr><td colspan='5' align='center'>----------------------------- ไม่มีข้อมูล -----------------------------</td></tr>";
}
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["thidate"];?></td>
    <td align="center"><a href="dxdr_ofyearout_dr_alpha.php?hn_now=<?=$rows["hn"];?>&doctor=<?=$_POST["doctor"];?>&thidate=<?=$rows["thidate"];?>"><?=$rows["hn"];?></a></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["camp"];?></td>
  </tr>
  <?
  }
  ?>
</table>

<?
}
?>
</body>

<?php include("unconnect.inc");?>
</html>