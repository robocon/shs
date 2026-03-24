<?php
if (!defined(BASE_API)) {
    echo "Invalid Base Path";
    exit;
}
if($action==='save'){
    dump($data);

    // DB = ตัวเก่า = ตัวใหม่
    /*
    การวินิจฉัย    diagnosis = dia1 = dia1
    diagdetail = nosis_d = dm_date
    โรคร่วม HT    ht = ht = ht
    โรคร่วม อื่นๆ    ht_etc = ht_etc = como_etc
    ht ht_d = como_etc_date
    smork = cigarette = dm_cigarette
    */
    $dmData = array(
        'dm_no' => $data[''],
        'thidate' => $data[''],
        'dateN' => $data[''],
        'hn' => $data[''],
        'doctor' => $data[''],
		'ptname' => $data[''],
        'ptright' => $data[''],
        'dbbirt' => $data[''],
        'sex' => $data[''],

        'diagnosis' => $data['dm_type'],
        'diagdetail' => $data['dm_type_date'],
        'ht' => $data['dm_como_ht'],
        'ht_etc' => $data['other_como'],
        'htdetail' => $data['other_como_date'],
        'smork' => $data['dm_smoked'],

        'retinal' => $data['retinal'],
        'retinal_date' => $data['retinal_date'],
        'foot_exam_date' => $data['foot_exam_date'],
        'dm_foot' => $data['dm_foot'],
        'tooth_date' => $data['dm_teeth_date'],
        'tooth' => $data['dm_teeth'],


    );
    exit;
}