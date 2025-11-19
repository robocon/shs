<?php 
require_once dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

function mapData($v){
    return "'$v'";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระยะเวลารอคอยผู้ป่วย ARI Clinic</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
    #show-table tr th{
        background-color: #13795b;
		color: #ffffff;
    }
    label:hover{
        cursor: pointer;
    }
</style>
<div class="container-fluid">

    <h3 class="mt-2">ระยะเวลารอคอยผู้ป่วย ARI Clinic</h3>
    <span>* จำนวน ชั่วโมงและนาที คือระยะเวลาตั้งแต่ลงทะเบียนไปจนถึงเก็บเงินผู้ป่วย/จ่ายยา</span>
    <form action="report_covid_time.php" method="post">
        <div class="row g-3 align-items-center">
            <div class="col-auto">
                <label for="inputPassword6" class="col-form-label">เลือกวันเดือนปี</label>
            </div>
            <div class="col-auto">
                <?php
                $defYear = date('Y');
                $defMonth = sprintf("%02d", date('m'));
                $defDay = sprintf("%02d", date('d'));

                $ranges = range(2020, $defYear);

                $yearSelected = empty($_POST['years']) ? $defYear : $_POST['years'];
                $monthSelected = empty($_POST['months']) ? $defMonth : $_POST['months'];
                $daySelected = empty($_POST['days']) ? '' : $_POST['days'];

                ?>
                <?=getYearList('years',true,$yearSelected,$ranges,'form-select', false, true);?>
            </div>
            <div class="col-auto">
                <?=getMonthList('months',$monthSelected,'form-select', true);?>
            </div>
            <div class="col-auto">
                <?=getDateList('days',$daySelected,'form-select', true);?>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">แสดงผล</button>
                <input type="hidden" name="page" value="search">
            </div>
        </div>
    </form>

<?php
$page = $_POST['page'];
if($page){

    $y = $_POST['years'];
    $m = $_POST['months'];
    $d = $_POST['days'];

    $yTh = $y + 543;

    $whereOpday = " ( `thidate` >= '$yTh-01-01' AND `thidate` <= '$yTh-12-31' )";
    $whereOpd = " ( `thidate` >= '$yTh-01-01' AND `thidate` <= '$yTh-12-31' )";
    $whereDiag = " ( `svdate_en` >= '$y-01-01' AND `svdate_en` <= '$y-12-31' )";
    $whereOpself = " ( `registerdate` >= '$y-01-01' AND `registerdate` <= '$y-12-31' )";
    $whereDate = " ( `date` >= '$yTh-01-01' AND `date` <= '$yTh-12-31' )";
    if($yTh != '' AND ( $m != '' OR $d != '' ) ){
        if($m != ''){
            $dateLikeTh = "$yTh-$m%";
            $dateLikeEn = "$y-$m%";
        }
        if($d != ''){
            $dateLikeTh = "$yTh-$m-$d%";
            $dateLikeEn = "$y-$m-$d%";
        }
        $whereOpday = " `thidate` LIKE '$dateLikeTh' ";
        $whereOpd = " `thidate` LIKE '$dateLikeTh' ";
        $whereDiag = " `svdate_en` LIKE '$dateLikeEn' ";
        $whereOpself = " `registerdate` LIKE '$dateLikeEn' ";
        $whereDate = " `date` LIKE '$dateLikeTh' ";
    }


    $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_opday`
    (INDEX `thdatehn`(`thdatehn`))
    SELECT `ptname`,`thdatehn`,SUBSTRING(`thidate`,1,10) AS `registerdate`,SUBSTRING(`thidate`,12,8) AS `register_time`,CONCAT((SUBSTRING(`thidate`,1,4)-543),SUBSTRING(`thidate`,5,15)) AS `regisOfficeDateTime`
    FROM `opday` WHERE $whereOpday 
    GROUP BY `thdatehn`;";
    $q = $dbi->query($sql);
    if($q===false){
        echo $dbi->error;
    }

    $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_diag`
    (INDEX `thdatehn`(`thdatehn`))
    SELECT `hn`,`an` AS `vn`,GROUP_CONCAT(DISTINCT `icd10` SEPARATOR '<br>') AS `icd10`,GROUP_CONCAT(DISTINCT `diag` SEPARATOR '<br>') AS `diag`, `svdate_en`,CONCAT(SUBSTRING(`svdate`,9,2),'-',SUBSTRING(`svdate`,6,2),'-',SUBSTRING(`svdate`,1,4),`hn`) AS `thdatehn`,SUBSTRING(`svdate`,12,8) AS `dt_time`
    FROM `diag` WHERE $whereDiag AND `icd10` IN ('U071','J00','J101')
    AND `hn` <> '' 
    AND `icd10` <> '' 
    GROUP BY CONCAT(SUBSTRING(`svdate`,1,10),`hn`);";
    $q = $dbi->query($sql);
    if($q===false){
        echo $dbi->error;
    }
    
    $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_opselfisolation`
    (INDEX `thdatehn`(`thdatehn`))
    SELECT `registerdate`,`row_id` AS `id`,`thdatehn`,`hn`,`vn`,`ptname`,`officer_date`,SUBSTRING(`officer_date`,12,8) AS `opd_time` 
    FROM `opselfisolation` WHERE $whereOpself 
    AND `hn` <> '' 
    GROUP BY `thdatehn` 
    ORDER BY `row_id` ASC;";
    // $q = $dbi->query($sql);
    // if($q===false){
    //     echo $dbi->error;
    // }

    $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_opd`
    (INDEX `thdatehn`(`thdatehn`))
    SELECT `ptname`,`vn`,`thdatehn`,SUBSTRING(`thidate`,12,8) AS `opd_time`
    FROM `opd` WHERE $whereOpd 
    GROUP BY `thdatehn`;";
    $q = $dbi->query($sql);
    if($q===false){
        echo $dbi->error;
    }


    
    $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_dphardep`
    (INDEX `thdatehn`(`thdatehn`))
    SELECT SUBSTRING(`date`,12,8) AS `phar_time`,`hn`,CONCAT(SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn`) AS `thdatehn`
    FROM `dphardep` WHERE $whereDate
    AND `dr_cancle` IS NULL 
    GROUP BY CONCAT(SUBSTRING(`date`,1,10),`hn`);";
    $q = $dbi->query($sql);
    if($q===false){
        echo $dbi->error;
    }

    $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_opacc`
    (INDEX `thdatehn`(`thdatehn`))
    SELECT CONCAT((SUBSTRING(`date`,1,4)-543),SUBSTRING(`date`,5,15)) AS `opaccDate`,SUBSTRING(`date`,12,8) AS `money_time`,`hn`,CONCAT(SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn`) AS `thdatehn`
    FROM `opacc` WHERE $whereDate
    GROUP BY CONCAT(SUBSTRING(`date`,1,10),`hn`);";
    $q = $dbi->query($sql);
    if($q===false){
        echo $dbi->error;
    }

    $sql = "SELECT b.`registerdate`,c.`hn`,c.`vn`,b.`ptname`,b.`register_time`,c.`dt_time`,d.`phar_time`,e.`money_time`,f.`opd_time`
    ,MOD(HOUR(TIMEDIFF(b.`regisOfficeDateTime`,e.`opaccDate`)),24) AS `hour`
    ,MINUTE(TIMEDIFF(b.`regisOfficeDateTime`,e.`opaccDate`)) AS `minute`,c.`diag`,c.`icd10`
    FROM `tmp_diag` AS c
    LEFT JOIN `tmp_opday` AS b ON c.`thdatehn` = b.`thdatehn`
    LEFT JOIN `tmp_opd` AS f ON c.`thdatehn` = f.`thdatehn`
    LEFT JOIN `tmp_dphardep` AS d ON d.`thdatehn` = c.`thdatehn`
    LEFT JOIN `tmp_opacc` AS e ON e.`thdatehn` = c.`thdatehn`
    WHERE ( b.`register_time` IS NOT NULL AND e.`money_time` IS NOT NULL )";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <div>
            <span><strong>เลือก ICD 10 ที่ต้องการแสดงผล</strong></span>
            <?php
            $icdItems = array('U071','J00','J101');
            foreach ($icdItems as $item) {
                ?>
                <input type="checkbox" id="<?=$item;?>" class="selectedItem" value="<?=$item;?>" onclick="selectIcd10(this)" checked="checked">
                <label for="<?=$item;?>"><?=$item;?></label>
                <?php
            }

            // $forJs = array_map('mapData', $icdItems);
            // $setIcdItemForJs = implode(',', $forJs);
            ?>
        </div>
        <table class="table mt-2" id="show-table">
            <tr>
                <th>วันที่เข้ารับบริการ</th>
                <th>HN</th>
                <th>VN</th>
                <th>ชื่อ-สกุล</th>
                <th>icd10</th>
                <th>Diag</th>
                <th>ลงทะเบียน</th>
                <th>OPD</th>
                <th>พบแพทย์<br><span style="font-size:15px;">เวลาที่แพทย์จ่ายยา</span></th>
                <th>จ่ายยา</th>
                <th>ส่วนเก็บเงิน</th>
                <th>ชั่วโมง</th>
                <th>นาที</th>
            </tr>
        <?php
        while ($a = $q->fetch_assoc()) {
            if($a['phar_time']>$a['money_time']){
                $pTime = strtotime($a['phar_time']);
                $rTime = strtotime($a['register_time']);
                $diff = abs($pTime-$rTime);
                $a['minute'] = ($diff / 60)%60;
                $a['hour'] = round($diff / 3600);
            }
            ?>
            <tr class="data" data-icd="<?=$a['icd10'];?>">
                <td><?=$a['registerdate'];?></td>
                <td><?=$a['hn'];?></td>
                <td><?=$a['vn'];?></td>
                <td><?=$a['ptname'];?></td>
                <td><?=$a['icd10'];?></td>
                <td><?=$a['diag'];?></td>
                <td><?=$a['register_time'];?><!--ลงทะเบียน--></td>
                <td><?=$a['opd_time'];?><!--OPD--></td>
                <td><?=$a['dt_time'];?><!--พบแพทย์--></td>
                <td><?=$a['phar_time'];?><!--จ่ายยา--></td>
                <td><?=$a['money_time'];?><!--ส่วนเก็บเงิน--></td>
                <td><?=$a['hour'];?></td>
                <td><?=$a['minute'];?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <script>
            function selectIcd10(checkboxElement){

                let checkboxItem = [];
                const selectedItem = document.getElementsByClassName('selectedItem');
                for (let index = 0; index < selectedItem.length; index++) {
                    const element = selectedItem[index];
                    if(element.checked===true){
                        checkboxItem.push(element.value);
                    }
                }
                
                const items = document.getElementsByClassName('data');
                for (let index = 0; index < items.length; index++) {
                    const el = items[index];
                    const icdValue = el.getAttribute('data-icd');
                    if( checkboxItem.indexOf(icdValue)<0 ){
                        el.style.display = 'none';
                    }else{
                        el.style.display = '';
                    }
                }
            }
        </script>
        <?php
    }else{
        ?>
        <div class="alert alert-danger mt-2" role="alert">
            <strong>ไม่พบข้อมูล</strong>
        </div>
        <?php
    }
}
?>
</div>
</body>
</html>