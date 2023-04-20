<?php 
include_once 'bootstrap.php';
include_once 'includes/JSON.php';
$action = sprintf("%s", $_POST['action']);
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

if ($action==='save') { 

    $hn = sprintf("%s", $_POST['hn']);
    $curr_th_date = (date('Y')+543).date('-m-d');
    $cookie_key = $curr_th_date.$hn;
    $cookie_name = "fresh_wound[$cookie_key]";

    $date = date('Y-m-d');
    $datehn = $curr_th_date.$hn;

    $owner = $_SESSION['sOfficer'];
    $ftwn = sprintf("%s", $_POST['ftwn']);

    $json = new Services_JSON();
    $ftwa = $json->encode($_POST['ftwa']);
    $ftwb = $json->encode($_POST['ftwb']);

    $sql = "SELECT * FROM `ftw` WHERE `datehn` = '$datehn' ";
    $q = $dbi->query($sql);
    if($q->num_rows > 0){ 
        $a = $q->fetch_assoc();
        $ftw_id = $a['id'];

        $sql = "UPDATE `ftw` SET 
        `date`='$date', 
        `hn`='$hn', 
        `datehn`='$datehn', 
        `ftwa`='$ftwa', 
        `ftwb`='$ftwb', 
        `ftwn`='$ftwn', 
        `owner`='$owner' 
        WHERE (`id`='$ftw_id');";

    }else {
        $sql = "INSERT INTO `ftw` (`id`, `date`, `hn`, `datehn`, `ftwa`, `ftwb`, `ftwn`, `owner`) 
        VALUES 
        (NULL, '$date', '$hn', '$datehn', '$ftwa', '$ftwb', '$ftwn', '$owner');";
    }
    $save = $dbi->query($sql);

    setcookie($cookie_name, 1, strtotime('today 23:59'), '/');
    ?>
    <div style="text-align: center;border: 1px solid #009688;background-color: #009688;color: #ffffff;">
        <p><b>บันทึกข้อมูลเรียบร้อย</b></p>
    </div>
    <script>
        window.onload = function(){
            setTimeout(function(){
                window.close();
            }, 1000);
        }
    </script>
    <?php
    exit;
}

$view = sprintf("%s", $_GET['view']);
$hn = sprintf("%s", $_GET['hn']);

$datehn = (date('Y')+543).date('-m-d').$hn;
$sql = "SELECT * FROM `ftw` WHERE `datehn` = '$datehn' ";
$q = $dbi->query($sql);
$a = array();
if($q->num_rows > 0){
    $a = $q->fetch_assoc();
}

$json = new Services_JSON();
$ftwa = $json->decode($a['ftwa']);
$a1 = in_array('a1',$ftwa)===true ? 'checked="checked"' : '';
$a2 = in_array('a2',$ftwa)===true ? 'checked="checked"' : '';
$a3 = in_array('a3',$ftwa)===true ? 'checked="checked"' : '';
$a4 = in_array('a4',$ftwa)===true ? 'checked="checked"' : '';
$a5 = in_array('a5',$ftwa)===true ? 'checked="checked"' : '';

$ftwb = $json->decode($a['ftwb']);
$b1 = in_array('b1',$ftwb)===true ? 'checked="checked"' : '';
$b2 = in_array('b2',$ftwb)===true ? 'checked="checked"' : '';
$b3 = in_array('b3',$ftwb)===true ? 'checked="checked"' : '';
$b4 = in_array('b4',$ftwb)===true ? 'checked="checked"' : '';

$n = ($a['ftwn']=='n') ? 'checked="checked"' : '';

?>
<style>
    *{
        font-family: "TH Sarabun New","TH SarabunPSK";
        font-size: 18px;
    }
    p, ol{
        margin:0;
        padding:0;
    }
    li{
        margin-left: 16px;
    }
    input[type=checkbox]:hover, label:hover{
        cursor: pointer;
    }
</style>
<form action="er_form_fresh_wound.php" method="post">
    <div>
        <h3 style="text-align:center;">แบบฟอร์มคัดกรองบาดแผลสด : Fresh Traumatic Wound (FTW)*</h3>
        <p style="text-align:center;">*FTW = บาดแผลสดจาก อุบัติเหตุที่เกิด<u>ภายใน 6 ชั่วโมง</u>ก่อนได้รับการรักษา</p>
    </div>
    <div>
        <h3><u>กรุณาเลือกลักษณะอาการของผู้ป่วยด้านล่างนี้ โดยลักษณะอาการด้านล่างเป็นลักษณะอาการของผู้ป่วย Fresh Traumatic Wound ที่สมเหตุสมผลที่จะได้รับยาปฏิชีวนะ</u></h3>
    </div>
    <div>
        <table border="1">
            <tr>
                <td align="center"><b>ลักษณะของบาดแผล</b></td>
                <td align="center"><b>การประเมิน</b></td>
                <td></td>
            </tr>
            <tr style="background-color: #d1d1d1;">
                <td><b>บาดแผลที่มีโอกาสติดเชื้อและควรใช้ยาปฏิชีวนะ</b></td>
                <td></td>
                <td align="center"><b>ยาปฏิชีวนะที่แนะนำ</b></td>
            </tr>
            <tr>
                <td>1.แผลขอบไม่เรียบ เย็บแผลให้ขอบชนกันได้ไม่สนิท</td>
                <td align="center"><input type="checkbox" name="ftwa[]" id="ftw_a01" value="a1" <?=$a1;?> ></td>
                <td rowspan="5">
                    <p>1<sup>st</sup>-line : Dicloxacillin 250-500 mg QID ขณะท้องว่าง</p>
                    <p><u>กรณีแพ้ Penicillin</u></p>
                    <ol>
                        <li><b>Clindamycin</b> 300mg TID</li>
                        <li><b>Erythromycin dry sry.</b> 20-50 mg/kg/day แบ่งให้3-4ครั้งขณะท้องว่าง</li>
                        <li><b>Roxithromycin</b> 150mg BID</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td>2.แผลลึกถึงกล้ามเนื้อ เอ็น หรือกระดูก</td>
                <td align="center"><input type="checkbox" name="ftwa[]" id="ftw_a02" value="a2" <?=$a2;?>></td>
            </tr>
            <tr>
                <td>3.แผลยาวกว่า 5 ซม.</td>
                <td align="center"><input type="checkbox" name="ftwa[]" id="ftw_a03" value="a3" <?=$a3;?>></td>
            </tr>
            <tr>
                <td>4.แผลจากการบดอัด (เช่น โดนประตูหนีบอย่างแรง)</td>
                <td align="center"><input type="checkbox" name="ftwa[]" id="ftw_a04" value="a4" <?=$a4;?>></td>
            </tr>
            <tr>
                <td>5.ผู้ป่วยภูมิต้านทานต่ำ (เช่น อายุ >65ปี เบาหวาน ตับแข็ง โรคพิษสุราเรื้อรัง หลอดเลือดส่วนปลายตีบ มะเร็ง ได้รับยากดภูมิ)</td>
                <td align="center"><input type="checkbox" name="ftwa[]" id="ftw_a05" value="a5" <?=$a5;?>></td>
            </tr>
            <tr style="background-color: #d1d1d1;">
                <td><b>บาดแผลที่มีสิ่งปนเปื้อนและควรได้ยาปฏิชีวนะ</b></td>
                <td></td>
                <td align="center"><b>ยาปฏิชีวนะที่แนะนำ พิจารณาให้ tetanus toxoid ร่วมด้วย</b></td>
            </tr>
            <tr>
                <td>1.แผลสัตว์กัด/คนกัด (อาจให้ยาปฏิชีวนะนาน 3-5วัน และพิจารณาใช้ rabies vaccine, rabies immunoglobulin ร่วมด้วย)</td>
                <td align="center"><input type="checkbox" name="ftwb[]" id="ftw_b01" value="b1" <?=$b1;?> ></td>
                <td rowspan="4">
                    <p>1<sup>st</sup>-line : <b>Amoxycillin-Clavulanic acid</b></p>
                    <p>เด็ก = Amox-Clav โดยให้ Amoxy 20-50 mg/kg/day แบ่งให้ 3ครั้ง<br>(MAX: Amoxy 250mg/dose)</p>
                    <p>ผู้ใหญ่ = 625 mg BID</p>
                    <p><u>กรณีแพ้ Penicillin</u></p>
                    <p><b>Ciprofloxacin</b> 500 mg BID + <b>Clindamycin</b> 300 mg TID</p>
                    <p><b>Ciprofloxacin</b> 500 mg BID + <b>Metronidazole</b> 400-500 mg TID</p>
                </td>
            </tr>
            <tr>
                <td>2.มีเนื้อตายบริเวณกว้าง</td>
                <td align="center"><input type="checkbox" name="ftwb[]" id="ftw_b02" value="b2" <?=$b2;?>></td>
            </tr>
            <tr>
                <td>3.มีสิ่งสกปรกติดอยู่ในแผลล้างไม่ออก</td>
                <td align="center"><input type="checkbox" name="ftwb[]" id="ftw_b03" value="b3" <?=$b3;?>></td>
            </tr>
            <tr>
                <td>4.ปนเปื้อนสิ่งที่มีแบคทีเรียมาก (เช่น อจจาระ น้ำสกปรก)</td>
                <td align="center"><input type="checkbox" name="ftwb[]" id="ftw_b04" value="b4" <?=$b4;?>></td>
            </tr>
        </table>
    </div>
    <div>
        <p style="margin: 16px;"><input type="checkbox" name="ftwn" id="ftw_n" value="n" <?=$n;?> ><b><u><label for="ftw_n">ไม่เข้าเกณฑ์การได้รับยาปฏิชีวนะ</label></u></b></p>
        <p>คณะอนุกรรมการส่งเสริมการใช้ยาอย่างสมเหตุผล</p>
        <p>Reference: แนวทางการใช้ยาปฏิชีวนะอย่างสมเหตุผล. 2554 [ออนไลน์]: http://newsser.fda.moph.go.th/rumthai/userfiledownload/asu173dl.pdf</p>
    </div>
    <?php 
    if ($view=='saveform') {
        ?>
        <div style="text-align:center;">
            <button type="submit" style="padding: 8px; 16px">บันทึกข้อมูล</button>
            <input type="hidden" name="hn" value="<?=$_GET['hn'];?>">
            <input type="hidden" name="action" value="save">
        </div>
        <?php
    }
    ?>
    
</form>