<?php 
include 'bootstrap.php';

$shs_configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottow',
    'pass' => ''
);
$db = Mysql::load($shs_configs);






$sql = "SELECT * FROM `opcardchk` WHERE `part` = 'newsoldier62in61' ";
$db->select($sql);
$items = $db->get_items();

?>

<style>
*{
    font-family: "TH Sarabun New","TH SarabunPSK";
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, .chk_table th, .chk_table td{
    border: 1px solid black;
    font-size: 16pt;
    padding: 3px;
}
</style>

<table class="chk_table">

    <tr>
        <th>#</th>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>หน่วย</th>
        <th>วันที่</th>
        <th>ICD10</th>
        <th>Diag</th>
    </tr>

<?php
$i = 0;
foreach ($items as $key => $item) {
    ++$i;
    $name = $item['name'];
    $surname = $item['surname'];
    $branch = $item['branch'];

    $sql_op = "SELECT `hn`,`idcard`,`name`,`surname` FROM `opcard` WHERE `name` = '$name' AND `surname` = '$surname' ";
    $db->select($sql_op);
    $user = null;
    $hn = null;
    $opday = null;

    $thidate = null;
    $icd10 = null;
    $diag = null;

    $thidate_list = array();
    $icd10_list = array();
    $diag_list = array();

    if( $db->get_rows() > 0 ){

        $user = $db->get_item();
        $hn = $user['hn'];
        
        $opday_sql = "SELECT `thidate`,`ptname`,`diag`,`icd10` 
        FROM `opday` 
        WHERE  `hn` = '$hn' 
        AND ( `thidate` >= '2562-05-01 00:00:00' AND `thidate` <= '2562-05-31 23:59:59' ) ";
        $db->select($opday_sql);
        $opdays = $db->get_items();
        foreach ($opdays as $key => $op) {
            $thidate_list[] = $op['thidate'];
            $icd10_list[] = ( empty($op['icd10']) ) ? '-' : $op['icd10'] ;
            $diag_list[] = ( empty($op['diag']) ) ? '-' : $op['diag'] ;
        }

        $thidate = implode('<br>', $thidate_list);
        $icd10 = implode('<br>', $icd10_list);
        $diag = implode('<br>', $diag_list);

    }

    ?>

    <tr valign="top">
        <td><?=$i;?></td>
        <td>
            <?php 
            if($hn){
                echo $hn;
            }else{
                echo "-";
            }
            ?>
        </td>
        <td><?=$name.' '.$surname;?></td>
        <td><?=$branch;?></td>
        <td><?=$thidate;?></td>
        <td><?=$icd10;?></td>
        <td><?=$diag;?></td>
    </tr>

    <?php

}

?>

</table>