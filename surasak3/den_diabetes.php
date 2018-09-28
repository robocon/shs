<?php 
include 'bootstrap.php';

$configs = array(
    'host' => '192.168.1.2',
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
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
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
            <label for="type1">Ẻ������ HN</label>
        </div>
        <div>
            <?php 
            $type2_selected = ( $type == 2 ) ? 'checked="checked"' : '' ;
            ?>
            <input type="radio" name="type" id="type2" value="2" <?=$type2_selected;?>> 
            <label for="type2">Ẻ��� HN</label>
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
        AND `l_hbalc` < 7 
        AND `bp1` <> '' 
        AND ( `bp1` < 140 AND `bp2` < 90 )";
    }else if( $type == 2 ){
        $sql = "SELECT b.* 
        FROM ( 
            SELECT MAX(`row_id`) AS `max_id`, `hn` 
            FROM `diabetes_clinic_history` 
            WHERE `dateN` LIKE '$year%' 
            GROUP BY `hn` 
        ) AS a 
        LEFT JOIN  `diabetes_clinic_history` AS b ON b.`row_id` = a.`max_id`
        WHERE b.`l_hbalc` < 7 
        AND b.`bp1` <> '' 
        AND ( b.`bp1` < 140 AND b.`bp2` < 90 ) ORDER BY `hn`";
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
    ?>
    <h3>��ª��ͼ���������ҹ ��<?=($year+543);?></h3>
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
        $i = 0;
        $male_rows = $female_rows = 0;
        $hba1c_rows = 0;
        $bp_count = 0;
        $toots_count = 0;
        foreach ($items as $key => $item) { 

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
                $other .= '�ä���� HT, ';
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

            if( $item['l_hbalc'] != '' && $item['l_hbalc'] > 0 ){
                $hba1c_rows++;
            }

            if ( $item['bp1'] && $item['bp2'] ) {
                $bp_count++;
            }

            if( $item['tooth'] == 1 ){
                $toots_count++;
            }

            ?>
            <tr>
                <td><?=$i;?></td>
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
    <br>
    <table class="chk_table">
        <tr>
            <td>�ӹǹ������ DM</td>
            <td><?=$count_dm;?> ���</td>
        </tr>
        <tr>
            <td>�ӹǹ������ DM ������ä����</td>
            <td><?=$count_other;?> ���</td>
        </tr>
        <tr>
            <td>�ӹǹ������ ����ٺ������</td>
            <td><?=$count_smoke;?> ���</td>
        </tr>
        <tr>
            <td>�ӹǹ������ �������ٺ������</td>
            <td><?=$count_non_smoke;?> ���</td>
        </tr>
        <tr>
            <td>�� ���</td>
            <td><?=$male_rows;?> ���</td>
        </tr>
        <tr>
            <td>�� ˭ԧ</td>
            <td><?=$female_rows;?> ���</td>
        </tr>
        <tr>
            <td>�ӹǹ������ HBA1C �����¡��� 7</td>
            <td><?=$hba1c_rows;?> ���</td>
        </tr>
        <tr>
            <td>�ӹǹ�����·�� BP < 140/90</td>
            <td><?=$bp_count;?> ���</td>
        </tr>
        <tr>
            <td>�ӹǹ�����·���Ǩ�ѹ</td>
            <td><?=$toots_count;?> ���</td>
        </tr>
        <?php 
        ksort($age_list);
        foreach ($age_list as $key => $age) {
            ?>
            <tr>
                <td>�ӹǹ���������� <?=$key;?>��</td>
                <td><?=count($age);?></td>
            </tr>
            <?php
        }
        ?>
    </table>

    <?php
    

}

