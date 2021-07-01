<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?
	session_start();
	include("connect.inc");
	///$bbbbcode มาจากหน้า ward
 	$query1 = "SELECT bed,date, ptname, an, hn, caldate, bedname, bedcode, status, c19status FROM bed WHERE bedcode LIKE  '$bbbbcode%' and an!='' ";
	//echo $query1;
  	$result1 = mysql_query($query1);
 	while(list($bed,$date,$ptname,$an,$hn,$caldate,$bedname,$bedcode,$status,$c19status)=Mysql_fetch_row($result1)){
		$query2 = "SELECT lastcalroom,accno,bedpri,date FROM bed WHERE bedcode = '$bedcode'";
		//echo $query2."<br>";
		$result2 = mysql_query($query2);
		list($lastcalroom,$cAccno,$cBedpri,$datestart)=mysql_fetch_row($result2);
		//echo "$hn ".$date2."<br>";
		$chgdate=(substr($lastcalroom,0,4)-543).substr($lastcalroom,4); //วันนอน
		$datenow=date("Y-m-d H:i:s"); //วันนี้
		$s = strtotime($datenow)-strtotime($chgdate);
		//echo $s."<br>";
		$d = intval($s/86400);   //day
	    $s -= $d*86400;
	    $h  = intval($s/3600);    //hour
	    //echo "จำนวนวัน  $d วัน $h ชั่วโมง &nbsp;&nbsp;";
	    $days= $d;

		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
		
		//หาวันนอนรวม
			$chgdatesall=(substr($datestart,0,4)-543).substr($datestart,4); //วันนอน
		$datenow=date("Y-m-d H:i:s"); //วันนี้
		$sallstart = strtotime($datenow)-strtotime($chgdatesall);
		//echo $s."<br>";
		$dallstart = intval($sallstart/86400);   //day
	    $sallstart -= $dallstart*86400;
	    $hallstart  = intval($sallstart/3600);    //hour
	    //echo "จำนวนวัน  $d วัน $h ชั่วโมง &nbsp;&nbsp;";
	    $daysallstart= $dallstart;
		
		
		$query5 = "update bed SET days ='$daysallstart' where bedcode = '$bedcode'";
				$result5 = mysql_query($query5) or die("Query failed,cannot update beddays");
				
		
		$query3 = "Select my_food,doctor,diag,dcdate From ipcard where an = '$an' limit 1";
		$result3 = Mysql_Query($query3) or die(mysql_error());
		list($myfood,$doctor,$diag,$dcdate) = Mysql_fetch_row($result3);
		
		if($dcdate=="0000-00-00 00:00:00"){
			if($days>0){
			
			$oBedcode1=substr($bedcode,0,2);
			if($oBedcode1 != '44'){
			  if($cBedpri>$myfood){
					$cNBedpri=$cBedpri-$myfood;
					$cYBedpri=$cBedpri-$cNBedpri;
			  }
			  else {
					$cNBedpri=0;
					$cYBedpri=$cBedpri;
			  }
			}else{
				$cNBedpri=0;
				$cYBedpri=$cBedpri;
			}
			//echo "เบิกได้ $cYBedpri1<br>";
			//echo "เบิกไม่ได้ $cNBedpri1<br>";
			  $cBedfood  =$days*$cBedpri;    //รวมราคาห้องและอาหารทั้งสิ้น
			  $cYBedfood=$days*$cYBedpri; //รวมราคาห้องและอาหารที่เบิกได้
			  $cNBedfood=$days*$cNBedpri; //รวมราคาห้องและอาหารที่เบิกไม่ได้
			  
			  $stays='รวม '.$days.' วัน'; 
			  if($oBedcode1 != '44'){
				  $cWcare=300;
				  $cWname="(55010)ค่าบริการพยาบาลทั่วไป (IPD)";
			  }else{
					$cWcare=700;
					$cWname="(55012 )ค่าบริการพยาบาลทั่วไป ICU";
			  }
			  $cBedwcare  =$days*$cWcare;  //รวมค่าบริการทางพยาบาล
			  /////////
			  

			//   $diag = htmlspecialchars($diag, ENT_QUOTES);
			$diag = str_replace("'", ' ', $diag);

			if($c19status!='y')
			{
			
	//ค่าห้องที่เบิกได้ depart	
				$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$ptname','$hn','$an','$doctor','WARD','2','$bedname (เฉพาะที่เบิกได้) $stays','$cYBedfood','คอมพิวเตอร์','$diag','$cAccno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into depart in page calroom");
				$idno=mysql_insert_id();
	//ค่าห้องที่เบิกได้ patdata
				$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$hn','$an','$ptname','$doctor','2','BFY','$bedname (เฉพาะที่เบิกได้) $stays','$days','$cYBedfood','WARD','BFY','$idno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata in page calroom");
	//ค่าบริการทางพยาบาล
				$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$an','NCARE','WARD','$cWname','$days','$cBedwcare','คอมพิวเตอร์','NCARE','$cAccno','$idno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into ipacc2 in page calroom");
	//ค่าห้องที่เบิกได้ ipacc	
				$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$an','BFY','WARD','$bedname ($bedcode) $stays','$days','$cYBedfood','คอมพิวเตอร์','BFY','$cAccno','$idno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into ipacc in page calroom");
	//ค่าห้องส่วนเกิน dapart
				$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$ptname','$hn','$an','$doctor','WARD','2','ค่าห้องส่วนเกิน $cNBedpri บาท $stays','$cNBedfood','คอมพิวเตอร์','$diag','$cAccno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into depart in page calroom");
				$idno=mysql_insert_id();
	//ค่าห้องส่วนเกิน patdata
				$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$hn','$an','$ptname','$doctor','2','BFN','ค่าห้องส่วนเกิน $cNBedpri บาท $stays','$days','$cNBedfood','WARD','BFN','$idno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata in page calroom");
	//ค่าห้องส่วนเกิน ipacc
				$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$an','BFN','WARD','ค่าห้องส่วนเกิน $cNBedpri บาท $stays','$days','$cNBedfood','คอมพิวเตอร์','BFN','$cAccno','$idno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into ipacc1 in page calroom");
			}

				$daytime =explode(" ",$lastcalroom);
				$timeadmit = $daytime[1]; //เอาเวลาที่ admit ออกมาก่อน
				$caldate =explode("-",$daytime[0]); //ตัดเอาวันที่ในเบสออกมาเพื่อไปทำ mktime
				$tomorrow = mktime(0,0,0,$caldate[1],($caldate[2]+$days),($caldate[0]-543)); 
				$calroom = date("Y-m-d",$tomorrow);
				$cutmonn = explode("-",$calroom); //ทำmktimeเสดแล้ว ตัดแยกออกมาบวกเป็นพ.ศ.
				$daycalroom = ($cutmonn[0]+543)."-".$cutmonn[1]."-".$cutmonn[2]." ".$timeadmit;
				
				
				//$daycalroom= $caldate[0]."-".$caldate[1]."-".($caldate[2]+$days)." ".$timeadmit;
				//echo $daycalroom;
				//$daycalroom = (date("Y")+543).date("-m-d ").$timeadmit;
				$query4 = "update bed SET lastcalroom ='$daycalroom',days ='$daysallstart' where bedcode = '$bedcode'";
				$result4 = mysql_query($query4) or die("Query failed,cannot update bed in page calroom");
				
			} // end day > 0 


			if($c19status=='y' && $oBedcode1 == '42')
			{
				$shortThDate = (date("Y")+543).date("-m-d");
				// ในวันนี้มีการเพิ่มไปแล้วรึยัง
				$sql = "SELECT `row_id` FROM `ipacc` WHERE `date` LIKE '$shortThDate%' AND `an` = '$an' AND `code` = '21401' LIMIT 1";
				$q_ipacc = mysql_query($sql);
				if(mysql_num_rows($q_ipacc) == 0) // ถ้ายังไม่ได้เพิ่ม
				{
					//ค่าห้องที่เบิกได้ depart	
					$query = "INSERT INTO `depart`(`date`,`ptname`,`hn`,`an`,`doctor`,`depart`,`item`,`detail`,`price`,`idname`,`diag`,`accno`)
					VALUES
					('$Thidate','$ptname','$hn','$an','$doctor','WARD','1','ค่าห้องควบคุมผู้ป่วย COVID ใน รพ.','2500','คอมพิวเตอร์','$diag','$cAccno');";
					$result = mysql_query($query) or die(mysql_error().$query);
					$idno=mysql_insert_id();

					//ค่าห้องที่เบิกได้ patdata
					$query = "INSERT INTO `patdata`(`date`,`hn`,`an`,`ptname`,`doctor`,`item`,`code`,`detail`,`amount`,`price`,`depart`,`part`,`idno`) 
					VALUES
					('$Thidate','$hn','$an','$ptname','$doctor','2','BFY','ค่าห้องควบคุมผู้ป่วย COVID ใน รพ.','$days','2500','WARD','BFY','$idno');";
					$result = mysql_query($query) or die(mysql_error().$query);

					//ค่าบริการทางพยาบาล
					$query = "INSERT INTO `ipacc`(`date`,`an`,`code`,`depart`,`detail`,`amount`,`price`,`idname`,`part`,`accno`,`idno`)
					VALUES
					('$Thidate','$an','21401','WARD','ค่าห้องควบคุมผู้ป่วย COVID ใน รพ.','$days','2500','คอมพิวเตอร์','BFY','$cAccno','$idno');";
					$result = mysql_query($query) or die(mysql_error().$query);
					
					// ค่าบริการพยาบาลทั่วไป
					$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$an','NCARE','WARD','(55010)ค่าบริการพยาบาลทั่วไป (IPD)','1','300','คอมพิวเตอร์','NCARE','$cAccno','$idno');";
					$result = mysql_query($query) or die(mysql_error().$query);
				}

				

			}

		} // end dcdate == '0000-00-00 00:00:00'
	}
	
?>
</body>
</html>