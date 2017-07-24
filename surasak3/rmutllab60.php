<p align="center">นำเข้า Lab ตรวจสุขภาพราชมงคลลำปาง 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="กดที่นี่ เพื่อนำเข้า Lab" />
</form>
</p>
<?
if($_POST["act"]=="add"){
include("connect.inc"); 
$sql="select * from opcardchk where part='ราชมงคลลำปาง60'  and active='w' order by row asc";
//echo $sql;
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


$Thidate2 = "2017-06-28 18:51:56";
$patienttype = "OPD";

$clinicalinfo = "ตรวจสุขภาพราชมงคลลำปาง60";

if(substr($rows["name"],0,3)=="นาย"){
$gender = "M";
}else if(substr($rows["name"],0,3)=="นาง"){
$gender = "F";
}else if(substr($rows["name"],0,6)=="นางสาว"){
$gender = "F";
}else if(substr($rows["name"],0,4)=="น.ส."){
$gender = "F";	
}else{
$gender = "M";
}
$priority = "R";

$labnumber="170628".sprintf("%03d",$nLab);

$sql1 = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".$labnumber."', '".$rows["HN"]."', '".$patienttype."', '".$ptname."', '".$gender."', '".$dbirth."', '', '', '','".$cliniciancode."', 'MD022 (ไม่ทราบแพทย์)', '".$priority."', '".$clinicalinfo."');";
//echo $sql1."<br>";
$result1 = mysql_query($sql1)or die("Query failed,INSERT orderhead");
//echo "นำเข้า Order Lab เรียบร้อยแล้ว";

$arrlab=array('AMP');

foreach ($arrlab as $value) {
   list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '".$value."' limit 0,1 "));   
   
$sql2 = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".$labnumber."', '".$code."', '".$oldcode."', '".$detail."');";
$result2 = mysql_query($sql2) or die("Query failed,INSERT orderdetail");
//echo "==>".$sql2."<br>";
}

}  //close while
?>
    <script>alert('นำเข้า Order Lab เรียบร้อยแล้ว กรุณาปิดหน้าต่างนี้ !!!');window.close();</script>
<?
}  //close if act=add
?>