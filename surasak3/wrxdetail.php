<?php
    session_start();
    session_unregister("nRunno");
    $nRunno="";
    session_register("nRunno");

	session_unregister("sRow_id");
    $sRow_id=$nRow_id;
    session_register("sRow_id");

    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aAmount");
    session_unregister("aSlipcode");

    $x=0;
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aAmount = array("        �ӹǹ   ");
    $aSlipcode = array("        �Ը���   ");
    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aAmount");
    session_register("aSlipcode");

    $sPtname = '';
    session_register("sPtname");
    $cBed=$sBed;
    session_register("cBed");

    $dDate=$sDate;
    include("connect.inc");
	//runno  for chktranx
	 include("connect.inc");

    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'phardep'";
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
    $nRunno=$row->runno;
    $nRunno++;
    $query ="UPDATE runno SET runno = $nRunno WHERE title='phardep'";
    $result = mysql_query($query)
        or die("Query failed");
	//end  runno  for chktranx

  
    $query = "SELECT * FROM dphardep WHERE row_id = '$nRow_id' "; 
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

print"<table>";
print" <tr>";
   print"<th bgcolor=CD853F>#</th>";
  print"<th bgcolor=CD853F>��¡��</th>";
  print"<th bgcolor=CD853F>�ӹǹ</th>";
 print" <th bgcolor=CD853F>�Ҥ�</th>";
  print"<th bgcolor=CD853F>�Ը���</th>";
 print" <th bgcolor=CD853F>���Ը���</th>";
print" </tr>";
    $query = "SELECT tradname,amount,price,slcode,drugcode FROM ddrugrx WHERE idno = '$nRow_id' AND date = '".$_GET["sDate"]."' ";

    $result = mysql_query($query)
        or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "�ѹ��� $d/$m/$y<br>";
    print "$sPtname, HN: $sHn, AN:$sAn �Է��:$sPtright<br> ";
    print "$cWardname ��§$cBed �ä: $sDiag<br>";
//    print "ᾷ�� :$sDoctor<br><br>";

    while (list ($tradname,$amount,$price,$slcode,$drugcode) = mysql_fetch_row ($result)) {
        $x++;
        $aDgcode[$x]=$drugcode;
        $aTrade[$x]=$tradname;
        $aSlipcode[$x]=$slcode;        
        $aAmount[$x]=$amount;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$x</td>\n".
           "  <td BGCOLOR=F5DEB3>$tradname</td>\n".   
           "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"slipprint.php? cSlcode=$slcode&cDrugcode=$drugcode& cTradname=$tradname&cAmount=$amount\">$slcode</a></td>\n".
           "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"rxslip.php? cDrugcode=$drugcode& cTradname=$tradname&cAmount=$amount\">���Ը���</a></td>\n".
           " </tr>\n");
      }
    
   print"</table>";
    print "����Թ  $sNetprice �ҷ<br>";
    print "ᾷ�� :$sDoctor<br><br>";
	
	$sqld="select status_log from ipcard where an ='$sAn' ";
	$rowd = mysql_query($sqld);
	list($statuslog) = mysql_fetch_array($rowd);
	if($statuslog=="��˹���"){
		print "<font color='#FF0000'>�������ö�Ѵʵ�͡�����ͧ�ҡ�����¨�˹�������<br> �ջѭ�ҵԴ��� ��ǹ���Թ�����</font>&nbsp;&nbsp;&nbsp;";
	}else{
   		print " <a target=_blank href='wrxstkcut.php?sDate=".$_GET["sDate"]."'>�Ѵʵ�͡��</a>&nbsp;&nbsp;&nbsp;";
	}
   
  // print" <a target=_blank href='wrxprint.php'>�����������</a>&nbsp;&nbsp;&nbsp;";
    print"<a target=_blank href='slipsprn2.php'>�������ҡ�ҷ�����</a>";  
	include("unconnect.inc");
?>

