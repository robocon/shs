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
    var_dump($save);

    exit;
}


if ( $page === 'form' ) { 

    $id = input_get('id');
    
    if ( $id === false ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    // $year_chk = get_year_checkup();

    $db->select("SELECT *,`HN` AS `hn` FROM `opcardchk` WHERE `row` = '$id' ");
    $user = $db->get_item();
    $user_hn = $user['hn'];
    $user_part = $user['part'];

    $db->select("SELECT SUBSTRING(`yearchk`, 3, 2) AS `yearchk` FROM `chk_company_list` WHERE `code` = '$user_part' ");
    $chk_company = $db->get_item();
    $year_chk = $chk_company['yearchk'];

    $sql = "SELECT * 
    FROM `resulthead` 
    WHERE `hn` = '$user_hn'  
    AND `clinicalinfo` LIKE '%ตรวจสุขภาพประจำปี$year_chk'";
    $db->select($sql);
    $lab_rows = $db->get_rows();

    include 'chk_menu.php';

    ?>
    <p><a href="chk_show_user.php?part=<?=$user['part'];?>">&lt;&lt;&nbsp;กลับไปหน้ารายชื่อ</a></p>
    <?php

    if( $lab_rows === 0 ){
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }else {
        
        $items = $db->get_items();

        ?>
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
        <table class="chk_table" width="100%">
            <tr>
                <th>Lab Number</th>
                <!-- <th>autonumber</th> -->
                <th>รายการตรวจ</th>
                <th>สถานะแลป</th>
                <th></th>
                <!-- <th>ปรับสถานะLab</th> -->
            </tr>
            <?php
            foreach ($items as $key => $item) {
                $autonumber = $item['autonumber'];
            ?>
            <tr>
                <td><?=$item['labnumber'];?></td>
            <!-- <td><?=$autonumber;?></td> -->
                <td><?=$item['profilecode'];?></td>
                <td>
                    <div>
                    <!-- chk_lab.php?page=editdetail&number=<?=$item['autonumber'];?>&id=<?=$id;?> -->
                        <a href="javascript:void(0);" title="แก้ไขสถานะ" onclick="showInput('<?=$item['autonumber'];?>')"><?=$item['clinicalinfo'];?></a>
                    </div>
                </td>
                <td>
                    <?php
                    $detail_sql = "SELECT * FROM `resultdetail` WHERE `autonumber` = '$autonumber' ";
                    $db->select($detail_sql);
                    $detail_items = $db->get_items();
                    ?>
                    <table class="chk_table labTable" width="100%">
                        <tr>
                            <th>Lab Code</th>
                            <th>Lab Name</th>
                            <th>Result</th>
                            <th>Normal Range</th>
                        </tr>
                        <?php
                        $ii = 1;
                        foreach( $detail_items AS $key => $detail ){
                            $bgColor = '';
                            if($ii%3==0){
                                $bgColor = 'style="background-color: #e3e3e3;"';
                            }
                        ?>
                        <tr <?=$bgColor;?> >
                            <td width="20%">
                                <a href="chk_lab.php?page=edit_result&autonumber=<?=$autonumber;?>&labcode=<?=$detail['labcode'];?>&id=<?=$id;?>"><?=$detail['labcode'];?></a>
                            </td>
                            <td width="20%"><?=$detail['labname'];?></td>
                            <td width="10%"><?=$detail['result'];?></td>
                            <td width="10%"><?=$detail['normalrange'];?></td>
                        </tr>
                        <?php
                        $ii++;
                        }
                        ?>
                    </table>
                </td>
                <!-- <td><a href="chk_lab.php?page=editdetail&number=<?=$item['autonumber'];?>&id=<?=$id;?>">แก้ไขสถานะ</a></td> -->
            </tr>
            <?php
            }
            ?>
        </table>
        <script>
        // const inputValue = data.ip;
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
                // console.log(clinicalinfoInput);
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
                console.log(body);
                Swal.fire({
                    icon: "success",
                    title: "บันทึกข้อมูลเรียบร้อย",
                    showConfirmButton: false,
                    timer: 1500
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