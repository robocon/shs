<?
include("connect.inc");
if($_POST["act"]=="add"){
$cquery=mysql_query("SELECT  * FROM opcardchk WHERE part ='สอบตำรวจ57'");
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
	$hn=$rows["HN"];
	$ptname=$rows["yot"]." ".$rows["name"]." ".$rows["surname"];

	$add="insert into orderhead set orderdate='$_POST[orderdate]',
													labnumber='".date("ymd").sprintf("%03d", $nLab)."',
													hn='$hn',
													patienttype='$_POST[patienttype]',
													patientname='$ptname',
													sex='$_POST[sex]',
													dob='$_POST[dob]',
													room='$_POST[room]',
													clinicianname='$_POST[clinicianname]',
													priority='$_POST[priority]',
													clinicalinfo='$_POST[clinicalinfo]',
													isquery='$_POST[isquery]';";
	echo $add."<br>";	
	$resultadd = mysql_query($add) or die("Query failed");
$labcode1="CBC";
$labcode11="30101";
$labname1="(30101)CBC (+ diff. + RBC morphology + plt count) by automation";

	$add1="insert into orderdetail set labnumber='".date("ymd").sprintf("%03d", $nLab)."',
													labcode='$labcode1',
													labcode1='$labcode11',
													labname='$labname1';";
	echo $add1."<br>";		
	$resultadd1 = mysql_query($add1) or die("Query failed");													
													
$labcode2="UA";
$labcode12="31001";
$labname2="(31001)Urine Analysis";

	$add2="insert into orderdetail set labnumber='".date("ymd").sprintf("%03d", $nLab)."',
													labcode='$labcode2',
													labcode1='$labcode12',
													labname='$labname2';";
	echo $add2."<br>";		
	$resultadd2 = mysql_query($add2) or die("Query failed");		

$labcode3="ST";
$labcode13="31201";
$labname3="(31201)Routine direct smear";

	$add3="insert into orderdetail set labnumber='".date("ymd").sprintf("%03d", $nLab)."',
													labcode='$labcode3',
													labcode1='$labcode13',
													labname='$labname3';";
	echo $add3."<br>";		
	$resultadd3 = mysql_query($add3) or die("Query failed");		

$labcode4="HIV";
$labcode14="36350";
$labname4="(36350)HIV-Ab (screening)  -  RAPID";

	$add4="insert into orderdetail set labnumber='".date("ymd").sprintf("%03d", $nLab)."',
													labcode='$labcode4',
													labcode1='$labcode14',
													labname='$labname4';";
	echo $add4."<br>";		
	$resultadd4 = mysql_query($add4) or die("Query failed");		

$labcode5="VDRL";
$labcode15="36003";
$labname5="(36003)VDRL (RPR)";

	$add5="insert into orderdetail set labnumber='".date("ymd").sprintf("%03d", $nLab)."',
													labcode='$labcode5',
													labcode1='$labcode15',
													labname='$labname5';";
	echo $add5."<br>";		
	$resultadd5 = mysql_query($add5) or die("Query failed");		
	
$labcode6="AMP";
$labcode16="33708";
$labname6="(33708)Methamphetamine (urine) (immunoassay)";

	$add6="insert into orderdetail set labnumber='".date("ymd").sprintf("%03d", $nLab)."',
													labcode='$labcode6',
													labcode1='$labcode16',
													labname='$labname6';";
	echo $add6."<br>";		
	$resultadd6 = mysql_query($add6) or die("Query failed");			

	
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
<strong>สอบตำรวจ นำเข้าข้อมูล OrderHead && OrderDetail </strong>
<form action="importlabpolice.php" method="post" name="frm1">
	<input name="act" type="hidden" value="add" />
    <input name="orderdate" type="hidden" value="<?=date("Y-m-d H:i:s");?>" />
    <input name="patienttype" type="hidden" value="OPD" />
    <input name="sex" type="hidden" value="M" />
    <input name="dob" type="hidden" value="1994-01-01 00:00:00" />
    <input name="room" type="hidden" value="000" />
    <input name="clinicianname" type="hidden" value="กรุณาเลือกแพทย์" />
    <input name="priority" type="hidden" value="R" />
    <input name="clinicalinfo" type="hidden" value="CBC ,UA ,ST ,HIV ,VDRL ,AMP ," />
    <input name="isquery" type="hidden" value="0" />
	<input type="submit" name="button" id="button" value="Import Data" />
</form>
</div>
