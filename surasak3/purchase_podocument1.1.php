<?php
    $yym=$thiyr.'-'.$rptmo;
    print "<b>���͡��á����觫��� ʻ.���ᾷ��  ��Ш���͹ $yym  </b>&nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< �����</a>&nbsp;&nbsp;&nbsp;<a target=_top  href='purchase_pomonth1.php'><< ����͡��͹</a><br>";
    print "��ԡ--> ��� �� ���觫��ͪ��Ǥ���-->��͡������� PO<br>";
    print "��ԡ--> �ѹ������觫��ͪ��Ǥ���---->������ PO ���Ǥ���<br>";
    print "��ԡ--> ��¡�� ------------------->�٨ӹǹ��¡�÷����觫���<br>";
    print "��ԡ--> �ѹ������觫��ͨ�ԧ -------->������ PO ��ԧ<br>";
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 19px;
}
-->
</style>
<table>
 <tr>
  <th bgcolor=FF9999>#</th>
  <th bgcolor=FF9999>�ѹ������</th>
  <th bgcolor=FF9999>��� �� ���觫��ͪ��Ǥ���</th>

    <th bgcolor=FF9999>�ѹ������觫��ͪ��Ǥ���(ʻ.)<br />
���VAT��ѧ</th>

 <th bgcolor=FF9999>�ѹ������觫��ͪ��Ǥ���(ʻ.)<br />
���VAT��͹</th> 
    <th bgcolor=FF9999>���ʺ���ѷ</th>
  <th bgcolor=FF9999>����ѷ������ҧ�����ǹ�ӡѴ</th>
  <th bgcolor=FF9999>��¡��</th>
  <th bgcolor=FF9999>�Ҥ�������vat</th>
  <th bgcolor=FF9999>�ѹ����˹��觢ͧ</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");
    $nNetprice=0;
	//$query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id FROM pocompany WHERE date LIKE '$yym%' AND prepono !='¡��ԡ' ORDER BY date ";
    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id FROM pocompany WHERE date LIKE '$yym%' AND prepono !='¡��ԡ' AND potype='pc' ORDER BY date ";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
    $nNetprice=0;
    while (list ($date,$prepono,$prepodate,$comcode,$comname,$items,$netprice,$pono,$podate,$bounddate,$row_id ) = mysql_fetch_row 	($result)) {
	$num++;
                $nNetprice= $nNetprice+$netprice;
        print (" <tr>\n".
           "  <td BGCOLOR=FFCCCC>$num</td>\n".
           "  <td BGCOLOR=FFCCCC><a target=_BLANK  href=\"purchase_prepofill.php?nRow_id=$row_id\">$date</a></td>\n".
           "  <td BGCOLOR=FFCCCC><a target=_BLANK  href=\"purchase_prepofill.php?nRow_id=$row_id\">$prepono</a></td>\n".

          "  <td BGCOLOR=FFCCCC><a href='purchase_prepoprn_new.php?nRow_id=$row_id' target='_blank'>$prepodate</a></td>\n".
          "  <td BGCOLOR=FFCCCC><a href='purchase_prepoprn.1_new.php?nRow_id=$row_id' target='_blank'>$prepodate</a></td>\n".
		  "  <td BGCOLOR=FFCCCC><a target=_BLANK  href=\"purchase_podocumentselect.php? 	nRow_id=$row_id\">$comcode</a></td>\n".
           "  <td BGCOLOR=FFCCCC>$comname</td>\n".
           "  <td BGCOLOR=FFCCCC><a target=_BLANK  href=\"purchase_podgitem.php? 	nRow_id=$row_id&cComname=$comname&sNetpri=$netprice\">$items</a></td>\n".
           "  <td BGCOLOR=FFCCCC>$netprice</td>\n".
           "  <td BGCOLOR=FFCCCC>$pono</td>\n".
    
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "<b>�����Ť����觫��� ʻ.���ᾷ�� ������  $nNetprice �ҷ</b>&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='purchase_officers.php'>��駤�Ң����š�����õ�Ǩ�Ѻ��ʴ�</a><br>";

?>
</table>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a>


