<?php 
require_once dirname(__FILE__).'/../surasak3/bootstrap.php';
require_once dirname(__FILE__).'/../surasak3/class_file/class_opcard.php';

function toThai($t){
    return iconv('WINDOWS-874', 'UTF-8', $t);
}
$file_name = 'checkup-sso-user.csv';
$file = fopen($file_name,"r");

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$classOpcard = new Opcard();

$limit = 10;
$i = 0;
$depart = '';
while(! feof($file))
{
    list($number, $a, $b, $idcard, $cbc, $ua, $bs, $cr, $hdlChol, $hbsag, $fobt, $cxr) = fgetcsv($file);
    $idcard = str_replace('-', '', trim($idcard));
    
    $testDepart = toThai($a);
    $matchDepart = mb_ereg("^รายชื่อ|^นาย|^นาง|^น\.ส\.|^ยศ|^หน่วยงาน", $testDepart);
    if($matchDepart===false && !empty($testDepart)){
        $depart = $testDepart;
        // var_dump($depart);
        // echo "\n\n";
    }

    $verrify = false;
    $opcard = false;
    if(strlen($idcard)===13){
        $opcard = $classOpcard->getByIdcard($idcard);
        if(!empty($opcard['idcard'])){
            $verrify = true;
        }
    }

    $lab = array();

    if($verrify===true){
        // var_dump($depart);
        // var_dump($opcard['ptname']);
        // var_dump($idcard);
        // var_dump($ua);
        // var_dump($bs);
        // var_dump($hdlChol);
        // var_dump($hbsag);
        // var_dump($fobt);
        // var_dump($cxr);
        if($bs=='/'){
            $lab[] = 'BS';
        }
        if($cr=='/'){
            $lab[] = 'CR-sso';
        }
        if($hdlChol=='/'){
            $lab[] = 'HDL-sso';
        }
        if($hbsag=='/'){
            $lab[] = 'HBSAG';
        }
        if($fobt=='/'){
            $lab[] = 'STOCB-sso';
        }

        // if(count($lab)>0){
            $labItem = implode(',', $lab);
            $hn = $opcard['hn'];
            $idcard = $opcard['idcard'];
            
            $sql = "INSERT INTO `lab67` (`id`, `hn`, `idcard`, `lab`) VALUES (NULL, '$hn', '$idcard', '$labItem');";
            dump($sql);
            $save = $dbi->query($sql);
            dump($save);
        // }

        echo "\n\n";
    }
    
    // if($i==$limit){
    //     exit;
    // }
    $i++;
}

fclose($file);