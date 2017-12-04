<?php
    session_start();
    $thdatehn="";
    session_register("thdatehn"); 
 
    include("connect.inc");   

//หาข้อมูลจาก opcard ของ $cHn เพื่อใช้ทั้งในกรณีลงทะเบียนแล้ว หรือยังไม่ลง
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
	      $cName = $row->name;
	      $cSurname = $row->surname;
                      $cPtname=$cYot.' '.$cName.'  '.$cSurname;
	      $cPtright = $row->ptright;
                      $cGoup=$row->goup;
	      $cCamp=$row->camp;
                      $cNote=$row->note;
//	      echo "HN : $cHn,  $cYot   $cName  $cSurname<br>";  
//                      echo "สิทธิการรักษา : $cPtright <br> ";
	      }  
//
    $thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
//  $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
    $thdatehn=$d.'-'.$m.'-'.$yr.$cHn;   //  session ใช้ update opday table
//    print "วันที่  $thidate<br>";
//    print " $thdatehn<br>";

//หา VN จาก runno table
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

// ตรวจดูว่า วันนี้ลงทะเบียนหรือยัง
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
//กรณียังไม่ลงทะเบียน
    If (empty($row->hn)){
                    //ยังไม่เปลี่ยนวันที่
                    if($today==$dVndate){
                         $nVn++;
             	         $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
      	         $query ="UPDATE runno SET runno = $nVn WHERE title='VN'";
	         $result = mysql_query($query) or die("Query failed");
//	         print "ได้หมายเลข VN = $nVn<br>";
			     }
//วันใหม่
                    if($today<>$dVndate){    
                         $nVn=1;
             	         $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
      	         $query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
	         $result = mysql_query($query) or die("Query failed");
//   	         echo mysql_errno() . ": " . mysql_error(). "\n";
//                       echo "<br>";
//                         print "วันใหม่  เริ่ม VN = $nVn <br>";
	                                     }	
//ลงทะเบียนใน opday table
	    $query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,
                	     ptright,goup,camp)VALUES('$thidate','$thdatehn','$cHn','$nVn',
	                    '$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp');";
	    $result = mysql_query($query) or die("Query failed,cannot insert into opday");
           }  
else  {
$nVn=$row->vn;

        $query ="UPDATE opday SET ptname='$cPtname',
			         ptright='$cPtright',
			         goup='$cGoup',
			         camp='$cCamp'
                       WHERE thdatehn = '$thdatehn'";
        $result = mysql_query($query)
                       or die("Query failed,update opday");

//print "VN: $nVn ลงทะเบียนไปก่อนแล้ว";
//update data in appoint
        $query ="UPDATE appoint SET came ='Y'
                       WHERE row_id ='$nRow' ";
        $result = mysql_query($query)
                       or die("Query failed,update appoint");
         }
  include("unconnect.inc");

/////rxform.php
     $Thaidate=date("d-m-").(date("Y")+543)." เวลา  ".date("H:i:s");


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

print ".fc1-0 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:80PX;top:40PX;width:100PX;height:30PX;'><span class='fc1-2'>VN: $nVn</span></DIV>";
print "<DIV style='left:150PX;top:40PX;width:200PX;height:30PX;'><span class='fc1-0'>HN: $cHn</span></DIV>";
print "<DIV style='left:240PX;top:40PX;width:200PX;height:30PX;'><span class='fc1-0'>$Thaidate</span></DIV>";
print "<DIV style='left:395PX;top:40PX;width:306PX;height:30PX;'><span class='fc1-1'>สิทธิ : $cPtright</span></DIV>";
print "<DIV style='left:80PX;top:70PX;width:306PX;height:30PX;'><span class='fc1-3 '>$cPtname</span></DIV>";
print "<DIV style='left:300PX;top:70PX;width:200PX;height:30PX;'><span class='fc1-0'>อายุ $cAge</span></DIV>";
print "<DIV style='left:410PX;top:70PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตร ปชช:  $cIdcard</span></DIV>";
print "<DIV style='left:570PX;top:70PX;width:300PX;height:30PX;'><span class='fc1-0'>#.$cIdguard</span></DIV>";
print "<DIV style='left:400PX;top:120PX;width:306PX;height:30PX;'><span class='fc1-0'>$cNote:</span></DIV>";
print "<DIV style='left:540PX;top:10PX;width:306PX;height:30PX;'><span class='fc1-0'>$sOfficer..ตรวจสอบสิทธิ</span></DIV>";




print "</BODY></HTML>";



 include("connect.inc");  
    $query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '$cHn' ";
    $result = mysql_query($query)
        or die("Query drugreact failed");

   if(mysql_num_rows($result)){
print "<div align='right'>";
print"<table border='0' width='50%'>";
	print"<tr>

		<td width='40%'><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>ประวัติการแพ้ยา</td>
		<td width='60%'><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br<br>";
  while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
            print (" <tr>\n".
                "  <td BGCOLOR=F5DEB3><font face='cordia New' size=3>$tradname</td>\n".
                "  <td BGCOLOR=F5DEB3><font face='cordia New' size=3>$advreact($asses)</td>\n".
                " </tr>\n");
  						    }
	print"	</td>";
	print"</tr>";
print"</table>";
print "</div>";
			}
 include("unconnect.inc");  
//add


?>




