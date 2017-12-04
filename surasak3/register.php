<?php
session_start();
include("connect.inc");

//variable
session_register("thdatehn"); 
session_register("nRunno");  
session_register("vAN");
session_register("cHn");  
session_register("cPtname");
session_register("cPtright");
session_register("cPtright1");
session_register("nVn");  
session_register("cAge");  
session_register("cNote");  
session_register("cIdcard");  
session_register("cIdguard");  

$toborow["EX01"] = "EX01 รักษาโรคทั่วไปในเวลาราชการ";
$toborow["EX02"] = "EX02 ผู้ป่วยฉุกเฉิน";
$toborow["EX03"] = "EX03 สมัครโครงการจ่ายตรง";
$toborow["EX04"] = "EX04 ผู้ป่วยนัด";

//$toborow["EX05"] = "EX05 ยืมไม่เอาใบสั่งยา";
$toborow["EX05"] = "EX05 ยืม";

$toborow["EX06"] = "EX06 คัดกรองแพ้ยา";
$toborow["EX07"] = "EX07 ทันตกรรม";
$toborow["EX08"] = "EX08 สูติ";
$toborow["EX09"] = "EX09 ผ่าตัด";
$toborow["EX10"] = "EX10 ไตเทียม";
$toborow["EX11"] = "EX11 รักษาโรคนอกเวลาราชการ";
$toborow["EX12"] = "EX12 นอนโรงพยาบาล";
$toborow["EX13"] = "EX13 เลื่อนนัด";
$toborow["EX14"] = "EX14 อัลตร้าซาวด์";
$toborow["EX15"] = "EX15 ออก VN";
$toborow["EX16"] = "EX16 ตรวจสุขภาพ";
$toborow["EX17"] = "EX17 กายภาพบำบัด";
$toborow["EX18"] = "EX18 ออกใบแทน";
$toborow["EX19"] = "EX19 ออก VN ทำแผล";
$toborow["EX20"] = "EX20 นวดแผนไทย";
$toborow["EX21"] = "EX21 dripยา";

	$_SESSION["thdatehn"]="";
	$thidate2 = (date("Y")).date("-m-d H:i:s"); 
	$thidate = (date("Y")+543).date("-m-d H:i:s"); 

	$time=date("H:i:s");
	

	$today = date("d-m-Y");   
	$d=substr($today,0,2);
	$m=substr($today,3,2);
	$yr=substr($today,6,4) +543;  
	$_SESSION["thdatehn"] = $d.'-'.$m.'-'.$yr.$_GET["hn"];  
	$code21 = '21';

$query = "SELECT hn, yot, idcard, name, surname, ptright, goup, camp, note, idguard FROM opcard WHERE hn = '".$_GET["hn"]."' limit 1";

$result = mysql_query($query) or die("Query failed");

list( $cHn, $cYot, $cIdcard, $cName, $cSurname, $cPtright, $cGoup, $cCamp, $cNote, $cIdguard) = Mysql_fetch_row($result);

$cPtname=$cYot.' '.$cName.'  '.$cSurname;

$ok = 'N';   
$R03true1 = "Null";
$R03true2 = ""; 

	switch($_GET["ex"]){

		case "EX19": $ok = 'Y'; break;
		case "EX03": $R03true1 = "'1'"; $R03true2 = " ,withdraw='1' "; break;

	}

$query = "SELECT hn,vn,kew,toborow FROM opday WHERE thdatehn = '".$_SESSION["thdatehn"]."' Order by row_id DESC limit 0,1 ";

$result = mysql_query($query) or die("Query failed,opday");
$rows = Mysql_num_rows($result);

if($rows > 0){//เคยลงทะเบียนแล้ว

	$arr = Mysql_fetch_assoc($result);
	$_SESSION["nVn"] = $arr["vn"];
	$query =" UPDATE opday SET  toborow='".$toborow[$_GET["ex"]]."', okopd='".$ok."', officer='".$_SESSION["sOfficer"]."' ".$R03true2." WHERE thdatehn = '".$_SESSION["thdatehn"]."' AND vn ='".$_SESSION["nVn"]."' limit 1 ";

	$result = mysql_query($query) or die("Query failed,update opday");

}else{//ลงทะเบียนครั้งแรก
	
	$query = "SELECT runno, startday FROM runno WHERE title = 'VN'";
	$result = mysql_query($query) or die("Query failed");
	list($_SESSION["nVn"], $dVndate) = Mysql_fetch_row($result);

	$dVndate=substr($dVndate,0,10);
	$today = date("Y-m-d");  


	//ยังไม่เปลี่ยนวันที่
	if($today==$dVndate){
		$_SESSION["nVn"]++;
		$thdatevn=$d.'-'.$m.'-'.$yr.$_SESSION["nVn"];
		$query ="UPDATE runno SET runno = ".$_SESSION["nVn"]." WHERE title='VN'";
		$result = mysql_query($query) or die("Query failed");
		//print "<font face='Angsana New' size=5>ผู้ป่วยใหม่ได้หมายเลข VN = ".$_SESSION["nVn"]."  .... </font> ...ผู้ลงทะเบียน  ..........$_SESSION["sOfficer"]<br>";
		//print "การออก OPD CARD  = $case<br>";
	}

	//วันใหม่
	if($today<>$dVndate){    
		$_SESSION["nVn"]=1;
		$thdatevn=$d.'-'.$m.'-'.$yr.$_SESSION["nVn"];
		$query ="UPDATE runno SET runno = ".$_SESSION["nVn"]." ,startday=now()  WHERE title='VN'";

		$result = mysql_query($query) or die("Query failed");
		//   	         echo mysql_errno() . ": " . mysql_error(). "\n";
		//                       echo "<br>";
		//print "ผู้ป่วยใหม่  ได้ VN = ".$_SESSION["nVn"]." <br>";
	}	

	if(substr($_POST["case"],0,4) == "EX19"){
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,  ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,icd10,icd9cm,okopd,withdraw)VALUES('".$thidate."','".$_SESSION["thdatehn"]."','".$cHn."','".$_SESSION["nVn"]."',  '".$thdatevn."','".$cPtname."','".$cPtright."','".$cGoup."','".$cCamp."','".$note."','".$cIdcard."','".$toborow[$_GET["ex"]]."','".$borow."','".$code21."','".$_SESSION["sOfficer"]."','Z480','9357','Y',".$R03true1.");";
	}else{
		$query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,  ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer,withdraw)VALUES('$thidate','".$_SESSION["thdatehn"]."','$cHn','".$_SESSION["nVn"]."',  '$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$note','$cIdcard','".$toborow[$_GET["ex"]]."','$borow','$code21','".$_SESSION["sOfficer"]."',".$R03true1.");";
	}
		
		echo $query,"<BR>";
		$result = mysql_query($query) or die("Query failed,cannot insert into opday");
		
		$query ="UPDATE opday SET time1='$time' WHERE thdatehn = '".$_SESSION["thdatehn"]."' AND vn ='".$_SESSION["nVn"]."' ";
		$result = mysql_query($query);
		echo $query,"<BR>";

}

if(isset($_GET["kew"]) && $_GET["kew"] !=""){
	$query = "SELECT title,prefix,runno FROM runno WHERE title = '".$_GET["kew"]."'";
    $result = mysql_query($query) or die("Query failed runno ask");
	list($vTitle, $vPrefix, $nRunno) = Mysql_fetch_row($result);

    $nRunno++;
    $vkew1=$nRunno;
	$vkew12=$vPrefix.$nRunno;


// update kew to table runno
    $query ="UPDATE runno SET runno = ".$nRunno." WHERE title='".$_GET["kew"]."'";
    $result = mysql_query($query);
//        or die("Query failed runno update");

// ใส่ kew ใน opday table 
    $query ="UPDATE opday SET kew = '".$vkew12."' WHERE thdatehn = '".$_SESSION["thdatehn"]."' AND vn = '".$_SESSION["nVn"]."' "; 
   $result = mysql_query($query);
}

?>
<HTML>
<HEAD>
<TITLE>ลงทะเบียน ผู้ป่วย</TITLE>
<style type="text/css">
<!--
.title_tb {
	background-color:#66CDAA;
	color: #FFFF66;
	font-weight: bold;
	font-family: "ms Sans Serif"; font-size: 16; 
}

.detail_tb {font-size: 16;
	background-color:#FFFFFF;
}
-->
</style>
</HEAD>

<BODY bgcolor="#FFFFDD">

<BR>
<TABLE bgcolor="#FFFFFF" align="center" width="600">
<TR class="title_tb">
	<TD colspan="2">ลงทะเบียนเรียบร้อยแล้ว</TD>
</TR>
<TR class="detail_tb">
	<TD colspan="2" align="center">&nbsp;</TD>
</TR>
<TR class="detail_tb">
	<TD align="right">VN :</TD>
	<TD><?php echo $_SESSION["nVn"];?></TD>
</TR>
<TR class="detail_tb">
	<TD align="right">HN :</TD>
	<TD><?php echo $hn;?></TD>
</TR>
<TR class="detail_tb">
	<TD align="right">ชื่อ - สกุล :</TD>
	<TD><?php echo $cPtname;?></TD>
</TR>
<TR class="detail_tb">
	<TD align="right">สิทธิ์การรักษา :</TD>
	<TD><?php echo $cPtright;?></TD>
</TR>
<TR class="detail_tb">
	<TD colspan="2" align="center"><?php echo $idguard;?></TD>
</TR>
<TR class="detail_tb">
	<TD align="right">ผู้ลงทะเบียน :</TD>
	<TD><?php echo $_SESSION["sOfficer"];?></TD>
</TR>
<TR class="detail_tb">
	<TD colspan="2" align="center">&nbsp;</TD>
</TR>
</TABLE>

</BODY>
</HTML>