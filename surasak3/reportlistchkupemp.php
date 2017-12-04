<title>รายงานจำนวนลูกจ้างที่เข้ารับการตรวจสุขภาพประจำปี</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<?
include("connect.inc");

$sql1="SELECT * FROM dxofyear_emp WHERE thidate like '$_GET[chkdate]%' AND yearchk = '$_GET[year]' group by hn order by row_id desc";
//echo $sql1;
$result=mysql_query($sql1) or die("Query condxofyear_so line 15 Error");
$num=mysql_num_rows($result);
?>
<p align="center" style="font-weight:bold;">รายงานจำนวนลูกจ้างที่เข้ารับการตรวจสุขภาพประจำปี
<?=$showyear;?></p>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>#</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>วันที่ตรวจ</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="25%" align="center" bgcolor="#66CC99"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>อายุ</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>LAB</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>XRAY</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>OPD</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>DOCTOR</strong></td>
  </tr>
  <?
  $i=0;
  //echo date("Y-m-d H:i:s");
  while($rows=mysql_fetch_array($result)){
  $i++;
  $date1=substr($rows["thidate"],0,10);
  list($y,$m,$d)=explode("-",$date1);
  $y=$y+543;
  $showdate="$d/$m/$y";
  $chkdate="$y-$m-$d";
  
  $query1=mysql_query("select orderdate from orderhead where hn='$rows[hn]' and (orderdate like '$date1%' || clinicalinfo = 'ตรวจสุขภาพประจำปี$_GET[year]') order by autonumber desc limit 1");
  list($lab)=mysql_fetch_array($query1);
  
  $query2=mysql_query("select date from patdata where hn='$rows[hn]' and (date like '$chkdate%' || depart = 'XRAY') and ptright='R31 ลูกจ้าง' order by row_id desc limit 1");
  list($xray)=mysql_fetch_array($query2);  
  
  $query3=mysql_query("select thidate from  condxofyear_emp where hn='$rows[hn]' and yearcheck = '25$_GET[year]'  order by row_id desc limit 1");
  //echo $query3."<br>";
  list($doctor)=mysql_fetch_array($query3); 
     
  ?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$showdate;?></td>
    <td bgcolor="#CCFFCC"><?=$rows["hn"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["ptname"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["age"];?></td>
    <td bgcolor="#CCFFCC"><?=$lab;?></td>
    <td bgcolor="#CCFFCC"><?=$xray;?></td>
    <td bgcolor="#CCFFCC"><?=$rows["thidate"];?></td>
    <td bgcolor="#CCFFCC"><?=$doctor;?></td>
  </tr>
  <?
  }
  ?>
</table>

