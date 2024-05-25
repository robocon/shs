<?php 
session_start();
require_once 'config.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$json = file_get_contents('php://input');
$data = json_decode($json, true);
$action = $data['action'];
if ($action == 'save') {
    
    $hn = $data['hn'];
    $ptright = $data['ptright'];

    $q = $dbi->query("UPDATE `opcard` SET `ptright` = '$ptright' WHERE `hn` = '$hn' ");
    if($q===true){
        $res = array('status_code'=>200);
    }else{
        $res = array('status_code'=>400,'message'=>$dbi->error);
    }

    echo json_encode($res);
    exit;
}

$title = 'ระบบตรวจสอบสิทธิผู้ป่วยนัดผ่าน WebService สปสช';

$q = $dbi->query("SELECT `cid`,`token` FROM `runno_token` WHERE `id` = '1'");
$t = $q->fetch_assoc();
$person_id = preg_replace('/\D/','', $t['cid']);
$smctoken = $t['token'];

$dateAppoint = date('Y-m-d');
list($y, $m, $d) = explode('-', $dateAppoint);

$thDateAppoint = $d.' '.$def_fullm_th[$m].' '.($y+543);

$sqlAppoint = "SELECT b.`idcard`,b.`ptright`,a.* 
FROM (
    SELECT `hn`,`room`,`detail`,`doctor`,`ptname` 
    FROM `appoint` 
    WHERE `appdate_en` = '$dateAppoint' 
    AND `apptime` != 'ยกเลิกการนัด' 
    AND (`detail` NOT LIKE 'FU18%' AND `detail` NOT LIKE 'FU39%' ) 
    ORDER BY `doctor`,`room`,`apptime`
) AS a 
LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn` 
LIMIT 5";
$qAppoint = $dbi->query($sqlAppoint);

$userList = array();
$userForJs = array();
while ($a = $qAppoint->fetch_assoc()) { 
    $key = $a['idcard'];
    $userForJs[] = "'$key'";
    $userList[$key] = $a;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title;?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<style>
    .contentBetween{
        display: flex;
        justify-content: space-between;
    }
</style>

<div class="container">
<h3 class="text-center"><?=$title;?></h3>
<h5 class="text-center">ผู้ป่วยนัดวันที่ <?=$thDateAppoint;?></h5>
<table class="table table-sm table-hover">
    <thead>
        <tr class="table-success align-top">
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>แผนก/ห้อง</th>
            <th>แพทย์</th>
            <th>สิทธิ</th>
            <th>
                WebService สปสช<br>
                <button class="btn btn-primary" onclick="getNhsoData()">เริ่มตรวจสอบสิทธิ</button>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($userList as $key => $user) {
        ?>
        <tr>
            <td><?=$user['hn'];?></td>
            <td><?=$user['ptname'];?></td>
            <td><div class="contentBetween"><span><?=$user['room'];?></span> <span><?='('.$user['detail'].')';?></span></div></td>
            <td><?=$user['doctor'];?></td>
            <td ondblclick="showPtright(this,'<?=$user['hn'];?>')"><?=$user['ptright'];?></td>
            <td><div id="<?=$user['idcard'];?>" class="contentBetween"></div></td>
        </tr>
        <?php 
        }
        ?>
    </tbody>
</table>

</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script>

    var currentElement = null;
    var oldValue = null;
    function showPtright(el,hn){
        
        oldValue = el.innerHTML;
        currentElement = el;

        let option = '';
        for (let index = 0; index < ptrightList.length; index++) {
            const ele = ptrightList[index];
            const ptCode = ele.code+' '+ele.name;
            option += '<option value="'+ptCode+'">'+ptCode+'</option>';
        }

        let selectOption = '<select onchange="updatePtright(this.value,\''+hn+'\')" style="width:200px;">';
        selectOption += '<option value="">&gt;&gt;&nbsp;เลือกสิทธิ&nbsp;&lt;&lt;</option>'+option+'</select>';
        el.innerHTML = selectOption;

    }

    var ptrightList = [];
    async function getPtright(){
        const response = await fetch('http://192.168.131.240:8081/api/ptright');
        const data = await response.json();
        ptrightList = data.list;
    }

    async function updatePtright(v, hn, parent){
        
        if(v==""){
            return false;
        }

        data = {
            'hn': hn,
            'ptright': v,
            'action':'save'
        };

        const response = await fetch('appointToday.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        const res = await response.json();

        if(res.status_code==200){
            
            alert('บันทึกข้อมูลเรียบร้อย');
            currentElement.innerHTML = v;
        }else{
            alert('ไม่สามารถบันทึกข้อมูลได้'+res.message);
            currentElement.innerHTML = oldValue;
        }
        
    }

    const appointUserList = [<?=implode(',',$userForJs);?>];
    const person_id = '<?=$person_id;?>';
    const smctoken = '<?=$smctoken;?>';

    window.onload = function(){
        getPtright();
    }

    async function getNhsoData(){
        
        for (let index = 0; index < appointUserList.length; index++) {
            const el = appointUserList[index];
            let data = null;
            const response = await fetch('http://192.168.129.143/appointNhso.php?idcard='+el+'&user_person_id='+person_id+'&smctoken='+smctoken);
            data = await response.json();

            res = '';
            let item = document.getElementById(el);
            
            if(data!==null && data.count_select === 0){
                res = data.ws_status_desc;
                item.setAttribute('style','color: red;');
            }else if(data!==null && data.count_select > 0){
                res = '<span>'+data.maininscl_name+'</span> <span>('+data.subinscl_name+')</span>';
            }
            item.innerHTML = res;
            
        }
        
    }
</script>
</body>
</html>