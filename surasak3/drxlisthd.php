<?php    
	
	include("connect.inc");

$today=date("d-m-").(date("Y")+543);
	
if(isset($_GET["action"]) && $_GET["action"] =="refresh"){
	
header("content-type: application/x-javascript; charset=TIS-620");
$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
print ("<table>
 <tr>
	<th bgcolor=6495ED><font face='Angsana New'>#</th>
	<th bgcolor=6495ED><font face='Angsana New'>VN</th>
	<th bgcolor=6495ED><font face='Angsana New'>����</th>
	<th bgcolor=6495ED><font face='Angsana New'>����</th>
	<th bgcolor=6495ED><font face='Angsana New'>HN</th>
	<th bgcolor=6495ED><font face='Angsana New'>�����</th>
	<th bgcolor=6495ED><font face='Angsana New'>�Է��</th>
		<th bgcolor=6495ED><font face='Angsana New'>ᾷ��</th>
			<th bgcolor=6495ED><font face='Angsana New'>���ᾷ��</th>
		<th bgcolor=6495ED><font face='Angsana New'>�����ͧ��</th>
			<th bgcolor=6495ED><font face='Angsana New'>�����Ѻ������</th>
	<th bgcolor=6495ED><font face='Angsana New'>���ҷ��Ѵ</th>
	
 </tr>");

  //  $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew FROM dphardep WHERE whokey='DR' and date LIKE '$today%'  AND dr_cancle is null ORDER BY stkcutdate, row_id  DESC ";
  $HD1="HD";
  $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin FROM dphardep WHERE whokey LIKE '$HD1%' and date LIKE '$today%'  AND dr_cancle is null AND doctor LIKE '$HD1%'  ORDER BY stkcutdate, hn  DESC ";

    $result = mysql_query($query) or die("Query failed");

	$num=mysql_num_rows($result);

    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin) = mysql_fetch_row ($result)) {
        
        $time=substr($date,11);
		if($stkcutdate == "")
			$bgcolor="#33FFFF";
		else
			$bgcolor="#FFFFFF";

        print (" <tr>\n".
           "  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$num$HD</td>\n".
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

exit();
}

$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];

    print "<font face='Angsana New'>�ѹ��� $today  ��¡�������Ҩҡᾷ����ͧ����� ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;�����</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='drx1datehd.php'>&lt;&lt;���͡�ѹ�������</a>";

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
	
			url = 'drxlisthd.php?action=refresh&d=<?php echo $_GET["d"];?>&m=<?php echo $_GET["m"];?>&yr=<?php echo $_GET["yr"];?>';
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById("list").innerHTML = xmlhttp.responseText;
tt = 20*1000;
setTimeout("searchSuggest();",tt);
}

</SCRIPT>

<div id="list">

</div>

</body>
</html>
<?php  include("unconnect.inc");?>




