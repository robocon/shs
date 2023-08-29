SELECT a.*,b.hn,b.patientname AS ptname,c.`dbirth`,TIMESTAMPDIFF(YEAR, toEn(c.`dbirth`), SUBSTRING(NOW(), 1, 10)) AS `age`, 2565 AS `yearchk` 
FROM ( 
	SELECT autonumber,labcode,labname,result,unit,normalrange,authorisedate  FROM resultdetail WHERE ( authorisedate >= '2021-10-01' AND authorisedate <= '2022-09-30' ) 
	AND ( labcode = 'GLU' OR labcode = 'HBA1CC' ) 
	GROUP BY autonumber 
	ORDER BY autonumber DESC 
) AS a 
LEFT JOIN resulthead AS b ON a.autonumber = b.autonumber 
LEFT JOIN opcard AS c ON b.hn = c.hn 
WHERE c.dbirth IS NOT NULL 
AND TIMESTAMPDIFF(YEAR, toEn(c.`dbirth`), SUBSTRING(NOW(), 1, 10)) >= 35 
AND ( b.hn NOT IN ( SELECT `hn` FROM diabetes_clinic ) AND b.hn NOT IN ( SELECT hn FROM hba1c_bs ) ) 
GROUP BY b.hn 

หาการตรวจ ครั้งล่าสุดของแต่ละ hn
select * from (
SELECT MAX(autonumber) as last_autonumber 
FROM `hba1c_bs` 
WHERE hn NOT IN ( SELECT hn FROM diabetes_clinic) 
group by hn ) as a left join hba1c_bs as b on a.last_autonumber = b.autonumber 
order by a.last_autonumber asc