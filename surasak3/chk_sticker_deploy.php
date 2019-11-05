<?php 

include 'bootstrap.php';
$db = Mysql::load();

$part = input_get('part');

$sql = "SELECT a.*
FROM `opcardchk` AS a 
WHERE a.`part` = '$part' 
ORDER BY a.`row` ASC";
$db->select($sql);
$items = $db->get_items();

    
$ii = 0;
foreach ($items as $key => $item) {
    
    ++$ii;

    $exam_no = $item['exam_no'];
    // $lab_chem = $exam_no."02";
    $ptname = $item['name'].' '.$item['surname'];
    // $hn = $item['HN'];
    
    // ปริ้นเผื่อมาสัก 3 ใบ พี่สมยศบอก
    for ($i=0; $i < 3; $i++) { 

        $last_code = '';

        if( $i == 0 ){
            $last_code = '01';
        }elseif ( $i == 1 ) {
            $last_code = '02';
        }
        ?>
        
        <font style='line-height:25px;' face='Angsana New' size='8'><center><b><?=$exam_no;?></b></center></font>
        <font style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$ptname;?></b></center></font>
        <font style='line-height:23px;' face='Angsana New' size='6'><center><b><?=$last_code;?></b></center></font>
        
        <!--<font style='line-height:10px;' face='Angsana New' size='3'><center><b><?=$lab_chem;?></b></center></font>
        <center><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$lab_chem;?>"></span></center>-->
        <div style="page-break-before: always;"></div>
        <?php
    }

    // if( $ii == 5 ){ exit; }
    
}