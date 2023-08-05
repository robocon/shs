<?php 
require_once 'config.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$title = 'ระบบตรวจสอบสิทธิผู้ป่วยนัดผ่าน WebService สปสช';

$q = $dbi->query("SELECT `cid`,`token` FROM `runno_token` WHERE `id` = '1'");
$t = $q->fetch_assoc();
$person_id = preg_replace('/\D/','', $t['cid']);
$smctoken = $t['token'];

$dateAppoint = '2023-08-05';
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
LIMIT 4";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">  
</head>
<body>
<div class="container">
<h3 class="text-center"><?=$title;?></h3>
<h5 class="text-center">ผู้ป่วยนัดวันที่ <?=$thDateAppoint;?></h5>
<table class="table table-sm table-hover">
    <thead>
        <tr class="table-success">
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>ห้อง</th>
            <th>แพทย์</th>
            <th>สิทธิ</th>
            <th>WebService สปสช</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($userList as $key => $user) {
        ?>
        <tr>
            <td><?=$user['hn'];?></td>
            <td><?=$user['ptname'];?></td>
            <td><?=$user['room'].'('.$user['detail'].')';?></td>
            <td><?=$user['doctor'];?></td>
            <td><?=$user['ptright'];?></td>
            <td id="<?=$user['idcard'];?>"></td>
        </tr>
        <?php 
        }
        ?>
    </tbody>
</table>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script>
    const appointUserList = [<?=implode(',',$userForJs);?>];
    const person_id = '<?=$person_id;?>';
    const smctoken = '<?=$smctoken;?>';

    window.onload = function(){
        getNhsoData();
    }

    async function getNhsoData(){
        
        for (let index = 0; index < appointUserList.length; index++) {
            const el = appointUserList[index];
            const response = await fetch('appointNhso.php?idcard='+el+'&user_person_id='+person_id+'&smctoken='+smctoken);
            const data = await response.json();

            res = '';
            let item = document.getElementById(el);
            if(data.count_select === 0){
                res = data.ws_status_desc;
                item.setAttribute('style','color: red;');
            }else{
                res = data.maininscl_name+'('+data.subinscl_name+')';
            }
            item.innerHTML = res;
            
        }
        
    }
</script>
</body>
</html>