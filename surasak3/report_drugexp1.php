<?
session_start();
include("connect.inc");

$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<div align="center" style="margin-top: 20px;"><strong>��§ҹ��������ص����ǧ����</strong></div>
<div align="center">����ҧ�ѹ��� <?=$showdate1;?> �֧�ѹ��� <?=$showdate2;?>
</div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>������</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>���͡�ä��</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>�������ѭ</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>���ʺ���ѷ</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>���ͺ���ѷ</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>Lot.</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>�ѹ���������</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>�ѹ����������</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>��ͧ��</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>��ѧ</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>�������</strong></td>
  </tr>
<?
$chkdate1=($_POST["year1"]-543)."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=($_POST["year2"]-543)."-".$_POST["month2"]."-".$_POST["date2"];
$sql="select * from combill where amount > 0 and expdate between '$chkdate1' and '$chkdate2' order by expdate asc";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$sql1="select * from druglst where drugcode='$rows[drugcode]'";
$query1=mysql_query($sql1);
$rows1=mysql_fetch_array($query1);
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["drugcode"]?></td>
    <td><?=$rows["tradname"]?></td>
    <td><?=$rows["genname"]?></td>
    <td><?=$rows1["comcode"]?></td>
    <td><?=$rows1["comname"]?></td>
    <td><?=$rows["lotno"]?></td>
    <td align="center"><?=$rows["getdate"]?></td>
    <td align="center"><?=$rows["expdate"]?></td>
    <td><?=$rows1["stock"]?></td>
    <td><?=$rows1["mainstk"]?></td>
    <td align="center"><?=$rows1["totalstk"]?></td>
  </tr>
<?
}
?>  
</table>
