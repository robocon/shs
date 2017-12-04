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
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่06 DIAG ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
  //  print "  <th bgcolor=6495ED>#</th>";
//   print "  <th bgcolor=6495ED>รหัส</th>";
 
print " </tr>";

  // $query="SELECT * FROM reportnhso05";
 $query="SELECT reportnhso05.hn,date_format(reportnhso05.thidate,'%d/ %m/ %Y'),reportnhso05.doctor,reportnhso05.icd10,reportnhso05.clinic,opcard.idcard , reportnhso05.toborow,reportnhso05.vn,reportnhso05.diagtype,reportnhso05.an FROM reportnhso05 LEFT JOIN opcard ON reportnhso05.hn=opcard.hn";

   $result = mysql_query($query);
    while (list ($hn,$date,$doctor,$icd10,$clinic,$id,$toborow,$vn,$diagtype,$an) = mysql_fetch_row ($result)) {	

         
$sql = "Select codedoctor From inputm where name = '$doctor' limit 1";
$result2 = Mysql_Query($sql);
list($doctor22) = Mysql_fetch_row($result2);


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
$doctor1=substr($doctor,0,5);
if  ($doctor1=='MD022'){$doctor2="00000";} else 
if  ($doctor1=='MD006'){$doctor2="12891";} else 
if  ($doctor1=='MD007'){$doctor2="12456";} else 
if  ($doctor1=='MD008'){$doctor2="16633";} else 
if  ($doctor1=='MD009'){$doctor2="19364";} else 
if  ($doctor1=='MD011'){$doctor2="20186";} else 
if  ($doctor1=='MD013'){$doctor2="19921";} else 
if  ($doctor1=='MD014'){$doctor2="20182";} else 
if  ($doctor1=='MD015'){$doctor2="21504";} else 
if  ($doctor1=='MD016'){$doctor2="21329";} else 
if  ($doctor1=='MD020'){$doctor2="3448";} else 
if  ($doctor1=='MD030'){$doctor2="5947";} else 
if  ($doctor1=='MD036'){$doctor2="20278";} else 
if  ($doctor1=='MD037'){$doctor2="10212";} else 
if  ($doctor1=='MD041'){$doctor2="27035";} else 
if  ($doctor1=='MD043'){$doctor2="1850";} else 
if  ($doctor1=='MD047'){$doctor2="24535";} else 
if  ($doctor1=='MD048'){$doctor2="29290";} else 
if  ($doctor1=='MD049'){$doctor2="37555";} else 
if  ($doctor1=='MD050'){$doctor2="37525";} else 
if  ($doctor1=='MD051'){$doctor2="24512";} else 
if  ($doctor1=='MD052'){$doctor2="19286";} else 
if  ($doctor1=='MD057'){$doctor2="00000";} else 
{
$doctor2="";
};



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

//    $date1="$d/$m/$y2"; 
$date1="$y1$m$d";
if($clinic1==''){$clinic1="99";} ;
//$datem1=date_format(datem,'%d/ %m/ %Y');

if($icd10==''){$icd10="Z532";};
$diagtype=substr($diagtype,0,1);
if($diagtype==''){$diagtype="1";};


if($an== '' ){$c1="0";} else {$c1="1";};

$clinicall="$c1$clinic1$num00";

        print (
        //   " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
           "11512|$hn|$date1$vn|$date1|1|$icd10||$clinicall<BR>");
		
		if(isset($_POST["noicd10"]) && $_POST["noicd10"] =="1"){
			print ("<td>".$toborow."</td>");
		}
              echo (" </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>