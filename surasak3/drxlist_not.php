<?php    
if(isset($_GET["action"]) && $_GET["action"] =="refresh"){
header("content-type: application/x-javascript; charset=TIS-620");

}
	include("connect.inc");


	
if(isset($_GET["action"]) && $_GET["action"] =="refresh"){
	

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

  $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin,idname FROM dphardep WHERE left(doctor,2) != 'HD' AND whokey='DR' and (date LIKE '0000-00-00%' or date ='') and hn='".$_GET['hn']."' AND dr_cancle is null  ORDER BY stkcutdate, hn  DESC ";

    $result = mysql_query($query) or die("Query failed");

	$num=mysql_num_rows($result);

    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin,$idname) = mysql_fetch_row ($result)) {
        

        $time=substr($date,11);
		if($stkcutdate == "")
			$bgcolor="#66CDAA";
		else
			$bgcolor="#FFFFFF";

        print (" <tr>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$num</td>\n".
			"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$tvn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'><a target=_self  href=\"drxdetail_not.php? sDate=$date&nRow_id=$row_id&nAccno=$accno&sPtright=$ptright\">$ptname</a></td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$price</td>\n".
		   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$ptright</td>\n".
   		   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$doctor</td>\n".
			  "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$idname</td>\n".
			   "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$kew</td>\n".
			   	"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$kewphar</td>\n".
			"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$pharin</td>\n".
			   	"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$stkcutdate</td>\n".
		   " </tr>\n");
		   $num--;
		}
   

print ("</table>");

exit();
}


    print "<font face='Angsana New'>รายการใบสั่งยาค้างจ่ายจากแพทย์ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='drx1date.php'>&lt;&lt;เลือกวันที่ใหม่</a>";
	

?>
<html>
<head>
</head>
<body>

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
	
			url = 'drxlist_not.php?action=refresh&hn=<?php echo $_GET["hn_drx"];?>';
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById("list").innerHTML = xmlhttp.responseText;
tt = 20*1000;
setTimeout("searchSuggest();",tt);
}

</SCRIPT>

<FORM METHOD=GET ACTION="drxlist_not.php">
<TABLE>
<TR>
	<TD>HN : </TD>
	<TD><INPUT TYPE="text" NAME="hn_drx"></TD>
	<TD><INPUT TYPE="submit" value="ตกลง">&nbsp;</TD>
</TR>
</TABLE>


</FORM>
<div id="list">

</div>

</body>
</html>
<?php  include("unconnect.inc");?>




