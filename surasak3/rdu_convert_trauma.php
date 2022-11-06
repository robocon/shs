<?php 
set_time_limit(0);

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

function toUTF($txt){
    return iconv("TIS620", "UTF8", $txt);
    // return $txt;
}

define('HOST', '192.168.131.240');
define('PORT', '3306');
define('DB', 'sm3db-utf8');
define('USER', 'sm3db_user');
define('PASS', 'sm3dbPassword');

$dbi = new mysqli(HOST,USER,PASS,DB);
if($dbi->connect_errno){
    echo $dbi->connect_errno;
    exit;
}
$dbi->query("SET NAMES UTF8");

$date_start = '2565-10-01';
$date_end = '2565-10-31';

$quarter = 1;
$year = '2566';

$dirPath = realpath(dirname(__FILE__))."/rdu";
if(!file_exists($filePath)){
    mkdir($dirPath);
}

$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_trauma_'.$quarter.'.sql';
if(file_exists($filePath))
{
    unlink($filePath);
}

$sql = "SELECT *, 
CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `date_hn`
FROM `trauma`
WHERE ( `date` >= '$date_start 00:00:00' AND `date` <= '$date_end 23:59:59' ) ";
$q = $dbi->query($sql);

$sql_header = "INSERT INTO `rdu_trauma` (`id`, `trauma_id`, `date`, `hn`, `ptright`, `dx`, `organ`, `maintenance`, `cure`, `doctor`, `trauma`, `type_wounded`, `type_wounded2`, `date_hn`, `quarter`, `year`) VALUES ";
// $sql_data_list = array();

while ( $item = $q->fetch_assoc() ) {
    // dump($item);
    $trauma_id = $item['row_id'];
    $date = $item['date'];
    $hn = $item['hn'];

    $ptright = $item['list_ptright'];
    $dx = htmlspecialchars($item['dx'], ENT_QUOTES);
    $dx = trim(preg_replace('/\s+/',' ',$dx));

    $organ = $item['organ'];
    $organ = htmlspecialchars($organ, ENT_QUOTES);
    $organ = trim(preg_replace('/\s+/',' ',$organ));

    $maintenance = htmlspecialchars($item['maintenance'], ENT_QUOTES);
    $maintenance = trim(preg_replace('/\s+/',' ',$maintenance));

    $cure = $item['cure'];
    $doctor = $item['doctor'];
    $trauma = $item['trauma'];
    $type_wounded = $item['type_wounded'];
    $type_wounded2 = $item['type_wounded2'];
    $date_hn = $item['date_hn'];

    $sql_insert = $sql_header."(NULL, '$trauma_id', '$date', '$hn', '$ptright', '$dx', '$organ', '$maintenance', '$cure', '$doctor', '$trauma', '$type_wounded', '$type_wounded2', '$date_hn', '$quarter', '$year');\n";
    // dump($test);

    file_put_contents($filePath, $sql_insert, FILE_APPEND);

}
// $sql_value = implode(',', $sql_data_list);
// $sql_header.$sql_value;
// file_put_contents($filePath, $sql_header.$sql_value, FILE_APPEND);

echo "Success";