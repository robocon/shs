<?php
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_opcard.php';
require_once dirname(__FILE__).'/class_file/class_opday.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$classOpday = new Opday();

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
    <div class="row">
        <div class="col-md-auto">
            <h3>STEP 1 ตรวจสอบสิทธิและบันทึก</h3>
            <form action="pre_vn.php" method="post">
                <div>
                    <!-- <button type="submit">ดำเนินการออก vn อัตโนมัติ องค์การบริหารส่วนจังหวัดลำปาง 68</button> -->
                    <?php
                    $sql = sprintf("SELECT * FROM `chk_company_list` WHERE `id`='%s' AND `job_date_run` != '' AND `job_status` = 'r' ", $dbi->real_escape_string($_GET['id']));
                    $q = $dbi->query($sql);
                    if($q->num_rows>0){
                        $item = $q->fetch_assoc();
                        $chk_company_id = $item['id'];
                        $code = $item['code'];

                        $sqlPreVn = "SELECT * FROM `pre_vn` WHERE `chk_company_id` = '$chk_company_id' ";
                        $qPreVn = $dbi->query($sqlPreVn);

                        $sqlPtright = "SELECT `code`,`name` FROM `ptright` WHERE `chk_up` = 'y'";
                        $qPtright = $dbi->query($sqlPtright);
                        $ptrightItems = array();
                        while ($ptright = $qPtright->fetch_assoc()) {
                            $ptrightItems[] = $ptright;
                        }

                        $sqlChkCompany = "SELECT a.*,SUBSTRING(b.`ptright`,1,3) AS `ptCode`, b.`ptright` FROM (
                            SELECT `HN` AS `hn`,`exam_no`,`name`,`surname`,`idcard` FROM `opcardchk` WHERE `part` = '$code'
                        ) AS a 
                        LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`";
                        $qChk = $dbi->query($sqlChkCompany);
                        if($qChk->num_rows>0){
                            ?>
                            <table>
                                <tr>
                                    <th>HN</th>
                                    <th>Exam no</th>
                                    <th>ชื่อสกุล</th>
                                    <th>สิทธิ</th>
                                </tr>
                            <?php
                            $i = 1;
                            while ($a = $qChk->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $a['hn']; ?></td>
                                    <td><?= $a['exam_no']; ?></td>
                                    <td><?= $a['name'].'  '.$a['surname']; ?></td>
                                    <td>
                                        <select name="" id="">
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
                        <?php
                    }else{
                        ?><p><strong>ไม่พบข้อมูล</strong></p><?php
                    }
                    ?>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>
        <div class="col-md-auto align-self-center">
            <h3>STEP 2</h3>
            <button class="btn btn-primary">ออก VN Manual</button>
        </div>
        <div class="col-md-auto">
            <h3>STEP 3</h3>
            <table>
                <tr>
                    <td>asdf</td>
                    <td>asdf</td>
                    <td>asdf</td>
                </tr>
            </table>
        </div>
    </div>
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