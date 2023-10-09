<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

function getRduForm6($dateHn=null, $drugcode=null){
    global $dbi;
    $sql = "SELECT * FROM rdu_form6 WHERE dateHn='$dateHn' AND drugcode='$drugcode' LIMIT 1";
    $q = $dbi->query($sql);
    $res = false;
    if($q->num_rows>0){
        $res = $q->fetch_assoc();
    }
    return $res;
}

$action = sprintf($_POST['action']);
if ($action==='save_form') {
    
    $hn = sprintf("%s", $_POST['hn']);
    $icd10 = sprintf("%s", $_POST['icd10']);
    $drugcode = sprintf("%s", $_POST['drugcode']);

    $in1_1 = sprintf("%s", $_POST['1_1']);
    $in1_2 = sprintf("%s", $_POST['1_2']);
    $in1_3 = sprintf("%s", $_POST['1_3']);
    $in1_4 = sprintf("%s", $_POST['1_4']);
    $in2_1 = sprintf("%s", $_POST['2_1']);
    $in2_2 = sprintf("%s", $_POST['2_2']);
    $in2_3 = sprintf("%s", $_POST['2_3']);
    $in3_1 = sprintf("%s", $_POST['3_1']);
    $in3_2 = sprintf("%s", $_POST['3_2']);
    $in4_1 = sprintf("%s", $_POST['4_1']);
    $in4_2 = sprintf("%s", $_POST['4_2']);
    $inNoChoise = sprintf("%s", $_POST['noChoise']);
    $doctor = sprintf("%s", $_SESSION['sOfficer']);
    $dateHn = date('Y-m-d').$hn;

    $cookie_name = "rdu_form6[$dateHn]";

    $resRduForm6 = getRduForm6($dateHn, $drugcode);
    if($resRduForm6===false){
        $sql = "INSERT INTO `rdu_form6` 
        (`id`, `date`, `hn`, `dateHn`, `icd10`, `drugcode`, 
        `in1_1`, `in1_2`, `in1_3`, `in1_4`, `in2_1`, `in2_2`, 
        `in2_3`, `in3_1`, `in3_2`, `in4_1`, `in4_2`, `noChoise`, 
        `doctor`) 
        VALUES 
        (NULL, NOW(), '$hn', '$dateHn', '$icd10', '$drugcode', 
        '$in1_1', '$in1_2', '$in1_3', '$in1_4', '$in2_1', '$in2_2', 
        '$in2_3', '$in3_1', '$in3_2', '$in4_1', '$in4_2', '$inNoChoise', 
        '$doctor');";
    }else{ 
        $id = $resRduForm6['id'];
        $sql = "UPDATE `rdu_form6` SET 
        `hn`='$hn', 
        `dateHn`='$dateHn', 
        `icd10`='$icd10', 
        `drugcode`='$drugcode', 
        `in1_1`='$in1_1', 
        `in1_2`='$in1_2', 
        `in1_3`='$in1_3', 
        `in1_4`='$in1_4', 
        `in2_1`='$in2_1', 
        `in2_2`='$in2_2', 
        `in2_3`='$in2_3', 
        `in3_1`='$in3_1', 
        `in3_2`='$in3_2', 
        `in4_1`='$in4_1', 
        `in4_2`='$in4_2', 
        `noChoise`='$inNoChoise', 
        `doctor`='$doctor' 
        WHERE id = '$id';";
    }

    $save = $dbi->query($sql);
    $res = 'บันทึกข้อมูลเรียบร้อย';
    if ($save===false) {
        $res = "ERROR : ".$dbi->error;
    }else{
        setcookie($cookie_name, 1, strtotime('today UTC 23:59:59'), '/');
    }

    ?>
    <div style="padding: 4px; background-color: #198754; color: white; text-align: center;">
        <?=$res;?> <br>หน้าต่างจะปิดใน <span id="showTime"></span>
    </div>
    <script>
        window.onload = function(){ 
            window.opener.setCookie('<?=$cookie_name;?>','1','<?=strtotime('today UTC 23:59:59').'000';?>');
            setTimeout(function(){
                window.close();
            }, 3000);

            var count = 3;
            document.getElementById('showTime').innerHTML = count;
            var timerId = setInterval(function(){
                
                count--;
                
                if (count == 0) {
                    clearInterval(timerId);
                }

                document.getElementById('showTime').innerHTML = count;
                
            }, 1000);
            
        }
    </script>
    <?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respiratory Infection</title>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK","TH Sarabun New";
            font-size: 18px;
        }
        label:hover{
            cursor: pointer;
        }
        .bg_header{
            background-color: #b8b8b8;
        }
        .bg_title{
            background-color: #e1e1e1;
        }
        p{
            margin:0;
            padding:0;
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
    <div align="center" style="font-size: 24px;">
        <h2>แบบฟอร์มคัดกรองโรคติดเชื้อทางเดินหายใจส่วนบนและหลอดลมอักเสบเฉียบพลัน (Respiratory Infection)<br>ที่มีสาเหตุจากเชื้อแบคทีเรีย</h2>
    </div>
    <div align="center">
        * Respiratory Infection = โรคติดเชื้อทางเดินหายใจส่วนบนและหลอดลมอักเสบเฉียบพลัน เช่น คอหอยอักเสบ/ต่อมทอนซิลอักเสบเฉียบพลัน<br>ไซนัสอักเสบเฉียบพลัน หูชั้นกลางอักเสบเฉียบพลัน และหลอดลมอักเสบเฉียบพลัน
    </div>
    <div align="center" style="font-size: 24px;">
        <h3>กรุณาเลือกลักษณะอาการของผู้ป่วยด้านล่างนี้ โดยลักษณะอาการด้านล่างเป็นลักษณะอาการของผู้ป่วย Respiratory Infection<br>ที่สมเหตุสมผลที่จะได้รับยาปฏิชีวนะ</h3>
    </div>
    <form action="rdu_form6.php" method="post" onsubmit="return check_rdu_form6();">
        <table class="chk_table">
            <tr class="bg_header">
                <th>เกณฑ์การใช้ยาปฏิชีวนะ </th>
                <th>การประเมิน</th>
            </tr>
            <tr class="bg_title">
                <th colspan="2" align="left">
                &#11162; เกณฑ์การใช้ยาปฏิชีวนะในผู้ป่วย โรคคอหอยอักเสบ/ต่อมทอนซิลอักเสบเฉียบพลันจากเชื้อ Group A Streptococcus (Centor criteria) (มีลักษณะต่อไปนี้ ≥3 ข้อ ยกเว้น ผู้ป่วยโรคหัวใจรูห์มาติกและผู้ป่วยภูมิคุ้มกันบกพร่อง พิจารณาให้ยาปฏิชีวนะแม้เกณฑ์วินิจฉัยไม่ครบ)
                </th>
            </tr>
            <tr>
                <td><label for="1_1">1. ไข้ (BT >38°C)</label></td>
                <td align="center"><input type="checkbox" name="1_1" id="1_1" value="1" onclick="count_choise(this)"></td>
            </tr>
            <tr>
                <td><label for="1_2">2. Exudate/Pustule ที่คอหอย/ต่อมทอลซิล</label></td>
                <td align="center"><input type="checkbox" name="1_2" id="1_2" value="2" onclick="count_choise(this)"></td>
            </tr>
            <tr>
                <td><label for="1_3">3. ต่อมน้ำเหลืองที่คอ (anterior cervical lymph nodes) โต/กดเจ็บ (ที่ไม่ใช่ต่อมน้ำเหลืองใต้คาง หรือ submandibular lymph nodes)</label></td>
                <td align="center"><input type="checkbox" name="1_3" id="1_3" value="3" onclick="count_choise(this)"></td>
            </tr>
            <tr>
                <td><label for="1_4">4. ไม่มีอาการไอ</label></td>
                <td align="center"><input type="checkbox" name="1_4" id="1_4" value="4" onclick="count_choise(this)"></td>
            </tr>
            <tr class="bg_title">
                <th colspan="2" align="left">
                &#11162; เกณฑ์การใช้ยาปฏิชีวนะในผู้ป่วยโรคไซนัสอักเสบเฉียบพลันจากเชื้อแบคทีเรีย (อย่างน้อย 1 ข้อ)
                </th>
            </tr>
            <tr>
                <td><label for="2_1">1. มีอาการของหวัด ไซนัสอักเสบตั้งแต่ 10 วัน โดยอาการไม่ดีขึ้น</label></td>
                <td align="center"><input type="checkbox" name="2_1" id="2_1" value="1" onclick="count_choise(this)"></td>
            </tr>
            <tr>
                <td><label for="2_2">2. มีไข้สูง (BT 39°C) ตั้งแต่เริ่มป่วย ร่วมกับน้ำมูกเหลือง-เขียว หรือเจ็บที่ใบหน้าต่อเนื่องนานอย่างน้อย 3-4 วัน</label></td>
                <td align="center"><input type="checkbox" name="2_2" id="2_2" value="2" onclick="count_choise(this)"></td>
            </tr>
            <tr>
                <td><label for="2_3">3.  Double worsening (มีอาการของหวัด ไซนัสอักเสบนาน 5-6 วันแล้วอาการดีขึ้น แต่กลับมามีอาการอีกครั้ง)</label></td>
                <td align="center"><input type="checkbox" name="2_3" id="2_3" value="3" onclick="count_choise(this)"></td>
            </tr>
            <tr class="bg_title">
                <th colspan="2" align="left">
                &#11162; เกณฑ์การใช้ยาปฏิชีวนะในผู้ป่วยโรคหูชั้นกลางอักเสบเฉียบพลันจากเชื้อแบคทีเรีย (อย่างน้อย 1 ข้อ)
                </th>
            </tr>
            <tr>
                <td><label for="3_1">1. อาการรุนแรงมาก หรืออาการไม่ดีขึ้นเองใน 3 วัน หรือพบ tympanic membrane โป่ง หรือมี otorrhea หรือ อาการดีขึ้นแล้วกลับมีอาการเพิ่มขึ้นอีก</label></td>
                <td align="center"><input type="checkbox" name="3_1" id="3_1" value="1" onclick="count_choise(this)"></td>
            </tr>
            <tr>
                <td><label for="3_2">2. ไม่ตอบสนองต่อการรักษาด้วย amoxicillin</label></td>
                <td align="center"><input type="checkbox" name="3_2" id="3_2" value="2" onclick="count_choise(this)"></td>
            </tr>
            <tr class="bg_title">
                <th colspan="2" align="left">
                &#11162; เกณฑ์การใช้ยาปฏิชีวนะในผู้ป่วยโรคกล่องเสียงและท่อลมอักเสบเฉียบพลันจากเชื้อแบคทีเรีย (อย่างน้อย 1 ข้อ)
                </th>
            </tr>
            <tr>
                <td><label for="4_1">1. เสมหะเขียวเหนียวจ้านวนมาก ร่วมกับมีไข</label></td>
                <td align="center"><input type="checkbox" name="4_1" id="4_1" value="1" onclick="count_choise(this)"></td>
            </tr>
            <tr>
                <td><label for="4_2">2. ไม่ตอบสนองต่อ Nebulized epinephrine หรือ glucocorticoids</label></td>
                <td align="center"><input type="checkbox" name="4_2" id="4_2" value="2" onclick="count_choise(this)"></td>
            </tr>
        </table>
        <div style="padding: 8px; 0">
            <input type="checkbox" name="noChoise" id="noChoise" value="1" onclick="count_choise(this)"><label for="noChoise"><u><b style="font-size:24px;">ไม่เข้าเกณฑ์การได้รับยาปฏิชีวนะ</b></u></label>
        </div>
        <div align="center">
            <button type="submit" style="padding: 4px 16px; font-size: 28px;">บันทึก</button>
            <input type="hidden" name="action" id="action" value="save_form">
            <input type="hidden" name="hn" value="<?=sprintf("%s", $_GET['hn']);?>">
            <input type="hidden" name="icd10" value="<?=sprintf("%s", $_GET['icd10']);?>">
            <input type="hidden" name="drugcode" value="<?=sprintf("%s", $_GET['drugcode']);?>">
        </div>
    </form>
    <div>
        <p><b>คณะอนุกรรมการส่งเสริมการใช้ยาอย่างสมเหตุผล</b></p>
        <p>Reference: แนวทางการใช้ยาปฏิชีวนะอย่างสมเหตุผล. 2554 [ออนไลน์]: http://newsser.fda.moph.go.th/rumthai/userfiledownload/asu173dl.pdf</p>
    </div>
    <script>

        var choise = 0;

        function check_rdu_form6(){ 

            var res = true;
            if (choise==0) {
                alert('กรุณาเลือกตัวเลือกอย่างน้อย 1 ตัว');
                res = false;
            }

            return res;
        }

        function count_choise(item){
            if(item.checked===true){
                choise++;
            }else{
                choise--;
            }
        }
        
    </script>
</body>
</html>