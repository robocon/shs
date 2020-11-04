<?php
include 'bootstrap.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
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
$out_result_sql = mysql_query($sql) or die ( mysql_error() );
$num = mysql_num_rows($out_result_sql);

$q = mysql_query("SELECT `date_checkup` AS `show_date`, `name` AS `company_name` 
FROM `chk_company_list` 
WHERE `code` = '$camp' ") or die ( mysql_error() );
$company = mysql_fetch_assoc($q);
?>	
<body>
<div align="center"><strong>ผลการตรวจสุขภาพเจ้าหน้าที่ <?=$company['company_name'];?>  บริการตรวจสุขภาพ ณ โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div>
<div align="center"><strong>ระหว่างวันที่ <?=$company['show_date'];?> จำนวน <?=$num;?> ราย</strong></div>
<table width="100%" class="chk_table">
  <tr>
    <th width="3%" rowspan="2" align="center">ลำดับ</th>
    <th width="5%" rowspan="2" align="center">HN</th>
    <th width="15%" rowspan="2" align="center">ชื่อ - สกุล</th>
    <th width="4%" rowspan="2" align="center">อายุ</th>
    <th width="5%" rowspan="2" align="center">น้ำหนัก</th>
    <th width="5%" rowspan="2" align="center">ส่วนสูง</th>
    <th width="5%" rowspan="2" align="center">BP</th>
    <th colspan="31" align="center">รายการตรวจ</th>
    <th width="8%" rowspan="2" align="center">ภาวะสุขภาพโดยรวม</th>
    <th colspan="2" align="center">สรุปผลการตรวจ</th>
  </tr>

  <tr>
    <th width="3%" align="center">PE</th>
    <th width="7%" align="center">X-RAY</th>
    <th width="5%" align="center">CBC</th>
    <th width="5%" align="center">UA</th>
    <th width="5%" align="center">BS</th>
    <th width="6%" align="center">CHOL</th>
    <th width="6%" align="center">TRIG</th>
    <th width="5%" align="center">HDL</th>
    <th width="5%" align="center">LDL</th>
    <th width="5%" align="center">BUN</th>
    <th width="3%" align="center">CR</th>
    <th width="3%" align="center">eGFR</th>
    <th width="6%" align="center">URIC</th>
    <th width="7%" align="center">SGOT</th>
    <th width="6%" align="center">SGPT</th>
    <th width="4%" align="center">ALK</th>
    <th width="7%" align="center">HBsAg</th>
    <th width="6%" align="center">FOBT</th>
    <th width="6%" align="center">AFP</th>
    <th width="6%" align="center">Anti-HAV IgG</th>
    <th width="6%" align="center">Stool Exam</th>
    <th width="6%" align="center">Stool Culture</th>
    <th width="6%" align="center">Stool Occult</th>

    <th width="6%" align="center">METAMP</th>
    <th width="5%" align="center">ABOC</th>
    <th width="6%" align="center">EKG</th>
    <th width="6%" align="center">V/A</th>
    <th width="6%" align="center">สายตา</th>
    <th width="6%" align="center">สมรรถภาพปอด</th>
    <th width="6%" align="center">อัลตร้าซาวด์<br>ช่องท้อง</th>
    <th width="6%" align="center">ต่อมลูกหมาก<br>โดยการคลำ</th>
    <th width="5%" align="center">พบแพทย์</th>
    <th width="6%" align="center">ไม่พบแพทย์</th>
  </tr>
<?php
$i=0;
while($result = mysql_fetch_array($out_result_sql)){

    $yaer_chk = $result['year_chk'];
    $pt_hn = $result['hn'];
    $age = $result["age"];
    $cs = $result["cs"];

    if(empty($result["HN"])){
        $result["HN"] = $result["hn"];
    }

    $sql2 = "select * from out_result_chkup where hn='$pt_hn' AND `part` = '$camp'";
    $query2 = mysql_query($sql2);
    $result2 = mysql_fetch_array($query2);

    if(empty($age)){
        $age=$result2["age"];
    }

    /*
    // กรณีที่มี labnumber จากใน chk_lab_items
    $defLabNumber = "AND `labnumber` = '$exam_no'";
    $sql = "SELECT `labnumber` FROM `chk_lab_items` WHERE `part` = '$showpart' AND `hn` = '$hn' ";
    $q = mysql_query($sql) or die(mysql_error());
    if (mysql_num_rows($q) > 0) {
        $labItemList = array();
        while ($labChk = mysql_fetch_assoc($q)) { 
            $testLabnumber = $labChk['labnumber'];
            $labItemList[] = " `labnumber` = '$testLabnumber' ";
        }
        $defLabNumber = implode(' OR ', $labItemList);
        $defLabNumber = " AND ( $defLabNumber )";
    }
    */

    $i++;
    $ptname=$result2["ptname"];
    if($result2["bp1"] && $result2["bp2"]){
        $bp=$result2["bp1"]."/".$result2["bp2"];
    }else if($result2["bp3"] && $result2["bp4"]){
        $bp=$result2["bp3"]."/".$result2["bp4"];
    }else{
        $bp="&nbsp;";
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
	
    $objQuery11 = mysql_query($strSQL11);
    list($orderdate)=mysql_fetch_array($objQuery11);
	
	list($d,$m,$y)=explode("-",$orderdate);
	$yy=$y+543;
	$showdate="$d/$m/$yy";
	$dateekg="$yy-$m";	
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result["HN"];?></td>
    <td><?=$ptname;//."->".$result2["part"];?></td>
    <td align="center"><?=$age;?></td>
    <td align="center"><?=$result2["weight"];?></td>
    <td align="center"><?=$result2["height"];?></td>
    <td align="center"><?=$bp;?></td>
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
$queryStat = mysql_query("SELECT `stat_cbc`,`stat_ua` FROM `condxofyear_out` WHERE `hn` = '$pt_hn' ORDER BY `row_id` DESC LIMIT 1");
$dxStat = mysql_fetch_assoc($queryStat);
$stat_cbc = $dxStat['stat_cbc'];
$stat_ua = $dxStat['stat_ua'];

$sql18="SELECT * 
FROM resulthead 
WHERE profilecode = 'CBC' 
AND hn = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
GROUP BY `profilecode` ";

$query18=mysql_query($sql18);
$numcbc=mysql_num_rows($query18);
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
?></td>
    <td align="center"><?php
$sql19="SELECT * 
FROM resulthead WHERE profilecode = 'UA' AND hn = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
GROUP BY `profilecode` ";
//echo $sql19;
$query19=mysql_query($sql19);
$numua=mysql_num_rows($query19);
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
?></td>
    <td align="center"><?php
$sql1="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'GLU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
GROUP BY a.`profilecode` ";
//echo $sql1;
$query1=mysql_query($sql1);
list($glu,$flag)=mysql_fetch_array($query1);
if($flag=="N" || $flag=="L"){
	echo $glu;
}else if($flag=="H"){
	echo "<strong style='color:#FF0000'>$glu</strong>";
}else{
	echo "&nbsp;";
}
?>    </td>
    <td align="center"><?php
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
//echo $sql2;
$query2=mysql_query($sql2);
list($chol,$flag)=mysql_fetch_array($query2);

if($flag=="N"){
	echo $chol;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$chol</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?php
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
//echo $sql3;
$query3=mysql_query($sql3);
list($trig,$flag)=mysql_fetch_array($query3);

if($flag=="N"){
	echo $trig;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$trig</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?php
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
//echo $sql4;
$query4=mysql_query($sql4);
list($hdl,$flag)=mysql_fetch_array($query4);

if($flag=="N" || $flag=="H"){
	echo $hdl;
}else if($flag=="L"){
	echo "<strong style='color:#FF0000'>$hdl</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql5="SELECT b.result, b.flag 
FROM ( 

SELECT *, MAX(`autonumber`) AS `latest_number`
FROM `resulthead` 
WHERE `hn` = '$pt_hn' 
AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
AND ( `profilecode` = 'LDL' OR `profilecode` = 'LDLC' OR `profilecode` = '10001' ) 
GROUP BY `profilecode` 

) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE (b.labcode = 'LDL' OR b.labcode = 'LDLC' OR b.labcode='10001') AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
GROUP BY a.`profilecode` ";

$query5=mysql_query($sql5);
list($ldl,$flag)=mysql_fetch_array($query5);

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
AND `profilecode` = 'URIC' 
GROUP BY `profilecode` 

) AS a
INNER JOIN resultdetail AS b ON a.latest_number = b.autonumber
WHERE b.labcode = 'URIC' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
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
    <td align="center"><?
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
	echo "ไม่พบเชื้อ";
}else if($hbsag=="Positive"){
	echo "<strong style='color:#FF0000'>พบเชื้อ</strong>";
}else{
	echo "&nbsp;";
}
?></td>
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
list($hbsag,$flag)=mysql_fetch_array($query13);

if($hbsag=="Negative"){
	echo "ไม่พบเลือด";
}else if($hbsag=="Positive"){
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
<!-- Anti-HAV IgG -->
<td align="center">
    <?php 

    $hn = $result['HN'];

    $sql = "SELECT b.`result`, b.`flag` 
    FROM ( 

        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
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
<!-- WET ตรวจอุจจาระสมบูรณ์แบบ Stool Exam -->
<td align="center">
    <?php 
    $sql = "SELECT b.`result`, b.`flag` 
    FROM ( 
        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
        AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
        AND `profilecode` = 'WET' 
        GROUP BY `profilecode` 
    ) AS a
    INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
    WHERE b.result !='DELETE' OR b.result !='*' ";
    $query13 = mysql_query($sql);
    $resutlWET = "";
    if (mysql_num_rows($query13) > 0) {
        list($result, $flag) = mysql_fetch_array($query13);
        $resutlWET = 'ปกติ';
        if( $flag != 'N' ){
            $resutlWET = 'ผิดปกติ';
        }
    }
    echo $resutlWET;
    ?>
</td> 
<!-- Stool Culture -->
<td align="center"><?php echo $cs; ?></td>

<?php
// ตรวจเลือดในอุจจาระ - Stool Occult
$sql = "SELECT b.`result`, b.`flag` 
FROM ( 

    SELECT *, MAX(`autonumber`) AS `latest_number`
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND `clinicalinfo` ='ตรวจสุขภาพประจำปี$yaer_chk' 
    AND `profilecode` = 'STOCC' 
    GROUP BY `profilecode` 

) AS a
INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
WHERE b.result !='DELETE' OR b.result !='*' ";
$query13 = mysql_query($sql);
list($stoccRes, $flag) = mysql_fetch_array($query13);
$stoccTxt = '';
if( $stoccRes == 'Negative' ){
    $stoccTxt = 'ปกติ';
}elseif ( $stoccRes == 'Positive' ) {
    $stoccTxt = 'ผิดปกติ';
}

?>
<td align="center"><?=$stoccTxt;?></td>

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
//echo $sql1;
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
    <td><? 
	$sql3="select * from patdata where hn='$pt_hn' and code='51410' and date like '$dateekg%' order by row_id desc";
	//echo $sql3;
	$query3=mysql_query($sql3);
	$num3=mysql_num_rows($query3);
	if(!empty($num3)){  //ถ้ามีการคิดค่าใช้จ่าย
		if($result["HN"]=="56-9685"){ echo $result2["ekg"]; }else{ echo "ปกติ"; }
	}else if($result["HN"]=="60-5189"){  //ตรวจแต่ไม่ได้คิดค่าใช้จ่าย
		echo "ปกติ";
	}
	 ?></td>
    <td>
	<? 
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
	<? 
		if($result2["pt"]=="ปกติ"){ echo $result2["pt"]; }else if($result2["pt"]=="ปอดจำกัดการขยายตัว" || $result2["pt"]=="ปอดอุดกั้น"){ echo $result2["pt"]."...".$result2["pt_detail"];}else{ echo "&nbsp;";}
	?></td>
    <td>
    <?php
    if( !empty($result['altra']) ){
        echo $result['altra'];
    }
    ?>
    </td>
    <td>
    <?php 
    // ต่อมลูกหมากโดยการคลำ
    if( !empty($result['psa']) ){
        echo $result['psa'];
    }
    ?>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
  </tr>
<? } ?>  
</table>
<p align="center">PE = การตรวจร่างกายทั่วไป  BS = น้ำตาลในเลือด  CHOL,TRI, HDL, LDL= ไขมันในเลือด BUN, CR= การทำงานของไต  URIC = กรดยูริค SGOT,SGPT, ALK = การทำงานของตับ<br />
HBsAg = เชื้อไวรัสตับอักเสบ  FOBT = เลือดในอุจจาระ METAMP = ตรวจหาสารเสพติด ABOC = กรุ๊ปเลือด EKG = คลื่นหัวใจไฟฟ้า V/A = ตรวจตา</p>
</body>
</html>
