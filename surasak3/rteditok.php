<?php
    session_start();
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
           $pAge="$ageY ปี";
             }
      else{
            $pAge="$ageY ปี $ageM เดือน";
                        }
      return $pAge;
          }

//$Y=($y-543);
//$dbirth="$Y-$m-$d";
$dbirth="$y-$m-$d";

$sql = "UPDATE opcard SET idcard='$idcard',hn='$cHn',
            yot='$yot',name='$name',surname='$surname',goup='$goup',married='$married',
            dbirth='$dbirth',guardian='$guardian',idguard='$idguard',
            nation='$nation',religion='$religion',career='$career',ptright='$ptright',address='$address',
            tambol='$tambol',ampur='$ampur',changwat='$changwat',
            phone='$phone',father='$father',mother='$mother',couple='$couple',
            note='$note',sex='$sex',camp='$camp',race='$race'  WHERE hn='$cHn' ";

$result = mysql_query($sql)
 or die("Query failed ipcard");

If (!$result){
echo "update opcard fail";
echo mysql_errno() . ": " . mysql_error(). "\n";
echo "<br>";
        }
else {
print " แก้ไขข้อมูลเรียบร้อย: <br>";
         }

 include("unconnect.inc");
?>




