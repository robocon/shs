<?php

$strSort = $_POST["mySort"];
 include("../connect.inc");
$strSQL = "SELECT count(*) as count ,type_net  FROM internet WHERE idcard='' and date_service ='' Group by type_net Order by ".$strSort."  asc";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>
<table width="205" border="1">
  <tr>
    <th width="91" bgcolor="#0099FF"> <div align="center">อายุการใช้งาน</a></div></th>
    <th width="98" bgcolor="#0099FF"> <div align="center">จำนวนที่เหลือ</a> </div></th>
  </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
?>
  <tr>
    <td><div align="center"><?=$objResult["type_net"];?></div></td>
    <td align="center"><?=$objResult["count"];?></td>
  </tr>
<?
}
?>
</table>