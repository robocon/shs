<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
.font1{
	font-size:18px;
}
</style>
<div align="center">
<?php
  print "<font face='Angsana New'><b>��ª��ͼ������к�</b><br>";
   ?>
 <div id="no_print" ><a href="JavaScript:window.print();">��������ª���</a></div>
   <?


 include("connect.inc");
 


$sqltime="SELECT menucode FROM  inputm GROUP BY menucode ORDER BY menucode DESC";
$querytime=mysql_query($sqltime);

?>
<hr width="50%"  align="center"/><br />
<table border="1" style="border-collapse:collapse" bordercolor="#666666" cellpadding="0" cellspacing="0" class="font1"> 
<?php 
$n=1;

while($arrtime=mysql_fetch_array($querytime)){
	
	
	echo "<tr height='40'><td colspan='6' align='center'  bgcolor=\"#00CCFF\"><b>
	Ἱ�    $arrtime[menucode]
	</tr></td>";
	echo "<tr bgcolor='#CCCCCC'>
	<td align='center'>�ӴѺ</td>
	<td align='center'>����-ʡ��</td>
	<td align='center'>���ͼ����</td>
	<td align='center'>menucode</td>
	</tr>";
	
	$show="SELECT * FROM  inputm WHERE  menucode ='".$arrtime['menucode']."'";
	$queryshow=mysql_query($show);
	$rows=mysql_num_rows($queryshow);
	$n=0;
	while($arrshow=mysql_fetch_array($queryshow)){
		
	
	$n++;
	
	
print " <tr>
          <td align='center'><font face='Angsana New'>$n</td>
		  <td><font face='Angsana New'>$arrshow[name]</td>
		  <td><font face='Angsana New'>$arrshow[idname]</td>
		  <td align='center'><font face='Angsana New'>$arrshow[menucode]</td>
          </tr>";

}
}
echo "</table>";

include("unconnect.inc");

?>
</div>
