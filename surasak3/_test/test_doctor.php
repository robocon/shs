<?php
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_doctor.php';

$dt = new Doctor();
// $id = 1;
// $res = $dt->getExamTable($id);

$doctorcode = '';
$res = $dt->getAllDoctor($doctorcode);

// $dataPost = array(
//     'name' => 'AAA',
//     'doctor_id' => '999',
//     'day' => array('tue','thu','fri'),
//     'detail' => 'ฝากครรภ์',
//     'time_start' => '10:00',
//     'time_end' => '12:00',
//     'type' => 'สูติ',
// );
// $res = $dt->saveExamTable($dataPost);
dump($res);