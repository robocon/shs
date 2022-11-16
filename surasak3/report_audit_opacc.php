<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?
include("connect.inc");
?>
<table width="90%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td height="19" align="center"><strong>วันที่</strong></td>
    <td align="center"><strong>HN</strong></td>
    <td align="center"><strong>VN</strong></td>
    <td align="center"><strong>ชื่อผู้มารับบริการ</strong></td>
    <td align="center"><strong>หมวดหมู่</strong></td>
    <td align="center"><strong>รายการ</strong></td>
    <td align="center"><strong>ราคา</strong></td>
    <td align="center"><strong>เจ้าหน้าที่</strong></td>
    <td align="center"><strong>สิทธิ</strong></td>
    <td align="center"><strong>บัญชี</strong></td>
    <td align="center"><strong>เลขที่ใบเสร็จ</strong></td>
  </tr>
  <?
$query1="CREATE TEMPORARY TABLE reportopacc select * from opacc where (date >='2563-03-01 00:00:00' and date <='2563-03-31 23:59:59') and credit NOT IN ('ยกเลิก','นอนโรงพยาบาล','ค้างจ่าย','อื่นๆ','ยกเว้น','') order by date,hn" ;
//echo $query;
$result = mysql_query($query1) or die("Query failed BillTran, Create reportdrugrx Error !!!");  

$sql="select * from reportopacc order by date,hn";	
//echo $sql;
$query=mysql_query($sql);
$numchkup=mysql_num_rows($query);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;

    $dated=substr($rows["date"],8,2);
    $datem=substr($rows["date"],5,2); 
	$datey=substr($rows["date"],0,4); 
	$time=substr($rows["date"],11,8); 
	$datetime="$dated-$datem-$datey $time";
	
	$chkdate="$datey-$datem-$dated";
	
	
if($rows["credit"]=='จ่ายตรง'){
	$price=$rows["paidcscd"];
}else if($rows["credit"]=='เงินสด'){
	$price=$rows["paid"];
}else{
	$price=$rows["price"];
}
	
$sql2="select * from opday where hn ='".$rows["hn"]."' and thidate like '".$chkdate."%'";
//echo $sql2."<br>";
$query2=mysql_query($sql2);
$rows2=mysql_fetch_array($query2);

if(empty($rows2["ptname"])){
	$sql1="select * from depart where hn ='".$rows["hn"]."' and date like '".$chkdate."%'";
	$query1=mysql_query($sql1);
	$rows1=mysql_fetch_array($query1);
	$ptname=$rows1["ptname"];
}else{
	$ptname=$rows2["ptname"];
}

if($rows["vn"]==""){
	$vn=$rows2["vn"];
}else{
	$vn=$rows["vn"];
}

if($rows["ptright"]==""){
	$ptright=$rows2["ptright"];
}else{
	$ptright=$rows["ptright"];
}

if($rows["depart"]=="PATHO" && $rows["detail"]==""){
	$detail="ค่าตรวจวิเคราะห์โรค";
}else{
	$detail=$rows["detail"];
}
?>      
  <tr>
    <td width="14%" align="center"><?=$datetime;?></td>
    <td width="22%"><?=$rows["hn"];?></td>
    <td width="23%"><?=$vn;?></td>
    <td width="10%"><?=$ptname;?></td>
    <td width="6%"><?=$rows["depart"];?></td>
    <td width="14%"><?=$detail;?></td>
    <td width="11%"><?=$price;?></td>
    <td width="23%"><?=$rows["idname"];?></td>
    <td width="23%"><?=$ptright;?></td>
    <td width="23%"><?=$rows["credit"];?></td>
    <td width="23%"><?=$rows["billno"];?></td>
  </tr>
<?
}
?>  
</table>
