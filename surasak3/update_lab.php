<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 18px;
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
$sql="select * from lab";
$query=mysql_query($sql);
while($rows=mysql_fetch_array($query)){
	$codex=$rows["codex"];
	$id=$rows["id"];
	$sql1="select * from labcare where codex='$codex' and labstatus='Y'";
	$query1=mysql_query($sql1);
	$num1=mysql_num_rows($query1);
	if($num1 >0){
		$rows1=mysql_fetch_array($query1);
		$version=$rows1["version"];
		$row_id=$rows1["row_id"];
		$codex=$rows1["codex"];
		$edit="update lab set version='$version',row_id='$row_id' where codex='$codex'";
		mysql_query($edit);
	}
}
?>
