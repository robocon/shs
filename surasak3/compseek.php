<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
	session_register('ponumber');
	$_SESSION['ponumber'] = $_POST['ponum'];
    print  "��Ǩ�ͺ���Ǫ�ѳ��㹤�ѧ�ͧ����ѷ ���͡����觫���<a target=_parent  href='../nindex.htm'><<�����</a> ";
    print  "<a target=_parent  href='dgorder.php'><<��觫���������</a> ";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ҧ�дѺ</th>
  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>
  <th bgcolor=6495ED><font face='Angsana New'>㹤�ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>��ͧ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����?��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>˹��¹Ѻ</th>
  <th bgcolor=6495ED><font face='Angsana New'>��Ҵ��è�</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�(+vat)/pack</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�(������vat)</th>
    <th bgcolor=6495ED><font face='Angsana New'>spec</th>
 </tr>

<?php
  $n=0;
If (!empty($comcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,minimum,totalstk,mainstk,stock,rxrate,stkpmon,packing,pack,packpri_vat,packpri,comname,row_id,snspec,spec FROM druglst  WHERE comcode = '$comcode' "; 
	 
    $result = mysql_query($query) or die("Query failed");
	 for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	       }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }
        $cComname  =$row->comname;
        $cComcode   =$comcode;

    if(mysql_num_rows($result)){
	
	$query = "SELECT startday FROM runno WHERE title = 'RXAC'";
	list($dStartday) = mysql_fetch_row(mysql_query($query));

	$date2=date("Y-m-d H:i:s");  //�ѹ���ӹǳ 
	$s = strtotime($date2)-strtotime($dStartday);

	//echo strtotime($date2)," - ",strtotime($dStartday)," + ",$s,"<BR>";
	//   echo "�ӹǹ�Թҷ� $s<br>";  //seconds
	$d = intval($s/86400);   //day

	$s -= $d*86400;
	$h  = intval($s/3600);    //hour
	//   echo "�ӹǹ�ѹ  $d �ѹ $h �������<br>";

	$days= $d;
	if ($h>12){
		$days=$d+1;
	}  

        print "<font face='Angsana New' size='5'>$comcode :$cComname &nbsp;&nbsp;&nbsp;<u>�Ţ������觫��� ".$_SESSION['ponumber']."</u><br>";
        print "<font face='Angsana New' size='2'>��/��͹ ����ѵ�ҡ�è��µ����͹ <br>";
        print "����� ? ��͹ ����ѧ���������������͹ (������ط��/�ѵ�ҡ�è��µ����͹)";

        $query = "SELECT drugcode,tradname,minimum,totalstk,mainstk,stock,rxrate,stkpmon,packing,pack,packpri_vat,packpri,row_id,snspec,spec,rxaccum FROM druglst  WHERE comcode = '$comcode' ";  
        $result = mysql_query($query) or die("Query failed");
        while (list ($drugcode,$tradname,$minimum,$totalstk,$mainstk,$stock,
	$rxrate,$stkpmon,$packing,$pack,$packpri_vat,$packpri,$row_id,$snspec,$spec,$rxaccum
	) = mysql_fetch_row ($result)) {
if($snspec!=''){$snspec1='('.$snspec.')';}
else{$snspec1=$snspec;};

$nRxacc = $rxaccum;   
//echo $nRxacc," ",$days;
//exit();
	if ($nRxacc > 0 && $days > 0){
		$nRate      = ($nRxacc/$days)*30;      //�ӹǹ������͹
		$nMonth    = $totalstk/$nRate;           //��������������ա�����͹
		
		$nRate = number_format($nRate,0);
		$nMonth = number_format($nMonth,1);

	}else {
		$nRate   = 0;
		$nMonth = 0;
	}

            $n++;
            print (" <tr>\n".
               "  <td bgcolor=6495ED>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"podgamt.php? Dgcode=$drugcode&Trade=".urlencode($tradname)." & Packing=$packing & Pack=$pack & Minimum=$minimum & Totalstk=$totalstk &Packpri_vat=$packpri_vat & Packpri=$packpri&Spec=$spec&Snspec=$snspec\"><font face='Angsana New'>$tradname $snspec1</a></td>\n".
				     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$minimum</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nRate</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nMonth</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packing</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$pack</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri_vat</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri</td>\n".
				     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$spec</td>\n".
               " </tr>\n");
               }
	}
    else {
           die("��辺���� $comcode ");
           }

   include("unconnect.inc");
          }
?>

</table>


 
