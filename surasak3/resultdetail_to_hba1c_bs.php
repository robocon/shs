<?php 
include 'bootstrap.php';
set_time_limit(0);

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

/**
 * @important
 * ในอนาคตหลังจากโอนข้อมูลเข้าไปที่ hba1c_bs ครบตามปีงบ ก็จะเรียกใช้จาก hba1c_bs แทนการเรียก resultdetail
 */

/**
 * - เลือกข้อมูลจากใน resultdetail ในปีงบ โดยเอาแค่ hba1c กับ bs
 * - join กลับไปที่ resulthead เพื่อเอา hn, patientname
 * - join ไปที่ opcard เพื่อเอา วดป.เกิดมาคำนวณหาอายุ
 * - ทำ not in ไปที่ diabetes_clinic เพื่อหาว่ายังไม่เคยมีข้อมูล hn ในคลินิกเบาหวาน
 */
$sql = "SELECT a.*,b.hn,b.patientname AS ptname,c.`dbirth`,TIMESTAMPDIFF(YEAR, toEn(c.`dbirth`), SUBSTRING(NOW(), 1, 10)) AS `age`, 2566 AS `yearchk` 
FROM ( 
	SELECT autonumber,labcode,labname,result,unit,normalrange,authorisedate  FROM resultdetail WHERE ( authorisedate >= '2022-10-01' AND authorisedate <= '2023-09-30' ) 
	AND ( labcode = 'GLU' OR labcode = 'HBA1CC' ) 
	GROUP BY autonumber 
	ORDER BY autonumber DESC 
) AS a 
LEFT JOIN resulthead AS b ON a.autonumber = b.autonumber 
LEFT JOIN opcard AS c ON b.hn = c.hn 
WHERE c.dbirth IS NOT NULL 
AND TIMESTAMPDIFF(YEAR, toEn(c.`dbirth`), SUBSTRING(NOW(), 1, 10)) >= 35 
AND ( b.hn NOT IN ( SELECT `hn` FROM diabetes_clinic ) AND b.hn NOT IN ( SELECT hn FROM hba1c_bs WHERE yearchk != '2565' ) ) 
GROUP BY b.hn ";
/**
 * statement ด้านบนจะเป็นการหาข้อมูลเพื่อเอาไป insert ใน hba1c_bs แต่ถ้าจะหาตามพี่อิ๋วที่ต้องการแค่คนใหม่ที่ยังไม่เคยมีใน diabetes_clinic ให้เอา AND b.hn NOT IN ( SELECT hn FROM hba1c_bs ) ออกไป
 */
$q = $dbi->query($sql);
if($q->num_rows>0){
    while ($a = $q->fetch_assoc()) {

        $autonumber = $a['autonumber'];
        $labcode = $a['labcode'];
        $result = $a['result'];
        $hn = $a['hn'];
        $ptname = $a['ptname'];
        $yearchk = $a['yearchk'];

        $sql_hba1c_insert = "INSERT INTO `hba1c_bs` ( 
            `id`, `autonumber`, `labcode`, `result`, `hn`, `ptname`, `yearchk` 
        ) VALUES ( 
            NULL, '$autonumber', '$labcode', '$result', '$hn', '$ptname', '$yearchk' 
        );";
        // dump($sql);
        $save = $dbi->query($sql_hba1c_insert);
        dump($save);
    }
}else{
    dump($dib->error);
}