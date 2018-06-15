<?php

include 'bootstrap.php';

$id = urldecode(input('id'));

$db = Mysql::load();
$db->select("SELECT * FROM `refer` WHERE `refer_runno` = '$id'");
$item = $db->get_item();

$type_wound_lists = array(
    'P02' => '���� (�)',
    'P03' => '���� (��)',
    'P04' => '���� (���)',
    'P05' => '��ͺ����',
    'P06' => '�.��',
    'P07' => '�.',
    'P08' => '��Сѹ�ѧ��',
    'P09' => '30�ҷ',
    'P10' => '30�ҷ�ء�Թ',
    'P11' => '�ú.',
    'P12' => '��.44'
);
$targe_list = array('1' => '��֡��/�ԹԨ���','2' => '�ѡ����������觡�Ѻ','3' => '�͹����');
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
<p><b>�Ţ��� Refer</b> : <?=$item['refer_runno'];?></p>
<p><b>���ҷ�� Refer</b> : <?=$item['dateopd'];?></p>
<p><b>�ҡ��</b> : <?=$organ;?></p>
<p><b>����ѡ��</b> : <?=$maintenance;?></p>
<p><b>�Է��������</b> : <?=$type_wound_lists[$type_wound];?></p>
<p><b>����������</b> : <?=$list_type_patient;?></p>
<p><b>���˵ء�� Refer</b> : <?=$item['exrefer'];?></p>
<p><b>ᾷ�����ѡ��</b> : <?=$item['doctor'];?></p>
<p><b>�ѵػ��ʧ��/����</b> : <?=$targe_list[$targe];?></p>
<p><b>������������</b> : <?=$pttype_list[$pttype];?></p>
<p><b>����Թ�ҧ</b> : <?=$item['refercar'];?></p>

<?php
if( $maintenance2 ){
    ?>
    <p><b>�������Ӥѭ�ͧ������</b> : - <?=$organ2?> <br> - <?=$maintenance2?></p>
    <?php
}
?>

<p><b>Refer 价���ç��Һ��</b> : <?=( ($item['referh'] !== '00') ? $item['referh'] : '-' );?></p>
<p><b>�ѭ�ҡ�� Refer</b> : <?=$problem_refer;?></p>
<p><b>��觷����仴���</b> : <?=( !empty($item['doc_refer']) ? '� Refer' : '' );?> 
<?=( !empty($item['nurse']) ? '��Һ��' : '' );?> 
<?=( !empty($item['assistant_nurse']) ? '������' : '' );?> 
<?=( !empty($item['suggestion']) ? '�����й�' : '' );?> 
<?=( !empty($item['estimate']) ? 'Ẻ�����Թ þ.�ӻҧ �����Ţ'.$item['no_estimate'] : '' );?> 
<?=( !empty($item['cradle']) ? '��' : '' );?> 
<?=( !empty($item['doc_txt']) ? '㺺ѹ�֡��ͤ���' : '' );?> </p>
<script type="text/javascript">
window.print();
</script>