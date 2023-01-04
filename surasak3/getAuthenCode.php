<?php 
session_start();
include 'config.php';
$dbi = new mysqli(HOST, USER, PASS, DB);

function dump($txt){
    echo "<pre>";
    echo var_dump($txt);
    echo "</pre>";
}

$action = sprintf("%s", $_REQUEST['action']);
if($action==='save'){
    $pid = sprintf("%s", $_GET['pid']);
    $claimType = sprintf("%s", $_GET['claimType']);
    $mobile = sprintf("%s", $_GET['mobile']);
    $correlationId = sprintf("%s", $_GET['correlationId']);
    $hn = sprintf("%s", $_GET['hn']);
    $hcode = sprintf("%s", $_GET['hcode']);

    $post_field = array(
        'pid' => $pid,
        'claimType' => $claimType,
        'mobile' => $mobile,
        'correlationId' => $correlationId,
        'hn' => $hn,
        'hcode' => $hcode
    );

    $data_postfields = json_encode($post_field);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://localhost:8189/api/nhso-service/confirm-save");
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_postfields);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=utf-8"));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    $save = json_decode($output, true);
    

    if(!empty($save['status']) && $save['status']!=400){
        ?>
        <p><b>AuthenCode:</b> <?=$save['claimCode'];?></p>
        <a href="javascript:window.close();">ปิดหน้าต่าง</a>
        <?php
    }else{
        ?>
        <p style="color:red;"><b><?=$save['errors'][1]['defaultMessage'];?></b></p>
        <a href="javascript:window.close();">ปิดหน้าต่าง</a>
        <a href="getAuthenCode.php">ปิดหน้าต่าง</a>
        <?php
    }
    
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ขอ AuthenCode ผ่าน API</title>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 18px;
        }
        .chk_table{
            border-collapse: collapse;
        }

        .chk_table th,
        .chk_table td{
            padding: 3px;
            border: 1px solid black;
            font-size: 16pt;
        }
    </style>
</head>
<body>

<p style="margin:0; padding:0;"><b>ทดสอบการขอ Authen ผ่าน NHSO Secure Smartcard Agent</b></p>
<p style="margin:0; padding:0;"><b>ใช้งานผ่าน Google Chrome, Firefox, Microsoft Edge เท่านั้น</b></p>

<?php 
$to_page = sprintf("%d", $_POST['to_page']);
if ($to_page=="0") {
    ?>
    <form action="getAuthenCode.php" method="POST">
        <div>
            <button type="submit">ตรวจสอบสิทธิเบื้องต้น</button>
            <input type="hidden" name="to_page" value="2">
        </div>
    </form>
    <?php
}elseif ($to_page=="2") { 

    $url = 'http://localhost:8189/api/smartcard/read?readImageFlag=false';
    $curl = curl_init(); 
	curl_setopt( $curl, CURLOPT_URL, $url); 
	curl_setopt( $curl, CURLOPT_FRESH_CONNECT, 1); 
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $curl ); 
	curl_close($curl);
    $res_data = json_decode($result, true);
    if(!empty($res_data['status']) && $res_data['status']==418){
        ?>
        <div style="color:red;"><b><?=$res_data['message'];?></b></div>
        <a href="getAuthenCode.php">ดำเนินการใหม่อีกครั้ง</a>
        <?php

    }elseif(!empty($res_data['status']) && $res_data['status']=500){
        ?>
        <div style="color:red;"><b>กรุณาเสียบบัตรประชาชน</b></div>
        <a href="getAuthenCode.php">ดำเนินการใหม่อีกครั้ง</a>
        <?php

    }else{

        $idcard = $res_data['pid'];
        $q = $dbi->query("SELECT `hn`,`phone` FROM `opcard` WHERE `idcard`='$idcard' LIMIT 1");
        $hn = $mobile = '';
        if($q->num_rows > 0){
            $op = $q->fetch_assoc();
            $hn = $op['hn'];
            $mobile = $op['phone'];
        }

        ?>
        <style>
            .tb_title{
                text-align: right;
                font-weight: bold;
            }
        </style>
        <table>
            <tr>
                <td class="tb_title">HN:</td>
                <td colspan="3"><?=$hn;?></td>
            </tr>
            <tr>
                <td class="tb_title">บัตรปชช:</td>
                <td><?=$res_data['pid'];?></td>
                <td class="tb_title">ชื่อ-สกุล:</td>
                <td><?=$res_data['fname'].'  '.$res_data['lname'];?></td>
            </tr>
            <tr>
                <td class="tb_title">เพศ:</td>
                <td><?=$res_data['sex'];?></td>
                <td class="tb_title">อายุ:</td>
                <td><?=$res_data['age'];?></td>
            </tr>
            <tr>
                <td class="tb_title">เบอร์โทร:</td>
                <td><?=$mobile;?></td>
                <td class="tb_title"></td>
                <td></td>
            </tr>
            <tr>
                <td class="tb_title">โรงพยาบาลหลัก:</td>
                <td><?=$res_data['hospMain']['hname'].' ('.$res_data['hospMain']['hcode'].')';?></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="tb_title">สิทธิ์การรักษา:</td>
                <td colspan="3"><?=$res_data['mainInscl'].' - '.$res_data['subInscl'];?></td>
            </tr>
            <tr>
                <td class="tb_title">การเข้ารับบริการ</td>
                <td colspan="3">
                    <?php
                    foreach ($res_data['claimTypes'] as $key => $value) {

                        $url = 'getAuthenCode.php?action=save';
                        $url .= '&pid='.$res_data['pid'];
                        $url .= '&claimType='.$value['claimType'];
                        $url .= '&mobile='.$mobile;
                        $url .= '&correlationId='.$res_data['correlationId'];
                        $url .= '&hn='.$hn;
                        $url .= '&hcode='.$res_data['hospMain']['hcode'];

                        ?>
                        <a href="<?=$url;?>" onclick="return confirm('ยืนยันการบันทึกข้อมูล');"><?=$value['claimTypeName'];?></a><br>
                        <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
        <?php
    }
}
?>
<br>
<div>
    <div>
        <b>ประวัติการขอ Authen Code 5 ครั้งล่าสุด</b>
    </div>
    <div>
        <?php 
        $get_idcard = sprintf("%s", $_GET['idcard']);
        ?>
        <button type="button" onclick="getHistory(<?=$get_idcard;?>)">ดูประวัติ</button>
    </div>
    <div id="resHistory"></div>
</div>

<script>
    function getHistory(idcard){
        loadHistory(idcard);
    }

    async function loadHistory(idcard){ 
        var res = document.getElementById('resHistory');
        var response = await fetch('http://localhost:8189/api/nhso-service/latest-5-authen-code-all-hospital/'+idcard);
        if(response.ok){
            var data = await response.json();
            if(data.length==0){
                res.innerHTML = '<p><b>ไม่พบข้อมูลการขอ AuthenCode</b></p>';

            }else{ 
                var table = '<table class="chk_table"><tr><th>#</th><th>hcode</th><th>claimType</th><th>claimCode</th><th>claimDateTime</th></tr>';
                var i = 1;
                data.forEach(el => {
                    table+='<tr>';
                    table+='<td>'+i+'</td>';
                    table+='<td>'+el.hcode+'</td>';
                    table+='<td>'+el.claimType+'</td>';
                    table+='<td>'+el.claimCode+'</td>';
                    table+='<td>'+el.claimDateTime+'</td>';
                    table+='</td>';
                    i++;
                });
                table+='</table>';
                res.innerHTML = table;
            }

        }else{
            res.innerHTML = 'ไม่พบ SmartCard Agent กรุณาติดตั้ง <a href="https://www.nhso.go.th/downloads/208" target="_blank">NHSO Secure SmartCard Agent.</a> ก่อนใช้งาน';
        
        }
    }
</script>

</body>
</html>