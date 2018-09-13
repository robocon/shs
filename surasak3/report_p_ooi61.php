<?php 

// $db2 = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
$db2 = mysql_connect('192.168.1.2', 'remoteuser', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );


$sql = "select COUNT(`hn`) 
from opday
where thidate like '2561-08%' 
and ptright like 'r07%'";
$q = mysql_query($sql) or die( mysql_error() );
// ==> 4372 


$sql = "select COUNT(`hn`) 
from opday
where thidate like '2561-08%' 
and (  
    ptright like 'r09%' 
    or ptright like 'r10%' 
    or ptright like 'r11%' 
    or ptright like 'r12%' 
    or ptright like 'r13%' 
    or ptright like 'r14%' 
)";
$q = mysql_query($sql) or die( mysql_error() );
// ==> 660

