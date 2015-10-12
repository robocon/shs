<?php
   session_start();
//   session_destroy();
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
    session_unregister("sPtname");
    session_unregister("sDoctor");
    session_unregister("sAge");
    session_unregister("sPtright");
    session_unregister("sReport");
    session_unregister("sDetail");
    session_unregister("sRow_id"); 

    $dDate=$_GET["sDate"];
    $sHn=$_GET["cHn"];
    $sAn=$_GET["cAn"];
    $sPtname=$_GET["cPtname"];
    $sDoctor=$_GET["cDoctor"];
    $sAge=""; 
    $sPtright="";
    $sReport="";

    $sDetail=$cDetail;
    $sRow_id=$nRow_id;
  
    session_register("dDate");  
    session_register("sHn");   
    session_register("sAn");
    session_register("sPtname");
    session_register("sDoctor");
    session_register("sAge");
    session_register("sPtright");
    session_register("sReport");
    session_register("sDetail");
    session_register("sRow_id"); 

   Function calcage($birth){
      $today = getdate();   
      $nY  = $today['year']; 
      $nM = $today['mon'] ;
      $bY=substr($birth,0,4)-543;
//    $bY=substr($birth,0,4);
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

   include("connect.inc");
	    $query = "SELECT * FROM opcard WHERE hn = '".$_GET["cHn"]."'";
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
       	   If ($result){
  	       $sHn=$row->hn;
  	       $cYot = $row->yot;
                       $cName = $row->name;
   	       $cSurname = $row->surname;
   	       $sPtname=$row->yot.' '.$row->name.' '.$row->surname;
   	       $sPtright = $row->ptright;
                       $cAge=$row->dbirth;
                       $cAddress=$row->address;
                       $cMuang="ต. $row->tambol  อ. $row->ampur  จ. $row->changwat" ; 
                       $sAge=calcage($cAge);
/*
HN  AN  
ชื่อ
อายุ
สิทธิ
โรค
แพทย์
รายการ  
วันที่ทำ $dDate
ผลการอ่าน
*/
                       print "HN $sHn<br>";
	       if (!empty($cAn)){
		$sAn=$cAn;
	        	print "AN $sAn<br>";
			}
	       print "$sPtname<br>";
	       print "อายุ: $sAge (วันเกิด: $cAge)<br>";
	       if (!empty($sPtright)){
		print "สิทธิการรักษา: $sPtright<br>";
			}
	       print "ที่อยู่:$cAddress $cMuang<br>";
	       print "แพทย์: $cDoctor<br>";
                       print "การตรวจ: $cDetail<br>";
	       print "วันที่ตรวจ: $sDate<br>";
	       print "อ่านผล:-<br>";
         	   	       }  
 	  else {
  	       echo "ไม่พบ HN : $hn ";
  	         }    
	    	       
list($report) = Mysql_fetch_row(Mysql_Query("Select report From patdata where row_id = '".$_GET["nRow_id"]."' "));
?>

<form method="POST" action="xrprn.php">
  <p><textarea rows="13" name="report" cols="105"><?php echo $report;?></textarea></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input type="submit" value="  &#3610;&#3633;&#3609;&#3607;&#3638;&#3585;  " name="B1">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="reset" value="  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  " name="B2"></p>
</form>

<?php include("unconnect.inc");  ?>
