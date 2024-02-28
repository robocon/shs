<?php

include 'bootstrap.php';

$page = input('page');
$action = sprintf("%s", $_REQUEST['action']);
$db = Mysql::load();

if( $action == 'saveCinicalinfo' ){

    $labnumber = sprintf("%s", $_POST['labnumber']);
    $clinicalinfo = trim(sprintf("%s", $_POST['clinicalinfo']));

    $sqlUpdate = "UPDATE resulthead SET clinicalinfo = '$clinicalinfo' WHERE labnumber = '$labnumber' ";
    $save = $db->update($sqlUpdate);
    if($save===true){
        $res = '{"status":200, "labnumber": "'.$labnumber.'", "message":"บันทึกข้อมูลเรียบร้อย"}';
    }else{
        $res = '{"status":400, "message": " ไม่สามารถบันทึกข้อมูลได้"}';
    }
    echo $res;
    exit;
}elseif( $action == 'saveLabnumber' ){

    $oldLabnumber = sprintf("%s", $_POST['oldLabnumber']);
    $newLabnumber = trim(sprintf("%s", $_POST['newLabnumber']));

    $sqlUpdate = "UPDATE resulthead SET labnumber = '$newLabnumber' WHERE labnumber = '$oldLabnumber' ";
    $save = $db->update($sqlUpdate);
    if($save===true){
        $res = '{"status":200, "labnumber": "'.$newLabnumber.'", "message":"บันทึกข้อมูลเรียบร้อย"}';
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

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>แก้ไขข้อมูลแลป</title>
    </head>
    <body>
    <?php

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

    $sql = "SELECT `labnumber`,`autonumber`,`orderdate`,`clinicalinfo`,GROUP_CONCAT(`profilecode`) `profilecode`
    FROM `resulthead` 
    WHERE `hn` = '$user_hn' 
    $whereDateResultHead 
    GROUP BY `labnumber`,`clinicalinfo`";
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
                    <a href="javascript:void(0);" onclick="editLabnumber('<?=$item['labnumber'];?>')"><?=$item['labnumber'];?></a>
                </td>
                <td>
                    <a href="chk_edit_lab_item.php?labnumber=<?=$item['labnumber'];?>" title="แก้ไขรายตัว" target="_blank"><?=$item['profilecode'];?></a>
                </td>
                <td>
                    <?php 
                    $inputClinicalinfo = $item['clinicalinfo'];
                    if(empty($item['clinicalinfo'])){
                        $item['clinicalinfo'] = 'คลิกเพื่อแก้ไข';
                    }
                    ?>
                    <a href="javascript:void(0);" title="แก้ไขสถานะ" onclick="showInput('<?=$item['labnumber'];?>','<?=$inputClinicalinfo;?>')"><?=$item['clinicalinfo'];?></a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <script>
            async function showInput(labnumber,clinicalinfo){ 
                const inputValue = clinicalinfo;
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
                    data.push(encodeURIComponent('labnumber')+"="+encodeURIComponent(labnumber));
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

            async function editLabnumber(labnumber){
                const inputValue = labnumber;
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
                    data.push(encodeURIComponent('oldLabnumber')+"="+encodeURIComponent(labnumber));
                    data.push(encodeURIComponent('newLabnumber')+"="+encodeURIComponent(labnumberInput));
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
    ?>
    </body>
    </html>
    <?php
}