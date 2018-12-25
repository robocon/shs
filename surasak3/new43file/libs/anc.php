<?php 

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

$sql = "SELECT '11512' AS `HOSPCODE`,
`hn` AS `PID`, 
`vn`, 
thDateToEn(`thidate`) AS `DATE_SERV`, 
'' AS `GRAVIDA`, 
'' AS `ANCNO`, 
'' AS `GA`, 
'' AS `ANCRESULT`, 
'' AS `ANCPLACE`, 
TRIM(`doctor`) AS `doctor`, 
thDateTimeToEn(`thidate`) AS `D_UPDATE`, 
TRIM(`idcard`) AS `CID`
FROM `opday` 
WHERE `thidate` LIKE '$thimonth%' 
AND `toborow` LIKE 'ex08%' ";

$q = mysql_query($sql, $db2) or die( mysql_error() );

$txt = '';

while ( $item = mysql_fetch_assoc($q) ) {

    $seq = $item['DATE_SERV'].sprintf("%03d", $item['vn']); 

    if( preg_match('/^(MD\d+)/', $item['doctor'], $matchs) > 0 ){ 

        $pre_doc = $matchs['1'];
        $q2 = mysql_query("SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '$pre_doc%'", $db2) or die( mysql_error() );
        if ( mysql_num_rows($q2) > 0 ) {
            $dt = mysql_fetch_assoc($q2);
            $code = sprintf("%05d", $dt['doctorcode']);
        }else{

            $code = '00000';
        }

    }else{

        $test_match = preg_match('/(\d+){4,5}/', $item['doctor'], $match);
        if( $test_match > 0 ){
            $code = $match['1'];
        }

    }

    $provider = $seq.$code;

    $txt .= $item['HOSPCODE'].'|'
    .$item['PID'].'|'
    .$seq.'|'
    .$item['DATE_SERV'].'|'
    .$item['GRAVIDA'].'|'
    .$item['ANCNO'].'|'
    .$item['GA'].'|'
    .$item['ANCRESULT'].'|'
    .$item['ANCPLACE'].'|'
    .$provider.'|'
    .$item['D_UPDATE'].'|'
    .$item['CID']."\r\n";

}



$filePath = $dirPath.'/anc.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|GRAVIDA|ANCNO|GA|ANCRESULT|ANCPLACE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_anc.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม anc เสร็จเรียบร้อย<br>";

mysql_close($db2);