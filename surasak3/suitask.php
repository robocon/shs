<form method="POST" action="presuit.php">
  <p><font size="4" face="Angsana New"><b>���ҧ�ٵ�
  �ش��õ�Ǩ�ԹԨ����ä</b></font></p>
  <p><font face="Angsana New">�����ٵ�(��͸Ժ��)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="suitname" size="20"></font></p>
  <p><font face="Angsana New">�����ٵ�(�Ӵ���&nbsp;@
  ����)&nbsp; <input type="text" name="suitcode" size="15" value="@"></font></p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="       ��ŧ       " name="B1"></font></p>
</form><br />
<br />
<br />
<br />
�ٵ�Lab���������
<table width="50%" border="0">
<?
include("connect.inc");
$sql = "select * from labcare where code like '@%' ";
$row = mysql_query($sql);
while($result = mysql_fetch_array($row)){
	$i++;
	if($i%2==0){
		$color='#CCCCCC';
	}else{
		$color='#99CCFF';
	}
?>
  <tr bgcolor="<?=$color?>" >
    <td width="80%"><a target="_blank" href="suitdetail.php?code=<?=$result['code']?>"><?=$result['code']?></a></td>
    <td width="20%" align="center"><a target="_blank" href="suitdetail.php?code=<?=$result['code']?>&del" onclick="return confirm('�׹�ѹ���ź�ٵ� <?=$result['code']?>?');"> ź </a></td>
  </tr>
<?
}
?>
</table>



