<?php
include 'bootstrap.php';
include 'includes/cu_sso.php';
$sso = new CU_SSO();

// $_GET["part"] = "อินทราเซรามิค60";
$showpart = 'อินทราเซรามิค60';
$checkup_date_code = '170619';

$sql = "SELECT a.*,b.`sex`,b.`dbirth`
FROM `opcardchk` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`part` = '$showpart' 
ORDER BY a.`row` ASC ";
$result = mysql_query($sql);
while ( $item = mysql_fetch_assoc($result) ) {

    $age_year = substr($item['dbirth'], 0, 4);
    $sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
    $exam_no = $item['exam_no'];
    $fullname = $item['name'].' '.$item['surname'];

    // ตรวจพวก chem จะตามท้ายด้วย 01
    $lab_number = $checkup_date_code.$exam_no."01";

    // ตรวจพวก chem จะตามท้ายด้วย 02
    $lab_chem = $checkup_date_code.$exam_no."02";

    $all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);
    
    $pre_number = 0;
    if( in_array('CBC-sso', $all_lists) === true ){
        ++$pre_number;
        ?>
        <font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
        <font style='line-height:20px;' face='Angsana New' size='6'>
            <center><b><?=$pre_number;?>-<?=$exam_no;?></b> <span style="font-size: 14px;">CBC</span></center>
        </font>
        <center><span class='fc1-0'><img src="barcode/labstk.php?cLabno=<?=$lab_number;?>"></span></center>
        <div style="page-break-before: always;"></div>
        <?php
    }

    if( in_array('UA-sso', $all_lists) === true ){
        ++$pre_number;
        ?>
        <font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
        <font style='line-height:20px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
        <font style='line-height:20px;' face='Angsana New' size='5'><center><b>UA</b></center></font>
        <div style="page-break-before: always;"></div>
        <?php
    }

    // พวกเคม
    $fix_search = array('BS-sso','CR-sso','HDL-sso','CHOL-sso','HBSAG-sso');
    $test_diff = array_diff($fix_search, $all_lists);
    if( count($test_diff) < 5 ){
        ++$pre_number;

        $list_chem = array_diff($all_lists, $fix_search);
        $chem_text = implode(',', $list_chem);
        ?>
        <font style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
        <font style='line-height:23px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
        <center><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$lab_chem;?>"></span></center>
        <div style="page-break-before: always;"></div>
        <?php
    }

    if( in_array('STOCB-sso', $all_lists) === true ){
        ++$pre_number;
        ?>
        <font style='line-height:22px;'  face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
        <font style='line-height:20px;'  face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
        <font style='line-height:20px;'  face='Angsana New' size='5'><center><b>STOOL</b></center></font>
        <div style="page-break-before: always;"></div>
        <?php
    }

    $file = 'intraceramic60_print_sticker_log.txt';
    $content = $item['HN'].','.implode(',', $all_lists);
    $content .= "\n";
    file_put_contents('logs/'.$file, $content, FILE_APPEND | LOCK_EX);


}
