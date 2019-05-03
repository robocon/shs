<?php
# หน้าสติกเกอร์ 
# พี่สอง post deploy - pre deploy
include 'bootstrap.php';


$db = Mysql::load($shs_configs);

$sql = "SELECT * 
FROM `opcardchk` 
WHERE `part` = 'newsoldier62in61' ";
$db->select($sql);

$items = $db->get_items();

$labin = '620507';
// $labin = '';
$i = 0;

foreach ($items as $key => $item) {
// for($i=1; $i<=54; $i++){

    $hn = $item['HN'];
    $code_exam = $item['exam_no'];

    $pid = (int) $item['pid'];

    $pid = sprintf('%03d', $pid);

    $branch = $item['branch'];

    $normal_code = $code_exam.'01';
    $chem_code = $code_exam.'02';
    $ua_code = $code_exam.'03';

    $fname = str_replace(array('นาย','นางสาว','นาง'), '', $item['name']);

    $name = 'พลฯ'.$fname.' '.$item['surname'];
    ?>
    <!-- CBC -->
    <font style='line-height:20px;' face='Angsana New' size='4'><center><b><?=$name;?></b></center></font>
    <font  style='line-height:18px;' face='Angsana New' size='4'><center><b><?=$pid.' '.$branch;?></b></center></font>
	<div style='text-align:center;'>
		<span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$normal_code;?>"></span>
	</div>
	<div style="page-break-before: always;"></div>

    <!-- CHEM -->
    <font style='line-height:20px;' face='Angsana New' size='4'><center><b><?=$name;?></b></center></font>
    <font  style='line-height:18px;' face='Angsana New' size='4'><center><b><?=$pid.' '.$branch;?></b></center></font>
	<div style='text-align:center;'>
		<span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$normal_code;?>"></span>
	</div>
	<div style="page-break-before: always;"></div>

    <!-- UA -->
    <!--
	<font style='line-height:20px;' face='Angsana New' size='4'><center><b><?=$name;?></b></center></font>
    <font  style='line-height:18px;' face='Angsana New' size='4'><center><b><?=$hn;?> (03)</b></center></font>
	<div style='text-align:center;'>
		<span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$ua_code;?>"></span>
	</div>
	<div style="page-break-before: always;"></div>
    -->
    <?php 

    $i++;

    // if( $i == 3 ){
    //     exit;
    // }


    /*
    if( $item['exam_no'] >= "622110" ){
    ?>

        <!-- ST 2 ใบ -->
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b>STOOL</b></center></font>
        <div style="page-break-before: always;"></div>

        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b>STOOL C/S</b></center></font>
        <div style="page-break-before: always;"></div>

        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b>STOOL C/S</b></center></font>
        <div style="page-break-before: always;"></div>

        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b>STOOL C/S</b></center></font>
        <div style="page-break-before: always;"></div>

        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b>STOOL C/S</b></center></font>
        <div style="page-break-before: always;"></div>

        
        <?php
    }
    */

}