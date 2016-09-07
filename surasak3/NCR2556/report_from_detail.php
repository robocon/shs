<?php 
include '../bootstrap.php';
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <title>�к���§ҹ��ä���</title>
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
</head>
<body>
	<?php
	include 'menu.php';

    $clinics = array(
        'A' => 'A ���˵ء�ó������͡�ʷ��������Դ������Ҵ����͹',
        'B' => 'B �Դ������Ҵ����͹������ѧ���֧��Ǽ�����',
        'C' => 'C �Դ������Ҵ����͹�Ѻ������ ����Դ�ѹ���� ����ա���ѡ��',
        'D' => 'D �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѧ�ҡ���������͡���Դ�ѹ������ ����Դ�ѹ���µ�ͼ�����',
        'E' => 'E �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѡ�������ҡ��鹨ҡ�˵ء�ó��� �Դ�ѹ����/�ԡ����§���Ǥ��ǵ�ͼ�����',
        'F' => 'F �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѡ�� �Դ�ѹ����/�ԡ�� ��§���Ǥ��� �����µ�ͧ���� þ.�ҹ���',
        'G' => 'G �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѡ�� �Դ�����ԡ�ö���',
        'H' => 'H �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѡ�ҷӡ�á����Ե/��ͺ���ª��Ե',
        'I' => 'I �Դ������Ҵ����͹�Ѻ������ ��ͧ������ѡ�Ҷ֧����Ե'
    );

    $date = ad_to_bc(input_get('date'));
    $group = input_get('group');

    $conf = array(
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'dbconform',
        'user' => 'root',
        'pass' => '1234'
    );

    $db = Mysql::load($conf);
    $sql = "SELECT a.*, b.`name` 
    FROM `ncr2556` AS a 
    LEFT JOIN `departments` AS b ON b.`code` = a.`until`
    WHERE a.`nonconf_date` LIKE '$date%' 
    AND a.`come_from_id` = '$group' 
    ORDER BY b.`id` ASC";
    $db->select($sql);
    $items = $db->get_items();
	?>
    <style type="text/css">
    td, th{
        padding: 2px;
    }
    </style>
    <div class="col">
        <div class="cell">
            <table border="1" cellspacing="1" cellpadding="3" bordercolor="#000000" style="border-collapse:collapse">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NCR</th>
                        <th>˹��§ҹ</th>
                        <th>�˵ء�ó�</th>
                        <th>�����ع�ç</th>
                        <th>��������§</th>
                        <th>�ѹ���-����</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($items as $key => $item) {

                        $thai_date =preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '${3}/${2}/${1}', $item['nonconf_date']);
                        $clinic_code = $item['clinic'];

                        // �˵ء�ó� //
                        $topic1 = array('<b>1.������ʹ���/��/ˡ���</b>');
                        $topic2 = array('<b>2.��õԴ����������</b>');
                        $topic3 = array('<b>3.���ʹ</b>');
                        $topic4 = array('<b>4.����ͧ���</b>');
                        $topic5 = array('<b>5.����ԹԨ���/�ѡ��</b>');
                        $topic6 = array('<b>6.��ä�ʹ</b>');
                        $topic7 = array('<b>7.��ü�ҵѴ/���ѭ��</b>');
                        $topic8 = array('<b>8.����</b>');

                        if( $item['topic1_1'] > 0 ){ array_push($topic1, '���'); }
                        if( $item['topic1_2'] > 0 ){ array_push($topic1, '����ҹ͹���躹���'); }
                        if( $item['topic1_3'] > 0 ){ array_push($topic1, '���ҡ��§/������/���'); }
                        if( $item['topic1_4'] > 0 ){ array_push($topic1, '����ͧ�Ѵ�֧��ش'); }
                        if( $item['topic1_5'] > 0 ){ array_push($topic1, '�չ�����������§'); }
                        if( $item['topic1_6'] > 0 ){ array_push($topic1, '��Ѵ�������ҧ�������͹����'); }
                        if( !empty($item['topic1_7']) ){ array_push($topic1, $item['topic1_7']); }

                        if( $item['topic2_1'] > 0 ){ array_push($topic2, '�������§ҹ�� lab / Film X-ray ��ǹ���ͼԴ����'); }
                        if( $item['topic2_2'] > 0 ){ array_push($topic2, '�����§ҹᾷ��/ᾷ�����ͺ'); }
                        if( $item['topic2_3'] > 0 ){ array_push($topic2, '��Ժѵ����١��ͧ��������'); }
                        if( $item['topic2_4'] > 0 ){ array_push($topic2, '�Ǫ����¹�������ó�'); }
                        if( $item['topic2_5'] > 0 ){ array_push($topic2, '��Թ������ç�Ѻ�ѵ����'); }
                        if( $item['topic2_6'] > 0 ){ array_push($topic2, '���ѵ�������������Թ���'); }
                        if( !empty($item['topic2_7']) ){ array_push($topic2, $item['topic2_7']); }
                        
                        if( $item['topic3_1'] > 0 ){ array_push($topic3, '�Դ��'); }
                        if( $item['topic3_2'] > 0 ){ array_push($topic3, '�����á��͹�ҡ���������ʹ'); }
                        if( $item['topic3_3'] > 0 ){ array_push($topic3, '�����ʹ'); }
                        if( !empty($item['topic3_4']) ){ array_push($topic3, $item['topic3_4']); }

                        if( $item['topic4_1'] > 0 ){ array_push($topic4, '�����¶١�ǡ/����'); }
                        if( $item['topic4_2'] > 0 ){ array_push($topic4, '����������'); }
                        if( $item['topic4_3'] > 0 ){ array_push($topic4, '���ӧҹ/�ӧҹ�Դ����'); }
                        if( $item['topic4_4'] > 0 ){ array_push($topic4, '���������ͧ�����'); }
                        if( $item['topic4_5'] > 0 ){ array_push($topic4, '�Կ�����ӧҹ'); }
                        if( !empty($item['topic4_6']) ){ array_push($topic4, $item['topic4_6']); }
                        
                        if( $item['topic5_1'] > 0 ){ array_push($topic5, '�Ѻ admit ������ä���� 7�ѹ'); }
                        if( $item['topic5_2'] > 0 ){ array_push($topic5, '�������ö�ԹԨ����ä����ͧ admit ������ er ���'); }
                        if( $item['topic5_3'] > 0 ){ array_push($topic5, '��ҹ����硫�����Դ'); }
                        if( $item['topic5_4'] > 0 ){ array_push($topic5, '��Ҫ��㹡���ѡ�Ҽ����·���شŧ'); }
                        if( $item['topic5_5'] > 0 ){ array_push($topic5, '�����á��͹�ҡ�ѵ����'); }
                        if( $item['topic5_6'] > 0 ){ array_push($topic5, '��÷� diag proc ����������Ἱ'); }
                        if( $item['topic5_7'] > 0 ){ array_push($topic5, '���������ѧ�����§��'); }
                        if( $item['topic5_8'] > 0 ){ array_push($topic5, '��� Cath/Tube/Drain ���١'); }
                        if( $item['topic5_9'] > 0 ){ array_push($topic5, '���� Cath / Tube /Drain'); }
                        if( $item['topic5_10'] > 0 ){ array_push($topic5, '���¼�������� ICU �������Ἱ'); }
                        if(!empty($item['topic5_11']) > 0 ){ array_push($topic5, $item['topic5_11']); }

                        if( $item['topic6_1'] > 0 ){ array_push($topic6, '��辺 Fetal distress �ѹ��ǧ��'); }
                        if( $item['topic6_2'] > 0 ){ array_push($topic6, '��ҵѴ��ʹ����Թ�'); }
                        if( $item['topic6_3'] > 0 ){ array_push($topic6, '�����á��͹�ҡ��ä�ʹ'); }
                        if( $item['topic6_4'] > 0 ){ array_push($topic6, '�Ҵ�纨ҡ��ä�ʹ'); }
                        if( !empty($item['topic6_5']) ){ array_push($topic6, $item['topic6_5']); }

                        if( $item['topic7_1'] > 0 ){ array_push($topic7, '�����á��͹�ҧ���ѭ��'); }
                        if( $item['topic7_2'] > 0 ){ array_push($topic7, '��ҵѴ�Դ��/�Դ��ҧ/�Դ���˹�'); }
                        if( $item['topic7_3'] > 0 ){ array_push($topic7, '�Ѵ�������͡��������ҧἹ'); }
                        if( $item['topic7_4'] > 0 ){ array_push($topic7, '��纫��������з��Ҵ��'); }
                        if( $item['topic7_5'] > 0 ){ array_push($topic7, '�������ͧ���/�������㹼�����'); }
                        if( $item['topic7_6'] > 0 ){ array_push($topic7, '��Ѻ�Ҽ�ҵѴ���'); }
                        if( !empty($item['topic7_7']) ){ array_push($topic7, $item['topic7_7']); }
                        
                        if( $item['topic8_1'] > 0 ){ array_push($topic8, '������/�ҵ� ���֧���'); }
                        if( $item['topic8_2'] > 0 ){ array_push($topic8, '�����Ѥ������ þ.'); }
                        if( $item['topic8_3'] > 0 ){ array_push($topic8, '�ա�÷�������ҧ��� ������/�ҵ�/���˹�ҷ��'); }
                        if( $item['topic8_4'] > 0 ){ array_push($topic8, '�����¾�������ҵ�ǵ��/��������ҧ��µ���ͧ'); }
                        if( $item['topic8_5'] > 0 ){ array_push($topic8, '�á���/�ѡ����'); }
                        if( $item['topic8_6'] > 0 ){ array_push($topic8, '��äء���/������'); }
                        if( $item['topic8_7'] > 0 ){ array_push($topic8, '����Ǵ�������ѹ����/�����͹'); }
                        if( $item['topic8_8'] > 0 ){ array_push($topic8, '�غѵ��˵������'); }
                        if( $item['topic8_9'] > 0 ){ array_push($topic8, '���.�Ҵ�纨ҡ��÷ӧҹ'); }
                        if( $item['topic8_10'] > 0 ){ array_push($topic8, '��������¡�纤�������'); }
                        if( !empty($item['topic8_11']) ){ array_push($topic8, $item['topic8_11']); }
                        // �˵ء�ó� //

                        $risk = array();
                        if( $item['risk1'] > 0 ){ array_push($risk, 'Clinical Risk'); }
                        if( $item['risk2'] > 0 ){ array_push($risk, 'Infection control Risk'); }
                        if( $item['risk3'] > 0 ){ array_push($risk, 'Medication Risk'); }
                        if( $item['risk4'] > 0 ){ array_push($risk, 'Medical Equipment Risk'); }
                        if( $item['risk5'] > 0 ){ array_push($risk, 'Safety and Environment Risk'); }
                        if( $item['risk6'] > 0 ){ array_push($risk, 'Customer Complaint Risk'); }
                        if( $item['risk7'] > 0 ){ array_push($risk, 'Financial Risk'); }
                        if( $item['risk8'] > 0 ){ array_push($risk, 'Utilization Management Risk'); }
                        if( $item['risk9'] > 0 ){ array_push($risk, 'Information Risk'); }
                    ?>
                    <tr>
                        <td align="right"><?=$i;?></td>
                        <td align="right"><?=$item['ncr'];?></td>
                        <td><?=$item['name'];?></td>
                        <td>
                            <?php
                            if( count($topic1) > 1 ){ echo  implode(', ', $topic1); }
                            if( count($topic2) > 1 ){ echo  implode(', ', $topic2); }
                            if( count($topic3) > 1 ){ echo  implode(', ', $topic3); }
                            if( count($topic4) > 1 ){ echo  implode(', ', $topic4); }
                            if( count($topic5) > 1 ){ echo  implode(', ', $topic5); }
                            if( count($topic6) > 1 ){ echo  implode(', ', $topic6); }
                            if( count($topic7) > 1 ){ echo  implode(', ', $topic7); }
                            if( count($topic8) > 1 ){ echo  implode(', ', $topic8); }
                            ?>
                        </td>
                        <td><?=$clinics[$clinic_code];?></td>
                        <td>
                            <?php
                            if( count($risk) > 0 ){ echo  implode(', ', $risk); }
                            ?>
                        </td>
                        <td align="left"><?=$thai_date.' '.$item['nonconf_time'];?></td>
                        <td>
                            <a href="ncf_print.php?ncr_id=<?=$item['nonconf_id'];?>" target="_blank">View</a>
                        </td>
                    </tr>
                    <?php
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>