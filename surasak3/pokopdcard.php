<?
session_start();
include("connect.inc");
$_GET['hn']="47-1";
$sql="SELECT *, concat(yot,name,' ',surname) as ptname FROM `opcard` WHERE  hn = '".$_GET['hn']."'";
$query=mysql_query($sql) or die (mysql_error());
$rows=mysql_fetch_array($query);
explode("-",$rows["dbirth"])
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
#head1 {
  font-family:"TH SarabunPSK";
  font-size: 20px;
  font-weight:bold;
}
#head2 {
  font-family:"TH SarabunPSK";
  font-size: 18px;
  font-weight:bold;
}
#tdbottom {
  border-bottom:solid 1px #000;
}
#td-left {
  border-left:solid 1px #000;
}
#td-leftbottom {
  border-bottom:solid 1px #000;
  border-left:solid 1px #000;
}
#td-leftdashedbottom {
  border-bottom:dashed 1px #000;
  border-left:solid 1px #000;
}

-->
</style>
<div align="center">
<div align="center" id="head1">�ѵúѹ�֡����Ѻ��ԡ�� �ç��Һ�Ť��¡�����</div>
<div align="center" id="head2">285 �.��§����-�Ӿٹ �.�Ѵࡵ �.���ͧ��§���� �.��§���� 50000 ���Ѿ�� 053-245784</div>
<div align="center">
<table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#000000" style="border-top:solid 1px #000; border-right: solid 1px #000; border-bottom: solid 1px #000; border-left: solid 1px #000;">
  <tr>
    <td colspan="3" id="tdbottom" ><strong>�Ţ���ѵ÷ͧ</strong><?=$rows[""];?></td>
    <td width="277" rowspan="2" align="left" valign="top" id="td-leftbottom"><strong>�Է�ԡ���ѡ��</strong> <?=$rows["ptright"];?></td>
    <td colspan="3" rowspan="2" align="left" valign="top" id="td-leftbottom"><strong>HN</strong> <?=$rows["hn"];?></td>
  </tr>
  <tr>
    <td colspan="3" id="tdbottom"><strong>�Ţ���ѵû�ЪҪ�</strong> <?=$rows["idcard"];?></td>
    </tr>
  <tr>
    <td colspan="4" id="tdbottom"><strong>����-ʡ��</strong> <?=$rows["ptname"];?></td>
    <td colspan="3" align="left" valign="top" id="td-leftbottom"><strong>�ѹ ��͹ �� �Դ</strong> <?=$rows["ptname"];?></td>
  </tr>
  <tr>
    <td width="180" id="tdbottom"><strong>�� 
      <? 
		if($rows["sex"]=="�"){
			echo "���";
		}else if($rows["sex"]=="�"){
			echo "˭ԧ";
		}else{
			echo "������к�";
		}	  
	  ?>
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>�ѧ�Ѵ 
      <?=$rows["camp"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td width="271" align="left" id="td-left"><strong>��Ǩ�����á�����</strong></td>
    <td colspan="2" align="center" id="td-leftbottom"><strong>�Ţ�������</strong></td>
    </tr>
  <tr>
    <td id="tdbottom"><strong>���� 
      <?=$rows["ptname"];?>
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>�Ҫվ 
      <?=$rows["career"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td align="left" id="td-leftbottom"><strong>���ѹ�֡</strong></td>
    <td width="97" id="td-leftdashedbottom">&nbsp;</td>
    <td width="87" id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" width="180" id="tdbottom"><strong>��ʹ� 
      <?=$rows[" 	religion"];?>
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>�������ʹ 
      <?=$rows["blood"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td id="td-left"><strong>X-ray</strong></td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" id="tdbottom"><strong>��ҹ�Ţ��� 
      <?=$rows["address"];?>
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>������
    </strong></td>
    <td align="left" width="277" id="tdbottom"><strong>���
    </strong></td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" id="tdbottom"><strong>���
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>�Ӻ� 
      <?=$rows["tambol"];?>
    </strong></td>
    <td align="left" id="tdbottom"><strong>����� 
      <?=$rows["ampur"];?>
    </strong></td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" id="tdbottom"><strong>�ѧ��Ѵ 
      <?=$rows["changwat"];?>
    </strong></td>
    <td colspan="2" align="left" id="tdbottom"><strong>ʶҹ�Ҿ���� 
      <?=$rows["ptname"];?>
    </strong></td>
    <td align="left" id="tdbottom"><strong>���Ѿ�� 
      <?=$rows["ptname"];?>
    </strong></td>
    <td id="td-leftbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left" id="tdbottom"><strong>�Դ� 
      <?=$rows["ptname"];?>
    </strong></td>
    <td align="left" width="192" id="tdbottom"><strong>��ô� 
      <?=$rows["ptname"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td id="td-left"><strong>����</strong></td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left" id="tdbottom"><strong>���� 
      <?=$rows["ptname"];?>
    </strong></td>
    <td align="left" id="tdbottom"><strong>����� 
      <?=$rows["ptname"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="left" id="tdbottom"><strong>�����Դ����</strong>� <strong>
      <?=$rows["ptname"];?>
    </strong></td>
    <td align="left" id="tdbottom"><strong>����Ǣ�ͧ�� 
      <?=$rows["ptname"];?>
    </strong></td>
    <td id="tdbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" id="tdbottom"><strong>���Ѿ�� 
      <?=$rows["ptname"];?>
    </strong></td>
    <td colspan="2" id="tdbottom">&nbsp;</td>
    <td id="tdbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
    <td id="td-leftdashedbottom">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><strong>(�������͡��¹͡�ç��Һ��)</strong></td>
    <td id="td-left">&nbsp;</td>
    <td id="td-left">&nbsp;</td>
    <td id="td-left">&nbsp;</td>
  </tr>
</table>

</div>
</div>
