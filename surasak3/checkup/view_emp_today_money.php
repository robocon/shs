<?php 
include '../bootstrap.php';

/**
 * @todo
 * - ทะเบียน
 * - lab 
 * - ซักประวัติ
 * - แพทย์
 */

$shs_configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottow',
    'pass' => ''
);

$db = Mysql::load($shs_configs);
// $db->exec("SET NAMES UTF8");

$sql = "SELECT z.`HN` AS `pre_hn`, CONCAT(z.`name`,' ',z.`surname`) AS `pre_name`, 
b.`row_id`,b.`thidate`,z.`HN` AS `hn`, CONCAT(z.`name`,' ',z.`surname`) AS `ptname`,b.`vn` AS `regis_vn`,b.`toborow`,c.`vn` AS `vs_vn`,z.`agey` AS `age` ,
CONCAT(SUBSTRING(b.`thidate`,1,10),b.`hn`) AS `date_hn_bc`,
CONCAT((SUBSTRING(b.`thidate`,1,4) - 543),SUBSTRING(b.`thidate`,5,6),b.`hn`) AS `date_hn_ad`,
d.`employee`,
c.`camp`,c.`yearchk`,c.`weight`,c.`height`,c.`bmi`,c.`bp1`,c.`bp2`,
e.`date_chk`,e.`doctor`,
e.`cxr`,e.`res_cbc`,e.`res_ua`,e.`res_glu`,e.`res_crea`,e.`res_chol`,e.`res_hdl`,e.`res_hbsag`, 
e.`conclution`,e.`normal_suggest`,e.`normal_suggest_date`,e.`abnormal_suggest`,e.`abnormal_suggest_date`,e.`diag` 

FROM (
	SELECT *,CONCAT('2019',`HN`) AS `year_hn` FROM `opcardchk` WHERE `part` = 'ลูกจ้าง62' 
) AS z 
LEFT JOIN ( 
	SELECT *,CONCAT(SUBSTRING(`thidate`,1,4),`hn`) AS `year_hn` FROM `dxofyear_out` 
) AS c ON c.`year_hn` = z.`year_hn` 

LEFT JOIN ( 

	SELECT y.`row_id`,y.`thidate`,y.`thdatehn`,y.`hn`,y.`vn`,y.`thdatevn`,y.`ptname`,y.`age`,y.`ptright`,y.`idcard`,
	y.`toborow`,y.`officer`,CONCAT('2019',y.`hn`) AS `year_hn`
	FROM ( 
		SELECT MAX(`row_id`) AS `row_id` 
		FROM `opday` 
		WHERE `thidate` >= '2562-04-01 00:00:00' AND `thidate` <= '2562-05-10 23:23:59' 
		GROUP BY `hn` 
	) AS x 
	LEFT JOIN `opday` AS y ON x.`row_id` = y.`row_id` 
	
) AS b ON b.`year_hn` = z.`year_hn` 

LEFT JOIN `opcard` AS d ON d.`hn` = z.`HN` 
LEFT JOIN ( 
	SELECT * FROM `chk_doctor` WHERE `date_chk` >= '2019-04-01 00:00:00' AND `date_chk` <= '2019-05-10 23:23:59' 
) AS e ON e.`hn` = z.`HN` 
WHERE e.`date_chk` IS NOT NULL 
ORDER BY z.`row` ASC ";

$db->select($sql);
$items = $db->get_items();

?>

<style>
*{
    font-family:"TH Sarabun New","TH SarabunPSK";
    font-size: 12pt;
}

.chk_table{
    border-collapse: collapse;
}

.chk_table th{
    text-align: center;
}

.chk_table, th, td{
    border: 1px solid black;
    padding: 3px;
}
</style>

<div>
    <h3>สรุปผลตรวจสุขภาพลูกจ้างชั่วคราว ปี2562 (ช่วงทดสอบ)</h3>
    <div style="border: 2px solid #7e7e00; background-color: #fefed3; padding: 4px; margin: 4px;">
        <p><b>!!! READ ME !!!</b></p>
        <ul>
            <li><span style="color: #ccca00;"><b><u>สีเหลือง</u></b></span> ขาดสรุปผลจากแพทย์</li>
            <li><span style="color: #ff9c9c;"><b><u>สีแดง</u></b></span> ขาดข้อมูลซักประวัติ และ การสรุปผลจากแพทย์</li>
            <li><span style="color: #d800f9;"><b><u>สีม่วง</u></b></span> ไม่พบการลงทะเบียน</li>
            <li><span><b><u>สถานะลูกจ้าง</u></b></span> y: มีการยืนยันสถานะจากทะเบียน n: ยังไม่มีการยืนยันจากทะเบียน</li>
            <li><span><b><u>แพทย์</u></b></span> คือ แพทย์ผู้สรุปผลตรวจ</li>
        </ul>
    </div>
    <table class="chk_table" width="200%">
        <tr>
            <th rowspan="2">#</th>
            <th rowspan="2">HN</th>
            <th rowspan="2">ชื่อ-สกุล</th>
            <th colspan="14">รายการตรวจ</th>
        </tr>
        <tr>
            <th>X-RAY</th>
            <th>CBC</th>
            <th>UA</th>
            <th>GLU</th>
            <th>CR</th>
            <th>CHOL</th>
            <th>HDL</th>
            <th>HBsAg</th>
            <th>FOBT</th>
            <th>LDL</th>
            <th>BUN</th>
            <th>SGOT</th>
            <th>SGPT</th>
            <th>ALK</th>
        </tr>
        <?php 

        $i = 1;
        foreach ($items as $key => $item) { 

            $style = '';
            $regis_warn = '';

            $test_camp = preg_match('/(ลูกจ้าง|ตรวจสุขภาพ)/', $item['camp'], $matchs);
            
            // ถ้าสถานะไม่ใช่ลูกจ้างแต่มีการตรวจ
            if( $item['employee'] == 'n' && $test_camp > 0 ){
                $regis_warn = 'style="background-color: #fffea7;"';

            }
            
            // ขาดลงผลจากแพทย์ (เหลือง)
            if( !is_null($item['yearchk']) && is_null($item['doctor']) ){
                $style = 'style="background-color: #fffea7;"';

            }elseif ( is_null($item['yearchk']) && is_null($item['doctor']) ) { // ขาดซักประวัติ และ ลงผลจากแพทย์ (แดง)
                $style = 'style="background-color: #ff9c9c;"';

            }
            
            if ( is_null($item['row_id']) ) { // ขาดตั้งแต่ลงทะเบียน (ม่วง)
                $style = 'style="background-color: #d800f9;"';
            }

            $age = substr($item['age'], 0, 2);

            $bp1 = $item['bp1'];
            $bp2 = $item['bp2'];

            if( !empty($item['bp21']) && $item['bp21'] != '-' ){
                $bp1 = $item['bp21'];
            } 
            if( !empty($item['bp22']) && $item['bp22'] != '-' ){
                $bp2 = $item['bp22'];
            }

            // dump($item['hn']);

            // สรุปผลจาก conclution ที่แพทย์ลง
            $conclution = $item['conclution'];
            $suggest_date = '';
            if( $conclution == 1 ){
                $suggest_list = array(
                    1 => 'ไม่ได้ให้คำแนะนำ', 
                    'แนะนำให้รับการตรวจต่อเนื่อง ครั้งต่อไป'
                );

                $suggest = $item['normal_suggest'];
                $suggest_date = ( $item['normal_suggest_date'] != NULL && $item['normal_suggest_date'] != "0000-00-00" ) ? 'ในวันที่ '.$item['normal_suggest_date'] : '' ;

                // dump($item['normal_suggest_date']);
                
            }else{
                $suggest_list = array(
                    1 => 'ไม่ได้ให้คำแนะนำ', 
                    'ให้คำแนะนำในการตรวจติดตาม/ตรวจซ้ำ ครั้งต่อไป', 
                    'ให้คำแนะนำเข้ารับการรักษากรณีเจ็บป่วยโดยนัดเข้ารับบริการ', 
                    'ให้คำแนะนำเข้ารักการรักษากรณีภาวะแทรกซ้อนจากโรคเรื้อรัง'
                );

                $suggest = $item['abnormal_suggest'];
                $suggest_date = ( $item['abnormal_suggest_date'] != NULL && $item['abnormal_suggest_date'] != "0000-00-00" ) ? 'ในวันที่ '.$item['abnormal_suggest_date'] : '' ;
                
                // dump($item['abnormal_suggest_date']);
            }

            // echo "<hr>";

            $suggest_detail = $suggest_list[$suggest];
            $conclution_detail = $suggest_detail.$suggest_date;

            $yearchk = $item['yearchk'];
            $hn = $item['hn'];
            // ผลตรวจตัวอื่นๆ
            $sql = "SELECT b.* 
            FROM ( 

                SELECT MAX(`autonumber`) AS `latest_number` 
                FROM `resulthead` 
                WHERE `hn` = '$hn' 
                AND `orderdate` LIKE '2019-04%' 
                AND ( `profilecode` != 'CBC' AND `profilecode` != 'UA' )
                AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี62' 
                GROUP BY `profilecode` 
                ORDER BY `autonumber` ASC 

            ) AS a 
                RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
            WHERE b.`autonumber` = a.`latest_number` 
            AND ( 
                b.`labcode` = 'GLU' 
                OR b.`labcode` = 'CREA' 
                OR b.`labcode` = 'CHOL' 
                OR b.`labcode` = 'HDL' 
                OR b.`labcode` = 'HBSAG' 
                OR b.`labcode` = 'OCCULT' 
                OR b.`labcode` = '38302' 
                OR b.`labcode` = 'LDL' 
                OR b.`labcode` = 'BUN' 
                OR b.`labcode` = 'CR' 
                OR b.`labcode` = 'AST' 
                OR b.`labcode` = 'ALT' 
                OR b.`labcode` = 'ALP' 
            ) 
            ORDER BY b.seq ASC ";

            $db->select($sql);
            $etc_items = $db->get_items();
            
            $etc = array();
            foreach ($etc_items as $key => $lab_item) {
                $labcode = strtolower($lab_item['labcode']);
                $etc[$labcode] = array(
                    'result' => $lab_item['result'], 
                    'normalrange' => $lab_item['normalrange'],
                    'flag' => $lab_item['flag']
                );
            }

            ?>
            <tr <?=$style;?>>
                <td><?=$i;?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>


                <td>
                    <?php 
                    if ( $item['cxr'] == '1' ) {
                        echo 'ปกติ';
                    }elseif ( $item['cxr'] == '2' ) {
                        echo 'ผิดปกติ';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if( $item['res_cbc'] == '1' ){
                        echo "ปกติ";
                    }else if( $item['res_cbc'] == '2' ){
                        echo "ผิดปกติ";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if( $item['res_ua'] == '1' ){
                        echo "ปกติ";
                    }else if( $item['res_ua'] == '2' ){
                        echo "ผิดปกติ";
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['glu']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['glu']['normalrange'];?>"><?=$etc['glu']['result'];?></span>
                    </td>
                    <td align="right">
                    <?php 
                    $style = '';
                    if( $etc['crea']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['crea']['normalrange'];?>"><?=$etc['crea']['result'];?></span>
                </td>
                <td align="right">
                    <?php 
                    $style = '';
                    if( $etc['chol']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['chol']['normalrange'];?>"><?=$etc['chol']['result'];?></span>
                </td>
                <td align="right">
                    <?php 
                    $style = '';
                    if( $etc['hdl']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['hdl']['normalrange'];?>"><?=$etc['hdl']['result'];?></span> 
                </td>
                <td>
                    <?php
                    if( $etc['hbsag']['result'] == 'Negative' ){
                        echo 'ไม่พบเชื้อ';
                    }elseif ( $etc['hbsag']['result'] == 'Positive' ) {
                        echo 'พบเชื้อ';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if( $etc['occult']['result'] == 'Negative' ){
                        echo 'ไม่พบเลือด';
                    }elseif ( $etc['occult']['result'] == 'Positive' ) {
                        echo 'พบเลือด';
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['ldl']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['ldl']['normalrange'];?>"><?=$etc['ldl']['result'];?></span>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['bun']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['bun']['normalrange'];?>"><?=$etc['bun']['result'];?></span>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['ast']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['ast']['normalrange'];?>"><?=$etc['ast']['result'];?></span>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['alt']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['alt']['normalrange'];?>"><?=$etc['alt']['result'];?></span>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['alp']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['alp']['normalrange'];?>"><?=$etc['alp']['result'];?></span>
                </td>





            </tr>


            <?php 
            $i++;
        }
        ?>
    </table>
</div>
<?php 