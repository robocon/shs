<?php
    include("connect.inc");
    $query = "UPDATE appoint SET apptime = '¡��ԡ��ùѴ' WHERE  row_id = '$cRow' ";
    $result = mysql_query($query) or die("Query failed");
    If ($result){
        // require_once 'delappoi_json.php';
        print "¡��ԡ��ùѴ���º����<br>";
        print "�Դ˹�ҵ�ҧ���";
 	}
    // include("unconnect.inc");
?>
