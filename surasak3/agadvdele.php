<?php
	session_start();
    include("connect.inc");
  
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