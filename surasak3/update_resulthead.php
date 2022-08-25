<?
include("connect.inc");
$sql="select * from resulthead where orderdate like '2022-08-14%'";
$query=mysql_query($sql);
while($rows=mysql_fetch_array($query)){
	$autonumber=$rows["autonumber"];
//echo $rows["patientname"];
$subclinicianname=substr($rows["clinicianname"],0,5);

$sql1="select * from opcard where hn='".$rows["hn"]."' limit 1";
$query1=mysql_query($sql1);
$num1=mysql_num_rows($query1);
$result=mysql_fetch_array($query1);
	if($num1 > 0){
		$ptname=$result["yot"]." ".$result["name"]."  ".$result["surname"];
		$update="UPDATE resulthead SET patientname='$ptname' WHERE autonumber='$autonumber'";
		mysql_query($update);
		echo $update."<br>";		
	}


$sql2="select * from doctor where name like '$subclinicianname%' limit 1";
//echo $sql2."<br>";
$query2=mysql_query($sql2);
$num2=mysql_num_rows($query2);
$result2=mysql_fetch_array($query2);
	if($num2 > 0){
		$doctorname=$result2["name"];
		//echo $result2["name"]."<br>";
		$update2="UPDATE resulthead SET clinicianname='$doctorname' WHERE autonumber='$autonumber'";
		mysql_query($update2);
		echo $update2."<br>";
	}
}
?>