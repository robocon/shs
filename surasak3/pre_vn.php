<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/class_file/class_opcard.php';
include_once dirname(__FILE__).'/class_file/class_opday.php';
include_once dirname(__FILE__).'/class_file/class_opcardchk.php';
include_once dirname(__FILE__).'/includes/JSON.php';

$content = file_get_contents('php://input');
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$data = $json->decode($content);

$classOpday = new Opday();
$classOpcardchk = new Opcardchk();

/**
 * @readme แก้ไปแก้มาจะกลายเป็นว่า แทบจะสร้าง opcardchk ตัวใหม่ขึ้นมาอีกละ
 * หรือจะเพิ่ม field เข้าไปใน opcardchk ดีหว่า มีฟิลด์ chk_company_id, vn, ptright, thdatehn(dd-mm-YYYYHN)
 */

if($data['action']==='updateOpcardchk'){

    $chk_company_id = $data['company_id'];
    $company = $classOpcardchk->getComanyNameFromId($chk_company_id);
    $part = $company['part'];

    // if (empty($data['user'])) {
    //     $res = array('status'=>400, 'msg'=>'ไม่พบข้อมูล');
    // }else{

    /**
     * ⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️
     * @todo ปรับเป็นการเอาค่าที่ได้รับจาก POST มาเทียบกับใน pre_vn ว่าใครเป็นคนใหม่ คนเก่า เพราะ POST ที่ส่งมาเป็นรายชื่อจากใน opcardchk ไม่ใช่จาก pre_vn โดยตรง
     * แล้วเขียนอยกตาม statement ว่าจะให้อัพเดท หรือว่า เพิ่มข้อมูลเข้าไปใหม่
     */
    foreach ($data['user'] as $hn => $ptright) {
        
        $preVnUser = $classOpcardchk->getPreVnUser($hn, $chk_company_id);
        dump($preVnUser);
        if($preVnUser==false){
            // INSERT
            $u = $classOpcardchk->getUserFromHnAndCompany($hn, $part);
            dump($u);

            $name = $u['name'];
            $surname = $u['surname'];
            $idcard = $u['idcard'];

            $sqlPreVn = "INSERT INTO `pre_vn` 
            (`id`, `hn`, `name`, `surname`, `idcard`, `ptright`, `chk_company_id`) 
            VALUES 
            (NULL, '$hn', '$name', '$surname', '$idcard', '$ptright', '$chk_company_id');";
            // $q = $dbi->query($sqlPreVn);
            dump($sqlPreVn);
        }else{
            // UPDATE
            $sqlUpdate = "UPDATE `pre_vn` SET 
            `ptright`='$ptright' 
            WHERE (`hn`='$hn' AND `chk_company_id` = '$chk_company_id');";
            // $q = $dbi->query($sqlUpdate);
            dump($sqlUpdate);
        }
    }
        
    // }
    echo $json->encode($res);
    exit;
}elseif($data['action']==='generateVn'){
    $chk_company_id = $data['company_id'];

    $sql = "SELECT * FROM `pre_vn` WHERE `chk_company_id` = '$chk_company_id' AND (`vn` IS NULL OR `vn` == '') ORDER BY `id` ASC";
    while($a = $q->fetch_assoc()){
            
        $hn = $a['hn'];
        $ptrightCode = $a['ptright'];

        $thisDay = $classOpday->getThisDay($hn);
        if($thisDay===false){

            if($ptrightCode=='R33'){
                $classOpday->setToborow('EX51 ตรวจสุขภาพ อปท.');
            }elseif ($ptrightCode=='R07') {
                $classOpday->setToborow('EX46 ตรวจสุขภาพประกันสังคม');
            }
            
            $classOpday->sOfficer = 'กรรณิกา ทาใจ';
            $opday = $classOpday->createOpday($hn);


            /**
             * ⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️
             * @todo อัพเดทใน pre_vn ด้วยจ้า
             */
        }
    }



    $res = array('status'=>400,'msg'=>'กำลังพัฒนาใจเยนๆโยม');
    echo $json->encode($res);
    exit;
}

if(empty($_GET['id'])){
    include 'pageNotFound.php';
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าออกVN</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
</style>
<div class="container-fluid">
    <h1 class="mt-3">ตั้งค่าเตรียมออก VN</h1>
    <?php
    $currentDateEn = date('Y-m-d');
    $sql = sprintf("SELECT * FROM `chk_company_list` WHERE `id`='%s' AND `job_date_run`='$currentDateEn' ", $dbi->real_escape_string($_GET['id']));
    $q = $dbi->query($sql);
    $item = $q->fetch_assoc();
    if($item['job_status']!=='r'){
        ?>
        <p><strong>มีการออก VN ไปเรียบร้อยแล้ว</strong></p>
        <?php
    }else{
    ?>
    <div class="row">
        <div class="col">
            <h3>STEP 1 ตรวจสอบสิทธิและบันทึก</h3>
            <div><span class="badge text-bg-warning">* อัพเดทข้อมูล ยังไม่ออก VN</span></div>
            <div><span class="badge text-bg-warning">* จะทำการออก VN เฉพาะสิทธิประกันสังคมเท่านั้น</span></div>
        </div>
        <div class="col">
            <h3>STEP 2</h3>
            <span class="badge text-bg-warning">* ออก VN</span>
        </div>
        <div class="col"><h3>STEP 3</h3></div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <form action="pre_vn.php" method="post" onsubmit="saveOpcardchk()">
                <div>
                <!-- <button type="submit">ดำเนินการออก vn อัตโนมัติ องค์การบริหารส่วนจังหวัดลำปาง 68</button> -->
                <?php
                    $chk_company_id = $item['id'];
                    $code = $item['code'];

                    $sqlPreVn = "SELECT * FROM `pre_vn` WHERE `chk_company_id` = '$chk_company_id' ";
                    $qPreVn = $dbi->query($sqlPreVn);
                    $preVnRows = $qPreVn->num_rows;
                    if($preVnRows>0){
                        ?>
                        <input type="hidden" name="prevnStatus" id="prevnStatus" value="1">
                        <?php
                    }else{
                        ?>
                        <input type="hidden" name="prevnStatus" id="prevnStatus" value="0">
                        <?php
                    }

                    $sqlPtright = "SELECT `code`,`name` FROM `ptright` WHERE `chk_up` = 'y'";
                    $qPtright = $dbi->query($sqlPtright);
                    $ptrightItems = array();
                    while ($ptright = $qPtright->fetch_assoc()) {
                        $ptrightItems[] = $ptright;
                    }

                    $sqlChkCompany = "SELECT a.*,SUBSTRING(b.`ptright`,1,3) AS `ptCode`, b.`ptright` FROM (
                        SELECT `HN` AS `hn`,`exam_no`,`name`,`surname`,`idcard` FROM `opcardchk` WHERE `part` = '$code'
                    ) AS a 
                    LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn` 
                    ORDER BY `exam_no` ASC";
                    $qChk = $dbi->query($sqlChkCompany);
                    if($qChk->num_rows>0){
                        ?>
                        <table>
                            <tr>
                                <th>HN</th>
                                <th>Exam no</th>
                                <th>ชื่อสกุล</th>
                                <th>เลือกสิทธิ</th>
                            </tr>
                        <?php
                        $i = 1;
                        while ($a = $qChk->fetch_assoc()) { 
                            /**
                             * ⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️⚠️v
                             * @todo ต้องเอาไปเทียบกับชื่อใน pre_vn อีกครั้งหนึ่งว่าใครเป็นรายชื่อใหม่ หรือรายชื่อเก่าบ้าง
                             */
                            ?>
                            <tr>
                                <td>
                                    <?= $a['hn']; ?>
                                    <input type="hidden" name="hn[]" value="<?= $a['hn']; ?>">
                                </td>
                                <td>
                                    <?= $a['exam_no']; ?>
                                    <input type="hidden" name="exam_no[]" value="<?= $a['exam_no']; ?>">
                                </td>
                                <td><?= $a['name'].'  '.$a['surname']; ?></td>
                                <td>
                                    <select name="ptright[]" class="user-ptright">
                                    <?php
                                    foreach ($ptrightItems as $key => $ptright) {
                                        $selected = $ptright['code']==$a['ptCode'] ? 'selected="selected"' : '';
                                        ?>
                                        <option 
                                            value="<?= $ptright['code'];?>" 
                                            <?= $selected;?> 
                                        ><?= $ptright['code'].' '.$ptright['name']; ?></option>
                                        <?php
                                    }
                                    ?>
                                    </select>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                        </table>
                        <?php
                    }
                    ?>
                    <input type="hidden" name="action" value="generate">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </form>
            <script>
                function saveOpcardchk(){
                    event.preventDefault();
                    
                    // const ptrights = document.getElementsByClassName('user-ptright');
                    let formData = new FormData();
                    // formData.append('action', 'updateOpcardchk');
                    // for (let index = 0; index < ptrights.length; index++) {
                    //     const element = ptrights[index];
                    //     if(element.value==='R07'){
                    //         formData.append(element.getAttribute('name'), element.value);
                    //     }
                    // }

                    const inputExamno = document.getElementsByName('hn[]');
                    const inputPtright = document.getElementsByName('ptright[]');
                    const prevnStatus = document.getElementById('prevnStatus').value;

                    let user = {};

                    let ii = 0;
                    inputPtright.forEach(input => {
                            let key = inputExamno[ii].value;
                            user[key] = input.value;
                        ii++;
                    });
                    formData['user'] = user;
                    formData['action'] = 'updateOpcardchk';
                    formData['company_id'] = '<?= $chk_company_id;?>';
                    formData['prevnStatus'] = prevnStatus;
                    
                    onSaveOpcardchk(formData).then((res)=>{
                        console.log(res);
                    });
                }

                async function onSaveOpcardchk(formData){
                    const response = await fetch('pre_vn.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    });
                    const body = await response.json();
                    return body;
                }
            </script>
        </div>
        <div class="col align-self-end">
            <button class="btn btn-primary" onclick="generateVn()">ออก VN Manual</button>
            <script>
                function generateVn(){
                    Swal.fire("ออก VN");
                    // ยิง company id ไปที่ generateVn
                }
            </script>
        </div>
        <div class="col">
            <table>
                <tr>
                    <td>asdf</td>
                    <td>asdf</td>
                    <td>asdf</td>
                </tr>
            </table>
        </div>
    </div>
    <?php
    }
    ?>
</div>
<?php

exit;
$action = $_POST['action'];
if($action==='generate'){
    $sqlPreVn = "SELECT * FROM `pre_vn` ORDER BY `id` ASC";
    $q = $dbi->query($sqlPreVn);
    if($q->num_rows>0){
        ?>
        <table>
            <tr>
                <th>HN</th>
                <th>VN</th>
                <th>ชื่อ-สกุล</th>
                <th>สิทธิ์</th>
                <th>ออก OPD CARD</th>
                <th>จนท.</th>
            </tr>
        <?php
        while($a = $q->fetch_assoc()){
            
            $hn = $a['hn'];
            $ptrightCode = $a['ptright'];

            $thisDay = $classOpday->getThisDay($hn);
            if($thisDay===false){

                if($ptrightCode=='R33'){
                    $classOpday->setToborow('EX51 ตรวจสุขภาพ อปท.');
                }elseif ($ptrightCode=='R07') {
                    $classOpday->setToborow('EX46 ตรวจสุขภาพประกันสังคม');
                }
                
                $classOpday->sOfficer = 'กรรณิกา ทาใจ';
                $opday = $classOpday->createOpday($hn);
                ?>
                <tr bgcolor="green">
                    <td><?=$opday['hn'];?></td>
                    <td><?=$opday['vn'];?></td>
                    <td><?=$opday['ptname'];?></td>
                    <td><?=$opday['ptright'];?></td>
                    <td><?=$opday['toborow'];?></td>
                    <td><?=$opday['officer'];?></td>
                </tr>
                <?php
            }else{
                ?>
                <tr bgcolor="yellow">
                    <td><?=$thisDay['hn'];?></td>
                    <td><?=$thisDay['vn'];?></td>
                    <td><?=$thisDay['ptname'];?></td>
                    <td><?=$thisDay['ptright'];?></td>
                    <td><?=$thisDay['toborow'];?></td>
                    <td><?=$thisDay['officer'];?></td>
                </tr>
                <?php
            }
        }
        ?>
        </table>
        <?php
    }
}

?>
</body>
</html>