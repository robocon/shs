<?php
session_start();
include("../connect.inc");
if( $_SESSION["smenucode"] != 'ADM' && ( $_SESSION["smenucode"] != 'ADMSSO' && $_SESSION['sIdname'] != 'สุมนา1' ) ){
    echo "ไม่สามารถเข้าใช้งานได้";
    exit;
}

?>
<style>
/* ตาราง */
body, button{
    font-family: "TH SarabunPSK", "TH Sarabun New";
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}
.chk_table th{
    background-color: #b5b5b5;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
    font-size: 16pt;
}
</style>
<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;กลับหน้าหลัก ร.พ.</a> | <a href="doctor_order_drug.php">ข้อมูลยา</a> | <a href="doctor_order_drug2.php">ข้อมูลยาที่มีมูลค่าการใช้สูง</a> | <a href="doctor_order_drug3.php">ข้อมูลการจ่ายยาเฉลี่ย 3 เดือนย้อนหลัง</a> | <a href="doctor_order_drug4.php">ข้อมูลการจ่ายยาเฉลี่ย 3 เดือนย้อนหลัง (MED)</a> | <a href="doctor_order_drug5.php">ข้อมูลยาที่มีการจ่ายมูลค่าสูงสุด 10 อันดับ</a>
</div>
<div>
    <h3>ข้อมูลยาที่มีการจ่ายมูลค่าสูงสุด 10 อันดับ</h3>
</div>
<?
/*$sql="SELECT a.`ptname`,a.`date`, 
    b.`hn`, b.`drugcode`, b.`tradname`, c.`salepri`,b.`amount`, b.`price`, b.`part`,
    c.`row_id`, c.`unit` 
    FROM ( 
        SELECT * 
        FROM `phardep` 
        WHERE  (ptright like 'R07%' and cashok ='ประกันสังคม')
        AND `date` >= '2562-04-01 00:00:00' AND `date` <= '2562-04-30 23:59:59' 
        AND doctor NOT REGEXP '^HD' 
        AND (`an` IS NULL || `an`='')
    ) AS a 
    LEFT JOIN `drugrx` AS b ON b.`idno` = a.`row_id` 
    LEFT JOIN ( 
    
        SELECT * 
        FROM `druglst` 
        WHERE (part='DDL' OR part='DDY') 
        AND `drugcode` NOT IN ('1KALE*  ','20KALE    ','30LP200_RT','1TEEV','20STEEV','30TEEV','1GPO30*  ','20SGPO30','20SGPO40','20GPOZ250','30GPOZ250','1EPIV-C*  ','20S3TC','30LAM_150','30LAM_300','20VIRE','20SZIL','20KALE    ','20STOC  ') AND (`drugcode` NOT LIKE  '20%' AND  `drugcode` NOT LIKE  '30%')
    ) AS c ON c.`drugcode` = b.`drugcode`
    WHERE c.`row_id` IS NOT NULL AND b.`amount` >0";
	
//echo $sql."<br>";
$query=mysql_query($sql);
$num=mysql_num_rows($query);	*/
?>


SELECT b.`drugcode` , b.`tradname` , c.`salepri` , SUM( b.`amount` ) , SUM( b.`price` ) AS sumprice
FROM (

SELECT * 
FROM  `phardep` 
WHERE (
ptright
LIKE  'R07%' AND cashok =  'ประกันสังคม'
) AND  `date` >=  '2562-04-01 00:00:00' AND  `date` <=  '2562-08-31 23:59:59' AND doctor NOT 
REGEXP  '^HD' AND (
`an` IS NULL ||  `an` =  ''
)
) AS a
LEFT JOIN  `drugrx` AS b ON b.`idno` = a.`row_id` 
LEFT JOIN (

SELECT * 
FROM  `druglst` 
WHERE (
part =  'DDL' OR part =  'DDY'
) AND (
`drugcode` NOT 
LIKE  '20%' AND  `drugcode` NOT 
LIKE  '30%'
)
) AS c ON c.`drugcode` = b.`drugcode` 
WHERE c.`row_id` IS NOT NULL AND b.`amount` >0
GROUP BY b.drugcode
ORDER BY SUM( b.`price` ) DESC 
LIMIT 0 , 20

<br />
<br />
<br />





SELECT b.`drugcode` , b.`tradname` , c.part, c.salepri, SUM( b.`amount` ) AS amount, SUM( b.`price` ) AS price
FROM (

SELECT * 
FROM  `phardep` 
WHERE (
ptright
LIKE  'R07%' AND cashok =  'ประกันสังคม'
) AND  `date` >=  '2562-06-01 00:00:00' AND  `date` <=  '2562-06-30 23:59:59' AND doctor NOT 
REGEXP  '^HD' AND (
`an` IS NULL ||  `an` =  ''
)
) AS a
LEFT JOIN  `drugrx` AS b ON b.`idno` = a.`row_id` 
LEFT JOIN (

SELECT * 
FROM  `druglst` 
WHERE (
part =  'DDL' OR part =  'DDY'
) AND  `drugcode` NOT 
IN (
'1KALE*  ',  '20KALE    ',  '30LP200_RT',  '1TEEV',  '20STEEV',  '30TEEV',  '1GPO30*  ',  '20SGPO30',  '20SGPO40',  '20GPOZ250',  '30GPOZ250',  '1EPIV-C*  ',  '20S3TC',  '30LAM_150',  '30LAM_300',  '20VIRE', '20SZIL',  '20KALE ',  '20STOC '
) AND (
`drugcode` NOT 
LIKE  '20%' AND  `drugcode` NOT 
LIKE  '30%'
)
) AS c ON c.`drugcode` = b.`drugcode` 
WHERE c.`row_id` IS NOT NULL AND b.`amount` >0
GROUP BY b.drugcode
ORDER BY SUM( b.`price` ) DESC 
LIMIT 1 , 20
