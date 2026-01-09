<?php
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>รายงานสรุปผลตรวจสุขภาพ</title>
<style type="text/css">

/* 
https://css-tricks.com/fixing-tables-long-strings/
*/
* {
	font-family: "TH Sarabun New","TH SarabunPSK";
	font-size: 18px;
}
.chk_table{
        border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}

</style>
</head>
<?php

$camp = $_GET["camp"];

$title_date = '';

$sql = "SELECT a.* 
FROM ( 
    SELECT * FROM `out_result_chkup` WHERE `part` = '$camp' 
) AS a 
LEFT JOIN ( 
    SELECT * FROM `opcardchk` WHERE `part` = '$camp' ORDER BY `row` ASC 
) AS b ON b.`HN` = a.`hn` 
ORDER BY b.`row` ASC";
$qOutResultChkup = $dbi->query($sql);
$num = $qOutResultChkup->num_rows;

$sql = "SELECT `date_checkup` AS `show_date`, `name` AS `company_name` 
FROM `chk_company_list` 
WHERE `code` = '$camp' ";
$q = $dbi->query($sql);
$company = $q->fetch_assoc();

?>	
<body>
<div align="center"><strong>ผลการตรวจสุขภาพเจ้าหน้าที่ <?=$company['company_name'];?>  บริการตรวจสุขภาพ ณ โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div>
<div align="center"><strong>ระหว่างวันที่ <?=$company['show_date'];?> จำนวน <?=$num;?> ราย</strong></div>
<table width="400%" class="chk_table">
  <tr valign="middle">
    <th class="col-1" rowspan="2" align="center">ลำดับ</th>
    <th class="col-2" rowspan="2" align="center">HN</th>
    <th class="col-3" rowspan="2" align="center">ชื่อ - สกุล</th>
    <th class="col-4" rowspan="2" align="center">อายุ</th>
    <th class="col-5" rowspan="2" align="center">น้ำหนัก</th>
    <th class="col-6" rowspan="2" align="center">ส่วนสูง</th>
    <th class="col-7" rowspan="2" align="center">BP</th>
    <th class="col-8" rowspan="2" align="center">Pulse</th>
    <th class="col-9" rowspan="2" align="center">Rate</th>
    <th class="col-10" rowspan="2" align="center">Temp</th>
    <th class="col-11" rowspan="2" align="center">โรคประจำตัว</th>
    <th class="col-12" colspan="48" align="center">รายการตรวจ</th>
    <th class="col-13" rowspan="2" align="center">ภาวะสุขภาพโดยรวม</th>
    <th class="col-14" rowspan="2" align="center" >เคยเข้ารับการรักษาในโรงพยาบาล</th>
    <th class="col-15" rowspan="2" align="center" >ประวัติอื่นที่สำคัญ</th>
    <th class="col-16" colspan="4" align="center">สรุปผลการตรวจ</th>
  </tr>

  <tr valign="middle">
    <th>PE</th>
    <th>X-RAY</th>
    <th>CBC</th>
    <th>UA</th>
    <th>BS</th>
    <th>CHOL</th>
    <th>TRIG</th>
    <th>HDL</th>
    <th>LDL</th>
    <th>BUN</th>
    <th>CR</th>
    <th>eGFR</th>
    <th>URIC</th>
    <th>SGOT</th>
    <th>SGPT</th>
    <th>ALK</th>
    <th>HBsAg</th>
    <th>Anti HCV</th>
    <th>Anti-HIV</th>
    <th>HBA1C</th>
    <th>Anti-HBs</th>
    <th>FOBT</th>
    <th>AFP</th>
    <th>CEA</th>
    <th>PSA</th>
    <th>Anti-HAV IgG</th>
    <th>Anti HAV IgM</th>
    <th>Stool Exam</th>
    <th>Stool Culture</th>
    <th>Stool Occult</th>
    <th>ตรวจการติดเชื้อแบคทีเรีย โรคไข้ฉี่หนู (Leptospira Ab IgM)</th>
    <th>ตรวจการติดเชื้อแบคทีเรีย โรคไข้ฉี่หนู (Leptospira Ab IgG)</th>
    <th>METAMP</th>
    <th>ABOC</th>
    <th>EKG</th>
    <th>V/A</th>
    <th align="center">สายตา</th>
    <th align="center">สมรรถภาพปอด</th>
    <th align="center">อัลตร้าซาวด์<br>ช่องท้อง</th>
    <th align="center">ตรวจคัดกรองหาความเสี่ยงของโรคเส้นเลือดแดงตีบตัน (CIMT)</th>
    <th align="center">ตรวจหัวใจด้วยคลื่นเสียงสะท้อนความถี่สูง (ECHO)</th>
    <th align="center">ตรวจวัดความแข็งตัวของหลอดเลือด (ABI)</th>
    <th align="center">สายตาอาชีวอนามัย + สายตาสั้น, ยาว</th>
    <th align="center">ต่อมลูกหมาก<br>โดยการคลำ</th>
    <th align="center">ความดันตา</th>
    <th align="center">ลานสายตา</th>

    <th align="center">โรคประจำตัว</th>
    <th align="center">อุบัติเหตุและผ่าตัด</th>
    

    <!-- สรุปผลการตรวจ -->
    <th align="center">ผลการได้ยิน</th>
    <th align="center">แมมโมแกรม</th>
    <th align="center">พบแพทย์</th>
    <th align="center">ไม่พบแพทย์</th>
    <!-- สรุปผลการตรวจ -->
  </tr>
<?php
$i=0;
// while($result = mysql_fetch_array($out_result_sql)){
while($result = $qOutResultChkup->fetch_assoc()){

    $yaer_chk = $result['year_chk'];
    $pt_hn = $result['hn'];
    $age = $result["age"];
    $cs = $result["cs"];
    $exam_no = $result["exam_no"];
    $hearing = $result['hearing'];

    $pulse = $result['p'];
    $rate = $result['rate'];
    $temp = $result['temp'];

    if(empty($result["HN"])){
        $result["HN"] = $result["hn"];
    }

    $result2 = $result;
    $prawat = $result2['prawat'];
    if(empty($age)){
        $age=$result2["age"];
    }
    
    // กรณีที่มี labnumber จากใน chk_lab_items
    $defLabNumber = "AND `labnumber` = '$exam_no'";
    $sqlLab = "SELECT `labnumber` FROM `chk_lab_items` WHERE `part` = '$camp' AND `hn` = '$pt_hn' ";
    $qLab = $dbi->query($sqlLab);
    if($qLab->num_rows>0){
        $labItemList = array();
        while($labChk = $qLab->fetch_assoc()){
            $testLabnumber = $labChk['labnumber'];
            $labItemList[] = " `labnumber` = '$testLabnumber' ";
        }
        $defLabNumber = implode(' OR ', $labItemList);
        $defLabNumber = " AND ( $defLabNumber )";
    }
    

    $i++;
    $ptname=$result2["ptname"];
    $bp="&nbsp;";

    if($result2["bp1"] && $result2["bp2"]){
        $bp=$result2["bp1"]."/".$result2["bp2"];
    }
    
    if($result2["bp3"] && $result2["bp4"]){
        $bp=$result2["bp3"]."/".$result2["bp4"];
    }
    if($result["congenital_disease"]=="ปฎิเสธ" || empty($result["congenital_disease"])){
        $disease="ไม่มี";
    }else{
        $disease="มี";
    }

    $strSQL11 = "SELECT date_format(`orderdate`,'%d-%m-%Y') as orderdate2 
    FROM `resulthead` 
    WHERE `hn` = '".$result['HN']."' 
    AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
    order by autonumber desc";  //โชว์ข้อมูล
    $q11 = $dbi->query($strSQL11);
    $itemQ11 = $q11->fetch_assoc();
    $orderdate = $itemQ11['orderdate2'];
	
	list($d,$m,$y)=explode("-",$orderdate);
	$yy=$y+543;
	$showdate="$d/$m/$yy";
	$dateekg="$yy-$m";	
?>  
  <tr valign="top">
    <td align="right"><?=$i;?></td>
    <td><?=$result["HN"];?></td>
    <td><?=$ptname;?></td>
    <td align="right"><?=$age;?></td>
    <td align="right"><?=$result2["weight"];?></td>
    <td align="right"><?=$result2["height"];?></td>
    <td align="right"><?=$bp;?></td>
    <td align="right"><?=$pulse;?></td>
    <td align="right"><?=$rate;?></td>
    <td align="right"><?=$temp;?></td>
    <td><?=$prawat;?></td>
    <td>&nbsp;</td>
    <td align="left">
        <?php 
        if($result2["cxr"]==""){ 
            echo "ปกติ"; 
        }else{ 
            echo $result2["cxr"]; 
        } 
        ?>
    </td>
    <td align="center">
<?php 

$stat_cbc = $stat_ua = '';
$qDxOfYear = $dbi->query("SELECT `stat_cbc`,`stat_ua` FROM `condxofyear_out` WHERE `hn` = '$pt_hn' ORDER BY `row_id` DESC LIMIT 1");
$dxStat = $qDxOfYear->fetch_assoc();
$stat_cbc = $dxStat['stat_cbc'];
$stat_ua = $dxStat['stat_ua'];

$sql18="SELECT * 
FROM resulthead 
WHERE profilecode = 'CBC' 
AND hn = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
GROUP BY `profilecode` ";
$q18 = $dbi->query($sql18);
$numcbc = $q18->num_rows;
if($numcbc > 0){
    echo "มี";
    if( !empty($stat_cbc) ){
        echo "($stat_cbc)";
    }
}else if($numcbc < 1){
	echo "<strong style='color:#FF0000'>ไม่มี</strong>";
}else{
	echo "&nbsp;";
}
?>
</td>
<td align="center">
<?php
$sql19="SELECT * 
FROM resulthead WHERE profilecode = 'UA' AND hn = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
GROUP BY `profilecode` ";
$q19 = $dbi->query($sql19);
$numua = $q19->num_rows;
if($numua > 0){
    echo "มี";
    if( !empty($stat_ua) ){
        echo "($stat_ua)";
    }
}else if($numua < 1){
	echo "<strong style='color:#FF0000'>ไม่มี</strong>";
}else{
	echo "&nbsp;";
}
?>
</td>
<td align="center">
<?php
$sql1 = "SELECT b.result, b.flag 
FROM ( 

    SELECT *, MAX(`autonumber`) AS `latest_number`
    FROM `resulthead` 
    WHERE `hn` = '$pt_hn' 
    AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
    AND `profilecode` = 'GLU' 
    GROUP BY `profilecode` 

) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode = 'GLU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
GROUP BY a.`profilecode`"; 
$query1=mysql_query($sql1);
list($glu,$flag)=mysql_fetch_array($query1);
if($flag=="N" || $flag=="L"){
	echo $glu;
}else if($flag=="H" OR $flag=="HH"){
	echo "<strong style='color:#FF0000'>$glu</strong>";
}else{
	echo "&nbsp;";
}
?>    </td>
    <td align="center"><?php

/**
 * หา LIPID ซึ่งใน LIPID จะมี CHOL(Cholesterol*), TRIG(Triglyceride*), HDL(HDL-C), 10001(LDL-C) อีกทีหนึ่ง
 * ถ้ามีตรวจ LIPID ก็เอาไปแทนค่า statement ตัวเดิม
 */
$sql_lipid="SELECT b.`labcode`, b.`labname`, b.`result`, b.`flag`
FROM ( 

    SELECT *, MAX(`autonumber`) AS `latest_number`
    FROM `resulthead` 
    WHERE `hn` = '$pt_hn' 
    AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
    AND `profilecode` = 'LIPID' 

) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode IN ('CHOL','TRIG','HDL','10001') ";

$q_lipid=mysql_query($sql_lipid);
$lipid = array();
if(mysql_num_rows($q_lipid) > 0){
    while ($l = mysql_fetch_assoc($q_lipid)) { 
        
        $key = $l['labcode'];
        $lipid[$key] = $l;
    }
}

if($lipid['CHOL']){

    $chol = $lipid['CHOL']['result'];
    $flag = $lipid['CHOL']['flag'];

}else{

    $sql2="SELECT b.result, b.flag 
    FROM ( 

        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$pt_hn' 
        AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
        AND `profilecode` = 'CHOL' 
        GROUP BY `profilecode` 

    ) AS a
    INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
    WHERE b.labcode = 'CHOL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
    GROUP BY a.`profilecode` ";
    $query2=mysql_query($sql2);
    list($chol,$flag)=mysql_fetch_array($query2);

}

if($flag=="N"){
	echo $chol;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$chol</strong>";
}else{
	echo "&nbsp;";
}


?>
</td>
<td align="center">
<?php
if($lipid['TRIG']){
    $trig = $lipid['TRIG']['result'];
    $flag = $lipid['TRIG']['flag'];
}else{
    $sql3="SELECT b.result, b.flag 
    FROM ( 
        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$pt_hn' 
        AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
        AND `profilecode` = 'TRIG' 
        GROUP BY `profilecode` 
    ) AS a
    INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
    WHERE b.labcode = 'TRIG' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
    GROUP BY a.`profilecode` ";
    $query3=mysql_query($sql3);
    list($trig,$flag)=mysql_fetch_array($query3);
}

if($flag=="N"){
	echo $trig;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$trig</strong>";
}else{
	echo "&nbsp;";
}
?>
</td>
<td align="center">
<?php 
if($lipid['HDL']){
    $hdl = $lipid['HDL']['result'];
    $flag = $lipid['HDL']['flag'];

}else{
    $sql4="SELECT b.result, b.flag 
    FROM ( 
        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$pt_hn' 
        AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
        AND `profilecode` = 'HDL' 
        GROUP BY `profilecode` 
    ) AS a
    INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
    WHERE b.labcode = 'HDL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
    GROUP BY a.`profilecode` ";
    $query4=mysql_query($sql4);
    list($hdl,$flag)=mysql_fetch_array($query4);
}

if($flag=="N" || $flag=="H"){
	echo $hdl;
}else if($flag=="L"){
	echo "<strong style='color:#FF0000'>$hdl</strong>";
}else{
	echo "&nbsp;";
}
?>
</td>
<!-- LDL ธรรมดา -->
<td align="center">
<?php 
if($lipid['10001']){
    $ldl = $lipid['10001']['result'];
    $flag = $lipid['10001']['flag'];

}else{
    $sql5="SELECT b.result, b.flag 
    FROM ( 
        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$pt_hn' 
        AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
        AND `profilecode` = 'LDL'
        GROUP BY `profilecode` 
    ) AS a
    INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
    WHERE `profilecode` = 'LDL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
    GROUP BY a.`profilecode` ";
    $query5=mysql_query($sql5);
    if(mysql_num_rows($query5)>0){ 

        list($ldl,$flag)=mysql_fetch_array($query5);

    }else{

        $sql5="SELECT b.result, b.flag 
        FROM ( 
            SELECT *, MAX(`autonumber`) AS `latest_number`
            FROM `resulthead` 
            WHERE `hn` = '$pt_hn' 
            AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
            AND `profilecode` = '10001'
            GROUP BY `profilecode` 
        ) AS a
        INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
        WHERE `profilecode` = '10001' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
        GROUP BY a.`profilecode` ";
        $query5=mysql_query($sql5);
        list($ldl,$flag)=mysql_fetch_array($query5);

    }
}

if($flag=="N" || $flag=="L"){
	echo $ldl;
}else if($flag=="H"){
	echo "<strong style='color:#FF0000'>$ldl</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql6="SELECT b.result, b.flag 
FROM ( 

SELECT *, MAX(`autonumber`) AS `latest_number`
FROM `resulthead` 
WHERE `hn` = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
AND `profilecode` = 'BUN' 
GROUP BY `profilecode` 

) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode = 'BUN' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
GROUP BY a.`profilecode` ";

$query6=mysql_query($sql6);
list($bun,$flag)=mysql_fetch_array($query6);

if($flag=="N"){
	echo $bun;
}else{
	echo "<strong style='color:#FF0000'>$bun</strong>";
}
?></td>
<td align="center">
    <?php 
    // CREA
    $sql7="SELECT b.result, b.flag 
    FROM ( 

    SELECT *, MAX(`autonumber`) AS `latest_number`
    FROM `resulthead` 
    WHERE `hn` = '$pt_hn' 
    AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
    AND `profilecode` = 'CREAG' 
    GROUP BY `profilecode` 

    ) AS a
    INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
    WHERE b.labcode = 'CREA' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
    GROUP BY a.`profilecode` ";

    $query7=mysql_query($sql7);
    list($crea,$flag)=mysql_fetch_array($query7);

    if($flag=="N"){
        echo $crea;
    }else{
        echo "<strong style='color:#FF0000'>$crea</strong>";
    }
    ?>
</td>
<td align="center">
    <?php 
    // GFR
    $sql7="SELECT b.result, b.flag 
    FROM ( 

        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$pt_hn' 
        AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
        $defLabNumber 
        AND `profilecode` = 'CREAG' 
        GROUP BY `profilecode` 

    ) AS a
    INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
    WHERE b.labcode = 'GFR' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
    GROUP BY a.`profilecode` ";
    
    $query7=mysql_query($sql7);
    list($crea,$flag)=mysql_fetch_array($query7);

    if($flag=="N"){
        echo $crea;
    }else{
        echo "<strong style='color:#FF0000'>$crea</strong>";
    }
    ?>
</td>


    <td align="center"><?
$sql8="SELECT b.result, b.flag 
FROM ( 

SELECT *, MAX(`autonumber`) AS `latest_number`
FROM `resulthead` 
WHERE `hn` = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
AND ( `profilecode` = 'URIC' OR `profilecode` = '1427' ) 
GROUP BY `profilecode` 

) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE ( b.labcode = 'URIC' OR b.`labcode` = '1427' ) AND b.result !='DELETE' AND a.hn = '$pt_hn' 
GROUP BY a.`profilecode` ";
//echo $sql8;
$query8=mysql_query($sql8);
list($uric,$flag)=mysql_fetch_array($query8);

if($flag=="N"){
	echo $uric;
}else{
	echo "<strong style='color:#FF0000'>$uric</strong>";
}
?></td>
    <td align="center"><?
$sql9="SELECT b.result, b.flag 
FROM ( 

SELECT *, MAX(`autonumber`) AS `latest_number`
FROM `resulthead` 
WHERE `hn` = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
AND `profilecode` = 'AST' 
GROUP BY `profilecode` 

) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode = 'AST' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
GROUP BY a.`profilecode` ";
//echo $sql9;
$query9=mysql_query($sql9);
list($ast,$flag)=mysql_fetch_array($query9);

if($flag=="N"){
	echo $ast;
}else{
	echo "<strong style='color:#FF0000'>$ast</strong>";
}
?></td>
    <td align="center"><?
$sql10="SELECT b.result, b.flag 
FROM ( 

SELECT *, MAX(`autonumber`) AS `latest_number`
FROM `resulthead` 
WHERE `hn` = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
AND `profilecode` = 'ALT' 
GROUP BY `profilecode` 

) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode = 'ALT' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
GROUP BY a.`profilecode` ";
//echo $sql10;
$query10=mysql_query($sql10);
list($alt,$flag)=mysql_fetch_array($query10);

if($flag=="N"){
	echo $alt;
}else{
	echo "<strong style='color:#FF0000'>$alt</strong>";
}
?></td>
    <td align="center"><?
$sql11="SELECT b.result, b.flag 
FROM ( 

SELECT *, MAX(`autonumber`) AS `latest_number`
FROM `resulthead` 
WHERE `hn` = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
AND `profilecode` = 'ALP' 
GROUP BY `profilecode` 

) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode = 'ALP' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
GROUP BY a.`profilecode` ";
//echo $sql11;
$query11=mysql_query($sql11);
list($alp,$flag)=mysql_fetch_array($query11);

if($flag=="N"){
	echo $alp;
}else{
	echo "<strong style='color:#FF0000'>$alp</strong>";
}
?></td>

<td align="center">
    <!-- HBSAG -->
<?php
$sql12="SELECT b.result, b.flag 
FROM ( 

SELECT *, MAX(`autonumber`) AS `latest_number`
FROM `resulthead` 
WHERE `hn` = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
AND `profilecode` = 'HBSAG' 
GROUP BY `profilecode` 

) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode = 'HBSAG' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk'
GROUP BY a.`profilecode` ";
//echo $sql12;
$query12=mysql_query($sql12);
list($hbsag,$flag)=mysql_fetch_array($query12);

if($hbsag=="Negative"){
	echo '<span title="HBSAG">ไม่พบเชื้อ</span>';
}else if($hbsag=="Positive"){
	echo '<strong style="color:#FF0000;" title="HBSAG">พบเชื้อ</strong>';
}else{
	echo "&nbsp;";
}
?>
</td>

<td align="center">
<!-- เชื้อไวรัสตับอักเสบบี (Anti HCV) -->
<?php
$sql12="SELECT b.result, b.flag 
FROM ( 
    SELECT *, MAX(`autonumber`) AS `latest_number` FROM `resulthead` WHERE `hn` = '$pt_hn' AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' AND `profilecode` = 'HCVAB' GROUP BY `profilecode` 
) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode = 'HCVAB' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk'
GROUP BY a.`profilecode` ";
$query12=mysql_query($sql12);
list($hcvab,$flag)=mysql_fetch_array($query12);

if($hcvab=="Negative"){
	echo "ไม่พบเชื้อ";
}else if($hcvab=="Positive"){
	echo "<strong style='color:#FF0000'>พบเชื้อ</strong>";
}else{
	echo "&nbsp;";
}
?></td>

<td align="center">
<!-- ไวรัส เอช ไอ วี (Anti-HIV) -->
<?php
$sql12="SELECT b.result, b.flag 
FROM ( 
    SELECT *, MAX(`autonumber`) AS `latest_number` FROM `resulthead` WHERE `hn` = '$pt_hn' AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' AND `profilecode` = 'HIV' GROUP BY `profilecode` 
) AS a 
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber 
WHERE b.labcode = 'HIV' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
GROUP BY a.`profilecode` ";
$query12=mysql_query($sql12);
if(mysql_num_rows($query12) > 0)
{
    list($hcvab,$flag)=mysql_fetch_array($query12);
    $result = 'Negative';
    if( $flag != 'N' ){ 
        $result = 'Positive';
    }
    echo $result;
}
?>
</td>

<td align="center">
<?php
// HBA1CC
$sql12="SELECT b.result, b.flag 
FROM ( 
    SELECT *, MAX(`autonumber`) AS `latest_number` 
    FROM `resulthead` 
    WHERE `hn` = '$pt_hn' AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' AND `profilecode` = 'HBA1C' GROUP BY `profilecode` 
) AS a 
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber 
WHERE b.labcode = 'HBA1CC' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
GROUP BY a.`profilecode` ";
$query12=mysql_query($sql12);
if(mysql_num_rows($query12) > 0)
{
    list($hba1c,$flag)=mysql_fetch_array($query12);
    echo $hba1c;
}
?>
</td>

<td align="center">
<?php
// Anti-HBs
$sql12="SELECT b.result, b.flag 
FROM ( 
    SELECT *, MAX(`autonumber`) AS `latest_number` 
    FROM `resulthead` 
    WHERE `hn` = '$pt_hn' AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' AND `profilecode` = 'ANTIHB' GROUP BY `profilecode` 
) AS a 
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber 
WHERE b.labcode = 'ANTIHB' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
GROUP BY a.`profilecode` ";
$query12=mysql_query($sql12);
$antihb = '';
if(mysql_num_rows($query12) > 0)
{
    list($antihb,$flag)=mysql_fetch_array($query12);
    // $antihb = 'Negative';
    // if( $flag != 'N' ){ 
    //     $antihb = 'Positive';
    // }
    echo $antihb;
}
?>
</td>

<td align="center">
<?php
$sql13="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'OCCULT' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk'
GROUP BY a.`profilecode` ";
//echo $sql13;
$query13=mysql_query($sql13);
list($occultResult,$flag)=mysql_fetch_array($query13);

if($occultResult=="Negative"){
	echo "ไม่พบเลือด";
}else if($occultResult=="Positive"){
	echo "<strong style='color:#FF0000'>พบเลือด</strong>";
}else{
	echo "&nbsp;";
}
?>
</td>
<td align="center">
    <?php
    $sql13="SELECT b.result, b.flag 
    FROM ( 

SELECT *, MAX(`autonumber`) AS `latest_number`
FROM `resulthead` 
WHERE `hn` = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
AND `profilecode` = 'AFP' 
GROUP BY `profilecode` 

) AS a
    INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
    WHERE b.labcode = 'AFP' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
    GROUP BY a.`profilecode` ";
    
    $query13=mysql_query($sql13);
    list($afp,$flag)=mysql_fetch_array($query13);

    $result_outlab_txt = 'ปกติ';
    if( $flag['flag'] != 'N' ){
        $result_outlab_txt = 'ผิดปกติ';
    }

    echo $afp;
    
    ?>
</td>
<td>
<?php 
// CEA 
$sqlCEA="SELECT b.result, b.flag 
FROM ( 
    SELECT *, MAX(`autonumber`) AS `latest_number` FROM `resulthead` WHERE `hn` = '$pt_hn' AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' AND `profilecode` = 'CEA' GROUP BY `profilecode` 
) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode = 'CEA' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
GROUP BY a.`profilecode` ";
$query10=mysql_query($sqlCEA);
list($cea,$flag)=mysql_fetch_array($query10);

if($flag=="N"){
	echo $cea;
}else{
	echo "<strong style='color:#FF0000'>$cea</strong>";
}
?>
</td>
<td>
<?php 
// CEA 
$sqlPSA="SELECT b.result, b.flag 
FROM ( 
    SELECT *, MAX(`autonumber`) AS `latest_number` FROM `resulthead` WHERE `hn` = '$pt_hn' AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' AND `profilecode` = 'PSA' GROUP BY `profilecode` 
) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode = 'PSA' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
GROUP BY a.`profilecode` ";
$query10=mysql_query($sqlPSA);
list($psa,$flag)=mysql_fetch_array($query10);

if($flag=="N"){
	echo $psa;
}else{
	echo "<strong style='color:#FF0000'>$psa</strong>";
}
?>
</td>
<!-- Anti-HAV IgG -->
<td align="center">
    <?php 

    $sql = "SELECT b.`result`, b.`flag` 
    FROM ( 

        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$pt_hn' 
        AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
        AND `profilecode` = 'HAVTOT' 
        GROUP BY `profilecode` 

    ) AS a
    INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
    WHERE b.result !='DELETE' OR b.result !='*' ";
    
    $query13 = mysql_query($sql);
    list($result, $flag) = mysql_fetch_array($query13);

    echo $result;
    ?>
</td>
<!-- Anti HAV IgM -->
<td align="center">
    <?php 

    $sql = "SELECT b.`result`, b.`flag` 
    FROM ( 

        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$pt_hn' 
        AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
        AND `profilecode` = 'AHAV' 
        GROUP BY `profilecode` 

    ) AS a
    INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
    WHERE b.result !='DELETE' OR b.result !='*' ";
    
    $query13 = mysql_query($sql);
    list($result, $flag) = mysql_fetch_array($query13);

    echo $result;
    ?>
</td>
<!-- WET ตรวจอุจจาระสมบูรณ์แบบ Stool Exam -->
<td align="center">
    <?php 
    $sqlStool = "SELECT b.`result`, b.`flag` 
    FROM ( 
        SELECT *, MAX(`autonumber`) AS `latest_number` 
        FROM `resulthead` 
        WHERE `hn` = '$pt_hn' 
        AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
        AND `profilecode` = 'STOOL' 
        GROUP BY `profilecode` 
    ) AS a 
    INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber` 
    WHERE ( b.`labcode` = 'PARASI' AND b.`labname` = 'Parasite or ova' ) 
    AND ( b.`result` !='DELETE' AND b.`result` !='*' ) ";
    $qStool = mysql_query($sqlStool) or die(mysql_error());
    $resutlWET = "";
    if (mysql_num_rows($qStool) > 0) {
        list($result, $flag) = mysql_fetch_array($qStool);

        if($result!='*' OR $result!='DELETE')
        {
            if( $flag != 'N' ){
                $resutlWET = 'ผิดปกติ';
            }elseif ($flag != 'Y') {
                $resutlWET = 'ปกติ';
            }
        }
        
    }
    
    echo '<span title="'.$result.'">'.$resutlWET.'</span>';
    ?>
</td> 
<!-- Stool Culture -->
<td align="center"><?php echo $cs; ?></td>

<?php
// ตรวจเลือดในอุจจาระ - Stool Occult
$sql_stocc = "SELECT b.`result`, b.`flag` 
FROM ( 
    SELECT *, MAX(`autonumber`) AS `latest_number`
    FROM `resulthead` 
    WHERE `hn` = '$pt_hn' 
    AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
    AND `profilecode` = 'STOCC' 
    GROUP BY `profilecode` 
) AS a
INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
WHERE b.result !='DELETE' OR b.result !='*' ";
$q_stocc = mysql_query($sql_stocc) or die(mysql_error());

$stoccTxt = '';
if(mysql_num_rows($q_stocc) > 0)
{
    list($stoccRes, $flag) = mysql_fetch_array($q_stocc);
    if( $stoccRes == 'Negative' ){
        $stoccTxt = 'ปกติ';
    }elseif ( $stoccRes == 'Positive' ) {
        $stoccTxt = 'ผิดปกติ';
    }
}
?>
<td align="center"><?=$stoccTxt;?></td>

<?php
// ตรวจการติดเชื้อแบคทีเรีย โรคไข้ฉี่หนู (Leptospira Ab IgM)
// ตรวจการติดเชื้อแบคทีเรีย โรคไข้ฉี่หนู (Leptospira Ab IgG)
$sqlIgM = "SELECT b.`result`, b.`flag` 
FROM ( 
    SELECT *, MAX(`autonumber`) AS `latest_number`
    FROM `resulthead` 
    WHERE `hn` = '$pt_hn' 
    AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
    AND `profilecode` = '36007' 
    GROUP BY `profilecode` 
) AS a
INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
WHERE b.result !='DELETE' OR b.result !='*' ";
$qIgM = mysql_query($sqlIgM) or die(mysql_error());
if(mysql_num_rows($qIgM) > 0)
{
    while ($a = mysql_fetch_assoc($qIgM)) {
        ?>
        <td align="center"><?=$a['result'];?></td>
        <?php
    }
}else{
    ?>
    <td></td>
    <td></td>
    <?php
}
?>
<td align="center">
<?php 
$sql14="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'METAMP' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk'
GROUP BY a.`profilecode` ";

$query14=mysql_query($sql14);
list($hbsag,$flag)=mysql_fetch_array($query14);

if($hbsag=="Negative"){
	echo "ปกติ";
}else if($hbsag=="Positive"){
	echo "<strong style='color:#FF0000'>ผิดปกติ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql17="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'ABOC' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk'
GROUP BY a.`profilecode` ";
$query17=mysql_query($sql17);
list($aboc,$flag)=mysql_fetch_array($query17);
if($flag=="N"){
	echo $aboc;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$aboc</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td>
    <?php 
    if(!empty($result2['ekg']))
    {
        echo $result2['ekg'];
    }
	?>
    </td>
    <td>
	<?php
	if($month=="8"  || $month=="9"){
		echo "&nbsp;";
	}else{
		if($result2["va"]==""){ echo "ปกติ"; }else{ echo $result2["va"];}
	}
	?></td>
    <td><? 
		if($result2["eye"]=="ปกติ"){ echo $result2["eye"]; }else if($result2["eye"]=="ผิดปกติ"){ echo $result2["eye"]."...".$result2["eye_detail"];}else{ echo "&nbsp;";}
	?></td>
    <td>
	<?php
        $ptDetail = '';
        if(!empty($result2['pt_detail'])){
            $ptDetail = $result2['pt_detail'];
        }
        echo $result2['pt'].' '.$ptDetail;
		// if($result2["pt"]=="ปกติ"){ echo $result2["pt"]; }else if($result2["pt"]=="ปอดจำกัดการขยายตัว" || $result2["pt"]=="ปอดอุดกั้น"){ echo $result2["pt"]."...".$result2["pt_detail"];}else{ echo "&nbsp;";}
	?>
    </td>
    <td>
    <?php
    //อัลตร้าซาวด์ช่องท้อง
    if( !empty($result2['altra']) ){
        echo $result2['altra'];
    }
    ?>
    </td>
    <td>
    <?php
    // ตรวจคัดกรองหาความเสี่ยงของโรคเส้นเลือดแดงตีบตัน
    if( !empty($result2['cimt']) ){
        echo $result2['cimt'];
    }
    ?>
    </td>
    <td>
    <?php
    // ตรวจหัวใจด้วยคลื่นเสียงสะท้อนความถี่สูง
    if( !empty($result2['echo']) ){
        echo $result2['echo'];
    }
    ?>
    </td>
    <td>
    <?php
    // ตรวจวัดความแข็งตัวของหลอดเลือด
    if( !empty($result2['abi']) ){
        echo $result2['abi'];
    }
    ?>
    </td>
    <td>
        <!-- สายตาอาชีวอนามัย + สายตาสั้น, ยาว -->
        <?=(!empty($result2['occupa_health']) ? $result2['occupa_health'] : '' );?>
    </td>
    <td>
    <?php 
    // ต่อมลูกหมากโดยการคลำ
    if( !empty($result2['psa']) ){
        echo $result2['psa'];
    }
    ?>
    </td>
    <td>
    <?php 
    // ความดันตา
    if( !empty($result2["eye_pressure"]) ){
        echo $result2["eye_pressure"].( !empty($result2["eye_pressure_detail"]) ? $result2["eye_pressure_detail"] : '' );
    }
    ?>
    </td>
    <td>
    <?php 
    // ลานสายตา
    if( !empty($result2["eye_vision"]) ){
        echo $result2["eye_vision"].( !empty($result2["eye_vision_detail"]) ? $result2["eye_vision_detail"] : '' );
    }
    ?>
    </td>
    
    <td width="12%"><?=!empty($result2['congenital_disease']) ? $result2['congenital_disease'] : '' ; ?></td>
    <td width="12%"><?=!empty($result2['accidents_surgery']) ? $result2['accidents_surgery'] : '' ; ?></td>
    <td width="12%"><?=!empty($result2['treatment']) ? $result2['treatment'] : '' ; ?></td>
    <td width="12%"><?=!empty($result2['record']) ? $result2['record'] : '' ; ?></td>

    <td>
        <!-- ภาวะสุขภาพโดยรวม -->
    </td>
    <td>
    <?php 
    // ผลการได้ยิน
    if( !empty($hearing) ){
        echo $hearing;
    }
    ?>
    </td>
    <td>
    <?php 
    // แมมโมแกรม
    if( !empty($result2["mammogram"]) ){
        echo $result2["mammogram"];
    }
    ?>
    </td>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<? } ?>  
</table>
<p align="center">PE = การตรวจร่างกายทั่วไป  BS = น้ำตาลในเลือด  CHOL,TRI, HDL, LDL= ไขมันในเลือด BUN, CR= การทำงานของไต  URIC = กรดยูริค SGOT,SGPT, ALK = การทำงานของตับ<br />
HBsAg = เชื้อไวรัสตับอักเสบ  FOBT = เลือดในอุจจาระ METAMP = ตรวจหาสารเสพติด ABOC = กรุ๊ปเลือด EKG = คลื่นหัวใจไฟฟ้า V/A = ตรวจตา</p>
</body>
</html>
