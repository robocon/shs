<?php
session_start();
$sOfficer=$_SESSION["sOfficer"];

include("class_file/class_refer.php");
$obj = New refer();

include("connect.inc");
$thidate = (date("Y")+543).date("-m-d H:i:s"); 

$cAn = $_POST["cAn"];
$cHn = $_POST["cHn"];
$dctype_code = substr($_POST["dctype"],0,1);

//เก็บข้อมูลหากคนไข้ Refer
$get_refer_no = false;
if($dctype_code == "4"){
			
	$obj->sethn($cHn);
	$obj->setan($cAn);

	if($_POST["hospital1"] != ""){
		$_POST["hospital"] = $_POST["hospital1"];
	}

	$obj->setreferh("", $_POST["hospital"]);
	$obj->setlist_type_patient($_POST["list_type_patient"]);

	$obj->setorgan($_POST["organ"]);
	$obj->setmaintenance($_POST["maintenance"]);

	$obj->setrefertype("2 ส่งต่อ");
	$obj->setdateopd($thidate);
	$obj->setpttype($_POST["pttype"]);
	$obj->setdiag($_POST["diag"]);
	$obj->setexrefer($_POST["exrefer"],$_POST["exrefer2"]);
	$obj->setrefercar($_POST["refercar"]);
	$obj->setoffice($_SESSION["sOfficer"]);
	$obj->setdoctor($_POST["doctor"]);
	$obj->setward("Ward".$cBedcode);
	$obj->settype_woud($_POST["list_ptright"]);
	$obj->settime_refer($_POST["time_refer"]);
	$obj->setproblem_refer($_POST["problem_refer"]);
	$obj->set_doc_refer($_POST["doc_refer"]);
	$obj->set_nurse($_POST["nurse"]);
	$obj->set_assistant_nurse($_POST["assistant_nurse"]);
	$obj->set_estimate($_POST["estimate"]);
	$obj->set_no_estimate($_POST["no_estimate"]);
	$obj->set_cradle ($_POST["cradle"]);
	$obj->set_doc_txt($_POST["doc_txt"]);
	$obj->set_suggestion($_POST["suggestion"]);
	$obj->set_targe($_POST["targe"]);
	$obj->inserttb();

	$get_refer_no = $obj->get_refer_no();
}

/*
ค่าเตียงสามัญและค่าอาหาร ไม่เกินวันละ 200 บาท
ค่าห้องและค่าอาหาร ไม่เกินวันละ600 บาท
ถ้านับได้เกิน 6 ชม. ถือเป็น 1 วัน

กรณีตายหรือreferวันแรก นับได้ไม่เกิน 6 ชม.เบิกได้ดังนี้
ค่าเตียงสามัญและค่าอาหาร ไม่เกินวันละ 100 บาท
ค่าห้องและค่าอาหาร ไม่เกินวันละ200 บาท

ลงเวลา admit discharge ให้ชัดเจน
*/
	$date1=$cDate;  //admit date
	$date1=(substr($cDate,0,4)-543).substr($cDate,4); //admit date

  	//$chgdate=(substr($cChgdate,0,4)-543).substr($cChgdate,4); //admit date or changdate

  //echo "วันรับป่วย  $date1<br>"; 
  	$date2=date("Y-m-d H:i:s");  //discharge date 
  //echo "วันจำหน่าย  $date2<br>"; 
  //$date1=("2003-08-30 08:30:20");//admit
  //$date2=("2003-09-10 08:30:20");//discharge

//นอนก่อนจำหน่าย
   $s = strtotime($date2)-strtotime($date1);
 // echo "จำนวนวินาที $s<br>";  //seconds
   $d = intval($s/86400);   //day

   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
  // echo "จำนวนวัน  $d วัน $h ชั่วโมง<br>";

   $daysall= $d;
   if ($h>6){
         $daysall=$d+1;
    }      
		//$daysall จำนวนวันนอนทั้งหมด 
    
//นอนรวม
/*
   $s1 = strtotime($date2)-strtotime($date1);
 //  echo "จำนวนวินาทีรวม $s1<br>";  //seconds
   $d1 = intval($s1/86400);   //day

   $s1 -= $d1*86400;
   $h1  = intval($s1/3600);    //hour
   echo "จำนวนวันรวม  $d1 วัน $h1 ชั่วโมง<br>";

   $days1= $d1;
   if ($h1>6){
         $days1=$d1+1;
                        }    
 $chgwdate=(substr($cChgwdate,0,4)-543).substr($cChgwdate,4); //admit date or changdate
//บริการก่อนจำหน่าย
 $s2 = strtotime($date2)-strtotime($chgwdate);
   echo "จำนวนวินาที $s<br>";  //seconds
   $d2 = intval($s2/86400);   //day

   $s2 -= $d2*86400;
   $h2  = intval($s2/3600);    //hour
   echo "จำนวนวัน  $d2 วัน $h2 ชั่วโมง<br>";

   $days2= $d2;
   if ($h2>6){
         $days2=$d2+1;
                        }      
    echo "จำนวนวันคิดค่าบริการ $days2 วัน<br>";
    echo "จำนวนวันนอน $days วัน<br>";
    echo "ลากลับบ้าน $absent วัน<br>";
    $days=$days-$absent;
    echo "จำนวนวันนอนทั้งสิ้น $days วัน <br>";
	    echo "จำนวนวันนอนรวม $days1 วัน <br><br>";
/////คอมเม้นเก่า/////
   if ($hours>=1 && $hours<=6 ){
	if ($cBedpri=200){
		$Bfprice=100;
		            }
	if ($cBedpri>200){
	                $Bfprice=200;
		           }
	  		}
  $cBedfood=($days*$bedpri)+$Bfprice; //รวมราคาห้องและอาหาร
/////เก่า/////

		$sql = "Select my_food From ipcard where an = '$cAn' limit 1";
$result2 = Mysql_Query($sql) or die(mysql_error());
list($myfood) = Mysql_fetch_row($result2);

   $oBedcode1=substr($cBedcode,0,2);
    echo "หอผู้ป่วยจำหน่าย $oBedcode1<br>";
	 echo "ราคาเตียงจำหน่าย $cBedpri<br>";
	  echo "เบิกได้ $myfood<br>";


  if ($cBedpri>$myfood){
      $cNBedpri1=$cBedpri1-$myfood;
      $cYBedpri1=$cBedpri1-$cNBedpri1;
	       }
  else {
      $cNBedpri1=0;
      $cYBedpri1=$cBedpri1;
           }

  echo "เบิกได้ $cYBedpri1<br>";
    echo "เบิกไม่ได้ $cNBedpri1<br>";

  $cYBedfood1=$days*$cYBedpri1; //รวมราคาห้องและอาหารที่เบิกได้
  $cNBedfood1=$days*$cNBedpri1; //รวมราคาห้องและอาหารที่เบิกไม่ได


	 
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

 echo "เบิกได้ $cYBedpri1<br>";
    echo "เบิกไม่ได้ $cNBedpri1<br>";
	
	
  $cBedfood  =$days*$cBedpri;    //รวมราคาห้องและอาหารทั้งสิ้น
  $cYBedfood=$days*$cYBedpri; //รวมราคาห้องและอาหารที่เบิกได้
  $cNBedfood=$days*$cNBedpri; //รวมราคาห้องและอาหารที่เบิกไม่ได้

*/
/////คำนวนวันสุดท้าย
		//echo $clastcal;
		$query = "SELECT lastcalroom FROM bed WHERE bedcode = '$cBedcode'";
    	$result = mysql_query($query) or die("Query failed");
		list($lastcalroom) = mysql_fetch_array($result);
		
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
		$caldate=(substr($lastcalroom,0,4)-543).substr($lastcalroom,4); //วันนอน
		
		$s = strtotime($date2)-strtotime($caldate);
		//echo $s."<br>";
		$d = intval($s/86400);   //day
	    $s -= $d*86400;
	    $h  = intval($s/3600);    //hour
	   //echo "จำนวนวัน  $d วัน $h ชั่วโมง &nbsp;&nbsp;";
		$dayslast= $d;
  		if ($h>6){
         	$dayslast=$d+1;
		} 
		//echo $h;
		//echo $dayslast;
		$query3 = "Select my_food,doctor,diag From ipcard where an = '$cAn' limit 1";
		$result3 = Mysql_Query($query3) or die(mysql_error());
		list($myfood,$doctor,$diag) = Mysql_fetch_row($result3);
		
		$oBedcode1=substr($cBedcode,0,2);
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
		 if($oBedcode1=="42") $dcward = "หอผู้ป่วยรวม"; 
		 elseif($oBedcode1=="43") $dcward = "หอผู้ป่วยสูตินรี"; 
		 elseif($oBedcode1=="44") $dcward = "หอผู้ป่วยหนัก"; 
		 elseif($oBedcode1=="41") $dcward = "หอผู้ป่วยชาย"; 
		 elseif($oBedcode1=="45") $dcward = "หอผู้ป่วยพิเศษ"; 
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
		  
//ค่าห้องที่เบิกได้ depart	
			$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','WARD','2','$cBedname (เฉพาะที่เบิกได้) $stays','$cYBedfood','$sOfficer','$diag','$cAccno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into depart");
			$idno=mysql_insert_id();
//ค่าห้องที่เบิกได้ patdata
			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','2','BFY','$cBedname (เฉพาะที่เบิกได้) $stays','$dayslast','$cYBedfood','WARD','BFY','$idno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
//ค่าบริการทางพยาบาล
			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$cAn','NCARE','WARD','$cWname(จำหน่าย)','$dayslast','$cBedwcare','$sOfficer','NCARE','$cAccno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc2");
//ค่าห้องที่เบิกได้ ipacc	
			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$cAn','BFY','WARD','$cBedname ($cBedcode)(จำหน่าย) $stays','$dayslast','$cYBedfood','$sOfficer','BFY','$cAccno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
//ค่าห้องส่วนเกิน dapart
			$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','WARD','2','ค่าห้องส่วนเกิน $cNBedpri บาท(จำหน่าย) $stays','$cNBedfood','$sOfficer','$diag','$cAccno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into depart");
			$idno=mysql_insert_id();
//ค่าห้องส่วนเกิน patdata
   			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','2','BFN','ค่าห้องส่วนเกิน $cNBedpri บาท(จำหน่าย) $stays','$dayslast','$cNBedfood','WARD','BFN','$idno');";
			//echo $query."<br>";
  			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
//ค่าห้องส่วนเกิน ipacc
   			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$cAn','BFN','WARD','ค่าห้องส่วนเกิน $cNBedpri บาท(จำหน่าย) $stays','$dayslast','$cNBedfood','$sOfficer','BFN','$cAccno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc1");

		
		//echo "จำนวนวัน  $d วัน $h ชั่วโมง &nbsp;&nbsp;";

//ลบออกจากเตียงเก่า(ลบข้อมูล)
  $sql = "UPDATE bed SET ptname='',age='',idcard='',address='',muang='',ptright='',doctor='',date='',
           hn='',an='',diagnos='',price=0,paid=0,debt=0,food='',diag1='',officer='',
           chgdate=now(),accno=1,lastcalroom='0000-00-00 00:00:00' WHERE bedcode='$Bedcode';";
  $result = mysql_query($sql) or die("erase bed fail");

//รวมราคาห้องและอาหาร(เบิกได้)
   //$stays='รวม '.$days.' วัน'; 
  // $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
/*
//insert data into depart
   $query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,
                    idname,diag,accno)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','WARD','2','$cBedname (เฉพาะที่เบิกได้) $stays',
                    '$cYBedfood','$sOfficer','$cDiag','$cAccno');";
   $result = mysql_query($query) or die("Query failed,cannot insert into depart");
   $idno=mysql_insert_id();



//insert data into patdata
                $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','2','BFY','$cBedname (เฉพาะที่เบิกได้) $stays','$days',
                                 '$cYBedfood','WARD','BFY','$idno');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");

 

$oBedcode1=substr($cBedcode,0,2);
if($oBedcode1 != '44'){
      $cWcare=300;
	  $cWname="(55010)ค่าบริการพยาบาลทั่วไป (IPD)";
	
}else

	{
	    $cWcare=700;
		 $cWname="(55012 )ค่าบริการพยาบาลทั่วไป ICU";
	}
  $cBedwcare  =$days2*$cWcare;    //รวมบริการทางการพยาบาล
$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno)VALUES('$Thidate','$cAn','NCARE','WARD','$cWname(จำหน่าย)',
                    '$days2',' $cBedwcare','$sOfficer','NCARE','$cAccno','$idno');";
   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");

  

   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno)VALUES('$Thidate','$cAn','BFY','WARD','$cBedname ($cBedcode) $stays',
                    '$days','$cYBedfood','$sOfficer','BFY','$cAccno','$idno');";
   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
// 	    echo mysql_errno() . ": " . mysql_error(). "\n";
//	    echo "<br>";

//รวมราคาห้องและอาหาร(เบิกไม่ได้)
//insert data into depart
   $query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,
                    idname,diag,accno)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','WARD','2','ค่าห้องส่วนเกิน $cNBedpri บาท $stays',
                    '$cNBedfood','$sOfficer','$cDiag','$cAccno');";
   $result = mysql_query($query) or die("Query failed,cannot insert into depart");
   $idno=mysql_insert_id();

//insert data into patdata
   $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','2','BFN','ค่าห้องส่วนเกิน $cNBedpri บาท $stays','$days',
                                 '$cNBedfood','WARD','BFN','$idno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into patdata");

//insert data into ipacc
   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno)VALUES('$Thidate','$cAn','BFN','WARD','ค่าห้องส่วนเกิน $cNBedpri บาท $stays',
                    '$days','$cNBedfood','$sOfficer','BFN','$cAccno','$idno');";
   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");*/

//begin คำนวนค่ารักษาพยาบาลและinsert data to ipcard
  $nNetprice=0;
    $nNetpaid=0;
    $query = "SELECT price,paid FROM ipacc WHERE an = '$cAn'  ";
    $result = mysql_query($query)
        or die("Query failed ipacc");
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;      
$nNetprice =$nNetprice+$row->price;
$nNetpaid = $nNetpaid+$row->paid;
		}
//end  คำนวนค่ารักษาพยาบาลและinsert data to ipcard
   $sql="UPDATE ipcard SET ptname='$cPtname',age='$cAge',ptright='$cPtright',
             bedcode='$Bedcode',days='$daysall',dcdate='$Thidate',dcstatus='1',diag='$cDiag',  
             icd10='$icd10', comorbid='$comorbid',complica='$complica',other='$other',extcause='$extcause',icd9cm='$icd9cm',
             second='$second',result='$txresult',dctype='$dctype', price='$nNetprice',paid= '$nNetpaid',calc='$Thidate',
             doctor='$cDoctor',accno='$cAccno',status_log='จำหน่าย',lastcalroom='$lastcalroom' WHERE an='$cAn';"; 
  $result = mysql_query($sql) or die("insert data to ipcard fail");
  
  
 //////////  ward_log  จำหน่าย /////
 
$rward = substr($cBedcode,0,2);
  	/* 	if($rward=='42'){
			 $wname='หอผู้ป่วยรวม';
			 $linkward="fward.php";
		 }elseif($rward=='43'){
			 $wname='หอผู้ป่วยสูติ';
			 $linkward="gward.php";
		 }elseif($rward=='44'){
			$wname='หอผู้ป่วยICU';
			$linkward="icuward.php";
		 }elseif($rward=='45'){
			 $wname='หอผู้ป่วยพิเศษ';	
			 $linkward="vipward.php";
		 }*/
   $chgcode="Dc";
 
  $sql_ward="INSERT INTO `ward_log` ( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` , day ,  `lastcall` , `office` ) VALUES ( '".$thidate."', '".$cAn."', '".$cHn."', '".$wname."', '".$cBedcode."','".$chgcode."', '', '', '".$daysall."', '".$lastcalroom."',  '".$sOfficer."')";
  $result_ward = mysql_query($sql_ward)or die(mysql_error());
 ////////////////////////// 
  
  
  
  
  $sqldc = "insert into dcstatus(date,an,status,office) values('$Thidate','$cAn','$dcward','".$_SESSION["sOfficer"]."') ";
  $result = mysql_query($sqldc) or die("update dcstatus fail");

if($_POST["dctype"] == "8 Dead Autopsy" || $_POST["dctype"] == "9 Dead Non autopsy"){
	$sql="UPDATE opcard SET idguard='MX04 เสียชีวิต(ใน)' , lastupdate = '".(date("Y")+543).date("-m-d H:i:s")."'  WHERE hn='$cHn';"; 
  	$result = mysql_query($sql) or die("update data to opcard fail");
}
//             echo mysql_errno() . ": " . mysql_error(). "\n";
//             echo "<br>";
////////////////

if( $dctype_code == "4" ){
	$time_refer = $_POST['time_refer'];
	$organ = $_POST['organ'];
	$maintenance = $_POST[' maintenance'];
	$list_ptright = $_POST['list_ptright'];
	$list_type_patient = $_POST['list_type_patient'];
	$exrefer = $_POST['exrefer'];
	$exrefer2 = $_POST['exrefer2'];
	$refer_doctor = $_POST['doctor'];
	$targe = $_POST['targe'];
	$pttype = $_POST['pttype'];
	$refercar = $_POST['refercar'];
	$hospital = $_POST['hospital'];
	$hospital1 = $_POST['hospital1'];
	$problem_refer = $_POST['problem_refer'];

	$doc_refer = $_POST['doc_refer'];
	$nurse = $_POST['nurse'];
	$assistant_nurse = $_POST['assistant_nurse'];
	$suggestion = $_POST['suggestion'];
	$estimate = $_POST['estimate'];
	$no_estimate = $_POST['no_estimate'];
	$cradle = $_POST['cradle'];
	$doc_txt = $_POST['doc_txt'];

	$targe_list = array('1' => 'ปรึกษา/วินิจฉัย','2' => 'รักษาแล้วให้ส่งกลับ','3' => 'โอนย้าย');
	$pttype_list = array('1' => 'Emergency','2' => 'Urgent','3' => 'Non-Urgent');
  
	?>
	<style type="text/css">
	p{ margin: 0; }
	@screen print{
		.hide-txt{ display: none; }
	}
	</style>
	<p><b>เลขที่ Refer</b> : <?=$get_refer_no;?></p>
	<p><b>เวลาที่ Refer</b> : <?=$time_refer;?></p>
	<p><b>อาการ</b> : <?=$organ;?></p>
	<p><b>การรักษา</b> : <?=$maintenance;?></p>
	<p><b>สิทธิ์ผู้ป่วย</b> : <?=$list_ptright;?></p>
	<p><b>ประเภทคนไข้</b> : <?=$list_type_patient;?></p>
	<p><b>สาเหตุการ Refer</b> : <?=$exrefer;?> <?=( !empty($exrefer2) ? '<b>สาเหตุอื่นๆ</b> : '.$exrefer2 : '' );?></p>
	<p><b>แพทย์ผู้รักษา</b> : <?=$refer_doctor;?></p>
	<p><b>วัตุประสงค์/เพื่อ</b> : <?=$targe_list[$targe];?></p>
	<p><b>ประเภทผู้ป่วย</b> : <?=$pttype_list[$pttype];?></p>
	<p><b>การเดินทาง</b> : <?=$refercar;?></p>
	<p><b>Refer ไปที่โรงพยาบาล</b> : <?=( ($hospital !== '00') ? $hospital : '' );?> <?=( !empty($hospital1) ? '<b>สถานพยาบาลอื่น</b> : '.$hospital1 : '' );?></p>
	<p><b>ปัญหาการ Refer</b> : <?=$problem_refer;?></p>
	<p><b>สิ่งที่ส่งไปด้วย</b> : <?=( !empty($doc_refer) ? 'ใบ Refer' : '' );?> 
	<?=( !empty($nurse) ? 'พยาบาล' : '' );?> 
	<?=( !empty($assistant_nurse) ? 'ผู้ช่วย' : '' );?> 
	<?=( !empty($suggestion) ? 'ให้คำแนะนำ' : '' );?> 
	<?=( !empty($estimate) ? 'แบบประเมิน รพ.ลำปาง หมายเลข'.$no_estimate : '' );?> 
	<?=( !empty($cradle) ? 'เปล' : '' );?> 
	<?=( !empty($doc_txt) ? 'ใบบันทึกข้อความ' : '' );?> </p>
	<br>
	<p><a href="#"></a></p>
	<script type="text/javascript">
	window.print();
	</script>
	<?php

}else{
	
	print "AN $cAn<br>";
	print "โรค $cDiag<br>";
	//print "จำนวนวันนอน $days วัน<br>";
	print "ผลการรักษา $txresult<br>";
	print "ประเภทการจำหน่าย $dctype<br>";
	print "แพทย์ $cDoctor<br><br>";
	print "จำหน่ายผู้ป่วยเรียบร้อย <br>";
	print "ปิดหน้าต่างนี้  และRefresh หน้าต่างหอผู้ป่วย<br>";
	print "เพื่อ update ข้อมูล";

}

include("unconnect.inc");
//  session_destroy();
//ipdata.php
session_unregister("x");
session_unregister("aDgcode");
session_unregister("aTrade");
session_unregister("aPrice");
session_unregister("aPart");
session_unregister("aAmount");
session_unregister("aMoney");
session_unregister("Netprice");
session_unregister('cDate');
//    session_unregister('cBedcode');
//    session_unregister('Bedcode');
session_unregister('cBed');
session_unregister('cPtname');
session_unregister('cAge');
session_unregister('cPtright');
session_unregister('cDoctor');
session_unregister('cHn');
session_unregister('cAn');
session_unregister('cDiag');
session_unregister('cBedpri');
session_unregister('cChgdate');
session_unregister('cChgwdate');
session_unregister('cBedname');
session_unregister('cAccno');
session_unregister("clastcal");
////
?>
<script type="text/javascript">
	setTimeout("window.opener.location.href='allward.php?code=<?=$rward?>';window.close()",5000);
</script>