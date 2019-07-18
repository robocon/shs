<?php 

set_time_limit(0);

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$db = mysql_connect('192.168.1.2', 'remoteuser', '') or die( mysql_error() );
mysql_select_db('smdb', $db) or die( mysql_error() );

// mysql_query('SET NAMES TIS620', $db);

$date_start = '2562-04-01';
$date_end = '2562-06-31';
$quarter = 3;
$year = '2562';

$dirPath = realpath(dirname(__FILE__))."/rdu";
$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_trauma_'.$quarter.'.sql';

unlink($filePath);

$sql = "SELECT *, 
CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `date_hn`
FROM `trauma`
WHERE ( `date` >= '$date_start 00:00:00' AND `date` <= '$date_end 23:59:59' ) ";
$q = mysql_query($sql, $db) or die( mysql_error() );


$sql_header = "INSERT INTO `trauma` (`id`, `trauma_id`, `date`, `hn`, `ptright`, `dx`, `organ`, `maintenance`, `cure`, `doctor`, `trauma`, `type_wounded`, `type_wounded2`, `date_hn`, `quarter`, `year`) VALUES ";

$sql_data_list = array();
$test_i = 0;

while ( $item = mysql_fetch_assoc($q) ) {

    $trauma_id = $item['row_id'];
    $date = $item['date'];
    $hn = $item['hn'];

    $ptright = $item['list_ptright'];
    $dx = htmlspecialchars($item['dx'], ENT_QUOTES);
    $dx = trim(preg_replace('/\s+/',' ',$dx));

    $organ = htmlspecialchars($item['organ'], ENT_QUOTES);
    $organ = trim(preg_replace('/\s+/',' ',$organ));

    $maintenance = htmlspecialchars($item['maintenance'], ENT_QUOTES);
    $maintenance = trim(preg_replace('/\s+/',' ',$maintenance));

    $cure = $item['cure'];
    $doctor = $item['doctor'];
    $trauma = $item['trauma'];
    $type_wounded = $item['type_wounded'];
    $type_wounded2 = $item['type_wounded2'];
    $date_hn = $item['date_hn'];

    $sql_data_list[] = "(NULL, '$trauma_id', '$date', '$hn', '$ptright', '$dx', '$organ', '$maintenance', '$cure', '$doctor', '$trauma', '$type_wounded', '$type_wounded2', '$date_hn', '$quarter', '$year')";

    $test_i++;
}

$data_sql = implode(",\n", $sql_data_list);

file_put_contents($filePath, $sql_header."\n".$data_sql, FILE_APPEND);
file_put_contents($filePath, ';', FILE_APPEND);

mysql_close($db);

echo "Success";