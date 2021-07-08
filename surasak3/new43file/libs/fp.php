<?php

$dbi = new mysqli(HOST, USER, PASS, DB);
$q_fp = $dbi->query("SELECT * FROM `43fp` WHERE `DATE_SERV` LIKE '$date_serv%' ORDER BY `id` ASC ");
$txt = $fp_data = "";

while ($item = $q_fp->fetch_assoc()) {
    
    $HOSPCODE = $item['HOSPCODE'];
    $PID = $item['PID'];
    $SEQ = $item['SEQ'];
    $DATE_SERV = $item['DATE_SERV'];
    $FPTYPE = $item['FPTYPE'];
    $FPPLACE = $item['FPPLACE'];
    $PROVIDER = $item['PROVIDER'];
    $D_UPDATE = $item['D_UPDATE'];
    $CID = $item['CID'];


    $fp_data = "$HOSPCODE|$PID|$SEQ|$DATE_SERV|$FPTYPE|$FPPLACE|$PROVIDER|$D_UPDATE|$CID\r\n";
    $txt .= $fp_data;
    
}

$filePath = $dirPath.'/fp.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|FPTYPE|FPPLACE|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_fp.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม fp เสร็จเรียบร้อย<br>";