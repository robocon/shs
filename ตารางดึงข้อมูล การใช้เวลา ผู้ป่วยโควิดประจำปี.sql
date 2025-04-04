DROP TEMPORARY TABLE IF EXISTS `tmp_opday`;
CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_opday`
SELECT `thdatehn`,SUBSTRING(`thidate`,12,8) AS `register_time`,CONCAT((SUBSTRING(`thidate`,1,4)-543),SUBSTRING(`thidate`,5,15)) AS `regisOfficeDateTime`
FROM `opday` WHERE ( `thidate` >= '2568-01-01' AND `thidate` <= '2568-12-31' )
GROUP BY `thdatehn`;

DROP TEMPORARY TABLE IF EXISTS `tmp_diag`;
CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_diag`
SELECT `hn`,`icd10`,`svdate_en`,CONCAT(SUBSTRING(`svdate`,9,2),'-',SUBSTRING(`svdate`,6,2),'-',SUBSTRING(`svdate`,1,4),`hn`) AS `thdatehn`,SUBSTRING(`svdate`,12,8) AS `dt_time`
FROM `diag` 
WHERE ( `svdate_en` >= '2025-01-01' AND `svdate_en` <= '2025-12-31' ) 
AND `hn` <> '' 
AND `icd10` <> '' 
GROUP BY CONCAT(SUBSTRING(`svdate`,1,10),`hn`);

DROP TEMPORARY TABLE IF EXISTS `tmp_opselfisolation`;
CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_opselfisolation`
SELECT `registerdate`,`row_id` AS `id`,`thdatehn`,`hn`,`vn`,`ptname`,`officer_date`,SUBSTRING(`officer_date`,12,8) AS `opd_time` 
FROM `opselfisolation` 
WHERE (`registerdate` >= '2025-01-01' AND `registerdate` <= '2025-12-31') 
AND `hn` <> '' 
GROUP BY `thdatehn` 
ORDER BY `row_id` ASC;

DROP TEMPORARY TABLE IF EXISTS `tmp_dphardep`;
CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_dphardep`
SELECT SUBSTRING(`date`,12,8) AS `phar_time`,`hn`,CONCAT(SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn`) AS `thdatehn`
FROM `dphardep` 
WHERE ( `date` >= '2568-01-01' AND `date` <= '2568-12-31' )
AND `dr_cancle` IS NULL 
GROUP BY CONCAT(SUBSTRING(`date`,1,10),`hn`);

DROP TEMPORARY TABLE IF EXISTS `tmp_opacc`;
CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_opacc`
SELECT CONCAT((SUBSTRING(`date`,1,4)-543),SUBSTRING(`date`,5,15)) AS `opaccDate`,SUBSTRING(`date`,12,8) AS `money_time`,`hn`,CONCAT(SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn`) AS `thdatehn`
FROM `opacc` 
WHERE ( `date` >= '2568-01-01' AND `date` <= '2568-12-31' )
GROUP BY CONCAT(SUBSTRING(`date`,1,10),`hn`);

SELECT a.`registerdate`,a.`hn`,a.`vn`,a.`ptname`,b.`register_time`,a.`opd_time`,c.`dt_time`,d.`phar_time`,e.`money_time`
,MOD(HOUR(TIMEDIFF(b.`regisOfficeDateTime`,e.`opaccDate`)),24) AS `hour`
,MINUTE(TIMEDIFF(b.`regisOfficeDateTime`,e.`opaccDate`)) AS `minute`
FROM `tmp_opselfisolation` AS a 
LEFT JOIN `tmp_opday` AS b ON a.`thdatehn` = b.`thdatehn`
LEFT JOIN `tmp_diag` AS c ON c.`thdatehn` = a.`thdatehn`
LEFT JOIN `tmp_dphardep` AS d ON d.`thdatehn` = a.`thdatehn`
LEFT JOIN `tmp_opacc` AS e ON e.`thdatehn` = a.`thdatehn`
WHERE ( b.`register_time` IS NOT NULL AND e.`money_time` IS NOT NULL )