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
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aAmount = array("        จำนวน   ");
    $aSlipcode = array("        วิธีใช้   ");
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
  print"<th bgcolor=CD853F>รายการ</th>";
  print"<th bgcolor=CD853F>จำนวน</th>";
 print" <th bgcolor=CD853F>ราคา</th>";
  print"<th bgcolor=CD853F>วิธีใช้</th>";
 print" <th bgcolor=CD853F>แก้วิธีใช้</th>";
print" </tr>";
    $query = "SELECT tradname,amount,price,slcode,drugcode FROM ddrugrx WHERE idno = '$nRow_id' AND date = '".$_GET["sDate"]."' ";

    $result = mysql_query($query)
        or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "วันที่ $d/$m/$y<br>";
    print "$sPtname, HN: $sHn, AN:$sAn สิทธิ:$sPtright<br> ";
    print "$cWardname เตียง$cBed โรค: $sDiag<br>";
//    print "แพทย์ :$sDoctor<br><br>";

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
           "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"rxslip.php? cDrugcode=$drugcode& cTradname=$tradname&cAmount=$amount\">แก้วิธีใช้</a></td>\n".
           " </tr>\n");
      }
    
   print"</table>";
    print "รวมงิน  $sNetprice บาท<br>";
    print "แพทย์ :$sDoctor<br><br>";
	
	$sqld="select status_log from ipcard where an ='$sAn' ";
	$rowd = mysql_query($sqld);
	list($statuslog) = mysql_fetch_array($rowd);
	if($statuslog=="จำหน่าย"){
		print "<font color='#FF0000'>ไม่สามารถตัดสต๊อกได้เนื่องจากผู้ป่วยจำหน่ายแล้ว<br> มีปัญหาติดต่อ ส่วนเก็บเงินรายได้</font>&nbsp;&nbsp;&nbsp;";
	}else{
   		print " <a target=_blank href='wrxstkcut.php?sDate=".$_GET["sDate"]."'>ตัดสต๊อกยา</a>&nbsp;&nbsp;&nbsp;";
	}
   
  // print" <a target=_blank href='wrxprint.php'>พิมพ์ใบสั่งยา</a>&nbsp;&nbsp;&nbsp;";
    print"<a target=_blank href='slipsprn2.php'>พิมพ์สลากยาทั้งหมด</a>";  
	include("unconnect.inc");
?>

