<?php
	session_start();
    include("connect.inc");
  
    $row_id = $_GET['row_id'];

    // ź�������͡�ҡ��� drugallergy
    $q = mysql_query("SELECT * FROM `drugreact` WHERE `row_id` = '$row_id' ");
    $item = mysql_fetch_assoc($q);
    $hn = $item['hn'];
    $drugcode = $item['drugcode'];

    $sql = "DELETE FROM `drugallergy` WHERE `PID` = '$hn' AND `drugcode` = '$drugcode' ";
    mysql_query($sql);
    // ź�������͡�ҡ��� drugallergy
    
    $query = "DELETE FROM drugreact WHERE row_id = '$row_id' ";
    $result = mysql_query($query)
        or die("Query failed");

    If ($result){
          print "ź���������º��������<br>";
          print "�Դ˹�ҵ�ҧ���";
		  ?>
		 <script>
         window.location.href='dgadv.php?cHn=<?=$_SESSION['sHn']?>';
         </script>
         <?
 	}
    include("unconnect.inc");
?>