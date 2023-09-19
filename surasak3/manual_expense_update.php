<?php 
require_once 'bootstrap.php';
require_once 'class_file/class_depart.php';
require_once 'class_file/class_patdata.php';
require_once 'class_file/class_opacc.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$depart_id = sprintf("%s", $_GET['depart_id']);
$new_lab = sprintf("%s", $_GET['new_lab']);
$vn = sprintf("%s", $_GET['vn']);

dump($depart_id);
dump($new_lab);
dump($vn);

$labItems = explode(',', $new_lab);


$dep = new ClassDepart();
$item = $dep->getDepartFromId($depart_id);
dump($item);
$hn = $item['hn'];
$depart_date = $item['date'];

$sumYprice = 0;
$sumNprice = 0;

foreach ($labItems AS $key => $labCode) { 
    $sqlLabcare = sprintf("SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice`,`depart`,`part` FROM `labcare` WHERE `code` = '%s' ", $labCode);
    $q = $dbi->query($sqlLabcare);
    if ($q->num_rows > 0) { 
        $lab = $q->fetch_assoc();
        $code = $lab['code'];
        $detail = $lab['detail'];
        $price = $lab['price'];
        $nprice = $lab['nprice'];
        $yprice = $lab['yprice'];
        $depart = $lab['depart'];
        $part = $lab['part'];

        // $sql = "UPDATE patdata SET ";
        dump($code);
        $sql_patdata = "SELECT row_id FROM patdata WHERE date LIKE '2566-09-13%' AND hn = '$hn' AND code = '$code' AND depart = 'PATHO'";
        $qPat = $dbi->query($sql_patdata);
        if($qPat->num_rows>0){
            $pat = $qPat->fetch_assoc();

            $sumYprice += $yprice;
            $sumNprice += $nprice;
            
            $patdata_id = $pat['row_id'];
            $sql_pat_update = "UPDATE patdata SET 
            price = '$price',
            yprice = '$yprice',
            nprice = '',
            paid = '$price' 
            WHERE row_id = '$patdata_id' ";
            dump($sql_pat_update);
            $updatePatdata = $dbi->query($sql_pat_update);
            dump($updatePatdata);
        }
        
    }
}

$sumYprice = number_format($sumYprice, 2);
// $sumYprice = number_format($sumYprice, 2);

$sql = "UPDATE depart SET 
price = '$sumYprice', 
sumyprice = '$sumYprice',
sumnprice = '',
paid = '$sumYprice' 
WHERE row_id = '$depart_id' ";
dump($sql);
$updateDepart = $dbi->query($sql);
dump($updateDepart);

$sql = "SELECT row_id FROM opacc WHERE txdate = '$depart_date' AND hn = '$hn' AND depart = 'PATHO' AND vn = '$vn' ";
$qOpacc = $dbi->query($sql);
if ($qOpacc->num_rows>0) { 
    $opacc = $qOpacc->fetch_assoc();
    $opacc_id = $opacc['row_id'];

    $sql_opacc_update = "UPDATE opacc SET price = '$sumYprice', paid = '$sumYprice', paidcscd = '$sumYprice' WHERE row_id = '$opacc_id' ";
    dump($sql_opacc_update);
    $updateOpacc = $dbi->query($sql_opacc_update);
    dump($updateOpacc);
}