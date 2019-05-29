<?php 
include '../bootstrap.php';

$shs_configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottow',
    'pass' => ''
);

$db = Mysql::load($shs_configs);
// $db->exec("SET NAMES UTF8");

$view = $_GET['view'];
$where_branch = '';
$branch_header = '';

if ( $view == 'type1' ) {
    $where_branch = 'นวดแผนไทย';
    $branch_header = " ($where_branch)";

}elseif ( $view == 'type2' ) {
    $where_branch = 'ไตเทียม';
    $branch_header = " ($where_branch)";;

}


$sql = "SELECT a.*,b.`txdate` 
FROM ( 
    SELECT `HN` AS `hn` ,`idcard`,CONCAT(`name`,' ',`surname`) AS `ptname` ,`agey`,CONCAT('2019',`HN`) AS `year_hn` 
    FROM `opcardchk` 
    WHERE `part` = 'ลูกจ้าง62' 
    AND `branch` = '$where_branch' 
    ORDER BY `row` ASC 
) AS a 
LEFT JOIN ( 
    SELECT `date`,`txdate`,`credit`,`hn` FROM `opacc` WHERE `credit` = 'SSOCHKUP62' AND `depart` = 'PATHO' GROUP BY `hn` 
) AS b ON b.`hn` = a.`hn` ";
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

@media print{
    .disable_div{
        display: none;
    }
}
</style>
<div class="disable_div">
    <a href="view_emp_today_money.php">ลูกจ้าง</a> | 
    <a href="view_emp_today_money.php?view=type1">นวดแผนไทย</a> | 
    <a href="view_emp_today_money.php?view=type2">ไตเทียม</a> | 
</div>
<div>
    <h3>ตรวจสุขภาพลูกจ้างชั่วคราว<?=$branch_header;?> ปี2562</h3>

    <table class="chk_table" >
        <tr>
            <th rowspan="2">#</th>
            <th rowspan="2">HN</th>
            <th rowspan="2">ชื่อ-สกุล</th>
            <th colspan="14">รายการตรวจ</th>
            <th rowspan="2">รวม</th>
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

        $item_lab = array(

            'CBC',
            'UA',
            'BS',
            'CR',
            'CHOL',
            'HDL',
            'HBsAg',
            'FOBT',
            'LDL',
            'BUN',
            'SGOT',
            'SGPT',
            'ALK'

        );

        $i = 1;

        $overall_price = 0;
        foreach ($items as $key => $item) { 

            $total_price = 0;

            $style = '';
            $regis_warn = '';

            
            
            $yearchk = $item['yearchk'];
            $hn = $item['hn'];
            $txdate = $item['txdate'];

            $pat_sql = "SELECT `code`,`detail`,`price` FROM `patdata` WHERE `date` = '$txdate' AND `hn` = '$hn' ";
            $db->select($pat_sql);
            $pat_list = array();

            if( $db->get_rows() > 0 ){
                $pats = $db->get_items();
                foreach ($pats as $key => $pat_item) {
                    $code = trim($pat_item['code']);
                    $price = $pat_item['price'];
                    $pat_list[$code] = $price;
                }
            }


            $xray_sql = "SELECT `price` FROM `opacc` WHERE `credit` = 'SSOCHKUP62' AND `depart` = 'XRAY' AND `hn` = '$hn' ";
            $db->select($xray_sql);
            $xray_price = '';
            if ($db->get_rows() > 0) {
                $xray = $db->get_item();
                $xray_price = $xray['price'];

                $total_price += $xray_price;
            }
            
            ?>
            <tr <?=$style;?>>
                <td><?=$i;?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>

                <td><?=$xray_price;?></td>
                <?php 
                foreach ($item_lab as $key => $value) {

                    $total_price += $pat_list[$value];
                    
                    ?>
                    <td style="text-align: right;"><?=$pat_list[$value];?></td>
                    <?php
                }
                ?>

                <td style="text-align: right;"><?=number_format($total_price,2);?></td>
            </tr>
            
            <?php 

            $overall_price += $total_price;

            $i++;
        }
        ?>
        <tr>
            <td colspan="17">สรุปยอด</td>
            <td style="text-align: right;"><?=number_format($overall_price,2);?></td>
        </tr>
    </table>
</div>
<?php 