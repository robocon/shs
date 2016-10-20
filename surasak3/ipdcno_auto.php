<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
		<title>Untitled Document</title>
	</head>
<body>
<?php
include("connect.inc");

$sql = "select dcdate from ipcard where an ='".$_GET['an']."' ";
$rows = mysql_query($sql);
list($dcdate) = mysql_fetch_array($rows);
$m5 = substr($dcdate,5,2);
$yr5 = substr($dcdate,0,4);  

$sql2 = "select * from ipcard where dcdate like '%".$yr5."-".$m5."-%' order by dcdate";
$rows2 = mysql_query($sql2);	
$i = 0;

$result2 = false;
while($result = mysql_fetch_array($rows2)){

	$i++;
	$d1 = substr($result['date'],8,2);
	$m1 = substr($result['date'],5,2);
	$yr1 = substr($result['date'],0,4);  
	$time1 = substr($result['date'],11);  
	$date1 = $d1."-".$m1."-".$yr1." ".$time1; //date 
	$d2 = substr($result['dcdate'],8,2);
	$m2 = substr($result['dcdate'],5,2);
	$yr2 = substr($result['dcdate'],0,4);  
	$time2 = substr($result['dcdate'],11);  
	$date2 = $d2."-".$m2."-".$yr2." ".$time2; //dcdate
	$str = $i."/".$m5."/".$yr5; //dcnumber

	//echo "<tr><td align='center'>$i</td><td>".$date1."</td><td>".$date2."</td><td align='center'>".$result['hn']."</td><td align='center'>".$result['an']."</td><td>".$result['ptname']."</td><td align='center'>".$str."</td></tr>";		

	$sqlup = "update ipcard SET dcnumber = '".$str."' where row_id = '".$result['row_id']."' ";
	$result2 = mysql_query($sqlup) or die( mysql_error() );
}

$alert = false;
if( $result2 !== false ){
	$alert = "AN: ".$_GET['an']." ให้เลขลำดับการจำหน่ายผู้ป่วยแล้ว ";
}
	
?>
<script type="text/javascript">
	<?php
	if( $alert !== false ){
		?>
		alert('<?=$alert;?>');
		<?php
	}
	?>
	window.close();
</script>	
</body>
</html>