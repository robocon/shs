<?
session_start();
include("connect.inc");

// ź������
if($_GET["act"]=="del"){
	$getid=$_GET["id"];
	$del="delete from drugslip where row_id='$getid'";
	if(mysql_query($del)){
		echo "<script>alert('ź���������º����');window.location='dgslip.php';</script>";									
	}else{
		echo "<script>alert('�Դ��Ҵ �������öź��������');window.location='dgslip.php';</script>";
	}
}
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
  <form name="form1" method="post" action="<? $PHP_SELF; ?>">
    <tr>
      <td align="center" valign="bottom"><p><strong>�����Ըա������ :</strong> 
          <input type="text" name="txt" size="30" value="<?=$txt;?>" />
                  &nbsp;
          <input type="submit" name="button" id="button" value="���Ң�����" style="height:25px; font-family:'TH SarabunPSK'; font-size:16px;" />
      <p><a target=_self  href='../nindex.htm'><< �����</a></p></td>
    </tr>
  </form>
</table>
<?
if($_POST["txt"]=="") {
$query = "SELECT * FROM drugslip";
}else{
$query = "SELECT * FROM drugslip where slcode like '%$_POST[txt]%'";
}
$result = mysql_query($query) or die("Query failed");
$num=mysql_num_rows($result);
?>
<table width="100%" border="1" cellpadding="0" style="border-collapse:collapse; border-color: #000000;">
 <tr>
	<td width="4%" height="25" align="center" bgcolor="#FF9933"><strong>�ӴѺ���</strong></td>
	<td width="11%" align="center" bgcolor="#FF9933"><strong>����</strong></td>
    <td width="23%" align="center" bgcolor="#FF9933"><strong>�Ը���1</strong></td>
    <td width="20%" align="center" bgcolor="#FF9933"><strong>�Ը���2</strong></td>
    <td width="18%" align="center" bgcolor="#FF9933"><strong>�Ը���3</strong></td>    
    <td width="15%" align="center" bgcolor="#FF9933"><strong>�Ը���4</strong></td>
    <td width="9%" align="center" bgcolor="#FF9933"><strong>��кǹ���</strong></td>
 </tr>
<?
if(empty($num)){
echo "
	<tr>
		<td colspan='7' align='center' bgcolor='#EBF2D3' class='style3'>---------- ����բ�������к� ----------</td>
	</tr>
";
}else{
	$i=0;
	while($rows=mysql_fetch_array($result)){
	$i++;
?> 
 <tr>
   <td height="23" align="center" bgcolor="#EBF2D3"><?=$i;?></td>
   <td width="11%" align="left" bgcolor="#EBF2D3"><?=$rows["slcode"];?></td>
   <td align="left" bgcolor="#EBF2D3"><?=$rows["detail1"];?></td>
   <td align="left" bgcolor="#EBF2D3"><?=$rows["detail2"];?></td>
   <td align="left" bgcolor="#EBF2D3"><?=$rows["detail3"];?></td>   
   <td align="left" bgcolor="#EBF2D3"><?=$rows["detail4"];?></td>
   <td align="center" bgcolor="#FFCC99"><a href="dgslip_edit.php?id=<?=$rows["row_id"];?>">���</a>&nbsp;&nbsp;&nbsp;
   <a href="dgslip.php?act=del&id=<?=$rows["row_id"];?>" onClick="return confirm('�س��ͧ���ź��¡�ù���ԧ�������?');">ź</a></td>
 </tr>
<?
	}
}
?> 
</table>  
