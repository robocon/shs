<body Onload="window.print();">

<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>
<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $dDate=$sDate;
    include("connect.inc");
  
    $query = "SELECT * FROM depart WHERE date = '$dDate' AND row_id = '".$_GET["gRow_id"]."' limit 1";
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
    $cHn=$row->hn;
    $cAn=$row->an;
    $cPtname=$row->ptname;
	  $cLab=$row->lab;
	  $idno = $row->row_id;


  

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

print ".fc1-0 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-7 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";
print ".fc1-4 { COLOR:000000;FONT-SIZE:30PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-5 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-6 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";
//print "<DIV style='left:0PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-3'><b>&nbsp;&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี </b></span></DIV>";
//print "<DIV style='left:150PX;top:6PX;width:200PX;height:30PX;'><span class='fc1-4'><u>LAB</u></span></DIV>";
print "<DIV style='left:0PX;top:0PX;width:200PX;height:30PX;'><span class='fc1-6'><b>HN:</b>$cHn&nbsp;<b></b>($tvn)&nbsp;$Thaidate</span></DIV>";
//print "<DIV style='left:0PX;top:25PX;width:200PX;height:30PX;'><span class='fc1-6'>$Thaidate</span></DIV>";
print "<DIV style='left:0PX;top:15PX;width:500PX;height:30PX;'><span class='fc1-0'>$cPtname</span></DIV>";
$nLab21=sprintf("%03d",$cLab);
$labno=substr(date("Y"),2,2).date("md").$nLab21."02";
print "<DIV style='left:45PX;top:55PX;width:100PX;height:10PX;'><span class='fc1-0'><img src = \"barcode/labstk.php?cLabno=$labno\"></span></DIV>";

//print "<DIV style='left:70PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-1'>Lab  No.</span></DIV>";
print "<DIV style='left:10PX;top:70PX;width:500PX;height:30PX;'><span class='fc1-7'> $cLab</span></DIV>";
  print "<br><br>";
    $query = "SELECT code FROM patdata WHERE date = '$dDate' AND idno = '".$idno."' ";
    $result = mysql_query($query)
        or die("Query failed");
	print "<DIV style='left:0PX;top:35PX;width:180PX;' >";
    while (list ($code) = mysql_fetch_row ($result)) {

             print "<font face='Angsana New' size='1'>$code, </font>";
      }
  print "</DIV>";
  
	
    include("unconnect.inc");
?>