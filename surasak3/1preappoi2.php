<?php
//    $cHn="";
    session_start();

  
$cappdate=$appdate;
  $cappmo=$appmo;
  $cthiyr=$thiyr;
  $cdoctor=$doctor;

  session_register("cappdate");
 session_register("cappmo");
 session_register("cthiyr");
 session_register("cdoctor");
    include("connect.inc");   
//$dbirth="$y-$m-$d"; เก็บวันเกิดใน opcard= "$y-$m-$d" ซึ่ง=$birth in function
// print "<p><b><font face='Angsana New' size = '3'>โรงพยาบาลค่ายสุรศักดิ์มนตรี</font></b></p>";
   print "<p><font face='Angsana New' size = '4'>ชื่อ $cPtname  HN: $cHn อายุ $cAge &nbsp;<B>สิทธิ:$cptright:$idguard</font></B><br>";
  print "<font face='Angsana New' size = '4'>แพทย์ $cdoctor วันที่: $cappdate&nbsp;$cappmo&nbsp;$thiyr  </font></B></p>";

?>
<?php
    include("connect.inc");
 $appd=$cappdate.' '.$cappmo.' '.$cthiyr;

  
    $query="CREATE TEMPORARY TABLE appoint1 SELECT * FROM appoint WHERE appdate = '$appd' and doctor = '$cdoctor' ";
    $result = mysql_query($query) or die("Query failed,app");
   $query="SELECT  apptime,COUNT(*) AS duplicate FROM appoint1 GROUP BY apptime HAVING duplicate > 0 ORDER BY apptime";
   $result = mysql_query($query);
     $n=0;
 while (list ($apptime,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
           //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New' size = '3'><b>$apptime</b>&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New' size = '4'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New' size = '3'>นัดจำนวน&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n&nbsp;");
               }
 print "<br><font face='Angsana New' size = '5'><b>จำนวนผู้ป่วยทั้งหมด&nbsp;&nbsp; $num&nbsp;&nbsp;คน</b></a> ";
   include("unconnect.inc");
?>
<form method="POST" action="1appinsert1.php">
<font face="Angsana New" size = '4'>กรุณาระบุการนัดมาเพื่อ เพื่อที่แผนกทะเบียนจะทำการค้นหา OPD Card ได้ถูกต้อง
<br>
    <font face="Angsana New">
     ยื่นใบนัดที่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select size="1" name="room">
    <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3627;&#3657;&#3629;&#3591;&#3605;&#3619;&#3623;&#3592;&gt;</option>
    <option>จุดบริการนัดที่ 1</option>
    <option>จุดบริการนัดที่ 2</option>
    <option>แผนกทะเบียน</option>
 <option>ห้องฉุกเฉิน</option>
    <option>กองทันตกรรม</option>
    <option>แผนกพยาธิวิทยา</option>
    <option>แผนกเอกชเรย์</option>
    <option>กองสูติ-นารี</option>
   </select>
  &#3648;&#3623;&#3621;&#3634;&nbsp; <select size="1" name="capptime">
    <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>
    <option>07:00 &#3609;.</option>
    <option>07:30 &#3609;.</option>
    <option>08:00 &#3609;.</option>
    <option>08:30 &#3609;.</option>
    <option>09:00 &#3609;.</option>
    <option>09:30 &#3609;.</option>
    <option>10:00 &#3609;.</option>
    <option>10:30 &#3609;.</option>
    <option>11:00 &#3609;.</option>
    <option>11:30 &#3609;.</option>
    <option>13:00 &#3609;.</option>
    <option>13:30 &#3609;.</option>
    <option>14:00 &#3609;.</option>
    <option>14:30 &#3609;.</option>
    <option>15:00 &#3609;.</option>
    <option>15:30 &#3609;.</option>
    <option>16:00 &#3609;.</option>
  <option>16:30 &#3609;.</option>
<option>17:00 &#3609;.</option>
<option>17:30 &#3609;.</option>
    <option>18:00 &#3609;.</option>
<option>18:30 &#3609;.</option>
<option>19:00 &#3609;.</option>
    <option>19:30 &#3609;.</option>
    <option>20:00 &#3609;.</option>
<option>21:00 &#3609;.</option>
  </select></font> 

<br>

<font face="Angsana New">&#3609;&#3633;&#3604;&#3617;&#3634;&#3648;&#3614;&#3639;&#3656;&#3629;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <select size="1" name="detail">
 <option value="FU01 ตรวจตามนัด">ตรวจตามนัด</option>
 <option value="FU02 ตามผลตรวจ">ตามผลตรวจ</option>

<option value="FU03 นอนโรงพยาบาล">นอนโรงพยาบาล</option>

<option value="FU04 ทันตกรรม">ทันตกรรม</option>

<option value="FU05 ผ่าตัด">ผ่าตัด</option>

<option value="FU06 สูติ">สูติ</option>
<option value="FU07 คลีนิกฝังเข็ม">คลีนิกฝังเข็ม</option>
<option value="FU08 Echo">Echo</option>
<option value="FU09 มวลกระดูก">มวลกระดูก</option>
         </select>&nbsp;&nbsp;<input type="text" name="detail2" size="35"></font><br>

  <font face="Angsana New">&#3586;&#3657;&#3629;&#3588;&#3623;&#3619;&#3611;&#3598;&#3636;&#3610;&#3633;&#3605;&#3636;&#3585;&#3656;&#3629;&#3609;&#3614;&#3610;&#3649;&#3614;&#3607;&#3618;&#3660;&nbsp;
  <select size="1" name="advice">
    <option selected value="NA">&lt;&#3650;&#3611;&#3619;&#3604;&#3648;&#3621;&#3639;&#3629;&#3585;&#3619;&#3634;&#3618;&#3585;&#3634;&#3619;&gt;</option>
    <option value="NA">&#3652;&#3617;&#3656;&#3617;&#3637;</option>
    <option>&#3652;&#3617;&#3656;&#3605;&#3657;&#3629;&#3591;&#3591;&#3604;&#3609;&#3657;&#3635;&#3627;&#3619;&#3639;&#3629;&#3629;&#3634;&#3627;&#3634;&#3619;</option>
    <option>&#3591;&#3604;&#3609;&#3657;&#3635;&#3649;&#3621;&#3632;&#3629;&#3634;&#3627;&#3634;&#3619;&#3627;&#3621;&#3633;&#3591;&#3648;&#3623;&#3621;&#3634;
    20:00 &#3609;.</option>
    <option>&#3591;&#3604;&#3609;&#3657;&#3635;&#3649;&#3621;&#3632;&#3629;&#3634;&#3627;&#3634;&#3619;&#3627;&#3621;&#3633;&#3591;&#3648;&#3623;&#3621;&#3634;
    24:00 &#3609;.</option>
  </select></font></p>

  <p><font face="Angsana New">&#3648;&#3592;&#3634;&#3632;&#3648;&#3621;&#3639;&#3629;&#3604;&nbsp;&nbsp;&nbsp;&nbsp;
  <select size="1" name="patho">
  <option selected value="NA">&#3652;&#3617;&#3656;&#3617;&#3637;</option>
  <option>CBC</option>
  <option>UA</option>
  <option>CBC, UA</option>
  <option>BS</option>
    <option>CBC ,BS, CHOL, TG</option>
  <option>BS, CHOL, TG</option>
 <option>BUN,CR</option>
  <option>CHOL, TG</option>
  <option>CBC, CD4, LFT</option>
  <option>CBC,UA,BS,BUN,CR,LFT,CHOL,TG,URIC</option>
  <option>URIC ACID</option>
  <option>Anti HIV</option>

 <option>CBC,CD4</option>

 <option>BS,CHOL,TG,HDL,LDL</option>
 
<option>CHOL,TG,HDL,LDL</option>

 <option>BS,HbA1C</option>
 
<option>FT3,FT4,TSH</option>

<option>FBs,Bun,Cr</option>
<option>FBs,HbA1C,Chol,Tg</option>
<option>FBs,HbA1C,Chol,Tg,UA</option>
<option>Bun,Cr,E-lyte,Hct</option>
<option>FBs,HbA1C,Bun,Cr,Chol,Tg</option>
<option>FBs,Chol,Tg,Bun,Cr,Ua</option>
<option>FBs,HbA1C,Chol,Tg,Bun,Cr,Ua</option>

  &nbsp;
  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><br>

<font face="Angsana New">&#3648;&#3629;&#3585;&#3595;&#3648;&#3619;&#3618;&#3660;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select size="1" name="xray">
  <option selected value="NA">&#3652;&#3617;&#3656;&#3617;&#3637;&#3585;&#3634;&#3619;&#3648;&#3629;&#3585;&#3595;&#3648;&#3619;&#3618;&#3660;</option>
  <option>CXR</option>
  <option>KUB</option>
  &nbsp;
  </select><br>&#3629;&#3639;&#3656;&#3609;&#3654;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="other" size="30">
  &nbsp;</font></p>

  <font face="Angsana New">

    <p><font face="Angsana New">&#3649;&#3612;&#3609;&#3585;&#3607;&#3637;&#3656;&#3609;&#3633;&#3604;&nbsp;&nbsp;&nbsp;<select size="1" name="depcode">
    <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3649;&#3612;&#3609;&#3585;&#3607;&#3637;&#3656;&#3609;&#3633;&#3604;&gt;</option>
    <option>U09&nbsp;
    ห้องตรวจโรค</option>
    <option>U01&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3594;&#3634;&#3618;</option>
    <option>U02&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3597;&#3636;&#3591;</option>
    <option>U03&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3626;&#3641;&#3605;&#3636;&#3609;&#3619;&#3637;</option>
    <option>U19&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3614;&#3636;&#3648;&#3624;&#3625;3</option>
    <option>U04&nbsp;
    &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3609;&#3633;&#3585;ICU</option>
    <option>U05&nbsp;
    &#3627;&#3657;&#3629;&#3591;&#3612;&#3656;&#3634;&#3605;&#3633;&#3604;</option>
    <option>U06&nbsp; &#3623;&#3636;&#3626;&#3633;&#3597;&#3597;&#3637;</option>
    <option>U12&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3652;&#3605;&#3648;&#3607;&#3637;&#3618;&#3617;</option>
    <option>U10&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3614;&#3618;&#3634;&#3608;&#3636;</option>
    <option>U11&nbsp;
    &#3649;&#3612;&#3609;&#3585;&#3648;&#3629;&#3585;&#3595;&#3660;&#3648;&#3619;&#3618;&#3660;</option>
    <option>U13&nbsp;
    &#3585;&#3629;&#3591;&#3607;&#3633;&#3609;&#3605;&#3585;&#3619;&#3619;&#3617;</option>
    <option>U16&nbsp;
    &#3627;&#3657;&#3629;&#3591;&#3593;&#3640;&#3585;&#3648;&#3593;&#3636;&#3609;</option>
    <option>U19&nbsp; กองตรวจโรคผู้ป่วยสูติ</option>
  </select>&nbsp;&nbsp;&nbsp;</font>&nbsp;&nbsp;&nbsp;&nbsp;</font>

     
  &nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;     " name="B1">
  &nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a></p>
  </form>
&nbsp&nbsp;<<&nbsp<a target=_self  href='hnappoi1.php'>ออกใบนัดใหม่</a>
