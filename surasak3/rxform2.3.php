

<body Onload="window.print();">
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*����������ԹҷչФ�Ѻ�ç�Ţ 5 */); 
</Script>
<?php

    session_start();
    $thdatehn="";
    session_register("thdatehn"); 
 
    include("connect.inc");   

$ok = 'p';

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
           $pAge="$ageY ��";
             }
      else{
            $pAge="$ageY �� $ageM ��͹";
                        }
      return $pAge;
          }
//�Ң����Ũҡ opcard �ͧ $cHn ��������㹡ó�ŧ����¹���� �����ѧ���ŧ
$_SESSION["cHn"] = $_GET["cHn"];
	    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
	    $result = mysql_query($query) or die("Query failed");

	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
			     	              }
	        if(!($row = mysql_fetch_object($result)))
	            continue;
			    	       		       }
	   If ($result){
//	      $cHn=$row->hn;
	      $cYot = $row->yot;
 	      
	      $cIdcard = $row->idcard;
	      $cName = $row->name;
	      $cSurname = $row->surname;
              $cPtname=$cYot.' '.$cName.'  '.$cSurname;
	      $cPtright = $row->ptright;
              $cGoup=$row->goup;
	      $cCamp=$row->camp;
              $cNote=$row->note;
  


$cCbirth =$row->cbirth; // (�ѹ�Դ��ͤ���������)
	$cDbirth =$row->dbirth;
 $cD=substr($cDbirth,8,2);
    $cM=substr($cDbirth,5,2); 
    $cY=substr($cDbirth,0,4); 
$dbirth="$cY-$cM-$cD"; //�觼�ҹ�������ѹ�Դ�ҡ opedit �¡�� submit
$cAge=calcage($dbirth);


	               $cIdguard=$row->idguard;
 
	     // echo "HN : $cHn, ����-ʡ��: $cYot   $cName  $cSurname<br>";  
                   // echo "<font face='Angsana New' size=4><b>�Է�ԡ���ѡ�� : $cPtright :<font face='Angsana New' size=5><u>$cIdguard</u></b></font><br> ";
       //        echo "�����Ţ�ѵ� ���.: $cIdcard <br> ";
 		// echo "�����˵�.: $cNote <br> ";
//echo "<B>�����˵�.:.����Ǩ�ͺ�Է�Էء���駡�͹�͡������ </B><br> ";
	      }  
//
    $thidate = (date("Y")+543).date("-m-d H:i:s"); 
  $Thaidate1=date("dm").(date("Y"));
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
//  $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
    $thdatehn=$d.'-'.$m.'-'.$yr.$cHn;   //  session �� update opday table
   // print "�ѹ���  $thidate<br>";
//    print " $thdatehn<br>";

//to find AN from runno table
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'AN'";
    $result = mysql_query($query)
        or die("Query failed runno ask");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $vTitle=$row->title;
    $vPrefix=$row->prefix;
    $nRunno=$row->runno;
    $nRunno++;
    $vAN=$vPrefix.$nRunno;

//�� VN �ҡ runno table
	    $query = "SELECT * FROM runno WHERE title = 'VN'";
	    $result = mysql_query($query) or die("Query failed");
	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
				              }
	        if(!($row = mysql_fetch_object($result)))
	            continue;
				                                       }
//  	    $cTitle=$row->title;  //=VN
	    $nVn=$row->runno;
	    $dVndate=$row->startday;
	    $dVndate=substr($dVndate,0,10);
	    $today = date("Y-m-d");  
//print "$today<br>";
//print "$dVndate<br>";
//print "$nVn.'A'<br>";

// ��Ǩ����� �ѹ���ŧ����¹�����ѧ
    $query = "SELECT hn,vn FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC ";
    $result = mysql_query($query)
        or die("Query failed,opday");
//    echo mysql_errno() . ": " . mysql_error(). "\n";
//    echo "<br>";

        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }	
//�ó��ѧ���ŧ����¹
    If (empty($row->hn)){
                    //�ѧ�������¹�ѹ���
                    if($today==$dVndate){
                         $nVn++;
             	         $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
      	         $query ="UPDATE runno SET runno = $nVn WHERE title='VN'";
	         $result = mysql_query($query) or die("Query failed");
	         print "�������Ţ VN = $nVn  ........  ...����Ǩ�ͺ�Է��  ..........$sOfficer<br>";
       //  print "����͡ OPD CARD  = $case<br>";
			     }
//�ѹ����
                    if($today<>$dVndate){    
                         $nVn=1;
             	         $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
      	         $query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
	         $result = mysql_query($query) or die("Query failed");
//   	         echo mysql_errno() . ": " . mysql_error(). "\n";
//                       echo "<br>";
                        // print "�ѹ����  ����� VN = $nVn <br>";
	                                     }	
//ŧ����¹� opday table
	    $query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,
                	     ptright,goup,camp,note,idcard,toborow,borow,dxgroup,officer)VALUES('$thidate','$thdatehn','$cHn','$nVn',
	                    '$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$note','$cIdcard','$case','$borow','$code21','$sOfficer');";
	    $result = mysql_query($query) or die("Query failed,cannot insert into opday");
           }  
else  {
$nVn=$row->vn;

        $query ="UPDATE opday SET phaok='$ok' WHERE thdatehn = '$thdatehn' AND vn = '".$nVn."' ";
        $result = mysql_query($query)
                       or die("Query failed,update opday");

//print "VN: $nVn ŧ����¹仡�͹����......����Ǩ�ͺ�Է��  ..........$sOfficer";
         }
  include("unconnect.inc");
/////rxform.php
     $Thaidate=date("d-m-").(date("Y")+543)." ����  ".date("H:i:s");


print "<HTML>";

print "<script>";

 print "ie4up=nav4up=false;";

 print "var agt = navigator.userAgent.toLowerCase();";

 print "var major = parseInt(navigator.appVersion);";

 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";

   print "ie4up = true;";

 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";

   print "nav4up = true;";

print "</script>";



print "<head>";

print "<STYLE>";

 print "A {text-decoration:none}";

 print "A IMG {border-style:none; border-width:0;}";

 print "DIV {position:absolute; z-index:25;}";

print ".fc1-0 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:21PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:22PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-4 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-99 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:3 of 9 Barcode;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<center>$Thaidate<br>";
print "HN: $cHn......VN: $nVn<br>";
print "$ctoborow<br>";
print "�Է�� : $cPtright<br>";
print "$cPtname<br>";
print "�ѵ� ���:  $cIdcard</center></DIV>";
//print "<DIV style='left:350PX;top:160PX;width:500PX;height:30PX;'><span class='fc1-99'>01$Thaidate1$nVn</span></DIV>";
//print "<DIV style='left:530PX;top:160PX;width:500PX;height:30PX;'><span class='fc1-99'>HN: $cHn</span></DIV>";
//print "<DIV style='left:520PX;top:10PX;width:306PX;height:30PX;'><span class='fc1-0'>$sOfficer..��Ǩ�ͺ�Է��</span></DIV>";




print "</BODY></HTML>";






 include("unconnect.inc"); 
//add

?>




