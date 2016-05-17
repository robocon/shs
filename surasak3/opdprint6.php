<style>
.font1{
	font-family:"Angsana New";
	font-size:13pt;
}
#tdindent{
text-indent:0cm;
}
#tdindent2{
text-indent:10cm;
}
</style>
<br />
<body onLoad="print();">
<?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543);
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
//
    include("connect.inc");

    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
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
	$regisdate=$row->regisdate;
	$idcard =$row->idcard;
	$vHN =$row->hn;
	$yot=$row->yot;
	$name=$row->name;
	$surname =$row->surname;
    $ptname=$yot.' '.$name.'  '.$surname;
	$goup =$row->goup;
	$married =$row->married;
//	$cbirth (วันเกิดข้อความเก็บไว้ดู)
	$cbirth =$row->cbirth; // (วันเกิดข้อความเก็บไว้ดู)
	$dbirth =$row->dbirth;
	$guardian=$row->guardian;
	$idguard=$row->idguard;
	$nation =$row->nation;
	$religion =$row->religion;
	$career =$row->career;
	$ptright =$row->ptright;
	$address =$row->address;
	$tambol =$row->tambol;
	$ampur =$row->ampur;
	$changwat =$row->changwat;
	$phone =$row->phone;
	$father =$row->father;
	$mother =$row->mother;
	$couple =$row->couple;
	$note=$row->note;
	$sex =$row->sex;
	$camp =$row->camp;
	$race=$row->race;
$ptf=$row->ptf;
$ptfadd=$row->ptfadd;
$ptffone=$row->ptffone;
$ptfmon=$row->ptfmon;
//  2494-05-28
    $d=substr($dbirth,8,2);
    $m=substr($dbirth,5,2); 
    $y=substr($dbirth,0,4); 
    $birthdate="$d-$m-$y"; //print into opdcard
    $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;
  
                  }  
   else {
      echo "ไม่พบ HN : $cHn ";
           }   

if($sex =='ช'){$sex1="ชาย";} else {$sex1="หญิง";};
include("unconnect.inc");
?>
<table width="100%" border="0" align="center" class="font1" cellpadding="1" cellspacing="1">
      <tr>
        <td width="16%" id="tdindent"><img src="images/sso.png" alt="" width="100" height="100" /></td>
        <td colspan="2" valign="bottom" style="text-indent:3cm;"><span style="font-size:16pt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><u>หนังสือรับรองของแพทย์ผู้รักษา</u></strong></span></td>
        <td width="27%" align="right" valign="top">กท.16/1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">ข้าพเจ้า.................................................................................................... <!--
          <?// for($i=1;$i<=90;$i++){ echo "&nbsp;"; } ?>
          -->เลขที่ใบอนุญาตประกอบวิชาชีพเวชกรรม<!--
            <?// for($i=1;$i<=45;$i++){ echo "&nbsp;"; } ?>
          -->........................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">สถานที่ตรวจรักษา<!-- &nbsp;&nbsp;&nbsp;&nbsp;-->
        &nbsp;&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง &nbsp;&nbsp;&nbsp;โทรศัพท์ <!---->054-839305 <!---->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โทรสาร <!---->054-839310<!----></td>
      </tr>
      <tr>
        <td colspan="4"></td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">ได้ตรวจรักษาแล้วขอรับรอง ดังนี้</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent"><span style="font-size:16pt; font-weight:bold;" >1. ผู้ป่วยชื่อ 
          <?=$ptname;?>
          &nbsp;&nbsp; เพศ 
            <?=$sex1;?>
             &nbsp;&nbsp;อายุ &nbsp;&nbsp;
              <?=$cAge;?></span>
            </td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent"><span style="font-size:16pt;" >&nbsp;&nbsp;&nbsp;&nbsp;HN 
          <?=$vHN;?>
           &nbsp;&nbsp;AN
            <? for($i=1;$i<=20;$i++){ echo "&nbsp;"; } ?></span>
          </td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent"><span style="font-size:16pt;" >2. เข้ารับการรักษาครั้งแรกวันที่  <?=date("d-m-").(date("Y")+543);?>&nbsp;&nbsp;เวลา....................... 
          น.</td></span>
      </tr>
      <tr>
        <td colspan="4" id="tdindent"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/image001.gif" width="13" height="13" />&nbsp;&nbsp;เจ็บป่วยจากการทำงาน <img src="images/image001.gif" width="13" height="13" />&nbsp;กรณีประสบอันตรายจากการทำงาน</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent"> 3.สาเหตุของการเจ็บป่วย /ประสบอันตราย ........................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">4.ประวัติการเจ็บป่วยและอาการที่สำคัญ ............................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;(Pertinent Physical Exam)
          ..............................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">5.ผลการตรวจพิเศษ  ............................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;(Investigation).................................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">6.การวินิจฉัยโรค (ให้ระบุชื่อโรค โดยใช้หลักตาม ICD10) &nbsp;1.<span style="text-indent:7.2cm;">..........................................................................................................................................................</span></td>
      </tr>
      <tr>
        <td colspan="4" style="text-indent:7.2cm;">2...........................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" style="text-indent:7.2cm;">3...........................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;(Diagnosis) 
        .....................................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;โรคแทรก
         
        .......................................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">ถ้ามีการผ่าตัด 1..........................................................................................................................................................
           วันที่ 
            ................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2..........................................................................................................................................................
           วันที่ 
            ................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">8.การักษา(Treatment) <img src="images/image001.gif" width="13" height="13" />&nbsp; แนะนำ <img src="images/image001.gif" width="13" height="13" /> &nbsp;ยา,แนะนำ <img src="images/image001.gif" width="13" height="13" /> &nbsp;ผ่าตัด <img src="images/image001.gif" width="13" height="13" /> &nbsp;หัตถการอื่นๆ ระบุ 
          ........................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">9. ระยะเวลาหยุดพักรักษาตัว <img src="images/image001.gif" width="13" height="13" /> &nbsp;มีกำหนด
          ...................................เดือน 
            ...................................
             วัน ตั้งแต่วันที่ 
              ...............................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">วันสิ้นสุดการรักษา
          ....................................................
         <img src="images/image001.gif" width="13" height="13" />&nbsp;ยังไม่สิ้นสุดการรักษา</td>
      </tr>
      <tr>
        <td id="tdindent">10.ผลการรักษา</td>
        <td colspan="3"><img src="images/image001.gif" width="13" height="13" />&nbsp;สูญเสียสมรรถภาพอย่างถาวรของอวัยวะ </td>
      </tr>
      <tr>
        <td id="tdindent">(Result)</td>
        <td width="10%">&nbsp;</td>
        <td colspan="2">1. 
          ............................................................................................
          ร้อยละ 
          ......................................................................</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">2. 
          ............................................................................................
          ร้อยละ 
            ......................................................................</td
  >
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">3. 
          ............................................................................................
          ร้อยละ 
            ......................................................................</td
  >
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><img src="images/image001.gif" width="13" height="13" />&nbsp;ไม่มีการสูญเสีย 
          ................................................................................................................................................................................
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3"><img src="images/image001.gif" width="13" height="13" /> เสียชีวิตจากสาเหตุ 
          ...........................................................................................................................................................................
        </td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">11.ความเห็นอื่น 
          ................................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4" id="tdindent">&nbsp;&nbsp;&nbsp;&nbsp;(Comments) 
          ..................................................................................................................................................................................................................................</td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="right" id="tdindent2">&nbsp;ลงชื่อ...................................................................แพทย์ผู้รักษา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="right" id="tdindent2">วันที่ ..................เดือน ..................................พ.ศ....................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
    </table>
</body>