<?
session_start();
include("connect.inc");
//echo $_SESSION["smenucode"].$_SESSION["sOfficer"];
// แก้ไขข้อมูล
if($_POST["act"]=="edit"){
$rowid=$_POST["row_id"];
$datekey=date("Y-m-d H:i:s");
$edit="update drugslip set slcode='$_POST[slcode]',
										detail1='$_POST[detail1]',
										detail2='$_POST[detail2]',
										detail3='$_POST[detail3]',
										detail4='$_POST[detail4]' where row_id=$rowid";

		if(mysql_query($edit)){
			$add="insert into log_drugslip set slcode='$_POST[slcode]', action='edit', username='".$_SESSION["sOfficer"]."', menucode='".$_SESSION["smenucode"]."', datekey='$datekey'";
			mysql_query($add);
			echo "<script>alert('แก้ไขข้อมูลเรียบร้อยแล้ว');window.location='dgslip.php';</script>";									
		}else{
			echo "<script>alert('ผิดพลาด ไม่สามารถแก้ไขข้อมูลได้');window.location='dgslip_edit.php?id=$rowid';</script>";
		}
}
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?
$getid=$_GET["id"];
$sql="SELECT * FROM drugslip where row_id='$getid'";
$query=mysql_query($sql); 
$rows=mysql_fetch_array($query);
?>
<form name="form1" method="post" action="dgslip_edit.php">
<input name="act" type="hidden" id="act" value="edit">
<input name="row_id" type="hidden" id="row_id" value="<?=$rows["row_id"];?>">
<table width="40%" border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#FFCC99">
  <tr>
    <td colspan="2" align="center"><strong>แก้ไขข้อมูลวิธีการใช้ยา</strong></td>
  </tr>
  <tr>
    <td width="39%" align="right"><strong>รหัสวิธีการใช้ : </strong></td>
    <td width="61%"><label>
      <input type="text" name="slcode" id="slcode" value="<?=$rows["slcode"];?>">
    </label></td>
  </tr>
  <tr>
    <td align="right"><strong>วิธีการใช้ 1 : </strong></td>
    <td><input name="detail1" type="text" id="detail1" size="40" value="<?=$rows["detail1"];?>"></td>
  </tr>
  <tr>
    <td align="right"><strong>วิธีการใช้ 2 : </strong></td>
    <td><input name="detail2" type="text" id="detail2" size="40" value="<?=$rows["detail2"];?>"></td>
  </tr>
  <tr>
    <td align="right"><strong>วิธีการใช้ 3 : </strong></td>
    <td><input name="detail3" type="text" id="detail3" size="40" value="<?=$rows["detail3"];?>"></td>
  </tr>
  <tr>
    <td align="right"><strong>วิธีการใช้ 4 : </strong></td>
    <td><input name="detail4" type="text" id="detail4" size="40" value="<?=$rows["detail4"];?>"></td>
  </tr>
  <tr>
    <td height="52">&nbsp;</td>
    <td><label>
      <input type="submit" name="button" id="button" value="แก้ไขข้อมูล" style="height:30px; font-family:'TH SarabunPSK'; font-size:18px;">
    </label></td>
  </tr>
</table>
</form>
