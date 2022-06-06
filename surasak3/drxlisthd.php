<?php    
	
include("connect.inc");
$dbi = new mysqli($ServerName,$User,$Password,$DatabaseName);

$today=date("d-m-").(date("Y")+543);
	
if(isset($_GET["action"]) && $_GET["action"] =="refresh"){ 
	
header("content-type: application/x-javascript; charset=TIS-620");
$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];

$appdate_en = ($_GET['yr']-543).'-'.$_GET['m'].'-'.$_GET['d'];


$hd_name_list = array('FU18'=>'ไตเทียม1','FU39'=>'ไตเทียม2');

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
	<th bgcolor=6495ED>ห้อง</th>
	
 </tr>");

  //  $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew FROM dphardep WHERE whokey='DR' and date LIKE '$today%'  AND dr_cancle is null ORDER BY stkcutdate, row_id  DESC ";
  $HD1="HD";
  $query = "SELECT a.*,b.`code` 
  FROM (
  SELECT tvn,date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate,kew,kewphar,pharin 
  FROM dphardep WHERE whokey LIKE '$HD1%' and date LIKE '$today%'  
  AND dr_cancle is null 
  AND doctor LIKE '$HD1%'  
  ORDER BY stkcutdate, hn  DESC 
  ) AS a 
  LEFT JOIN (
	SELECT `hn`, SUBSTRING(`detail`,1,4) AS `code` FROM `appoint` WHERE `appdate_en` = '$appdate_en'
  ) AS b ON b.`hn` = a.`hn`
  ORDER BY b.code,a.tvn ASC";

    $result = mysql_query($query) or die("Query failed ".mysql_error());

	$num=mysql_num_rows($result);

    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate,$kew,$kewphar,$pharin,$code) = mysql_fetch_row ($result)) {
        
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
				   "<td>$hd_name_list[$code]</td>".
		   " </tr>\n");
		   $num--;
       }
   

print ("</table>");

exit();
}

$today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];

    print "<font face='Angsana New'>วันที่ $today  รายการใบสั่งยาจากแพทย์ห้องไตเทียม ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='drx1datehd.php'>&lt;&lt;เลือกวันที่ใหม่</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_blank  href='drxlisthd_not.php'>&lt;&lt;ค้างจ่าย</a>";

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




