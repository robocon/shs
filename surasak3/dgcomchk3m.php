<?php
    print"��Ǩ�ͺ���Ǫ�ѳ��ͧ���к���ѷ㹤�ѧ�ͧ�ç��Һ��<br> ";
	print"ź���? ���ź�͡�ҡ�ѭ�����Ǫ�ѳ��ͧ�ç��Һ��<br>";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="comcode.php">���ʺ���ѷ ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="comcode" size="10"></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ��ŧ     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a></font></p>
</form>
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
  <th bgcolor=6495ED><font face='Angsana New'>㹤�ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>��ͧ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>���������</th>  
  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����?��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>packing</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�/pack</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�+vat/pack</th>
  <th bgcolor=CD853F><font face='Angsana New'>ź���?</th>
 </tr>

<?php
  $n=0;
If (!empty($comcode)){
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

$date=date('Y-m-d');
$lastmonth=date('Y-m-d', strtotime("-3 month"));
//echo $lastmonth;

    $query = "SELECT drugcode,tradname,unitpri,edpri,salepri,minimum,totalstk,mainstk,stock,rxrate,stkpmon,pack,packpri,comname,row_id FROM druglst  WHERE comcode = '$comcode' ";  
    $result = mysql_query($query) or die("Query failed");
	 for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	       }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }
        $cComname=$row->comname;
    if(mysql_num_rows($result)){
//        $cComname=$row->comname;
        print "<font face='Angsana New' size='5'>$comcode :$cComname <br>";
//        print "<font face='Angsana New' size='2'>��������������Ѻ����� $dStartday (��ҵ�ͧ��õ�駤�� 0 价������ set 0 ��è�����)<br>";
        print "<font face='Angsana New' size='2'>��/��͹ ����ѵ�ҡ�è��µ����͹ <br>";
        print "����� ? ��͹ ����ѧ���������������͹ (������ط��/�ѵ�ҡ�è��µ����͹)";

        $query = "SELECT drugcode,tradname,unitpri,edpri,salepri,minimum,totalstk,mainstk,stock,rxrate,stkpmon,
		pack,packpri,packpri_vat,row_id,comname FROM druglst  WHERE comcode = '$comcode' ";  
        $result = mysql_query($query) or die("Query failed");
        while (list ($drugcode,$tradname,$unitpri,$edpri,$salepri,$minimum,$totalstk,$mainstk,$stock,
	$rxrate,$stkpmon,$pack,$packpri,$packpri_vat,$row_id
	) = mysql_fetch_row ($result)) {
            $n++;
            $profit=($salepri - $unitpri)*100/$unitpri;
            $profit=number_format($profit,1);


		$sql1="select sum(stkcut) as amount from stktranx where drugcode ='$drugcode' and getdate between '$lastmonth' and '$date' ";
		//echo $sql1;
		$query1=mysql_query($sql1);
		list($amount)=mysql_fetch_array($query1);
		
		$rxrate3m=$amount/3;
		
            print (" <tr>\n".
               "  <td bgcolor=6495ED>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$edpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$profit</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$minimum</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
			   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>".(number_format($rxrate3m,2))."</td>\n".  //��/��͹
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkpmon</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$pack</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri_vat</td>\n".
               "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"dgdele.php? Delrow=$row_id&Dgcode=$drugcode&Dgtrad=$tradname\">ź</td>\n".
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


 