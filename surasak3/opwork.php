<?php
session_start();
if (isset($sOfficer)){} else {die;} //for security

$thdatehn="";
$thidate2 = (date("Y")).date("-m-d H:i:s"); 
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$thidate3 = (date("Y")+543).date("-m-d"); 

$time=date("H:i:s");
session_register("thdatehn"); 
session_register("admit_vn"); 

include("connect.inc");   

$code21 = '21';

if(substr($_POST["case"],0,4) == "EX19"||substr($_POST["case"],0,4) == "EX35")
	$ok = 'Y';
else
	$ok = 'N';   


if(substr($_POST["case"],0,4) == "EX03"){  //��Ѥ��ç����ԡ���µç
	$R03true1 = "'1'";
	$R03true2 = " ,withdraw='1' ";	
}else{
	$R03true1 = "Null";
	$R03true2 = ""; 
}

Function calcage($birth){

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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

//$Y=($y-543);
//$dbirth="$Y-$m-$d";
$dbirth="$y-$m-$d"; //�觼�ҹ�������ѹ�Դ�ҡ opedit �¡�� submit
$cAge=calcage($dbirth);

//��Ǩ�ͺ�Ţ�ѵû�ЪҪ�
$sql = "Select hn From opcard where idcard='$idcard' AND hn<>'$cHn' limit 0,1 ";
$result = mysql_query($sql);
	if(mysql_num_rows($result) > 0 && strlen(trim($idcard)) == 13){
		list($chk_idcard) = mysql_fetch_row($result);
		echo "<SCRIPT LANGUAGE=\"JavaScript\">

		alert('�Ţ�ѵû�ЪҪ� $idcard �١���� HN : $chk_idcard ��سҵ�Ǩ�ͺ����繤�����ǡѹ�������');

		</SCRIPT>";
}
$where4="";
if($_POST['lockptright5']=="lock"){
	$where4 = ",ptright2='".$_POST['ptright']."' ";
}else{
	$where4 = ",ptright2='' ";
}
//update opdcard table
	$hospcode=$_POST['hospcode'];
	$ptrcode=$_POST['rdo1'];
	$typearea = $_POST['typearea'];

	$vstatus = $_POST['vstatus'];
	$father_id = $_POST['father_id'];
	$mother_id = $_POST['mother_id'];
	$couple_id = $_POST['couple_id'];


	//$note=$_POST['note'].'/'.$hospcode;
$employee = ( isset($_POST['employee']) && $_POST['employee'] === 'y' ) ? 'y' : 'n' ;

$sql = "UPDATE opcard SET idcard='$idcard',mid='$mid',hn='$cHn',
yot='$yot',name='$name',surname='$surname',education='$education',goup='$goup',married='$married',
dbirth='$dbirth',guardian='$guardian',idguard='$idguard',
nation='$nation',religion='$religion',career='$career',ptright='$ptright',ptright1='$ptright1',ptrightdetail='$ptrightdetail',address='$address',
tambol='$tambol',ampur='$ampur',changwat='$changwat',hphone='$hphone',
phone='$phone',father='$father',mother='$mother',couple='$couple',
note='$note',sex='$sex',camp='$camp',race='$race' ,ptf='$ptf',ptfadd='$ptfadd',
ptffone='$ptffone',ptfmon='$ptfmon',lastupdate='$thidate', blood='$blood',drugreact='$drugreact',  
officer ='".$_SESSION["sOfficer"]."' , hospcode='".$hospcode."', ptrcode ='$ptrcode',

employee='$employee', opcardstatus='$opcardstatus',`typearea` = '$typearea',`vstatus`='$vstatus',
`father_id`='$father_id',`mother_id`='$mother_id',`couple_id`='$couple_id' $where4 WHERE hn='$cHn' ";


$result = mysql_query($sql) or die("Query failed ipcard".mysql_error());

If (!$result){
	echo "update opcard fail";
	echo mysql_errno() . ": " . mysql_error(). "\n";
	echo "<br>";
} else {
	print " ��䢢��������º����: ";
}

//update xrayno table
$sql = "UPDATE xrayno SET name='$name',surname='$surname' WHERE hn='$cHn' ";

$result = mysql_query($sql) or die("Query failed xrayno");

//update xrayno table
$fname=$yot." ".$name." ".$surname;
$sql = "UPDATE bed SET ptname='$fname' WHERE hn='$cHn' limit 1";
$result = mysql_query($sql) or die("Query failed bed");

$sql = "UPDATE ipcard SET ptname='$fname' WHERE hn='$cHn'  limit 1";

$result = mysql_query($sql) or die("Query failed ipcard");

If (!$result){
	echo "update xrayno fail";
	echo mysql_errno() . ": " . mysql_error(). "\n";
	echo "<br>";
} else {
	print " ��䢢��������º��������: <br>";
}

//�Ң����Ũҡ opcard �ͧ $cHn ��������㹡ó�ŧ����¹���� �����ѧ���ŧ
$query = "SELECT * FROM opcard WHERE hn = '$cHn'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}

	if(!($row = mysql_fetch_object($result)))
	continue;
}

If ($result){
	//	      $cHn=$row->hn;
	$cYot = $row->yot;
 	$cIdcard = $row->idcard;
	$cName = $row->name;
	$cSurname = $row->surname;
	$cPtname=$cYot.' '.$cName.'  '.$cSurname;
	$cPtright = $row->ptright;
	$cGoup=$row->goup;
	$cCamp=$row->camp;
	$cNote=$row->note;
  	               $cIdguard=$row->idguard;
 
	echo "HN : $cHn, ����-ʡ��: $cYot   $cName  $cSurname<br>";  
	echo "<font face='Angsana New' size=4><b>�Է�ԡ���ѡ�� : $cPtright :<font face='Angsana New' size=5><u>$cIdguard</u></b></font><br> ";
       
	//       echo "�����Ţ�ѵ� ���.: $cIdcard  ";
 
	//   echo "�Ҥ����ش��������� $cLastupdate <br> ";
 	
	// echo "�����˵�.: $cNote <br> ";
//echo "<B>�����˵�.:.����Ǩ�ͺ�Է�Էء���駡�͹�͡������ </B><br> ";
}  
//

$today = date("d-m-Y");   
$d=substr($today,0,2);
$m=substr($today,3,2);
$yr=substr($today,6,4) +543;  
//  $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
$thdatehn=$d.'-'.$m.'-'.$yr.$cHn;   //  session �� update opday table
//    print "�ѹ���  $thidate<br>";
//    print " $thdatehn<br>";
//to find AN from runno table

$query = "SELECT title,prefix,runno FROM runno WHERE title = 'AN'";
$result = mysql_query($query) or die("Query failed runno ask");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}

	if(!($row = mysql_fetch_object($result)))
		continue;
}

$vTitle=$row->title;
$vPrefix=$row->prefix;
$nRunno=$row->runno;
$nRunno++;
$vAN=$vPrefix.$nRunno;

//�� VN �ҡ runno table
$query = "SELECT * FROM runno WHERE title = 'VN'";
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
$nVn=$row->runno;
$dVndate=$row->startday;
$dVndate=substr($dVndate,0,10);
$today = date("Y-m-d");  
//print "$today<br>";
//print "$dVndate<br>";
//print "$nVn.'A'<br>";
?>
 <script>
 	function chType(){
		var text5='<?=$_POST['case']?>';
		var text6 =text5.substring(0,4);
		if(text6=="EX12"){
			return confirm('�׹�ѹ��� admit ������\nan:<?=$vAN?>\nhn:<?=$cHn?> \n����:<? echo $yot?> <? echo $name?> <? echo $surname?>\n�Է��:<?=$ptright?>');
		}
		else{
			alert('��س����͡���������ŧ����¹���������١��ͧ\n㹡ó��Ѻ����������͡������ ��ù͹�ç��Һ��');
			return false;
		}
	}
 </script>
<?

//�óբ� vn ����
If ($_POST["new_vn"] == "1"){
	
	//�ѧ�������¹�ѹ���
	if($today==$dVndate){
		$nVn++;
		$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
		$query ="UPDATE runno SET runno = $nVn WHERE title='VN'";
		$result = mysql_query($query) or die("Query failed");
		print "<font face='Angsana New' size=5>�����������������Ţ VN = $nVn  .... </font> ...���ŧ����¹  ..........$sOfficer<br>";
		print "����͡ OPD CARD  = $case<br>";
	}

	//�ѹ����
	if($today<>$dVndate){    
		$nVn=1;
		$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
		$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
		$result = mysql_query($query) or die("Query failed");
		//   	         echo mysql_errno() . ": " . mysql_error(). "\n";
		//                       echo "<br>";
		print "����������  �� VN = $nVn <br>";
	}	
	
	// �Է�� ��� + ex46 ��Ǩ�آ�Ҿ
	$toborow = strtolower(substr($_POST['case'],0,4));
	$ptright = strtolower(substr($_POST['ptright'],0,3));
	$checkdx = '';
	if( $toborow == 'ex46' && $ptright == 'r07' ){
		$checkdx = "sso";
	}

//ŧ����¹� opday table
$opergcode='x';
	if(substr($_POST["case"],0,4) == "EX19"){  //EX19 �͡ VN ����(������ͧ)
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,diag,icd10,icd9cm,okopd,withdraw,opdreg)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer','D/S wound ','Z480','9357','Y',".$R03true1.",'$opergcode');";
	}else if(substr($_POST["case"],0,4) == "EX22"){  //EX22 ��Ǩ��š�д١
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,icd10,icd9cm,okopd,withdraw,opdreg)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer','Z138','8898','Y',".$R03true1.",'$opergcode');";
	}else if(substr($_POST["case"],0,4) == "EX40"){
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw,opdreg,checkdx)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.",'$opergcode','P');";
	}else{
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw,opdreg,checkdx)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.",'$opergcode','$checkdx');";
	}
		$result = mysql_query($query) or die("Query failed,cannot insert into opday");
		$opday_id = mysql_insert_id();

	
	//�Ѵ�红�����㹵��ҧ cliniceye �óշ�����͡ EX25
	if(substr($_POST["case"],0,4) == "EX25"){  //EX25 �ѡ��
	$today = date("Y-m-d H:i:s");
	$subtoday=substr($today,0,10);
	$sql="select * from cliniceye where date_time like '$subtoday%' && hn='$cHn' && vn='$nVn'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);
		if($num < 1){
		$add="insert into cliniceye set date_time='$today', hn='$cHn', vn='$nVn'";
		$query=mysql_query($add);
		}
	}	
	
		
		$query = "INSERT INTO opday2(thidate,thdatehn,hn,vn,thdatevn,ptname,age, ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.");";
		
		$result = mysql_query($query) or die("Query failed,cannot insert into opday");


	// update time to table opday
	$query ="UPDATE opday SET time1='$time' WHERE thdatehn = '$thdatehn' AND vn ='$nVn' ";
	$result = mysql_query($query);
	//        or die("Query failed runno update");

	$query1 = "SELECT status FROM typeopcard WHERE type_name = '".$_POST['case']."'";
	$result1 = mysql_query($query1) or die("Query failed");
	list($statustype)=mysql_fetch_array($result1);
	if($statustype=="Y"){
		$check = "select * from depart where hn = '".$cHn."' and  detail = '(55020/55021 ��Һ�ԡ�ü����¹͡)' and date like '".(date("Y")+543).date("-m-d")."%' ";
		$resultcheck = mysql_query($check);
		$cal = mysql_num_rows($resultcheck);
		if($cal==0){
		//runno  for chktranx
			$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
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
		
			$nRunno=$row->runno;
			$nRunno++;
		
			$query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
			$result = mysql_query($query) or die("Query failed");
				/////////////////////////////////////////////////////////////
			$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$cHn','','OTHER','1','(55020/55021 ��Һ�ԡ�ü����¹͡)', '50','50','0','','$sOfficer','0','$nVn','$cPtright');";
			$result = mysql_query($query);
			$idno=mysql_insert_id();
		 
			$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
VALUES('$thidate','$cHn','','$cPtname','1','SERVICE','(55020/55021 ��Һ�ԡ�ü����¹͡)','1','50','50','0','OTHER','OTHER','$idno','$cPtright');";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
			
			$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
      		$result = mysql_query($query) or die("Query failed,update opday");
		}
	}
}else{

$query = "SELECT row_id,hn,vn,kew,toborow FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC limit 0,1 ";
$result = mysql_query($query) or die("Query failed,opday");
//    echo mysql_errno() . ": " . mysql_error(). "\n";
//    echo "<br>";

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
}

if(!($row = mysql_fetch_object($result)))
	continue;
}	
$opday_id = $row->row_id;
$nVn=$row->vn;
$kew=$row->kew;
$toborow=$row->toborow;


if(substr($_POST["case"],0,4) == "EX19"){
$query ="UPDATE opday SET ptname='$cPtname',
ptright='$cPtright',
goup='$cGoup',
note='$note',
idcard='$cIdcard',
borow='$borow',
toborow='$case',
camp='$cCamp',
okopd='Y',  
officer='$sOfficer'
".$R03true2."
WHERE thdatehn = '$thdatehn' AND vn ='$nVn' ";
}else{

	// �Է�� ��� + ex46 ��Ǩ�آ�Ҿ
	$toborow = strtolower(substr($_POST['case'],0,4));
	$ptright = strtolower(substr($_POST['ptright'],0,3));
	$checkdx = '';
	if( $toborow == 'ex46' && $ptright == 'r07' ){
		$checkdx = ", `checkdx` = 'sso' ";
	}

	$query ="UPDATE opday SET ptname='$cPtname',
	ptright='$cPtright',
	goup='$cGoup',
	note='$note',
	idcard='$cIdcard',
	borow='$borow',
	toborow='$case',
	camp='$cCamp',
	okopd='N',  
	officer='$sOfficer'
	$checkdx
	".$R03true2."
	WHERE thdatehn = '$thdatehn' AND vn ='$nVn' ";

}

$result = mysql_query($query) or die("Query failed,update opday");
$sql = "Select count(row_id) as c_row From opday2 where thdatehn = '".$thdatehn."' AND toborow = '".$case."' limit 1 ";
list($c_row) = Mysql_fetch_row(Mysql_Query($sql));

if($c_row == 0){
	$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
	$query = "INSERT INTO opday2(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.");";
	$result = mysql_query($query) or die("Query failed,cannot insert into opday2");
}else{
	$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
	$query = "Update opday2 set thidate = '".$thidate."' where thdatevn = '".$thdatevn."' limit 1 ";
	$result = mysql_query($query) or die("Query failed,cannot insert into opday2");
}

	$query1 = "SELECT status FROM typeopcard WHERE type_name = '".$_POST['case']."'";
	$result1 = mysql_query($query1) or die("Query failed");
	list($statustype)=mysql_fetch_array($result1);
	if($statustype=="Y"){
		$check = "select * from depart where hn = '".$cHn."' and  detail = '(55020/55021 ��Һ�ԡ�ü����¹͡)' and date like '".(date("Y")+543).date("-m-d")."%' ";
		$resultcheck = mysql_query($check);
		$cal = mysql_num_rows($resultcheck);
		if($cal==0){
		//runno  for chktranx
			$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
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
		
			$nRunno=$row->runno;
			$nRunno++;
		
			$query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
			$result = mysql_query($query) or die("Query failed");
				/////////////////////////////////////////////////////////////
			$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$cHn','','OTHER','1','(55020/55021 ��Һ�ԡ�ü����¹͡)', '50','50','0','','$sOfficer','0','$nVn','$cPtright');";
			$result = mysql_query($query);
			$idno=mysql_insert_id();
		 
			$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
VALUES('$thidate','$cHn','','$cPtname','1','SERVICE','(55020/55021 ��Һ�ԡ�ü����¹͡)','1','50','50','0','OTHER','OTHER','$idno','$cPtright');";
			$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
			
			$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
      		$result = mysql_query($query) or die("Query failed,update opday");
		}
	}

print "<font face='Angsana New' size=10>��������ŧ����¹���º�������� <br>�� VN: $nVn ���Ƿ��..$kew...<br>����¹�ҡ ..$toborow..<br>�� ...".$_POST['case']."...</font>";
print "<br>���ŧ����¹ ..$sOfficer";
}


if(substr($_POST["case"],0,4)=="EX03"){  //�Դ��Һ�ԡ����Ѥ��ç����ԡ���µç�ѵ��ѵ�
	
	// �����ѹ����ѧ����դ�Ҹ������������Ѥ��ç��è��µç
	$sql = "SELECT a.`row_id`
	FROM `depart` AS a 
	LEFT JOIN `patdata` as b ON b.`idno` = a.`row_id` 
	WHERE a.`date` LIKE '$thidate3%' 
	AND a.`hn` = '$cHn' 
	AND a.`tvn` = '$nVn' 
	AND b.`detail` = '��Ҹ������������Ѥ��ç��è��µç'";
	$q = mysql_query($sql);
	$rows = mysql_num_rows($q);
	if( $rows === 0 ){

		//runno  for chktranx
		$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
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

		$nRunno=$row->runno;
		$nRunno++;

		$query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
		$result = mysql_query($query) or die("Query failed");
			/////////////////////////////////////////////////////////////
		$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$cHn','','OTHER','1','��Һ�ԡ�÷ҧ���ᾷ��', '30','0','30','','$sOfficer','0','$nVn','$cPtright');";
		$result = mysql_query($query);
		$idno=mysql_insert_id();
		
		$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
		VALUES('$thidate','$cHn','','$cPtname','1','cscd','��Ҹ������������Ѥ��ç��è��µç','1','30','0','30','OTHER','MC','$idno','$cPtright');";
		$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
		
		$query ="UPDATE opday SET other=(other+30) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
		$result = mysql_query($query) or die("Query failed,update opday");
	}
}



if($_POST["doctor50"]=="doctor50"){  //�Դ��Һ�ԡ�÷ҧ���ᾷ�� �͡�����Ҫ���
	
	// �����ѹ����ѧ����դ�Һ�ԡ�÷ҧ���ᾷ�� �͡�����Ҫ���
	$sql = "SELECT a.`row_id`
	FROM `depart` AS a 
	LEFT JOIN `patdata` as b ON b.`idno` = a.`row_id` 
	WHERE a.`date` LIKE '$thidate3%' 
	AND a.`hn` = '$cHn' 
	AND a.`tvn` = '$nVn' 
	AND b.`code` = 'clinic50'";
	$q = mysql_query($sql);
	$rows = mysql_num_rows($q);
	if( $rows === 0 ){

		//runno  for chktranx
		$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
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

		$nRunno=$row->runno;
		$nRunno++;

		$query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
		$result = mysql_query($query) or die("Query failed");
			/////////////////////////////////////////////////////////////
			
	$query = "SELECT * FROM labcare WHERE code = 'doctor50' ";
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
	    $aDepart=$row->depart; 
		$aPart=$row->part;
		$aCode=$row->code; 
	    $aDetail=$row->detail;
	    $aPrice=$row->price;
		$aYprice=$row->yprice;
		$aNprice=$row->nprice;
			
		$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$cHn','','$aDepart','1','$aDetail', '$aPrice','$aYprice','$aNprice','','$sOfficer','0','$nVn','$cPtright');";
		$result = mysql_query($query);
		$idno=mysql_insert_id();
		
		$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
		VALUES('$thidate','$cHn','','$cPtname','1','$aCode','$aDetail','1','$aPrice','$aYprice','$aNprice','$aDepart','$aPart','$idno','$cPtright');";
		$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
		
		$query ="UPDATE opday SET other=(other+$aPrice) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
		$result = mysql_query($query) or die("Query failed,update opday");
	}
}



if($_POST["doctor80"]=="doctor80"){  //�Դ��Һ�ԡ�÷ҧ���ᾷ�� �͡�����Ҫ���
	
	// �����ѹ����ѧ����դ�Һ�ԡ�÷ҧ���ᾷ�� �͡�����Ҫ���
	$sql = "SELECT a.`row_id`
	FROM `depart` AS a 
	LEFT JOIN `patdata` as b ON b.`idno` = a.`row_id` 
	WHERE a.`date` LIKE '$thidate3%' 
	AND a.`hn` = '$cHn' 
	AND a.`tvn` = '$nVn' 
	AND b.`code` = 'clinic80'";
	$q = mysql_query($sql);
	$rows = mysql_num_rows($q);
	if( $rows === 0 ){

		//runno  for chktranx
		$query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
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

		$nRunno=$row->runno;
		$nRunno++;

		$query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
		$result = mysql_query($query) or die("Query failed");
			/////////////////////////////////////////////////////////////
			
	$query = "SELECT * FROM labcare WHERE code = 'doctor80' ";
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
	    $aDepart=$row->depart; 
		$aPart=$row->part;
		$aCode=$row->code; 
	    $aDetail=$row->detail;
	    $aPrice=$row->price;
		$aYprice=$row->yprice;
		$aNprice=$row->nprice;
			
		$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('$nRunno','$thidate','$cPtname','$cHn','','$aDepart','1','$aDetail', '$aPrice','$aYprice','$aNprice','','$sOfficer','0','$nVn','$cPtright');";
		$result = mysql_query($query);
		$idno=mysql_insert_id();
		
		$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright)
		VALUES('$thidate','$cHn','','$cPtname','1','$aCode','$aDetail','1','$aPrice','$aYprice','$aNprice','$aDepart','$aPart','$idno','$cPtright');";
		$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
		
		$query ="UPDATE opday SET other=(other+$aPrice) WHERE thdatehn= '$thdatehn' AND vn = '".$nVn."' ";
		$result = mysql_query($query) or die("Query failed,update opday");
	}
}

// ��Ǩ�ͺ����Ѻവ dphardep �ó� �������ҩմ�ҵ�����ͧ
if(substr($_POST["case"],0,4) == "EX23"){
	$sql = "Select row_id From dphardep where hn = '".$cHn."' AND date like '".$thidate3."%' AND tvn = '' ";

	$result = mysql_query($sql);
	while(list($dphardep_id) = mysql_fetch_row($result)){
				mysql_query("update dphardep set tvn = '".$nVn."', date = '".$thidate."' where row_id = '".$dphardep_id."' limit 1 ");
				mysql_query("update ddrugrx set date = '".$thidate."'  where idno = '".$dphardep_id."'  ");
	}

}
$_SESSION['admit_vn']=$nVn;
//END 

// �红�������� PERSON 
// $db43 = mysql_connect(HOST, USER, PASS);
// mysql_select_db("43files", $db43);

$short_th_date = substr($thidate,0,10);
$date_hn = $short_th_date.$cHn;
$cid = trim($idcard);
$hn = $pid = $cHn;
$prename = trim($yot);
$name = trim($name);
$lname = trim($surname);
$sex = trim($sex);
$birth = trim($dbirth);
$mstatus = trim($married);
$occupation_new = trim($career);
$race = trim($race);
$nation = trim($nation);
$religion = trim($religion);
$education = trim($education);
// $father = trim($_POST['idcard_father']);
// $mother = trim($_POST['idcard_mother']);
// $couple = trim($_POST['idcard_couple']);
$father = NULL;
$mother = NULL;
$couple = NULL;
$abogroup = trim($blood);
$d_update = trim($thidate);
// $vstatus = $_POST['vstatus'];
$vstatus = NULL;

$telephone = str_replace(array(' ', '-'), '', trim($hphone));
$mobile = str_replace(array(' ', '-'), '', trim($phone));

$q = mysql_query("SELECT `id` FROM `PERSON` WHERE `date_hn` = '$date_hn' ");
if( mysql_num_rows($q) == 0 ){
	// insert 
	$sql = "INSERT INTO `PERSON` (
		`id`, `date_hn`, `HOSTPCODE`, `CID`, `PID`, `HID`, `PRENAME`, `NAME`, `LNAME`, `HN`, 
		`SEX`, `BIRTH`, `MSTATUS`, `OCCUPATION_OLD`, `OCCUPATION_NEW`, `RACE`, `NATION`, `RELIGION`, `EDUCATION`, `FSTATUS`, 
		`FATHER`, `MOTHER`, `COUPLE`, `VSTATUS`, `MOVEIN`, `DISCHARGE`, `DDISCHARGE`, `ABOGROUP`, `RHGROUP`, `LABOR`, 
		`PASSPORT`, `TYPEAREA`, `D_UPDATE`, `TELEPHONE`, `MOBILE`
	) VALUES (
		NULL, '$date_hn', '11512', '$cid', '$pid', NULL, '$prename', '$name', '$lname', '$hn', 
		'$sex', '$birth', '$mstatus', NULL, '$occupation_new', '$race', '$nation', '$religion', '$education', NULL, 
		'$father', '$mother', '$couple', '$vstatus', NULL, NULL, NULL, '$abogroup', NULL, NULL, 
		NULL, '$typearea', '$d_update', '$telephone', '$mobile'
	);";
	mysql_query($sql);
}else{ 
	$item = mysql_fetch_assoc($q);
	$person_id = $item['id'];
	// update
	$sql = "UPDATE `PERSON` SET 
	`date_hn`='$date_hn', `HOSTPCODE`='11512', `CID`='$cid', `PID`='$pid', `HID`=NULL, 
	`PRENAME`='$prename', `NAME`='$name', `LNAME`='$lname', `HN`='$hn', `SEX`='$sex', `BIRTH`='$birth', 
	`MSTATUS`='$mstatus', `OCCUPATION_OLD`=NULL, `OCCUPATION_NEW`='$occupation_new', `RACE`='$race', `NATION`='$nation', `RELIGION`='$religion', 
	`EDUCATION`='$education', `FSTATUS`=NULL, `FATHER`='$father', `MOTHER`='$mother', `COUPLE`='$couple', `VSTATUS`='$vstatus', 
	`MOVEIN`=NULL, `DISCHARGE`=NULL, `DDISCHARGE`=NULL, `ABOGROUP`='$abogroup', `RHGROUP`=NULL, `LABOR`=NULL, 
	`PASSPORT`=NULL, `TYPEAREA`='$typearea', `D_UPDATE`='$d_update', `TELEPHONE`='$telephone', `MOBILE`='$mobile' 
	WHERE (`id`='$person_id');";
	mysql_query($sql);
}
// ������红�������� PERSON 

// �红�������� ICF �Ѻ DISABILITY 
$disabid = trim($_POST['disabid']);
if( $disabid != '' ){ 

	// �Ѿഷ�ҹ�����ŷ���红����ż��ԡ��
    $icf = trim($_POST['icf']);
    $disabtype = trim($_POST['disabtype']);
    $disabcause = trim($_POST['disabcause']);

	$sql = "SELECT `id` FROM `disabled_user` WHERE `hn` = '$pid' ";
	$q = mysql_query($sql);
	$num_disuser = mysql_num_rows($q);
	if( $num_disuser > 0 ){
		$sql = "UPDATE `disabled_user` SET 
		`idcard` = '$cid', 
		`disabid` = '$disabid', 
		`icf` = '$icf', 
		`disabtype` = '$disabtype', 
		`disabcause` = '$disabcause', 
		`lastupdate` = NOW()  
		WHERE `hn` = '$pid' ";
		mysql_query($sql); 
	}else{ 
		$date_dis = date('Ymd');
		$sql = "INSERT INTO `disabled_user` (
			`id`, `hn`, `idcard`, `disabid`, `icf`, `disabtype`, `disabcause`, `date_detect`, `date_disab`, `lastupdate` 
		) VALUES (
			NULL, '$pid', '$cid', '$disabid', '$icf', '$disabtype', '$disabcause', '$date_dis', '$date_dis', NOW() 
		);";
		mysql_query($sql);
	
	}
	
	
	// �红�����ŧ��� icf
	$d_update = date('Ymdhis');
	$date_serv = date('Ymd');
	$seq = $date_serv.sprintf("%03d", $nVn);

	$sql = "SELECT `id` FROM `icf43` WHERE `opday_id` = '$opday_id' ";
	$q = mysql_query($sql);
	if ( mysql_num_rows($q) > 0 ) {
		
		$icf_item = mysql_fetch_assoc();
		$icf_id = $icf_item['id'];

		$sql = "UPDATE `icf43` SET 
		`disabid`='$disabid', 
		`pid`='$pid', 
		`seq`='$seq', 
		`date_serv`='$date_serv', 
		`icf`='$icf', 
		`d_update`='$d_update', 
		`cid`='$cid' 
		WHERE (`id`='$icf_id');";
		mysql_query($sql);
		
	} else {
		$sql = "INSERT INTO `icf43` (
			`id`, `hospcode`, `disabid`, `pid`, `seq`, `date_serv`, 
			`icf`, `qualifier`, `provider`, `d_update`, `cid`, `opday_id`
		) VALUES (
			NULL, '11512', '$disabid', '$pid', '$seq', '$date_serv', 
			'$icf', NULL, NULL, '$d_update', '$cid', '$opday_id'
		);";
		mysql_query($sql);

	} 

	// �红�����ŧ��� disability
	$sql = "SELECT `id` FROM `disability43` WHERE `opday_id` = '$opday_id' ";
	$q = mysql_query($sql);
	if ( mysql_num_rows($q) > 0 ) {
		// 
		$sql = "UPDATE `disability43` SET 
		`disabid`='$disabid', 
		`disabtype`='$disabtype', 
		`disabcause`='$disabcause', 
		`d_update`='$d_update' 
		WHERE (`id`='$dis_id');";
		mysql_query($sql);
		
	} else { 
		$sql = "INSERT INTO `disability43` (
			`id`, `hospcode`, `disabid`, `pid`, `disabtype`, `disabcause`, 
			`diagcode`, `date_detect`, `date_disab`, `d_update`, `cid`, `opday_id`
		) VALUES (
			NULL, '11512', '$disabid', '$pid', '$disabtype', '$disabcause', 
			NULL, '$date_serv', '$date_serv', '$d_update', '$cid', '$opday_id'
		);";
		mysql_query($sql);
	}
}
// �红�������� ICF �Ѻ DISABILITY 


// �ٻ�Ҿ
$dataf=$_FILES['filUpload']['tmp_name'];
$dataf_name=$_FILES['filUpload']['name'];
$dataf_size=$_FILES['filUpload']['size'];
$dataf_type=$_FILES['filUpload']['type'];
if(empty($dataf)){
	
	
}else{
$structure = '../image_patient';



					$ext=strtolower(end(explode('.',$dataf_name)));
					
					echo $ext;
					if($ext=="jpg"){
								
								$filename=$_POST['cIdcard'].".". $ext;
		
								copy($dataf, "$structure/$filename");
								
								//echo $structure.'/'.$_POST['cIdcard'].'.jpg';

						}else{
				
				//echo $filename;
				echo "<FONT SIZE=\"\" COLOR=\"#CC0000\"><B><CENTER>�������ö Upload �� ��س����͡������չ��ʡ�Ŵѧ���  .jpg</CENTER></B></FONT> ";
								}
					}			//�Դ���*/





?>
 

<br>1...��ǵ�Ǩ�ä�����&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="addQueue('kewadd.php')">��ǵ�Ǩ�ä����� (<?php $sql = "Select runno From runno where title ='kew' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_TOP href="kewadd2.php" onclick="addQueue()">��ǵ�Ǩ�ѹ�����(<?php $sql = "Select runno From runno where title ='kew2' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>) </a>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd3.php" onclick="addQueue()">����ٵ�(<?php $sql = "Select runno From runno where title ='kew3' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd7.php" onclick="addQueue()">��ǵ�Ǩ��(<?php $sql = "Select runno From runno where title ='kew7' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd_chkup.php" onclick="addQueue()">��ǵ�Ǩ�آ�Ҿ������ѧ�Ѵ��Шӻ�(<?php $sql = "Select runno From runno where title ='chekup' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;

<BR>
&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd6.php" onclick="addQueue()">��ǽ�����(<?php $sql = "Select runno From runno where title ='kew6' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd5.php" onclick="addQueue()">��š�д١(<?php $sql = "Select runno From runno where title ='kew5' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;
	
	&nbsp;&nbsp;&nbsp
	<?php
	$q = mysql_query("SELECT * FROM `runno` WHERE `title` = 'kewsold' ");
	$item = mysql_fetch_assoc($q);
	?>
	<a target="_target" href="kewadd_soldier.php" onclick="addQueue()">��ǵ�Ǩ�آ�Ҿ���þ�ҹ��Шӻ�(<?php echo $item['runno'];?>)</a>
	&nbsp;&nbsp;&nbsp
	
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd4.php">ź���</a>
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǥ�Թԡ�����&nbsp;&nbsp;&nbsp;<a target=_TOP href="keweye.php">�ѡ��(�) </a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewmed.php" onclick="addQueue()">���á���(�)(<?php $sql = "Select runno From runno where title ='kewmed' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="kewsurg.php" onclick="addQueue()">���¡���(�) </a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewogb.php" onclick="addQueue()">�ٵ�(�)(<?php $sql = "Select runno From runno where title ='kewogb' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewent.php" onclick="addQueue()">�� �� ��١(�)</a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewchild.php" onclick="addQueue()">������Ǫ(�)</a>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewortho.php" onclick="addQueue()">���¡�����д١(�)(<?php $sql = "Select runno From runno where title ='kewortho' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>
<br>2...�觢�����&nbsp;&nbsp;&nbsp;
<a target=_TOP href="sentkew.php" onclick="searchCard(event)" >�觢����Ť鹺ѵ� </a>&nbsp;&nbsp;&nbsp;
<a target=_TOP href="sentopd.php">�觢����ŤѴ�¡�ó��͡�������ͧ</a>

<br> <br>&nbsp;&nbsp;&nbsp;
<a target=_TOP href="rxform.php">����������� </a>&nbsp;&nbsp;&nbsp;
<a target=_TOP href="rxform9.php">�������������������� </a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint2.php?cHn=<?=$cHn;?>">�����ѵõ�ͻ���ѵԼ�����</a>&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint4.php">�����ѵõ�ͻ���ѵԼ�������á</a>
<br>
&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint.php">�����ѵõ�Ǩ�ä,�ѵü�����</a>
&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint1bc.php">�����ѵü�����</a>&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint6.php">����� ��.16/1</a>&nbsp;&nbsp;&nbsp;

<a target=_TOP href="edprint.php">���������ҹ͡�ѭ��</a>
&nbsp;&nbsp;&nbsp;<a target=_blank href="FR-IPC-001_8.php?cHn=<?=$cHn;?>">Ẻ����Ѻ�͹�ѡ�ҵ��</a><br>
&nbsp;&nbsp;&nbsp;
<a target=_TOP href="vnprint.php">������ ��Ǩ�ä</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target=_TOP href="vnprint_l.php">㺵Դ OPDCARD</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target=_blank href="opdfullprint.php">㺻���ѵ�Ẻ���</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target=_TOP href="opdprint7.php">���һ���ѵԡ���ѡ�Ҿ�Һ��</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target="_top" href="report_opt.php?cHn=<?=$cHn;?>">��Ѥè��µç ͻ�.</a><br />
&nbsp;&nbsp;&nbsp;&nbsp;<a target=_TOP href="opdcard_reg.php?cHn=<?=$cHn;?>&cVn=<?=$nVn;?>">㺵������ѹ</a><br><br><br>&nbsp;&nbsp;&nbsp;

<a  href="opipcard.php" onclick="return chType();">�Ѻ�����繤���� (admit)</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target=_TOP href="updatevn.php">����¹ VN  �ó� VN �����ҹ��</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a target=_TOP href="otherpage.php">���Թ����</a>

<?php 
include 'includes/config.php';




?>




<script type="text/javascript">

var queue = 0;

var card = 0;
function searchCard(ev){
	
	if( queue === 0 ){
		var c = confirm('�ѧ����顴��� �׹�ѹ�����觤鹺ѵ��������?');
		if( c === false ){
			SMPreventDefault(ev);
			return false;
		}else{
			queue = 1;
		}
	}
	
	if( card === 0 ){
		card = 1;
	}else{
		alert('�觤鹺ѵ����º��������');
		SMPreventDefault(ev);
	}
}

function addQueue(win_file){

	queue = 1;
	
	// �硡�͹����ա�����������������ֻ���
	win_file = typeof win_file !== 'undefined' ? win_file : false ;

	// ����դ����Դ popup
	if( win_file !== false ){
		window.open(win_file);
	}

}

function SMPreventDefault(ev){
	if( !ev.returnValue ){
		ev.returnValue = false; // For old IE(6,7,8,9)
	}else{
		ev.preventDefault();
	}
}
</script>
<?php
include("unconnect.inc");
?>
