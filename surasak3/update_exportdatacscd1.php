<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<?
$thiyr=$_POST["thiyr"];
$yrmonth=$_POST["rptmo"];
$yrdate=$_POST["rptdate"];
$yrmonthdate="$thiyr-$yrmonth-$yrdate";
$showdate="$yrdate/$yrmonth/$thiyr";

$sql="select * from opday where thidate LIKE '$yrmonthdate%' and icd10 !='' AND (substring(ptright,1,3)='R02' OR substring(ptright,1,3)='R03' ) ";  //มีการลงรหัสโรคเรียบร้อยแล้ว
//echo $sql;
$query = mysql_query($sql);
$num=mysql_num_rows($query);
$i=0;
while ($rows=mysql_fetch_array($query)) {	  //วนลูป
$i++;
	$edit="update opacc set icd10_cscd='y' where hn='$rows[hn]' and credit='จ่ายตรง' and txdate LIKE '$yrmonthdate%';";
	//echo $i."]".$edit."<br>";
	$query1 = mysql_query($edit);
	if($i==$num){
		echo "<script>alert('ปรับปรุงข้อมูลวันที่ $showdate เรียบร้อยแล้ว มีทั้งหมด $num รายการ');window.location='update_exportdatacscd.php';</script>";
	}
}


/////////////////////แจ้งเตือน //////////////////////

$sToken = "9EuptC9Wk6mzmrIPZhyBEGW2FB5QPZKDgxzEQBdU03o"; // Claim CSOP
$sMessage =iconv('TIS-620','UTF-8',"กองทุนเบิกจ่ายตรง\nอัพเดทสถานะ ICD10\nวัน/เดือน/ปี :  $showdate\nเจ้าหน้าที่: $sOfficer");
$chOne = curl_init(); 
curl_setopt( $chOne, CURLOPT_URL, "https://203.104.138.174/api/notify"); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt( $chOne, CURLOPT_POST, 1); 
curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne ); 
curl_close($chOne);	

/////////////////////แจ้งเตือน //////////////////////

?>
