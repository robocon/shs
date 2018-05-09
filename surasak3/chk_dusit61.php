<?php
# หน้าสติกเกอร์
include 'bootstrap.php';


$db = Mysql::load();

$sql = "SELECT * FROM `opcardchk` WHERE `part` = 'สวนดุสิต61' ORDER BY `exam_no` ASC ";
$db->select($sql);

$items = $db->get_items();

$labin = '180510';

foreach ($items as $key => $item) {

    $hn = $item['HN'];
    $code_exam = $labin.$item['exam_no'];

    $normal_code = $code_exam.'01';
    $chem_code = $code_exam.'02';

    $name = $item['name'].' '.$item['surname'];
    ?>
    <!-- CBC -->
    <font style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
	<div style='text-align:center;'>
		<span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$normal_code;?>"></span>
	</div>
	<div style="page-break-before: always;"></div>

    <!-- CHEM -->
    <font style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
	<div style='text-align:center;'>
		<span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$chem_code;?>"></span>
	</div>
	<div style="page-break-before: always;"></div>

    <!-- UA 2 ใบ -->
	<font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
	<font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
	<font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$code_exam;?></b></center></font>
	<div style="page-break-before: always;"></div>
    <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
	<font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
	<font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$code_exam;?></b></center></font>
	<div style="page-break-before: always;"></div>


    <?php
    if( $item['course'] == '2' ){
        ?>

        <!-- ST 2 ใบ -->
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$code_exam;?></b></center></font>
        <div style="page-break-before: always;"></div>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$code_exam;?></b></center></font>
        <div style="page-break-before: always;"></div>

        <!-- CLS 3 ใบ -->
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$code_exam;?></b></center></font>
        <div style="page-break-before: always;"></div>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$code_exam;?></b></center></font>
        <div style="page-break-before: always;"></div>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$code_exam;?></b></center></font>
        <div style="page-break-before: always;"></div>

        <!-- OUTLAB 1 ใบ -->
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$name;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$hn;?></b></center></font>
        <font  style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$code_exam;?></b></center></font>
        <div style="page-break-before: always;"></div>
        <?php
    }
}