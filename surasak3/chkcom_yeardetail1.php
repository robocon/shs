<?php
session_start();

    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" G:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
	 $doctor="$doctor1";   

  
	 print "<font size='2'>รายชื่อผู้เข้ารับตรวจสุขภาพประจำปี $year <br>";
	 print "<u><b><font size='2'>บริษัท $company &nbsp;&nbsp; $program</u> <br>";
     print "รายงานวันที่ $Thidate</b> ";
	 print "<br><a href='pdx_ofyear3.php?com=$company&pro=$program' target='_blank'>พิมพ์ใบนำทาง</a>";
  
	$today="$yr-$m-$d";
    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
	$num=1;
?>
<table>
 <tr>
   <th bgcolor=6495ED><font size='2'>#</th>
  <th bgcolor=6495ED><font size='2'>HN</th>
  <th bgcolor=6495ED><font size='2'>ชื่อ</th>
 
  <th bgcolor=6495ED><font size='2'>เลขบัตรปชช.</th>
    <th bgcolor=6495ED><font size='2'>ว/ด/ป เกิด</th>
    <th bgcolor=6495ED><font size='2'>อายุ</th>
  <th bgcolor=6495ED><font size='2'>lab</th>
   <th bgcolor=6495ED><font size='2'>xray</th>
   <th bgcolor=6495ED><font size='2'>opd</th>
  <th bgcolor=6495ED><font size='2'>doctor</th>
   </tr>

<?php
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

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

 include("connect.inc");
 $query="SELECT hn,company,program,idno FROM chkup_company WHERE company='$company'  and program = '$program' ORDER by idno";
  $result = mysql_query($query)or die("Query failed");
    while (list ($hn,$company,$program,$idno) = mysql_fetch_row ($result)) {	

 $sql = "Select yot,name,surname,idcard,dbirth From opcard where hn = '$hn' ";
	list($yot,$name,$surname,$idcard,$dbirth)  = mysql_fetch_row(Mysql_Query($sql));

$fullname=$yot.''.$name.'&nbsp;'.$surname;
$birthday = substr($dbirth,8,2)."-".substr($dbirth,5,2)."-".substr($dbirth,0,4);
$age = calcage($dbirth);
 	print("<tr>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$num</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$hn</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$fullname</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$idcard</td>\n".    
	"<td bgcolor=F5DEB3><font face='Angsana New'>$birthday</td>\n".    
	"<td bgcolor=F5DEB3 ><font face='Angsana New'>$age</td>\n".  
		"<td bgcolor=F5DEB3 ><font face='Angsana New'></td>\n".  
		"<td bgcolor=F5DEB3 ><font face='Angsana New'></td>\n".  
		"<td bgcolor=F5DEB3 ><font face='Angsana New'></td>\n".   
		"<td bgcolor=F5DEB3 ><font face='Angsana New'></td>\n".   
	" </tr>\n");
$num++;
}       

include("unconnect.inc");

?>