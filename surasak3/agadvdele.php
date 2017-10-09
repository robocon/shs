<?php
	session_start();
    include("connect.inc");
  
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