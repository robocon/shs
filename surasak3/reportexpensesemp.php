<title>��ػ�������µ�Ǩ�آ�Ҿ�١��ҧ��Шӻ�</title>
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
////*runno ��Ǩ�آ�Ҿ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
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
////*runno ��Ǩ�آ�Ҿ*/////////

$sql1="SELECT * FROM dxofyear_emp WHERE yearchk = '$nPrefix' group by hn order by thidate asc";
//echo $sql1;
$result=mysql_query($sql1) or die("Query condxofyear_so line 13 Error");
$num=mysql_num_rows($result);
?>
<p align="center" style="font-weight:bold;">��§ҹ�ӹǹ�١��ҧ�������Ѻ��õ�Ǩ�آ�Ҿ��Шӻ�
<?=$showyear;?></p>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>#</strong></td>
    <td width="16%" align="center" bgcolor="#66CC99"><strong>�ѹ����Ǩ</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="31%" align="center" bgcolor="#66CC99"><strong>����-���ʡ��</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>����</strong></td>
    <td width="16%" align="center" bgcolor="#66CC99"><strong>��� LAB</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>��� XRAY</strong></td>
  </tr>
  <?
  $i=0;
  //echo date("Y-m-d H:i:s");
  while($rows=mysql_fetch_array($result)){
  $i++;
  $date1=substr($rows["thidate"],0,10);
  list($y,$m,$d)=explode("-",$date1);
  $y=$y+543;
  $showdate="$d/$m/$y";
  $chkdate="$y-$m";
  
 $query1=mysql_query("select price as labprice from opacc where hn='$rows[hn]' and date like '$chkdate%'  and depart = 'PATHO' and credit='��Ǩ�آ�Ҿ'");
  list($labprice)=mysql_fetch_array($query1);
  
  $query2=mysql_query("select price as xrayprice from opacc where hn='$rows[hn]' and date like '$chkdate%' and depart = 'XRAY' and credit='��Ǩ�آ�Ҿ'");
  list($xrayprice)=mysql_fetch_array($query2); 
     
  ?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$showdate;?></td>
    <td bgcolor="#CCFFCC"><?=$rows["hn"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["ptname"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["age"];?></td>
    <td align="right" bgcolor="#CCFFCC"><?=$labprice;?></td>
    <td align="right" bgcolor="#CCFFCC"><?=$xrayprice;?></td>
  </tr>
  <?
  }
  ?>
</table>

