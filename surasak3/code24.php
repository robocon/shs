<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
}
-->
</style>
<span class="font1"><a href="../nindex.htm"><< ����� </a></span>
<center><span class="font1" style="font-size:25px;">�ѭ���� 24 ��ѡ</span></center>
<span class="font1" style="font-size:20px;"><strong><u>����� 24 ��ѡ</u></strong></span>

<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td width="5%" align="center" class="font1">#</td>
    <td width="13%" align="center" class="font1">������</td>
    <td width="30%" align="center" class="font1">��������ѭ</td>
    <td width="40%" align="center" class="font1">���͡�ä��</td>
    <td width="12%" align="center" class="font1">�ѭ���� 24 ��ѡ</td>
  </tr>
<?
include("connect.inc");
$sql = "select * from druglst where code24 ='' order by drugcode asc ";
$row = mysql_query($sql);
while($rep1 = mysql_fetch_array($row)){
	$i++;
	?>
  <tr>
    <td align="center" class="font1">
      <?=$i?>
    </td>
    <td class="font1">
      <?=$rep1['drugcode']?>
    </td>
    <td class="font1">
      <?=$rep1['genname']?>
    </td>
    <td class="font1">
      <?=$rep1['tradname']?>
    </td>
    <td class="font1" align="center"><a href="#" onclick="window.open('upd_code24.php?nrow=<?=$rep1['row_id']?>',null,'height=300,width=320,scrollbars=0')">���</a></td>
  </tr>
<?	
}
?>
</table><br>
<span class="font1" style="font-size:20px;"><u><strong>�� 24 ��ѡ</strong></u></span>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td width="5%" align="center" class="font1">#</td>
    <td width="12%" align="center" class="font1">������</td>
    <td width="25%" align="center" class="font1">��������ѭ</td>
    <td width="32%" align="center" class="font1">���͡�ä��</td>
    <td width="17%" align="center" class="font1">�ѭ���� 24 ��ѡ</td>
    <td width="9%" align="center" class="font1">���</td>
  </tr>
 <?
 $i=0;
 $sql2 = "select * from druglst where code24 !='' order by drugcode asc";
$row2 = mysql_query($sql2);
while($rep2 = mysql_fetch_array($row2)){
	$i++;
 ?>
  <tr>
    <td align="center" class="font1">
      <?=$i?>
    </td>
    <td class="font1">
      <?=$rep2['drugcode']?>
    </td>
    <td class="font1">
      <?=$rep2['genname']?>
    </td>
    <td class="font1">
      <?=$rep2['tradname']?>
    </td>
    <td class="font1">
      <?=$rep2['code24']?>
    </td>
    <td align="center" class="font1"><a href="#" onclick="window.open('upd_code24.php?nrow=<?=$rep2['row_id']?>',null,'height=300,width=320,scrollbars=0')">���</a></td>
  </tr>
  <?
}
  ?>
</table>
