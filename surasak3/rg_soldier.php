<?php 
include 'bootstrap.php';

if( empty($_SESSION['sOfficer']) ){ 
    echo '�Դ��ͼԴ��Ҵ�ҧ��С�� ��س�<a href="login_page.php">�������к�</a>�ա����';
    exit;
}

$db = Mysql::load();

/**
 * @todo 
 * [] form ����������
 *      [] ����͹ᾷ����
 *      [] Ṻ�ٻ + �Ѵ�ٻ 1 ����
 * [] ˹����ѡ + ���ҵ�� HN
 *      [] ���͡�� pdf + xlsx
 * [] ˹����䢢�����
 *      [] ��������ǡѹ�Ѻ˹������
 */

 /*
CREATE TABLE `rg_soldier` (
  `id` int(11) NOT NULL auto_increment,
  `date` datetime default NULL,
  `hn` varchar(45) default NULL,
  `address` text,
  `regular` text,
  `last_update` datetime default NULL,
  `yot_pt` varchar(50) NOT NULL,
  `ptname` varchar(255) default NULL,
  `yearchk` varchar(45) default NULL,
  `pic` varchar(255) default NULL,
  `book_id` varchar(50) NOT NULL,
  `number_id` varchar(50) NOT NULL,
  `yot1` varchar(50) NOT NULL,
  `doctor1` varchar(255) NOT NULL,
  `code1` varchar(50) NOT NULL,
  `yot2` varchar(50) NOT NULL,
  `doctor2` varchar(255) NOT NULL,
  `code2` varchar(50) NOT NULL,
  `yot3` varchar(50) NOT NULL,
  `doctor3` varchar(255) NOT NULL,
  `code3` varchar(50) NOT NULL,
  `diag` text NOT NULL,
  `province` varchar(255) NOT NULL,
  `editor` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;
 */

$action = input('action');
if( $action === "save" ){

    $id = input_post('id', false);

    // $dr1 = input_post('dr1');
    // $dr2 = input_post('dr2');
    // $dr3 = input_post('dr3');
    $hn = input_post('hn');
    $book_id = input_post('book_id');
    $number_id = input_post('number_id');
    $diag = input_post('diag');
    $regular = input_post('regular');
    $yearchk = get_year_checkup(true);
    $file_name = 'NULL';
    
    $sql = "SELECT `yot`,CONCAT(`name`,' ',`surname`) AS `ptname`, CONCAT(`address`,' ',`tambol`,' ',`ampur`) AS `address`, `changwat` AS `province`
    FROM `opcard` WHERE `hn` = '$hn' LIMIT 1";
    $db->select($sql);
    $pt = $db->get_item();
    $yot_pt = $pt['yot'];
    $ptname = $pt['ptname'];
    $address = $pt['address'];
    $province = $pt['province'];
    $editor = $_SESSION['sOfficer'];
    
    $dr_lists = array();
    for ($i=1; $i <= 3; $i++) { 

        $dr_code = input_post('dr'.$i);

        $sql = "SELECT IF(`yot` != '', `yot`, `yot2`) AS `yot`, TRIM(SUBSTRING(`name`,6)) AS `name`, `doctorcode` 
        FROM `doctor` 
        WHERE `doctorcode` = '$dr_code'  
        AND `status` = 'y' 
        AND `name` REGEXP '^MD+' ";
        $db->select($sql);
        $dr = $db->get_item();
        
        // $i = 0;
        // foreach ( $items as $key => $dr ) {
            // ++$i;
            $dr_lists['yot'.$i] = $dr['yot'];
            $dr_lists['doctor'.$i] = $dr['name'];
            $dr_lists['code'.$i] = $dr['doctorcode'];
        // }

    }
    

    if( empty($id) ){
        $sql = "INSERT INTO `rg_soldier`
        (`id`,`date`,`hn`,`address`,`regular`,
        `last_update`,`yot_pt`,`ptname`,`yearchk`,`book_id`,
        `number_id`,`yot1`,`doctor1`,`code1`,`yot2`,
        `doctor2`,`code2`,`yot3`,`doctor3`,`code3`,
        `diag`,`province`,`editor`) 
        VALUES 
        (NULL,NOW(),'$hn','$address','$regular',
        NOW(),'$yot_pt','$ptname','$yearchk','$book_id',
        '$number_id','".$dr_lists['yot1']."','".$dr_lists['doctor1']."','".$dr_lists['code1']."','".$dr_lists['yot2']."',
        '".$dr_lists['doctor2']."','".$dr_lists['code2']."','".$dr_lists['yot3']."','".$dr_lists['doctor3']."','".$dr_lists['code3']."',
        '$diag','$province','$editor');
        ";
        $save = $db->insert($sql);
        $last_id = $db->get_last_id();
    }else{
        $sql = "UPDATE `rg_soldier`
        SET
        `regular` = '$regular',
        `last_update` = NOW(),
        `book_id` = '$book_id',
        `number_id` = '$number_id',
        `yot1` = '".$dr_lists['yot1']."',
        `doctor1` = '".$dr_lists['doctor1']."',
        `code1` = '".$dr_lists['code1']."',
        `yot2` = '".$dr_lists['yot2']."',
        `doctor2` = '".$dr_lists['doctor2']."',
        `code2` = '".$dr_lists['code2']."',
        `yot3` = '".$dr_lists['yot3']."',
        `doctor3` = '".$dr_lists['doctor3']."',
        `code3` = '".$dr_lists['code3']."',
        `diag` = '$diag',
        `editor` = '$editor'
        WHERE `id` = '$id';";
        $save = $db->update($sql);
        $last_id = $id;
    }

    $files = $_FILES['pic_patient'];
    $ext = strrchr(strtolower($files['name']), ".");
    if( $files['error'] === 0 && ( $ext == '.png' OR $ext == '.jpg' OR $ext == '.jpeg' ) ){
        $file_name = md5($files['tmp_name']).$ext;
        $folder = 'certificate';
        if( !file_exists($folder) ){ mkdir($folder); }
        if( !file_exists($folder.'/'.$yearchk) ){ mkdir($folder.'/'.$yearchk); }
        move_uploaded_file($files['tmp_name'], $folder.'/'.$yearchk.'/'.$file_name);

        $sql = "UPDATE `rg_soldier` SET `pic` = '$file_name' WHERE `id` = '$last_id';";
        $save = $db->update($sql);

    }
    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    redirect('rg_soldier.php', $msg);
    exit;

} else if( $action === 'delete' ){
    $id = input_get('id');

    if( $id === false ){
        echo "��辺������";
        exit;
    }

    $sql = "DELETE FROM `rg_soldier` WHERE `id` = '$id' ";
    $delete = $db->delete($sql);

    if( $delete !== false ){
        $_SESSION['x-msg'] = 'ź���������º����';
        header("Location: rg_soldier.php");
    }

}

$types = array(
    1 => array(
        'title' => '�ä���ͤ����Դ���Ԣͧ��',
        'items' => array(
            '�' => '�Ң�ҧ㴢�ҧ˹�觺ʹ ���������ѡ���������µҴ�����蹵����ǡ���ͧ����ѧ������дѺ��ӡ��� 3/60 �����ҹ��µ��������᤺���� 10 ͧ��',
            '�' => '��µ���軡�� ���������ѡ���������µҴ���������� ����ͧ����ѧ������дѺ 6/24 ���͵�ӡ��ҷ���ͧ��ҧ',
            '�' => '��µ�����ҡ���� 8 ��ͻ���� ������µ�����ҡ���� 5 ��ͻ���� ����ͧ��ҧ',
            '�' => '�����ǵҷ���ͧ��ҧ (Bilateral Cataract)',
            '�' => '����Թ (Glaucoma)',
            '�' => '�ä���ǻ���ҷ����������� 2 ��ҧ (Optic Atrophy)',
            '�' => '���ǻ���ҷ���ѡ�ʺ������ѧ���͢�蹷���ͧ��ҧ',
            '�' => '����ҷ�������͹����١�����ӧҹ�٭�������ҧ���� (Cranial never 3 , 4 , 6)'
        )
    ),2 => array(
        'title' => '�ä���ͤ����Դ���Ԣͧ��',
        'items' => array(
            '�' => '��˹ǡ����ͧ��ҧ ��͵�ͧ�����§㹪�ǧ���蹤������ 500-2,000 �ͺ����Թҷ������Թ���� 55 ഫ��� �֧�����Թ����ͧ��ҧ',
            '�' => '�٪�鹡�ҧ�ѡ�ʺ������ѧ����ͧ��ҧ',
            '�' => '���������ٷ��ط���ͧ��ҧ'
        )
    ),3 => array(
        'title' => '�ä�ͧ���������ʹ���ʹ',
        'items' => array(
            '�' => '����������ʹ���ʹ�ԡ�����ҧ���� ���Ҩ�Դ�ѹ���������ç',
            '�' => '������㨾ԡ��',
            '�' => '����鹢ͧ���㨼Դ�������ҧ���� ���Ҩ�Դ�ѹ���������ç',
            '�' => '�ä�ͧ������������㨹Դ����������ö�ѡ�������¢Ҵ������Ҩ���ѹ����',
            '�' => '��ʹ���ʹᴧ�˭��觾ͧ',
            '�' => '��ʹ���ʹ���㹡����š������觾ͧ���ͼԴ���Ԫ�Դ����Ҩ���ѹ����'
        )
    ),4 => array(
        'title' => '�ä���ʹ������������ҧ���ʹ',
        'items' => array(
            '�' => '�ä���ʹ�������������ҧ���ʹ�Դ�������ҧ�ع�ç����Ҩ���ѹ���¶֧���Ե',
            '�' => '��������� (Hypersplenism) ����ѡ������������Ҩ���ѹ����'
        )
    ),5 => array(
        'title' => '�ä�ͧ�к�����',
        'items' => array(
            '�' => '�ä�״ (Asthma) ������Ѻ����ԹԨ��µ��ࡳ�����ԹԨ���',
            '�' => '�ä�ҧ�ʹ������ҡ���� �ͺ�˹���� ����ա���٭���¡�÷ӧҹ�ͧ�к��ҧ�Թ���� �µ�Ǩ���ö�Ҿ�ʹ���� forced Expiratoy Volume in One Second ���,���� Forced Vital Capacity ��ӡ��������� 60 �ͧ����ҵðҹ���ࡳ��',
            '�' => '�ä�����ѹ���ʹ㹻ʹ�٧ (Pulmonary Hypertension) ����ԹԨ����¡�õ�Ǩ���㨴��¤������§��������٧ (Echocardiogram) �����¡����������¤����ѹ���ʹ㹻ʹ',
            '�' => '�ä�ا���㹻ʹ (Lung Cyst) ����Ǩ�ԹԨ������¡�ö����ѧ�շ�ǧ͡ ���� ��硫��������������ʹ',
            '�' => '�ä��ش������㨢�й͹��Ѻ (Obstructive Sleep Apnea) ����ԹԨ��´��¡�õ�Ǩ��ù͹��Ѻ (Polysomnography)'
        )
    ),6 => array(
        'title' => '�ä�ͧ�к��������',
        'items' => array(
            '�' => '��ѡ�ʺ������ѧ',
            '�' => '������ҡ��䵾ԡ�� (Nephrotic Syndrome)',
            '�' => '����������ѧ',
            '�' => '䵾ͧ�繶ا�������Դ (Polycystic Kidney)'
        )
    ),7 => array(
        'title' => '�ä���ͤ����Դ���Ԣͧ��д١ ��� ��С��������',
        'items' => array(
            '�' => array(
                'name' => '�ä������ͤ����Դ���Ԣͧ��� �ѧ���仹��',
                'attributes' => array(
                    1 => '����ѡ�ʺ������ѧ (Chronic Arthritis)',
                    2 => '���������������ѧ (Chronic Osteoarthritis)',
                    3 => '�ä�����С�д١�ѹ��ѧ�ѡ�ʺ������ѧ (Spondyloarthropathy)'
                )
            ),
            '�' => array(
                'name' => 'ᢹ �� ��� ��� ���� ���ҧ����ҧ˹�觼Դ���� �ѧ���仹��',
                'attributes' => array(
                    1 => 'ᢹ �� ��� ������� ��ǹ���;ԡ�� �֧�����Ҩ��ѡ�Ҵ����Ը��������ش���ǡ��ѧ���������',
                    2 => '������������ʹ�ǹ���֧��ͻ��¹������;ԡ�ö֧������������',
                    3 => '���Ǫ��ͧ��ʹ�ǹ������ͻ��¹���',
                    4 => '����������͢�ҧ���ǡѹ������ͧ���Ǣ��仴�ǹ���֧��ͻ��¹������;ԡ�ö֧������������',
                    5 => '������������Ҵ�ǹ���֧��ͻ��¹������;ԡ�ö֧������������',
                    6 => '������Ң�ҧ���ǡѹ������ͧ���Ǣ��仴�ǹ���֧��ͻ��¹������;ԡ�ö֧������������',
                    7 => '��������������Т�ҧ�����˹�觹��Ǣ��仴�ǹ���֧��ͻ��¹������;ԡ�ö֧������������',
                    8 => '����������Ң�ҧ㴢�ҧ˹�觵����˹�觹��Ǣ��仴�ǹ���֧���⤹�������;ԡ�ö֧������������'
                )
            ),
            '�' => '�����§�����秷��ͪ�Դ����',
            '�' => '��д١�ѹ˹ѧ�����ͤ�������蹨������Ѵ �����秷��ͪ�Դ����',
            '�' => '����������������պ����˴��� (Atrophy or Contracture) ���繼������������ǹ˹���������������'
        )
    ),8 => array(
        'title' => '�ä�ͧ���������������мԴ���Ԣͧ���к������',
        'items' => array(
            '�' => '���е��������´�ӧҹ��������ҧ����',
            '�' => '���е������Ҹ����´�ӧҹ��������ҧ����',
            '�' => '���е�������ͧ�Դ�������ҧ����',
            '�' => '����ҹ',
            '�' => '������ǹ (Obesity) ����մѪ�դ������¢ͧ��ҧ��� (BodyMass Index) ����� 35 ���š��������ҧ���â���',
            '�' => '�ä���ͤ����Դ��������ǡѺ���к�������ͧ���ҵ� ������ô����ù�����������·� ��Сô��ҧ ��ʹ�����к���������� ��Դ���� ����Ҩ���ѹ����',
            '�' => '���е��������´�ӧҹ�ҡ�Դ���� (Hyperthyroidism)'
        )
    ),9 => array(
        'title' => '�ä�Դ����',
        'items' => array(
            '�' => '�ä����͹',
            '�' => '�ä��Ҫ�ҧ',
            '�' => '�ä�Դ����������ѧ�����ʴ��ҡ���ع�ç ����������ö�ѡ�������¢Ҵ��'
        )
    ),10 => array(
        'title' => '�ä�ҧ����ҷ�Է��',
        'items' => array(
            '�' => '�Ե��ԭ��Ҫ�� (Mental retardation) ������дѺ����ѭ�� 69 ���� ��ӡ��ҹ��',
            '�' => '�� (Mutism) ���;ٴ������������Ϳѧ��������������ͧ (Aphasia) ��Դ����',
            '�' => '���ѡ (Epilepsy) �����ä����������ҡ�êѡ (Seizures) ���ҧ����',
            '�' => '����ҵ (Paralysis) �ͧᢹ �� ��� ���� ��Ҫ�Դ����',
            '�' => '��ͧ������ (Dementia)',
            '�' => '�ä���ͤ����Դ���Ԣͧ��ͧ������ѹ��ѧ��������Դ�����Դ�������ҧ�ҡ㹡������͹��Ǣͧᢹ���͢����ҧ����',
            '�' => '���������������ѧ���ҧ˹ѡ (Myasthenia Gravis)'
        )
    ),11 => array(
        'title' => '�ä�ҧ�Ե�Ǫ',
        'items' => array(
            '�' => array(
                'name' => '�ä�Ե������ҡ���ع�ç ����������ѧ',
                'attributes' => array(
                    1 => '�ä�Ե��� (Schizophrenia)',
                    2 => '�ä�Ե������ŧ�Դ (Resistant delusional disorder, Induced delusional disorder)',
                    3 => '�äʤԫ��Ϳ�礷ջ (Schizoaffective disorder)',
                    4 => '�ä�Ե����Դ�ҡ�ä�ҧ��� (Other Mental disorder due to brain Damage and Dysfunction)',
                    5 => '�ä�Ե���� (Unspecified nonorganic psychosis)'
                )
            ),
            '�' => array(
                'name' => '�ä�������û�ǹ������ҡ���ع�ç ����������ѧ',
                'attributes' => array(
                    1 => '�ä�������û�ǹ (Manic Episode, Bipolar Affective Disorder)',
                    2 => '�ä�������û�ǹ����Դ�ҡ�ä�ҧ��� (Other Mental Disorder due to brain Damage and Dysfunction to Physical disorder)',
                    3 => '�ä�������û�ǹ���� (Other Mood (Affective)Disorder, Unspecified Mood Disorder)',
                    4 => '�ä�������� (Depressive Depressive Disorder, Recurent Depressive Disorder)'
                )
            ),
            '�' => array(
                'name' => '�ä�Ѳ�ҡ�÷ҧ�Ե�Ǫ',
                'attributes' => array(
                    1 => '�Ե��ԭ��Ҫ�ҷ�����дѺ����ѭ�� 70 ���͵�ӡ��ҹ�� (Mental Retardation)',
                    2 => '�ä���ͤ����Դ����㹡�þѲ�ҡ�âͧ�ѡ�зҧ�ѧ��������� (Pervasive Development)'
                )
            )
        )
    ),12 => array(
        'title' => '�ä����',
        'items' => array(
            '�' => '����� (Hermaphrodism)',
            '�' => '����� (Malignant Neoplasm)',
            '�' => '�Ѻ�ѡ�ʺ������ѧ (Chronic Hepatitis)',
            '�' => '�Ѻ�� (Chrrhosis of Liver)',
            '�' => '����͡ (Albion)',
            '�' => '�ä�ٻ�����Ը���⵫�ʷ�����ҧ��� (Systemic Lupus Eyethematosus)',
            '�' => '����秷�����ҧ��� (Systemic Sclerosis)',
            '�' => array(
                'name' => '�ٻ�Ի�Ե��ҧ� ����',
                'attributes' => array(
                    1 => '��١����',
                    2 => 'ྴҹ���������٧�����������鹾ٴ���Ѵ'
                )
            ),
            '�' => '�ä���˹ѧ�͡��ش��ǼԴ��������Դ��Դ�硴ѡ�� (Lamella Ichthyosis & Congenital Ichthyosiform Erytkroderma)'
        )
    )
);

$set_types = array();
foreach ($types as $main_number => $item_type) {

    if( count($item_type['items']) > 0 ){
        foreach( $item_type['items'] AS $item_number => $item ){

            $item_name = $item;
            $sub_item = false;
            if( is_array($item) === true ){
                $item_name = $item['name'];
                $sub_item = $item['attributes'];
            }
            
            if( $sub_item === false ){
                $sub_item_key = "$main_number.$item_number";
                $set_types[$sub_item_key] = $item_name;
            }

            $json_sub_item = array();
            if( $sub_item !== false ){
                foreach ($sub_item as $last_key => $value) {
                    $last_item_key = "$main_number.$item_number.$last_key";
                    $set_types[$last_item_key] = $value;
                }
            }

        }
    }
}

// ����
if( $action === "search_val" ){

    $regular = trim($_POST['content_txt']);
    $regular = iconv('UTF-8', 'TIS-620', $regular);

    foreach ($set_types as $key => $value) {

        $test_match_val = preg_match('/'.addslashes($regular).'/', strtolower($value));
        $test_match_key = preg_match('/'.str_replace('.','\.',$regular).'/', $key);
        
        if ( $test_match_val > 0 OR $test_match_key > 0 ) {

            $segment_list = explode('.',$key);
            $segment_txt = array();
            foreach($segment_list as $segment){
                $segment_txt[] = "($segment)";
            }
            ?>
            <a href="javascript: void(0);"><p class="search_detail"><?php echo implode(' ', $segment_txt);?> <?=$value;?></p></a>
            <?php
        }

    }

    exit;
}


include 'rg_menu.php';
$page = input('page');
if( empty($page) ){

    ?>
    <div class="claearfix">
    <h3>��§ҹ��õ�Ǩ�ä����¡�͹ࡳ�����(��辺�����Դ����)</h3>

    <div>
        <form action="rg_soldier.php" method="post">
            <div>
                <div>
                    ���͡��: 
                    <?php 
                    $curr_year = date('Y');
                    $range_y = range(2017, $curr_year);
                    $selected_y = input_post('year_selected', $curr_year);
                    echo getYearList('year_selected', false, $selected_y, $range_y);

                    $selected_m = input_post('selected_month', date('m'));
                    ?>
                    ���͡��͹: <?=getMonthList('selected_month', $selected_m);?>

                    <button type="submit">�ʴ���</button>
                </div>
            </div>
        </form>
    </div>

    <?php

    $sql = "SELECT a.*, b.`idcard`, b.`changwat` 
    FROM `rg_soldier` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE `last_update` LIKE '$selected_y-$selected_m%' 
    ORDER BY number_id ASC";
    $db->select($sql);
    $items = $db->get_items();

    $rows = $db->get_rows();
    if( $rows > 0 ){
        ?>
        <table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff">
            <thead>
                <tr>
                    <th>�ӴѺ</th>
                    <th>�������</th>
                    <th>�Ţ���</th>
                    <th>�ӹ�˹��</th>
                    <th>����</th>
                    <th>���ʡ��</th>
                    <th width="8%">���ʺѵû�Шӵ�ǻ�ЪҪ�</th>
                    <th>�ä����Ǩ��</th>
                    <th width="30%">����з�ǧ���Ѵ</th>
                    <th width="12%">�������ҷ���</th>
                    <th>�ѧ��Ѵ</th>
                    <th>�ѹ����͡��Ѻ�ͧ</th>
                    <th width="12%">��С������ᾷ�����Ǩ</th>
                    <th>�����</th>
                    <th>���</th>
                    <th>ź</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($items as $key => $item) {
                    list($firstname, $lastname) = explode(' ', $item['ptname']);

                    $board = $item['yot1'].$item['doctor1'].'<br>';
                    $board .= $item['yot2'].$item['doctor2'].'<br>';
                    $board .= $item['yot3'].$item['doctor3'];

                    list($date, $time) = explode(' ',$item['last_update']);
                    list($y, $m, $d) = explode('-', $date);

                    $lastupdate = $d.' '.$def_fullm_th[$m].' '.( $y + 543 );
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$item['book_id'];?></td>
                        <td><?=$item['number_id'];?></td>
                        <td><?=$item['yot_pt'];?></td>
                        <td><?=$firstname;?></td>
                        <td><?=$lastname;?></td>
                        <td><?=$item['idcard'];?></td>
                        <td><?=$item['diag'];?></td>
                        <td><?=$item['regular'];?></td>
                        <td><?=$item['address'];?></td>
                        <td><?=$item['changwat'];?></td>
                        <td><?=$lastupdate;?></td>
                        <td><?=$board;?></td>
                        <td><a href="rg_soldier_print.php?id=<?=$item['id'];?>" target="_blank">�����</a></td>
                        <td><a href="rg_soldier.php?page=form&id=<?=$item['id'];?>">���</a></td>
                        <td><a href="rg_soldier.php?action=delete&id=<?=$item['id'];?>" onclick="return del_confirm();">ź</a></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
        </div>
        <script type="text/javascript">
            function del_confirm(){
                var c = confirm('�׹�ѹ���ź������');
                if( c === false ){
                    return false;
                }
            }
        </script>
        <?php
    }else{
        ?>
        <p>�ѧ����բ�����</p>
        <?php
    }

} else if( $page === 'form' ){
    
    $id = input_get('id');
    
    if( empty($id) ){
        $hn = input_post('hn', false);
        ?>
        <h3>������ѹ�֡������ �ê.</h3>
        <form action="rg_soldier.php?page=form" method="post">
            <fieldset>
                <legend>�к� HN</legend>
                <div>
                    HN: <input type="text" name="hn" value="<?=$hn;?>">
                </div>
                <div>
                    <button type="submit">����</button>
                    <input type="hidden" name="search_hn" value="1">
                </div>
            </fieldset>
        </form>
        <?php
        $search_hn = input('search_hn', false);
        $yearchk = $pic = $diag = $code3 = $code2 = $code1 = $regular = $number_id = $book_id = false;
        
    }else{
        $search_hn = 1;
        $sql = "SELECT * FROM `rg_soldier` WHERE `id` = '$id' ";
        $db->select($sql);
        $user = $db->get_item();

        $hn = $user['hn'];
        $book_id = $user['book_id'];
        $number_id = $user['number_id'];
        $regular = $user['regular'];
        $diag = $user['diag'];
        $code1 = $user['code1'];
        $code2 = $user['code2'];
        $code3 = $user['code3'];
        $pic = $user['pic'];
        $yearchk = $user['yearchk'];
        ?>
        <h3>�������䢢����� �ê.</h3>
        <?php
    }

    
    if( $search_hn !== false ){

        $sql = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn'";
        $db->select($sql);
        $user = $db->get_item();

        $sql = "SELECT IF(`yot` != '', `yot`, `yot2`) AS `yot`, TRIM(SUBSTRING(`name`,6)) AS `name`, `doctorcode` 
        FROM `doctor` 
        WHERE  `rg_status` != '' 
        AND `name` REGEXP '^MD+' order by rg_status";
        $q = mysql_query($sql) or die( mysql_error() );
        $dr_items = array();
        while ( $dr = mysql_fetch_assoc($q) ) {
            $dr_items[] = $dr;
        }
    
        ?>
        <div>
            <form action="rg_soldier.php" method="post" id="inputForm" enctype="multipart/form-data">
                <div>����-ʡ��: <?=$user['ptname'];?></div>

                <div>
                    ������� <input type="text" name="book_id" value="<?=$book_id;?>"> �Ţ��� <input type="text" name="number_id" value="<?=$number_id;?>">
                </div>

                <div>
                    <span>���ҡ���з�ǧ���Ѵ: </span><input type="text" id="regular_search" >
                    <div id="regular_result" style="color: blue; text-decoration: underline;"><?=$regular;?></div>
                    <input type="hidden" id="regular" name="regular" value="<?=$regular;?>">
                </div>
    
                <div>
                    ��С������ᾷ�줹���1: 
                    <select name="dr1" id="dr1">
                        <?php
                        foreach ($dr_items as $key => $item) {
                            $selected = ( $item['doctorcode'] == $code1 ) ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$item['doctorcode'];?>" <?=$selected;?> ><?=$item['yot'].$item['name'];?></option>
                            <?php
                        }
                        ?>
                    </select>   
                </div>
                <div>
                    ��С������ᾷ�줹���2: 
                    <select name="dr2" id="dr2">
                        <?php
                        foreach ($dr_items as $key => $item) {
                            $selected = ( $item['doctorcode'] == $code2 ) ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$item['doctorcode'];?>" <?=$selected;?> ><?=$item['yot'].$item['name'];?></option>
                            <?php
                        }
                        ?>
                    </select>   
                </div>
                <div>
                    ��С������ᾷ�줹���3: 
                    <select name="dr3" id="dr3">
                        <?php
                        foreach ($dr_items as $key => $item) {
                            $selected = ( $item['doctorcode'] == $code3 ) ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$item['doctorcode'];?>" <?=$selected;?> ><?=$item['yot'].$item['name'];?></option>
                            <?php
                        }
                        ?>
                    </select>   
                </div>
                <div>
                    �ä����Ǩ�� <input type="text" name="diag" value="<?=$diag;?>">
                </div>
                <div>
                    Ṻ�ٻ���� : <input type="file" name="pic_patient" id="" style="font-size: 12px;">
                    <?php
                    if ( $pic != 'NULL' && $pic != false ) {
                        ?>
                        <p><u>(�óշ���ͧ�������¹�ٻ����ö�Ѿ��Ŵ�ٻ����Ѻ��ѹ��)</u></p>
                        <img src="certificate/<?=$yearchk;?>/<?=$pic;?>" style="width: 120px;">
                        <?php
                    }
                    ?>
                    
                </div>
                <div>
                    <button type="submit">�ѹ�֡������</button>
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="hn" value="<?=$hn;?>">
                    <input type="hidden" name="id" value="<?=$id;?>">
                </div>
            </form>
        </div>
        <div id="show_content" style="display: none;">
        <fieldset><legend>�š�ä���</legend><div class="show_list"></div></fieldset>
        </div>
        <br>
        <div id="full_detail_container">
            <button class="show_detail">�ʴ���͡���з�ǧ������</button>
            <div class="full_detail" style="display: none;">
                <?php
    
                foreach ($types as $main_number => $item_type) {
    
                    $header =  '<p>('.$main_number.') '.$item_type['title'].'</p>';
                    echo $header;
    
                    if( count($item_type['items']) > 0 ){
                        foreach( $item_type['items'] AS $item_number => $item ){
    
                            $item_name = $item;
                            $sub_item = false;
                            if( is_array($item) === true ){
                                $item_name = $item['name'];
                                $sub_item = $item['attributes'];
                            }
                            
    
                            $txt = '<p class="from_full_detail">('.$main_number.') ('.$item_number.') '.$item_name.'</p>';
                            if( $sub_item === false ){
                                echo '<a href="javascript:void(0)">'.$txt.'</a>';
                            }else if( $sub_item !== false ){
                                echo $txt;
                            }
    
                            $json_sub_item = array();
                            if( $sub_item !== false ){
                                foreach ($sub_item as $last_key => $value) {
                                    echo '<a href="javascript:void(0)"><p class="from_full_detail">('.$main_number.') ('.$item_number.') ('.$last_key.') '.$value.'</p></a>';
                                }
                            }
    
                        }
                    }
                    ?>
                    <br>
                    <?php
                }
                ?>
            </div>
        </div>
    
    
        <script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script type="text/javascript">
        jQuery.noConflict();
        (function( $ ) {
        $(function() {
            $(document).on("click", ".show_detail", function(){
                $(".full_detail").slideToggle("fast");
            });
    
            $(document).on("keyup", "#regular_search", function(){
    
                var txt = $(this).val();
                if( txt.length >= 2 ){
                    $.ajax({
                        data: {"content_txt": txt,"action":"search_val"},
                        // datatype: "json",
                        method : "post",
                        url: "rg_soldier.php",
                        success: function(msg){
                            // console.log(msg);
    
                            if ( msg !== '' ) {
                                $("#show_content").show();
                                $(".show_list").html(msg);
                            }
                            
                        }
                    });
                }
                
            });
    
            $(document).on("click", ".from_full_detail", function(){
                var full_detail = $(this).html();
                $("#regular").val(full_detail);
                $("#regular_result").html(full_detail);
                $(".full_detail").slideUp(100);
            });
    
            // ��ԡ��¡�÷�����
            $(document).on("click", ".search_detail", function(){
                var full_detail = $(this).html();
                $("#regular").val(full_detail);
                $("#regular_result").html(full_detail);
                $("#show_content").hide();
            });
    
            $(document).on("submit", "#inputForm", function(){
                var regular = $("#regular").val();
                if (regular == '') {
                    alert('��س����͡����з�ǧ');
                    return false;
                }

                var dr1 = $("#dr1").val();
                var dr2 = $("#dr2").val();
                var dr3 = $("#dr3").val();

                if( dr1 == dr2 || dr1 == dr3 || dr2 == dr3 ){
                    alert('����ᾷ���� ��س����͡ᾷ�������ա����');
                    return false;
                }

            });
    
        });
        })(jQuery);
    
        </script>
    
        <?php
    }

}