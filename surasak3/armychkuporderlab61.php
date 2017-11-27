<p align="center">นำเข้า Order Lab สังกัด ตรวจสุขภาพทหารประจำปี 2561
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="คลิกที่นี่ เพื่อนำเข้า Lab ตรวจสุขภาพทหาร" />
</form>
<p align="center" style="color:#FF0000; font-size:28px; font-weight:bold;">!!! คลิกแค่ครั้งเดียว เฉพาะวันที่ 26/11/60 เท่านั้น</p>
</p>
<?
if($_POST["act"]=="add"){
	include("connect.inc"); 
	$sql="SELECT *
FROM chkup_solider where (yearchkup='61' and active='' and camp != 'D01 รพ.ค่ายสุรศักดิ์มนตรี') order by  row_id asc";
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num;
	while($rows=mysql_fetch_array($query)){
	
		list($d,$m,$y)=explode(" ",$rows["birthday"]);
		if($m=="มกราคม"){
			$mm="01";
		}else if($m=="กุมภาพันธ์"){
			$mm="02";
		}else if($m=="มีนาคม"){
			$mm="03";
		}else if($m=="เมษายน"){
			$mm="04";
		}else if($m=="พฤษภาคม"){
			$mm="05";
		}else if($m=="มิถุนายน"){
			$mm="06";
		}else if($m=="กรกฎาคม"){
			$mm="07";
		}else if($m=="สิงหาคม"){
			$mm="08";
		}else if($m=="กันยายน"){
			$mm="09";
		}else if($m=="ตุลาคม"){
			$mm="10";
		}else if($m=="พฤศจิกายน"){
			$mm="11";
		}else if($m=="ธันวาคม"){
			$mm="12";
		}
		
		
		
		
		$dbirth="$y-$mm-$d 00:00:00";  //ok
		
		$ptname=$rows["yot"]." ".$rows["ptname"];  //ok
		
		$Thidate2 = date("Y").date("-m-d H:i:s");  //ok
		$patienttype = "OPD";  //ok
		
		$clinicalinfo = "ตรวจสุขภาพประจำปี61";  //ok
		if($rows["gender"]=="1"){  //ok
			$gender = "M";
		}else{
			$gender="F";
		}
		
		$priority = "R";
		
		$sql1 = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".$rows["lab"]."', '".$rows["hn"]."', '".$patienttype."', '".$ptname."', '".$gender."', '".$dbirth."', '', '', '','".$cliniciancode."', 'MD022 (ไม่ทราบแพทย์)', '".$priority."', '".$clinicalinfo."');";
		//echo "------------------------------------------------<br>";
		//echo $sql1."<br>";
		$result1 = mysql_query($sql1)or die("Query failed,INSERT orderhead ");
		
		if($rows["age"] < 35){ 
			$arrlab=array('CBC','UA');
		}else{
			$arrlab=array('CBC','UA','BS','CHOL','TRI','HDL','BUN','CR','ALK','SGPT','SGOT','URIC');
		}
		
		foreach ($arrlab as $value) {
		   list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '".$value."' limit 0,1 "));   
		   
			$sql2 = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".$rows["lab"]."', '".$code."', '".$oldcode."', '".$detail."');";
			$result2 = mysql_query($sql2) or die("Query failed,INSERT orderdetail");
			//echo "==>".$sql2."<br>";
		}	
		
	}  //close while
	?>
    <script>alert('นำเข้า Order Lab เรียบร้อยแล้ว กรุณาปิดหน้าต่างนี้ !!!');window.close();</script>
    <?
}  //close if act=add
?>