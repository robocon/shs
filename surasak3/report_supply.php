<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ��ʴ�������ͧ�ҧ���ᾷ��������ö�ԡ������</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
-->
</style></head>
<? include("../connect.inc"); ?>
<body>
<?
$sql="select drugcode,tradname,unit,salepri from druglst where part='DSY'";
echo $sql;
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
echo $num;
?>
<p style="font-weight:bold; font-size:18px;">��¡����ʴ�������ͧ�ҧ���ᾷ��������ö�ԡ������ 㹡óշ��ʶҹ��Һ����觨����������¹͡���͹ӡ�Ѻ������ҹ</p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td rowspan="2" align="center"><strong>�ӴѺ</strong></td>
    <td rowspan="2" align="center"><strong>����</strong></td>
    <td rowspan="2" align="center"><strong>��¡��</strong></td>
    <td rowspan="2" align="center"><strong>˹���</strong></td>
    <td rowspan="2" align="center"><strong>�����˵�/���͹䢡���ԡ</strong></td>
    <td rowspan="2" align="center"><strong>�����˵�</strong></td>
    <td rowspan="2" align="center"><strong>�鹷ع��� ���� �Ҥ�</strong></td>
    <td colspan="3" align="center"><strong>����ҳ�����</strong></td>
    <td rowspan="2" align="center"><strong>������繵����¡��<br /> 
    (item) yes or no</strong></td>
    <td rowspan="2" align="center"><strong>������繵�͢�����<br />
    �鹷ع yes or no</strong></td>
    <td rowspan="2" align="center"><strong>�к��˵ؼ�</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>�����¹͡</strong></td>
    <td align="center"><strong>�������</strong></td>
    <td align="center"><strong>�����¡�Ѻ��ҹ</strong></td>
  </tr>
  <?
  $i=0;
  while($rows=mysql_fetch_array($query)){
  $i++;
  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="left"><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td align="center"><?=$rows["unit"];?></td>
    <td align="center"><? //$rows["drugnote"];?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$rows["salepri"];?></td> 
<?
$dbsql="select sum(amount) as sumdrug from drugrx where (date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59') and part='DSY' and drugcode='".$rows["drugcode"]."' and  an is null ";
$dbquery=mysql_query($dbsql);
$dbnum=mysql_num_rows($dbquery);
$dbrows=mysql_fetch_array($dbquery);
?>      
    <td align="center"><? if($dbrows["sumdrug"]=="" || $dbrows["sumdrug"]==0){ echo "-";}else{ echo $dbrows["sumdrug"];}?></td>
<?
$tbsql="select sum(amount) as sumipacc from ipacc where (date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59') and part='DSY' and code='".$rows["drugcode"]."'";
//echo $sql;
$tbquery=mysql_query($tbsql);
$tbnum=mysql_num_rows($tbquery);
$tbrows=mysql_fetch_array($tbquery);
?>    
    <td align="center"><? if($tbrows["sumipacc"]==" " || $tbrows["sumipacc"]==0){ echo "-";}else{ echo $tbrows["sumipacc"];}?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <?
  }
  ?>
</table>
</body>
</html>
