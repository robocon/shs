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

	$_SESSION["dt_diag_detail"] = $_POST["dt_diag_detail"];
	$_SESSION["dt_icd10"] = $_POST["dt_icd10"];  //ICD10 Principal Diagnosis
	$_SESSION["dt_diag"] = $_POST["dt_diag"];  //Principal Diagnosis
	$_SESSION["diag_thai"] = $_POST["diag_thai"];  //Principal Diagnosis ภาษาไทย
	
	$_SESSION["dt_diag"]=$_SESSION["diag_thai"]." ".$_SESSION["dt_diag"];
	
	$_SESSION["dt_diag_morbidity"] = $_POST["dt_diag_morbidity0"];
	$_SESSION["dt_icd10_morbidity"] = $_POST["dt_icd10_morbidity0"];
	
	$_SESSION["dt_diag_complication"] = $_POST["dt_diag_complication"];
	$_SESSION["dt_icd10_complication"] = $_POST["dt_icd10_complication"];
	
	$_SESSION["dt_diag_other"] = $_POST["dt_diag_other"];
	$_SESSION["dt_icd10_other"] = $_POST["dt_icd10_other"];
	
	$_SESSION["dt_diag_external"] = $_POST["dt_diag_external"];
	$_SESSION["dt_icd10_external"] = $_POST["dt_icd10_external"];
	
	$_SESSION["organ"] = $_POST["dt_diag_detail"];
	
	$sql2 = "select * from icd10 where code = '".$_SESSION["dt_icd10"]."' ";
	$step2 = mysql_query($sql2);
	$rep = mysql_fetch_array($step2);
	if($_SESSION["dt_icd10"]!=""&&$_SESSION["diag_thai"]!=""&&$rep['diag_thai']==""){
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
	
	$sql = "Update opday set history='".$_SESSION["dt_diag_detail"]."' , diag='".jschars($_SESSION["dt_diag"])."', diag_eng='".$detail."', diag_thai='".$thai."', icd10 = '".$_SESSION["dt_icd10"]."' , `diag_morbidity` = '".$_SESSION["dt_diag_morbidity"]."', `diag_complication` = '".$_SESSION["dt_diag_complication"]."', `diag_other` = '".$_SESSION["dt_diag_other"]."',`external_cause` = '".$_SESSION["dt_diag_external"]."',`icd101` = '".$_SESSION["dt_icd10_morbidity"]."', `icd10_complication` = '".$_SESSION["dt_icd10_complication"]."',`icd10_other` = '".$_SESSION["dt_icd10_other"]."', `icd10_external_cause` = '".$_SESSION["dt_icd10_external"]."' where thdatevn = '".date("d-m-").(date("Y")+543).$_SESSION["vn_now"]."' limit 1";
	$result = Mysql_Query($sql);

	$sql = "Update dxofyear  set dx='".$_SESSION["dt_diag_detail"]."' where thdatevn = '".(date("Y").date("-m-d")).$_SESSION["vn_now"]."' limit 1";

	$result = Mysql_Query($sql);
	
	
	//$sql = "Update opd set organ='".$_SESSION["dt_diag_detail"]."'  where thdatehn = '".date("d-m-").(date("Y")+543).$_SESSION["hn_now"]."' limit 1";
	//$result = Mysql_Query($sql);
	
	/*$sql = "Update diag set diag='".$_SESSION["dt_diag"]."',icd10='".$_SESSION["dt_icd10"]."'  where regisdate like '".(date("Y")+543).date("-m-d")."%' and hn='".$_SESSION["hn_now"]."' and office = '".$_SESSION["dt_doctor"]."' and type='PRINCIPLE' limit 1";
	//echo $sql;
	$result = Mysql_Query($sql);
	$sum =mysql_affected_rows();
	if($sum==0){*/
		$sql = "insert into diag (regisdate,hn,an,diag,icd10,type,office,diag_thai,svdate,status) values('".(date("Y")+543).date("-m-d H:i:s")."','".$_SESSION["hn_now"]."','".$_SESSION["vn_now"]."','".jschars($_POST['dt_diag'])."','".$_POST['dt_icd10']."','PRINCIPLE','".$_SESSION["dt_doctor"]."','".$thai."','".(date("Y")+543).date("-m-d H:i:s")."','Y') ";

		$result1= mysql_query($sql);
//	}
	
	for($k=0;$k<16;$k++){
		if($_POST['dt_diag_morbidity'.$k]!=""){
				$sql = "insert into diag (regisdate,hn,an,diag,icd10,type,office,svdate,status) values('".(date("Y")+543).date("-m-d H:i:s")."','".$_SESSION["hn_now"]."','".$_SESSION["vn_now"]."','".jschars($_POST['dt_diag_morbidity'.$k])."','".$_POST['dt_icd10_morbidity'.$k]."','CO-MORBIDITY','".$_SESSION["dt_doctor"]."','".(date("Y")+543).date("-m-d H:i:s")."','Y') ";

				$result= mysql_query($sql);
		}
	}

	if($result)
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dt_drug.php\">";
	else
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dt_diag.php\">";

	include("unconnect.inc");
?>