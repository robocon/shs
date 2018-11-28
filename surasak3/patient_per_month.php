<?php 
// งานกายภาพ + แพทย์แผนไทย
// @readme งานกายภาพจะเป็น `staf_massage` = '' แต่ถ้าเป็นแพทย์แผนไทยจะเป็น `staf_massage` <> '' 
// WEEKDAY 0 => Monday 
DROP TEMPORARY TABLE IF EXISTS `tmp_depart`; 
CREATE TEMPORARY TABLE `tmp_depart` 
SELECT *, SUBSTRING(`date`, 1, 10) AS `only_date`, 
CONCAT(SUBSTRING(`date`, 1, 10), `hn`) AS `date_hn`, 
SUBSTRING(`date`, 12, 8) AS `time`, 
WEEKDAY(toEn(`date`)) AS `day_in`  
FROM `depart` 
WHERE `date` LIKE '2561-11%' 
AND `depart` = 'PHYSI' 
AND `cashok` <> '' 
AND `status` = 'Y' 
AND `staf_massage` = '' 
GROUP BY CONCAT(SUBSTRING(`date`, 1, 10), `hn`); 

// งานกายภาพ วันธรรมดา
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

// งานกายภาพ เสาร์-อาทิตย์
SELECT `only_date`, COUNT(`row_id`) AS `rows` 
FROM `tmp_depart` 
WHERE ( `day_in` >= 5 AND `day_in` <= 6 ) 
AND ( `time` >= '08:00:00' AND `time` <= '16:00:00' ) 
GROUP BY `only_date` 
ORDER BY row_id ASC 


// งานนวดแผนไทย ตอนเย็นวันจันทร์
SELECT `only_date`, COUNT(`row_id`) AS `rows` 
FROM `tmp_depart` 
WHERE `day_in` = 0 
AND ( `time` >= '16:00:00' AND `time` <= '20:00:00' )
GROUP BY `only_date` 
ORDER BY row_id ASC 

// งานนวด ตอนเช้าวันเสาร์-อาทิตย์
SELECT `only_date`, COUNT(`row_id`) AS `rows` 
FROM `tmp_depart` 
WHERE ( `day_in` >= 5 AND `day_in` <= 6 )
AND ( `time` >= '08:00:00' AND `time` <= '16:00:00' )
GROUP BY `only_date` 
ORDER BY row_id ASC 


// หมอขชล เย็น
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


// LAB ช่วงเช้า
DROP TEMPORARY TABLE IF EXISTS `tmp_opday`; 
CREATE TEMPORARY TABLE `tmp_opday`
SELECT `thidate`,`hn`,`vn`,`ptname`, SUBSTRING(`thidate`, 1, 10) AS `only_date`, 
CONCAT(SUBSTRING(`thidate`, 1, 10), `hn`) AS `date_hn`, 
SUBSTRING(`thidate`, 12, 8) AS `time`
FROM `opday` 
WHERE `thidate` LIKE '2561-08%' 
AND toborow NOT LIKE 'EX02%' 
AND `an` IS NULL  
AND `patho` > 0 
GROUP BY CONCAT(SUBSTRING(`thidate`, 1, 10), `hn`) 
ORDER BY `row_id` ASC; 

DROP TEMPORARY TABLE IF EXISTS `tmp_depart`; 
CREATE TEMPORARY TABLE `tmp_depart`
SELECT `row_id` AS `depart_id`,`depart`, SUBSTRING(`date`, 1, 10) AS `only_date`, 
CONCAT(SUBSTRING(`date`, 1, 10), `hn`) AS `date_hn`, 
SUBSTRING(`date`, 12, 8) AS `time` 
FROM `depart` 
WHERE `date` LIKE '2561-08%' 
AND `depart` = 'PATHO' 
AND `an` = '' 
AND `price` > 0 
AND `status` = 'Y' 
GROUP BY CONCAT(SUBSTRING(`date`, 1, 10), `hn`);

// เอาไว้เทสดูรายละเอียด
SELECT b.`thidate`,b.`hn`,b.`vn`,b.`ptname`,b.`date_hn`,a.*  
FROM `tmp_depart` AS a 
RIGHT JOIN `tmp_opday` AS b ON b.`date_hn` = a.`date_hn` 
WHERE ( a.`time` >= '06:00:00' AND a.`time` <= '08:00:00' ) 
ORDER BY a.`depart_id` ASC 

// นับยอด
SELECT a.`only_date`, COUNT(a.`depart_id`) AS `rows` 
FROM `tmp_depart` AS a 
RIGHT JOIN `tmp_opday` AS b ON b.`date_hn` = a.`date_hn` 
WHERE ( a.`time` >= '06:00:00' AND a.`time` <= '08:00:00' ) 
GROUP BY a.`only_date` 
ORDER BY a.`depart_id` ASC 

// LAB 00.00-08.00 น.
DROP TEMPORARY TABLE IF EXISTS `tmp_depart`; 
CREATE TEMPORARY TABLE `tmp_depart`
SELECT *, SUBSTRING(`date`, 1, 10) AS `only_date`, 
CONCAT(SUBSTRING(`date`, 1, 10), `hn`) AS `date_hn`, 
SUBSTRING(`date`, 12, 8) AS `time` 
FROM `depart` 
WHERE `date` LIKE '2561-09%' 
AND `depart` = 'PATHO' 
AND `price` > 0 
AND `status` = 'Y' 
GROUP BY CONCAT(SUBSTRING(`date`, 1, 10), `hn`);

SELECT `only_date`,`time`,`hn`,`an`,`ptname`,`idname`
FROM `tmp_depart`
WHERE ( `time` >= '00:00:00' AND `time` <= '08:00:00' ) 
ORDER BY `only_date`,`time` ASC;

// ฝังเข็ม วันเสาร์ 08-12น.
DROP TEMPORARY TABLE IF EXISTS `tmp_depart`; 
CREATE TEMPORARY TABLE `tmp_depart`
SELECT `row_id`,`depart`,`hn`,`ptname`, SUBSTRING(`date`, 1, 10) AS `only_date`, 
CONCAT(SUBSTRING(`date`, 1, 10), `hn`) AS `date_hn`, 
SUBSTRING(`date`, 12, 8) AS `time`,
DAYOFWEEK(CONCAT((SUBSTRING(`date`,1,4) - 3),SUBSTRING(`date`,5,6))) AS `day_in` 
FROM `depart` 
WHERE `date` LIKE '2561-11%' 
AND `depart` = 'NID' 
AND `an` = '' 
AND `price` > 0 
AND `status` = 'Y' 
AND DAYOFWEEK(CONCAT((SUBSTRING(`date`,1,4) - 3),SUBSTRING(`date`,5,6))) = 6 
AND ( SUBSTRING(`date`, 12, 8) >= '08:00:00' AND SUBSTRING(`date`, 12, 8) <= '12:00:00' ) 
GROUP BY CONCAT(SUBSTRING(`date`, 1, 10), `hn`);

SELECT `only_date`, COUNT(`row_id`) AS `rows`
FROM `tmp_depart` 
GROUP BY `only_date` 
ORDER BY `row_id` ASC 





// ห้องยา ตัวใหม่
DROP TEMPORARY TABLE IF EXISTS `tmp_phardep`; 
CREATE TEMPORARY TABLE `tmp_phardep`
SELECT `row_id`,`chktranx`,`date`,`ptname`,`hn`, 
SUBSTRING(`date`, 1, 10) AS `only_date`,
CONCAT(SUBSTRING(`date`, 1, 10), `hn`) AS `date_hn`, 
SUBSTRING(`date`, 12, 8) AS `time`,
DAYOFWEEK(CONCAT((SUBSTRING(`date`,1,4) - 3),SUBSTRING(`date`,5,6))) AS `day_in` 
FROM  `phardep` 
WHERE `date` LIKE '2561-11%' 
AND `borrow` IS NULL 
GROUP BY CONCAT(SUBSTRING(`date`, 1, 10), `hn`); 

SELECT `only_date`, COUNT(`row_id`) AS `rows`
FROM `tmp_phardep` 
WHERE ( `time` >= '00:00:00' AND `time` <= '08:00:00' ) 
GROUP BY `only_date` 
ORDER BY `row_id` ASC 



