<?php
  include("connect.inc");
   print "<a href='../nindex.htm'><font face='Angsana New'><< �����</a><br>";
/////////
//runno  to find date established 0
    $query = "SELECT title,startday FROM runno WHERE title = 'RXAC'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $dStartday=$row->startday;

//   $dStartday=(substr($dStartday,0,4)-543).substr($dStartday,4); //�ѹ��駤�� 0
   $date2=date("Y-m-d H:i:s");  //�ѹ���ӹǳ 

   $s = strtotime($date2)-strtotime($dStartday);
//   echo "�ӹǹ�Թҷ� $s<br>";  //seconds
   $d = intval($s/86400);   //day

   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
//   echo "�ӹǹ�ѹ  $d �ѹ $h �������<br>";

   $days= $d;
   if ($h>12){
         $days=$d+1;
                        }  
print "�ѹ���������Ѻ�Ҩ������� $dStartday �֧�Ѩ�غѹ�ӹǳ�� $days �ѹ<br>";       
////////


   $query="SELECT row_id FROM druglst";
   $result = mysql_query($query);
   $xRec = mysql_num_rows($result);
   print "�ӹǹ records $xRec<br>";

   $_unitpri=0;  //�Ҥҷع���������
   $_salepri=0;  //�ҤҢ�����������

      print "<table>";
      print " <tr>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>row</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>�ӹǹ�ط��</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>㹤�ѧ</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>���ͧ����</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҷع</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ��</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>���� %</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��Ť��(�Ҥҷع)</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��Ť��(�ҤҢ��)</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��������</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>�����?��͹</th>";
      print " </tr>";

  for ($n=1; $n<=$xRec; $n++){
        $query = "SELECT * FROM druglst WHERE row_id = $n ";
        $result = mysql_query($query) or die("Query druglst failed");
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    if(mysql_num_rows($result)){
          $nRow_id=$row->row_id;
          $cDrugcode=$row->drugcode;
          $cTradname=$row->tradname;
          $nUnitpri = $row->unitpri;
          $nSalepri = $row->salepri;
          $nStock     = $row->stock;
          $nMainstk = $row->mainstk;
          $nRxacc = $row->rxaccum;         
          $nRate  = $row->rxrate;
          $nMonth = $row->stkpmon;
          $nTotalstk = $nStock+$nMainstk;  

          if ($nTotalstk > 0){
	$xUnitpri =$nUnitpri * $nTotalstk;  //�������Ҥҷع
	$xSalepri=$nSalepri * $nTotalstk; //�������ҤҢ��
	$_unitpri  = $_unitpri+($nUnitpri * $nTotalstk);  //�������Ҥҷع
	$_salepri = $_salepri+($nSalepri * $nTotalstk); //�������ҤҢ��
                $profit=($nSalepri - $nUnitpri)*100/$nUnitpri;
                $profit=number_format($profit,1);
		}
          else {
	$xUnitpri =0;
	$xSalepri=0;
	$profit=0;
	}
// rate �������        
          if ($nRxacc > 0){
                     $nRate      = ($nRxacc/$days)*30;      //�ӹǹ������͹
                     $nRate=number_format($nRate,1);
                     $nMonth    = $nTotalstk/$nRate;           //��������������ա�����͹
                     $nMonth=number_format($nMonth,1);

	  	         }
          else {
	     $nRate   = 0;
	     $nMonth = 0;
	         }
// rate �������

        $query ="UPDATE druglst SET  totalstk = $nMainstk+$nStock,
			          rxrate    = $nRate,
			          stkpmon= $nMonth
                       WHERE row_id=$n ";
        $result = mysql_query($query) or die("Query failed,update druglst, $n");
//        echo mysql_errno() . ": " . mysql_error(). "\n";
//        echo "<br>";
//      print "�ѹ�֡���������º���� �Ƿ�� $n<br><br>";

         print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nRow_id</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cDrugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cTradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nTotalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nMainstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nStock</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nUnitpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nSalepri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$profit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$xUnitpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$xSalepri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nRxacc</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nRate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nMonth</td>\n".
           " </tr>\n");

      }
  }
print "</table>";

$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
print "<br>�ӹǳ��Ť�����Ǫ�ѳ������� $Thaidate<br>";
$netprofit = $_salepri-$_unitpri;
print "******************************************<br>";
print "�ӹǳ��Ť�����Ǫ�ѳ������� ����Ҥҷع �� = $_unitpri �ҷ <br>";
print "�ӹǳ��Ť�����Ǫ�ѳ������� ����ҤҢ���� = $_salepri �ҷ <br>";
print "�ӹǳ������ = $_salepri - $_unitpri = $netprofit �ҷ <br>";
$profit=$netprofit*100/$_unitpri;
$profit=number_format($profit,1);
print "��������� = $profit  %<br>";
print "<br><a href='../nindex.htm'><< �����</a><br>";

include("unconnect.inc");
?>

