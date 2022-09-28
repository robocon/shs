<?php 
require_once 'bootstrap.php';
require_once 'class_file/opday.php';
require_once 'class_file/opcard.php';

if(authen()===false){
    redirect("login_page.php");
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสุขภาพสิทธิประกันสังคม</title>
</head>
<body>
    <style>
        *{
            font-family: "TH Sarabun New","TH SarabunPSK";
            font-size: 20px;
        }
    </style>
    <div>
        <h3>ตรวจสุขภาพสิทธิประกันสังคม</h3>
    </div>
    <div>
        <fieldset>
            <legend>ค้นหาจาก HN</legend>
            <form action="orderlabsso.php" method="post">
                <div>
                    HN: <input type="text" name="hn" id="hn">
                </div>
                <div>
                    <button type="submit">ค้นหา</button>
                    <input type="hidden" name="action" value="search">
                </div>
            </form>
        </fieldset>
    </div>
    <?php 
    $action = $_POST['action'];
    if ($action == 'search') {
        $hn = $_POST['hn'];

        $oc = new Opcard();
        $pt = $oc->getByHn($hn);
        if(!empty($pt)){

            $opday = new Opday();
            $op = $opday->getThisDay($hn);
            if(!empty($op)){ 
                ?>
                <p style="color: red;"><b>วันนี้ผู้ป่วยมีการออก VN(<?=$op['vn'];?>) เรียบร้อยแล้ว กรุณาตรวจสอบความถูกต้องอีกครั้งก่อนดำเนินการต่อไป</b></p>
                <?php
            }

            $age = findPtAge($pt['dbirth']);
            ?>
            <form action="orderlabsso2.php" method="post">
                <h3>ข้อมูลเบื้องต้นผู้มารับบริการ</h3>
                <table>
                    <tr>
                        <td align="right"><b>ชื่อ-สกุล:</b></td>
                        <td><?=$pt['yot'].$pt['name'].' '.$pt['surname'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>HN:</b></td>
                        <td><?=$pt['hn'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>อายุ:</b></td>
                        <td><?=$age;?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>สิทธิ:</b></td>
                        <td><?=$pt['ptright'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>ประเภทสิทธิ:</b></td>
                        <td><?=$pt['ptrightdetail'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>รพ.ต้นสังกัด:</b></td>
                        <td><?=$pt['hospcode'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>ออก OPD CARD:</b></td>
                        <td>
                            <select name="toborow" id="toborow">
                                <option value="EX46 ตรวจสุขภาพประกันสังคม">EX46 ตรวจสุขภาพประกันสังคม</option>
                                <option value="EX26 ตรวจสุขภาพประจำปี">EX26 ตรวจสุขภาพประจำปี</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="right"></td>
                        <td>
                            <input type="checkbox" name="extra" id="extra" value="1"> กรณีเป็นเจ้าหน้าที่ นวดแผนไทย กับ ไตเทียม
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button type="submit" style="padding:8px;">ดำเนินการออก VN ต่อไป &gt;&gt;</button>
                            <input type="hidden" name="hn" id="hn" value="<?=$hn;?>" >
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            
        }else{
            ?><p>ไม่พบ HN <?=$hn;?> ตรวจสอบข้อมูลอีกครั้ง</p><?php
        }
    }
?>
</body>
</html>