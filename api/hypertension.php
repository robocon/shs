<?php
if (!defined('BASE_API')) {
    echo "Invalid Base Path";
    exit;
}
if($action==='saveHypertension'){
    $class_ht = new Hypertension();
    
    $postData = array();
    if(!empty($data['ht_no'])){
        $postData['ht_no'] = $data['ht_no'];
    }else{
        // สร้างเลข ht_no ใหม่
        $htNumber = $class_ht->newHtNumber();
        $postData['ht_no'] = $htNumber['ht_no'];
    }
    
    $postData['thidate'] = date('Y-m-d');
    $postData['hn'] = $data["ht_hn"];
    $postData['doctor'] = $data["ht_doctor"];
    $postData['ptname'] = $data["ht_ptname"];
    $postData['ptright'] = $data["ht_ptright"];
    $postData['sex'] = $data['ht_sex'];
    $postData['diagnosis'] = $data["ht_diag"];
    $postData['ht'] = $data['ht'];
    $postData['joint_disease_dm'] = $data['joint_disease_dm'];
    $postData['joint_disease_nephritic'] = $data['joint_disease_nephritic'];
    $postData['joint_disease_myocardial'] = $data['joint_disease_myocardial'];
    $postData['joint_disease_paralysis'] = $data['joint_disease_paralysis'];
    $postData['smork'] = $data['cigarette'];
    $postData['bmi'] = $data['ht_bmi'];
    $postData['height'] = $data['ht_height'];
    $postData['weight'] = $data['ht_weight'];
    $postData['round'] = $data['ht_round'];
    $postData['temperature'] = $data['ht_temp'];
    $postData['pause'] = $data['ht_pulse'];
    $postData['rate'] = $data['ht_rate'];
    $postData['bp1'] = $data['ht_bp1'];
    $postData['bp2'] = $data['ht_bp2'];
    $postData['officer'] = $_SESSION['sOfficer'];
    $postData['officer_edit'] = $_SESSION['sOfficer'];
    $postData['register_date'] = $data['register_date'];
    // $postData['pension'] = $rows['pension_status'];
    $postData['age_str'] = $data["ht_age"];
    $postData['diag_date'] = $data['diag_date'];
    $postData['bp3'] = $data['ht_bp3'];
    $postData['bp4'] = $data['ht_bp4'];
    $postData['ecgCxr'] = $data['ecgCxr'];
    $postData['dateEcgCxr'] = $data['dateEcgCxr'];
    $postData['albumin'] = $data['albumin'];
    $postData['dateAlbumin'] = $data['dateAlbumin'];
    $postData['albuminLabnumber'] = $data['albuminLabnumber'];
    $postData['creatinine'] = $data['creatinine'];
    $postData['dateCreatinine'] = $data['dateCreatinine'];
    $postData['creatinineLabnumber'] = $data['creatinineLabnumber'];
    
    $postData['joint_disease'] = 0;
    if( $data['joint_disease_dm'] OR $data['joint_disease_nephritic'] OR $data['joint_disease_myocardial'] OR $data['joint_disease_paralysis'] ){
        $postData['joint_disease'] = 1;
    }
    
    // เซ็ตค่าจาก $data ก่อนบันทึกหรืออัพเดท
    $class_ht->setHypertension_clinic($postData);

    $htResponse = array();
    if(empty($data['hypertension_id'])){
        $res = $class_ht->insert();

    }else{
        $class_ht->setRowId($data['hypertension_id']);
        $res = $class_ht->update();
        
    }
    $htResponse['hypertension'] = $res;

    
    $class_ht->setHn($data['ht_hn']);
    $screenHt = $class_ht->get_screen_ht();
    if($screenHt['error_code']==400){
        $class_ht->insert_screen_ht();
    }else{
        $class_ht->setRowId($screenHt['row_id']);
        $class_ht->update_screen_ht();
    }

    $res = $class_ht->getHtHistoryThisDay($data["hn"]);
    $hyperData = $class_ht->getOneFromHn($data["hn"]);
    if($res['error_code']==400){
        $class_ht->setDateN($hyperData['dateN']); // OVERRIDE dateN ตอนเซ็ตค่า setHypertension_clinic ก่อนที่จะบันทึก setHypertension_clinic
        $hisRes = $class_ht->insert_history();
    }else{
        $class_ht->setHistoryId($res['id']);
        $hisRes = $class_ht->update_history();
    }
    $htResponse['hypertension_history'] = $hisRes;

    echo $json->encode($htResponse);
    exit();
}