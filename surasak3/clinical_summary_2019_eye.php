<?php 

include 'bootstrap.php';

$db = Mysql::load();

// $db->set_charset("TIS620");
?>

<style>
body{
    margin: 0;
    padding: 0;
}
*{
    font-family: "TH Sarabun New", "TH SarabunPSK";
    font-size: 14pt;
}
p{
    margin: 0;
    padding: 0;
}
.tb_normal_line td{
    line-height: 11pt;
}
.tb_info td{
    font-size: 14pt;
    line-height: 14pt;
}
@media print{
    .form_container{
        display: none;
    }
}
</style>

<?php 

$an = input('an');
$sql = "SELECT a.*,SUBSTRING(a.`date`,1,10) AS `admit_date`,SUBSTRING(a.`dcdate`,1,10) AS `dcdate`,b.`yot`,b.`name`,b.`surname`,b.`idcard`,b.`dbirth`,b.`ptright` AS `ptright2` 
FROM `ipcard` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`an` = '$an' ";
$db->select($sql);
$item = $db->get_item();

$ptname = $item['yot'].$item['name'].' '.$item['surname'];

$match = preg_match('/(นาง|หญิง|น.ส|ด.ญ|ms|mis)/', $item['yot'], $matchs);
$gender = 'ชาย';
if( $match > 0 ){
    $gender = 'หญิง';
}

function create_dot($dot_num){ 
    $dot_txt = '';
    for ($i=0; $i < $dot_num; $i++) { 
        $dot_txt .= '.';
    }
    return $dot_txt;
}

?>

<div style="position: relative; padding: 10px;">
    <div style="text-align: center; font-size: 16pt;">Clinical  Summary</div>
    <div style="text-align: center; font-size: 16pt;">โรงพยาบาลค่ายสุรศักดิ์มนตรี  จังหวัดลำปาง</div>

    <div style="position: absolute; top: 10px; left: 10px;">MR  IPD - 002 (4)</div>
    <div style="position: absolute; top: 30px; left: 10px;">เริ่มใช้ วันที่ 1 เม.ย. 66</div>
    <div>&nbsp;</div>
    <div>
        <table style="width: 100%;" class="tb_info">
            <tr>
                <td width="35%">Name: <?=$ptname;?></td>
                <td width="25%">HN: <?=$item['hn'];?></td>
                <td width="15%">AN: <?=$item['an'];?></td>
                <td width="25%">Sex: <?=$gender;?></td>
            </tr>
            <tr>
                <td>เลขบัตรประจำตัวประชาชน: <?=$item['idcard'];?></td>
                <td>สิทธิการรักษา: <?=$item['ptright2'];?></td>
                <td>&nbsp;</td>
                <td>DOB: <?=$item['dbirth'];?></td>
            </tr>
            <tr>
                <td>Careprovider: </td>
                <td>&nbsp;</td>
                <td>Location: </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">Admission Date: <?=$item['admit_date'];?></td>
                <td colspan="2">Discharge Date: <?=$item['dcdate'];?></td>
            </tr>
        </table>
    </div>
    <div>
        <table width="100%">
            <tr>
                <td>Principle  Diagnosis</td>
                <td>Cataract</td>
                <td><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> Right eye</td>
                <td><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> Left eye</td>
            </tr>
        </table>
    </div>
    <div><p style="word-wrap: break-word;"><?=create_dot(230);?></p></div>
    <div>
        <p style="word-wrap: break-word;">Comorbidities <?=create_dot(191);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;">Complications <?=create_dot(191);?></p>
    </div>
    <div>
        <table>
            <tr>
                <td>LAB&nbsp;&nbsp;&nbsp;</td>
                <td><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> CBC</td>
            </tr>
            <tr>
                <td></td>
                <td><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> FBS</td>
            </tr>
        </table>
    </div>

    <div><p style="word-wrap: break-word;"><?=create_dot(230);?></p></div>
    <div><p>Treatment  &  Operation</p></div>
    <div>
        <table>
            <tr>
                <td><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> Phacoemulsification</td>
                <td><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> Right eye</td>
                <td><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> Left eye</td>
            </tr>
            <tr>
                <td colspan="3"><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> Extracapsular cataract extraction/Manual small incision cataract surgery</td>
            </tr>
            <tr>
                <td><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> Intraocular Lens Implantation</td>
                <td><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> Right eye</td>
                <td><img src="dcsum_clip_image001_0000.gif" alt="" width="15" height="15" align="center"/> Left eye</td>
            </tr>
        </table>
    </div>
    <div><p style="word-wrap: break-word;"><?=create_dot(230);?></p></div>
    <div><p>Result <?=create_dot(217);?></p></div>
    <div><p style="word-wrap: break-word;"><?=create_dot(230);?></p></div>
    <div><p>Home Medication <?=create_dot(194);?></p></div>
    <div><p style="word-wrap: break-word;"><?=create_dot(230);?></p></div>
    <div><p style="word-wrap: break-word;"><?=create_dot(230);?></p></div>
    <div><p style="word-wrap: break-word;"><?=create_dot(230);?></p></div>
    <div><p style="word-wrap: break-word;"><?=create_dot(230);?></p></div>
    <div><p>Follow Up <?=create_dot(209);?></p></div>
    <div><p>Follow Up วันที่ <?=create_dot(70);?> ตามผล <?=create_dot(116);?></p></div>
    <div><p>LAB ล่วงหน้า <?=create_dot(205);?></p></div>
    <div><p style="word-wrap: break-word;"><?=create_dot(230);?></p></div>
    <div>&nbsp;</div>
    <div style="text-align: right;">แพทย์ผู้รักษา..............................................................................</div>
    <div style="text-align: right;">(...........................................................................)</div>
    <br><br><br><br>
    <div>** หมายเหตุ: หลังสแกนเรียบร้อยแล้ว ให้นำเอกสารใส่ในเวชระเบียนผู้ป่วยในทุกครั้ง**</div>
</div>
<script>
window.onload = function(){
    window.print();
}
</script>