<?php 
$dbi = new mysqli(HOST, USER, PASS, DB);

$q_labor = $dbi->query("SELECT * FROM `43labor` WHERE `ipcard_date` LIKE '$date_serv%' ORDER BY `id` ASC ");
$txt = $labor_data = "";

while ($item = $q_labor->fetch_assoc()) { 

    $HOSPCODE = $item['HOSPCODE'];
    $PID = $item['PID'];
    $GRAVIDA = $item['GRAVIDA'];
    $LMP = $item['LMP'];
    $EDC = $item['EDC'];
    $BDATE = $item['BDATE'];
    $BRESULT = $item['BRESULT'];
    $BPLACE = $item['BPLACE'];
    $BHOSP = $item['BHOSP'];
    $BTYPE = $item['BTYPE'];
    $BDOCTOR = $item['BDOCTOR'];
    $LBORN = $item['LBORN'];
    $SBORN = $item['SBORN'];
    $D_UPDATE = $item['D_UPDATE'];
    $CID = $item['CID'];

    $labor_data = "$HOSPCODE|$PID|$GRAVIDA|$LMP|$EDC|$BDATE|$BRESULT|$BPLACE|$BHOSP|$BTYPE|$BDOCTOR|$LBORN|$SBORN|$D_UPDATE|$CID\r\n";
    $txt .= $labor_data;
}

$filePath = $dirPath.'/labor.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|GRAVIDA|LMP|EDC|BDATE|BRESULT|BPLACE|BHOSP|BTYPE|BDOCTOR|LBORN|SBORN|D_UPDATE|CID\r\n";
$txt = $header.$txt;

$qofPath = $dirPath.'/qof_labor.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม labor เสร็จเรียบร้อย<br>";