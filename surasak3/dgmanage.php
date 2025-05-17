<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';
$json = new Services_JSON();

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
    echo $json->encode($res);
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
    echo $json->encode($res);
    exit;

}elseif($action==='getFromId'){
    $id = $json['id'];
    $sql = sprintf("SELECT `name` FROM `drugreact_group` WHERE `id` = '%s'", 
        $dbi->real_escape_string($id)
    );
    $q = $dbi->query($sql);
    if($q!==false){
        if($q->num_rows>0){
            $a = $q->fetch_assoc();
            $res = array('status'=>200, 'message'=>$a['name']);
        }else{ 
            $res = array('status'=>400, 'message'=>'ไม่พบข้อมูล');
        }
    }else{
        $res = array('status'=>400, 'message'=>'Not Found Data Error: '.$dbi->error);
    }
    
    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
    exit;

}elseif($action==='update'){
    $id = $json['id'];
    $name = $json['name'];
    $oldName = $json['oldName'];
    
    $sql = sprintf("UPDATE `drugreact_group` SET `name` = '%s' WHERE `id` = '%s'", 
        $dbi->real_escape_string($name),
        $dbi->real_escape_string($id)
    );
    $qReactGroup = $dbi->query($sql);
    
    $sqlUpdate = sprintf("UPDATE `drugreact` SET `groupname` = '%s' WHERE `groupname` = '%s' ;",
        $dbi->real_escape_string($name),
        $dbi->real_escape_string($oldName)
    );
    $dbi->query($sqlUpdate);
    
    if($qReactGroup!==false){
        $res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ Error: '.$dbi->error);
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
    exit;

}elseif ($action==='checkDrugreact') {
    $id = $json['id'];
    $name = $json['name'];

    $res = array('status'=>200,'userReactRows'=>0,'groupReactRows'=>0);
    $sql = sprintf("SELECT * FROM `drugreact` WHERE `groupname` = '%s'; ", $dbi->real_escape_string($name));
    $q = $dbi->query($sql);
    if($q!==false){
        $userReactRows = $q->num_rows;
        if($userReactRows>0){
            $res['userReactRows'] = $userReactRows;
        }
    }else{
        $res = array('status'=>400,'message'=>'Error: '.$dbi->error);
    }
    
    $sql = sprintf("SELECT * FROM `drugreact_group_list` WHERE `drugreact_group` = '%s' ", $dbi->real_escape_string($id));
    $q = $dbi->query($sql);
    if($q!==false){
        $groupReactRows = $q->num_rows;
        if($groupReactRows>0){
            $res['groupReactRows'] = $groupReactRows;
        }
    }else{
        $res = array('status'=>400,'message'=>'Error: '.$dbi->error);
    }
    
    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
    exit;
}elseif ($action=='checkPass') {
    
    $user = $_SESSION['sIdname'];
    $pass = $json['pass'];

    $sql = sprintf("SELECT `row_id` FROM `inputm` WHERE `idname` = '%s' AND `pword` = '%s' AND `status` = 'y' LIMIT 1", 
    $dbi->real_escape_string($user),
    $dbi->real_escape_string($pass));
    $q = $dbi->query($sql);
    if($q!==false){
        if($q->num_rows>0){
            $res = array('status'=>200);
        }else{
            $res = array('status'=>400);
        }
    }else{
        $res = array('status'=>400);
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
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
                        <a href="javascript:void(0);" title="แก้ไข" onclick="editReactGroup('<?=$a['id'];?>')">✏️</a>
                    </td>
                    <td>
                        <a href="javascript:void(0);" title="ลบ" onclick="delReactGroup('<?=$a['id'];?>')">🗑️</a>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <script>

            // ลบ/ปรับสถานะเป็น n
            async function delReactGroup(id){
                
                const response = await fetch('dgmanage.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({"action":"getFromId","id":id})
                });
                const content = await response.json();
                
                const reactName = content.message;
                const result = await sendPostJson({"action": "checkDrugreact","name":reactName, "id":id}).then((res)=>{
                    return res;
                });

                if(result.userReactRows > 0 || result.groupReactRows > 0){
                    confirmDelGroup1(id);
                    
                }else{
                    console.log("Do Delete");
                    doDeleteGroup(id);
                }
            }

            async function confirmDelGroup1(id){
                const { value: userPass } = await Swal.fire({
                    title: 'คุณต้องการลบข้อมูลนี้หรือไม่?',
                    html: `การลบข้อมูลนี้จะทำให้รายการยาที่เคยผูกไว้กับกลุ่มยานี้หายไปทั้งหมด<br>และจะไม่สามารถกู้คืนข้อมูลได้อีก`,
                    icon: 'warning',
                    input: "password",
                    inputLabel: "กรุณากรอกรหัสผ่านเพื่อยืนยันการลบ",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยันการลบ',
                    cancelButtonText: 'ยกเลิก',
                    inputValidator: (value) => {
                        if (!value) {
                            return "กรุณากรอกข้อมูล";
                        }
                    }
                });
                
                if(userPass){
                    const response = await fetch('dgmanage.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({"action":"checkPass","pass":userPass})
                    });
                    const content = await response.json();
                    if(content.status===200){
                        console.log("Do Delete");
                        doDeleteGroup(id)
                    }else{
                        Swal.fire({icon: 'warning', title:"รหัสผ่านไม่ถูกต้อง"});
                    }
                }
            }

            async function doDeleteGroup(id){
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
                    confirmButtonText: 'แก้ไขได้เลย',
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
                        "oldName": inputValue,
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
                    confirmButtonText: 'เพิ่ม',
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