<?php    
if(isset($_GET["action"]) && $_GET["action"] =="refresh"){
header("content-type: application/x-javascript; charset=TIS-620");

}
	include("connect.inc");

	
$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];

    print "<font face='Angsana New'>วันที่ $today  รายการใบสั่งยาจากแพทย์ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='drx1date.php'>&lt;&lt;เลือกวันที่ใหม่</a>";

?>
<html>
<head>
</head>
<body>

<SCRIPT LANGUAGE="JavaScript">

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
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById("list").innerHTML = xmlhttp.responseText;
tt = 20*1000;
setTimeout("searchSuggest();",tt);
}

</SCRIPT>


<?php
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
			<th bgcolor=6495ED><font face='Angsana New'>คิวแพทย์</th>
		<th bgcolor=6495ED><font face='Angsana New'>คิวห้องยา</th>
			<th bgcolor=6495ED><font face='Angsana New'>เวลารับใบสั่งยา</th>
	<th bgcolor=6495ED><font face='Angsana New'>เวลาที่ตัด</th>
	
 </tr>");

 $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin FROM dphardep WHERE whokey='DR' and date LIKE '$today%'  AND (dr_cancle is null || dr_cancle='') AND tvn = '".$_GET["vn_drx"]."' ORDER BY stkcutdate, hn  DESC ";
//echo $query;
    $result = mysql_query($query) or die("Query failed");

	$num=mysql_num_rows($result);

    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin) = mysql_fetch_row ($result)) {
        
        $time=substr($date,11);
		if($stkcutdate == "")
			$bgcolor="#66CDAA";
		else
			$bgcolor="#FFFFFF";

        print (" <tr>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$num</td>\n".
			"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$tvn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'><a target=_BLANK  href=\"drxdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno&sPtright=$ptright\">$ptname</a></td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$price</td>\n".
		   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$ptright</td>\n".
   		   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$doctor</td>\n".
			   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$kew</td>\n".
			   	"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$kewphar</td>\n".
			"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$pharin</td>\n".
			   	"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$stkcutdate</td>\n".
		   " </tr>\n");
		   $num--;
       }
   

print ("</table>");
?>

</body>
</html>
<?php  include("unconnect.inc");?>




