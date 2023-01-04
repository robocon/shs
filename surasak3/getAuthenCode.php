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
        <p><a href="javascript:window.close();">ปิดหน้าต่าง</a></p>
        <?php
    }else{
        ?>
        <p style="color:red;"><b><?=$save['errors'][0]['defaultMessage'];?></b></p>
        <p><a href="javascript:window.close();">ปิดหน้าต่าง</a></p>
        <p><a href="getAuthenCode.php">กลับไปหน้าการขอ AuthenCode API</a></p>
        <?php
    }
    
    exit;
}elseif ($action==='getOpcard') {

    $idcard = $_REQUEST['idcard'];
    $q = $dbi->query("SELECT `hn`,`phone` FROM `opcard` WHERE `idcard`='$idcard' LIMIT 1");
    $hn = $mobile = '';
    if($q->num_rows > 0){
        $op = $q->fetch_assoc();
        $hn = $op['hn'];
        $mobile = $op['phone'];
    }
    header('Content-Type: application/json');
    echo json_encode(array('hn'=>$hn, 'mobile'=>$mobile));
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
        .tb_title{
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>

<p style="margin:0; padding:0;"><b>ทดสอบการขอ Authen ผ่าน NHSO Secure Smartcard Agent</b></p>
<p style="margin:0; padding:0;"><b>ใช้งานผ่าน Google Chrome, Firefox, Microsoft Edge เท่านั้น</b></p>

<form action="getAuthenCode.php" method="POST" id="mainForm">
    <div>
        <button type="submit">ตรวจสอบสิทธิเบื้องต้น</button>
    </div>
    <div id="resMain"></div>
</form>
<script>
    document.getElementById("mainForm").addEventListener('submit', (ev) => {
        ev.preventDefault();
        readSmartCard();
    });

    async function readSmartCard(){ 
        var res = document.getElementById("resMain");
        try {
            var response = await fetch('http://localhost:8189/api/smartcard/read?readImageFlag=true');
            var data = await response.json();
            
            if(data.status==418){
                res.innerHTML = '<div style="color:red;"><b>'+res.message+'</b></div>';
                
            }else if(data.status==500){
                res.innerHTML = '<div style="color:red;"><b>กรุณาเสียบบัตรประชาชนผู้มารับบริการ</b></div>';
                
            }else{
                console.log(data);
                var resOpcard = await fetch('getAuthenCode.php?action=getOpcard&idcard='+data.pid);
                var opcardTxt = await resOpcard.json();

                // console.log(opcardTxt);

                var resHtml = ' <table>';
                resHtml += '<tr><td rowspan="8"><img src="data:image/jpg;base64,'+data.image+'" style="height:150px;"></td></tr>';
                resHtml += '<tr><td class="tb_title">HN:</td><td colspan="3">'+opcardTxt.hn+'</td></tr>';
                resHtml += '<tr><td class="tb_title">บัตรปชช:</td><td>'+data.pid+'</td><td class="tb_title">ชื่อ-สกุล:</td><td>'+data.fname+' '+data.lname+'</td></tr>';
                resHtml += '<tr><td class="tb_title">เพศ:</td><td>'+data.sex+'</td><td class="tb_title">อายุ:</td><td>'+data.age+'</td></tr>';
                resHtml += '<tr><td class="tb_title">เบอร์โทร:</td><td>'+opcardTxt.mobile+'</td><td class="tb_title"></td><td></td></tr>';
                resHtml += '<tr><td class="tb_title">โรงพยาบาลหลัก:</td><td>'+data.hospMain.hname+' ('+data.hospMain.hcode+')</td><td></td><td></td></tr>';
                resHtml += '<tr><td class="tb_title">สิทธิ์การรักษา:</td><td colspan="3">'+data.mainInscl+' - '+data.subInscl+'</td></tr>';
                resHtml += '<tr valign="top"><td class="tb_title">เลือกการเข้ารับบริการ</td><td colspan="3">';
                data.claimTypes.forEach(el=>{ 

                    var url = 'getAuthenCode.php?action=save';
                    url += '&pid='+data.pid;
                    url += '&claimType='+el.claimType;
                    url += '&mobile='+opcardTxt.mobile;
                    url += '&correlationId='+data.correlationId;
                    url += '&hn='+opcardTxt.hn;
                    url += '&hcode='+data.hospMain.hcode;
                    
                    resHtml += '<a href="'+url+'" onclick="return confirm(\'ยืนยันการบันทึกข้อมูล\');">'+el.claimTypeName+'</a><br>';
                });
                resHtml += '</tr>';
                resHtml += '</table>';
                res.innerHTML = resHtml;
            }
        } catch (error) {
            res.innerHTML = '<div>ไม่พบ SmartCard Agent กรุณาติดตั้ง <a href="https://www.nhso.go.th/downloads/208" target="_blank">NHSO Secure SmartCard Agent.</a> ก่อนใช้งาน</div>';
            res.innerHTML += '<div><a href="https://drive.google.com/file/d/1-FSr-wGYGN_hpMtTSfYuKpYPnOq9uVyk/view" target="_blank">ชั้นตอนการติดตั้ง</a></div>';
        }
        
    }
</script>
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
        try {
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

            }
        } catch (error) {
            res.innerHTML = '<div>ไม่พบ SmartCard Agent กรุณาติดตั้ง <a href="https://www.nhso.go.th/downloads/208" target="_blank">NHSO Secure SmartCard Agent.</a> ก่อนใช้งาน</div>';
            res.innerHTML += '<div><a href="https://drive.google.com/file/d/1-FSr-wGYGN_hpMtTSfYuKpYPnOq9uVyk/view" target="_blank">ชั้นตอนการติดตั้ง</a></div>';
        }
        
    }
</script>

</body>
</html>