<?php

$dbi = new mysqli(HOST, USER, PASS, DB);

$q_women = $dbi->query("SELECT * FROM WOMEN ORDER BY `id` ASC ");
$txt = $women_data = "";

while ($item = $q_women->fetch_assoc()) {

    $HOSPCODE = $item['HOSPCODE'];
    $PID = $item['PID'];
    $FPTYPE = $item['FPTYPE'];
    $NOFPCAUSE = $item['NOFPCAUSE'];
    $TOTALSON = $item['TOTALSON'];
    $NUMBERSON = $item['NUMBERSON'];
    $ABORTION = $item['ABORTION'];
    $STILLBIRTH = $item['STILLBIRTH'];
    $D_UPDATE = $item['D_UPDATE'];
    $CID = $item['CID'];

    $women_data = "$HOSPCODE|$PID|$FPTYPE|$NOFPCAUSE|$TOTALSON|$NUMBERSON|$ABORTION|$STILLBIRTH|$D_UPDATE|$CID\r\n";
    $txt .= $women_data;
    
}

$zipLists[] = $filePath = $dirPath.'/women.txt';
file_put_contents($filePath, $txt);

$header = "HOSPCODE|PID|FPTYPE|NOFPCAUSE|TOTALSON|NUMBERSON|ABORTION|STILLBIRTH|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofLists[] = $qofPath = $dirPath.'/qof_women.txt';
file_put_contents($qofPath, $txt);