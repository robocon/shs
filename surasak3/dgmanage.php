<?php
include dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$input = file_get_contents('php://input');
$json = json_decode($input, true);

$action = $json['action'];
if($action==='add'){
    $name = $json['name'];
    $sql = sprintf("INSERT INTO `drugreact_group` (`name`, `status`) VALUES ('%s', 'y')", 
        $dbi->real_escape_string($name)
    );
    $q = $dbi->query($sql);
    if($q===true){
        $res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ Error: '.$dbi->error);
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($res);
    exit;

}elseif($action==='delete'){
    $id = $json['id'];
    $sql = sprintf("UPDATE `drugreact_group` SET `status` = 'n' WHERE `id` = '%s'", 
        $dbi->real_escape_string($id)
    );
    $q = $dbi->query($sql);
    if($q===true){
        $res = array('status'=>200, 'message'=>'ลบข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถลบข้อมูลได้ Error: '.$dbi->error);
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($res);
    exit;

}elseif($action==='getFromId'){
    $id = $json['id'];
    $sql = sprintf("SELECT `name` FROM `drugreact_group` WHERE `id` = '%s'", 
        $dbi->real_escape_string($id)
    );
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        $a = $q->fetch_assoc();
        $res = array('status'=>200, 'message'=>$a['name']);
    }else{ 
        $res = array('status'=>400, 'message'=>'Error: '.$dbi->error);
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($res);
    exit;

}elseif($action==='update'){
    $id = $json['id'];
    $name = $json['name'];
    $sql = sprintf("UPDATE `drugreact_group` SET `name` = '%s' WHERE `id` = '%s'", 
        $dbi->real_escape_string($name),
        $dbi->real_escape_string($id)
    );
    $q = $dbi->query($sql);
    if($q===true){
        $res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ Error: '.$dbi->error);
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode($res);
    exit;

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการกลุ่มยาที่มีโอกาศแพ้</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size:20px;
        }
    </style>
    <div class="container mt-2">
        <h3>จัดการข้อมูลกลุ่มยาที่มีโอกาสแพ้</h3>
        <div class="mt-2">
            <button class="btn btn-primary" onclick="addReactGroup()">➕&nbsp;เพิ่มกลุ่ม</button>
        </div>
        <table class="table table-striped mt-2">
            <tr>
                <th>#</th>
                <th>ชื่อ</th>
                <th colspan="2">จัดการ</th>
            </tr>
            <?php 
            $sql = "SELECT * FROM `drugreact_group` WHERE `status` = 'y' ORDER BY `id` ASC";
            $q = $dbi->query($sql);
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr id="item-tr-<?=$a['id'];?>">
                    <td><?=$i;?></td>
                    <td id="item-id-<?=$a['id'];?>"><?=$a['name'];?></td>
                    <td>
                        <a href="javascript:void(0);<?=$a['id'];?>" title="แก้ไข" onclick="editReactGroup('<?=$a['id'];?>')">✏️</a>
                    </td>
                    <td>
                        <a href="javascript:void(0);<?=$a['id'];?>" title="ลบ" onclick="delReactGroup('<?=$a['id'];?>')">🗑️</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <script>

            // ลบ/ปรับสถานะเป็น n
            function delReactGroup(id){
                Swal.fire({
                    title: 'คุณต้องการลบข้อมูลนี้หรือไม่?',
                    text: 'หากลบแล้วจะไม่สามารถกู้คืนได้',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่, ลบเลย!',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the delete action here
                        let objData = {
                            "action": 'delete',
                            "id": id
                        };
                        sendPostJson(objData).then((res)=>{
                            if(res.status==200){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลบข้อมูลเรียบร้อย'
                                }).then((res)=>{
                                    document.getElementById('item-tr-'+id).remove();
                                });
                            }else{
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ไม่สามารถลบข้อมูลได้',
                                    text: res.message
                                });
                            }
                        });
                    }
                })
            }

            async function editReactGroup(id){
                
                let objData = {
                    "action": 'getFromId',
                    "id": id
                };

                inputValue = await sendPostJson(objData).then((res)=>{
                    return res.message;
                });

                const { value: inputName } = await Swal.fire({
                    title: "แก้ไขชื่อกลุ่มยา",
                    input: "text",
                    inputValue,
                    showCancelButton: true,
                    confirmButtonText: 'ใช่, ลบเลย!',
                    cancelButtonText: 'ยกเลิก',
                    inputValidator: (value) => {
                        if (!value) {
                            return "กรุณาใส่ชื่อกลุ่มยา";
                        }else if (value.length <= 3) {
                            return "ชื่อกลุ่มยาสั้นเกินไป";
                        }
                    }
                });
                if (inputName) {
                    let objData = {
                        "action": 'update',
                        "name": inputName,
                        "id": id
                    };
                    sendPostJson(objData).then((res)=>{
                        if(res.status==200){
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเรียบร้อย'
                            }).then((res)=>{
                                document.getElementById('item-id-'+id).innerHTML = inputName;
                            });
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกข้อมูลได้',
                                text: res.message
                            });
                        }
                    });
                }
            }

            async function addReactGroup(){
                const { value: inputName } = await Swal.fire({
                    title: "เพิ่มชื่อกลุ่มยา",
                    input: "text",
                    showCancelButton: true,
                    confirmButtonText: 'ใช่, ลบเลย!',
                    cancelButtonText: 'ยกเลิก',
                    inputValidator: (value) => {
                        if (!value) {
                            return "กรุณาใส่ชื่อกลุ่มยา";
                        }else if (value.length <= 3) {
                            return "ชื่อกลุ่มยาสั้นเกินไป";
                        }
                    }
                });
                if (inputName) {
                    let objData = {
                        "action": 'add',
                        "name": inputName
                    };
                    sendPostJson(objData).then((res)=>{
                        if(res.status==200){
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเรียบร้อย'
                            }).then((res)=>{
                                location.reload();
                            });
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกข้อมูลได้',
                                text: res.message
                            });
                        }
                    });
                }
            }

            async function sendPostJson(objData){
                const response = await fetch('dgmanage.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(objData)
                });
                const content = await response.json();
                return content;
            }
        </script>
    </div>
</body>
</html>