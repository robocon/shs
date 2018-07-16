<?php
    echo "<p align='center'><strong>รหัสยา/เวชภัณฑ์</strong></p>";
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<table width="98%" align="center">
 <tr>
  <th width="5%" bgcolor=#009966>#</th>
  <th width="11%" bgcolor=#009966>รหัส</th>
  <th width="34%" bgcolor=#009966>ชื่อการค้า</th>
  <th width="34%" bgcolor=#009966>ชื่อสามัญ</th>
  <th width="8%" bgcolor=#009966>ประเภทยา</th>
  <th width="8%" bgcolor=#009966>สถานะ</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT drugcode,tradname, genname, part, drug_active FROM druglst where grouptype !='pc' ORDER BY drugcode ASC";
	//echo $query;
    $result = mysql_query($query)
        or die("Query failed");
	$i=0;
    while (list ($drugcode, $tradname, $genname, $part, $active) = mysql_fetch_row ($result)) {
	$i++;
	if($active=="y"){
		$active="active";
	}else if($active=="n"){
		$active="inactive";
	}
        print (" <tr>\n".
           "  <td align='center' BGCOLOR=66CC99>$i</td>\n".
		   "  <td BGCOLOR=66CC99>$drugcode</td>\n".
           "  <td BGCOLOR=66CC99>$tradname</td>\n".
		   "  <td BGCOLOR=66CC99>$genname</td>\n".
		   "  <td BGCOLOR=66CC99>$part</td>\n".
		   "  <td BGCOLOR=FF9999>$active</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>

