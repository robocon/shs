<?php
    print "<font face='Angsana New'><b>��ª��ͼ�����㹵��ᾷ��</b><br>";
    print "<b>ᾷ��:</b> $doctor <br>"; 
//    print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
    <th bgcolor=6495ED>VN</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
    <th bgcolor=6495ED><font face='Angsana New'>��§</th>
	    <th bgcolor=6495ED><font face='Angsana New'>�ѹ��˹���</th>
  <th bgcolor=6495ED>�ä</th>
  </tr>
 

<?php
    include("connect.inc");
$doctor=substr($doctor,0,5);
    $query = "SELECT date,an,hn,ptname,bedcode,diag,dcdate,doctor FROM ipcard WHERE doctor LIKE '$doctor%'";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
while(list($date,$an,$hn,$ptname,$bedcode,$diag,$dcdate,$doctor)=mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
		   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedcode</td>\n".
				  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dcdate</td>\n".
					  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           " </tr>  \n"  );
					
       }

    include("unconnect.inc");
?>
</table>




