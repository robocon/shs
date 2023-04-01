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
    


    $query = "SELECT ipcard.an,ipcard.hn,ipcard.date,ipcard.dcdate,ipcard.days,ipcard.bedcode,ipcard.weight,opcard.yot,opcard.name,opcard.surname,opcard.idcard,opcard.ptright,opcard.dbirth,opcard.sex,opcard.address,opcard.tambol,opcard.ampur,opcard.changwat,opcard.phone,opcard.ptf,opcard.ptfadd,opcard.ptffone,opcard.camp 
    FROM ipcard 
    LEFT JOIN opcard ON ipcard.hn=opcard.hn WHERE an = '$Can'";
    $result = mysql_query($query)or die("Query failed");
    list ($an,$hn,$date,$dcdate,$days,$bedcode,$weight,$yot,$name,$surname,$idcard,$ptright,$dbirth,$sex,$address,$tambol,$ampur,$changwat,$phone,$ptf,$ptfadd,$ptffone,$camp) = mysql_fetch_row ($result);


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

$ward=substr($bedcode,0,2);

if($dcdate=="0000-00-00 00:00:00"){
	$dischargedate="";
	

	if($ward=="42"){
		$wardin="หอผู้ป่วยรวม";
		$wardout="";
	}else if($ward=="43"){
		$wardin="หอผู้ป่วยสูตินรี";
		$wardout="";
	}else if($ward=="44"){
		$wardin="หอผู้ป่วย ICU";	
		$wardout="";
	}else if($ward=="45"){
		$wardin="หอผู้ป่วยพิเศษ";
		$wardout="";
	}else if($ward=="46"){
		$wardin="Cohort Ward";
		$wardout="";	
	}else if($ward=="47"){
		$wardin="Home Isolation";
		$wardout="";
	}else if($ward=="48"){
		$wardin="รพ.สนาม";
		$wardout="";
	}else{
		$wardin="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$wardout="";
	}		
}else{	
	$dcddate=substr($dcdate,8,2);
	$dcmdate=substr($dcdate,5,2); 
	$dcydate=substr($dcdate,0,4); 
	$dctdate=substr($dcdate,11,8); 
	$dischargedate="$dcddate-$dcmdate-$dcydate<br>$dctdate";
	
	if($ward=="42"){
		$wardin="หอผู้ป่วยรวม";
		$wardout="หอผู้ป่วยรวม";
	}else if($ward=="43"){
		$wardin="หอผู้ป่วยสูตินรี";
		$wardout="หอผู้ป่วยสูตินรี";
	}else if($ward=="44"){
		$wardin="หอผู้ป่วย ICU";	
		$wardout="หอผู้ป่วย ICU";
	}else if($ward=="45"){
		$wardin="หอผู้ป่วยพิเศษ";
		$wardout="หอผู้ป่วยพิเศษ";
	}else if($ward=="46"){
		$wardin="Cohort Ward";
		$wardout="Cohort Ward";	
	}else if($ward=="47"){
		$wardin="Home Isolation";
		$wardout="Home Isolation";
	}else if($ward=="48"){
		$wardin="รพ.สนาม";
		$wardout="รพ.สนาม";
	}else{
		$wardin="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$wardout="";
	}		
}
//end opdcard


	

$chknewborn=substr($ptright,0,3);
if($chknewborn=="R10"){
	$birthweight=$weight;
}else{
	$birthweight="<br>";
}	
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
.head{
    /* font-weight: bold; */
    font-size: 16pt;
}
.bottom_sign td{
    font-size: 12pt;
    line-height: 14pt;
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
.procedure td{
    vertical-align: middle!important;
    line-height: 16pt;
}
</style>
<!-- window.print(); -->
<body onLoad="">
<div align="center" class="head">DISCHARGE SUMMARY</div>
<div align="center" class="head" style="position:relative;">
    <div style="position:absolute;left:0;" class="head">MR  IPD - 002 (1)</div>    
    FORT SURASAKMONTRI HOSPITAL เริ่มใช้  วันที่  1 เม.ย. 66
</div>
<BR />
<table width="100%" class="tb_info" style="border-collapse: collapse; border: 1px solid black; border-bottom: none;">
    <tr>
        <td class="dbtb_bottom" width="35%"><b>ADMIT:</b> <?=$adate;?></td>
        <td class="dbtb_bottom"><b>เวลา:</b> <?=$tdate;?>น.</td>
        <td class="dbtb_bottom"><b>AN:</b>  <?=$an;?></td>
        <td class="dbtb_bottom"><b>HN:</b> <?=$hn;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom"><b>ชื่อ:</b> <?=$cPtname;?></td>
        <td class="dbtb_bottom"><b>อายุ:</b> <?=$cAge?></td>
        <td class="dbtb_bottom"><b>เพศ:</b> <?=$sex1;?></td>
        <td class="dbtb_bottom"><b>สังกัด:</b> <?=$camp;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom"><b>เลข ปชช.</b> <?=$idcard;?></td>
        <td class="dbtb_bottom"></td>
        <td class="dbtb_bottom"><b>ว/ด/ป.เกิด:</b> <?=$birthdate;?></td>
        <td class="dbtb_bottom"><b>สิทธิ:</b> <?=$ptright;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom"><b>บ้านเลขที่</b> <?=$address;?> ตำบล<?=$tambol;?> อำเภอ <?=$ampur;?></td>
        <td class="dbtb_bottom"></td>
        <td class="dbtb_bottom"><b>จังหวัด:</b> <?=$changwat;?></td>
        <td class="dbtb_bottom"><b>โทร:</b> <?=$phone;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom_hide" valign="top" colspan="4"><b>ผู้ที่ติดต่อได้:</b> <?=$ptf;?>
		<span style="margin-left: 20px;"><b>เกี่ยวข้องเป็น:</b>&nbsp;&nbsp;<?=$ptfadd;?></span>
		<span style="margin-left: 10px;"><b>โทรศัพท์:</b>&nbsp;&nbsp;<?=$ptffone;?></span>
		<span style="margin-left: 10px;"><b>หอรับ</b>&nbsp;&nbsp;<?php echo $wardin;?></span>
		<span style="margin-left: 10px;"><b>หอจำหน่าย</b>&nbsp;&nbsp;<?php echo $wardout;?></span>
        </td>
    </tr>
</table>
<table width="100%" class="dctb">
  <tr>
    <td class="dbtb_bottom_hide" valign="top" width="10%">Refer from</td>
    <td class="dbtb_bottom_hide" align="center" valign="top" width="15%">Discharge Date, Time<br>
	<?php echo $dischargedate;?></td>
    <td class="dbtb_bottom_hide" align="center" valign="top" width="20%">
        <div>LENGTH OF STAY ( DAYS )<br>
	<?php echo $days;?></div>
        <div style="margin-top:6px;">TOTAL LEAVE DAYS</div>
    </td>
    <td class="dbtb_bottom_hide" align="center" valign="bottom" style="vertical-align: bottom;">
        <table width="100%" class="dctb_close tb_normal_line" style="border:0;">
            <tr>
                <td colspan="2" style="text-align: center;">CONDITION OF INFANT AT BIRTH</td>
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
        <div>BIRTH WEIGHT<br>
		<?php echo $birthweight;?>
		</div>
        <div>GRAMS</div>
    </td>
  </tr>
</table>

<table width="100%" class="dctb" valign="top" style="">
    <tr class="tb_hide_top">
        <td rowspan="7" class="dbtb_bottom_hide" width="10%">DIAGNOSIS</td>
        <td width="65%">1 PRINCIPAL DIAGNOSIS</td>
        <td width="25%">DIAGNOSIS   ICD  CODING<br>MAIN CONDITION<br>&nbsp;</td>
    </tr>
    <tr>
        <td>2 COMORBIDITY<br><br><br><br></td>
        <td>COMORBIDITY (S)</td>
    </tr>
    <tr>
        <td>3 COMPLICATION<br><br><br><br></td>
        <td>COMPLICATION (S)<br>&nbsp;</td>
    </tr>
    <tr>
        <td>4 OTHER DIAGNOSIS<br><br><br></td>
        <td>OTHER (S)</td>
    </tr>
    <tr>
        <td class="dbtb_bottom_hide">5 EXTERNAL CAUSE OF INJURY<br><br></td>
        <td class="dbtb_bottom_hide">EXTERNAL CAUSE (S)</td>
    </tr>
</table>

<table width="100%" class="dctb" valign="top" >
    <tr>
        <td rowspan="5" class="dbtb_bottom_hide" width="10%">OPERATION</td>
        <td style="border-right:0; border-bottom: 0;">OPERATING  ROOM  PROCEDURE</td>
        <td style="border-left: 0;border-right: 0;border-bottom: 0;">DATE</td>
        <td style="border-left: 0;border-right: 0;border-bottom: 0;">TIME STARED</td>
        <td style="border-left: 0;border-right: 0;border-bottom: 0;">TIME  END</td>
        <td rowspan="2">MAIN</td>
    </tr>
    <tr>
        <td colspan="4" style="border-top: 0;">1.</td>
    </tr>
    <tr>
        <td colspan="4">2.</td>
        <td rowspan="3" class="dbtb_bottom_hide">OTHER (S)</td>
    </tr>
    <tr>
        <td colspan="4">3.</td>
    </tr>
    <tr>
        <td colspan="4" class="dbtb_bottom_hide">&nbsp;</td>
    </tr>
</table>

<table width="100%" class="dctb tb_normal_line procedure" valign="middle" >
    <tr>
        <td style="position: relative;" width="33%" class="dbtb_bottom_hide">NON OR PROCEDURE<span style="position: absolute; top: 2px; right: 2px;">DATE</span></td>
        <td style="position: relative;" width="33%" class="dbtb_bottom_hide">&nbsp;<span style="position: absolute; top: 2px; right: 2px;">DATE</span></td>
        <td style="position: relative;" class="dbtb_bottom_hide">&nbsp;<span style="position: absolute; top: 2px; right: 2px;">DATE</span></td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Arthrocentesis(8191)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Gastric lavage Irrigation(9633)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> EGD(4513)..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Paracenthesis (5491)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Insertion of endotracheal tube(9604)</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Vetilation &lt;96(5671)..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Thoracocenthesis (3491)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Lumbar puncture (L.P.X0331)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Vetilation&gt;96(9672) ..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Central venous catheterization(3893)</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Physical therapy(9339)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Normal delivery (7359)..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> CT scan..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Transfusion(9904)..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Other..</td>
    </tr>
    <tr>
        <td class="dbtb_bottom_hide" colspan="2"><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Diagnosis ultrasound    ( specify )</td>
        <td class="dbtb_bottom_hide"><img src="dcsum_clip_image001_0000.gif" width="12" height="12" align="center" style="margin-left: 2px;"/> Other..</td>
    </tr>
</table>

<table width="100%" class="dctb tb_normal_line" valign="top" style="">
    <tr>
        <td width="50%">DISCHARGE STATUS</td>
        <td width="50%">DISCHARGE TYPE</td>
    </tr>
    <tr>
        <td>
            <table class="dctb_close" width="100%">
                <tr>
                    <td>1&nbsp;&nbsp;COMPLETE RECOVERY</td>
                    <td>6&nbsp;&nbsp;NORMAL CHILD DISCHARGED WITH MOTHER</td>
                </tr>
                <tr>
                    <td>2&nbsp;&nbsp;IMPROVED</td>
                    <td>7&nbsp;&nbsp;NORMAL CHILD DISCHARGED SEPARETERY</td>
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
                    <td>5&nbsp;&nbsp;OTHER</td>
                </tr>
                <tr>
                    <td>2&nbsp;&nbsp;AGAINST ADVICE</td>
                    <td>6&nbsp;&nbsp;DEAD AUTOPSY</td>
                </tr>
                <tr>
                    <td>3&nbsp;&nbsp;ESCAPE</td>
                    <td>7&nbsp;&nbsp;DEAD  NO  AUTOPSY</td>
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
    <tr style="height:30px;" >
        <td width="25%">MEDLICENSE<br>................................................</td>
        <td width="25%">ATTENDING<br>PHYSICIAN ...................................</td>
        <td width="25%">APPROVED<br>BY ................................................</td>
        <td width="25%">ICD CODING By CODER....</td>
    </tr>
</table>

</body>
<script>
window.onload = function(){
    window.print();
}
</script>