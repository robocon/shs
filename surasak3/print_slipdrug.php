<?php
    session_start();
    include("connect.inc");
?>	
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 17px;
}
-->
</style>

<?

$Thaidate=date("d/m/").(date("Y")+543)."  ".date("H:i:s");

$thdatehn=date("d-m-").(date("Y")+543).$_GET["hn"];
//echo $thdatehn;



if($_GET["type"]=="SI"){
	$type="OP self Isolation";
	$sql ="UPDATE opday SET opdtype='".$_GET["type"]."', opdcolor='".$_GET["color"]."'  WHERE  thdatehn='".$thdatehn."'";   // แก้ไขข้อมูลตาราง opday
	$result = Mysql_Query($sql) or die(Mysql_Error());
	
		$sql = "Select vn,ptname,age,ptright From opday where thdatehn = '".$thdatehn."'  limit 1";
		$arr = mysql_fetch_assoc(mysql_query($sql));
		
		$sql1 = "Select phone From opcard where hn = '".$_REQUEST["hn"]."' limit 1";
		$query1=mysql_query($sql1);
		$arr1 = mysql_fetch_assoc($query1);
		
		$registerdate=date("Y-m-d");
		$officer_date=date("Y-m-d H:i:s");
		
		$plandate1 = date ("Y-m-d", strtotime("+2 day", strtotime($registerdate)));
		$plandate2 = date ("Y-m-d", strtotime("+6 day", strtotime($registerdate)));

		$sql2 = "Select status_day1,status_day2 From opselfisolation where hn = '".$_GET["hn"]."' limit 1";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		$arr2 = mysql_fetch_assoc($query2);
		//echo "==>".$num2."<br>";
		
		if($num2 < 1){  //ภายในวันลงทะเบียนแค่ 1 ครั้ง
			$add="insert into opselfisolation set registerdate='$registerdate',
												  thdatehn='$thdatehn',
												  hn='".$_GET["hn"]."',
												  vn='".$arr["vn"]."',
												  ptname='".$arr["ptname"]."',
												  age='".$arr["age"]."',
												  ptright='".$arr["ptright"]."',
												  phone='".$arr1["phone"]."',
												  plandate1='$plandate1',
												  plandate2='$plandate2',
												  status_day1='n',
												  status_day2='n',
												  officer = '".$_SESSION["sOfficer"]."',
												  officer_date='$officer_date'";
			//echo $add;									  
			$result = Mysql_Query($add) or die(Mysql_Error());
		}else{
			$add ="UPDATE opselfisolation SET vn='".$arr["vn"]."', ptname='".$arr["ptname"]."',age='".$arr["age"]."',ptright='".$arr["ptright"]."',phone='".$arr1["phone"]."'  WHERE  thdatehn='".$thdatehn."'";   // แก้ไขข้อมูลตาราง opday
			//echo $add;
			$result = Mysql_Query($add) or die(Mysql_Error());	
		}
	
}else if($_GET["type"]=="HI"){
	$type="Home Isolation";
	$sql ="UPDATE opday SET opdtype='".$_GET["type"]."',opdcolor='".$_GET["color"]."'  WHERE  thdatehn='".$thdatehn."'";   // แก้ไขข้อมูลตาราง opday
	$result = Mysql_Query($sql) or die(Mysql_Error());	

}else if($_GET["type"]=="FI"){
	$type="รพ.สนาม";
	$sql ="UPDATE opday SET opdtype='".$_GET["type"]."',opdcolor='".$_GET["color"]."'  WHERE  thdatehn='".$thdatehn."'";   // แก้ไขข้อมูลตาราง opday
	$result = Mysql_Query($sql) or die(Mysql_Error());	
}else{
	$type="";
}





if($_GET["color"]=="green"){
	$color="เขียว";
}else if($_GET["color"]=="yellow"){
	$color="เหลือง";
}else if($_GET["color"]=="red"){
	$color="แดง";	
}else{
	$color="";
}





$query = "SELECT * FROM opday WHERE hn = '".$_GET["hn"]."' and thdatehn='$thdatehn' limit 1"; 
//echo $query;
$result = mysql_query($query) or die("Query failed");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
	}

	$tvn=$row->vn;
	$cHn=$row->hn;
	$cPtname=$row->ptname;
	$cAge =$row->age;
	
		
	
	print "<body Onload=\"window.print();\">

				<Script Language=\"JavaScript\">
					function CloseWindowsInTime(t){
						t = t*1000;
						setTimeout(\"window.close()\",t);
					}
					CloseWindowsInTime(2); 
				</Script>
				";
				
print "<div align='center'>";
print "<div style='line-height:24px; font-family:Angsana New; font-size: 26px;'><b>ผู้ป่วย $type<br>กลุ่มอาการสี$color</b></div>";				
print "</div>";			
print "<div align='center'>";
print "<div style='line-height:25px;'>&nbsp;</div>";
print "<div style='line-height:24px; font-family:Angsana New; font-size: 28px;'><b>$cPtname</b></div>";
print "<div style='margin-left: 10px; line-height:20px; font-size: 18px;'><b>HN:$cHn&nbsp;VN:$tvn&nbsp;Date:$Thaidate&nbsp;</b></div>";
print "<div style='line-height:2px;'>&nbsp;</div>";
print "<div style='line-height:18px; font-family:Angsana New; font-size: 18px;'><b>อายุ : $cAge</b></div>";
print "<div style='line-height:3px;'>&nbsp;</div>";
print "<div  style='margin-left: 10px; line-height:18px;'><b>แพ้ยา :</b></div>";
	$query12 = "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$cHn."' ";
    $result12 = mysql_query($query12) or die("Query failed");
	while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
		print "<div  style='margin-left: 10px; line-height:18px;'>$tradname...$advreact(.$asses.)</div>";
	}					
?>