<?php
include 'bootstrap.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

require_once 'includes/JSON.php';
$json = new Services_JSON();

$sLevel = sprintf("%s", $_SESSION['sLevel']);
if(empty($sLevel)){
	echo "Invalid data";
	exit;
}
if($sLevel!='admin'){
    echo "อนุญาตเฉพาะAdminประจำแผนก";
    exit;
}
$getMenucode = sprintf("%s", $_SESSION['smenucode']);

$action = sprintf("%s", $_GET['action']);
if($action=='enable'){

    $id = sprintf("%s", $_GET['id']);
    $q = $dbi->query("UPDATE `inputm` SET `status` = 'Y' WHERE `row_id` = '$id' LIMIT 1;");
    if($q !== false){
        $res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>$dbi->error);
    }
    echo $json->encode($res);
    exit;

}elseif($action=='delete'){

    $id = sprintf("%s", $_GET['id']);
    $detail = sprintf("%s", $_GET['detail']);
    $q = $dbi->query("SELECT `name`,`menucode` FROM `inputm` WHERE `row_id` = '$id' LIMIT 1;");
    if($q->num_rows>0){
        $user = $q->fetch_assoc();
        $sOfficer = sprintf("%s", $_SESSION['sOfficer']);
        $smenucode = sprintf("%s", $_SESSION['smenucode']);

        $message = "$sOfficer($smenucode) ได้ขอลบผู่้ใช้งาน ".$user['name'].'('.$user['menucode'].') เหตุผล: '.$detail;
        // 'LdH3u9gnaKiyCBSTq1EkctYtMbErKG7gjJ1DErd2sfL'
        $lineRes = sendLineNotify($message);
        if($lineRes===false){
            $res = array('status'=>400, 'message'=>'ระบบการแจ้งเตือนขัดข้อง กรุณาตรวจสอบอินเตอร์เน็ตว่าสามารถใช้งานได้ตามปกติได้หรือไม่');
        }else{
            $res = array('status'=>200, 'message'=>'return กลับมาเฉยๆ');
        }
        
    }else{
        $res = array('status'=>400, 'message'=>$dbi->error);
    }
    echo $json->encode($res);
    exit;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>disable user</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <?php 
    require_once 'com_user_menu.php';
    ?>
    <div class="container mt-2">
        <h3>รายชื่อปิดการใช้งาน</h3>
        <?php 
        $sql = "SELECT * FROM `inputm` WHERE `menucode` LIKE '$getMenucode%' AND `menucode` != 'ADMDR1' AND `status` = 'N' ORDER BY `row_id` ASC ";
		$q = $dbi->query($sql);
		$num = $q->num_rows;
        if($num>0){
            ?>
            <table class="table table-hover">
            <tr>
                <th width="10%">ลำดับ</th>
                <th width="30%">ชื่อ - นามสกุล</th>
                <?php 
                if($getMenucode=='ADM'){
                    ?><th width="15%">part</th><?php
                }
                ?>
                <th width="15%">ระดับ</th>
                <th width="30">จัดการข้อมูล</th>
            </tr>
            <?php
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                $statusTxt = 'ใช้งาน';
                if(strtolower($rows["status"])!='y'){
                    $statusTxt = '<strong class="text-danger">ปิดการใช้งาน</strong>';
                }
                ?>
                <tr id="user-<?=$a['row_id'];?>">
					<td><?=$i; ?></td>
					<td><?=$a["name"];?></td>
					<?php 
					if($getMenucode=='ADM'){
						?><td><?=$a["menucode"]; ?></td><?php
					}
					?>
					<td><?=$a["level"];?></td>
					<td>
						<div class="d-grid gap-2 d-md-block">
                            <a href="javascript:void(0);" class="btn btn-success btn-sm" data-id="<?=$a['row_id'];?>" onclick="onEnable('<?=$a['row_id'];?>')">เปิดใช้งาน</a>
                            <a href="javascript:void(0);" class="btn btn-danger btn-sm" data-id="<?=$a['row_id'];?>" onclick="onDelete('<?=$a['row_id'];?>')">ลบถาวร</a>
						</div>
					</td>
				</tr>
                <?php
                $i++;
            } // end while
            ?>
            </table>
            <script>
                async function onEnable(row_id){
                    const response = await fetch('disableuser.php?action=enable&id='+row_id);
                    const res = await response.json();
                    if(res.status==200){
                        Swal.fire({
                            icon: "success",
                            title: res.message,
                            showConfirmButton: false,
                            timer: 1200
                        });
                        document.getElementById('user-'+row_id).remove();
                    }
                    
                }

                async function onDelete(row_id){

                    const {value:text} = await Swal.fire({
                        input: "textarea",
                        title: "คุณมั่นใจการลบข้อมูลถาวร?",
                        text: "การลบข้อมูลครั้งนี้ จะไม่สามารถกู้ข้อมูลคืนได้อีก กรุณาระบุเหตุผลในการลบข้อมูล",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "ใช่, ฉันต้องการลบ",
                        cancelButtonText: "ยกเลิก",
                        inputPlaceholder: "ระบุเหตุผลในช่องนี้",
                        inputValidator: (value) =>{
                            if(!value){ return "กรุณาระบุเหตุผล"; }
                        }
                    });

                    if(text){
                        onDeleteProcess(row_id,text).then((res)=>{
                                
                            if(res.status==200){ 
                                document.getElementById('user-'+row_id).remove();
                                Swal.fire({
                                    title: "ดำเนินการแจ้งลบผู้ใช้งานเรียบร้อย ศูนย์คอมพิวเตอร์จะดำเนินการลบข้อมูลภายใน 48ชั่วโมง ขอบคุณครับ",
                                    icon: "success"
                                });
                            }else{
                                Swal.fire({
                                    title: "Error!",
                                    text: res.message,
                                    icon: "error"
                                });
                            }
                            
                        });
                    }

                }

                async function onDeleteProcess(id,text){
                    const response = await fetch('disableuser.php?action=delete&id='+id+'&detail='+text);
                    const res = await response.json();
                    return res;
                }
            </script>
            <?php
            
        }else{
            ?>
            <p>ไม่พบข้อมูล</p>
            <?php
        }
        ?>
    </div>
</body>
</html>