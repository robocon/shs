<?php 
include 'bootstrap.php';

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

    return $pAge;
}

// ข้าราชการ
$db = Mysql::load();
$db->select("SELECT * FROM `opcardchk` WHERE `part` = 'lpru61' ORDER BY `row` ASC");
$items = $db->get_items();

foreach( $items as $key => $item ){ 

    $hn = $item['HN'];

    $db->select("SELECT * FROM `opcard` WHERE `hn` = '$hn' ");
    $opcard = $db->get_item();

    $thidate = (date('Y') + 543).date('-m-d H:i:s');
    $thdatehn = date('d-m-').(date('Y') + 543).$hn;
    $ptname = $opcard['yot'].$opcard['name'].' '.$opcard['surname'];
    $age = calcage($opcard['dbirth']);
    $ptright = $opcard['ptright'];
    $goup = $opcard['goup'];
    $camp = $opcard['camp'];
    $idcard = $opcard['idcard'];
    $time1 = date('H:i:s');

    $db->exec("LOCK TABLES `runno` READ");
    $db->select("SELECT * FROM `runno` WHERE `title` = 'VN'");
    $runno = $db->get_item();
    $nVn = $runno['runno'];
    $nVn++;
    $db->exec("UNLOCK TABLES");
    
    $db->exec("LOCK TABLES `runno` WRITE");
    $db->update("UPDATE runno SET runno = '$nVn' WHERE title='VN'");
    $db->exec("UNLOCK TABLES");

    $thdatevn = date('d-m-').(date('Y') + 543).$nVn;
    
    $opday_sql = "INSERT INTO `opday` (
        `row_id`, `thidate`, `thdatehn`, `hn`, `vn`, 
        `thdatevn`, `an`, `ptname`, `age`, `ptright`, 
        `goup`, `camp`, `dxgroup`, `diag`, `diag_morbidity`, 
        `diag_complication`, `diag_other`, `external_cause`, `icd10`, `icd10_morbidity`, 
        `icd10_complication`, `icd10_other`, `icd10_external_cause`, `icd9cm`, `doctor`, 
        `waittime`, `okopd`, `PHAR`, `xray`, `patho`, 
        `emer`, `surg`, `physi`, `denta`, `other`, 
        `note`, `idcard`, `borow`, `toborow`, `inopdday`, 
        `officer`, `erok`, `erdiag`, `kew`, `phaok`, 
        `time1`, `time2`, `clinic`, `icd101`, `withdraw`, 
        `history`, `diagicd10`, `diagtype`, `ref_icd10`, `officer2`, 
        `checkdx`, `diag_eng`, `diag_thai`, `dr_input`, `typeservice`, 
        `subgroup`, `opdreg`
    ) VALUES (
        NULL, '$thidate', '$thdatehn', '$hn', '$nVn', 
        '$thdatevn', NULL, '$ptname', '$age', '$ptright', 
        '$goup', '$camp', '21', NULL, NULL, 
        NULL, NULL, NULL, NULL, NULL, 
        NULL, NULL, NULL, NULL, NULL, 
        NULL, 'N', 0.00, 0.00, 0.00, 
        0.00, 0.00, 0.00, 0.00, 0.00, 
        'ม.ราชภัฏลำปาง', '$idcard', '', 'EX26 ตรวจสุขภาพประจำปี', NULL, 
        'ระบบคอมพิวเตอร์', 'N', NULL, NULL, 'Y', 
        '$time1', NULL, NULL, NULL, NULL, 
        NULL, '', NULL, '', NULL, 
        'P', '', '', NULL, NULL, 
        NULL, 'x'
    );";
    $db->insert($opday_sql);
    dump($opday_sql);

    echo "<hr>";
}



