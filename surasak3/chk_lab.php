<?php

include 'bootstrap.php';

$page = input('page');
$action = sprintf("%s", $_REQUEST['action']);
$db = Mysql::load();

if ( $action === 'save' ) {

    $info = input_post('info');
    $number = input_post('number');
    $id = input_post('id');

    if ( empty($number) ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    $sql = "UPDATE `resulthead` SET 
    `clinicalinfo` = '$info' 
    WHERE `autonumber` = '$number' ";
    $update = $db->update($sql);

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $update !== true ){
		$msg = errorMsg('update', $update['id']);
    }

    redirect('chk_lab.php?page=form&id='.$id, $msg);
    exit;
} elseif ( $action == 'save_result' ){

    $autonumber = input_post('autonumber');
    $labcode = input_post('labcode');
    $id = input_post('id');

    $result = input_post('result');
    $normalrange = input_post('normalrange');

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    $sql = "UPDATE `resultdetail` SET 
    `result` = '$result', 
    `normalrange` = '$normalrange' 
    WHERE `autonumber` = '$autonumber' 
    AND `labcode` = '$labcode' ";
    $update = $db->update($sql);

    redirect('chk_lab.php?page=form&id='.$id, $msg);
    exit;
}elseif( $action == 'findCinicalinfo' ){

    $autonumber = sprintf("%s", $_GET['autonumber']);

    $sql = "SELECT clinicalinfo FROM `resulthead` WHERE `autonumber` = '$autonumber' ";
    $db->select($sql);
    if($db->get_rows() > 0){
        $item_result = $db->get_item();
        $res = '{"status":200, "clinicalinfo": "'.$item_result['clinicalinfo'].'", "message":"พบข้อมูล"}';
    }else{
        $res = '{"status":400, "message": "ไม่พบข้อมูล"}';
    }
    echo $res;
    exit;

}elseif( $action == 'saveCinicalinfo' ){

    $autonumber = sprintf("%s", $_POST['autonumber']);
    $clinicalinfo = sprintf("%s", $_POST['clinicalinfo']);

    $sqlUpdate = "UPDATE resulthead SET clinicalinfo = '$clinicalinfo' WHERE autonumber = '$autonumber' ";
    $save = $db->update($sqlUpdate);
    if($save===true){
        $res = '{"status":200, "autonumber": "'.$autonumber.'", "message":"บันทึกข้อมูลเรียบร้อย"}';
    }else{
        $res = '{"status":400, "message": " ไม่สามารถบันทึกข้อมูลได้"}';
    }
    echo $res;
    exit;
}elseif( $action == 'findLabnumber' ){

    $autonumber = sprintf("%s", $_GET['autonumber']);

    $sql = "SELECT labnumber FROM `resulthead` WHERE `autonumber` = '$autonumber' ";
    $db->select($sql);
    if($db->get_rows() > 0){
        $item_result = $db->get_item();
        $res = '{"status":200, "labnumber": "'.$item_result['labnumber'].'", "message":"พบข้อมูล"}';
    }else{
        $res = '{"status":400, "message": "ไม่พบข้อมูล"}';
    }
    echo $res;
    exit;
}elseif( $action == 'saveLabnumber' ){

    $autonumber = sprintf("%s", $_POST['autonumber']);
    $labnumber = sprintf("%s", $_POST['labnumber']);

    $sqlUpdate = "UPDATE resulthead SET labnumber = '$labnumber' WHERE autonumber = '$autonumber' ";
    $save = $db->update($sqlUpdate);
    if($save===true){
        $res = '{"status":200, "autonumber": "'.$autonumber.'", "message":"บันทึกข้อมูลเรียบร้อย"}';
    }else{
        $res = '{"status":400, "message": " ไม่สามารถบันทึกข้อมูลได้"}';
    }
    echo $res;
    exit;
}


if ( $page === 'form' ) { 

    $id = input_get('id');
    if ( $id === false ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    $start_date = (!empty($_POST['start_date'])) ? sprintf("%s", $_POST['start_date']) : '' ;
    $end_date = (!empty($_POST['end_date'])) ? sprintf("%s", $_POST['end_date']) : date('Y-m-d') ;

    $whereDateResultHead = "AND orderdate >= '".date('Y-m-01')." 00:00:00'";
    $action = (!empty($_POST['action'])) ? sprintf("%s", $_POST['action']) : '' ;
    if($action==='searchByDate'){
        $whereDateResultHead = " AND (orderdate >= '$start_date 00:00:00' AND orderdate <= '$end_date 23:59:59') ";
    }

    $db->select("SELECT *,`HN` AS `hn` FROM `opcardchk` WHERE `row` = '$id' ");
    $user = $db->get_item();
    $user_hn = $user['hn'];
    $user_part = $user['part'];

    $db->select("SELECT SUBSTRING(`yearchk`, 3, 2) AS `yearchk` FROM `chk_company_list` WHERE `code` = '$user_part' ");
    $chk_company = $db->get_item();

    $sql = "SELECT * 
    FROM `resulthead` 
    WHERE `hn` = '$user_hn'  
    -- AND `clinicalinfo` LIKE '%ตรวจสุขภาพประจำปี%' 
    $whereDateResultHead";
    
    $db->select($sql);
    $lab_rows = $db->get_rows();
    $items = $db->get_items();

    include 'chk_menu.php';

    ?>

    <link href="js/vanilla-calendar/vanilla-calendar.min.css" rel="stylesheet">
    <script src="js/vanilla-calendar/vanilla-calendar.min.js" defer></script>

    <p><a href="chk_show_user.php?part=<?=$user['part'];?>" class="button">&lt;&lt;&nbsp;กลับไปหน้ารายชื่อ</a></p>
    
    <script src="sweetalert/sweetalert2@11.js"></script>
    <style>
        .labTable tr:hover{
            background-color:#c5c5c5!important;
        }
    </style>
    <h3>แก้ไขข้อมูลแลป</h3>
    <table>
        <tr>
            <td align="right"><b>HN : </b></td>
            <td><?=$user['hn'];?></td>
        </tr>
        <tr>
            <td align="right"><b>ชื่อ-สกุล : </b></td>
            <td><?=$user['name'];?> <?=$user['surname'];?></td>
        </tr>
        <tr>
            <td align="right"><b>บริษัท : </b></td>
            <td><?=$user['part'];?></td>
        </tr>
    </table>
    <br>
    <fieldset style="display:inline-block; margin-bottom:8px;">
        <legend>ค้นหาตามวันที่</legend>
        <form action="chk_lab.php?page=form&id=<?=$id;?>" method="post">
            <table>
                <tr>
                    <td>
                        <label for="start_date">เริ่มวันที่
                            <input type="text" id="start_date" name="start_date" value="<?=$start_date;?>">
                        </label>
                        <div style="position:relative;">
                            <div style="position: absolute;">
                                <div id="calendar_start"></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <label for="end_date">ถึงวันที่
                            <input type="text" id="end_date" name="end_date" value="<?=$end_date;?>">
                        </label>
                        <div style="position:relative;">
                            <div style="position: absolute;">
                                <div id="calendar_end"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr colspan="2">
                    <td>
                        <button type="submit">ค้นหา</button>
                        <input type="hidden" name="action" value="searchByDate">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        document.addEventListener("keydown", (event) => {
            if (event.isComposing || event.keyCode === 27) {
                document.getElementById('calendar_start').style.display = 'none';
                document.getElementById('calendar_end').style.display = 'none';
            }
        });

        document.getElementById('start_date').onclick=function(){ 
            document.getElementById('calendar_start').style.display = '';
            const calendar = new VanillaCalendar('#calendar_start',{
                settings: {
                    lang: 'th',
                    iso8601: false,
                },
                actions: {
                    clickDay(event, self) {
                        document.getElementById('start_date').value = self.selectedDates[0];
                        document.getElementById('calendar_start').style.display = 'none';
                    },
                },
            });
            calendar.init();
        }

        document.getElementById('end_date').onclick=function(){ 
            document.getElementById('calendar_end').style.display = '';
            const calendar = new VanillaCalendar('#calendar_end',{
                settings: {
                    lang: 'th',
                    iso8601: false,
                },
                actions: {
                    clickDay(event, self) {
                        document.getElementById('end_date').value = self.selectedDates[0];
                        document.getElementById('calendar_end').style.display = 'none';
                    },
                },
            });
            calendar.init();
        }
    });
    </script>
    <br>
    <?php
    if( $lab_rows === 0 ){
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }else {
        $items = $db->get_items();
        ?>
        <table class="chk_table" width="100%">
            <tr>
                <th>ID</th>
                <th>วันที่</th>
                <th>Lab Number</th>
                <th>รายการตรวจ</th>
                <th>สถานะแลป</th>
            </tr>
            <?php
            foreach ($items as $key => $item) {
                $autonumber = $item['autonumber'];
            ?>
            <tr>
                <td><?=$item['autonumber'];?></td>
                <td width="150"><?=$item['orderdate'];?></td>
                <td>
                    <a href="javascript:void(0);" onclick="editLabnumber('<?=$item['autonumber'];?>')"><?=$item['labnumber'];?></a>
                </td>
                <td><?=$item['profilecode'];?></td>
                <td>
                    <?php 
                    if(empty($item['clinicalinfo'])){
                        $item['clinicalinfo'] = 'คลิกเพื่อแก้ไข';
                    }
                    ?>
                    <a href="javascript:void(0);" title="แก้ไขสถานะ" onclick="showInput('<?=$item['autonumber'];?>')"><?=$item['clinicalinfo'];?></a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <script>
            async function showInput(autonumber){ 

                const response = await fetch('chk_lab.php?action=findCinicalinfo&autonumber='+autonumber);
                const data = await response.json();
                const inputValue = data.clinicalinfo;
                const { value: clinicalinfoInput } = await Swal.fire({
                    title: "ปรับสถานะแลป",
                    input: "text",
                    inputLabel: "สถานะแลปปัจจุบัน",
                    inputValue,
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return "กรุณาใส่ข้อมูลให้ถูกต้อง";
                        }
                    },
                    confirmButtonText: "บันทึกข้อมูล",
                    cancelButtonText: "ยกเลิก",
                });
                if (clinicalinfoInput) {
                    
                    let data = [];
                    data.push(encodeURIComponent('action')+"="+encodeURIComponent('saveCinicalinfo'));
                    data.push(encodeURIComponent('autonumber')+"="+encodeURIComponent(autonumber));
                    data.push(encodeURIComponent('clinicalinfo')+"="+encodeURIComponent(clinicalinfoInput));
                    let dataPost = data.join("&");
                    
                    let response = await fetch('chk_lab.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        body: dataPost
                    });
                    const body = await response.json();
                    
                    Swal.fire({
                        icon: "success",
                        title: "บันทึกข้อมูลเรียบร้อย",
                        showConfirmButton: false,
                        timer: 1000
                    }).then(()=>{
                        location.reload(true);
                    });
                }
            }

            async function editLabnumber(autonumber){
                const response = await fetch('chk_lab.php?action=findLabnumber&autonumber='+autonumber);
                const data = await response.json();
                const inputValue = data.labnumber;
                const { value: labnumberInput } = await Swal.fire({
                    title: "แก้ไข Labnumber",
                    input: "text",
                    inputLabel: "เลขที่แลปปัจจุบัน",
                    inputValue,
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return "กรุณาใส่ข้อมูลให้ถูกต้อง";
                        }
                    },
                    confirmButtonText: "บันทึกข้อมูล",
                    cancelButtonText: "ยกเลิก",
                });
                if (labnumberInput) {
                    
                    let data = [];
                    data.push(encodeURIComponent('action')+"="+encodeURIComponent('saveLabnumber'));
                    data.push(encodeURIComponent('autonumber')+"="+encodeURIComponent(autonumber));
                    data.push(encodeURIComponent('labnumber')+"="+encodeURIComponent(labnumberInput));
                    let dataPost = data.join("&");
                    
                    let response = await fetch('chk_lab.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        body: dataPost
                    });
                    const body = await response.json();
                    
                    Swal.fire({
                        icon: "success",
                        title: "บันทึกข้อมูลเรียบร้อย",
                        showConfirmButton: false,
                        timer: 1000
                    }).then(()=>{
                        location.reload(true);
                    });
                }
            }
        </script>
        <?php
    }
}elseif ( $page === 'editdetail' ) {

    $number = input_get('number');
    $id = input_get('id');

    if ( empty($number) ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    $sql = "SELECT * FROM `resulthead` WHERE `autonumber` = '$number' ";
    $db->select($sql);
    $item = $db->get_item();

    include 'chk_menu.php';
    ?>
    <a href="chk_lab.php?page=form&id=<?=$id;?>" class="button">&lt;&lt;&nbsp;กลับไปหน้าปรับผล</a>
    <br><br>
    <form action="chk_lab.php" method="post">
        <div>
            สถานะแลป : <input type="text" name="info" id="" value="<?=$item['clinicalinfo'];?>">
        </div>
        <div style="color: red;">
            คำแนะนำ : ให้เปลี่ยน keyword เช่น ตรวจสุขภาพประจำปี60 เป็น deleteตรวจสุขภาพประจำปี60
        </div>
        <div>
            <button type="submit">บันทึกข้อมูล</button>
            <input type="hidden" name="number" value="<?=$number;?>">
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?=$id;?>">
            
        </div>
    </form>
    <?php
}elseif ( $page === 'edit_result' ) {

    $autonumber = input_get('autonumber');
    $labcode = input_get('labcode');
    $id = input_get('id');

    $sql = "SELECT `result`,`normalrange` 
    FROM `resultdetail` 
    WHERE `autonumber` = '$autonumber' 
    AND `labcode` = '$labcode' ";
    $db->select($sql);
    $item_result = $db->get_item();

    include 'chk_menu.php';
    ?>
    <div>
        <h3>แก้ไขผลแลป</h3>
        <p>เลขที่ Autonumber : <?=$autonumber;?></p>
        <p>Labcode : <?=$labcode;?></p>
    </div>
    <form action="chk_lab.php" method="post">
        <div>
            result: <input type="text" name="result" id="" value="<?=$item_result['result'];?>">
        </div>
        <div>
            normalrange: <input type="text" name="normalrange" id="" value="<?=$item_result['normalrange'];?>">
        </div>
        <div>
            <button type="submit">บันทึกข้อมูล</button>
            <input type="hidden" name="action" value="save_result">
            <input type="hidden" name="autonumber" value="<?=$autonumber;?>">
            <input type="hidden" name="labcode" value="<?=$labcode;?>">
            <input type="hidden" name="id" value="<?=$id;?>">
        </div>
        <div>
            <a href="javascript: window.history.back();">ย้อนกลับ</a>
        </div>
    </form>
    <?php

}