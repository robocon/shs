<?php
require_once 'bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ติดตามผลแลปผู้ป่วยนอก</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK","TH Sarabun New";
            font-size: 16pt;
        }
        label:hover{
            cursor: pointer;
        }
        table.table tr th{
            background-color: #198754;
            color: #ffffff;
        }
    </style>
    <div class="container mt-2">
    <?php
    $dateNow = date('Y-m-d');
    $sql = "SELECT `clinicianname` FROM `orderhead` WHERE `orderdate` LIKE '$dateNow%' AND `patienttype` = 'OPD' AND (`clinicianname` != ' กรุณาเลือกแพทย์' AND `clinicianname` NOT LIKE 'HD%') GROUP BY `clinicianname`";
    $q = $dbi->query($sql);
    ?>
    <form action="doctor_lab.php" method="post" class="row g-3">
        <h3>ติดตามผลแลปผู้ป่วยนอก</h3>
        <div class="col-md-4" style="height: 300px;overflow-y: scroll;">
            <label for="inputEmail4" class="form-label fw-bold">รายชื่อแพทย์ที่ส่งผลตรวจในวันนี้</label>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" onclick="selectAll()" id="selectAll" name="selectall" value="all">
                <label for="selectAll" class="form-check-label">เลือกทั้งหมด</label>
            </div>
            <?php
            while ($a = $q->fetch_assoc()) {
                ?>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="<?=$a['clinicianname'];?>" name="doctor[]" value="<?=$a['clinicianname'];?>">
                    <label for="<?=$a['clinicianname'];?>" class="form-check-label"><?=$a['clinicianname'];?></label>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">แสดงข้อมูล</button>
            <input type="hidden" name="action" value="show">
        </div>
    </form>
    <script>
        function selectDoctor(t){
            if(t.checked===true){
                let html = `<div id="selectDt${t.row_id}">${t.value}</div>`;
                document.getElementById('doctor-selected').innerHTML += html;

            }else if(t.checked===false){
                document.getElementById('selectDt'+t.row_id).remove();

            }
        }
    </script>
    <?php
    $action=$_POST['action'];
    if($action==='show'){

        $dateNow = date('Y-m-d');
        $thDateNow = (date('Y')+543).date('-m-d');

        if(empty($_POST['selectall'])){
            $dtList = array();
            foreach ($_POST['doctor'] as $dt) {
                $dtList[] = "'$dt'";
            }
            $dtName = implode(',', $dtList);
            
            if(empty($dtList)){
                ?>
                <div class="mt-4"><p><b>กรุณาเลือกแพทย์ที่ต้องการ</b></p></div>
                <?php
                exit;
            }

            $whereDoctor = "WHERE `doctor2` IN($dtName)";
        }else{
            $whereDoctor = "";
        }

        $sqlOrderhead = "CREATE TEMPORARY TABLE `tmp_orderhead`(
            `hn` VARCHAR(50),
            `patienttype` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
            `orderdate` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
            `labnumber` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
            `patientname` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
            `room` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
            `clinicalinfo` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
            `clinicianname` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
            `thdatehn` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
            KEY `hn` (`hn`),
            KEY `labnumber` (`labnumber`)
        )
        SELECT `hn`,`patienttype`,`orderdate`,`labnumber`,`patientname`,`room`,`clinicalinfo`,`clinicianname`,
        CONCAT(SUBSTRING(`orderdate`,9,2),'-',SUBSTRING(`orderdate`,6,2),'-',(SUBSTRING(`orderdate`,1,4)+543),`hn`) AS `thdatehn`
        FROM `orderhead` 
        WHERE `orderdate` LIKE '$dateNow%' 
        AND `clinicianname` != ' กรุณาเลือกแพทย์' 
        AND `patienttype` = 'OPD'";
        $dbi->query($sqlOrderhead);

        $sqlOpd = "CREATE TEMPORARY TABLE `tmp_opd`(
        `row_id` INT(11),
        `thdatehn` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
        `doctor` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
        KEY `thdatehn` (`thdatehn`)
        )
        SELECT `row_id`,`thdatehn`,`doctor` FROM `opd` WHERE `thidate` LIKE '$thDateNow%';";
        $dbi->query($sqlOpd);
        
        $sqlTmpLaborder = "CREATE TEMPORARY TABLE `tmp_laborder`
        SELECT b.*,c.`autonumber`,
        GROUP_CONCAT(c.`profilecode`) AS `profilecode`,
        IF(SUBSTRING(b.`clinicianname`,0,5)='MD022',a.`doctor`,b.`clinicianname`) AS `doctor2`
        FROM `tmp_opd` AS a 
        LEFT JOIN `tmp_orderhead` AS b ON b.`thdatehn` = a.`thdatehn` 
        LEFT JOIN `resulthead` AS c ON c.`labnumber` = b.`labnumber` 
        WHERE b.`hn` IS NOT NULL 
        GROUP BY c.`labnumber` 
        ORDER BY c.`clinicianname` ASC, c.`labnumber` DESC ;";
        $dbi->query($sqlTmpLaborder);

        $sql = "SELECT * FROM `tmp_laborder` $whereDoctor ";
        $q = $dbi->query($sql);
        $orderHeadRows = $q->num_rows;
        if($orderHeadRows>0){
            
            $doctorItems = array();

            while ($a = $q->fetch_assoc()) {

                $key = $a['doctor2'];
                $doctorItems[$key]['name'] = $key;
                $doctorItems[$key]['data'][] = $a;
                
            }
            
            foreach ($doctorItems as $key => $item) {
                ?>
                <h3 class="mt-4"><?=$item['name'];?></h3>
                <table class="table table-sm">
                    <tr>
                        <th>เวลาส่ง</th>
                        <th>HN</th>
                        <th>Labnumber</th>
                        <th>ชื่อ-สกุล</th>
                        <th>VN</th>
                        <th>แพทย์</th>
                        <th width="39%">รายการที่แพทย์ส่งตรวจ</th>
                        <th>ผลแลป</th>
                    </tr>
                <?php
                foreach ($item['data'] as $k => $data) {
                    
                    $orderDate = substr($data['orderdate'],10);
                    $labnumber = $data['labnumber'];
                    $doctor = $data['doctor2'];
                    ?>
                    <tr>
                        <td><?=$orderDate;?></td>
                        <td><?=$data['hn'];?></td>
                        <td><?=$labnumber;?></td>
                        <td><?=$data['patientname'];?></td>
                        <td><?=$data['room'];?></td>
                        <td><?=$doctor;?></td>
                        <td><?=$data['clinicalinfo'];?></td>
                        <td>
                            <?php
                            if(!empty($data['autonumber'])){

                                $link = 'lab_lst_print_opd1new2.php?hn='.$data['hn'].'&labnumber='.$labnumber.'&listlab='.$data['profilecode'].'&depart='.$data['patienttype'].'&doctor='.$doctor;

                                ?><span>✔️</span><a href="<?=$link;?>" target="_blank" title="สั่งปริ้น">🖨️</a><?php
                            }else{
                                ?><span>❌</span><?php
                            }
                            
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </table>
                <?php
            }
        }else{
            ?>
            <div class="mt-4">
                <p><b>ไม่พบข้อมูลในวันนี้</b></p>
            </div>
            <?php
        }
    }
    ?>
    </div>
</body>
</html>