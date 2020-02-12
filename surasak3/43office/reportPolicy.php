<?php 
include '../bootstrap.php';
$db = Mysql::load();

$action = input('action');
if( $action == 'edit' ){ 

    $db->select("SELECT * FROM `43policy` WHERE `id` = :id ", array(':id' => input_get('id')) );
    $list = $db->get_item();
    
    include 'head.php';
    include '../includes/JSON.php';
    
    $json = new Services_JSON();
    $policy_data = $json->decode($list['policy_data']);

    $bdate = ( substr($policy_data->BDATE,0,4) + 543).'-'.substr($policy_data->BDATE,4,2).'-'.substr($policy_data->BDATE,6,2);
    
    ?>
    <style>
        table tr{
            vertical-align: top;
        }
    </style>
    <fieldset>
        <legend>ฟอร์มบันทึก POLICY</legend>
        <form action="reportPolicy.php" method="post">
            <table>
                <tr>
                    <td class="txtRight">รหัสสถานบริการ : </td>
                    <td><input type="text" name="hospcode" value="<?=$list['hospcode'];?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">รหัสนโยบาย : </td>
                    <td><input type="text" name="policy_id" value="<?=$list['policy_id'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">ปีนโยบาย : </td>
                    <td><input type="text" name="policy_year" value="<?=$list['policy_year'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">เลขประจาตัวบุคคลของเด็ก(HN) : </td>
                    <td><input type="text" name="hn" value="<?=$policy_data->PID;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">วันเดือนปีเกิดของเด็ก : </td>
                    <td><input type="text" name="bdate" id="bdate" value="<?=$bdate;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">เส้นรอบศีรษะของเด็ก : </td>
                    <td>
                        <input type="text" name="hc" value="<?=$policy_data->HC;?>">
                        <div>หน่วยเป็น ซม. อนุญาติให้ใช้ทศนิยม 1ตำแหน่ง</div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">บันทึก</button>
                        <input type="hidden" name="id" value="<?=$list['id'];?>">
                        <input type="hidden" name="action" value="save">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <script>
    var popup1;
    window.onload = function() {
        popup1 = new Epoch('popup1','popup',document.getElementById('bdate'),false);
    };
    </script>
    <?php
    exit;
}elseif ($action === 'save') {
    
    include '../includes/JSON.php';
    $json = new Services_JSON();
    
    $id = input_post('id');
    $hospcode = input_post('hospcode');
    $policy_id = input_post('policy_id');
    $policy_year = input_post('policy_year');
    $policy_data = input_post('policy_data');

    $hn = input_post('hn');
    $bdate = input_post('bdate');
    $bdate = bc_to_ad($bdate);
    $bdate = str_replace('-','', $bdate);

    $hc = input_post('hc');
    if( strstr($hc, '.') ){ 
        list($dec, $tenths) = explode('.', $hc);
        $hc = $dec.'.'.substr($tenths, 0, 1);
    }else{
        $hc = number_format($hc, 1);
    }

    $policy_lists = array(
        'HOSPCODE' => $hospcode, 
        'PID' => $hn, 
        'BDATE' => $bdate, 
        'HC' => $hc 
    );
    $policy_data = $json->encode($policy_lists);

    $sql = "UPDATE `43policy` SET 
    `hospcode`='$hospcode', 
    `policy_id`='$policy_id', 
    `policy_year`='$policy_year', 
    `policy_data`='$policy_data', 
    `last_update`=NOW() 
    WHERE (`id`='$id');";

    $save = $db->update($sql);
    $msg = "บันทึกข้อมูลเรียบร้อย";
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    redirect('reportPolicy.php?id='.$id, $msg);

    exit;
}elseif ($action === 'del') {
    
    exit;
}

include_once 'head.php';
$sql = "SELECT * FROM `43policy` ORDER BY `id` DESC ";
$db->select($sql);
if ( $db->get_rows() > 0 ) {

    $items = $db->get_items();
    ?>
    <div class="clearfix">
        <h1 style="margin:0;">รายงาน POLICY</h1> <span>ข้อมูลจัดเก็บตามนโยบาย(เส้นรอบศรีษะเด็กแรกเกิด)</span>
    </div>
    <table class="chk_table">
        <tr>
            <th class="warning">รหัสสถานบริการ</th>
            <th class="warning">รหัสนโยบาย</th>
            <th class="warning">ปีนโยบาย</th>
            <th class="warning">รายละเอียดข้อมูล</th>
            <th class="warning">วันเดือนปีที่ปรับปรุง</th>
            <th rowspan="2">ปรับปรุง</th>
        </tr>
        <tr>
            <th class="warning">HOSPCODE</th>
            <th class="warning">POLICY_ID</th>
            <th class="warning">POLICY_YEAR</th>
            <th class="warning">POLICY_DATA</th>
            <th class="warning">D_UPDATE</th>
        </tr>
    <?php 
    foreach ($items as $key => $list) {
        ?>
        <tr>
            <td class="warning"><?=$list['hospcode'];?></td>
            <td class="warning"><?=$list['policy_id'];?></td>
            <td class="warning"><?=$list['policy_year'];?></td>
            <td class="warning"><?=$list['policy_data'];?></td>
            <td class="warning"><?=$list['d_update'];?></td>
            <td>
                <a href="reportPolicy.php?action=edit&id=<?=$list['id'];?>">แก้ไข</a> | <a href="reportPolicy.php?action=edit&id=<?=$list['id'];?>" onclick="return notiConfirm()">ลบ</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </table>
    <script>
        function notiConfirm(){
            var c=confirm('ยืนยันที่จะลบข้อมูล');
            return c;
        }
    </script>
    <?php
}else{
    ?>
    <p>ไม่พบข้อมูล</p>
    <?php
}