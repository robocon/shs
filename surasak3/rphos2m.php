<?php
$yym = $_POST['thiyr'].'-'.$_POST['rptmo'];
$yym_end = $_POST['thiyr_end'].'-'.$_POST['rptmo_end'];

$txt_more = '';
if( $yym_end != $yym ){
    $txt_more = '�֧��͹ '.$yym_end;
}

    // $yym=$thiyr.'-'.$rptmo;
    // $yym1=$thiyr.'/'.$rptmo;
    
    ?>
    <div>
        <a target=_top  href='../nindex.htm'>&lt;&lt; �����</a> | <a target=_top  href='hos2m.php'>&lt;&lt; ��Ѻ����͡��͹</a> | <a href="rphos2m_2.php">��§ҹ�ʹ��������ǧ����</a>
    </div>
    <?php

    print "<font face='Angsana New'><b>��ش����ѹ����������Ǫ�ѳ��(�.�.2)  ��͹ $yym $txt_more (���§����ѹ����Ѻ�ͧ)</b><br>";
	print "<a href='rphos2m_print.php?yym=$yym'>�������ش����ѹ����</a>";
	
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ӴѺ��ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>���觫���</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ����Ѻ�ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ�����觢ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ţ�����觢ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����ѷ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>��¡�ë���</th>
  <th bgcolor=6495ED><font face='Angsana New'>LotNo</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ӹǹ</th>
  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�/˹���</th>
  <th bgcolor=6495ED><font face='Angsana New'>����Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�.�.5</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");
//or billdate LIKE '$yym1%'

    $date_more = "date LIKE '$yym%'";
    if( $yym_end != $yym ){
        $date_more = " ( date >= '$yym-01' AND date <= '$yym_end-31') ";
    }

    $query = "SELECT stkno,docno,getdate,date,billno,comname,drugcode,tradname,lotno,packamt,packing,packpri,price,stkbak,packamt 
    FROM combill 
    WHERE $date_more 
    AND drugcode like '".$_POST["drugcode"]."%' ORDER BY getdate";

    $result = mysql_query($query) or die("Query failed");
    $num=0;
   $netprice=0;
   
  // echo $query;

    while (list ($stkno,$docno,$getdate,$billdate,$billno,$comname,$drugcode,$tradname,$lotno,$packamt,$packing,$packpri,$price,$stkbak,$packamt) = mysql_fetch_row ($result)) {
	$num++;
        $netprice = $netprice+$price;

/*
          if ($packamt > 0){
 	$npack  =$stkbak/$packamt;
	  	     }
          else {
	$npack  ='';
	  }
*/
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$docno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$lotno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packamt</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packing</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"rphos5dg.php? Dgcode=$drugcode\">�.�.5</a></td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "<br>�����Ť�ҫ���������Ǫ�ѳ�������  $netprice �ҷ";
?>

</table>
