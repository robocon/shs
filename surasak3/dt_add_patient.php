<?php 
session_start();
?>
<html>
<head>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }

-->
</style>
</head>
</body>
<?php 

$today = (date("Y")+543)."-".date("m-d");
$thiday = date("d-m-").(date("Y")+543);
include("connect.inc");

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

$todayvn = $thiday.$_REQUEST["vn_now"];

	$sql = "Select hn, time_format(thidate,'%H:%i'),checkdx From opday where thdatevn = '".$todayvn."'  limit 1";

	$result = Mysql_Query($sql);
	if(mysql_num_rows($result) > 0){
		session_register("time_opday");
		session_register("time_opd");

		session_register("vn_now");
		session_register("hn_now");
		session_register("idcard_now");
		session_register("yot_now");
		session_register("name_now");
		session_register("surname_now");
		session_register("age_now");
		session_register("ptright_now");
		
		session_register("dt_diag_detail");
		session_register("dt_diag");
		session_register("diag_thai");
		session_register("dt_icd10");

		session_register("list_drugcode");
		session_register("list_drugamount");
		session_register("list_drugslip");
		
		session_register("nRunno");
		session_register("dt_drugstk");

		session_register("alert500");

		session_register("temperature");
		session_register("pause");
		session_register("rate");
		session_register("weight");
		session_register("height");
		session_register("bp");
		session_register("congenital_disease");
		session_register("organ");
		session_register("staff");
		session_register("drugreact");
		session_register("list_drugreact");
		session_register("type");
		session_register("dt_doctor");
		session_register("dt_dental");
		session_register("dt_special");
		session_register("S_listxray");
	


		$query = "SELECT runno FROM runno WHERE title = 'phardep' limit 0,1";
		$result2 = mysql_query($query) or die("Query failed");
		
		list($_SESSION["nRunno"]) = mysql_fetch_row($result2);
		

		 $_SESSION["nRunno"]++;

		$query ="UPDATE runno SET runno = ".$_SESSION["nRunno"]." WHERE title='phardep'";
		$result2 = mysql_query($query) or die("Query failed");
		
		$_SESSION["vn_now"] = "" ;
		$_SESSION["hn_now"] = "" ;
		$_SESSION["idcard_now"] = "" ;
		$_SESSION["yot_now"] = "" ;
		$_SESSION["name_now"] = "" ;
		$_SESSION["surname_now"] = "" ;
		$_SESSION["age_now"] = "" ;
		$_SESSION["ptright_now"] = "" ;

		
		$_SESSION["dt_diag"]="";
		$_SESSION["dt_icd10"]="";
		$_SESSION["diag_thai"]="";
		$_SESSION["dt_drugstk"]="";
		
		$_SESSION["dt_diag_morbidity"] = "";
		$_SESSION["dt_icd10_morbidity"] = "";
	
		$_SESSION["dt_diag_complication"] = "";
		$_SESSION["dt_icd10_complication"] = "";
	
		$_SESSION["dt_diag_other"] = "";
		$_SESSION["dt_icd10_other"] = "";
	
		$_SESSION["dt_diag_external"] = "";
		$_SESSION["dt_icd10_external"] = "";

		$_SESSION["list_drugcode"] = array() ;
		$_SESSION["list_drugamount"] = array() ;
		$_SESSION["list_drugslip"] = array() ;

		$_SESSION["list_drug_inject_amount"] = array() ;
		$_SESSION["list_drug_inject_unit"] = array() ;
		$_SESSION["list_drug_inject_amount2"] = array() ;
		$_SESSION["list_drug_inject_unit2"] = array() ;
		$_SESSION["list_drug_inject_amount3"] = array() ;
		$_SESSION["list_drug_inject_unit3"] = array() ;
		$_SESSION["list_drug_inject_time"] = array() ;
		$_SESSION["list_drug_inject_slip"] = array() ;
		$_SESSION["list_drug_inject_type"] = array() ;
		$_SESSION["list_drug_inject_etc"] = array() ;
		$_SESSION["list_drug_reason"] = array() ;
		$_SESSION["list_drug_reason2"] = array() ;
		

		$_SESSION["list_code"] = array() ;
		$_SESSION["list_detail"] = array() ;
		$_SESSION["S_listxray"] = array();

		$_SESSION["alert500"]=0;
		$_SESSION["list_drugreact"] = "";

		if(isset($_POST["doctor"])){
			$_SESSION["dt_doctor"] = $_POST["doctor"];
			$_SESSION["dt_dental"] = true;
		}else{
			$_SESSION["dt_doctor"] = $_SESSION["sOfficer"];
			$_SESSION["dt_dental"] = false;
		}
		
		if(isset($_POST["special"])){
			$_SESSION["dt_special"] = true;
		}else{
			$_SESSION["dt_special"] = false;
		}

		$_SESSION['repeat_bp'] = ''; 
		$_SESSION["stk_diag_other"] = '';


	list($hn_now,$_SESSION["time_opday"],$mcheckdx) = Mysql_fetch_row($result);
				

		$_SESSION["vn_now"] = $_REQUEST["vn_now"];

		$sql = "Select hn, idcard, yot, name, surname, dbirth, ptright  From opcard where hn = '".$hn_now."' limit 1";
		$result = Mysql_Query($sql);
		list($_SESSION["hn_now"],$_SESSION["idcard_now"],$_SESSION["yot_now"],$_SESSION["name_now"],$_SESSION["surname_now"],$_SESSION["age_now"],$_SESSION["ptright_now"]) = Mysql_fetch_row($result);
		 $_SESSION["age_now"] = calcage($_SESSION["age_now"]);

		$thidate = date("d-m-").(date("Y")+543);
		$thidatehn = $thidate.$_SESSION["hn_now"];

		$sql = "Select temperature, pause, rate, weight, bp1, bp2, congenital_disease, organ, officer, drugreact, time_format(thidate,'%H:%i'), height, type,bp3,bp4 From opd where thdatehn = '".$thidatehn."' limit 1";
		$result = Mysql_Query($sql) or die("Error opd");
		list($_SESSION["temperature"], $_SESSION["pause"], $_SESSION["rate"], $_SESSION["weight"], $bp1, $bp2, $_SESSION["congenital_disease"],$_SESSION["organ"],$_SESSION["staff"],$_SESSION["drugreact"],$_SESSION["time_opd"],$_SESSION["height"], $_SESSION["type"],$bp3,$bp4) = Mysql_fetch_row($result);

		$sql = "Update opd set dc_diag = '".date("H:i:s")."'  Where thdatehn = '".$thidatehn."' limit 1 ";
		$result = Mysql_Query($sql);

		$_SESSION["bp"] = $bp1."/".$bp2;
		$_SESSION['repeat_bp'] = "$bp3 / $bp4";
		//$_SESSION["dt_diag_detail"]=$_SESSION["organ"];


if($_SESSION["sIdname"] == "md19921"){
	
	$sql = "select count(hn) from opday where doctor ='����Թ��� ����չҤ (�.19921)' AND hn='".$_SESSION["hn_now"]."' AND diag IS NOT NULL Order by row_id DESC limit 1";
	$result = mysql_query($sql);
	list($rows) = mysql_fetch_row($result);

	if($rows > 0){
		$sql = "Select diag From opday where hn='".$_SESSION["hn_now"]."' AND doctor ='����Թ��� ����չҤ (�.19921)' AND diag IS NOT NULL Order by row_id DESC limit 1 ";
		list($_SESSION["dt_diag"]) = mysql_fetch_row(mysql_query($sql));
	}

}
			if($mcheckdx=="Y"){
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dxdr_ofyear1_dr.php\">";
			}else if($mcheckdx=="P"){
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dxdr_ofyearout_dr.php\">";
			}else if($mcheckdx=="sso"){
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=chk_doctor.php\">";
			}else{
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=dt_diag.php\">";
			}
		

	}else{
		
		session_unregister("vn_now");
		session_unregister("hn_now");
		session_unregister("idcard_now");
		session_unregister("yot_now");
		session_unregister("name_now");
		session_unregister("surname_now");
		session_unregister("age_now");
		session_unregister("ptright_now");

		session_unregister("temperature");
		session_unregister("pause");
		session_unregister("rate");
		session_unregister("weight");
		session_unregister("bp");
		session_unregister("congenital_disease");
		session_unregister("organ");
		session_unregister("dt_doctor");
		session_unregister("dt_dental");

		if(isset($_POST["doctor"])){
			$first_page = "dt_dental.php";
		}else{
				$first_page = "dt_index.php";
		}

		echo "<CENTER><B>����������Ţ VN : ".$_REQUEST["vn_now"]."</B> <BR> <A HREF=\"".$first_page."\">&lt;&lt; ��Ѻ</A></CENTER>";
		
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=dt_index.php\">";
	}


include("unconnect.inc");
?>
</body>
</html>