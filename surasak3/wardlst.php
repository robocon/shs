

<?php
   session_start();
   session_unregister("cWardname");    
    $cWardcode=substr($ward,0,2);
	$cWardname=substr($ward,2);
   session_register("cWardname");    

    $today="$d-$m-$yr";
   print "<font face='Angsana New'>�ѹ��� $today  ��¡����ԡ�Ҩҡ $cWardname ";
	print "&nbsp;&nbsp;&nbsp;&nbsp<input type=button onclick='history.back()' value='<<< ��Ѻ�'>";
  //print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
    <th bgcolor=6495ED><font face='Angsana New'>��§</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
    <th bgcolor=6495ED><font face='Angsana New'>AN</th>
  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>
    <th bgcolor=6495ED><font face='Angsana New'>�Ҥ����</th>
    <th bgcolor=6495ED><font face='Angsana New'>�Է��</th>
    <th bgcolor=6495ED><font face='Angsana New'>ᾷ��</th>
    <th bgcolor=6495ED><font face='Angsana New'>�Ѵʵ�͡/����</th>
 </tr>

<?php
    $detail="������Ǫ�ѳ��";
    $num=0;
    include("connect.inc");
    $query = "SELECT whokey,date,ptname,hn,an,price,row_id,accno,ptright,doctor,dgtake FROM dphardep WHERE whokey LIKE '$cWardcode%' and date LIKE '$today%' and an !='' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($whokey,$date,$ptname,$hn,$an,$price,$row_id,$accno,$ptright,$doctor,$dgtake) = mysql_fetch_row ($result)) {
        $num++;
		$cBed=substr($whokey,2);
        $time=substr($date,11);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cBed</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"wrxdetail.php? sBed=$cBed&sDate=$date&nRow_id=$row_id&nAccno=$accno&sPtright=$ptright\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
		   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
   		   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
   		   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dgtake</td>\n".
		   " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




