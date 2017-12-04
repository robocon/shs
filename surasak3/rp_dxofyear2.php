<?php
set_time_limit(30);

$dbconnect = mysql_connect ( "localhost", "root", "1234") or die(mysql_error());
mysql_select_db("smdb",$dbconnect);

echo "<table>";
$sql = "Select * From dxofyear Order by camp ASC ";
$result = mysql_query($sql);
while($arr = mysql_fetch_assoc($result)){

	echo "<tr><td>",$arr["thidate"],"</td><td>",$arr["hn"],"</td><td>",$arr["ptname"],"<td><td>",$arr["camp"],"<td></tr>";

}
echo "</table>";

mysql_close($dbconnect);

?>
