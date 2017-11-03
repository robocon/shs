<?php
include 'bootstrap.php';

if( $_SESSION['smenucode'] !== 'ADM' AND $_SESSION['smenucode'] !== 'ADMCOM' ){ 
    echo "เฉพาะเจ้าหน้าที่ศูนย์คอม";
    exit;
}

// dump($_SESSION);

$db = Mysql::load();

$action = input('action');

if( $action === 'recheck_password' ){
    
    require_once 'includes/JSON.php';
    $json = new Services_JSON();

    $id = $_SESSION['sRowid'];
    $pass = input_post('check_pass');
    
    $sql = "SELECT `pword` FROM `inputm` WHERE `row_id` = :row_id AND `pword` = :password ";
    $db->select($sql, array(':row_id' => $id, ':password' => $pass ));
    $rows = $db->get_rows();

    $res = array('res_status' => 0);
    if ( $rows > 0 ) {
        $res = array('res_status' => 4);
    }

    $output = $json->encode($res);
    echo $output;

    exit;
}

if( $action === false ){

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
    '25' => 'แพทย์ทางเลือก',
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
    'ห้องตรวจตา'
);

?>
<h3>เพิ่มชื่อแพทย์มาใหม่</h3>
<?php
if( !empty($_SESSION['x-msg']) ){
    ?>
    <div style="padding: 10px;border: 1px solid #000000;background-color: #fffdbc;margin: 10px;"><?=$_SESSION['x-msg'];?></div>
    <?php
    unset($_SESSION['x-msg']);
}
?>

<form action="new_doctor.php" method="post" id="adminForm">
    <div>
        <span>ยศ</span> <input type="text" name="pre_name" > <span>ร.อ., น.พ., พ.ญ. ฯลฯ</span>
    </div>
    <div>
        <span>ชื่อ-สกุล</span> <input type="text" name="fullname" > 
    </div>
    <div>
        <span>เลขที่ ว.</span> <input type="text" name="doctor_num">
    </div>
    <div>
        <span>รายละเอียด </span> 
        <select name="doctor_type" id="">
            <?php foreach( $section AS $key => $item ){ ?>
            <option value="<?=$key;?> <?=$item;?>"><?=$item;?></option>
            <?php } ?>
        </select>
    </div>

    <div>
        <span>ห้องตรวจ</span> 
        <select name="room" id="">
            <?php foreach( $room_list AS $key => $item ){ ?>
            <option value="<?=$item;?>"><?=$item;?></option>
            <?php } ?>
        </select>
    </div>
    <div>
        <button type="submit">ตกลง</button>
        <input type="hidden" name="action" value="save">
    </div>
    <div>ชื่อผู้ใช้งานและรหัสผ่านคือ md__เลขว.__ เช่น md99999 </div>
</form>
<script src="js/vendor/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
    $(function(){

        var confirm_pass = false;
        var timeo = false;
        function test_timeout(){
            var timeo = setTimeout(function() {

                // console.log(confirm_pass);

                if( confirm_pass == false ){
                    // test_timeout();
                    test_out(timeo);
                }else{

                    // Success 
                    // console.log('Password :)');
                    // test_out(timeo);
                    $('#adminForm').submit();

                }
                
            }, 500);
            return timeo;
        }

        function test_out(timeo){
            clearTimeout(timeo);
        }
        
        

        $(document).on('submit', '#adminForm', function(){
            
            if( confirm_pass == false ){

            
            var pass = window.prompt('ยืนยันรหัสผ่าน', '');
            if( pass !== null ){

                timeo = test_timeout();

                $.ajax({
                    url: 'new_doctor.php',
                    method: 'post',
                    dataType: 'json',
                    async: false,
                    data: {'check_pass': pass, 'action': 'recheck_password'},
                    success: function(ret){
                        
                        // console.log(ret.res_status);

                        if( ret.res_status == 0 ){
                            alert('การยืนยันรหัสผ่านไม่ถูกต้อง');
                            confirm_pass = false;
                        }else{
                            confirm_pass = true;
                        }

                        // test_out(timeo);
                        
                    }

                });

            }
            
            return false;

            }

        });

    });
    
</script>

<?php
} else if ( $action === 'save' ){
    
    $pre_name = input_post('pre_name');
    $fullname = input_post('fullname');
    $doctor_num = input_post('doctor_num');
    $doctor_type = input_post('doctor_type');
    $room = input_post('room');

    if( empty($pre_name) OR empty($fullname) OR empty($doctor_num) ){
        echo 'กรุณากรอกข้อมูลให้ครบถ้วน<br><a href="javascript: window.history.back(-1);">กลับไปหน้าฟอร์ม</a>';
        exit;
    }

    $sql = "SELECT `name` FROM `doctor` WHERE `name` LIKE 'MD%' ORDER BY `row_id` DESC LIMIT 1 ";
    $db->select($sql);
    $test = $db->get_item();
    $match = preg_match('/MD(\d+)/', $test['name'], $matchs);
    
    $new_md = 'MD'.( $matchs['1'] + 1 );

    $sql = "INSERT INTO `doctor` VALUES (NULL, '$pre_name', '', '$new_md $fullname', '$doctor_num', '$doctor_type', 'y', 'ADM', '$doctor_type', '1', '1', '1', '1', '1', '$room', '99', '', 'y', 'y');";
    $insert = $db->insert($sql);
    // dump($insert);

    $sql = "INSERT INTO `inputm` VALUES (NULL, '$fullname (ว.$doctor_num)', 'md$doctor_num', 'md$doctor_num', 'ADMDR1', 'Y', '$doctor_num', '$new_md', '', '', NOW(), 'dr', '');";
    $insert = $db->insert($sql);
    // dump($insert);
    
    redirect('new_doctor.php', 'บันทึกข้อมูลเรียบร้อย');

}


