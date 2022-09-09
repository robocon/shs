<?php 
include 'bootstrap.php'; 

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
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

<fieldset>
    <legend>ค้นหาตามวันที่</legend>
    <form action="echo_form_print.php" method="post">
        <?php 
        $date = (empty($_POST['date'])) ? (date('Y')+543).date('-m-d') : $_POST['date'] ;
        ?>
        <div>
            เลือกวันที่ <input type="text" name="date" id="date" value="<?=$date;?>">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="action" value="search">
        </div>
    </form>
</fieldset>
<?php 
$action = $_POST['action'];
if($action === "search"){
    
    list($y,$m,$d) = explode('-', $date);
    $date = bc_to_ad($_POST['date']);
    $sql = "SELECT `id`, `date`, `hn`, `ptname`, `vn`, `doctor` FROM `echo_cardio` WHERE `date` LIKE '$date%' ";
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
                    <th>VN</th>
                    <th>ผู้บันทึก</th>
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
                    <td><?=$a['vn'];?></td>
                    <td><?=$a['doctor'];?></td>
                    <td><a href="echo_print.php?id=<?=$a['id'];?>&hn=<?=$a['hn'];?>">พิมพ์</a></td>
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
}
?>