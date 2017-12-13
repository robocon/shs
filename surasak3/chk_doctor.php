<?php

include 'bootstrap.php';

include 'dt_menu.php';
// include 'dt_patient.php';

session_unregister("list_bill");
session_register("list_bill");

$_SESSION['list_bill'] = '';
$vn = $_SESSION['vn_now']; //vn
$hn = $_SESSION['hn_now'];
$post_vn = 1;
$_SESSION['dt_doctor'] = $_SESSION['sOfficer'];

$date_now = date("Y-m-d H:i:s");
$date_hn = date('d-m-').( date('Y') + 543 ).$hn;

$db = Mysql::load();

$sql = "SELECT a.*, b.`idcard`, b.`blood` 
FROM `opd` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`thdatehn` = '$date_hn' 
";
$db->select($sql);
$opd = $db->get_item();

$cig_lists = array(0 => 'ไม่สูบ', 1 => 'สูบ', 2 => 'เคยสูบ');
$cigok_lists = array(0 => 'ไม่อยากเลิก', 1 => 'อยากเลิก');
$al_lists = array(0 => 'ไม่ดื่ม', 1 => 'ดื่ม', 2 => 'เคยดื่ม');
$drugreact_lists = array(0 => 'ไม่แพ้', 1 => 'แพ้');

?>
<style type="text/css">
table{
    border-collapse: collapse;
}
.chk_table{
    border-collapse: collapse;
    width: 100%;
    border: 2px solid #000000;
}
.chk_table .title{
    font-weight: bold;
    border-bottom: 2px solid #000000;
    background-color: #b9e3ae;
    text-align: center;
}

label{
    cursor: pointer;
}
.tb-title{
    font-weight: bold;
    text-align: right;
}
.tb-title:after{
    content: "\0020\003A\0020";
}
h1,h3,p{
    margin: 0;
    padding: 0;
}
</style>
<form action="chk_doctor.php" method="post" >
    <h2 align="center">บันทึกผลตรวจสุขภาพประกันสังคม</h2>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>ข้อมูลผู้ป่วย</h3></td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%">
                    <tr>
                        <td width="10%" class="tb-title">ชื่อ-สกุล</td>
                        <td width="15%"><?=$opd['ptname'];?></td>
                        <td width="10%" class="tb-title">HN</td>
                        <td width="15%"><?=$opd['hn'];?></td>
                        <td width="10%" class="tb-title">VN</td>
                        <td width="15%"><?=$opd['vn'];?></td>
                        <td width="10%" class="tb-title">อายุ</td>
                        <td width="15%"><?=$opd['age'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">เลขบัตรประชาชน</td>
                        <td><?=$opd['idcard'];?></td>
                        <td class="tb-title">น้ำหนัก</td>
                        <td><?=$opd['weight'];?> กก.</td>
                        <td class="tb-title">ส่วนสูง</td>
                        <td><?=$opd['height'];?> ซม.</td>
                        <td class="tb-title">BP</td>
                        <td><?=$opd['bp1'].'/'.$opd['bp2'];?> mmHg</td>
                    </tr>
                    <tr>
                        <td class="tb-title">T</td>
                        <td><?=$opd['temperature'];?> &#8451;</td>
                        <td class="tb-title">P</td>
                        <td><?=$opd['pause'];?> ครั้ง/นาที</td>
                        <td class="tb-title">R</td>
                        <td><?=$opd['rate'];?> ครั้ง/นาที</td>
                        <td class="tb-title">กรุ๊ปเลือด</td>
                        <td><?=$opd['blood'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">โรคประจำตัว</td>
                        <td><?=$opd['organ'];?></td>
                        <td class="tb-title">สูบบุหรี่</td>
                        <td>
                            <?php
                            $cig_code = $opd['cigarette'];
                            echo $cig_lists[$cig_code];

                            if( !empty($opd['cigarette']) ){
                                $cigok_code = $opd['cigok'];
                                echo ' ('.$cigok_lists[$cigok_code].')';
                            }
                            ?>
                        </td>
                        <td class="tb-title">ดื่มสุรา</td>
                        <td>
                            <?php 
                            $al_code = $opd['alcohol'];
                            echo $al_lists[$al_code];
                            ?>
                        </td>
                        <td class="tb-title">แพ้ยา</td>
                        <td>
                            <?php 
                            $react_code = $opd['drugreact'];
                            echo $drugreact_lists[$react_code];
                            ?>
                        </td>
                    </tr>
                    <tr>
                    
                        <td class="tb-title">ลักษณะอาการ</td>
                        <td><?=$opd['type'];?></td>
                        <td class="tb-title">อาการ</td>
                        <td><?=$opd['organ'];?></td>
                        <td class="tb-title">BMI</td>
                        <td>
                            <?php 
                            $ht = $opd["height"] / 100;
                            echo number_format(($_SESSION["weight"]/($ht*$ht)),2);
                            ?>
                        </td>
                        <td class=""></td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>ข้อมูลทางห้องปฏิบัติการ</h3></td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td colspan="2" align="center">CBC</td>
                    </tr>
                    <tr>
                        <td>test</td>
                        <td>1234</td>
                    </tr>
                </table>
            </td>
            <td>
                <table  width="100%">
                    <tr>
                        <td colspan="2" align="center">UA</td>
                    </tr>
                    <tr>
                        <td>test</td>
                        <td>1234</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>
    <table class="chk_table">
        <tr>
            <td colspan="2" class="title"><h3>ข้อมูลสุขภาพ</h3></td>
        </tr>
        <tr>
            <td width="25%" class="tb-title">การคัดกรองการได้ยิน</td>
            <td>
                <label for="ear1"><input type="radio" name="ear" id="ear1"> ปกติ </label>
                <label for="ear2"><input type="radio" name="ear" id="ear2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">การตรวจเต้านมโดยแพทย์<br>หรือบุคลากรสาธารณสุข</td>
            <td>
                <label for="breast1"><input type="radio" name="breast" id="breast1"> ปกติ </label>
                <label for="breast2"><input type="radio" name="breast" id="breast2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">การตรวจตาโดยความดูแลของจักษุแพทย์</td>
            <td>
                <label for="eye1"><input type="radio" name="eye" id="eye1"> ปกติ </label>
                <label for="eye2"><input type="radio" name="eye" id="eye2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">การตรวจตาด้วย Snellen eye Chart</td>
            <td>
                <label for="snell_eye1"><input type="radio" name="snell_eye" id="snell_eye1"> ปกติ </label>
                <label for="snell_eye2"><input type="radio" name="snell_eye" id="snell_eye2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">Chest X-ray <a href="http://pacssrsh/explore.asp?path=/All%20Patients/InternalPatientUID=58-2733" target="_blank">ดูผลการตรวจ</a> </td>
            <td>
                <label for="cxr1"><input type="radio" name="cxr" id="cxr1"> ปกติ </label>
                <label for="cxr2"><input type="radio" name="cxr" id="cxr2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">สรุปผลตรวจ</td>
            <td>
                <label for="conclution1"><input type="radio" name="conclution" id="conclution1"> ปกติ </label>
                <label for="conclution2"><input type="radio" name="conclution" id="conclution2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="tb-title" style="text-align: left;">คำแนะนำเพิ่มเติมในการดูแลสุขภาพ</p>
                <textarea name="suggestion" cols="60" rows="8" id="" placeholder="ทดสอบรายละเอียดเพิ่มเติม"></textarea>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
    </table>
    <br>
    <div align="center">
        <button type="submit">บันทึกข้อมูล</button>
    </div>
</form>