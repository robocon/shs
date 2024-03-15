<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", (!empty($_POST['action']) ? $_POST['action'] : '' ));
if($action === 'del'){

    $id = sprintf("%d", $_POST['id']);
    if(!empty($id)){
        $sql = "DELETE FROM `pt_reh` WHERE `id` = '$id' LIMIT 1;";
        $d = $dbi->query($sql);
        $res = '{"status":200, "detail": "ลบข้อมูลเรียบร้อย"}';
        if($d===false){
            $res = '{"status":400, "detail": "ไม่สามารถลบข้อมูลได้ "'.$dbi->error.'}';
        }
    }else{
        $res = '{"status":400, "detail": "Invalid data"}';
    }
    echo $res;
    exit;
}elseif($action === 'save'){

    $id = sprintf("%d", $_POST['id']);
    $reh_number = sprintf("%s", $_POST['reh_number']);

    $sql = "UPDATE `pt_reh` SET `reh_number` = '$reh_number' WHERE `id` = '$id' ";
    $update = $dbi->query($sql);
    if($update!==false){
        $res = '{"status":200, "detail": "แก้ไขข้อมูลเรียบร้อย", "id": "'.$id.'", "reh_number": "'.$reh_number.'" }';
    }else{
        $res = '{"status":400, "detail": "ไม่สามารถแก้ไขข้อมูลได้ '.$dbi->error.'"}';
    }
    echo $res;
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พิมพ์ทะเบียนแรกรับย้อนหลัง</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <script src="js/sweetalert2.all.min.js"></script>

    <link href="js/vanilla-calendar/vanilla-calendar.min.css" rel="stylesheet">
    <script src="js/vanilla-calendar/vanilla-calendar.min.js" defer></script>
    
</head>
<body>
    <?php 
    require_once 'pt_reh_menu.php';

    $dateSelect = sprintf("%s", (!empty($_POST['dateSelected']) ? $_POST['dateSelected'] : '' ));

    ?>
    <div class="container mt-4">
        <form action="pt_reh_reprint.php" method="post" class="mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="dateSelected" class="col-form-label">เลือกวันที่</label>
                </div>
                <div class="col-auto">
                    <input type="text" id="dateSelected" name="dateSelected" class="form-control" value="<?=$dateSelect;?>">
                    <div style="position:relative;">
                            <div style="position: absolute;">
                                <div id="calendar_start"></div>
                            </div>
                        </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">ค้นหา</button>
                    <input type="hidden" name="page" value="search">
                </div>
            </div>
        </form>
        <script>
            // ESC ปิดปฏิทิน
            document.addEventListener("keydown", (event) => {
                if (event.isComposing || event.keyCode === 27) {
                    document.getElementById('calendar_start').style.display = 'none';
                }
            });
            
            // แสดงปฏิทิน
            document.getElementById('dateSelected').onclick=function(){ 
                document.getElementById('calendar_start').style.display = '';
                const calendar = new VanillaCalendar('#calendar_start',{
                    settings: {
                        lang: 'th',
                        iso8601: false,
                    },
                    actions: {
                        clickDay(event, self) {
                            document.getElementById('dateSelected').value = self.selectedDates[0];
                            document.getElementById('calendar_start').style.display = 'none';
                        },
                    },
                });
                calendar.init();
            }
        </script>
        
        <?php 
        $page = sprintf("%s", $_POST['page']);
        if($page==='search'){

            $dateSelect = sprintf("%s", $_POST['dateSelected']);
            $sql = "SELECT * FROM `pt_reh` WHERE `date` = '$dateSelect' ORDER BY `id` DESC ";
            $q = $dbi->query($sql);
            if($q->num_rows>0){
                list($y,$m,$d) = explode('-', $dateSelect);
                ?>
                <h3>ข้อมูลวันที่ <?=$d.' '.$def_fullm_th[$m].' '.($y+543);?></h3>
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>HN</th>
                        <th>ชื่อ-สกุล</th>
                        <th>VN</th>
                        <th>REH Number</th>
                        <th>จนท.</th>
                        <th></th>
                    </tr>
                    <?php 
                    $i = 1;
                    while($a = $q->fetch_assoc()){
                        ?>
                        <tr id="trReh<?=$a['id'];?>">
                            <td><?=$i;?></td>
                            <td><a href="javascript:void(0);" onclick="openReprint('<?=$a['id'];?>')" title="สั่งปริ้น"><?=$a['hn'];?></a></td>
                            <td><?=$a['ptname'];?></td>
                            <td><?=$a['vn'];?></td>
                            <td><span id="rehNumber<?=$a['id'];?>"><?=$a['reh_number'];?></span></td>
                            <td><?=$a['officer'];?></td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-sm btn-primary" title="แก้ไข REH Number" onclick="editRehNumber('<?=$a['id'];?>','<?=$a['reh_number'];?>')"><i class="bi bi-pencil"></i></a>
                                <a href="javascript:void(0);" class="btn btn-sm btn-danger" title="ลบ" onclick="confirmDel('<?=$a['id'];?>')"><i class="bi bi-trash3"></i></a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </table>
                <script>
                    async function editRehNumber(id,rehNumber){
                        // แทนค่าเข้าไปใน input ของ Swal
                        const inputValue = rehNumber;

                        // rehNumberInput เอาค่า Input ใน Swal มาใช้งาน
                        const { value: rehNumberInput } = await Swal.fire({
                            title: "แก้ไขเลขที่ REH",
                            input: "text",
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
                        
                        // ถ้ามีค่าจาก Input ของ Swal
                        if (rehNumberInput) {
                    
                            // ส่ง post ไปบันทึกข้อมูล
                            let data = [];
                            data.push(encodeURIComponent('action')+"="+encodeURIComponent('save'));
                            data.push(encodeURIComponent('reh_number')+"="+encodeURIComponent(rehNumberInput));
                            data.push(encodeURIComponent('id')+"="+encodeURIComponent(id));
                            let dataPost = data.join("&");
                            
                            let response = await fetch('pt_reh_reprint.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                                },
                                body: dataPost
                            });
                            const body = await response.json();

                            // แสดงข้อความ 
                            Swal.fire({
                                position: "bottom-end",
                                title: body.detail,
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {

                                // หลังจาก Swal ทำงานเสร็จให้รีเฟรชหน้าจอ
                                location.reload(true);
                            });
                            
                        }
                    }

                    function openReprint(id){
                        let target = 'target='+encodeURIComponent('pt_firstregis_reprint.php?id='+id);
                        window.open('<?=NOTIFY_HOST;?>/shspdf/printPdf.php?'+target, "rehPopup","width=600,height=400");
                    }

                    function confirmDel(id) {
                        Swal.fire({
                            title: "ยืนยันการลบ?",
                            text: "การลบจะไม่สามารถกู้คืนข้อมูลได้อีก",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "ยืนยัน",
                            cancelButtonText: "ยกเลิก",
                        }).then((result) => { 

                            // เมื่อมีการยืนยันการลบ
                            if (result.isConfirmed) {

                                // ส่งค่าไปลบ
                                rehDelete(id).then((res)=>{
                                    Swal.fire({
                                        position: "bottom-end",
                                        title: res.detail,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    
                                    // ไม่ต้องรอการทำงานของ Swal ให้ลบแถวไปได้เลย
                                    if(res.status===200){
                                        document.getElementById("trReh"+id).remove();
                                    }
                                });
                                
                            }
                        });
                    }

                    async function rehDelete(id){
                        let data = [];
                        data.push(encodeURIComponent('action')+"="+encodeURIComponent('del'));
                        data.push(encodeURIComponent('id')+"="+encodeURIComponent(id));
                        let dataPost = data.join("&");
                        let response = await fetch('pt_reh_reprint.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                            },
                            body: dataPost
                        });
                        const body = await response.json();
                        return body;
                    }
                </script>
                <?php
            }else{
                ?>
                <div class="alert alert-warning" role="alert">ไม่พบข้อมูล</div>
                <?php
            }
        } // end if page === search
        ?>
    </div>
</body>
</html>