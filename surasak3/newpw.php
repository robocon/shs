<?php
    session_start();
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
<script language="javascript">
////// �礤����ҧ
function fncSubmit()
{
	
	var fn = document.f1;
	if(fn.password.value=="")
	{
		alert('��سҡ�͡���ʼ�ҹ���');
		fn.password.focus();
		return false;
	}
	
	if(fn.newpw1.value=="")
	{
		alert('��سҡ�͡���ʼ�ҹ����');
		fn.newpw1.focus();
		return false;
	}
	
	if(fn.newpw2.value=="")
	{
		alert('��س��׹�ѹ���ʼ�ҹ����');
		fn.newpw2.focus();
		return false;
	}
	fn.submit();
}

</script>
<br />
<br />
<form method="POST" action="chgpword.php" name="f1" id="f1">
  <div align="left">
    <table border="0" cellpadding="3" cellspacing="0" width="100%" height="202">
      <tr>
        <td height="33" align="right">&nbsp;</td>
        <td align="left"><b>����¹���ʼ�ҹ����</b></td>
      </tr>
      <tr>
        <td width="21%" height="33" align="right"><strong>���ʼ���� : &nbsp;
        </strong></td>
        <td width="74%" align="left">
          <input name="username" type="text" class="forntsarabun" value="<?=$sIdname;?>" readonly="readonly">
          <br></td>
      </tr>
      <tr>
        <td height="33" align="right"><strong>���ʼ�ҹ��� : &nbsp;</strong></td>
        <td align="left"><input name="password" id="password" type="password" class="forntsarabun" /></td>
      </tr>
      <tr>
        <td height="33" align="right"><strong>���ʼ�ҹ���� : &nbsp;</strong></td>
        <td align="left"><input name="newpw1" id="newpw1" type="password" class="forntsarabun" /></td>
      </tr>
      <tr>
        <td height="33" align="right"><strong>�׹�ѹ�������� : &nbsp;</strong></td>
        <td align="left"><input name="newpw2" id="newpw2" type="password" class="forntsarabun" /></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td align="left"><input name="B1" type="submit" class="forntsarabun" value="����¹���ʼ�ҹ"  onClick="JavaScript:return fncSubmit()"></td>
      </tr>
    </table>
  </div>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
</form>

