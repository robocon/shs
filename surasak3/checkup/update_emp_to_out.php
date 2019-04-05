<?php 
// header('Content-Type: text/html; charset=TIS-620');


include '../bootstrap.php';

$db = Mysql::load();

// $db->exec("SET NAMES TIS620");

$sql = "SELECT * FROM `dxofyear_emp` WHERE `yearchk` = '62' ORDER BY `thidate` ASC";
$db->select($sql);
$items = $db->get_items();

exit;

foreach ($items as $key => $item) {
    

    // dump($item);

    $hn_out = $item['hn'];

    $sql = "SELECT * FROM `dxofyear_out` WHERE `hn` = '$hn_out' AND `yearchk` = '62' ";
    $db->select($sql);

    $row = $db->get_rows();
    if( $row == 0 ){
        // $user = $db->get_item();
        // dump($user);

        // 

        $sql = "INSERT INTO `dxofyear_out` ( 
            `thidate`, `thdatehn`, `thdatevn`, `hn`, `vn`, `ptname`, 
            `age`, `camp`, `camp_until`, `height`, `weight`, `round_`, 
            `temperature`, `pause`, `rate`, `bmi`, `bp1`, `bp2`, 
            `bp21`, `bp22`, `drugreact` , `cigarette` , `alcohol` , `exercise` , 
            `congenital_disease` , `type` , `organ` , `clinic` , `doctor` , `ua_color`, 
            `ua_appear`, `ua_spgr`, `ua_phu`, `ua_bloodu`, `ua_prou`, `ua_gluu`, 
            `ua_ketu`, `ua_urobil`, `ua_bili`, `ua_nitrit`, `ua_wbcu`, `ua_rbcu`, 
            `ua_epiu`, `ua_bactu`, `ua_yeast`, `ua_mucosu`, `ua_amopu`, `ua_castu`, 
            `ua_crystu`, `ua_otheru`, `cbc_wbc`, `wbcrange`, `wbcflag`, `cbc_rbc`, 
            `cbc_hb`, `cbc_hct`, `hctrange`, `hctflag`, `cbc_mcv`, `cbc_mch`, 
            `cbc_mchc`, `cbc_pltc`,`pltcrange`, `pltcflag`, `cbc_plts`, `cbc_neu`, 
            `cbc_lymp`, `cbc_mono`, `cbc_eos`, `cbc_baso`, `cbc_band`, `cbc_atyp`, 
            `cbc_nrbc`, `cbc_rbcmor`, `cbc_other`, `cxr`, `bs`,`bsrange`, 
            `bsflag`, `bun`,`bunrange`, `bunflag`, `cr`,`crrange`, 
            `crflag`, `uric`,`uricrange`, `uricflag`, `chol`,`cholrange`, 
            `cholflag`, `tg`,`tgrange`, `tgflag`, `sgot`,`sgotrange`, 
            `sgotflag`, `sgpt`,`sgptrange`, `sgptflag`, `alk`,`alkrange`, 
            `alkflag`, `dx`, `yearchk`
        ) VALUES (
            '".$item["thidate"]."','".$item["thdatehn"]."','".$item["thdatevn"]."','".$item["hn"]."','".$item["vn"]."','".$item["ptname"]."',
            '".$item["age"]."','".$item["camp"]."','".$item["camp_until"]."','".$item["height"]."','".$item["weight"]."','".$item["round_"]."',
            '".$item["temperature"]."','".$item["pause"]."','".$item["rate"]."','".$item["bmi"]."','".$item["bp1"]."','".$item["bp2"]."',
            '".$item["bp21"]."','".$item["bp22"]."','".$item["drugreact"]."','".$item["cigarette"]."','".$item["alcohol"]."','".$item["exercise"]."',
            '".$item["congenital_disease"]."','".$item["type"]."','".$item["organ"]."','".$item["clinic"]."','".$item["doctor"]."','".$item["ua_color"]."',
            '".$item["ua_appear"]."','".$item["ua_spgr"]."','".$item["ua_phu"]."','".$item["ua_bloodu"]."','".$item["ua_prou"]."','".$item["ua_gluu"]."',
            '".$item["ua_ketu"]."','".$item["ua_urobil"]."','".$item["ua_bili"]."','".$item["ua_nitrit"]."','".$item["ua_wbcu"]."','".$item["ua_rbcu"]."',
            '".$item["ua_epiu"]."','".$item["ua_bactu"]."','".$item["ua_yeast"]."','".$item["ua_mucosu"]."','".$item["ua_amopu"]."','".$item["ua_castu"]."',
            '".$item["ua_crystu"]."','".$item["ua_otheru"]."','".$item["cbc_wbc"]."','".$item["wbcrange"]."','".$item["wbcflag"]."','".$item["cbc_rbc"]."',
            '".$item["cbc_hb"]."','".$item["cbc_hct"]."','".$item["hctrange"]."','".$item["hctflag"]."','".$item["cbc_mcv"]."','".$item["cbc_mch"]."',
            '".$item["cbc_mchc"]."','".$item["cbc_pltc"]."','".$item["pltcrange"]."','".$item["pltcflag"]."','".$item["cbc_plts"]."','".$item["cbc_neu"]."',
            '".$item["cbc_lymp"]."','".$item["cbc_mono"]."','".$item["cbc_eos"]."','".$item["cbc_baso"]."','".$item["cbc_band"]."','".$item["cbc_atyp"]."',
            '".$item["cbc_nrbc"]."','".$item["cbc_rbcmor"]."','".$item["cbc_other"]."','".$item["cxr"]."','".$item["bs"]."','".$item["bsrange"]."',
            '".$item["bsflag "]."','".$item["bun"]."','".$item["bunrange"]."','".$item["bunflag"]."','".$item["cr"]."','".$item["crrange"]."',
            '".$item["crflag"]."','".$item["uric"]."','".$item["uricrange"]."','".$item["uricflag"]."','".$item["chol"]."','".$item["cholrange"]."',
            '".$item["cholflag"]."','".$item["tg"]."','".$item["tgrange"]."','".$item["tgflag"]."','".$item["sgot"]."','".$item["sgotrange "]."',
            '".$item["sgotflag"]."','".$item["sgpt"]."','".$item["sgptrange"]."','".$item["sgptflag"]."','".$item["alk"]."','".$item["alkrange"]."',
            '".$item["alkflag"]."','".$item["dx"]."','".$item["yearchk"]."'
        )";
        $insert = $db->insert($sql);
        dump($insert);
        dump($sql);

    }

    

    echo "<hr>";

}
