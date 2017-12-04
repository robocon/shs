<?php
  include("connect.inc");
  $xRec=23659;
  for ($n=1; $n<=$xRec; $n++){
        $query = "SELECT * FROM stktranx WHERE row_id = $n ";
        $result = mysql_query($query) or die("Query druglst failed");
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    if(mysql_num_rows($result)){
          $nRow_id=$row->row_id;
          $nStkcut =$row->stkcut;
          $cDate=$row->date;
/*
	ทำเป็น  พ.ศ.
    $today = date("d-m-Y");   
	dd-mm-YYYY
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

               ทำเป็น ค.ศ.
    $cDate --->YYYY-mm-dd
    $d=substr($cDate,8,2);
    $m=substr($cDate,5,2);
    $yr=substr($cDate,0,4) - 543;  
    $cDate="$yr-$m-$d";
*/
	print "cDate $cDate<br>";//เดิม
	    $d=substr($cDate,8,2);
	    $m=substr($cDate,5,2);
    	          $yr=substr($cDate,0,4) - 543;  
	    $cDate="$yr-$m-$d";  // ค.ศ.

          print "row_id =$nRow_id ,     stkcut= $nStkcut,    cdate=$cDate<br>";
          if ($nStkcut > 0){
          	$cGetdate="$cDate";
			print "cGetdate=$cGetdate<br>";
		//แก้ไขข้อมูล
 	       $query ="UPDATE stktranx  SET  getdate = '$cDate'
		                        WHERE row_id=$n ";
 	       $result = mysql_query($query) or die("Query failed,update stktranx, n=$n, row_id= $nRow_id");
		   echo mysql_errno() . ": " . mysql_error(). "\n";
		   echo "<br>";
           print "บันทึกข้อมูลเรียบร้อย แถวที่ $nRow_id  n $n<br><br>";

									}
							}
		}
  
print  "Last  row_id = $nRow_id ,n= $n<br>";
include("unconnect.inc");
?>

