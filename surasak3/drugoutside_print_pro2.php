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
?>
<br />
<div align="right" class="font1" style="width:80%;">�Ţ���   <?=$arr['runno'];?>

</div>
<h1 class="font2" align="center" style="height:20PX;">Ẻ��觫���������Ǫ�ѳ�� �͡�ç��Һ��</h1>
<h1 class="font2" align="center" style="height:20PX;">�ç��Һ�Ť�������ѡ�������� �.�ӻҧ</h1>
<!--<h1 class="font2" align="center">�ô������ͧ���� / ŧ㹪�ͧ ( ) �������駡�͡��ͤ���</h1>-->
<hr width="60%" />
<table border="0" align="center"  class="font1">
 <? if($arr['hn']!=''){?>
  <tr>
    <td align="center">�ѹ��� </td>
    <td class="font1"><?=$arr['dateadd'];?>&nbsp;&nbsp; </td>
    <td class="font1">�����¹͡</td>
    <td colspan="3">����-ʡ�� 
    <b><?=$arr['ptname'];?></b>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HN  :
<b><?=$arr['hn'];?></b></td>

</tr>
<? }else{ 

	$sql1="select * from  ipcard where an='".$arr['an']."' ";
	$query1=mysql_query($sql1) or die (mysql_error());	
	$arr1=mysql_fetch_array($query1);
?>
 <tr>
    <td align="center">�ѹ���</td>
    <td class="font1"><?=$arr['dateadd'];?> &nbsp;&nbsp;</td>
    <td class="font1">�������</td>
    <td colspan="3">����-ʡ�� 
    <b><?=$arr['ptname'];?></b>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AN  :
<b><?=$arr['an'];?></b>&nbsp;&nbsp;�ͼ����� :<?=$arr1['my_ward'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

</tr>
<? } ?>

  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
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
    <td colspan="4" align="right" class="font1">(&nbsp;<?=$i;?>&nbsp;)</td>
    <td colspan="2" class="font1">&nbsp;&nbsp;
<?=$arr2['list_detail']?></td>
  </tr>
  <? 
  $i++;
  } ?>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">������Ǫ�ѳ������¡�ù���ç��Һ������ը�˹���</td>
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
    <td colspan="6" align="center" class="font1">�������ԡ�� ��سҹ�������Ѻ�Թ����кث��������������</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">�Դ�����ͧ����¹���ᾷ��������� ����Ѻ�ͧ�ԡ</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  
  <? 
  $sql = "Select doctorcode From doctor where name like '%".$arr['name']."%' ";
  $result = mysql_query($sql);
  list($doctorcode) = mysql_fetch_row($result);
  
  ?>
  <tr>
    <td height="45" colspan="6" align="center" class="font1">ᾷ�� .............................�.&nbsp;<?=$doctorcode;?></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">( <?=substr($arr['name'],5);?> )</td>
  </tr>
  </table>

</body>
</html>