<?php 
require_once 'bootstrap.php';
require_once 'class_file/class_depart.php';
require_once 'class_file/class_patdata.php';
require_once 'class_file/class_opacc.php';
require_once 'class_file/class_resulthead.php';
require_once 'class_file/opday.php';

// require_once 'manual_expense_config.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$part = sprintf("%s", $_GET['part']);
$q = $dbi->query("SELECT `id`,`code` FROM `chk_company_list` WHERE `code` = '$part' LIMIT 1 ");
if($q->num_rows == 0){
    echo "Invalid part";
    exit;
}
$chkCompany = $q->fetch_assoc();
$companyPart = $chkCompany['code'];

$dep = new ClassDepart();
$result = new ClassResulthead();
$opacc = new ClassOpacc();

$date = (date('Y')+543).date('-m-d');
$startDate = $date.' 00:00:00';
$endDate = $date.' 23:59:59';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$companyPart;?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    // เอาค่า company part (code) ไปใช้ในเมนูด้วย
    require_once 'manual_expense_menu.php';


    $sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`ptright`, 
    c.`vn` 
    FROM (
        SELECT * FROM `manual_expense` WHERE `part` = '$companyPart' 
    ) AS a LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`
    LEFT JOIN (
        SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,toborow 
        FROM opday 
        WHERE thidate >= '$startDate' and thidate <= '$endDate' 
    ) AS c ON a.`hn` = c.`hn`
    GROUP BY a.hn
    ORDER BY a.id ASC";
    $q = $dbi->query($sql);
    if($q->num_rows == 0){
        ?>
        <div class="text-center alert alert-danger m-3"><strong>ยังไม่มีข้อมูลนำเข้าการตรวจแลป กรุณานำเข้าข้อมูลก่อนดำเนินการต่อไป</strong></div>
        <?php
    }

    $qConfig = $dbi->query("SELECT * FROM `expense_config`");
    $config = array();
    while ($a = $qConfig->fetch_assoc()) {
        $key = $a['type'];
        $config[$key] = $a['name'];
    }
    
    ?>
    <div class="alert alert-info m-3">
        <strong>การใช้งาน</strong>
        <ol>
            <li>การลงทะเบียน สถานะออก OPD CARD จะเป็น <strong>EX51 ตรวจสุขภาพ อปท.</strong></li>
            <li>การบันทึกค่าใช้จ่าย จำเป็นต้องกำหนดชื่อเจ้าหน้าที่ ที่ปฏิบัติงานในวันนั้นๆ</li>
        </ol>
    </div>
    <div class="">
        <h3><?=$companyPart;?></h3>
        <div>

        </div>
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
                            <td><?=$a['ptname'];?><br><?=$a['lab_items'];?></td>
                            <td><?=$a['ptright'];?></td>
                            <td>
                                <?php 
                                if (empty($a['vn'])) {
                                    ?>
                                    <a href="manual_expense_vn.php?hn=<?=$currHn;?>" target="_blank" class="btn btn-primary btn-sm">ออก VN</a>
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
                                    $urlLab .= "&officer=".rawurldecode($config['lab']);
                                    $urlLab .= "&moneyOfficer=".rawurldecode($config['money']);
                                    $urlLab .= "&credit=".rawurldecode('จ่ายตรง อปท.');
                                    $urlLab .= "&companyPart=".rawurldecode($companyPart);
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
                                    $url .= "&officer=".rawurldecode($config['xray']);
                                    $url .= "&moneyOfficer=".rawurldecode($config['money']);
                                    $url .= "&credit=".rawurldecode('จ่ายตรง อปท.');
                                    $url .= "&companyPart=".rawurldecode($companyPart);
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

                                    $pathoDate = substr($pItem['date'], 0, 10);
                                    $pathoHn = $pItem['hn'];
                                    $pathoVn = $pItem['tvn'];
                                    
                                    ?>
                                    <!-- manual_expense_update.php?depart_id=<?=$id;?>&new_lab=<?=rawurldecode($a['lab_items']);?>&vn=<?=$a['vn'];?> -->
                                    <a href="reportcash1.php?hn=<?=$pathoHn;?>&vn=<?=$pathoVn;?>&date=<?=$pathoDate;?>" class="btn btn-primary btn-sm" target="_blank">
                                        <?=$pItem['row_id'];?> <?=$pItem['depart'];?> (<?=$pItem['price'];?>)
                                    </a>
                                    <?php 
                                }

                                // dump($xray);
                                foreach($xray AS $x){ 
                                    $pathoDate = substr($x['date'], 0, 10);
                                    $pathoHn = $x['hn'];
                                    $pathoVn = $x['tvn'];
                                    ?>
                                    <a href="reportcash1.php?hn=<?=$pathoHn;?>&vn=<?=$pathoVn;?>&date=<?=$pathoDate;?>" class="btn btn-primary btn-sm" target="_blank"><?=$x['depart'].'('.$x['price'].')';?></a>
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