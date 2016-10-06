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
    FROM `drug_fail_2` AS a 
    LEFT JOIN `departments` AS b ON b.`code` = a.`area`
    WHERE a.`fha_date` LIKE '$date%' 
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
                        <th>˹��§ҹ</th>
                        <th>�˵ء�ó�</th>
                        <th>�����ع�ç</th>
                        <th>�ѹ���-����</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($items as $key => $item) {

                        $thai_date =preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '${3}/${2}/${1}', $item['fha_date']);
                        $clinic_code = $item['level_vio'];

                        // �˵ء�ó� //
                        $topic1 = array('<b>�������� (Prescribing error)</b>');
                        $topic2 = array('<b>��è�����(Dispensing error)</b>');
                        $topic3 = array('<b>��äѴ�͡����� (Transcribing error)</b>');
                        $topic4 = array('<b>��ú������� (Administration error)</b>');
                        $topic5 = array('<b>Compliance Error (������Ңͧ������)</b>');

                        if( $item['p1'] > 0 ){ array_push($topic1, '�����������բ�ͺ���'); }
                        if( $item['p2'] > 0 ){ array_push($topic1, '�����������բ��������'); }
                        if( $item['p3'] > 0 ){ array_push($topic1, '����ҷ��������ջ���ѵ���'); }
                        if( $item['p4'] > 0 ){ array_push($topic1, '����ҷ���Դ��ԡ����ҵ�͡ѹ'); }
                        if( $item['p5'] > 0 ){ array_push($topic1, '�����㹢�Ҵ�٧�Թ�'); }
                        if( $item['p6'] > 0 ){ array_push($topic1, '�����㹢�Ҵ����Թ�'); }
                        if( $item['p7'] > 0 ){ array_push($topic1, '����'); }
                        if( $item['p8'] > 0 ){ array_push($topic1, '����кؤ����ç/�Ը���/�ӹǹ'); }
                        if( $item['p9'] > 0 ){ array_push($topic1, '�Դ������/��Դ��'); }
                        if( $item['p10'] > 0 ){ array_push($topic1, '�Դ�����ç'); }
                        if( $item['p11'] > 0 ){ array_push($topic1, '�Դ�ٻẺ��'); }
                        if( $item['p12'] > 0 ){ array_push($topic1, '�Դ�Ը���'); }
                        if( $item['p13'] > 0 ){ array_push($topic1, '�Դ����ҳ/�ӹǹ��'); }
                        if( $item['p14'] > 0 ){ array_push($topic1, '����ҫ�ӫ�͹'); }
                        if( $item['p15'] > 0 ){ array_push($topic1, '��觨��������ç�Ѻ������'); }
                        if( !empty($item['p_detail']) ){ array_push($topic1, $item['p_detail']); }

                        if( $item['d1'] > 0 ){ array_push($topic2, '���������ç�Ѻ������'); }
                        if( $item['d2'] > 0 ){ array_push($topic2, '�����ҼԴ��Դ/������'); }
                        if( $item['d3'] > 0 ){ array_push($topic2, '�Դ��Ҵ'); }
                        if( $item['d4'] > 0 ){ array_push($topic2, '�Դ�����ç'); }
                        if( $item['d5'] > 0 ){ array_push($topic2, '�Դ�ӹǹ/����ҳ'); }
                        if( $item['d6'] > 0 ){ array_push($topic2, '�Դ�ٻẺ'); }
                        if( $item['d7'] > 0 ){ array_push($topic2, '�������������/��������Ҿ����Ҿ������������'); }
                        if( $item['d8'] > 0 ){ array_push($topic2, '�ҢҴ Stock �������ö�Ѵ���������觢�й��'); }
                        if( $item['d9'] > 0 ){ array_push($topic2, '����'); }
                        if( !empty($item['d_detail']) ){ array_push($topic2, $item['d_detail']); }
                        
                        if( $item['t1'] > 0 ){ array_push($topic3, '�Դ������/��Դ��'); }
                        if( $item['t2'] > 0 ){ array_push($topic3, '�Դ�����ç'); }
                        if( $item['t3'] > 0 ){ array_push($topic3, '�Դ�ٻẺ��'); }
                        if( $item['t4'] > 0 ){ array_push($topic3, '�Դ�Ը���'); }
                        if( $item['t5'] > 0 ){ array_push($topic3, '�Դ����ҳ/�ӹǹ�ҫ�ӫ�͹'); }
                        if( $item['t6'] > 0 ){ array_push($topic3, '�����ç�Ѻ���ͼ����'); }
                        if( $item['t7'] > 0 ){ array_push($topic3, '�ҷ��ᾷ����������'); }
                        if( $item['t8'] > 0 ){ array_push($topic3, '����'); }
                        if( !empty($item['t_detail']) ){ array_push($topic3, $item['t_detail']); }

                        if( $item['a1'] > 0 ){ array_push($topic4, '������������ҷ���˹�/��������'); }
                        if( $item['a2'] > 0 ){ array_push($topic4, '�Դ��Ҵ/�����ç'); }
                        if( $item['a3'] > 0 ){ array_push($topic4, '�Դ������/��Դ��'); }
                        if( $item['a4'] > 0 ){ array_push($topic4, '�Դ�ѵ�ҡ�������/��������'); }
                        if( $item['a5'] > 0 ){ array_push($topic4, '�Դ���˹�/�Զշҧ/�ٻẺ'); }
                        if( $item['a6'] > 0 ){ array_push($topic4, '�Դ��'); }
                        if( $item['a7'] > 0 ){ array_push($topic4, '����'); }
                        if( $item['a8'] > 0 ){ array_push($topic4, '��������ú��¡��(�Ҵ/�Թ)'); }
                        if( $item['a9'] > 0 ){ array_push($topic4, '������ҡ����/���¡��Ҩӹǹ���駷�����'); }
                        if( $item['a10'] > 0 ){ array_push($topic4, '�����/����ҼԴ'); }
                        if( $item['a11'] > 0 ){ array_push($topic4, '���ѡ���ҼԴ(�Ҥ�ҧ stock / �����ѹ�����ö�ء�Թ / �������������� �蹹͡������ ����ͧ�ѹ�ʧ)'); }
                        if( $item['a12'] > 0 ){ array_push($topic4, '������������/��������Ҿ'); }
                        if( !empty($item['a_detail']) ){ array_push($topic4, $item['a_detail']); }
                        
                        if( $item['c1'] > 0 ){ array_push($topic5, '������������Ѻ��зҹ�ҵ��ᾷ�����'); }
                        if( $item['c2'] > 0 ){ array_push($topic5, '����'); }
                        if( !empty($item['c_detail']) ){ array_push($topic5, $item['c_detail']); }
                    ?>
                    <tr>
                        <td align="right"><?=$i;?></td>
                        <td><?=$item['name'];?></td>
                        <td>
                            <?php
                            if( count($topic1) > 1 ){ echo  implode(', ', $topic1); }
                            if( count($topic2) > 1 ){ echo  implode(', ', $topic2); }
                            if( count($topic3) > 1 ){ echo  implode(', ', $topic3); }
                            if( count($topic4) > 1 ){ echo  implode(', ', $topic4); }
                            if( count($topic5) > 1 ){ echo  implode(', ', $topic5); }
                            ?>
                        </td>
                        <td><?=$clinics[$clinic_code];?></td>
                        <td align="left"><?=$thai_date.' '.$item['fha_time'];?></td>
                        <td>
                            <a href="fha_report.php?row_id=<?=$item['row_id'];?>" target="_blank">View</a>
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