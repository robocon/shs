<?php 
include '../bootstrap.php';
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
    <title>ระบบรายงานการค้นหา</title>
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
</head>
<body>
	<?php
	include 'menu.php';

    $clinics = array(
        'A' => 'A มีเหตุการณ์ซึ่งมีโอกาสที่ก่อให้เกิดความคลาดเคลื่อน',
        'B' => 'B เกิดความคลาดเคลื่อนขึ้นแต่ยังไม่ถึงตัวผู้ป่วย',
        'C' => 'C เกิดความคลาดเคลื่อนกับผู้ป่วย ไม่เกิดอันตราย ไม่มีการรักษา',
        'D' => 'D เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องเฝ้าระวังอาการเพราะมีโอกาสเกิดอันตรายได้ ไม่เกิดอันตรายต่อผู้ป่วย',
        'E' => 'E เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องให้การรักษาเพิ่มมากขึ้นจากเหตุการณ์นั้น เกิดอันตราย/พิการเพียงชั่วคราวต่อผู้ป่วย',
        'F' => 'F เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องให้การรักษา เกิดอันตราย/พิการ เพียงชั่วคราว ผู้ป่วยต้องอยู่ รพ.นานขึ้น',
        'G' => 'G เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องให้การรักษา เกิดความพิการถาวร',
        'H' => 'H เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องให้การรักษาทำการกู้ชีวิต/เกือบเสียชีวิต',
        'I' => 'I เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องให้การรักษาถึงแก่ชีวิต'
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
                        <th>หน่วยงาน</th>
                        <th>เหตุการณ์</th>
                        <th>ความรุนแรง</th>
                        <th>วันที่-เวลา</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($items as $key => $item) {

                        $thai_date =preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '${3}/${2}/${1}', $item['fha_date']);
                        $clinic_code = $item['level_vio'];

                        // เหตุการณ์ //
                        $topic1 = array('<b>การสั่งยา (Prescribing error)</b>');
                        $topic2 = array('<b>การจ่ายยา(Dispensing error)</b>');
                        $topic3 = array('<b>การคัดลอกคำสั่ง (Transcribing error)</b>');
                        $topic4 = array('<b>การบริหารยา (Administration error)</b>');
                        $topic5 = array('<b>Compliance Error (การใช้ยาของผู้ป่วย)</b>');

                        if( $item['p1'] > 0 ){ array_push($topic1, 'สั่งยาโดยไม่มีข้อบ่งใช้'); }
                        if( $item['p2'] > 0 ){ array_push($topic1, 'สั่งยาโดยไม่มีข้อห้ามใช้'); }
                        if( $item['p3'] > 0 ){ array_push($topic1, 'สั่งยาที่ผู้ป่วยมีประวัติแพ้'); }
                        if( $item['p4'] > 0 ){ array_push($topic1, 'สั่งยาที่เกิดปฏิกิริยาต่อกัน'); }
                        if( $item['p5'] > 0 ){ array_push($topic1, 'สั่งยาในขนาดสูงเกินไป'); }
                        if( $item['p6'] > 0 ){ array_push($topic1, 'สั่งยาในขนาดต่ำเกินไป'); }
                        if( $item['p7'] > 0 ){ array_push($topic1, 'อื่นๆ'); }
                        if( $item['p8'] > 0 ){ array_push($topic1, 'ไม่ระบุความแรง/วิธีใช้/จำนวน'); }
                        if( $item['p9'] > 0 ){ array_push($topic1, 'ผิดชื่อยา/ชนิดยา'); }
                        if( $item['p10'] > 0 ){ array_push($topic1, 'ผิดความแรง'); }
                        if( $item['p11'] > 0 ){ array_push($topic1, 'ผิดรูปแบบยา'); }
                        if( $item['p12'] > 0 ){ array_push($topic1, 'ผิดวิธีใช้'); }
                        if( $item['p13'] > 0 ){ array_push($topic1, 'ผิดปริมาณ/จำนวนยา'); }
                        if( $item['p14'] > 0 ){ array_push($topic1, 'สั่งยาซ้ำซ้อน'); }
                        if( $item['p15'] > 0 ){ array_push($topic1, 'สั่งจ่ายยาไม่ตรงกับผู้ป่วย'); }
                        if( !empty($item['p_detail']) ){ array_push($topic1, $item['p_detail']); }

                        if( $item['d1'] > 0 ){ array_push($topic2, 'จ่ายยาไม่ตรงกับผู้ป่วย'); }
                        if( $item['d2'] > 0 ){ array_push($topic2, 'จ่ายยาผิดชนิด/ชื่อยา'); }
                        if( $item['d3'] > 0 ){ array_push($topic2, 'ผิดขนาด'); }
                        if( $item['d4'] > 0 ){ array_push($topic2, 'ผิดความแรง'); }
                        if( $item['d5'] > 0 ){ array_push($topic2, 'ผิดจำนวน/ปริมาณ'); }
                        if( $item['d6'] > 0 ){ array_push($topic2, 'ผิดรูปแบบ'); }
                        if( $item['d7'] > 0 ){ array_push($topic2, 'จ่ายยาหมดอายุ/เสื่อมสภาพโดยสภาพเก็บไม่เหมาะสม'); }
                        if( $item['d8'] > 0 ){ array_push($topic2, 'ยาขาด Stock ไม่สามารถจัดยาได้ตามใบสั่งขณะนั้น'); }
                        if( $item['d9'] > 0 ){ array_push($topic2, 'อื่นๆ'); }
                        if( !empty($item['d_detail']) ){ array_push($topic2, $item['d_detail']); }
                        
                        if( $item['t1'] > 0 ){ array_push($topic3, 'ผิดชื่อยา/ชนิดยา'); }
                        if( $item['t2'] > 0 ){ array_push($topic3, 'ผิดความแรง'); }
                        if( $item['t3'] > 0 ){ array_push($topic3, 'ผิดรูปแบบยา'); }
                        if( $item['t4'] > 0 ){ array_push($topic3, 'ผิดวิธีใช้'); }
                        if( $item['t5'] > 0 ){ array_push($topic3, 'ผิดปริมาณ/จำนวนยาซ้ำซ้อน'); }
                        if( $item['t6'] > 0 ){ array_push($topic3, 'ยาไม่ตรงกับชื่อผู้ใช้'); }
                        if( $item['t7'] > 0 ){ array_push($topic3, 'ยาที่แพทย์ไม่ได้สั่ง'); }
                        if( $item['t8'] > 0 ){ array_push($topic3, 'อื่นๆ'); }
                        if( !empty($item['t_detail']) ){ array_push($topic3, $item['t_detail']); }

                        if( $item['a1'] > 0 ){ array_push($topic4, 'ไม่จ่ายยาในเวลาที่กำหนด/ลืมให้ยา'); }
                        if( $item['a2'] > 0 ){ array_push($topic4, 'ผิดขนาด/ความแรง'); }
                        if( $item['a3'] > 0 ){ array_push($topic4, 'ผิดชื่อยา/ชนิดยา'); }
                        if( $item['a4'] > 0 ){ array_push($topic4, 'ผิดอัตราการให้ยา/สารละลาย'); }
                        if( $item['a5'] > 0 ){ array_push($topic4, 'ผิดตำแหน่ง/วิถีทาง/รูปแบบ'); }
                        if( $item['a6'] > 0 ){ array_push($topic4, 'ผิดคน'); }
                        if( $item['a7'] > 0 ){ array_push($topic4, 'อื่นๆ'); }
                        if( $item['a8'] > 0 ){ array_push($topic4, 'ให้ยาไม่ครบรายการ(ขาด/เกิน)'); }
                        if( $item['a9'] > 0 ){ array_push($topic4, 'ให้ยามากกว่า/น้อยกว่าจำนวนครั้งที่สั่ง'); }
                        if( $item['a10'] > 0 ){ array_push($topic4, 'เตรียม/ผสมยาผิด'); }
                        if( $item['a11'] > 0 ){ array_push($topic4, 'เก็บรักษายาผิด(ยาค้าง stock / เก็บยาอันตรายในรถฉุกเฉิน / เก็บยาไม่เหมาะสม เช่นนอกตู้เย็น ไม่ป้องกันแสง)'); }
                        if( $item['a12'] > 0 ){ array_push($topic4, 'ให้ยาหมดอายุ/เสื่อมสภาพ'); }
                        if( !empty($item['a_detail']) ){ array_push($topic4, $item['a_detail']); }
                        
                        if( $item['c1'] > 0 ){ array_push($topic5, 'ผู้ป่วยไม่ได้รับประทานยาตามแพทย์สั่ง'); }
                        if( $item['c2'] > 0 ){ array_push($topic5, 'อื่นๆ'); }
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