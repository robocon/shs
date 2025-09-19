<?php
include dirname(__FILE__).'/bootstrap.php';

// session_start();
if (isset($_SESSION['sIdname'])) {
} else {
    die;
} //for security

// include("connect.inc");

//wardpage.php
// session_unregister("cDepart");
// session_unregister("aDetail");
// session_unregister("cTitle");

//ipdata.php
// session_unregister("x");
// session_unregister("aDgcode");
// session_unregister("aTrade");
// session_unregister("aPrice");
// session_unregister("aPart");
// session_unregister("aAmount");
// session_unregister("aMoney");
// session_unregister("Netprice");
// session_unregister('cDate');
// session_unregister('cBedcode');
// session_unregister('cBed');
// session_unregister('cPtname');
// session_unregister('cAge');
// session_unregister('cPtright');
// session_unregister('cDoctor');
// session_unregister('cHn');
// session_unregister('cAn');
// session_unregister('cDiag');
// session_unregister('cBedpri');
// session_unregister('cChgdate');
// session_unregister('cBedname');
// session_unregister('cAccno');
// session_unregister("nRunno");
////
// var_dump($_GET);
// echo "<hr>";

// $Bedcode = $cBedcode;
// session_register("Bedcode");

///////////
// session_register('cBedcode');
// session_register('cBed');
// $_SESSION["cBedcode"] = $_GET["cBedcode"];
// $_SESSION["cBed"] = $_GET["cBed"];

$sql = sprintf("SELECT * FROM `bed` WHERE `an`='%s' limit 1", $dbi->real_escape_string($_GET['cAn']));
$q = $dbi->query($sql);
$res = $q->num_rows;
if($res>0){
    $arr = $q->fetch_assoc();
}else{
    ?>
    <p><b>ไม่พบข้อมูล AN: <?=$_GET['cAn'];?> กรุณาตรวจสอบข้อมูลอีกครั้ง</b></p>
    <?php
    exit;
}
?>
<style>
    legend { font-size: 16px; font-weight: bold; color: #06F; padding:0px 3px; }
    fieldset { display: inline; width: 70%; margin-right: 40px; }
</style>

<fieldset>
    <legend>ข้อมูลผู้ป่วย</legend>
    <table>
        <tr>
            <td align="right"><b>เตียง: </b></td>
            <td><?=$arr['bedcode'];?></td>
        </tr>
        <tr>
            <td align="right"><b>ชื่อ-สกุล: </b></td>
            <td><?=$arr['ptname'];?></td>
        </tr>
        <tr>
            <td align="right"><b>HN: </b></td>
            <td><?=$arr['hn'];?> <b>AN: </b><?=$arr['an'];?></td>
        </tr>
        <tr>
            <td align="right"><b>อาหารเดิมเป็น: </b></td>
            <td><?=$arr['food'];?></td>
        </tr>
    </table>
</fieldset>

<form method="POST" action="ipfoodok.php" onsubmit="return checkForm();">
    <fieldset>
        <legend>เปลี่ยนอาหาร</legend>
        <BR />
        <table border="0">
            <tr>
                <td align="right">เปลี่ยนอาหารเป็น :</td>
                <td>
                    <select size="1" name="food">
                        <option selected>อาหารปกติ</option>
                        <option>อาหารอ่อน</option>
                        <option>อาหารเหลว</option>
                        <option>NPO (งดอาหาร, น้ำ)</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <td align="right">ต้องการแยกภาชนะ :</td>
                <td>
                    <input type="radio" name="food_container" id="food_container1" value="0"><label for="food_container1">ไม่แยก</label>
                    <input type="radio" name="food_container" id="food_container2" value="1"><label for="food_container2">แยก</label>
                    <div style="display:none;" id="noti_food_container">กรุณาเลือกภาชนะ</div>
                </td>
            </tr>
            <tr>
                <td align="right"> อาหารสั่งเพิ่ม :</td>
                <td><input type="text" name="addfood" size="70"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" value="  ตกลง  " name="B1" />
                    <input type="reset" value="  ลบทิ้ง  " name="B2" />
                    <input type="hidden" name="hn" value="<?=$arr['hn'] ?>" />
                    <input type="hidden" name="an" value="<?=$arr['an']; ?>" />
                    <input type="hidden" name="bedcode" value="<?=$arr['bedcode'] ?>" />
                    <input type="hidden" name="food_old" value="<?=htmlspecialchars($arr['food'], ENT_QUOTES); ?>" />
                    <input type="hidden" name="ward" value="<?=$_GET['cbedname']; ?>" />
                    <input type="hidden" name="lastcall" value="<?=$arr['lastcalroom']; ?>" />

                </td>
            </tr>
        </table>

    </fieldset>
</form>
<script type="text/javascript">
function checkForm() {

    var txt = "";
    var stat = true;

    var fc1 = document.getElementById('food_container1').checked;
    var fc2 = document.getElementById('food_container2').checked;
    
    if(fc1===false && fc2===false){
        stat = false;
        txt += "- กรุณาเลือกภาชนะ";
    }

    if (stat == false) {
        alert(txt);
    }
    return stat;
}
</script>