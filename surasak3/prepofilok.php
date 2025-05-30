<?php
    session_start();
    include("connect.inc");
	include("function.php");
?>
<script src="sweetalert/jquery-3.6.0.js"></script>
<script src="sweetalert/sweetalert2@11.js"></script>
<?
    $query = "SELECT * FROM pocompany WHERE row_id = '$xRow_id'";
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
    $cDepartdate=$row->departdate;  //calendar1
	$cPrepodate=$row->prepodate; //calendar2
	$cPodate=$row->podate;  //calendar3
	$cBounddate=$row->bounddate; //calendar4
	$cChkindate=$row->chkindate;  //calendar5
	$cSenddate=$row->senddate;  //calendar6
	$cBorrowdate=$row->borrowdate;  //calendar7
	$cPobilldate=$row->pobilldate;	//calendar8
	$cFixdate=$row->fixdate;  //calendar9
	$cReportdate=$row->reportdate;  //calendar10
   }
	
	if(!empty($departdate)){
		$departdate=displaydate_th($departdate);
	}else{
		$departdate=$cDepartdate;
	}	
	
	if(!empty($prepodate)){
		$prepodate=displaydate_th($prepodate);
	}else{
		$prepodate=$cPrepodate;
	}
	
	if(!empty($podate)){
		$podate=displaydate_th($podate);
	}else{
		$podate=$cPodate;
	}

	if(!empty($bounddate)){
		$bounddate=displaydate_th($bounddate);
	}else{
		$bounddate=$cBounddate;
	}
	
	if(!empty($chkindate)){
		$chkindate=displaydate_th($chkindate);
	}else{
		$chkindate=$cChkindate;
	}
	
	if(!empty($senddate)){	
		$senddate=displaydate_th($senddate);
	}else{
		$senddate=$cSenddate;
	}
	
	if(!empty($borrowdate)){
		$borrowdate=displaydate_th($borrowdate);
	}else{
		$borrowdate=$cBorrowdate;
	}

	if(!empty($pobilldate)){	
		$pobilldate=displaydate_th($pobilldate);
	}else{
		$pobilldate=$cPobilldate;
	}
		
	if(!empty($fixdate)){	
		$fixdate=displaydate_th($fixdate);
	}else{
		$fixdate=$cFixdate;
	}
	
	if(!empty($reportdate)){
		$reportdate=displaydate_th($reportdate);
	}else{
		$reportdate=$cReportdate;
	}
	

//update data in pocompany
	$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
	
        $query ="UPDATE pocompany SET  depart='$depart',
								departno='$departno',
								departdate='$departdate',
								prepono='$prepono', 
  		                        prepodate = '$prepodate',
								netprice = '$prenetprice',
								pono='$pono', 
								ponoyear='$ponoyear', 
  		                        podate = '$podate',
  		                        bounddate = '$bounddate',
								chkindate = '$chkindate',
								senddate = '$senddate',
								borrowdate = '$borrowdate',
								pobillno = '$pobillno',
								pobilldate = '$pobilldate',
								fixdate = '$fixdate',
								reportdate = '$reportdate',
								user_edit = '".$_SESSION["sOfficer"]."',
								lastupdate = '$Thidate'
                       WHERE  row_id='$xRow_id' ";
		//echo $query;
$result = mysql_query($query)or die("Query failed,update pocompany");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";

include("unconnect.inc");
print "...............<br>";
print "...............<br>";
print "...............<br>";
print "...............<br>";
print "...............บันทึกข้อมูลเรียบร้อย<br>";

    session_unregister("xRow_id");
?>


