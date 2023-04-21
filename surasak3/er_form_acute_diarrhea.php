<?php 
include_once 'bootstrap.php';
include_once 'includes/JSON.php';
$action = sprintf("%s", $_POST['action']);
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

if($action==='save'){

    $acu1 = sprintf("%s", $_POST['acu1']);
    $acu2 = sprintf("%s", $_POST['acu2']);
    $acu3 = sprintf("%s", $_POST['acu3']);
    $acu4 = sprintf("%s", $_POST['acu4']);
    $acu5 = sprintf("%s", $_POST['acu5']);
    $acu6 = sprintf("%s", $_POST['acu6']);
    $acu7 = sprintf("%s", $_POST['acu7']);
    $acu8 = sprintf("%s", $_POST['acu8']);
    $acu_n = sprintf("%s", $_POST['acu_n']);

    $hn = sprintf("%s", $_POST['hn']);
    $curr_th_date = (date('Y')+543).date('-m-d');
    $cookie_key = $curr_th_date.$hn;
    $cookie_name = "acute_diarrhea[$cookie_key]";

    $date = date('Y-m-d');
    $datehn = $curr_th_date.$hn;

    $owner = $_SESSION['sOfficer'];

    $sql = "SELECT * FROM `er_acute` WHERE `datehn` = '$datehn' ";
    $q = $dbi->query($sql);
    if($q->num_rows > 0){ 
        $a = $q->fetch_assoc();
        $id = $a['id'];

        $sql = "UPDATE `er_acute` SET `date`='$date',
         `hn`='$hn',
         `datehn`='$datehn',
         `acu1`='$acu1',
         `acu2`='$acu2',
         `acu3`='$acu3',
         `acu4`='$acu4',
         `acu5`='$acu5',
         `acu6`='$acu6',
         `acu7`='$acu7',
         `acu_n`='$acu_n',
         `owner`='$owner' 
         WHERE `id`='$id';";
    }else{
        $sql = "INSERT INTO `er_acute` (`id`, `date`, `hn`, `datehn`, `acu1`, `acu2`, `acu3`, `acu4`, `acu5`, `acu6`, `acu7`, `acu_n`, `owner`) 
        VALUES 
        (NULL, '$date', '$hn', '$datehn', '$acu1', '$acu2', '$acu3', '$acu4', '$acu5', '$acu6', '$acu7', '$acu_n', '$owner');";
    }
    $save = $dbi->query($sql);
    $msg = "บันทึกข้อมูลเรียบร้อย";
    if($save==false){
        $msg = "ไม่สามารถบันทึกข้อมูลได้ (".$dbi->error.")";
    }else{
        setcookie($cookie_name, 1, strtotime('today 23:59'), '/');
    }
    ?>
    <div style="text-align: center;border: 1px solid #009688;background-color: #009688;color: #ffffff;">
        <p><b><?=$msg;?></b></p>
    </div>
    <script>

        window.onload = function(){ 

            window.opener.setCookie('<?=$cookie_name;?>','1','<?=strtotime('today 23:59:59').'000';?>');

            setTimeout(function(){
                // window.close();
            }, 1000);
        }
    </script>
    <?php
    exit;
}

$view = sprintf("%s", $_GET['view']);
$hn = sprintf("%s", $_GET['hn']);

$datehn = (date('Y')+543).date('-m-d').$hn;

$sql = "SELECT * FROM `er_acute` WHERE `datehn` = '$datehn' ";
$q = $dbi->query($sql);
$a = array();
if($q->num_rows > 0){
    $a = $q->fetch_assoc();

    $acu1 = !empty($a['acu1']) ? 'checked="checked"' : '' ;
    $acu2 = !empty($a['acu2']) ? 'checked="checked"' : '' ;
    $acu3 = !empty($a['acu3']) ? 'checked="checked"' : '' ;
    $acu4 = !empty($a['acu4']) ? 'checked="checked"' : '' ;
    $acu5 = !empty($a['acu5']) ? 'checked="checked"' : '' ;
    $acu6 = !empty($a['acu6']) ? 'checked="checked"' : '' ;
    $acu7 = !empty($a['acu7']) ? 'checked="checked"' : '' ;
    $acu_n = !empty($a['acu_n']) ? 'checked="checked"' : '' ;
}
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
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table th,
    .chk_table td{
        border: 1px solid black;
        padding: 3px;
    }
</style>
<form action="er_form_acute_diarrhea.php" method="post">
    <div>
        <h3 style="text-align:center;">แบบฟอร์มคัดกรองท้องร่วงเฉียบพลัน : Acute Diarrhea*</h3>
        <p style="text-align:center;">*Acute Diarrhea = อุจจาระเหลวกว่าปกติอย่างน้อย 3ครั้ง/วัน หรือถ่ายอจจาระเป็นน้ำอย่างน้อย 1ครั้ง/วัน โดยมีอาการ &le;2สัปดาห์</p>
    </div>
    <div>
        <h3><u>กรุณาเลือกลักษณะอาการของผู้ป่วยด้านล่างนี้ โดยลักษณะอาการด้านล่างเป็นลักษณะอาการของผู้ป่วย <br>Acute Diarrhea ที่สมเหตุสมผลที่จะได้รับยาปฏิชีวนะ</u></h3>
    </div>
    <div>
        <table class="chk_table">
            <tr>
                <td align="center"><b>ลักษณะอาการที่สมเหตุสมผลที่จะได้รับปฏิชีวนะ</b></td>
                <td align="center"><b>การประเมิน</b></td>
            </tr>
            <tr>
                <td>1.อุจจาระเป็นมูกเลือด หรือพบ WBC และ RBC ในอุจจาระร่วมกับมีไข้(&ge;38&#8451;)</td>
                <td align="center"><input type="checkbox" name="acu1" id="acu1" value="1" <?=$acu1;?> ></td>
            </tr>
            <tr>
                <td>2.ทารกอายุ&le;3เดือน ถ่ายอุจจาระเป็นมูกเลือด หรือพบ WBC และ RBC ในอุจจาระ</td>
                <td align="center"><input type="checkbox" name="acu2" id="acu2" value="1" <?=$acu2;?> ></td>
            </tr>
            <tr>
                <td>3.ผู้ป่วยภูมิคุ้มกันบกพร่อง หรือผู้สูงอายุ(&ge;70ปี)</td>
                <td align="center"><input type="checkbox" name="acu3" id="acu3" value="1" <?=$acu3;?> ></td>
            </tr>
            <tr>
                <td>
                    4.ผู้ป่วยสงสัยติดเชื้อในกระแสเลือด หรืออาการรุนแรง คือมีอาการหรืออาการแสดงอย่างน้อย 1ข้อดังต่อไปนี้
                    <ol>
                        <li>ไข้สูง (&ge;38.5&#8451;)</li>
                        <li>มีอาการหรืออาการแสดงของภาวะ Hypovolemia</li>
                        <li>Unformed stool &ge;6ครั้ง ภายใน 24ชั่วโมงที่ผ่านมา</li>
                        <li>Severe abdominal pain</li>
                        <li>จำเป็นต้องเข้ารับการักษาในโรงพยาบาล</li>
                    </ol>
                </td>
                <td align="center"><input type="checkbox" name="acu4" id="acu4" value="1" <?=$acu4;?> ></td>
            </tr>
            <tr>
                <td>5.ถ่ายเป็นน้ำ ร่วมกับผลเพราะเชื้อเป็นเชื้อ Vibrio cholerae หรืออยู่ในพื้นที่ระบาดของโรคอหิวาตกโรค</td>
                <td align="center"><input type="checkbox" name="acu5" id="acu5" value="1" <?=$acu5;?> ></td>
            </tr>
            <tr>
                <td>6.กำลังได้รับ หรือเคยได้รับ broad spectrum antibiotic (ภายใน 3เดือนที่ผ่านมา) หรือเป็นผู้ป่วยกำลังรักษาตัวในโรงพยาบาล (&ge;3วัน) ร่วมกับตรวจยืนยันพบเชื้อ C. diffcile</td>
                <td align="center"><input type="checkbox" name="acu6" id="acu6" value="1" <?=$acu6;?> ></td>
            </tr>
            <tr>
                <td>7.ผลเพาะเชื้อจากอุจจาระบเชื้อ Entamoeba histolytica</td>
                <td align="center"><input type="checkbox" name="acu7" id="acu7" value="1" <?=$acu7;?> ></td>
            </tr>
        </table>
    </div>
    <div>
        <p style="margin: 16px;"><input type="checkbox" name="acu_n" id="acu_n" value="n" <?=$acu_n;?> ><b><u><label for="acu_n">ไม่เข้าเกณฑ์การได้รับยาปฏิชีวนะ</label></u></b></p>
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