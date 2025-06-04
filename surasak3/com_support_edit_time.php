<?php
include dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$input = file_get_contents('php://input');
$json = json_decode($input, true);

$action = $json['action'];
if ($action==='udpateTime') {
    
    $id = $json['id'];
    $date = $json['date'];
    $time = $json['time'];

    $sql = sprintf("UPDATE `com_support` SET `dateend` = '%s %s' WHERE `row` = '%s'", 
        $dbi->real_escape_string($date),
        $dbi->real_escape_string($time),
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
}elseif ($action==='loadDetail') {

    $id = $json['id'];
    $sql = sprintf("SELECT `detail` FROM `com_support` WHERE `row` = '%s'", 
        $dbi->real_escape_string($id)
    );
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        $a = $q->fetch_assoc();
        $res = array('status'=>200, 'message'=>html_entity_decode($a['detail']));
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
    <title></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: 'TH SarabunPSK';
            font-size:20px;
        }
        .text-align-left{
            text-align: left;
        }
    </style>
    <?php
    $latestMonth = strtotime("-1 month");
    $dateEnd = (date("Y",$latestMonth)+543).date("-m", $latestMonth);
    ?>
    <div class="">
        <h3>รายการ ณ <?=$def_fullm_th[(date('m', $latestMonth))].' '.(date("Y",$latestMonth)+543);?></h3>
    <?php 
    $sql = "SELECT `row`,`depart`,`head`,`detail`,`user`,`dateend`,`programmer` FROM `com_support` WHERE `dateend` LIKE '$dateEnd%' AND `status` = 'n' AND `programmer` = 'กฤษณะศักดิ์  กันธรส' ORDER BY `dateend` ASC";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        ?>
        <table class="table">
            <tr>
                <th>#</th>
                <th width="10%">วันที่ปิดงาน</th>
                <th>หัวข้อ</th>
                <th>รายละเอียด</th>
                <th>ผู้แจ้ง</th>
                <th>แผนก</th>
                <th>ผู้ปฏิบัติ</th>
            </tr>
        <?php
        while($a = $q->fetch_assoc()){
            $id = $a['row'];
            list($date, $time) = explode(' ', $a['dateend']);
            $detail = html_entity_decode($a['detail']);
            ?>
            <tr>
                <td><a href="javascript:void(0);"><?=$id;?></a></td>
                <td><a href="javascript:void(0);" onclick="editDateTime('<?=$id;?>','<?=$date;?>','<?=$time;?>')"><?=$a['dateend'];?></a></td>
                <td><a href="javascript:void(0);" onclick="loadContent('<?=$id;?>')"><strong><?=$a['head'];?></strong></a>    </td>
                <td><?=preg_replace('#<br />(\s*<br />)+#', '<br />', $detail);?></td>
                <td><?=$a['user'];?></td>
                <td><?=$a['depart'];?></td>
                <td><?=$a['programmer'];?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <script>
            async function editDateTime(id, d, t){
                let { value: formValues } = await Swal.fire({
                    title: "แก้ไข วัน-เวลา ปิดงาน",
                    html: `<div>
                        <div>
                            วัน <input type="date" id="swal-input1" class="swal2-input" value="${d}">
                        </div>
                        <div>
                            เวลา <input type="time" id="swal-input2" class="swal2-input" value="${t}">
                        </div>
                    </div>
                    `,
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "บันทึก",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "ยกเลิก",
                    focusConfirm: false,
                    preConfirm: () => {
                        return { 
                            "id": id,
                            "date": document.getElementById("swal-input1").value, 
                            "time": document.getElementById("swal-input2").value
                        };
                    }
                });
                if (formValues) {
                    doUpdateEditTime(formValues).then((res)=>{
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

            async function doUpdateEditTime(data){
                data.action = 'udpateTime';
                const response = await fetch('com_support_edit_time.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    body: JSON.stringify(data)
                });
                const content = await response.json();
                return content;
            }

            function loadContent(id){
                doLoadContent(id).then((res)=>{
                    if(res.status==200){
                        Swal.fire({
                            width: "90%",
                            html: `<div class="text-align-left">${res.message}</div>`
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

            async function doLoadContent(id){
                let data = {
                    "action": 'loadDetail',
                    "id": id
                };
                const response = await fetch('com_support_edit_time.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    body: JSON.stringify(data)
                });
                const content = await response.json();
                return content;
            }
        </script>
        <?php
    }else{
        echo $dbi->error;
    }
    ?>
    </div>
</body>
</html>