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
    
    $risk_list = array(
        'risk1' => 'Clinical Risk',
        'risk2' => 'Infection control Risk',
        'risk3' => 'Medication Risk',
        'risk4' => 'Medical Equipment Risk',
        'risk5' => 'Safety and Environment Risk',
        'risk6' => 'Customer Complaint Risk',
        'risk7' => 'Financial Risk',
        'risk8' => 'Utilization Management Risk',
        'risk9' => 'Information Risk'
    );

    $dmg_list = array(
        1 => 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'
    );

    $event_list = array(
        1 => 'ความปลอดภัย / ตก/ หกล้ม', 'การติดต่อสื่อสาร', 'เลือด', 'เครื่องมือ', 'การวินิจฉัย / รักษา', 'การคลอด', 'การผ่าตัด / วิสัญญี', 'อื่น ๆ' 
    );

	?>
    <div class="main-container">
		<div class="col">
			<div class="cell">
            
                <form action="report_risktopic.php" method="post">

                    <h3>ค้นหาตามช่วงระยะเวลา และชนิดความเสี่ยง</h3>
                    <?php 
                    $year_range = range('2556', get_year_checkup(true) );
                    $def_year = date('Y') + 543;
                    $def_month = date('m');

                    $year_start = input_post('year_start', $def_year);
                    $year_end = input_post('year_end', $def_year);

                    $month_start = input_post('month_start', $def_month);
                    $month_end = input_post('month_end', $def_month);
                    ?>
                    <div>
                        เลือกชนิดความเสี่ยง: 
                        <select name="risk" id="">
                            <?php 
                            $i = 0;
                            foreach ($risk_list as $key => $item) {
                                ++$i;
                                ?>
                                <option value="<?=$key;?>"><?=$i;?> <?=$item;?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        ตั้งแต่ปี <?php echo getYearList('year_start', false, $year_start, $year_range); ?>
                        เดือน <?php echo getMonthList('month_start', $month_start);?>
                    </div>
                    <div>
                        ถึงปี <?php echo getYearList('year_end', false, $year_end, $year_range); ?>
                        เดือน <?php echo getMonthList('month_end', $month_end);?>
                    </div>

                    <div>
                        <button type="submit">ค้นหา</button>
                        <input type="hidden" name="action" value="search">
                    </div>
                </form>

            </div>
        </div>



        <?php
        $action = input_post('action');
        if ( $action != false ) {

            $risk = input_post('risk');

            $year_start = input_post('year_start');
            $month_start = input_post('month_start');

            $date_start = "$year_start-$month_start";

            $year_end = input_post('year_end');
            $month_end = input_post('month_end');

            $date_end = "$year_end-$month_end";

            
            $sql = "CREATE TEMPORARY TABLE `tmp_ncr2556` 
            SELECT `nonconf_id`,`ncr`,`type`,`until`,`nonconf_date`,`nonconf_dategroup`,`nonconf_time`,`event`,`come_from_id`,`come_from_detail`,`clinic`, 
            CASE
                WHEN `topic1_1` = 1 THEN '1'
                WHEN `topic1_2` = 1 THEN '1'
                WHEN `topic1_3` = 1 THEN '1'
                WHEN `topic1_4` = 1 THEN '1'
                WHEN `topic1_5` = 1 THEN '1'
                WHEN `topic1_6` = 1 THEN '1'
                WHEN `topic1_7` IS NOT NULL AND `topic1_7` != '' THEN '1'

                WHEN `topic2_1` = 1 THEN '2'
                WHEN `topic2_2` = 1 THEN '2'
                WHEN `topic2_3` = 1 THEN '2'
                WHEN `topic2_4` = 1 THEN '2'
                WHEN `topic2_5` = 1 THEN '2'
                WHEN `topic2_6` = 1 THEN '2'
                WHEN `topic2_7` IS NOT NULL AND `topic2_7` != '' THEN '2'

                WHEN `topic3_1` = 1 THEN '3'
                WHEN `topic3_2` = 1 THEN '3'
                WHEN `topic3_3` = 1 THEN '3'
                WHEN `topic3_4` IS NOT NULL AND `topic3_4` != '' THEN '3'

                WHEN `topic4_1` = 1 THEN '4'
                WHEN `topic4_2` = 1 THEN '4'
                WHEN `topic4_3` = 1 THEN '4'
                WHEN `topic4_4` = 1 THEN '4'
                WHEN `topic4_5` = 1 THEN '4'
                WHEN `topic4_6` IS NOT NULL AND `topic4_6` != '' THEN '4'

                WHEN `topic5_1` = 1 THEN '5'
                WHEN `topic5_2` = 1 THEN '5'
                WHEN `topic5_3` = 1 THEN '5'
                WHEN `topic5_4` = 1 THEN '5'
                WHEN `topic5_5` = 1 THEN '5'
                WHEN `topic5_6` = 1 THEN '5'
                WHEN `topic5_7` = 1 THEN '5'
                WHEN `topic5_8` = 1 THEN '5'
                WHEN `topic5_9` = 1 THEN '5'
                WHEN `topic5_10` = 1 THEN '5'
                WHEN `topic5_11` IS NOT NULL AND `topic5_11` != '' THEN '5'

                WHEN `topic6_1` = 1 THEN '6'
                WHEN `topic6_2` = 1 THEN '6'
                WHEN `topic6_3` = 1 THEN '6'
                WHEN `topic6_4` = 1 THEN '6'
                WHEN `topic6_5` IS NOT NULL AND `topic6_5` != '' THEN '6'

                WHEN `topic7_1` = 1 THEN '7'
                WHEN `topic7_2` = 1 THEN '7'
                WHEN `topic7_3` = 1 THEN '7'
                WHEN `topic7_4` = 1 THEN '7'
                WHEN `topic7_5` = 1 THEN '7'
                WHEN `topic7_6` = 1 THEN '7'
                WHEN `topic7_7` IS NOT NULL AND `topic7_7` != '' THEN '7'

                WHEN `topic8_1` = 1 THEN '8'
                WHEN `topic8_2` = 1 THEN '8'
                WHEN `topic8_3` = 1 THEN '8'
                WHEN `topic8_4` = 1 THEN '8'
                WHEN `topic8_5` = 1 THEN '8'
                WHEN `topic8_6` = 1 THEN '8'
                WHEN `topic8_7` = 1 THEN '8'
                WHEN `topic8_8` = 1 THEN '8'
                WHEN `topic8_9` = 1 THEN '8'
                WHEN `topic8_10` = 1 THEN '8'
                WHEN `topic8_11` IS NOT NULL AND `topic8_11` != '' THEN '8'
                ELSE ''
            END AS `topic`
            FROM `ncr2556` 
            WHERE `nonconf_date` >= '$date_start-01' 
            AND `nonconf_date` <= '$date_end-31' 
            AND `$risk` = '1' 
            AND `clinic` != '' 
            ORDER BY `clinic` ";
            // dump($sql);
            $q = mysql_query($sql) or die( mysql_error() );

            $sql = "SELECT *, CONCAT(`topic`,`clinic`) AS `key`, COUNT(`nonconf_id`) AS `rows`
            FROM `tmp_ncr2556` 
            GROUP BY CONCAT(`topic`,`clinic`)";

            $topic_lists = array();
            $q = mysql_query($sql) or die( mysql_error() );
            while ( $item = mysql_fetch_assoc($q) ) {

                $key = $item['key'];
                $topic_lists[$key] = $item['rows'];
            }
            dump($topic_lists);


/*
- สร้าง array 2มิติ
topic[X][risk] เช่น topic1A topic1B topic1D
*/
            // dump($sql);
        }
        

        ?>
    </div>

    <?php 

    // ncr2556
    // nonconf_date
    ?>

</body>

</html>