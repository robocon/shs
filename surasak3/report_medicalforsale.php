<?
session_start();
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.txt {	font-family: TH SarabunPSK;
	font-size: 18px;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
</head>

<body>
<p align="center" style="margin-top: 20px;"><strong>���͡�է�����ҳ���ʹ٢����š����觫����Ǫ�ѳ��/�ػ�ó�</strong></p>
<div align="center">
  <form method="post" action="report_medicalforsale.php">
    <input type="hidden" name="act" value="show" />
    �է�����ҳ&nbsp;&nbsp;
    <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='txt'>";
				foreach($dates as $i){

				?>
    <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
    </option>
    <?
				}
				echo "<select>";
				?>
	&nbsp;&nbsp;
    <select name="part" class="txt">
      <option value="DS">�Ǫ�ѳ�������</option>
      <option value="DSY">�Ǫ�ѳ���ԡ��</option>
      <option value="DSN">�Ǫ�ѳ���ԡ�����</option>
      <option value="DP">�ػ�ó������</option>
      <option value="DPY">�ػ�ó��ԡ��</option>
      <option value="DPN">�ػ�ó��ԡ�����</option>

    </select>
     &nbsp;&nbsp;  
    <input type="submit" value="�٢�����" name="B1"  class="txt" />
    &nbsp;&nbsp;
    <input type="button" value="�������ѡ" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
  </form>
</div>
<?
if($_POST["act"]=="show"){
$startyear=$_POST["year1"]-1;
$endyear=$_POST["year1"];
//echo $startyear;
$month1="���Ҥ� ".$startyear;
$month2="��Ȩԡ�¹ ".$startyear;
$month3="�ѹ�Ҥ� ".$startyear;
$month4="���Ҥ� ".$endyear;
$month5="����Ҿѹ�� ".$endyear;
$month6="�չҤ� ".$endyear;
$month7="����¹ ".$endyear;
$month8="����Ҥ� ".$endyear;
$month9="�Զع�¹ ".$endyear;
$month10="�á�Ҥ� ".$endyear;
$month11="�ԧ�Ҥ� ".$endyear;
$month12="�ѹ��¹ ".$endyear;

if($_POST["part"]=="DS"){
	$showised="�Ǫ�ѳ�������";
}else if($_POST["part"]=="DSY"){
	$showised="�Ǫ�ѳ���ԡ��";
}else if($_POST["part"]=="DSN"){
	$showised="�Ǫ�ѳ���ԡ�����";
}else if($_POST["part"]=="DP"){
	$showised="�ػ�ó������";
}else if($_POST["part"]=="DPY"){
	$showised="�ػ�ó��ԡ��";
}else if($_POST["part"]=="DPN"){
	$showised="�ػ�ó��ԡ�����";
}
?>
<hr />
<div align="center" style="margin-top: 20px;"><strong>��§ҹ�ʴ������š����觫����Ǫ�ѳ��/�ػ�ó� ������<?=$showised;?></strong></div>
<div align="center">�է�����ҳ <?=$endyear;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>�ѹ/��͹/��</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>�Ţ���� PO</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>������</strong></td>
    <td width="46%" align="center" bgcolor="#66CC99"><strong>������</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>�ӹǹ</strong></td>
    <td width="18%" align="center" bgcolor="#66CC99"><strong>�Ҥ����</strong></td>
  </tr>
  <?
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

if($_POST["part"]=="DS" || $_POST["part"]=="DSY" || $_POST["part"]=="DSN"){
$result="select SUM(b.`price`) AS sumprice from pocompany AS a INNER JOIN poitems AS b ON a.row_id=b.idno INNER JOIN druglst AS c ON b.drugcode=c.drugcode where (a.bounddate LIKE '%$month1' OR a.bounddate LIKE '%$month2'  OR a.bounddate LIKE '%$month3'  OR a.bounddate LIKE '%$month4'  OR a.bounddate LIKE '%$month5'  OR a.bounddate LIKE '%$month6'  OR a.bounddate LIKE '%$month7'  OR a.bounddate LIKE '%$month8'  OR a.bounddate LIKE '%$month9'  OR a.bounddate LIKE '%$month10'  OR a.bounddate LIKE '%$month11'  OR a.bounddate LIKE '%$month12') AND (a.prepono !='¡��ԡ' AND a.prepono !='0' AND a.prepono !='000') AND ( a.`potype` is null OR a.`potype` = '' ) AND c.part LIKE 'DS%' AND a.prepono NOT LIKE '�.%' AND pono !=''";
}else if($_POST["part"]=="DP" || $_POST["part"]=="DPY" || $_POST["part"]=="DPN"){
$result="select SUM(b.`price`) AS sumprice from pocompany AS a INNER JOIN poitems AS b ON a.row_id=b.idno INNER JOIN druglst AS c ON b.drugcode=c.drugcode where (a.bounddate LIKE '%$month1' OR a.bounddate LIKE '%$month2'  OR a.bounddate LIKE '%$month3'  OR a.bounddate LIKE '%$month4'  OR a.bounddate LIKE '%$month5'  OR a.bounddate LIKE '%$month6'  OR a.bounddate LIKE '%$month7'  OR a.bounddate LIKE '%$month8'  OR a.bounddate LIKE '%$month9'  OR a.bounddate LIKE '%$month10'  OR a.bounddate LIKE '%$month11'  OR a.bounddate LIKE '%$month12') AND (a.prepono !='¡��ԡ' AND a.prepono !='0' AND a.prepono !='000') AND ( a.`potype` is null OR a.`potype` = '' ) AND c.part LIKE 'DP%' AND a.prepono NOT LIKE '�.%' AND pono !=''";
}
//echo $result;
$cquery=mysql_query($result);
list($sumprice)=mysql_fetch_array($cquery);



if($_POST["part"]=="DS"){
$sql="select * from pocompany AS a  INNER JOIN poitems AS b ON a.row_id=b.idno INNER JOIN druglst AS c ON b.drugcode=c.drugcode where (a.bounddate LIKE '%$month1' OR a.bounddate LIKE '%$month2'  OR a.bounddate LIKE '%$month3'  OR a.bounddate LIKE '%$month4'  OR a.bounddate LIKE '%$month5'  OR a.bounddate LIKE '%$month6'  OR a.bounddate LIKE '%$month7'  OR a.bounddate LIKE '%$month8'  OR a.bounddate LIKE '%$month9'  OR a.bounddate LIKE '%$month10'  OR a.bounddate LIKE '%$month11'  OR a.bounddate LIKE '%$month12') AND (a.prepono !='¡��ԡ' AND a.prepono !='0' AND a.prepono !='000') AND ( a.`potype` is null OR a.`potype` = '' ) AND c.part LIKE 'DS%' AND a.prepono NOT LIKE '�.%'  AND pono !='' ORDER BY a.date ASC";
}else if($_POST["part"]=="DSY"){
$sql="select * from pocompany AS a INNER JOIN poitems AS b ON a.row_id=b.idno INNER JOIN druglst AS c ON b.drugcode=c.drugcode where (a.bounddate LIKE '%$month1' OR a.bounddate LIKE '%$month2'  OR a.bounddate LIKE '%$month3'  OR a.bounddate LIKE '%$month4'  OR a.bounddate LIKE '%$month5'  OR a.bounddate LIKE '%$month6'  OR a.bounddate LIKE '%$month7'  OR a.bounddate LIKE '%$month8'  OR a.bounddate LIKE '%$month9'  OR a.bounddate LIKE '%$month10'  OR a.bounddate LIKE '%$month11'  OR a.bounddate LIKE '%$month12') AND (a.prepono !='¡��ԡ' AND a.prepono !='0' AND a.prepono !='000') AND ( a.`potype` is null OR a.`potype` = '' ) AND (c.part ='DSY') AND a.prepono NOT LIKE '�.%'  AND pono !='' ORDER BY a.date ASC";
}else if($_POST["part"]=="DSN"){
$sql="select * from pocompany AS a INNER JOIN poitems AS b ON a.row_id=b.idno INNER JOIN druglst AS c ON b.drugcode=c.drugcode where (a.bounddate LIKE '%$month1' OR a.bounddate LIKE '%$month2'  OR a.bounddate LIKE '%$month3'  OR a.bounddate LIKE '%$month4'  OR a.bounddate LIKE '%$month5'  OR a.bounddate LIKE '%$month6'  OR a.bounddate LIKE '%$month7'  OR a.bounddate LIKE '%$month8'  OR a.bounddate LIKE '%$month9'  OR a.bounddate LIKE '%$month10'  OR a.bounddate LIKE '%$month11'  OR a.bounddate LIKE '%$month12') AND (a.prepono !='¡��ԡ' AND a.prepono !='0' AND a.prepono !='000') AND ( a.`potype` is null OR a.`potype` = '' ) AND (c.part ='DSN') AND a.prepono NOT LIKE '�.%'  AND pono !='' ORDER BY a.date ASC";

}else if($_POST["part"]=="DP"){
$sql="select * from pocompany AS a  INNER JOIN poitems AS b ON a.row_id=b.idno INNER JOIN druglst AS c ON b.drugcode=c.drugcode where (a.bounddate LIKE '%$month1' OR a.bounddate LIKE '%$month2'  OR a.bounddate LIKE '%$month3'  OR a.bounddate LIKE '%$month4'  OR a.bounddate LIKE '%$month5'  OR a.bounddate LIKE '%$month6'  OR a.bounddate LIKE '%$month7'  OR a.bounddate LIKE '%$month8'  OR a.bounddate LIKE '%$month9'  OR a.bounddate LIKE '%$month10'  OR a.bounddate LIKE '%$month11'  OR a.bounddate LIKE '%$month12') AND (a.prepono !='¡��ԡ' AND a.prepono !='0' AND a.prepono !='000') AND ( a.`potype` is null OR a.`potype` = '' ) AND c.part LIKE 'DP%' AND a.prepono NOT LIKE '�.%'  AND pono !='' ORDER BY a.date ASC";
}else if($_POST["part"]=="DPY"){
$sql="select * from pocompany AS a INNER JOIN poitems AS b ON a.row_id=b.idno INNER JOIN druglst AS c ON b.drugcode=c.drugcode where (a.bounddate LIKE '%$month1' OR a.bounddate LIKE '%$month2'  OR a.bounddate LIKE '%$month3'  OR a.bounddate LIKE '%$month4'  OR a.bounddate LIKE '%$month5'  OR a.bounddate LIKE '%$month6'  OR a.bounddate LIKE '%$month7'  OR a.bounddate LIKE '%$month8'  OR a.bounddate LIKE '%$month9'  OR a.bounddate LIKE '%$month10'  OR a.bounddate LIKE '%$month11'  OR a.bounddate LIKE '%$month12') AND (a.prepono !='¡��ԡ' AND a.prepono !='0' AND a.prepono !='000') AND ( a.`potype` is null OR a.`potype` = '' ) AND (c.part ='DPY') AND a.prepono NOT LIKE '�.%'  AND pono !='' ORDER BY a.date ASC";
}else if($_POST["part"]=="DPN"){
$sql="select * from pocompany AS a INNER JOIN poitems AS b ON a.row_id=b.idno INNER JOIN druglst AS c ON b.drugcode=c.drugcode where (a.bounddate LIKE '%$month1' OR a.bounddate LIKE '%$month2'  OR a.bounddate LIKE '%$month3'  OR a.bounddate LIKE '%$month4'  OR a.bounddate LIKE '%$month5'  OR a.bounddate LIKE '%$month6'  OR a.bounddate LIKE '%$month7'  OR a.bounddate LIKE '%$month8'  OR a.bounddate LIKE '%$month9'  OR a.bounddate LIKE '%$month10'  OR a.bounddate LIKE '%$month11'  OR a.bounddate LIKE '%$month12') AND (a.prepono !='¡��ԡ' AND a.prepono !='0' AND a.prepono !='000') AND ( a.`potype` is null OR a.`potype` = '' ) AND (c.part ='DPN') AND a.prepono NOT LIKE '�.%'  AND pono !='' ORDER BY a.date ASC";

}

//echo $sql;
$query=mysql_query($sql);
$i=0;
$total=0;
while($rows=mysql_fetch_array($query)){
$i++;
$chkdate=substr($rows["txdate"],0,10);
$nRow_id=$rows["row_id"];

$total=$total+$rows["price"];
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["prepodate"]?></td>
    <td align="left"><?=$rows["prepono"]?></td>
    <td align="left"><?=$rows["drugcode"]?></td>
    <td align="left"><?=$rows["tradname"]?></td>
    <td align="center"><?=$rows["amount"]?></td>
    <td align="right"><?=number_format($rows["price"],2);?></td>
  </tr>
  <?
}
?>
  <tr>
    <td colspan="6" align="right"><strong>������Թ������</strong></td>
    <td align="right"><strong>
      <?=number_format($total,2);?>
    </strong></td>
  </tr>
  <tr>
    <td colspan="6" align="right"><strong>�ʹ��������觫��ͷ�����</strong></td>
    <td align="right"><strong>
      <?=number_format($sumprice,2);?>
    </strong></td>
  </tr>  
<?
$avg=($total*100)/$sumprice;
?>  
  <tr>
    <td colspan="6" align="right"><strong>�Դ���ѵ��������</strong></td>
    <td align="right"><strong>
      <?=number_format($avg,2);?>
    </strong></td>
  </tr>  
</table>

<?
}
?>
</body>
</html>
