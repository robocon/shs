<?php 

include 'bootstrap.php';

$shs_configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'remoteuser',
    'pass' => ''
);
$db = Mysql::load($shs_configs);

// r09 - 014
// r36 �͡ࢵ 

$def_road = input_get('show');

if ( $def_road == 'all' ) {
    $where = '';

}elseif ( $def_road == 'burana' ) {
    $where = "AND `address` LIKE '%��ó�%'";

}elseif ( $def_road == 'surasak' ) {
    $where = "AND `hospcode` LIKE '11512%'";

}elseif ( $def_road == 'sm3burana' ) {
    $where = "AND ( `address` LIKE '%��ó�%' AND `hospcode` LIKE '11512%' )";

}

$sql = "SELECT `row_id`,`idcard`,`hn`,`yot`,`name`,`surname`,`dbirth`,`ptright`,`address`,`tambol`,`ampur`,`changwat`,`sex`, 
`hphone`,`phone`,`ptffone`,TIMESTAMPDIFF( YEAR, thDateToEn(`dbirth`), NOW() ) AS `age`,`hospcode` 
FROM `opcard` 
WHERE ( `name` != '�غ����ѵ�' AND `idguard` NOT LIKE 'MX07%' ) 
$where 
AND `ptright` REGEXP 'R(09|1[0-4]|36)' 
AND ( 
    TIMESTAMPDIFF( YEAR, thDateToEn(`dbirth`), NOW() ) >= 50 
    AND 
    TIMESTAMPDIFF( YEAR, thDateToEn(`dbirth`), NOW() ) <= 70 
) 
ORDER BY `changwat`,`ampur`,`tambol`,`address` ASC ";
$db->select($sql);
$items = $db->get_items();

?>
<style>
*{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 14pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
    padding: 3px;
}
</style>

<a href="uc_list_user.php?show=all">������</a>&nbsp;|
&nbsp;<a href="uc_list_user.php?show=burana">੾�ж����ɮ���ó�</a>&nbsp;|
&nbsp;<a href="uc_list_user.php?show=surasak">������(11512)</a>&nbsp;|
&nbsp;<a href="uc_list_user.php?show=sm3burana">�����ɮ���ó�(11512)</a>

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>����-ʡ��</th>
        <th>HN</th>
        <th>�Ţ�ѵ�</th>
        <th>�ѹ�Դ</th>
        <th>����</th>
        <th>�Է��</th>

        <th>��ҹ�Ţ���</th>
        <th>��͡/���</th>
        <th>���</th>

        <th>�Ӻ�</th>
        <th>�����</th>
        <th>�ѧ��Ѵ</th>

        <th>������</th>
        <th>�����íҵ�</th>

        <th>þ.</th>

    </tr>
<?php 
$i = 1;
foreach ($items as $key => $item) { 

    $ptname = $item['yot'].$item['name'].' '.$item['surname'];
    ?>
    <tr>
        <td><?=$i;?></td>
        <td><?=$ptname;?></td>
        <td><?=$item['hn'];?></td>
        <td><?=$item['idcard'];?></td>
        <td><?=$item['dbirth'];?></td>
        <td><?=$item['age'];?></td>
        <td><?=$item['ptright'];?></td>

        <?php 
        $test_match = preg_match('/(\s(�\.|��͡).+)\s?/',$item['address'], $matchs);
        $soi = '';
        if($test_match > 0){
            $soi = trim($matchs[0]);

            $item['address'] = str_replace($soi,'',$item['address']);
        }

        $test_match = preg_match('/(\s(�\.|���).+)\s?/',$item['address'], $matchs);
        $road = '';
        if($test_match > 0){
            $road = trim($matchs[0]);

            $item['address'] = str_replace($road,'',$item['address']);
        }
        ?>
        <td><?=$item['address'];?></td>
        <td><?=$soi;?></td>
        <td><?=$road;?></td>

        <td><?=$item['tambol'];?></td>
        <td><?=$item['ampur'];?></td>
        <td><?=$item['changwat'];?></td>

        <td><?=$item['phone'].( ( $item['hphone'] != '-' && !empty($item['hphone']) ) ? ','.$item['hphone'] : '' );?></td>
        <td><?=$item['ptffone'];?></td>

        <td><?=$item['hospcode'];?></td>
    </tr>
    <?php
    $i++;
}
?>
</table>