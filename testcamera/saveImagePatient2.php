<?php
$dataJsonEncode = json_encode(array(
    'data' => sprintf("%s", $_POST['imgScan']['0']),
    'idcard' => sprintf("%s", $_POST['idcard'])
));
// $data = sprintf("%s", $_POST['data']);
// $idcard = sprintf("%s", $_POST['idcard']);

$chOne = curl_init();
curl_setopt($chOne, CURLOPT_URL, "http://192.168.131.250/sm3/saveImagePatient.php");
curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($chOne, CURLOPT_POST, 1);
curl_setopt($chOne, CURLOPT_POSTFIELDS, $dataJsonEncode);
$headers = array('Content-type: application/json');
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($chOne);
curl_close($chOne);

$res = json_decode($result, true);
if($res['status']==200){
    echo $res['message'].' ( บันทึกข้อมูลเรียบร้อย ) กรุณาปิดหน้าต่าง';
}else{
    echo $res['message'].' ( บันทึกข้อมูลไม่สมบูรณ์ )';
}