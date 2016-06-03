<?php
//    $cHn="";
$cPtname=$cYot.' '.$cName.' '.$cSurname;
$cAge=$Age;
$cptright=$ptright;
$cnote=$note;
$cidguard=$idguard;
session_register("cAge");
session_register("cHn");  
session_register("cPtname");
session_register("cptright");
session_register("cnote");
session_register("cidguard");

    include("connect.inc");   

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

//$dbirth="$y-$m-$d"; เก็บวันเกิดใน opcard= "$y-$m-$d" ซึ่ง=$birth in function
$cAge=calcage($cAge);
// print "<p><b><font face='Angsana New'>โรงพยาบาลค่ายสุรศักดิ์มนตรี</font></b></p>";
   print "<p><font face='Angsana New'>ชื่อ $cPtname  HN: $cHn อายุ $cAge &nbsp;<B>สิทธิ:$cptright:$idguard</font></B></p>";
?>
<form method="POST" action="appinsert.php" target="_BLANK">
  <p><font face="Angsana New">&#3609;&#3633;&#3604;&#3617;&#3634;&#3623;&#3633;&#3609;&#3607;&#3637;&#3656;&nbsp;&nbsp;&nbsp;&nbsp;
  <select size="1" name="appdate">
    <option selected>--วันที่--</option>
    <option value="01">01</option>
	  <option value="02">02</option>
	    <option value="03">03</option>
		  <option value="04">04</option>
		    <option value="05">05</option>
		  <option value="06">06</option>
		    <option value="07">07</option>
	  <option value="08">08</option>
	    <option value="09">09</option>
		  <option value="10">10</option>
		    <option value="11">11</option>
			  <option value="12">12</option>
	  <option value="13">13</option>
	    <option value="14">14</option>
		  <option value="15">15</option>
		    <option value="16">16</option>
			  <option value="17">17</option>
	  <option value="18">18</option>
	    <option value="19">19</option>
		  <option value="20">20</option>
		    <option value="21">21</option>
			  <option value="22">22</option>
	  <option value="23">23</option>
	    <option value="24">24</option>
		  <option value="25">25</option>
		    <option value="26">26</option>
			  <option value="27">27</option>
			    <option value="28">28</option>
	  <option value="29">29</option>
	    <option value="30">30</option>
		  <option value="31">31</option>
		   
    

  </select>  <select size="1" name="appmo">
    <option selected>--เดือน--</option>
    <option value="มกราคม">มกราคม</option>
    <option value="กุมภาพันธ์">กุมภาพันธ์</option>
    <option value="มีนาคม">มีนาคม</option>
    <option value="เมษายน">เมษายน</option>
    <option value="พฤษภาคม">พฤษภาคม</option>
    <option value="มิถุนายน">มิถุนายน</option>
    <option value="กรกฏาคม">กรกฏาคม</option>
    <option value="สิงหาคม">สิงหาคม</option>
    <option value="กันยายน">กันยายน</option>
    <option value="ตุลาคม">ตุลาคม</option>
    <option value="พฤศจิกายน">พฤศจิกายน</option>
    <option value="ธันวาคม">ธันวาคม</option>
  </select><select size="1" name="thiyr">
    <option selected>2549</option>
    <option>2550</option>
    <option>2551</option>
    <option>2552</option>
    <option>2553</option>
  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &#3648;&#3623;&#3621;&#3634;&nbsp; <select size="1" name="apptime">
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
<option>17:00 &#3609;.</option>
    <option>18:00 &#3609;.</option>
    <option>19:30 &#3609;.</option>
    <option>20:00 &#3609;.</option>
<option>21:00 &#3609;.</option>
  </select></font></p>
  <p><font face="Angsana New">&#3649;&#3614;&#3607;&#3618;&#3660;&#3612;&#3641;&#3657;&#3609;&#3633;&#3604;&nbsp;&nbsp;&nbsp;&nbsp;
  <select size="1" name="doctor">
    <option selected><เลือกแพทย์></option>
    <option>MD022 (ไม่ทราบแพทย์)</option>
    <option>MD006 เลือก ด่านสว่าง</option>
    <option>MD007 ณรงค์ ปรีดาอนันทสุข</option>
    <option>MD008 อรรณพ ธรรมลักษมี</option>
    <option>MD009 นภสมร ธรรมลักษมี</option>
    <option>MD011 อนุพงษ์ รอดสาย</option>
    <option>MD013 ธนบดินทร์ ผลศรีนาค</option>
    <option>MD014 สมัชชา เบี้ยจรัส</option>
    <option>MD015 ศุภชัย คูสุวรรณ</option>
    <option>MD016 อัศวิน แก้วเนตร</option>
    <option>MD017 สิทธิชัย จิตสมจินต์</option>
    <option>MD020 หนึ่งฤทัย มหายศนันท์</option>
     <option>MD030 เกื้อกูล ผสมทรัพย์</option>
     <option>MD036 ศุภสิทธิ์  คงมีผล</option>
    <option>MD037 ปฏิพงค์  ศรีทิภัณฑ์</option>
      <option>MD041  วรวิทย์ วงษ์มณี</option>
    <option>MD043  วีระยุทธ์ วงศ์จันทร์</option>
<option>MD044  ธิติ  สุธีรศานต์</option>
<option>MD045  เอกวิทย์ หาญกิติพงศ์ไพศาล</option>
<option>MD046  สุรวุฒิ เอื้อคณิต</option>
<option>MD047  วันชาติ นำประเสริฐชัย</option>
<option>MD048  สุรภัทร ศรีนนท์</option>
<option>MD049  ศรายุทธ กาญจนธารายนต์</option>
<option>MD050  กฤษดากร ไวทยโยธิน</option>
<option>MD051  ทองแดง  อาฒยะพันธ์</option>
<option>MD052  วุฒิไชย  อิศระ</option>

    </select></font> </p>
 
    <font face="Angsana New">
    &nbsp;&nbsp;&nbsp;&nbsp; &#3609;&#3633;&#3604;&#3617;&#3634;&#3607;&#3637;&#3656;&nbsp;<select size="1" name="room">
    <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3627;&#3657;&#3629;&#3591;&#3605;&#3619;&#3623;&#3592;&gt;</option>
    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 1</option>
    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 2</option>
    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 3</option>
    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 4</option>
    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 5</option>
    <option>&#3629;&#3634;&#3618;&#3640;&#3619;&#3585;&#3619;&#3619;&#3617; 6</option>
    <option>&#3627;&#3641; &#3588;&#3629; &#3592;&#3617;&#3641;&#3585;</option>
    <option>&#3585;&#3640;&#3617;&#3634;&#3619;</option>
    <option>&#3624;&#3633;&#3621;&#3618;&#3585;&#3619;&#3619;&#3617;</option>
    <option>&#3585;&#3619;&#3632;&#3604;&#3641;&#3585;&#3649;&#3621;&#3632;&#3586;&#3657;&#3629;</option>
    <option>&#3624;&#3633;&#3621;&#3618;&#3660;&#3607;&#3634;&#3591;&#3648;&#3604;&#3636;&#3609;&#3611;&#3633;&#3626;&#3626;&#3634;&#3623;&#3632;</option>
    <option>&#3626;&#3641;&#3605;&#3636;-&#3609;&#3619;&#3637;&#3648;&#3623;&#3594;</option>
    <option>&#3624;&#3633;&#3621;&#3618;&#3660;&#3619;&#3632;&#3610;&#3610;&#3611;&#3619;&#3632;&#3626;&#3634;&#3607;</option>
    <option>ทันตกรรม</option>
   </select></font></p>

<p><font face="Angsana New">กรุณาระบุการนัดมาเพื่อ เพื่อที่แผนกทะเบียนจะทำการค้นหา OPD Card ได้ถูกต้อง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <p><font face="Angsana New">&#3609;&#3633;&#3604;&#3617;&#3634;&#3648;&#3614;&#3639;&#3656;&#3629;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <select size="1" name="detail">
      <option value="FU01 ตรวจตามนัด">ตรวจตามนัด</option>
 <option value="FU02 ตามผลตรวจ">ตามผลตรวจ</option>
<option value="FU03 นอนโรงพยาบาล">นอนโรงพยาบาล</option>
<option value="FU04 ทันตกรรม">ทันตกรรม</option>
<option value="FU05 ผ่าตัด">ผ่าตัด</option>
<option value="FU06 สูติ">สูติ</option>
         </select>&nbsp;&nbsp;<input type="text" name="detail2" size="35"></font></p>

  <p><font face="Angsana New">&#3586;&#3657;&#3629;&#3588;&#3623;&#3619;&#3611;&#3598;&#3636;&#3610;&#3633;&#3605;&#3636;&#3585;&#3656;&#3629;&#3609;&#3614;&#3610;&#3649;&#3614;&#3607;&#3618;&#3660;&nbsp;
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
  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></p>

  <p><font face="Angsana New">&#3648;&#3629;&#3585;&#3595;&#3648;&#3619;&#3618;&#3660;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <select size="1" name="xray">
  <option selected value="NA">&#3652;&#3617;&#3656;&#3617;&#3637;&#3585;&#3634;&#3619;&#3648;&#3629;&#3585;&#3595;&#3648;&#3619;&#3618;&#3660;</option>
  <option>CXR</option>
  <option>KUB</option>
  &nbsp;
  </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &#3629;&#3639;&#3656;&#3609;&#3654;&nbsp;<input type="text" name="other" size="30">
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

