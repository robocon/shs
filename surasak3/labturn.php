<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $Thdhn=date("d-m-").(date("Y")+543).$cHn;

 include("connect.inc");
//runno  for chktranx

$query = "SELECT status, price FROM depart WHERE row_id = '$sPharow' limit 1 "; 
$result = mysql_query($query);
list($status, $price) = mysql_fetch_row($result);

if($status == "N"){

	echo "<BR><BR><CENTER>�������ö¡��ԡ�����ͧ�ҡ��¡�ù���¶١¡��ԡ�����</CENTER>";

exit();
}else if($price < 0){

	echo "<BR><BR><CENTER>�������ö¡��ԡ�����ͧ�ҡ��¡���ըӹǹ�Թ���Դź</CENTER>";

exit();
}

    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
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

    $query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx



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
    $cAn       =$row->an;  
	$cDoctor  =$row->doctor;
	$cDepart  =$row->depart;
	$aDetail  =$row->detail;
	$item     =$row->item;
	$x=$item;
//	$sOfficer  =$row->idname;
	$cDiag    =$row->diag;
	$Netprice  =$row->price*-1;
	$aSumYprice=$row->sumyprice*-1;
	$aSumNprice=$row->sumnprice*-1;
    $cAccno  =$row->accno;
    $tvn   =$row->tvn;

/*
'$cPtname','$cHn',
				'$cAn','$cDoctor','$cDepart','$item','$aDetail',                '$Netprice','$aSumYprice','$aSumNprice','','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright');";

CREATE TABLE `depart` (
  `row_id` int(11) NOT NULL auto_increment,
  `chktranx` int(11) default NULL,
  `date` datetime default NULL,
  `ptname` varchar(40) default NULL,
  `hn` varchar(12) default NULL,
  `an` varchar(12) default NULL,
  `doctor` varchar(40) default NULL,
  `depart` varchar(5) default NULL,
  `item` int(2) default NULL,
  `detail` varchar(40) default NULL,
  `price` double(11,2) default NULL,
  `sumyprice` double(11,2) default NULL,
  `sumnprice` double(11,2) default NULL,
  `paid` double(11,2) default NULL,
  `idname` varchar(32) default NULL,
  `diag` varchar(48) default NULL,
  `accno` int(4) default NULL,
  `tvn` varchar(12) default NULL,
  `ptright` varchar(30) default NULL,

*/

//¡��ԡʶԵԿ����
$query ="UPDATE xray_stat SET cancle = '1' WHERE idno = '".$row->chktranx."' limit 1";
$result = mysql_query($query) or die("Query failed");

//insert data into depart
   $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright)VALUES('$nRunno','$Thidate','$cPtname','$cHn',
				'$cAn','$cDoctor','$cDepart','$item','$aDetail',                '$Netprice','$aSumYprice','$aSumNprice','','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright');";

       $result = mysql_query($query) or 
                die("**��͹ !��ҹ��¡��ԡ��¡��仡�͹˹�ҹ������");

  $idno=mysql_insert_id();

//insert data into patdata
    $aCode = array("code");
    $aDetail  = array("detail");
    $aAmount = array("�ӹǹ ");
    $aMoney= array("����Թ ");
	$aYprice= array("Yprice ");
    $aNprice= array("Nprice");
    $aPart = array("part ");

    $query = "SELECT code,detail,amount,price,yprice,nprice,part,row_id FROM patdata WHERE idno = '$sPharow' ";
    $result = mysql_query($query)
        or die("Query failed");
/*
    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
*/
    while (list ($code,$detail,$amount,$price,$yprice,$nprice,$part,$row_id) = mysql_fetch_row ($result)) {

        array_push($aCode,$code);
        array_push($aDetail,$detail);
        array_push($aAmount,$amount*-1);
        array_push($aMoney,$price*-1);
        array_push($aYprice,$yprice*-1);
        array_push($aNprice,$nprice*-1);
        array_push($aPart,$part);
      }

//insert data into patdata
    for ($n=1; $n<=$x; $n++){
         If (!empty($aCode[$n])){
                $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$aCode[$n]','$aDetail[$n]','$aAmount[$n]',
                                 '$aMoney[$n]','$aYprice[$n]','$aNprice[$n]','$cDepart','$aPart[$n]','$idno','$cPtright');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");
        }
        }

// in case of inpatient insert data into ipacc
IF (!empty($cAn)) {
     for ($n=1; $n<=$x; $n++){

   If ($aPart[$n]=="DPY" and $aNprice[$n] < 0){

                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                                    idname,part,accno,idno)VALUES('$Thidate','$cAn','$aCode[$n]','$cDepart','$aDetail[$n]',
                                    '$aAmount[$n]','$aYprice[$n]','$sOfficer','DPY','$cAccno','$idno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc1");

   }


   If ($aPart[$n]=="DPY" and $aNprice[$n] < 0){

                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                                    idname,part,accno,idno)VALUES('$Thidate','$cAn','$aCode[$n]','$cDepart','$aDetail[$n]',
                                    '$aAmount[$n]','$aNprice[$n]','$sOfficer','DPN','$cAccno','$idno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc2");

   }

else {
 $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                                    idname,part,accno,idno)VALUES('$Thidate','$cAn','$aCode[$n]','$cDepart','$aDetail[$n]',
                                    '$aAmount[$n]','$aMoney[$n]','$sOfficer','$aPart[$n]','$cAccno','$idno');";
                   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc3");
}
}
}
//update data in opday 
	if ($cDepart == 'XRAY'){
			    $xraypri=$Netprice;
	            }
	else {
					    $xraypri=0;
	         }
	if ($cDepart =='PATHO'){
			    $pathopri=$Netprice;
	            }
	else {
					    $pathopri=0;
	         }
	if ($cDepart =='EMER'){
			    $emerpri=$Netprice;
	            }
	else {
					    $emerpri=0;
	         }
	if ($cDepart =='SURG'){
			    $surgpri=$Netprice;
	            }
	else {
					    $surgpri=0;
	         }
	if ($cDepart =='PHYSI'){
			    $physipri=$Netprice;
	            }
	else {
					    $physipri=0;
	         }
	if ($cDepart =='DENTA'){
			    $dentapri=$Netprice;
	            }
	else {
					    $dentapri=0;
	         }
	if ($cDepart =='OTHER'){
			    $otherpri=$Netprice;
	            }
	else {
					    $otherpri=0;
	         }

		$Thdhn=date("d-m-").(date("Y")+543).$cHn;
        $query ="UPDATE opday SET   xray= xray+$xraypri,
																patho=patho+$pathopri,
																emer=emer+$emerpri,
																surg=surg+$surgpri,
																physi=physi+$physipri,
																denta=denta+$dentapri,
																other=other+$otherpri
					   WHERE thdatehn= '$Thdhn' AND vn = '".$_SESSION["sVn"]."' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");
		
		$sql = "Update depart set status = 'N' where row_id = '$sPharow' ";
		$result = mysql_query($sql);

		$sql = "Update patdata set status = 'N' where idno = '$sPharow' ";
		$result = mysql_query($sql);

//��駡��¡��ԡ
    print "<font face='Angsana New'>$Thaidate<br>";
    print "$cPtname HN:$cHn VN:$tvn <br>";
    print "�Է��: $cPtright<br>";
    print "�ä :$cDiag<br>";
    print "ᾷ��:$cDoctor<br>";

      print "<table>";
      print " <tr>";
      print "  <th>#</th>";
      print "  <th>��¡��</th>";
      print "  <th>�ӹǹ</th>";
      print "  <th>�Ҥ�</th>";
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
   print "�Ҥ���� $Netprice �ҷ<br>";
//����駡��¡��ԡ

      print "¡��ԡ��¡�����º���� <br>";
      print "���. $sOfficer  $Thaidate<br>";

session_unregister("sVn");

 include("unconnect.inc");
?>
 
