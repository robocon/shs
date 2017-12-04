<?
include("connect.inc");
if($_POST["act"]=="add"){
$cquery=mysql_query("SELECT  * FROM opcardchk AS a INNER  JOIN out_result_chkup AS b ON a.HN = b.hn WHERE a.part ='ราชมงคล'");
$num=mysql_num_rows($cquery);

//----------------------- Runno Lab ----------------------//
$query = "SELECT runno, startday FROM runno WHERE title = 'lab'";
$result = mysql_query($query) or die("Query failed");
	
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
	
	if(substr($dLabdate,0,10) != date("Y-m-d")){
		$nLab = 1;
		$dLabdate = date("Y-m-d 00:00:00");
	}
//----------------------- Runno Lab ----------------------//

	$i=0;
	while($rows=mysql_fetch_array($cquery)){
	$i++;
	$hn=$rows["hn"];
	$ptname=$rows["ptname"];
	if(substr($ptname,0,3) == "นาง"){
		$sex="F";
	}else if(substr($ptname,0,3) == "นาย"){
		$sex="M";
	}else{
		$sex="M";
	}
	$add="insert into orderhead set orderdate='$_POST[orderdate]',
													labnumber='".date("ymd").sprintf("%03d", $nLab)."',
													hn='$hn',
													patienttype='$_POST[patienttype]',
													patientname='$ptname',
													sex='$sex',
													dob='$_POST[dob]',
													room='$_POST[room]',
													clinicianname='$_POST[clinicianname]',
													priority='$_POST[priority]',
													clinicalinfo='$_POST[clinicalinfo]',
													isquery='$_POST[isquery]';";
	echo $add."<br>";	
	$resultadd = mysql_query($add) or die("Query failed");
	
	$add1="insert into orderdetail set labnumber='".date("ymd").sprintf("%03d", $nLab)."',
													labcode='$_POST[labcode]',
													labcode1='$_POST[labcode1]',
													labname='$_POST[labname]';";
	echo $add1."<br>";		
	$resultadd1 = mysql_query($add1) or die("Query failed");
	
		$nLab++;
		$query1 ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab';";
		echo $query1."<br>";
		$result = mysql_query($query1) or die("Query failed");	
		echo "[$i]---------------------------บันทึกข้อมูล HN : $hn ($ptname) เรียบร้อยแล้ว---------------------------<br>";					
	}
	
}
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<div align="center">
<strong>นำเข้าข้อมูล OrderHead && OrderDetail </strong>
<form action="importlabrmutl.php" method="post" name="frm1">
	<input name="act" type="hidden" value="add" />
    <input name="orderdate" type="hidden" value="<?=date("Y-m-d H:i:s");?>" />
    <input name="patienttype" type="hidden" value="OPD" />
    <input name="sex" type="hidden" value="M" />
    <input name="dob" type="hidden" value="1994-01-01 00:00:00" />
    <input name="room" type="hidden" value="000" />
    <input name="clinicianname" type="hidden" value="กรุณาเลือกแพทย์" />
    <input name="priority" type="hidden" value="R" />
    <input name="clinicalinfo" type="hidden" value="AMP ," />
    <input name="isquery" type="hidden" value="0" />
    <input name="labcode" type="hidden" value="AMP" />
    <input name="labcode1" type="hidden" value="33708" />
	<input name="labname" type="hidden" value="(33708)Methamphetamine (urine) (immunoassay)" />
	<input type="submit" name="button" id="button" value="Import Data" />
</form>
</div>
