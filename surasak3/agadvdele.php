<?php
	session_start();
    include("connect.inc");
  
    $row_id = $_GET['row_id'];

    // ลบข้อมูลออกจากแฟ้ม drugallergy
    $q = mysql_query("SELECT * FROM `drugreact` WHERE `row_id` = '$row_id' ");
    $item = mysql_fetch_assoc($q);
    $hn = $item['hn'];
    $drugcode = $item['drugcode'];

    $sql = "DELETE FROM `drugallergy` WHERE `PID` = '$hn' AND `drugcode` = '$drugcode' ";
    mysql_query($sql);
    // ลบข้อมูลออกจากแฟ้ม drugallergy
    
    $query = "DELETE FROM drugreact WHERE row_id = '$row_id' ";
    $result = mysql_query($query)
        or die("Query failed");

    If ($result){
          print "ลบข้อมูลเรียบร้อยแล้ว<br>";
          print "ปิดหน้าต่างนี้";
		  ?>
		 <script>
         window.location.href='dgadv.php?cHn=<?=$_SESSION['sHn']?>';
         </script>
         <?
 	}
    include("unconnect.inc");
?>