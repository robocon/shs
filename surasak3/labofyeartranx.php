<?php
session_start();
?>
<body Onload="window.print();">

<?php
    
	$getpro=$_GET["pro"];
	
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY";
	}else{
		if ($ageM > 5){
			$ageY=$ageY;
			$pAge="$ageY ��";
		}else{
			$pAge="$ageY ��";
		}
	}

return $pAge;
}

    if (isset($sIdname)){} else {die;} //for security
    $Thidate = (date("Y")+543).date("-m-d H:i:s");
	$ldate = (date("Y")+543).date("-m-d"); 
	$Thidate2 = date("Y").date("-m-d H:i:s"); 
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
	$patienttype = "OPD";
	$sourcecode = "";//����ward
	$build = array("42"=>"�ͼ�����˭ԧ","44"=>"�ͼ����� ICU","43"=>"�ͼ������ٵ�","45"=>"�ͼ����¾����");

	$sourcename = "";//����ward
	$room = ""; //��ͧ������
	$clinicalinfo = "";

   //item count
   $item=0;
   $x=count($_SESSION['aDgcode']);
   for ($n=0; $n<$x; $n++){
        if(!empty($_SESSION['aDgcode'][$n])){
             $item++;
		}
    }

    include("connect.inc");

	// �ѹ�Ţ lab �ͧ hdl ��͹
	$query = "SELECT runno, startday FROM runno WHERE title = 'lab'";
	$result = mysql_query($query) or die( mysql_error() );
	$row = mysql_fetch_assoc($result);
	$nLab_hdl = $row['runno'];
	$dLabdate = $row['startday'];
	$dLabdate = substr($dLabdate,0,10);

	$nLab_hdl_update = $nLab_hdl + 1;

	$query ="UPDATE runno SET runno = $nLab_hdl_update, startday = '$dLabdate' WHERE title='lab'";
	$result = mysql_query($query) or die("Query failed");
	
	// �ѹ�Ţ lab �ͧ hdl ��͹

//�Ţ LAB
	$query = "SELECT runno, startday FROM runno WHERE title = 'lab'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	//  	    $cTitle=$row->title;  //=VN
	$nLab=$row->runno;
	$dLabdate=$row->startday;
	$dLabdate=substr($dLabdate,0,10);
	
	if(substr($dLabdate,0,10) != date("Y-m-d")){
		$nLab = 1;
		$dLabdate = date("Y-m-d 00:00:00");
	}
	
	$today = date("Y-m-d"); 

	$cliniciancode = "";//����ᾷ��
	$clinicianname ="MD022 (����Һᾷ��)";//����ᾷ��
		


		$query = "SELECT * FROM opday WHERE hn = '".$_SESSION['hn']."' and thidate like '".$ldate."%' ";
	    $result = mysql_query($query) or die("Query failed");

	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
			}
	        if(!($row = mysql_fetch_object($result)))
	            continue;
		}
        if(mysql_num_rows($result)){
	      $cHn=$row->hn;
          $cPtname=$row->ptname;
	      $cPtright = "R22 ��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��";
		  $tvn=$row->vn;
   		  $cIdcard=$row->idcard;
		  $cDoctor = "MD022 (����Һᾷ��)";
		  $cDiag="��Ǩ�آ�Ҿ";
		}
		$room = $tvn;
		$patient_from = "OPD";
		$Netprice=0;
		$aSumYprice=0;
		$aSumNprice=0;
		for($n=0; $n<$x; $n++){
			if(!empty($_SESSION['aDgcode'][$n])){
				$sql = "select code,detail,price,yprice,nprice,depart,part from labcare where code = '".$_SESSION['aDgcode'][$n]."'";
				$row = mysql_query($sql);
				list($code,$detail,$price,$yprice,$nprice,$depart,$part) = mysql_fetch_array($row);
				$Netprice+=$price;
				$aSumYprice+=$yprice;
				$aSumNprice+=$nprice;
			}
		}

//insert data into depart
   $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright,lab)VALUES('".$_SESSION['nRunno']."','$Thidate','$cPtname','$cHn','','$cDoctor','PATHO','$item','��Ǩ�آ�Ҿ', '$Netprice','$aSumYprice','$aSumNprice','','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright','$nLab');";
      $result = mysql_query($query) or 
                die("**��͹ ! ����;�˹�ҵ�ҧ����ʴ������ѹ�֡������仡�͹���� ���͡�úѹ�֡�������<br>
	*�ô��Ǩ�ͺ�������¡������� [�١�è����Թ] �������<br>
	*������ʴ���� ��ѹ�֡仡�͹����<br>
	*���������ʴ����  ��úѹ�֡�������<br><br>
                -------- ��¡�� ---------<br> 
	$Thaidate<br>
	$cPtname HN:$cHn AN:$cAn VN:$tvn<br>
                �Է��: $cPtright<br>
                �ä:$cDiag<br>
                ᾷ��:$cDoctor<br>
                $aDetail<br>
               �ӹǹ $item ��¡��<br>
               �Ҥ���� $Netprice �ҷ<br>
               ���. $sOfficer<br>");
  $idno=mysql_insert_id();  



//insert data into patdata
    for($n=0; $n<$x; $n++){
		if(!empty($_SESSION['aDgcode'][$n])){
			$sql = "select code,detail,price,yprice,nprice,depart,part from labcare where code = '".$_SESSION['aDgcode'][$n]."'";
			$row = mysql_query($sql);
			list($code,$detail,$price,$yprice,$nprice,$depart,$part) = mysql_fetch_array($row);
			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$code','$detail','1','$price','$yprice','$nprice','$depart','$part','$idno','$cPtright');";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");

        }
	}

	// �Դ�������� ���� HDL �����ա 1��¡��
	if( $_GET['pro'] == '3' OR $_GET['pro'] == '4' ){

		$sql = "select code,detail,price,yprice,nprice,depart,part from labcare where code = 'HDL'";
		$row = mysql_query($sql);
		list($code,$detail,$price,$yprice,$nprice,$depart,$part) = mysql_fetch_array($row);

		$Netprice2=$price;
		$aSumYprice=$yprice;
		$aSumNprice=$nprice;

		// Depart Runno
		$query = "SELECT * FROM runno WHERE title = 'depart'";
		$result = mysql_query($query) or die("Query failed");
		$runrow = mysql_fetch_assoc($result);
		$depart_runno=$runrow['runno'];
		$depart_runno++;
		$query ="UPDATE runno SET runno = $depart_runno WHERE title='depart'";
		$result = mysql_query($query) or die("Query failed");
		// Depart Runno

		$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,sumnprice,paid, idname,diag,accno,tvn,ptright,lab)
		VALUES
		('$depart_runno','$Thidate','$cPtname','$cHn','','$cDoctor','PATHO','1','��Ǩ�آ�Ҿ', '$Netprice2','$aSumYprice','$aSumNprice','','$sOfficer','$cDiag','$cAccno','$tvn','$cPtright','$nLab_hdl');";
		mysql_query($query) or die(mysql_error());
		$depart_id = mysql_insert_id(); 

		$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) 
		VALUES
		('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$code','$detail','1','$price','$yprice','$nprice','$depart','$part','$depart_id','$cPtright');";
		mysql_query($query) or die(mysql_error());

		// echo "������� HDL �ӹǹ $item ��¡��<br>�Ҥ���� $Netprice2 �ҷ<br>";

		$Netprice += $Netprice2;
	}
	// �Դ�������� ���� HDL �����ա 1��¡��
		
		
		$pathopri=$Netprice;


		$Thdhn=date("d-m-").(date("Y")+543).$cHn;
        $query ="UPDATE opday SET patho=patho+$pathopri WHERE thdatehn= '$Thdhn' AND vn = '".$tvn."' ";
        $result = mysql_query($query) or die("Query failed,update opday");
	
	 for ($n=0; $n<$x; $n++){

		 list($olddetail,$detail) = mysql_fetch_row(mysql_query("Select oldcode,detail From labcare where code = '".$_SESSION['aDgcode'][$n]."' limit 0,1 "));

		$sql = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$_SESSION['aDgcode'][$n]."', '".$olddetail."', '".$detail."');";
		 $result = mysql_query($sql) or die("Query failed,INSERT orderdetail");

		 $clinicalinfo .=$_SESSION['aDgcode'][$n]." ,";
	 }

	 // ���� HDL � orderdetail
	if( $_GET['pro'] == '3' OR $_GET['pro'] == '4' ){
		
		// $labnumber = date("ymd").sprintf("%03d", $nLab_hdl);
		list($olddetail,$detail) = mysql_fetch_row(mysql_query("Select oldcode,detail From labcare where code = 'HDL' limit 0,1 "));
		$sql = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) 
		VALUES 
		('".date("ymd").sprintf("%03d", $nLab_hdl)."', 'HDL', '$olddetail', '$detail');";
		$result = mysql_query($sql) or die( "orderdetail : ".mysql_error() );
		// var_dump($result);
	}


////*runno ��Ǩ�آ�Ҿ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
////*runno ��Ǩ�آ�Ҿ*/////////

	  if($cDiag == "��Ǩ�آ�Ҿ")
			$clinicalinfo = "��Ǩ�آ�Ҿ��Шӻ�".$nPrefix;
	
	$sql = "Select sex, dbirth From opcard where hn = '".$cHn."' limit 0,1 ";
	$result = mysql_query($sql) or die("Query failed,update opday");
	list($sex, $dbirth) = mysql_fetch_row($result);

	if($sex == "�")
		$gender = "M";
	else if($sex == "�")
		$gender = "F";
	else
		$gender = "0";
	
		$priority = "R";

	
	$first_year = explode("-",$dbirth);
	$first_year[0] = $first_year[0]-543;
	if(checkdate($first_year[1],$first_year[2],$first_year[0])){
		$dbirth = $first_year[0].substr($dbirth,4);
	}else{
		$dbirth = date("Y-m-d");
	}
	
	$sql = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$cHn."', '".$patienttype."', '".$cPtname."', '".$gender."', '".$dbirth."', '".$sourcecode."', '".$sourcename."', '".$room."','".$cliniciancode."', '".$clinicianname."', '".$priority."', '".$clinicalinfo."');";
	$result = mysql_query($sql) or die("Query failed,INSERT orderhead ");

	$nLab++;
	$query ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
	$result = mysql_query($query) or die("Query failed");

	// ���� HDL � orderhead
	if( $_GET['pro'] == '3' OR $_GET['pro'] == '4' ){
		// $labnumber = date("ymd").sprintf("%03d", $nLab_hdl);
		$sql = "INSERT INTO `orderhead` 
		( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) 
		VALUES 
		('', '$Thidate2', '".date("ymd").sprintf("%03d", $nLab_hdl)."', '$cHn', '$patienttype', '$cPtname', '$gender', '$dbirth', '$sourcecode', '$sourcename', '$room','$cliniciancode', '$clinicianname', '$priority', '$clinicalinfo');";
		$result = mysql_query($sql) or die("orderhead : ".mysql_error());
	}

		
	////*runno queue lab*/////////
	$query = "SELECT runno,startday  FROM runno WHERE title = 'lab_qchk'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nRunno1=$row->runno;
	$nDate=$row->startday;
	$day = substr($nDate,0,10);
	$ddd=(date("Y")+543).date("-m-d");
	if($day!=$ddd){
		$nRunno1=1;
		$query ="UPDATE runno SET runno = '$nRunno1', startday = '$Thidate' WHERE title='lab_qchk'";
		$result = mysql_query($query) or die("Query failed");
		
		$query ="UPDATE chkup_solider SET qlab = '$nRunno1', lab = '$Thidate' WHERE hn='$cHn' and yearchkup='$nPrefix'";
		$result = mysql_query($query) or die("Query failed");
	}
	else{
		$nRunno1++;
	////*runno queue lab*/////////
		$query ="UPDATE runno SET runno = '$nRunno1', startday = '$Thidate' WHERE title='lab_qchk'";
		$result = mysql_query($query) or die("Query failed");
		
		$query ="UPDATE chkup_solider SET qlab = '$nRunno1', lab = '$Thidate' WHERE hn='$cHn' and yearchkup='$nPrefix'";
		$result = mysql_query($query) or die("Query failed");	
	}

	
   include("unconnect.inc");
   ///stricker

   echo "<font style='font-family:AngsanaUPC; font-size:16px;'>��Ǩ�آ�Ҿ����Ҫ��÷��û�Шӻ�$nPrefix&nbsp;Lab:$nRunno1<br>";
   echo "<b>HN:$cHn</b>&nbsp;($tvn)<br>";
   echo "<b>����:$cPtname<br>";
   echo "��ᾷ�� ��س���蹷����ͧ��Ъ�� 1<br>";
  // echo "��س���蹷����ͧ����¹��ѧ��� 12.45 �.</font>";
 //  echo "<br>";
   //stricker
   $ok=0;
   if($result){
   		if($getpro=="1" || $getpro=="2"){
		include("labslip4cbc_chkup.php");
		}else if($getpro=="3" || $getpro=="4"){
		include("labslip4cbc_chkup.php");
		include("labslip4bc_chkup.php");
		}
   }
?>
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
// setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*����������ԹҷչФ�Ѻ�ç�Ţ 5 */); 
</Script>
