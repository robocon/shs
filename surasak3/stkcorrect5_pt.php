<?php
  include("connect.inc");
   print "<a href='../nindex.htm'><font face='Angsana New'><< �����</a><br>";
//   print "- �ӹǹ�Ҩӹǹ�ط�����Ǫ�ѳ�� (㹤�ѧ + ���ͧ����)<br>";
//   print "- �ӹǹ�ҡ��âͧ���Ǫ�ѳ�����е�� <br>";
//   print "- �ӹǹ����Ť�����(�Ҥҷع)�ͧ���Ǫ�ѳ������� <br>";
//   print "- �ӹǹ����Ť�����(�ҤҢ��)�ͧ���Ǫ�ѳ������� <br>";
//   print "- �ӹǹ�ҡ�������¢ͧ���Ǫ�ѳ������� <br>";
//   print "- �ӹǹ���ѵ�ҡ��������͹(��/��͹) <br>";
//   print "- �ӹǹ�Ҩӹǹ��͹���������Ҿ���(�����?��͹) <br>";
///////////////runno  to find date established 0
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
print "�ѹ���������Ѻ�������� $dStartday �֧�Ѩ�غѹ�ӹǳ�� $days �ѹ<br>";   
/*  
   $query="SELECT row_id FROM druglst";
   $result = mysql_query($query);
   $xRec = mysql_num_rows($result);
   print "�ӹǹ records $xRec<br>";
*/
   $_unitpri=0;  //�Ҥҷع���������
   $_salepri=0;  //�ҤҢ�����������
   $n=0;    //�Ѻ�ӹǹ record
////////////

      print "<table>";
      print " <tr>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>row</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҷع</th>";
print "  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ��</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>�ӹǹ�ط�Ԥ��</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>㹤�ѧ���</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>���ͧ���¤��</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��ͧ�������¨�ԧ</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��ѧ���¨�ԧ</th>";

      print "  <th bgcolor=6495ED><font face='Angsana New'>�ӹǹ�ط�Ԩ�ԧ</th>";
    
      print " </tr>";

        $query = "SELECT row_id,drugcode,tradname,unitpri,salepri,stock,mainstk,rxaccum,rxrate,
                            stkpmon FROM druglst_pt ";
        $result = mysql_query($query) or die("Query druglst failed");

    while(list($row_id,$drugcode,$tradname,$unitpri,$salepri,$stock,$mainstk,$rxaccum,$rxrate,
     $stkpmon) = mysql_fetch_row ($result)) {
		$n++; 
          $nRow_id=$row_id;
          $cDrugcode=$drugcode;
          $cTradname=$tradname;
          $nUnitpri = $unitpri;
          $nSalepri = $salepri;
          $nStock     = $stock;
          $nMainstk = $mainstk;
          $nRxacc = $rxaccum;         
          $nRate  = $rxrate;
          $nMonth = $stkpmon;

          $nTotalstk = $nStock+$nMainstk;  

   //$profit   =99;
   //$xUnitpri =99;
   //$xSalepri =99;

          if ($nTotalstk <> 0 and $nUnitpri <>0 and $nSalepri <> 0 ){
	$xUnitpri =$nUnitpri * $nTotalstk;  //�������Ҥҷع
	$xSalepri=$nSalepri * $nTotalstk; //�������ҤҢ��
	$_unitpri  = $_unitpri+$xUnitpri ;  //�������Ҥҷع
	$_salepri = $_salepri+$xSalepri; //�������ҤҢ��
                $profit=($nSalepri - $nUnitpri)*100/$nUnitpri;
   //   print "row_id $nRow_id  �Ҥҷع���= $_unitpri  �ҤҢ�����=  $_salepri<br>";
		}
          else {
	$xUnitpri =0;
	$xSalepri=0;
	$profit=0;
	}

// rate �������        
          if ($nRxacc > 0){
                     $nRate      = ($nRxacc/$days)*30;      //�ӹǹ������͹
                     $nMonth    = $nTotalstk/$nRate;           //��������������ա�����͹
	  	         }
          else {
	     $nRate   = 0;
	     $nMonth = 0;
	         }
// rate �������

        $quest ="UPDATE druglst SET  totalstk = $nMainstk+$nStock,
			          rxrate    = $nRate,
			          stkpmon= $nMonth
                       WHERE row_id='$nRow_id' ";
        $ans = mysql_query($quest) ;
if (mysql_errno()<>0){
	print "$nRow_id<br>";
print "Mainstk = $nMainstk<br>";
print "Stock = $nStock<br>";
print " totalstk = $nTotalstk<br>";
print "rxrate =  (Rxacc/days)*30 = $nRxacc/days*30 =  $nRate<br>";
print "stkpmon = Totalstk/Rate = $nTotalstk/$nRate = $nMonth<br>";

	}
//        echo mysql_errno() . ": " . mysql_error(). "\n";
//        echo "<br>";
//place after update
      $profit=number_format($profit,1);
      $nMonth=number_format($nMonth,1);
      $nRate=number_format($nRate,1);
//      print "�ѹ�֡���������º���� �Ƿ�� $nRow_id<br><br>";

         print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nRow_id</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cDrugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$cTradname</td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nUnitpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nSalepri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nTotalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nMainstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nStock</td>\n".
    
         "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
	    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
	    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".

           " </tr>\n");

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

