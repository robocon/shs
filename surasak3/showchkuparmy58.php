<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<? 
include("connect.inc");
$sql1="SELECT *
FROM `condxofyear_so`
WHERE `dxptright` = '1' AND `organ` = '��Ǩ�آ�Ҿ��Шӻ�' AND `yearcheck` = '2558' ORDER BY camp ASC, hn ASC";
$query1=mysql_query($sql1)or die (mysql_error());
?>
<h1 class="pdx" align="center">��ª��͡��ѧ�� ��. ����Ǩ�آ�Ҿ��Шӻ� 2558</h1>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#339966" class="pdxpro">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99">#</td>
    <td width="6%" align="center" bgcolor="#66CC99">HN</td>
    <td width="5%" align="center" bgcolor="#66CC99">��</td>
    <td width="7%" align="center" bgcolor="#66CC99">����</td>
    <td width="7%" align="center" bgcolor="#66CC99">���ʡ��</td>
    <td width="7%" align="center" bgcolor="#66CC99">����</td>
    <td width="7%" align="center" bgcolor="#66CC99">�����</td>
    <td width="7%" align="center" bgcolor="#66CC99">���˹�</td>
    <td width="7%" align="center" bgcolor="#66CC99">�ѧ�Ѵ/˹���</td>
    <td width="7%" align="center" bgcolor="#66CC99">�Է���ԡ</td>
    <td width="7%" align="center" bgcolor="#66CC99">�����Ҫ��� (�����)</td>
    <td width="8%" align="center" bgcolor="#66CC99">����ѵ��ä��Шӵ��</td>
    <td width="6%" align="center" bgcolor="#66CC99">���˹ѡ</td>
    <td width="7%" align="center" bgcolor="#66CC99">��ǹ�٧</td>
    <td width="15%" align="center" bgcolor="#66CC99">BP</td>
  </tr>
  <?
  $i=0;
  while($arr1=mysql_fetch_array($query1)){
  $i++;
  if($arr1['chunyot']=="CH01"){
  		$chunyot="��·��ê���ѭ�Һѵ�";
  }else if($arr1['chunyot']=="CH02"){
  		$chunyot="��·��ê�鹻�зǹ";
  }else if($arr1['chunyot']=="CH03"){
  		$chunyot="�١��ҧ��Ш�";
  }else if($arr1['chunyot']=="CH04"){
  		$chunyot="��ѡ�ҹ�Ҫ���";
  }else{
  		$chunyot="&nbsp;";
  }
  
  if($arr1['prawat']=="0"){
  		$prawat="������ä��Шӵ��";
  }else if($arr1['prawat']=="1"){
  		$prawat="�ä�����ѹ���Ե�٧";
  }else if($arr1['prawat']=="2"){
  		$prawat="�ä����ҹ";
  }else if($arr1['prawat']=="3"){
  		$prawat="�ä���������ä��ʹ���ʹ";
  }else if($arr1['prawat']=="4"){
  		$prawat="�ä��ѹ����ʹ�٧";
  }else if($arr1['prawat']=="5"){
  		$prawat="�ä��Шӵ�� 4 �ä����˹���������ѹ ����� 2 �ä���� ($arr1[congenital_disease])";
  }else if($arr1['prawat']=="6"){
  		$prawat="�ä��Шӵ�ǹ͡�˹�ͨҡ 4 �ä����˹����  ($arr1[congenital_disease])";
  }else{
  		$prawat="&nbsp;";
  }
   ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><? if(!empty($arr1['hn'])){ echo $arr1['hn'];}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['yot'])){ echo $arr1['yot'];}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['name'])){ echo $arr1['name'];}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['surname'])){ echo $arr1['surname'];}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['age'])){ echo $arr1['age'];}else{ echo "&nbsp;";}?></td>
    <td><?=$chunyot;?></td>
    <td><? if(!empty($arr1['position'])){ echo $arr1['position'];}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['camp'])){ echo $arr1['camp'];}else{ echo "&nbsp;";}?></td>
    <td><? if($arr1['dxptright']==1){ echo "�Է�Ԣ���Ҫ���";}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($arr1['ratchakarn'])){ echo $arr1['ratchakarn'];}else{ echo "-";}?></td>
    <td><?=$prawat;?></td>
    <td><?=$arr1['weight'];?></td>
    <td><?=$arr1['height'];?></td>
    <td><?=$arr1['bp1'].'/'.$arr1['bp2'];?></td>
  </tr>
  <? } ?>
</table>
