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
	///$bbbbcode �Ҩҡ˹�� ward
 	$query1 = "SELECT bed,date, ptname, an, hn, caldate, bedname, bedcode, status FROM bed WHERE bedcode LIKE  '$bbbbcode%' and an!='' ";
	//echo $query1;
  	$result1 = mysql_query($query1);
 	while(list($bed,$date,$ptname,$an,$hn,$caldate,$bedname,$bedcode,$status)=Mysql_fetch_row($result1)){
		$query2 = "SELECT lastcalroom,accno,bedpri,date FROM bed WHERE bedcode = '$bedcode'";
		//echo $query2."<br>";
		$result2 = mysql_query($query2);
		list($lastcalroom,$cAccno,$cBedpri,$datestart)=mysql_fetch_row($result2);
		//echo "$hn ".$date2."<br>";
		$chgdate=(substr($lastcalroom,0,4)-543).substr($lastcalroom,4); //�ѹ�͹
		$datenow=date("Y-m-d H:i:s"); //�ѹ���
		$s = strtotime($datenow)-strtotime($chgdate);
		//echo $s."<br>";
		$d = intval($s/86400);   //day
	    $s -= $d*86400;
	    $h  = intval($s/3600);    //hour
	    //echo "�ӹǹ�ѹ  $d �ѹ $h ������� &nbsp;&nbsp;";
	    $days= $d;
		
		//���ѹ�͹���
			$chgdatesall=(substr($datestart,0,4)-543).substr($datestart,4); //�ѹ�͹
		$datenow=date("Y-m-d H:i:s"); //�ѹ���
		$sallstart = strtotime($datenow)-strtotime($chgdatesall);
		//echo $s."<br>";
		$dallstart = intval($sallstart/86400);   //day
	    $sallstart -= $dallstart*86400;
	    $hallstart  = intval($sallstart/3600);    //hour
	    //echo "�ӹǹ�ѹ  $d �ѹ $h ������� &nbsp;&nbsp;";
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
			//echo "�ԡ�� $cYBedpri1<br>";
			//echo "�ԡ����� $cNBedpri1<br>";
			  $cBedfood  =$days*$cBedpri;    //����Ҥ���ͧ�������÷�����
			  $cYBedfood=$days*$cYBedpri; //����Ҥ���ͧ�������÷���ԡ��
			  $cNBedfood=$days*$cNBedpri; //����Ҥ���ͧ�������÷���ԡ�����
			  
			  $stays='��� '.$days.' �ѹ'; 
			  if($oBedcode1 != '44'){
				  $cWcare=300;
				  $cWname="(55010)��Һ�ԡ�þ�Һ�ŷ���� (IPD)";
			  }else{
					$cWcare=700;
					$cWname="(55012 )��Һ�ԡ�þ�Һ�ŷ���� ICU";
			  }
			  $cBedwcare  =$days*$cWcare;  //�����Һ�ԡ�÷ҧ��Һ��
			  /////////
			  $Thidate = (date("Y")+543).date("-m-d H:i:s"); 

			//   $diag = htmlspecialchars($diag, ENT_QUOTES);
			$diag = str_replace("'", ' ', $diag);

	//�����ͧ����ԡ�� depart	
				$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$ptname','$hn','$an','$doctor','WARD','2','$bedname (੾�з���ԡ��) $stays','$cYBedfood','����������','$diag','$cAccno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into depart in page calroom");
				$idno=mysql_insert_id();
	//�����ͧ����ԡ�� patdata
				$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$hn','$an','$ptname','$doctor','2','BFY','$bedname (੾�з���ԡ��) $stays','$days','$cYBedfood','WARD','BFY','$idno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata in page calroom");
	//��Һ�ԡ�÷ҧ��Һ��
				$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$an','NCARE','WARD','$cWname','$days','$cBedwcare','����������','NCARE','$cAccno','$idno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into ipacc2 in page calroom");
	//�����ͧ����ԡ�� ipacc	
				$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$an','BFY','WARD','$bedname ($bedcode) $stays','$days','$cYBedfood','����������','BFY','$cAccno','$idno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into ipacc in page calroom");
	//�����ͧ��ǹ�Թ dapart
				$query = "INSERT INTO depart(date,ptname,hn,an,doctor,depart,item,detail,price,idname,diag,accno)VALUES('$Thidate','$ptname','$hn','$an','$doctor','WARD','2','�����ͧ��ǹ�Թ $cNBedpri �ҷ $stays','$cNBedfood','����������','$diag','$cAccno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into depart in page calroom");
				$idno=mysql_insert_id();
	//�����ͧ��ǹ�Թ patdata
				$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,depart,part,idno) VALUES('$Thidate','$hn','$an','$ptname','$doctor','2','BFN','�����ͧ��ǹ�Թ $cNBedpri �ҷ $stays','$days','$cNBedfood','WARD','BFN','$idno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata in page calroom");
	//�����ͧ��ǹ�Թ ipacc
				$query = "INSERT INTO ipacc(date,an,code,depart,detail,amount,price,idname,part,accno,idno)VALUES('$Thidate','$an','BFN','WARD','�����ͧ��ǹ�Թ $cNBedpri �ҷ $stays','$days','$cNBedfood','����������','BFN','$cAccno','$idno');";
				//echo $query."<br>";
				$result = mysql_query($query) or die("Query failed,cannot insert into ipacc1 in page calroom");
				$daytime =explode(" ",$lastcalroom);
				$timeadmit = $daytime[1]; //������ҷ�� admit �͡�ҡ�͹
				$caldate =explode("-",$daytime[0]); //�Ѵ����ѹ�������͡������价� mktime
				$tomorrow = mktime(0,0,0,$caldate[1],($caldate[2]+$days),($caldate[0]-543)); 
				$calroom = date("Y-m-d",$tomorrow);
				$cutmonn = explode("-",$calroom); //��mktime�ʴ���� �Ѵ�¡�͡�Һǡ�繾.�.
				$daycalroom = ($cutmonn[0]+543)."-".$cutmonn[1]."-".$cutmonn[2]." ".$timeadmit;
				
				
				//$daycalroom= $caldate[0]."-".$caldate[1]."-".($caldate[2]+$days)." ".$timeadmit;
				//echo $daycalroom;
				//$daycalroom = (date("Y")+543).date("-m-d ").$timeadmit;
				$query4 = "update bed SET lastcalroom ='$daycalroom',days ='$daysallstart' where bedcode = '$bedcode'";
				$result4 = mysql_query($query4) or die("Query failed,cannot update bed in page calroom");
			}
		}
	}
	
?>
</body>
</html>