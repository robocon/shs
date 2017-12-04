<?
include("../connect.inc");
$sql = "select hn from condxofyear_so where yearcheck ='2557'";
$query=mysql_query($sql);
	$i=0;
while($rows=mysql_fetch_array($query)){
	$hn=$rows["hn"];
	$chksql="select hn from chkup_solider where hn ='$hn'";
	$chkquery=mysql_query($chksql);
	$chkrows=mysql_fetch_array($chkquery);
	$i++;
	$chkhn=$chkrows["hn"];
		if($hn == $chkhn){
			echo "$i) เท่ากับ $chkhn <br />";
		}else{
			echo "$i) ไม่เท่ากับ $hn <br />";
			/*$edit="update condxofyear_so set yearcheck='d' where hn='$hn'";
			mysql_query($edit);*/
		}
}
?>
