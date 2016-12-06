<?
include("../connect.inc");
$_POST['year']="2557";
$_POST['mon']="10";
$newcredit="30บาท";
//--------------------------------- ค่าใช้จ่ายผู้ป่วยนอก	---------------------------------//	
$rssql ="select * from  opacc  where credit like '$newcredit%' and date like '".$_POST['year']."-".$_POST['mon']."%' and depart='PHAR'";
echo $rssql."<br>";
$rsresult = mysql_query($rssql) or die("Query failed12");
//echo $sql16;
		
while($rsrows = mysql_fetch_array($rsresult)){		
		
		$chkhn=$rsrows["hn"]; 
		$chkdate = substr($rsrows["date"],0,10);	
		echo ">>>$chkhn ($chkdate) <br>";
		
		$sql16 ="select *,sum(amount) as sumamount from  drugrx  where hn='$chkhn' and date like '$chkdate%'  and (an is null or an = '') and (part != 'DSY' or part != 'DSN' or part != 'DPN') group by drugcode";
		//echo $sql16;
		
		$result16 = mysql_query($sql16) or die("Query failed16");
		$num16= mysql_num_rows($result16);
   		while($rows16 = mysql_fetch_array($result16)){	
			$hcode16 ="11512";
			$hn16=$rows16["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล	
			$an16=$rows16["an"]; //  AN ใช้ตัวแปรนี้นำเข้าข้อมูล
			$drugcode16=$rows16["drugcode"];  //  DID ใช้ตัวแปรนี้นำเข้าข้อมูล
			$drugname16=$rows16["tradname"];  //  DIDNAME ใช้ตัวแปรนี้นำเข้าข้อมูล
			$amount16=$rows16["sumamount"];  //  AMOUNT ใช้ตัวแปรนี้นำเข้าข้อมูล
			$price=$rows16["price"]; 
			$amount=$rows16["amount"]; 
			$saleprice = $price/$amount;   //  DRUGPRICE(ราคาขาย) ใช้ตัวแปรนี้นำเข้าข้อมูล
			
			$datetimedrg=$rows16["date"];
			$datedrg = substr($datetimedrg,0,10);
			$datedrug =explode("-",$datedrg);
			$newdatedrug=$datedrug[0]-543;
			$newdateserv =$newdatedrug.$datedrug[1].$datedrug[2];  		  //  DATE_SERV ใช้ตัวแปรนี้นำเข้าข้อมูล						
			

//---------------------ใช้ข้อมูลยาจากตาราง druglst---------------------//					
			$sqldrx= "SELECT * FROM  druglst WHERE drugcode ='".$drugcode16."' ";
			$resultdrx = mysql_query($sqldrx) or die("Query druglst failed");
			$rowsdrx=mysql_fetch_array($resultdrx);
				$code24=$rowsdrx["code24"];    //  DIDSTD ใช้ตัวแปรนี้นำเข้าข้อมูล
				//$saleprice=$rowsdrx["salepri"];    //  DRUGPRICE(ราคาขาย) ใช้ตัวแปรนี้นำเข้าข้อมูล
				$unitprice=$rowsdrx["unitpri"];    //  DRUGCOST(ราคาทุน) ใช้ตัวแปรนี้นำเข้าข้อมูล
				$unit=$rowsdrx["unit"];    //  DIDSTD ใช้ตัวแปรนี้นำเข้าข้อมูล
				$packing=$rowsdrx["packing"];    //  UNIT_PACK ใช้ตัวแปรนี้นำเข้าข้อมูล
						
	
				// หา drugtype=2 ระบุรหัสเหตุผล EA, EB, EC, ED, EE, EF, PA
				

//---------------------ใช้ข้อมูลการรับบริการจากตาราง opday---------------------//					
		$sqlop ="select * from opday where hn ='".$hn16."' and thidate like '$datedrg%'";   //  Query เอาข้อมูลจากตาราง opday
		$resultop = mysql_query($sqlop) or die("Query opday failed");
   		$rowsop = mysql_fetch_array($resultop);	
			$personid=$rowsop["idcard"]; //  PERSON_ID ใช้ตัวแปรนี้นำเข้าข้อมูล	
			
			//CLINIC
			$clinic3=$rowsop["clinic"];
			$clinic1=0;
			$clinic2=1;
			$clinic=substr($clinic3,0,2);
			if($clinic==''){$clinic="00";} ;
			$newclinic=$clinic1.$clinic.$clinic2;  //  CLINIC ใช้ตัวแปรนี้นำเข้าข้อมูล	
						
			//SEQ
			$rowidop=$rowsop["row_id"];
			$newrowid = substr($rowidop,3,4);		
			
			$vn=$rowsop["vn"];
			$lenvn=strlen($vn);
			if($lenvn=="1"){
				$newvn="00".$vn;
			}else if($lenvn=="2"){
				$newvn="0".$vn;
			}else if($lenvn=="3"){
				$newvn=$vn;
			}
			$newseq=$newdateserv.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล		
			
									
					//---------------------ใช้ข้อมูลยาจากตาราง druglst---------------------//					
					$sqldrx= "SELECT * FROM  druglst WHERE drugcode ='".$drugcode16."' ";
					$resultdrx = mysql_query($sqldrx) or die("Query druglst failed");
					$rowsdrx=mysql_fetch_array($resultdrx);
						$code24=$rowsdrx["code24"];    //  DIDSTD ใช้ตัวแปรนี้นำเข้าข้อมูล
						//$saleprice=$rowsdrx["salepri"];    //  DRUGPRICE(ราคาขาย) ใช้ตัวแปรนี้นำเข้าข้อมูล
						$unitprice=$rowsdrx["unitpri"];    //  DRUGCOST(ราคาทุน) ใช้ตัวแปรนี้นำเข้าข้อมูล
						$unit=$rowsdrx["unit"];    //  DIDSTD ใช้ตัวแปรนี้นำเข้าข้อมูล
						$packing=$rowsdrx["packing"];    //  UNIT_PACK ใช้ตัวแปรนี้นำเข้าข้อมูล			
						

					$sql161 ="select * from  drugrx  where hn='".$hn16."' and drugcode ='".$drugcode16."' ";
					//echo $sql161."</br>";
					$result161 = mysql_query($sql161) or die("Query failed16");
					$num161= mysql_num_rows($result161);
					$rows161 = mysql_fetch_array($result161);	
						
								// ระบุรหัสเหตุผล EA, EB, EC, ED, EE, EF
								$reason161=$rows161["reason"]; 
								$reason1=substr($reason161,0,1);
								$reasondefault1 ="00";													
					
				if(($reason1 =="A" || $reason1 =="B" || $reason1 =="C" || $reason1 =="D" || $reason1 =="E" || $reason1 =="F") && $reason1 !=" "){
						$newreason1 ="E".$reason1;
			
						echo "--->
								$hcode16,
								$hn16,
								$an16,
								$newclinic,
								$personid,
								$newdcdate,
								$drugcode16,
								$drugname16,
								$amount16,
								$saleprice,
								$unitprice,
								$code24,
								$unit,
								$packing,
								$newseq,
								$newreason1,																														
								$pano,
								$totcopay,
								$use_status ,
								$total <br>";							
	
						}else{
								echo "===>
										$hcode16,
										$hn16,
										$an16,
										$newclinic, 
										$personid, 
										$newdcdate,
										$drugcode16,  drugcode
										$drugname16,  
										$amount16, 
										$saleprice, 
										$unitprice, 
										$code24, 	
										$unit, 	
										$packing, 	 
										$newseq, 	
										$reasondefault1,																								
										$pano,
										$totcopay,
										$use_status,
										$total<br>";											
						}  // if $reason					
		}  // while drugrx
}  //while opacc
?>