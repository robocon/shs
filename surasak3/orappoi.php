<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);
    $appd=$appdate.' '.$appmo.' '.$thiyr;
    print "<font face='Angsana New'><b>��ª��ͤ���Ѵ��Ǩ��ҵѴ</b><br>";
  
  
    print "<b>�Ѵ���ѹ���</b> $appd<br> ";
   print "�ѹ/���ҷӡ�õ�Ǩ�ͺ....$Thaidate"; 
    print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>.....</a>";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED>����</th>
    <th bgcolor=6495ED>�ѹ���Ѵ</th>
    <th bgcolor=6495ED>ᾷ����Ѵ</th>
	  <th bgcolor=6495ED>����</th>
	    <th bgcolor=6495ED>����</th>
  
  <th bgcolor=6495ED>���Ѵ</th>
  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT hn,ptname,age,apptime,doctor,detail2,other,appdate,officer FROM appoint WHERE appdate like '%$appd%' and detail ='FU05 ��ҵѴ' ORDER BY appdate ";
    $result = mysql_query($query)
        or die("Query failed");
    $num=0;
    while (list ($hn,$ptname,$age,$apptime,$doctor,$detail2,$other,$appdate,$officer) = mysql_fetch_row ($result)) {
        $num++;
$officer=substr($officer,0,10);
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$age</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$appdate</td>\n".
    
		   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n".
			"  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail2 &nbsp;&nbsp;$other</td>\n".
				"  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




