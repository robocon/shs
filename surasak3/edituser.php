<?
session_start();
include("connect.inc");
if($_POST["act"]=="edit"){
				$add="update inputm set name='".$_POST["txtname"]."' where row_id='".$_POST["row_id"]."'";
				if(mysql_query($add)){
					echo "<script>alert('��䢢����Ťس $_POST[txtname] ���º��������');window.location='showuser.php?menucode=$_POST[menucode]';</script>";
				}else{
					echo "<script>alert('!!! �Դ��Ҵ�������ö��䢢�������');window.location='edituser.php?menucode=$_POST[menucode]&id=$_POST[row_id]';</script>";
				}
}
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
-->
</style>
<div align="center">
<p><strong>��䢢����ż����ҹ�к�</strong><br>
</p>
<?
$sql="select * from inputm where row_id='".$_GET["id"]."' and menucode='".$_GET["menucode"]."'";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
$rows=mysql_fetch_array($query);
?>
<form action="edituser.php" method="post" name="form1">
<input name="act" type="hidden" value="edit">
<input name="row_id" type="hidden" value="<?=$_GET["id"];?>">
<input name="menucode" type="hidden" value="<?=$_GET["menucode"];?>">
<table width="50%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="34%" align="right" bgcolor="#FF9999"><strong>����-���ʡ�� : </strong></td>
    <td width="66%" bgcolor="#FFCCCC"><label>
      <input name="txtname" type="text" class="forntsarabun" id="txtname" size="25" value="<?=$rows["name"];?>">
    </label></td>
  </tr>
  <tr>
    <td bgcolor="#FF9999">&nbsp;</td>
    <td bgcolor="#FF9999"><label>
      <input type="submit" name="button" id="button" class="forntsarabun" value="��䢢�����">
    </label></td>
  </tr>
</table>
</form>
</div>

