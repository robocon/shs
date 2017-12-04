<?   session_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>สั่ง LAB ตรวจสุขภาพนอกหน่วย</title>
<link type="text/css" href="chk_style.css" rel="stylesheet" />
<style type="text/css">
.pdxpro {	font-family: "TH SarabunPSK";
	font-size: 16pt;
}
</style>
</head>

<body>

<form name="frmbill" method="post">
  <table width="50%" border="0" align="center" class="fontsara">
    <tr>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" width="15%">ระบุ HN</td>
      <td width="15%"><input type="text" name="Chkhn" value="<?=$_POST['Chkhn'];?>" class="fontsara" /></td>
      <td width="20%"><input type="submit" name="submit" value=" ค้นหา " class="fontsara"><a target=_self  href='../nindex.htm' class="fontsara"> &larr;ไปเมนู</a> </td>
    </tr>
  </table>
</form>

<BR />
<hr />
<BR />
  <?

if(isset($_POST['Chkhn'])){
 include("connect.inc");
 
	$strsql="SELECT *,concat(yot,name,' ',surname)as ptname,dbirth,HN FROM `opcardchk` WHERE  hn = '".$_POST['Chkhn']."'";
	$query=mysql_query($strsql) or die (mysql_error());
	$Row=mysql_num_rows($query);
	
	if($Row ==0){
	echo "<div align='center' class='fontsara'>!!! ไม่พบ HN  $_POST[Chkhn]!! </div>";	
	}else{
		
		$arr=mysql_fetch_array($query);
		
		
		$dbirth=explode("/",$arr['dbirth']);
		
		$dbirth1=$dbirth[2]-543;
		$dbirth2=$dbirth1.'-'.$dbirth[1].'-'.$dbirth[0];

 ?>
<form name="form1" action="" method="post">
  <table width="70%" border="0" align="center" cellpadding="2" cellspacing="2" class="fontsara">
  <tr>
    <td width="20%" align="right" valign="top">HN:</td>
    <td width="26%">  <strong>
      <?=$arr['HN'];?>
    </strong></td>
    <td>ชื่อ-สกุล: 
      <strong>
      <?=$arr['ptname'];?>
      </strong></td>
    </tr>
  <tr>
    <td align="right" valign="top">ID:</td>
    <td> <strong>
    <!--  <?//=$arr['idcard'];?>-->
    <?=$arr['idcard'];?>
    </strong></td>
    <td>เบอร์โทร:      <strong>
      <?=$arr['phone'];?>
    </strong></td>
  </tr>
  <tr>
    <td align="right" valign="top">โปรแกรมตรวจ</td>
    <td colspan="2">
    <select name="pro" class="pdxpro">
   	<!--<option value="BS">BS</option>-->
     <!--<option value="ALK">(ALK) Alkaline phosphatase</option>-->
      <option value="1">โปรแกรม อายุต่ำกว่า 35</option>
      <option value="3">โปรแกรม อายุมากกว่า 35</option>
     <option value="ST">STOOL</option>
    </select> 
    <!--<span id="spName"> STOOL 
      <input type="checkbox" name="stool" id="stool" value="ST"></span>--></td>
  </tr>
  <tr>
    <td colspan="3" align="center">
    <input type="hidden" name="HN" value="<?=$arr['HN'];?>">
    <input type="hidden" name="name" value="<?=$arr['ptname'];?>">
    <input type="hidden" name="dbirth" value="<?=$dbirth2;?>">
    <input type="submit" name="Submit" value=" บันทึกข้อมูล "  class="pdxpro" />
      <!--<a target=_self  href='../backoffice/index.php'>&larr; ไปเมนู</a>--><br></td>
  </tr>
</table>
</form>
<? 
	} 
	 include("unconnect.inc");
}

if(isset($_POST['Submit'])){
include("connect.inc");	
		function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}
return $ageY;
}

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

//  	    $cTitle=$row->title;  //=VN
$nLab=$row->runno;
$dLabdate=$row->startday;
$dLabdate=substr($dLabdate,0,10);

$Thidate2 = date("Y").date("-m-d H:i:s");
$patienttype = "OPD";

$clinicalinfo = "ตรวจสุขภาพกัลยาณี58";
$gender = "M";
$priority = "R";

/*$first_year = explode("-",$_POST['dbirth']);
	$first_year[0] = $first_year[0]-543;
	
	//if(checkdate($first_year[1],$first_year[2],$first_year[0])){
		$dbirth = $first_year[0].substr($_POST['dbirth'],4);
	}/else{
		$dbirth = date("Y-m-d");
}
*/

$sql = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$_POST['HN']."', '".$patienttype."', '".$_POST['name']."', '".$gender."', '".$_POST['dbirth']."', '', '', '','".$cliniciancode."', 'MD022 (ไม่ทราบแพทย์)', '".$priority."', '".$clinicalinfo."');";
$result = mysql_query($sql)or die("Query failed,INSERT orderhead ");

if($_POST['pro']==1){
	
	//if($_POST['stool']=='ST'){
	//$arrlab=array('CBC','UA','ST');	
	//}else{
	$arrlab=array('CBC','UA');	
	//}
	$pro="P1";

}elseif($_POST['pro']==3){
		
	//if($_POST['stool']=='ST'){
	//$arrlab=array('CBC','UA','ST','BS','URIC','SGPT','SGOT','CR','BUN','CHOL','TRI','ALK');
	//}else{
	$arrlab=array('CBC','UA','BS','URIC','SGPT','SGOT','CR','BUN','CHOL','TRI','ALK');
	//}
	$pro="P3";

}/*else if($_POST['pro']=='ALK'){


/*else if($_POST['pro']=='ALK'){
	$arrlab=array('ALK');	
	
	$pro="ALK";
}*/
else if($_POST['pro']=='ST'){
	$arrlab=array('ST');	
	
	$pro="ST";
}
foreach ($arrlab as $value) {
   
   list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '".$value."' limit 0,1 "));
   
$sql = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$code."', '".$oldcode."', '".$detail."');";
$result = mysql_query($sql) or die("Query failed,INSERT orderdetail");

}

/*
	for ($n=1; $n<=5; $n++){

		 list($olddetail) = mysql_fetch_row(mysql_query("Select oldcode From labcare where code = '".$aDgcode[$n]."' limit 0,1 "));

		$sql = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$aDgcode[$n]."', '".$olddetail."', '".$aTrade[$n]."');";
		 $result = mysql_query($sql) or die("Query failed,INSERT orderdetail");

		 $clinicalinfo .=$aDgcode[$n]." ,";
	 }
*/
$labno=date("ymd").sprintf("%03d", $nLab);

		$nLab++;
		$query ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
		$result = mysql_query($query) or die("Query failed runno");	
		
		
if($result){
			
echo "<div align=\"center\" class=\"fontsara1\">บันทึกข้อมูลเรียบร้อยแล้ว</div>";
echo"<meta http-equiv='refresh' content='1;url=chk_hn.php'>";
//echo "<div align=\"center\" class=\"fontsara1\"><a href='chk_labslip4bc.php?labno=$labno&hn=$_POST[hn]&ptname=$_POST[name]' target='_blank'>พิมพ์สติกเกอร์ Barcode</a></div>";
?>
<script>
window.open('chk_labslip4bc.php?labno=<?=$labno;?>&hn=<?=$_POST['HN'];?>&ptname=<?=$_POST['name'];?>&pro=<?=$pro;?>',null,'height=500,width=850,scrollbars=1');
</script>
<?

		}
		
	
//	echo "<BR>$query";
}
 include("unconnect.inc");
?>

</body>
</html>