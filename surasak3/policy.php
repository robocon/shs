<?php 

include 'bootstrap.php';
$db = Mysql::load();

$action = input_post('action');
if( $action == 'save' ){

    include 'includes/JSON.php';

    $id = input_post('id');
    $hc = input_post('hc');

    $sql = "SELECT a.*,b.`dbirth` 
    FROM `opday` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE a.`row_id` = '$id'";
    $db->select($sql);
    $num_opday = $db->get_rows();

    if ( $num_opday > 0 ) {
        
    
        $item = $db->get_item();

        $year = date('Y');

        $d_update = $item['thidate'];
        $pid = $item['idcard'];

        list($y, $m, $d) = explode('-', $item['dbirth']);
        $bdate = ( $y - 543 ).$m.$d;

        $policy_date = array(
            'HOSPCODE' => '11512', 
            'PID' => $pid, 
            'BDATE' => $bdate, 
            'HC' => $hc
        );

        $json = new Services_JSON();
        $policy_data = $json->encode($policy_date);

        // d_update วันที่ตาม thidate
        // test policy 
        $sql = "SELECT `id` FROM `policy` WHERE `opday_id` = '$id' ";
        $db->select($sql);
        $row_policy = $db->get_rows();
        if ( $row_policy > 0 ) {
            
            $sql = "UPDATE `policy` SET 
            `policy_data` = '$policy_data', 
            `d_update` = thDateTimeToEn('$d_update'),
            `last_update` = NOW() 
            WHERE (`id`='$id');";
            mysql_query($sql);

        }else{
            $sql = "INSERT INTO `policy` (
                `id`, `hospcode`, `policy_id`, `policy_year`, `policy_data`, `d_update`,`opday_id`,`last_update` 
            ) VALUES (
                NULL, '11512', '001', '$year', '$policy_data', thDateTimeToEn('$d_update'), '$id',NOW() 
            );";
            mysql_query($sql);
        }
    
    }

    redirect('policy.php', 'บันทึกข้อมูลเรียบร้อย');
    exit;
}

?>

<div>
    <a href="../nindex.htm">หน้าหลักร.พ.</a>
</div>

<style>
*{
    font-family: TH Sarabun New, TH SarabunPSK;
    font-size: 16pt;
}
.alert{
    border: 1px solid #979700;
    background-color: #ffffc9;
    padding: 4px;
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

<?php 
if ( isset($_SESSION['x-msg']) ) {
    ?>
    <div class="alert"><?=$_SESSION['x-msg'];?></div>
    <?php
    $_SESSION['x-msg'] = NULL;
}
?>


<fieldset>
    <legend>ค้นหาตาม HN</legend>
    <form method="post" action="policy.php">

        <div>
            HN: <input type="text" name="hn" id="">
        </div>
        <div>
            <button type="submit">ตกลง</button>
            <input type="hidden" name="page" value="search">
        </div>
    </form> 
</fieldset>

<?php

$page = input('page');
if ( $page == 'search' ) { 

    $hn = input_post('hn');
    $sql = "SELECT a.`row_id`,a.`thidate`,a.`hn`,a.`vn`,a.`ptname`,a.`doctor`,b.`id` 
    FROM `opday` AS a 
    LEFT JOIN `policy` AS b ON b.`opday_id` = a.`row_id` 
    WHERE `hn` = '$hn' 
    ORDER BY `thidate` DESC";
    $db->select($sql);

    $items = $db->get_items();
    ?>
    <div>
        <h3>ข้อมูลการมาโรงพยาบาล</h3>
        <table class="chk_table">
            <tr>
                <th>วันที่</th>
                <th>HN</th>
                <th>VN</th>
                <th>ชื่อ-สกุุล</th>
                <th>แพทย์</th>
                <th>บันทึก</th>
            </tr>
            <?php 
            foreach ($items as $key => $item) { 

                $style = '';

                if ( $item['id'] != NULL ) {
                    
                    $style = 'style="background-color: #8eff8e;"';
                }
                ?>
                <tr <?=$style;?> >
                    <td><?=$item['thidate'];?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['vn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['doctor'];?></td>
                    <td><a href="policy.php?page=form&id=<?=$item['row_id'];?>">ลงข้อมูล</a></td>
                </tr>
                <?php
            }
            ?>
            
        </table>
    </div>
    
    <?php
}elseif ( $page == 'form' ) {

    $id = input_get('id');

    $sql = "SELECT * FROM `opday` WHERE `row_id` = '$id'";
    $db->select($sql);
    $item = $db->get_item();

    ?>
    <div>
        <fieldset>
            <legend>ลงข้อมูล</legend>
            <form action="policy.php" method="post">
                
                <div>
                    <p><b>ชื่อ-สกุล:</b><?=$item['ptname'];?> <b>HN:</b><?=$item['hn'];?> <b>VN:</b><?=$item['vn'];?> </p>
                    <p><b>วันที่รับการรักษา:</b><?=$item['thidate'];?> <b>แพทย์:</b><?=$item['doctor'];?></p>
                </div>

                <div>
                    รอบศรีษะเด็ก: <input type="text" name="hc" id=""> <span>หน่วยเป็น ซม. และมีจุดทศนิยม 1 ตาแหน่ง เช่น 18.0</span>
                </div>

                <div>
                    <button type="submit">บันทึก</button>
                    <input type="hidden" name="id" value="<?=$item['row_id'];?>">
                    <input type="hidden" name="action" value="save">
                </div>
            </form>
        </fieldset>
    </div>
    <?php

}

?>

