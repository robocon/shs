<?
session_start();
include("connect.inc");
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<table width="80%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="14%" rowspan="2" align="center" bgcolor="#66CC99">ปีที่ดำเนินการ</td>
    <td width="18%" rowspan="2" align="center" bgcolor="#66CC99">งานทั้งหมด</td>
    <td colspan="2" align="center" bgcolor="#66CC99">รอดำเนินการ</td>
    <td colspan="2" align="center" bgcolor="#66CC99">อยู่ระหว่างดำเนินการ</td>
    <td colspan="2" align="center" bgcolor="#66CC99">เสร็จสิ้น</td>
    <td width="17%" rowspan="2" align="center" bgcolor="#66CC99">คิดเป็น</td>
  </tr>
  <tr>
    <td width="7%" align="center" bgcolor="#66CC99">จำนวน</td>
    <td width="8%" align="center" bgcolor="#66CC99">ร้อยละ</td>
    <td width="9%" align="center" bgcolor="#66CC99">จำนวน</td>
    <td width="10%" align="center" bgcolor="#66CC99">ร้อยละ</td>
    <td width="9%" align="center" bgcolor="#66CC99">จำนวน</td>
    <td width="8%" align="center" bgcolor="#66CC99">ร้อยละ</td>
  </tr>
<?
$sql="select date from  com_support group by substring(date,1,4)";
$query=mysql_query($sql);
while($rows=mysql_fetch_array($query)){
$year=substr($rows["date"],0,4);
?>  
  <tr>
    <td align="center"><?=$year;?></td>
	<?
    $csql="select * from  com_support where date like '$year%' and (status !='c' and status !='w')";
    $cquery=mysql_query($csql);
	$cnum=mysql_num_rows($cquery);
    ?>    
    <td align="center"><?=$cnum;?></td>    
	<?
    $ysql="select * from  com_support where date like '$year%' and status ='y'";
    $yquery=mysql_query($ysql);
	$ynum=mysql_num_rows($yquery);
	$yper=$ynum*100/$cnum;
	$yper=number_format($yper,2);	
    ?>     
    <td align="center"><?=$ynum;?></td>
	<td align="center"><?=$yper;?></td>
	<?
    $asql="select * from  com_support where date like '$year%' and programmer !='เพลิงพายุ' and status ='a'";
    $aquery=mysql_query($asql);
	$anum=mysql_num_rows($aquery);
	$aper=$anum*100/$cnum;
	$aper=number_format($aper,2);	
    ?>     
    <td align="center"><?=$anum;?></td>
	<td align="center"><?=$aper;?></td>
	<?
    $nsql="select * from  com_support where date like '$year%' and status ='n'";
	//echo $nsql;
    $nquery=mysql_query($nsql);
	$nnum=mysql_num_rows($nquery);
	$nper=$nnum*100/$cnum;
	$nper=number_format($nper,2);
    ?>     
    <td align="center"><?=$nnum;?></td>
    <td align="center"><?=$nper;?></td>
    <?
	$total=(($anum+$nnum)*100)/$cnum;
	//echo "$anum+$nnum/$cnum";
	?>
    <td align="center"><?=number_format($total,2)." %";?></td>
  </tr>
<?
}
?>  
</table>
