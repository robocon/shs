<?php
include_once dirname(__FILE__).'/bootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="">
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 18px;
        }
    </style>
    <?php
    $currDate = date('Y-m-d');
    if($currDate=='2025-12-17'){
        $chk_company_id = '999';
        
    }elseif ($currDate=='2025-12-18') {
        $chk_company_id = '900';
        
    }elseif ($currDate=='2025-12-19') {
        $chk_company_id = '901';
        
    }else{
        echo "หมดแล้วจ้า";
        exit;
    }
    
    $sql = "SELECT `idcard`,`exam_no` FROM `opcardchk` WHERE `part` IN ('มหาวิทยาลัยราชภัฏลำปาง 68','คณะพยาบาลศาสตร์ มหาวิทยาลัยราชภัฏลำปาง 68 ธ.ค.') ORDER BY `row`";
    $q = $dbi->query($sql);
    $userList = array();
    while ($a = $q->fetch_assoc()) {
        $key = $a['idcard'];
        $userList[$key]  = $a['exam_no'];
    }

    $sql = "SELECT * FROM `pre_vn` WHERE `chk_company_id`='$chk_company_id' ORDER BY `id` ASC";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        list($y, $m, $d) = explode('-', $currDate);
        ?>
        <h3>รายชื่อตรวจสุขภาพ ม.ราชภัฏลำปาง วันที่ <?= $d ?> <?= $def_fullm_th[$m] ?> <?= $y ?></h3>
        <table class="table table-sm table-striped table-hover">
            <tr>
                <th>#</th>
                <th>Exam Number</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>เลขบัตรประชาชน</th>
                <th>VN</th>
            </tr>
        <?php
        $ii = 1;
        while($a = $q->fetch_assoc()){
            $thdatehn = date('d-m-').(date('Y')+543).$hn;

            $vn = '';
            $sqlOpday = sprintf("SELECT `row_id`,`thdatehn`,`vn` FROM `opday` WHERE `thdatehn` = '%s' ", $dbi->real_escape_string($thdatehn));
            $qOpday = $dbi->query($sqlOpday);
            if($qOpday->num_rows>0){
                $opday = $qOpday->fetch_assoc();
                $vn = $opday['vn'];
            }

            $idcard = $a['idcard'];
            ?>
            <tr>
                <td><?= $ii ?></td>
                <td><?= $userList[$idcard]; ?></td>
                <td><?= $a['hn']; ?></td>
                <td><?= $a['name'].'  '.$a['surname']; ?></td>
                <td><?= $a['idcard']; ?></td>
                <td><?= $a['vn']; ?></td>
            </tr>
            <?php
            $ii++;
        }
        ?>
        </table>
        <?php
    }
    ?>
</div>
</body>
</html>