<?
include("connect.inc");
$sql="select * from condxofyear_so where yearcheck='2562' group by hn";
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
	$chkhn=$rows["hn"];
	$sql1="update chkup_solider set active='y' where yearchkup='62' and hn='$chkhn'";
	//echo "$i]".$sql1."<br>";
	$query1=mysql_query($sql1);
}
?>
