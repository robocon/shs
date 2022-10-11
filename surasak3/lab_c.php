<?
session_start();
include("connect.inc");



$sql="select * from lab_c WHERE detail_c=''";
$query=mysql_query($sql);
while($rows=mysql_fetch_array($query)){
$sql1="select * from labcare where codex='".$rows["code_c"]."'";
$query1=mysql_query($sql1);
$result=mysql_fetch_array($query1);
$num=mysql_num_rows($query1);
	if($num >0){
		$chksql="update lab_c SET detail_c='".$result["detail"]."',
												 code_his='".$result["code"]."' WHERE code_c='".$result["codex"]."';";
		//echo $chksql."<br>";		
		$chkquery=mysql_query($chksql);										 
	}
	
}
?>
