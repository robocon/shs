<?php
require dirname(__FILE__)."/bootstrap.php";
require dirname(__FILE__)."/includes/JSON.php";

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

$list_ua["COLOR"] =  "ua_color"; 
$list_ua["APPEAR"] =  "ua_appear"; 
$list_ua["SPGR"] =  "ua_spgr"; 
$list_ua["PHU"] =  "ua_phu"; 
$list_ua["BLOODU"] =  "ua_bloodu"; 
$list_ua["PROU"] =  "ua_prou"; 
$list_ua["GLUU"] =  "ua_gluu"; 
$list_ua["KETU"] =  "ua_ketu"; 
$list_ua["UROBIL"] =  "ua_urobil"; 
$list_ua["BILI"] =  "ua_bili"; 
$list_ua["NITRIT"] =  "ua_nitrit"; 
$list_ua["WBCU"] =  "ua_wbcu"; 
$list_ua["RBCU"] =  "ua_rbcu"; 
$list_ua["EPIU"] =  "ua_epiu"; 
$list_ua["BACTU"] =  "ua_bactu"; 
$list_ua["YEAST"] =  "ua_yeast"; 
$list_ua["MUCOSU"] =  "ua_mucosu"; 
$list_ua["AMOPU"] =  "ua_amopu";
$list_ua["CASTU"] =  "ua_castu"; 
$list_ua["CRYSTU"] =  "ua_crystu"; 
$list_ua["OTHERU"] =  "ua_otheru"; 

$list_cbc["WBC"] =  "cbc_wbc"; 
$list_cbc["RBC"] =  "cbc_rbc"; 
$list_cbc["HB"] =  "cbc_hb"; 
$list_cbc["HCT"] =  "cbc_hct"; 
$list_cbc["MCV"] =  "cbc_mcv";
$list_cbc["MCH"] =  "cbc_mch";
$list_cbc["MCHC"] =  "cbc_mchc";
$list_cbc["PLTC"] =  "cbc_pltc";
$list_cbc["PLTS"] =  "cbc_plts";
$list_cbc["NEU"] =  "cbc_neu";
$list_cbc["LYMP"] =  "cbc_lymp";
$list_cbc["MONO"] =  "cbc_mono";
$list_cbc["EOS"] =  "cbc_eos";
$list_cbc["BASO"] =  "cbc_baso";
$list_cbc["BAND"] =  "cbc_band";
$list_cbc["ATYP"] =  "cbc_atyp";
$list_cbc["NRBC"] =  "cbc_nrbc";
$list_cbc["RBCMOR"] =  "cbc_rbcmor";
$list_cbc["OTHER"] =  "cbc_other";

// รายการแลปอื่นๆที่ให้แสดงผลได้
$list_lab["TRIG"] = "tg";
$list_lab["GLU"] = "bs";
$list_lab["CHOL"] = "chol";
$list_lab["AST"] = "sgot";
$list_lab["ALT"] = "sgpt";
$list_lab["ALP"] = "alk";
$list_lab["BUN"] = "bun";
$list_lab["CREA"] = "cr";
$list_lab["URIC"] = "uric";

$list_lab["HDL"] = "hdl";
$list_lab["LDL"] = "ldl";
$list_lab["10001"] = "10001";//ldlc
$list_lab["MALARI"] = "malari";
$list_lab["METAMP"] = "metamp";
$list_lab["HBSAG"] = "hbsag";
$list_lab["HCVAB"] = "hcvab";
$list_lab["HIV"] = "hiv";
$list_lab["VDRL"] = "vdrl";
$list_lab["PARASI"] = "parasi";
$list_lab["GROUPT"] = "groupt";
$list_lab["RH"] = "rh";
$list_lab["UPT"] = "upt";
$list_lab["ANTIHB"] = "antihb";
$list_lab["AHAV"] = "ahav";

//เพิ่มใหม่ LFT
$list_lab["TB"] = "TB";
$list_lab["DB"] = "DB";
$list_lab["ALB"] = "ALB";
$list_lab["TP"] = "TP";

$action = $_POST['action'];
if($action=='findUAResult'){
    
    $sql = sprintf("SELECT a.*,b.`labname`,b.`result` 
    FROM (
        SELECT `autonumber` FROM `resulthead` WHERE `labnumber` = '%s' AND `profilecode` = 'UA' 
    ) AS a LEFT JOIN `resultdetail` AS b ON a.`autonumber` = b.`autonumber` 
    WHERE b.`labcode` IN ('COLOR','APPEAR','SPGR','PHU','BLOODU','PROU','GLUU','KETU','UROBIL','BILI','NITRIT','WBCU','RBCU','EPIU','BACTU','YEAST','MUCOSU','AMOPU','CASTU','CRYSTU','OTHERU')",
    $dbi->real_escape_string($_POST['labnumber'])
    );
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <table>
            <?php
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                $labname = $a['labname'];
                if ($labname == "OTHERU") {
                    $size = "13";
                } else {
                    $size = "6";
                }
                ?>
                <td align="right" class="tb_font_2"><?=$labname; ?> : </td>
                <td>&nbsp;<input name="<?=$list_ua[$labname]; ?>" type="text" value="<?=$a['result']; ?>" size="<?=$size; ?>" readonly />&nbsp;&nbsp;</td>
                <?php
                if ($i % 5 == 0) echo "<tr></tr>";
                $i++;
            }
            ?>
        </table>
        <?php
    }else{
        ?><p><b>&nbsp;&nbsp;&nbsp;ไม่พบข้อมูล UA</b></p><?php
    }
    exit;

}else if($action=='findCBCResult'){

    $sql = sprintf("SELECT a.*,b.`labname`,b.`result` 
    FROM (
        SELECT `autonumber` FROM `resulthead` WHERE `labnumber` = '%s' AND `profilecode` = 'CBC' 
    ) AS a LEFT JOIN `resultdetail` AS b ON a.`autonumber` = b.`autonumber` 
    WHERE b.`labcode` IN ('WBC','RBC','HB','HCT','MCV','MCH','MCHC','PLTC','PLTS','NEU','LYMP','MONO','EOS','BASO','BAND','ATYP','NRBC','RBCMOR','OTHER')",
    $dbi->real_escape_string($_POST['labnumber'])
    );
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <table>
            <?php
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                $labname = $a['labname'];
                if ($labname == "OTHER" || $labname == "PLTS") {
                    $size = "13";
                } else {
                    $size = "6";
                }
                ?>
                <td align="right" class="tb_font_2"><?=$labname; ?> : </td>
                <td>
                    &nbsp;<input name="<?=$list_cbc[$labname]; ?>" type="text" value="<?=$a['result']; ?>" size="<?=$size; ?>" readonly />&nbsp;&nbsp;
                    <input type="hidden" name="<?= $labname ?>range" value="<?= $a['normalrange'] ?>" />
                    <input type="hidden" name="<?= $labname ?>flag" value="<?= $a['flag'] ?>" />
                </td>
                <?php
                if ($i % 5 == 0) echo "<tr></tr>";
                $i++;
            }
            ?>
        </table>
        <?php
    }else{
        ?><p><b>&nbsp;&nbsp;&nbsp;ไม่พบข้อมูล CBC</b></p><?php
    }
    exit;
}else if($action=='findOTHERResult'){

    $sql = sprintf("SELECT b.`labcode`,b.`result`,b.`unit`,b.`normalrange`,b.`flag`,SUBSTRING(b.`authorisedate`,1,10) AS `authorisedate`
	FROM ( 
		SELECT MAX(`autonumber`) AS `autonumber` 
		FROM `resulthead` 
		WHERE `labnumber` = '%s' 
		AND ( `profilecode` <> 'UA' AND `profilecode` <> 'CBC' )
		GROUP BY `profilecode`
	) as a , 
	`resultdetail` as b  
	WHERE a.`autonumber` = b.`autonumber` 
	AND b.`parentcode` <> 'UA' 
	AND b.`parentcode` <> 'CBC' 
    AND b.`labcode` IN('TRIG','GLU','CHOL','AST','ALT','ALP','BUN','CREA','URIC','HDL','LDL','10001','MALARI','METAMP','HBSAG','HCVAB','HIV','VDRL','PARASI','GROUPT','RH','UPT','ANTIHB','AHAV','TB','DB','ALB','TP')
	Order by a.`autonumber` ASC ",
    $dbi->real_escape_string($_POST['labnumber'])
    );
    
    $q = $dbi->query($sql);
    if($q->num_rows>0){

        $items = array();
        $orderdate = '';
        while ($a = $q->fetch_assoc()) {
            $orderdate = $a['authorisedate'];
            $labname = $a['labcode'];
            $a['name'] = $list_lab[$labname];
            $items[] = $a;
        }

        $res = array(
            'status'=>200,
            'date'=>$orderdate,
            'data'=>$items
        );
    /*
    ?>
    <table border="0">
        <tr>
            <?php
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                $extraName = "";
                $labname = $a['labcode'];
                if ($labname == '10001') {
                    $extraName = '(LDLC)';
                }
                ?>
                <td align="right" class="tb_font_2"><?=$labname . $extraName; ?> : </td>
                <td>
                    &nbsp;<input name="<?=$list_lab[$labname]; ?>" type="text" value="<?=$a['result']; ?>" size="6" readonly />&nbsp;&nbsp;
                    <input type="hidden" name="<?=$labname;?>range" value="<?=$a['normalrange'];?>" />
                    <input type="hidden" name="<?=$labname;?>flag" value="<?=$a['flag']?>" />
                </td>
            <?php
                // ตัดบรรทัดใหม่
                if ($i % 5 == 0) echo "<tr></tr>";
                $i++;
            }
            ?>
        </tr>
    </table>
    <?php
    */

    }else{
        
        $res = array('status'=>400, 'message'=>'ไม่พบข้อมูลแลปอืนๆ');
    }

    echo $json->encode($res);
    exit;
}

