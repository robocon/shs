<?php
set_time_limit(30);
$dbconnect = mysql_connect ( "192.168.131.240", "sm3db_user", "sm3dbPassword") or die(mysql_error());
mysql_select_db("sm3db-utf8",$dbconnect);

echo "<table>";
$sql = "Select * From dxofyear Order by camp ASC ";
$result = mysql_query($sql);
while($arr = mysql_fetch_assoc($result)){

	echo "<tr><td>",$arr["thidate"],"</td><td>",$arr["hn"],"</td><td>",$arr["ptname"],"<td><td>",$arr["camp"],"<td></tr>";

}
echo "</table>";

mysql_close($dbconnect);

?>
