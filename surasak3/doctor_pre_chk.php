<?php
// ��ͻ�Ҩҡ chk_doctor
include 'bootstrap.php';
$db = Mysql::load();

$action = input_post('action');
if( $action === 'save' ){

    $dxofyear_id = input_post('dxofyear_id');

    $hn = input_post('hn');
    $vn = input_post('vn');
    $prefix = input_post('yot');
    $name = input_post('name');
    $surname = input_post('surname');
    $idcard = input_post('idcard');
    $address = input_post('address');
    $date_chk = input_post('date_chk');
    $yearchk = get_year_checkup();
    $ear = $_POST['ear'];
    $eye = $_POST['eye'];
    $snell_eye = $_POST['snell_eye'];
    $cxr = $_POST['cxr'];
    $cxr_detail = $_POST['cxr_detail'];
    $conclution = $_POST['conclution'];

    $normal_suggest = $_POST['normal_suggest'];
    $normal_suggest_date = input_post('normal_suggest_date');

    $abnormal_suggest = $_POST['abnormal_suggest'];
    $abnormal_suggest_date = input_post('abnormal_suggest_date');

    $doctor = input_post('doctor');
    $officer = $_SESSION['sOfficer'];

    $res_cbc = $_POST['res_cbc'];
    $res_ua = $_POST['res_ua'];
    $res_glu = $_POST['res_glu'];
    $res_crea = $_POST['res_crea'];
    $res_chol = $_POST['res_chol'];
    $res_hdl = $_POST['res_hdl'];
    $res_hbsag = $_POST['res_hbsag'];
    $res_occult = $_POST['res_occult'];

    if($_POST['res_stocc']){
        $res_occult = $_POST['res_stocc'];
    }

    $diag = input_post('diag');
    
    $sex = input_post('sex');
    $breast = '';
    if( $sex == "�" ){
        $breast = input_post('breast');
    }

    $curr_date = date('Y-m-d');
    $sql = "SELECT `id` FROM `chk_doctor` WHERE `date_chk` LIKE '$curr_date%' AND `hn` = '$hn' ";
    $db->select($sql);
    $rows = $db->get_rows();
    
    if ( $rows == 0 ) {
        
        $sql = "INSERT INTO `chk_doctor` (
            `id`, `hn`, `vn`, `prefix`, `name`, `surname`, 
            `idcard`, `address`, `date_chk`, `yearchk`, `ear`, `breast`, 
            `eye`, `snell_eye`, `cxr`, `conclution`, `normal_suggest`,
            `normal_suggest_date`, `abnormal_suggest`, `abnormal_suggest_date`, `doctor`, `officer`, 
            `res_cbc`, `res_ua`, `res_glu`, `res_crea`, `res_chol`, `res_hdl`, 
            `res_hbsag`,`res_occult`,`diag`,`cxr_detail`
        ) VALUES (
            NULL, '$hn', '$vn', '$prefix', '$name', '$surname', 
            '$idcard', '$address', NOW(), '$yearchk', '$ear', '$breast', 
            '$eye', '$snell_eye', '$cxr', '$conclution', '$normal_suggest', 
            '$normal_suggest_date', '$abnormal_suggest', '$abnormal_suggest_date', '$doctor', '$officer', 
            '$res_cbc', '$res_ua', '$res_glu', '$res_crea', '$res_chol', '$res_hdl', 
            '$res_hbsag', '$res_occult', '$diag', '$cxr_detail'
        );";
        $save = $db->insert($sql);

    }else if( $rows > 0 ){

        $up = $db->get_item();
        $id = $up['id'];

        $sql = "UPDATE `chk_doctor` SET 
        `ear` = '$ear', 
        `breast` = '$breast', 
        `eye` = '$eye', 
        `snell_eye` = '$snell_eye', 
        `cxr` = '$cxr', 
        `conclution` = '$conclution', 
        `normal_suggest` = '$normal_suggest',
        `normal_suggest_date` = '$normal_suggest_date', 
        `abnormal_suggest` = '$abnormal_suggest', 
        `abnormal_suggest_date` = '$abnormal_suggest_date',
        `doctor` = '$doctor',
        `res_cbc` = '$res_cbc', 
        `res_ua` = '$res_ua', 
        `res_glu` = '$res_glu', 
        `res_crea` = '$res_crea', 
        `res_chol` = '$res_chol', 
        `res_hdl` = '$res_hdl', 
        `res_hbsag` = '$res_hbsag',
        `res_occult` = '$res_occult',
        `diag` = '$diag',
        `cxr_detail` = '$cxr_detail'
        WHERE `id` = '$id' ; ";
        $save = $db->update($sql);

    }

    // ua -> res_ua
    $_POST['normal'] = ( $res_ua == 1 ) ? '����' : '�Դ����' ;

    //cbc -> res_cbc
    $_POST['normal81'] = ( $res_cbc == 1 ) ? '����' : '�Դ����' ;

    // xray -> cxr
    $_POST['normal51'] = ( $cxr == 1 ) ? '����' : '�Դ����' ;

    // ���� -> conclution
    
    $_POST['normal61'] = ( $conclution == 1 ) ? '����' : '�Դ����' ;

    $_POST['doctorn'] = $doctor;
    $_POST['dx'] = $diag;
    $nPrefix = '2561';



    if($_POST['normal20']=="����"|$_POST['normal20']=="") $_POST['ch20']="";
	if($_POST['normal21']=="����"|$_POST['normal21']=="") $_POST['ch21']="";
	if($_POST['normal22']=="����"|$_POST['normal22']=="") $_POST['ch22']="";
	if($_POST['normal23']=="����"|$_POST['normal23']=="") $_POST['ch23']="";
	if($_POST['normal24']=="����"|$_POST['normal24']=="") $_POST['ch24']="";
	if($_POST['normal25']=="����"|$_POST['normal25']=="") $_POST['ch25']="";
	if($_POST['normal26']=="����"|$_POST['normal26']=="") $_POST['ch26']="";
	if($_POST['normal27']=="����"|$_POST['normal27']=="") $_POST['ch27']="";
	if($_POST['normal28']=="����"|$_POST['normal28']=="") $_POST['ch28']="";
	if($_POST['normal29']=="����"|$_POST['normal29']=="") $_POST['ch29']="";
	if($_POST['normal30']=="����"|$_POST['normal30']=="") $_POST['ch30']="";
	if($_POST['normal']=="����"|$_POST['normal']=="") $_POST['ch']="";
	if($_POST['normal31']=="����"|$_POST['normal31']=="") $_POST['ch31']="";
	if($_POST['normal32']=="����"|$_POST['normal32']=="") $_POST['ch32']="";
	if($_POST['normal33']=="����"|$_POST['normal33']=="") $_POST['ch33']="";
	if($_POST['normal81']=="����"|$_POST['normal81']=="") $_POST['ch81']="";
	if($_POST['normal41']=="����"|$_POST['normal41']=="") $_POST['ch41']="";
	if($_POST['normal42']=="����"|$_POST['normal42']=="") $_POST['ch42']="";
	if($_POST['normal43']=="����"|$_POST['normal43']=="") $_POST['ch43']="";
	if($_POST['normal44']=="����"|$_POST['normal44']=="") $_POST['ch44']="";
	if($_POST['normal45']=="����"|$_POST['normal45']=="") $_POST['ch45']="";
	if($_POST['normal46']=="����"|$_POST['normal46']=="") $_POST['ch46']="";
	if($_POST['normal47']=="����"|$_POST['normal47']=="") $_POST['ch47']="";
	if($_POST['normal48']=="����"|$_POST['normal48']=="") $_POST['ch48']="";
	if($_POST['normal49']=="����"|$_POST['normal49']=="") $_POST['ch49']="";
	if($_POST['normal51']=="����"|$_POST['normal51']=="") $_POST['ch51']="";
	if($_POST['normal52']=="����"|$_POST['normal52']=="") $_POST['ch52']="";
	
	if($_POST['other1']==""){ $_POST['normal53']=""; $_POST['ch53']="";};
	if($_POST['other2']==""){ $_POST['normal54']=""; $_POST['ch54']="";};
	if($_POST['normal53']=="����"|$_POST['normal53']=="") $_POST['ch53']="";
	if($_POST['normal54']=="����"|$_POST['normal54']=="") $_POST['ch54']="";
	if($_POST['normal55']=="����"|$_POST['normal55']=="") $_POST['ch55']="";
    if($_POST['normal56']=="����"|$_POST['normal56']=="") $_POST['ch56']="";
    
    $txtsm="";
	for($k=1;$k<=8;$k++){
		if($_POST['chk'.$k]!=""){
			if($k==8){
				$txtsm .= $_POST['text71'];
			}else{
				$txtsm .= $_POST['chk'.$k].",";
			}
		}
	}
	if($_POST['normal71']=="����"){
		$txtsm="";
		$_POST['text72']="";
	}elseif($_POST['normal71']=="�ջѨ�������§�����Դ�ä (�Դ������硹���)"){
		//$txtsm=$txtsm;
		$_POST['text72']="";
	}elseif($_POST['normal71']=="���ä"){
		$txtsm=$_POST['text72'];
    }
    
    if($_POST['normal62']=="����������§���ͧ�鹵���ä"){ 
		$rs_sum21 = $_POST['normal621'];
		$rs_sum22 = $_POST['normal622'];
		$rs_sum23 = $_POST['normal623'];
		$rs_sum24 = $_POST['normal624'];
		$rs_sum25 = $_POST['normal625'];
	}
	if($_POST['normal65']=="���´����ä������ѧ"){ 
		$rs_sum51 = $_POST['normal651'];
		$rs_sum52 = $_POST['normal652'];
		$rs_sum53 = $_POST['normal653'];
	}
	if($_POST['normal66']=="����硫����"){ 
		$rs_sum61 = $_POST['normal661'];
	}

    // ��ô��Թ��� port ����ͧ��ǹ��������
    // -> normal_suggest
    // -> abnormal_suggest
    $_POST['normal95'] = '5 ����';
    
    if( $conclution == 1 ){
        $suggest_list = array(
            1 => '����������й�', 
            '�й�����Ѻ��õ�Ǩ������ͧ'
        );

        $normal951 = $suggest_list[$normal_suggest];
        
    }else{
        $suggest_list = array(
            1 => '����������й�', 
            '�����й�㹡�õ�Ǩ�Դ���/��Ǩ���', 
            '�����й�����Ѻ����ѡ�ҡó��纻���', 
            '�����й�����ѡ����ѡ�ҡó������á��͹�ҡ�ä������ѧ'
        );

        $normal951 = $suggest_list[$abnormal_suggest];
        
    }

    $_POST['normal951'] = $normal951;
    
    $date_now = date("Y-m-d H:i:s");
    $date_hn = date('Y-m-d').$hn;
    $date_vn = date('Y-m-d').$vn;
    

    $sql = "SELECT * FROM `dxofyear_out` WHERE `row_id` = '$dxofyear_id'";
    $db->select($sql);
    $dx = $db->get_item();

    $sql ="INSERT INTO  `condxofyear_out` ( 
        `thidate`,`thdatehn`,`thdatevn`,`hn`,`vn`,`ptname`,
        `age`,`camp`,`camp_until`,`height`,`weight`,`round_`,
        `temperature`,`pause`,`rate`,`bmi`,`bp1`,`bp2`,
        `drugreact` ,`prawat`,`congenital_disease`,`type`,`organ`,`doctor`,
        `ua_color`,`ua_appear`,`ua_spgr`,`ua_phu`,`ua_bloodu`,`ua_prou`,
        `ua_gluu`,`ua_ketu`,`ua_urobil`,`ua_bili`,`ua_nitrit`,`ua_wbcu`,
        `ua_rbcu`,`ua_epiu`,`ua_bactu`,`ua_yeast`,`ua_mucosu`,`ua_amopu`,
        `ua_castu`,`ua_crystu`,`ua_otheru`,`stat_ua`,`reason_ua`,`cbc_wbc`,
        `stat_wbc`,`reason_wbc`,`wbcrange`,`wbcflag`,`cbc_rbc`,`cbc_hb`,
        `cbc_hct`,`stat_hct`,`reason_hct`,`hctrange`,`hctflag`,`cbc_mcv`,
        `cbc_mch`,`cbc_mchc`,`cbc_pltc`,`stat_pltc`,`reason_pltc`,`pltcrange`,
        `pltcflag`,`cbc_plts`,`cbc_neu`,`cbc_lymp`,`cbc_mono`,`cbc_eos`,
        `cbc_baso`,`cbc_band`,`cbc_atyp`,`cbc_nrbc`,`cbc_rbcmor`,`cbc_other`,
        `stat_cbc`,`reason_cbc`,`cxr`,`reason_cxr`,`bs`,`stat_bs`,
        `reason_bs`,`bsrange`,`bsflag`,`bun`,`stat_bun`,`reason_bun`,
        `bunrange`,`bunflag`,`cr`,`stat_cr`,`reason_cr`,`crrange`,
        `crflag`,`uric`,`stat_uric`,`reason_uric`,`uricrange`,`uricflag`,
        `chol`,`stat_chol`,`reason_chol`,`cholrange`,`cholflag`,`tg`,
        `stat_tg`,`reason_tg`,`tgrange`,`tgflag`,`sgot`,`stat_sgot`,
        `reason_sgot`,`sgotrange`,`sgotflag`,`sgpt`,`stat_sgpt`,`reason_sgpt`,
        `sgptrange`,`sgptflag`,`alk`,`stat_alk`,`reason_alk`,`alkrange`,
        `alkflag`,`general`,`reason_general`,`pap`,`reason_pap`,`other1`,
        `stat_other1`,`reason_other1`,`other2`,`stat_other2`,`reason_other2`,`dx`,
        `clinic`,`cigarette`,`alcohol`,`summary`,`diag`,`soldier1`,
        `reason_sol1`,`soldier2`,`reason_sol2`,`soldier3`,`reason_sol3`,`soldier4`,
        `reason_sol4`,`soldier5`,`reason_sol5`,`soldier6`,`reason_sol6`,`soldier7`,
        `reason_sol7`,`soldier8` ,`reason_sol8`,`soldier9`,`reason_sol9`,`soldier10`,
        `reason_sol10`,`status_dr`,`yearcheck`,
        `sol1`,`sol2`,`sol3`,`sol4`,`sol41`,`sol5`,
        `sol51`,`sum1`,`sum2`,`rs_sum21`,`rs_sum22`,`rs_sum23`,
        `rs_sum24`,`rs_sum25`,`sum3`,`sum4`,`sum5`,`rs_sum51`,
        `rs_sum52`,`rs_sum53`,`sum6`,`rs_sum61`,`anemia`,`cirrhosis`,
        `hepatitis`,`cardiomegaly`,`allergy`,`gout`,`waistline`,`asthma`,
        `muscle`,`ihd`,`thyroid`,`heart`,`emphysema`,`herniated`,
        `conjunctivitis`,`cystitis`,`epilepsy`,`fracture`,`cardiac`,`spine`,
        `dermatitis`,`degeneration`,`alcoholic`,`copd`,`bph`,`kidney`,
        `pterygium`,`tonsil`,`paralysis`,`blood`,`conanemia`,`ht`,
        `stat_pressure`,`reason_pressure`,`stat_bmi`,`reason_bmi`) 
    VALUES (
        '".$date_now."','".$date_hn."','".$date_vn."','".$dx['hn']."','".$dx['vn']."','".$dx['ptname']."',
        '".$dx['age']."','".$dx['camp']."','".$dx['camp_until']."','".$dx['height']."','".$dx['weight']."','".$dx['round_']."',
        '".$dx['temperature']."','".$dx['pause']."','".$dx['rate']."','".$_POST['bmi']."','".$dx['bp1']."','".$dx['bp2']."',
        '".$dx['drugreact']."','".$dx['prawat']."','".$dx['congenital_disease']."','".$dx['type']."','".$dx['organ']."','".$_POST['doctorn']."',
        '".$dx['ua_color']."','".$dx['ua_appear']."','".$dx['ua_spgr']."','".$dx['ua_phu']."','".$dx['ua_bloodu']."','".$dx['ua_prou']."',
        '".$dx['ua_gluu']."','".$dx['ua_ketu']."','".$dx['ua_urobil']."','".$dx['ua_bili']."','".$dx['ua_nitrit']."','".$dx['ua_wbcu']."',
        '".$dx['ua_rbcu']."','".$dx['ua_epiu']."','".$dx['ua_bactu']."','".$dx['ua_yeast']."','".$dx['ua_mucosu']."','".$dx['ua_amopu']."',
        '".$dx['ua_castu']."','".$dx['ua_crystu']."','".$dx['ua_otheru']."','".$_POST['normal']."','".$_POST['ch']."','".$dx['cbc_wbc']."',
        '".$_POST['normal32']."','".$_POST['ch32']."','".$dx['wbcrange']."','".$dx['wbcflag']."','".$dx['cbc_rbc']."','".$dx['cbc_hb']."',
        '".$dx['cbc_hct']."','".$_POST['normal31']."','".$_POST['ch31']."','".$dx['hctrange']."','".$dx['hctflag']."','".$dx['cbc_mcv']."',
        '".$dx['cbc_mch']."','".$dx['cbc_mchc']."','".$dx['cbc_pltc']."','".$_POST['normal33']."','".$_POST['ch33']."','".$dx['pltcrange']."',
        '".$dx['pltcflag']."','".$dx['cbc_plts']."','".$dx['cbc_neu']."','".$dx['cbc_lymp']."','".$dx['cbc_mono']."','".$dx['cbc_eos']."',
        '".$dx['cbc_baso']."','".$dx['cbc_band']."','".$dx['cbc_atyp']."','".$dx['cbc_nrbc']."','".$dx['cbc_rbcmor']."','".$dx['cbc_other']."',
        '".$_POST['normal81']."','".$_POST['ch81']."','".$_POST['normal51']."','".$_POST['ch51']."','".$dx['bs']."','".$_POST['normal47']."',
        '".$_POST['ch47']."','".$dx['bsrange']."','".$dx['bsflag']."','".$dx['bun']."','".$_POST['normal44']."','".$_POST['ch44']."',
        '".$dx['bunrange']."','".$dx['bunflag']."','".$dx['cr']."','".$_POST['normal45']."','".$_POST['ch45']."','".$dx['crrange']."',
        '".$dx['crflag']."','".$dx['uric']."','".$_POST['normal49']."','".$_POST['ch49']."','".$dx['uricrange']."','".$dx['uricflag']."',
        '".$dx['chol']."','".$_POST['normal46']."','".$_POST['ch46']."','".$dx['cholrange']."','".$dx['cholflag']."','".$dx['tg']."',
        '".$_POST['normal48']."','".$_POST['ch48']."','".$dx['tgrange']."','".$dx['tgflag']."','".$dx['sgot']."','".$_POST['normal41']."',
        '".$_POST['ch41']."','".$dx['sgotrange']."','".$dx['sgotflag']."','".$dx['sgpt']."','".$_POST['normal42']."','".$_POST['ch42']."',
        '".$dx['sgptrange']."','".$dx['sgptflag']."','".$dx['alk']."','".$_POST['normal43']."','".$_POST['ch43']."','".$dx['alkrange']."',
        '".$dx['alkflag']."','".$_POST['normal20']."','".$_POST['ch20']."','".$_POST['normal52']."','".$_POST['ch52']."','".$_POST['other1']."',
        '".$_POST['normal53']."','".$_POST['ch53']."','".$_POST['other2']."','".$_POST['normal54']."','".$_POST['ch54']."','".$_POST['dx']."',
        '".$dx['clinic']."','".$dx['cigarette']."','".$dx['alcohol']."','".$_POST['normal71']."','".$txtsm."','".$_POST['normal21']."','".$_POST['text21']."',
        '".$_POST['normal22']."','".$_POST['text22']."','".$_POST['normal23']."','".$_POST['text23']."','".$_POST['normal24']."','".$_POST['text24']."',
        '".$_POST['normal25']."','".$_POST['text25']."','".$_POST['normal26']."','".$_POST['text26']."','".$_POST['normal27']."','".$_POST['text27']."',
        '".$_POST['normal28']."','".$_POST['text28']."','".$_POST['normal29']."','".$_POST['text29']."','".$_POST['normal30']."','".$_POST['text30']."',
        'Y','".$nPrefix."','".$_POST['normal91']."','".$_POST['normal92']."','".$_POST['normal93']."','".$_POST['normal94']."',
        '".$_POST['normal941']."','".$_POST['normal95']."','".$_POST['normal951']."','".$_POST['normal61']."','".$_POST['normal62']."','".$rs_sum21."',
        '".$rs_sum22."','".$rs_sum23."','".$rs_sum24."','".$rs_sum25."','".$_POST['normal63']."','".$_POST['normal64']."',
        '".$_POST['normal65']."','".$rs_sum51."','".$rs_sum52."','".$rs_sum53."','".$_POST['normal66']."','".$rs_sum61."',
        '".$_POST['anemia']."','".$_POST['cirrhosis']."','".$_POST['hepatitis']."','".$_POST['cardiomegaly']."','".$_POST['allergy']."','".$_POST['gout']."',
        '".$_POST['waistline']."','".$_POST['asthma']."','".$_POST['muscle']."','".$_POST['ihd']."','".$_POST['thyroid']."','".$_POST['heart']."',
        '".$_POST['emphysema']."','".$_POST['herniated']."','".$_POST['conjunctivitis']."','".$_POST['cystitis']."','".$_POST['epilepsy']."','".$_POST['fracture']."',
        '".$_POST['cardiac']."','".$_POST['spine']."','".$_POST['dermatitis']."','".$_POST['degeneration']."','".$_POST['alcoholic']."','".$_POST['copd']."',
        '".$_POST['bph']."','".$_POST['kidney']."','".$_POST['pterygium']."','".$_POST['tonsil']."','".$_POST['paralysis']."','".$_POST['blood']."',
        '".$_POST['conanemia']."','".$_POST['ht']."','".$_POST['normal55']."','".$_POST['ch55']."','".$_POST['normal56']."','".$_POST['ch56']."'
    )";

    $dx_insert = $db->insert($sql);

    // $sql = "UPDATE `lab_pretest` SET `checked` = 'y' WHERE `hn` = '$hn' AND `part` = '�١��ҧ61' LIMIT 1 ";
    // $db->update($sql);

    $msg = '�ѹ�֡���������º����<br>��ѧ�ҡ�����ʵԡ��������ö�Դ˹�ҹ����ѹ��';
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }

    redirect('doctor_pre_chk_print.php?hn='.$hn.'&vn='.$vn.'&date='.$curr_date, $msg);
    exit;
}

// include 'dt_menu.php';
// dump($_GET);
session_unregister("list_bill");
session_register("list_bill");

$_SESSION['list_bill'] = '';
// $vn = $_SESSION['vn_now']; //vn
// $hn = $_SESSION['hn_now'];
$vn = $_GET['vn'];
$hn = $_GET['hn'];

$_SESSION['dt_doctor'] = $_SESSION['sOfficer'];
if( isset($_SESSION['doctor']) ){
    $_SESSION['dt_doctor'] = $_SESSION['doctor'];
}

$date_now = date("Y-m-d H:i:s");
// $date_hn = date('d-m-').( date('Y') + 543 ).$hn;
$date_hn = date('Y-m-d').$hn;


$sql = "SELECT a.*,
b.`idcard`, b.`blood`,b.`yot`,b.`name`,b.`surname`,b.`address`,b.`tambol`,b.`ampur`,b.`changwat`,b.`sex`
FROM `dxofyear_out` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`hn` = '$hn' 
ORDER BY `row_id` DESC LIMIT 1";
$db->select($sql);
$opd = $db->get_item();
$year_checkup = $opd['yearchk'];

$bp1 = $opd['bp1'];
$bp2 = $opd['bp2'];

if( !empty($opd['bp21']) ){
    $bp1 = $opd['bp21'];
}

if( !empty($opd['bp22']) ){
    $bp2 = $opd['bp22'];
}

// �֧�ѹ������Ǩ lab �Ѻ���ѹ������Ѻ�������Ѻ��ԡ��
// $sql = "SELECT SUBSTRING(`orderdate`,1,10) AS `lab_opd`  
// FROM `resulthead` 
// WHERE `hn` = '$hn' 
// AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' 
// ORDER BY `autonumber` DESC 
// LIMIT 1 ";
// $db->select($sql);
// $res_head = $db->get_item();
// $lab_opd = $res_head['lab_opd'];


$cig_lists = array(0 => '����ٺ', 1 => '�ٺ', 2 => '���ٺ');
$cigok_lists = array(0 => '�����ҡ��ԡ', 1 => '��ҡ��ԡ');
$al_lists = array(0 => '������', 1 => '����', 2 => '�´���');
$drugreact_lists = array(0 => '�����', 1 => '��');

$type_lists = array('�Թ��','���ö��','�͹��','�ҵ�',);

?>
<style type="text/css">
table{
    border-collapse: collapse;
}
.chk_table{
    border-collapse: collapse;
    width: 100%;
    border: 2px solid #000000;
}
.chk_table .title{
    font-weight: bold;
    border-bottom: 2px solid #000000;
    background-color: #b9e3ae;
    text-align: center;
}

label{
    cursor: pointer;
}
.tb-title{
    font-weight: bold;
    text-align: right;
}
.tb-title:after{
    content: "\0020\003A\0020";
}
h1,h3,p{
    margin: 0;
    padding: 0;
}
.clean_data{
    color: blue;
    text-decoration: underline;
    cursor: pointer;
}
.cxr-selected{
    color:blue;
    cursor: pointer;
    text-decoration: underline;
}

</style>
<div>
    <a href="dt_emp_manual_index.php">��Ѻ�˹�� ���ҵ��HN </a>
</div>
<form action="doctor_pre_chk.php" method="post" id="formSubmit">
    <h2 align="center">�ѹ�֡�ŵ�Ǩ�آ�Ҿ��Сѹ�ѧ��</h2>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>�����ż�����</h3></td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="10%" class="tb-title">����-ʡ��</td>
                        <td width="15%"><?=$opd['ptname'];?></td>
                        <td width="10%" class="tb-title">HN</td>
                        <td width="15%"><?=$opd['hn'];?></td>
                        <td width="10%" class="tb-title">VN</td>
                        <td width="15%"><?=$opd['vn'];?></td>
                        <td width="10%" class="tb-title">����</td>
                        <td width="15%"><?=$opd['age'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">�Ţ�ѵû�ЪҪ�</td>
                        <td><?=$opd['idcard'];?></td>
                        <td class="tb-title">���˹ѡ</td>
                        <td><?=$opd['weight'];?> ��.</td>
                        <td class="tb-title">��ǹ�٧</td>
                        <td><?=$opd['height'];?> ��.</td>
                        <td class="tb-title">BP</td>
                        <td><?=$bp1.'/'.$bp2;?> mmHg</td>
                    </tr>
                    <tr>
                        <td class="tb-title">T</td>
                        <td><?=$opd['temperature'];?> &#8451;</td>
                        <td class="tb-title">P</td>
                        <td><?=$opd['pause'];?> ����/�ҷ�</td>
                        <td class="tb-title">R</td>
                        <td><?=$opd['rate'];?> ����/�ҷ�</td>
                        <td class="tb-title">�������ʹ</td>
                        <td><?=$opd['blood'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">�ä��Шӵ��</td>
                        <td><?=$opd['congenital_disease'];?></td>
                        <td class="tb-title">�ٺ������</td>
                        <td>
                            <?php
                            $cig_code = $opd['cigarette'];
                            echo $cig_lists[$cig_code];

                            if( !empty($opd['cigarette']) ){
                                $cigok_code = $opd['cigok'];
                                echo ' ('.$cigok_lists[$cigok_code].')';
                            }
                            ?>
                        </td>
                        <td class="tb-title">��������</td>
                        <td>
                            <?php 
                            $al_code = $opd['alcohol'];
                            echo $al_lists[$al_code];
                            ?>
                        </td>
                        <td class="tb-title">����</td>
                        <td>
                            <?php 
                            $react_code = $opd['drugreact'];
                            echo $drugreact_lists[$react_code];
                            ?>
                        </td>
                    </tr>
                    <tr>
                    
                        <td class="tb-title">�ѡɳм�����</td>
                        <td><?=$opd['type'];?></td>
                        <td class="tb-title">�ҡ��</td>
                        <td><?=$opd['organ'];?></td>
                        <td class="tb-title">BMI</td>
                        <td>
                            <?php 
                            $ht = $opd["height"] / 100;
                            $bmi = number_format(($opd["weight"]/($ht*$ht)),2);

                            $bmi_abnormal = '';
                            if($bmi < 18.5 && $bmi > 22.99){
                                $bmi_abnormal = 'style="font-weight: bold; color: red;"';
                            }

                            ?>
                            <span <?=$bmi_abnormal;?>><?=$bmi;?></span>
                        </td>
                        <td class="tb-title">�͡���ѧ���</td>
                        <td>
                            <?php 
                            $exercise_list = array('������͡���ѧ���','�͡���ѧ��� ��ӡ���ࡳ��','�͡���ѧ��� ���ࡳ��');
                            $exercise = $opd["exercise"];
                            ?>
                            <?=$exercise_list[$exercise];?>
                        </td>
                    </tr>
                </table>
                <br>
                <!-- �����ŷ���������������Ѻ ��§ҹ����ºؤ�� -->
                <table width="100%" align="left">
                    <tr>
                        <td class="tb-title" width="10%">��Ҥ����ѹ</td>
                        <td>


                            <?php 
                            // ���� 
                            $pres_normal = '';
                            if( ( $bp1 > 0 && $bp1 < 129 ) && ( $bp2 >0 && $bp2 < 89 ) ){
                                $pres_normal = 'checked="checked"';
                            }

                            $pres_abnormal = '';
                            if( ( $bp1 >= 130 && $bp2 >= 90 ) || ( $bp1 >= 129 && $bp2 <= 89 ) || ( $bp1 <= 129 && $bp2 >= 89 ) ){
                                $pres_abnormal = 'checked="checked"';
                            }

                            ?>

                            <input type="radio" id="pres_normal" name="normal55" value="����" <?=$pres_normal;?> >
                            <label for="pres_normal">
                                ����
                            </label>

                            <input type="radio" id="pres_abnormal" name="normal55" value="�Դ����" <?=$pres_abnormal;?> >
                            <label for="pres_abnormal">
                                �Դ����
                            </label>
                            
                            <?php 
                            $style_press = 'style="display: none;"';
                            if( !empty($pres_abnormal) ){
                                $style_press = '';
                            }
                            ?>
                            <select name="ch55" id="pres_extra" <?=$style_press;?> >
                                <option value="�����ѹ���Ե ��ͺ�٧ PRE-HT" <? if($bp1 >= 135 && $bp1 <= 139){ echo "selected='selected';";}?>>�����ѹ���Ե ��ͺ�٧ PRE-HT</option>
                                <option value="��ҹ�դ����ѹ���Ե�٧ ��õ�ͧ�Ǻ�����������ҧ��觤�Ѵ ��੾������÷�������������͡���ѧ���" <? if(($bp1 >=140 && $bp2 >= 90) || ($bp1 >=140 && $bp2 <= 90) || ($bp1 <=140 && $bp2 >= 90)){ echo "selected='selected';";}?>>��ҹ�դ����ѹ���Ե�٧ ��õ�ͧ�Ǻ�����������ҧ��觤�Ѵ ��੾������÷�������������͡���ѧ���</option>
                            </select>

                            
                        </td>
                    </tr>
                    <tr>
                        <td class="tb-title">��� BMI</td>
                        <td>
                            <?php
                            
                            $bmi_normal_checked = '';
                            if( empty($bmi_abnormal) ){
                                $bmi_normal_checked = 'checked="checked"';
                            }
                            ?>
                            <input type="radio" id="bmi_normal" name="normal56" value="����" <?=$bmi_normal_checked;?>>
                            <label for="bmi_normal">
                                ����
                            </label>
                            
                            <?php
                            $bmi_abnormal_checked = 'checked="checked"';
                            if( empty($bmi_abnormal) ){
                                $bmi_abnormal_checked = '';
                            }
                            ?>
                            <input type="radio" id="bmi_abnormal" name="normal56" value="�Դ����" <?=$bmi_abnormal_checked;?>>
                            <label for="bmi_abnormal">
                                �Դ����
                            </label>
                            
                            <?php 
                            $style_bmi = 'style="display: none;"';
                            if( !empty($bmi_abnormal) ){
                                $style_bmi = '';
                            }
                            ?>
                            <select name="ch56" id="bmi_extra" <?=$style_bmi;?> >
                                <option value="��ҹ�չ��˹ѡ�����Թ�" <?php if($bmi < 18.5){ echo "selected='selected';";}?>>��ҹ�չ��˹ѡ�����Թ�</option>
                                <option value="��ҹ����������й��˹ѡ�Թ" <?php if($bmi >= 23 && $bmi <= 24.99){ echo "selected='selected';";}?>>��ҹ����������й��˹ѡ�Թ</option>
                                <option value="��ҹ�չ��˹ѡ�Թ����������ǹ" <? if($bmi >= 25 && $bmi <= 29.99){ echo "selected='selected';";}?>>��ҹ�չ��˹ѡ�Թ����������ǹ</option>
                                <option value="��ҹ��������ǹ��͹��ҧ�ҡ" <?php if($bmi >= 30 && $bmi <= 34.99){ echo "selected='selected';";}?>>��ҹ��������ǹ��͹��ҧ�ҡ</option>
                                <option value="��ҹ��������ǹ�ع�ç" <?php if($bmi >= 35){ echo "selected='selected';";}?>>��ҹ��������ǹ�ع�ç</option>            
                            </select>
                        
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="chk_table">
        <tr>
            <td class="title"><h3>�����ŷҧ��ͧ��Ժѵԡ��</h3></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">
                <?php

                // $year_checkup = '61';

                $sql = "SELECT b.`labcode`,b.`labname`,b.`result`,b.`normalrange`,b.`unit`,b.`flag`,SUBSTRING(b.`authorisedate`,1,10) AS `resultdate`
                FROM ( 

                    SELECT MAX(`autonumber`) AS `latest_number` 
                    FROM `resulthead` 
                    WHERE `hn` = '$hn' 
                    AND `profilecode` = 'CBC'
                    AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' 
                    GROUP BY `profilecode` 
                    ORDER BY `autonumber` ASC 

                ) AS a 
                    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
                WHERE b.`autonumber` = a.`latest_number` 
                AND ( b.`labcode` = 'HB' OR b.`labcode` = 'HCT' OR b.`labcode` = 'WBC' 
                OR b.`labcode` = 'NEU' OR b.`labcode` = 'LYMP' OR b.`labcode` = 'MONO' 
                OR b.`labcode` = 'EOS' OR b.`labcode` = 'BASO' OR b.`labcode` = 'PLTC' 
                OR b.`labcode` = 'RBC' ) 
                ORDER BY b.seq ASC";
                $db->select($sql);
                $cbc_items = $db->get_items();
                $extra = array();

                if( count($cbc_items) > 0 ){

                    ?>
                    <table width="100%">
                        <tr style="background-color: #e6e6e6; font-size: 18px;">
                            <th width="40%">��¡�õ�Ǩ CBC</th>
                            <th width="30%">�ŵ�Ǩ</th>
                            <th width="30%">��һ���</th>
                        </tr>
                        <?php
                        $result_cbc = '';
                        $result_date = '';
                        foreach ($cbc_items as $key => $cbc) {

                            $cbc_abnormal = '';
                            if( $cbc['flag'] == 'L' OR $cbc['flag'] == 'H' ){
                                $cbc_abnormal = 'style="font-weight: bold; color: red;"';
                            }

                            // ����Ѻ��ػ�ŵ�Ǩ
                            $lab_key = strtolower($cbc['labcode']) ;
                            if( $lab_key == 'hct' OR $lab_key == 'wbc' OR $lab_key == 'pltc' ){
                                $extra[$lab_key] = $cbc;
                            }

                            ?>
                            <tr>
                                <td><?=$cbc['labname'];?></td>
                                <td align="center" <?=$cbc_abnormal;?>><?=$cbc['result'];?></td>
                                <td align="center"><?=$cbc['normalrange'];?></td>
                            </tr>
                            <?php
                            $result_cbc = $cbc['autonumber'];

                            $result_date = $cbc['resultdate'];
                        }
                        ?>
                        
                    </table>
                    <?php 
                    // dump($extra);
                    ?>
                    <!-- ��ػ�š�õ�Ǩ ����Ѻ��§ҹ��ºؤ�� -->
                    <table width="100%">
                        <tr style="background-color: #e6e6e6; font-size: 18px;">
                            <th width="15%">��¡�õ�Ǩ</th>
                            <th width="15%" align="center">�ŵ�Ǩ</th>
                            <th width="15%" align="center">��һ���</th>
                            <th bgcolor="#abcea1">�š�õ�Ǩ</th>
                        </tr>

                        <tr>
                            <td>HCT: </td>
                            <td align="center"><?=$extra['hct']['result'];?></td>
                            <td align="center"><?=$extra['hct']['normalrange'];?></td>
                            <td bgcolor="#abcea1" style="font-weight: bold;">

                                <?php 
                                $hct_result = $extra['hct']['result'];
                                $res_hct = '';
                                $res_hct2 = '';
                                $style_res_hct = 'style="display: none;"';
                                
                                if( $hct_result >= 34 && $hct_result <= 49 ){
                                    $res_hct = 'checked="checked"';
                                    
                                }else{
                                    $res_hct2 = 'checked="checked"';
                                    $style_res_hct = '';
                                }
                                ?>
                                <label for="res_hct">
                                    <input type="radio" name="normal31" class="res_hct" id="res_hct" value="����" <?=$res_hct;?> onclick="click_hs(this, 'hct_extra', 'hide')"> ����
                                </label> 
                                <label for="res_hct2">
                                    <input type="radio" name="normal31" class="res_hct" id="res_hct2" value="�Դ����" <?=$res_hct2;?> onclick="click_hs(this, 'hct_extra', 'show')"> �Դ����
                                </label>
                                
                                <select id="hct_extra" name='ch31' <?=$style_res_hct;?>>
                                    <option value='���дѺ������ʹᴧ��ӡ��һ��� �觺͡�֧���Ыմ��õ�Ǩ��� ���� ��ᾷ�����������˵�' <?php if($hct_result < 37){ echo "selected='selected';";}?>>���дѺ������ʹᴧ��ӡ��һ��� �觺͡�֧���Ыմ��õ�Ǩ��� ���� ��ᾷ�����������˵�</option>
                                    <option value='���дѺ������ʹᴧ�٧���һ��� ��õ�Ǩ��� ���� ��ᾷ��' <?php if($hct_result > 49){ echo "selected='selected';";}?>>���дѺ������ʹᴧ�٧���һ��� ��õ�Ǩ������;�ᾷ��</option>
                                </select>

                            </td>
                        </tr>

                        <tr>
                            <td>WBC: </td>
                            <td align="center"><?=$extra['wbc']['result'];?></td>
                            <td align="center"><?=$extra['wbc']['normalrange'];?></td>
                            <td bgcolor="#abcea1" style="font-weight: bold;">

                                <?php 
                                $wbc_result = $extra['wbc']['result'];
                                $res_wbc = '';
                                $res_wbc2 = '';
                                $style_res_wbc = 'style="display: none;"';

                                // ����
                                if( ( $wbc_result >= 5 && $wbc_result <= 10 ) ){
                                    $res_wbc = 'checked="checked"';
                                    
                                }else{
                                    $res_wbc2 = 'checked="checked"';
                                    $style_res_wbc = '';
                                }

                                ?>
                                <label for="res_wbc">
                                    <input type="radio" name="normal32" class="res_wbc" id="res_wbc" value="����" <?=$res_wbc;?> onclick="click_hs(this, 'wbc_extra', 'hide')"> ����
                                </label> 
                                <label for="res_wbc2">
                                    <input type="radio" name="normal32" class="res_wbc" id="res_wbc2" value="�Դ����" <?=$res_wbc2;?> onclick="click_hs(this, 'wbc_extra', 'show')"> �Դ����
                                </label>

                                <select id="wbc_extra" name='ch32' <?=$style_res_wbc;?>>
                                    <option value='����ҳ������ʹ����դ�ҵ�ӡ��һ��� ��õ�Ǩ������;�ᾷ��' <? if($result_dx['cbc_wbc'] < 5){ echo "selected='selected';";}?>>����ҳ������ʹ����դ�ҵ�ӡ��һ��� ��õ�Ǩ������;�ᾷ��</option>
                                    <option value='����ҳ������ʹ���������дѺ�٧�Թ���� ��õ�Ǩ������;�ᾷ��' <? if($result_dx['cbc_wbc'] > 10){ echo "selected='selected';";}?>>����ҳ������ʹ���������дѺ�٧�Թ���� ��õ�Ǩ������;�ᾷ��</option>              
                                </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>PLTC: </td>
                            <td align="center"><?=$extra['pltc']['result'];?></td>
                            <td align="center"><?=$extra['pltc']['normalrange'];?></td>
                            <td bgcolor="#abcea1" style="font-weight: bold;">

                                <?php 
                                $pltc_result = $extra['pltc']['result'];
                                $res_pltc = '';
                                $res_pltc2 = '';
                                $style_res_pltc = 'style="display: none;"';

                                // ����
                                if( ( $pltc_result >= 140 && $pltc_result <= 400 ) ){
                                    $res_pltc = 'checked="checked"';
                                    
                                }else{
                                    $res_pltc2 = 'checked="checked"';
                                    $style_res_pltc = '';
                                }

                                ?>
                                <label for="res_pltc">
                                    <input type="radio" name="normal33" class="res_pltc" id="res_pltc" value="����" <?=$res_pltc;?> onclick="click_hs(this, 'plct_extra', 'hide')"> ����
                                </label> 
                                <label for="res_pltc2">
                                    <input type="radio" name="normal33" class="res_pltc" id="res_pltc2" value="�Դ����" <?=$res_pltc2;?> onclick="click_hs(this, 'plct_extra', 'show')"> �Դ����
                                </label>
                                <select name='ch33' id="plct_extra" <?=$style_res_pltc;?>>
                                    <option value='����ҳ������ʹ�դ�ҵ�ӡ��һ��� ��õ�Ǩ������;�ᾷ��' <? if($result_dx['cbc_pltc'] < 140){ echo "selected='selected';";}?>>����ҳ������ʹ�դ�ҵ�ӡ��һ��� ��õ�Ǩ������;�ᾷ��</option>
                                    <option value='����ҳ������ʹ�դ���٧�Թ���� ��õ�Ǩ������;�ᾷ��' <? if($result_dx['cbc_pltc'] > 400){ echo "selected='selected';";}?>>����ҳ������ʹ�դ���٧�Թ���� ��õ�Ǩ������;�ᾷ��</option>      
                                </select>
                            </td>
                        </tr>

                    </table>

                    <table width="100%">
                    <tr bgcolor="#abcea1" style="font-weight: bold;">
                            <td width="40%">��ػ�š�õ�Ǩ CBC (������ѹ��� <?=$result_date;?>)</td>
                            <td>
                                <label for="res_cbc">
                                    <input type="radio" name="res_cbc" class="res_cbc" id="res_cbc" value="1"> ����
                                </label> 
                                <label for="res_cbc2">
                                    <input type="radio" name="res_cbc" class="res_cbc" id="res_cbc2" value="2"> �Դ����
                                </label>
                            </td>
                            <td></td>
                        </tr>   
                    </table>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <tr>
            <td valign="top">
                <?php
                $sql = "SELECT b.*, SUBSTRING(b.`authorisedate`,1,10) AS `resultdate`
                FROM ( 

                    SELECT MAX(`autonumber`) AS `latest_number` 
                    FROM `resulthead` 
                    WHERE `hn` = '$hn' 
                    AND `profilecode` = 'UA'
                    AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' 
                    GROUP BY `profilecode` 
                    ORDER BY `autonumber` ASC 

                ) AS a 
                    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
                WHERE b.`autonumber` = a.`latest_number` 
                AND ( b.`labcode` = 'SPGR' OR b.`labcode` = 'PHU' OR b.`labcode` = 'GLUU' 
                OR b.`labcode` = 'PROU' 
                OR b.`labcode` = 'RBCU' OR b.`labcode` = 'WBCU' OR b.`labcode` = 'EPIU' 
                OR b.`labcode` = 'BLOODU' OR b.`labcode` = 'KETU' ) 
                ORDER BY b.seq ASC";
                $db->select($sql);
                $ua_items = $db->get_items();

                if ( count($ua_items) > 0 ) {
                    ?>
                    <table  width="100%">
                        <tr style="background-color: #e6e6e6; font-size: 18px;">
                            <th width="40%">��¡�õ�Ǩ UA</th>
                            <th width="30%">�ŵ�Ǩ</th>
                            <th width="30%">��һ���</th>
                        </tr>
                        <?php
                        $result_ua = '';
                        $result_date = '';
                        foreach ($ua_items as $key => $ua) {

                            $ua_abnormal = '';
                            if( $ua['flag'] == 'L' OR $ua['flag'] == 'H' ){
                                $ua_abnormal = 'style="font-weight: bold; color: red;"';
                            }

                            ?>
                            <tr>
                                <td><?=$ua['labname'];?></td>
                                <td align="center" <?=$ua_abnormal;?>><?=$ua['result'];?></td>
                                <td align="center"><?=$ua['normalrange'];?></td>
                            </tr>
                            <?php
                            $result_ua = $ua['autonumber'];
                            $result_date = $ua['resultdate'];
                        }
                        ?>
                        <tr bgcolor="#abcea1" style="font-weight: bold;">
                            <td>��ػ�š�õ�Ǩ UA (������ѹ��� <?=$result_date;?>)</td>
                            <td>
                                <label for="res_ua">
                                    <input type="radio" name="res_ua" class="res_ua" id="res_ua" value="1"> ����
                                </label> 
                                <label for="res_ua2">
                                    <input type="radio" name="res_ua" class="res_ua" id="res_ua2" value="2"> �Դ����
                                </label>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    <?php
                }
                ?>
            </td>
        </tr>
        <tr><td>&nbsp;</td></tr>
        <?php

        $sql = "SELECT b.* 
        FROM ( 

            SELECT MAX(`autonumber`) AS `latest_number` 
            FROM `resulthead` 
            WHERE `hn` = '$hn' 
            AND ( `profilecode` != 'CBC' AND `profilecode` != 'UA' ) 
            AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' 
            GROUP BY `profilecode` 
            ORDER BY `autonumber` ASC 

        ) AS a 
            RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
        WHERE b.`autonumber` = a.`latest_number` 
        AND ( 
            b.`labcode` = 'GLU' 
            OR b.`labcode` = 'CREA' 
            OR b.`labcode` = 'CHOL' 
            OR b.`labcode` = 'HDL' 
            OR b.`labcode` = 'HBSAG' 
            OR b.`labcode` = 'OCCULT' 
            OR b.`labcode` = '38302' 
            OR b.`labcode` = 'STOCC' 
        ) 
        ORDER BY b.seq ASC ";

        $db->select($sql);
        $etc_rows = $db->get_rows();
        if( $etc_rows > 0 ){
            $etc_items = $db->get_items();
            ?>
            <tr>
                <td>
                    <table width="100%">
                        <tr style="background-color: #e6e6e6; font-size: 18px;">
                            <th>��¡�õ�Ǩ����</th>
                            <th align="center">�ŵ�Ǩ</th>
                            <th align="center">��һ���</th>
                            <th bgcolor="#abcea1">�š�õ�Ǩ</th>
                        </tr>
                        <?php
                        foreach ($etc_items as $key => $etc) {

                            $labcode = strtolower($etc['labcode']);

                            $etc_abnormal = '';
                            if( $etc['flag'] == 'L' OR $etc['flag'] == 'H' ){
                                $etc_abnormal = 'style="font-weight: bold; color: red;"';
                            }

                            if( ( $labcode == 'occult' OR $labcode == 'hbsag' ) && $etc['result'] == 'Positive' ){
                                $etc_abnormal = 'style="font-weight: bold; color: red;"';
                            }

                            ?>
                            <tr>
                                <td><?=$etc['labname'];?></td>
                                <td align="center" <?=$etc_abnormal;?>><?=$etc['result'];?></td>
                                <td align="center"><?=$etc['normalrange'];?></td>
                                <td bgcolor="#abcea1" style="font-weight: bold;">
                                    <label for="res_<?=$labcode;?>">
                                        <input type="radio" name="res_<?=$labcode;?>" class="res_<?=$labcode;?>" id="res_<?=$labcode;?>" value="1"> ����
                                    </label> 
                                    <label for="res_<?=$labcode;?>2">
                                        <input type="radio" name="res_<?=$labcode;?>" class="res_<?=$labcode;?>" id="res_<?=$labcode;?>2" value="2"> �Դ����
                                    </label>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>

                    </table>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <br>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>�������آ�Ҿ</h3></td>
        </tr>
        <tr>
            <td width="25%" class="tb-title">��äѴ��ͧ������Թ</td>
            <td>
                <label for="ear1"><input type="radio" name="ear" id="ear1" value="1"> ���� </label>
                <label for="ear2"><input type="radio" name="ear" id="ear2" value="2"> �Դ���� </label>
                <span class="clean_data" onclick="clean_data(['ear1','ear2']);">��ҧ������</span>
            </td>
        </tr>
        <?php
        if( $opd['sex'] == '�' ){
        ?>
        <tr>
            <td class="tb-title">��õ�Ǩ��ҹ���ᾷ��<br>���ͺؤ�ҡ��Ҹ�ó�آ</td>
            <td>
                <label for="breast1"><input type="radio" name="breast" id="breast1" value="1"> ���� </label>
                <label for="breast2"><input type="radio" name="breast" id="breast2" value="2"> �Դ���� </label>
                <span class="clean_data" onclick="clean_data(['breast1','breast2']);">��ҧ������</span>
            </td>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td class="tb-title">��õ�Ǩ���¤������Ţͧ�ѡ��ᾷ��</td>
            <td>
                <label for="eye1"><input type="radio" name="eye" id="eye1" value="1"> ���� </label>
                <label for="eye2"><input type="radio" name="eye" id="eye2" value="2"> �Դ���� </label>
                <span class="clean_data" onclick="clean_data(['eye1','eye2']);">��ҧ������</span>
            </td>
        </tr>
        <tr>
            <td class="tb-title">��õ�Ǩ�Ҵ��� Snellen eye Chart</td>
            <td>
                <label for="snell_eye1"><input type="radio" name="snell_eye" id="snell_eye1" value="1"> ���� </label>
                <label for="snell_eye2"><input type="radio" name="snell_eye" id="snell_eye2" value="2"> �Դ���� </label>
                <span class="clean_data" onclick="clean_data(['snell_eye1','snell_eye2']);">��ҧ������</span>
            </td>
        </tr>
        <tr>
            <td class="tb-title">Chest X-ray <a href="http://pacssrsh/explore.asp?path=/All%20Patients/InternalPatientUID=<?=$hn;?>" target="_blank">�ټš�õ�Ǩ</a> </td>
            <td>
                <label for="cxr1"><input type="radio" name="cxr" class="cxr" id="cxr1" value="1"> ���� </label>
                <label for="cxr2"><input type="radio" name="cxr" class="cxr" id="cxr2" value="2"> �Դ���� </label>
                <input type="text" name="cxr_detail" id="cxr_detail" size="40">
            </td>
        </tr>
        <?php 
        $yearchk = get_year_checkup();
        // ����ա��ŧ�Ũҡ chk_cxr_doctor.php �ͧ�����Է
        $sql = "SELECT * FROM `chk_cxr` WHERE `hn` = '$hn' AND `year_chk` = '$yearchk' ";
        $db->select($sql);
        if( $db->get_rows() > 0 ){
            $user = $db->get_item();
            ?>
            <tr>
                <td class="tb-title">�š�õ�Ǩ�ҡ�ѧ��ᾷ��</td>
                <td>
                    <?=$user['cxr'].' '.$user['detail'];?> <span class="cxr-selected" data-result="<?=$user['cxr'];?>" data-detail="<?=$user['detail'];?>">��ԡ�����</span> �����׹�ѹ����ѧ��ᾷ��
                </td>
            </tr>
            <?php 
        }
        ?>
    </table>
    <br>
    <style type="text/css">
    .normal, .abnormal, .norm-sugges{
        display: none;
    }
    table.calendar{
        font-size: 1.2em!important;
    }
    </style>
    <table class="chk_table">
        <tr>
            <td colspan="4" class="title"><h3>��ػ�š�õ�Ǩ��С�ô��Թ�ҹ</h3></td>
        </tr>
        <tr valign="top">
            <td width="15%" class="tb-title" style="border-bottom: 1px solid #000;">�š�õ�Ǩ</td>
            <td style="border-left: 1px solid #000;border-bottom: 1px solid #000;">
                <label for="conclution1">
                    <input type="radio" name="conclution" class="conclution" id="conclution1" value="1"> ���� 
                </label>
            </td>
            <td style="border-left: 1px solid #000;border-bottom: 1px solid #000;" colspan="2">
                <label for="conclution2">
                    <input type="radio" name="conclution" class="conclution" id="conclution2" value="2"> �Դ���� 
                </label>
            </td>
        </tr>
        <tr valign="top">
            <td class="tb-title">���й�</td>
            <td style="border-left: 1px solid #000; border-bottom: 1px solid #000;">
                <input type="radio" name="normal_suggest" class="suggest_detail cleardate" id="normal_suggest2" value="1">
                <label for="normal_suggest2" class="cleardate"> ����������й� </label>
            </td>
            <td style="border-left: 1px solid #000; border-bottom: 1px solid #000;" colspan="2">
                <input type="radio" name="abnormal_suggest" class="suggest_detail cleardate" id="abs0" value="1"> <label for="abs0" class="cleardate"> ����������й� </label>
            </td>
        </tr>
        
        <tr valign="top">
            <td></td>
            <td style="border-left: 1px solid #000;">
                <input type="radio" name="normal_suggest" class="suggest_detail cleardate"  id="normal_suggest1" value="2">
                <label for="normal_suggest1">�й�����Ѻ��õ�Ǩ������ͧ <br>���駵�����ѹ��� </label>
                <input type="text" name="normal_suggest_date" id="normal_suggest_date">
            </td>
            <td style="border-left: 1px solid #000;">
                <input type="radio" name="abnormal_suggest" class="suggest_detail" id="abs1" value="2"> <label for="abs1"> �����й�㹡�õ�Ǩ�Դ���/��Ǩ��� ���駵���</label><br>
                <input type="radio" name="abnormal_suggest" class="suggest_detail" id="abs2" value="3"> <label for="abs2"> �����й�����Ѻ����ѡ�ҡó��纻����¹Ѵ����Ѻ��ԡ��</label><br>
                <input type="radio" name="abnormal_suggest" class="suggest_detail" id="abs3" value="4"> <label for="abs3"> �����й�����ѡ����ѡ�ҡó������á��͹�ҡ�ä������ѧ</label><br>
            </td>
            <td style="border-left: 1px solid #000;" valign="middle">
                ��ѹ��� <input type="text" name="abnormal_suggest_date" id="abnormal_suggest_date">
            </td>
        </tr>
    </table>

<br>

<table width="100%" class="chk_table">
    <tbody>
        <tr>
            <td bgcolor="" colspan="5" class="title">
                <h3>�������ä</h3>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                $disease = array(
                    'anemia' => '���Ե�ҧ (Anemia)',
                    'cirrhosis' => '�Ѻ�� (Cirrhosis)',
                    'hepatitis' => '�ä�Ѻ�ѡ�ʺ (Hepatitis)',
                    'cardiomegaly' => '�����',
                    'allergy' => '������',
                    'gout' => '�ä��ҷ�',
                    'waistline' => '�ͺ����Թ (��� &gt; 90 �.�.,˭ԧ &gt; 80 �.�.)',
                    'asthma' => '�ͺ�״ (Asthma)',
                    'muscle' => '����������ѡ�ʺ',
                    'ihd' => '�ä���㨢Ҵ���ʹ������ѧ (IHD)',
                    'thyroid' => '���´�',
                    'heart' => '�ä����',
                    'emphysema' => '�ا���觾ͧ',
                    'herniated' => '��͹�ͧ��д١�Ѻ��鹻���ҷ',
                    'conjunctivitis' => '����ͺص��ѡ�ʺ (Conjunctivitis)',
                    'cystitis' => '�����л�������ѡ�ʺ (Cystitis)',
                    'epilepsy' => '���ѡ (Epilepsy)',
                    'fracture' => '��д١�ѡ����͹',
                    'cardiac' => '�����鹼Դ�ѧ��� (Cardiac arrhythmia)',
                    'spine' => '��д١�ѹ��ѧ (͡) ��',
                    'dermatitis' => '���˹ѧ�ѡ�ʺ',
                    'degeneration' => '������������',
                    'alcoholic' => '�����Դ���Ԩҡ��š�����',
                    'copd' => 'COPD',
                    'bph' => 'BPH',
                    'kidney' => '䵼Դ����',
                    'pterygium' => '�������',
                    'tonsil' => '�����͹����',
                    'paralysis' => '����ҵ�ա����/���',
                    'blood' => '������ʹ�Դ����',
                    'conanemia' => '���Ыմ',
                    'ht' => '�����ѹ���Ե�٧'
                );
                ?>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="">
                    <tbody>
                        
                        <?php 
                        $i = 0;

                        foreach ($disease as $key => $item) {

                            ++$i;

                            if( $i == 1 ){ echo "<tr>"; }

                            ?>
                            <td width="30%">
                                <input type="checkbox" name="<?=$key;?>" id="<?=$key;?>" value="Y">
                                <label for="<?=$key;?>"><?=$item;?></label>
                            </td>
                            <?php

                            if( $i % 3 == 0 ){
                                echo "</tr>";
                                $i = 0;
                            }

                            
                        }
                        ?>
                        
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>


    <br>
    <table class="chk_table">
        <tr>
            <td class="title" style="text-align: left;"><h3>�ѹ�֡����Թԩ�¨ҡᾷ��</h3></td>
        </tr>
        <tr>
            <td>
                <textarea name="diag" id="" cols="60" rows="5"></textarea>
            </td>
        </tr>
    </table>
    <br>
    <div align="center">
        <button type="submit" id="submit-btn">�ѹ�֡������</button>

        <input type="hidden" name="dxofyear_id" value="<?=$opd['row_id'];?>">      

        <input type="hidden" name="action" value="save">
        <input type="hidden" name="hn" value="<?=$hn;?>">
        <input type="hidden" name="vn" value="<?=$vn;?>">
        <input type="hidden" name="idcard" value="<?=$opd['idcard'];?>">
        <input type="hidden" name="doctor" value="<?=$_SESSION['dt_doctor'];?>">
        <input type="hidden" name="cbc" value="<?=$result_cbc;?>">
        <input type="hidden" name="ua" value="<?=$result_ua;?>">

        <input type="hidden" name="bmi" value="<?=$bmi;?>">

        <input type="hidden" name="yot" value="<?=$opd['yot'];?>">
        <input type="hidden" name="name" value="<?=$opd['name'];?>">
        <input type="hidden" name="surname" value="<?=$opd['surname'];?>">

        <input type="hidden" name="sex" value="<?=$opd['sex'];?>">

        <?php
        $address = $opd['address'].' '.( !empty($opd['tambol']) ? '�.'.$opd['tambol'] : '' ).' '.( !empty($opd['ampur']) ? '�.'.$opd['ampur'] : '' ).' '.( !empty($opd['changwat']) ? '�.'.$opd['changwat'] : '' );
        ?>
        <input type="hidden" name="address" value="<?=$address;?>">
    </div>
</form>


<link type="text/css" href="epoch_styles.css" rel="stylesheet">
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">
    var popup1, popup2, popup3;
    window.onload = function() {
        popup1 = new Epoch('popup1','popup',document.getElementById('normal_suggest_date'),false);
        popup1 = new Epoch('popup2','popup',document.getElementById('abnormal_suggest_date'),false);
    };
</script>

<script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
    var click_hs;

    function clean_data(items){
        items.forEach(function(item) {
            document.getElementById(item).checked = false;
        });
    }

    $(function(){

        $(document).on('click', '#conclution1', function(){
            // $('.normal').show();
            // $('.abnormal').hide();

            clear_sub();
        });

        $(document).on('click', '#conclution2', function(){
            // $('.normal').hide();
            // $('.abnormal').show();
            
            clear_sub();
        });

        $(document).on('click', '.cleardate', function(){
            $('#normal_suggest_date').val('');
            $('#abnormal_suggest_date').val('');
            
        });

        function clear_sub(){
            $('#normal_suggest1').prop('checked', false);
            $('#normal_suggest2').prop('checked', false);
            
            $('#abs0').prop('checked', false);
            $('#abs1').prop('checked', false);
            $('#abs2').prop('checked', false);
            $('#abs3').prop('checked', false);
            
        }

        $(document).on('submit', '#formSubmit', function(){
            var res_cbc = $('.res_cbc').is(':checked');
            var res_ua = $('.res_ua').is(':checked');
            var cxr = $('.cxr').is(':checked');
            var conclution = $('.conclution').is(':checked');
            var suggest_detail = $('.suggest_detail').is(':checked');

            var res_glu = $('.res_glu').is(':checked');
            var res_crea = $('.res_crea').is(':checked');
            var res_chol = $('.res_chol').is(':checked');
            var res_hdl = $('.res_hdl').is(':checked');
            var res_hbsag = $('.res_hbsag').is(':checked');
            var res_occult = $('.res_occult').is(':checked');
            
            var ret_stat = true;
            
            if( $('.res_cbc').val() && res_cbc === false ){
                alert('��س����͡�š�õ�Ǩ CBC');
                ret_stat = false;

            }else if( $('.res_ua').val() && res_ua === false ){
                alert('��س����͡�š�õ�Ǩ UA');
                ret_stat = false;

            }else if( $('.res_glu').val() && res_glu === false ){
                alert('��س����͡�š�õ�Ǩ Blood Sugar');
                ret_stat = false;

            }else if( $('.res_crea').val() && res_crea === false ){
                alert('��س����͡�š�õ�Ǩ Creatinine');
                ret_stat = false;

            }else if( $('.res_chol').val() && res_chol === false ){
                alert('��س����͡�š�õ�Ǩ Cholesterol');
                ret_stat = false;

            }else if( $('.res_hdl').val() && res_hdl === false ){
                alert('��س����͡�š�õ�Ǩ HDL');
                ret_stat = false;

            }else if( $('.res_hbsag').val() && res_hbsag === false ){
                alert('��س����͡�š�õ�Ǩ HBsAg');
                ret_stat = false;

            }else if( $('.res_occult').val() && res_occult === false ){
                alert('��س����͡�š�õ�Ǩ ���ʹ��ب����');
                ret_stat = false;

            }else if( cxr === false ){
                alert('��س����͡�š�õ�Ǩ X-Ray');
                ret_stat = false;

            }else if( conclution === false ){
                alert('��س����͡��ػ�š�õ�Ǩ�آ�Ҿ');
                ret_stat = false;

            }else if( suggest_detail === false ){
                alert('��س����͡�����й�㹡�õ�Ǩ�آ�Ҿ');
                ret_stat = false;

            }

            return ret_stat;
        });



        $(document).on('click', '#pres_abnormal', function(){
            $('#pres_extra').show();
        });
        $(document).on('click', '#pres_normal', function(){
            $('#pres_extra').hide();
        });

        $(document).on('click', '#bmi_abnormal', function(){
            $('#bmi_extra').show();
        });
        $(document).on('click', '#bmi_normal', function(){
            $('#bmi_extra').hide();
        });
        
        
        // support only click event
        // E.g. click_hs('#from', '#target', 'hide')
        click_hs = function(btn, target, action){

            $(document).on('click', '#'+btn.id, function(){
                if( action == 'hide' ){
                    $('#'+target).hide();
                }else{
                    $('#'+target).show();
                }
            });
        }

        $(document).on('click', '.cxr-selected', function(){

            if( $(this).attr('data-result') == '����' ){
                $( "#cxr1" ).prop( "checked", true );

            }else if( $(this).attr('data-result') == '�Դ������硹���' || $(this).attr('data-result') == '�Դ���Ԥ�þ�ᾷ��' ){
                $( "#cxr2" ).prop( "checked", true );

            }

            var data_detail = $(this).attr('data-detail');
            $('#cxr_detail').val(data_detail);

        });

    });
</script>