<?php 
require_once dirname(__FILE__).'/../surasak3/bootstrap.php';
require_once dirname(__FILE__).'/../surasak3/class_file/class_opcard.php';

function toThai($t){
    return iconv('WINDOWS-874', 'UTF-8', $t);
}
// $file_name = 'checkup-sso-user.csv';
$file_name = 'hem.csv';
$file = fopen($file_name,"r");

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$classOpcard = new Opcard();

$limit = 10;
$i = 0;
$depart = '';
?>
<table>

<?php
while(! feof($file))
{
    list($number, $a, $b, $idcardExcel, $cbc, $ua, $bs, $cr, $hdlChol, $hbsag, $fobt, $cxr) = fgetcsv($file);
    $idcardExcel = str_replace('-', '', trim($idcardExcel));
    // var_dump($idcardExcel);
    $testDepart = toThai($a);
    $matchDepart = mb_ereg("^รายชื่อ|^นาย|^นาง|^น\.ส\.|^ยศ|^หน่วยงาน", $testDepart);
    if($matchDepart===false && !empty($testDepart)){
        $depart = $testDepart;
        // var_dump($depart);
        // echo "\n\n";
    }

    $verrify = false;
    $opcard = false;
    if(strlen($idcardExcel)===13){
        $opcard = $classOpcard->getByIdcard($idcardExcel);
        if(!empty($opcard['idcard'])){
            $verrify = true;
        }
    }

    // dump($opcard);

    $lab = array();

    // if($verrify===true){

        if($cbc=='/'){
            $lab[] = 'CBC-sso';
        }
        if($ua=='/'){
            $lab[] = 'UA-sso';
        }
        if($bs=='/'){
            $lab[] = 'BS';
        }
        if($cr=='/'){
            $lab[] = 'CR-sso';
        }
        if($hdlChol=='/'){
            $lab[] = 'HDL-sso';
            $lab[] = 'CHOL-sso';
        }
        if($hbsag=='/'){
            $lab[] = 'HBSAG';
        }
        if($fobt=='/'){
            $lab[] = 'STOCB-sso';
        }
        if($cxr=='/'){
            $lab[] = '41001-CHK';
        }

        // if(count($lab)>0){
            $labItem = implode(',', $lab);
            $hn = $opcard['hn'];
            // $idcard = $opcard['idcard'];
            
            
        // }
        if(!empty($idcardExcel) && strlen($idcardExcel)===13){ 

            // lab67full
            $sql = "INSERT INTO `lab67full` (`id`, `hn`, `idcard`,depart, `lab`) VALUES (NULL, '$hn', '$idcardExcel','$depart', '$labItem');";
            // dump($sql);
            // $save = $dbi->query($sql);
            // dump($save);

            // $dbi->query("UPDATE lab67 SET depart = '$depart' WHERE hn='$hn'")
            ?>
            <tr>
                <td><?=$depart;?></td>
                <td><?=$idcardExcel;?></td>
                <td><?=$hn;?></td>
                <td>
                    <?php 
                    if(!empty($hn)){
                        echo $opcard['ptname'];
                    }else{
                        echo '<span style="color:red;"><b>error</b></span>';
                    }
                    ?>
                </td>
                <td><?=$opcard['age'];?></td>
                <td><?=$opcard['ptright'];?></td>
                <td><?=$labItem;?></td>
            </tr>
            <?php
        }

    $i++;
}

fclose($file);
?>
</table>