<?php
include 'bootstrap.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ��ػ�ŵ�Ǩ�آ�Ҿ</title>
<style type="text/css">

body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
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
<div align="center"><strong>�š�õ�Ǩ�آ�Ҿ���˹�ҷ�� <?=$company['company_name'];?>  ��ԡ�õ�Ǩ�آ�Ҿ � �ç��Һ�Ť�������ѡ��������</strong></div>
<div align="center"><strong>�����ҧ�ѹ��� <?=$company['show_date'];?> �ӹǹ <?=$num;?> ���</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <th width="3%" rowspan="2" align="center"><strong>�ӴѺ</strong></th>
    <th width="5%" rowspan="2" align="center"><strong>HN</strong></th>
    <th width="15%" rowspan="2" align="center"><strong>���� - ʡ��</strong></th>
    <th width="4%" rowspan="2" align="center"><strong>����</strong></th>
    <th width="5%" rowspan="2" align="center"><strong>���˹ѡ</strong></th>
    <th width="5%" rowspan="2" align="center"><strong>��ǹ�٧</strong></th>
    <th width="5%" rowspan="2" align="center"><strong>BP</strong></th>
    <th colspan="28" align="center"><strong>��¡�õ�Ǩ</strong></th>
    <th width="8%" rowspan="2" align="center"><strong>�����آ�Ҿ�����</strong></th>
    <th colspan="2" align="center"><strong>��ػ�š�õ�Ǩ</strong></th>
  </tr>
  <tr>
    <th width="3%" align="center"><strong>PE</strong></th>
    <th width="7%" align="center"><strong>X-RAY</strong></th>
    <th width="5%" align="center"><strong>CBC</strong></th>
    <th width="5%" align="center"><strong>UA</strong></th>
    <th width="5%" align="center"><strong>BS</strong></th>
    <th width="6%" align="center"><strong>CHOL</strong></th>
    <th width="6%" align="center"><strong>TRIG</strong></th>
    <th width="5%" align="center"><strong>HDL</strong></th>
    <th width="5%" align="center"><strong>LDL</strong></th>
    <th width="5%" align="center"><strong>BUN</strong></th>
    <th width="3%" align="center"><strong>CR</strong></th>
    <th width="6%" align="center"><strong>URIC</strong></th>
    <th width="7%" align="center"><strong>SGOT</strong></th>
    <th width="6%" align="center"><strong>SGPT</strong></th>
    <th width="4%" align="center"><strong>ALK</strong></th>
    <th width="7%" align="center"><strong>HBsAg</strong></th>
    <th width="6%" align="center"><strong>FOBT</strong></th>

    <th width="6%" align="center"><strong>Anti-HAV IgG</strong></th>
    <th width="6%" align="center"><strong>Stool Exam</strong></th>
    <th width="6%" align="center"><strong>Stool Culture</strong></th>

    <th width="6%" align="center"><strong>METAMP</strong></th>
    <th width="5%" align="center"><strong>ABOC</strong></th>
    <th width="6%" align="center"><strong>EKG</strong></th>
    <th width="6%" align="center"><strong>V/A</strong></th>
    <th width="6%" align="center"><strong>��µ�</strong></th>
    <th width="6%" align="center"><strong>���ö�Ҿ�ʹ</strong></th>
    <th width="6%" align="center"><strong>��ŵ��ҫ�Ǵ�<br>��ͧ��ͧ</strong></th>
    <th width="6%" align="center"><strong>�����١��ҡ<br>�¡�ä��</strong></th>
    <th width="5%" align="center"><strong>��ᾷ��</strong></th>
    <th width="6%" align="center"><strong>��辺ᾷ��</strong></th>
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
    <td align="center"><?php 
$sql18="SELECT * 
FROM resulthead 
WHERE profilecode = 'CBC' 
AND hn = '$pt_hn' 
AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
GROUP BY `profilecode` ";

$query18=mysql_query($sql18);
$numcbc=mysql_num_rows($query18);
if($numcbc > 0){
	echo "��";
}else if($numcbc < 1){
	echo "<strong style='color:#FF0000'>�����</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?php
$sql19="SELECT * 
FROM resulthead WHERE profilecode = 'UA' AND hn = '$pt_hn' 
AND `clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
GROUP BY `profilecode` ";
//echo $sql19;
$query19=mysql_query($sql19);
$numua=mysql_num_rows($query19);
if($numua > 0){
	echo "��";
}else if($numua < 1){
	echo "<strong style='color:#FF0000'>�����</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?php
$sql1="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'GLU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '$pt_hn' 
AND a.`clinicalinfo` ='��Ǩ�آ�Ҿ��Шӻ�$yaer_chk' 
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
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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
$sql3="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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
$sql4="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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
    <td align="center"><?
$sql5="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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
    <td align="center"><?
$sql6="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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
    <td align="center"><?
$sql7="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'CREA' AND b.result !='DELETE' AND a.hn = '$pt_hn' 
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
?></td>
    <td align="center"><?
$sql8="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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
    <td align="center"><?
$sql9="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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
    <td align="center"><?
$sql10="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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
    <td align="center"><?
$sql11="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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
    <td align="center"><?
$sql12="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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
    <td align="center"><?
$sql13="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
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

    $hn = $result['HN'];

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

    $query13 = mysql_query($sql);
    list($result, $flag) = mysql_fetch_array($query13);

    echo $result;
    ?>
</td> 
<!-- Stool Culture -->
<td align="center"><?php echo $cs; ?></td>

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
?></td>
    <td><? 
	$sql3="select * from patdata where hn='$pt_hn' and code='51410' and date like '$dateekg%' order by row_id desc";
	//echo $sql3;
	$query3=mysql_query($sql3);
	$num3=mysql_num_rows($query3);
	if(!empty($num3)){  //����ա�äԴ��������
		if($result["HN"]=="56-9685"){ echo $result2["ekg"]; }else{ echo "����"; }
	}else if($result["HN"]=="60-5189"){  //��Ǩ�������Դ��������
		echo "����";
	}
	 ?></td>
    <td>
	<? 
	if($month=="8"  || $month=="9"){
		echo "&nbsp;";
	}else{
		if($result2["va"]==""){ echo "����"; }else{ echo $result2["va"];}
	}
	?></td>
    <td><? 
		if($result2["eye"]=="����"){ echo $result2["eye"]; }else if($result2["eye"]=="�Դ����"){ echo $result2["eye"]."...".$result2["eye_detail"];}else{ echo "&nbsp;";}
	?></td>
    <td>
	<? 
		if($result2["pt"]=="����"){ echo $result2["pt"]; }else if($result2["pt"]=="�ʹ�ӡѴ��â��µ��" || $result2["pt"]=="�ʹ�ش���"){ echo $result2["pt"]."...".$result2["pt_detail"];}else{ echo "&nbsp;";}
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
    // �����١��ҡ�¡�ä��
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
<p align="center">PE = ��õ�Ǩ��ҧ��·����  BS = ��ӵ������ʹ  CHOL,TRI, HDL, LDL= ��ѹ����ʹ BUN, CR= ��÷ӧҹ�ͧ�  URIC = �ô���Ԥ SGOT,SGPT, ALK = ��÷ӧҹ�ͧ�Ѻ<br />
HBsAg = ��������ʵѺ�ѡ�ʺ  FOBT = ���ʹ��ب���� METAMP = ��Ǩ������ʾ�Դ ABOC = �������ʹ EKG = ��������俿�� V/A = ��Ǩ��</p>
</body>
</html>
