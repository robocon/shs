<?php    
	
	include("connect.inc");
$vn= $_GET["vn"];
$today=date("d-m-").(date("Y")+543);
	


$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
  print "<font face='Angsana New'>ระบบเบิกยาห้องไตเทียม ";
    print "<font face='Angsana New'>วันที่ $today  รายการใบสั่งยาจากแพทย์ VN : $vn ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='drx1datehd1.php'>&lt;&lt;เลือกวันที่ใหม่</a>";

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
	
			url = 'drxlisthd1.php?action=refresh&d=<?php echo $_GET["d"];?>&m=<?php echo $_GET["m"];?>&yr=<?php echo $_GET["yr"];?>&vn=<?php echo $_GET["vn"];?>';
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
    $HD1="HD";
  $query = "SELECT tvn,date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin,whokey FROM dphardep WHERE  date LIKE '$today%'  AND dr_cancle is null and doctor LIKE '$HD1%'  Order by hn DESC  ";

    $result = mysql_query($query) or die("Query failed");

	$num=mysql_num_rows($result);

    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin,$whokey) = mysql_fetch_row ($result)) {
        
        $time=substr($date,11);
		if($stkcutdate == "")
			$bgcolor="#66CDAA";
		else
			$bgcolor="#FFFFFF";

   $whokey=substr($whokey,0,2);
		if($whokey == "HD")
			$bgcolor1="#00CCFF";
		else
			$bgcolor1="#66CDAA";

	if($bgcolor=="#FFFFFF")
			$bgcolor1="#FFFFFF";
		else
			$bgcolor1=$bgcolor1;

        print (" <tr>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$num</td>\n".
			"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$tvn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'><a target=_BLANK  href=\"drxdetailhd.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$price</td>\n".
		   "  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$ptright</td>\n".
   		   "  <td BGCOLOR='".$bgcolor1."'><font face='Angsana New'>$doctor</td>\n".
			 
		   " </tr>\n");
		   $num--;
       }
   

print ("</table>");
?>

</body>
</html>
<?php  include("unconnect.inc");?>
<FONT SIZE="5" COLOR="#000099">***หมายเหตุ***<BR>
<FONT SIZE="4" COLOR="#000000">สีเขียวล้วน คือ ยังไม่ได้ตัดสต๊อก ยังไม่ได้ส่งห้องยา สามารถแก้ไข / เพิ่มได้</FONT>
<BR>
<FONT SIZE="4" COLOR="#66CDAA">สีเขียวล้วน+สีฟ้า คือ ยังไม่ได้ตัดสต๊อก ส่งห้องยาแล้ว สามารถแก้ไข / เพิ่มได้</FONT>
<BR>
<FONT SIZE="4" COLOR="#FF0066">สีขาว คือ ได้ทำการตัดสต็อกแล้ว ไม่สามารถแก้ไข / เพิ่มได้</FONT></FONT>



