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
		$pAge="$ageY »Õ";
	}else{
		$pAge="$ageY »Õ $ageM à´×Í¹";
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
if($sex=='ª'){
	$sex1='ªÒÂ';
}else {
	$sex1='Ë­Ô§';
}

 $ddate=substr($date,8,2);
    $mdate=substr($date,5,2); 
    $ydate=substr($date,0,4); 
	$tdate=substr($date,11,5); 
 $adate="$ddate-$mdate-$ydate"; 

//print opd card ·Õè¹Õè ¨Ò¡ opdcardprn.htm  by frontpage



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
	font-size:16pt;
	line-height: 20px;
}
.table2{
	font-family:"TH SarabunPSK";
	font-size:14pt;
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


table.dctb{
    font-family:"TH SarabunPSK";
    border-collapse: collapse;
    font-size:14pt;
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
<!-- window.print(); -->
<body onLoad="">

<div align="right" class="head">MR – IPD - 002 (1)</div>
<div align="center" class="head">DISCHARGE SUMMARY</div>
<div align="center" class="head">FORT SURASAKMONTRI HOSPITAL àÃÔèÁãªé  ÇÑ¹·Õè  4 ÁÕ.¤. 62</div>
<BR />
<table width="100%" class="" style="border-collapse: collapse; border: 1px solid black; border-bottom: none; font-family: TH SarabunPSK; font-size: 14pt;">
    <tr>
        <td class="dbtb_bottom">ADMIT: &nbsp;<?=$adate;?></td>
        <td class="dbtb_bottom">àÇÅÒ:&nbsp;<?=$tdate;?>¹.</td>
        <td class="dbtb_bottom">AN:&nbsp; <?=$an;?></td>
        <td class="dbtb_bottom">HN:&nbsp;<?=$hn;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom">ª×èÍ:&nbsp;<?=$cPtname;?></td>
        <td class="dbtb_bottom">ÍÒÂØ:&nbsp;<?=$cAge?></td>
        <td class="dbtb_bottom">à¾È:<?=$sex1;?></td>
        <td class="dbtb_bottom">ÊÑ§¡Ñ´:&nbsp;<?=$camp;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom">àÅ¢ »ªª.&nbsp;<?=$idcard;?></td>
        <td class="dbtb_bottom"></td>
        <td class="dbtb_bottom">Ç/´/».à¡Ô´:&nbsp;<?=$birthdate;?></td>
        <td class="dbtb_bottom"> ÊÔ·¸Ô:&nbsp;<?=$ptright;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom">ºéÒ¹àÅ¢·Õè <?=$address;?>&nbsp;µÓºÅ<?=$tambol;?>&nbsp;ÍÓàÀÍ <?=$ampur;?>&nbsp;</td>
        <td class="dbtb_bottom"></td>
        <td class="dbtb_bottom">¨Ñ§ËÇÑ´: <?=$changwat;?></td>
        <td class="dbtb_bottom">â·Ã: <?=$phone;?></td>
    </tr>
    <tr>
        <td class="dbtb_bottom_hide">¼Ùé·ÕèµÔ´µèÍä´é:&nbsp;<?=$ptf;?></td>
        <td class="dbtb_bottom_hide">à¡ÕèÂÇ¢éÍ§à»ç¹:&nbsp;<?=$ptfadd;?></td>
        <td class="dbtb_bottom_hide">&nbsp;â·ÃÈÑ¾·ì:&nbsp;<?=$ptffone;?></td>
        <td class="dbtb_bottom_hide">ËÍÃÑº&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ËÍ¨ÓË¹èÒÂ</td>
    </tr>
</table>
<table width="100%" class="dctb" style="font-size: 12pt; border-bottom: none!important;">
  <tr>
    <td class="dbtb_bottom_hide" valign="top">Refer from</td>
    <td class="dbtb_bottom_hide" align="center" valign="top">Discharge Date, Time</td>
    <td class="dbtb_bottom_hide" align="center" valign="top">
        <div><font class="length">LENGTH OF STAY <br />( DAYS )</font></div>
        <div>&nbsp;</div>
        <div>TOTAL LEAVE DAYS</div>
        <div>&nbsp;</div>
    </td>
    <td class="dbtb_bottom_hide" align="center" valign="bottom">CONDITION OF INFANT AT BIRTH
        <br>
        <br>
        <table width="100%" class="dctb_close">
            <tr>
                <td align="left" valign="top"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> LIVEBIRTH</td>
                <td align="left" valign="top"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> CLINICALLY MATURE</td>
            </tr>
            <tr>
                <td align="left" valign="top"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> STILLBRITH &nbsp;&nbsp;</td>
                <td align="left" valign="top"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="left"/> CLINICALLY PREMATURE</td>
            </tr>
        </table>
        <p></p>
    </td>
    <td class="dbtb_bottom_hide" align="center" valign="top">
        <p>BIRTH<br />WEIGHT</p>
        <p>GRAMS</p>
    </td>
  </tr>
</table>

<table width="100%" class="dctb" valign="top" style="font-size: 12pt;">
    <tr class="tb_hide_top">
        <td rowspan="7" class="dbtb_bottom_hide">DIAGNOSIS</td>
        <td>1 PRINCIPAL DIAGNOSIS</td>
        <td>DIAGNOSIS   ICD  CODING<br>By CODER……………………………………………..<br>&nbsp;</td>
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
        <td>EXTERNAL CAUSE (S)<br>&nbsp;<br>&nbsp;<br>&nbsp;</td>
    </tr>
    <tr>
        <td class="dbtb_bottom_hide">5 EXTERNAL CAUSE OF INJURY</td>
        <td class="dbtb_bottom_hide">PROCEDURES ICD CODEING<br>By CODER....</td>
    </tr>
</table>

<table width="100%" class="dctb" valign="top" style="font-size: 12pt;">
    <tr>
        <td rowspan="5" class="dbtb_bottom_hide">OPERATION</td>
        <td>OPERATING  ROOM  PROCEDURE</td>
        <td style="border-left: 0;">DATE</td>
        <td>TIME STARED</td>
        <td>TIME  END</td>
        <td rowspan="2">MAIN</td>
    </tr>
    <tr>
        <td colspan="4">1.</td>
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

<table width="100%" class="dctb" valign="top" style="font-size: 12pt;">
    <tr>
        <td style="position: relative;">NON or<br>PROCEDURE<span style="position: absolute; top: 2px; right: 2px;">DATE</span></td>
        <td style="position: relative;">&nbsp;<span style="position: absolute; top: 2px; right: 2px;">DATE</span></td>
        <td style="position: relative;">&nbsp;<span style="position: absolute; top: 2px; right: 2px;">DATE</span></td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/> Arthrocentesis(8191)</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/> Gastric lavage Irrigation(9633)</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/> EGD(4513)……………………..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Paracenthesis (5491)………………………..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Insertion of endotracheal tube(9604)…………</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Vetilation &lt;96(5671)……………………..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Thoracocenthesis (3491)………………………..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Lumbar puncture (L.P.X0331)…………………..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Vetilation&gt;96(9672) ………………………..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Central venous catheterization(3893)…………</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Physical therapy(9339)………………………..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Transfution(9904)……………………..</td>
    </tr>
    <tr>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>CT scan………………………..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Normal delivery(7359)………………………..</td>
        <td><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Other………………………..</td>
    </tr>
    <tr>
        <td class="dbtb_bottom_hide"><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Diagnosis ultrasound    ( specify )…………</td>
        <td class="dbtb_bottom_hide"><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/></td>
        <td class="dbtb_bottom_hide"><img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Other………………………..</td>
    </tr>
</table>

<table width="100%" class="dctb" valign="top" style="font-size: 14pt;">
    <tr>
        <td>DISCHARGE STATUS</td>
        <td>DISCHARGE TYPE</td>
    </tr>
    <tr>
        <td>
            <table class="dctb_close">
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
            <table class="dctb_close">
                <tr>
                    <td>1&nbsp;&nbsp;WITH APPROVAL</td>
                    <td>5&nbsp;&nbsp;OTHER</td>
                </tr>
                <tr>
                    <td>2&nbsp;&nbsp;AGAINST ADVICE</td>
                    <td>6&nbsp;&nbsp;DEAD AUTOPSY</td>
                </tr>
                <tr>
                    <td>3&nbsp;&nbsp;ESCAPE</td>
                    <td>7&nbsp;&nbsp;DEAD  NO  SUTOPSY</td>
                </tr>
                <tr>
                    <td>4&nbsp;&nbsp;BY TRANSFER</td>
                    <td></td>
                </tr>
                <tr>
                    <td>ª×èÍÊ¶Ò¹¾ÂÒºÒÅ·ÕèÊè§µèÍ ..............................................................</td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="dbtb_bottom_hide"><b>CAUSE  OF  DEATH</b></td>
    </tr>
</table>

<table width="100%" class="dctb" valign="top" style="font-size: 16pt;">
    <tr>
        <td>MEDLISENCE<br>……………………………</td>
        <td>ATTENDING<br>PHYSICIAN ………………………………………………</td>
        <td>APPROVED<br>BY ………………………………………………………</td>
    </tr>
</table>

</body>
<script>
window.onload = function(){
    window.print();
}
</script>