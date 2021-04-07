<?php 
function dump($txt)
{
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}
function toUTF8($str)
{
    $str = iconv("TIS-620", "UTF-8", $str );
    return $str;
}

/**
 * UpdateImmunization Example from
 * https://drive.google.com/file/d/1QAj8MyXnmMDfSF53EBd4fIHavCeFwdUi/view
 */
$data = array
(
    'hospital' => array
    (
        'hospital_code' => '11512', // Require
        'hospital_name' => toUTF8('โรงพยาบาลค่ายสุรศักดิ์มนตรี'), // Require
        'his_identifier' => 'SHS version 3.2'
    ),
    'patient' => array
    (
        'CID' => '3501500171671', // opcard.idcard
        'hn' => '47-1', // opcard.hn
        'patient_guid' => '{73F287FF-5924-435F-B80A-8993A1349DAE}', // opcard.guid --> เดี๋ยวgenerateให้ครับ
        'prefix' => toUTF8('นาย'), // opcard.yot
        'first_name' => toUTF8('เพลิงพายุ'), // opcard.name
        'last_name' => toUTF8('อุปนันท์'), // opcard.surname
        'gender' => '1', // opcard.sex convert เอง
        'birth_date' => '1982-03-05', // opcard.dbirth พ.ศ. --> ค.ศ.
        'marital_status_id' => '1', // opcard.married 
        'address' => '22', // opcard.address
        'moo' => '2', // opcard.address --> แยกจาก Address เองเด้อ
        'road' => '', // opcard.address --> แยกจาก Address เองเด้อ
        'chw_code' => '20', // opcard.changwat
        'amp_code' => '04', // opcard.ampur
        'tmb_code' => '05', // opcard.tambol
        'installed_line_connect' => '',
        'home_phone' => '0277777777', // opcard.hphone
        'mobile_phone' => '', // opcard.phone
        'ncd' => array()
    ),
    'lab' => array
    (

    ),
    'immunization_plan' => array
    (
        array
        (
            'vaccine_code' => 'C19',
            'immunization_plan_ref_code' => '18', // เป็น รหัส primary key ของข้อมูลต้นทางที่ส่งเข้ามา
            'treatment_plan_name' => 'Vaccine COVID-19',
            'practitioner_license_number' => toUTF8('ท.1234567'),
            'practitioner_name' => 'LAB',
            'practitioner_role' => toUTF8('แพทย์'),
            'vaccine_ref_name' => toUTF8('วัคซีน Covid 19 - ซิโนแวค'),
            'schedule' => array
            (
                array
                (
                    'immunization_plan_schedule_ref_code' => '33', // เป็นรหัส primary key ของข้อมูลต้นทางที่ส่งเข้ามา
                    'schedule_date' => '2021-01-25',
                    'treatment_number' => 1,
                    'schedule_description' => toUTF8('ให้ Vaccine COVID-19 เข็มแรก'),
                    'complete' => 'Y',
                    'visit_date' => '2021-01-25'
                ),
                array
                (
                    'immunization_plan_schedule_ref_code' => '34',
                    'schedule_date' => '2021-02-24',
                    'treatment_number' => 2,
                    'schedule_description' => toUTF8('ให้ Vaccine COVID-19 เข็มที่ 2'),
                    'complete' => 'N'
                )
            )
        )
    ),
    'visit' => array
    (
        'visit_guid' => '{8A4298CF-6E0C-4338-926F-ACDDECF454FF}',
        'visit_ref_code' => '640125141902',
        'visit_datetime' => '2021-01-25T14:19:02.000',
        'claim_fund_pcode' => 'A2',
        'visit_observation' => array
        (
            'systolic_blood_pressure' => 120,
            'diastolic_blood_pressure' => 80,
            'body_weight_kg' => 65,
            'body_height_cm' => 165,
            'temperature' => 36.5
        ),
        'visit_immunization' => array
        (
            array
            (
                'visit_immunization_ref_code' => '70',
                'immunization_datetime' => '2021-01-26T13:30:29.000',
                'vaccine_code' => 'C19',
                'lot_number' => 'TestABCDE',
                'expiration_date' => '2024-01-26',
                'vaccine_note' => 'test',
                'vaccine_ref_name' => toUTF8('วัคซีน Covid 19 - ซิโนแวค'),
                'serial_no' => '1234567890',
                'vaccine_manufacturer' => 'Sinovac Life Sciences',
                'vaccine_plan_no' => 1,
                'vaccine_route_name' => toUTF8('ฉีดเข้ากล้ามเนื้อ (Intramuscular)'),
                'practitioner' => array
                (
                    'license_number' => toUTF8('ท.1234567'),
                    'name' => toUTF8('นพ.ทดสอบ'),
                    'role' => toUTF8('แพทย์')
                ),
                'immunization_plan_ref_code' => '18',
                'immunization_plan_schedule_ref_code' => '33'
            )
        ),
        'visit_immunization_reaction' => array
        (
            array
            (
                'visit_immunization_reaction_ref_code' => '17',
                'visit_immunization_ref_code' => '70',
                'report_datetime' => '2021-01-26T17:13:16.000',
                'reaction_detail_text' => toUTF8('ปวดศีรษะ (Headache) : test'),
                'vaccine_reaction_type_id' => 2,
                'reaction_date' => '2021-01-26',
                'vaccine_reaction_stage_id' => 2,
                'vaccine_reaction_symptom_id' => 4
            )
        ),
        'appointment' => array
        (
            array
            (
                'appointment_ref_code' => '710378',
                'appointment_datetime' => '2021-02-24T09:00:00.000',
                'appointment_note' => toUTF8('หมายเหตุ'),
                'appointment_cause' => toUTF8('นัดมารับวัคซีนเข็ม 2'),
                'provis_aptype_code' => 'C19',
                'practitioner' => array
                (
                    'license_number' => toUTF8('ท.1234567'),
                    'name' => toUTF8('นพ.ทดสอบ'),
                    'role' => toUTF8('แพทย์')
                )
            )
        )
    ),
);

$post_request = array(
    'page' => 'UpdateImmunization', // and other page Ex. ImmunizationHistory, ImmunizationTarget and ETC.
    'data' => $data
);

$post_query = http_build_query($post_request);

$curl = curl_init();
curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
curl_setopt($curl, CURLOPT_URL, "http://localhost/moph/index.php"); // ยังไม่เปิดใจเย็นๆ
curl_setopt($curl, CURLOPT_POSTFIELDS, $post_query);
curl_setopt($curl, CURLOPT_HTTPHEADER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);

echo "<pre>";
var_dump($output);
echo "</pre>";

// dump($output);