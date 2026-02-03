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
    <title>รายการตรวจผู้ป่วยนัดที่ราคาเกิน 1,000บาท ประกันสังคม</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-md mb-4 d-print-none" data-bs-theme="dark" style="background-color: #13795b;">
		<div class="container-fluid">
			<a class="navbar-brand" href="../nindex.htm">🏠 หน้าหลัก ร.พ.</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
	</nav>
<div class="container">
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 20px;
        }
    </style>

    <form action="appoint_lab_review.php" method="post">
        <div></div>
    </form>

    <h3 class="mt-2">รายการตรวจผู้ป่วยนัดที่ราคาเกิน 1,000.- ประกันสังคม</h3>
    <div>
        <?php
        // ประกันสุขภาพถ้วนหน้า
        $nhsoPtGroup = array('R09','R10','R11','R12','R13','R15','R36','R44','R54');

        $timestamp1 = strtotime("now");
        $next2days = strtotime("+7 days");

        $appdateList = array();
        while ($timestamp1 <= $next2days) {
            $timestamp1 = strtotime('+1 day', $timestamp1);
            $m = date('m', $timestamp1);
            $appdateList[] = "'".date('d', $timestamp1).' '.$def_fullm_th[$m].' '.(date('Y', $timestamp1)+543)."'";
        }
        
        $whereAppdate = implode(',', $appdateList);
        $sql = "SELECT `hn`,`ptname`,`doctor`,`room`,`patho`,`appdate`
        FROM `appoint` 
        WHERE `appdate` IN ($whereAppdate) 
        AND (`patho` != 'ไม่มี' AND `patho` != '')";
        $q = $dbi->query($sql);
        if($q->num_rows>0){
            $labOver = array();
            $labOver30 = array();
            while ($a = $q->fetch_assoc()) {

                $pathoList = explode(',', $a['patho']);
                $pathoItem = array();
                foreach ($pathoList as $p) {
                    $pathoItem[] = "'".trim($p)."'";
                }
                $codeWhere = implode(',', $pathoItem);

                $hnAppoint = $a['hn'];
                $sqlOpcard = "SELECT `row_id`,SUBSTRING(`ptright`,1,3) AS `ptCode`,`ptright` FROM `opcard` WHERE `hn` = '$hnAppoint' ";
                $qOpcard = $dbi->query($sqlOpcard);
                $opcard = $qOpcard->fetch_assoc();

                if(in_array($opcard['ptCode'], $nhsoPtGroup)==true){ // เอารายชื่อ คนไข้สิทธิ30บาทแยกไปต่างหาก
                    $a['code_where'] = $codeWhere;
                    $a['ptright'] = $opcard['ptright'];
                    $labOver30[] = $a;
                }

                if($opcard['ptCode']!='R07'){
                    continue;
                }
                
                $sql = "SELECT SUM(`price`) AS `sum` FROM `labcare` WHERE `code` IN ($codeWhere)";
                $qLabcare = $dbi->query($sql);
                $item = $qLabcare->fetch_assoc();
                if($item['sum']>1000){
                    $a['price'] = $item['sum'];
                    $labOver[] = $a;
                }
            }

            
            if( $labOver > 0 ){
            ?>
            <table class="table table-hover table-sm table-striped mt-2">
                <tr>
                    <th>วันที่นัด</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>นัดที่</th>
                    <th>พบแพทย์</th>
                    <th>รายการตรวจ</th>
                    <th>ราคา</th>
                </tr>
                <?php
                foreach ($labOver as $lab) {
                    ?>
                    <tr>
                        <td><?= $lab['appdate'] ?></td>
                        <td><?= $lab['hn'] ?></td>
                        <td><?= $lab['ptname'] ?></td>
                        <td><?= $lab['room'] ?></td>
                        <td><?= $lab['doctor'] ?></td>
                        <td><?= $lab['patho'] ?></td>
                        <td><?= number_format($lab['price'],0) ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
            }

            ?>
            <h3 class="mt-4">สิทธิ 30บาท ที่เกิน 700.-</h3>
            <?php
            if( $labOver30 > 0 ){
            ?>
            <table class="table table-hover table-sm table-striped mt-2">
                <tr>
                    <th>วันที่นัด</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>สิทธิ</th>
                    <th>นัดที่</th>
                    <th>พบแพทย์</th>
                    <th>รายการตรวจ</th>
                    <th>ราคา</th>
                </tr>
                <?php
                foreach ($labOver30 as $a) {
                    $codeWhere = $a['code_where'];
                    $sql = "SELECT SUM(`price`) AS `sum` FROM `labcare` WHERE `code` IN ($codeWhere)";
                    $qLabcare = $dbi->query($sql);
                    $item = $qLabcare->fetch_assoc();
                    
                    if($item['sum']>700){
                    ?>
                    <tr>
                        <td><?= $a['appdate'] ?></td>
                        <td><?= $a['hn'] ?></td>
                        <td><?= $a['ptname'] ?></td>
                        <td><?= $a['ptright'] ?></td>
                        <td><?= $a['room'] ?></td>
                        <td><?= $a['doctor'] ?></td>
                        <td><?= $a['patho'] ?></td>
                        <td><?= number_format($item['sum'],0) ?></td>
                    </tr>
                    <?php
                    }
                }
                ?>
            </table>
            <?php
            }
        }
        ?>
    </div>
</div>
</body>
</html>