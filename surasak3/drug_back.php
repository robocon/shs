<?php
    session_start();
	 include("connect.inc");
	
	 /*if($_SESSION["sIdname"] != "bbm"){
			
			echo "ขออภัยอยู่ระหว่างการปรับปรุง";
			exit();

	 }*/

?>
	 
<HTML>
<HEAD>
<TITLE> คืนยาผู้ป่วยใน </TITLE>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}
body,td,th {
font-family:  MS Sans Serif;
font-size: 16 px;
}
.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}

#slidemenubar, #slidemenubar2{
position:absolute;
left:-155px;
width:160px;
top:250px;
border:1.5px solid #FFCC00;


layer-background-color:lightyellow;
font:bold 12px ms sans serif;
line-height:20px;

}

</style>
</HEAD>

<BODY>
<?php
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

$item = 0;
$list_drugrx = array();
$list_amount = array();
$list_sql = array();
for($i=1;$i<$_POST["total"];$i++){
	
	if(isset($_POST["list_rows".$i])){
		$item++;
		array_push($list_drugrx,$_POST["list_rows".$i]);
		array_push($list_amount,$_POST["amount".$i]);
	}
}

$Netprice = 0;

	$query = "SELECT * FROM phardep WHERE row_id = '".$_POST["row_id"]."' limit 1 ";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$Date  =$row->date;
	$ptname  =$row->ptname;
	$ptright  =$row->ptright;
	$hn         =$row->hn;
	$tvn   =$row->tvn;

for($i=0;$i<$item;$i++){

	$sql = "Select drugcode,tradname,amount,price,slcode,part,statcon,DPY,DPN From drugrx where row_id = ".$list_drugrx[$i]." limit 1 ";
	list($drugcode,$tradname,$amount,$price,$slcode,$part, $statcon,$rdpy,$rdpn) = mysql_fetch_row(mysql_query($sql));

		$amount2 = $list_amount[$i];

		$unit_price = $price/ $amount;
		$price = $unit_price*$amount2;

		$unit_DPY = $rdpy/ $amount;
		$rdpy = $unit_DPY*$amount2;

		$unit_DPN = $rdpn/ $amount;
		$rdpn = $unit_DPN*$amount2;
	
		
		$amount = $list_amount[$i];


	switch($part){
		case "DDL" : $Essd = $Essd + $price; break;
		case "DDY" : $Nessdy = $Nessdy + $price; break;
		case "DDN" : $Nessdn = $Nessdn + $price; break;
		
		case "DPY" : $DPY = $DPY + $rdpy; $DPN = $DPN + $rdpn; break;
		case "DPN" : $DPN = $DPN + $price;    break;
		case "DSY" : $DSY = $DSY + $rdpy; $DSN = $DSN + $rdpn; break;
		case "DSN" : $DSN = $DSN + $price; break;

	}

	$query ="update druglst SET stock = stock + $list_amount[$i], rxaccum = rxaccum - $list_amount[$i], rx1day   = rx1day -$list_amount[$i], totalstk = stock + mainstk WHERE drugcode= '$drugcode' ";
	mysql_query($query);

	$sql = "Select stock From druglst where drugcode = '$drugcode' limit 0,1 ";
	list($stock) = mysql_fetch_row(mysql_query($sql));

	$list_sql[$i] = "INSERT INTO drugrx(date,hn,an,drugcode,tradname, amount,price,item,slcode,part,idno,stock,statcon, DPY , DPN  )VALUES('$Thidate','$pHn','$pAn','$drugcode','$tradname', $amount*-1,$price*-1,'$item','$slcode','$part','[idno]','$stock','".$statcon."',$rdpy*-1,$rdpn*-1);";

	
	$Netprice = $Netprice+$price;

	$querye ="update drugrx SET reject = 'Y' where row_id = ".$list_drugrx[$i]." limit 1 ";
	mysql_query($querye);

	$c1 = substr($drugcode,0,1);
	$c2 = substr($drugcode,0,2);

	if($c2!='20'&&($c1=='2'||$c1=='0')){
			
		$sdepart = "select * from depart where date like '".$Date."%' and hn='$hn' and detail='(55823 ค่าฉีดยาผู้ป่วยนอก)' and price > 0 and status ='Y'";
		
		
		$rowdeps = mysql_query($sdepart);
		$ndep = mysql_num_rows($rowdeps);

		if($ndep>0){
			//runno  for chktranx
					$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
					$result = mysql_query($query)
						or die("Query failed");
				
					for ($k = mysql_num_rows($result) - 1; $k >= 0; $k--) {
						if (!mysql_data_seek($result, $k)) {
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
					
			$query5 = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$Thidate."','".$ptname."','".$hn."','','EMER','1','(55823 ค่าฉีดยาผู้ป่วยนอก)', '-20','-20','0','','".$_SESSION["sOfficer"]."','0','".$tvn."','".$ptright."');";

			$result = mysql_query($query5);
			$idnodepart=mysql_insert_id();
				 
			$query5 = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$Thidate."','".$hn."','','".$ptname."','1','INJ','(55823 ค่าฉีดยาผู้ป่วยนอก)','1','-20','-20','0','EMER','NCARE','".$idnodepart."','".$ptright."');";

			$result = mysql_query($query5) or die("Query failed,cannot insert into patdata"); 
			
			$rowdeps = mysql_query($sdepart);
			$arr = mysql_fetch_array($rowdeps);
			$query1 ="UPDATE depart SET status = 'N' WHERE row_id='".$arr['row_id']."' ";
			$result = mysql_query($query1) or die("Query failed");
		}
	}
	

}
	
	$query = "SELECT * FROM phardep WHERE row_id = '".$_POST["row_id"]."' limit 1 ";
	$result = mysql_query($query);
	$row = mysql_fetch_object($result);
	$ptname  =$row->ptname;
	$ptright  =$row->ptright;
	$hn         =$row->hn;
    $an          =$row->an;  
	$Netprice  =$Netprice*-1;
	$doctor  =$row->doctor;
	$diag    =$row->diag;
    $cAccno  =$row->accno;
    $tvn   =$row->tvn;

	$sql = "INSERT INTO phardep(date,ptname,hn,an,price,doctor,item,idname,diag,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,accno,tvn,ptright,phapt)VALUES('".$Thidate."','".$ptname."','".$hn."','".$an."','".$Netprice."','".$doctor."','".$item."','".$_SESSION["sOfficer"]."','".$diag."','".($Essd*-1)."','".($Nessdy*-1)."','".($Nessdn*-1)."','".($DPY*-1)."','".($DPN*-1)."','".($pricetype["DSY"]*-1)."','".($DSY*-1)."','".$accno."','".$tvn."','".$ptright."','".$_SESSION["sOfficer"]."');";
	
	$result = mysql_query($sql) or die("Query failed,insert into phardep");
	$idno=mysql_insert_id();
	
	for($i=0;$i<$item;$i++){
		$list_sql[$i] = str_replace("[idno]",$idno,$list_sql[$i]);
		$result = mysql_query($list_sql[$i]) or die("Query failed,insert into drugrx".$i);

	}

	if($an != "")
	for($i=0;$i<$item;$i++){
	
	$sql = "Select drugcode,tradname,amount,price,slcode,part,statcon,DPY,DPN,date From drugrx where row_id = ".$list_drugrx[$i]." limit 1 ";
	list($drugcode,$tradname,$amount,$price,$slcode,$part, $statcon,$rdpy,$rdpn,$dd) = mysql_fetch_row(mysql_query($sql));
	
	///***เช็คสถานะจำหน่าย***///
	$sqlx = "Select status From ipacc where date = '".$dd."' and code ='".$drugcode."' and amount='".$amount."' ";
	list($statusx) = mysql_fetch_row(mysql_query($sqlx));
	
		$amount2 = $list_amount[$i];

		$unit_price = $price/ $amount;
		$price = $unit_price*$amount2;

		$unit_DPY = $rdpy/ $amount;
		$rdpy = $unit_DPY*$amount2;

		$unit_DPN = $rdpn/ $amount;
		$rdpn = $unit_DPN*$amount2;
	
		
		$amount = $list_amount[$i];

	If ($part=="DPY" & $rdpn > 0){
          $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno,status)VALUES('$Thidate','$an','$drugcode','PHAR','$tradname',$amount*-1,$rdpy*-1,'DPY','".$_SESSION["sOfficer"]."','$cAccno','$idno','$statusx');";



		 $result = mysql_query($query) or die("insert into ipacc failed1");
			
			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,idno,status)VALUES('$Thidate','$an','$drugcode','PHAR','$tradname','0',$rdpn*-1,'DPN','".$_SESSION["sOfficer"]."','$cAccno','$idno','$statusx');";
            $result = mysql_query($query) or die("insert into ipacc failed2");

	}else{

          $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,part,idname,accno,status)VALUES('$Thidate','$an','$drugcode','PHAR','$tradname',$amount*-1,$price*-1,'$part','".$_SESSION["sOfficer"]."','$cAccno','$statusx');";


		  $result = mysql_query($query) or die("insert into ipacc failed3");
 	}
}
print "คืนยาทั้งหมด ".$item." รายการเรียบร้อยแล้ว<br>";
print "จนท. $sOfficer  $Thaidate<br>";

?>	

</BODY>
</HTML>
<?php
include("unconnect.inc");
?>
