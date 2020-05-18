<?php 

$sql = "SELECT * FROM `tb_provider_9` ORDER BY `ROW_ID` ";
$q = mysql_query($sql);

$providerTXT = '';
while ($item = mysql_fetch_assoc($q)) {

    $HOSPCODE = $item['HOSPCODE'];
    $PROVIDER = $item['PROVIDER'];
    $REGISTERNO = $item['REGISTERNO'];
    $CONCIL = $item['CONCIL'];
    $CID = $item['CID'];
    $PRENAME = $item['PRENAME'];
    $NAME = $item['NAME'];
    $LNAME = $item['LNAME'];
    $SEX = $item['SEX'];
    $BIRTH = $item['BIRTH'];
    $PROVIDERTYPE = $item['PROVIDERTYPE'];
    $STARTDATE = $item['STARTDATE'];
    $OUTDATE = $item['OUTDATE'];
    $MOVEFROM = $item['MOVEFROM'];
    $MOVETO = $item['MOVETO'];
    $D_UPDATE = $item['D_UPDATE'];

    $providerTXT .= "$HOSPCODE|$PROVIDER|$REGISTERNO|$CONCIL|$CID|$PRENAME|$NAME|$LNAME|$SEX|$BIRTH|$PROVIDERTYPE|$STARTDATE|$OUTDATE|$MOVEFROM|$MOVETO|$D_UPDATE\r\n";

}

$filePath = $dirPath.'/provider.txt';

file_put_contents($filePath, $providerTXT);
$zipLists[] = $filePath;

$header = "HOSPCODE|PROVIDER|REGISTERNO|CONCIL|CID|PRENAME|NAME|LNAME|SEX|BIRTH|PROVIDERTYPE|STARTDATE|OUTDATE|MOVEFROM|MOVETO|D_UPDATE\r\n";
$providerTXTQOF = $header.$providerTXT;
$qofPath = $dirPath.'/qof_provider.txt';
file_put_contents($qofPath, $providerTXTQOF);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม provider เสร็จเรียบร้อย<br>";