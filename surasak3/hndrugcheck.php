<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบการใช้ยาตาม HN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'>&larr;ไปเมนู</a></p>
</form>

<table>
 <tr>
 <th bgcolor=CD853F>HN</th>
      <th bgcolor=CD853F>AN</th>
      <th bgcolor=CD853F>วันและเวลา</th>
      <th bgcolor=CD853F>drugcode</th>
      <th bgcolor=CD853F>ชื่อยา</th>
      <th bgcolor=CD853F>วิธีใช้</th>
      <th bgcolor=CD853F>จำนวน</th>
      <th bgcolor=CD853F>ราคา</th>
      <th bgcolor=CD853F>part</th>
      <th bgcolor=CD853F>แพทย์</th>
      <th bgcolor=CD853F>ผู้ตัด</th>
 </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,an,date,drugcode,tradname, slcode,amount, price,part FROM drugrx WHERE hn = '$hn'  ORDER BY date DESC " ;
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$an,$date,$drugcode,$tradname, $slcode,$amount, $price,$part) = mysql_fetch_row ($result)) {

		$sql = "Select doctor,idname From phardep where date = '$date'  ";
	//$result = Mysql_Query($sql);
	//list($doctor1,$idname1) = Mysql_fetch_row($result);
		list($doctor1,$idname1)  = mysql_fetch_row(Mysql_Query($sql));

$sql1="SELECT * FROM `druglst` WHERE drugcode='$drugcode' and had='Y' ";
$result1 =mysql_query($sql1);
$num=mysql_num_rows($result1);
if($num>0){
	
	$bg="#CC3333";
	
}else{
	
	$bg="#F5DEB3";
	
}
        print (" <tr>\n".
		"  <td BGCOLOR=$bg>$hn</td>\n".
		"  <td BGCOLOR=$bg>$an</td>\n".
		"  <td BGCOLOR=$bg>$date</a></td>\n".
		"  <td BGCOLOR=$bg>$drugcode</td>\n".
		"  <td BGCOLOR=$bg>$tradname</td>\n".
		"  <td BGCOLOR=$bg>$slcode</td>\n".
		"  <td BGCOLOR=$bg>$amount</td>\n".
		"  <td BGCOLOR=$bg>$price</td>\n".
		"  <td BGCOLOR=$bg>$part</td>\n".
		"  <td BGCOLOR=$bg>$doctor1</td>\n".
		"  <td BGCOLOR=$bg>$idname1</td>\n".
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
