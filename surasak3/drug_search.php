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
<p align="center" style="margin-top: 20px;"><strong>���Ң��������ʶҹ��Һ��</strong></p>
<div align="center">
  <form method="post" action="drug_search.php">
    <input type="hidden" name="act" value="show" />
    ���Ҫ�����&nbsp;&nbsp;
	<input name="drugname" type="text" class="txt" />
	&nbsp;&nbsp; 
    <input type="submit" value="�٢�����" name="B1"  class="txt" />
    &nbsp;&nbsp;
    <input type="button" value="�������ѡ" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
  </form>
</div>
<?
if($_POST["act"]=="show"){
$drugname=$_POST["drugname"];
?>
<hr />
<div align="center" style="margin-top: 20px;"><strong>��§ҹ�ʴ���������</strong></div>
<div align="center"><strong>�Ӥ� : </strong>
  <?=$drugname;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>������</strong></td>
    <td width="35%" align="center" bgcolor="#66CC99"><strong>���͡�ä��</strong></td>
    <td width="34%" align="center" bgcolor="#66CC99"><strong>�������ѭ</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>TMT CODE</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>�Ҥ�/˹���</strong></td>
  </tr>
  <?
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

$sql="select * from druglst  where tradname LIKE '%$drugname%' OR genname LIKE '%$drugname%' and drug_active='y'";
//echo $sql;
$query=mysql_query($sql);
$i=0;
$total=0;
if(mysql_num_rows($query) < 1){
?>
  <tr>
    <td align="center" colspan="6" style="color:#FF0000;">--------------------------------------------------------- ��辺������ ---------------------------------------------------------</td>
  </tr>
<?
}else{
while($rows=mysql_fetch_array($query)){
$i++;
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="left"><?=$rows["drugcode"]?></td>
    <td align="left"><?=$rows["tradname"]?></td>
    <td align="left"><?=$rows["genname"]?></td>
    <td align="center"><?=$rows["tmt"]?></td>
    <td align="right"><?=$rows["salepri"]?></td>
  </tr>
  <?
	}
}
?>  
<?
$avg=($total*100)/$sumprice;
?>  
</table>

<?
}
?>
</body>
</html>
