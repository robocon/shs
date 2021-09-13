<?php 
// require_once 'bootstrap.php';

$id = input_get('id');

$sql = "SELECT * FROM `appoint` WHERE `row_id` = '$id' ";
$db->select($sql);
$rows = $db->get_rows();

if( $rows > 0 ){

    $item = $db->get_item();

    $sql = "SELECT a.*, b.`detail`
    FROM `appoint_lab` AS a 
    LEFT JOIN `labcare` AS b ON b.`code` = a.`code` 
    WHERE a.`id` = '$id'";
    $db->select($sql);

    $row_lab = $db->get_rows();
    // 

    ?>
    <style>
    .lab_container{
        display: none;
        position: absolute;
        top: 260px;
        left: 140px;
        background-color: #ffffff;
        border: 2px solid red;
        padding: 4px;
        width: 600px;
    }
    .btn-close-lab:hover{
        cursor: pointer;
        text-decoration: underline;
    }
    </style>

    <fieldset>
        <legend>ฟอร์มแก้ไขข้อมูล</legend>

        <form action="appoint_edit.php" method="post">
            <div>
                <p>
                    <b>ชื่อ-สกุล:</b> <?=$item['ptname'];?> <b>HN:</b> <?=$item['hn'];?> อายุ <?=$item['age'];?> <b>สิทธิ:</b><?=$item['ptright'];?>
                </p>
                <p>
                    <b>แพทย์:</b> <?=$item['doctor'];?> <b>วันที่:</b> <?=$item['appdate'];?> <a href="javascript:void(0);">แก้ไข</a>
                </p>
            </div>



            <div>
                <table>
                    <tr>
                        <td>นัดมาเพื่อ:</td>
                        <td>
                            <select name="detail" id="detail">
                            <?php 
                            $sql_applist = "SELECT * FROM `applist` WHERE `status` = 'Y'";
                            $q_applist = $dbi->query($sql_applist);
                            while ($applist = $q_applist->fetch_assoc()) {
                                $applist_selected = ($applist['appvalue']==$item['detail']) ? 'selected="selected"' : '' ;
                                ?>
                                <option value="<?=$applist['appvalue'];?>" <?=$applist_selected;?> ><?=$applist['applist'];?></option>
                                <?php
                            }
                            ?>
                                
                            </select>&nbsp;
                            <b>อื่นๆ:</b><input type="text" id="detail2" name="detail2" size="50" value="<?=$item['detail2'];?>">
                        </td>
                    </tr>
                    <tr>
                        <td>ยื่นใบนัดที่:</td>
                        <td>
                        <?php 
                        $room_list = array('จุดบริการนัดที่ 1','อาคารเฉลิมพระเกียรติ','แผนกทะเบียน','ห้องฉุกเฉิน','กองทันตกรรม','แผนกพยาธิวิทยา','แผนกเอกชเรย์','กองสูติ-นารี','กายภาพ','คลีนิกฝังเข็ม','นวดแผนไทย','ห้องตรวจจักษุ(ตา)','ห้องตรวจกายภาพบำบัด(ตึกกายภาพ)','ตรวจตามนัด OPDเวชศาสตร์ฟื้นฟู','คลีนิกโรคไต','กายภาพบำบัดชั้น 2','ห้อง CT SCAN','ห้องเก็บเงินรายได้ เบอร์4','ห้อง CT SCAN (ตรวจมวลกระดูก)','ห้องตรวจเฉพาะโรค','แผนกตรวจสุขภาพ','คลินิก ARI (ติดเชื้อระบบทางเดินหายใจ)',);
                        ?>
                        <select name="" id="">
                            <?php 
                            foreach ($room_list as $room_item) {
                                $room_selected = ($room_item==$item['room']) ? 'selected="selected"' : '' ;
                                ?>
                                <option value="<?=$room_item;?>" <?=$room_selected;?> ><?=$room_item;?></option>
                                <?php
                            }
                            ?>
                            
                        </select>
                        <?php
/*
?>
<select size="1" name="room" id="room">
    <option value="NA">&lt;เลือกห้องตรวจ&gt;</option>
    <option>จุดบริการนัดที่ 1</option>
    <option id="pre-opd" <?=$preOpd;?>>อาคารเฉลิมพระเกียรติ</option>
    <option id="opd">แผนกทะเบียน</option>
    <option>ห้องฉุกเฉิน</option>
    <option>กองทันตกรรม</option>
    <option>แผนกพยาธิวิทยา</option>
    <option>แผนกเอกชเรย์</option>
    <option>กองสูติ-นารี</option>
    <option <? if($_SESSION["smenucode"]=="ADMPT"){ echo "selected";}?>>กายภาพ</option>
    <option>คลีนิกฝังเข็ม</option>
    <option>นวดแผนไทย</option>
    <option>ห้องตรวจจักษุ(ตา)</option>
    <option>ห้องตรวจกายภาพบำบัด(ตึกกายภาพ)</option>
    <option>ตรวจตามนัด OPDเวชศาสตร์ฟื้นฟู</option>
    <option>คลีนิกโรคไต</option>
    <option>กายภาพบำบัดชั้น 2</option>
    <option>ห้อง CT SCAN</option>  
    <option>ห้องเก็บเงินรายได้ เบอร์4</option>  <!--#18-->             
    <? if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){?>
    <option selected="selected">ห้อง CT SCAN (ตรวจมวลกระดูก)</option>
    <? } ?>
    <option>ห้องตรวจเฉพาะโรค</option>
    <option>แผนกตรวจสุขภาพ</option>
    <option>คลินิก ARI (ติดเชื้อระบบทางเดินหายใจ)</option>
</select>
*/



                            $interval = 1800; // 60*30 => 1800 => 30Min
                            $date_first = strtotime(date('Y-m-d 07:00:00'));
                            $date_second = strtotime(date('Y-m-d 19:00:00'));
                            $time_list = array('08:00 น. - 10.00 น.', '08:00 น. - 11:00 น.');

?>



                            <b>เวลา:</b> <select name="capptime" id="capptime">
                            <?php 
                            foreach ($time_list as $time_item) { 
                                $time_item_selected = ($item['apptime']==$time_item) ? 'selected="selected"' : '' ;
                                ?><option value="<?=$time_item?>" <?=$time_item_selected;?> ><?=$time_item;?></option><?php
                            }

                            for ($i=$date_first; $i <= $date_second; $i+=$interval) { 
                                $show_time = date('H:i', $i).' น.';
                                $time_selected = ($item['apptime']==$show_time) ? 'selected="selected"' : '' ;
                                ?><option value="<?=$show_time?>" <?=$time_selected;?> ><?=$show_time;?></option><?php
                            }
                            ?>
                                
                            </select>
                        </td>
                    </tr>
                </table>
            </div>


            <?php 
            $xray_lists = array(
                'NA' => 'ไม่มีการเอกซเรย์',
                'CXR' => 'CXR',
                'KUB' => 'KUB',
                'เอกซเรย์ ก่อนพบแพทย์' => 'เอกซเรย์ ก่อนพบแพทย์',
                'อัลตราซาวนด์' => 'อัลตราซาวนด์',
                'ตรวจ IVP' => 'ตรวจ IVP'
            );

            // กรณีมี , แยก xray 
            $item_xray = trim($item['xray']);
            $xray1 = $xray2 = false;

            if( strpos($item_xray, ',') !== false ){ 

                list($xray1, $xray2) = explode(',', $item_xray,2);

            }elseif( strpos($item_xray, ' ') !== false ){

                list($xray1, $xray2) = explode(' ', $item_xray,2);
                
            }else{

                $xray1 = $item_xray;
                
            }

            if( $xray1 == 'ไม่มี' ){
                $xray1 = 'NA';
            }

            ?>
            <br>
            <br>
            <br>
            <div>
                เอกซเรย์: <select name="xray" id="">
                    <option value="">-- เลือกการเอกซเรย์ --</option>
                <?php 
                // Test ก่อนว่าใน xray1 เป็น false รึป่าว ถ้าใช่ก็จะไปแสดงในส่วนของ xray 2
                $test_match = false;
                foreach ($xray_lists as $key => $xray) { 

                    $selected = '';
                    if( $key == $xray1 ){
                        $selected = 'selected="selected"';
                        $test_match = true;
                    }
                    ?>
                    <option value="<?=$key;?>" <?=$selected;?> ><?=$xray;?></option>
                    <?php
                }
                ?>
                </select> 
                <?php 
                if( $test_match === false ){
                    $xray2 = $xray1.( $xray2 != false ? $xray2 : false );
                }
                ?>
                <input type="text" name="xray2" id="" value="<?=$xray2;?>" style="width: 200px;"> <span style="font-size: 14pt;color: red;">* หากมีมากกว่า 1รายการให้ใช้ Comma(,) ในการแบ่งรายการตรวจ เช่น CXR,KUB เป็นต้น</span>
            </div>

            <fieldset>
                <legend>รายการ LAB</legend>
                <div>
                    <button class="table_lab">เพิ่มรายการ LAB</button>
                </div>
                <div>
                    <ol id="list_patho">
                    <?php
                    if ( $row_lab > 0 ) { 
                        $lab_items = $db->get_items();
                        foreach ($lab_items as $key => $lab) {
                            ?>
                            <li>
                                <?=$lab['detail'];?> <a href="javascript:void(0);" class="del_item">[ ลบ ]</a>
                                <input type="hidden" name="code[]" value="<?=$lab['code'];?>">
                            </li>
                            <?php
                        }
                    }
                    ?>
                    </ol>
                </div>
                เจาะเลือดเพิ่มเติม <input type="text" name="labextra" id="" value="<?=$item['labextra'];?>">
            </fieldset>

            <div>
                <button type="submit">บันทึกข้อมูล</button>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?=$item['row_id'];?>">
                <input type="hidden" name="hn" value="<?=$item['hn'];?>">
                <input type="hidden" name="lab_old" value="<?=$item['patho'];?>">
                <input type="hidden" name="xray_old" value="<?=$item_xray;?>">
                <input type="hidden" name="officer_old" value="<?=$item['officer'];?>">
                <input type="hidden" name="labextra_old" value="<?=$item['labextra'];?>">
            </div>

        </form>

    </fieldset>

    <div class="lab_container" id="lab_container">
        <div style="position: absolute; top: 0; right: 0; font-weight: bold;background-color: #bbbbbb; z-index:9;" class="btn-close-lab">[ ปิด ]</div>
        <div style="position: relative;">
            ค้นหาจากชื่อ : <input type="text" name="lab_search" id="lab_search" onkeyup="search_labname(this.value)">
            <div id="lab_search_result" style="position: absolute; top: 32px; left: 0; border:2px solid blue; background-color:#ffffff; display: none;"></div>
        </div>
        
        <p style="text-align: center; "><b>รายการตรวจทางพยาธิ</b></p>
        <?php
        $db->select("SELECT * FROM `labcare` WHERE ( `lab_list` !=0 AND `lab_list` IS NOT NULL ) AND `lab_listdetail` <> '' ORDER BY `lab_list` ASC");
        $labcare_list = $db->get_items();
        ?>
        <table class="chk_table" width="100%">
            <tr>
                <?php 
                // แถวละ 5
                $i = 0;
                foreach ($labcare_list as $key => $result2) {

                    ++$i;
                    ?>
                    <td>
                        <a href="javascript: void(0);" title="<?=$result2['detail']?>" data-detail="<?=$result2['detail']?>" data-code="<?=$result2['code']?>" class="lab_add"><?=$result2['lab_listdetail']?></a>
                    </td>
                    <?php

                    if( $i % 5 == 0 ){
                        ?></tr><tr><?php
                        $i = 0;

                    }
                }
                ?>
                
            </tr>
        </table>
    </div>
    
    <script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        
        function addEventListener(el, eventName, handler) {
            if (el.addEventListener) {
                el.addEventListener(eventName, handler);
            } else {
                el.attachEvent('on' + eventName, function(){
                handler.call(el);
                });
            }
        }

        function search_labname(this_value)
        {
            if(this_value.length >= 2)
            {
                document.getElementById('lab_search_result').style.display = '';

                var request = new XMLHttpRequest();
                request.open('GET', 'appoint_edit.php?action=search&value='+this_value, true);

                request.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status >= 200 && this.status < 400) {
                        // Success!
                        document.getElementById('lab_search_result').innerHTML = this.responseText;


                        document.getElementById('close_lab_search_name').addEventListener('click', function(){
                            document.getElementById('lab_search_result').style.display = 'none';
                        });

                        
                        var edit_items = document.getElementsByClassName("selected_code_detail");
                        if(edit_items.length > 0)
                        {
                            for (let index = 0; index < edit_items.length; index++) {
                                edit_items[index].addEventListener("click", action_selected_code_detail);
                            }
                        }

                        // console.log(resp);
                    } else {
                    // Error :(
                    }
                }
                };

                request.send();
                request = null;
            }
        }

        function action_selected_code_detail(){
            document.getElementById('lab_search_result').style.display = 'none';
            document.getElementById('lab_container').style.display = 'none';
        }

        // button เปิด-ปิด
        $(document).on('click', '.table_lab', function(){
            $('.lab_container').toggle();
            return false;
        });

        // ปุ่มปิด manual
        $(document).on('click', '.btn-close-lab', function(){
            $('.lab_container').hide();
        });

        // เพิ่มเข้าไปในฟอร์ม
        $(document).on('click', '.lab_add', function(){
            var code = $(this).attr('data-code');
            var detail = $(this).attr('data-detail');
            
            var htm = '<li>'+detail+' <a href="javascript:void(0);" class="del_item">[ ลบ ]</a> <input type="hidden" name="code[]" value="'+code+'"></li>';
            
            $('#list_patho').append(htm);
        });

        // ลบออกจากฟอร์ม
        $(document).on('click', '.del_item', function(){
            var c = confirm('ยืนยันลบรายการ LAB?');
            if( c == true ){
                $(this).parent().remove();
            }
        });
        
    </script>

    <?php

}else {
    ?>
    <p><b>ไม่พบข้อมูล</b></p>
    <?php
}

