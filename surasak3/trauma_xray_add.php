<?php
session_start();

 include("connect.inc");
 
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thdhn=date("d-m-").(date("Y")+543).$_SESSION["hn_now"];

$item=0;
	
$item  = count($_SESSION["list_code"]);

if($item == 0){
				
	echo "
		
		<BR><BR><CENTER>กรุณาเลือกรายการตรวจ LAB อย่างน้อย 1 รายการ</CENTER>";
	exit();

}

	$cPtname = $_POST["ptname"];

	$cYot = $_POST["yot"];
	$cName = $_POST["name"];
	$cSurname = $_POST["surname"];

	$cHn = $_POST["hn"];
	$cAn = $_POST["an"];
	$cDoctor = $_POST["doctor"];
	$cDepart = "PATHO";
	$aDetail="";
	$cDiag = "";
	$tvn = $_POST["vn"];
	$cPtright = $_POST["ptright"];
	$cDbirth = $_POST["dbirth"];
	

	$cLab="ER";
	
	$query = "SELECT title,prefix,runno FROM runno WHERE title = 'xrayno' limit 1";
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $idrun=$row->runno;
    $idrun++;

    $query ="UPDATE runno SET runno = $idrun WHERE title='xrayno'";
    $result = mysql_query($query) or die("Query failed");

	for ($i=0; $i<$item; $i++){
		$detail2 .= ($i+1).".  ".$_SESSION["list_code"][$i]."\n";
	}

	$sql = " ;";

			
		$sql = "INSERT INTO `xray_doctor` (`date` ,`hn` ,`vn` ,`yot` ,`name` ,`sname` ,`detail` ,`doctor` ,`status` ,`xrayno` ,`film` ,`type_diag`,`detail_all`,`dbirth`,`orderby`)VALUES ";
		
		$list = array();
		for ($n=0; $n<$item; $n++){
         If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$Thidate."', '".$cHn."', '".$tvn."', '".$cYot."', '".$cName."', '".$cSurname."', '".$_SESSION["list_code"][$n]."', '".$cDoctor."', 'N', '".$idrun."', '".$_POST["type"]."', '".$_POST["type_diag"]."', '".$detail2."', '".$cDbirth."', '".$cLab."') ";
				array_push($list,$q);
              
		 }
        }

		if($n > 0){
			$sql .= implode(", ",$list);
			$result = Mysql_Query($sql) or die("Error patdata ".Mysql_Error());
		}

		if($result){
			$print = "<FONT SIZE=\"4\" COLOR=\"blue\">สั่ง X-RAYผู้ป่วย <BR> HN : ".$cHn." ชื่อ-สกุล : ".$cPtname." จำนวน : ".$item."&nbsp;รายการ <BR>บันทึกข้อมูลเรียบร้อยแล้ว</FONT> ";
		}else{
			$print = "<FONT SIZE=\"4\" COLOR=\"red\">ไม่สามารถบันทึกข้อมูลได้<BR><A HREF=\"trauma_xray.php?vn=".$tvn."\">&lt;&lt;กลับ</A></FONT>";
		}
		
		
		//$pathopri=$Netprice;
		//$sql ="UPDATE opday SET patho=patho+".$pathopri." WHERE thdatehn= '".$Thdhn."' AND  vn = '".$tvn."' ";
		//$result = Mysql_Query($sql) or die("Error update opday ".Mysql_Error());

		echo "
	<html>
	<head>
		<SCRIPT LANGUAGE=\"JavaScript\">
		window.onload = function(){
			setTimeout(\"window.location.href='trauma_xray.php?vn=".$tvn."';\",3000);
		}
		</SCRIPT>
	</head>
	<body leftmargin=\"0\" topmargin=\"0\">
		<BR><BR><BR><CENTER>".$print."</CENTER>
	</body>
	</html>
				
	";