<p align="center">����� Lab ��Ǩ�آ�Ҿ�������ǹ���Ե 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="������� ���͹���� Lab" />
</form>
</p>
<?
if($_POST["act"]=="add"){
include("connect.inc"); 
$sql="select * from opcardchk where part='�ǹ���Ե60' order by row asc";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
//echo $num;
while($rows=mysql_fetch_array($query)){
//list($d,$m,$y)=explode("/",$rows["dbirth"]);
//$y=$y-543;
//$dbirth="$y-$m-$d 00:00:00";
$dbirth="00-00-00 00:00:00";
$ptname=$rows["name"]."  ".$rows["surname"];

$query1 = "SELECT runno, startday FROM runno WHERE title = 'lab'";
$result = mysql_query($query1) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

$nLab=$row->runno;
$dLabdate=$row->startday;
$dLabdate=substr($dLabdate,0,10);

$Thidate2 = date("Y").date("-m-d H:i:s");
$patienttype = "OPD";


$clinicalinfo = "��Ǩ�آ�Ҿ�ǹ���Ե60";
$chkgender=substr($rows["name"],0,6);
if($chkgender=="�ҧ���"){
$gender = "F";
}else{
$chkgender=substr($rows["name"],0,3);
	if($chkgender=="�ҧ"){
		$gender = "F";
	}else{
		$gender = "M";
	}
}

$priority = "R";

$sql1 = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$rows["idcard"]."', '".$patienttype."', '".$ptname."', '".$gender."', '".$dbirth."', '', '', '','".$cliniciancode."', 'MD022 (����Һᾷ��)', '".$priority."', '".$clinicalinfo."');";
//echo $sql1."<br>";
$result1 = mysql_query($sql1)or die("Query failed,INSERT orderhead ");
echo "����� Order Lab ���º��������";
if($rows["pid"]=="1" || $rows["pid"]=="3"){
$arrlab=array('CBC','UA','BS','LIPID','BUN','CR','SGOT','SGPT','ALK','URIC','HBSAG');
}else if($rows["pid"]=="2"){
$arrlab=array('CBC','UA','BS','LIPID','BUN','CR','SGOT','SGPT','ALK','URIC','HBSAG','C-S','ST');
}

foreach ($arrlab as $value) {
   list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '".$value."' limit 0,1 "));   
   
$sql2 = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$code."', '".$oldcode."', '".$detail."');";
$result2 = mysql_query($sql2) or die("Query failed,INSERT orderdetail");
//echo "==>".$sql2."<br>";
}

$nLab++;
$query3 ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
$result3 = mysql_query($query3) or die("Query failed runno");	
}  //close while
}  //close if act=add
?>