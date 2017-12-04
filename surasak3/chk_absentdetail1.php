<?php
session_start();

    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" G:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
	 $doctor="$doctor1";   

  
	 print "<font size='2'>รายชื่อผู้ที่ไม่ได้เข้ารับการตรวจสุขภาพประจำปี $year ";
	 print "<font size='2'>แผนก/ฝ่าย $camp <br>";
    print "<b>รายงานวันที่ $Thidate</b> ";
  
	$today="$yr-$m-$d";
    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
	$num=1;
?>
<table>
 <tr>
   <th bgcolor=6495ED><font size='2'>#</th>
  <th bgcolor=6495ED><font size='2'>HN</th>
  <th bgcolor=6495ED><font size='2'>ชื่อ</th>
 
  <th bgcolor=6495ED><font size='2'>ประเภท</th>
    <th bgcolor=6495ED><font size='2'>idno</th>
	<th bgcolor=6495ED><font size='2'>lab</th>
   <th bgcolor=6495ED><font size='2'>xray</th>
   <th bgcolor=6495ED><font size='2'>opd</th>
  <th bgcolor=6495ED><font size='2'>doctor</th>
   </tr>

<?php
 include("connect.inc");
 $query="SELECT hn,camp,goup,idno,lab,xray,dr,opd  FROM chkup_solider WHERE camp='$camp' ORDER by goup,idno";
  $result = mysql_query($query)or die("Query failed");
    while (list ($hn,$camp,$group,$idno,$lab,$xray,$dr,$opd) = mysql_fetch_row ($result)) {	

		$tbsql="select * from condxofyear_so where hn='$hn' and yearcheck='25$year' and status_dr='Y' ";
  		$tbresult = mysql_query($tbsql)or die("Query failed");
		//echo $tbsql."</br>";
		$num1=mysql_num_rows($tbresult);
		//echo "--->".$num1."</br>";
		if($num1 < 1){

$sql = "Select yot,name,surname From opcard where hn = '$hn' ";
	list($yot,$name,$surname)  = mysql_fetch_row(Mysql_Query($sql));

$fullname=$yot.''.$name.'&nbsp;'.$surname;
if($dr!=""){
	$dr=(substr($dr,0,4)+543)."-".substr($dr,5);
}
if($opd!=""){
	$opd=(substr($opd,0,4)+543)."-".substr($opd,5);
}
 	print("<tr>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$num</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$hn</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$fullname</td>\n".
//	"<td bgcolor=F5DEB3><font face='Angsana New'>$camp</td>\n".    
	"<td bgcolor=F5DEB3><font face='Angsana New'>$group</td>\n".    
	"<td bgcolor=F5DEB3 ><font face='Angsana New'>$idno</td>\n".  
		"<td bgcolor=F5DEB3 ><font face='Angsana New'>$lab</td>\n".  
		"<td bgcolor=F5DEB3 ><font face='Angsana New'>$xray</td>\n".  
		"<td bgcolor=F5DEB3 ><font face='Angsana New'>$opd</td>\n".  
		"<td bgcolor=F5DEB3 ><font face='Angsana New'>$dr</td>\n". 
	" </tr>\n");
$num++;
}       
	}
include("unconnect.inc");
//แสดงรายการคืนเงิน
?>