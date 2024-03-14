<?php 
require_once 'bootstrap.php';
require_once 'class_file/class_depart.php';
require_once 'class_file/class_patdata.php';
require_once 'class_file/class_opacc.php';
require_once 'class_file/class_resulthead.php';
require_once 'class_file/opday.php';

require_once 'manual_expense_config.php';

$dep = new ClassDepart();
$result = new ClassResulthead();
$opacc = new ClassOpacc();

$date = (date('Y')+543).date('-m-d');

$startDate = '2567-03-07 00:00:00';
$endDate = '2567-03-07 23:59:59';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=COMPANY_PART;?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <?php 
    $sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`ptright`, 
    c.`vn` 
    FROM (
        SELECT * FROM `manual_expense` WHERE `part` = '".COMPANY_PART."' 
    ) AS a LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`
    LEFT JOIN (
        SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,toborow 
        FROM opday 
        WHERE thidate >= '$startDate' and thidate <= '$endDate' 
    ) AS c ON a.`hn` = c.`hn`
    GROUP BY a.hn
    ORDER BY a.id ASC";
    $q = $dbi->query($sql);
    require_once 'manual_expense_menu.php';
    ?>
    <div class="">
        <h3><?=COMPANY_PART;?></h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>สิทธิ</th>
                    <th>VN</th>
                    <th></th>
                    <th>Lab Result</th>
                    <th>LAB</th>
                    <th>XRAY</th>
                    <th>สกง</th>
                    <th>comment</th>
                </tr>
            </thead>
            <?php 
            $ii = 1;
            if ($q->num_rows>0) {
                ?>
                <tbody>
                    <?php 
                    while ($a = $q->fetch_assoc()) {

                        $currHn = $a['hn'];

                        $patho = $dep->getDepart($date, $a['hn'], 'PATHO');
                        $xray = $dep->getDepart($date, $a['hn'], 'XRAY');
                        $resultheadItems = $result->getResulthead($a['labnumber']);
 
                        $op = $opacc->getOpacc($date, $a['hn']);
                        ?>
                        <tr>
                            <td><?=$ii;?></td>
                            <td><?=$a['hn'];?></td>
                            <td><?=$a['ptname'];?></td>
                            <td><?=$a['ptright'];?></td>
                            <td>
                                <?php 
                                if (empty($a['vn'])) {
                                    ?>
                                    <a href="manual_expense_vn.php?hn=<?=$currHn;?>" target="_blank" class="text-danger"><b>ไม่มี VN</b></a>
                                    <?php
                                }else{
                                    echo $a['vn'];
                                }
                                ?>
                            </td>
                            <td><?=$a['toborow'];?></td>
                            <td>
                                <?php 
                                if ($resultheadItems===false) {
                                    echo "รอผลแลป";
                                }else {
                                    $profileCode = array();
                                    $labnumber = '';
                                    foreach($resultheadItems AS $rh){
                                        $labnumber = $rh['labnumber'];
                                        $profileCode[] = $rh['profilecode'];
                                    }
                                    // echo $labnumber.'<br>'.implode(',', $profileCode);
                                    echo $labnumber;
                                }
                                ?>
                            </td>
                            <td>
                                <?php 
                                // if ($patho===false && !empty($a['vn'])) { 

                                    $urlLab = "hn=".$a['hn'];
                                    $urlLab .= "&depart=PATHO";
                                    $urlLab .= "&officer=".rawurldecode('พัชรี คำฟู');
                                    $urlLab .= "&moneyOfficer=".rawurldecode('นางสาว วัลยา คำปาเชื้อ');
                                    $urlLab .= "&credit=".rawurldecode('จ่ายตรง อปท.');
                                    ?>
                                    <a href="manual_expense_lab_add.php?<?=$urlLab;?>" class="btn btn-primary btn-sm" target="_blank"><i class="bi bi-currency-bitcoin"></i></a>
                                    <?php
                                // }
                                ?>
                            </td>
                            <td>
                                <?php 
                                // if ($xray===false && !empty($a['vn'])) { 
                                    $url = "hn=".$a['hn'];
                                    $url .= "&depart=XRAY";
                                    $url .= "&officer=".rawurldecode('สุทธิชัย หนูมา');
                                    $url .= "&moneyOfficer=".rawurldecode('นางสาว วัลยา คำปาเชื้อ');
                                    $url .= "&credit=".rawurldecode('จ่ายตรง อปท.');
                                    ?>
                                    <a href="manual_expense_xray_add.php?<?=$url;?>" class="btn btn-primary btn-sm" target="_blank"><i class="bi bi-currency-bitcoin"></i></a>
                                    <?php
                                // }
                                ?>
                            </td>
                            <td>
                                <?php 
                                // dump($a);
                                foreach ($patho as $key => $pItem) {
                                    $id = $pItem['row_id'];
                                    ?>
                                    <!-- manual_expense_update.php?depart_id=<?=$id;?>&new_lab=<?=rawurldecode($a['lab_items']);?>&vn=<?=$a['vn'];?> -->
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" target="_blank">
                                        <?=$pItem['row_id'];?> <?=$pItem['depart'];?> (<?=$pItem['price'];?>)
                                    </a>
                                    <?php 
                                }

                                // dump($xray);
                                foreach($xray AS $x){
                                    ?>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" ><?=$x['depart'].'('.$x['price'].')';?></a>
                                    <?php
                                }
                                ?>
                                
                            </td>
                            <td>
                                <?=$a['comment'];?>
                            </td>
                        </tr>
                        <?php
                        $ii++;
                    }
                    ?>
                    
                </tbody>
                <?php
            }
            ?>
            
        </table>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>