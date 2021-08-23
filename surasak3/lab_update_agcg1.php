<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
// $dbi->query("SET NAMES TIS620");
// $dbi->query("SET NAMES UTF8");

$sql_patdata = $dbi->query("SELECT *,SUBSTRING(`date`,1,10) AS `short_date` FROM `patdata` WHERE ( `date` LIKE '2564-07-19%' OR `date` LIKE '2564-07-20%' ) AND `code` = 'AgCG1' ");
while ($pat = $sql_patdata->fetch_assoc()) {
    
    $row_id = $pat['row_id'];
    $id_no = $pat['idno'];
    $hn = $pat['hn'];
    $pat_date = $pat['date'];

    list($date, $time) = explode(' ', $pat['date']);

    if($pat['short_date']=='2564-07-19')
    {
        $newDate = '2564-07-13';
    }
    elseif ($pat['short_date']=='2564-07-20') 
    {
        $newDate = '2564-07-19';
    }

    $newPatdataDate = $newDate.' '.$time;
    

    $pat_update_sql = "UPDATE `patdata` SET `date` = '$newPatdataDate' WHERE `row_id` = '$row_id' ";
    $update_pat = $dbi->query($pat_update_sql);
    dump($pat_update_sql);
    dump($update_pat);

    $dep_update_sql = "UPDATE `depart` SET `date` = '$newPatdataDate' WHERE `row_id` = '$id_no' ";
    $update_dep = $dbi->query($dep_update_sql);
    dump($dep_update_sql);
    dump($update_dep);

    $sql_opacc = "SELECT `row_id`, `date` FROM `opacc` WHERE `txdate` = '$pat_date' AND `hn` = '$hn' ";
    $opacc_q = $dbi->query($sql_opacc);
    if($opacc_q->num_rows > 0)
    {
        $opacc = $opacc_q->fetch_assoc();
        $opaccId = $opacc['row_id'];

        list($opaccDate, $opaccTime) = explode(' ',$opacc['date']);
        // list($opaccTxDate, $opaccTxTime) = explode(' ',$opacc['txdate']);

        $newOpaccDate = $newDate.' '.$opaccTime;

        $opacc_update_sql = "UPDATE `opacc` SET `date` = '$newOpaccDate', `txdate` = '$newPatdataDate'  WHERE `row_id` = '$opaccId' ";
        $update_opacc = $dbi->query($opacc_update_sql);
        dump($opacc_update_sql);
        dump($update_opacc);
    }

    echo "<hr>";
    
}