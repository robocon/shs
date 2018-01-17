<?php
include 'bootstrap.php';

if( empty($_SESSION['sOfficer']) ){ 
    echo '�Դ��ͼԴ��Ҵ�ҧ��С�� ��س�<a href="login_page.php">�������к�</a>�ա����';
    exit;
}

$db = Mysql::load();

include 'rg_menu.php';

$page = input('page');
$date_th = input('date_th');

$sql = "SELECT SUBSTRING(a.`thidate`,1,10) AS `pt_date` , a.`hn`, a.`vn`, a.`ptname`, a.`idcard`, 
CONCAT(b.`address`,' �.',b.`tambol`,' �.',b.`ampur`,' �.',b.`changwat`) AS `pt_address`
FROM `opday2` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`thidate` LIKE '$date_th%' 
AND a.`toborow` LIKE 'ex30%' ";
$db->select($sql);

$items = $db->get_items();

?>
<h3>��ª��ͼ�����Ң���Ѻ�ͧ�����ࡳ�����</h3>
<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff" width="100%">
    <tr>
        <th>�ӴѺ</th>
        <th>����-ʡ��</th>
        <th>�Ţ�ѵû�ЪҪ�</th>
        <!--<th>�ä����Ǩ��</th>
        <th>�������ǧ��Ѻ��� �� �.�. ����<br>
��Щ�Ѻ��䢷�� �� �.�. ����</th>
        <th>���ᾷ�����Ǩ</th>-->
        <th>�������ҷ���</th>
        <th>�.�.�. ����Ѻ��õ�Ǩ</th>
    </tr>
    <?php
    $i = 0;
    foreach ($items as $key => $item) {
        ++$i;
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['idcard'];?></td>
            <td><?=$item['pt_address'];?></td>
            <td><?=$item['pt_date'];?></td>
        </tr>
        <?php

    }
    ?>
</table>