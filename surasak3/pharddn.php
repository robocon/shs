<?php
include("connect.inc");
$sql = "select * from druglst where part='DDN' ";
$row = mysql_query($sql);
echo "<table width='50%' border=1 style='font-family:AngsanaUPC; font-size:16px; border-collapse:collapse;' cellpadding='0' cellspacing='0'><tr><td align='center'>#</td><td align='center'>������</td><td align='center'>���͡�ä��</td><td align='center'>�Ҥҷع</td><td align='center'>�ҤҢ��</td><td align='center'>���� %</td></tr>";
while($result = mysql_fetch_array($row)){
	$i++;
?>
<tr><td><?=$i?></td><td><?=$result['drugcode']?></td><td><?=$result['tradname']?></td><td><?=$result['unitpri']?></td><td><?=$result['salepri']?></td><td><?=number_format((($result['salepri']*100)/$result['unitpri'])-100,2);?></td></tr>
<?
}
echo "</table>";
?>