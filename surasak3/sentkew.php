<?php
session_start();
global $thdatehn;
include("connect.inc");

$cy='X';

//update kew in opday
$query ="UPDATE opday SET phaok='$cy' WHERE thdatehn = '$thdatehn'  AND vn = '".$_SESSION["nVn"]."' ";
$result = mysql_query($query) or die( mysql_error() );
if (!$result){
    echo "insert into opday fail";
} else {
    echo '<p>�ѹ�֡��䢢��������º����</p>';
    echo '<p>�觢��������º����</p>';
}
include("unconnect.inc");
session_unregister("sTdatehn");
?>
<script type="text/javascript">
function CloseWindowsInTime(t){
    t = t*1000;
    setTimeout( function(){
       window.close(); 
    }, t);
}
CloseWindowsInTime(1); 
</script>
