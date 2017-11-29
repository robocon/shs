<?php

// session_start();

// include("connect.inc");

include 'bootstrap.php';
include 'dt_menu.php';
// include("dt_menu.php");

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

$sql = "SELECT * FROM `opd` WHERE `thdatehn` = '$date_hn'";
$db->select($sql);
$pt = $db->get_item();

$sql = "SELECT b.`name`  
FROM `opcardchk` AS a 
LEFT JOIN `chk_company_list` AS b ON b.`code` = a.`part` 
WHERE a.`HN` = '$hn' ";

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
                        <td width="15%"><?=$pt['ptname'];?></td>
                        <td width="10%" class="tb-title">HN</td>
                        <td width="15%"><?=$pt['hn'];?></td>
                        <td width="10%" class="tb-title">บริษัท</td>
                        <td width="15%">xxx</td>
                        <td width="10%" class="tb-title">อายุ</td>
                        <td width="15%"><?=$pt['age'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">น้ำหนัก</td>
                        <td><?=$pt['weight'];?></td>
                        <td class="tb-title">ส่วนสูง</td>
                        <td><?=$pt['height'];?></td>
                        <td class="tb-title">BP</td>
                        <td><?=$pt['bp1'].'/'.$pt['bp2'];?></td>
                        <td class="tb-title">Repeat-BP</td>
                        <td>xxx</td>
                    </tr>
                    <tr>
                        <td class="tb-title">T</td>
                        <td><?=$pt['temperature'];?></td>
                        <td class="tb-title">P</td>
                        <td><?=$pt['pause'];?></td>
                        <td class="tb-title">R</td>
                        <td><?=$pt['rate'];?></td>
                        <td class="tb-title">โรคประจำตัว</td>
                        <td><?=$pt['organ'];?></td>
                    </tr>
                    <tr>
                        <td class="tb-title">สูบบุหรี่</td>
                        <td><?=$pt['cigarette'];?></td>
                        <td class="tb-title">ดื่มสุรา</td>
                        <td><?=$pt['alcohol'];?></td>
                        <td class="tb-title">ออกกำลังกาย</td>
                        <td><?=$pt['exercise'];?></td>
                        <td class="tb-title">แพ้ยา</td>
                        <td><?=$pt['drugreact'];?></td>
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
            <td width="25%" class="tb-title">การคัดกรองการได้ยิน : </td>
            <td>
                <label for="ear1"><input type="radio" name="ear" id="ear1"> ปกติ </label>
                <label for="ear2"><input type="radio" name="ear" id="ear2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">การตรวจเต้านมโดยแพทย์<br>หรือบุคลากรสาธารณสุข : </td>
            <td>
                <label for="breast1"><input type="radio" name="breast" id="breast1"> ปกติ </label>
                <label for="breast2"><input type="radio" name="breast" id="breast2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">การตรวจตาโดยความดูแลของจักษุแพทย์ : </td>
            <td>
                <label for="eye1"><input type="radio" name="eye" id="eye1"> ปกติ </label>
                <label for="eye2"><input type="radio" name="eye" id="eye2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">การตรวจตาด้วย Snellen eye Chart : </td>
            <td>
                <label for="snell_eye1"><input type="radio" name="snell_eye" id="snell_eye1"> ปกติ </label>
                <label for="snell_eye2"><input type="radio" name="snell_eye" id="snell_eye2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">Chest X-ray : <a href="http://pacssrsh/explore.asp?path=/All%20Patients/InternalPatientUID=58-2733" target="_blank">ดูผลการตรวจ</a> </td>
            <td>
                <label for="cxr1"><input type="radio" name="cxr" id="cxr1"> ปกติ </label>
                <label for="cxr2"><input type="radio" name="cxr" id="cxr2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td class="tb-title">สรุปผลตรวจ : </td>
            <td>
                <label for="conclution1"><input type="radio" name="conclution" id="conclution1"> ปกติ </label>
                <label for="conclution2"><input type="radio" name="conclution" id="conclution2"> ผิดปกติ </label>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p class="tb-title">คำแนะนำเพิ่มเติมในการดูแลสุขภาพ</p>
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