<?php

$fix_date = date('YmdHis');

$sql = "SELECT 
'11512' AS `HOSPCODE`, `VILL_CODE` AS `VID`, '' AS `NTRADITIONAL`, 
'' AS `NMONK`, '' AS `NRELIGIONLEADER`, '' AS `NBROADCAST`, 
'' AS `NRADIO`, '' AS `NPCHC`, '' AS `NCLINIC`, 
'' AS `NDRUGSTORE`, '' AS `NCHILDCENTER`, '' AS `NPSCHOOL`, 
'' AS `NSSCHOOL`, '' AS `NTEMPLE`, '' AS `NRELIGIOUSPLACE`, 
'' AS `NMARKET`, '' AS `NSHOP`, '' AS `NFOODSHOP`, 
'' AS `NSTALL`, '' AS `NRAINTANK`, '' AS `NCHICKENFARM`, 
'' AS `NPIGRARM`, '' AS `WASTEWATER`, '' AS `GARBAGE`, 
'' AS `NFACTORY`, '' AS `LATITUDE`, '' AS `LONGITUDE`, 
'' AS `OUTDATE`, '' AS `NUMACTUALLY`, '' AS `RISKTYPE`, 
'' AS `NUMSTATELESS`, '' AS `NEXERCISECLUB`, '' AS `NOLDERLYCLUB`, 
'' AS `NDISABLECLUB`, '' AS `NUMBERONCELUB`, '".$fix_date."' AS `D_UPDATE` 
FROM `village` 
WHERE `TAM_CODE` = '520111' 
AND ( `VILL_NO` = '07' OR `VILL_NO` = '01' ) ";
$q = mysql_query($sql) or die( mysql_error() );

$txt = '';
while ( $item = mysql_fetch_assoc($q) ) {
    $txt .= $item['HOSPCODE'].'|'.$item['VID'].'|'.$item['NTRADITIONAL'].'|';
    $txt .= $item['NMONK'].'|'.$item['NRELIGIONLEADER'].'|'.$item['NBROADCAST'].'|';
    $txt .= $item['NRADIO'].'|'.$item['NPCHC'].'|'.$item['NCLINIC'].'|';
    $txt .= $item['NDRUGSTORE'].'|'.$item['NCHILDCENTER'].'|'.$item['NPSCHOOL'].'|';
    $txt .= $item['NSSCHOOL'].'|'.$item['NTEMPLE'].'|'.$item['NRELIGIOUSPLACE'].'|';
    $txt .= $item['NMARKET'].'|'.$item['NSHOP'].'|'.$item['NFOODSHOP'].'|';
    $txt .= $item['NSTALL'].'|'.$item['NRAINTANK'].'|'.$item['NCHICKENFARM'].'|';
    $txt .= $item['NPIGRARM'].'|'.$item['WASTEWATER'].'|'.$item['GARBAGE'].'|';
    $txt .= $item['NFACTORY'].'|'.$item['LATITUDE'].'|'.$item['LONGITUDE'].'|';
    $txt .= $item['OUTDATE'].'|'.$item['NUMACTUALLY'].'|'.$item['RISKTYPE'].'|';
    $txt .= $item['NUMSTATELESS'].'|'.$item['NEXERCISECLUB'].'|'.$item['NOLDERLYCLUB'].'|';
    $txt .= $item['NDISABLECLUB'].'|'.$item['NUMBERONCELUB'].'|'.$item['D_UPDATE'];
    $txt .= "\r\n";
}

$filePath = $dirPath.'/village.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|VID|NTRADITIONAL|NMONK|NRELIGIONLEADER|NBROADCAST|NRADIO|NPCHC|NCLINIC|NDRUGSTORE|NCHILDCENTER|NPSCHOOL|NSSCHOOL|NTEMPLE|NRELIGIOUSPLACE|NMARKET|NSHOP|NFOODSHOP|NSTALL|NRAINTANK|NCHICKENFARM|NPIGRARM|WASTEWATER|GARBAGE|NFACTORY|LATITUDE|LONGITUDE|OUTDATE|NUMACTUALLY|RISKTYPE|NUMSTATELESS|NEXERCISECLUB|NOLDERLYCLUB|NDISABLECLUB|NUMBERONCELUB|D_UPDATE\r\n";

$txt = $header.$txt;
$qofPath = $dirPath.'/qof_village.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม village เสร็จเรียบร้อย<br>";