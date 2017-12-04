<?
session_start();
include("connect.inc");
$sql="select an, ward from ward_log where ward ='ËÍ¼Ùé»èÇÂICU' and ward !='' and regisdate like '2555%' and an !='' group by an";
//echo $sql."<br>";
$query=mysql_query($sql);
?>
<table width="40%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center" bgcolor="#FF9999">#</td>
    <td align="center" bgcolor="#FF9999">an</td>
    <td align="center" bgcolor="#FF9999">ward</td>
  </tr>
<?
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$wsql="select an, ward from ward_log where an ='$rows[an]' and ward !='ËÍ¼Ùé»èÇÂICU' and ward !='' and regisdate like '2555%' group by an ";
//echo $wsql."<br>";
$wquery=mysql_query($wsql);
while($wrows=mysql_fetch_array($wquery)){
	$asql="select an, ward from ward_log where an ='$wrows[an]' and ward ='ËÍ¼Ùé»èÇÂICU' and ward !='' and regisdate like '2555%' group by an";
	//echo $asql."<br>";
	$aquery=mysql_query($asql);
	while($arows=mysql_fetch_array($aquery)){
?>  
  <tr>
    <td><?=$i;?></td>
    <td><?=$arows["an"];?></td>
    <td><?=$arows["ward"];?></td>
  </tr>
<?
		}
	}
}
?>  
</table>
