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

    if ($_GET['Can']) {
        $Can = $_GET['Can'];
        $an = $Can;

    }elseif ($_GET['an']) {
        $an = $_GET['an'];
        $Can = $an;
    }
    


    $query = "SELECT ipcard.an,ipcard.hn,ipcard.date,ipcard.bedcode,opcard.yot,opcard.name,opcard.surname,opcard.idcard,opcard.ptright,opcard.dbirth,opcard.sex,opcard.address,opcard.tambol,opcard.ampur,opcard.changwat,opcard.phone,opcard.ptf,opcard.ptfadd,opcard.ptffone,opcard.camp 
    FROM ipcard 
    LEFT JOIN opcard ON ipcard.hn=opcard.hn WHERE an = '$Can'";
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
*{
    font-family:"TH Sarabun New", "TH SarabunPSK";
    font-size:11pt;
}
/* ทดสอบความสูง td ตามฟอนต์ */
.tb_normal_line td{
    line-height: 11pt;
}
.tb_info td{
    font-size: 14pt;
    line-height: 14pt;
}
.head, 
.bottom_sign td{
    font-size: 16pt;
    line-height: 16pt;
}

table.dctb{
    border-collapse: collapse;
}
table.dctb th,
table.dctb td{
    border: 1px solid black;
    vertical-align: top;
}

.tb_hide_top td{
    border-top: 0;
}

.dbtb_bottom{
    border-bottom: 1px solid black;
}
.dbtb_bottom_hide{
    border-bottom: 0px!important;
}
.dctb_close th,
.dctb_close td{
    border: 0px!important;
}
</style>
<body onLoad="window.print();">

<div align="right" class="head">MR  IPD - 002 (3)</div>
<div align="center" class="head">DISCHARGE SUMMARY</div>
<div align="center" class="head">FORT SURASAKMONTRI HOSPITAL เริ่มใช้  วันที่  4 มี.ค. 62</div>
<BR />
<table width="100%" class="tb_info" style="border-collapse: collapse; border: 1px solid black; border-bottom: none;">
    <tr>
        <td class="dbtb_bottom">ADMIT: <?=$adate;?></td>
        <td class="dbtb_bottom">เวลา: <?=$tdate;?>น.</td>
        <td class="dbtb_bottom">AN:  <?=$an;?></td>
        <td class="dbtb_bottom">HN: <?=$hn;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom">ชื่อ: <?=$cPtname;?></td>
        <td class="dbtb_bottom">อายุ: <?=$cAge?></td>
        <td class="dbtb_bottom">เพศ:<?=$sex1;?></td>
        <td class="dbtb_bottom">สังกัด: <?=$camp;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom">เลข ปชช. <?=$idcard;?></td>
        <td class="dbtb_bottom"></td>
        <td class="dbtb_bottom">ว/ด/ป.เกิด: <?=$birthdate;?></td>
        <td class="dbtb_bottom">สิทธิ: <?=$ptright;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom">บ้านเลขที่ <?=$address;?> ตำบล<?=$tambol;?> อำเภอ <?=$ampur;?></td>
        <td class="dbtb_bottom"></td>
        <td class="dbtb_bottom">จังหวัด: <?=$changwat;?></td>
        <td class="dbtb_bottom">โทร: <?=$phone;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom_hide">ผู้ที่ติดต่อได้: <?=$ptf;?></td>
        <td class="dbtb_bottom_hide">เกี่ยวข้องเป็น: <?=$ptfadd;?></td>
        <td class="dbtb_bottom_hide">โทรศัพท์: <?=$ptffone;?></td>
        <td class="dbtb_bottom_hide">หอรับ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หอจำหน่าย</td>
    </tr>
</table>
<table width="100%" class="dctb">
  <tr>
    <td class="dbtb_bottom_hide" valign="top" width="10%">Refer from</td>
    <td class="dbtb_bottom_hide" align="center" valign="top" width="15%">Discharge Date, Time</td>
    <td class="dbtb_bottom_hide" align="center" valign="top" width="15%">
        <div>LENGTH OF STAY ( DAYS )</div>
        <div>&nbsp;</div>
        <div>TOTAL LEAVE DAYS</div>
        <div>&nbsp;</div>
    </td>
    <td class="dbtb_bottom_hide" align="center" valign="bottom" style="vertical-align: bottom;">
        <table width="100%" class="dctb_close tb_normal_line">
            <tr>
                <td colspan="2" style="text-align: center;">CONDITION OF INFANT AT BIRTH</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
                <td align="left" valign="top" width="50%"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> LIVEBIRTH</td>
                <td align="left" valign="top" width="50%"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> CLINICALLY MATURE</td>
            </tr>
            <tr>
                <td align="left" valign="top"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> STILLBRITH &nbsp;&nbsp;</td>
                <td align="left" valign="top"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> CLINICALLY PREMATURE</td>
            </tr>
        </table>
    </td>
    <td class="dbtb_bottom_hide" align="center" valign="top" width="15%">
        <div>BIRTH WEIGHT<br><br></div>
        <div>GRAMS</div>
    </td>
  </tr>
</table>

<table width="100%" class="dctb" valign="top">
    <tr class="tb_hide_top">
        <td rowspan="7" class="dbtb_bottom_hide" width="10%">DIAGNOSIS</td>
        <td>
            1 PRINCIPAL DIAGNOSIS<br>
            <table class="dctb_close" width="100%">
                <tr>
                    <td>Cataract</td>
                    <td>
                        <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Right eye
                    </td>
                    <td>
                        <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Left eye
                    </td>
                </tr>
            </table>
        </td>
        <td>DIAGNOSIS   ICD  CODING<br>By CODER..<br>&nbsp;</td>
    </tr>
    <tr>
        <td rowspan="2">
            2 COMORBIDITY<br>
            <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/>Hypertension<br>
            <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/>Diabetes mellitus<br>
            <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/>Dyslipidemia
        </td>
        <td>MAINCONDITION</td>
    </tr>
    <tr>
        <td>COMORBIDITY (S)</td>
    </tr>
    <tr>
        <td rowspan="2">3 COMPLICATION</td>
        <td>COMPLICATION (S)<br>&nbsp;</td>
    </tr>
    <tr>
        <td>OTHER (S)<br>&nbsp;</td>
    </tr>
    <tr>
        <td>4 OTHER DIAGNOSIS</td>
        <td>EXTERNAL CAUSE (S)<br>&nbsp;<br>&nbsp;</td>
    </tr>
    <tr>
        <td class="dbtb_bottom_hide">5 EXTERNAL CAUSE OF INJURY</td>
        <td class="dbtb_bottom_hide">PROCEDURES ICD CODEING<br>By CODER....</td>
    </tr>
</table>

<table width="100%" class="dctb" valign="top">
    <tr>
        <td rowspan="4" class="dbtb_bottom_hide" width="10%">OPERATION</td>
        <td>OPERATING  ROOM  PROCEDURE</td>
        <td style="border-left: 0;">DATE</td>
        <td>TIME STARED</td>
        <td>TIME  END</td>
        <td rowspan="2">MAIN</td>
    </tr>
    <tr>
        <td colspan="4">
            <table class="dctb_close" width="55%">
                <tr>
                    <td width="50%">
                        <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Phacoemulsification
                    </td>
                    <td width="25%">
                        <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Right eye
                    </td>
                    <td width="25%">
                        <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Left eye
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="font-size: 10pt;">
                        <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Extracapsular cataract extraction/Manual small incision cataract surgery
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="4" class="dbtb_bottom_hide">
            Intraocular Lens Implantation
            <table width="50%" class="dctb_close">
                <tr>
                    <td>
                        <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Right eye
                    </td>
                    <td>
                        <img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> Left eye
                    </td>
                </tr>
            </table>
        </td>
        <td rowspan="3" class="dbtb_bottom_hide">OTHER (S)</td>
    </tr>
</table>

<table width="100%" class="dctb tb_normal_line" valign="top">
    <tr>
        <td style="position: relative;" class="dbtb_bottom_hide">NON or<br>PROCEDURE<span style="position: absolute; top: 2px; right: 2px;">DATE</span></td>
        <td style="position: relative;" class="dbtb_bottom_hide">&nbsp;<span style="position: absolute; top: 2px; right: 2px;">DATE</span></td>
        <td style="position: relative;" class="dbtb_bottom_hide">&nbsp;<span style="position: absolute; top: 2px; right: 2px;">DATE</span></td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/> Arthrocentesis(8191)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/> Gastric lavage Irrigation(9633)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/> EGD(4513)..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Paracenthesis (5491)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Insertion of endotracheal tube(9604)</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Vetilation &lt;96(5671)..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Thoracocenthesis (3491)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Lumbar puncture (L.P.X0331)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Vetilation&gt;96(9672) ..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Central venous catheterization(3893)</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Physical therapy(9339)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Transfution(9904)..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>CT scan..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Normal delivery(7359)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Other..</td>
    </tr>
    <tr>
        <td class="dbtb_bottom_hide"><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Diagnosis ultrasound    ( specify )</td>
        <td class="dbtb_bottom_hide"></td>
        <td class="dbtb_bottom_hide"><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Other..</td>
    </tr>
</table>

<table width="100%" class="dctb tb_normal_line" valign="top">
    <tr>
        <td width="50%">DISCHARGE STATUS</td>
        <td width="50%">DISCHARGE TYPE</td>
    </tr>
    <tr>
        <td>
            <table class="dctb_close" width="100%">
                <tr>
                    <td>1&nbsp;&nbsp;COMPLETE RECOVERY</td>
                    <td>6&nbsp;&nbsp;NORMAL CHILD DICHARGE WITH MOTHER</td>
                </tr>
                <tr>
                    <td>2&nbsp;&nbsp;IMPROVED</td>
                    <td>7&nbsp;&nbsp;NORMAL CHILD DICHARGE SEPARETERY</td>
                </tr>
                <tr>
                    <td>3&nbsp;&nbsp;NOT IMPROVED</td>
                    <td>8&nbsp;&nbsp;STILLEIRTH</td>
                </tr>
                <tr>
                    <td>4&nbsp;&nbsp;DELIVERED</td>
                    <td>9&nbsp;&nbsp;DEAD</td>
                </tr>
                <tr>
                    <td>5&nbsp;&nbsp;UNDELIVERED</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </td>
        <td>
            <table class="dctb_close" width="100%">
                <tr>
                    <td width="50%">1&nbsp;&nbsp;WITH APPROVAL</td>
                    <td width="50%">5&nbsp;&nbsp;OTHER</td>
                </tr>
                <tr>
                    <td>2&nbsp;&nbsp;AGAINST ADVICE</td>
                    <td>6&nbsp;&nbsp;DEAD AUTOPSY</td>
                </tr>
                <tr>
                    <td>3&nbsp;&nbsp;ESCAPE</td>
                    <td>7&nbsp;&nbsp;DEAD NO AUTOPSY</td>
                </tr>
                <tr>
                    <td>4&nbsp;&nbsp;BY TRANSFER</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">ชื่อสถานพยาบาลที่ส่งต่อ .........................................................</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="dbtb_bottom_hide"><b>CAUSE  OF  DEATH</b></td>
    </tr>
</table>

<table width="100%" class="dctb bottom_sign" valign="top">
    <tr>
        <td>MEDLICENSE<br></td>
        <td>ATTENDING<br>PHYSICIAN </td>
        <td>APPROVED<br>BY </td>
    </tr>
</table>

</body>