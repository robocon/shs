
...............................��ª��ͼ����·�����..............................<br>
<?php

	$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;
    $today="$d-$m-$yr";
    print "�ѹ��� $today  ��ª��ͼ����·�� VN ���";
    print "<a target=_self  href='../nindex.htm'><<�����</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
 
<th bgcolor=6495ED>VN</th>
 

  <th bgcolor=6495ED>����</th>
 


  
  </tr>

<?php
    $detail="�����";
    include("connect.inc");

 $query="CREATE TEMPORARY TABLE opdaydel SELECT row_id,vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,time1,time2 FROM opday WHERE thidate LIKE '$today%'   ";
    $result = mysql_query($query) or die("Query failed,warphar");

  
 $query="SELECT  row_id,vn,thidate,hn,ptname,COUNT(*) AS duplicate FROM opdaydel GROUP BY vn HAVING duplicate > 1";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($row_id1,$vn,$thidate,$hn,$ptname) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);

        print (" <tr>\n".
      
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
   
             "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"opdaydel1.php? cRow_id=$row_id1&cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd\">�������ͷӡ��ź</a></td>\n".
      
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>




