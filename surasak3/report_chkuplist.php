<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<?
	include("connect.inc");	
	$sql="SELECT  count(part) as countpart, part FROM opcardchk group by part";
	//echo $sql;
	$cquery=mysql_query($sql);
	$num=mysql_num_rows($cquery);
?>
<p align="center"><strong>หน่วยงานที่เข้ารับการตรวจสุขภาพ</strong></p>
<table width="50%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="7%" align="center" bgcolor="#FF9999"><strong>#</strong></td>
    <td width="48%" align="center" bgcolor="#FF9999"><strong>หน่วยงาน</strong></td>
    <td width="22%" align="center" bgcolor="#FF9999"><strong>จำนวนที่มา</strong></td>
    <td width="23%" align="center" bgcolor="#FF9999"><strong>จำนวนทั้งหมด</strong></td>
  </tr>
<?
	$i=0;
	while($result=mysql_fetch_array($cquery)){
	$i++;
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result['part'];?></td>
<?
	$sql1="SELECT * FROM opcardchk AS a INNER  JOIN out_result_chkup AS b ON a.HN = b.hn WHERE a.part ='".$result['part']."'";
	$query1=mysql_query($sql1);
	$num1=mysql_num_rows($query1);
?>    
    <td align="center"><a href="print_chkuplist.php?part=<?=$result['part'];?>" target="_blank">
      <?=number_format($num1);?>
    </a></td>
    <td align="center"><a href="print_chkuplistall.php?part=<?=$result['part'];?>" target="_blank"><?=number_format($result['countpart']);?></a></td>
  </tr>
<?	
	}
?>  
</table>
