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
    return $str;
}
	
    $cAn=$an;
	$cHn=$_POST['hn'];
	$cDiag=$_POST['diag'];
	
	$thidate=(date("Y")+543).date("-m-d H:i:s");
//update data in ipcard
        $query ="UPDATE ipcard SET goup='$goup', 
			         camp='$camp',
			         icd10='".$_POST['icd10']."',
			         comorbid='$dt_icd10_morbidity0',	
			         complica='$complica',
				     other='$other',
				     extcause='$extcause',	
				     result='$result',
				     clinic='$clinic',
				     dctype='$dctype' 				                       
                     WHERE  an='$cAn' ";
   $result = mysql_query($query)or die("Query failed,update ipacrd");
	
	$sql = "Select row_id From ipcard where an='$cAn' AND dctype = '4 By transfer' limit 1";
	$result = mysql_query($sql);
	$rows = Mysql_num_rows($result);
	if($rows > 0){
		list($idno) = Mysql_fetch_row($result);
		
		$sql = "Update refer set clinic = '".$clinic."' where ward like 'Ward%' AND trauma_id = '".$idno."'  limit 1 ";
		$result = mysql_query($sql)or die(mysql_error());
	}

/////////////////////////////////////
	
if($_POST['icd10']!=''){
	
	if($_POST['dx1']==''){
		
$strsql1="INSERT INTO `diag` ( `regisdate` , `hn` , `an` , `diag` , `icd10` , `type` , `office` )
VALUES ('".$thidate."', '".$cHn."', '".$cAn."', '".jschars($_POST['icd10detail'])."', '".$_POST['icd10']."','PRINCIPLE', '".$sOfficer."')";
	$result1 = mysql_query($strsql1)or die(mysql_error());
	
	}else{
	
	$update1="UPDATE diag SET icd10='".$_POST['icd10']."', diag='".jschars($_POST['icd10detail'])."' WHERE row_id='".$_POST['dx1']."' ";	
	$result1 = mysql_query($update1);
	
	}
}
//////////////////////////////////////////
for($c1=1;$c1<=$_POST['c1'];$c1++){

if($_POST['complica_'.$c1]!=''){

		
	$update2="UPDATE diag SET icd10='".$_POST['complica_'.$c1]."', diag='".jschars($_POST['comdetail_'.$c1])."' WHERE row_id='".$_POST['dx3'.$c1]."' ";	
	$result2 = mysql_query($update2);
	


}
}
for($c2=0;$c2<16;$c2++){
	
	if($_POST['complica'.$c2]!=''){
		
		$type="COMPLICATION";
	
	$sqlc="INSERT INTO `diag` ( `regisdate` , `hn` , `an` , `diag` , `icd10` , `type` , `office` )
VALUES ('".$thidate."', '".$cHn."', '".$cAn."', '".jschars($_POST['comdetail'.$c2])."', '".$_POST['complica'.$c2]."', '".$type."', '".$sOfficer."');";
 	$sqlresult = mysql_query($sqlc) or die(mysql_error());
	
//echo $sqldiag."<br>";
	}
}


///////////////////////////////////////
for($ot=1;$ot<=$_POST['ot'];$ot++){
if($_POST['other_'.$ot]!=''){
	
	
	$update3="UPDATE diag SET icd10='".$_POST['other_'.$ot]."', diag='".jschars($_POST['otherdetail_'.$ot])."' WHERE row_id='".$_POST['dx4'.$ot]."' ";	
	$result3 = mysql_query($update3);	

}
}

for($ot2=0;$ot2<16;$ot2++){
	
	if($_POST['other'.$ot2]!=''){
		
		$type="OTHER";
	
	$sqlc="INSERT INTO `diag` ( `regisdate` , `hn` , `an` , `diag` , `icd10` , `type` , `office` )
VALUES ('".$thidate."', '".$cHn."', '".$cAn."', '".jschars($_POST['otherdetail'.$ot2])."', '".$_POST['other'.$ot2]."', '".$type."', '".$sOfficer."');";
 	$sqlresult = mysql_query($sqlc) or die(mysql_error());
	
//echo $sqldiag."<br>";
	}
}
//////////////////////////////////
for($ex=1;$ex<=$_POST['ex'];$ex++){
	if($_POST['extcause_'.$ex]!==''){
	
		$update4="UPDATE diag SET icd10='".$_POST['extcause_'.$ex]."', diag='".jschars($_POST['externadetail_'.$ex])."' WHERE row_id='".$_POST['dx5'.$ex]."' ";	
	$result4 = mysql_query($update4);	

}
}
for($ex2=0;$ex2<16;$ex2++){
	
	if($_POST['extcause'.$ex2]!=''){
		
		$type="EXTERNAL CAUSE";
	
	$sqlc="INSERT INTO `diag` ( `regisdate` , `hn` , `an` , `diag` , `icd10` , `type` , `office` )
VALUES ('".$thidate."', '".$cHn."', '".$cAn."', '".jschars($_POST['externadetail'.$ex2])."', '".$_POST['extcause'.$ex2]."', '".$type."', '".$sOfficer."');";
 	$sqlresult = mysql_query($sqlc) or die(mysql_error());
	
	}
}

//////////////////////////////////
//insert into ipicd9cm table//


for($i=0;$i<16;$i++){
	
if($_POST['icd9cm'.$i] !=''){

   		 echo "ICD9CM ".$_POST['icd9cm'.$i]."date".$_POST['icddate'.$i]."AN $cAn,admitdate $admdate<br><br>";
		 
            //insert data into ipicd9cm
           $query = "INSERT INTO ipicd9cm(admdate,an,icd9cm,icddate,officer)
	 	   VALUES('$admdate','$cAn','".$_POST['icd9cm'.$i]."','".$_POST['icddate'.$i]."','$sOfficer');";
          $result1 = mysql_query($query) or die(mysql_error());
}
}

for($b=1;$b<=$_POST['maxicd9'];$b++){
	

	if($_POST['icd9cm_'.$b]!=''){
		
	$update6="UPDATE ipicd9cm SET icd9cm='".$_POST['icd9cm_'.$b]."', icddate ='".$_POST['icddate_'.$b]."' WHERE row_id='".$_POST['row'.$b]."' ";	
	$result6 = mysql_query($update6);
	
	}
}


//insert into diag table
/************************/

//echo $_POST['max'];

for($a=1;$a<=$_POST['max'];$a++){
	

	
	if($_POST['dt_icd10_'.$a]!=''){
		
		$update5="UPDATE diag SET icd10='".$_POST['dt_icd10_'.$a]."', diag='".jschars($_POST['dt_diag_'.$a])."' WHERE row_id='".$_POST['dx2'.$a]."' ";	
		$result5 = mysql_query($update5);
	
	//echo $update5;
	}
}


for($x=0;$x<16;$x++){
	
	if($_POST['dt_icd10_morbidity'.$x]!=''){
		
		$type="CO-MORBIDITY";
	
	$sqldiag="INSERT INTO `diag` ( `regisdate` , `hn` , `an` , `diag` , `icd10` , `type` , `office` )
VALUES ('".$thidate."', '".$cHn."', '".$cAn."', '".jschars($_POST['dt_diag_morbidity'.$x])."', '".$_POST['dt_icd10_morbidity'.$x]."', '".$type."', '".$sOfficer."');";
 	$sqlresult = mysql_query($sqldiag) or die(mysql_error());
	
//echo $sqldiag."<br>";
	}
}



   If (!$result){
        echo "insert into ipcard fail";
		echo"<meta http-equiv='refresh' content='2;url=dxipan.php'>";
                    }
   else {
        echo "บันทึกแก้ไขข้อมูลเรียบร้อย";
		
	echo"<meta http-equiv='refresh' content='2;url=dxipan.php'>";
          }
include("unconnect.inc");
?>


