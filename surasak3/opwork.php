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


if(substr($_POST["case"],0,4) == "EX03"){
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
	//$note=$_POST['note'].'/'.$hospcode;


$sql = "UPDATE opcard SET idcard='$idcard',mid='$mid',hn='$cHn',
yot='$yot',name='$name',surname='$surname',education='$education',goup='$goup',married='$married',
dbirth='$dbirth',guardian='$guardian',idguard='$idguard',
nation='$nation',religion='$religion',career='$career',ptright='$ptright',ptright1='$ptright1',ptrightdetail='$ptrightdetail',address='$address',
tambol='$tambol',ampur='$ampur',changwat='$changwat',hphone='$hphone',
phone='$phone',father='$father',mother='$mother',couple='$couple',
note='$note',sex='$sex',camp='$camp',race='$race' ,ptf='$ptf',ptfadd='$ptfadd',ptffone='$ptffone',ptfmon='$ptfmon',lastupdate='$thidate', blood='$blood',drugreact='$drugreact',  officer ='".$_SESSION["sOfficer"]."' , hospcode='".$hospcode."', ptrcode ='$ptrcode',opcardstatus='$opcardstatus' $where4 WHERE hn='$cHn' ";


$result = mysql_query($sql) or die("Query failed ipcard");

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
	
	//ŧ����¹� opday table
$opergcode='x';
	if(substr($_POST["case"],0,4) == "EX19"){
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,diag,icd10,icd9cm,okopd,withdraw,opdreg)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer','D/S wound ','Z480','9357','Y',".$R03true1.",'$opergcode');";
	}else if(substr($_POST["case"],0,4) == "EX22"){
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,icd10,icd9cm,okopd,withdraw,opdreg)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer','Z138','8898','Y',".$R03true1.",'$opergcode');";
	}else{
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,age,ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw,opdreg)VALUES('$thidate','$thdatehn','$cHn','$nVn',  '$thdatevn','$cPtname','$cAge','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer',".$R03true1.",'$opergcode');";
	}
		$result = mysql_query($query) or die("Query failed,cannot insert into opday");
	
	//�Ѵ�红�����㹵��ҧ cliniceye �óշ�����͡ EX25
	if(substr($_POST["case"],0,4) == "EX25"){
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

$query = "SELECT hn,vn,kew,toborow FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC limit 0,1 ";
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

// ��Ǩ�ͺ����Ѻ�� dphardep �ó� �������ҩմ�ҵ�����ͧ
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
 

<br>1...��ǵ�Ǩ�ä�����&nbsp;&nbsp;&nbsp;<a target=_TOP href="kewadd.php">��ǵ�Ǩ�ä����� (<?php $sql = "Select runno From runno where title ='kew' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_TOP href="kewadd2.php">��ǵ�Ǩ�ѹ�����(<?php $sql = "Select runno From runno where title ='kew2' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>) </a>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd3.php">����ٵ�(<?php $sql = "Select runno From runno where title ='kew3' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;

&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd7.php">��ǵ�Ǩ��(<?php $sql = "Select runno From runno where title ='kew7' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd_chkup.php">��ǵ�Ǩ�آ�Ҿ(<?php $sql = "Select runno From runno where title ='kewchild' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;

<BR>
&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd6.php">��ǽ�����(<?php $sql = "Select runno From runno where title ='kew6' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd5.php">��š�д١(<?php $sql = "Select runno From runno where title ='kew5' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;
	
	&nbsp;&nbsp;&nbsp
	<?php
	$q = mysql_query("SELECT * FROM `runno` WHERE `title` = 'kewsold' ");
	$item = mysql_fetch_assoc($q);
	?>
	<a target="_target" href="kewadd_soldier.php">��ǵ�Ǩ�آ�Ҿ����(<?php echo $item['runno'];?>)</a>
	&nbsp;&nbsp;&nbsp
	
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewadd4.php">ź���</a>
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǥ�Թԡ�����&nbsp;&nbsp;&nbsp;<a target=_TOP href="keweye.php">�ѡ��(�) </a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewmed.php">���á���(�)(<?php $sql = "Select runno From runno where title ='kewmed' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>
&nbsp;&nbsp;&nbsp;<a target=_TOP href="kewsurg.php">���¡���(�) </a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewogb.php">�ٵ�(�)(<?php $sql = "Select runno From runno where title ='kewogb' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewent.php">�� �� ��١(�)</a>&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewchild.php">������Ǫ(�)</a>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp<a target=_TOP href="kewortho.php">���¡�����д١(�)(<?php $sql = "Select runno From runno where title ='kewortho' ";
	$result = Mysql_Query($sql);
	list($akew) = Mysql_fetch_row($result);
	echo $akew ;   ?>)</a>
<br>2...�觢�����&nbsp;&nbsp;&nbsp;
<a target=_TOP href="sentkew.php">�觢����Ť鹺ѵ� </a>&nbsp;&nbsp;&nbsp;
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
include("unconnect.inc");
?>