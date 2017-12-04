<?php
 session_start();

 if(isset($_GET["action"]) && $_GET["action"] == "doctor_s"){
	header("content-type: application/x-javascript; charset=TIS-620");
	$cDoctor = $_GET["AA"];
	
	exit();
}

    $cHn="";
    $cPtname="";
    $cPtright="";
    $nRunno="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");

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


   $tvn="";
    session_register("tvn");
If (!empty($hn)){
    include("connect.inc");
	


    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
	$thidatehn=$d.'-'.$m.'-'.$yr.$hn;

	$sql = "Select vn From opday where thdatehn = '".$thidatehn."' limit 1";
	$opday_result = Mysql_Query($sql);
	list($vn) = mysql_fetch_row($opday_result);
	$tvn = $vn;
	

    $thdatevn=$d.'-'.$m.'-'.$yr.$vn;
// ตรวจดูว่าลงทะเบียนหรือยัง
    $query = "SELECT * FROM opday WHERE thdatevn = '$thdatevn'";
    $result = mysql_query($query) or die("Query failed,opday");
/*
    echo mysql_errno() . ": " . mysql_error(). "\n";
    echo "<br>";
*/
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }	
//กรณียังไม่ลงทะเบียน
    If (empty($row->hn)){
        print "VN :$vn<br>";
        print "ยังไม่ได้ลงทะเบียนตรวจวันนี้  โปรดขอ VN ใหม่จากห้องทะเบียน<br>";
                                    }
//กรณีลงทะเบียนแล้ว
   else { 
        $cHn=$row->hn;
        $cPtname=$row->ptname;
        $cPtright=$row->ptright;

		$x=0;
    $aDgcode = array("รหัส");
    $aTrade  = array("รายการ");
    $aPrice  = array("ราคา ");
    $aPart = array("part");
    $aAmount = array("        จำนวน   ");
    $aMoney= array("       รวมเงิน   ");
    $Netprice="";   

    $aYprice = array("ราคา ");
    $aNprice = array("ราคา ");
    $aSumYprice = array("ราคา ");
    $aSumNprice = array("ราคา ");
    session_register("aYprice");
    session_register("aNprice");
    session_register("aSumYprice");
    session_register("aSumNprice");

    $cPart="";
    $cDiag=$diag;
    $cDoctor=$doctor;
    $cAn="";
    $cAccno=0;
	$tvn="$tvn";
    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aMoney");
    session_register("Netprice");
    session_register("cPart");
    session_register("cDiag");
    session_register("cAn"); 
    session_register("cDoctor"); 
    session_register("cAccno"); 
	session_register("tvn"); 
	session_register("list_codeed");

	$_SESSION["list_codeed"] = array();
	$_SESSION["cDoctor"] = "MD013 ธนบดินทร์ ผลศรีนาค";
	$_SESSION["cDiag"] = "ตรวจสุขภาพ";
	$_SESSION["Amount"] = 1;
	$Amount = 1;

	$query = "SELECT * FROM labcare WHERE code = 'CHEK-UP' ";
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
	    $x++;
	    $aDgcode[$x]=$row->code; 
	    $aTrade[$x]=$row->detail;
	    $aPrice[$x]=$row->price;

	    $aPart[$x]=$row->part;
	    $aAmount[$x]=$Amount;
	    $money = $Amount*$row->price ;
	    $aMoney[$x]=$money;
	    $Netprice=array_sum($aMoney);

	    $aYprice[$x]=$row->yprice*$Amount;
	    $aNprice[$x]=$row->nprice*$Amount;
	    $aSumYprice=array_sum($aYprice);
	    $aSumNprice=array_sum($aNprice);
//$cDoctor

?>

<SCRIPT LANGUAGE="JavaScript">

function newXmlHttp(dct){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
		
		url = 'vndxdiag.php?action=doctor_s&AA=' + dct;
		//xmlhttp = newXmlHttp();
		xmlhttp.open("GET", url, false);
		xmlhttp.send(null);

		if(dct ==" กรุณาเลือกแพทย์")
			document.getElementById("link_next").style.display = "none";
		else
			document.getElementById("link_next").style.display = "";



}



</SCRIPT>

<?php
	print "ผู้ป่วยนอก<br>";
	print "HN :$cHn<br>";
	print "VN :$tvn<br>";
	print "$cPtname<br>";
	print "สิทธิการรักษา :$cPtright<br>";
	print "โรค :$cDiag<br>";
	print "แพทย์ : ";

	$strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'   order by name"; 
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 

	echo "<select name=\"doctor\" Onchange=\"newXmlHttp(this.value);\"> ";
	while($objResult = mysql_fetch_array($objQuery)) 
	{ 
		echo "<option value=\"".$objResult["name"]."\">".$objResult["name"]."</option> ";
	} 
	echo "</select><BR>";

      //  print "VN  :$vn<br>";
      //  print "HN :$cHn<br>";
      //  print "$cPtname<br>";
     //   print "สิทธิการรักษา :$cPtright";
        print "<br><a target=_BLANK href=\"labtranx.php\" id=\"link_next\" style=\"display:none;\">ชื่อถูกต้อง คิดค่าใช้จ่าย</a>";
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
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
           }
   include("unconnect.inc");
   }
?>

