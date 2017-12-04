<p align="center">นำเข้า Lab ตรวจสุขภาพอินทราเซรามิค 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="กดที่นี่ เพื่อนำเข้า Lab" />
</form>
</p>
<?
if($_POST["act"]=="add"){
include("connect.inc"); 
$sql="select * from opcardchk where part='อินทราเซรามิค60' order by row asc";
echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
//echo $num;
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
//echo "==>$i";
$dbirth="00-00-00 00:00:00";
$ptname=$rows["name"]."  ".$rows["surname"];
$nLab= $rows['exam_no'];
$age= $rows['agey'];

//echo substr($rows["name"],1,3);


$Thidate2 = date("Y").date("-m-d H:i:s");
$patienttype = "OPD";

$clinicalinfo = "ตรวจสุขภาพประกันสังคม60";

if(substr($rows["name"],0,3)=="นาย"){
$gender = "M";
}else if(substr($rows["name"],0,3)=="นาง"){
$gender = "F";
}else if(substr($rows["name"],0,6)=="นางสาว"){
$gender = "F";	
}else{
$gender = "M";
}
$priority = "R";

$sql1 = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$rows["HN"]."', '".$patienttype."', '".$ptname."', '".$gender."', '".$dbirth."', '', '', '','".$cliniciancode."', 'MD022 (ไม่ทราบแพทย์)', '".$priority."', '".$clinicalinfo."');";
echo $sql1."<br>";
$result1 = mysql_query($sql1)or die("Query failed,INSERT orderhead ");
echo "นำเข้า Order Lab เรียบร้อยแล้ว";


if($age >= 18 && $age < 20){
	$arrlab=array('CBC-sso');
}else if($age >=20 && $age <26){
	$arrlab=array('CBC-sso','HDL-sso','CHOL-sso');
}else if($age >=26 && $age <35){
	$arrlab=array('CBC-sso','HDL-sso','CHOL-sso','HBSAG-sso');
}else If($age>=35 && $age <50){
	$arrlab=array('CBC-sso','HDL-sso','CHOL-sso','HBSAG-sso','BS-sso');
}else if($age >=50 && $age <55){
	$arrlab=array('CBC-sso','HDL-sso','CHOL-sso','HBSAG-sso','BS-sso','STOCB-sso');
}else if($age >= 55){
	$arrlab=array('CBC-sso','HDL-sso','CHOL-sso','HBSAG-sso','BS-sso','STOCB-sso','UA-sso');
}

foreach ($arrlab as $value) {
   list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '".$value."' limit 0,1 "));   
   
$sql2 = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$code."', '".$oldcode."', '".$detail."');";
$result2 = mysql_query($sql2) or die("Query failed,INSERT orderdetail");
echo "==>".$sql2."<br>";
}

}  //close while
}  //close if act=add
?>