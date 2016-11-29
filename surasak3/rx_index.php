<?php 
session_start();
include 'connect.inc';

$cAn = $_GET['cAn'];
$Bed = $_GET['Bed'];

$today = (date("Y")+543)."-".date("m-d");
$thiday = date("d-m-").(date("Y")+543);

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
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

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
	$sql = "Select * From ipcard where an = '".$cAn."' and status_log!='จำหน่าย'  limit 1";
	$result = Mysql_Query($sql) or die( mysql_error() );
	if(mysql_num_rows($result) > 0){

		session_register("hn_ipd");
		session_register("idcard_ipd");
		session_register("ptname_ipd");
		session_register("age_ipd");
		session_register("ptright_ipd");
		session_register("bed");
		
		session_register("list_drugcode");
		session_register("list_drugamount");
		session_register("list_drugslip");
		
		session_register("nRunno");


		//runno  for chktranx
		$query = "SELECT title,prefix,runno FROM runno WHERE title = 'phardep'";
		$result = mysql_query($query) or die("Query failed");
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
			if(!($row = mysql_fetch_object($result)))
				continue;
			 }
		$_SESSION["nRunno"]=$row->runno;
		$_SESSION["nRunno"]++;
		$query ="UPDATE runno SET runno = '".$_SESSION["nRunno"]."' WHERE title='phardep'";
		$result = mysql_query($query) or die("Query failed");
		//end  runno  for chktranx

		
		$_SESSION["hn_ipd"] = "" ;
		$_SESSION["idcard_ipd"] = "" ;
		$_SESSION["ptname_ipd"] = "" ;
		$_SESSION["age_ipd"] = "" ;
		$_SESSION["ptright_ipd"] = "" ;
		$_SESSION["bed"] = "" ;

		$_SESSION["list_drugcode"] = array() ;
		$_SESSION["list_drugamount"] = array() ;
		$_SESSION["list_drugslip"] = array() ;


		$sql = "Select an,hn,ptname, age, ptright,bedcode  From ipcard where an = '".$cAn."' limit 1";
		$result = Mysql_Query($sql);
		list($_SESSION["an_ipd"],$_SESSION["hn_ipd"],$_SESSION["ptname_ipd"],$_SESSION["age_ipd"],$_SESSION["ptright_ipd"],$_SESSION["bed"]) = Mysql_fetch_row($result);
		 //$_SESSION["age_ipd"] = calcage($_SESSION["age_ipd"]);

		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=ward_rx.php\">";

	}else{
		
		session_unregister("hn_ipd");
		session_unregister("idcard_ipd");
		session_unregister("ptname_ipd");
		session_unregister("age_ipd");
		session_unregister("ptright_ipd");
		session_unregister("bed");
		session_unregister("list_drugcode");
		session_unregister("list_drugamount");
		session_unregister("list_drugslip");
	
		
	}


include("unconnect.inc");
?>
</body>
</html>