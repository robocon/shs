<?php
session_start();
include("connect.inc");

$sOfficer = $_SESSION["sOfficer"];

if( empty($cAn) OR empty($cPtname) OR empty($sOfficer) ){
  echo '������ҡ�������ҹ ��س�<a href="../nindex.htm">��ԡ�����</a>�����������к��ա����';
  exit;
}

$thidate = (date("Y")+543).date("-m-d H:i:s"); 

//�红������ҡ���� Refer
if(substr($_POST["dctype"],0,1) == "4"){
  
  // ��log �����բ����� refer
  // $refer_data_log = array_push($_POST, $_SESSION["sOfficer"], "Ward".$cBedcode);
  // var_dump($refer_data_log);
  file_put_contents('logs/ward_refer.log', serialize($_POST));


	include("class_file/class_refer.php");
	$obj = New refer();

	$obj->sethn($cHn);
	$obj->setan($cAn);

	if($_POST["hospital1"] != ""){
		$_POST["hospital"] = $_POST["hospital1"];
	}

	$obj->setreferh("", $_POST["hospital"]);
	$obj->setlist_type_patient($_POST["list_type_patient"]);

	$obj->setorgan($_POST["organ"]);
	$obj->setmaintenance($_POST["maintenance"]);

	$obj->setrefertype("2 �觵��");
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
}


/*
�����§���ѭ��Ф������� ����Թ�ѹ�� 200 �ҷ
�����ͧ��Ф������� ����Թ�ѹ��600 �ҷ
��ҹѺ���Թ 6 ��. ����� 1 �ѹ

�óյ������refer�ѹ�á �Ѻ������Թ 6 ��.�ԡ��ѧ���
�����§���ѭ��Ф������� ����Թ�ѹ�� 100 �ҷ
�����ͧ��Ф������� ����Թ�ѹ��200 �ҷ

ŧ���� admit discharge ���Ѵਹ
*/
	$date1=$cDate;  //admit date
	$date1=(substr($cDate,0,4)-543).substr($cDate,4); //admit date

  	//$chgdate=(substr($cChgdate,0,4)-543).substr($cChgdate,4); //admit date or changdate

  //echo "�ѹ�Ѻ����  $date1<br>"; 
  	$date2=date("Y-m-d H:i:s");  //discharge date 
  //echo "�ѹ��˹���  $date2<br>"; 
  //$date1=("2003-08-30 08:30:20");//admit
  //$date2=("2003-09-10 08:30:20");//discharge

//�͹��͹��˹���
   $s = strtotime($date2)-strtotime($date1);
 // echo "�ӹǹ�Թҷ� $s<br>";  //seconds
   $d = intval($s/86400);   //day

   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
  // echo "�ӹǹ�ѹ  $d �ѹ $h �������<br>";

   $daysall= $d;
   if ($h>6){
         $daysall=$d+1;
    }      
		//$daysall �ӹǹ�ѹ�͹������ 
    
//�͹���
/*
   $s1 = strtotime($date2)-strtotime($date1);
 //  echo "�ӹǹ�Թҷ���� $s1<br>";  //seconds
   $d1 = intval($s1/86400);   //day

   $s1 -= $d1*86400;
   $h1  = intval($s1/3600);    //hour
   echo "�ӹǹ�ѹ���  $d1 �ѹ $h1 �������<br>";

   $days1= $d1;
   if ($h1>6){
         $days1=$d1+1;
                        }    
 $chgwdate=(substr($cChgwdate,0,4)-543).substr($cChgwdate,4); //admit date or changdate
//��ԡ�á�͹��˹���
 $s2 = strtotime($date2)-strtotime($chgwdate);
   echo "�ӹǹ�Թҷ� $s<br>";  //seconds
   $d2 = intval($s2/86400);   //day

   $s2 -= $d2*86400;
   $h2  = intval($s2/3600);    //hour
   echo "�ӹǹ�ѹ  $d2 �ѹ $h2 �������<br>";

   $days2= $d2;
   if ($h2>6){
         $days2=$d2+1;
                        }      
    echo "�ӹǹ�ѹ�Դ��Һ�ԡ�� $days2 �ѹ<br>";
    echo "�ӹǹ�ѹ�͹ $days �ѹ<br>";
    echo "�ҡ�Ѻ��ҹ $absent �ѹ<br>";
    $days=$days-$absent;
    echo "�ӹǹ�ѹ�͹������ $days �ѹ <br>";
	    echo "�ӹǹ�ѹ�͹��� $days1 �ѹ <br><br>";
/////���������/////
   if ($hours>=1 && $hours<=6 ){
	if ($cBedpri=200){
		$Bfprice=100;
		            }
	if ($cBedpri>200){
	                $Bfprice=200;
		           }
	  		}
  $cBedfood=($days*$bedpri)+$Bfprice; //����Ҥ���ͧ��������
/////���/////

		$sql = "Select my_food From ipcard where an = '$cAn' limit 1";
$result2 = Mysql_Query($sql) or die(mysql_error());
list($myfood) = Mysql_fetch_row($result2);

   $oBedcode1=substr($cBedcode,0,2);
    echo "�ͼ����¨�˹��� $oBedcode1<br>";
	 echo "�Ҥ���§��˹��� $cBedpri<br>";
	  echo "�ԡ�� $myfood<br>";


  if ($cBedpri>$myfood){
      $cNBedpri1=$cBedpri1-$myfood;
      $cYBedpri1=$cBedpri1-$cNBedpri1;
	       }
  else {
      $cNBedpri1=0;
      $cYBedpri1=$cBedpri1;
           }

  echo "�ԡ�� $cYBedpri1<br>";
    echo "�ԡ����� $cNBedpri1<br>";

  $cYBedfood1=$days*$cYBedpri1; //����Ҥ���ͧ�������÷���ԡ��
  $cNBedfood1=$days*$cNBedpri1; //����Ҥ���ͧ�������÷���ԡ����


	 
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

 echo "�ԡ�� $cYBedpri1<br>";
    echo "�ԡ����� $cNBedpri1<br>";
	
	
  $cBedfood  =$days*$cBedpri;    //����Ҥ���ͧ�������÷�����
  $cYBedfood=$days*$cYBedpri; //����Ҥ���ͧ�������÷���ԡ��
  $cNBedfood=$days*$cNBedpri; //����Ҥ���ͧ�������÷���ԡ�����

*/
/////�ӹǹ�ѹ�ش����
		//echo $clastcal;
		$query = "SELECT lastcalroom FROM bed WHERE bedcode = '$cBedcode'";
    	$result = mysql_query($query) or die("Query failed");
		list($lastcalroom) = mysql_fetch_array($result);
		
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
		$caldate=(substr($lastcalroom,0,4)-543).substr($lastcalroom,4); //�ѹ�͹
		
		$s = strtotime($date2)-strtotime($caldate);
		//echo $s."<br>";
		$d = intval($s/86400);   //day
	    $s -= $d*86400;
	    $h  = intval($s/3600);    //hour
	   //echo "�ӹǹ�ѹ  $d �ѹ $h ������� &nbsp;&nbsp;";
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
		 if($oBedcode1=="42") $dcward = "�ͼ��������"; 
		 elseif($oBedcode1=="43") $dcward = "�ͼ������ٵԹ��"; 
		 elseif($oBedcode1=="44") $dcward = "�ͼ�����˹ѡ"; 
		 elseif($oBedcode1=="41") $dcward = "�ͼ����ª��"; 
		 elseif($oBedcode1=="45") $dcward = "�ͼ����¾����"; 
 		//echo "�ԡ�� $cYBedpri1<br>";
   		//echo "�ԡ����� $cNBedpri1<br>";
		  $cBedfood  =$dayslast*$cBedpri;    //����Ҥ���ͧ�������÷�����
		  $cYBedfood=$dayslast*$cYBedpri; //����Ҥ���ͧ�������÷���ԡ��
		  $cNBedfood=$dayslast*$cNBedpri; //����Ҥ���ͧ�������÷���ԡ�����
		  
		  $stays='��� '.$dayslast.' �ѹ'; 
		  if($oBedcode1 != '44'){
			  $cWcare=300;
			  $cWname="(55010)��Һ�ԡ�þ�Һ�ŷ���� (IPD)";
		  }else{
				$cWcare=700;
				$cWname="(55012 )��Һ�ԡ�þ�Һ�ŷ���� ICU";
		  }
		  $cBedwcare  =$dayslast*$cWcare;  //�����Һ�ԡ�÷ҧ��Һ��
		  /////////
		  
//�����ͧ����ԡ�� depart	
			$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','WARD','2','$cBedname (੾�з���ԡ��) $stays','$cYBedfood','$sOfficer','$diag','$cAccno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into depart");
			$idno=mysql_insert_id();
//�����ͧ����ԡ�� patdata
			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','2','BFY','$cBedname (੾�з���ԡ��) $stays','$dayslast','$cYBedfood','WARD','BFY','$idno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
//��Һ�ԡ�÷ҧ��Һ��
			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$cAn','NCARE','WARD','$cWname(��˹���)','$dayslast','$cBedwcare','$sOfficer','NCARE','$cAccno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc2");
//�����ͧ����ԡ�� ipacc	
			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$cAn','BFY','WARD','$cBedname ($cBedcode)(��˹���) $stays','$dayslast','$cYBedfood','$sOfficer','BFY','$cAccno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
//�����ͧ��ǹ�Թ dapart
			$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','WARD','2','�����ͧ��ǹ�Թ $cNBedpri �ҷ(��˹���) $stays','$cNBedfood','$sOfficer','$diag','$cAccno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into depart");
			$idno=mysql_insert_id();
//�����ͧ��ǹ�Թ patdata
   			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','2','BFN','�����ͧ��ǹ�Թ $cNBedpri �ҷ(��˹���) $stays','$dayslast','$cNBedfood','WARD','BFN','$idno');";
			//echo $query."<br>";
  			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
//�����ͧ��ǹ�Թ ipacc
   			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$cAn','BFN','WARD','�����ͧ��ǹ�Թ $cNBedpri �ҷ(��˹���) $stays','$dayslast','$cNBedfood','$sOfficer','BFN','$cAccno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc1");

		
		//echo "�ӹǹ�ѹ  $d �ѹ $h ������� &nbsp;&nbsp;";

//ź�͡�ҡ��§���(ź������)
  $sql = "UPDATE bed SET ptname='',age='',idcard='',address='',muang='',ptright='',doctor='',date='',
           hn='',an='',diagnos='',price=0,paid=0,debt=0,food='',diag1='',officer='',
           chgdate=now(),accno=1,lastcalroom='0000-00-00 00:00:00' WHERE bedcode='$Bedcode';";
  $result = mysql_query($sql) or die("erase bed fail");

//����Ҥ���ͧ��������(�ԡ��)
   //$stays='��� '.$days.' �ѹ'; 
  // $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
/*
//insert data into depart
   $query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,
                    idname,diag,accno)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','WARD','2','$cBedname (੾�з���ԡ��) $stays',
                    '$cYBedfood','$sOfficer','$cDiag','$cAccno');";
   $result = mysql_query($query) or die("Query failed,cannot insert into depart");
   $idno=mysql_insert_id();



//insert data into patdata
                $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','2','BFY','$cBedname (੾�з���ԡ��) $stays','$days',
                                 '$cYBedfood','WARD','BFY','$idno');";
                $result = mysql_query($query) or die("Query failed,cannot insert into patdata");

 

$oBedcode1=substr($cBedcode,0,2);
if($oBedcode1 != '44'){
      $cWcare=300;
	  $cWname="(55010)��Һ�ԡ�þ�Һ�ŷ���� (IPD)";
	
}else

	{
	    $cWcare=700;
		 $cWname="(55012 )��Һ�ԡ�þ�Һ�ŷ���� ICU";
	}
  $cBedwcare  =$days2*$cWcare;    //�����ԡ�÷ҧ��þ�Һ��
$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno)VALUES('$Thidate','$cAn','NCARE','WARD','$cWname(��˹���)',
                    '$days2',' $cBedwcare','$sOfficer','NCARE','$cAccno','$idno');";
   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");

  

   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno)VALUES('$Thidate','$cAn','BFY','WARD','$cBedname ($cBedcode) $stays',
                    '$days','$cYBedfood','$sOfficer','BFY','$cAccno','$idno');";
   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
// 	    echo mysql_errno() . ": " . mysql_error(). "\n";
//	    echo "<br>";

//����Ҥ���ͧ��������(�ԡ�����)
//insert data into depart
   $query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,
                    idname,diag,accno)VALUES('$Thidate','$cPtname','$cHn','$cAn','$cDoctor','WARD','2','�����ͧ��ǹ�Թ $cNBedpri �ҷ $stays',
                    '$cNBedfood','$sOfficer','$cDiag','$cAccno');";
   $result = mysql_query($query) or die("Query failed,cannot insert into depart");
   $idno=mysql_insert_id();

//insert data into patdata
   $query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno)
                                 VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','2','BFN','�����ͧ��ǹ�Թ $cNBedpri �ҷ $stays','$days',
                                 '$cNBedfood','WARD','BFN','$idno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into patdata");

//insert data into ipacc
   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno,idno)VALUES('$Thidate','$cAn','BFN','WARD','�����ͧ��ǹ�Թ $cNBedpri �ҷ $stays',
                    '$days','$cNBedfood','$sOfficer','BFN','$cAccno','$idno');";
   $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");*/

//begin �ӹǹ����ѡ�Ҿ�Һ�����insert data to ipcard
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
//end  �ӹǹ����ѡ�Ҿ�Һ�����insert data to ipcard
   $sql="UPDATE ipcard SET ptname='$cPtname',age='$cAge',ptright='$cPtright',
             bedcode='$Bedcode',days='$daysall',dcdate='$Thidate',dcstatus='1',diag='$cDiag',  
             icd10='$icd10', comorbid='$comorbid',complica='$complica',other='$other',extcause='$extcause',icd9cm='$icd9cm',
             second='$second',result='$txresult',dctype='$dctype', price='$nNetprice',paid= '$nNetpaid',calc='$Thidate',
             doctor='$cDoctor',accno='$cAccno',status_log='��˹���',lastcalroom='$lastcalroom' WHERE an='$cAn';"; 
  $result = mysql_query($sql) or die("insert data to ipcard fail");
  
  
 //////////  ward_log  ��˹��� /////
 
$rward = substr($cBedcode,0,2);
  	/* 	if($rward=='42'){
			 $wname='�ͼ��������';
			 $linkward="fward.php";
		 }elseif($rward=='43'){
			 $wname='�ͼ������ٵ�';
			 $linkward="gward.php";
		 }elseif($rward=='44'){
			$wname='�ͼ�����ICU';
			$linkward="icuward.php";
		 }elseif($rward=='45'){
			 $wname='�ͼ����¾����';	
			 $linkward="vipward.php";
		 }*/
   $chgcode="Dc";
 
  $sql_ward="INSERT INTO `ward_log` ( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` , day ,  `lastcall` , `office` ) VALUES ( '".$thidate."', '".$cAn."', '".$cHn."', '".$wname."', '".$cBedcode."','".$chgcode."', '', '', '".$daysall."', '".$lastcalroom."',  '".$sOfficer."')";
  $result_ward = mysql_query($sql_ward)or die(mysql_error());
 ////////////////////////// 
  
  
  
  
  $sqldc = "insert into dcstatus(date,an,status,office) values('$Thidate','$cAn','$dcward','".$_SESSION["sOfficer"]."') ";
  $result = mysql_query($sqldc) or die("update dcstatus fail");

if($_POST["dctype"] == "8 Dead Autopsy" || $_POST["dctype"] == "9 Dead Non autopsy"){
	$sql="UPDATE opcard SET idguard='MX04 ���ª��Ե(�)' , lastupdate = '".(date("Y")+543).date("-m-d H:i:s")."'  WHERE hn='$cHn';"; 
  	$result = mysql_query($sql) or die("update data to opcard fail");
}
//             echo mysql_errno() . ": " . mysql_error(). "\n";
//             echo "<br>";
////////////////
          print "AN $cAn<br>";
          print "�ä $cDiag<br>";
          //print "�ӹǹ�ѹ�͹ $days �ѹ<br>";
          print "�š���ѡ�� $txresult<br>";
          print "��������è�˹��� $dctype<br>";
          print "ᾷ�� $cDoctor<br><br>";
          print "��˹��¼��������º���� <br>";
          print "�Դ˹�ҵ�ҧ���  ���Refresh ˹�ҵ�ҧ�ͼ�����<br>";
          print "���� update ������";

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
  <script>
setTimeout("window.opener.location.href='allward.php?code=<?=$rward?>';window.close()",5000);
//setTimeout("window.close()",1000);
</script>