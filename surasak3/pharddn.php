<?php
include("connect.inc");
$sql = "select * from druglst where part='DDN' ";
$row = mysql_query($sql);
echo "<table width='50%' border=1 style='font-family:AngsanaUPC; font-size:16px; border-collapse:collapse;' cellpadding='0' cellspacing='0'><tr><td align='center'>#</td><td align='center'>รหัสยา</td><td align='center'>ชื่อการค้า</td><td align='center'>ราคาทุน</td><td align='center'>ราคาขาย</td><td align='center'>กำไร %</td></tr>";
while($result = mysql_fetch_array($row)){
	$i++;
?>
<tr><td><?=$i?></td><td><?=$result['drugcode']?></td><td><?=$result['tradname']?></td><td><?=$result['unitpri']?></td><td><?=$result['salepri']?></td><td><?=number_format((($result['salepri']*100)/$result['unitpri'])-100,2);?></td></tr>
<?
}
echo "</table>";
?>