<?php
    session_start();
    print  "��Ǩ�ͺ���Ǫ�ѳ��㹤�ѧ�ҵ�� Lot.No ����ѹ�������<br> ";
    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED>����</th>";
    print "  <th bgcolor=6495ED>��¡��</th>";
    print "  <th bgcolor=6495ED>Exp.Date</th>";
    print "  <th bgcolor=6495ED>Lot.No</th>";
    print "  <th bgcolor=6495ED>㹤�ѧ</th>";
    print "  <th bgcolor=6495ED>˹���</th>";
    print "  <th bgcolor=CD853F>ź���</th>";
    print " </tr>";

    If (!empty($drugcode)){
          include("connect.inc");

         $query = "SELECT drugcode,tradname,genname,stock,mainstk,totalstk FROM druglst WHERE drugcode = '$drugcode' ";
		 //echo $query;
         $result = mysql_query($query) or die("Query failed");

	 for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	       }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }

          if(mysql_num_rows($result)){
                $dcode=$row->drugcode;
	$tname=$row->tradname;
	$nstock=$row->stock;
	$nmainstk=$row->mainstk;
	$ntotalstk=$row->totalstk;	
                    }
         else {
                die("��辺���� $drugcode <a target=_self  href='../nindex.htm'><�����</a>");
                 }
     //  $query = "SELECT drugcode,tradname,expdate,lotno,amount,unit,dgexplot FROM combill  WHERE dgexplot LIKE '$drugcode%' and amount >0 ";
         $query = "SELECT drugcode,tradname,expdate,lotno,amount,unit,dgexplot,row_id FROM combill  WHERE dgexplot LIKE '$drugcode%' and amount >0 ORDER BY dgexplot DESC";//DESC
		 //echo $query;

         $result = mysql_query($query)
                or die("Query failed");

         print "$drugcode,$tname <br>";
         print "<font face='Angsana New'>㹤�ѧ.......... $nmainstk <br>";
         print "���ͧ����..... $nstock<br>";
         print "�շ�����....... $ntotalstk <br>";
         print "����ͨӹǹ㹤�ѧ��� Lot.No ����ѹ������شѧ���<br> ";

         while (list ($drugcode, $tradname,$expdate,$lotno,$amount,$unit,$dgexplot,$row_id) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                       "  <td BGCOLOR=66CDAA><a target='_BLANK'  href='dgprocure_edit.php?editrow=$row_id'>$drugcode</td>\n".
                       "  <td BGCOLOR=66CDAA>$tradname</td>\n".
                       "  <td BGCOLOR=66CDAA>$expdate</td>\n".
                       "  <td BGCOLOR=66CDAA>$lotno</td>\n".
                       "  <td BGCOLOR=66CDAA>$amount</td>\n".
                       "  <td BGCOLOR=66CDAA>$unit</td>\n".
                       "  <td bgcolor=F5DEB3><a target=_self href=\"lotdele.php? Delrow=$row_id&Dgcode=$drugcode&cTrad=$tradname&cLot=$lotno&nAmt=$amount\">ź���</td>\n".
                       " </tr>\n");
                        }
          include("unconnect.inc");
                        }
    print "<table>";
?>
<a target=_top  href="../nindex.htm"><< �����</a>


