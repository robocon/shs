<?
include("connect.inc");
?>
<style type="text/css">
	<!--
	.formdrug {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	-->
</style>
<form name="f1" method="post" action="">
<table border="1" cellspacing="0" cellpadding="0"  bordercolor="#000000" style="border-collapse:collapse" class="formdrug">
  <tr>
    <td colspan="4" align="center" bgcolor="#FFCCCC">�ʴ������ż����µ���ѧ�Ѵ</td>
  </tr>
  <tr>
    <td align="center">���͡�ѧ�Ѵ</td>
    <td><? 
print " <select  name='camp' class='formdrug'>";
print " <option value='0' ><--���͡�ѧ�Ѵ--></option>";
//print "<option value=\"M01 �����͹\">�����͹</option>";
print "<option value=\"M02 �.17 �ѹ2\">�.17 �ѹ2</option>";
print "<option value=\"M03 ���ŷ��ú����32\">���ŷ��ú����32</option>";
print "<option value=\"M04 �.�.��������ѡ��������\">�.�.��������ѡ��������</option>";
print "<option value=\"M05 �.�ѹ4\">�.�ѹ4</option>";
print "<option value=\"M06 ���½֡ú����ɻ�еټ�\">���½֡ú����ɻ�еټ�</option>";
print "<option value=\"M0301 ��.���.32\">��.���.32</option>";
print "<option value=\"M0302 ���.���.32\">���.���.32</option>";
print "<option value=\"M0303 ���.,���.���.32\">���.,���.���.32</option>";
print "<option value=\"M0304 �¡.���.32\">�¡.���.32</option>";
print "<option value=\"M0305 ���.���.32\">���.���.32</option>";
print "<option value=\"M0306 ���.���.32\">���.���.32</option>";
print "<option value=\"M0307 ���.���.32\">���.���.32</option>";
print "<option value=\"M0308 ���.���.32\">���.���.32</option>";
print "<option value=\"M0309 �ʡ.���.32\">�ʡ.���.32</option>";
print "<option value=\"M0310 ����.���.32\">����.���.32</option>";
print "<option value=\"M0311 ���.���.32\">���.���.32</option>";
print "<option value=\"M0312 ͡.��� ���.32\">͡.��� ���.32</option>";
print "<option value=\"M0313 ����.���.32\">����.���.32</option>";
print "<option value=\"M0314 ���.���.32\">���.���.32</option>";
print "<option value=\"M0315 �Ȩ.���.32\">�Ȩ.���.32</option>";
print "<option value=\"M0316 ����.���.32\">����.���.32</option>";
print "<option value=\"M0317 ʢ�.���.32\">ʢ�.���.32</option>";
print "<option value=\"M0313 è.���.32\">è.���.32</option>";
print "<option value=\"M0318 ���.���.32\">���.���.32</option>";
print "<option value=\"M0319 ��.���.32\">��.���.32</option>";
print "<option value=\"M0320 ���.���.32\">���.���.32</option>";
print "<option value=\"M0321 ����.��.���.32\">����.��.���.32</option>";
print "<option value=\"M0322 ��.��.���.32\">��.��.���.32</option>";
print "<option value=\"M0323 �ʾ.���.32\">�ʾ.���.32</option>";
print "<option value=\"M0324 ��þ���ѧ ���.32\">��þ���ѧ ���.32</option>";
print "<option value=\"M0325 Ƚ.�ȷ.���.32\">Ƚ.�ȷ.���.32</option>";
print "<option value=\"M0326 ���.���.32\">���.���.32</option>";
print "<option value=\"M0327 �ٹ�����Ѿ�� ���.32\">�ٹ�����Ѿ�� ���.32</option>";
print "<option value=\"M0328 ���.���.32\">���.���.32</option>";
print "<option value=\"M08 ��ʴըѧ��Ѵ�ӻҧ\">��ʴըѧ��Ѵ�ӻҧ</option>";
print "<option value=\"M09 ��.��ѧ ʻ.��\">��.��ѧ ʻ.��</option>";
print "<option value=\"M07 ˹��·�������\">˹��·�������</option>";
print "</select>";
?>
    <td align="center"><input name="button" type="submit" class="formdrug" id="button" value="����" /></td>
    <td align="center"><a target=_self  href='../nindex.htm' class="formdrug"> <-----����� </a></td>
  </tr>
</table>
</form>


<hr />

<?
if(isset($_POST['button'])){

$strcamp=explode(" ",$_POST['camp']);


$sql1="CREATE TEMPORARY TABLE  opcard1  Select * from  opcard  WHERE (camp like '%".$strcamp[1]."%' and goup not like 'G31%' and goup not like 'G32%' and goup not like 'G36%' and goup not like 'G39%'  and goup not like 'G33%' and yot !='' and name  !='' and surname !='') ";
$query1 = mysql_query($sql1); 

$sql="select hn,concat(yot,name,' ',surname)as name,camp from opcard1  Order by row_id ASC";
$result=mysql_query($sql);

//echo $sql1;

 ?>
<table border="1" cellspacing="0" cellpadding="0"  bordercolor="#000000" style="border-collapse:collapse" class="formdrug">
  <tr>
    <td colspan="4" align="center" bgcolor="#CCCCCC">��ª��ͼ����µ���ѧ�Ѵ  <?=$strcamp[0].' '.$strcamp[1];?></td>
    
  </tr>
  <tr>
    <td>�ӴѺ</td>
    <td>HN</td>
    <td>����-ʡ��</td>
    <td>�ѧ�Ѵ</td>
  </tr>
  <?
  $n=0;
  while($dbarr=mysql_fetch_array($result)){
  ?>
  <tr>
    <td><?=++$n;?></td>
    <td><?=$dbarr['hn']?></td>
    <td><?=$dbarr['name']?></td>
    <td><?=$dbarr['camp']?></td>
  </tr>
  <?
  } 
  ?>
</table>
<?
}
?>