<?php
session_start();
include("connect.inc");
$cy='N';

//update kew in opday
$query ="UPDATE opday SET phaok='$cy' WHERE thdatehn = '$thdatehn'  AND vn = '".$_SESSION["nVn"]."' ";
$result = mysql_query($query) or die("Query failed,update opday");

?>
<Script Language="JavaScript">
function CloseWindowsInTime(t){
    t = t*1000;
    setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*����������ԹҷչФ�Ѻ�ç�Ţ 5 */); 
</Script>
<?php
If (!$result){
    echo "insert into opday fail";
}else {
    echo "�ѹ�֡��䢢��������º����";
    echo "�觢��������º����  $query";
}

$_SESSION['sTdatehn'] = NULL;