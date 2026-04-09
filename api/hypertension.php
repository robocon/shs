<?php
if (!defined('BASE_API')) {
    echo "Invalid Base Path";
    exit;
}
if($action==='saveHypertension'){
    $class_hypertension = new Hypertension();

    if(!empty($data['ht_no'])){
        $postData['ht_no'] = $data['ht_no'];
    }else{
        // สร้างเลข ht_no ใหม่
        $htNumber = $class_hypertension->newHtNumber();
        $postData['ht_no'] = $htNumber['ht_no'];
    }
    
    $postData['thidate'] = date('Y-m-d');
    $postData['hn'] = $data["hn"];
    $postData['doctor'] = $data["ht_doctor"];
    $postData['ptname'] = $data["ptname"];
    $postData['ptright'] = $rows3["ptright"];
    $postData['sex'] = $sex;
    $postData['diagnosis'] = $rows3["diag"];
    $postData['ht'] = $data['ht'];
    $postData['joint_disease_dm'] = $data['joint_disease_dm'];
    $postData['joint_disease_nephritic'] = $data['joint_disease_nephritic'];
    $postData['joint_disease_myocardial'] = $data['joint_disease_myocardial'];
    $postData['joint_disease_paralysis'] = $data['joint_disease_paralysis'];
    $postData['smork'] = $data['cigarette'];
    $postData['bmi'] = $data['bmi'];
    $postData['height'] = $data['height'];
    $postData['weight'] = $data['weight'];
    $postData['round'] = $data['waist'];
    $postData['temperature'] = $data['temperature'];
    $postData['pause'] = $data['pause'];
    $postData['rate'] = $data['rate'];
    $postData['bp1'] = $data['bp1'];
    $postData['bp2'] = $data['bp2'];
    $postData['officer'] = $_SESSION['sOfficer'];
    $postData['officer_edit'] = $_SESSION['sOfficer'];
    $postData['register_date'] = $data['register_date'];
    // $postData['pension'] = $rows['pension_status'];
    $postData['age_str'] = $rows3["age"];
    $postData['diag_date'] = $data['diag_date'];
    $postData['bp3'] = $data['bp3'];
    $postData['bp4'] = $data['bp4'];
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
    $class_hypertension->setHypertension_clinic($postData);

    if(empty($data['hypertension_id'])){
        $class_hypertension->insert();
    }else{
        $class_hypertension->setRowId($data['hypertension_id']);
        $class_hypertension->update();
    }

    $res = $class_hypertension->getHtHistoryThisDay($data["hn"]);
    $hyperData = $class_hypertension->getOneFromHn($data["hn"]);
    if($res['error_code']==400){
        $class_hypertension->setDateN($hyperData['dateN']); // OVERRIDE dateN ตอนเซ็ตค่า setHypertension_clinic ก่อนที่จะบันทึก setHypertension_clinic
        $class_hypertension->insert_history();
    }else{
        $class_hypertension->setHistoryId($res['id']);
        $class_hypertension->update_history();
    }
}