<?php
    include("connect.inc");
        $query ="UPDATE newpha SET newpha = '$newpha' 
";
        $result = mysql_query($query)
                       or die("Query failed,update labcare");
   If (!$result){
        echo "insert into labcare fail";
                    }
   else {
        echo "�ѹ�֡��䢢��������º����";
          }
include("unconnect.inc");
?>


