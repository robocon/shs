<?php 

// WEEKDAY 0 => Monday 
DROP TEMPORARY TABLE IF EXISTS `tmp_opday`; 
CREATE TEMPORARY TABLE `tmp_opday`
SELECT `row_id`,`thidate`,`thdatehn`,`hn`,`vn`,`thdatevn`,`ptname`,`age`,`ptright`,`doctor`,`idcard`,`toborow`,`officer`,
SUBSTRING(`thidate`, 12, 8) AS `time`,WEEKDAY(toEn(`thidate`)) AS `day_in`  
FROM `opday` 
WHERE `thidate` LIKE '2561-11%' 
AND `idcard` != '' 
AND `an` IS NULL ;



SELECT * 
FROM `tmp_opday` 
WHERE `toborow` LIKE 'EX17%' 
AND `time` >= '08:00:00' AND `time` <= '16:00:00' 


SELECT * 
FROM `tmp_opday` 
WHERE `toborow` LIKE 'EX17%' 
AND `time` >= '16:30:00' AND `time` <= '20:30:00' 


