<? 
session_start();
?>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<script language="javascript">
////// �礤����ҧ
function fncSubmit()
{
	
	var fn = document.f1;
	if(fn.depart.value=="0")
	{
		alert('��س����͡Ἱ�');
		fn.depart.focus();
		return false;
	}
	
	if(fn.head.value=="")
	{
		alert('��سҡ�͡��Ǣ��');
		fn.head.focus();
		return false;
	}
	
	if(fn.phone.value=="")
	{
		alert('��سҡ�͡�������Ѿ������');
		fn.phone.focus();
		return false;
	}
	fn.submit();
}

</script>
<body bgcolor="#FFFFFF" >

<form method="POST" action="comadd1.php" name="f1" id="f1">
<table class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#CCCCCC"><span class="forntsarabun">�к��� �������/��Ѻ��ا ������� ������ç��Һ�Ť�������ѡ��������&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><--------- �����</a></span></td>
    </tr>
  <tr>
    <td width="80">Ἱ�</td>
    <td width="100"><!--<input name="depart" type="text" class="forntsarabun" size="20">-->
    <select name="depart" id="depart" class="forntsarabun">
	<option value="0">���͡Ἱ�</option>
<?
include("connect.inc");
		$sql="select  *  from   departments where status='y' order by id asc";
		$result=mysql_query($sql);
			while($arr=mysql_fetch_array($result)) {
    		echo '<option value="'.$arr['name'].'">'.$arr['name'].' </option>';
		}
	  ?>
      </select></td>
    </tr>
  <tr>
    <td>��Ǣ��</td>
    <td colspan="3"><input name="head" id="head" type="text" class="forntsarabun" size="40">  
    <font color="#FF0000">*** �к����ٷ���ջѭ���������ٷ���ͧ�����䢴��¤�Ѻ ***</font></td>
    </tr>
  <tr>
    <td valign="top">��������´</td>
    <td colspan="3"><TEXTAREA NAME="detail" COLS="100" ROWS="10" class="forntsarabun"></TEXTAREA></td>
    </tr>
  <tr>
    <td>�����</td>
    <td><input name="user" type="text" class="forntsarabun" size="20" value="<?=$sOfficer;?>"></td>
    <td width="96">���Ѿ������</td>
    <td width="518"><input name="phone" id="phone" type="text" class="forntsarabun" size="20"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3"><input name="B1" type="submit" class="forntsarabun" value="��ŧ" onClick="JavaScript:return fncSubmit()">
      <input name="B2" type="reset" class="forntsarabun" value="ź���"></td>
    </tr>
</table>
</form>

</body>

