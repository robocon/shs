<?php
	session_start();
	
	include("connect.inc");

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
	$str = str_replace(",", "\,", $str);
    return $str;
}


	$_SESSION["dt_diag_detail"]=str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$_POST["dt_diag_detail"]);		//เอาสัญลักษณ์พิเศษออก
	$_SESSION["dt_icd10"] = $_POST["dt_icd10"];  //ICD10 Principal Diagnosis
	$_SESSION["dt_diag"] =str_replace(array("\r","\n","\r\n",'"',"'","<",">","&"),'',$_POST["dt_diag"]);	//Principal Diagnosis
	$_SESSION["diag_thai"] = $_POST["diag_thai"];  //Principal Diagnosis ภาษาไทย
	
	$_SESSION["dt_diag"]=$_SESSION["diag_thai"]." ".$_SESSION["dt_diag"];
	
	
	$_SESSION["dt_diag_other"] = $_POST["dt_diag_other0"];
	$_SESSION["dt_icd10_other"] = $_POST["dt_icd10_other0"];
	
	$_SESSION["organ"] = $_POST["dt_diag_detail"];
	
	$sql2 = "select * from icd10 where code = '".$_SESSION["dt_icd10"]."' ";
	$step2 = mysql_query($sql2);
	$num=mysql_num_rows($step2);
	$rep = mysql_fetch_array($step2);
	
	
	if($_SESSION["dt_icd10"]!="" && $_SESSION["diag_thai"]!="" && $rep['diag_thai']==""){
		$sql = "update icd10 set diag_thai = '".$_SESSION["diag_thai"]."' where code='".$_SESSION["dt_icd10"]."'  ";
		mysql_query($sql);
	}

	$sql2 = "select code,status,detail,diag_thai,diag_eng from icdthai where code='".$_SESSION["dt_icd10"]."' ";
	$result = mysql_query($sql2);
	list($code,$status,$detail,$thai,$eng) = mysql_fetch_array($result);

	if(empty($thai)){
		$thai=$_SESSION["diag_thai"];
	}else{
		$thai=$thai;
	}
	
	$sql = "Update opday set history='".$_SESSION["dt_diag_detail"]."' , diag='".jschars($_SESSION["dt_diag"])."', diag_eng='".$detail."', diag_thai='".$thai."', icd10 = '".$_SESSION["dt_icd10"]."' , `diag_other` = '".$_SESSION["dt_diag_other"]."',`icd10_other` = '".$_SESSION["dt_icd10_other"]."' where thdatevn = '".date("d-m-").(date("Y")+543).$_SESSION["vn_now"]."' limit 1";
	$result = Mysql_Query($sql);

$sql = "Update dxofyear  set dx='".$_SESSION["dt_diag_detail"]."' where thdatevn = '".(date("Y").date("-m-d")).$_SESSION["vn_now"]."' limit 1";
$result = Mysql_Query($sql);
	
		$regisdate_en = $svdate_en = date('Y-m-d');
		$sql = "insert into diag (regisdate,hn,an,diag,icd10,type,office,diag_thai,svdate,status,regisdate_en,svdate_en) values('".(date("Y")+543).date("-m-d H:i:s")."','".$_SESSION["hn_now"]."','".$_SESSION["vn_now"]."','".jschars($_POST['dt_diag'])."','".$_POST['dt_icd10']."','PRINCIPLE','".$_SESSION["dt_doctor"]."','".$thai."','".(date("Y")+543).date("-m-d H:i:s")."','Y','$regisdate_en', '$svdate_en') ";
		$result1= mysql_query($sql);
		
	for($k=0;$k<16;$k++){
		if($_POST['dt_diag_other'.$k]!=""){
			$sql = "insert into diag (regisdate,hn,an,diag,icd10,type,office,svdate,status,regisdate_en,svdate_en) values('".(date("Y")+543).date("-m-d H:i:s")."','".$_SESSION["hn_now"]."','".$_SESSION["vn_now"]."','".jschars($_POST['dt_diag_other'.$k])."','".$_POST['dt_icd10_other'.$k]."','OTHER','".$_SESSION["dt_doctor"]."','".(date("Y")+543).date("-m-d H:i:s")."','Y','$regisdate_en', '$svdate_en') ";
			$result= mysql_query($sql);
			$_SESSION["stk_diag_other"] .= jschars($_POST['dt_diag_other'.$k])."<br>";
		}
	}

	if($result)
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dt_drug.php\">";
	else
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dt_diag.php\">";

	include("unconnect.inc");
?>