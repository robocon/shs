<?php
  session_start();
 $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  include("connect.inc");

//เก็บข้อมูลเตียงที่ย้าย
    $query = "SELECT * FROM bed WHERE bedcode = '$outbcode'";
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

   If ($result){
      $oBedcode=$row->bedcode;
      $oAn=$row->an;
      $oHn=$row->hn;
      $oPtname=$row->ptname;
      $oPtright=$row->ptright;
      $oDoctor=$row->doctor;
      $oAge=$row->age;
      $oAddress=$row->address;
      $oMuang=$row->muang;
      $oDate=$row->date;
      $oDiagnos=$row->diagnos;
      
      $idcard=$row->idcard;
      $food=$row->food;
      
      $cChgdate=$row->chgdate;
	  $cChgwdate=$row->chgwdate;
      $cBedname=$row->bedname;
      $cBedpri=$row->bedpri;

      $price=$row->price;
      $paid=$row->paid;
      $debt=$row->debt;
      $accno=$row->accno;
	  $cbedcode=$row->bedcode;
	  $calroom=$row->lastcalroom;
   }
   else {
      echo "ไม่พบ bedcode : $oBedcode";
   }


$sql = "Select bedpri,bedcode From bed where bedcode='$Bcode' limit 1";
$result3 = Mysql_Query($sql) or die(mysql_error());
list($Nbadpri,$bedcode) = Mysql_fetch_row($result3);
$cbedcode1=substr($cbedcode,0,2);
$bedcode1=substr($bedcode,0,2);
  echo "ห้องใหม่ $Bcode<br>"; 
  echo "ราคาห้องเดิม $cBedpri<br>"; 
   echo "ราคาห้องใหม่ $Nbadpri<br>"; 
    echo "หอเดิม $cbedcode1<br>"; 
   echo "หอใหม่ $bedcode1<br>"; 
   
echo "<br>";    

//คิดค่าบริการทางพยาบาล
/*if($cbedcode1 != $bedcode1){

//คำนวนค่าบริการทางการพยาบาล
  $chgwdate=(substr($cChgwdate,0,4)-543).substr($cChgwdate,4); //admit date or changdate
  echo "วันเริ่มนอนป่วย  $chgdate<br>"; 
  $date2=date("Y-m-d H:i:s");  //discharge date 
  echo "วันย้าย  $date2<br>"; 
  //$date1=("2003-08-30 08:30:20");//admit
  //$date2=("2003-09-10 08:30:20");//discharge
   $s = strtotime($date2)-strtotime($chgwdate);
   echo "จำนวนวินาที $s<br>";  //seconds
   $d = intval($s/86400);   //day
   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
   echo "จำนวนวัน  $d วัน $h ชั่วโมง <br>";
   $days= $d;
   
   if ($h>12){
         $days=$d+1;
                        } 

    echo "จำนวนวันนอนทั้งสิ้น  $days วัน<br>";

//แยกค่าห้อง icu
  $oBedcode1=substr($oBedcode,0,2);
if($oBedcode1 != '44'){
      $cWcare=300;
	  $cWname="(55010)ค่าบริการพยาบาลทั่วไป (IPD)";
	
}else

	{
	    $cWcare=700;
		 $cWname="(55012 )ค่าบริการพยาบาลทั่วไป ICU";
	  }


  $cBedwcare  =$days*$cWcare;    //รวมบริการทางการพยาบาล
 

//insert into ipacc  รวมราคาห้องและอาหาร
   $stays='รวม '.$days.' วัน'; 
   $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
   echo "$cWname  $stays เป็นเงินทั้งสิ้น $cBedwcare บาท <br>";
 
   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','NCARE','WARD',' $cWname ($cbedcode) $stays',
                    '$days','$cBedwcare','$sOfficer','NCARE','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
// 	    echo mysql_errno() . ": " . mysql_error(). "\n";
//	    echo "<br>";

    $query1 = "UPDATE bed SET chgwdate='$Thidate' WHERE bedcode='$Bcode';";
  $result = mysql_query($query1) or die("insert data to bed fail");
 echo"คิดค่าบริการทางการพยาบาล";
 echo"$query1";
//จบคำนวนค่าบริการทางการพยาบาล
 
}
else
//ค่าห้องเท่ากัน
{

  $oBedcode1=substr($oBedcode,0,2);
if($oBedcode1 != '44'){
      $cWcare=300;
	  $cWname="(55010)ค่าบริการพยาบาลทั่วไป (IPD)";
	
}else

	{
	    $cWcare=700;
		 $cWname="(55012 )ค่าบริการพยาบาลทั่วไป ICU";
	  }

$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','NCARE','WARD','$cWname($cbedcode)$stays',
                    '0','0','$sOfficer','NCARE','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");

  $query1= "UPDATE bed SET chgwdate='$cChgwdate' WHERE bedcode='$Bcode';";
  $result = mysql_query($query1) or die("insert data to bed fail");
 echo"ไม่คิดค่าบริการทางการพยาบาล";
 echo"$query1";
}




//คิดค่าห้อง/ค่าอาหาร

if($cBedpri != $Nbadpriand){

//คำนวนค่าห้อง
  $chgdate=(substr($cChgdate,0,4)-543).substr($cChgdate,4); //admit date or changdate
  echo "วันเริ่มนอนป่วย  $chgdate<br>"; 
  $date2=date("Y-m-d H:i:s");  //discharge date 
  echo "วันย้าย  $date2<br>"; 
  //$date1=("2003-08-30 08:30:20");//admit
  //$date2=("2003-09-10 08:30:20");//discharge
   $s = strtotime($date2)-strtotime($chgdate);
   echo "จำนวนวินาที $s<br>";  //seconds
   $d = intval($s/86400);   //day
   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
   echo "จำนวนวัน  $d วัน $h ชั่วโมง <br>";
   $days= $d;
   
   if ($h>12){
         $days=$d+1;
                        } 

    echo "จำนวนวันนอนทั้งสิ้น  $days วัน<br>";

$sql = "Select my_food From ipcard where an = '$oAn' limit 1";
$result2 = Mysql_Query($sql) or die(mysql_error());
list($myfood) = Mysql_fetch_row($result2);

//แยกค่าห้อง icu
  $oBedcode1=substr($oBedcode,0,2);
if($oBedcode1 != '44'){
  if ($cBedpri>$myfood){
      $cNBedpri=$cBedpri-$myfood;
      $cYBedpri=$cBedpri-$cNBedpri;

	       }
  else {
      $cNBedpri=0;
      $cYBedpri=$cBedpri;
	 
           }
}else

	{
		$cNBedpri=0;
      $cYBedpri=$cBedpri;

	  }


  $cBedfood  =$days*$cBedpri;    //รวมราคาห้องและอาหารทั้งสิ้น
  $cYBedfood=$days*$cYBedpri; //รวมราคาห้องและอาหารที่เบิกได้
  $cNBedfood=$days*$cNBedpri; //รวมราคาห้องและอาหารที่เบิกไม่ได้

//insert into ipacc  รวมราคาห้องและอาหาร
   $stays='รวม '.$days.' วัน'; 
   $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
   echo "$cBedname $stays เป็นเงินทั้งสิ้น $cBedfood บาท <br>";
   echo "ค่าห้องส่วนที่เบิกได้ $cYBedpri บาทต่อวัน  $stays  เป็นเงิน $cYBedfood บาท<br>";
   echo "ค่าห้องส่วนเกิน $cNBedpri บาทต่อวัน $stays  เป็นเงิน $cNBedfood บาท<br><br>";




   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','BFY','WARD','$cBedname ($cbedcode) $stays',
                    '$days','$cYBedfood','$sOfficer','BFY','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
// 	    echo mysql_errno() . ": " . mysql_error(). "\n";
//	    echo "<br>";

   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','BFN','WARD','ค่าห้องส่วนเกิน $cNBedpri บาท $stays',
                    '$days','$cNBedfood','$sOfficer','BFN','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
//จบคำนวนค่าห้อง*/
/////คำนวนวันสุดท้าย
 
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
		$chgdate=(substr($calroom,0,4)-543).substr($calroom,4); //วันนอน
		$datenow=date("Y-m-d H:i:s"); //วันนี้
		$s = strtotime($datenow)-strtotime($chgdate);
		//echo $s."<br>";
		$d = intval($s/86400);   //day
	    $s -= $d*86400;
	    $h  = intval($s/3600);    //hour
	   	echo "จำนวนวัน  $d วัน $h ชั่วโมง &nbsp;&nbsp;";
		echo "<br>"; 
		$dayslast= $d;
  		if ($h>=12){
         	$dayslast=$d+1;
		} 
		//echo $dayslast;
	//if($dayslast>=0){
		if($dayslast<0){
			$dayslast=0;
		}
		$query3 = "Select my_food,doctor,diag From ipcard where an = '$oAn' limit 1";
		$result3 = Mysql_Query($query3) or die(mysql_error());
		list($myfood,$doctor,$diag) = Mysql_fetch_row($result3);
		
		
		$oBedcode1=substr($cbedcode,0,2);
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
		  $cBedfood  =$dayslast*$cBedpri;    //รวมราคาห้องและอาหารทั้งสิ้น
		  $cYBedfood=$dayslast*$cYBedpri; //รวมราคาห้องและอาหารที่เบิกได้
		  $cNBedfood=$dayslast*$cNBedpri; //รวมราคาห้องและอาหารที่เบิกไม่ได้
		  
		  $stays='รวม '.$dayslast.' วัน'; 
		  if($oBedcode1 != '44'){
			  $cWcare=300;
			  $cWname="(55010)ค่าบริการพยาบาลทั่วไป (IPD)";
		  }else{
				$cWcare=700;
				$cWname="(55012 )ค่าบริการพยาบาลทั่วไป ICU";
		  }
		  $cBedwcare  =$dayslast*$cWcare;  //รวมค่าบริการทางพยาบาล
		  /////////
		////ตัวแปรเตียงเก่า
		/*$oBedcode=$row->bedcode;
      $oAn=$row->an;
      $oHn=$row->hn;
      $oPtname=$row->ptname;
      $oPtright=$row->ptright;
      $oDoctor=$row->doctor;
      $oAge=$row->age;
      $oAddress=$row->address;
      $oMuang=$row->muang;
      $oDate=$row->date;
      $oDiagnos=$row->diagnos;
      
      $idcard=$row->idcard;
      $food=$row->food;
      
      $cChgdate=$row->chgdate;
	  $cChgwdate=$row->chgwdate;
      $cBedname=$row->bedname;
      $cBedpri=$row->bedpri;

      $price=$row->price;
      $paid=$row->paid;
      $debt=$row->debt;
      $accno=$row->accno;
	  $cbedcode=$row->bedcode;
	  $calroom=$row->lastcalroom;*/
	  /////////////////
//ค่าห้องที่เบิกได้ depart	
			$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$oPtname','$oHn','$oAn','$oDoctor','WARD','2','$cBedname (เฉพาะที่เบิกได้) $stays','$cYBedfood','คอมพิวเตอร์','$diag','$accno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into depart");
			$idno=mysql_insert_id();
//ค่าห้องที่เบิกได้ patdata
			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$oHn','$oAn','$oPtname','$oDoctor','2','BFY','$cBedname (เฉพาะที่เบิกได้) $stays','$dayslast','$cYBedfood','WARD','BFY','$idno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
//ค่าบริการทางพยาบาล
			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$oAn','NCARE','WARD','$cWname(ย้ายเตียง)','$dayslast','$cBedwcare','คอมพิวเตอร์','NCARE','$accno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc2");
//ค่าห้องที่เบิกได้ ipacc	
			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$oAn','BFY','WARD','$cBedname ($oBedcode)(ย้ายเตียง) $stays','$dayslast','$cYBedfood','คอมพิวเตอร์','BFY','$accno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
//ค่าห้องส่วนเกิน dapart
			$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$oPtname','$oHn','$oAn','$oDoctor','WARD','2','ค่าห้องส่วนเกิน $cNBedpri บาท(ย้ายเตียง) $stays','$cNBedfood','คอมพิวเตอร์','$diag','$accno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into depart");
			$idno=mysql_insert_id();
//ค่าห้องส่วนเกิน patdata
   			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$oHn','$oAn','$oPtname','$oDoctor','2','BFN','ค่าห้องส่วนเกิน $cNBedpri บาท(ย้ายเตียง) $stays','$dayslast','$cNBedfood','WARD','BFN','$idno');";
			//echo $query."<br>";
  			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
//ค่าห้องส่วนเกิน ipacc
   			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$oAn','BFN','WARD','ค่าห้องส่วนเกิน $cNBedpri บาท(ย้ายเตียง) $stays','$dayslast','$cNBedfood','คอมพิวเตอร์','BFN','$accno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc1");

	//	}
//ย้ายออกจากเตียงเก่า(ลบข้อมูล)
  $sql = "UPDATE bed SET ptname='',age='',idcard='',address='',muang='',ptright='',doctor='',date='',
           hn='',an='',diagnos='',price=0,paid=0,debt=0,food='',officer='',
           chgdate=now(),accno=1,lastcalroom='0000-00-00 00:00:00' WHERE bedcode='$oBedcode';";
  $result = mysql_query($sql) or die("erase bed fail");
		 //echo $sql;

//ย้ายเข้าเตียงใหม่  
if($dayslast>0){
	/*
	$daytime =explode(" ",$lastcalroom);
			$timeadmit = $daytime[1]; //เอาเวลาที่ admit ออกมาก่อน
			$caldate =explode("-",$daytime[0]); //ตัดเอาวันที่ในเบสออกมาเพื่อไปทำ mktime
			$tomorrow = mktime(0,0,0,$caldate[1],($caldate[2]+$days),($caldate[0]-543)); 
			$calroom = date("Y-m-d",$tomorrow);
			$cutmonn = explode("-",$calroom); //ทำmktimeเสดแล้ว ตัดแยกออกมาบวกเป็นพ.ศ.
			$daycalroom = ($cutmonn[0]+543)."-".$cutmonn[1]."-".$cutmonn[2]." ".$timeadmit;
	*/
	$monn = explode(" ",$calroom);
	$timeadmit=$monn[1];
	$caldate =explode("-",$monn[0]);
	$tomorrow = mktime(0,0,0,$caldate[1],($caldate[2]+$dayslast),($caldate[0]-543)); 
	$calroom = date("Y-m-d",$tomorrow);
	$cutmonn = explode("-",$calroom);
	$calroom4 = ($cutmonn[0]+543)."-".$cutmonn[1]."-".$cutmonn[2]." ".$timeadmit;
	//echo $calroom4;
}else{
	$calroom4=$calroom;
}

  $sql = "UPDATE bed SET ptname='$oPtname',age='$oAge',idcard='$idcard',address='$oAddress',
              muang='$oMuang',ptright='$oPtright',doctor='$oDoctor',date='$oDate',
           hn='$oHn',an='$oAn',diagnos='$oDiagnos',price='$price',paid='$paid',debt='$debt',food='$food',officer='',
           chgdate='$Thidate',accno='$accno',lastcalroom='$calroom4' WHERE bedcode='$Bcode';";
  $result = mysql_query($sql) or die("insert data to bed fail");
		 //echo $sql;
		 
		
		 ///////  ward_log /////////
		 
		 if($bedcode1=='42'){
			 $wname='หอผู้ป่วยรวม';
			// $old=$wname.'/'.$Bedcode;	
			// $new=$wname.'/'.$cbedcode;	
		 }elseif($bedcode1=='43'){
			 $wname='หอผู้ป่วยสูติ';
			// $old=$wname.'/'.$cbedcode;	
			// $new=$wname.'/'.$Bcode;	
		 }elseif($bedcode1=='44'){
			$wname='หอผู้ป่วยICU';
			// $old=$wname.'/'.$cbedcode;	
			// $new=$wname.'/'.$Bcode;
		 }elseif($bedcode1=='45'){
			 $wname='หอผู้ป่วยพิเศษ';
			// $old=$wname.'/'.$cbedcode;	
			// $new=$wname.'/'.$Bcode;		
		 }
		 

	if($cbedcode1==$bedcode1){
		$chgcode="Bed";	
	}else{
		$chgcode="Ward";	
	}	 
  $sOfficer=$_SESSION["sOfficer"];
  

 $sql_ward="INSERT INTO `ward_log` ( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` , day ,  `lastcall` , `office` ) VALUES ( '".$Thidate."', '".$oAn."', '".$oHn."', '".$wname."', '".$Bcode."','".$chgcode."', '".$cbedcode."', '".$Bcode."', '".$dayslast."', '".$calroom4."',  '".$sOfficer."')";
  $result_ward = mysql_query($sql_ward)or die(mysql_error());
		 
		 
		 ////////////////////////////

  	if(!$result){
           echo "clear bed fail";
           echo mysql_errno() . ": " . mysql_error(). "\n";
           echo "<br>";
    }
  	else{
          print "ย้ายผู้ป่วยเรียบร้อย <br>";
		   print "กรุณารอสักครู่ .............ระบบจะปิดหน้าต่างอัตโนมัติ <br>";
          //print "ปิดหน้าต่างนี้  และRefresh หน้าต่างหอผู้ป่วย<br>";
          //print "เพื่อ update ข้อมูล";
 	}



//}
/*else
//ค่าห้องเท่ากัน
{

$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','BFY','WARD','$cBedname($cbedcode)$stays',
                    '0','0','$sOfficer','BFY','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
// 	    echo mysql_errno() . ": " . mysql_error(). "\n";
//	    echo "<br>";

   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','BFN','WARD','ค่าห้องส่วนเกิน $cNBedpri บาท $stays',
                    '0','0','$sOfficer','BFN','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
*/
//ย้ายออกจากเตียงเก่า(ลบข้อมูล)

/*  $sql = "UPDATE bed SET ptname='',age='',idcard='',address='',muang='',ptright='',doctor='',date='',
           hn='',an='',diagnos='',price=0,paid=0,debt=0,food='',officer='',
           chgdate=now(),accno=1 WHERE bedcode='$oBedcode';";
  $result = mysql_query($sql)
         or die("erase bed fail");

//ย้ายเข้าเตียงใหม่  
  $sql = "UPDATE bed SET ptname='$oPtname',age='$oAge',idcard='$idcard',address='$oAddress',
              muang='$oMuang',ptright='$oPtright',doctor='$oDoctor',date='$oDate',
           hn='$oHn',an='$oAn',diagnos='$oDiagnos',price='$price',paid='$paid',debt='$debt',food='$food',officer='',
           accno='$accno' WHERE bedcode='$Bcode';";
  $result = mysql_query($sql)
         or die("insert data to bed fail");






  If (!$result){
           echo "clear bed fail";
           echo mysql_errno() . ": " . mysql_error(). "\n";
           echo "<br>";
                   }
  else {
          print "ย้ายผู้ป่วยเรียบร้อย <br>";
          print "ปิดหน้าต่างนี้  และRefresh หน้าต่างหอผู้ป่วย<br>";
          print "เพื่อ update ข้อมูล";
         }

}*/ 


$rward = substr($Bcode,0,2);
			if($rward=='41'){
				//echo "<a href='mward.php'>กลับหน้า ward</a>";
				$linkward="allward.php?code=41";
			}elseif($rward=='42'){
				//echo "<a href='fward.php'>กลับหน้า ward</a>";
				$linkward="allward.php?code=42";
			}elseif($rward=='43'){
				//echo "<a href='gward.php'>กลับหน้า ward</a>";
				$linkward="allward.php?code=43";
			}elseif($rward=='44'){
			//	echo "<a href='icuward.php'>กลับหน้า ward</a>";
				$linkward="allward.php?code=44";
			}elseif($rward=='45'){
				//echo "<a href='vipward.php'>กลับหน้า ward</a>";
				$linkward="allward.php?code=45";
			}
			
  session_unregister("Bcode");
  
  ?>
  <script>
setTimeout("window.opener.location.href='<?=$linkward;?>';window.close()",5000);
//setTimeout("window.close()",1000);
</script>
  <?

   include("unconnect.inc");
//  session_destroy();
 
?>
