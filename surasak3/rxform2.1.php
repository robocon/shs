<?php
session_start();
$thdatehn="";
session_register("thdatehn"); 

include("connect.inc");   

?>
<HTML>
<HEAD>
<TITLE> Print VN </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<script>
 ie4up=nav4up=false;
 var agt = navigator.userAgent.toLowerCase();
 var major = parseInt(navigator.appVersion);
 if ((agt.indexOf('msie') != -1) && (major >= 4))
   ie4up = true;
 if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))
   nav4up = true;
</script>

</HEAD>

<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>
<Script Language="JavaScript">
	function CloseWindowsInTime(t){
		t = t*1000;
		window.print();
		setTimeout("window.close()",t);
	}
	CloseWindowsInTime(2/*����������ԹҷչФ�Ѻ�ç�Ţ 5 */); 
</Script>

<?php
$ok = 'N';

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

//�Ң����Ũҡ opcard �ͧ $cHn ��������㹡ó�ŧ����¹���� �����ѧ���ŧ
$_SESSION["cHn"] = $_GET["cHn"];
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
  


	$cCbirth =$row->cbirth; // (�ѹ�Դ��ͤ���������)
	$cDbirth =$row->dbirth;
	$cD=substr($cDbirth,8,2);
	$cM=substr($cDbirth,5,2); 
	$cY=substr($cDbirth,0,4); 
	$dbirth="$cY-$cM-$cD"; //�觼�ҹ�������ѹ�Դ�ҡ opedit �¡�� submit
	$cAge=calcage($dbirth);


	$cIdguard=$row->idguard;
 
	// echo "HN : $cHn, ����-ʡ��: $cYot   $cName  $cSurname<br>";  
	// echo "<font face='Angsana New' size=4><b>�Է�ԡ���ѡ�� : $cPtright :<font face='Angsana New' size=5><u>$cIdguard</u></b></font><br> ";
       //        echo "�����Ţ�ѵ� ���.: $cIdcard <br> ";
 		// echo "�����˵�.: $cNote <br> ";
//echo "<B>�����˵�.:.����Ǩ�ͺ�Է�Էء���駡�͹�͡������ </B><br> ";
}  


$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate1=date("dm").(date("Y"));
$today = date("d-m-Y");   
$d=substr($today,0,2);
$m=substr($today,3,2);
$yr=substr($today,6,4) +543;  
//  $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
$thdatehn=$d.'-'.$m.'-'.$yr.$cHn;   //  session �� update opday table
// print "�ѹ���  $thidate<br>";
//    print " $thdatehn<br>";

//to find AN from runno table
$query = "SELECT title,prefix,runno FROM runno WHERE title = 'AN'";
$result = mysql_query($query) or die("Query failed runno ask");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)){
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

//$cTitle=$row->title;  //=VN
$nVn=$row->runno;
$dVndate=$row->startday;
$dVndate=substr($dVndate,0,10);
$today = date("Y-m-d");  
//print "$today<br>";
//print "$dVndate<br>";
//print "$nVn.'A'<br>";

// ��Ǩ����� �ѹ���ŧ����¹�����ѧ
$query = "SELECT hn,vn FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC ";
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

//�ó��ѧ���ŧ����¹
If (empty($row->hn)){
//�ѧ�������¹�ѹ���
	if($today==$dVndate){
		$nVn++;
		$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
		$query ="UPDATE runno SET runno = $nVn WHERE title='VN'";
		$result = mysql_query($query) or die("Query failed");
		print "�������Ţ VN = $nVn  ........  ...����Ǩ�ͺ�Է��  ..........$sOfficer<br>";
		//  print "����͡ OPD CARD  = $case<br>";
	}
//�ѹ����

	if($today<>$dVndate){    
		$nVn=1;
		$thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
		$query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
		$result = mysql_query($query) or die("Query failed");
		//   	         echo mysql_errno() . ": " . mysql_error(). "\n";
		//                       echo "<br>";
		// print "�ѹ����  ����� VN = $nVn <br>";
	}	
//ŧ����¹� opday table
	$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,
	ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer)VALUES('$thidate','$thdatehn','$cHn','$nVn',
	'$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer');";
	$result = mysql_query($query) or die("Query failed,cannot insert into opday");
}else{

	$nVn=$row->vn;
	$query ="UPDATE opday SET phaok='$ok'  WHERE thdatehn = '$thdatehn' AND vn = '".$nVn."' ";
	$result = mysql_query($query) or die("Query failed,update opday");

	//print "VN: $nVn ŧ����¹仡�͹����......����Ǩ�ͺ�Է��  ..........$sOfficer";
}

// �Դʶҹ���ѧ�ҡ����ԡ�����
$sql = "SELECT `id`,`hn` FROM `opcard_update` WHERE `hn` = '$cHn' AND `status` = 'Y' ";
$q = mysql_query($sql) or die( mysql_error() );
$op_rows = mysql_num_rows($q);
if( $op_rows == 0 ){
	$op_item = mysql_fetch_assoc($q);
	$op_id = $op_item['id'];

	$op_update_sql = "UPDATE `opcard_update`
	SET `status` = 'N'
	WHERE `id` = '$op_id';";
	mysql_query($op_update_sql) or die( mysql_error() );
}

include("unconnect.inc");
/////rxform.php

include("opd/class_printvn.php");
$classopd = new printvn();
$classopd->input_hn($_SESSION["cHn"]);
$classopd->outputprint();

?>

