<?php 

// $db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
// mysql_select_db('smdb', $db2) or die( mysql_error() );

$sql = "SELECT `HOSPCODE`,
`PID`, 
`GRAVIDA`, 
`LMP`, 
`EDC`, 
`VDRL_RESULT`, 
`HB_RESULT`, 
`HIV_RESULT`, 
`DATE_HCT`, 
`HCT_RESULT`, 
`THALASSEMIA`, 
`D_UPDATE`, 
`PROVIDER`, 
`CID`, 
`HEIGHT`
FROM `43prenatal` 
WHERE `date_serv` LIKE '$date_serv%' ";

$q = mysql_query($sql, $db2) or die( mysql_error() );

$txt = '';

while ( $item = mysql_fetch_assoc($q) ) {

    $txt .= $item['HOSPCODE'].'|'
    .$item['PID'].'|'
    .$item['GRAVIDA'].'|'
    .$item['LMP'].'|'
    .$item['EDC'].'|'
    .$item['VDRL_RESULT'].'|'
    .$item['HB_RESULT'].'|'
    .$item['HIV_RESULT'].'|'
    .$item['DATE_HCT'].'|'
    .$item['HCT_RESULT'].'|'
    .$item['THALASSEMIA'].'|'
    .$item['D_UPDATE'].'|'
    .$item['PROVIDER'].'|'
    .$item['CID'].'|'
    .$item['HEIGHT']."\r\n";

}

$filePath = $dirPath.'/prenatal.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|GRAVIDA|LMP|EDC|VDRL_RESULT|HB_RESULT|HIV_RESULT|DATE_HCT|HCT_RESULT|THALASSEMIA|D_UPDATE|PROVIDER|CID|HEIGHT\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_prenatal.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม prenatal เสร็จเรียบร้อย<br>";

// mysql_close($db2);