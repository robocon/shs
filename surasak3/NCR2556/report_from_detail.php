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
                        <th>หน่วยงาน</th>
                        <th>เหตุการณ์</th>
                        <th>ความรุนแรง</th>
                        <th>ความเสี่ยง</th>
                        <th>วันที่-เวลา</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($items as $key => $item) {

                        $thai_date =preg_replace('/(\d{4})-(\d{2})-(\d{2})/', '${3}/${2}/${1}', $item['nonconf_date']);
                        $clinic_code = $item['clinic'];

                        // เหตุการณ์ //
                        $topic1 = array('<b>1.ความปลอดภัย/ตก/หกล้ม</b>');
                        $topic2 = array('<b>2.การติดต่อสื่อสาร</b>');
                        $topic3 = array('<b>3.เลือด</b>');
                        $topic4 = array('<b>4.เครื่องมือ</b>');
                        $topic5 = array('<b>5.การวินิจฉัย/รักษา</b>');
                        $topic6 = array('<b>6.การคลอด</b>');
                        $topic7 = array('<b>7.การผ่าตัด/วิสัญญี</b>');
                        $topic8 = array('<b>8.อื่นๆ</b>');

                        if( $item['topic1_1'] > 0 ){ array_push($topic1, 'ล้ม'); }
                        if( $item['topic1_2'] > 0 ){ array_push($topic1, 'พบว่านอนอยู่บนพื้น'); }
                        if( $item['topic1_3'] > 0 ){ array_push($topic1, 'ตกจากเตียง/เก้าอี้/โต๊ะ'); }
                        if( $item['topic1_4'] > 0 ){ array_push($topic1, 'เครื่องรัดตึงหลุด'); }
                        if( $item['topic1_5'] > 0 ){ array_push($topic1, 'ปีนข้ามไม้กั้นเตียง'); }
                        if( $item['topic1_6'] > 0 ){ array_push($topic1, 'พลัดตกระหว่างการเคลื่อนย้าย'); }
                        if( !empty($item['topic1_7']) ){ array_push($topic1, $item['topic1_7']); }

                        if( $item['topic2_1'] > 0 ){ array_push($topic2, 'ไม่มีรายงานผล lab / Film X-ray ด่วนหรือผิดปกติ'); }
                        if( $item['topic2_2'] > 0 ){ array_push($topic2, 'ไม่รายงานแพทย์/แพทย์ไม่ตอบ'); }
                        if( $item['topic2_3'] > 0 ){ array_push($topic2, 'ปฏิบัติไม่ถูกต้องตามคำสั่ง'); }
                        if( $item['topic2_4'] > 0 ){ array_push($topic2, 'เวชระเบียนไม่สมบูรณ์'); }
                        if( $item['topic2_5'] > 0 ){ array_push($topic2, 'ใบยินยอมไม่ตรงกับหัตถการ'); }
                        if( $item['topic2_6'] > 0 ){ array_push($topic2, 'ทำหัตถการโดยไม่มีใบยินยอม'); }
                        if( !empty($item['topic2_7']) ){ array_push($topic2, $item['topic2_7']); }
                        
                        if( $item['topic3_1'] > 0 ){ array_push($topic3, 'ผิดคน'); }
                        if( $item['topic3_2'] > 0 ){ array_push($topic3, 'ภาวะแทรกซ้อนจากการให้เลือด'); }
                        if( $item['topic3_3'] > 0 ){ array_push($topic3, 'แพ้เลือด'); }
                        if( !empty($item['topic3_4']) ){ array_push($topic3, $item['topic3_4']); }

                        if( $item['topic4_1'] > 0 ){ array_push($topic4, 'ผู้ป่วยถูกลวก/ไหม้'); }
                        if( $item['topic4_2'] > 0 ){ array_push($topic4, 'ตกใส่ผู้ป่วย'); }
                        if( $item['topic4_3'] > 0 ){ array_push($topic4, 'ไม่ทำงาน/ทำงานผิดปกติ'); }
                        if( $item['topic4_4'] > 0 ){ array_push($topic4, 'ไม่มีเครื่องมือใช้'); }
                        if( $item['topic4_5'] > 0 ){ array_push($topic4, 'ลิฟท์ไม่ทำงาน'); }
                        if( !empty($item['topic4_6']) ){ array_push($topic4, $item['topic4_6']); }
                        
                        if( $item['topic5_1'] > 0 ){ array_push($topic5, 'รับ admit ซ้ำโดยโรคเดิมใน 7วัน'); }
                        if( $item['topic5_2'] > 0 ){ array_push($topic5, 'ไม่สามารถวินิจฉัยโรคที่ต้อง admit หรือมา er ซ้ำ'); }
                        if( $item['topic5_3'] > 0 ){ array_push($topic5, 'อ่านผลเอ็กซ์เรย์ผิด'); }
                        if( $item['topic5_4'] > 0 ){ array_push($topic5, 'ล่าช้าในการรักษาผู้ป่วยที่ทรุดลง'); }
                        if( $item['topic5_5'] > 0 ){ array_push($topic5, 'ภาวะแทรกซ้อนจากหัตถการ'); }
                        if( $item['topic5_6'] > 0 ){ array_push($topic5, 'การทำ diag proc ซ้ำโดยไม่มีแผน'); }
                        if( $item['topic5_7'] > 0 ){ array_push($topic5, 'การเฝ้าระวังไม่เพียงพอ'); }
                        if( $item['topic5_8'] > 0 ){ array_push($topic5, 'ใส่ Cath/Tube/Drain ไม่ถูก'); }
                        if( $item['topic5_9'] > 0 ){ array_push($topic5, 'ดูแล Cath / Tube /Drain'); }
                        if( $item['topic5_10'] > 0 ){ array_push($topic5, 'ย้ายผู้ป่วยเข้า ICU โดยไม่มีแผน'); }
                        if(!empty($item['topic5_11']) > 0 ){ array_push($topic5, $item['topic5_11']); }

                        if( $item['topic6_1'] > 0 ){ array_push($topic6, 'ไม่พบ Fetal distress ทันท่วงที'); }
                        if( $item['topic6_2'] > 0 ){ array_push($topic6, 'ผ่าตัดคลอดช้าเกินไป'); }
                        if( $item['topic6_3'] > 0 ){ array_push($topic6, 'ภาวะแทรกซ้อนจากการคลอด'); }
                        if( $item['topic6_4'] > 0 ){ array_push($topic6, 'บาดเจ็บจากการคลอด'); }
                        if( !empty($item['topic6_5']) ){ array_push($topic6, $item['topic6_5']); }

                        if( $item['topic7_1'] > 0 ){ array_push($topic7, 'ภาวะแทรกซ้อนทางวิสัญญี'); }
                        if( $item['topic7_2'] > 0 ){ array_push($topic7, 'ผ่าตัดผิดคน/ผิดข้าง/ผิดตำแหน่ง'); }
                        if( $item['topic7_3'] > 0 ){ array_push($topic7, 'ตัดอวัยวะออกโดยไม่ได้วางแผน'); }
                        if( $item['topic7_4'] > 0 ){ array_push($topic7, 'เย็บซ่อมอวัยวะที่บาดเจ็บ'); }
                        if( $item['topic7_5'] > 0 ){ array_push($topic7, 'ทิ้งเครื่องมือ/ก๊อสไว้ในผู้ป่วย'); }
                        if( $item['topic7_6'] > 0 ){ array_push($topic7, 'กลับมาผ่าตัดซ้ำ'); }
                        if( !empty($item['topic7_7']) ){ array_push($topic7, $item['topic7_7']); }
                        
                        if( $item['topic8_1'] > 0 ){ array_push($topic8, 'ผู้ป่วย/ญาติ ไม่พึงพอใจ'); }
                        if( $item['topic8_2'] > 0 ){ array_push($topic8, 'ไม่สมัครใจอยู่ รพ.'); }
                        if( $item['topic8_3'] > 0 ){ array_push($topic8, 'มีการทำร้ายร่างกาย ผู้ป่วย/ญาติ/เจ้าหน้าที่'); }
                        if( $item['topic8_4'] > 0 ){ array_push($topic8, 'ผู้ป่วยพยายามฆ่าตัวตาย/ทำร้ายร่างกายตัวเอง'); }
                        if( $item['topic8_5'] > 0 ){ array_push($topic8, 'โจรกรรม/ลักขโมย'); }
                        if( $item['topic8_6'] > 0 ){ array_push($topic8, 'การคุกคาม/ข่มขู่'); }
                        if( $item['topic8_7'] > 0 ){ array_push($topic8, 'สิ่งแวดล้อมเป็นอันตราย/ปนเปื้อน'); }
                        if( $item['topic8_8'] > 0 ){ array_push($topic8, 'อุบัติเหตุไฟไหม้'); }
                        if( $item['topic8_9'] > 0 ){ array_push($topic8, 'จนท.บาดเจ็บจากการทำงาน'); }
                        if( $item['topic8_10'] > 0 ){ array_push($topic8, 'ไม่ได้เรียกเก็บค่าใช้จ่าย'); }
                        if( !empty($item['topic8_11']) ){ array_push($topic8, $item['topic8_11']); }
                        // เหตุการณ์ //

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