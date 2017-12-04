<?php
$thiyr=$thiyr;
    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
  //  $query="CREATE TEMPORARY TABLE reportnhso02 SELECT hn,changwat,ampur,dbirth,sex,married,career,nation,idcard FROM opcard WHERE regisdate LIKE '$yrmonth%' ";
  //  $result = mysql_query($query) or die("Query failed,warphar");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่01 PERSON ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
//  print "<a target=_self  href=\"reportnhso02_02_txt.php?  yrmonth1= $yrmonth\" >ส่งออกข้อมูล</a><br> ";
    print "<table>";
    print " <tr>";
  
print " </tr>";

   $sql="SELECT a.hn,a.changwat,a.ampur,a.dbirth,a.sex,a.married,a.career,a.nation,a.idcard,b.thidate,a.yot,a.name,a.surname,a.career,a.address,a.tambol,a.ampur,a.religion,b.thidate From opcard as a,opday as b where a.hn=b.hn AND b.thidate like '$yrmonth%'  group by a.hn ";
   $result = mysql_Query($sql) or die(mysql_error());
    while (list ($hn,$changwat,$amphur,$dob,$sex,$marringe,$occupa,$nation,$id,$thidate,$yot,$name,$surname,$career,$address,$tambol,$ampur,$religion,$thidate) = mysql_fetch_row ($result)) {	
$num1=11512;
$num2=543;
    $d=substr($dob,8,2);
    $m=substr($dob,5,2); 
    $y=substr($dob,0,4); 
 $y1=$y-$num2;
   $y2=substr($y1,2,2);
   $occupa1=substr($occupa,0,2);
    //$dob1="$d/$m/$y2";
$dob1="$y1$m$d";
if($sex=='ช'){$sex1="1";} else {$sex1="2";}    ;
if($marringe=='โสด'){$marringe1="1";} else if($marringe=='สมรส'){$marringe1="2";} else {$marringe1="3";};
if($changwat=='ลำปาง'){$changwat1="52";} 
else if($changwat=='เชียงใหม่'){$changwat1="50";}
else if($changwat=='พะเยา'){$changwat1="56";}
else if($changwat=='น่าน'){$changwat1="55";}
else if($changwat=='อุตรดิตถ์'){$changwat1="53";}
else if($changwat=='แพร่'){$changwat1="54";}
else if($changwat=='เชียงราย'){$changwat1="57";}
else if($changwat=='ลำพูน'){$changwat1="51";} 
else {$changwat1="52";};
if($nation=='ไทย'){$nation1="099";} else {$nation1="000";};
$fullname=$name.' '.$surname.','.$yot;
if(strlen($id)=="13" and substr($id,0,1) != "0"){$idtype="1";}else {$idtype="4";};

 $career=substr( $career,0,2);
if($career=='01'){$career1="001";} 
else if($career=='02'){$career1="002";}
else if($career=='03'){$career1="014";}
else if($career=='04่'){$career1="003";}
else if($career=='05'){$career1="007";}
else if($career=='06'){$career1="004";}
else if($career=='07'){$career1="004";}
else if($career=='08'){$career1="901";}
else if($career=='09'){$career1="004";}
else if($career=='10'){$career1="005";}
else if($career=='11'){$career1="000";}
else if($career=='12'){$career1="013";}
else if($career=='13'){$career1="010";}
else {$career="901";};

if($religion=='พุทธ'){$religion='1';}else{$religion='9';};



  $thidated=substr($thidate,8,2);
   $thidatem=substr($thidate,5,2); 
 $thidatey=substr($thidate,0,4); 
  $thidatem1=substr($thidate,11,2); 
   $thidatem2=substr($thidate,14,2); 
    $thidatem3=substr($thidate,17,2); 

    $thidatey1= $thidatey-$num2;
  


//$datem1=date_format(datem,'%d/ %m/ %Y');
        print ("$num1|$id|$hn||$yot|$name|$surname|$hn|$sex1|$dob1|$address|0|0|0|$changwat1|$marringe1|$career1|000|$nation1|$religion||||||||||||4| $thidatey1$thidatem$thidated$thidatem1$thidatem2$thidatem3<BR>".
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>