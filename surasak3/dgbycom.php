<?php
    print  "��Ǩ�ͺ���Ǫ�ѳ��㹤�ѧ�ҵ�� ������<br> ";
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

  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>
  <th bgcolor=6495ED><font face='Angsana New'>㹤�ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>��ͧ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����?��͹</th>

  <th bgcolor=6495ED><font face='Angsana New'>�дѺ1/2��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>�дѺ3��͹</th>
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

    $query = "SELECT drugcode,tradname,totalstk,mainstk,stock,rxrate,stkpmon,pack,packpri,comname FROM druglst  WHERE comcode = '$comcode' ";  
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
        print "<font face='Angsana New' size='5'>$comcode :$cComname <br>";
        print "<font face='Angsana New' size='2'>��/��͹ ����ѵ�ҡ�è��µ����͹ <br>";
        print "����� ? ��͹ ����ѧ���������������͹ (������ط��/�ѵ�ҡ�è��µ����͹)";

        $query = "SELECT drugcode,tradname,totalstk,mainstk,stock,rxrate,stkpmon,pack,packpri,comname FROM druglst  WHERE comcode = '$comcode' ";  
        $result = mysql_query($query) or die("Query failed");
        while (list ($drugcode,$tradname,$totalstk,$mainstk,$stock,
	$rxrate,$stkpmon,$pack,$packing
	) = mysql_fetch_row ($result)) {
            $n++;
            $halfmonth=$rxrate*.5;
            $trimonth    =$rxrate*3;
            print (" <tr>\n".
               "  <td bgcolor=6495ED>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".

               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkpmon</td>\n".

               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$halfmonth</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$trimonth</td>\n".
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


 