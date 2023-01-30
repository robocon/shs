<?php 
include 'bootstrap.php'; 

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_REQUEST['action']);
if($action=='cancel'){
    $id = sprintf("%s", $_REQUEST['id']);
    $dbi->query("UPDATE `echo_cardio` SET `status` = 'n' WHERE `id` = '$id' LIMIT 1");
    redirect("echo_form_print.php","บันทึกข้อมูลเรียบร้อย");
    exit;
}
?>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 18px;
    }
    h3{
        font-weight: bold;
        font-size: 24px;
        margin: 0;
        padding: 0;
    }
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table th,
    .chk_table td{
        border: 1px solid black;
        font-size: 16pt;
        padding: 3px;
    }
</style>
<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก ร.พ.ฯ</a>
</div>
<?php 
if(!empty($_SESSION['x-msg'])){
    ?>
    <p style="color: green; font-weight: bold;"><?=$_SESSION['x-msg'];?></p>
    <?php
    $_SESSION['x-msg'] = null;
}
?>
<fieldset>
    <legend>พิมพ์ผล Echo</legend>
    <form action="echo_form_print.php" method="post">
        <?php 
        $date = (empty($_POST['date'])) ? (date('Y')+543).date('-m-d') : $_POST['date'] ;
        ?>
        <div>
            เลือกวันที่ <input type="text" name="date" id="date" value="<?=$date;?>">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="search">
        </div>
    </form>
</fieldset>
<?php 
$page = sprintf("%s", $_REQUEST['page']);
if($page === "search"){
    
    list($y,$m,$d) = explode('-', $date);
    $date = bc_to_ad($_POST['date']);
    $sql = "SELECT `id`, `date`, `hn`, `ptname`, `vn`, `doctor`,`type` FROM `echo_cardio` WHERE `date` LIKE '$date%' AND `status` = 'y'";
    $q = $dbi->query($sql);
    if($q->num_rows > 0){
        ?>
        <div><h3>รายชื่อผู้มารับบริการ <span>วันที่ <?=$d.' '.$def_fullm_th[$m].' '.$y;?></span></h3></div>
        <table class="chk_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>วันที่</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>ประเภท</th>
                    <th>VN / AN</th>
                    <th>ผู้บันทึก</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$a['date'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['type'];?></td>
                    <td><?=$a['vn'];?></td>
                    <td><?=$a['doctor'];?></td>
                    <td><a href="echo_print.php?id=<?=$a['id'];?>&hn=<?=$a['hn'];?>" target="_blank">พิมพ์</a></td>
                    <td><a href="echo_form_print.php?action=cancel&id=<?=$a['id'];?>" onclick="return confirm('ยืนยันที่จะยกเลิกข้อมูล');">ยกเลิก</a></td>
                    <th>
                        <a href="echo_form_print.php?page=reprint&id=<?=$a['id'];?>&hn=<?=$a['hn'];?>">Visit อื่น</a>
                    </th>
                </tr>
                <?php
                $i++;
            }
            ?>
            </tbody>
        </table>
        <?php
    }else{
        ?>
        <p>ไม่พบข้อมูลวันที่ดังกล่าว</p>
        <?php
    }
}elseif($page==='reprint'){
    $id = sprintf("%s", $_REQUEST['id']);
    $hn = sprintf("%s", $_REQUEST['hn']);

    $prevD = strtotime("-3 months");
    $start = (date('Y', $prevD) + 543) . date('-m-d', $prevD);
    $end = (date('Y') + 543) . date('-m-d');
    ?>
    <h3>เลือกรายการ Visit ที่เคยมาพบแพทย์</h3>
    <table class="chk_table">
        <tr>
            <th>วันที่</th>
            <th>VN</th>
            <th>แพทย์</th>
            <th>การมารพ.</th>
            <th></th>
        </tr>
    
    <?php
    $sql = "SELECT SUBSTRING(`thidate`,1,10) AS `date2`,`thidate`,`vn`,`doctor`,`toborow` FROM `opday` WHERE ( `thidate` >= '$start' AND `thidate` <= '$end' ) AND `hn` = '$hn' ";
    $q = $dbi->query($sql);
    if ($q->num_rows > 0) {
        while ($a = $q->fetch_assoc()) {
            ?>
            <tr>
                <td><?=$a['date2'];?></td>
                <td><?=$a['vn'];?></td>
                <td><?=$a['doctor'];?></td>
                <td><?=$a['toborow'];?></td>
                <td><a href="echo_print.php?id=<?=$id;?>&hn=<?=$hn;?>&date=<?=rawurldecode($a['thidate']);?>" target="_blank">พิมพ์</a></td>
            </tr>
            <?php
        }
    }
    ?>
    </table>
    <?php
}
?>