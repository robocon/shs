<?php
    print  "��Ǩ�ͺ���Ǫ�ѳ��㹤�ѧ���˭����ըӹǹ = 0  <br> ";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҷع</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ� ED</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>����(%)</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ҧ�дѺ</th>
  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>
  <th bgcolor=CD853F><font face='Angsana New'>㹤�ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>��ͧ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����?��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>packing</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�/pack</th>
 </tr>

<?php
    include("connect.inc");
    //runno  to find date established
    $query = "SELECT title,startday FROM runno WHERE title = 'RX1D'";
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

    $query = "SELECT drugcode,tradname,unitpri,edpri,salepri,minimum,totalstk,mainstk,stock,rxrate,stkpmon,pack,packpri,comname FROM druglst  WHERE mainstk = 0 order by drugcode ";  
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
        $cComname=$row->comname;
        $n=0;
//        print "<font face='Angsana New' size='5'>$comcode :$cComname <br>";
//        print "<font face='Angsana New' size='2'>��������������Ѻ����� $dStartday (��ҵ�ͧ��õ�駤�� 0 价������ set 0 ��è�����)<br>";
        print "<font face='Angsana New' size='2'>��/��͹ ����ѵ�ҡ�è��µ����͹ <br>";
        print "����� ? ��͹ ����ѧ���������������͹ (������ط��/�ѵ�ҡ�è��µ����͹)";
        while (list ($drugcode,$tradname,$unitpri,$edpri,$salepri,$minimum,$totalstk,$mainstk,$stock,
	$rxrate,$stkpmon,$pack,$packing
	) = mysql_fetch_row ($result)) {
            $n++;
        if($unitpri>0){
            $profit=($salepri - $unitpri)*100/$unitpri;
            $profit=number_format($profit,1);
		}
            print (" <tr>\n".
               "  <td bgcolor=6495ED><font face='Angsana New'>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$edpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$profit</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$minimum</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$mainstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkpmon</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$pack</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packing</td>\n".
               " </tr>\n");
               }
	}
    else {
           die("��辺�ҷ���ըӹǹ =0 㹤�ѧ���˭� ");
           }

   include("unconnect.inc");
?>

</table>


 