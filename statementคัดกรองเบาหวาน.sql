- หาจากคนไข้นัดก่อนว่าใครมีแลปบ้าง
- จากนั้นเอาไป join opcard แล้วหาอายุ >= 35 
SELECT s.*, t.dbirth,TIMESTAMPDIFF(YEAR, toEn(t.dbirth), SUBSTRING(NOW(), 1, 10)) AS `age`, 2566 AS `yearchk` 
FROM ( 
	SELECT y.*   
	FROM (
		SELECT row_id AS appoint_id, appdate,apptime,hn FROM appoint WHERE ( appdate_en >= '2021-10-01' AND appdate_en <= '2022-09-30' ) AND apptime != 'ยกเลิกการนัด' GROUP BY hn
	) AS x 
	LEFT JOIN 
	( 
		SELECT a.*,b.hn,b.patientname AS ptname FROM (
			SELECT autonumber,labcode,labname,result,authorisedate FROM resultdetail WHERE ( authorisedate >= '2021-10-01' AND authorisedate <= '2022-09-30' ) AND ( labcode = 'GLU' OR labcode = 'HBA1CC' )
		) AS a LEFT JOIN resulthead AS b ON a.autonumber = b.autonumber 
		GROUP BY b.hn 
	) AS y ON x.hn = y.hn
	WHERE y.autonumber IS NOT NULL 
) AS s LEFT JOIN opcard AS t ON s.hn = t.hn 
WHERE ( t.dbirth IS NOT NULL AND TIMESTAMPDIFF(YEAR, toEn(t.dbirth), SUBSTRING(NOW(), 1, 10)) >= 35 ) 
AND ( s.hn NOT IN ( SELECT `hn` FROM diabetes_clinic ) AND s.hn NOT IN ( SELECT hn FROM hba1c_bs ) ) 

หาการตรวจ ครั้งล่าสุดของแต่ละ hn
select * from (
SELECT MAX(autonumber) as last_autonumber 
FROM `hba1c_bs` 
WHERE hn NOT IN ( SELECT hn FROM diabetes_clinic) 
group by hn ) as a left join hba1c_bs as b on a.last_autonumber = b.autonumber 
order by a.last_autonumber asc