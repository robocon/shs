<?php
    $today=date("d-m-").(date("Y")+543);
    print "<font face='Angsana New'>วันที่ $today  รายการใบสั่งยาจากแพทย์ ";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='drx1date.php'>&lt;&lt;เลือกวันที่ใหม่</a>";
    $today = $_GET["yr"]."-".$_GET["m"]."-".$_GET["d"];
?>
<html>
<head>
</head>
<body>

<SCRIPT LANGUAGE="JavaScript">
	t = 10*1000;
	setTimeout("window.location.reload()",t);
</SCRIPT>

<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>VN</th>
  <th bgcolor=6495ED><font face='Angsana New'>เวลา</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>ค่ายา</th>
    <th bgcolor=6495ED><font face='Angsana New'>สิทธิ</th>
    <th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
	<th bgcolor=6495ED><font face='Angsana New'>เวลาที่ตัด</th>
 </tr>

<?php
    $detail="ค่ายา";
    
    include("connect.inc");

    $query = "SELECT tvn, date,ptname,hn,price,row_id,accno,ptright,doctor, stkcutdate FROM dphardep WHERE whokey='DR' and date LIKE '$today%'  AND dr_cancle is null ORDER BY stkcutdate, row_id  DESC ";
    $result = mysql_query($query) or die("Query failed");

$num=mysql_num_rows($result);

    while (list ($tvn,$date,$ptname,$hn,$price,$row_id,$accno,$ptright,$doctor, $stkcutdate) = mysql_fetch_row ($result)) {
        
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
			"  <td BGCOLOR='".$bgcolor."'><font face='Angsana New'>$stkcutdate</td>\n".
		   " </tr>\n");
		   $num--;
       }
    include("unconnect.inc");
?>
</table>
</body>
</html>





