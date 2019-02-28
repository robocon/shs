<?php 

include 'bootstrap.php';
$db = Mysql::load();

$db->exec("SET NAMES TIS620");

$action = input_post('action');
if( $action == 'save' ){

    include 'includes/JSON.php';

    $id = input_post('id');
    $hc = input_post('hc');

    $hc = number_format($hc, 1);

    $sql = "SELECT a.*,b.`idcard`,b.`dbirth` 
    FROM `ipcard` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE a.`row_id` = '$id'";
    // dump($sql);
    $db->select($sql);
    $num_opday = $db->get_rows();

    if ( $num_opday > 0 ) {
        
    
        $item = $db->get_item();
        // dump($item);
        $year = date('Y');

        $d_update = date('YmdHis');
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
        // $sql = "SELECT `id` FROM `policy` WHERE `opday_id` = '$id' ";
        // $db->select($sql);
        // $row_policy = $db->get_rows();
        // if ( $row_policy > 0 ) {
            
        //     $sql = "UPDATE `policy` SET 
        //     `policy_data` = '$policy_data', 
        //     `d_update` = thDateTimeToEn('$d_update'),
        //     `last_update` = NOW() 
        //     WHERE (`id`='$id');";
        //     mysql_query($sql);

        // }else{
            $sql = "INSERT INTO `policy` (
                `id`, `hospcode`, `policy_id`, `policy_year`, `policy_data`, `d_update`,`opday_id`,`last_update` 
            ) VALUES (
                NULL, '11512', '001', '$year', '$policy_data', thDateTimeToEn('$d_update'), '$id',NOW() 
            );";
            dump($sql);
            // mysql_query($sql);
        // }
    
    }


    // redirect('policy.php', 'บันทึกข้อมูลเรียบร้อย');
    exit;
}

?>

<div>
    <a href="../nindex.htm">หน้าหลักร.พ.</a> | <a href="policy_view.php">ดูข้อมูล policy</a>
</div>

<style>
*{
    font-family: TH Sarabun New, TH SarabunPSK;
    font-size: 16pt;
}
h1,h3{
    padding: 0;
    margin: 0;
}
h1{
    font-size: 28pt;
}
h3{
    font-size: 20pt;
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
label{
    cursor: pointer;
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

<div>
    <h1>แฟ้ม policy</h1>
</div>
<fieldset>
    <legend>ค้นหาตาม AN</legend>
    <form method="post" action="policy.php">

        <div>
            AN: <input type="text" name="an" id="">
        </div>
        <div>
            <button type="submit">ตกลง</button>
            <input type="hidden" name="page" value="form">
        </div>
    </form> 
</fieldset>

<?php

$page = input('page');
if ( $page == 'search' ) { 
    
    redirect('policy.php?page=form');
    exit;

    $an = input_post('an');
    $sql = "SELECT a.`row_id`,a.`thidate`,a.`hn`,a.`vn`,a.`ptname`,a.`doctor`,a.`age`,b.`id`
    FROM `ipcard` AS a 
    LEFT JOIN `policy` AS b ON b.`ipcard_id` = a.`row_id` 
    WHERE `hn` = '$hn' 
    ORDER BY `thidate` DESC 
    LIMIT 200";
    $db->select($sql);

    $items = $db->get_items();
    ?>
    <div>
        <h3>ข้อมูลการมาโรงพยาบาล</h3>
        <table class="chk_table">
            <tr>
                <th>วันที่มารับบริการ</th>
                <th>HN</th>
                <th>VN</th>
                <th>ชื่อ-สกุุล</th>
                <th>อายุ</th>
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
                    <td><?=$item['age'];?></td>
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

    $an = input_post('an');

    $sql = "SELECT * FROM `ipcard` WHERE `an` = '$an'";
    $db->select($sql);
    $item = $db->get_item();

    ?>
    <div>
        <fieldset>
            <legend>ลงข้อมูล</legend>
            <form action="policy.php" method="post">
                
                <div>
                    <p><b>ชื่อ-สกุล:</b><?=$item['ptname'];?> <b>HN:</b><?=$item['hn'];?> <b>AN:</b><?=$item['an'];?> </p>
                    <p><b>อายุ:</b><?=$item['age'];?> <b>แพทย์:</b><?=$item['doctor'];?></p>
                </div>

                <div>
                    รอบศรีษะเด็ก: <input type="text" name="hc" id=""> <span>หน่วยเป็น ซม. และมีจุดทศนิยม 1 ตาแหน่ง เช่น 18.0</span>
                </div>
                <div>&nbsp;</div>
                <div>
                    วันที่ลงข้อมูล: <input type="text" name="d_update" id=""> 
                    <div>
                        <label for="use_current_date">
                            <input type="checkbox" name="use_current_date" id="use_current_date">วันที่ปัจจุบัน
                        </label>
                    </div>
                </div>

                <div>
                    <button type="submit">บันทึกข้อมูล</button>
                    <input type="hidden" name="id" value="<?=$item['row_id'];?>">
                    <input type="hidden" name="action" value="save">
                </div>
            </form>
        </fieldset>
    </div>
    <?php

}
?>

