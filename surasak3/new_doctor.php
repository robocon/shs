<?php
include 'bootstrap.php';

if( $_SESSION['smenucode'] !== 'ADM' AND $_SESSION['smenucode'] !== 'ADMCOM' ){ 
    echo "੾�����˹�ҷ���ٹ����";
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

// �����Ũҡ 43��� ����Ἱ�����Ѻ��ԡ�� 26Sep16.xls
$section = array(
    '01' => '����á���',
    '02' => '���¡���',
    '03' => '�ٵԡ���',
    '04' => '����Ǫ����',
    '05' => '������Ǫ����',
    '06' => '�ʵ �� ���ԡ',
    '07' => '�ѡ���Է��',
    '08' => '���¡�������⸻Դԡ��',
    '09' => '�Ե�Ǫ',
    '10' => '�ѧ���Է��',
    '11' => '�ѹ�����',
    '12' => '�Ǫ��ʵ��ء�Թ��йԵ��Ǫ',
    '13' => '�Ǫ������鹿�',
    '14' => 'ᾷ��Ἱ��',
    '15' => 'PCU � þ. / Ἱ���������آ�Ҿ',
    '16' => '�Ǫ������ԺѵԷ����',
    '17' => '�Ǫ���ʵ���ͺ������Ъ����',
    '18' => '�Ҫ�Ǥ�Թԡ',
    '19' => '���ѭ���Է��(��Թԡ�ЧѺ�Ǵ)',
    '20' => '���¡�������ҷ',
    '21' => '�Ҫ���Ǫá���',
    '22' => '�Ǫ�����ѧ��',
    '23' => '��Ҹ��Է�ҡ�����Ҥ',
    '24' => '��Ҹ��Է�Ҥ�ԹԤ',
    '25' => 'ᾷ��ҧ���͡',
    '26' => '�Է�Ҥ�Թԡ (���˹ѧ)',
    '88' => 'ᾷ��Ἱ�չ',
    '99' => '����'
);

$room_list = array(
    '��ͧ��Ǩ�ä�����',
    '��ͧ��Ǩ 3',
    '��ͧ��Ǩ 4',
    '��ͧ��Ǩ 5',
    '��ͧ��Ǩ 6',
    '��ͧ��Ǩ 7',
    '��ͧ��Ǩ 8',
    '��ͧ��Ǩ 9',
    '��ͧ��Ǩ 10',
    '��ͧ���¡���',
    '��ͧ��Ǩ �ٵ�',
    '��ͧ��Ǩ��'
);

?>
<h3>��������ᾷ��������</h3>
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
        <span>��</span> <input type="text" name="pre_name" > <span>�.�., �.�., �.�. ���</span>
    </div>
    <div>
        <span>����-ʡ��</span> <input type="text" name="fullname" > 
    </div>
    <div>
        <span>�Ţ��� �.</span> <input type="text" name="doctor_num">
    </div>
    <div>
        <span>��������´ </span> 
        <select name="doctor_type" id="">
            <?php foreach( $section AS $key => $item ){ ?>
            <option value="<?=$key;?> <?=$item;?>"><?=$item;?></option>
            <?php } ?>
        </select>
    </div>

    <div>
        <span>��ͧ��Ǩ</span> 
        <select name="room" id="">
            <?php foreach( $room_list AS $key => $item ){ ?>
            <option value="<?=$item;?>"><?=$item;?></option>
            <?php } ?>
        </select>
    </div>
    <div>
        <button type="submit">��ŧ</button>
        <input type="hidden" name="action" value="save">
    </div>
    <div>���ͼ����ҹ������ʼ�ҹ��� md__�Ţ�.__ �� md99999 </div>
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

            
            var pass = window.prompt('�׹�ѹ���ʼ�ҹ', '');
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
                            alert('����׹�ѹ���ʼ�ҹ���١��ͧ');
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
        echo '��سҡ�͡���������ú��ǹ<br><a href="javascript: window.history.back(-1);">��Ѻ�˹�ҿ����</a>';
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

    $sql = "INSERT INTO `inputm` VALUES (NULL, '$fullname (�.$doctor_num)', 'md$doctor_num', 'md$doctor_num', 'ADMDR1', 'Y', '$doctor_num', '$new_md', '', '', NOW(), 'dr', '');";
    $insert = $db->insert($sql);
    // dump($insert);
    
    redirect('new_doctor.php', '�ѹ�֡���������º����');

}


