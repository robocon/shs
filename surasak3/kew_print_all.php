<?php

/*
mx01 ----> ������Ф�ͺ����

age >= 75 ����٧����

��Ǩ�ä�����

Q_ ��ǻ���
� ����
DEN_ �ѹ�����
�ٵ�_ �ٵ�

EYE_ ��

Old ����٧����

��� ��Ǩ�آ�Ҿ���þ�ҹ

*/

include 'bootstrap.php';

$id = input_get('id');

$db = Mysql::load();

$sql = "SELECT a.*, b.`idguard` 
FROM `opday` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`row_id` = '$id' ";
$db->select($sql);
$item = $db->get_item();

$type_queue = '��Ǩ�ä�����';
$wait_queue = '���Ѻ��ԡ�÷��ش�Ѵ�¡';
$age = substr($item['age'], 0, 2);
$mx = substr($item['idguard'], 0, 2);

if( preg_match('/(Q_|�|DEN_|�ٵ�_|EYE_|Old)/', $item['kew'], $match) > 0 ){
    $prefix = $match['0'];

    if( $prefix == '�' OR $mx == 'MX01' ){
        $type_queue = '������Ф�ͺ����';

    }elseif ( $prefix == 'DEN_' ) {
        $type_queue = '�ѹ�����';
        $wait_queue = '���Ѻ�ѵ�������蹷��Ἱ��ѹ�����';

    }elseif ( $prefix == '�ٵ�_' ) {
        $type_queue = '�ٵ�';
        $wait_queue = '���Ѻ�ѵ��������Ἱ��ٵ�';

    }elseif ( $prefix == 'EYE_' ) {
        $type_queue = '��';

    }elseif ( $prefix == 'Old' OR ( $prefix == 'Q_' && $age >= 75 ) ) {
        $type_queue = '����٧����';

    }elseif ( $prefix == '���' ) {
        $type_queue = '��Ǩ�آ�Ҿ���þ�ҹ';

    }
}

?>
<center><font size=5><b>�ӴѺ���: <?=$item['kew'];?></b><br>
<center><font size=4><b><?=$type_queue;?></b><br>
<center><font size=2><b>�ѹ��� <?=$item['thidate'];?></b><br>
<center><?=$item['ptname'];?><br>
<center>HN:<?=$item['hn'];?>.....VN:<?=$item['vn'];?><br>
<center><b><?=$wait_queue;?></b><br>
<script type="text/javascript">

function CloseWindowsInTime(t){
	window.print();
    t = t*1000;
    setTimeout("window.close()",t);
}
CloseWindowsInTime(2); 

</script>