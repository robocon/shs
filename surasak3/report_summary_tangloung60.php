<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ��ػ�ŵ�Ǩ�آ�Ҿ</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
</head>
<?
include("connect.inc");

?>	
<body>
<div align="center"><strong>�š�õ�Ǩ�آ�Ҿ���˹�ҷ�� ����ҧ��ǧ����  ��ԡ�õ�Ǩ�آ�Ҿ � �ç��Һ�Ť�������ѡ��������</strong></div>
<div align="center"><strong>�����ҧ�ѹ��� 21-23 �á�Ҥ� 2560 �ӹǹ 3 ���</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" rowspan="2" align="center"><strong>�ӴѺ</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>HN</strong></td>
    <td width="15%" rowspan="2" align="center"><strong>���� - ʡ��</strong></td>
    <td width="4%" rowspan="2" align="center"><strong>����</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>���˹ѡ</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>��ǹ�٧</strong></td>
    <td width="5%" rowspan="2" align="center"><strong>BP</strong></td>
    <td colspan="7" align="center"><strong>��¡�õ�Ǩ</strong></td>
    <td width="8%" rowspan="2" align="center"><strong>�����آ�Ҿ�����</strong></td>
    <td colspan="2" align="center"><strong>��ػ�š�õ�Ǩ</strong></td>
  </tr>
  <tr>
    <td width="3%" align="center"><strong>PE</strong></td>
    <td width="7%" align="center"><strong>X-RAY</strong></td>
    <td width="5%" align="center"><strong>BS</strong></td>
    <td width="6%" align="center"><strong>CHOL</strong></td>
    <td width="5%" align="center"><strong>HDL</strong></td>
    <td width="7%" align="center"><strong>HBSAG</strong></td>
    <td width="6%" align="center"><strong>FOBT</strong></td>
    <td width="5%" align="center"><strong>��ᾷ��</strong></td>
    <td width="6%" align="center"><strong>��辺ᾷ��</strong></td>
  </tr>
<?
$sql="SELECT  *  FROM opcardchk WHERE part='����ҧ��ǧ60' and active='y' order by row";
//echo $sql."<br>";
$row = mysql_query($sql)or die ("Query Fail");
$i=0;
while($result = mysql_fetch_array($row)){

$sql2="select * from out_result_chkup where hn='".$result["HN"]."'";
//echo $sql2;
$query2=mysql_query($sql2);
$result2=mysql_fetch_array($query2);

$i++;
$ptname=$result["yot"].$result["name"]." ".$result["surname"];
if($result2["bp1"] && $result2["bp2"]){
	$bp=$result2["bp1"]."/".$result2["bp2"];
}else{
	$bp="&nbsp;";
}
if($result["congenital_disease"]=="����ʸ" || empty($result["congenital_disease"])){
	$disease="�����";
}else{
	$disease="��";
}
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result["HN"];?></td>
    <td><?=$ptname;//."->".$result2["part"];?></td>
    <td align="center"><?=$result["agey"];?></td>
    <td align="center"><?=$result2["weight"];?></td>
    <td align="center"><?=$result2["height"];?></td>
    <td align="center"><?=$bp;?></td>
    <td>&nbsp;</td>
    <td align="left"><? 
			  if($result2["cxr"]==""){ echo "����"; }else{ echo $result2["cxr"]; }
		   ?></td>
    <td align="center"><?
$sql1="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'GLU' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�60' OR a.clinicalinfo = '��Ǩ�آ�Ҿ��Сѹ�ѧ��60'
)
GROUP BY a.`profilecode` ";
//echo $sql1;
$query1=mysql_query($sql1);
list($glu,$flag)=mysql_fetch_array($query1);
if($flag=="N"){
	echo $glu;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$glu</strong>";
}else{
	echo "&nbsp;";
}
?>    </td>
    <td align="center"><?
$sql2="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'CHOL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�60' OR a.clinicalinfo = '��Ǩ�آ�Ҿ��Сѹ�ѧ��60'
)
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
    <td align="center"><?
$sql4="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HDL' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�60' OR a.clinicalinfo = '��Ǩ�آ�Ҿ��Сѹ�ѧ��60'
)
GROUP BY a.`profilecode` ";
//echo $sql4;
$query4=mysql_query($sql4);
list($hdl,$flag)=mysql_fetch_array($query4);

if($flag=="N"){
	echo $hdl;
}else if($flag=="H" || $flag=="L"){
	echo "<strong style='color:#FF0000'>$hdl</strong>";
}else{
	echo "&nbsp;";
}
?></td>
    <td align="center"><?
$sql12="SELECT b.result, b.flag 
FROM resulthead AS a
INNER JOIN resultdetail AS b ON a.autonumber = b.autonumber
WHERE b.labcode = 'HBSAG' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�60' OR a.clinicalinfo = '��Ǩ�آ�Ҿ��Сѹ�ѧ��60'
)
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
WHERE b.labcode = 'OCCULT' AND (b.result !='DELETE' OR b.result !='*') AND a.hn = '".$result["HN"]."' AND (
a.clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�60' OR a.clinicalinfo = '��Ǩ�آ�Ҿ��Сѹ�ѧ��60'
)
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<? } ?>  
</table>
<p align="center">PE = ��õ�Ǩ��ҧ��·����  BS = ��ӵ������ʹ  CHOL,TRI = ��ѹ����ʹ  HBsAg = ��������ʵѺ�ѡ�ʺ  FOBT = ���ʹ��ب����</p>
</body>
</html>
