<?php
    $today="$d-$m-$yr";
    print "<font face='Angsana New'>�ѹ��� $today  ���͡��¡�������ҷ���ͧ��ä׹����Ҥ�ѧ ";
//    print "(�׹�ҷ��е������ԡ������, �׹���㺤�ԡ�׹�ҷ���)";
    print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=#669999>#</th>
  <th bgcolor=#669999>����</th>
  <th bgcolor=#669999>����</th>
  <th bgcolor=#669999>HN</th>
  <th bgcolor=#669999>AN</th>
   <th bgcolor=#669999>vn</th>
  <th bgcolor=#669999>�����</th>
  <th bgcolor=#669999>�����Թ</th>
  <th bgcolor=#669999>������</th>
    <th bgcolor=#669999>�¡��ԡ</th>
        <th bgcolor=#669999>�¡��ԡ</th>
  </tr>

<?php
    $detail="�����";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,hn,an,price,paid,row_id,accno,dgtake,borrow,tvn  FROM phardep WHERE date LIKE '$today%'   order by hn,date   ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date,$ptname,$hn,$an,$price,$paid,$row_id,$accno,$dgtake,$borrow,$vn) = mysql_fetch_row ($result)) {
        $num++;
		 if($price > 0)
			 $color="#C0C0C0";
			 else
			 $color = "#FFCC99";
        $time=substr($date,11);
        echo " <tr>\n";
           echo "  <td BGCOLOR=$color>$num</td>\n";
          echo  "  <td BGCOLOR=$color>$time</td>\n";
          echo  "  <td BGCOLOR=$color>";
		  echo "<a  href=\"dgdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">";
		if($borrow == 'T'){

		  echo "<FONT COLOR=\"red\">",$ptname,"&nbsp;</FONT>";

		}else{

		  echo $ptname;

		} 
		echo "</a>";
		  echo "</td>\n";
         echo   "  <td BGCOLOR=$color>$hn</td>\n";
         echo   "  <td BGCOLOR=$color>$an</td>\n";
		    echo   "  <td BGCOLOR=$color>$vn</td>\n";
          echo  "  <td BGCOLOR=$color>$price</td>\n";
          echo  "  <td BGCOLOR=$color>$paid</td>\n";
		   echo  " <td BGCOLOR=$color>$dgtake</td>\n";
          echo  "  <td BGCOLOR=$color><a  href=\"dgdetailc.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">�¡��ԡ</a>\n";
          echo " </tr>\n";
		     echo  " <td BGCOLOR=$color>$borrow</td>\n";
       }
    include("unconnect.inc");
?>
</table>




