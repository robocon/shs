<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $Thdhn=date("d-m-").(date("Y")+543).$cHn;

function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

 include("connect.inc");

    $query = "SELECT borrow FROM phardep where row_id = '".$_GET["nRow_id"]."' "; //session
	$result = Mysql_Query($query);
	$arr = Mysql_fetch_assoc($result);

	if($arr["borrow"] == "T"){

		echo "รายการยานี้เคยทำการคืนแล้วไม่สามารถคืนอีกครั้งได้";
		exit();

	}

    $aDgcode = array("รหัสยา");
    $aTrade  = array(" ชื่อการค้า");
    $aAmount = array("จำนวน ");
    $aMoney= array("รวมเงิน ");
    $aSlipcode = array(" วิธีใช้ ");
    $aPart = array("part ");
	$aStatcon = array("สถานะ ");
	$aDpy = array("เบิกได้ ");
	$aDpn = array("เบิกไม่ได้ ");
	$aStatus = array("สถานะยา");


//insert data into phardep
//    echo "sPharow=$sPharow<br>";
    $query = "SELECT * FROM phardep WHERE row_id = '$sPharow' "; //session
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
	$ddate    =$row->date;
	$cPtname  =$row->ptname;
	$cPtright  =$row->ptright;
	$cHn         =$row->hn;
    $cAn          =$row->an;  
	$Netprice  =$row->price*-1;
	$cDoctor  =$row->doctor;
	$x             =$row->item;
//	$sOfficer  =$row->idname;
	$cDiag    =$row->diag;
	$Essd      =$row->essd*-1;
	$Nessdy =$row->nessdy*-1;
	$Nessdn =$row->nessdn*-1;
	$DPY      =$row->dpy*-1;
	$DPN      =$row->dpn*-1;
                $cAccno  =$row->accno;
	$DSY      =$row->dsy*-1;
	$DSN       =$row->dsn*-1;
                   $tvn   =$row->tvn;
				   
				   $datedr =$row->datedr;


		$sql = "Update dphardep set stkcutdate = Null where tvn='".$row->tvn."' AND hn='".$row->hn."' AND price='".$row->price."' AND dr_cancle is null and date='$datedr' limit 1 ";
		
		
		
		//echo $sql;
		$result = mysql_query($sql) or die("Query failed,update phardep");

		$query = "Update phardep set borrow = 'T' where row_id = '".$_GET["nRow_id"]."' ";
		$result = mysql_query($query) or die("Query failed,update phardep");
		$query = "Update drugrx set status = 'N' where idno = '".$_GET["nRow_id"]."' ";
		$result = mysql_query($query) or die("Query failed,update drugrx");

       $query = "INSERT INTO phardep(date,ptname,hn,an,price,doctor,item,
                    idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,accno,tvn,ptright,phapt,datedr )VALUES('$Thidate','$cPtname','$cHn','$cAn',
                    '$Netprice','$cDoctor','$x','$sOfficer','".jschars($cDiag)."','$Essd','$Nessdy',
	    '$Nessdn','$DPY','$DPN','$DSY','$DSN','$cAccno','$tvn','$cPtright','$sOfficer','$datedr');";
	   
       $result = mysql_query($query) or die("Query failed,insert into phardep");
  $idno=mysql_insert_id();

//insert data into drugrx
    $query = "SELECT drugcode,tradname,amount,price,slcode,part,statcon,DPY,DPN,date FROM drugrx WHERE date = '$dDate' and hn='$cHn' ";
    $result = mysql_query($query) or die("Query failed");
	$item=0;
    while (list ($drugcode,$tradname,$amount,$price,$slcode,$part, $statcon,$rdpy,$rdpn,$dd) = mysql_fetch_row ($result)) {

		$statusx = "";

		if(!empty($cAn))
		{
			///***เช็คสถานะจำหน่าย***///
			$sqlx = "Select status From ipacc where date = '".$dd."' AND an = '$cAn' and code ='".$drugcode."' and amount='".$amount."' ";
			list($statusx) = mysql_fetch_row(mysql_query($sqlx));
		}
		
        array_push($aDgcode,$drugcode);
        array_push($aTrade,$tradname);
        array_push($aAmount,$amount);
        array_push($aMoney,$price);
        array_push($aSlipcode,$slcode);
        array_push($aPart,$part);
		array_push($aStatcon,$statcon);
		array_push($aDpy,$rdpy);
		array_push($aDpn,$rdpn);
		array_push($aStatus,$statusx);
		$item++;
	}

$x=$item;
//update data in druglst 
     for ($n=1; $n<=$x; $n++){
            $query ="update druglst SET stock = stock + $aAmount[$n],
              			  rxaccum = rxaccum - $aAmount[$n],
             			  rx1day   = rx1day -$aAmount[$n],
        			  totalstk = stock + mainstk
                           WHERE drugcode= '$aDgcode[$n]' ";
						   
echo $query;
		if($aDgcode[$n] !="")
           $result = mysql_query($query) or die("Query failed,update druglst");
		        };


     for ($n=1; $n<=$x; $n++){

		 $sql = "Select stock From druglst where drugcode = '".$aDgcode[$n]."' limit 0,1 ";
		 $result = Mysql_Query($sql);
		 $arr = Mysql_fetch_assoc($result);
		 $stock = $arr["stock"];


             $query = "INSERT INTO drugrx(date,hn,an,drugcode,tradname,
                   amount,price,item,slcode,part,idno,stock,statcon )VALUES('$Thidate','$cHn','$cAn','$aDgcode[$n]','$aTrade[$n]',
                   $aAmount[$n]*-1,$aMoney[$n]*-1,'$x','$aSlipcode[$n]','$aPart[$n]','$idno','$stock','".$aStatcon[$n]."');";
			
			if($aDgcode[$n] !=""){
				$result = mysql_query($query) or die("Query failed,insert into drugrx");
				
				$querye ="update drugrx SET reject = 'Y' WHERE date = '$dDate' and hn='$cHn' ";
				mysql_query($querye);
			
				$c1 = substr($aDgcode[$n],0,1);
				$c2 = substr($aDgcode[$n],0,2);

				if($c2!='20'&&($c1=='2'||$c1=='0')){
						
					$sdepart = "select * from depart where date like '".$ddate."%' and hn='$cHn' and detail='(55823 ค่าฉีดยาผู้ป่วยนอก)' and price > 0 and status ='Y'";
					
					
					$rowdeps = mysql_query($sdepart);
					$ndep = mysql_num_rows($rowdeps);
			
					if($ndep>0){
						//runno  for chktranx
								$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
								$result = mysql_query($query)
									or die("Query failed");
							
								for ($k = mysql_num_rows($result) - 1; $k >= 0; $k--) {
									if (!mysql_data_seek($result, $k)) {
										echo "Cannot seek to row $k\n";
										continue;
									}
							
									if(!($row = mysql_fetch_object($result)))
										continue;
								}
							
								$nRunno=$row->runno;
								$nRunno++;
							
								$query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
								$result = mysql_query($query) or die("Query failed");
								
						$query5 = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$Thidate."','".$cPtname."','".$cHn."','','EMER','1','(55823 ค่าฉีดยาผู้ป่วยนอก)', '-20','-20','0','','".$sOfficer."','0','".$tvn."','".$cPtright."');";

						$result = mysql_query($query5);
						$idnodepart=mysql_insert_id();
							 
						$query5 = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$Thidate."','".$cHn."','','".$cPtname."','1','INJ','(55823 ค่าฉีดยาผู้ป่วยนอก)','1','-20','-20','0','EMER','NCARE','".$idnodepart."','".$cPtright."');";
			
						$result = mysql_query($query5) or die("Query failed,cannot insert into patdata"); 
						
						
					}
				}
			}
      	};
		 	$rowdeps = mysql_query($sdepart);
			$arr = mysql_fetch_array($rowdeps);
			$query1 ="UPDATE depart SET status = 'N' WHERE row_id='".$arr['row_id']."' ";
			$result = mysql_query($query1) or die("Query failed");


// in case of inpatient insert data into ipacc
IF (!empty($cAn)) {
     for ($n=1; $n<=$x; $n++){


		   If ($aPart[$n]=="DPY" and $aDpn[$n] > 0){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno,status)VALUES('$Thidate','$cAn','$aDgcode[$n]','PHAR','$aTrade[$n]',$aAmount[$n]*-1,$aDpy[$n]*-1,'DPY','$sOfficer','$cAccno','$idno','$aStatus[$n]');";
                   $result = mysql_query($query) or die("insert into ipacc failed1");
		
                                $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno,status                                )VALUES('$Thidate','$cAn','$aDgcode[$n]','PHAR','$aTrade[$n]',
                                   '0',$aDpn[$n]*-1,'DPN','$sOfficer','$cAccno','$idno','$aStatus[$n]');";
                                 $result = mysql_query($query) or die("insert into ipacc failed2");
		        }	   

				else {

                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,status
                                   )VALUES('$Thidate','$cAn','$aDgcode[$n]','PHAR','$aTrade[$n]',
                                   $aAmount[$n]*-1,$aMoney[$n]*-1,'$aPart[$n]','$sOfficer','$cAccno','$aStatus[$n]');";
                   $result = mysql_query($query) or die("insert into ipacc failed3");
 		       }

		


}

}



   	     

//update data in opday ลดราคายาที่คืน
        $Thdhn=date("d-m-").(date("Y")+543).$cHn;

        $query ="update opday SET  phar= phar+$Netprice
                       WHERE thdatehn= '$Thdhn' AND vn = '".$tvn."' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");

      print "คืนยาทั้งใบเรียบร้อย <br>";
	   print "กรุณาพิมพ์หน้านี้ทุกครั้งที่ยกเลิกรายการยา <br>";
      print "จนท. $sOfficer  $Thaidate<br>";

 include("unconnect.inc");
?>
 
