<p align="center">����� Lab ��Ǩ�آ�Ҿ�Ҫ�����ӻҧ 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="������� ���͹���� Lab" />
</form>
</p>
<?
if($_POST["act"]=="add"){
include("connect.inc"); 
$sql="select * from opcardchk where part='�Ҫ�����ӻҧ60'  and active='w' order by row asc";
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

$clinicalinfo = "��Ǩ�آ�Ҿ�Ҫ�����ӻҧ60";

if(substr($rows["name"],0,3)=="���"){
$gender = "M";
}else if(substr($rows["name"],0,3)=="�ҧ"){
$gender = "F";
}else if(substr($rows["name"],0,6)=="�ҧ���"){
$gender = "F";
}else if(substr($rows["name"],0,4)=="�.�."){
$gender = "F";	
}else{
$gender = "M";
}
$priority = "R";

$labnumber="170628".sprintf("%03d",$nLab);

$sql1 = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".$labnumber."', '".$rows["HN"]."', '".$patienttype."', '".$ptname."', '".$gender."', '".$dbirth."', '', '', '','".$cliniciancode."', 'MD022 (����Һᾷ��)', '".$priority."', '".$clinicalinfo."');";
//echo $sql1."<br>";
$result1 = mysql_query($sql1)or die("Query failed,INSERT orderhead");
//echo "����� Order Lab ���º��������";

$arrlab=array('AMP');

foreach ($arrlab as $value) {
   list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '".$value."' limit 0,1 "));   
   
$sql2 = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".$labnumber."', '".$code."', '".$oldcode."', '".$detail."');";
$result2 = mysql_query($sql2) or die("Query failed,INSERT orderdetail");
//echo "==>".$sql2."<br>";
}

}  //close while
?>
    <script>alert('����� Order Lab ���º�������� ��سһԴ˹�ҵ�ҧ��� !!!');window.close();</script>
<?
}  //close if act=add
?>