<?php
    include("connect.inc");
        $query ="UPDATE runno SET prefix = '$prefix' ,
 runno = '$runno'				
                       WHERE title = '$title' ";
        $result = mysql_query($query)
                       or die("Query failed,update labcare");
   If (!$result){
        echo "�Դ��Ҵ ��䢢�������������";
                    }
   else {
        echo "��䢢��������º����";
		echo "<script>opener.location=opener.location.toString();self.close();</script>";
          }
include("unconnect.inc");
?>


