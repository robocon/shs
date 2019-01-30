<?php 

// $db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
// mysql_select_db('smdb', $db2) or die( mysql_error() );

list($year, $month, $day) = explode('-', $thimonth);

$dServ = ( $year - 543 ).$month.$day;

// var_dump($dServ);
// var_dump($day);

if( $day == "" ){
    $where = "`date_serv` LIKE '$dServ%'";
}else{
    $where = "`date_serv` LIKE '$dServ'";
}

// exit;


$sql = "SELECT '11512' AS `HOSPCODE`,
`pid` AS `PID`, 
`seq` AS `SEQ`, 
`date_serv` AS `DATE_SERV`, 
`gravida` AS `GRAVIDA`, 
`ancno` AS `ANCNO`, 
`ga` AS `GA`, 
`ancres` AS `ANCRESULT`, 
`aplace` AS `ANCPLACE`, 
`provider` AS `PROVIDER`, 
`d_update` AS `D_UPDATE`, 
`cid` AS `CID`
FROM `anc` 
WHERE $where ";
// var_dump($sql);
$q = mysql_query($sql, $db2) or die( mysql_error() );

$txt = '';

while ( $item = mysql_fetch_assoc($q) ) {

    /*
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
    */

    $txt .= $item['HOSPCODE'].'|'
    .$item['PID'].'|'
    .$item['SEQ'].'|'
    .$item['DATE_SERV'].'|'
    .$item['GRAVIDA'].'|'
    .$item['ANCNO'].'|'
    .$item['GA'].'|'
    .$item['ANCRESULT'].'|'
    .$item['ANCPLACE'].'|'
    .$item['PROVIDER'].'|'
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

// mysql_close($db2);