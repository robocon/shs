<?php
    $yym=$thiyr.'-'.$rptmo;
    print "<font face='Angsana New'><b>���͡��á����觫���������Ǫ�ѳ��  ��Ш���͹ $yym  </b>&nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< �����</a>&nbsp;&nbsp;&nbsp;<a target=_top  href='pomonth.php'><< ����͡��͹</a><br>";
    print "��ԡ--> ��� �� ���觫��ͪ��Ǥ���-->��͡������� PO<br>";
    print "��ԡ--> �ѹ������觫��ͪ��Ǥ���---->������ PO ���Ǥ���<br>";
    print "��ԡ--> ��¡�� ------------------->�٨ӹǹ��¡�÷����觫���<br>";
    print "��ԡ--> �ѹ������觫��ͨ�ԧ -------->������ PO ��ԧ<br>";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ������</th>
  <th bgcolor=6495ED><font face='Angsana New'>��� �� ���觫��ͪ��Ǥ���</th>

    <th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͪ��Ǥ���(��)���VAT��ѧ</th>

 <th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͪ��Ǥ���(��)���VAT��͹</th>




 <th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͪ��Ǥ���(�Ǫ�ѳ�� )���VAT��ѧ</th>
 <th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͪ��Ǥ���(�Ǫ�ѳ�� )���VAT��͹</th>
 
    <th bgcolor=6495ED><font face='Angsana New'>���ʺ���ѷ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����ѷ������ҧ�����ǹ�ӡѴ</th>
  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�������vat</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ����˹��觢ͧ</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");
    $nNetprice=0;
    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id FROM pocompany WHERE date LIKE '$yym%' AND prepono !='¡��ԡ' ORDER BY date ";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
    $nNetprice=0;
    while (list ($date,$prepono,$prepodate,$comcode,$comname,$items,$netprice,$pono,$podate,$bounddate,$row_id ) = mysql_fetch_row 	($result)) {
	$num++;
                $nNetprice= $nNetprice+$netprice;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php?nRow_id=$row_id\">$date</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php?nRow_id=$row_id\">$prepono</a></td>\n".

          "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepoprn.php?nRow_id=$row_id\">$prepodate</a> <a href='prepoprn_new.php?nRow_id=$row_id' target='_blank'>(Ẻ����)</a></td>\n".
          "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepoprn.1.php?nRow_id=$row_id\">$prepodate</a> <a href='prepoprn.1_new.php?nRow_id=$row_id' target='_blank'>(Ẻ����)</a></td>\n".
          "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepoprn1.php?nRow_id=$row_id\">$prepodate</a> <a href='prepoprn1_new.php?nRow_id=$row_id' target='_blank'>(Ẻ����)</a></td>\n".
          "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepoprn1.1.php?nRow_id=$row_id\">$prepodate</a> <a href='prepoprn1.1_new.php?nRow_id=$row_id' target='_blank'>(Ẻ����)</a></td>\n".
  
"  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"podocumentselect.php? 	nRow_id=$row_id\">$comcode</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"podgitem.php? 	nRow_id=$row_id&cComname=$comname&sNetpri=$netprice\">$items</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$netprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$pono</td>\n".
    
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "<b>�����Ť����觫���������Ǫ�ѳ�������  $nNetprice �ҷ</b>&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='officers.php'>������õ�Ǩ�Ѻ��ʴ�</a><br>";

?>
</table>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a>


