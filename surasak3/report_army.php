<?php
include("../connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
$y="Y";
$sql = "select * from condxofyear_so where yearcheck='2557' and (anemia='$y' or cardiomegaly='$y' or waistline='$y' or ihd='$y' or emphysema='$y' or cystitis='$y' or cardiac='$y' or degeneration='$y' or bph='$y' or tonsil='$y' or conanemia='$y' or cirrhosis='$y' or allergy='$y' or asthma='$y' or thyroid='$y' or herniated='$y' or epilepsy='$y' or spine='$y' or alcoholic='$y' or kidney='$y' or paralysis='$y' or hepatitis='$y' or gout='$y' or muscle='$y' or heart='$y' or conjunctivitis='$y' or fracture='$y' or dermatitis='$y' or copd='$y' or pterygium='$y' or blood='$y')";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
//echo $num;
?>
<p align="center">�ѭ����ª��͢���Ҫ���</p>
<p>����Ѻ��õ�Ǩ��ҧ��»�Шӻ� &nbsp;2557<br>
˹��� &nbsp;���.32 </p>
<table width="100%" border="0">
  <tr>
    <td colspan="3">1. �ӹǹ����Ҫ��÷���èب�ԧ</td>
    <td width="18%">&nbsp;</td>
    <td width="46%">&nbsp;</td>
  </tr>
  <tr>
    <td width="4%">&nbsp;</td>
    <td colspan="2">- ��·���</td>
    <td align="right">235</td>
    <td>��</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">- ����Ժ</td>
    <td align="right">749</td>
    <td>��</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">- ������, ���ҹ, �١��ҧ</td>
    <td align="right">37</td>
    <td>��</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">���</td>
    <td align="right">1021</td>
    <td>��</td>
  </tr>
  <tr>
    <td colspan="3">2. �ӹǹ����Ҫ��÷���Ѻ��õ�Ǩ</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">- ��·���</td>
    <td align="right">217</td>
    <td>��</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">- ����Ժ</td>
    <td align="right">734</td>
    <td>��</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">- ������, ���ҹ, �١��ҧ</td>
    <td align="right">35</td>
    <td>��</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="15%" align="center">&nbsp;</td>
    <td width="17%" align="left">���</td>
    <td align="right">986</td>
    <td>��</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="left">����Ѻ��õ�Ǩ</td>
    <td align="right"> 96.57 �����繵�</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center"><strong>�ӴѺ</strong></td>
    <td width="19%" align="center"><strong>�� - ����</strong></td>
    <td width="11%" align="center"><strong>����</strong></td>
    <td width="6%" align="center"><strong>���˹ѡ</strong></td>
    <td width="6%" align="center"><strong>�٧</strong></td>
    <td width="7%" align="center"><strong>�ͺ���</strong></td>
    <td width="46%" align="center"><strong>�ҡ���ä����Ǩ��������Ҿ��������������ͧ��ҧ��¤��йӻ�ԺѵԢͧᾷ��</strong></td>
  </tr>
<?
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$camp = $rows["camp"];
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["age"];?></td>
    <td><?=$rows["weight"];?></td>
    <td><?=$rows["height"];?></td>
    <td><?=$rows["round_"];?></td>
    <td>
	<?
    if($rows["anemia"]=="Y"){
		echo "���Ե�ҧ, ";
	}
    if($rows["cardiomegaly"]=="Y"){
		echo "�����, ";
	}
    if($rows["waistline"]=="Y"){
		echo "�ͺ����Թ, ";
	}
    if($rows["ihd"]=="Y"){
		echo "�ä���㨢Ҵ���ʹ������ѧ, ";
	}
    if($rows["emphysema"]=="Y"){
		echo "�ا���觾ͧ, ";
	}
    if($rows["cystitis"]=="Y"){
		echo "�����л�������ѡ�ʺ, ";
	}
    if($rows["cardiac"]=="Y"){
		echo "�����鹼Դ�ѧ���, ";
	}
    if($rows["degeneration"]=="Y"){
		echo "������������, ";
	}
    if($rows["bph"]=="Y"){
		echo "BPH, ";
	}
    if($rows["tonsil"]=="Y"){
		echo "�����͹����, ";
	}
    if($rows["conanemia"]=="Y"){
		echo "���Ыմ, ";
	}
    if($rows["cirrhosis"]=="Y"){
		echo "�Ѻ��, ";
	}
    if($rows["allergy"]=="Y"){
		echo "������, ";
	}
    if($rows["asthma"]=="Y"){
		echo "�ͺ�״, ";
	}
    if($rows["thyroid"]=="Y"){
		echo "���´�, ";
	}
    if($rows["herniated"]=="Y"){
		echo "��͹�ͧ��д١�Ѻ��鹻���ҷ, ";
	}
    if($rows["epilepsy"]=="Y"){
		echo "���ѡ, ";
	}
    if($rows["spine"]=="Y"){
		echo "��д١�ѹ��ѧ (͡) ��, ";
	}
    if($rows["alcoholic"]=="Y"){
		echo "�����Դ���Ԩҡ��š�����, ";
	}
    if($rows["kidney"]=="Y"){
		echo "䵼Դ����, ";
	}
    if($rows["paralysis"]=="Y"){
		echo "����ҵ�ա����/���, ";
	}
    if($rows["hepatitis"]=="Y"){
		echo "�ä�Ѻ�ѡ�ʺ, ";
	}
    if($rows["gout"]=="Y"){
		echo "�ä��ҷ�, ";
	}
    if($rows["muscle"]=="Y"){
		echo "����������ѡ�ʺ, ";
	}
    if($rows["heart"]=="Y"){
		echo "�ä����, ";
	}
    if($rows["conjunctivitis"]=="Y"){
		echo "����ͺص��ѡ�ʺ, ";
	}
    if($rows["fracture"]=="Y"){
		echo "��д١�ѡ����͹, ";
	}
    if($rows["dermatitis"]=="Y"){
		echo "���˹ѧ�ѡ�ʺ, ";
	}
    if($rows["copd"]=="Y"){
		echo "COPD, ";
	}
    if($rows["pterygium"]=="Y"){
		echo "�������, ";
	}
    if($rows["blood"]=="Y"){
		echo "������ʹ�Դ����, ";
	}
													
	?>
    </td>
  </tr>
 <?
 }
 ?>
</table>
