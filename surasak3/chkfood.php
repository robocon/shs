<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
 <style type="text/css">
<!--
.font1 {
	font-family:"TH Niramit AS";
	font-size:22px;
}
-->
</style>
<body>
<script>
function chknull(){
	if(document.form1.menu.selectedIndex==0)
	{
		alert('��س����͡��¡�������');
		document.form1.menu.focus();
		return false;
	}
	document.form1.submit();
}
</script>
<? $lbedcode=substr($_GET['code'],0,2); ?>
<form id="form1" name="form1" method="post" action="allfood.php?code=<?=$lbedcode;?>" onsubmit="JavaScript:return chknull();">
  <table border="0" class="font1" align="center">
    <tr>
      <td colspan="2" align="center">��س����͡ ��¡�������</td>
    </tr>
    <tr>
      <td><select name="menu" class="font1">
      <option value="0">��س����͡��¡�������</option>
      <option value="��������">��������</option>
      <option value="����á�ҧ�ѹ">����á�ҧ�ѹ</option>
      <option value="��������">��������</option>
      </select>
      </td>
      <td><input type="submit" name="b1" value="��ŧ"  class="font1"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><a target=_self  href="../nindex.htm">/-----��Ѻ����</a></td>
    </tr>
  </table>
</form>
</body>
</html>