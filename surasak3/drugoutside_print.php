<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Ẻ��觫�������з��ѵ���� �͡�ç��Һ��</title>
</head>
<style type="text/css">
.font1 {
	font-family: "TH Niramit AS";
	font-size:20px;
}
.font2 {
	font-family: "TH Niramit AS";
	font-size:22px;
}
</style>
<body onload="window.print() ;">

<? 
 include("connect.inc");
 
 
$month['01'] = "���Ҥ�";
$month['02'] = "����Ҿѹ��";
$month['03'] = "�չҤ�";
$month['04'] = "����¹";
$month['05'] = "����Ҥ�";
$month['06'] = "�Զع�¹";
$month['07'] = "�á�Ҥ�";
$month['08'] = "�ԧ�Ҥ�";
$month['09'] = "�ѹ��¹";
$month['10'] = "���Ҥ�";
$month['11'] = "��Ȩԡ�¹";
$month['12'] = "�ѹ�Ҥ�";	

$sql="select * from  drugoutside as b WHERE  b.row_id='".$_GET['id']."' ";
$result = mysql_query($sql);
$arr=mysql_fetch_array($result);

$showdate=substr($arr['regisdate'],0,10);

$showdate1=explode("-",$showdate);

if($arr['typedoc']=='N'){
$typedoc="�ç��Һ������ը�˹���";
}else{
$typedoc="�ç��Һ���ը�˹��������ͧ�ҡ�Ҵ����";
}
?>
<br />
<div align="right" class="font1" style="width:80%;">�Ţ���   <?=$arr['runno'];?>

</div>
<h1 class="font2" align="center" style="height:20PX;">��Ѻ�ͧ��¡������������������������ը�˹����ʶҹ��Һ��</h1>
<!--<h1 class="font2" align="center" style="height:20PX;">�ç��Һ�Ť�������ѡ�������� �.�ӻҧ</h1>-->
<!--<h1 class="font2" align="center">�ô������ͧ���� / ŧ㹪�ͧ ( ) �������駡�͡��ͤ���</h1>-->
<hr width="60%" />
<table border="0" align="center"  class="font1">
  <tr>
    <td colspan="4">��Ҿ���
      <?=$arr['yot'];?>
    &nbsp;<?=substr($arr['doctor'],6);?>  </td>
    <td>[
      <? if($arr['type']=='���ᾷ�����ѡ��'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>
]
      ���ᾷ�����ѡ��   [
<? if($arr['type']=='���˹��ʶҹ��Һ��'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>
]
    ���˹��ʶҹ��Һ��</td>
  </tr>
  <tr>
    <td colspan="5">����ç��Һ��...............�ç��Һ�Ť�������ѡ��������.............. �ѧ��Ѵ.............�ӻҧ &nbsp;&nbsp;&nbsp;&nbsp;���Ѻ�ͧ���</td>
  </tr>
  <tr>
    <td colspan="5" class="font1"><input type="hidden" name="ptname" value="<?=$arr['yot'].$arr['name'].' '.$arr['surname'];?>" /><?=$arr['ptname'];?>&nbsp;&nbsp;&nbsp;&nbsp;HN  : <?=$arr['hn'];?><input type="hidden" name="hn" value="<?=$arr['hn'];?>" /> 
      &nbsp;&nbsp;�Է�� :
<?=$arr['ptright'];?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��觻������ä .......
    <?=$arr['diag'];?> .......</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="font1">[ <? if($arr['action']=='A'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?> ]
      �.���繵�ͧ��</td>
    <td colspan="2">[ <? if($arr['action_detail']=='��'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?> ] �� </td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">[ <? if($arr['action_detail']=='���ʹ�����ǹ��Сͺ�ͧ���ʹ������÷�᷹'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ]  ���ʹ�����ǹ��Сͺ�ͧ���ʹ������÷�᷹ </td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">[ <? if($arr['action_detail']=='��͡��ਹ'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ] ��͡��ਹ</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">[ <? if($arr['action_detail']=='����������'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?> ] ����������</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">[ <? if($arr['action_detail']=='�ػ�ó�㹡�úӺѴ�ѡ���ä'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ]
      �ػ�ó�㹡�úӺѴ�ѡ���ä</td>
  </tr>
  <tr>
    <td colspan="5" align="center" class="font1">�����¡�â�ҧ��ҧ��� ��� ����ը�˹�����ç��Һ������ʶҹ��Һ����觹��</td>
  </tr>
  <tr>
    <td colspan="5" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="font1">[  <? if($arr['action']=='B'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ]  �.���繵�ͧ����Ѻ��õ�Ǩ</td>
    <td colspan="2">[ <? if($arr['action_detail']=='�ҧ��ͧ���ͧ'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ]
      �ҧ��ͧ���ͧ</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">[ <? if($arr['action_detail']=='��ꡫ����'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ]
      ��ꡫ����
</td>
  </tr>
  <tr>
    <td colspan="5" align="center" class="font1">�����¡�â�ҧ��ҧ��� �������ը�˹�����ç��Һ������ʶҹ��Һ����觹���������ö����ԡ����</td>
  </tr>
  <tr>
    <td colspan="5" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" class="font1">�к� ��¡��</td>
  </tr>
  <? 
$sql2="select * from  drugoutside_list as b WHERE  b.ref_id='".$arr['row_id']."' ";
$result2 = mysql_query($sql2);
$i=1;
while($arr2=mysql_fetch_array($result2)){

?>
  <tr>
    <td colspan="3" align="right" class="font1">(&nbsp;<?=$i;?>&nbsp;)</td>
    <td colspan="2" class="font1">&nbsp;&nbsp;
<?=$arr2['list_detail']?></td>
  </tr>
  <? 
  $i++;
  } ?>
  <tr>
    <td colspan="5" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1"><?=$arr['yot'];?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="font11">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
     <?  $sql = "Select doctorcode,position From doctor where name like '%".$arr['doctor']."%' ";
  $result = mysql_query($sql)  or die (mysql_error());
  list($doctorcode,$position) = mysql_fetch_row($result); ?>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center">&nbsp;(
    <?=substr($arr['doctor'],5);?>&nbsp;)</td>
  </tr>
 
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center">���˹�
      <?=$position;?>&nbsp;&nbsp;&nbsp;�.
      <?=$doctorcode;?>&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center">�ѹ���..<?=$showdate1[2];?>..��͹...<?=$month[$showdate1[1]];?>...�.�...<?=$showdate1[0];?>&nbsp;</td>
  </tr>
</table>
  
  <div style="page-break-before:always;"></div>
  
  <br />
<div align="right" class="font1" style="width:80%;">�Ţ���   <?=$arr['runno'];?>

</div>
<h1 class="font2" align="center" style="height:20PX;">Ẻ��觫�����/�Ǫ�ѳ�� �͡�ç��Һ��</h1>
<h1 class="font2" align="center" style="height:20PX;">�ç��Һ�Ť�������ѡ�������� �.�ӻҧ</h1>
<!--<h1 class="font2" align="center">�ô������ͧ���� / ŧ㹪�ͧ ( ) �������駡�͡��ͤ���</h1>-->
<hr width="60%" />
<table border="0" align="center"  class="font1">
 <? if($arr['typeopd']=='�����¹͡'){?>
  <tr>
    <td colspan="3" align="center">�ѹ���
    <?=$showdate;?>&nbsp;&nbsp; �����¹͡</td>
    <td colspan="3" align="left"> &nbsp;����-ʡ�� 
      <b><?=$arr['ptname'];?></b>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HN  :
  <b><?=$arr['hn'];?></b></td>

</tr>
<? }elseif($arr['typeopd']=='�������'){

	$sql1="select * from  ipcard where an='".$arr['an']."' limit 1";
	$query1=mysql_query($sql1) or die (mysql_error());	
	$arr1=mysql_fetch_array($query1);
?>
 <tr>
    <td colspan="3" align="center">�ѹ��� 
    <?=$showdate;?> &nbsp;&nbsp;�������</td>
    <td colspan="3">����-ʡ�� 
      <b><?=$arr['ptname'];?></b>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AN  :
  <b><?=$arr['an'];?></b>&nbsp;&nbsp;�ͼ����� :<?=$arr1['my_ward'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

</tr>
<? } ?>

  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="2" align="center" class="font1"><span class="font11">�Է�� :
        <?=$arr['ptright'];?>
    </span></td>
    <td colspan="3" class="font1">��觻������ä .......
      <?=$arr['diag'];?>
......</td>
  </tr>
  <tr>
    <td colspan="6" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" class="font1">�к� ��¡��/�ӹǹ/�Ը�����</td>
  </tr>
  <? 
$sql2="select * from  drugoutside_list as b WHERE  b.ref_id='".$arr['row_id']."' ";
$result2 = mysql_query($sql2);
$i=1;
while($arr2=mysql_fetch_array($result2)){

?>
  <tr>
    <td align="right" class="font1">&nbsp;</td>
    <td align="right" class="font1"><span class="font11">(&nbsp;
        <?=$i;?>
&nbsp;)</span></td>
    <td colspan="4" class="font1">&nbsp;&nbsp;
    <?=$arr2['list_detail']?></td>
  </tr>
  <? 
  $i++;
  } ?>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">��/�Ǫ�ѳ������¡�ù�� <?=$typedoc;?></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">��سҫ��ͨҡ�ç��Һ�����������ҹ�����Ἱ�Ѩ�غѹ</td>
  </tr>
  <tr>
    <td height="39" colspan="6" align="center" valign="bottom" class="font1">���Ѫ�� .........................................</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">( <span class="font11">
      <?=$arr['name2'];?>
    )</span></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">�����·���ԡ�� ��سҹ�������Ѻ�Թ����кت��������������</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">�Դ�����ͧ����¹���ᾷ��������� ����Ѻ�ͧ�ԡ</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  
  <? 
  $sql = "Select doctorcode ,position From doctor where name like '%".$arr['doctor']."%' ";
  $result = mysql_query($sql);
  list($doctorcode,$position ) = mysql_fetch_row($result);
  
  ?>
  <tr>
    <td colspan="6" align="center" class="font1"><?=$arr['yot'];?>
    .............................</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">(  
      <?=substr($arr['doctor'],5);?> )</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">���˹�
      <?=$position;?>
      &nbsp;&nbsp;&nbsp;�.
    <?=$doctorcode;?></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
</table>

</body>
</html>