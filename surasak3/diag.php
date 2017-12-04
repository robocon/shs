<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
	
	if(isset($_POST["noicd10"]) && $_POST["noicd10"] =="1"){
		$where = " AND icd10 = '' ";

	}

    $query="CREATE TEMPORARY TABLE reportnhso05 SELECT hn,thidate,doctor,icd10,clinic , toborow,vn,diagtype,an FROM opday WHERE thidate LIKE '$yrmonth%' ".$where;
    $result = mysql_query($query) or die("Query failed,warphar");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงานมาตรฐานแฟ้มข้อมูลแฟ้มที่06 DIAG ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
  //  print "  <th bgcolor=6495ED>#</th>";
//   print "  <th bgcolor=6495ED>รหัส</th>";
 
print " </tr>";

  // $query="SELECT * FROM reportnhso05";
 $query="SELECT reportnhso05.hn,date_format(reportnhso05.thidate,'%d/ %m/ %Y'),reportnhso05.doctor,reportnhso05.clinic,opcard.idcard , reportnhso05.toborow,reportnhso05.vn,reportnhso05.an,reportnhso05.thidate,reportnhso05.icd10 FROM reportnhso05 LEFT JOIN opcard ON reportnhso05.hn=opcard.hn";

   $result = mysql_query($query);
    while (list ($hn,$date,$doctor,$clinic,$id,$toborow,$vn,$an,$date2,$icd10opday) = mysql_fetch_row ($result)) {	

         $sql3 = "SELECT icd10,type,svdate FROM diag WHERE svdate LIKE '".substr($date2,0,10)."%' and hn='$hn' and status='Y' and icd10!='' ";

		$rows3 = mysql_query($sql3);
		$num1 = mysql_num_rows($rows3);
		if($num1>0){
			while(list($icd10,$typediag,$svdate) =mysql_fetch_array($rows3)){
				if($typediag=="PRINCIPLE"){$type="1";}
				elseif($typediag=="CO-MORBIDITY"){$type="2";}
				elseif($typediag=="COMPLICATION"){$type="3";}
				elseif($typediag=="OTHER"){$type="4";}
				elseif($typediag=="EXTERNAL CAUSE"){$type="5";}
				
				$num1=1;
				$num3='0';
				$num2=543;
				$num00='00';
			
				$d=substr($date,0,2);
				$m=substr($date,4,2); 
				$y=substr($date,8,4); 
				$y1=$y-$num2;
				$y2=substr($y1,2,2);
				$clinic1=substr($clinic,0,2);
				
				if($icd10 == ""){
							
					if($toborow == "EX 91 ออก VN โดย กายภาพ")
						$icd10 = "Z501";
					else if(substr($toborow,0,4) == "EX01"){
						$icd10 = "Z501";
					}else if(substr($toborow,0,4) == "EX07")
						$icd10 = "Z012";
					else if(substr($toborow,0,4) == "EX11")
						$icd10 = "Z501";
					else if(substr($toborow,0,4) == "EX14")
						$icd10 = "Z018";
					else if($toborow == "ออก VN โดย LAB")
						$icd10 = "Z017";
						
				}
				
				$vn=sprintf('%03d',$vn);
				$date1="$y1$m$d";
				if($clinic1==''){$clinic1="99";} ;
				if($icd10==''){$icd10="Z532";};
				if($an== '' ){$c1="0";} else {$c1="1";};
			
				$clinicall="$c1$clinic1$num00";
				$yy = substr($svdate,0,4)-543;
				$mm = substr($svdate,5,2);
				$dd = substr($svdate,8,2);
				$hh = substr($svdate,11,2);
				$ii = substr($svdate,14,2);
				$ss = substr($svdate,17,2);
				$dateup = "$yy$mm$dd$hh$ii$ss";
				
				print ("11512|$hn|$date1$vn|$date1|$type|$icd10|$dateup|$clinicall|$id<BR>");
			}
				
		}else{
			$icd10=$icd10opday;
			$type="1";
			$num1=1;
			$num3='0';
			$num2=543;
			$num00='00';
		
			$d=substr($date,0,2);
			$m=substr($date,4,2); 
			$y=substr($date,8,4); 
			$y1=$y-$num2;
			$y2=substr($y1,2,2);
			$clinic1=substr($clinic,0,2);
			
			if($icd10 == ""){
						
				if($toborow == "EX 91 ออก VN โดย กายภาพ")
					$icd10 = "Z501";
				else if(substr($toborow,0,4) == "EX01"){
					$icd10 = "Z501";
				}else if(substr($toborow,0,4) == "EX07")
					$icd10 = "Z012";
				else if(substr($toborow,0,4) == "EX11")
					$icd10 = "Z501";
				else if(substr($toborow,0,4) == "EX14")
					$icd10 = "Z018";
				else if($toborow == "ออก VN โดย LAB")
					$icd10 = "Z017";
					
			}
			
			$vn=sprintf('%03d',$vn);
			$date1="$y1$m$d";
			if($clinic1==''){$clinic1="99";} ;
			if($icd10==''){$icd10="Z532";};
			if($an== '' ){$c1="0";} else {$c1="1";};
		
			$clinicall="$c1$clinic1$num00";
			$yy = substr($svdate,0,4);
			$mm = substr($svdate,5,2);
			$dd = substr($svdate,8,2);
			$hh = substr($svdate,11,2);
			$ii = substr($svdate,14,2);
			$ss = substr($svdate,17,2);
			$dateup = "$yy$mm$dd$hh$ii$ss";
			
			print ("11512|$hn|$date1$vn|$date1|$type|$icd10|$dateup|$clinicall|$id<BR>");
		}

		echo (" </tr>\n");
			
/*		if(isset($_POST["noicd10"]) && $_POST["noicd10"] =="1"){
			print ("<td>".$toborow."</td>");
		}*/
	}
              

print "<table>";

include("unconnect.inc");
?>