<?php
    session_start();
?>
<style type="text/css">

body,td,th {
	font-family: TH SarabunPSK;
	font-size: 12px;
}
</style>
<?
	$sVn=$_GET["vn"];
	$sAn=$_GET["an"];
	
	if(!empty($sVn)){
		$showvisit="(VN:$sVn)";
	}else if(!empty($sAn)){
		$showvisit="(AN:$sAn)";
	}	
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $aDetail1 = array("detail1");
    $aDetail2 = array("detail2");
    $aDetail3 = array("detail3");
    $aDetail4 = array("detail4");

    include("connect.inc");
//////// add drugnote from druglst
    $aDrugnote = array("drugnote");
    for ($n=1; $n<=$x; $n++){
             $query = "SELECT drugnote FROM druglst WHERE drugcode = '$aDgcode[$n]' ";
             $result = mysql_query($query) or die("Query failed drugnote,druglst ");

             for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
                  if (!mysql_data_seek($result, $i)) {
                            echo "Cannot seek to row $i\n";
                            continue;
                                                                        }
                 if(!($row = mysql_fetch_object($result)))
                        continue;
		              }
             array_push($aDrugnote,$row->drugnote); 
                                          }
////// end  add drugnote from druglst
    for ($n=1; $n<=$x; $n++){
             $query = "SELECT slcode,detail1,detail2,detail3,detail4 FROM drugslip WHERE slcode = '$aSlipcode[$n]' ";
             $result = mysql_query($query) or die("Query failed");
//             echo mysql_errno() . ": " . mysql_error(). "\n";
//             echo "<br>";
             for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
                  if (!mysql_data_seek($result, $i)) {
                            echo "Cannot seek to row $i\n";
                            continue;
                                                                        }
                 if(!($row = mysql_fetch_object($result)))
                        continue;
		              }
             array_push($aDetail1,$row->detail1); 
             array_push($aDetail2,$row->detail2); 
             array_push($aDetail3,$row->detail3); 
             array_push($aDetail4,$row->detail4); 
                                          }

// print slip   
//ตัดค่าฉึดยาทิ้ง
    $injcount=0;
    for ($n=1; $n<=$x; $n++){
	if ($aDgcode[$n]=='INJ'){
		$injcount++;
		}
	}
    $injcount=$x - $injcount;

    for ($n=1; $n<=$x; $n++){
         If (!empty($aSlipcode[$n])){
		 
             $query1 = "SELECT drugnote, drugname,drug_properties FROM druglst WHERE drugcode = '$aDgcode[$n]' ";
             //echo $query1;
			 $result1 = mysql_query($query1) or die("Query failed drugnote,druglst ");
			 list($eDrugnote,$eDgname,$eDgproperties)=mysql_fetch_array($result1);
			
			  $cPtname=substr($cPtname,0,25);
			  $aTrade[$n]=substr($aTrade[$n],0,18);
			  $showtradname="$aTrade[$n] ($aDgcode[$n])=$aAmount[$n]";
?>
<div align="center" style="margin-top:5px;margin-left:5px;">
<table border="0" align="center" width="100%" cellpadding="0" cellspacing="0" style="font-size:12px;">
  <tr>
    <th width="80%" valign="top" align="left">
	<div><strong style="font-size:14px;"><?php echo $sPtname;?></strong></div>
	<div style="font-size:12px; margin-top:-3px;"><?php echo $Thaidate;?>&nbsp;<?=$showvisit;?> .No.<?php echo $n;?>/<?php echo $injcount;?></div>
	<div style="font-size:12px; margin-top:-3px;"><?php echo $showtradname;?></div>
	<div style="font-size:12px; margin-top:-3px;"><?php echo $aDetail1[$n];?></div>
	<div style="font-size:12px; margin-top:-3px;"><?php echo $aDetail2[$n];?></div>
	<div style="font-size:12px; margin-top:-3px;"><?php echo $aDetail3[$n];?></div>	
	</th>
	<th width="8%" align="center" valign="top"><div style="margin-right:10px;"><img src="printQrCodeDrugcode.php?drugcode=<?php echo $aDgcode[$n];?>&size=3&level=2&margin=1"></div></th>
  </tr>
  <tr>
	<th colspan="2" align="left">
	<div style="font-size:12px; margin-top:-3px;"><?php echo $eDgproperties;?></div>
	<div style="font-size:12px; margin-top:-3px;"><?php echo $aDrugnote[$n];?></div>
	</th>	
  </tr> 
</table>
</div>
<div style='page-break-after: always'></div>
<?    
		}      
	}
	
 include("unconnect.inc");
?>


