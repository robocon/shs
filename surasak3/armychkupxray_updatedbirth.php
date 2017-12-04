<p align="center">Update HBD Order XRAY ตรวจสุขภาพทหารประจำปี 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="กดที่นี่ เพื่อ UPDATE" />
</form>
</p>
<?		
if($_POST["act"]=="add"){
	include("connect.inc"); 
	$sql="select * from xray_doctor where date ='2559-11-15 02:00:00' and detail='1.CHEST CHECK UP' ";  //สำหรับตรวจวันที่ 15-11-59
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num;
	$n=0;
	while($rows=mysql_fetch_array($query)){	
	$n++;
	//echo $n.") ";
	$hn=$rows["hn"];
	$xrayno=$rows["xrayno"];
	
		$query1 = "SELECT dbirth FROM opcard WHERE hn = '$hn'";
		$result = mysql_query($query1) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		
		$nDbirth=$row->dbirth;
		
		//echo $nDbirth."<br>";
		
		$query3 ="UPDATE xray_doctor SET dbirth = '$nDbirth', orderby='XRAY' WHERE hn = '$hn' and xrayno='$xrayno'";
		//echo $query3."<br>";
		$result3 = mysql_query($query3) or die("Query failed xray_doctor");		
		
	}  //close while
	?>
    <script>alert('UPDATE เรียบร้อยแล้ว กรุณาปิดหน้าต่างนี้ !!!');window.close();</script>
    <?
}  //close if act=add
	
