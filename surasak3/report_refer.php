<?
include("connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font2
{
	font-family:AngsanaUPC;
	font-size:18px;
}
</style>
<body>
<div id="no_print" > 
<a href ="../nindex.htm" > &lt;&lt; ����</a>
<form action="" method="post">
<table class="pdxhead" border="1" bordercolor="#FFFF00">
  <tr>
    <td width="412" align="center" bgcolor="#FFFF99"><strong>Ẻ���ԡ���ö�觵�ͼ�����</strong></td></tr>
  <tr>
  <td>HN : 
    <input name="hn" type="text" size="10" class="pdxhead"  /> 
  <input type="submit"  value="   ��ŧ   " name="okhn" class="pdxhead"/></td>
  </tr>
</table>
</form>
</div>
<?
if(isset($_POST['okhn'])){
	//echo "<br><input type='button' onclick='window.print()' value='                             �����                               '>";
	echo "<table width='80%' border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse'><tr><td align='center'>�ѹ���</td><td align='center'>HN</td><td align='center'>����</td><td align='center'>���ʡ��</td><td align='center'>&nbsp;</td><tr>";
	$sql = "select * from refer where hn = '".$_POST['hn']."'";
	$result = mysql_query($sql);
	$sum = mysql_num_rows($result);
	if($sum=="0"){
		echo "<br><span class='pdxhead'>��辺</span>";
	}else{
		while($arr = mysql_fetch_array($result)){
			echo "<tr><td>".$arr['dateopd']."</td><td>".$arr['hn']."</td><td>".$arr['name']."</td><td>".$arr['sname']."</td><td><a href='report_refer.php?print=".$arr['row_id']."'>�������觵��</a></td></tr>";
		}
		echo "</table>";
	}
}
elseif(isset($_GET['print'])){
	?>
	<script>
    window.print();
    </script>
	<?
		$sql = "select * from refer where row_id = '".$_GET['print']."'";
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
		
		$sql6= "select sex,concat(yot,' ',name,' ',surname) from opcard where hn = '".$arr['hn']."'";
		$result6 = mysql_query($sql6);
		list($sex,$ptname) = mysql_fetch_array($result6);
?>
<table width="655" border="0" align="center" class="font2">
  <tr>
    <td colspan="3" align="center" style="font-size:24px;"><strong>Ẻ���ԡ���ö�觵�ͼ�����</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center" style="font-size:22px;"><strong>�ç��Һ�Ť�������ѡ�������� �.�ӻҧ ��. 054-839305</strong></td>
  </tr>
  <tr>
    <td colspan="2">�͡�������� �ѹ��� : <?=date("d/m/").(date("Y")+543) ?> ���� <?=date("H:i")?></td>
    <td width="336">�Ţ�Ӥѭ�觵�ͼ�����&nbsp;&nbsp;&nbsp;R<?=$arr['refer_runno']?></td>
  </tr>
  <tr>
    <td colspan="2">�����ª���&nbsp;&nbsp;&nbsp; <?=$ptname?></td>
    <td>�Ţ��Шӵ�ǻ�ЪҪ� <?=$arr['idcard']?></td>
  </tr>
  <tr>
    <td width="159">�� : 
      <?=$sex == '�' ? '���':'˭ԧ'?></td>
    <td width="146">���� : <?=$arr['age']?></td>
    <td>�Է�����ʴԡ���ѡ�Ҿ�Һ��</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="checkbox" id="checkbox" />
     ����ѭ�ա�ҧ</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="checkbox2" id="checkbox2" />
    ���� :.....................................</td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="font-size:20px;"><strong>�觵�ͨҡ</strong></td>
    <td align="center" style="font-size:20px;"><strong>�Ѻ��ͷ��</strong></td>
  </tr>
  <tr>
    <td><strong>�.�. ��������ѡ��������</strong></td>
    <td><strong>���� 11512</strong></td>
   <? if($arr['referh']!="����"){?>
    <td><strong>�.�. 
      <?=substr($arr['referh'],6)?> &nbsp;&nbsp;&nbsp;���� : <?=substr($arr['referh'],0,5)?>
    </strong></td>
    <? }else{?>
    <td>�.�. .................. ���� : ...........</td>
    <? }?>
  </tr>
  <tr>
    <td>�ѹ���  <?=substr($arr['dateopd'],8,2)."/".substr($arr['dateopd'],5,2)."/".substr($arr['dateopd'],0,4)?></td>
    <td>����  <?=substr($arr['dateopd'],11)?></td>
    <td>�ѹ��� : ........../........../..........���� : ..........:..........</td>
  </tr>
  <tr>
    <td>HN : <?=$arr['hn']?></td>
    <td>AN : <?=$arr['an']?></td>
    <td>HN : ................................. AN : ...............................</td>
  </tr>
  <tr>
    <td colspan="2" align="center">�˵ؼŷ���觵�� ���/���� �˵ؼŷҧ��ԹԤ����Ӥѭ</td>
    <td style="font-size:18px;"><strong>����Ѻ���</strong></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="3" valign="top">-<?=$arr['exrefer']?></td>
    <td><input type="checkbox" name="checkbox6" id="checkbox6" />
    �繼������</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox7" id="checkbox7" />
    �ѧࡵ�ҡ��</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox8" id="checkbox8" />
    �ѡ����������Ѻ</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:18px;"><strong>�ѵ�ػ��ʧ��/����</strong></td>
    <td><input type="checkbox" name="checkbox9" id="checkbox9" />
    ����ѡ�ҵ�ͷ�����</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox3" id="checkbox3" <? if($arr['target_refer']=="1")echo "checked";?> />
    ��֡��/�ԹԨ���</td>
    <td>&nbsp;</td>
    <td style="font-size:18px;"><strong>�ó����ª��Ե</strong></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox4" id="checkbox4" <? if($arr['target_refer']=="2")echo "checked";?>/> 
    �ѡ����������觡�Ѻ</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="checkbox10" id="checkbox10" />
    �����ҧ����觵��</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox5" id="checkbox5" <? if($arr['target_refer']=="3")echo "checked";?>/> 
      �͹����</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="checkbox11" id="checkbox11" />
    ��ѧ�ҡ�Ѻ�ѡ��</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>���˹�ҷ�� �.�. ����觵��</strong></td>
    <td align="center"><strong>���˹�ҷ�� �.�. ����Ѻ���</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center">ŧ����.............................................................</td>
    <td align="center">ŧ����................................................................</td>
  </tr>
  <tr>
    <td colspan="2" align="center">(....................................................................)</td>
    <td align="center">(........................................................................)</td>
  </tr>
  <tr>
    <td colspan="2" align="center">���˹�.................................................................</td>
    <td align="center">���˹�........................................................................</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:18px;"><strong>�ѵ�ҡ���ԡ ����觵�ͼ�����</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">���зҧ�����ҧ �.�. ��/�Ѻ :................................��.</td>
    <td>��Ҿ�˹з�����¡��:.............................................�ҷ</td>
  </tr>
  <tr>
    <td colspan="2">�ѵ���ԡ������Թ :..............................................�ҷ</td>
    <td>�ԡ����Է���:......................................................�ҷ</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>��ǹ�ԡ�����:......................................................�ҷ</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:18px;"><strong>�ҹ��˹з�����觵�ͼ�����</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">�Ţ����¹.............................................&nbsp;&nbsp;�ѧ��Ѵ...........................................</td>
  </tr>
  <tr>
    <td colspan="3">��ö�ͧ 
      <input type="checkbox" name="checkbox12" id="checkbox12" />
      �.�.����觵��
      <input type="checkbox" name="checkbox14" id="checkbox14" />
      �.�.����Ѻ���
      <input type="checkbox" name="checkbox16" id="checkbox16" />
˹��§ҹ��� �к�...............................................................................</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:18px;"><strong>˹��·���ԡ���</strong></td>
    <td style="font-size:18px;"><strong>�����˵� ����Ѻ �.�.</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="checkbox" name="checkbox13" id="checkbox13" />
�.�.����觵��
  <input type="checkbox" name="checkbox15" id="checkbox15" />
�.�.����Ѻ���</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>���ѹ�֡/�ԡ</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">ŧ����.................................................................</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">(.........................................................................)</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">���˹�.......................................................................</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?
	}
?>
</body>
</html>