<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security
//oprxitem.php
  session_unregister("dDate1");  
    session_unregister("dDate");  
session_unregister("poid");  
    session_unregister("sHn");   
    session_unregister("sAn");
    session_unregister("sPtright");
    session_unregister("sPtname");
    session_unregister("sDoctor");
    session_unregister("sEssd");
    session_unregister("sNessdy");
    session_unregister("sNessdn");
    session_unregister("sDPY");
    session_unregister("sDPN");
    session_unregister("sDSY");
    session_unregister("sDSN");
    session_unregister("sNetprice");
    session_unregister("sDiag"); 
    session_unregister("sAccno"); 
    session_unregister("sRow_id"); 
    session_unregister("sRow"); 
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("aMoney"); 
session_unregister("$sChktranx"); 
session_unregister("$Time1"); 

//   
    $dDate=$sDate;
    $dDate1="";
$poid="";
    $sHn="";
    $sAn="";
    $sPtright="";
    $sPtname="";
    $sDoctor="";
    $sEssd="";
    $sNessdy="";
    $sNessdn="";
    $sNetprice="";
    $sDPY="";
    $sDPN="";  
  
    $sDSY="";
    $sDSN="";    
$Time1="";
    $sDiag="";
$sChktranx="";
    $sRow_id=$nRow_id;
    $sAccno=$nAccno;

    $x=0;
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aPrice  = array("                          �ҤҢ��  ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aSlipcode = array("        �Ը���   ");
    $aMoney= array("       ����Թ   ");
    $sRow=array("row_id of ipacc");
 

    session_register("dDate");  
 session_register("dDate1"); 
 session_register("poid");   
    session_register("sHn");   
    session_register("sAn");
    session_register("sPtright");
    session_register("sPtname");
    session_register("sDoctor");
    session_register("sEssd");
    session_register("sNessdy");
    session_register("sNessdn");
    session_register("sDPY");
    session_register("sDPN");
    session_register("sDSY");
    session_register("sDSN");
    session_register("sNetprice");
    session_register("sDiag"); 
    session_register("sAccno"); 
    session_register("sRow_id"); 
    session_register("sRow"); 

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aSlipcode");
    session_register("aMoney");
       session_register("$sChktranx");
   session_register("$Time1");

    include("connect.inc");
  $dDate1= $Thaidate=date("dm").(date("Y")+543);
  $Thaidate1=date("dm").(date("Y"));
   $Time1=date("Gis");
  
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
    $sPtright=$row->ptright;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
    $sEssd=$row->essd;
    $sNessdy=$row->nessdy;
    $sNessdn=$row->nessdn;
    $sDPY=$row->dpy;
    $sDPN=$row->dpn;     
    $sDSY=$row->dsy;
    $sDSN=$row->dsn;     
    $sNetprice=$row->price;
    $sDiag=$row->diag;
  $sChktranx=$row->chktranx;
 
?>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>��¡��</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ</th>
  <th bgcolor=CD853F><font face='Angsana New'>�Ҥ�</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ԡ��?</th>
 </tr>
<?php
    $query = "SELECT tradname,amount,price,part FROM drugrx WHERE idno = '$nRow_id' ";
    $result = mysql_query($query)
        or die("Query failed");
  print "�����¡�ü����¤�����Ǫ�ѳ��<br>";
    print "<font face='Angsana New'>$sPtname<br> ";
    $ptright=substr($sPtright,4);
    $doctor=substr($sDoctor,5);
$poid="$Thaidate1$sChktranx";
    print "HN: $sHn, �Է���:$ptright<br>";
    print "�ä: $sDiag, ᾷ�� :$doctor<br>";

    while (list ($tradname,$amount, $price,$part) = mysql_fetch_row ($result)) {
//        array_push($aPrice,$price);
//        $x++;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
      }

    if (empty($sAn) && $sNetprice > 0){
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>(55020/55021)��Һ�ԡ�ü����¹͡</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>1</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>50.00</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>�ԡ��</td>\n".
           " </tr>\n");
                           }
//�óդ׹�� �еԴź
    if (empty($sAn) && $sNetprice < 0){
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>(55020/55021)��Һ�ԡ�ü����¹͡</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>-1</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>-50.00</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>�ԡ��</td>\n".
           " </tr>\n");
                           }
    include("unconnect.inc");
?>
</table>
<?php

    $pay=$sNessdn+$sDPN+$sDSY+$sDSN;

//  OPD CASE
    if (empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice+50;
           $cPaid=$sNetprice+50; //opd case �� 50 �ҷ
           $free=$sEssd+$sNessdy+$sDPY+'50';
                            }

    if (empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice-50;
           $cPaid=$sNetprice-50; //opd case �׹��,  �׹�Թ 50 �ҷ
           $free=$sEssd+$sNessdy+$sDPY-'50';
                            }
//  IPD CASE
    if (!empty($sAn) && $sNetprice > 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }
//ipd case �׹��
    if (!empty($sAn) && $sNetprice < 0){
           $xNetpri=$sNetprice;
           $cPaid=$sNetprice;
           $free=$sEssd+$sNessdy+$sDPY+$sDSY+$sDSN;
      $pay=$sNessdn+$sDPN;
                            }

    $cPaid=number_format($cPaid,2,'.','');
    print "<font face='Angsana New' size='4'>����Թ�����  $xNetpri �ҷ (<b>�ԡ����� $pay �ҷ</b>, �ԡ�� $free �ҷ)<br>";
// print "<img src = \"cscdbc.php?cHn=$poid\"><br>";
// print "<img src = \"cscdbc.php?cHn=$dDate1\"><br>";
//    print "<img src = \"cscdbc.php?cHn=$Time1\"><br>";
 //   print "<img src = \"cscdbc.php?cHn=$sHn\"><br>";
 //   print "<img src = \"cscdbc.php?cHn=$free\"><br>";
  
?>


