<?php
include 'bootstrap.php';

if( $_SESSION['smenucode'] !== 'ADM' AND $_SESSION['smenucode'] !== 'ADMCOM' ){ 
    echo "੾�����˹�ҷ���ٹ����";
    exit;
}


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


$jobs = array(
    '���¡���',
    '���¡�������⸻Դԡ��',
    '�ٵԡ���',
    '����á���',
    '�ʵ �� ���ԡ',
    '������Ǫ����',
    '�ѡ���Է��',
    '�ѹ�����',
    '�ѧ���Է��',
    'ᾷ��Ἱ��',
    'ᾷ��Ἱ�չ',
    '�Ǫ������鹿�',
    '���ѭ���Է��(��Թԡ�ЧѺ�Ǵ)',
    '����'
);

$action = input('action');
if( $action === false ){
    ?>
    <style>
        label{
            cursor: pointer;
        }
    </style>
    <div><a href="../nindex.htm">&lt;&lt;&nbsp;˹����ѡ �.�.</a> | <a href="doctoredit1.php">˹����ª���ᾷ��</a></div>
    <?php 
    if( !empty($_SESSION['x-msg']) ){
        ?>
        <div style="padding: 10px;border: 1px solid #000000;background-color: #fffdbc;margin: 10px;"><?=$_SESSION['x-msg'];?></div>
        <?php
        unset($_SESSION['x-msg']);
    }
    ?>
    <div>
        <h3>����ᾷ������</h3>
    </div>
    <form action="new_doctor.php" method="post">
        <div>
            <span>��</span> : <input type="text" name="pre_name" > <span>�.�., �.�., �.�. ���</span>
        </div>
        <div>
            <span>����</span> : <input type="text" name="name" ><span style="color:red;">*</span> <span>ʡ��</span> : <input type="text" name="surname" ><span style="color:red;">*</span> 
        </div>
        <div>
            <span>�Ţ��� �.</span> : <input type="text" name="doctor_num"><span style="color:red;">*</span>
        </div>
        <div>
            <span>Ἱ����ӧҹ : </span> 
            <select name="doctor_type" id="">
                <?php foreach( $section AS $key => $item ){ ?>
                <option value="<?=$key;?> <?=$item;?>"><?=$item;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <span>������ᾷ��</span>
            <select name="�jobs" id="">
                <?php foreach( $jobs AS $key => $item ){ ?>
                <option value="<?=$key;?> <?=$item;?>"><?=$item;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <span>��ͧ��Ǩ : </span> 
            <select name="room" id="">
                <?php foreach( $room_list AS $key => $item ){ ?>
                <option value="<?=$item;?>"><?=$item;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <div>�����ᾷ�� : <span style="color:red;">*</span></div>
            <input type="radio" name="drType" id="drType1" value="dr"><label for="drType1">ᾷ���Ш�</label>
            <input type="radio" name="drType" id="drType2" value="intern"><label for="drType2">Intern</label>
        </div>
        <div>&nbsp;</div>
        <div>
            <button type="submit">����������</button>
            <div>
               <u>�к��ѧ����ͧ�Ѻᾷ��੾����ͧ� ��سҵԴ�������������</u>
            </div>
            <input type="hidden" name="action" value="save">
        </div>
        <div>** ���ͼ����ҹ������ʼ�ҹ��� md__�Ţ�.__ �� md99999 </div>
    </form>
    <?php


} else if ( $action === 'save' ){
    
    $pre_name = input_post('pre_name');
    $name = input_post('name');
    $surname = input_post('surname');
    $doctor_num = input_post('doctor_num');
    $doctor_type = input_post('doctor_type');
    $room = input_post('room');
    $drType = input_post('drType');
    $jobs = input_post('jobs');

    $fullname = $name.' '.$surname;

    if( empty($name) OR empty($surname) OR empty($doctor_num) OR empty($drType) ){
        echo '��سҡ�͡���������ú��ǹ<br><a href="javascript: window.history.back(-1);">��Ѻ�˹�ҿ����</a>';
        exit;
    }

    if ( strlen($doctor_num) > 5 ) {
        echo '����ᾷ�����١��ͧ<br><a href="javascript: window.history.back(-1);">��Ѻ�˹�ҿ����</a>';
        exit;
    }

    $db = Mysql::load();

    $sql = "SELECT * FROM `doctor` WHERE `doctorcode` = '$doctor_num' ";
    $db->select($sql);
    if( $db->get_rows() > 0 ){
        echo '�Ţ �. ��ӫ�͹ ��سҵ�Ǩ�ͺ�������ա����<br><a href="javascript: window.history.back(-1);">��Ѻ�˹�ҿ����</a>';
        exit;
    }
    
    $sql = "SELECT `prefix`,`runno` FROM `runno` WHERE `title` = 'doctor' LIMIT 1";
    $db->select($sql);
    $item = $db->get_item();
    $drRunno = intval($item['runno']) + 1;
    $new_md = $item['prefix'].$drRunno;

    $sql = "INSERT INTO `doctor` VALUES (NULL, '$pre_name', '', '$new_md $fullname', '$doctor_num', '$doctor_type', 'y', 'ADM', '$doctor_type', '1', '1', '1', '1', '1', '$room', '99', '', 'y', 'y','','$jobs');";
    $save = $db->insert($sql);
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }

    $prefixDr = '�.';
    // 11 �ѹ�����
    if( $doctor_type == 11 ){
        $prefixDr = '�.';

    }elseif ($doctor_type == 14) { // Ἱ��
        $prefixDr = '��.�';

    }elseif ($doctor_type == 88) { // Ἱ�չ
        $prefixDr = '��.';
        
    }

    $sql = "INSERT INTO `inputm` VALUES (NULL, '$fullname ($prefixDr.$doctor_num)', 'md$doctor_num', 'md$doctor_num', 'ADMDR1', 'Y', '$doctor_num', '$new_md', '', '', NOW(), '$drType', '');";
    $save = $db->insert($sql);
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }

    $now = date('Y-m-d H:i:s');
    $sql = "UPDATE `runno` SET 
    `runno` = '$drRunno',
    `startday` = '$now' 
    WHERE `title` = 'doctor' ";
    $save = $db->update($sql);

    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }
    
    redirect('new_doctor.php', $msg);
    exit;
}


