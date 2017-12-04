<?php

include 'bootstrap.php';

include 'templates/classic/header.php';

$default_year = get_year_checkup(true);
$year = (int) input_post('year', $default_year);
?>
<form action="quick.php" method="post" class="no_print">
    <div>
        <label for="year">
            �է�����ҳ: <input type="year" id="year" name="year" value="<?=$year;?>">
        </label>
        <div>
            <button type="submit">��ŧ</button>
            <input type="hidden" name="showtable" value="table">
        </div>
    </div>
</form>
<?php

$show = input_post('showtable');

if( $show === 'table' ){

    $year = (int) input_post('year');
    
    // �Ѻ����է�����ҳ
    $year_start = ($year - 1)."-10-01";
    $year_end = "$year-09-30";

    $bc_year = bc_to_ad($year);
    
    $budget_range = array(
        ($bc_year - 1).'-10' => '�.�.', 
        ($bc_year - 1).'-11' => '�.�.', 
        ($bc_year - 1).'-12' => '�.�.', 
        $bc_year.'-01' => '�.�.', 
        $bc_year.'-02' => '�.�.', 
        $bc_year.'-03' => '��.�', 
        $bc_year.'-04' => '��.�.', 
        $bc_year.'-05' => '�.�.', 
        $bc_year.'-06' => '��.�.', 
        $bc_year.'-07' => '�.�.', 
        $bc_year.'-08' => '�.�.', 
        $bc_year.'-09' => '�.�.'
    );

    $db = Mysql::load();

    ?>
    <div>
        <div>
            <h3>�š�ú�ԡ��</h3>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th rowspan="2">�ŧҹ</th>
                <th rowspan="2">�ӹǹ</th>
                <th colspan="12">�է�����ҳ <?=$year;?></th>
            </tr>
            <tr>
                <?php
                foreach($budget_range as $key => $month){
                    ?>
                    <th><?=$month;?></th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">
                    <p>2. ��ԡ�÷ѹ����� ��ͺ����������ҧ������آ�Ҿ ��û�ͧ�ѹ�ä ����ѡ�Ҿ�Һ�� ��С�ÿ�鹿����ö�Ҿ</p>
                    <p>2.1 �ա������ԡ�÷���ѡ����п�鹿����ҧ���� 200���� ��ͼ�����Է�� 1,000����ͻ�</p>
                </td>
                <td>����</td>
                <?php
                //// �ѹ����� �Ѻ�繤��駵�ͤ� ////
                // DROP TEMPORARY TABLE IF EXISTS `tmp_depart`;
                $sql = "CREATE TEMPORARY TABLE `tmp_den1` 
                SELECT COUNT(`hn`) AS `user_rows`, 
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 6 )) AS `full_ad_date`,
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 2 )) AS `ad_month`,
                (SUBSTRING(`date`, 1, 4) - 543) AS `year`,
                SUBSTRING( `date`, 6, 2 ) AS `month`, 
                SUBSTRING( `date`, 9, 2 ) AS `date`,
                IF(COUNT(`hn` >= 1),1,0) AS `num_user`
                FROM `depart`  
                WHERE `date` >= '$year_start' AND `date` <= '$year_end' 
                AND `status` = 'Y' 
                AND `depart` = 'DENTA'
                AND ( 
                    `ptright` LIKE 'R09%' 
                    OR `ptright` LIKE 'R10%' OR `ptright` LIKE 'R11%' 
                    OR `ptright` LIKE 'R12%' OR `ptright` LIKE 'R13%' 
                    OR `ptright` LIKE 'R14%' OR `ptright` LIKE 'R15%' 
                    )
                AND ( `cashok` != '' OR `cashok` IS NOT NULL ) 
                GROUP BY `hn`,`full_ad_date` 
                ORDER BY `full_ad_date` ASC;";
                $db->select($sql);

                $sql = "SELECT `full_ad_date`,`ad_month`,`year`,`month`,SUM(`num_user`) AS `sum` 
                FROM `tmp_den1` 
                GROUP BY `ad_month`;";
                $db->select($sql);
                $items = $db->get_items();

                $new_items = array();
                foreach ($items as $key => $item) {
                    $key = $item['ad_month'];
                    $new_items[$key] = $item;
                }

                //// �ѹ����� ////
                foreach($budget_range as $key => $month){
                    $sum = 0;
                    if ( isset($new_items[$key]) ) {
                        $item = $new_items[$key];
                        $sum = $item['sum'];
                    }
                    ?>
                    <td align="right"><?=$sum;?></td>
                    <?php
                }
                ?>
            </tr>
            <tr>
                <td>��</td>
            <?php
                //// �Ѻ�繤������͹
                $sql = "CREATE TEMPORARY TABLE `tmp_den2` 
                SELECT COUNT(`hn`) AS `user_rows`,`hn`,  
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 6 )) AS `full_ad_date`, 
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 2 )) AS `ad_month`, 
                (SUBSTRING(`date`, 1, 4) - 543) AS `year`, 
                SUBSTRING( `date`, 6, 2 ) AS `month`, 
                SUBSTRING( `date`, 9, 2 ) AS `date`, 
                IF(COUNT(`hn` >= 1),1,0) AS `num_user` 
                FROM `depart` 
                WHERE `date` >= '$year_start' AND `date` <= '$year_end' 
                AND `status` = 'Y' 
                AND `depart` = 'DENTA' 
                AND ( 
                    `ptright` LIKE 'R09%' 
                    OR `ptright` LIKE 'R10%' OR `ptright` LIKE 'R11%' 
                    OR `ptright` LIKE 'R12%' OR `ptright` LIKE 'R13%' 
                    OR `ptright` LIKE 'R14%' OR `ptright` LIKE 'R15%' 
                    ) 
                AND ( `cashok` != '' OR `cashok` IS NOT NULL ) 
                GROUP BY `hn`,`ad_month` 
                ORDER BY `ad_month` ASC;";
                $db->select($sql);

                $sql = "SELECT `full_ad_date`,`ad_month`,`year`,`month`,SUM(`num_user`) AS `sum` 
                FROM `tmp_den2` 
                GROUP BY `ad_month`;";
                $db->select($sql);
                $items = $db->get_items();

                $new_items = array();
                foreach ($items as $key => $item) {
                    $key = $item['ad_month'];
                    $new_items[$key] = $item;
                }

                //// �ѹ����� ////
                foreach($budget_range as $key => $month){
                    $sum = 0;
                    if ( isset($new_items[$key]) ) {
                        $item = $new_items[$key];
                        $sum = $item['sum'];
                    }
                    ?>
                    <td align="right"><?=$sum;?></td>
                    <?php
                }
            ?>
            </tr>
            <tr>
                <td rowspan="2">
                    <p>3.��ԡ�á���Ҿ�ӺѴ �¡�����кǹ��÷ҧ����Ҿ�ӺѴ��ͺ����������ҧ������آ�Ҿ ��û�ͧ�ѹ�ä ����ѡɾ�Һ�� ��С�ÿ�鹿����ö�Ҿ�ռŧҹ��ԡ�á���Ҿ�ӺѴ���ҧ���� 1,320���� ��ͼ�����Է�� 10,000��</p>
                </td>
                <td>����</td>
                <?php
                //// ����Ҿ �Ѻ�繨ӹǹ���� ////
                $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_pt` 
                SELECT COUNT(`hn`) AS `user_rows`, 
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 6 )) AS `full_ad_date`,
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 2 )) AS `ad_month`,
                (SUBSTRING(`date`, 1, 4) - 543) AS `year`,
                SUBSTRING( `date`, 6, 2 ) AS `month`, 
                SUBSTRING( `date`, 9, 2 ) AS `date`,
                IF(COUNT(`hn` >= 1),1,0) AS `num_user`
                FROM `depart`  
                WHERE `date` >= '$year_start' AND `date` <= '$year_end' 
                AND `status` = 'Y' 
                AND ( `doctor` LIKE 'MD074%' OR `doctor` LIKE 'MD013%' )
                AND ( 
                    `ptright` LIKE 'R09%' 
                    OR `ptright` LIKE 'R10%' OR `ptright` LIKE 'R11%' 
                    OR `ptright` LIKE 'R12%' OR `ptright` LIKE 'R13%' 
                    OR `ptright` LIKE 'R14%' OR `ptright` LIKE 'R15%' 
                    ) 
                AND ( `cashok` != '' OR `cashok` IS NOT NULL )
                GROUP BY `hn`,`full_ad_date` 
                ORDER BY `full_ad_date` ASC;";
                $db->select($sql);

                $sql = "SELECT `full_ad_date`,`ad_month`,`year`,`month`,SUM(`num_user`) AS `sum` 
                FROM `tmp_pt` 
                GROUP BY `ad_month`;";
                $db->select($sql);
                $items = $db->get_items();

                $new_items = array();
                foreach ($items as $key => $item) {
                    $key = $item['ad_month'];
                    $new_items[$key] = $item;
                }
                //// ����Ҿ ////
                foreach($budget_range as $key => $month){
                    $sum = 0;
                    if ( isset($new_items[$key]) ) {
                        $item = $new_items[$key];
                        $sum = $item['sum'];
                    }
                    ?>
                    <td align="right"><?=$sum;?></td>
                    <?php
                }
                ?>
            </tr>
            <tr>
                <td>��</td>
                <?php
                //// ����Ҿ �Ѻ�繨ӹǹ���� ////
                $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_pt2` 
                SELECT COUNT(`hn`) AS `user_rows`, 
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 6 )) AS `full_ad_date`,
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 2 )) AS `ad_month`,
                (SUBSTRING(`date`, 1, 4) - 543) AS `year`,
                SUBSTRING( `date`, 6, 2 ) AS `month`, 
                SUBSTRING( `date`, 9, 2 ) AS `date`,
                IF(COUNT(`hn` >= 1),1,0) AS `num_user`
                FROM `depart`  
                WHERE `date` >= '$year_start' AND `date` <= '$year_end' 
                AND `status` = 'Y' 
                AND ( `doctor` LIKE 'MD074%' OR `doctor` LIKE 'MD013%' )
                AND ( 
                    `ptright` LIKE 'R09%' 
                    OR `ptright` LIKE 'R10%' OR `ptright` LIKE 'R11%' 
                    OR `ptright` LIKE 'R12%' OR `ptright` LIKE 'R13%' 
                    OR `ptright` LIKE 'R14%' OR `ptright` LIKE 'R15%' 
                    ) 
                AND ( `cashok` != '' OR `cashok` IS NOT NULL )
                GROUP BY `hn`,`ad_month` 
                ORDER BY `ad_month` ASC;";
                $db->select($sql);

                $sql = "SELECT `full_ad_date`,`ad_month`,`year`,`month`,SUM(`num_user`) AS `sum` 
                FROM `tmp_pt2` 
                GROUP BY `ad_month`;";
                $db->select($sql);
                $items = $db->get_items();

                $new_items = array();
                foreach ($items as $key => $item) {
                    $key = $item['ad_month'];
                    $new_items[$key] = $item;
                }
                //// ����Ҿ ////
                foreach($budget_range as $key => $month){
                    $sum = 0;
                    if ( isset($new_items[$key]) ) {
                        $item = $new_items[$key];
                        $sum = $item['sum'];
                    }
                    ?>
                    <td align="right"><?=$sum;?></td>
                    <?php
                }
                ?>
            </tr>
        </tbody>
    </table>
    <?php
    




}












include 'templates/classic/footer.php';