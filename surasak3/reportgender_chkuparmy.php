<title>��§ҹ�š�û�Ѻ��ا��������</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<?
include("connect.inc");
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$showyear="25".$nPrefix;

$sql="SELECT * FROM condxofyear_so WHERE gender !='' AND yearcheck = '$showyear'";
$query=mysql_query($sql) or die("Query condxofyear_so line 27 Error");
$total=mysql_num_rows($query);

$sql1="SELECT * FROM condxofyear_so WHERE gender ='' AND yearcheck = '$showyear' order by camp";
//echo $sql1;
$result=mysql_query($sql1) or die("Query condxofyear_so line 31 Error");
$num=mysql_num_rows($result);
?>
<a href ="../nindex.htm" >&lt;&lt; ��Ѻ˹����ѡ</a>
<p align="center" style="font-weight:bold;">��§ҹ�š�û�Ѻ��ا�������Ȣͧ���ѧ�ŷ���Ǩ�آ�Ҿ��Шӻ� <?=$showyear;?></p>
<p>��Ѻ��ا�����ŷ����� : <?=$total;?> ��¡��</p>
<p>������͢����ŷ���ѧ������Ѻ��ا : <?=$num;?> ��¡�� �ѧ���</p>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="2%" align="center" bgcolor="#66CC99">#</td>
    <td width="14%" align="center" bgcolor="#66CC99">�ѹ����Ǩ</td>
    <td width="8%" align="center" bgcolor="#66CC99">HN</td>
    <td width="23%" align="center" bgcolor="#66CC99">����-���ʡ��</td>
    <td width="16%" align="center" bgcolor="#66CC99">�ѧ�Ѵ</td>
    <td width="11%" align="center" bgcolor="#66CC99">����</td>
    <td width="10%" align="center" bgcolor="#66CC99">��</td>
    <td width="16%" align="center" bgcolor="#66CC99">Key Manaul</td>
  </tr>
  <?
  $i=0;
  while($rows=mysql_fetch_array($result)){
  $i++;
  ?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$rows["thidate"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["hn"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["ptname"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["camp"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["age"];?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$rows["gender"];?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$rows["keymanual"];?></td>
  </tr>
  <?
  }
  ?>
</table>

