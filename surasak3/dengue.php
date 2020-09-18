<?php 
include 'bootstrap.php';
$db = Mysql::load();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>���Ҥ��������»���ҳ�ҡ ICD10 Dengue</title>
</head>
<body>
<style>
*{
    font-family: "TH Sarabun New", "TH SarabunPSK";
    font-size: 16pt;
}
body{
    padding: 8px;
    margin: 0;
}
/* ���ҧ */
.chk_table{
    border-collapse: collapse;
    width: 100%;
}
.chk_table th{
    background-color: #b8b8b8;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
</style>

    <div>
        <div><a href="../nindex.htm">&lt;&lt;&nbsp;˹����ѡ �.�.�</a></div>
    </div>

    <div>
        <h3 style="display: inline-block; font-size: 28px;">���Ҥ������¨ҡ ICD10 Dengue</h3>&nbsp;<span style="">���� ICD10 A90, A91, A971 ��� A972</span>
    </div>

    <form action="dengue.php" method="post">

        <div>
            <?php 
            $yRange = range(2012,date('Y'));

            $y = date('Y');
            $yearSelected = input_post('years', $y);
            $m = date('m');
            $monthSelected = input_post('months', $m);

            ?>
            <span>���͡��: <?=getYearList('years', true, $yearSelected, $yRange);?></span> 
            <span>���͡��͹: <?=getMonthList('months', $monthSelected);?></span>
        </div>
        <div>
            <button type="submit">���Ң�����</button>
            <input type="hidden" name="action" value="search">
        </div>
    
    </form>

<?php 
$action = input_post('action');
if ($action === 'search') {

    $yearSelected = input_post('years');
    $yearSelected += 543;

    $monthSelected = input_post('months');

    $sql = "SELECT `row_id`,`regisdate`,`hn`,`an`,`diag`,`icd10`,`type`,`diag_thai`,IF( `an` REGEXP '/', 'ipd', 'opd') AS `optype` 
    FROM `diag` 
    WHERE regisdate like '$yearSelected-$monthSelected%' 
    AND ( `icd10` LIKE 'a90' OR `icd10` LIKE 'a91' OR `icd10` LIKE 'a971' OR `icd10` LIKE 'a972' ) 
    ORDER BY `optype`,`regisdate` ";
    $db->select($sql);

    if($db->get_rows() > 0){
        $items = $db->get_items();

        ?>
        <div><h3>��������͹ <?=$def_fullm_th[$monthSelected];?> ��<?=$yearSelected;?></h3></div>
        <table class="chk_table">
            <tr>
                <th>HN</th>
                <th>AN/AN</th>
                <th>�ѹ���</th>
                <th>Diag</th>
                <th>ICD10</th>
                <th>Type</th>
                <th>Diag ��</th>
                <th>��������(�ҷ)</th>
            </tr>
        
        <?php
        foreach ($items as $key => $user) {
            
            $price = $date = '';
            $hn = $user['hn'];
            $an = $user['an'];
            if ($user['optype'] === 'ipd') {
                
                $sql = "SELECT `dcdate` AS `date`,`price` FROM `ipcard` WHERE `an` = '$an'";
                $db->select($sql);
                $ip = $db->get_item();
                $price = $ip['price'];
                $date = $ip['date'];

            }elseif ($user['optype'] === 'opd') {

                $sql = "SELECT `thidate` AS `date`, (`PHAR`+`xray`+`patho`+`emer`+`surg`+`physi`+`denta`+`other`) AS `price` FROM `opday` WHERE `hn` = '$hn' AND `vn` = '$an' ";
                $db->select($sql);
                $op = $db->get_item();
                $price = $op['price'];
                $date = $op['date'];

            }

            ?>
            <tr>
                <td><?=$user['hn'];?></td>
                <td><?=$user['an'];?></td>
                <td><?=$date;?></td>
                <td><?=$user['diag'];?></td>
                <td><?=$user['icd10'];?></td>
                <td><?=$user['type'];?></td>
                <td><?=$user['diag_thai'];?></td>
                <td style="text-align: right;"><?=number_format($price, 2);?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php 
    }else{
        ?><p>��辺������</p><?php
    }
    
}
?>

</body>
</html>

<?php 

