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
        
        $res = array('status'=>200, 'message'=>'เพิ่มข้อมูลเรียบร้อย');
        // เพิ่ม doctor
        $sql = "INSERT INTO `doctor` 
        (
            `row_id`, `yot`, `yot2`, `name`, `doctorcode`, `position2`, 
            `status`, `menucode`, `position`, `monday`, `tuesday`, `wednesday`, 
            `thursday`, `friday`, `room`, `rowshow`, `room_app`, `erstatus`, 
            `opdstatus`, `rg_status`, `clinic`, `queue_code`, `queue_status`
        ) VALUES (
            NULL, '$prefix', '', '$fullnameMd', '$doctor_number', '$depart', 
            'y', '$menucode', '$depart', '1', '1', '1', 
            '1', '1', '$room', '99', '', 'y', 
            'y', '', '$depart', '', ''
        );";
        $qInsertDr = $dbi->query($sql);
        if($qInsertDr!==false){
            $res['doctor'] = 'เพิ่มชื่อแพทย์เรียบร้อย';
        }

        $dbi->query("UPDATE `doctor_register` SET `status` = 'A', `date_generate`=NOW(), `officer_generate`='$sOfficer' WHERE `id` = '$id' LIMIT 1 ");

        // เพิ่ม inputm
        if($a['request_login']=='1'){

            $nameForInputm = $a['firstname'].' '.$a['lastname'].' ('.$a['prefix_doctor_number'].$doctor_number.')';
            $idname = 'md'.$doctor_number;
            $idcard = $a['idcard'];

            $level = 'dr';
            if($a['intern']=='1'){
                $level = 'intern';
            }

            $sql = "INSERT INTO `inputm` ( 
                `row_id`, `name`, `idname`, `pword`, `menucode`, `status`, 
                `codedoctor`, `mdcode`, `id`, `room_app`, `date_pword`, `level`, 
                `report_tnb`, `level_eopd`, `idcard`, `officer`
            ) VALUES (
                NULL, '$nameForInputm', '$idname', '$idname', 'ADMDR1', 'Y', 
                '$doctor_number', '$mdNumber', '', '', NOW(), '$level', 
                '', 'y', '$idcard', '$sOfficer'
            );";
            $inputmInsert = $dbi->query($sql);
            if($inputmInsert!==false){
                $res['inputm'] = 'เพิ่มผู้ใช้งานในระบบเรียบร้อย';
            }

            // insert inputm อีกรอบแต่เป็น ID สำหรับไตเทียม
            if($a['hem']=='1'){
                
                $hdname = 'HD '.$a['firstname'].' ('.$a['prefix_doctor_number'].$doctor_number.')';
                $hdIdname = 'HD'.$a['doctor_number'];

                $sql = "INSERT INTO `doctor` 
                (
                    `row_id`, `yot`, `yot2`, `name`, `doctorcode`, `position2`, 
                    `status`, `menucode`, `position`, `monday`, `tuesday`, `wednesday`, 
                    `thursday`, `friday`, `room`, `rowshow`, `room_app`, `erstatus`, 
                    `opdstatus`, `rg_status`, `clinic`, `queue_code`, `queue_status`
                ) VALUES (
                    NULL, '$prefix', '', '$hdname', '$doctor_number', '$depart', 
                    'y', '$menucode', '$depart', '1', '1', '1', 
                    '1', '1', '$room', '99', '', 'y', 
                    'y', '', '$depart', '', ''
                );";
                $dtHemInsert = $dbi->query($sql);

                $sql = "INSERT INTO `inputm` ( 
                    `row_id`, `name`, `idname`, `pword`, `menucode`, `status`, 
                    `codedoctor`, `mdcode`, `id`, `room_app`, `date_pword`, `level`, 
                    `report_tnb`, `level_eopd`, `idcard`, `officer`
                ) VALUES (
                    NULL, '$hdname', '$hdIdname', '$hdIdname', 'ADMDR1', 'Y', 
                    '$doctor_number', '$mdNumber', '', '', NOW(), '$level', 
                    '', 'y', '$idcard', '$sOfficer' 
                );";
                $inputHemInsert = $dbi->query($sql);


                if($inputHemInsert!==false){
                    $res['hem'] = 'เพิ่มผู้ใช้งานไตเทียมเรียบร้อย';
                }

            }

        }
        
    }else{
        $res = array('status'=>400, 'message'=>'ไม่พบข้อมูล');
    }
    
    echo $json->encode($res);
    exit;
}

$getAction = sprintf("%s", $_GET['action']);
if($getAction == 'info'){
    $id = sprintf("%s", $_GET['id']);
    $q = $dbi->query("SELECT `firstname`,`doctor_number`,`hem` FROM `doctor_register` WHERE `id` = '$id' AND `status` = 'A' LIMIT 1");
    if($q->num_rows>0){
        $d = $q->fetch_assoc();
        ?>
        <table>
            <tr>
                <td colspan="2"><h4>ชื่อผู้ใช้และรหัสเข้าใช้งานของแพทย์</h4></td>
            </tr>
            <tr>
                <td><strong>Username</strong>: </td>
                <td>md<?=$d['doctor_number'];?></td>
            </tr>
            <tr>
                <td><strong>Password</strong>: </td>
                <td>md<?=$d['doctor_number'];?></td>
            </tr>
            <?php 
            if($d['hem']=='1'){
                ?>
                <tr>
                    <td colspan="2"><h4 class="mt-2">ชื่อผู้ใช้และรหัสผ่านใช้งานไตเทียม</h4></td>
                </tr>
                <tr>
                    <td><strong>Username</strong>: </td>
                    <td>HD<?=$d['firstname'];?></td>
                </tr>
                <tr>
                    <td><strong>Password</strong>: </td>
                    <td>HD<?=$d['firstname'];?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }else{
        echo "ไม่พบข้อมูล";
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
                        <td>
                            <?php 
                            if($a['request_login']=='1'){
                                ?><a href="http://<?=NOTIFY_HOST;?>/shspdf/form_inputm_doctor.php?id=<?=$a['id'];?>" target="_blank"><?=$a['prefix_doctor_number'].$a['doctor_number'];?></a><?php
                            }else{
                                ?><?=$a['prefix_doctor_number'].$a['doctor_number'];?><?php
                            }
                            ?>
                            
                        </td>
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
                                }elseif($a['status']==='A' && $a['request_login']=='1'){
                                    // ดูข้อมูล
                                    ?><a href="javascript:void(0);" class="btn btn-primary" onclick="onShowInfo('<?=$a['id'];?>')">ดูข้อมูลการร้องขอ</a><?php
                                }else{
                                    ?>-<?php
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
                        
                        if(res.status==200){
                            Swal.fire({
                                title: "SUCCESS",
                                icon: "success",
                                html: res.message,
                                confirmButtonText: "OK"
                            }).then((result)=>{
                                window.location = 'doctor_register_list.php';
                            });
                        }
                        
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

                function onShowInfo(id){
                    showInfo(id).then((res)=>{
                        Swal.fire({
                            title: "ข้อมูลเข้าใช้งานครั้งแรก",
                            html: res,
                            showCloseButton: true
                        });
                    });
                }

                async function showInfo(id){
                    const response = await fetch('doctor_register_list.php?action=info&id='+id);
                    const body = await response.text();
                    return body;
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