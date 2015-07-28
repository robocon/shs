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
header("content-type: application/x-javascript; charset=TIS-620");
}
	include("connect.inc");

$today=date("d-m-").(date("Y")+543);
	
if(isset($_GET["action"]) && $_GET["action"] =="refresh"){
//echo "==>".$_GET["action"];
//echo "<meta http-equiv='refresh' content='10'> ";  	
$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
print ("<table>
 <tr>
	<th bgcolor=6495ED><font face='Angsana New'>#</th>
	<th bgcolor=6495ED><font face='Angsana New'>VN</th>
	<th bgcolor=6495ED><font face='Angsana New'>เวลา</th>
	<th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
	<th bgcolor=6495ED><font face='Angsana New'>HN</th>
	<th bgcolor=6495ED><font face='Angsana New'>ค่ายา</th>
	<th bgcolor=6495ED><font face='Angsana New'>สิทธิ</th>
	<th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
	<th bgcolor=6495ED><font face='Angsana New'>ผู้บันทึก</th>
	<th bgcolor=6495ED><font face='Angsana New'>คิวแพทย์</th>
	<th bgcolor=6495ED><font face='Angsana New'>คิวห้องยา</th>
	<th bgcolor=6495ED><font face='Angsana New'>เวลารับใบสั่งยา</th>
	<th bgcolor=6495ED><font face='Angsana New'>เวลาที่ตัด</th>
	
 </tr>");

  //  $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew FROM dphardep WHERE whokey='DR' and date LIKE '$today%'  AND dr_cancle is null ORDER BY stkcutdate, row_id  DESC ";

  $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin,idname FROM dphardep WHERE  whokey='DR' and date LIKE '$today%' AND dr_cancle is null  ORDER BY stkcutdate, hn  DESC ";
	//echo "==>".$query."<br>";
    $result = mysql_query($query) or die("Query failed");

	$num=mysql_num_rows($result);
	echo "จำนวน $num รายการ";
    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin,$idname) = mysql_fetch_row ($result)) {
        

        $time=substr($date,11);
		if($stkcutdate == "")
			$bgcolor="#66CDAA";
		else
			$bgcolor="#FFFFFF";

        print " <tr>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$num</td>\n".
			"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$tvn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$time</td>\n";
		if($tvn==""){
			print "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$ptname</td>\n";
		}else{
       	 	print   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'><a target=_BLANK  href=\"drxdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno&sPtright=$ptright\">$ptname</a></td>\n";
		}
          print "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$price</td>\n".
		   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$ptright</td>\n".
   		   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$doctor</td>\n".
			  "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$idname</td>\n".
			   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$kew</td>\n".
			   	"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$kewphar</td>\n".
			"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$pharin</td>\n".
			   	"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$stkcutdate</td>\n".
		   " </tr>\n";
		   $num--;
		}
   

print ("</table>");

exit();
}

$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];

    print "<font face='Angsana New'>วันที่ $today  รายการใบสั่งยาจากแพทย์ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='drx1date.php'>&lt;&lt;เลือกวันที่ใหม่</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_blank  href='drxlist_not.php'>&lt;&lt;ค้างจ่าย</a>";

?>
<html>
<head>
</head>
<body>
<FORM METHOD=GET ACTION="drxlist3.php" target="_blank">
<TABLE>
<TR>
	<TD>VN : </TD>
	<TD><INPUT TYPE="text" NAME="vn_drx"></TD>
	<TD><INPUT TYPE="submit" value="ตกลง">&nbsp;</TD>
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




