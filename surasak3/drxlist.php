<SCRIPT LANGUAGE="JavaScript">
	t = 1*1000;
	
	setTimeout("searchSuggest();",t);

	function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function searchSuggest() {
	
			url = 'drxlist.php?action=refresh&d=<?php echo $_GET["d"];?>&m=<?php echo $_GET["m"];?>&yr=<?php echo $_GET["yr"];?>';
			//alert('กำลังโหลดข้อมูลใหม่...');
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById("list").innerHTML = xmlhttp.responseText;
tt = 20*1000;
setTimeout("searchSuggest();",tt);
}

</SCRIPT>
<?php  
if(isset($_GET["action"]) && $_GET["action"] =="refresh"){
header("content-type: application/x-javascript; charset=UTF-8");
}
	include("connect.inc");

$today=date("d-m-").(date("Y")+543);
	
if(isset($_GET["action"]) && $_GET["action"] =="refresh"){
//echo "==>".$_GET["action"];
//echo "<meta http-equiv='refresh' content='10'> ";  	
$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
print ("<table>
 <tr style='color:#FFFFFF;font-weight:bold;'>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='5'>#</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='5'>VN</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='5'>เวลา</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='5'>ชื่อ</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='5'>HN</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='5'>ค่ายา</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='5'>สิทธิการรักษา</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='5'>แพทย์</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='5'>ผู้บันทึก</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='4'>คิวแพทย์</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='4'>คิวห้องยา</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='4'>เวลารับใบสั่งยา</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='4'>เวลาที่ตัด</th>
	<th bgcolor=#17A589><font face='TH SarabunPSK' size='4'>แบบบันทึกการรักษา<br>ผู้ป่วยโควิด19</th>
	
 </tr>");

  //  $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew FROM dphardep WHERE whokey='DR' and date LIKE '$today%'  AND dr_cancle is null ORDER BY stkcutdate, row_id  DESC ";

  $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin,idname FROM dphardep WHERE  whokey='DR' and date LIKE '$today%' AND dr_cancle is null AND department ='' ORDER BY stkcutdate, hn  DESC ";
	//echo "==>".$query."<br>";
    $result = mysql_query($query) or die("Query failed");

	$num=mysql_num_rows($result);
	echo "<div style='font-size:20px;'>จำนวน $num รายการ</div>";
    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin,$idname) = mysql_fetch_row ($result)) {
        

        $time=substr($date,11);
		
		$y=substr($date,0,4);
		$m=substr($date,5,2);
		$d=substr($date,8,2);
		$thdatehn="$d-$m-$y$hn";
	
		$sql2="select * from opselfisolation where thdatehn='$thdatehn'";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		$rows2=mysql_fetch_array($query2);
		
		if($num2 < 1){
			$opsi="";
		}else{
			$opsi="<a href='opselfisolation_print.php?hn=$hn&thidatehn=$thdatehn' target='_BLANK'>ดูข้อมูล</a>";
		}

		if($stkcutdate == "")
			$bgcolor="#48C9B0";		
		else
			$bgcolor="#FFFFFF";
        print " <tr>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$num</td>\n".
			"  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$tvn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$time</td>\n";
		if($tvn==""){
			print "  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$ptname</td>\n";
		}else{
       	 	print   "  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'><a target=_BLANK  href=\"drxdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno&sPtright=$ptright&sVn=$tvn\">$ptname</a></td>\n";
		}
          print "  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$hn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$price</td>\n".
		   "  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$ptright</td>\n".
   		   "  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$doctor</td>\n".
			  "  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$idname</td>\n".
			   "  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$kew</td>\n".
			   	"  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$kewphar</td>\n".
			"  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$pharin</td>\n".
			   	"  <td BGCOLOR='".$bgcolor."'><font face='TH SarabunPSK'>$stkcutdate</td>\n".
				   	"  <td BGCOLOR='".$bgcolor."' align='center'><font face='TH SarabunPSK'>$opsi</td>\n".
		   " </tr>\n";
		   $num--;
		}
   

print ("</table>");

exit();
}

$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];

    print "<div style='font-size:24px;'><font face='TH SarabunPSK'>วันที่ $today  รายการใบสั่งยาจากแพทย์ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='drx1date.php'>&lt;&lt;เลือกวันที่ใหม่</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_blank  href='drxlist_not.php'>&lt;&lt;ค้างจ่าย</a></div>";

?>
<html>
<title>รายการใบสั่งยาจากแพทย์</title>
<head>
</head>
<style>
body,td,th {
	font-family:TH SarabunPSK;
	font-size: 18px;
	font-weight:bold;	
}
table {
  border-collapse: collapse;
  width: 98%;
}

th, td {
  text-align: left;
  padding: 5px;
}
.txt {
	font-family: TH SarabunPSK;
	font-size: 18px;
} 
</style>
<body>
<FORM METHOD=GET ACTION="drxlist3.php" target="_blank">
<TABLE>
<TR>
	<TD width="4%">VN : </TD>
	<TD><INPUT TYPE="text" NAME="vn_drx" class="txt" autofocus>&nbsp;&nbsp;<INPUT TYPE="submit" value="ตกลง" class="txt"></TD>
</TR>
</TABLE>

<INPUT TYPE="hidden" name="yr" value="<?php echo $_GET["yr"];?>">
<INPUT TYPE="hidden" name="m" value="<?php echo $_GET["m"];?>">
<INPUT TYPE="hidden" name="d" value="<?php echo $_GET["d"];?>">
</FORM>

<div id="list">

</div>

</body>
</html>
<?php  include("unconnect.inc");?>




