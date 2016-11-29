<p align="center">นำเข้า Order Lab ตรวจสุขภาพทหารประจำปี 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="กดที่นี่ เพื่อนำเข้า Lab" />
</form>
</p>
<?
if($_POST["act"]=="add"){
	include("connect.inc"); 
	//$sql="select hn,yot,ptname,age,gender from  chkup_solider where camp like 'D01 รพ.ค่ายสุรศักดิ์มนตรี%' and yearchkup='60' order by row_id asc";  //รพ.ค่ายสุรศักดิ์มนตรี
	/*$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (
camp = 'D02 ศาล และ อก.ศาล มทบ.32' OR camp = 'D11 ฝธน.มทบ.32' OR camp = 'D12 ฝสวส.มทบ.32' OR camp = 'D03 ผปบ.มทบ.32' OR camp = 'D08 กกร.มทบ.32' OR camp = 'D16 ฝอศจ.มทบ.32' OR camp = 'D05 กกบ.มทบ.32' OR camp = 'D06 กยก.มทบ.32' OR camp = 'D07 กขว.มทบ.32' OR camp = 'D15 ฝคง.มทบ.32' OR camp = 'D10 ฝสก.มทบ.32' OR camp = 'D27 ผสพ.มทบ.32' OR camp = 'D28 มว.ดย.มทบ.32' OR camp = 'D21 กอง รจ.มทบ.32'
)
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";  //สำหรับตรวจวันที่ 15-11-59*/

	/*$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (hn = '48-3474')
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";  //สำหรับตรวจวันที่ 16-11-59*/

/*	$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (camp like 'D13%' and hn = '48-3471' || hn = '59-539' || hn = '54-11551' || hn = '47-6157')
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";*/


/*	$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (
camp like 'D09%' OR camp like 'D22%' OR camp like 'D26%' OR camp like 'D35%')
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";  //สำหรับตรวจวันที่ 17-11-59  100 คน*/

/*	$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (
camp like 'D23%' OR camp like 'D24%' OR camp like 'D20%' OR camp like 'D18%' OR camp like 'D14%' OR camp like 'D17%')
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";  //สำหรับตรวจวันที่ 18-11-59  104 คน
*/
/*	$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (
camp like 'D04%' OR camp like 'D32%')
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";  //สำหรับตรวจวันที่ 21-11-59  108 คน*/

/*	$sql="SELECT hn, yot, ptname, age, gender
FROM chkup_solider
WHERE yearchkup = '60' AND (
camp
LIKE 'D30%'
) AND (
active = 'n' || active = ''
)
GROUP BY hn
ORDER BY camp ASC , chunyot ASC , yot DESC";  //สำหรับตรวจวันที่ 23-11-59  187 คน*/

	$sql="SELECT hn, yot, ptname, age, gender
FROM chkup_solider
WHERE yearchkup = '60' AND (
camp
LIKE 'D31%'
) AND active = '' 
GROUP BY hn
ORDER BY camp ASC , chunyot ASC , yot DESC";  //สำหรับตรวจวันที่ 25-11-59  58 คน
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num;
	while($rows=mysql_fetch_array($query)){
	
		$dbirth="0000-00-00 00:00:00";
		
		$ptname=$rows["yot"]." ".$rows["ptname"];
		
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
		
		$clinicalinfo = "ตรวจสุขภาพประจำปี60";
		if($rows["gender"]=="1"){
			$gender = "M";
		}else{
			$gender="F";
		}
		
		$priority = "R";
		
		$sql1 = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$rows["hn"]."', '".$patienttype."', '".$ptname."', '".$gender."', '".$dbirth."', '', '', '','".$cliniciancode."', 'MD022 (ไม่ทราบแพทย์)', '".$priority."', '".$clinicalinfo."');";
		//echo $sql1."<br>";
		$result1 = mysql_query($sql1)or die("Query failed,INSERT orderhead ");
		
		if($rows["age"] < 35){ 
			$arrlab=array('CBC','UA');
		}else{
			$arrlab=array('CBC','UA','BS','CHOL','TRI','HDL','BUN','CR','ALK','SGPT','SGOT','URIC');
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
	?>
    <script>alert('นำเข้า Order Lab เรียบร้อยแล้ว กรุณาปิดหน้าต่างนี้ !!!');window.close();</script>
    <?
}  //close if act=add
?>