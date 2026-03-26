<?php
if (!defined('BASE_API')) {
    echo "Invalid Base Path";
    exit;
}
if($action==='save'){
    
    $doctorName = '';
    if(!empty($data['doctor'])){
        $classDoctor = new Doctor();
        $dt = $classDoctor->getDoctorFromId($data['doctor']);
        $doctorName = $dt['name'];
    }
    
    $currentDate = date('Y-m-d');
    $data['dmHn'] = '99999999';
    $dmData = array(
        'dm_no' => $data['dm_no'],
        'thidate' => $currentDate, // วันที่เริ่มบันทึก
        'dateN' => $currentDate, // วันที่อัพเดท
        'hn' => $data['dmHn'],
        'doctor' => $doctorName,
		'ptname' => $data['ptname'],
        'ptright' => $data['ptright'],
        'dbbirt' => $data['dbbirt'],
        'sex' => $data['sex'],

        'diagnosis' => $data['dm_type'],
        'diagdetail' => $data['dm_type_date'],
        'ht' => $data['dm_como_ht'],
        'ht_etc' => implode(',', $data['other_como[]']),
        'htdetail' => $data['other_como_date'],
        'smork' => $data['dm_smoked'],

        'retinal' => $data['retinal'],
        'retinal_date' => $data['retinal_date'],
        'foot_date' => $data['foot_exam_date'],
        'foot' => $data['dm_foot'],
        'tooth_date' => $data['dm_teeth_date'],
        'tooth' => $data['dm_teeth'],

        'foot_care' => $data['dm_footcare'],
        'date_footcare' => $data['date_footcare'],
        'nutrition' => $data['dm_nutrition'],
        'date_nutrition' => $data['date_nutrition'],
        'exercise' => $data['dm_exercise'],
        'date_exercise' => $data['date_exercise'],
        'officer' => $_SESSION['sOfficer']
    );

    $classDiabetes = new Diabetes();
    $dm = $classDiabetes->getDiabetesFromHn($data['dmHn'],array('row_id','dm_no','dateN'));
    if($dm===false){
        $dmClinicId = $classDiabetes->insertData('diabetes_clinic',$dmData);
        dump($res);


    }else{
        // update
        $dmUpdate = $dmData;
        unset($dmUpdate['dm_no']);
        unset($dmUpdate['thidate']);
        unset($dmUpdate['ptname']);

        $dmClinicId = $dm['row_id'];
        $res = $classDiabetes->updateData('diabetes_clinic',$dmUpdate," WHERE `row_id` = '$dmClinicId' ");
        dump($res);
        
    }


    $classDiabetes->findDiabetesHistoryToday();


    /**
     * @todo
     * [] เพิ่มไปใน history
     * [] เพิ่มไปใน screen_dm
     */
    // $mainDm = $classDiabetes->getDiabetesFromId($dmClinicId);
    // dump($mainDm);
    // $res = $classDiabetes->insertData('diabetes_clinic_history',$mainDm);
    // dump($res);
    exit;
}