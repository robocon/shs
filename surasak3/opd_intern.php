<?php 

include 'bootstrap.php';

// 仴֧�����Ũҡ�Կ����� .13 ����Ŵ�����Կ�������ѡ 
$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

/*

���ʹ�����¹Ѵ�Ѻᾷ�� Intern ������ä������ѧ ���� 
HT 
DM 
DLP 
Dyslipidemia 
Hyperglyceride 
Tyhroid 
����� �.�.61 - ��.�.62 �ͧᾷ����ª��͵��仹�� 


���ѷ� 			MD147	58044
���Թ 			MD148	58047
�����ó 		MD146	57988
���Գ� 			MD149	58030
��Ե� 			MD145	58075
�ػ����� 			MD132	55862
�Ѥ���� 			MD131	55824
�ͧ�� 			MD133	55811
��Գ�� 			MD134	55807
�Ѫþ���			MD116	20014

*/

?>

<style>
*{
    font-family: 'TH Sarabun New','TH SarabunPSK';
    font-size: 14pt;
}
h3{
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
@media print{
    fieldset{
        display: none;
    }
}
</style>
<fieldset>
    <legend>���ҵ����͹���Ѵ</legend>
    <form action="opd_intern.php" method="post">

        <div>
            ���͡��: 
            <?php 
            $y_match = input_post('years', (date('Y') + 543));
            $range = range(2561, (date('Y') + 544));
            getYearList('years', false, $y_match, $range);
            ?>
        </div>

        <div>
            ���͡��͹: 
            <?php 
            // 
            $match = input_post('months', date('m'));
            getMonthList('months', $match);
            ?>
        </div>

        <div>
            <button type="submit">�ʴ���</button>
            <input type="hidden" name="action" value="show">
        </div>
    </form>
</fieldset>
<?php

$action = input_post('action');

if ( $action == 'show' ) {

    $month_select = input_post('months');
    $year_select = input_post('years');

    $month_th = $def_fullm_th[$month_select];


    mysql_query("DROP TEMPORARY TABLE IF EXISTS `test_appoint`;");

    $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `test_appoint` 
    SELECT `row_id` AS `latest_id`,`date`,`hn`,`ptname`,`doctor`,`appdate`,`apptime`,
    CONCAT( SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn` ) as `date_hn`   
    FROM `appoint` 
    WHERE `appdate` LIKE '%$month_th $year_select' 
    AND ( 
        `doctor` LIKE 'MD147%' 
        OR `doctor` LIKE 'MD148%' 
        OR `doctor` LIKE 'MD146%' 
        OR `doctor` LIKE 'MD149%' 
        OR `doctor` LIKE 'MD145%' 
        OR `doctor` LIKE 'MD132%' 
        OR `doctor` LIKE 'MD131%' 
        OR `doctor` LIKE 'MD133%' 
        OR `doctor` LIKE 'MD134%' 
        OR `doctor` LIKE 'MD116%' 
        OR `doctor` LIKE 'MD022%' 
    ) 
    GROUP BY CONCAT( SUBSTRING(`date`,1,10),`hn`,SUBSTRING(`doctor`,1,5) );";
    mysql_query($sql);

    $sql = "SELECT a.*,b.`diag`,b.`icd10` 
    FROM `test_appoint` as a 
    LEFT JOIN `opday` as b on b.`thdatehn` = a.`date_hn` 
    WHERE a.`apptime` != '¡��ԡ��ùѴ' 
    AND b.`diag` <> '' 
    AND ( 
            b.`diag` like '%hypertension%'
            OR b.`diag` like '%diabet%'
            OR b.`diag` like '%stroke%'
            OR b.`diag` like '%gout%'
            OR b.`diag` like '%thyroid%'
            OR b.`diag` like '%asthma%'
            
             
            OR b.`diag` like '%hypergly%' 
            OR b.`diag` like '%atherosclerotic%' 
            OR b.`diag` like '%coronary%'
            OR b.`diag` like '%cardiovascular%'
    ) 
    ORDER BY `latest_id` ";
    $q = mysql_query($sql);
    

    ?>
    <div>
        <h3>������ª��͹Ѵᾷ�� Intern ��͹ <?=$month_th;?> ��<?=$year_select;?></h3>
    </div>
    <div>
        <table class="chk_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>�ѹ����Ǩ</th>
                    <th>HN</th>
                    <th>����ʡ��</th>
                    <th>ᾷ����Ѵ</th>
                    <th>�ѹ���Ѵ</th>
                    <th>Diag</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            while ($item = mysql_fetch_assoc($q) ) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['date'];?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['doctor'];?></td>
                    <td><?=$item['appdate'];?></td>
                    <td><?=$item['diag'];?></td>
                </tr>
                <?php 
                $i++;
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
    
    
}