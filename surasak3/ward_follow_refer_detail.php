<?php

include 'bootstrap.php';

$id = urldecode(input('id'));

$db = Mysql::load();
$db->select("SELECT * FROM `refer` WHERE `refer_runno` = '$id'");
$item = $db->get_item();

$type_wound_lists = array(
    'P02' => 'ทหาร (น)',
    'P03' => 'ทหาร (นส)',
    'P04' => 'ทหาร (พลฯ)',
    'P05' => 'ครอบครัว',
    'P06' => 'พ.ต้น',
    'P07' => 'พ.',
    'P08' => 'ประกันสังคม',
    'P09' => '30บาท',
    'P10' => '30บาทฉุกเฉิน',
    'P11' => 'พรบ.',
    'P12' => 'กท.44'
);
$targe_list = array('1' => 'ปรึกษา/วินิจฉัย','2' => 'รักษาแล้วให้ส่งกลับ','3' => 'โอนย้าย');
$pttype_list = array('1' => 'Emergency','2' => 'Urgent','3' => 'Non-Urgent');

$type_wound = $item['type_wound'];
$targe = $item['target_refer'];
$pttype = $item['pttype'];
$organ2 = $item['organ'];
$maintenance2 = $item['maintenance'];
$list_type_patient = $item['list_type_patient'];
$problem_refer = $item['problem_refer'];

$trauma_id = $item['trauma_id'];

if( !empty($trauma_id) ){
    $sql = "SELECT * FROM `trauma` WHERE `row_id` = '$trauma_id'; ";
    $db->select($sql);
    $trauma = $db->get_item();

    $organ = $trauma['organ'];
    $maintenance = $trauma['maintenance'];
    $type_wound = $trauma['list_ptright'];
    $list_type_patient = $trauma['type_wounded'];
    $problem_refer = $trauma['problem_refer'];
}
?>
<style type="text/css">
*{
    font-family: 'TH SarabunPSK';
    font-size: 14pt;
}
p{
    margin: 0;
}
</style>
<p><b>เลขที่ Refer</b> : <?=$item['refer_runno'];?></p>
<p><b>เวลาที่ Refer</b> : <?=$item['dateopd'];?></p>
<p><b>อาการ</b> : <?=$organ;?></p>
<p><b>การรักษา</b> : <?=$maintenance;?></p>
<p><b>สิทธิ์ผู้ป่วย</b> : <?=$type_wound_lists[$type_wound];?></p>
<p><b>ประเภทคนไข้</b> : <?=$list_type_patient;?></p>
<p><b>สาเหตุการ Refer</b> : <?=$item['exrefer'];?></p>
<p><b>แพทย์ผู้รักษา</b> : <?=$item['doctor'];?></p>
<p><b>วัตุประสงค์/เพื่อ</b> : <?=$targe_list[$targe];?></p>
<p><b>ประเภทผู้ป่วย</b> : <?=$pttype_list[$pttype];?></p>
<p><b>การเดินทาง</b> : <?=$item['refercar'];?></p>

<?php
if( $maintenance2 ){
    ?>
    <p><b>ข้อมูลสำคัญของผู้ป่วย</b> : - <?=$organ2?> <br> - <?=$maintenance2?></p>
    <?php
}
?>

<p><b>Refer ไปที่โรงพยาบาล</b> : <?=( ($item['referh'] !== '00') ? $item['referh'] : '-' );?></p>
<p><b>ปัญหาการ Refer</b> : <?=$problem_refer;?></p>
<p><b>สิ่งที่ส่งไปด้วย</b> : <?=( !empty($item['doc_refer']) ? 'ใบ Refer' : '' );?> 
<?=( !empty($item['nurse']) ? 'พยาบาล' : '' );?> 
<?=( !empty($item['assistant_nurse']) ? 'ผู้ช่วย' : '' );?> 
<?=( !empty($item['suggestion']) ? 'ให้คำแนะนำ' : '' );?> 
<?=( !empty($item['estimate']) ? 'แบบประเมิน รพ.ลำปาง หมายเลข'.$item['no_estimate'] : '' );?> 
<?=( !empty($item['cradle']) ? 'เปล' : '' );?> 
<?=( !empty($item['doc_txt']) ? 'ใบบันทึกข้อความ' : '' );?> </p>
<script type="text/javascript">
window.print();
</script>