<?php
    session_start();
    session_unregister("sPtname");
    session_unregister("cTrad");
    session_unregister("cAmt");
    session_unregister("sPharow");
    session_register("dDate");

    $sPtname = '';
    $sPharow = $nRow_id;
    $dDate=$sDate;
    session_register("sPtname");
    session_register("sPharow");
    session_register("dDate");

    $dDate=$sDate;
    include("connect.inc");
  
    $query = "SELECT * FROM phardep WHERE row_id = '$nRow_id' "; 
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
    $sHn=$row->hn;
    $sAn=$row->an;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
    $sEssd=$row->essd;
    $sNessdy=$row->nessdy;
    $sNessdn=$row->nessdn;
    $sDPY=$row->dpy;
    $sDPN=$row->dpn;     
    $sNetprice=$row->price;
    $sDiag=$row->diag;
    $cPaid=$sNetprice;

   
	echo "<A HREF=\"../nindex.htm\">&lt;&lt;�����</A>";
	 print "<CENTER>Ẻ ��¡��ԡ�����ŷ��ѹ�֡���������������� <br>�ç��Һ�Ť�������ѡ�������� �ӻҧ</CENTER><br>";
?>

<?php
    $query = "SELECT drugcode,tradname,amount,price,slcode,row_id,part, statcon FROM drugrx WHERE idno = '$sPharow' AND date = '".$_GET["sDate"]."'";
    $result = mysql_query($query)
        or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);

?>
</table>
<?php
 print "�ͧ���Ѫ���� �ͷӡ��¡��ԡ�����ż����� HN: &nbsp;$sHn <BR>";
    print "����&nbsp;$sPtname,  ";
    print "�ä: $sDiag&nbsp;&nbsp;";
	 
    print "ᾷ�� :$sDoctor<br>";
   

?>
<CENTER>
<table >
<?php
$i=1;
    while (list ($drugcode,$tradname,$amount,$price,$slcode,$row_id,$part, $statcon) = mysql_fetch_row ($result)) {
        print (" <tr height=\"30\">\n".
			"<td BGCOLOR=F5DEB3>$tradname</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$amount</span>".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           "  <td BGCOLOR=F5DEB3>$slcode</td>\n".
			     "  <td BGCOLOR=F5DEB3>$part</td>\n".
           " </tr>\n");

		 

$i++;
      }

    include("unconnect.inc");
?>
</table></CENTER>
</FORM>
<?php

 print "�繨ӹǹ�Թ  $sNetprice �ҷ&nbsp; ���ͧ�ҡ..................................................<br>";
 print "..............................................<BR>";
  print "���ӡ��¡��ԡ<br>";
   print "���˹�ҷ����ǹ���Թ ¡��ԡ������Ѻ�Թ�Ţ��� .........................";
 ?>


