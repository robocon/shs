<?php
/*
เป็นคำสั่งที่แตกออกมาจาก dt_durg.php
Q: เอาไว้ทำอะไร?
A: หาค่า ldl ที่เจาะแลปในวันนี้ให้แพทย์ดูก่อนที่จะสั่งใช้ยา Inclisiran(2INC) แต่เห็นว่าจะเปลี่ยนไปใช้ HOSxP เลยระงับงานนี้ไว้ก่อน
 */
include dirname(__FILE__).'/bootstrap.php';

$date = date('Y-m-d');
$hn = $_GET['hn'];
$sql = "SELECT a.*,b.* 
FROM (
	SELECT `hn`,`thdatehn` FROM `opday` WHERE `thidate` LIKE '2568-08-29%' 
) AS a 
LEFT JOIN (
	SELECT x.*,y.`labcode`,y.`labname`
	FROM ( 
		SELECT `autonumber`,`hn`,SUBSTRING(`orderdate`,1,10) AS `orderdate`,CONCAT(SUBSTRING(`orderdate`,9,2),'-',SUBSTRING(`orderdate`,6,2),'-',(SUBSTRING(`orderdate`,1,4)+543),`hn`) AS `thdatehn` 
		FROM `resulthead` 
		WHERE `orderdate` LIKE '$date%' 
        AND `hn` = '$hn' 
		AND `profilecode` = '10001' 
	) AS x 
	LEFT JOIN `resultdetail` AS y ON x.`autonumber` = y.`autonumber` 
	WHERE y.`labcode` = '10001' AND y.`labname` = 'LDL-CALCULATE' 
) AS b ON a.`thdatehn` = b.`thdatehn`
WHERe b.`autonumber` IS NOT NULL ";

dump($sql);