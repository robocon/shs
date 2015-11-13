<?php
session_start();
include("connect.inc");
?>

<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
</head>
<body>
<meta http-equiv="refresh" content="3;URL=dcstatus.php">

 <?php
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
           $pAge="$ageY ปี";
       
	   }else{
            $pAge="$ageY ปี $ageM เดือน";
      }
      return $pAge;
	}

$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$appd = $_POST["appdate"].' '.$_POST["appmo"].' '.$_POST["thiyr"];
if($_POST['status']=="ยืมเพื่อทบทวน"){
	$txt2 = $_POST["status2"];
}else{
	$txt2 = "";
}
$statusall = $_POST["status"].' '.$_POST["status1"];
//echo $_POST["appdate"].' '.$_POST["appmo"].' '.$_POST["thiyr"];;
  $count = count($_POST["list_an"]);


 for($i=0;$i<$count;$i++){
	
  if($_POST["list_an"][$i] == "")
	  continue;
	 
  $sql = "INSERT INTO dcstatus(date,an,status,office,status2)VALUES('".$Thidate."','".$_POST["list_an"][$i]."','".$statusall."','".$_SESSION["sOfficer"]."','".$txt2."');";

	$result = Mysql_Query($sql);
	if($result){
/************************ ออก ใบนัด ***************************/
print "<font face='Angsana New' size='3'><center><b>บันทึกข้อมูลแสดงสถานะประวัติผู้ป่วยใน";
print "<b><font face='Angsana New' size='3'>วันที่: ".$Thidate."  </b>&nbsp;&nbsp;&nbsp;<b>AN:</b> ".$_POST["list_an"][$i]." ";
print "<b><font face='Angsana New' size='3'><U>สถานะ:</b> ".$statusall."</U></FONT><br>";
	}
 }
    
// include("unconnect.inc");
list($thiyr, $mo) = explode('-', $_POST['back']);


?>
<p><a href="rechkipd1.php?thiyr=<?php echo $thiyr;?>&mo=<?php echo $mo;?>">กลับไปหน้า OPD-rechkOPD</a></p>
</body>
</html>