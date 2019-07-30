<?php 
include 'bootstrap.php';

$db = Mysql::load($shs_configs);
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
    <h3>�٢�������</h3>
</div>
<fieldset>
    <legend>���͡�����Ŵ���</legend>

    <form action="doctor_order_drug.php" method="post">
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

    $sql = "select a.ptname,a.date, 
    b.hn, b.drugcode, b.tradname, b.amount, b.price, b.part
    from phardep as a 
    left join drugrx as b on b.idno = a.row_id 
    where a.ptright like 'R07%' 
    and b.part like 'dd%' 
    and a.date >= '$start_year-$start_month-01 00:00:00' and a.date <= '$end_year-$end_month-$end_day_ofmonth 23:59:59' 
    and a.doctor like '%$doctor_code%' 
    and (a.an is null || a.an='') and (b.drugcode NOT LIKE '20%' AND b.drugcode NOT LIKE '30%') ";
    $db->select($sql);
	//echo $sql;

    $drug_list = $db->get_items();
    ?>
    <div>
        <h3>��¡���ҷ����觢ͧᾷ�� <?=$dt['name'];?> ����� <?=$def_fullm_th[$start_month].' '.$start_year;?> �֧ <?=$def_fullm_th[$end_month].' '.$end_year;?></h3>
    </div>
    <table class="chk_table">
        <tr>
            <th>#</th>
            <th>�ѹ���</th>
            <th>HN</th>
            <th>����-ʡ��</th>
            <th>������</th>
            <th>Trade name</th>
            <th>�ӹǹ������</th>
            <th>����Ҥ�</th>
            <th>㹺ѭ��/�͡�ѭ��</th>
        </tr>
        <?php 
        $i = 1; 
        $late_user_id = '';

        $hn_i = 1;
        $test_count_hn = array();
        foreach ($drug_list as $key => $d) {

            $c = '';
            if( $i % 2 == 0 ){
                $c = 'style="background-color: #dddddd;"';
            }

            $hn = $d['hn'];
            $ptname = $d['ptname'];

            ?>
            <tr <?=$c;?> >
                <td align="right"><?=$i;?></td>
                <td><?=$d['date'];?></td>
                <td><?=$hn;?></td>
                <td><?=$ptname;?></td>
                <td><?=$d['drugcode'];?></td>
                <td><?=$d['tradname'];?></td>
                <td align="right"><?=$d['amount'];?></td>
                <td align="right"><?=$d['price'];?></td>
                <td>
                <?php 
                if( $d['part'] == 'DDL' ){
                    echo '㹺ѭ������ѡ';
                }elseif( $d['part'] == 'DDY' OR $d['part'] == 'DDN' ){

                    $dd = '';
                    // if ( $d['part'] == 'DDY' ) {
                    //     $dd = '(�ԡ��)';
                    // }elseif( $d['part'] == 'DDN' ) {
                    //     $dd = '(�ԡ�����)';
                    // }

                    echo '<span style="color: #b5b500;">�͡�ѭ������ѡ '.$dd.'</span>';
                }
                ?>
                </td>
            </tr>
            <?php 
            $i++;
            $hn_i++;

            $late_user_id = $d['hn'];
            $late_month = $d['month'];
        }
        ?>

    </table>
    <br>
    <br>
    <?php
    $sql = "SELECT b.`year_month`,count(b.`hn`) AS `all_pt`,sum(b.`price`) AS `total` 
    FROM (
        SELECT a.`date`,a.`hn`,a.`an`,a.`tvn`,a.`ptright`,a.`doctor`,a.`price`,
        CONCAT(SUBSTRING(a.`date`,1,7)) AS `year_month`,CONCAT(SUBSTRING(a.`date`,1,10),a.`hn`,a.`tvn`) AS `super_id` 
        FROM `phardep` as a 
        WHERE a.`ptright` LIKE 'R07%' 
        AND a.`date` >= '$start_year-$start_month-01 00:00:00' AND a.`date` <= '$end_year-$end_month-$end_day_ofmonth 23:59:59' 
        AND a.`doctor` LIKE '%$doctor_code%' 
        AND (a.`an` is null || a.`an` ='') 
        GROUP BY CONCAT(SUBSTRING(a.`date`,1,10),a.`hn`,a.`tvn`)
    ) AS b GROUP BY b.`year_month` ";
	//echo $sql;
    $db->select($sql);
    $items = $db->get_items();

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

