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
// Update 31 �� 2553 
//bbm
$appd=$_POST['appdate'].' '.$_POST['appmo'].' '.$_POST['thiyr'];

  $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
   print "<font face='Angsana New'><b>��ª��ͤ���Ѵ��Ǩ   Ἱ������</b><br>";
   print "<b>�Ѵ���ѹ���</b> $appd<br> ";
   print "�ѹ/���ҷӡ�õ�Ǩ�ͺ....$Thaidate"; 
   ?>
 <div id="no_print" >  <a href="JavaScript:window.print();">��������ª���</a> </div>
   <?


 include("connect.inc");
 
$subappd=explode(' ',$appd);

 switch($subappd[1]){
		case "���Ҥ�": $printmonth = "01"; break;
		case "����Ҿѹ��": $printmonth = "02"; break;
		case "�չҤ�": $printmonth = "03"; break;
		case "����¹": $printmonth = "04"; break;
		case "����Ҥ�": $printmonth = "05"; break;
		case "�Զع�¹": $printmonth = "06"; break;
		case "�á�Ҥ�": $printmonth = "07"; break;
		case "�ԧ�Ҥ�": $printmonth = "08"; break;
		case "�ѹ��¹": $printmonth = "09"; break;
		case "���Ҥ�": $printmonth = "10"; break;
		case "��Ȩԡ�¹": $printmonth = "11"; break;
		case "�ѹ�Ҥ�": $printmonth = "12"; break;
	}
$newappd=$subappd[2].'-'.$printmonth.'-'.$subappd[0];
 

$sqltem="CREATE TEMPORARY TABLE  appoint1  Select * from  appoint  WHERE  `detail` 
LIKE  '%�����%' AND appdate ='$appd' ";
$querytem = mysql_query($sqltem);

$sqltime="SELECT COUNT( * ) AS cnum, apptime
FROM  `appoint1` 
GROUP BY apptime";
$querytime=mysql_query($sqltime);

?>
<hr width="50%"  align="center"/><br />
<table border="1" style="border-collapse:collapse" bordercolor="#666666" cellpadding="0" cellspacing="0" class="font1"> 
<?php 
$n=1;
$i=1;
while($arrtime=mysql_fetch_array($querytime)){
	
	
	echo "<tr height='40'><td colspan='6' align='center'  bgcolor=\"#00CCFF\"><b>��ǧ���  ".$i.' </b>  ����   '.$arrtime['apptime'].'  �� '.$arrtime['cnum']." ��</tr></td>";
	echo "<tr bgcolor='#CCCCCC'>
	<td align='center' width='20'>�ӴѺ</td>
	<td align='center' width='150'>����-ʡ��</td>
	<td align='center' width='50'>HN</td>
	<td align='center' width='50'>VN</td>
	<td align='center' width='180'>�Է��</td>
	<td align='center' width='200'>&nbsp;</td>
	</tr>";
	
	$show="SELECT * FROM  appoint1 WHERE  apptime ='".$arrtime['apptime']."'";
	$queryshow=mysql_query($show);
	$rows=mysql_num_rows($queryshow);
			while($arrshow=mysql_fetch_array($queryshow)){
		
				$ptright="SELECT * FROM  `opday` WHERE  `hn` =  '".$arrshow['hn']."'  and thidate like '$newappd%'  limit 0,1";
				$querypt=mysql_query($ptright);
				$arrpt=mysql_fetch_array($querypt);
	if($n>$rows){
	$n=1;
	}
print " <tr>
          <td align='center'><font face='Angsana New'>$n</td>
		  <td><font face='Angsana New'>$arrshow[ptname]</td>
		  <td><font face='Angsana New'>$arrshow[hn]</td>
		  <td align='center'><font face='Angsana New' >$arrpt[vn]</td>
		  <td><font face='Angsana New'>$arrpt[ptright]</td>
		  <td align='center'>&nbsp;</td>
          </tr>";
?>
<? 
$n++;
}
$i++;
}

echo "</table>";

include("unconnect.inc");

?>
</div>
