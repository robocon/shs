<?php 
$dbi = new mysqli(HOST, USER, PASS, DB);

$q_postnatal = $dbi->query("SELECT * FROM `43postnatal` WHERE `SEQ` LIKE '$date_serv%' ORDER BY `id` ASC ");
$txt = $postnatal_data = "";

while ($item = $q_postnatal->fetch_assoc()) { 
    
    $HOSPCODE = $item['HOSPCODE'];
    $PID = $item['PID'];
    $SEQ = $item['SEQ'];
    $GRAVIDA = $item['GRAVIDA'];
    $BDATE = $item['BDATE'];
    $PPCARE = $item['PPCARE'];
    $PPPLACE = $item['PPPLACE'];
    $PPRESULT = $item['PPRESULT'];
    $PROVIDER = $item['PROVIDER'];
    $D_UPDATE = $item['D_UPDATE'];
    $CID = $item['CID'];

    $postnatal_data = "$HOSPCODE|$PID|$SEQ|$GRAVIDA|$BDATE|$PPCARE|$PPPLACE|$PPRESULT|$PROVIDER|$D_UPDATE|$CID\r\n";
    $txt .= $postnatal_data;

}

$filePath = $dirPath.'/postnatal.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|GRAVIDA|BDATE|PPCARE|PPPLACE|PPRESULT|PROVIDER|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_postnatal.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม postnatal เสร็จเรียบร้อย<br>";