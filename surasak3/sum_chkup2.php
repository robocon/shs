<?php
include("connect.inc");
$query="SELECT  * FROM condxofyear_so AS b LEFT  JOIN  chkup_company AS a ON b.hn = a.hn WHERE a.company like '$id%' and program = '$pro' ";
//echo $query;
$rows = mysql_query($query);
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: AngsanaUPC; font-size:16px;">
<tr>
<td align="center">#</td>
<td align="center">HN</td>
<td align="center">ชื่อ-สกุล</td>
<td align="center">อายุ</td>
<td align="center">UA</td>
<td align="center">CBC</td>
<td align="center">GLU</td>
<td align="center">CHOL</td>
<td align="center">TRIG</td>
<td align="center">BUN</td>
<td align="center">CREA</td>
<td align="center">ALP</td>
<td align="center">ALT</td>
<td align="center">AST</td>
<td align="center">URIC</td>
<td align="center">CXR</td>
<td align="center">PAP</td>
<td align="center">สรุปผลการตรวจ</td>
<!--<td align="center">แพทย์</td>-->
</tr>
<?
while($result = mysql_fetch_array($rows)){
	$r++;
?>
	<tr>
<td><?=$r?></td>
<td><?=$result['hn']?></td>
<td><?=$result['ptname']?></td>
<td><?=substr($result['age'],0,5)?></td>
<td><?=$result['stat_ua']?></td>
<td><?=$result['stat_cbc']?></td>
<td><?=$result['stat_bs']?></td>
<td><?=$result['stat_chol']?></td>
<td><?=$result['stat_tg']?></td>
<td><?=$result['stat_bun']?></td>
<td><?=$result['stat_cr']?></td>
<td><?=$result['stat_alk']?></td>
<td><?=$result['stat_sgpt']?></td>
<td><?=$result['stat_sgot']?></td>
<td><?=$result['stat_uric']?></td>
<td><?=$result['cxr']?></td>
<td><?=$result['reason_pap']?></td>
<?
if($result['summary']=="มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)"){
	$sum = explode(" ",$result['summary']);
	$result['summary'] = $sum[0]." ".$result['diag']." ".$sum[1];
}else{
	$result['summary']=$result['summary'].":".$result['diag'];
}
?>
<td><?=$result['summary']?></td>
<!--<td><?//$result['doctor']?></td>-->
</tr>
<?
}
?>
</table>
