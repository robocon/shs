<?php
$connect = mysql_connect('localhost', 'root', '1234');
mysql_select_db('smdb', $connect);

$sql = "SELECT table_name, table_rows
FROM INFORMATION_SCHEMA.TABLES 
WHERE TABLE_SCHEMA = 'smdb' 
ORDER BY table_rows DESC;";
$query = mysql_query($sql, $connect) or die( mysql_error() );

$head_bash = "#!/bin/bash\n";
$sedtxt = $sqltxt = '';
while( $item = mysql_fetch_assoc($query) ){

    $tb_name = $item['table_name'];
    $table_rows = (int) $item['table_rows'];
    if ( $table_rows < 10000 ) {
        $sqltxt .= "mysqldump -u root -p1234 --default-character-set=latin1 smdb $tb_name | egrep -v \"(^SET|^/\*\!)\" > $tb_name.sql\n";

        $sedtxt .= "sed -i -r 's/latin1/utf8/g; s/tis620/utf8/g; s/InnoDB/MyISAM/g; s/COMMENT '.\+'/,/g' $tb_name.sql\n";
    }
    
}

if( !file_exists('exports') ){
    mkdir('exports', 755);
}

file_put_contents('exports/db_lists.sh', $head_bash.$sqltxt);
file_put_contents('exports/sed_lists.sh', $head_bash.$sedtxt);
print "create script successful\n"
?>