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
        'weight' => $data['weight'],
        'height' => $data['height'],
        'temperature' => $data['temperature'],
        'round' => $data['round'],
        'pause' => $data['pause'],
        'rate' => $data['rate'],
        'bp1' => $data['bp1'],
        'bp2' => $data['bp2'],
        'bmi' => $data['bmi'],

        'diagnosis' => $data['dm_type'],
        'diagdetail' => ad_to_bc($data['dm_type_date']),
        'ht' => $data['dm_como_ht'],
        'ht_etc' => implode(',', $data['other_como[]']),
        'htdetail' => ad_to_bc($data['other_como_date']),
        'smork' => $data['dm_smoked'],

        'retinal' => $data['retinal'],
        'retinal_date' => ad_to_bc($data['retinal_date']),
        'foot_date' => ad_to_bc($data['foot_exam_date']),
        'foot' => $data['dm_foot'],
        'tooth_date' => ad_to_bc($data['dm_teeth_date']),
        'tooth' => $data['dm_teeth'],

        'foot_care' => $data['dm_footcare'],
        'date_footcare' => ad_to_bc($data['date_footcare']),
        'nutrition' => $data['dm_nutrition'],
        'date_nutrition' => ad_to_bc($data['date_nutrition']),
        'exercise' => $data['dm_exercise'],
        'date_exercise' => ad_to_bc($data['date_exercise']),
        'officer' => $_SESSION['sOfficer']
    );

    $screenDmData = array(
        'hn' => $data['dmHn'],
        'ptname' => $data['ptname'],
        'age' => urldecode($data['age']),
        'date_active' => date('Y-m-d'),
        'officer' => $_SESSION['sOfficer'],
        'datetime' => date('Y-m-d H:i:s')
    );

    $classDiabetes = new Diabetes();

    ####### เพิ่มข้อมูลเข้า screen_dm อัตโนมัตถ้ายังไม่มีข้อมูล #######
    $screen = $classDiabetes->getScreenDm($data['dmHn']);
    if($screen===false){
        $classDiabetes->insertData('screen_dm',$screenDmData);
    }
    ####### เพิ่มข้อมูลเข้า screen_dm อัตโนมัตถ้ายังไม่มีข้อมูล #######

    $validate = false;

    $dm = $classDiabetes->getDiabetesFromHn($data['dmHn'],array('row_id','hn'));
    if($dm===false){

        $no = new Runno();
        $runno = $no->getRunno('diabetes');
        $dmData['dm_no'] = $runno;

        $no->nextRunno = $runno;
        $no->setNextRunno();
        
        $dmData['register_date'] = date('Y-m-d H:i:s');
        $dmClinicId = $classDiabetes->insertData('diabetes_clinic',$dmData);
        if($dmClinicId!==false){
            $validate = true;
        }

    }else{
        

        // update
        $dmUpdate = $dmData;
        unset($dmUpdate['dm_no']);
        unset($dmUpdate['thidate']);
        unset($dmUpdate['ptname']);

        $dmUpdate['officer_edit'] = $_SESSION['sOfficer'];
        $dmClinicId = $dm['row_id'];
        $res = $classDiabetes->updateData('diabetes_clinic',$dmUpdate," WHERE `row_id` = '$dmClinicId' ");
        if($res!==false){
            $validate = true;
        }
    }

    $historyId = $classDiabetes->findDiabetesHistoryToday($data['dmHn']);
    if($historyId===false){
        
        $history_insert = $classDiabetes->insertData('diabetes_clinic_history',$dmData);
        if($history_insert!==false){
            $validate = true;
        }

    }else{
        $res = $classDiabetes->updateData('diabetes_clinic_history',$dmUpdate," WHERE `row_id` = '$historyId' ");
        if($res!==false){
            $validate = true;
        }
    }

    if($validate===false){
        $res = array('status'=>400,'message'=>'บันทึกข้อมูลไม่สำเร็จ');
    }else{
        $res = array('status'=>200,'message'=>'บันทึกข้อมูลเรียบร้อย','dm_clinic_id'=>$dmClinicId,'hn'=>$dmData['hn']);
    }

    // $classDiabetes->delDiabetes($dmClinicId);
    // $classDiabetes->delDiabetesHistory($historyId);

    header('Content-Type: application/json');
    echo $json->encode($res);
    exit;
}