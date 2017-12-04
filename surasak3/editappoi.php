<?php
  print " ยังไม่ได้เขียนโปรแกรมนี้";
/*
    include("connect.inc");

    $query = "SELECT * FROM opday WHERE thdatehn = '$cTdatehn'";
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

   If ($result){
        //vn,ptname,hn,an,goup,diag,dxgroup
        $cPtname=$row->ptname;
        $cHn=$row->hn;
        $cDoctor=$row->doctor;
        $cDiag=$row->diag;
        $cOkopd=$row->okopd;
                  }  
   else {
      echo "ไม่พบ รหัส : $cTdatehn";
           }    
include("unconnect.inc");

print "<body bgcolor='##669999' text='#FFFFFF'>";
print "<form method='POST' action='okopd.php' target='_BLANK'>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "ตรวจสอบแก้ไข แพทย์ผู้รักษา การวินิจฉัยโรค</p>";
print "<div align='left'>";
print "<table border='0' cellpadding='0' cellspacing='0' width='76%'>";
print "<tr>";
print "<td width='15%'></td>";
print "<td width='32%' valign='middle'>HN";
print "<p>ชื่อผู้ป่วย</p>";
print "<p>แพทย์ผู้รักษา</p>";
print "<p>วินิจฉัยโรค</p>";
print "<p>คืนบัตร ?</td>";
print "<td width='42%' valign='top'><input type='text' name='hn' size='30' value='$cHn'>";
print "<p><input type='text' name='ptname' size='30' value='$cPtname'></p>";

print " <select  name='doctor'>";
print " <OPTION value='$cDoctor'>";
print " <option value='$cDoctor' selected>$cDoctor</option>";
print " <option value='0' ><-เลือก-></option>";

print "<option value='MD022 (ไม่ทราบแพทย์)'>(ไม่ทราบแพทย์)</option>";
print "<option value='MD003 ขุนศึก ขาวสำลี'>ขุนศึก ขาวสำลี</option>";
print "<option value='MD006 เลือก ด่านสว่าง'>เลือก ด่านสว่าง</option>";
print "<option value='MD007 ณรงค์ ปรีดาอนันทสุข'>ณรงค์ ปรีดาอนันทสุข</option>";
print "<option value='MD008 อรรณพ ธรรมลักษมี'>อรรณพ ธรรมลักษมี</option>";
print "<option value='MD009 นภสมร ธรรมลักษมี'>นภสมร ธรรมลักษมี</option>";
print "<option value='MD010 สุธี รัตนาธรรมวัฒน์'>สุธี รัตนาธรรมวัฒน์</option>";
print "<option value='MD011 อนุพงษ์ รอดสาย'>อนุพงษ์ รอดสาย</option>";
print "<option value='MD012 บุญชัย บุญวัฒน์'>บุญชัย บุญวัฒน์</option>";
print "<option value='MD013 ธนบดินทร์ ผลศรีนาค'>ธนบดินทร์ ผลศรีนาค</option>";
print "<option value='MD014 สมัชชา เบี้ยจรัส'>สมัชชา เบี้ยจรัส</option>";
print "<option value='MD015 ศุภชัย คูสุวรรณ'>ศุภชัย คูสุวรรณ</option>";
print "<option value='MD016 อัศวิน แก้วเนตร'>อัศวิน แก้วเนตร</option>";
print "<option value='MD017 สิทธิชัย จิตสมจินต์'>สิทธิชัย จิตสมจินต์</option>";
print "<option value='MD018 สุรัตร เปานิล'>สุรัตร เปานิล</option>";
print "<option value='MD019 เสริมบัติ ร่มเย็น'>เสริมบัติ ร่มเย็น</option>";
print "<option value='MD020 หนึ่งฤทัย มหายศนันท์'>หนึ่งฤทัย มหายศนันท์</option>";
print "<option value='MD021 นิวัฒน์ บุญยืน'>นิวัฒน์ บุญยืน</option>";
print "<option value='MD023 พันศักดิ์ โสภารัตน์'>พันศักดิ์ โสภารัตน์</option>";
print "<option value='MD024 ประทีป เหลือแก้ว'>ประทีป เหลือแก้ว</option>";
print "<option value='MD025 สุพรรษา งามวิทย์วิโรจน์'>สุพรรษา งามวิทย์วิโรจน์</option>";
print "<option value='MD026 อชพร เพชรดี'>อชพร เพชรดี</option>";
print "<option value='MD027 เมธา เที่ยงคำ'>เมธา เที่ยงคำ</option>";
print "<option value='MD028 อภิรดี เที่ยงคำ'>อภิรดี เที่ยงคำ</option>";
print "<option value='MD029 เสรี เสน่ห์ลักษณา'>เสรี เสน่ห์ลักษณา</option>";
print "</select></font>";

print "<p><input type='text' name='diag' size='30' value='$cDiag'></p>";

print " <select  name='okopd'>";
print " <OPTION value='$cOkopd'>";
print " <option value='$cOkopd' selected>$cOkopd</option>";
//print " <option value='0' ><-เลือก-></option>";
//print "<option value='N'>N</option>";
print "<option value='Y'>Y</option>";
print "</select></font>";

print "</tr>";
print "</table>";
print "</div>";
print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;";
print "<input type='submit' value='       &#3605;&#3585;&#3621;&#3591;       ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "<input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></p>";
print "</form>";
print "</body>";
*/


//แก้วันที่ เวลา แพทย์ ห้อง
/*
print "<form method='POST' action='appinsert.php' target='_BLANK'>";
print "  <p><font face='Angsana New'>&#3609;&#3633;&#3604;&#3617;&#3634;&#3623;&#3633;&#3609;&#3607;&#3637;&#3656;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  <input type='text' name='appdate' size='2'><select size='1' name='appmo'>";
print "    <option selected>--เดือน--</option>";
print "    <option value='มกราคม'>มกราคม</option>";
print "    <option value='กุมภาพันธ์'>กุมภาพันธ์</option>";
print "    <option value='มีนาคม'>มีนาคม</option>";
print "    <option value='เมษายน'>เมษายน</option>";
print "    <option value='พฤษภาคม'>พฤษภาคม</option>";
print "    <option value='มิถุนายน'>มิถุนายน</option>";
print "    <option value='กรกฏาคม'>กรกฏาคม</option>";
print "    <option value='สิงหาคม'>สิงหาคม</option>";
print "    <option value='กันยายน'>กันยายน</option>";
print "    <option value='ตุลาคม'>ตุลาคม</option>";
print "    <option value='พฤศจิกายน'>พฤศจิกายน</option>";
print "    <option value='ธันวาคม'>ธันวาคม</option>";
print "  </select><select size='1' name='thiyr'>";
print "    <option selected>2547</option>";
print "    <option>2548</option>";
print "    <option>2549</option>";
print "    <option>2550</option>";
print "    <option>2551</option>";
print "    <option>2552</option>";
print "    <option>2553</option>";
print "  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "  &#3648;&#3623;&#3621;&#3634;&nbsp; <select size='1' name='apptime'>";
print "    <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>";
print "    <option>07:00 &#3609;.</option>";
print "    <option>07:30 &#3609;.</option>";
print "    <option>08:00 &#3609;.</option>";
print "    <option>08:30 &#3609;.</option>";
print "    <option>09:00 &#3609;.</option>";
print "    <option>09:30 &#3609;.</option>";
print "    <option>10:00 &#3609;.</option>";
print "    <option>10:30 &#3609;.</option>";
print "   <option>11:00 &#3609;.</option>";
print "    <option>11:30 &#3609;.</option>";
print "    <option>13:00 &#3609;.</option>";
print "    <option>13:30 &#3609;.</option>";
print "    <option>14:00 &#3609;.</option>";
print "    <option>14:30 &#3609;.</option>";
print "    <option>15:00 &#3609;.</option>";
print "    <option>15:30 &#3609;.</option>";
print "    <option>16:00 &#3609;.</option>";
print "  </select></font></p>";

print "  <p><font face='Angsana New'>&#3649;&#3614;&#3607;&#3618;&#3660;&#3612;&#3641;&#3657;&#3609;&#3633;&#3604;&nbsp;&nbsp;&nbsp;&nbsp;";
print " <select  name='doctor'>";
print " <OPTION value='$cDoctor'>";
print " <option value='$cDoctor' selected>$cDoctor</option>";
print " <option value='0' ><-เลือก-></option>";

print "<option value='MD022 (ไม่ทราบแพทย์)'>(ไม่ทราบแพทย์)</option>";
print "<option value='MD003 ขุนศึก ขาวสำลี'>ขุนศึก ขาวสำลี</option>";
print "<option value='MD006 เลือก ด่านสว่าง'>เลือก ด่านสว่าง</option>";
print "<option value='MD007 ณรงค์ ปรีดาอนันทสุข'>ณรงค์ ปรีดาอนันทสุข</option>";
print "<option value='MD008 อรรณพ ธรรมลักษมี'>อรรณพ ธรรมลักษมี</option>";
print "<option value='MD009 นภสมร ธรรมลักษมี'>นภสมร ธรรมลักษมี</option>";
print "<option value='MD010 สุธี รัตนาธรรมวัฒน์'>สุธี รัตนาธรรมวัฒน์</option>";
print "<option value='MD011 อนุพงษ์ รอดสาย'>อนุพงษ์ รอดสาย</option>";
print "<option value='MD012 บุญชัย บุญวัฒน์'>บุญชัย บุญวัฒน์</option>";
print "<option value='MD013 ธนบดินทร์ ผลศรีนาค'>ธนบดินทร์ ผลศรีนาค</option>";
print "<option value='MD014 สมัชชา เบี้ยจรัส'>สมัชชา เบี้ยจรัส</option>";
print "<option value='MD015 ศุภชัย คูสุวรรณ'>ศุภชัย คูสุวรรณ</option>";
print "<option value='MD016 อัศวิน แก้วเนตร'>อัศวิน แก้วเนตร</option>";
print "<option value='MD017 สิทธิชัย จิตสมจินต์'>สิทธิชัย จิตสมจินต์</option>";
print "<option value='MD018 สุรัตร เปานิล'>สุรัตร เปานิล</option>";
print "<option value='MD019 เสริมบัติ ร่มเย็น'>เสริมบัติ ร่มเย็น</option>";
print "<option value='MD020 หนึ่งฤทัย มหายศนันท์'>หนึ่งฤทัย มหายศนันท์</option>";
print "<option value='MD021 นิวัฒน์ บุญยืน'>นิวัฒน์ บุญยืน</option>";
print "<option value='MD023 พันศักดิ์ โสภารัตน์'>พันศักดิ์ โสภารัตน์</option>";
print "<option value='MD024 ประทีป เหลือแก้ว'>ประทีป เหลือแก้ว</option>";
print "<option value='MD025 สุพรรษา งามวิทย์วิโรจน์'>สุพรรษา งามวิทย์วิโรจน์</option>";
print "<option value='MD026 อชพร เพชรดี'>อชพร เพชรดี</option>";
print "<option value='MD027 เมธา เที่ยงคำ'>เมธา เที่ยงคำ</option>";
print "<option value='MD028 อภิรดี เที่ยงคำ'>อภิรดี เที่ยงคำ</option>";
print "<option value='MD029 เสรี เสน่ห์ลักษณา'>เสรี เสน่ห์ลักษณา</option>";
print "<option value='MD030 เกื้อกูล สะสมทรัพย์'>เกื้อกูล สะสมทรัพย์</option>";
print "</select></font>";

print "    <font face='Angsana New'>";
print "    &nbsp;&nbsp;&nbsp;&nbsp; &#3609;&#3633;&#3604;&#3617;&#3634;&#3607;&#3637;&#3656;&nbsp;<select size='1' name='room'>";
print "    <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3627;&#3657;&#3629;&#3591;&#3605;&#3619;&#3623;&#3592;&gt;</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 1</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 2</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 3</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 4</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 5</option>";
print "    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 6</option>";
print "    <option>&#3627;&#3641; &#3588;&#3629; &#3592;&#3617;&#3641;&#3585;</option>";
print "    <option>&#3585;&#3640;&#3617;&#3634;&#3619;</option>";
print "    <option>&#3624;&#3633;&#3621;&#3618;&#3585;&#3619;&#3619;&#3617;</option>";
print "    <option>&#3585;&#3619;&#3632;&#3604;&#3641;&#3585;&#3649;&#3621;&#3632;&#3586;&#3657;&#3629;</option>";
print "    <option>&#3624;&#3633;&#3621;&#3618;&#3660;&#3607;&#3634;&#3591;&#3648;&#3604;&#3636;&#3609;&#3611;&#3633;&#3626;&#3626;&#3634;&#3623;&#3632;</option>";
print "    <option>&#3626;&#3641;&#3605;&#3636;-&#3609;&#3619;&#3637;&#3648;&#3623;&#3594;</option>";
print "    <option>&#3624;&#3633;&#3621;&#3618;&#3660;&#3619;&#3632;&#3610;&#3610;&#3611;&#3619;&#3632;&#3626;&#3634;&#3607;</option>";
print "   </select></font></p>";



print "<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
print "&nbsp;&nbsp;&nbsp;";
print "<input type='submit' value='       &#3605;&#3585;&#3621;&#3591;       ' name='B1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
//print "<input type='reset' value='  &#3621;&#3610;&#3607;&#3636;&#3657;&#3591;  ' name='B2'></p>";
print "</form>";
print "</body>";
*/
?>




    