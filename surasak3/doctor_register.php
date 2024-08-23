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

// ข้อมูลจาก 43แฟ้ม รหัสแผนกที่รับบริการ 26Sep16.xls
$section = array(
    '01' => 'อายุรกรรม',
    '02' => 'ศัลยกรรม',
    '03' => 'สูติกรรม',
    '04' => 'นรีเวชกรรม',
    '05' => 'กุมารเวชกรรม',
    '06' => 'โสต ศอ นาสิก',
    '07' => 'จักษุวิทยา',
    '08' => 'ศัลยกรรมออร์โธปิดิกส์',
    '09' => 'จิตเวช',
    '10' => 'รังสีวิทยา',
    '11' => 'ทันตกรรม',
    '12' => 'เวชศาสตร์ฉุกเฉินและนิติเวช',
    '13' => 'เวชกรรมฟื้นฟู',
    '14' => 'แพทย์แผนไทย',
    '15' => 'PCU ใน รพ. / แผนกส่งเสริมสุขภาพ',
    '16' => 'เวชกรรมปฎิบัติทั่วไป',
    '17' => 'เวชศาสสตร์ครอบครัวและชุมชน',
    '18' => 'อาชีวคลินิก',
    '19' => 'วิสัญญีวิทยา(คลินิกระงับปวด)',
    '20' => 'ศัลยกรรมประสาท',
    '21' => 'อาชีวเวชรกรรม',
    '22' => 'เวชกรรมสังคม',
    '23' => 'พยาธิวิทยากายวิภาค',
    '24' => 'พยาธิวิทยาคลินิค',
    '26' => 'วิทยาคลินิก (ผิวหนัง)',
    '88' => 'แพทย์แผนจีน',
    '99' => 'อื่นๆ'
);

$room_list = array(
    'ห้องตรวจโรคทั่วไป',
    'ห้องตรวจ 3',
    'ห้องตรวจ 4',
    'ห้องตรวจ 5',
    'ห้องตรวจ 6',
    'ห้องตรวจ 7',
    'ห้องตรวจ 8',
    'ห้องตรวจ 9',
    'ห้องตรวจ 10',
    'ห้องศัลยกรรม',
    'ห้องตรวจ สูติ',
    'ห้องตรวจตา',
    'ห้องทันตกรรม',
    'ห้องตรวจเวชศาสตร์ฟื้นฟู'
);


$jobsList = array(
    'อายุรกรรม',
    'ศัลยกรรม',
    'ศัลยกรรมออร์โธปิดิกส์',
    'สูติกรรม',
    'โสต ศอ นาสิก',
    'กุมารเวชกรรม',
    'จักษุวิทยา',
    'ทันตกรรม',
    'รังสีวิทยา',
    'แพทย์แผนไทย',
    'แพทย์แผนจีน',
    'เวชกรรมฟื้นฟู',
    'วิสัญญีวิทยา(คลินิกระงับปวด)',
    'อื่นๆ'
);

$action = sprintf("%s", $_REQUEST['action']);
if($action==='testDoctorId'){
    $doctorNumber = sprintf("%s", $_REQUEST['doctorNumber']);
    $q = $dbi->query("SELECT `row_id`,`name`,`status` FROM `doctor` WHERE doctorcode = '$doctorNumber' LIMIT 1 ");
    $res = array('status'=>200, 'message' => 'สามารถบันทึกข้อมูลได้');
    if($q->num_rows>0){
        $d = $q->fetch_assoc();
        $exText = '';
        if(strtolower($d['status'])=='n'){
            $exText = ' ปัจจุบันมีสถานะปิดการใช้งาน กรุณาติดต่อศูนย์คอมเพื่อเปิดการใช้งานอีกครั้ง';
        }
        $res = array('status'=>400, 'message' => 'เคยบันทึกเลข ว. แพทย์ '.$d['name'].'ไปแล้ว'.$exText, 'doctor_status' => $d['status'] );
    }
    echo $json->encode($res);
    exit;
}elseif ($action==='saveDoctorForm') {

    $idcard = sprintf("%s", $_POST['idcard']);
    $prefix = sprintf("%s", $_POST['prefix']);
    $prefixDoctorNumber = sprintf("%s", $_POST['prefixDoctorNumber']);
    $doctorNum = sprintf("%s", $_POST['doctorNum']);
    $depart = sprintf("%s", $_POST['depart']);
    $doctorJob = sprintf("%s", $_POST['doctorJob']);
    $room = sprintf("%s", $_POST['room']);
    $intern = sprintf("%s", $_POST['intern']);
    $hem = sprintf("%s", $_POST['hem']);
    $firstname  = sprintf("%s", $_POST['firstname']);
    $lastname  = sprintf("%s", $_POST['lastname']);
    $request_login = sprintf("%s", $_POST['request_login']);

    $sql = "INSERT INTO `doctor_register` (
        `id`, `date`, `idcard`,`prefix`, `firstname`, `lastname`, `prefix_doctor_number`,`doctor_number`, `depart`, `type`, `room`, `intern`, `hem`, `status`, `officer`, `request_login`
    ) VALUES (
        NULL, NOW(), '$idcard', '$prefix', '$firstname', '$lastname', '$prefixDoctorNumber', '$doctorNum', '$depart', '$doctorJob', '$room', '$intern', '$hem', 'H', '$sOfficer', '$request_login'
    );";
    $q = $dbi->query($sql);
    if($q!==false){
        $id = $dbi->insert_id;
        $res = array('status'=>200,'message'=>'บันทึกข้อมุลเรียบร้อย','id'=>$id);

        // send line notify
        $sToken = "LdH3u9gnaKiyCBSTq1EkctYtMbErKG7gjJ1DErd2sfL";
        $message = "บัตรประชาชน : $idcard\n";
        $message .= "ชื่อ-สกุล : $prefix $firstname $lastname\n";
        $message .= "เลขที่เวชกรรม : $prefixDoctorNumber $doctorNum\n";
        $message .= "แผนก : $depart\n";
        $message .= "ประเภท : $doctorJob\n";
        $message .= "ห้องตรวจ : $room\n";
        if($intern == '1'){
            $message .= "-> เป็นแพทย์อินเทิร์น\n";
        }
        if($hem == '1'){
            $message .= "-> แพทย์ออกตรวจห้องไตเทียม\n";
        }
        if($request_login=='1'){ 
            $message .= "* ขอเพิ่ม username และ password เพื่อเข้าสู่ระบบโรงพยาบาล *\n";
        }
        $message .= "ขอเพิ่มผู้ใช้งานเข้าสู่ระบบ";
        // sendLineNotify($message, $sToken);

        // send an email

        // Always set content-type when sending HTML email
        // $internEmoji = ($intern == '1') ? '&#9989;' : '&#10060;' ;
        // $hemEmoji = ($hem == '1') ? '&#9989;' : '&#10060;' ;
        // $to = "roboconk@gmail.com";
        // $subject = "ขอเพิ่มแพทย์ $firstname $lastname ($prefixDoctorNumber $doctorNum) ในระบบ ";

        // $message = "<table>
        //     <tr><td>ชื่อ-สกุล : </td><td>$prefix $firstname $lastname</td></tr>
        //     <tr><td>เลขที่เวชกรรม : </td><td>$prefixDoctorNumber $doctorNum</td></tr>
        //     <tr><td>แผนก : </td><td>$depart</td></tr>
        //     <tr><td>ประเภท : </td><td>$doctorJob</td></tr>
        //     <tr><td>ห้องตรวจ : </td><td>$room</td></tr>
        //     <tr><td>เป็นแพทย์อินเทิร์น : </td><td>$internEmoji</td></tr>
        //     <tr><td>แพทย์ออกตรวจห้องไตเทียม : </td><td>$hemEmoji</td></tr>
        // </table>";

        // $headers = "MIME-Version: 1.0" . "\r\n";
        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // $resMail = mail($to, "This is subject", "Hello This is message");
        // dump($resMail);
    }else{
        $res = array('status'=>400,'message'=>'ไม่สามารถบันทึกข้อมูลได้','error'=>$dbi->error);
    }
    echo $json->encode($res);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ขอเพิ่มชื่อแพทย์</title>
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
    <style>
        label{
            font-weight: bold;
        }
        label:hover{
            cursor: pointer;
        }
    </style>
    <div class="container mt-4">
        <h3>แบบฟอร์มขอเพิ่มชื่อแพทย์ในระบบ 👨🏽‍⚕️</h3>
        <form action="doctor_register.php" method="post" class="col-lg-8" id="formRegister">
            <div class="row mb-2">
                <label for="user" class="col-sm-3 col-form-label">เลขบัตรประชาชน</label>
                <div class="col-sm-4">
                    <input class="form-control" type="text" name="idcard" id="idcard"> 
                </div>
            </div>

            <div class="row mb-2">
                <label for="prefix" class="col-sm-3 col-form-label">ยศ/คำนำหน้าชื่อ</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="prefix" name="prefix">
                </div>
                <div class="col-sm-4">
                    <select class="form-select" onchange="setPrefix(this.value)">
                        <option value="">ตัวช่วย</option>
                        <option value="น.พ.">น.พ.</option>
                        <option value="พ.ญ.">พ.ญ.</option>
                        <option value="ร.ต.">ร.ต.</option>
                        <option value="ร.ต.หญิง">ร.ต.หญิง</option>
                        <option value="ร.ท.">ร.ท.</option>
                        <option value="ร.ท.หญิง">ร.ท.หญิง</option>
                        <option value="ร.อ.">ร.อ.</option>
                        <option value="ร.อ.หญิง">ร.อ.หญิง</option>
                        <option value="พ.ต.">พ.ต.</option>
                        <option value="พ.ต.หญิง">พ.ต.หญิง</option>
                        <option value="พ.ท.">พ.ท.</option>
                        <option value="พ.ท.หญิง">พ.ท.หญิง</option>
                        <option value="พ.อ.">พ.อ.</option>
                        <option value="พ.อ.หญิง">พ.อ.หญิง</option>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <label for="user" class="col-sm-3 col-form-label">ชื่อ - นามสกุล</label>
                <div class="col-sm">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ">
                </div>
                <div class="col-sm">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="นามสกุล">
                </div>
            </div>
            <div class="row mb-2">
                <label for="user" class="col-sm-3 col-form-label">เลขที่เวชกรรม</label>
                <div class="col-sm-7">
                    <div class="input-group">
                        <select class="form-select" name="prefixDoctorNumber">
                            <option value="ว.">ว.</option>
                            <option value="ท.">ท.</option>
                            <option value="พท.ป.">พท.ป.</option>
                            <option value="พท.ว.">พท.ว.</option>
                            <option value="พจ.">พจ.</option>
                        </select>
                        <input type="number" class="form-control" id="doctorNum" name="doctorNum">
                        <button class="btn btn-primary" type="button" id="checkDoctorNumber">ตรวจสอบ</button>
                        <button class="btn btn-secondary" id="responseCheck"></button>
                    </div>
                    <input type="hidden" name="testDoctorNumber" id="testDoctorNumber" value="0">
                </div>
                <div class="alert alert-secondary mt-2" role="alert">หากไม่มีข้อมูลในตัวเลือก กรุณาประสานศูนย์คอมฯ เพื่อทำการปรับปรุงข้อมูล ขอบคุณครับ</div>
                <div class="callout" style="border-left: 4px solid #ffe69c; background-color: #fff3cd;">
                    ทันตกรรม (ท.)<br>
                    แพทย์แผนไทยประยุกต์ (พท.ป)<br>
                    แพทย์แผนไทย (พท.ว.)<br>
                    แพทย์แผนจีน (พจ.)<br>
                    ค่าปริยาย (ว.)
                </div>
            </div>

            <div class="row mb-2">
                <label for="user" class="col-sm-3 col-form-label">ทำงานที่แผนก</label>
                <div class="col-sm-5">
                    <select name="depart" id="depart" class="form-select">
                        <?php foreach( $section AS $key => $item ){ ?>
                        <option value="<?=$key;?> <?=$item;?>"><?=$item;?></option>
                        <?php } ?>
                    </select>
                </div>
                
            </div>

            <div class="row mb-2">
                <label for="user" class="col-sm-3 col-form-label">ประเภทแพทย์</label>
                <div class="col-sm-5">
                    <select name="doctorJob" id="doctorJob" class="form-select">
                        <?php foreach( $jobsList AS $jobKey => $jobItem ){ ?>
                        <option value="<?=$jobItem;?>"><?=$jobItem;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row mb-2">
                <label for="user" class="col-sm-3 col-form-label">ห้องตรวจ</label>
                <div class="col-sm-5">
                    <select name="room" id="room" class="form-select">
                        <?php foreach( $room_list AS $key => $item ){ ?>
                        <option value="<?=$item;?>"><?=$item;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row mb-2">
                <label for="user" class="col-sm-3 col-form-label text-end">💡</label>
                <div class="col-sm-5">
                    <input class="form-check-input" type="checkbox" name="intern" id="intern" value="1"> <label for="intern" class="form-check-label">เป็นแพทย์อินเทิร์น</label>
                </div>
            </div>

            <div class="row mb-2">
                <label for="user" class="col-sm-3 col-form-label text-end">💡</label>
                <div class="col-sm-8">
                    <input class="form-check-input" type="checkbox" name="hem" id="hem" value="1"> <label for="hem" class="form-check-label">แพทย์ออกตรวจห้องไตเทียม</label>
                </div>
            </div>

            <div class="row mb-2">
                <label for="user" class="col-sm-3 col-form-label text-end">👉</label>
                <div class="col-sm-8">
                    <input class="form-check-input" type="checkbox" name="request_login" id="request_login" value="1"> <label for="request_login" class="form-check-label">ขอเพิ่ม username และ password เพื่อเข้าสู่ระบบโรงพยาบาล</label>
                    <div>
                        <span class="badge text-bg-warning">หากต้องการให้แพทย์สามารถเข้าไป คีย์ยา ลงDiag ฯลฯ กรุณาติ๊กตัวเลือกนี้ด้วยครับ</span>
                    </div>
                </div>
            </div>

            <div class="row mb-2">
                <label for="user" class="col-sm-3 col-form-label"></label>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    <input type="hidden" name="action" value="saveDoctorForm">
                </div>
            </div>
        </form>
        <script>
            function setPrefix(v){
                document.getElementById('prefix').value=v;
            }

            document.getElementById('checkDoctorNumber').onclick = function(){
                const doctorNum = document.getElementById('doctorNum');
                if(doctorNum.value.trim()==''){
                    Swal.fire('กรุณาใส่เลขที่เวชกรรม');
                    return false;
                }else if(doctorNum.value.length < 3){
                    Swal.fire('เลข ว. ควรมีอย่างน้อย 3 หลัก');
                    return false;
                }

                onCheckDoctorId(doctorNum.value.trim()).then((res)=>{
                    if(res.status===400){
                        Swal.fire(res.message);
                        document.getElementById('testDoctorNumber').value=0;
                        document.getElementById('responseCheck').innerHTML = '&#128546;';
                    }else{
                        document.getElementById('testDoctorNumber').value=1;
                        document.getElementById('responseCheck').innerHTML = '&#128512;';
                    }
                });

            }

            document.getElementById('formRegister').onsubmit = function(event){
                event.preventDefault();

                let idcard = document.getElementById('idcard').value.trim();
                let prefix = document.getElementById('prefix').value.trim();
                let firstname = document.getElementById('firstname').value.trim();
                let lastname = document.getElementById('lastname').value.trim();
                let doctorNum = document.getElementById('doctorNum').value.trim();
                let testDoctorNumber = document.getElementById('testDoctorNumber').value;
                

                if(idcard==='' || idcard.length != 13){
                    Swal.fire({title: "กรุณาใส่เลขบัตรประชาชนให้ถูกต้อง", showConfirmButton: false, timer: 1000, didClose: handleOnFocus('idcard')});
                    return false;
                }else if(prefix===''){
                    Swal.fire({title: "กรุณาใส่ยศ/คำนำหน้าชื่อ", showConfirmButton: false, timer: 1000, didClose: handleOnFocus('prefix')});
                    return false;
                }else if(firstname==='' || lastname===''){
                    Swal.fire({title: 'กรุณาใส่ชื่อ-นามสกุลให้เรียบร้อย', showConfirmButton: false, timer: 1000, didClose: handleOnFocus('firstname')});
                    return false;
                }else if(doctorNum===''){
                    Swal.fire({title: 'กรุณาใส่เลข ว. แล้วกดตรวจสอบให้เรียบร้อย', showConfirmButton: false, timer: 1000, didClose: handleOnFocus('doctorNum')});
                    return false;
                }else if(testDoctorNumber==0){
                    Swal.fire('กรุณากด ตรวจสอบ เพื่อตรวจสอบข้อมูลก่อนดำเนินการต่อไป');
                    return false;
                }

                const form =document.querySelector('#formRegister');
                const data = new URLSearchParams(new FormData(form)).toString();
                sendForm(data).then((res)=>{
                    
                    if(res.status==200){

                        

                        let txtMessage = `แจ้งผู้ดูแลระบบเรียบร้อย ศูนย์คอมฯ จะทำการตรวจสอบและดำเนินการเพิ่มผู้ใช้งานภายใน 24ชั่วโมง `

                        const reqLogin = document.getElementById('request_login').value;
                        if(reqLogin==1){
                            const url = 'http://<?=NOTIFY_HOST;?>/shspdf/form_inputm_doctor.php?id='+res.id;
                            txtMessage += `<br>คลิก <a href="${url}" target="_blank">ที่นี่</a> เพื่อพิมพ์ใบคำร้องขอใช้อินเตอร์เน็ต`
                        }

                        txtMessage += '<br>ขอบคุณครับ';

                        Swal.fire({
                            title: "SUCCESS",
                            icon: "success",
                            html: txtMessage,
                            confirmButtonText: "OK"
                        }).then((result)=>{
                            window.location = 'doctor_register_list.php';
                        });
                    }
                })
                
                return false;
            }

            async function sendForm(data){
                let response = await fetch('doctor_register.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    body: data
                });
                const body = await response.json();
                return body;
            }

            function handleOnFocus(idName){
                document.getElementById(idName).focus();
            }

            async function onCheckDoctorId(doctorNumber){
                const response = await fetch('doctor_register.php?action=testDoctorId&doctorNumber='+doctorNumber);
                const data = await response.json();
                return data;
            }
        </script>
    </div>
</body>
</html>