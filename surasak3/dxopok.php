<?php
    session_start();
    include("connect.inc");
	if($sOfficer == ""){
		echo "<CENTER>ขออภัยครับการ Login ของท่านหมดระยะเวลาแล้ว <BR>กรุณา Login ใหม่ด้วยครับ <A HREF=\"../sm3.php\">กลับหน้าแรก</A></CENTER>";
		exit();
	}
function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}
	?>
<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="1;URL=opdcardnohn.php?hnno=<?php echo $_POST["hn"];?>">
</head>



<?php

/*
CREATE TABLE opday (
  row_id int(11) NOT NULL auto_increment,
  thidate datetime default NULL,
  thdatehn varchar(20) default NULL,
  hn varchar(12) NOT NULL default '',
  vn varchar(5) default NULL,
  thdatevn varchar(13) default NULL,
  an varchar(12) default NULL,
  ptname varchar(30) default NULL,
  ptright varchar(32) default NULL,
  goup varchar(24) default NULL,
  camp varchar(24) default NULL,
  dxgroup char(2) default NULL,
  diag varchar(40) default NULL,
  icd10 varchar(8) default NULL,
  doctor varchar(40) default NULL,
  PRIMARY KEY  (row_id),
  KEY thdatehn (thdatehn),
  KEY thdatevn (thdatevn)
) TYPE=MyISAM;
*/
//update data in opday
$icd10_1=substr($icd10,0,1);
$icd10_2=substr($icd10,1,1);
$icd10_3=substr($icd10,0,2);
if($icd10_1=='A' ){$dxgroup1='1';}
else if($icd10_1=='B' ){$dxgroup1='1';}
else if($icd10_1=='C' ){$dxgroup1='2';}
else if($icd10_1=='D' ){
	if($icd10_2 <='5' ){$dxgroup1='2';}else {$dxgroup1='3';};
	}
else if($icd10_1=='E' ){$dxgroup1='4';}
else if($icd10_1=='F' ){$dxgroup1='5';}
else if($icd10_1=='G' ){$dxgroup1='6';}
else if($icd10_1=='H' ){
	if($icd10_2 <='6' ){$dxgroup1='7';}else {$dxgroup1='8';};
}
else if($icd10_1=='I' ){$dxgroup1='9';}
else if($icd10_1=='J' ){$dxgroup1='10';}
else if($icd10_1=='K' ){$dxgroup1='11';}
else if($icd10_1=='L' ){$dxgroup1='12';}
else if($icd10_1=='M' ){$dxgroup1='13';}
else if($icd10_1=='N' ){$dxgroup1='14';}
else if($icd10_1=='O' ){$dxgroup1='15';}
else if($icd10_1=='P' ){$dxgroup1='16';}
else if($icd10_1=='Q' ){$dxgroup1='17';}
else if($icd10_1=='R' ){$dxgroup1='18';}
else if($icd10_1=='X' ){ 
	if($icd10_3 =='X4' ){$dxgroup1='19';}
	else if($icd10_3 =='X6' ){$dxgroup1='19';}
	else if($icd10_3 =='X8' ){$dxgroup1='19';}
	else if($icd10_3 =='X9' ){$dxgroup1='19';}
	else {$dxgroup1='21';};
}
else {$dxgroup1='21';};

$thidate=(date("Y")+543).date("-m-d H:i:s");
$clinic = $_POST['clinic'];

        $query ="UPDATE opday SET goup='$goup', 
  		                        dxgroup = '$dxgroup1',
  		                        icd10 = '".$_POST["icd10"]."',  
								okopd = 'Y',
								icd9cm = '".$_POST['icd9cm0']."',
								doctor = '$doctor1',
								clinic = '$clinic',
								icd101 = '$icd101', 
								officer2='$sOfficer',
								diag='".jschars($_POST["diag"])."',
								diagtype='$diagtype',
								`diag_morbidity` = '".$_POST["dt_icd10_morbidity0"]."',
								`diag_complication` = '".$_POST["dt_diag_complication0"]."',
								`diag_other` = '".$_POST["dt_diag_other0"]."',
								`external_cause` = '".$_POST["dt_diag_external0"]."',
								`icd10_complication` = '".$_POST["dt_icd10_complication0"]."',
								`icd10_other` = '".$_POST["dt_icd10_other0"]."',
								`icd10_external_cause` = '".$_POST["dt_icd10_external0"]."' 
								WHERE  thdatehn='".$_POST['Tdate']."' AND vn = '".$_POST["cVn"]."' ";

		$result = mysql_query($query) or die("Query failed,update druglst");
		

		$regisdate_en = $svdate_en = date('Y-m-d');

//print_r($_POST);
if($_POST['prin']==""){
	$strsql1="INSERT INTO diag ( regisdate , hn , an , diag , icd10 , type , office ,diag_thai,svdate,status,regisdate_en,svdate_en)
VALUES ('".$thidate."', '".$hn."', '".$cVn."', '".jschars($_POST['diag'])."', '".$_POST['icd10']."','PRINCIPLE', '".$_SESSION['sOfficer']."','".jschars($_POST['thaiprin'])."','".$_POST['cTdate']."','Y','$regisdate_en','$svdate_en')";
	$result1 = mysql_query($strsql1)or die(mysql_error());
}elseif($_POST['icd10']==""&&$_POST['diag']==""){
	$update1="UPDATE diag SET status='N' WHERE row_id='".$_POST['prin']."' ";	
	$result1 = mysql_query($update1);
}else{
	$update1="UPDATE diag SET icd10='".$_POST['icd10']."', diag='".jschars($_POST['diag'])."',diag_thai='".jschars($_POST['thaiprin'])."' WHERE row_id='".$_POST['prin']."' ";	
	$result1 = mysql_query($update1);
	
}

for($k=0;$k<16;$k++){
	if($_POST['dt_diag_morbidity'.$k]!=""){
		$strsql1="INSERT INTO diag ( regisdate , hn , an , diag , icd10 , type , office ,diag_thai,svdate,status,regisdate_en,svdate_en) VALUES ('".$thidate."', '".$hn."', '".$cVn."', '".jschars($_POST['dt_diag_morbidity'.$k])."', '".$_POST['dt_icd10_morbidity'.$k]."','CO-MORBIDITY', '".$_SESSION['sOfficer']."','".jschars($_POST['thaicomo'.$k])."','".$_POST['cTdate']."','Y','$regisdate_en','$svdate_en')";
		
		$result1 = mysql_query($strsql1)or die(mysql_error());
	}
}

for($k=0;$k<16;$k++){
	if($_POST['dt_diag_morbiditya'.$k]!=""){
		$update1="UPDATE diag SET icd10='".$_POST['dt_icd10_morbiditya'.$k]."', diag='".jschars($_POST['dt_diag_morbiditya'.$k])."',diag_thai='".jschars($_POST['thaicomo'.$k])."' WHERE row_id='".$_POST['como'.$k]."' ";	
		$result1 = mysql_query($update1);
	}elseif($_POST['dt_icd10_morbiditya'.$k]==""&&$_POST['dt_diag_morbiditya'.$k]==""){
		$update1="UPDATE diag SET status='N' WHERE row_id='".$_POST['como'.$k]."' ";	
		$result1 = mysql_query($update1);
	}
}

for($k=0;$k<16;$k++){
	if($_POST['dt_diag_complication'.$k]!=""){
			$strsql1="INSERT INTO diag ( regisdate , hn , an , diag , icd10 , type , office ,diag_thai,svdate,status,regisdate_en,svdate_en)
	VALUES ('".$thidate."', '".$hn."', '".$cVn."', '".jschars($_POST['dt_diag_complication'.$k])."', '".$_POST['dt_icd10_complication'.$k]."','COMPLICATION', '".$_SESSION['sOfficer']."','".jschars($_POST['thaicompli'.$k])."','".$_POST['cTdate']."','Y','$regisdate_en','$svdate_en')";
			$result1 = mysql_query($strsql1)or die(mysql_error());
	}
}

for($k=0;$k<16;$k++){
	if($_POST['dt_diag_complicationa'.$k]!=""){
		$update1="UPDATE diag SET icd10='".$_POST['dt_icd10_complicationa'.$k]."', diag='".jschars($_POST['dt_diag_complicationa'.$k])."',diag_thai='".jschars($_POST['thaicompli'.$k])."' WHERE row_id='".$_POST['compli'.$k]."' ";	
		$result1 = mysql_query($update1);
	}elseif($_POST['dt_icd10_complicationa'.$k]==""&&$_POST['dt_diag_complicationa'.$k]==""){
		$update1="UPDATE diag SET status='N' WHERE row_id='".$_POST['compli'.$k]."' ";	
		$result1 = mysql_query($update1);
	}
}

for($k=0;$k<16;$k++){
	if($_POST['dt_diag_other'.$k]!=""){
		$strsql1="INSERT INTO diag ( regisdate , hn , an , diag , icd10 , type , office ,diag_thai,svdate,status,regisdate_en,svdate_en) VALUES ('".$thidate."', '".$hn."', '".$cVn."', '".jschars($_POST['dt_diag_other'.$k])."', '".$_POST['dt_icd10_other'.$k]."','OTHER', '".$_SESSION['sOfficer']."','".jschars($_POST['thaiother'.$k])."','".$_POST['cTdate']."','Y','$regisdate_en','$svdate_en')";
	
		$result1 = mysql_query($strsql1)or die(mysql_error());
	}
}

for($k=0;$k<16;$k++){
	if($_POST['dt_diag_othera'.$k]!=""){
		$update1="UPDATE diag SET icd10='".$_POST['dt_icd10_othera'.$k]."', diag='".jschars($_POST['dt_diag_othera'.$k])."',diag_thai='".jschars($_POST['thaiother'.$k])."' WHERE row_id='".$_POST['other'.$k]."' ";	
		$result1 = mysql_query($update1);
	}elseif($_POST['dt_icd10_othera'.$k]==""&&$_POST['dt_diag_othera'.$k]==""){
		$update1="UPDATE diag SET status='N' WHERE row_id='".$_POST['other'.$k]."' ";	
		$result1 = mysql_query($update1);
	}
}

for($k=0;$k<16;$k++){
	if($_POST['dt_diag_external'.$k]!=""){
		$strsql1="INSERT INTO diag ( regisdate , hn , an , diag , icd10 , type , office ,diag_thai,svdate,status,regisdate_en,svdate_en) VALUES ('".$thidate."', '".$hn."', '".$cVn."', '".jschars($_POST['dt_diag_external'.$k])."', '".$_POST['dt_icd10_external'.$k]."','EXTERNAL CAUSE', '".$_SESSION['sOfficer']."','".jschars($_POST['thaiexternal'.$k])."','".$_POST['cTdate']."','Y','$regisdate_en','$svdate_en')";
			
		$result1 = mysql_query($strsql1)or die(mysql_error());
	}
}

for($k=0;$k<16;$k++){
	if($_POST['dt_diag_externala'.$k]!=""){
		$update1="UPDATE diag SET icd10='".$_POST['dt_icd10_externala'.$k]."', diag='".jschars($_POST['dt_diag_externala'.$k])."',diag_thai='".jschars($_POST['thaiexternal'.$k])."' WHERE row_id='".$_POST['external'.$k]."' ";	
		$result1 = mysql_query($update1);
	}elseif($_POST['dt_icd10_externala'.$k]==""&&$_POST['dt_diag_externala'.$k]==""){
		$update1="UPDATE diag SET status='N' WHERE row_id='".$_POST['external'.$k]."' ";	
		$result1 = mysql_query($update1);
	}
}


for($k=0;$k<16;$k++){
	if($_POST['icd9cmdetail'.$k]!=""){
		$strsql1="INSERT INTO opicd9cm ( admdate , hn , vn , icd9cm , icddate , officer ,svdate,status)
	VALUES ('".$thidate."', '".$hn."', '".$cVn."', '".jschars($_POST['icd9cm'.$k])."', '', '".$_SESSION['sOfficer']."','".$_POST['cTdate']."','Y')";
			
		$result1 = mysql_query($strsql1)or die(mysql_error());
	}
}

for($k=0;$k<16;$k++){
	if($_POST['icd9cmdetailb'.$k]!=""){
		$strsql1="INSERT INTO opicd9cm ( admdate , hn , vn , icd9cm , icddate , officer ,svdate,status)
	VALUES ('".$thidate."', '".$hn."', '".$cVn."', '".jschars($_POST['icd9cmb'.$k])."', '', '".$_SESSION['sOfficer']."','".$_POST['cTdate']."','Y')";
			
		$result1 = mysql_query($strsql1)or die(mysql_error());
	}
}

for($k=0;$k<16;$k++){
	if($_POST['icd9cmdetaila'.$k]!=""){
		$update1="UPDATE opicd9cm SET icd9cm='".$_POST['icd9cma'.$k]."' WHERE row_id='".$_POST['icd9'.$k]."' ";	
		$result1 = mysql_query($update1) or die(mysql_error());
	}elseif($_POST['icd9cma'.$k]==""&&$_POST['icd9cmdetaila'.$k]==""){
		$update1="UPDATE opicd9cm SET status='N' WHERE row_id='".$_POST['icd9'.$k]."' ";	
		$result1 = mysql_query($update1) or die(mysql_error());
	}
}

//echo mysql_errno() . ": " . mysql_error(). "\n";
echo "<br>";
   if(!$result){
        echo "insert into opday fail";
                    }
   else {
        echo "บันทึกแก้ไขข้อมูลเรียบร้อย<BR>";
		 echo "diag&nbsp;&nbsp;$diag<BR>";
		  echo "icd10&nbsp;&nbsp;$icd10<BR>";
		   echo "กลุ่มโรค&nbsp;&nbsp;$dxgroup1&nbsp;";
          }
include("unconnect.inc");
session_unregister("sTdatehn");
?>

</html>
