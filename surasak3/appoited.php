<?php
session_start();
include("connect.inc");

$appd=$_REQUEST["appdate"].' '.$_REQUEST["appmo"].' '.$_REQUEST["thiyr"];

print "<font face='Angsana New'><b>��ª��ͤ���Ѵ��Ǩ</b><br>";
print "<b>ᾷ��:</b> $doctor <br>"; 
print "<b>�Ѵ���ѹ���</b> $appd ";

//    print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>";
?>
&nbsp;&nbsp;&nbsp;&nbsp;

<table>
	<tr>
		<th bgcolor=6495ED>#</th>
		<th bgcolor=6495ED><A HREF="appoited.php?sortby=time&appdate=<?php echo $_REQUEST["appdate"];?>&appmo=<?php echo urlencode($_REQUEST["appmo"]);?>&thiyr=<?php echo $_REQUEST["thiyr"];?>&doctor=<?php echo urlencode($_REQUEST["doctor"]);?>" style="color: #000000;">����</A></th>
		<th bgcolor=6495ED>HN</th>
		<th bgcolor=6495ED><font face='Angsana New'>����</th>
    
		<th bgcolor=6495ED><font face='Angsana New'>��¡��</th>
		<th bgcolor=6495ED><font face='Angsana New'>�Ѵ������</th>
		<th bgcolor=6495ED><font face='Angsana New'>DIAG ��͹�Ѵ</th>
		<th bgcolor=6495ED>����</th>
		<th bgcolor=6495ED><font face='Angsana New'>�ѹ�͡㺹Ѵ</th>
		<th bgcolor=6495ED><font face='Angsana New'>���˹�ҷ��</th>
		<th bgcolor=6495ED>��?</th>
		<th bgcolor=6495ED>¡��ԡ</th>
		<th bgcolor=6495ED>�����</th>
	</tr>

<?php


if($_GET["sortby"] == "time"){
	$OSB = "Order by apptime ASC ";
}else{
	$OSB = "";
}


$doctor2 = substr($_REQUEST["doctor"],0,5);	
$query = "SELECT row_id,hn,ptname,appdate,apptime,came,row_id,age,depcode,detail,officer,detail2,date,other FROM appoint WHERE appdate = '$appd' and doctor like '$doctor2%' AND detail like '".$_POST["detail"]."%' ".$OSB;
echo "<!-- ",$query," -->";


$result = mysql_query($query) or die("Query failed");
$num=0;

while (list ($row_id,$hn,$ptname,$appdate,$apptime,$came,$row_id,$age,$depcode,$detail,$officer,$detail2,$date,$other) = mysql_fetch_row ($result)) {
	$num++;
$date1=substr($date,0,4);
$date2=substr($date,5,2);
$date3=substr($date,8,2);
$thdatehn=$date3.'-'.$date2.'-'.$date1.''.$hn;
$sql = "Select diag From opday where thdatehn = '".$thdatehn."'  limit 1 ";
list($diag) = Mysql_fetch_row(Mysql_Query($sql));

	print (" <tr>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
  
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail2</td>\n".
	//       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depcode</td>\n".

	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".

			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$other</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".

	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'>$came</td>\n".
	//   "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"editappoi.php? cRow=$row_id&cAppdate=$appdate&cApptime=$apptime\">���</a></td>\n".
	"  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"delappoi.php? cRow=$row_id\">¡��ԡ</a></td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'><A HREF=\"appinsert2.php?row_id=".$row_id."\" target=\"_blank\">�����</a></td>\n".
	" </tr>\n");
}

include("unconnect.inc");
?>
</table>




