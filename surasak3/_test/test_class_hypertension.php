<?php 

var_dump(dirname(__FILE__));
require_once dirname(__FILE__).'/../includes/config.php';
require_once dirname(__FILE__).'/../includes/functions.php';
require_once dirname(__FILE__).'/../class_file/class_hypertension.php';

$ht = new Hypertension();
$postData['ht_no'] = '6086';
$postData['thidate'] = (date('Y')+543).date('-m-d');
$postData['hn'] = '66-1888';
$postData['doctor'] = "test";
$postData['ptname'] = 'test';
$postData['ptright'] = "test";
$postData['sex'] = '1';
$postData['diagnosis'] = 'test';
$postData['ht'] = '';
$postData['joint_disease'] = '';
$postData['joint_disease_dm'] = '';
$postData['joint_disease_nephritic'] = '';
$postData['joint_disease_myocardial'] = '';
$postData['joint_disease_paralysis'] = '';
$postData['smork'] = '0';
$postData['bmi'] = '25.96';
$postData['height'] = '157.0';
$postData['weight'] = '64.0';
$postData['round'] = '';
$postData['temperature'] = '36.5';
$postData['pause'] = '92';
$postData['rate'] = '20';
$postData['bp1'] = '';
$postData['bp2'] = '';
$postData['officer'] = "กฤษณะศักดิ์ กันธรส";
$postData['officer_edit'] = "กฤษณะศักดิ์ กันธรส";
$postData['register_date'] = '';
$postData['pension'] = '';
$postData['age_str'] = '39 ปี 8 เดือน';
$postData['diag_date'] = '';
$postData['bp3'] = '';
$postData['bp4'] = '';
$postData['ecgCxr'] = '';
$postData['dateEcgCxr'] = '';
$postData['albumin'] = '';
$postData['dateAlbumin'] = '';
$postData['albuminLabnumber'] = '';
$postData['creatinine'] = '';
$postData['dateCreatinine'] = '';
$postData['creatinineLabnumber'] = '';


$ht->setHypertension_clinic($postData);
// $res = $ht->insert_history();
// var_dump($res);

$ht->setHistoryId('11959');
$res = $ht->update_history();
dump($res);