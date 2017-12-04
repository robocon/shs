</body>
</html>
<html>
<head>
<title>เสียงประกาศ</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="10;URL=<?php echo $_SERVER['PHP_SELF'];

include("connect.inc");


	$query3 = "select row_id,kew  from soundpha where status= 'N'  limit 1  ";
	$row3 = mysql_query($query3);
	list($row_id,$kewpha111) = mysql_fetch_array($row3);






?>">
</head>
ประกาศเสียงรอรับยา กรุณา เปิดไว้ตลอดครับ


<embed src='soundkewpha/<?php echo $kewpha111;?>.wma' width='0' height='0' ></embed>
<?php  

echo $kewpha111; 

$query ="update soundpha SET status ='Y' WHERE row_id = '$row_id' limit 1 ";
		$result = mysql_query($query) or die("Query failed,update thaywin");



?>




<?php


    $query = "SELECT row_id,kew,hn FROM soundpha WHERE status = 'n'  ";
 $result = mysql_query($query) or die("Query failed");
	if(Mysql_num_rows($result) > 0){
?>
<table  align="center" style="font-family: Angsana New; font-size: 25px;">
 <tr>
	<th bgcolor="ffffff" colspan="9"  ><font size='5' color='#ff0000'><B><?php echo "รายชื่อเสียงที่ยังไม่ได้ประกาศ  ";?> </B></th>
  </tr>
 <tr>
 <th bgcolor="6495ED"><font size='4' >ลำดับ</th>	
 <th bgcolor="6495ED">เสียง</th>	
 <th bgcolor="6495ED"><font size='4' >HN</th>	
  </tr>

<?php

     $j=0;
	$countavg = 0;
    while (list ($row_id,$kew,$hn) = mysql_fetch_row ($result)) {
  print (
					" <tr>\n".
					
		
			"  <td BGCOLOR=ffffff><font face='Angsana New' size ='5'><b>$row_id</b></td>\n".
		"  <td BGCOLOR=fffffff><font face='Angsana New'  size ='7' >$kew</td>\n".	
				"  <td BGCOLOR=ffffff><font face='Angsana New' size ='5'><b>$hn</b></td>\n".	
		
					" </tr>\n");
       }
	
?>

</table>

<?php
	}
	
    include("unconnect.inc");
?>