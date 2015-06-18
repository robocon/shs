<body Onload="window.print();">
<?php

    session_start();

    if (isset($cHn )){ 



    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 

    include("connect.inc");



//    $appd=$appdate.'-'.$appmo.'-'.$thiyr;

    $appd=$appdate.' '.$appmo.' '.$thiyr;

    $sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,

	detail,detail2,advice,patho,xray,other,depcode)

	VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$doctor','$appd','$apptime',

	'$room','$detail','$detail2','$advice','$patho','$xray','$other','$depcode');";

    $result = mysql_query($sql);

//    echo mysql_errno() . ": " . mysql_error(). "\n";

//    echo "<br>";

   

//พิมพ์ใบนัด

   $doctor=substr($doctor,5);

   $depcode=substr($depcode,4);

    print "<font face='Angsana New' size='5'>&nbsp;&nbsp;<b>>>>>>>>>ใบนัดผู้ป่วย<<<<<<<<</b><br>";
      print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 ม.ค. 49 ********<br>";

   print "<font face='Angsana New' size='3'&nbsp;&nbsp;>>>>>โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง  โทร 054 - 221874 <<<<<br>";

   print "<b><font face='Angsana New' size='3'>ชื่อ:</b> $cPtname  &nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>อายุ:</b> $cAge&nbsp;<B>สิทธิ:$cptright&nbsp;:<u>$cidguard</u></font></B><br>";

   print "<b><FONT SIZE=4><U>นัดมาวันที่: $appd &nbsp;&nbsp;&nbsp;</U> </FONT></b><b> เวลา:</b> $apptime<br>";

   print "<b>นัดมาที่ห้อง:</b>&nbsp; $room";

   print "&nbsp;&nbsp;&nbsp;<b>แพทย์ผู้นัด:</b>&nbsp; $doctor<br>";

   IF ($detail !='NA') { 

        print "<b>เพื่อ:</b>&nbsp; $detail";

    }



   IF (!empty($detail2)) { 

        print "<b>:</b>&nbsp; $detail2<br>";

    }



   IF ($advice != 'NA') {

       print "<b>ข้อแนะนำ:</b> &nbsp;$advice<br>";

    }



   IF ($patho != 'NA') {

         print "<b>ตรวจพยาธิ:</b>&nbsp; $patho<br>";

    }



   IF ($xray != 'NA') {

        print "<b>ตรวจเอกซเรย์:</b>&nbsp; $xray<br>";

    }



   IF (!empty($other)) { 

        print "<b>ตรวจ:</b>&nbsp; $other<br>";

    }



   print "<b>ผู้ออกใบนัด:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 

   print "&nbsp;&nbsp;<b>วันและเวลาที่ออกใบนัด&nbsp;:</b>$Thaidate<br>"; 
    print "<b>หมายเหตุ:<u>$cidguard</u></b><BR>1.ผู้ป่วยนัดตรวจยื่นใบนัดที่จุดบริการนัด &nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ยื่นแผนกทะเบียน &nbsp; </B><br>3.ผู้ป่วยนัดผ่าตัด นอน และสูติ ให้ยื่นใบนัดที่แผนกทะเบียน &nbsp;&nbsp;4.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม<br>5.กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการ ในวันเวลาราชการ เวลา 13.00 น. - 15.00 น. โทร 054-221874 ต่อ 1100 , 1125"; 

 

    include("unconnect.inc");

    session_unregister("cHn");  

    session_unregister("cPtname");

    session_unregister("cAge");



        } 

else {
 $doctor=substr($doctor,5);

   $depcode=substr($depcode,4);

    print "<font face='Angsana New' size='5'>&nbsp;&nbsp;<b>>>>>>>>>ใบนัดผู้ป่วย<<<<<<<<</b><br>";
      print "<font face='Angsana New' size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 ม.ค. 49 ********<br>";

   print "<font face='Angsana New' size='3'&nbsp;&nbsp;>>>>>โรงพยาบาลค่ายสุรศักดิ์มนตรี  ลำปาง  โทร 054 - 221874 <<<<<br>";

   print "<b><font face='Angsana New' size='3'>ชื่อ:</b> $cPtname  &nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>อายุ:</b> $cAge&nbsp;<B>สิทธิ:$cptright<u>$cidguard</u></font></B><br>";

   print "<b><FONT SIZE=4><U>นัดมาวันที่: $appd &nbsp;&nbsp;&nbsp;</U> </FONT></b><b> เวลา:</b> $apptime<br>";

   print "<b>นัดมาที่ห้อง:</b>&nbsp; $room";

   print "&nbsp;&nbsp;&nbsp;<b>แพทย์ผู้นัด:</b>&nbsp; $doctor<br>";

   IF ($detail !='NA') { 

        print "<b>เพื่อ:</b>&nbsp; $detail";

    }



   IF (!empty($detail2)) { 

        print "<b>:</b>&nbsp; $detail2<br>";

    }



   IF ($advice != 'NA') {

       print "<b>ข้อแนะนำ:</b> &nbsp;$advice<br>";

    }



   IF ($patho != 'NA') {

         print "<b>ตรวจพยาธิ:</b>&nbsp; $patho<br>";

    }



   IF ($xray != 'NA') {

        print "<b>ตรวจเอกซเรย์:</b>&nbsp; $xray<br>";

    }



   IF (!empty($other)) { 

        print "<b>ตรวจ:</b>&nbsp; $other<br>";

    }



   print "<b>ผู้ออกใบนัด:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 

   print "&nbsp;&nbsp;<b>วันและเวลาที่ออกใบนัด&nbsp;:</b>$Thaidate<br>"; 
  print "<b>หมายเหตุ:<u>$cidguard</u></b><BR>1.ผู้ป่วยนัดตรวจยื่นใบนัดที่จุดบริการนัด &nbsp;&nbsp;2.กรุณามาตรงตามวันและเวลานัด&nbsp;<b>ถ้าผิดนัด </b>ให้ยื่นแผนกทะเบียน &nbsp; </B><br>3.ผู้ป่วยนัดผ่าตัด นอน และสูติ ให้ยื่นใบนัดที่แผนกทะเบียน  &nbsp;&nbsp;4.ผู้ป่วยนัดทันตกรรม ให้ยื่นใบนัดที่แผนกทันตกรรม<br>5.5.กรณีเลื่อนนัด ต้องติดต่อล่วงหน้าอย่างน้อย 2 วันทำการในวันเวลาราชการ เวลา 13.00 น. - 15.00 น. โทร 054-221874 ต่อ 1100 , 1125"; 


  die("");
         

        }

?>







