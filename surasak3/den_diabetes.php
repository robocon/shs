<?php 
include 'bootstrap.php';

$configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'remoteuser',
    'pass' => ''
);

$db = Mysql::load($configs);
$db->exec('SET NAMES UTF-8');

$end = date('Y');
$year_range = range(2016, $end);

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

    return $pAge;
}
?>
<style>
/* ���ҧ */
body, button{
    font-family: TH SarabunPSK, TH Sarabun NEW;
    font-size: 13pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 13pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
label{
    cursor: pointer;
}
</style>
<div>
    <a href="../nindex.htm">˹����ѡ �.�.</a>
</div>
<form action="den_diabetes.php" method="post">
    <h3>�к��ʴ���ª��ͼ���������ҹ ����Ѻ�ͧ�ѹ�����</h3>

    <?php 
    $year = input_post('year_selected');
    $type = input_post('type', 1);
    ?>
    <div> 
        ���͡�� : 
        <?php 
        getYearList('year_selected', true, $year, $year_range);
        ?>
    </div>

    <div>
        <div>�Ըա�����͡������</div>
        <div>
            <?php 
            $type1_selected = ( $type == 1 ) ? 'checked="checked"' : '' ;
            ?>
            <input type="radio" name="type" id="type1" value="1" <?=$type1_selected;?>> 
            <label for="type1">Ẻ������ HN (�����ŷء���駷�������ԡ��)</label>
        </div>
        <div>
            <?php 
            $type2_selected = ( $type == 2 ) ? 'checked="checked"' : '' ;
            ?>
            <input type="radio" name="type" id="type2" value="2" <?=$type2_selected;?>> 
            <label for="type2">Ẻ��� HN (�����Ť�������ش�ͧ������)</label>
        </div>
    </div>

    <div>
        <button type="submit">�ʴ���§ҹ</button>
        <input type="hidden" name="action" value="show_data">
    </div>

</form>

<?php

$action = input_post('action');
if ( $action == 'show_data' ) {
    
    $year = input_post('year_selected');
    $type = input_post('type');

    if( $type == 1 ){
        $sql = "SELECT * 
        FROM `diabetes_clinic_history` 
        WHERE `dateN` LIKE '$year%' 
        AND `hn` <> '' 
        AND ( `bp1` <> '' AND `bp2` <> '' ) 
        AND `l_hbalc` > 0 
        -- AND ( `l_hbalc` > 0  AND `l_hbalc` < 7  ) 
        -- AND `bp1` <> '' 
        -- AND ( `bp1` < 140 AND `bp2` < 90 )";
    }else if( $type == 2 ){

        $sql = "SELECT b.* 
        FROM ( 
            SELECT MAX(`row_id`) AS `max_id`, `hn` 
            FROM `diabetes_clinic_history` 
            WHERE `dateN` LIKE '$year%' 
            GROUP BY `hn` 
        ) AS a 
        LEFT JOIN  `diabetes_clinic_history` AS b ON b.`row_id` = a.`max_id` 
        WHERE b.`hn` <> '' 
        AND ( b.`bp1` <> '' AND b.`bp2` <> '' ) 
        AND b.`l_hbalc` > 0 ";
        $db->select($sql);
        // $count_all = $db->get_rows();

        // $sql = "SELECT b.* 
        // FROM ( 
        //     SELECT MAX(`row_id`) AS `max_id`, `hn` 
        //     FROM `diabetes_clinic_history` 
        //     WHERE `dateN` LIKE '$year%' 
        //     GROUP BY `hn` 
        // ) AS a 
        // LEFT JOIN  `diabetes_clinic_history` AS b ON b.`row_id` = a.`max_id`
        // WHERE ( `l_hbalc` > 0  AND `l_hbalc` < 7  ) 
        // AND b.`bp1` <> '' 
        // AND ( b.`bp1` < 140 AND b.`bp2` < 90 ) ";

    }
    $db->select($sql);
    $items = $db->get_items();

    $cigarette_list = array(
        0 => '����ٺ������',
        1 => '�ٺ������',
        2 => 'NA',
    );

    $count_other = 0;
    $count_smoke = 0;
    $count_non_smoke = 0;

    $age_list = array();


    // �¡�������������ࡳ�� hba1c �Ѻ bp
    $criteria_pass = array();
    $criteria_not_pass = array();

    // 
    $i = 0;
    $male_rows = $female_rows = $a1c_more7 = $hba1c_rows = $bp_more_count = $bp_count = $toots_count = 0;

    foreach ($items as $key => $item) { 

        // �红�����
        $test_criteria = 0;

        if( $item['l_hbalc'] > 0 && $item['l_hbalc'] <= 7 ){
            $test_criteria++;
        }

        if ( $item['bp1'] < 140 && $item['bp2'] < 90 ) {
            $test_criteria++;
        }

        if ( $test_criteria >= 2 ) {
            $criteria_pass[] = $item;
        }else{
            $criteria_not_pass[] = $item;
        }
        // �红�����


        ++$i;

        $age = calcage($item['dbbirt']);

        $test_age = substr($age, 0, 2);
        $age_list[$test_age][] = $item['hn'];

        $cig = $item['smork'];
        if( $cig === '0' ){
            $count_non_smoke++;
        }else if( $cig === '1' ){
            $count_smoke++;
        }

        $other = '';
        if( $item['ht'] != '' ){
            $other .= 'HT, ';
        }

        if ( $item['ht_etc'] != '' ) {
            $other .= $item['ht_etc'];
        }

        if ( $other != '' ) {
            $count_other++;
        }

        if( $item['sex'] == 1 ){
            $female_rows++;
        }elseif ( $item['sex'] == 0 ) {
            $male_rows++;
        }

        if( $item['l_hbalc'] > 0 && $item['l_hbalc'] <= 7 ){
            $hba1c_rows++;
        }elseif ( $item['l_hbalc'] > 0 && $item['l_hbalc'] > 7 ) {
            $a1c_more7++;
        }

        if ( $item['bp1'] <= 140 && $item['bp2'] <= 90 ) {
            $bp_count++;
        }elseif ( $item['bp1'] > 140 && $item['bp2'] > 90 ) {
            $bp_more_count++;
        }

        if( $item['tooth'] == 1 ){
            $toots_count++;
        }

    }



    ?>

    <div width="100%" style="clear: both;">
    
        <div style="float: left; width: 50%;">

            <h3>��ª��ͼ���������ҹ ��<?=($year+543);?> ����ҹࡳ�� HBA1C < 7 ��� BP 140/90</h3>
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>����-ʡ��</th>
                    <th>��</th>
                    <th>����</th>
                    <th>HBA1C</th>
                    <th>BP</th>
                    <th>������</th>
                    <th>�ä����</th>
                </tr>
                <?php 
                $i1 = 0;
                foreach ($criteria_pass as $key => $item) { 

                    $age = calcage($item['dbbirt']);
                    $cig = $item['smork'];

                    $other = '';
                    if( $item['ht'] != '' ){
                        $other .= 'HT, ';
                    }

                    if ( $item['ht_etc'] != '' ) {
                        $other .= $item['ht_etc'];
                    }

                    ++$i1;

                    ?>
                    <tr>
                        <td><?=$i1;?></td>
                        <td><?=$item['hn'];?></td>
                        <td><?=$item['ptname'];?></td>
                        <td><?=( $item['sex'] == '1' ? '˭ԧ' : '���' );?></td>
                        <td><?=$age;?></td>
                        <td><?=$item['l_hbalc'];?></td>
                        <td><?=$item['bp1'].'/'.$item['bp2'];?></td>
                        <td><?=$cigarette_list[$cig];?></td>
                        <td><?=$other;?></td>
                    </tr>
                    <?php 

                }
                ?>
            </table>

        </div>
    
        <div style="float: left; width: 50%;">
                
            <h3>��ª��ͼ���������ҹ ��<?=($year+543);?> �������ҹࡳ��</h3>
                
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>����-ʡ��</th>
                    <th>��</th>
                    <th>����</th>
                    <th>HBA1C</th>
                    <th>BP</th>
                    <th>������</th>
                    <th>�ä����</th>
                </tr>
                <?php 
                $i2 = 0;
                foreach ($criteria_not_pass as $key => $item) { 

                    ++$i2;

                    $age = calcage($item['dbbirt']);

                    $test_age = substr($age, 0, 2);
                    $cig = $item['smork'];

                    $other = '';
                    if( $item['ht'] != '' ){
                        $other .= 'HT, ';
                    }

                    if ( $item['ht_etc'] != '' ) {
                        $other .= $item['ht_etc'];
                    }


                    ?>
                    <tr>
                        <td><?=$i2;?></td>
                        <td><?=$item['hn'];?></td>
                        <td><?=$item['ptname'];?></td>
                        <td><?=( $item['sex'] == '1' ? '˭ԧ' : '���' );?></td>
                        <td><?=$age;?></td>
                        <td><?=$item['l_hbalc'];?></td>
                        <td><?=$item['bp1'].'/'.$item['bp2'];?></td>
                        <td><?=$cigarette_list[$cig];?></td>
                        <td><?=$other;?></td>
                    </tr>
                    <?php 

                }

                $count_dm = $i - $count_other;
                ?>
            </table>


        </div>

    </div>

    <div style="clear: both;"></div>

    <br>
    <div style="clear: both;">
    
        <table class="chk_table">
            
            <tr>
                <th>��ṡ�����¡��</th>
                <th>�ӹǹ���</th>
            </tr>

            <tr>
                <td>�ӹǹ������ ������ </td>
                <td align="right"><?=$i;?></td>
            </tr>

            <tr>
                <td>�ӹǹ������ DM ���ҧ����</td>
                <td align="right"><?=$count_dm;?></td>
            </tr>
            <tr>
                <td>�ӹǹ������ DM ������ä����</td>
                <td align="right"><?=$count_other;?></td>
            </tr>
            <tr>
                <td>�ӹǹ������ ����ٺ������</td>
                <td align="right"><?=$count_smoke;?></td>
            </tr>
            <tr>
                <td>�ӹǹ������ �������ٺ������</td>
                <td align="right"><?=$count_non_smoke;?></td>
            </tr>
            
            <tr>
                <td>�ӹǹ������ �������բ������ٺ������</td>
                <td align="right"><?=( $i - ( $count_smoke + $count_non_smoke ) );?></td>
            </tr>

            <tr>
                <td>�� ���</td>
                <td align="right"><?=$male_rows;?></td>
            </tr>
            <tr>
                <td>�� ˭ԧ</td>
                <td align="right"><?=$female_rows;?></td>
            </tr>
            <tr>
                <td>�ӹǹ������ HBA1C �����¡���������ҡѺ 7</td>
                <td align="right"><?=$hba1c_rows;?></td>
            </tr>
            <tr>
                <td>�ӹǹ������ HBA1C �ҡ���� 7</td>
                <td align="right"><?=$a1c_more7;?></td>
            </tr>
            <tr>
                <td>�ӹǹ�����·�� BP ���¡���������ҡѺ 140/90</td>
                <td align="right"><?=$bp_count;?></td>
            </tr>
            <tr>
                <td>�ӹǹ�����·�� BP �ҡ���� 140/90</td>
                <td align="right"><?=$bp_more_count;?></td>
            </tr>
            <tr>
                <td>�ӹǹ�����·���Ǩ�ѹ</td>
                <td align="right"><?=$toots_count;?></td>
            </tr>

        </table>
    </div>
    <br>
    <table class="chk_table">
        <tr>
            <th>��ṡ�������</th>
            <th>�ӹǹ���</th>
        </tr>
        <?php 
        ksort($age_list);
        foreach ($age_list as $key => $age) {
            ?>
            <tr>
                <td>�ӹǹ���������� <?=$key;?>��</td>
                <td align="center"><?=count($age);?></td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php
    

}

