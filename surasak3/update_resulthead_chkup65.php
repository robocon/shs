<?
include("connect.inc");
$sql="select * from resulthead where orderdate like '2022-08-15%' and `clinicalinfo` LIKE 'ตรวจสุขภาพประจำปี65'";
$query=mysql_query($sql);
while($rows=mysql_fetch_array($query)){
	$autonumber=$rows["autonumber"];
//echo $rows["patientname"];

$sql1="select patientname from orderhead where hn='".$rows["hn"]."' and labnumber='".$rows["labnumber"]."' limit 1";
echo $sql1."<br>";
$query1=mysql_query($sql1);
$num1=mysql_num_rows($query1);
$result=mysql_fetch_array($query1);
	if($num1 > 0){

		if(!empty($result["patientname"])){  //ถ้ามีชื่อ patientname
			$update1="UPDATE resulthead SET patientname='".$result["patientname"]."' WHERE autonumber='$autonumber';";
			mysql_query($update1);
			echo "1-->".$update1."<br>";				
		}
		
	
	}
}
?>