<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$hn = sprintf("%s", $_GET['hn']);
$drugcode = sprintf("%s", $_GET['drugcode']);
$returnstr = sprintf("%s", $_GET['returnstr']);
// $doctor = sprintf("%s", $_GET['doctor']);

$action = sprintf("%s",$_POST['action']);
if($action==='save'){ 

    $hn = sprintf("%s", $_POST['hn']);
    $drugcode = sprintf("%s", $_POST['drugcode']);
    $returnstr = sprintf("%s", $_POST['returnstr']);
    $reason = sprintf("%s", $_POST['reason']);
    $dt_code = sprintf("%s", $_POST['dt_code']);
    $doctor = sprintf("%s", $_POST['doctor']);


    $datehn = date('Y-m-d').$hn;
    $sql = "INSERT INTO `dt_rechallenge` 
    (`id`, `date`, `hn`, `datehn`, `drugcode`, `doctor`, `dt_code`, `reason`, `returnstr`) 
    VALUES 
    (NULL, NOW(), '$hn', '$datehn', '$drugcode', '$doctor', '$dt_code', '$reason', '$returnstr');";
    $save = $dbi->query($sql);
    $msg = 'บันทึกข้อมูลเรียบร้อย';

    ?>
    <div style="text-align: center;border: 1px solid #009688;background-color: #009688;color: #ffffff;">
        <p><b>บันทึกข้อมูลเรียบร้อย</b></p>
        <p><b>รอสักครู่ หน้าต่างจะปิดอัตโนมัติ</b></p>
    </div>
    <div>
        <button type="button" onclick="btn_close()">ปิดหน้าต่าง</button>
    </div>
    <script type="text/javascript">
        window.onload = function(){ 
            // 
            parent.window.opener.callback_drug_rechallenge();
            setTimeout(function(){
                window.close();
            }, 2500);
        }

        function btn_close(){
            window.close();
        }
    </script>
    <?php
    exit;
}

$q_drug = $dbi->query("SELECT `drugcode`,`genname`,`tradname` FROM `druglst` WHERE `drugcode` = '$drugcode' ");
$d = $q_drug->fetch_assoc();

$q_opday = $dbi->query("SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' ");
$op = $q_opday->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แบบฟอร์มยินยอม Rechallenge</title>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 18px;
        }
        h1{
            font-size: 32px;
            margin:0;
        }
    </style>
    <div>
        <div style="text-align:center;">
            <h1>แบบฟอร์มยินยอม Rechallenge</h1>
        </div>
        <div>
            <form action="dt_drug_rechallenge.php" method="post" id="dt_form" onsubmit="return check_dt_form()">
                <table width="100%">
                    <tr>
                        <td align="right" style="background-color:#D4EFDF;"><b>แพทย์:</b> </td>
                        <td>
                            <?=$doctor;?>
                            <input type="hidden" name="doctor" value="<?=$doctor;?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" style="background-color:#D4EFDF;"><b>ต้องการใช้ยา:</b> </td>
                        <td>
                            <?=$d['drugcode'].' - '.$d['tradname'].' / '.$d['genname'];?>
                            <input type="hidden" name="drugcode" value="<?=$drugcode;?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" style="background-color:#D4EFDF;"><b>แก่:</b> </td>
                        <td>
                            <?=$op['ptname'].' ( HN '.$hn.' )';?>
                            <input type="hidden" name="hn" value="<?=$hn;?>">
                        </td>
                    </tr>
                    <tr>
                        <td align="right" style="background-color:#D4EFDF;"><b>เหตุผลการใช้ยา:</b> </td>
                        <td><input type="text" name="reason" id="reason"></td>
                    </tr>
                    <tr>
                        <td align="right" style="background-color:#D4EFDF;"><b>กรุณากรอกเลข ว. ของท่าน</b> </td>
                        <td><input type="text" name="dt_code" id="dt_code"> <b>เพื่อยืนยันการสั่งจ่ายยา</b></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <button type="submit" style="padding: 8px 16px;">บันทึกข้อมูล</button>
                            <input type="hidden" name="action" value="save">
                            <input type="hidden" name="returnstr" value="<?=$returnstr;?>">
                        </td>
                    </tr>
                </table>
            </form>
            <script type="text/javascript">
                function check_dt_form(){
                    // event.preventDefault();

                    var reason = document.getElementById('reason');
                    var dt_code = document.getElementById('dt_code');
                    var test_return = true;
                    if(reason.value==''){
                        alert('กรุณาให้เหตุผลการใช้ยา');
                        test_return = false;

                    }else if(dt_code.value==''){
                        alert('กรุณากรอกเลข ว. ของท่าน');
                        test_return = false;

                    }

                    return test_return;
                }
                
            </script>
        </div>
    </div>
</body>
</html>