<?php
set_time_limit(0);
 include("connect.inc");

$sql = "Select hn, regisdate From opcard where lastupdate = '0000-00-00 00:00:00' limit 0,100 ";
$result = Mysql_Query($sql);
$rows = Mysql_num_rows($result);
if($rows > 0){
	$i=0;
	while($arr = Mysql_fetch_assoc($result)){

		$sql2 = "Select thidate From opday where hn = '".$arr["hn"]."' Order by thidate DESC limit 0,1 ";
		$result2 = Mysql_Query($sql2);
		$arr2 = Mysql_fetch_assoc($result2);
		$rows = Mysql_num_rows($result2);

		if($rows == 0){
			$date = explode("-",$arr["regisdate"]);
			$date_up = ($date[0]+543)."-".$date[1]."-".$date[2];
			$sql3 = "Update opcard set lastupdate = '".$date_up."' where hn = '".$arr["hn"]."' limit 1 ";
			$result3 = Mysql_Query($sql3);

		}else{
			$sql3 = "Update opcard set lastupdate = '".$arr2["thidate"]."' where hn = '".$arr["hn"]."' limit 1 ";
			$result3 = Mysql_Query($sql3);
		}



	$i++;
	}

	if($i>= $rows)
		echo "
		เหลืออีก ",$rows-$i," Record<BR>
	<META HTTP-EQUIV=\"Refresh\" CONTENT=\"10;URL=update_last.php\">";
}
include("unconnect.inc");
?>