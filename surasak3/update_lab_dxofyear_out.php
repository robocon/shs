<?php

include 'bootstrap.php';

$page = input_post('page');
if( $page ==='check_orderdetail' ){

    $db = Mysql::load();
    $labnumber = input_post('labnumber');
    $sql = "SELECT b.`autonumber`,b.`labcode`,b.`labname`,b.`result`,b.`unit`,b.`normalrange`,b.`flag`,b.`parentcode`,b.`authorisedate`
    FROM (
        SELECT `autonumber` 
        FROM resulthead 
        WHERE `labnumber` = '$labnumber' 
        AND `clinicalinfo` LIKE 'ตรวจสุขภาพประจำปี%'
        AND ( `profilecode` = 'UA' /*or `profilecode` = 'CBC'*/) 
        ORDER BY `autonumber` ASC 
    ) AS a
    LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` ";
    $db->select($sql);
    $items = $db->get_items();
    ?>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>วันที่ตรวจ</th>
            <th>labcode</th>
            <th>labname</th>
            <th>result</th>
            <th>unit</th>
        </tr>
        <?php
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$item['authorisedate'];?></td>
                <td><?=$item['labcode'];?></td>
                <td><?=$item['labname'];?></td>
                <td><?=$item['result'];?></td>
                <td><?=$item['unit'];?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
    exit;
}

?>
<div>
    <div>
        <h3>อัพเดทข้อมูล Lab ไปยังตรวจสุขภาพประจำปี</h3>
        <h4>* รองรับแค่ UA *</h4>
    </div>
</div>

<?php
$hn = input_post('hn');
?>
<fieldset>
    <legend>ค้นหาจาก HN:</legend>
    <form action="update_lab_dxofyear_out.php" method="post">
    <div>
        <div>
            <label for="hn">HN: </label>
            <input type="text" id="hn" name="hn" value="<?=$hn;?>">
        </div>
    </div>
    <div>
        <div>
            <button type="submit">ตกลง</button>
            <input type="hidden" name="action" value="hn_search">
            <input type="hidden" name="token" value="<?=generate_token('update_lab_dxofyear_out_hn');?>">
        </div>
    </div>
</form>
</fieldset>

<?php

$action = input_post('action');

if( $action === 'hn_search' ){

    $test_token = check_token(input_post('token'), 'update_lab_dxofyear_out_hn');
    if( $test_token === false ){ 
        echo "Invalid token";
        exit;
    }

    include 'includes/ajax.php';

    $db = Mysql::load();
    $hn = input_post('hn');

    $sql = "SELECT `hn`,`yot`,`name`,`surname` 
    FROM `opcard` 
    WHERE `hn` = '$hn'";
    $db->select($sql);
    $user = $db->get_item();

    $sql = "SELECT `autonumber`,`orderdate`,`labnumber`,`hn`,`patientname`,`clinicalinfo`
    FROM  `orderhead` 
    WHERE `hn` LIKE  '$hn' 
    AND `clinicalinfo` LIKE 'ตรวจสุขภาพประจำปี%' 
    ORDER BY `autonumber` DESC";
    $db->select($sql);
    $lab_items = $db->get_items();
    $lab_rows = count($lab_items);

    $sql = "SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname` 
    FROM `dxofyear_out` 
    WHERE `hn` LIKE  '$hn' 
    ORDER BY `row_id` DESC";
    $db->select($sql);
    $dx_lists = $db->get_items();
    $dx_rows = count($dx_lists);

    if( $lab_rows === 0 OR $dx_rows === 0 ){
        ?>
        <p>ไม่พบข้อมูล Lab</p>
        <?php
    }else{
        ?>
        <fieldset>
            <p><span>HN: </span><?=$user['hn'];?> <span>ชื่อ: </span><?=$user['yot'].' '.$user['name'].' '.$user['surname'];?></p>
            <legend>อัพเดทข้อมูลจากLab:</legend>
            <form action="update_lab_dxofyear_out.php" method="post" id="form_lab">
                <div>
                    <div>
                        <label for="labnumber">เลือกข้อมูล Lab</label>
                        <select name="labnumber" id="labnumber" onchange="return show_lab()">
                            <option value="">เลือก</option>
                            <?php 
                            foreach ($lab_items as $key => $item) {
                                ?>
                                <option value="<?=$item['labnumber'];?>"><?=$item['orderdate'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div id="lab_response"></div>
                <div>
                    <div>
                        <label for="dx_number">เลือกข้อมูลตรวจสุขภาพ</label>
                        <select name="dx_number" id="dx_number">
                            <option value="">เลือก</option>
                        <?php
                        foreach ($dx_lists as $key => $item) {
                            ?>
                            <option value="<?=$item['row_id'];?>"><?=$item['thidate'].' | VN: '.$item['vn'];?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>
                <div>
                    <div>
                        <button type="button" onclick="return check_form()">อัพเดท</button>
                        <input type="hidden" name="action" value="update_dxofyear">
                        <input type="hidden" name="hn" value="<?=$hn;?>">
                        <input type="hidden" name="token" value="<?=generate_token('update_lab_dxofyear_out_form');?>">
                    </div>
                </div>
            </form>
        </fieldset>
        <script type="text/javascript">
        function show_lab(){

            var labnumber = document.getElementById('labnumber').value;
            // console.log(labnumber);
            // var res = '';
            if( labnumber !== '' ){
                var newSm = new SmHttp();
                // console.log(newSm);
                newSm.ajax(
                    'update_lab_dxofyear_out.php', 
                    { 'page': 'check_orderdetail', 'labnumber': labnumber }, 
                    function(res){
                        // document.write(res);
                        // console.log(res);
                        document.getElementById('lab_response').innerHTML = res;
                    }
                );
            }else{
                document.getElementById('lab_response').innerHTML = '';
            }
            
            return false;
        }
        function check_form(){

            var lab = document.getElementById('labnumber').value;
            var dx = document.getElementById('dx_number').value;
            var test_form = true;
            if( lab === '' ){
                alert('กรุณาเลือกผล Lab');
                test_form = false;
            }else if( dx === '' ){
                alert('กรุณาเลือกตรวจสุขภาพ');
                test_form = false;
            }
            
            if( test_form === false ){
                return false;
            }else{
                document.getElementById('form_lab').submit();
            }
        }
        </script>
        <?php
    }

}else if( $action === 'update_dxofyear' ){

    $test_token = check_token(input_post('token'), 'update_lab_dxofyear_out_form');
    if( $test_token === false ){ 
        echo "Invalid token";
        exit;
    }

    $labnumber = input_post('labnumber');
    $dx_number = input_post('dx_number');

    $db = Mysql::load();
    $sql = "SELECT b.`autonumber`,b.`labcode`,b.`labname`,b.`result`,b.`unit`,b.`normalrange`,b.`flag`,b.`parentcode`
    FROM (
        SELECT `autonumber` 
        FROM resulthead 
        where `labnumber` = '$labnumber' 
        and ( `profilecode` = 'UA' OR `profilecode` = 'CBC') 
        order by `autonumber` asc 
    ) AS a
    LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` ";
    $db->select($sql);
    $items = $db->get_items();

    // ข้อมูลจากใน dxofyear_out
    $white_list = array(
        'ua_color',
        'ua_appear',
        'ua_spgr',
        'ua_phu',
        'ua_bloodu',
        'ua_prou',
        'ua_gluu',
        'ua_ketu',
        'ua_urobil',
        'ua_bili',
        'ua_nitrit',
        'ua_wbcu',
        'ua_rbcu',
        'ua_epiu',
        'ua_bactu',
        'ua_yeast',
        'ua_mucosu',
        'ua_amopu',
        'ua_castu',
        'ua_crystu',
        'ua_otheru'
    );

    $new_update = array();
    foreach( $items as $key => $item ){
        $name = 'ua_'.strtolower($item['labcode']);

        // ถ้ามีข้อมูลใน whitelist ให้อัพเดทตามฟิลด์นั้นๆ 
        if( in_array( $name, $white_list ) === true ){
            $new_update[] = "`$name` = '".$item['result']."'";
        }
    }

    $white_lists_cbc = array(
        'cbc_wbc',
        'cbc_neu',
        'cbc_lymp',
        'cbc_mono',
        'cbc_eos',
        'cbc_baso',
        'cbc_atyp',
        'cbc_band',
        'cbc_other',
        'cbc_nrbc',
        'cbc_rbc',
        'cbc_hb',
        'cbc_hct',
        'cbc_mcv',
        'cbc_mch',
        'cbc_mchc',
        'cbc_pltc',
        'cbc_plts',
        'cbc_rbcmor'
    );
    
    foreach( $items as $key => $item ){
        $name = 'cbc_'.strtolower($item['labcode']);

        // ถ้ามีข้อมูลใน whitelist ให้อัพเดทตามฟิลด์นั้นๆ 
        if( in_array( $name, $white_lists_cbc ) === true ){
            $new_update[] = "`$name` = '".$item['result']."'";
        }
    }


    $update_txt = implode(',', $new_update);

    $sql = "UPDATE `dxofyear_out` 
    SET 
    $update_txt 
    WHERE `row_id` = '$dx_number'; ";
    $update = $db->update($sql);
    if ( $update === true ) {
        ?>
        <p>อัพเดทข้อมูลเรียบร้อยแล้ว</p>
        <?php
    }
}