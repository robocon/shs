<?
include("connect.inc");
$sql="select * from comservice where row_id='$_GET[id]'";
//echo $sql;
$query=mysql_query($sql); 
$num=mysql_num_rows($query);         
$rows=mysql_fetch_array($query);  
	$ited_request1=$rows["datework"];
	list($y,$m,$d)=explode("-",$ited_request1);
	$y=$y+543;
	$newdate="$d/$m/$y";	
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style1 {
	font-size: 20px;
	font-weight: bold;
}
-->
</style>
<div align="center">
<div class="style1">㺢����/��������������к��������������͢���</div>
<div>�ͧ/Ἱ� �ٹ���ԡ�ä��������� �͡��������Ţ FR-COM-001/1 ��䢤��駷�� 04 �ѹ����ռźѧ�Ѻ�� 15 ��.�. 46</div>
<div>
<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border:#000000 solid 1px;">
  <tr>
    <td width="50%" valign="top"><p align="center"><strong>��������´�����ŷ������/�������</strong><strong> </strong></p></td>
    <td width="25%" valign="top"><p align="center"><strong>�����ͧ��</strong><strong> </strong></p></td>
    <td width="25%" valign="top"><p align="center"><strong>����Ѻ�ҹ</strong></p></td>
  </tr>
  <tr>
    <td valign="top"><div style="margin-top: 10px; margin-bottom: 100px; margin-left:5px;"><?=$rows["detail"];?></div><br /><br /><br /><br /><br /><br /><br /></td>
    <td align="center" valign="top"><div style="margin-top: 10px;">........................................<br />
      (<?=$rows["personal"];?>)<br /><?=$newdate;?></div></td>
    <td align="center" valign="top"><div style="margin-top: 10px;">........................................<br />
      (<?=$rows["personal"];?>)<br /><?=$newdate;?></div></td>
  </tr>
  <tr>
    <td colspan="3"><strong style="margin-left: 280px;">�š�û�Ժѵԧҹ/�ѭ��</strong></td>
    </tr>
  <tr>
    <td valign="top"><div style="margin-top: 10px; margin-bottom: 100px; margin-left: 5px;">
      <? echo "���Թ������º����";?>
    </div><br /><br /><br /></td>
    <td colspan="2" align="center" valign="top"><div style="margin-top: 10px;">........................................<br />(<?=$rows["user"];?>)<br />���Ѳ�������<br /><?=$newdate;?></div></td>
    </tr>
</table>
</div>
<div style="margin-top:50px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45%"><div style="margin-left:10px;"><p>- ͹��ѵ� <br />
      <span style="margin-left: 35px;">�.�......................................................</span><br />
      <span style="margin-left: 85px;">(�Ѱ���� �ؤء�)</span><br />
      <span style="margin-left: 95px;">��. þ.�����</span><br />
     <span style="margin-left: 45px;"> ............./................../..................</span></p></div></td>
    <td width="10%">&nbsp;</td>
    <td width="45%"><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ŧ����).................................................................... <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(...................................................................) <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(���˹�)................................................................. </p></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;"><p>- ���¹ ��.þ.�����<br />
      �Ԩ�ó������������èѴ�ӴѺ������觴�ǹ  �����ӴѺ���......... <br />
      ���д��Թ���  �ѹ���.........../.........../..............<br />
      �֧�ѹ���.........../.........../..............  �<br />
      <br />
      <span style="margin-left: 35px;">(ŧ����)..................................................................</span><br />
      <span style="margin-left: 65px;">(.................................................................)</span><br />
      <span style="margin-left: 25px;">��иҹ��С���������ʹ������Ǫ����¹ þ.�����</span></p>
      <span style="margin-left: 75px;">............./................../..................</span></div></td>
    <td>&nbsp;</td>
    <td><p>- ���¹ ��.þ.�����  (��ҹ��С���������ʹ��) <br />
      ............................................................................................ <br />
      ............................................................................................ <br />
      ............................................................................................ <br />
      ............................................................................................ <br />
      ............................................................................................<br /> 
      <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�.�................................................................................ <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(��ྪà �ʧ��ըѹ���)<br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;˹.�ٹ���ԡ�ä���������  þ.����� <br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;............./................../..................</p></td>
  </tr>
</table>

</div>
</div>
