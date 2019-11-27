<?php 
include 'bootstrap.php';

$db = Mysql::load();
if( $_SESSION["smenucode"] != 'ADM' && ( $_SESSION["smenucode"] != 'ADMSSO' && $_SESSION['sIdname'] != '�����1' ) ){
    echo "�������ö�����ҹ��";
    exit;
}

?>
<style>
/* ���ҧ */
body, button{
    font-family: "TH SarabunPSK", "TH Sarabun New";
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}
.chk_table th{
    background-color: #b5b5b5;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
    font-size: 16pt;
}
</style>
<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;��Ѻ˹����ѡ �.�.</a> | <a href="doctor_order_drug.php">��������</a> | <a href="doctor_order_drug2.php">�������ҷ������Ť�ҡ�����٧</a> | <a href="doctor_order_drug3.php">�����š�è���������� 3 ��͹��͹��ѧ</a>
</div>
<div>
    <h3>�������ҷ������Ť�ҡ�����٧</h3>
</div>
<fieldset>
    <legend>���͡�����Ŵ��ҷ������Ť���٧</legend>

    <form action="doctor_order_drug2.php" method="post">
        <div>
            ��͹-�� �������� 
            <?php 

            $start_month = input_post('start_month', date('m'));
            $start_year = input_post('start_year', (date('Y')+543));

            $end_month = input_post('end_month', date('m'));
            $end_year = input_post('end_year', (date('Y')+543));

            getMonthList('start_month',$start_month);

            getYearList('start_year', false, $start_year, range('2555', (date('Y')+543) ));
            ?>
        </div>
        <div>
            ��͹-�� �������ش
            <?php 
            getMonthList('end_month',$end_month);

            getYearList('end_year', false, $end_year, range('2555', (date('Y')+543) ));
            ?>
        </div>
        <div>
            ᾷ�� 
            <?php 
            $sql = "SELECT CONCAT(a.`yot`,b.`name`) AS `doctor_name`,a.`doctorcode`, b.`name` 
            FROM `doctor` AS a 
            LEFT JOIN `inputm` AS b ON b.`codedoctor` = a.`doctorcode`
            WHERE a.`status` = 'y' 
            AND ( a.`menucode` = 'ADM' OR a.`menucode` = 'ADMNID' ) 
            AND ( 
                a.`doctorcode` IS NOT NULL 
                AND a.`doctorcode` != '00000' 
                AND a.`doctorcode` != '0000' 
            ) 
            AND ( b.`name` NOT REGEXP '^HD' AND b.`name` NOT REGEXP '^NID' ) 
            ORDER BY a.`row_id` ";
            $db->select($sql);
            $items = $db->get_items();
            ?>

                <select name="doctor_code" id="">
                    <option value="">���͡ᾷ��</option>
                    <?php 
                    foreach ($items as $key => $item) {
                        ?>
                        <option value="<?=$item['doctorcode'];?>"><?=$item['name'];?></option>
                        <?php
                    }
                    ?>
                </select>

        </div>
        <div>
            <button>�ʴ�������</button>
            <input type="hidden" name="action" value="show">
        </div>
    </form>

</fieldset>
<?php

$action = input_post('action');
if ( $action == 'show' ) {
    

    $start_month = input_post('start_month');
    $start_year = input_post('start_year');

    $end_month = input_post('end_month');
    $end_year = input_post('end_year');

    $end_day_ofmonth = date('t', "$end_year-$end_month-01");

    $doctor_code = input_post('doctor_code');

    if ( empty($doctor_code) ) {
        echo "��س����͡ᾷ��";
        exit;
    }

    $sql = "SELECT CONCAT(a.`yot`,b.`name`) AS `doctor_name`,a.`doctorcode`, b.`name` 
    FROM `doctor` AS a 
    LEFT JOIN `inputm` AS b ON b.`codedoctor` = a.`doctorcode`
    WHERE a.`status` = 'y' 
    AND ( a.`menucode` = 'ADM' OR a.`menucode` = 'ADMNID' ) 
    AND ( 
        a.`doctorcode` IS NOT NULL 
        AND a.`doctorcode` != '00000' 
        AND a.`doctorcode` != '0000' 
    ) 
    AND ( b.`name` NOT REGEXP '^HD' AND b.`name` NOT REGEXP '^NID' ) 
    AND a.`doctorcode` = '$doctor_code' 
    ORDER BY a.`row_id` ";
    $db->select($sql);
    $dt = $db->get_item();

    $sql = "SELECT a.`ptname`,a.`date`, 
    b.`hn`, b.`drugcode`, b.`tradname`, c.`salepri`,b.`amount`, b.`price`, b.`part`,
    c.`row_id`, c.`unit`,a.`cashok`,a.`year_month`,a.`super_id` 
    FROM ( 
        SELECT *, 
        CONCAT(SUBSTRING(`date`,1,7)) AS `year_month`, 
        CONCAT(SUBSTRING(`date`,1,10),`hn`,`tvn`) AS `super_id` 
        FROM `phardep` 
        WHERE `ptright` LIKE 'R07%' 
        AND `date` >= '$start_year-$start_month-01 00:00:00' AND `date` <= '$end_year-$end_month-$end_day_ofmonth 23:59:59' 
        AND `doctor` LIKE '%$doctor_code%' 
        AND ( `chktranx` IS NOT NULL AND `borrow` IS NULL )
        AND ( `an` IS NULL )
        ORDER BY `row_id` ASC 
    ) AS a 
    LEFT JOIN `drugrx` AS b ON b.`idno` = a.`row_id` 
    LEFT JOIN ( 
    
        SELECT * 
        FROM `druglst` 
        WHERE `part` LIKE 'DD%' 
        AND `salepri` >= 5 
        AND `drugcode` NOT IN ('1KALE* �','20KALE � �','30LP200_RT','1TEEV','20STEEV','30TEEV','1GPO30* �','20SGPO30','20SGPO40','20GPOZ250','30GPOZ250','1EPIV-C* �','20S3TC','30LAM_150','30LAM_300','20VIRE','20SZIL','20KALE    ','20STOC  ') AND (`drugcode` NOT LIKE  '20%' AND  `drugcode` NOT LIKE  '30%')
    ) AS c ON c.`drugcode` = b.`drugcode`
    WHERE c.`row_id` IS NOT NULL ";
	
    $db->select($sql);

    $drug_list = $db->get_items();
    ?>
    <div>
        <h3>��¡���ҷ������Ť���٧�ͧᾷ�� <?=$dt['name'];?> ����� <?=$def_fullm_th[$start_month].' '.$start_year;?> �֧ <?=$def_fullm_th[$end_month].' '.$end_year;?></h3>
    </div>
    <table class="chk_table">
        <tr>
            <th>#</th>
            <th>�ѹ���</th>
            <th>HN</th>
            <th>����-ʡ��</th>
            <th>������</th>
            <th>Trade name</th>
            <th>�Ҥҵ��˹���</th>
            <th>˹��¹Ѻ</th>
            <th>�ӹǹ������</th>
            <th>����Ҥ�</th>
            <th>㹺ѭ��/�͡�ѭ��</th>
            <th>��è���</th>
        </tr>
        <?php 
        $i = 1; 
        $late_user_id = '';

        $hn_i = 1;

        $all_items = array();
        foreach ($drug_list as $key => $d) {

            $c = '';
            if( $i % 2 == 0 ){
                $c = 'style="background-color: #dddddd;"';
            }

            $hn = $d['super_id'];
            $ptname = $d['ptname'];

            $test_ym = $d['year_month'];
            if( $test_ym == $late_month ){
                if ($hn != $late_user_id) {
                    $hn_i++;
                }
                
                $ym_price += $d['price'];
            }else{
                $hn_i = 1;
                $ym_price = $d['price'];
            }

            ?>
            <tr <?=$c;?> >
                <td align="right"><?=$i;?></td>
                <td><?=$d['date'];?></td>
                <td><?=$d['hn'];?></td>
                <td><?=$ptname;?></td>
                <td><?=$d['drugcode'];?></td>
                <td><?=$d['tradname'];?></td>
                <td align="right"><?=number_format($d['salepri'],2);?></td>
                <td><?=$d['unit'];?></td>
                <td align="right"><?=$d['amount'];?></td>
                <td align="right"><?=number_format($d['price'],2);?></td>
                <td>
                <?php 
                if( $d['part'] == 'DDL' ){
                    echo '㹺ѭ������ѡ';
                }elseif( $d['part'] == 'DDY' OR $d['part'] == 'DDN' ){

                    $dd = '';
                    if ( $d['part'] == 'DDY' ) {
                        $dd = '(�ԡ��)';
                    }elseif( $d['part'] == 'DDN' ) {
                        $dd = '(�ԡ�����)';
                    }

                    echo '<span style="color: #b5b500;">�͡�ѭ������ѡ '.$dd.'</span>';
                }
                ?>
                </td>
                <td><?=$d['cashok'];?></td>
            </tr>
            <?php 
            $i++;
            // $hn_i++;

            $all_items[$test_ym] = array(
                'vn' => $hn_i,
                'sum' => $ym_price
            );

            $late_user_id = $d['super_id'];
            $late_month = $d['year_month'];
        }
        ?>

    </table>
    <br>
    <br>
    <?php 
    dump($all_items);
/*
$sql = "SELECT a.`ptname`,a.`date`, 
b.`hn`, b.`drugcode`, b.`tradname`, c.`salepri`,b.`amount`, b.`price`, b.`part`,
c.`row_id`, c.`unit`,a.`cashok`
FROM ( 
    SELECT * 
    FROM `phardep` 
    WHERE `ptright` LIKE 'R07%' 
    AND `date` >= '$start_year-$start_month-01 00:00:00' AND `date` <= '$end_year-$end_month-$end_day_ofmonth 23:59:59' 
    AND `doctor` LIKE '%$doctor_code%' 
    AND (`an` IS NULL || `an`='') 
    ORDER BY `row_id` ASC 
) AS a 
LEFT JOIN ( 
    SELECT *,(`price`/`amount`) AS `saleprice`
    FROM `drugrx` 
    WHERE `date` >= '$start_year-$start_month-01 00:00:00' AND `date` <= '$end_year-$end_month-$end_day_ofmonth 23:59:59' 
    AND `part` LIKE 'DD%' 
    AND ( 
        `drugcode` NOT IN ('1KALE* �','20KALE � �','30LP200_RT','1TEEV','20STEEV','30TEEV','1GPO30* �','20SGPO30','20SGPO40','20GPOZ250','30GPOZ250','1EPIV-C* �','20S3TC','30LAM_150','30LAM_300','20VIRE','20SZIL','20KALE    ','20STOC  ') 
        AND `drugcode` NOT LIKE '20%' 
        AND `drugcode` NOT LIKE '30%' 
    )

 ) AS b ON b.`idno` = a.`row_id` 
WHERE b.`row_id` IS NOT NULL 
AND b.`saleprice` > 5 ";
dump($sql);
    $db->select($sql);
    $items = $db->get_items();
    */
    $items = array();
    ?>
    <table class="chk_table">
        <tr>
            <th>��͹/��</th>
            <th>�ӹǹ�����¹͡�����͹(vn)</th>
            <th>����Ҥ���(�ҷ)</th>
        </tr>
        <?php 
        foreach ($items as $key => $item) {
            list($year,$m) = explode('-',$item['year_month']);
            ?>
            <tr>
                <td><?=$def_fullm_th[$m];?> / <?=$year;?></td>
                <td align="right"><?=$item['all_pt'];?></td>
                <td align="right"><?=number_format($item['total'],2);?></td>
            </tr>
            <?php
        }
        ?>
        
    </table>
    <?php

}

