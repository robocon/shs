<?php 
// �ҹ����Ҿ + ᾷ��Ἱ��
// @readme �ҹ����Ҿ���� `staf_massage` = '' ������ᾷ��Ἱ�¨��� `staf_massage` <> '' 
// WEEKDAY 0 => Monday 
DROP TEMPORARY TABLE IF EXISTS `tmp_depart`; 
CREATE TEMPORARY TABLE `tmp_depart` 
SELECT *, SUBSTRING(`date`, 1, 10) AS `only_date`, SUBSTRING(`date`, 12, 8) AS `time`, WEEKDAY(toEn(`date`)) AS `day_in`  
FROM `depart` 
WHERE `date` LIKE '2561-11%' 
AND `depart` = 'PHYSI' 
AND `cashok` <> '' 
AND `staf_massage` = '' 
GROUP BY `hn`; 

// �ҹ����Ҿ �ѹ������
SELECT `only_date`, COUNT(`row_id`) AS `rows` 
FROM `tmp_depart` 
WHERE ( `day_in` >= 0 AND `day_in` <= 4 ) 
AND (
    ( `time` >= '08:00:00' AND `time` <= '16:00:00' ) 
    OR 
    ( `time` >= '16:30:00' AND `time` <= '20:30:00' ) 
) 
GROUP BY `only_date` 
ORDER BY row_id ASC 

// �ҹ����Ҿ �����-�ҷԵ��
SELECT `only_date`, COUNT(`row_id`) AS `rows` 
FROM `tmp_depart` 
WHERE ( `day_in` >= 5 AND `day_in` <= 6 ) 
AND ( `time` >= '08:00:00' AND `time` <= '16:00:00' ) 
GROUP BY `only_date` 
ORDER BY row_id ASC 


// �ҹ�Ǵ �͹����ѹ�ѹ���
SELECT `only_date`, COUNT(`row_id`) AS `rows` 
FROM `tmp_depart` 
WHERE `day_in` = 0 
AND ( `time` >= '16:00:00' AND `time` <= '20:00:00' )
GROUP BY `only_date` 
ORDER BY row_id ASC 

// �ҹ�Ǵ �͹����ѹ�����-�ҷԵ��
SELECT `only_date`, COUNT(`row_id`) AS `rows` 
FROM `tmp_depart` 
WHERE ( `day_in` >= 5 AND `day_in` <= 6 )
AND ( `time` >= '08:00:00' AND `time` <= '16:00:00' )
GROUP BY `only_date` 
ORDER BY row_id ASC 


// ��͢�� ���
DROP TEMPORARY TABLE IF EXISTS `tmp_depart`; 
CREATE TEMPORARY TABLE `tmp_depart` 
SELECT *, SUBSTRING(`date`, 1, 10) AS `only_date`, 
CONCAT(SUBSTRING(`date`, 1, 10), `hn`) AS `date_hn`, 
SUBSTRING(`date`, 12, 8) AS `time`, 
WEEKDAY(toEn(`date`)) AS `day_in`  
FROM `depart` 
WHERE `date` LIKE '2561-11%' 
AND `doctor` LIKE 'MD101%'  
AND `cashok` <> '' 
AND `status` = 'Y' 
GROUP BY CONCAT(SUBSTRING(`date`, 1, 10), `hn`); 


SELECT `only_date`, COUNT(`row_id`) AS `rows` 
FROM `tmp_depart` 
WHERE ( `time` >= '16:00:00' AND `time` <= '24:00:00' ) 
GROUP BY `only_date` 
ORDER BY row_id ASC 