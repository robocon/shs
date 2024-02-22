<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = sprintf("%s", $_GET['id']);
$dxofyear_id = sprintf("%s", $_GET['dxofyear_id']);
$sql = "SELECT b.yot,b.name,b.surname,b.idcard,b.address,b.tambol,b.ampur,b.changwat,a.* FROM 
( 
    SELECT hn,vn,thidate,yearcheck,cxr,sum1,doctor,stat_cbc,stat_ua,stat_bs,stat_cr,stat_ldl,stat_ldlc,stat_hdl,stat_hbsag,stat_stocc,dx,reason_cxr,sol1 FROM condxofyear_out WHERE row_id = '$id' LIMIT 1
) AS a LEFT JOIN opcard AS b on b.hn = a.hn ";
$q = $dbi->query($sql);
if($q->num_rows>0){
    $a = $q->fetch_assoc();
    $hn = $a['hn'];
    $yearchk = $a['yearcheck'];

    $sqlChkDoctor = "SELECT row_id FROM chk_doctor WHERE yearchk='$yearchk' AND hn='$hn' ";
    $qChkDoctor = $dbi->query($sqlChkDoctor);
    if($qChkDoctor->num_rows>0){
        //update
        echo "มีข้อมูลอยู่แล้ว";

    }else{

        // dump($a);
        $vn = $a['vn'];
        $yot = $a['yot'];
        $name = $a['name'];
        $surname = $a['surname'];
        $idcard = $a['idcard'];

        $address = $a['address'];
        if(!empty($a['tambol'])){
            $address .= ' ต.'.$a['tambol'];
        }
        if(!empty($a['ampur'])){
            $address .= ' อ.'.$a['ampur'];
        }
        if(!empty($a['changwat'])){
            $address .= ' จ.'.$a['changwat'];
        }

        $date_chk = $a['thidate'];
        $yearchk = substr($a['yearcheck'], 2);
        $cxr = 1;
        if($a['cxr']=='ผิดปกติ'){
            $cxr = 2;
        }
        
        $sum1 = $a['sum1'];
        if(!empty($sum1) OR $sum1=='ปกติ'){
            $conclution = 1;
        }else{
            $conclution = 2;
        }

        $normal_suggest = 1;

        $pre_doctor = str_replace(array(' ', '  '), ' ', $a['doctor']);
        list($mdCode, $dtName, $dtSurname) = explode(' ', $pre_doctor);

        $qDt = $dbi->query("SELECT yot,doctorcode FROM doctor WHERE name LIKE '$mdCode%'");
        $dt = $qDt->fetch_assoc();

        $dtFullName = $dt['yot'].$dtName.' '.$dtSurname.' (ว.'.$dt['doctorcode'].')';
        
        $res_cbc = '';
        if($a['stat_cbc']=='ปกติ'){
            $res_cbc = 1;
        }elseif($a['stat_cbc']=='ผิดปกติ'){
            $res_cbc = 2;
        }
        
        $res_ua = '';
        if($a['stat_ua']=='ปกติ'){
            $res_ua = 1;
        }elseif($a['stat_ua']=='ผิดปกติ'){
            $res_ua = 2;
        }

        $res_glu = '';
        if($a['stat_bs']=='ปกติ'){
            $res_glu = 1;
        }elseif($a['stat_bs']=='ผิดปกติ'){
            $res_glu = 2;
        }
        
        $res_crea = '';
        if($a['stat_cr']=='ปกติ'){
            $res_crea = 1;
        }elseif($a['stat_cr']=='ผิดปกติ'){
            $res_crea = 2;
        }

        $res_chol = '';
        if($a['stat_ldl']=='ปกติ'){
            $res_chol = 1;
        }elseif($a['stat_ldl']=='ผิดปกติ'){
            $res_chol = 2;
        }
        
        $res_hdl = '';
        if($a['stat_hdl']=='ปกติ'){
            $res_hdl = 1;
        }elseif($a['stat_hdl']=='ผิดปกติ'){
            $res_hdl = 2;
        }

        $res_hbsag = '';
        if($a['stat_hbsag']=='ปกติ'){
            $res_hbsag = 1;
        }elseif($a['stat_hbsag']=='ผิดปกติ'){
            $res_hbsag = 2;
        }
        
        $res_occult = '';
        if($a['stat_stocc']=='ปกติ'){
            $res_occult = 1;
        }elseif($a['stat_stocc']=='ผิดปกติ'){
            $res_occult = 2;
        }
        
        $diag = $a['dx'];
        if(empty($diag)){
            $diag = substr($a['sol1'], 2);
        }
        $cxr_detail = $a['reason_cxr'];
        
        //insert
        $sqlChkDtInsert = "INSERT INTO `chk_doctor` (
            `id`, `hn`, `vn`, `prefix`, `name`, `surname`, 
            `idcard`, `address`, `date_chk`, `yearchk`, `ear`, `breast`, 
            `eye`, `snell_eye`, `cxr`, `conclution`, `normal_suggest`, `normal_suggest_date`, 
            `abnormal_suggest`, `abnormal_suggest_date`, `doctor`, `officer`, `res_cbc`, `res_ua`, 
            `res_glu`, `res_crea`, `res_chol`, `res_hdl`, `res_hbsag`, `res_occult`, 
            `diag`, `cxr_detail`, `dxofyear_out_id`
        ) VALUES (
            NULL, '$hn', '$vn', '$yot', '$name', '$surname', 
            '$idcard', '$address', '$date_chk', '$yearchk', '', '', 
            '', '', '$cxr', '$conclution', '$normal_suggest', '0000-00-00', 
            '', '0000-00-00', '$dtFullName', '$dtFullName', '$res_cbc', '$res_ua', 
            '$res_glu', '$res_crea', '$res_chol', '$res_hdl', '$res_hbsag', '$res_occult', 
            '$diag', '$cxr_detail', '$dxofyear_id'
        );";
        dump($sqlChkDtInsert);
        $saveChkDoctor = $dbi->query($sqlChkDtInsert);
        dump($saveChkDoctor);
    }
}else{
    dump($dbi->error);
}