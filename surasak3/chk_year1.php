<?php    
session_start();
?>
<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.font1{
	font-family: "TH SarabunPSK";
	font-size:20px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
</style>
<?
/*
if($_SESSION["sIdname"] != "bbm"){
	echo "อยู่ระหว่างปรับปรุง";
	exit();
}
*/
$appd=$appdate.' '.$appmo.' '.$thiyr;
$appd1=$thiyr.'-'.$appmo.'-'.$appdate;
    print "<font face='TH SarabunPSK'><b>รายชื่อผู้ที่มาตรวจสุขภาพประจำปี $year</b><br>";
  
//  print "<b>วันที่</b>  ";
   
 print ".........<input type=button class='forntsarabun' onclick='history.back()' value=' << กลับไป '>";
?>


<?php
    include("connect.inc");
//    $query="CREATE TEMPORARY TABLE opacc1 SELECT * FROM opacc WHERE date like '$appd1%' ";
	
  //  $result = mysql_query($query) or die("Query failed,app");


  print "จำนวนรายการที่บันทึก/กดดู = รายชื่อผู้ป่วย<a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
   $query="SELECT  camp,COUNT(*) AS duplicate FROM chkup_solider  WHERE yearchkup = '$year'   GROUP BY camp HAVING duplicate > 0 ORDER BY camp";
   $result = mysql_query($query);
     $n=0;
 while (list ($camp,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>$n)&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'><a target=_BLANK href=\"chk_yeardetail1.php? camp=$camp&year=$year\">$camp&nbsp;&nbsp;</a></td>\n".
         "  <td BGCOLOR=66CDAA><font face='TH SarabunPSK'>จำนวน&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;รายการ</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");
?>




