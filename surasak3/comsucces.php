<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<body bgcolor="#FFFFFF" >
<script language="javascript">
function fncSubmit()
{
	if(document.edit.p_edit.value=="")
	{
		alert('���š�ô��Թ�ҹ');
		document.edit.p_edit.focus();		
		return false;
	}	
	
	document.edit.submit();
}

</script>
<?
 include("connect.inc");
 
 $row=$_GET['row'];
 
 $query = "SELECT  *  FROM com_support   WHERE row ='$row'";
 $result = mysql_query($query)or die("Query failed"); 
 $dbarr=mysql_fetch_array($result);

?>

<form method="POST" action="?do=edit" onSubmit="JavaScript:return fncSubmit();" name="edit">
<table class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#CCCCCC"><span class="forntsarabun">�к��� �������/��Ѻ��ا ������� ������ç��Һ�Ť�������ѡ��������&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><--------- �����</a></span></td>
    </tr>
  <tr>
    <td>��Ǣ��</td>
    <td colspan="3"><input name="head" type="text" class="forntsarabun" value="<?=$dbarr['head'];?>" size="40" readonly></td>
    </tr>
  <tr>
    <td valign="top">��������´</td>
    <td colspan="3"><textarea name="detail" cols="100" rows="10" readonly class="forntsarabun"><?=$dbarr['detail'];?>
    </textarea></td>
    </tr>
  <tr>
    <td>�����</td>
    <td><input name="user" type="text" class="forntsarabun" value="<?=$dbarr['user'];?>" size="20" readonly></td>
    <td width="96">���Ѿ������</td>
    <td width="518"><input name="phone" type="text" class="forntsarabun" value="<?=$dbarr['phone'];?>" size="20" readonly></td>
  </tr>
  <tr>
    <td>����Ѻ�Դ�ͺ</td>
    <td colspan="3"><select name="programmer" class="forntsarabun" >
     <option value="0" selected>==��س����͡==</option>
    <option value="��Թ" <? if($dbarr['programmer']=="��Թ"){ echo "selected"; } ?>>��Թ</option>
	<option value="��ɳ��ѡ���" <? if($dbarr['programmer']=="��ɳ��ѡ���"){ echo "selected"; } ?>>��ɳ��ѡ���</option>
    </select>
    </td>
    </tr>
  <tr>
    <td valign="top">�š�ô��Թ�ҹ</td>
    <td colspan="3"><textarea name="p_edit" cols="100" rows="5" class="forntsarabun"></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input name="B1" type="submit" class="forntsarabun" value="��ŧ">
    <input type="hidden" name="row" value="<?=$row;?>">
      <input name="B2" type="reset" class="forntsarabun" value="ź���"></td>
    </tr>
</table>
</form>

<?

if($_REQUEST['do']=='edit'){
	$thidate = (date("Y")+543).date("-m-d H:i:s"); 

	$row=$_POST['row'];
	$p_edit=$_POST['p_edit'];
	$programmer=$_POST['programmer'];
	
	$update="UPDATE com_support SET status='n', p_edit='".$p_edit."' ,dateend='$thidate' , programmer='$programmer' Where row='$row' ";
	$query=mysql_query($update);
	
	
	//echo $update;
	 if($query){
			echo"<h1 align=center>�ѹ�֡���������º��������</h1>";
//		 	echo "<meta http-equiv='refresh' content='2; url=com_support.php'>" ;
			
			?>
<script>

window.open('','_self');
setTimeout("self.close()",2000);
window.opener.location.reload();
</script>
            <?
			}else {
			echo "<h1 align=center>�������ö������������</h1>";
		//	echo "<meta http-equiv='refresh' content='2; url=com_support.php'>" ;
			?>
            <script>

window.open('','_self');
setTimeout("self.close()",2000);
window.opener.location.reload();
</script>
            <?
			}
		
	

}
?>

</body>

