<?php
    session_start();

  include("connect.inc");

	$query = "Select count(row_id) as count_row From combill where row_id ='$Delrow' ";

	$result  = Mysql_Query($query);

	list($count_row) = Mysql_fetch_row($result);

	if($count_row <= 0){
		
		echo "��¡�ù����¡��ԡ����Ǥ�Ѻ";
		exit();

	}

  $query = "delete from combill where row_id ='$Delrow'";
  $result = mysql_query($query) or die("�������öź�ҵ�� LotNo �����");

  $query ="UPDATE druglst SET  mainstk= $nmainstk-$nAmt,
                                                     totalstk = $ntotalstk-$nAmt
                                     WHERE drugcode= '$Dgcode' ";
  $result = mysql_query($query)
                       or die("Query failed,update druglst");

///////
 
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


         $query = "SELECT drugcode,tradname,genname,stock,mainstk,totalstk FROM druglst WHERE drugcode = '$dcode' ";
         $result = mysql_query($query) or die("Query failed");

	 for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	       }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }


//                $dcode=$row->drugcode;
	$tname=$row->tradname;
	$nstock=$row->stock;
	$nmainstk=$row->mainstk;
	$ntotalstk=$row->totalstk;	

         $query = "SELECT drugcode,tradname,expdate,lotno,amount,unit,dgexplot,row_id FROM combill  WHERE dgexplot LIKE '$dcode%' and amount >0 ORDER BY dgexplot DESC";//DESC
         $result = mysql_query($query)
                or die("Query failed");

         print "��¡�����Ǫ�ѳ�����§��� Lot.No ������������ء�͹<br>";
         print "$dcode,$tname <br>";

         $x++;
         $aLot[$x]="ź�� $cTrad  ੾��LotNo. $cLot �ӹǹ $nAmt ˹��� ���º����";
         for ($n=1; $n<=$x; $n++){
                print "<font face='Angsana New'>$n. $aLot[$n]<br>";
	                                 }
         print "<br>����ͨӹǹ�ѧ���<br>";
         print "㹤�ѧ.......... $nmainstk <br>";
         print "���ͧ����..... $nstock<br>";
         print "�շ�����....... $ntotalstk <br>";
         print "����ͨӹǹ㹤�ѧ��� Lot.No ����ѹ������شѧ���<br> ";

         while (list ($drugcode, $tradname,$expdate,$lotno,$amount,$unit,$dgexplot,$row_id) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                       "  <td BGCOLOR=66CDAA>$dcode</td>\n".
                       "  <td BGCOLOR=66CDAA>$tradname</td>\n".
                       "  <td BGCOLOR=66CDAA>$expdate</td>\n".
                       "  <td BGCOLOR=66CDAA>$lotno</td>\n".
                       "  <td BGCOLOR=66CDAA>$amount</td>\n".
                       "  <td BGCOLOR=66CDAA>$unit</td>\n".
                       "  <td bgcolor=F5DEB3><a target=_self href=\"lotdele.php? Delrow=$row_id&Dgcode=$drugcode&cTrad=$tradname&cLot=$lotno&nAmt=$amount\">ź���</td>\n".
                       " </tr>\n");
                        }
          include("unconnect.inc");
    print "<table>";
?>
<a target=_top  href="../nindex.htm"><< �����</a>


