<?php
include 'bootstrap.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ��ػ�ŵ�Ǩ�آ�Ҿ</title>
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

$camp = '������������������63(2)';

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

$q = mysql_query("SELECT `date_checkup` AS `show_date`, `name` AS `company_name` FROM `chk_company_list` WHERE `code` = '$camp' ") or die ( mysql_error() );
$company = mysql_fetch_assoc($q);
?>	
<body>
<div align="center"><strong>�š�õ�Ǩ�آ�Ҿ���˹�ҷ�� <?=$company['company_name'];?>  ��ԡ�õ�Ǩ�آ�Ҿ � �ç��Һ�Ť�������ѡ��������</strong></div>
<div align="center"><strong>�����ҧ�ѹ��� <?=$company['show_date'];?> �ӹǹ <?=$num;?> ���</strong></div>
<table width="150%" class="chk_table">
  <tr>
    <th width="5%" rowspan="2" align="center">�ӴѺ</th>
    <th width="5%" rowspan="2" align="center">HN</th>
    <th width="15%" rowspan="2" align="center">���� - ʡ��</th>
    <th width="5%" rowspan="2" align="center">����</th>
    <th width="5%" rowspan="2" align="center">���˹ѡ</th>
    <th width="5%" rowspan="2" align="center">��ǹ�٧</th>
    <th width="5%" rowspan="2" align="center">BP</th>
    <th colspan="36" align="center">��¡�õ�Ǩ</th>
    <th width="8%" rowspan="2" align="center">�����آ�Ҿ�����</th>
    <th colspan="2" align="center">��ػ�š�õ�Ǩ</th>
  </tr>

  <tr>
    <th width="5%" align="center">PE</th>
    <th width="5%" align="center">X-RAY</th>
    <th width="5%" align="center">CBC</th>
    <th width="5%" align="center">UA</th>
    <th width="5%" align="center">BS</th>
    <th width="5%" align="center">CHOL</th>
    <th width="5%" align="center">TRIG</th>
    <th width="5%" align="center">HDL</th>
    <th width="5%" align="center">LDL</th>
    <th width="5%" align="center">BUN</th>
    <th width="5%" align="center">CR</th>
    <th width="5%" align="center">URIC</th>
    <th width="5%" align="center">SGOT</th>
    <th width="5%" align="center">SGPT</th>
    <th width="5%" align="center">ALK</th>
    <th width="5%" align="center">HBsAg</th>
    <th width="5%" align="center">FOBT</th>

    <th width="5%" align="center">Anti-HAV IgG</th>
    <th width="5%" align="center">Stool Exam</th>
    <th width="5%" align="center">Stool Culture</th>
    <th width="5%" align="center">Stool Occult</th>
    <th width="5%" align="center">eGFR</th>

    <th width="5%" align="center">AFP</th>
    <th width="5%" align="center">PSA</th>
    <th width="5%" align="center">CEA</th>
    
    <th width="5%" align="center">METAMP</th>
    <th width="5%" align="center">ABOC</th>
    <th width="5%" align="center">EKG</th>
    <th width="5%" align="center">V/A</th>
    <th width="10%" align="center">��µ�</th>
    <th width="10%" align="center">���ö�Ҿ�ʹ</th>
    <th width="10%" align="center">��ŵ��ҫ�Ǵ�<br>��ͧ��ͧ</th>
    <th width="10%" align="center">�����١��ҡ<br>�¡�ä��</th>

    <th width="10%" align="center">�š�õ�Ǩ����移ҡ���١</th>
    <th width="10%" align="center">�š�õ�Ǩ��������</th>
    <th width="10%" align="center">�ŵ�Ǩ����˹��蹢ͧ��š�д١</th>

    <th width="10%" align="center">��ᾷ��</th>
    <th width="10%" align="center">��辺ᾷ��</th>
  </tr>
<?php
$i=0;
while($result = mysql_fetch_array($out_result_sql)){

    $yaer_chk = $result['year_chk'];
    $pt_hn = $result['hn'];
    $age = $result["age"];
    $cs = $result["cs"];
    $exam_no = $result["exam_no"];

    if(empty($result["HN"])){
        $result["HN"] = $result["hn"];
    }

    $hn = $result['HN'];

    $sql2 = "select * from out_result_chkup where hn='$pt_hn' AND `part` = '$camp'";
    $query2 = mysql_query($sql2);
    $result2 = mysql_fetch_array($query2);

    if(empty($age)){
        $age=$result2["age"];
    }

    // �óշ���� labnumber �ҡ� chk_lab_items
    $defLabNumber = "AND `labnumber` = '$exam_no'";
    $sql = "SELECT `labnumber` FROM `chk_lab_items` WHERE `part` = '$camp' AND `hn` = '$pt_hn' ";
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

    $i++;
    $ptname=$result2["ptname"];
    if($result2["bp1"] && $result2["bp2"]){
        $bp=$result2["bp1"]."/".$result2["bp2"];
    }else if($result2["bp3"] && $result2["bp4"]){
        $bp=$result2["bp3"]."/".$result2["bp4"];
    }else{
        $bp="&nbsp;";
    }
    if($result["congenital_disease"]=="����ʸ" || empty($result["congenital_disease"])){
        $disease="�����";
    }else{
        $disease="��";
    }

    $sql = "SELECT `labnumber` FROM `chk_lab_items` WHERE `part` = '$camp' AND `hn` = '$hn' ";
    $q = mysql_query($sql);
    // $db->select($sql);
    $labItemList = array();
    while ($testLab = mysql_fetch_assoc($q)) {
        # code...
        $labItemList[] = $testLab;
    }

	// $labItemList = $db->get_items();
	$labnumberArray = array();
	foreach ($labItemList as $key => $lit) {
		$labnumberArray[] = " `labnumber` = '".$lit['labnumber']."'";
	}
	$whereLabnumber = implode(' OR ', $labnumberArray);
	$whereLabnumber = "( $whereLabnumber )";


    $strSQL11 = "SELECT date_format(`orderdate`,'%d-%m-%Y') as orderdate2 
    FROM `resulthead` 
    WHERE `hn` = '".$result['HN']."' 
    AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
    order by autonumber desc";  //��������
	
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
            echo "����"; 
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

// CBC
$sql18="SELECT * 
FROM resulthead 
WHERE profilecode = 'CBC' 
AND hn = '$pt_hn' 
AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
AND $whereLabnumber 
GROUP BY `profilecode` ";
$query18=mysql_query($sql18);
$numcbc=mysql_num_rows($query18);
if($numcbc > 0){
    echo "��";
    if( !empty($stat_cbc) ){
        echo "($stat_cbc)";
    }
}else if($numcbc < 1){
	echo "<strong style='color:#FF0000'>�����</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?php 
// UA 
$sql19="SELECT * 
FROM resulthead 
WHERE profilecode = 'UA' 
AND hn = '$pt_hn' 
AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
AND $whereLabnumber 
GROUP BY `profilecode` ";
$query19=mysql_query($sql19);
$numua=mysql_num_rows($query19);
if($numua > 0){
    echo "��";
    if( !empty($stat_ua) ){
        echo "($stat_ua)";
    }
}else if($numua < 1){
	echo "<strong style='color:#FF0000'>�����</strong>";
}else{
	echo "&nbsp;";
}
?></td> 

<?php 
// �Ż���� �������� CBC ��� UA
$sql1 = "SELECT x.`profilecode`,x.`autonumber`,b.seq 
FROM ( 
    SELECT MAX(`autonumber`) AS `latest_id` 
    FROM `resulthead` 
    WHERE `hn` = '$pt_hn' AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
	AND $whereLabnumber 
    AND ( 
		`profilecode` != 'CBC' 
        AND `profilecode` != 'UA' 
		AND `profilecode` != 'AFP' 
		AND `profilecode` != 'CEA' 
		AND `profilecode` != 'PSA' 
		AND `profilecode` != 'CA125' 
		AND `profilecode` != '38302' 

		AND `profilecode` != 'AHAV' 
		AND `profilecode` != 'BENZEN' 
		AND `profilecode` != 'XYLENE' 
		AND `profilecode` != 'WET' 
    ) 
	GROUP BY `profilecode` 
) AS a 
LEFT JOIN `resulthead` AS x ON x.`autonumber` = a.`latest_id` 
LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_id` 
WHERE b.`result` != 'DELETE' 
GROUP BY x.`profilecode` 
ORDER BY b.`seq` ASC, a.`latest_id` ASC ";
$query1 = mysql_query($sql1) or die( mysql_error() );
$otherResultLists = mysql_num_rows($query1);

$otherList = array();
while ($other = mysql_fetch_assoc($query1)) {
    $key = $other['profilecode'];
    $otherList[$key] = $other['autonumber'];
}

?>




    <!-- BS -->
    <td align="center">
    <?php 
    $autonumber = '';
    $autonumber = $otherList['GLU'];

$sql1="SELECT b.result, b.flag 
FROM resulthead AS a 
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'GLU' 
AND (b.result !='DELETE' OR b.result !='*') 
AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
GROUP BY a.`profilecode` ";


$sql1 = "SELECT b.`result`, b.`flag` 
FROM ( 
    select `autonumber` 
    from `resulthead` 
    where `hn` = '$pt_hn' 
    and `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
    and `autonumber` = '$autonumber' 
) AS a 
LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
WHERE (b.`result` !='DELETE' OR b.`result` !='*') ";
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
    $autonumber = '';
    $autonumber = $otherList['CHOL'];

$sql2="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'CHOL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
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
    $autonumber = '';
    $autonumber = $otherList['TRIG'];
$sql3="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'TRIG' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
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
    $autonumber = '';
    $autonumber = $otherList['HDL'];
$sql4="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'HDL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
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
    <td align="center"><?php 

    $autonumber = '';
    if ($otherList['LDL']) {
        $autonumber = $otherList['LDL'];
    }elseif ($otherList['LDLC']) {
        $autonumber = $otherList['LDLC'];
    }elseif ($otherList['10001']) {
        $autonumber = $otherList['10001'];
    }

$sql5="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE (b.labcode = 'LDL' OR b.labcode = 'LDLC' OR b.labcode='10001') AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
GROUP BY a.`profilecode` ";
//echo $sql5;
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
    <td align="center"><?php 
    $autonumber = '';
    $autonumber = $otherList['BUN'];
$sql6="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'BUN' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
GROUP BY a.`profilecode` ";
//echo $sql6;
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
    $autonumber = '';
    $autonumber = (!empty($otherList['CREA'])) ? $otherList['CREA'] : (!empty($otherList['CREAG']) ? $otherList['CREAG'] : '' );
    // $autonumber = $otherList['CREAG'];
    $sql7="SELECT b.result, b.flag 
    FROM resulthead AS a 
    INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
    WHERE ( b.labcode = 'CREA' OR b.labcode = 'CREAG' ) AND b.result !='DELETE' AND a.hn = '$pt_hn' 
    AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk'
    GROUP BY a.`profilecode` ";
    //echo $sql7;
    $query7=mysql_query($sql7);
    list($crea,$flag)=mysql_fetch_array($query7);

    if($flag=="N"){
        echo $crea;
    }else{
        echo "<strong style='color:#FF0000'>$crea</strong>";
    }
?>
</td>
    <td align="center"><?php 
    $autonumber = '';
    $autonumber = $otherList['URIC'];
$sql8="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'URIC' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
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
    <td align="center"><?php 
    $autonumber = '';
    $autonumber = $otherList['AST'];
$sql9="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'AST' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
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
    <td align="center"><?php 
    $autonumber = '';
    $autonumber = $otherList['ALT'];
$sql10="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'ALT' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
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
    <td align="center"><?php 
    $autonumber = '';
    $autonumber = $otherList['ALP'];
$sql11="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'ALP' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk'
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
    <td align="center"><?php 
    $autonumber = '';
    $autonumber = $otherList['HBSAG'];
$sql12="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'HBSAG' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk'
GROUP BY a.`profilecode` ";
//echo $sql12;
$query12=mysql_query($sql12);
list($hbsag,$flag)=mysql_fetch_array($query12);

if($hbsag=="Negative"){
	echo "��辺����";
}else if($hbsag=="Positive"){
	echo "<strong style='color:#FF0000'>������</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?php 
    $autonumber = '';
    $autonumber = $otherList['OCCULT'];
$sql13="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON b.autonumber = '$autonumber' 
WHERE b.labcode = 'OCCULT' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk'
GROUP BY a.`profilecode` ";
//echo $sql13;
$query13=mysql_query($sql13);
list($hbsag,$flag)=mysql_fetch_array($query13);

if($hbsag=="Negative"){
	echo "��辺���ʹ";
}else if($hbsag=="Positive"){
	echo "<strong style='color:#FF0000'>�����ʹ</strong>";
}else{
	echo "&nbsp;";
}
?></td>

<!-- Anti-HAV IgG -->
<td align="center">
    <?php 

    

    $sql = "SELECT b.`result`, b.`flag` 
    FROM ( 

        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
        AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
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
<td align="center">
    <?php 
    $sql = "SELECT b.`result`, b.`flag` 
    FROM ( 

        SELECT *, MAX(`autonumber`) AS `latest_number`
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
        AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
        AND `profilecode` = 'WET' 
        GROUP BY `profilecode` 

    ) AS a
    INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
    WHERE b.result !='DELETE' OR b.result !='*' ";
    // dump($sql);
    $query13 = mysql_query($sql);
    list($result, $flag) = mysql_fetch_array($query13);

    // echo $result;

    $result_outlab_txt = '����';
    if( $flag != 'N' ){
        $result_outlab_txt = '�Դ����';
    }
    echo $result_outlab_txt;
    ?>
</td> 
<!-- Stool Culture -->
<td align="center"><?php echo $cs; ?></td>

<?php
// ��Ǩ���ʹ��ب���� - Stool Occult
$sql = "SELECT b.`result`, b.`flag` 
FROM ( 

    SELECT *, MAX(`autonumber`) AS `latest_number`
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
    AND `profilecode` = 'STOCC' 
    GROUP BY `profilecode` 

) AS a
INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
WHERE b.result !='DELETE' OR b.result !='*' ";
$query13 = mysql_query($sql);
list($stoccRes, $flag) = mysql_fetch_array($query13);
$stoccTxt = '';
if( $stoccRes == 'Negative' ){
    $stoccTxt = '����';
}elseif ( $stoccRes == 'Positive' ) {
    $stoccTxt = '�Դ����';
}

?>
<td align="center"><?=$stoccTxt;?></td>

<!-- eGFR -->
<td align="center">
    <?php 
    $sql = "SELECT b.`result`, b.`flag` 
    FROM ( 
        SELECT MAX(`autonumber`) AS `latest_number` 
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
        AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
        $defLabNumber 
        AND `profilecode` = 'CREAG' 
    ) AS a
    INNER JOIN `resultdetail` AS b ON a.`latest_number` = b.`autonumber`
    WHERE b.`labname` LIKE 'eGFR%' 
	AND ( b.result != 'DELETE' OR b.result != '*' )";
    $query13 = mysql_query($sql);
    list($result, $flag) = mysql_fetch_array($query13);
    echo $result;
    ?>
</td>

<?php 

$sql = "SELECT a.*, c.`labcode`, c.`result`,c.`normalrange`,c.`flag`
FROM (
	SELECT MAX(`autonumber`) AS `autonumber`
	FROM `resulthead` 
	WHERE `hn` = '$hn' 
	AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
	AND $whereLabnumber 
	AND `testgroupcode` = 'OUT' 
	GROUP BY `profilecode` 
) AS b 
LEFT JOIN `resulthead` AS a ON a.`autonumber` = b.`autonumber` 
LEFT JOIN `resultdetail` AS c ON c.`autonumber` = b.`autonumber` 
ORDER BY c.seq ASC";
$outlab_query = mysql_query($sql) or die( mysql_error() );

$outLists = array();
while( $outlab = mysql_fetch_assoc($outlab_query)){ 
    $key = $outlab['labcode'];
    $outLists[$key] = $outlab['result'];
}

$AFP = ( !empty($outLists['AFP']) ) ? $outLists['AFP'] : '' ;
$PSA = ( !empty($outLists['PSA']) ) ? $outLists['PSA'] : '' ;
$CEA = ( !empty($outLists['CEA']) ) ? $outLists['CEA'] : '' ;
?>
<td><?=$AFP;?></td>
<td><?=$PSA;?></td>
<td><?=$CEA;?></td>

<td align="center">
<?php 
$sql14="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'METAMP' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk'
GROUP BY a.`profilecode` ";

$query14=mysql_query($sql14);
list($hbsag,$flag)=mysql_fetch_array($query14);

if($hbsag=="Negative"){
	echo "����";
}else if($hbsag=="Positive"){
	echo "<strong style='color:#FF0000'>�Դ����</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql17="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'ABOC' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk'
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
?>
</td>
<td>
    <!-- ��Ǩ EKG -->
    <?php 
	$sql3="select * from patdata where hn='$pt_hn' and code='51410' and date like '$dateekg%' order by row_id desc";
	$query3=mysql_query($sql3);
	$num3=mysql_num_rows($query3);
	if(!empty($num3)){  //����ա�äԴ��������
		if($result["HN"]=="56-9685"){ echo $result2["ekg"]; }else{ echo "����"; }
	}else if($result["HN"]=="60-5189"){  //��Ǩ�������Դ��������
		echo "����";
	}
	 ?>
    </td>
    <td>
    <!-- V/A -->
	<?php 
	if($result2["va"]==""){ echo "����"; }else{ echo $result2["va"];}
	?>
    </td>
    <td>
    <!-- ��µ� -->
    <?php 
		if($result2["eye"]=="����"){ echo $result2["eye"]; }else if($result2["eye"]=="�Դ����"){ echo $result2["eye"]."...".$result2["eye_detail"];}else{ echo "&nbsp;";}
	?>
    </td>
    <td>
    <!-- ���ö�Ҿ�ʹ -->
	<?php 
		if($result2["pt"]=="����"){ echo $result2["pt"]; }else if($result2["pt"]=="�ʹ�ӡѴ��â��µ��" || $result2["pt"]=="�ʹ�ش���"){ echo $result2["pt"]."...".$result2["pt_detail"];}else{ echo "&nbsp;";}
	?></td>

    <td>
    <!-- �š�õ�Ǩ��ŵ��ҫ�Ǵ��ͧ��ͧ -->
    <?php if( !empty($result2['altra']) ){ echo $result2['altra'];}?></td>
    <td>
    <!-- �����١��ҡ�¡�ä�� -->
    <?php if( !empty($result2['psa']) ){ echo $result2['psa'];}?></td>
    <!-- �š�õ�Ǩ����移ҡ���١ -->
    <td><?=(!empty($result2['hpv']) ? $result2['hpv'] : '' );?></td>
    <!-- �š�õ�Ǩ�������� -->
    <td><?=(!empty($result2['mammogram']) ? $result2['mammogram'] : '' );?></td>
    <!-- �ŵ�Ǩ����˹��蹢ͧ��š�д١ -->
    <td><?=(!empty($result2['bone_density']) ? $result2['bone_density'] : '' );?></td>
    <!-- �����آ�Ҿ����� -->
    <td>&nbsp;</td>
    <!-- ��ػ�š�õ�Ǩ -->
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<?php } ?>
</table>
<p align="center">PE = ��õ�Ǩ��ҧ��·����  BS = ��ӵ������ʹ  CHOL,TRI, HDL, LDL= ��ѹ����ʹ BUN, CR= ��÷ӧҹ�ͧ�  URIC = �ô���Ԥ SGOT,SGPT, ALK = ��÷ӧҹ�ͧ�Ѻ<br />
HBsAg = ��������ʵѺ�ѡ�ʺ  FOBT = ���ʹ��ب���� METAMP = ��Ǩ������ʾ�Դ ABOC = �������ʹ EKG = ��������俿�� V/A = ��Ǩ��</p>
</body>
</html>
