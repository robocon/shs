<?php
    include("connect.inc");
  
    $query = "DELETE FROM inputm WHERE idname = '$idname' ";
    $result = mysql_query($query)
        or die("Query failed");

    If ($result){
          print "ź���������º��������<br>";
          print "�Դ˹�ҵ�ҧ���";
 	}
    include("unconnect.inc");
?>