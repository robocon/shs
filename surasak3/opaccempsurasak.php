<?
include 'connect.inc';
$sql="select * from opcard where employee='y'";
$query=mysql_query($sql);
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<table width="50%" height="58" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse 1px;">
  <tr>
    <td width="8%" height="30" align="center" bgcolor="#FF66CC"><strong>ลำดับ</strong></td>
    <td width="14%" align="center" bgcolor="#FF66CC"><strong>HN</strong></td>
    <td width="49%" align="center" bgcolor="#FF66CC"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="15%" align="center" bgcolor="#FF66CC"><strong>ค่า XRAY</strong></td>
    <td width="15%" align="center" bgcolor="#FF66CC"><strong>ค่า LAB</strong></td>
  </tr>
  <?
  $i=0;
  $totallab=0;
  $totalxray=0;
  while($rows=mysql_fetch_array($query)){
  $i++;
  $ptname=$rows["yot"]." ".$rows["name"]."  ".$rows["surname"];
  
  $sql1=mysql_query("select price from opacc where hn='$rows[hn]' and depart='PATHO' and credit='ตรวจสุขภาพ' and date like '2558%'");
  list($pricelab)=mysql_fetch_array($sql1);
  $totallab=$totallab+$pricelab;
  
  $sql2=mysql_query("select price from opacc where hn='$rows[hn]' and depart='XRAY' and credit='ตรวจสุขภาพ' and date like '2558%'");
  list($pricexray)=mysql_fetch_array($sql2);  
  $totalxray=$totalxray+$pricexray;
  ?>
  <tr>
    <td height="28" align="center"><?=$i;?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$ptname;?></td>
    <td align="right"><?=$pricexray;?></td>
    <td align="right"><?=$pricelab;?></td>
  </tr>
  <?
  }
  ?>
  <tr>
  	<td colspan="3" align="right"><strong>รวมเป็นเงินทั้งสิ้น</strong></td>
    <td align="right"><?=number_format($totalxray,2);?></td>
    <td align="right"><?=number_format($totallab,2);?></td>
  </tr>
</table>

