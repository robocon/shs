<?php 

if ( !defined('RDU_TEST') ) {
    echo 'RDU Indicator (2^3)+3 :( BAD GATE WAYYYYYYYYYY NOOOOOOOOOOOOOOOOOOOOOOO';
    exit;
}

// $en_date_min = bc_to_ad($date_min);
// $en_date_max = bc_to_ad($date_max);

// ����������� opday
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_opday_in11`");
$sql = "CREATE TEMPORARY TABLE `pre_opday_in11` 
SELECT `hn`, 
SUBSTRING(`age`,1,2) AS `shortage`, 
SUBSTRING(`thidate`,1,10) AS `date`, 
CONCAT(SUBSTRING(`thidate`,1,10),`hn`) AS `datehn`, 
CONCAT((SUBSTRING(`thidate`,1,4) - 543),SUBSTRING(`thidate`,5,15)) AS `opd_date` 
FROM `opday` 
WHERE ( `thidate` >= '$date_min' AND `thidate` <= '$date_max' ) 
AND `an` IS NULL 
AND `icd10` regexp 'E11' 
GROUP BY `hn` ";
$db->exec($sql); 

// ����������� drugrx
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_drugrx_in11`");
$sql = "CREATE TEMPORARY TABLE `pre_drugrx_in11` 
SELECT `row_id`,`hn`,`drugcode`,CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `datehn` 
FROM `drugrx` 
WHERE ( `date` >= '$date_min' AND `date` <= '$date_max' ) 
AND `status` = 'Y' 
AND `an` IS NULL 
AND `drugcode` LIKE '1EUGL-C%' 
GROUP BY `hn` ";
$test = $db->exec($sql); 

// ����ͧ��Ǻ�������ѹ ���� �����·�����Ѻ�� gibenclamide
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_user_in11`");
$sql = "CREATE TEMPORARY TABLE `tmp_user_in11` 
SELECT a.*,b.`drugcode` 
FROM `pre_opday_in11` AS a 
LEFT JOIN `pre_drugrx_in11` AS b ON b.`hn` = a.`hn` 
WHERE b.`hn` IS NOT NULL "; 
$db->exec($sql); 

// ������� A2 �ҡ���Ż��������ش
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_prelab_in11`");
$sql = "CREATE TEMPORARY TABLE `tmp_prelab_in11` 
SELECT MAX(b.`autonumber`) AS `latest_id`, a.`opd_date`, a.`shortage`
FROM `tmp_user_in11` AS a 
LEFT JOIN `resulthead` AS b ON b.`hn` = a.`hn` 
WHERE a.`shortage` <= 65 
AND b.`orderdate` <= a.`opd_date` 
AND ( b.`profilecode` = 'CREA' OR b.`profilecode` = 'CREAG' ) 
GROUP BY b.`hn`";
$db->exec($sql); 


// A2 �ӹǳ eGFR �����¡��� 60 �����͹��ѧ����Թ 6��͹
$sql = "SELECT COUNT(d.`hn`) AS `rows` 
FROM tmp_prelab_in11 AS c 
LEFT JOIN `resulthead` AS d ON d.`autonumber` = c.`latest_id` 
LEFT JOIN `resultdetail` AS e ON e.`autonumber` = c.`latest_id`
WHERE e.`labname` = 'Creatinine' 
AND eGFR(c.`shortage`,d.`sex`,e.`result`) < 60 
AND TIMESTAMPDIFF(MONTH,d.`orderdate`,c.`opd_date`) <= 6 ";
$db->select($sql); 
$pre_a2 = $db->get_item();


// A1
$sql = "SELECT COUNT(`hn`) AS `rows`
FROM `tmp_user_in11` 
WHERE `shortage` > 65 ;";
$db->select($sql);
$pre_a1 = $db->get_item();


$in11a = $pre_a1['rows'] + $pre_a2['rows'];


// ������
$sql = "SELECT COUNT(`hn`) AS `rows` FROM `tmp_user_in11` ";
$db->select($sql);
$pre_b = $db->get_item();
$in11b = $pre_b['rows'];

$in11_result  = ( $in11a / $in11b ) * 100 ;
