


<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*����������ԹҷչФ�Ѻ�ç�Ţ 5 */); 
</Script>
<?php
    session_start();
    include("connect.inc");
    $cAn=$an;
//update data in ipcard
        $query ="UPDATE ipcard SET  ajrw='$ajrw' 				                       
                       WHERE  an='$cAn' ";
        $result = mysql_query($query)
                       or die("Query failed,update ipacrd");
        echo "�ѹ�֡��䢢��������º����";
include("unconnect.inc");
?>


