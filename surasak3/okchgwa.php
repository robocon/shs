<?php
  session_start();
 $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  include("connect.inc");

//�红�������§�������
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
      echo "��辺 bedcode : $oBedcode";
   }


$sql = "Select bedpri,bedcode From bed where bedcode='$Bcode' limit 1";
$result3 = Mysql_Query($sql) or die(mysql_error());
list($Nbadpri,$bedcode) = Mysql_fetch_row($result3);
$cbedcode1=substr($cbedcode,0,2);
$bedcode1=substr($bedcode,0,2);
  echo "��ͧ���� $Bcode<br>"; 
  echo "�Ҥ���ͧ��� $cBedpri<br>"; 
   echo "�Ҥ���ͧ���� $Nbadpri<br>"; 
    echo "����� $cbedcode1<br>"; 
   echo "������ $bedcode1<br>"; 
   
echo "<br>";    

//�Դ��Һ�ԡ�÷ҧ��Һ��
/*if($cbedcode1 != $bedcode1){

//�ӹǹ��Һ�ԡ�÷ҧ��þ�Һ��
  $chgwdate=(substr($cChgwdate,0,4)-543).substr($cChgwdate,4); //admit date or changdate
  echo "�ѹ������͹����  $chgdate<br>"; 
  $date2=date("Y-m-d H:i:s");  //discharge date 
  echo "�ѹ����  $date2<br>"; 
  //$date1=("2003-08-30 08:30:20");//admit
  //$date2=("2003-09-10 08:30:20");//discharge
   $s = strtotime($date2)-strtotime($chgwdate);
   echo "�ӹǹ�Թҷ� $s<br>";  //seconds
   $d = intval($s/86400);   //day
   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
   echo "�ӹǹ�ѹ  $d �ѹ $h ������� <br>";
   $days= $d;
   
   if ($h>12){
         $days=$d+1;
                        } 

    echo "�ӹǹ�ѹ�͹������  $days �ѹ<br>";

//�¡�����ͧ icu
  $oBedcode1=substr($oBedcode,0,2);
if($oBedcode1 != '44'){
      $cWcare=300;
	  $cWname="(55010)��Һ�ԡ�þ�Һ�ŷ���� (IPD)";
	
}else

	{
	    $cWcare=700;
		 $cWname="(55012 )��Һ�ԡ�þ�Һ�ŷ���� ICU";
	  }


  $cBedwcare  =$days*$cWcare;    //�����ԡ�÷ҧ��þ�Һ��
 

//insert into ipacc  ����Ҥ���ͧ��������
   $stays='��� '.$days.' �ѹ'; 
   $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
   echo "$cWname  $stays ���Թ������ $cBedwcare �ҷ <br>";
 
   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','NCARE','WARD',' $cWname ($cbedcode) $stays',
                    '$days','$cBedwcare','$sOfficer','NCARE','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
// 	    echo mysql_errno() . ": " . mysql_error(). "\n";
//	    echo "<br>";

    $query1 = "UPDATE bed SET chgwdate='$Thidate' WHERE bedcode='$Bcode';";
  $result = mysql_query($query1) or die("insert data to bed fail");
 echo"�Դ��Һ�ԡ�÷ҧ��þ�Һ��";
 echo"$query1";
//���ӹǹ��Һ�ԡ�÷ҧ��þ�Һ��
 
}
else
//�����ͧ��ҡѹ
{

  $oBedcode1=substr($oBedcode,0,2);
if($oBedcode1 != '44'){
      $cWcare=300;
	  $cWname="(55010)��Һ�ԡ�þ�Һ�ŷ���� (IPD)";
	
}else

	{
	    $cWcare=700;
		 $cWname="(55012 )��Һ�ԡ�þ�Һ�ŷ���� ICU";
	  }

$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','NCARE','WARD','$cWname($cbedcode)$stays',
                    '0','0','$sOfficer','NCARE','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");

  $query1= "UPDATE bed SET chgwdate='$cChgwdate' WHERE bedcode='$Bcode';";
  $result = mysql_query($query1) or die("insert data to bed fail");
 echo"���Դ��Һ�ԡ�÷ҧ��þ�Һ��";
 echo"$query1";
}




//�Դ�����ͧ/��������

if($cBedpri != $Nbadpriand){

//�ӹǹ�����ͧ
  $chgdate=(substr($cChgdate,0,4)-543).substr($cChgdate,4); //admit date or changdate
  echo "�ѹ������͹����  $chgdate<br>"; 
  $date2=date("Y-m-d H:i:s");  //discharge date 
  echo "�ѹ����  $date2<br>"; 
  //$date1=("2003-08-30 08:30:20");//admit
  //$date2=("2003-09-10 08:30:20");//discharge
   $s = strtotime($date2)-strtotime($chgdate);
   echo "�ӹǹ�Թҷ� $s<br>";  //seconds
   $d = intval($s/86400);   //day
   $s -= $d*86400;
   $h  = intval($s/3600);    //hour
   echo "�ӹǹ�ѹ  $d �ѹ $h ������� <br>";
   $days= $d;
   
   if ($h>12){
         $days=$d+1;
                        } 

    echo "�ӹǹ�ѹ�͹������  $days �ѹ<br>";

$sql = "Select my_food From ipcard where an = '$oAn' limit 1";
$result2 = Mysql_Query($sql) or die(mysql_error());
list($myfood) = Mysql_fetch_row($result2);

//�¡�����ͧ icu
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


  $cBedfood  =$days*$cBedpri;    //����Ҥ���ͧ�������÷�����
  $cYBedfood=$days*$cYBedpri; //����Ҥ���ͧ�������÷���ԡ��
  $cNBedfood=$days*$cNBedpri; //����Ҥ���ͧ�������÷���ԡ�����

//insert into ipacc  ����Ҥ���ͧ��������
   $stays='��� '.$days.' �ѹ'; 
   $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
   echo "$cBedname $stays ���Թ������ $cBedfood �ҷ <br>";
   echo "�����ͧ��ǹ����ԡ�� $cYBedpri �ҷ����ѹ  $stays  ���Թ $cYBedfood �ҷ<br>";
   echo "�����ͧ��ǹ�Թ $cNBedpri �ҷ����ѹ $stays  ���Թ $cNBedfood �ҷ<br><br>";




   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','BFY','WARD','$cBedname ($cbedcode) $stays',
                    '$days','$cYBedfood','$sOfficer','BFY','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
// 	    echo mysql_errno() . ": " . mysql_error(). "\n";
//	    echo "<br>";

   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','BFN','WARD','�����ͧ��ǹ�Թ $cNBedpri �ҷ $stays',
                    '$days','$cNBedfood','$sOfficer','BFN','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
//���ӹǹ�����ͧ*/
/////�ӹǹ�ѹ�ش����
 
		$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
		$chgdate=(substr($calroom,0,4)-543).substr($calroom,4); //�ѹ�͹
		$datenow=date("Y-m-d H:i:s"); //�ѹ���
		$s = strtotime($datenow)-strtotime($chgdate);
		//echo $s."<br>";
		$d = intval($s/86400);   //day
	    $s -= $d*86400;
	    $h  = intval($s/3600);    //hour
	   	echo "�ӹǹ�ѹ  $d �ѹ $h ������� &nbsp;&nbsp;";
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
		////�������§���
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
//�����ͧ����ԡ�� depart	
			$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$oPtname','$oHn','$oAn','$oDoctor','WARD','2','$cBedname (੾�з���ԡ��) $stays','$cYBedfood','����������','$diag','$accno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into depart");
			$idno=mysql_insert_id();
//�����ͧ����ԡ�� patdata
			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$oHn','$oAn','$oPtname','$oDoctor','2','BFY','$cBedname (੾�з���ԡ��) $stays','$dayslast','$cYBedfood','WARD','BFY','$idno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
//��Һ�ԡ�÷ҧ��Һ��
			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$oAn','NCARE','WARD','$cWname(������§)','$dayslast','$cBedwcare','����������','NCARE','$accno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc2");
//�����ͧ����ԡ�� ipacc	
			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$oAn','BFY','WARD','$cBedname ($oBedcode)(������§) $stays','$dayslast','$cYBedfood','����������','BFY','$accno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
//�����ͧ��ǹ�Թ dapart
			$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$oPtname','$oHn','$oAn','$oDoctor','WARD','2','�����ͧ��ǹ�Թ $cNBedpri �ҷ(������§) $stays','$cNBedfood','����������','$diag','$accno');";
			//echo $query."<br>";
			$result = mysql_query($query) or die("Query failed,cannot insert into depart");
			$idno=mysql_insert_id();
//�����ͧ��ǹ�Թ patdata
   			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$oHn','$oAn','$oPtname','$oDoctor','2','BFN','�����ͧ��ǹ�Թ $cNBedpri �ҷ(������§) $stays','$dayslast','$cNBedfood','WARD','BFN','$idno');";
			//echo $query."<br>";
  			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
//�����ͧ��ǹ�Թ ipacc
   			$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$oAn','BFN','WARD','�����ͧ��ǹ�Թ $cNBedpri �ҷ(������§) $stays','$dayslast','$cNBedfood','����������','BFN','$accno','$idno');";
			//echo $query."<br>";
   			$result = mysql_query($query) or die("Query failed,cannot insert into ipacc1");

	//	}
//�����͡�ҡ��§���(ź������)
  $sql = "UPDATE bed SET ptname='',age='',idcard='',address='',muang='',ptright='',doctor='',date='',
           hn='',an='',diagnos='',price=0,paid=0,debt=0,food='',officer='',
           chgdate=now(),accno=1,lastcalroom='0000-00-00 00:00:00' WHERE bedcode='$oBedcode';";
  $result = mysql_query($sql) or die("erase bed fail");
		 //echo $sql;

//���������§����  
if($dayslast>0){
	/*
	$daytime =explode(" ",$lastcalroom);
			$timeadmit = $daytime[1]; //������ҷ�� admit �͡�ҡ�͹
			$caldate =explode("-",$daytime[0]); //�Ѵ����ѹ�������͡������价� mktime
			$tomorrow = mktime(0,0,0,$caldate[1],($caldate[2]+$days),($caldate[0]-543)); 
			$calroom = date("Y-m-d",$tomorrow);
			$cutmonn = explode("-",$calroom); //��mktime�ʴ���� �Ѵ�¡�͡�Һǡ�繾.�.
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
			 $wname='�ͼ��������';
			// $old=$wname.'/'.$Bedcode;	
			// $new=$wname.'/'.$cbedcode;	
		 }elseif($bedcode1=='43'){
			 $wname='�ͼ������ٵ�';
			// $old=$wname.'/'.$cbedcode;	
			// $new=$wname.'/'.$Bcode;	
		 }elseif($bedcode1=='44'){
			$wname='�ͼ�����ICU';
			// $old=$wname.'/'.$cbedcode;	
			// $new=$wname.'/'.$Bcode;
		 }elseif($bedcode1=='45'){
			 $wname='�ͼ����¾����';
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
          print "���¼��������º���� <br>";
		   print "��س����ѡ���� .............�к��лԴ˹�ҵ�ҧ�ѵ��ѵ� <br>";
          //print "�Դ˹�ҵ�ҧ���  ���Refresh ˹�ҵ�ҧ�ͼ�����<br>";
          //print "���� update ������";
 	}



//}
/*else
//�����ͧ��ҡѹ
{

$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','BFY','WARD','$cBedname($cbedcode)$stays',
                    '0','0','$sOfficer','BFY','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
// 	    echo mysql_errno() . ": " . mysql_error(). "\n";
//	    echo "<br>";

   $query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,
                    idname,part,accno)VALUES('$Thidate','$oAn','BFN','WARD','�����ͧ��ǹ�Թ $cNBedpri �ҷ $stays',
                    '0','0','$sOfficer','BFN','$accno');";
  $result = mysql_query($query) or die("Query failed,cannot insert into ipacc");
*/
//�����͡�ҡ��§���(ź������)

/*  $sql = "UPDATE bed SET ptname='',age='',idcard='',address='',muang='',ptright='',doctor='',date='',
           hn='',an='',diagnos='',price=0,paid=0,debt=0,food='',officer='',
           chgdate=now(),accno=1 WHERE bedcode='$oBedcode';";
  $result = mysql_query($sql)
         or die("erase bed fail");

//���������§����  
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
          print "���¼��������º���� <br>";
          print "�Դ˹�ҵ�ҧ���  ���Refresh ˹�ҵ�ҧ�ͼ�����<br>";
          print "���� update ������";
         }

}*/ 


$rward = substr($Bcode,0,2);
			if($rward=='41'){
				//echo "<a href='mward.php'>��Ѻ˹�� ward</a>";
				$linkward="allward.php?code=41";
			}elseif($rward=='42'){
				//echo "<a href='fward.php'>��Ѻ˹�� ward</a>";
				$linkward="allward.php?code=42";
			}elseif($rward=='43'){
				//echo "<a href='gward.php'>��Ѻ˹�� ward</a>";
				$linkward="allward.php?code=43";
			}elseif($rward=='44'){
			//	echo "<a href='icuward.php'>��Ѻ˹�� ward</a>";
				$linkward="allward.php?code=44";
			}elseif($rward=='45'){
				//echo "<a href='vipward.php'>��Ѻ˹�� ward</a>";
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
