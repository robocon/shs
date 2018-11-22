<?php 

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

// วันธรรมดา
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

// เสาร์-อาทิตย์
SELECT `only_date`, COUNT(`row_id`) AS `rows` 
FROM `tmp_depart` 
WHERE ( `day_in` >= 5 AND `day_in` <= 6 ) 
AND ( `time` >= '08:00:00' AND `time` <= '16:00:00' ) 
GROUP BY `only_date` 
ORDER BY row_id ASC 