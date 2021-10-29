<?php 
// https://view.officeapps.live.com/op/view.aspx?src=http%3A%2F%2Fwww.bphc.moph.go.th%2Fmedia%2Fkunena%2Fattachments%2F156%2Fcvd.pptx&wdOrigin=BROWSELINK
// Slide ที่8
// 62-4033	นาย จักรพันธ์ ปลาก๋อง
// OPD row_id 739132

// Test เปรียบเทียบกับ https://www.rama.mahidol.ac.th/cardio_vascular_risk/thai_cv_risk_score/
$age = 54;
$sex = 0;
$sbp = 150;
$hyper = 0;
$diabetes = 0;
$smoke = 0;
$whtr = 98; // เป็นนิ้วคูณ 0.393701 แต่ในนี้ใส่เป็น cmได้เลย
$height = 158;

//HDC
$FullScore = 0;
$FullScore += 0.079*$age;
$FullScore += 0.128*$sex;
$FullScore += 0.019350987*$sbp;
$FullScore += 0.58454*$diabetes;
$FullScore += 3.512566*($whtr/$height);
$FullScore += 0.459*$smoke;
var_dump($FullScore);
echo "<hr>";

$preexp = $FullScore-7.720484;
var_dump($preexp);
echo "<hr>";

$exp = exp($preexp);
var_dump($exp);
echo "<hr>";

$pow = 0.978296**$exp; //ใช้แทน pow ใน PHP >= 5.6.x
var_dump($pow);
echo "<hr>";

$prePersent = 1-$pow;
var_dump($prePersent);
echo "<hr>";

$PFullScore = $prePersent * 100;
var_dump($PFullScore);
echo "<hr>";