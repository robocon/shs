<title>��§ҹ�š�û�Ѻ��ا�������ѧ�Ѵ</title>
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
	$showyear=$nPrefix;

$sql="SELECT * FROM chkup_solider WHERE hn !='' AND yearchkup = '$showyear'";
$query=mysql_query($sql) or die("Query chkup_solider line 13 Error");
$total=mysql_num_rows($query);

$sql1="SELECT * FROM chkup_solider WHERE hn ='' AND yearchkup = '$showyear' order by camp";
$result=mysql_query($sql1) or die("Query chkup_solider line 17 Error");
$num=mysql_num_rows($result);
?>
<a href ="../nindex.htm" >&lt;&lt; ��Ѻ˹����ѡ</a>
<p align="center" style="font-weight:bold;">��§ҹ�š�û�Ѻ��ا������HN�ͧ���ѧ�ŷ���Ǩ�آ�Ҿ��Шӻ� <?=$showyear;?></p>
<p>��Ѻ��ا�����ŷ����� : <?=$total;?> ��¡��</p>
<p>������͢����ŷ���ѧ������Ѻ��ا : <?=$num;?> ��¡�� �ѧ���</p>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99">#</td>
    <td width="17%" align="center" bgcolor="#66CC99">�ѹ����Ǩ</td>
    <td width="10%" align="center" bgcolor="#66CC99">HN</td>
    <td width="26%" align="center" bgcolor="#66CC99">����-���ʡ��</td>
    <td width="26%" align="center" bgcolor="#66CC99">�ѧ�Ѵ</td>
    <td width="17%" align="center" bgcolor="#66CC99">�����Ҫ���</td>
  </tr>
  <?
  $i=0;
  while($rows=mysql_fetch_array($result)){
  $i++;
  if(!empty($rows["yot"])){
  	$ptname=$rows["yot"].$rows["ptname"];
  }else{
  	$ptname=$rows["ptname"];
  }
  ?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$rows["idcard"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["hn"];?></td>
    <td bgcolor="#CCFFCC"><?=$ptname;?></td>
    <td bgcolor="#CCFFCC"><?=$rows["camp"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["ratchakarn"];?></td>
  </tr>
  <?
  }
  ?>
</table>

