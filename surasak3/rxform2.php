<?php 
session_start();
include("connect.inc");
?>
<body Onload="window.print();">
    <html>
    <head>
        <title>add_user</title>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
        <link href="css/backoffice.css" rel="stylesheet" type="text/css">
        <meta http-equiv="refresh" content="1;URL=oplist1.php">
    </head>

    <?php

    
    $thdatehn="";
    session_register("thdatehn");
    $ok = 'N';

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
            $pAge="$ageY ปี";
        }
        else{
            $pAge="$ageY ปี $ageM เดือน";
        }
        return $pAge;
    }
    //หาข้อมูลจาก opcard ของ $cHn เพื่อใช้ทั้งในกรณีลงทะเบียนแล้ว หรือยังไม่ลง
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



        $cCbirth =$row->cbirth; // (วันเกิดข้อความเก็บไว้ดู)
        $cDbirth =$row->dbirth;
        $cD=substr($cDbirth,8,2);
        $cM=substr($cDbirth,5,2);
        $cY=substr($cDbirth,0,4);
        $dbirth="$cY-$cM-$cD"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
        $cAge=calcage($dbirth);


        $cIdguard=$row->idguard;

        // echo "HN : $cHn, ชื่อ-สกุล: $cYot   $cName  $cSurname<br>";
        // echo "<font face='Angsana New' size=4><b>สิทธิการรักษา : $cPtright :<font face='Angsana New' size=5><u>$cIdguard</u></b></font><br> ";
        //        echo "หมายเลขบัตร ปชช.: $cIdcard <br> ";
        // echo "หมายเหตุ.: $cNote <br> ";
        //echo "<B>หมายเหตุ.:.ให้ตรวจสอบสิทธิทุกครั้งก่อนออกใบสั่งยา </B><br> ";
    }
    //
    $thidate = (date("Y")+543).date("-m-d H:i:s");
    $Thaidate1=date("dm").(date("Y"));
    $today = date("d-m-Y");
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;
    //  $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
    $thdatehn=$d.'-'.$m.'-'.$yr.$cHn;   //  session ใช้ update opday table
    // print "วันที่  $thidate<br>";
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
    //print "$today<br>";
    //print "$dVndate<br>";
    //print "$nVn.'A'<br>";

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
            print "ได้หมายเลข VN = $nVn  ........  ...ผู้ตรวจสอบสิทธิ  ..........$sOfficer<br>";
            //  print "การออก OPD CARD  = $case<br>";
        }
        //วันใหม่
        if($today<>$dVndate){
            $nVn=1;
            $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
            $query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
            $result = mysql_query($query) or die("Query failed");
            //   	         echo mysql_errno() . ": " . mysql_error(). "\n";
            //                       echo "<br>";
            // print "วันใหม่  เริ่ม VN = $nVn <br>";
        }
        //ลงทะเบียนใน opday table
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

        //print "VN: $nVn ลงทะเบียนไปก่อนแล้ว......ผู้ตรวจสอบสิทธิ  ..........$sOfficer";
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

    print "<DIV style='left:60PX;top:10PX;width:100PX;height:30PX;'><span class='fc1-2'>VN: $nVn</span></DIV>";
    print "<DIV style='left:130PX;top:10PX;width:300PX;height:30PX;'><span class='fc1-2'>HN: $cHn</span></DIV>";
    print "<DIV style='left:280PX;top:10PX;width:200PX;height:30PX;'><span class='fc1-0'>$Thaidate</span></DIV>";
    print "<DIV style='left:410PX;top:70PX;width:500PX;height:30PX;'><span class='fc1-1'>สิทธิ : $cPtright</span></DIV>";
    print "<DIV style='left:60PX;top:40PX;width:500PX;height:30PX;'><span class='fc1-1 '>$cPtname</span></DIV>";
    print "<DIV style='left:300PX;top:40PX;width:200PX;height:30PX;'><span class='fc1-0'>อายุ $cAge</span></DIV>";

    $cIdcard1=substr($cIdcard,0,1);
    $cIdcard2=substr($cIdcard,1,4);
    $cIdcard3=substr($cIdcard,5,5);
    $cIdcard4=substr($cIdcard,10,2);
    $cIdcard5=substr($cIdcard,12,1);
    $cIdcard9=$cIdcard1."-".$cIdcard2."-".$cIdcard3."-".$cIdcard4."-".$cIdcard5;



    print "<DIV style='left:50PX;top:70PX;width:306PX;height:30PX;'><span class='fc1-0'>บัตร ปชช:  $cIdcard9</span></DIV>";
    print "<DIV style='left:240PX;top:70PX;width:300PX;height:30PX;'><span class='fc1-0'>#.$cIdguard</span></DIV>";
    print "<DIV style='left:20PX;top:100PX;width:500PX;height:30PX;'><span class='fc1-0'>$cNote:</span></DIV>";
    //print "<DIV style='left:350PX;top:160PX;width:500PX;height:30PX;'><span class='fc1-99'>01$Thaidate1$nVn</span></DIV>";
    //print "<DIV style='left:530PX;top:160PX;width:500PX;height:30PX;'><span class='fc1-99'>HN: $cHn</span></DIV>";
    //print "<DIV style='left:520PX;top:10PX;width:306PX;height:30PX;'><span class='fc1-0'>$sOfficer..ตรวจสอบสิทธิ</span></DIV>";
    print "<DIV style='left:50PX;top:130PX;width:600PX;height:30PX;'><span class='fc1-0'><img src = \"printbcpha.php?cHn=$idcard\"></span></DIV>";


    print "<DIV style='left:390PX;top:620PX;width:600PX;height:30PX;'><span class='fc1-0'>....... แพทย์จ่ายยาผ่านระบบคอม</span></DIV>";


    print "</BODY></HTML>";



    include("connect.inc");

    $sql = "SELECT inrxform FROM opcard WHERE  hn = '".$cHn."' limit 1";
    $result = Mysql_Query($sql);
    list($note) = Mysql_fetch_row($result);

    if($note != ""){
        if($note == "ผู้ป่วยกลุ่มเสี่ยงต้องได้รับการฉีดวัคซีนป้องกันโรคไข้หวัดใหญ่(ฟรี)")
        $note .= "<BR>Influza Vaccine 0.5 ml. IM";
        print "<DIV style='left:340PX;top:130PX;width:500PX;height:30PX'><span class='fc1-0'>".$note."</span></DIV>";
        $top_drugreact = "180";
    }else{
        $top_drugreact = "130";
    }

    //แพ้ยา

    $query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '".$cHn."' ";
    $result = mysql_query($query) or die("Query drugreact failed");
    $count =mysql_num_rows($result);
    if($count > 0){
        $i=1;
        print "<DIV style='left:330px;top:".$top_drugreact."px;width:700PX;height:30PX;' ><span class='fc1-0'>";
        print "<B>ประวัติการแพ้ยา</B><BR>";
        while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
            print $tradname;
            if($i != $count)
            if($i%3==0) print "<BR>";else print ",&nbsp;";
            $i++;
        }
        print "</span></DIV>";

    }
    //แพ้ยา

    $query = "SELECT kew,toborow FROM opday WHERE  thdatehn = '$thdatehn' AND vn = '".$_GET["cVn"]."' ";
    $result = mysql_query($query)
    or die("Query drugreact failed");

    if(mysql_num_rows($result)){
        print "<div align='right'>";
        print"<table border='0' width='80%'>";
        print"<tr>

        <td width='70%'><br></td>
        <td width='80%'><br><br><br><br><br><br>";
        while (list ($kew,$ctoborow) = mysql_fetch_row ($result)) {

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

            print ".fc1-0 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

            print ".fc1-1 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

            print ".fc1-2 { COLOR:000000;FONT-SIZE:22PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
            print ".fc1-3 { COLOR:000000;FONT-SIZE:16PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

            print ".fc1-7 { COLOR:000000;FONT-SIZE:40PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";


            print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

            print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

            print "</STYLE>";



            print "<TITLE>Crystal Report Viewer</TITLE>";

            print "</head>";

            print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

            print "<DIV style='z-index:0'> &nbsp; </div>";

            print "<DIV style='left:450PX;top:10PX;width:500PX;height:30PX;'><span class='fc1-1'>ลำดับที่:</span></DIV>";
            print "<DIV style='left:520PX;top:0PX;width:900PX;height:70PX;'><span class='fc1-7'>$kew</span></DIV>";

            print "<DIV style='left:430PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-0'>$ctoborow</span></DIV>";




            print "</BODY></HTML>";
            print (" <tr>\n".
            "  <td ><font face='cordia New' size=3></td>\n".
            "  <td ><font face='cordia New' size=3></td>\n".
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
