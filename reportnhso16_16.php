<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
	
	if(isset($_POST["noicd10"]) && $_POST["noicd10"] =="1"){
		$where = " AND icd10 = '' ";

	}

    $query="CREATE TEMPORARY TABLE reportnhso16 SELECT date,hn,an,drugcode,tradname,amount FROM drugrx WHERE date LIKE '$yrmonth%' ".$where;
    $result = mysql_query($query) or die("Query failed,warphar");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. ��§��ҵðҹ���������������16 DRU ��Ш���͹ $yrmonth <a target=_self  href='../nindex.htm'><<�����</a><br> ";
    print "<table>";
    print " <tr>";
  //  print "  <th bgcolor=6495ED>#</th>";
//   print "  <th bgcolor=6495ED>����</th>";
 
print " </tr>";

  // $query="SELECT * FROM reportnhso16";
 $query="SELECT date_format(reportnhso16.date,'%d/ %m/ %Y'),reportnhso16.hn,reportnhso16.an,reportnhso16.drugcode,reportnhso16.tradname,reportnhso16.amount,druglst.unitpri,druglst.salepri,druglst.code24,druglst.subunit,druglst.packing FROM reportnhso16 LEFT JOIN druglst ON reportnhso16.drugcode=druglst.drugcode";

   $result = mysql_query($query);
    while (list ($date,$hn,$an,$drugcode,$tradname,$amount,$unitpri,$salepri,$code24,$subunit,$packing) = mysql_fetch_row ($result)) {	

         
//$sql = "Select idcard From opcard where hn = '$hn' limit 1";
//$result2 = Mysql_Query($sql);
//list($idcard) = Mysql_fetch_row($result2);

$num1=1;
$num3=0;
$num2=543;

    $d=substr($date,0,2);
    $m=substr($date,4,2); 
   $y=substr($date,8,4); 
   $y1=$y-$num2;
   $y2=substr($y1,2,2);

  
$thidatehn1="$d-$m-$y$hn";
	print "$thidatehn1";
		
//$sql = "Select clinic,vn From opday where thdatehn=$thidatehn1  limit 1";
//$result3 = Mysql_Query($sql);
//list($clinic,$vn) = Mysql_fetch_row($result3);

 $clinic1=substr($clinic,0,2);
 $vn=sprintf('%03d',$vn);

//    $date1="$d/$m/$y2"; 
$date1="$y1$m$d";
if($clinic1==''){$clinic1="00";} ;
//$datem1=date_format(datem,'%d/ %m/ %Y');




        print (" <tr>\n".
        //   " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>11512|$hn|$an|$num3$clinic1$num1|$idcard|$date1|$drugcode|$tradname|$amount|$salepri|$unitpri|$code24|$subunit|$packing|$date1$vn</td>\n");
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date1</td>\n".
         //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
        //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd9</td>\n".
        //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
        //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$occupa</td>\n".         
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nation</td>\n".
        //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$id</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ward</td>\n".
           echo (" </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>