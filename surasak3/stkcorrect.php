<?php
  include("connect.inc");
   print "<a href='../nindex.htm'><font face='Angsana New'><< �����</a><br>";
   print "- �ӹǹ�Ҩӹǹ�ط�����Ǫ�ѳ�� (㹤�ѧ + ���ͧ����)<br>";
   print "- �ӹǹ�ҡ��âͧ���Ǫ�ѳ�����е�� <br>";
   print "- �ӹǹ����Ť�����(�Ҥҷع)�ͧ���Ǫ�ѳ������� <br>";
   print "- �ӹǹ����Ť�����(�ҤҢ��)�ͧ���Ǫ�ѳ������� <br>";
   print "- �ӹǹ�ҡ�������¢ͧ���Ǫ�ѳ������� <br>";
   print "- �ӹǹ���ѵ�ҡ��������͹(��/��͹) <br>";
   print "- �ӹǹ�Ҩӹǹ��͹���������Ҿ���(�����?��͹) <br>";
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
print "�ѹ���������Ѻ�Ҩ������� $dStartday �֧�Ѩ�غѹ�ӹǳ�� $days �ѹ<br>";   
/*  
   $query="SELECT row_id FROM druglst";
   $result = mysql_query($query);
   $xRec = mysql_num_rows($result);
   print "�ӹǹ records $xRec<br>";
*/
   $_unitpri=0;  //�Ҥҷع���������
   $_salepri=0;  //�ҤҢ�����������
   $_salepri1=0;  //�ҤҢ�����������
   $n=0;    //�Ѻ�ӹǹ record
     $n1=0;    //�Ѻ�ӹǹ record
////////////

$part["DDL"] = "��㹺ѭ������ѡ��觪ҵ�";
$part["DDY"] = "�ҹ͡�ѭ������ѡ��觪ҵ� ���ԡ��";
$part["DDN"] = "�ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����";
$part["DSY"] = "�Ǫ�ѳ���ԡ��";
$part["DSN"] = "�Ǫ�ѳ���ԡ�����";
$part["DPY"] = "�ػ�ó��ԡ��";
$part["DPN"] = "�ػ�ó��ԡ�����";

      print "<table>";

        $query = "SELECT row_id,drugcode,tradname,unitpri,salepri,stock,mainstk,rxaccum,rxrate,
                            stkpmon, part, bcode,code24,tmt,comcode,comname,unit,pack,packpri_vat, edpri FROM druglst ORDER by part ";
        $result = mysql_query($query) or die("Query druglst failed");

    while(list($row_id,$drugcode,$tradname,$unitpri,$salepri,$stock,$mainstk,$rxaccum,$rxrate,
     $stkpmon,$part,$bcode,$code24,$tmt,$comcode,$comname,$unit,$pack,$packpri_vat, $edpri) = mysql_fetch_row ($result)) {
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
		  $cPart = $part;

          $nTotalstk = $nStock+$nMainstk;  

   //$profit   =99;
   //$xUnitpri =99;
   //$xSalepri =99;


     if($n==500){    print " <tr>";
     
}
	
	if($n % 500 == 0 || $n==1 || $n==100){   
	print " <tr>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>row</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>������</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>�ӹǹ�ط��</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>㹤�ѧ</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>���ͧ����</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҡ�ҧ</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҷع</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ��</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>���� %</th>";
//   print "  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ�µ�� ú.</th>";
//   print "  <th bgcolor=6495ED><font face='Angsana New'>���� % ��� ú.</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>��Ť��(�Ҥҷع)</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��Ť��(�ҤҢ��)</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��������</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>�����?��͹</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>�����(part)</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>������úѭ</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>����24</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>TMT</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>���ʺ���ѷ</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>����ѷ</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>packing</th>";
	  print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�/ᾡ</th>";
	  
      print " </tr>";
}
    
  if ($nUnitpri<=0.2){
  $nSalepri1=0.5;}
else if($nUnitpri<=0.5){
  $nSalepri1=1;}
else if($nUnitpri<=1){
  $nSalepri1=1.5;}
else if($nUnitpri<=5){
  $nSalepri1=1.5+1.25*($nUnitpri-1);}
else if($nUnitpri<=10){
  $nSalepri1=6.05+1.2*($nUnitpri-5);}
else if($nUnitpri<=50){
  $nSalepri1=12.5+1.18*($nUnitpri-10);}
else if($nUnitpri<=100){
  $nSalepri1=60+1.16*($nUnitpri-50);}
else if($nUnitpri<=500){
  $nSalepri1=118+1.14*($nUnitpri-100);}
else if($nUnitpri<=1000){
  $nSalepri1=574+1.12*($nUnitpri-500);}
else if($nUnitpri<=5000){
  $nSalepri1=1134+1.10*($nUnitpri-1000);}
else if($nUnitpri<=10000){
  $nSalepri1=5534+1.08*($nUnitpri-5000);}
else {$nSalepri1=10934+1.06*($nUnitpri-10000);
}


          if ($nTotalstk <> 0 and $nUnitpri <>0 and $nSalepri <> 0 ){
	$xUnitpri =$nUnitpri * $nTotalstk;  //�������Ҥҷع
	$xSalepri=$nSalepri * $nTotalstk; //�������ҤҢ��
	$xSalepri1=$nSalepri1* $nTotalstk; //�������ҤҢ�µ������º
	$_unitpri  = $_unitpri+$xUnitpri ;  //�������Ҥҷع
	$_salepri = $_salepri+$xSalepri; //�������ҤҢ��
	$_salepri1 = $_salepri1+$xSalepri1; //�������ҤҢ�µ������º
                $profit=($nSalepri - $nUnitpri)*100/$nUnitpri;
                $profit1=($nSalepri1 - $nUnitpri)*100/$nUnitpri;
      //print "row_id $nRow_id  �Ҥҷع���= $_unitpri  �ҤҢ�����=  $_salepri****";
   // print "row_id $nRow_id  �Ҥҷع���= $_unitpri  �ҤҢ�����=  $_salepri1<br>";
		}
          else {
	$xUnitpri =0;
	$xSalepri=0;
	$profit=0;
	$xSalepri1=0;
	$profit1=0;
	}

// rate �������        

          if ($nRxacc > 0 && $days > 0){
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
					   
        //$ans = mysql_query($quest) ;
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
 $nSalepri1=number_format( $nSalepri1,2);
 //$nSalepri01=round( $nSalepri1,0);
      $profit1=number_format($profit1,1);
      $nMonth=number_format($nMonth,1);
      $nRate=number_format($nRate,1);
//      print "�ѹ�֡���������º���� �Ƿ�� $nRow_id<br><br>";
		
		if($n %2 ==0){
			$bgcolor = "#66CDAA";
		}else{
			$bgcolor = "#FF9B9B";
		}

         print (" <tr>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$nRow_id</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$cDrugcode</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$cTradname</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$nTotalstk</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$nMainstk</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$nStock</td>\n".
		   "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$edpri</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$nUnitpri</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$nSalepri</td>\n".
     "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$profit</td>\n".
  //    "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$nSalepri1</td>\n".
 //   "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$profit1</td>\n".
      
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$xUnitpri</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$xSalepri</td>\n".

           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$nRxacc</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$nRate</td>\n".
           "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$nMonth</td>\n".
		   "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$cPart</td>\n".
		   "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$bcode</td>\n".
		   "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$code24</td>\n".
		   "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$tmt</td>\n".
		    "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$comcode</td>\n".
		 "  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$comname</td>\n".
			"  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$unit</td>\n".
			"  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$pack</td>\n".
			"  <td BGCOLOR=\"".$bgcolor."\"><font face='Angsana New'>$packpri_vat</td>\n".
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

$netprofit1 = $_salepri1-$_unitpri;

print "******************************************<br>";


print "<br><a href='../nindex.htm'><< �����</a><br>";

include("unconnect.inc");
?>

