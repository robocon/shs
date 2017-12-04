<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 

 include("connect.inc");
//to find data from depart
    $query = "SELECT * FROM depart WHERE row_id = '$sPharow' "; //session
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

//	$Thidate    =$row->date;
	$cPtname  =$row->ptname;
	$cPtright  =$row->ptright;
	$cHn       =$row->hn;
	
	if($cAn==''){
	$cAn=$_POST['cAn'];
	}else	{
    $cAn=$row->an;  
	}
	echo $cAn;
	$cDoctor  =$row->doctor;
	$cDepart  =$row->depart;
	$aDetail  =$row->detail;
	$item     =$row->item;
	$x=$item;
//	$sOfficer  =$row->idname;
	$cDiag    =$row->diag;
	$Netprice  =$row->price;
	$aSumYprice=$row->sumyprice;
	$aSumNprice=$row->sumnprice;
    $cAccno  =$row->accno;
    $tvn   =$row->tvn;


    $aCode = array("code");
    $aDetail  = array("detail");
    $aAmount = array("จำนวน ");
    $aMoney= array("รวมเงิน ");
	$aYprice= array("Yprice ");
    $aNprice= array("Nprice");
    $aPart = array("part ");

    $query = "SELECT code,detail,amount,price,yprice,nprice,part,row_id FROM patdata WHERE idno = '$sPharow' ";
    $result = mysql_query($query)
        or die("Query failed");
    while (list ($code,$detail,$amount,$price,$yprice,$nprice,$part,$row_id) = mysql_fetch_row ($result)) {
        array_push($aCode,$code);
        array_push($aDetail,$detail);
        array_push($aAmount,$amount);
        array_push($aMoney,$price);
        array_push($aYprice,$yprice);
        array_push($aNprice,$nprice);
        array_push($aPart,$part);
      }
  $Thidate1 = (date("Y")+543).date("-m-d"); 
//$sql = "Select an From ipcard where hn = '$cHn' and date like '$Thidate1%' ";  
$sql = "Select an From ipcard where hn = '$cHn' order by date desc limit 1 ";
$result2 = Mysql_Query($sql) or die(mysql_error());
list($cAn) = Mysql_fetch_row($result2);

// in case of inpatient insert data into ipacc
IF (!empty($cAn)) {
     for ($n=1; $n<=$x; $n++){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                                    idname,part,accno,idno)VALUES('$Thidate','$cAn','$aCode[$n]','$cDepart','$aDetail[$n]',
                                    '$aAmount[$n]','$aMoney[$n]','$sOfficer','$aPart[$n]','$cAccno','$idno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
	}

	$sql = " Update patdata set an = '".$cAn."' WHERE idno = '$sPharow' ";
	$result = mysql_query($sql) or die("Query failed,cannot insert into patdata");
	$sql = " Update depart set an = '".$cAn."', tvn = '".$cAn."'  WHERE  row_id = '$sPharow' ";
	$result = mysql_query($sql) or die("Query failed,cannot insert into depart");

//ใบแจ้งการส่งข้อมูลไป บ/ช ผป.ใน
    print "<font face='Angsana New'>$Thaidate<br>";
    print "$cPtname HN:$cHn VN:$tvn AN:$cAn<br>";
    print "สิทธิ: $cPtright<br>";
    print "โรค :$cDiag<br>";
    print "แพทย์:$cDoctor<br>";

      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>รายการ</th>";
      print "  <th>จำนวน</th>";
      print "  <th>ราคา</th>";
      print " </tr>";

    $no=0;
    for ($n=1; $n<=$x; $n++){
          If (!empty($aCode[$n])){
              $no++;
         print (" <tr>\n".
           "  <td>$no</td>\n".
           "  <td>$aDetail[$n]</td>\n".
           "  <td>$aAmount[$n]</td>\n".
           "  <td>$aMoney[$n]</td>\n".
           " </tr>\n");
           }
      } ;
   print "</table>";
   print "ราคารวม $Netprice บาท<br>";
//จบใบแจ้งการส่งข้อมูล
      print "ส่งข้อมูลเข้าบัญชีผู้ป่วยใน $cPtname  AN: $cAn เรียบร้อย <br>";
      print "จนท. $sOfficer  $Thaidate<br>";
	}
else{
	  echo $cAn;
	  print"<FONT SIZE=\"4\" COLOR=\"#FF0000\">ไม่สามารถส่งข้อมูลเข้าบัญชีผู้ป่วยในได้ เนื่องจาก ผู้ป่วยเป็นผู้ป่วยนอก ไม่ได้ทำการadmit</FONT>";
	}
 include("unconnect.inc");
?>
 
