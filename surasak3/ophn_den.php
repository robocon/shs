<?php
   session_start();
   
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>พิมพ์ใบประวัติผู้ป่วยทางทันตกรรม จาก&nbsp; HN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12" id="aLink"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ตกลง  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"></p>
</form>
<hr />
<? 
if (!empty($_POST['hn'])){
    include("connect.inc");


    $query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE hn = '".$_POST['hn']."'";
    $result = mysql_query($query)or die("Query failed");
	
	
	$rows=mysql_num_rows($result);
	
	
	if($rows){

?>

<table>
 <tr>
  <th height="22" bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED width="70">ยศ</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>สกุล</th>
  <th bgcolor=6495ED>สิทธิ</th>
<th bgcolor=6495ED>พิมพ์ใบต่อ หน้า </th>
<th bgcolor=6495ED>พิมพ์ใบต่อ หลัง </th>
  </tr>

<?php



    while (list ($hn,$yot,$name,$surname,$ptright,$ptright1,$idcard) = mysql_fetch_row ($result)) {

        print (" <tr>\n".
           "  <td>$hn</td>\n".
           "  <td>$yot</td>\n".
           "  <td>$name</td>\n".
           "  <td>$surname</td>\n".
		   "  <td>$ptright</td>\n".
           "  <td  align='center'><a href='opdprint_den.php?hn=$hn' target=_blank>พิมพ์ด้านหน้า</a></td>\n".
		   "  <td  align='center'><a href='opdprint_den2.php?hn=$hn' target=_blank>พิมพ์ด้านหลัง</a></td>\n".
		 //   "  <td  align='center'>พิมพ์ด้านหลัง</td>\n".
           " </tr>\n");	   
	}

?>
</table>


<?
	}else{
		
	echo "<h4>ไม่พบ HN </h4>";
	}

include("unconnect.inc");
       }
?>


