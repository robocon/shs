<?php
session_start();
$Thaidate=date("d-m-").(date("Y")+543);
$Thaitime=date("H:i");
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
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}
	return $pAge;
}
   
    include("connect.inc");

     $query = "SELECT ipcard.an,ipcard.hn,ipcard.date,ipcard.bedcode,opcard.yot,opcard.name,opcard.surname,opcard.idcard,opcard.ptright,opcard.dbirth,opcard.sex,opcard.address,opcard.tambol,opcard.ampur,opcard.changwat,opcard.phone,opcard.ptf,opcard.ptfadd,opcard.ptffone,opcard.camp FROM ipcard LEFT JOIN opcard ON ipcard.hn=opcard.hn WHERE an = '$Can'";
    $result = mysql_query($query)or die("Query failed");
    list ($an,$hn,$date,$bedcode,$yot,$name,$surname,$idcard,$ptright,$dbirth,$sex,$address,$tambol,$ampur,$changwat,$phone,$ptf,$ptfadd,$ptffone,$camp) = mysql_fetch_row ($result);


    $d=substr($dbirth,8,2);
    $m=substr($dbirth,5,2); 
    $y=substr($dbirth,0,4); 
    $birthdate="$d-$m-$y"; //print into opdcard
    $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;
if($sex=='ช'){
	$sex1='ชาย';
}else {
	$sex1='หญิง';
}

 $ddate=substr($date,8,2);
    $mdate=substr($date,5,2); 
    $ydate=substr($date,0,4); 
	$tdate=substr($date,11,5); 
 $adate="$ddate-$mdate-$ydate"; 

//print opd card ที่นี่ จาก opdcardprn.htm  by frontpage



//end opdcard

?>
<style type="text/css">

/*@font-face{
	font-family: "THSarabunNew";
	src: url("fonts/webfont/THSarabunNew.eot");
	src: url("fonts/webfont/THSarabunNew.eot#iefix"),
	url("fonts/webfont/THSarabunNew.woff") format('embedded-opentype'),
	url("fonts/THSarabunNew.ttf") format('truetype'),
	url("fonts/webfont/THSarabunNew.svg#ludger_duvernayregular") format('svg');
	font-weight: normal;
	font-style: normal;
}*/

.head{
	font-family:"TH SarabunPSK";
	font-size:20px;
	line-height: 20px;
}
.table2{
	font-family:"TH SarabunPSK";
	font-size:20px;
	line-height: 20px;
}
.table{
	font-family:"TH SarabunPSK";
	font-size:16px;
}
.length{
	font-family:"TH SarabunPSK";
	font-size:14px;
}
</style>
<body onLoad="window.print();">
<div align="center" class="head">DISCHARGE SUMMARY</div>
<div align="center" class="head">FORT SURASAKMONTRI HOSPITAL FR-MDO-001/1 , 05, 01 , ส.ค. 52</div>
<BR />
<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" style="border-collapse:collapse; border-bottom-color:#000000; border-bottom-style:none;" class="table">
  <tr>
    <td colspan="5">
    <table width="100%" border="0" align="center" class="table2">
      <tr>
        <td width="40%"  >ADMIT : &nbsp;<?=$adate;?>&nbsp;เวลา:&nbsp;<?=$tdate;?>&nbsp;&nbsp;</td>
        <td width="23%"  ><strong class="head">AN:&nbsp; <?=$an;?></strong></td>
        <td width="37%" ><strong class="head">HN:&nbsp;<?=$hn;?></strong></td>
      </tr>
      <tr>
        <td><strong class="head">ชื่อ:&nbsp;<?=$cPtname;?></strong>   อายุ:&nbsp;<?=$cAge?></td>
        <td>เพศ:<?=$sex1;?></td>
        <td> สังกัด:&nbsp;<?=$camp;?></td>
      </tr>
      <tr>
        <td>เลข ปชช.&nbsp;<?=$idcard;?></td>
        <td>ว/ด/ป.เกิด:&nbsp;<?=$birthdate;?></td>
        <td> สิทธิ:&nbsp;<?=$ptright;?></td>
      </tr>
      <tr>
        <td>บ้านเลขที่ <?=$address;?>&nbsp;ตำบล<?=$tambol;?>&nbsp;อำเภอ <?=$ampur;?>&nbsp;</td>
        <td>จังหวัด:
          <?=$changwat;?></td>
        <td>โทร:
          <?=$phone;?></td>
        </tr>
      <tr>
        <td>ผู้ที่ติดต่อได้:&nbsp;<?=$ptf;?> เกี่ยวข้องเป็น :&nbsp;<?=$ptfadd;?></td>
        <td>&nbsp;โทรศัพท์ :&nbsp;
          <?=$ptffone;?></td>
        <td>หอรับ&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หอจำหน่าย</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">Refer from</td>
    <td align="center" valign="top">Discharge Date, Time    </td>
    <td align="center" valign="top"><font class="length">LENGTH 
OF STAY <br />
( DAYS )</font></td>
    <td align="center" valign="top">CONDITION OF INFANT AT BIRTH
    <br>
      <table width="90%"  border="0" align="center" cellpadding="0" cellspacing="0" class="table">
        <tr>
          <td align="left" valign="top"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> LIVEBIRTH</td>
          <td align="left" valign="top"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> CLINICALLY MATURE</td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> STILLBRITH &nbsp;&nbsp;</td>
          <td align="left" valign="top"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> CLINICALLY PREMATURE</td>
        </tr>
      </table>
    <p></p></td>
    <td align="center" valign="top"><p>BIRTH<br />
WEIGHT</p>
    <p>GRAMS</p></td>
  </tr>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" style="border-collapse:collapse; border-top-color:#FFF; border-bottom-style:none;" class="table">
  <tr>
    <td width="26%">Diagnosis</td>
    <td width="10%" align="center">ICD</td>
    <td width="13%" align="center">Physician</td>
    <td width="30%" align="center">Rx/Procedure/Operation</td>
    <td width="12%" align="center">ICD 9 CM</td>
    <td width="9%" align="center">Date</td>
  </tr>
  <tr>
    <td valign="top">Principle Dx<br />
      <br>
    <br /></td>
    <td align="center">&nbsp;</td>
    <td align="center"><br />
      <br />
    <br /></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Comorbidity<br />
    <br />
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br /></td>
    <td align="center">&nbsp;</td>
    <td align="center"><br />
    <br /></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Complication<br />
    <br />
    <br />
    <br />
    <br /></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Other<br />
    <br />
    <br />
    <br />
    <br /></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">External Cause of injuries<br />
    <br />
    <br />
    <br />
    <br /></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
      <tr>
        <td width="14%"  align="center">PROCECURE</td>
        <td width="16%" align="left">( &nbsp;) Tracheostomy</td>
        <td width="20%" align="left">(&nbsp; ) Respirator support</td>
        <td width="8%" align="left">(&nbsp; ) CPR</td>
        <td width="18%" align="left">(&nbsp; ) ICU/CCU.....Days</td>
        <td width="24%" align="left">(&nbsp; ) Traction (skin,kull,skeletal)</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="left">(&nbsp; ) Cut down</td>
        <td align="left">( &nbsp;) Rehabilitation / PT </td>
        <td align="left">(&nbsp; ) LP</td>
        <td align="left">(&nbsp; ) Intercostal drainage </td>
        <td align="left">(&nbsp; ) Other.....................................</td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="1" cellspacing="0" cellpadding="0" bordercolor="#000000" style="border-collapse:collapse; border-top-color:#FFF; border-bottom-style:none;" class="table">
<tr>
<td width="50%"  align="center" valign="middle">DISCHARGE STATUS</td>
<td width="40%"  align="center" valign="middle">TYPE OF DISCHARGE</td>
<td width="10%" rowspan="2" align="left" valign="top">GA....................................................Wks<br />
  Gravidity................................................<br />
  Parity...................................................... <br />  
  Living Child...........................................<br /></td>
</tr>
<tr>
  <td align="center">
    <table width="96%" border="0" cellspacing="0" cellpadding="0" class="table">
    <tr>
      <td width="29%" align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Complete</td>
      <td width="37%" align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Normal delivery</td>
      <td width="34%" align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Normal infant</td>
      </tr>
    <tr>
      <td align="left" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp; Recovery</td>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Undelivery</td>
      <td align="left" valign="middle"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D/C separately</td>
      </tr>
    <tr>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/>Improved</td>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Normal infant</td>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> stillbirth</td>
      </tr>
    <tr>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Not improved</td>
      <td align="left" valign="middle"> D/C with mother</td>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Dead</td>
      </tr>
  </table></td>
  <td align="center"><table width="95%" border="0" cellspacing="0" cellpadding="0" class="table">
    <tr>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> With Approval</td>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Other</td>
      </tr>
    <tr>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Against Advice</td>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Dead Autopsy</td>
      </tr>
    <tr>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> By Escape</td>
      <td align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Dead No autopsy</td>
      </tr>
    <tr>
      <td colspan="2" align="left" valign="middle"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> By transfer to.............................................</td>
      </tr>
  </table></td>
  </tr>
<tr>
  <td align="center">
    Attending Physician<br />
    ...........................................<br>
    (                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) <br />
    Signature
  </td>
  <td colspan="2" align="center"> 
    Approved  By
<br />
...........................................<br>
(                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;) <br />
Signature </td>
  </tr>
</table>
</body>
