<?
session_start();
?>
<script language="JavaScript">
function checksubmit() {
if(document.form1.slipcode.value=="") {
alert("��س��к����ʨ�����") ;
document.form1.slipcode.focus() ;
return false ;
}else if(document.form1.detail1.value=="") {
alert("��س��к���¡��1") ;
document.form1.detail1.focus() ;
return false ;
}else if(document.form1.detail2.value=="") {
alert("��س��к���¡��2") ;
document.form1.detail2.focus() ;
return false ;
}else if(document.form1.detail3.value=="") {
alert("��س��к���¡��3") ;
document.form1.detail3.focus() ;
return false ;
}
}
</script>
<body>
<?php include("dt_menu.php");?>
<form name="form1" method="POST" action="dt_rxadd.php">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
  <p>&nbsp;&nbsp;&nbsp;<strong>���������ŷ���ҡ��</strong></p>
  <p>&nbsp;&nbsp; &#3619;&#3627;&#3633;&#3626;&#3592;&#3656;&#3634;&#3618;&#3618;&#3634;&nbsp; &nbsp;&nbsp;&nbsp;
  <input type="text" name="slipcode" id="slipcode" size="12">
  ���ʵ�ͧ����Թ 10 ����ѡ��
  </p>
  <p>&nbsp;&nbsp; &#3619;&#3634;&#3618;&#3585;&#3634;&#3619; 1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="text" name="detail1" id="detail1" size="48">
  ������ҧ. �Ѻ��зҹ������ 1 ���
  </p>
  <p>&nbsp;&nbsp; &#3619;&#3634;&#3618;&#3585;&#3634;&#3619; 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="detail2" id="detail2" size="48"> 
  ������ҧ. �ѹ�� 3 ���� ��ѧ�����</p>
  <p>&nbsp;&nbsp; &#3619;&#3634;&#3618;&#3585;&#3634;&#3619; 3&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
  <input type="text" name="detail3" id="detail3" size="48"> 
  ������ҧ. ���-��ҧ�ѹ-���</p>
  <p>&nbsp;&nbsp; &#3619;&#3634;&#3618;&#3585;&#3634;&#3619; 4&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
  <input type="text" name="detail4" id="detail4" size="1"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;
  <input type="submit" value="  &#3605;&#3585;&#3621;&#3591;  " onClick="JavaScript:return checksubmit();" name="B1">&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  " name="B2"></p>
  <p>&nbsp;</p>
</form>

</body>

