<?php 
require_once 'bootstrap.php';
include_once 'includes/JSON.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$json = new Services_JSON();

$sIdname = sprintf("%s", $_SESSION['sIdname']);
$sOfficer = sprintf("%s", $_SESSION['sOfficer']);
if(empty($sIdname)){
    echo "Invalid";
    exit;
}
$smenucode = sprintf("%s", $_SESSION['smenucode']);
$sLevel = sprintf("%s", $_SESSION['sLevel']);

/**
 * Summary of getMdNumber : get doctor number LIKE MD999
 * @return string 
 */
function getMdNumber(){
    global $dbi;

    $mdNumber = '';
    $sqlRunno = "SELECT `runno` FROM `runno` WHERE `title`='doctor' ";
    $qRunno = $dbi->query($sqlRunno);
    if($qRunno->num_rows>0){
        $aRunno = $qRunno->fetch_assoc();
        $mdNumber = 'MD'.$aRunno['runno'];

        $runnoPlus = $aRunno['runno'] + 1;
        $dbi->query("UPDATE `runno` SET `runno` = '$runnoPlus',`startday` = NOW() WHERE `title` = 'doctor' LIMIT 1 ");
    }
    return $mdNumber;
}

$phpGetContent = file_get_contents('php://input');
$j = $json->decode($phpGetContent);
$action = sprintf("%s", $j->action);
if($j->action==='addDoctor'){
    $id = sprintf("%s", $j->id);
    $sql = "SELECT * FROM `doctor_register` WHERE `id` = '$id' AND `status` = 'H' LIMIT 1";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        $a = $q->fetch_assoc();

        // $mdNumber = '';
        // $sqlRunno = "SELECT `runno` FROM `runno` WHERE `title`='doctor' ";
        // $qRunno = $dbi->query($sqlRunno);
        // if($qRunno->num_rows>0){
        //     $aRunno = $qRunno->fetch_assoc();
        //     $mdNumber = 'MD'.$aRunno['runno'];

        //     $runnoPlus = $aRunno['runno'] + 1;
        //     $dbi->query("UPDATE `runno` SET `runno` = '$runnoPlus',`startday` = NOW() WHERE `title` = 'doctor' LIMIT 1 ");
        // }

        $mdNumber = getMdNumber();
        
        $prefix = $a['prefix'];
        $fullnameMd = $mdNumber.' '.$a['firstname'].' '.$a['lastname'];
        $doctor_number = $a['doctor_number'];
        $depart = $a['depart'];
        $type = $a['type'];
        $room = $a['room'];

        $menucode = 'ADM';
        if($type=='ทันตกรรม'){
            $menucode = 'ADMDEN';

        }elseif ($type=='จักษุวิทยา') {
            $menucode = 'ADMEYE';

        }elseif ($type=='แพทย์แผนจีน') {
            $menucode = 'ADMNID';

        }elseif ($type=='แพทย์แผนไทย' OR $type=='เวชกรรมฟื้นฟู') {
            $menucode = 'ADMNPT';

        }
        
        // เพิ่ม doctor
        $sql = "INSERT INTO `doctor` 
        (
            `row_id`, `yot`, `yot2`, `name`, `doctorcode`, `position2`, 
            `status`, `menucode`, `position`, `monday`, `tuesday`, `wednesday`, 
            `thursday`, `friday`, `room`, `rowshow`, `room_app`, `erstatus`, 
            `opdstatus`, `rg_status`, `clinic`, `queue_code`, `queue_status`
        ) VALUES (
            NULL, '$prefix', '', '$fullnameMd', '$doctor_number', '$type', 
            'y', '$menucode', '$depart', '1', '1', '1', 
            '1', '1', '$room', '99', '', 'y', 
            'y', '', '$type', '', ''
        );";
        $qInsertDr = $dbi->query($sql);

        $dbi->query("UPDATE `doctor_register` SET `status` = 'A' WHERE `id` = '$id' LIMIT 1 ");

        // เพิ่ม inputm
        if($a['request_login']=='1'){

            $nameForInputm = $a['firstname'].' '.$a['lastname'].' ('.$a['prefix_doctor_number'].$doctor_number.')';
            $idname = 'md'.$doctor_number;

            $level = 'dr';
            if($a['intern']=='1'){
                $level = 'intern';
            }

            $sql = "INSERT INTO `inputm` ( 
                `row_id`, `name`, `idname`, `pword`, `menucode`, `status`, 
                `codedoctor`, `mdcode`, `id`, `room_app`, `date_pword`, `level`, 
                `report_tnb`, `level_eopd`
            ) VALUES (
                NULL, '$nameForInputm', '$idname', '$idname', 'ADMDR1', 'Y', 
                '$doctor_number', '$mdNumber', '', '', NOW(), '$level', 
                '', 'y'
            );";
            $inputmInsert = $dbi->query($sql);

            if($a['hem']=='1'){
                // insert inputm อีกรอบแต่เป็น ID สำหรับไตเทียม

                $hdname = 'HD '.$a['firstname'].' ('.$a['prefix_doctor_number'].$doctor_number.')';
                $hdIdname = 'HD'.$a['firstname'];

                // INSERT INTO `doctor` (`row_id`, `yot`, `yot2`, `name`, `doctorcode`, `position2`, `status`, `menucode`, `position`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `room`, `rowshow`, `room_app`, `erstatus`, `opdstatus`, `rg_status`, `clinic`, `queue_code`, `queue_status`
                // ) VALUES (
                // '200', 'ร.อ.หญิง', '', 'HD เมนัญชญา (ว.58058)', '58058', 'อายุรแพทย์', 'y', 'ADM', '01 อายุรแพทย์', '1', '1', '1', '1', '1', 'ห้องตรวจ 6', '99', '', 'y', 'y', '', 'อายุรกรรม', '', '');
                $sql = "INSERT INTO `doctor` 
                (
                    `row_id`, `yot`, `yot2`, `name`, `doctorcode`, `position2`, 
                    `status`, `menucode`, `position`, `monday`, `tuesday`, `wednesday`, 
                    `thursday`, `friday`, `room`, `rowshow`, `room_app`, `erstatus`, 
                    `opdstatus`, `rg_status`, `clinic`, `queue_code`, `queue_status`
                ) VALUES (
                    NULL, '$prefix', '', '$hdname', '$doctor_number', '$type', 
                    'y', '$menucode', '$depart', '1', '1', '1', 
                    '1', '1', '$room', '99', '', 'y', 
                    'y', '', '$type', '', ''
                );";

                // INSERT INTO `inputm` (
                // `row_id`, `name`, `idname`, `pword`, `menucode`, `status`, `codedoctor`, `mdcode`, `id`, `room_app`, `date_pword`, `level`, `report_tnb`, `last_login`, `idcard`, `level_eopd`, `officer`, `login_status`
                // ) VALUES (
                // '1057', 'HD เมนัญชญา (ว.58058)', 'HDเมนัญชญา', 'HDเมนัญชญา', 'ADMDR1', 'Y', '58058', 'MD200', '', '', '2023-07-31 08:00:00', 'dr', 'n', '2024-08-19 18:11:47', NULL, 'y', NULL, '0');
                $sql = "INSERT INTO `inputm` ( 
                    `row_id`, `name`, `idname`, `pword`, `menucode`, `status`, 
                    `codedoctor`, `mdcode`, `id`, `room_app`, `date_pword`, `level`, 
                    `report_tnb`, `level_eopd`
                ) VALUES (
                    NULL, '$hdname', '$hdIdname', '$hdIdname', 'ADMDR1', 'Y', 
                    '$doctor_number', '$mdNumber', '', '', NOW(), '$level', 
                    '', 'y'
                );";

            }

        }
    }
    
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อแพทย์ร้องขอ</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <?php 
    require_once 'com_user_menu.php';
    ?>
    <div class="container mt-4">
        <h3>รายชื่อแพทย์ขอใช้งานระบบ</h3>
        <?php 
        $sql = "SELECT * FROM `doctor_register` ORDER BY `id` DESC";
        $q = $dbi->query($sql);
        if($q->num_rows>0){
            ?>
            <table class="table">
                <tr>
                    <th>วันที่ลงทะเบียน</th>
                    <th>ยศชื่อ-สกุล</th>
                    <th>เลขที่ ว.</th>
                    <th>เป็นแพทย์</th>
                    <th>สถานะ</th>
                    <?php
                    if($smenucode=='ADM' && $sLevel==='admin'){
                        ?><th>จัดการ</th><?php
                    }
                    ?>
                </tr>
                <?php 
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$a['date'];?></td>
                        <td><?=$a['prefix'].$a['firstname'].' '.$a['lastname'];?></td>
                        <td><?=$a['prefix_doctor_number'].$a['doctor_number'];?></td>
                        <td><?=$a['depart'];?></td>
                        <td>
                            <?php 
                            if($a['status']==='H'){
                                ?><strong>รอตรวจสอบ</strong><?php
                            }elseif ($a['status']==='A') {
                                ?><strong>ดำเนินการเรียบร้อย</strong><?php
                            }
                            ?>
                        </td>
                        <?php
                        if($smenucode=='ADM' && $sLevel==='admin'){
                            ?>
                            <td>
                                <?php 
                                if($a['status']==='H'){
                                    ?><a href="javascript:void(0);" class="btn btn-primary" onclick="createUser('<?=$a['id'];?>')">สร้าง</a><?php
                                }elseif($a['status']==='A'){
                                    // ดูข้อมูล
                                    ?><a href="javascript:void(0);" class="btn btn-primary">ดูข้อมูลการร้องขอ</a><?php
                                }
                                ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <script>
                function createUser(id){
                    onCreateUser(id).then((res)=>{
                        console.log(res);
                    });
                }
                async function onCreateUser(id){

                    const response = await fetch('doctor_register_list.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({'id':id,'action':'addDoctor'})
                    });
                    const data = await response.json();
                    return data;
                }
            </script>
            <?php
            
        }else{
            ?><p><strong>ไม่พบข้อมูล</strong></p><?php
        }
        ?>
        
    </div>
</body>
</html>