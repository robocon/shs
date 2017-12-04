<?php    
	
	include("connect.inc");
$vn= $_GET["vn"];
$today=date("d-m-").(date("Y")+543);
	


$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];

    print "<font face='Angsana New'>วันที่ $today  รายการใบสั่งยาจากแพทย์ VN : $vn ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='drx1dateer.php'>&lt;&lt;เลือกวันที่ใหม่</a>";

?>
<html>
<head>
</head>
<body>

<SCRIPT LANGUAGE="JavaScript">
	t = 1*1000;
	
	//setTimeout("searchSuggest();",t);

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
	
			url = 'drxlister.php?action=refresh&d=<?php echo $_GET["d"];?>&m=<?php echo $_GET["m"];?>&yr=<?php echo $_GET["yr"];?>&vn=<?php echo $_GET["vn"];?>';
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
			
	
 </tr>");

  //  $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew FROM dphardep WHERE whokey='DR' and date LIKE '$today%'  AND dr_cancle is null ORDER BY stkcutdate, row_id  DESC ";
  $query = "SELECT tvn,date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin FROM dphardep WHERE whokey='DR' and date LIKE '$today%'  AND dr_cancle is null AND tvn='$vn' Order by row_id DESC  ";

    $result = mysql_query($query) or die("Query failed");

	$num=mysql_num_rows($result);

    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin) = mysql_fetch_row ($result)) {
        
        $time=substr($date,11);
		if($stkcutdate == "")
			$bgcolor="#66CDAA";
		else
			$bgcolor="#FFFFFF";

if($stkcutdate == "")
			$A="";
			//$link="<a target=_BLANK  href=\"drxdetailer.php? sDate=$date&nRow_id=$row_id&nAccno=$accno&sPtright=$ptright\">$ptname</a>";
		else
			$A="!คำเตือนได้ทำการตัดสต๊อกแล้วจะเปลี่ยนแปลงยากรุณาติดต่อห้องยา โทร 1160";
		//$link="$ptname";

if($stkcutdate == "")
			//A="";
			$link="<a target=_BLANK  href=\"drxdetailer.php? sDate=$date&nRow_id=$row_id&nAccno=$accno&sPtright=$ptright\">$ptname</a>";
		else
			//$A="!คำเตือนได้ทำการตัดสต๊อกแล้วจะเปลี่ยนแปลงยากรุณาติดต่อห้องยา โทร 1160";
		$link="$ptname";



	//	if ($stkcutdate == ""){$onclick= "<a target=_BLANK  href=\"drxdetailer.php? sDate=$date&nRow_id=$row_id&nAccno=$accno&sPtright=$ptright\">$ptname</A>";
//}else
//	{$onclick = "$ptname";
//};



        print (" <tr>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$num</td>\n".
			"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$tvn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$time</td>\n".
          // "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>".$onclick."</a></td>\n".
		
			  "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$link</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$price</td>\n".
		   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$ptright</td>\n".
   		   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$doctor</td>\n".
			 
		   " </tr>\n");
		   $num--;
       }
   

print ("</table>");
print ("<FONT SIZE=5 COLOR=#CC0033>$A</FONT><br>");
?>

</body>
</html>
<?php  include("unconnect.inc");?>


<FONT SIZE="5" COLOR="#000099">***หมายเหตุ***<BR>
<FONT SIZE="4" COLOR="#66CDAA">สีเขียว คือ ยังไม่ได้ตัดสต๊อก สามารถแก้ไข / เพิ่มได้</FONT><BR>
<FONT SIZE="4" COLOR="#FF0066">สีขาว คือ ได้ทำการตัดสต็อกแล้ว ไม่สามารถแก้ไข / เพิ่มได้</FONT></FONT>



