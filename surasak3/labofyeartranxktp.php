<body Onload="window.print();">

<?php
    session_start();
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
	      $cPtright = "R01 �Թʴ";
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
				$sql = "select code,detail,price,yprice,nprice,depart,part from labcare where code = '".$_SESSION['aDgcode'][$n]."' ";
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


//test 9/4/47 to find the last row
//printf ("Last inserted record has id %d\n",mysql_insert_id());
  $idno=mysql_insert_id();
//print "<br>$idno <br>";
//test 9/4/47 to find the last row

//insert data into patdata
    for($n=0; $n<$x; $n++){
		if(!empty($_SESSION['aDgcode'][$n])){
			$sql = "select code,detail,price,yprice,nprice,depart,part from labcare where code = '".$_SESSION['aDgcode'][$n]."' ";
			$row = mysql_query($sql);
			list($code,$detail,$price,$yprice,$nprice,$depart,$part) = mysql_fetch_array($row);
			$query = "INSERT INTO patdata(date,hn,an,ptname,doctor,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('$Thidate','$cHn','$cAn','$cPtname','$cDoctor','$item','$code','$detail','1','$price','$yprice','$nprice','$depart','$part','$idno','$cPtright');";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");

        }
	}

// in case of inpatient insert data into ipacc

//update data in opday 

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
   $drsql="select drchkup from chkup_solider where hn='$cHn' and yearchkup='$nPrefix'";
   //echo $drsql;
   $drquery=mysql_query($drsql);
	list($drchkup)=mysql_fetch_array($drquery);

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

/*	if($camp=="D04 ʧ.ʴ.��.�.�."){
		$showdate="�. 10 �.�. 57";
	}else if($camp=="D08 ���.���.32" || $camp=="D15 ���.���.32" || $camp=="D09 ���.���.32"){
		$showdate="�. 12 �.�. 57";
	}else if($camp=="D10 �ʡ.���.32" || $camp=="D03 ���.���.32" || $camp=="D14 ���.���.32"){
		$showdate="��. 13 �.�. 57";
	}else if($camp=="D13 ��.���.32"){
		$showdate="�. 14 �.�. 57";	
	}else if($camp=="D17 ���.���.32" || $camp=="D12 ����.���.32" || $camp=="D11 ���.���.32" || $camp=="D16 ��Ȩ.���.32" || $camp=="D18 ���.���.32"){
		$showdate="�. 17 �.�. 57";	
	}else if($camp=="D19 ��.�.���.32" || $camp=="D23 ���.���.32" || $camp=="D25 ��þ���ѧ ���.32" || $camp=="D21 �ͧ è.���.32"){
		$showdate="�. 18 �.�. 57";	
	}else if($camp=="D20 ���.���.32" || $camp=="D02 ��� ��� ͡.��� ���.32"){
		$showdate="�. 19 �.�. 57";	
	}else if($camp=="D26 ����.���.32"){
		$showdate="��. 20 �.�. 57";	
	}else if($camp=="D24 ʢ�.���.32" || $camp=="D27 �ʾ.���.32"){
		$showdate="�. 21 �.�. 57";	
	}else if($camp=="D28 ��.��.���.32" || $camp=="D07 ���.���.32" || $camp=="D06 �¡.���.32"){
		$showdate="�. 24 �.�. 57";	
	}else if($camp=="D05 ���.���.32"){
		$showdate="�. 25 �.�. 57";	
	}else if($camp=="D22 ����.��.���.32"){
		$showdate="�. 25 �.�. 57 - �. 26 �.�. 57";	
	}else if($camp=="D29 Ƚ.�ȷ.���.32"){
		$showdate="��. 27 �.�. 57 - �. 28 �.�. 57";	
	}else if($camp=="D32 ����.�þ.3"){
		$showdate="�. 8 �.�. 57 - �. 9 �.�. 57";	
	}else if($camp=="D31 �.�ѹ.4 ����4"){
		$showdate="��. 11 �.�. 57 - �. 12 �.�. 57";	
	}else if($camp=="D30 �.17 �ѹ.2"){
		$showdate="�. 15 �.�. 57 - �. 16 �.�. 57";	
	}else if($camp=="D01 þ.��������ѡ��������"){
		$showdate="�. 18 �.�. 57 - �. 22 �.�. 57";	
	}else{
		$showdate="�. 23 �.�. 57";	
	}*/

   echo "<font style='font-family:AngsanaUPC; font-size:16px;'>��Ǩ�آ�Ҿ���û�Шӻ�$nPrefix&nbsp;Lab:$nRunno1<br>";
   echo "<b>HN:$cHn</b>&nbsp;($tvn)<br>";
   echo "<b>����:$cPtname<br>";
   //echo "��ᾷ�� ��س���蹷����ͧ��Ъ�� 1<br>";
  // echo "��س���蹷����ͧ����¹��ѧ��� 12.45 �.</font>";
 //  echo "<br>";
   //stricker
   $ok=0;
   if($result){
   		if($getpro=="1" || $getpro=="2"){
		include("labslip4cbc1.php");
		}else if($getpro=="3" || $getpro=="4"){
		include("labslip4cbc1.php");
		include("labslip4bc1.php");
		}
   }
?>
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*����������ԹҷչФ�Ѻ�ç�Ţ 5 */); 
</Script>
