<?php
require_once dirname(__FILE__).'/newBootstrap.php';
/**
 * blood_request_save.php
 * รับค่าจาก POST #bloodRequestForm และบันทึกลง MySQL 5.x
 * PHP 5.3+ compatible (ใช้ mysqli_* functions)
 */

// ========== Connect ==========
$conn = mysqli_connect(HOST, USER, PASS, DB, PORT);
if (!$conn) {
    echo json_encode(array(
        'status'  => 'error',
        'message' => 'เชื่อมต่อฐานข้อมูลไม่ได้: ' . mysqli_connect_error()
    ));
    exit;
}

mysqli_set_charset($conn, 'utf8');

$wardArray = array(
    '42' => 'หอผู้ป่วยรวม',
    '43' => 'หอผู้ป่วยสูติ',
    '44' => 'หอผู้ป่วยICU',
    '45' => 'หอผู้ป่วยพิเศษ',
    '46' => 'หอผู้ป่วย Cohort Ward',
    '47' => 'ผู้ป่วย Home Isolation',
    '48' => 'ผู้ป่วย รพ.สนาม',
);

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

// ========== Helper: sanitize ==========
function clean($conn, $val) {
    return mysqli_real_escape_string($conn, trim($val));
}

// ========== รับค่า POST ==========
$hn              = clean($conn, isset($_POST['hn'])              ? $_POST['hn']              : '');
$an              = clean($conn, isset($_POST['an'])              ? $_POST['an']              : '');
$patient_name    = clean($conn, isset($_POST['patient_name'])    ? $_POST['patient_name']    : '');
$diag            = clean($conn, isset($_POST['diag'])            ? $_POST['diag']            : '');
$doctor          = clean($conn, isset($_POST['doctor'])          ? $_POST['doctor']          : '');
$ptright         = clean($conn, isset($_POST['ptright'])         ? $_POST['ptright']         : '');
$hct             = clean($conn, isset($_POST['hct'])             ? $_POST['hct']             : '');
$got_blood       = clean($conn, isset($_POST['got_blood'])       ? $_POST['got_blood']       : '0');
$get_blood_date  = clean($conn, isset($_POST['get_blood_date'])  ? $_POST['get_blood_date']  : '');
$hospital        = clean($conn, isset($_POST['hospital'])        ? $_POST['hospital']        : '');

$blood_group     = clean($conn, isset($_POST['blood_group'])     ? $_POST['blood_group']     : '');
$blood_group_rh  = clean($conn, isset($_POST['blood_group_rh'])  ? $_POST['blood_group_rh']  : '');

// ชนิดเลือด checkbox + unit
$prc             = isset($_POST['prc'])      ? 1 : 0;
$prc_unit        = clean($conn, isset($_POST['prc_unit'])        ? $_POST['prc_unit']        : '');
$lrpc            = isset($_POST['lrpc'])     ? 1 : 0;
$lrpc_unit       = clean($conn, isset($_POST['lrpc_unit'])       ? $_POST['lrpc_unit']       : '');
$ffp             = isset($_POST['ffp'])      ? 1 : 0;
$ffp_unit        = clean($conn, isset($_POST['ffp_unit'])        ? $_POST['ffp_unit']        : '');
$plt_conc        = isset($_POST['plt_conc']) ? 1 : 0;
$plt_conc_unit   = clean($conn, isset($_POST['plt_conc_unit'])   ? $_POST['plt_conc_unit']   : '');
$sdp             = isset($_POST['sdp'])      ? 1 : 0;
$sdp_unit        = clean($conn, isset($_POST['sdp_unit'])        ? $_POST['sdp_unit']        : '');
$other           = isset($_POST['other'])    ? 1 : 0;
$other_other     = clean($conn, isset($_POST['other_other'])     ? $_POST['other_other']     : '');

// เหตุผล
$reason          = clean($conn, isset($_POST['reason'])          ? $_POST['reason']          : '');
$other_reason    = clean($conn, isset($_POST['other_reason'])    ? $_POST['other_reason']    : '');

$blood_order_date = clean($conn, isset($_POST['blood_order_date']) ? $_POST['blood_order_date'] : '');
$blood_used_date  = clean($conn, isset($_POST['blood_used_date'])  ? $_POST['blood_used_date']  : '');

// แพทย์/พยาบาล
$doctor_order    = clean($conn, isset($_POST['doctor_order'])    ? $_POST['doctor_order']    : '');
$nurse           = clean($conn, isset($_POST['nurse'])           ? $_POST['nurse']           : '');
$date_drawn      = clean($conn, isset($_POST['date_drawn'])      ? $_POST['date_drawn']      : '');
$ward      = clean($conn, isset($_POST['ward_code'])      ? $_POST['ward_code']      : '');
$unit_request      = clean($conn, isset($_POST['unit_request'])      ? $_POST['unit_request']      : '');
// แปลง date_drawn จาก datetime-local (YYYY-MM-DDTHH:MM) → MySQL DATETIME
if ($date_drawn != '') {
    $date_drawn = str_replace('T', ' ', $date_drawn);
}

// แปลง date ว่าง → NULL
$get_blood_date  = ($get_blood_date  != '') ? "'{$get_blood_date}'"  : 'NULL';
$blood_order_date = ($blood_order_date != '') ? "'{$blood_order_date}'" : 'NULL';
$blood_used_date  = ($blood_used_date  != '') ? "'{$blood_used_date}'"  : 'NULL';
$date_drawn_sql   = ($date_drawn       != '') ? "'{$date_drawn}'"       : 'NULL';

// ========== INSERT ==========
$sql = "INSERT INTO blood_requests (
    hn, an, patient_name, diag, doctor, ptright,
    hct, got_blood, get_blood_date, hospital,
    blood_group, blood_group_rh,
    prc, prc_unit, lrpc, lrpc_unit,
    ffp, ffp_unit, plt_conc, plt_conc_unit,
    sdp, sdp_unit, other_blood, other_other,
    reason, other_reason,
    blood_order_date, blood_used_date,
    doctor_order, nurse, date_drawn,
    created_at, ward, step, unit_request
) VALUES (
    '{$hn}', '{$an}', '{$patient_name}', '{$diag}', '{$doctor}', '{$ptright}',
    '{$hct}', {$got_blood}, {$get_blood_date}, '{$hospital}',
    '{$blood_group}', '{$blood_group_rh}',
    {$prc}, '{$prc_unit}', {$lrpc}, '{$lrpc_unit}',
    {$ffp}, '{$ffp_unit}', {$plt_conc}, '{$plt_conc_unit}',
    {$sdp}, '{$sdp_unit}', {$other}, '{$other_other}',
    '{$reason}', '{$other_reason}',
    {$blood_order_date}, {$blood_used_date},
    '{$doctor_order}', '{$nurse}', {$date_drawn_sql},
    NOW(), {$ward}, '1', {$unit_request}
)";
$result = mysqli_query($conn, $sql);

if ($result) {
    $insert_id = mysqli_insert_id($conn);

    // http://192.168.131.220/bloodstock/notify.php
    $ward_name = $wardArray[$ward];
    $msg = "📌 มีใบขอเลือดจาก <b>$ward_name</b> 📌\n";
    $msg .= "<b>AN</b>: $an\n";
    $msg .= "<b>ชื่อ-สกุล</b>: $patient_name\n";
    if(!empty($hct)){
        $msg .= "<b>HCT</b> : $hct%\n";
    }

    if($got_blood==0){
        $msg .= "ไม่เคยได้รับเลือด\n";
    }else{
        $msg .= "เคยได้รับเลือด\n";
        $msg .= "ครั้งสุดท้ายเมื่อวันที่ $get_blood_date ที่ $hospital\n";
    }
    $msg .= "<b>Groupเลือด</b>: $blood_group $blood_group_rh\n";

    $msg .= "<b>จำนวนถุงเลือดที่ต้องการ</b>: $unit_request\n";

    $unit = '';
    if(!empty($prc)){
        $unit = "<b>PRC</b>: $prc_unit Unit";
    }
    if(!empty($lrpc)){
        $unit = "<b>LRPC</b>: $lrpc_unit Unit";
    }
    if(!empty($ffp)){
        $unit = "<b>FFP</b>: $ffp_unit Unit";
    }
    if(!empty($plt_conc)){
        $unit = "<b>Plt.Conc</b>: $plt_conc_unit Unit";
    }
    if(!empty($sdp)){
        $unit = "<b>SDP</b>: $sdp_unit Unit";
    }
    if(!empty($other)){
        $unit = "<b>Other</b>: $other_other";
    }
    $msg .= "ชนิดเลือดที่ต้องการขอ $unit\n";

    if (!empty($other_reason)) {
        $reason = $other_reason;
    }
    $msg .= "<b>ความต้องการ / เหตุผลการใช้เลือด</b>: $reason\n";
    $msg .= "<b>ผู้ร้องขอ</b>: $nurse\n\n";
    

    $msg = '<a href="['.DOMAIN_PATH.'/blood_request_list.php](รายละเอียด)">';

    $curl = curl_init();
    curl_setopt( $curl, CURLOPT_URL, "http://192.168.131.220/bloodstock/notify.php");
    curl_setopt( $curl, CURLOPT_POST, 1);
    curl_setopt( $curl, CURLOPT_POSTFIELDS, "message=".urlencode($msg)."&token=7a0aedcbd1941f4df7b3350a8e59bc7e36f94a3e");
    curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-type: application/x-www-form-urlencoded' ));
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt( $curl, CURLOPT_TIMEOUT, 10);
    $result = curl_exec( $curl );
    curl_close($curl);
    
    header('Content-Type: application/json; charset=utf-8');
    echo $json->encode(array(
        'status'    => 'success',
        'message'   => 'บันทึกข้อมูลสำเร็จ',
        'insert_id' => $insert_id
    ));
} else {
    echo $json->encode(array(
        'status'  => 'error',
        'message' => 'บันทึกข้อมูลไม่สำเร็จ: ' . mysqli_error($conn)
    ));
}
?>