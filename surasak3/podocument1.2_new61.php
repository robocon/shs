<?php
    $yym=$thiyr.'-'.$rptmo;
    print "<font face='Angsana New'><b>���͡��á����觫���������Ǫ�ѳ��  ��Ш���͹ $yym  </b>&nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< �����</a>&nbsp;&nbsp;&nbsp;<a target=_top  href='pomonth2_new61.php'><< ����͡��͹</a><br>";
    print "��ԡ--> ��� �� ���觫��ͪ��Ǥ���-->��͡������� PO<br>";
    print "��ԡ--> �ѹ������觫��ͪ��Ǥ���---->������ PO ���Ǥ���<br>";
    print "��ԡ--> ��¡�� ------------------->�٨ӹǹ��¡�÷����觫���<br>";
    print "��ԡ--> �ѹ������觫��ͨ�ԧ -------->������ PO ��ԧ<br>";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ������</th>

    <th bgcolor=6495ED><font face='Angsana New'>���ʺ���ѷ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����ѷ������ҧ�����ǹ�ӡѴ</th>
  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�������vat</th>
  <th bgcolor=6495ED><font face='Angsana New'>��� �� ���觫��ͨ�ԧ </th>
   <th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͨ�ԧ(��) ���VAT��ѧ</th>
   
   <th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͨ�ԧ(��) ���VAT��͹ </th>
   
   <th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͨ�ԧ(��) ���������</th>
   
   <th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͨ�ԧ(��)���Դ����</th>
   

<th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͨ�ԧ(�Ǫ�ѳ��) �����ѧ</th>
<th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͨ�ԧ(�Ǫ�ѳ��) �����͹</th>
<th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͨ�ԧ(�Ǫ�ѳ��)���������</th>
<th bgcolor=6495ED><font face='Angsana New'>�ѹ������觫��ͨ�ԧ(�Ǫ�ѳ��)���Դ����</th>

  <th bgcolor=6495ED><font face='Angsana New'>�ѹ����˹��觢ͧ</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");
    $nNetprice=0;
    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id ,ponoyear FROM pocompany WHERE date LIKE '$yym%' AND prepono !='¡��ԡ' ORDER BY date ";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
    $nNetprice=0;
    while (list ($date,$prepono,$prepodate,$comcode,$comname,$items,$netprice,$pono,$podate,$bounddate,$row_id,$ponoyear) = mysql_fetch_row 	($result)) {
	$num++;
                $nNetprice= $nNetprice+$netprice;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$date</td>\n".
      //    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$prepono</a></td>\n".
        
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"podgitem.php? 	nRow_id=$row_id&cComname=$comname&sNetpri=$netprice\">$items</a></td>\n".
           "  <td align='right' BGCOLOR=66CDAA><font face='Angsana New'>".number_format($netprice,2)."</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$pono$ponoyear</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn_new61.php?nRow_id=$row_id\">��ѧ</a></td>\n".
 
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn.1_new61.php?nRow_id=$row_id\">��͹</a></td>\n".
 
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn.2_new61.php?nRow_id=$row_id\">���������</a></td>\n".
 
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn.3_new61.php?nRow_id=$row_id\">���Դ����</a></td>\n".
 

 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1_new61.php?nRow_id=$row_id\">��ѧ</a></td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1.1_new61.php?nRow_id=$row_id\">��͹</a></td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1.2_new61.php?nRow_id=$row_id\">���������</a></td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1.3_new61.php?nRow_id=$row_id\">���Դ����</a></td>\n".
         
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bounddate</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "<b>�����Ť����觫���������Ǫ�ѳ�������  ".number_format($nNetprice,2)." �ҷ</b>&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='officers.php'>������õ�Ǩ�Ѻ��ʴ�</a><br>";

?>
</table>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a>


