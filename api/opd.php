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
        'diagdetail' => !empty($data['dm_type_date']) ? dateChristToThai($data['dm_type_date']) : '' ,
        'ht' => $data['dm_como_ht'],
        'ht_etc' => implode(',', $data['other_como[]']),
        'htdetail' => !empty($data['other_como_date']) ? dateChristToThai($data['other_como_date']) : '' ,
        'smork' => $data['dm_smoked'],

        'retinal' => $data['retinal'],
        'retinal_date' => !empty($data['retinal_date']) ? dateChristToThai($data['retinal_date']) : '' ,
        'foot_date' => !empty($data['foot_exam_date']) ? dateChristToThai($data['foot_exam_date']) : '' ,
        'foot' => $data['dm_foot'],
        'tooth_date' => !empty($data['dm_teeth_date']) ? dateChristToThai($data['dm_teeth_date']) : '' ,
        'tooth' => $data['dm_teeth'],

        'foot_care' => $data['dm_footcare'],
        'date_footcare' => !empty($data['date_footcare']) ? dateChristToThai($data['date_footcare']) : '' ,
        'nutrition' => $data['dm_nutrition'],
        'date_nutrition' => !empty($data['date_nutrition']) ? dateChristToThai($data['date_nutrition']) : '' ,
        'exercise' => $data['dm_exercise'],
        'date_exercise' => !empty($data['date_exercise']) ? dateChristToThai($data['date_exercise']) : '' ,
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

        dump($dmUpdate);

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

    header('Content-Type: application/json');
    echo $json->encode($res);
    exit;

}else if($action==='saveRetinal'){

    // $opcard = new Opcard();
    $dm = new Diabetes();
    $no = new Runno();

    // $post = $json->decode($jsonData);

    // ดูว่าใน diabetes_clinic เคยมีข้อมูลแล้วรึยัง
    $item = $dm->getDiabetesFromHn($data['hn']);
    $res = array('status'=>200, 'msg'=>'บันทึกข้อมูลเรียบร้อย');
    $error_list = array();
    
    $dmData = $data;
    $dmData['date'] = dateChristToThai($dmData['date']);
    $dmData['retinal_date'] = dateChristToThai($dmData['date']);

    // ถ้ายังไม่มี dmNumber ให้เพิ่มเข้าไปใน diabetic_clinic ก่อน 
    if($item===false){
        $runno = $no->getRunno('diabetes');
        
        $resInsertDiabetes = $dm->insertRetinalDiabetes($runno, $dmData);
        if($resInsertDiabetes!==false){
            $no->nextRunno = $runno;
            $no->setNextRunno();
            $dmNumber = $res['dm_no'] = $resInsertDiabetes;
        }else{
            $error_list['insert_retinal_diabetes'] = $resInsertDiabetes;
            $error_list['message'] = $dm->getError();
            $res['status']=400;
        }
    }else{
        $dmNumber = $item['dm_no'];
        $updateDm = $dm->updateRetinalDiabetes($dmNumber,$item['dateN'], $dmData);
        $res['update_dm_no'] = $updateDm;

    }

    // เช็กดูว่าวันนี้มี history แล้วรึยัง ถ้ายังไม่มีค่อยเพิ่ม
    $his = $dm->findDiabetesHistoryToday($dmData['hn']);
    if($his===false){
        $insertHistoryId = $dm->insertRetinalDiabetesHistory($dmNumber, $dmData);
        if($insertHistoryId!==false){
            $res['dm_history_id'] = $insertHistoryId;
        }else{
            $error_list['insert_diabetes_history'] = $insertHistoryId;
            $error_list['message'] = $dm->getError();
            $res['status']=400;
        }
    }else{
        $res['dm_history_id'] = $his;
    }
    
    // หลังจากบันทึกข้อมูลเข้า diabetes_clinic เรียบร้อยค่อยมาบันทึก retinal_exam
    $retinalId = $dm->findRetinalExamFromDateAndHn($data['hn']);
    if($retinalId===false){
        $insertRetinal = $dm->insertRetinalExam($dmNumber, $data);
        if($insertRetinal!==false){
            $res['retinal_id'] = $insertRetinal;
        }else{
            $error_list['insert_retinal'] = $insertRetinal;
            $error_list['message'] = $dm->getError();
            $res['status']=400;
        }
    }else{
        $dm->updateRetinalExam($retinalId, $data);
    }
    
    if(count($error_list)>0){
        $res['error']=$error_list;
    }
    echo $json->encode($res);
    exit;
}