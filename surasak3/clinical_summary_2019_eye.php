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
    font-size: 11pt;
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
$sql = "SELECT a.*,b.`yot`,b.`idcard`,b.`dbirth` 
FROM `ipcard` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`an` = '$an' ";
$db->select($sql);

$item = $db->get_item();

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

    <div style="position: absolute; top: 10px; right: 10px;">MR – IPD - 002 (4)</div>
    <div style="position: absolute; top: 24px; right: 10px;">เริ่มใช้ วันที่ 4 มี.ค. 62</div>
    <div>&nbsp;</div>
    <div>
        <table style="width: 100%;" class="tb_info">
            <tr>
                <td width="35%">Name: <?=$item['ptname'];?></td>
                <td width="40%">HN: <?=$item['hn'];?></td>
                <td width="10%">AN: <?=$item['an'];?></td>
                <td width="15%">Sex: <?=$gender;?></td>
            </tr>
            <tr>
                <td>เลขบัตรประจำตัวประชาชน: <?=$item['idcard'];?></td>
                <td>สิทธิการรักษา: <?=$item['ptright'];?></td>
                <td>&nbsp;</td>
                <td>DOB: <?=$item['dbirth'];?></td>
            </tr>
        </table>
    </div>
    <div>
        <table>
            <tr>
                <td>Principle  Diagnosis   Cataract&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>
                    <img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Right eye&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    <img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Left eye 
                </td>
            </tr>
        </table>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div><p>Lab  CBC, FBS </p></div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>
        <table>
            <tr>
                <td colspan="3">Treatment  &  Operation</td>
            </tr>
            <tr>
                <td>
                    <img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Phacoemulsification&nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    <img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Right eye&nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    <img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Left eye&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Extracapsular cataract extraction/Manual small incision cataract surgery 
                </td>
            </tr>
            <tr>
                <td>
                    <img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Intraocular Lens Implantation&nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    <img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Right eye&nbsp;&nbsp;&nbsp;
                </td>
                <td>
                    <img src="dcsum_clip_image001_0000.gif" width="15" height="15" align="left"/>Left eye&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
        </table>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div><p>Home Medication</p></div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>&nbsp;</div>
    <div style="text-align: right;">แพทย์ผู้รักษา..............................................................................</div>
    <div style="text-align: right;">(...........................................................................)</div>
</div>
<script>
window.onload = function(){
    window.print();
}
</script>