<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $Thdhn=date("d-m-").(date("Y")+543).$cHn;

 include("connect.inc");

//insert data into drugrx
    $query = "SELECT * FROM drugrx WHERE row_id = '$cRowdgrx' ";
    $result = mysql_query($query) or die("Query failed");
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
//              row_id        =$row->date;
  	$Date           =$row->date;
	$cHn             =$row->hn;
	$cAn             =$row->an;
	$Drugcode =$row->drugcode;
	$Tradname =$row->tradname;
	$Amount     =$row->amount;
	$Price        =$row->price;
	$Item          =  1;   //$row->item;
	$Slcode      =$row->slcode;
	$Part          =$row->part;

//หาราคาเวชภัณฑ์ อุปกรณ์ ที่ เบิกได้ ไม่ได้
    $query = "SELECT salepri,freepri FROM druglst WHERE drugcode = '$Drugcode' ";
    $result = mysql_query($query) or die("Query failed");
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;
         }
            $Salepri  = $row->salepri;
            $Freepri  = $row->freepri;
//
if (substr($Part,0,3)=="DDL"){
            $Essd = $Price;
              }
else {
			$Essd=0;
	}
if (substr($Part,0,3)=="DDY"){
            $Nessdy = $Price;
              }
else {
			$Nessdy=0;
	}
if (substr($Part,0,3)=="DDN"){
            $Nessdn = $Price;
                }
else {
			$Nessdn=0;
	}
//อุปกรณ์
if (substr($Part,0,3)=="DPY"){
            $DPY = $Freepri*$Amount;  //อุปกรณ์ ส่วนที่เบิกได้ $row->freepri
            $DPN = ($Salepri-$Freepri)*$Amount;  // อุปกรณ์ ส่วนที่เบิกไม่ได้ $row->salepri - $row->freepri
				}
else {
			$DPY=0;
			$DPN=0;
	}
if (substr($Part,0,3)=="DPN"){
            $DPN = $Price;  //อุปกรณ์เบิกไม่ได้
              }  
else {
			$DPN=0;
	}			  
//เวชภัณฑ์ไม่ใช่ยา
if (substr($Part,0,3)=="DSY"){
            $DSY = $Freepri*$Amount;  //เวชภัณฑ์ไม่ใช่ยา ส่วนที่เบิกได้ $row->freepri
            $DSN = ($Salepri-$Freepri)*$Amount;   // เวชภัณฑ์ไม่ใช่ยา ส่วนที่เบิกไม่ได้ $row->salepri - $row->freepri
                   }
else {
			$DSY=0;
			$DSN=0;
	}
if (substr($Part,0,3)=="DSN"){
            $DSN = $Price;  //เวชภัณฑ์ไม่ใช่ยา เบิกไม่ได้
               } 
else {
			$DSN=0;
	}			   
//

//insert data into phardep
    $query = "SELECT * FROM phardep WHERE date = '$Date' ";
    $result = mysql_query($query) or die("Query failed");
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
		$cHn         =$row->hn;
		$cPtright  =$row->ptright;
		$cAn          =$row->an;  
//*	$Netprice  =$row->price*-1;
	$cDoctor  =$row->doctor;
	$x             = 1;
//	$sOfficer  =$row->idname;
		$cDiag    =$row->diag;
		$cAccno  =$row->accno;
		$Netprice =$Price*-1;
		$Essd      =$Essd*-1;
		$Nessdy =$Nessdy*-1;
		$Nessdn =$Nessdn*-1;
		$DPY      =$DPY*-1;
		$DPN      =$DPN*-1;
		$DSY      =$DSY*-1;
		$DSN      =$DSN*-1;
		$tvn   =$row->tvn;

       $query = "INSERT INTO phardep(date,ptname,hn,an,price,doctor,item,idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,accno,tvn,ptright)VALUES('$Thidate','$cPtname','$cHn','$cAn','$Netprice','$cDoctor','$x','$sOfficer','$cDiag','$Essd','$Nessdy','$Nessdn','$DPY','$DPN','$DSY','$DSN','$cAccno','$tvn','$cPtright');";
       $result = mysql_query($query) or die("Query failed,insert into phardep");

	   $idno=mysql_insert_id();


//update data in druglst 

       $query ="UPDATE druglst SET stock = stock + $Amount,
								rxaccum = rxaccum - $Amount,
								rx1day   = rx1day -$Amount,
								totalstk = stock + mainstk
								WHERE drugcode= '$Drugcode' ";

       $result = mysql_query($query) or die("Query failed,update druglst");

 	   $sql = "Select stock From druglst where drugcode = '".$Drugcode."' limit 0,1 ";
	   $result = Mysql_Query($sql);
	   $arr = Mysql_fetch_assoc($result);
	   $stock = $arr["stock"];


$query = "INSERT INTO drugrx(date,hn,an,drugcode,tradname,amount,price,item,slcode,part,idno,stock)VALUES('$Thidate','$cHn','$cAn','$Drugcode','$Tradname',$Amount*-1,$Price*-1,'$Item','$Slcode','$Part','$idno','$stock');";
$result = mysql_query($query) or die("Query failed,insert into drugrx");

if($result){
	$querye ="update drugrx SET reject = 'Y' where row_id = '$cRowdgrx ";
	mysql_query($querye);
}

$c1 = substr($Drugcode,0,1);
$c2 = substr($Drugcode,0,2);

if($c2!='20'&&($c1=='2'||$c1=='0')){
	$sdepart = "select * from depart where date like '".$Date."%' and hn='$cHn' and detail='(55823 ค่าฉีดยาผู้ป่วยนอก)' and price > 0 and status ='Y' ";
	$row = mysql_query($sdepart);
	$ndep = mysql_num_rows($row);
	if($ndep>0){
		//runno  for chktranx
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
				$result = mysql_query($query) or die("Query failed");
				
		$query5 = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$Thidate."','".$cPtname."','".$cHn."','','EMER','1','(55823 ค่าฉีดยาผู้ป่วยนอก)', '-20','-20','0','','".$sOfficer."','0','".$tvn."','".$cPtright."');";
		$result = mysql_query($query5);
		$idnodepart=mysql_insert_id();
			 
		$query5 = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$Thidate."','".$cHn."','','".$cPtname."','1','INJ','(55823 ค่าฉีดยาผู้ป่วยนอก)','1','-20','-20','0','EMER','NCARE','".$idnodepart."','".$cPtright."');";
		$result = mysql_query($query5) or die("Query failed,cannot insert into patdata"); 
		
		$row = mysql_query($sdepart);
		$arr = mysql_fetch_array($row);
		$query1 ="UPDATE depart SET status = 'N' WHERE row_id='".$arr['row_id']."' ";
		$result = mysql_query($query1) or die("Query failed");
	}
}



// in case of inpatient insert data into ipacc
if(!empty($cAn)){
     for ($n=1; $n<=$x; $n++){
                   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno)VALUES('$Thidate','$cAn','$Drugcode','PHAR','$Tradname',$Amount,$Price,'$Part','$sOfficer','$cAccno');";
                   $result = mysql_query($query) or die("insert into ipacc failed");
	 }
}

//update data in opday ลดราคายาที่คืน
        $Thdhn=date("d-m-").(date("Y")+543).$cHn;

        $query ="UPDATE opday SET  phar= phar+$Netprice
                       WHERE thdatehn= '$Thdhn' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");


      print "คืนยา  $Tradname เรียบร้อย <br>";
      print "จนท. $sOfficer  $Thaidate<br>";

 include("unconnect.inc");
?>
 
