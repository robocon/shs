
<?php
    $yrmonth= $yrmonth1;
//header('Content-type: application/notepad');
//header('Content-Disposition: attachment; filename="PAT_11512_YYYYMM_YYYYMMDD.txt"'); 

   
      include("connect.inc");
$yy=543;
    $query="CREATE TEMPORARY TABLE reportnhso02 SELECT hn,changwat,ampur,dbirth,sex,married,career,nation,idcard FROM opcard WHERE regisdate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
    
  print "1. ��§��ҵðҹ���������������02 PAT ��Ш���͹ $yrmonth <a target=_self  href='../nindex.htm'><<�����</a><br> ";
  print "<a target=_self  href=\"reportnhso02_02_txt.php?  yrmonth1= $yrmonth\" >���͡������</a><br> ";
    print "<table>";
    print " <tr>";
  


   $query="SELECT * FROM reportnhso02";
   $result = mysql_query($query);
    while (list ($hn,$changwat,$amphur,$dob,$sex,$marringe,$occupa,$nation,$id) = mysql_fetch_row ($result)) {	
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
if($sex=='�'){$sex1="1";} else {$sex1="2";}    ;
if($marringe=='�ʴ'){$marringe1="1";} else if($marringe=='����'){$marringe1="2";} else {$marringe1="3";};
if($changwat=='�ӻҧ'){$changwat1="52";} else {$changwat1="";};
if($nation=='��'){$nation1="99";} else {$nation1="00";};

//$datem1=date_format(datem,'%d/ %m/ %Y');
        print (" <tr>\n".
           " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1|$hn|$changwat1||$dob1|$sex1|$marringe1|000|$nation1|$id</td>\n".
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>
