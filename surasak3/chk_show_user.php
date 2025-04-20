<?php
include dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$page = input('page');
$db = Mysql::load();

if ( $page === 'del_multiple' ) {

    $items = $_POST['ids'];
    $part = input_post('part');
    foreach ($items as $key => $id) {
        
        $sql = "DELETE FROM `opcardchk` WHERE `row` = '$id' LIMIT 1";
        $delete = $db->delete($sql);

    }

    $msg = 'ลบข้อมูลเรียบร้อย';
    if( $delete !== true ){
		$msg = errorMsg('delete', $delete['id']);
    }

    redirect('chk_show_user.php?part='.$part, $msg);

    exit;

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <title>รายชื่อผู้ตรวจสุขภาพ</title>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
include 'chk_menu.php';

$part = input_get('part');

$sql = "SELECT `id`,`name`,`code` FROM `chk_company_list` WHERE `code` = '$part'";
$db->select($sql);
$company = $db->get_item();

$sql = "SELECT a.`row`,a.`exam_no`,a.`name`,a.`surname`,a.`idcard`,a.`agey`,a.`part`, a.`HN` AS `hn`,b.`ptright`,a.`dbirth`
FROM `opcardchk` AS a 
LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn` 
WHERE a.`part` = '$part' 
ORDER BY a.`row`";
$db->select($sql);
$rows = $db->get_rows();
if( $rows > 0 ){
    $items = $db->get_items();
    ?>
    <style>
        label{
            cursor: pointer;
        }
    </style>
    <div class="" style="display:flex; align-items: center;">
        <h3 style="margin:0; padding:0;">รายชื่อผู้ตรวจสุขภาพ&nbsp;:&nbsp;<?=$company['name'];?></h3>&nbsp;<div>[<?=$company['code'];?>]</div>
    </div>
    <div style="margin-bottom: 8px;">
        <button type="button" onclick="addUser('<?=$company['id'];?>','0')">+ เพิ่มรายชื่อ</button>
    </div>
    <form action="chk_show_user.php" method="post" id="formUserList">
        <table class="chk_table">
            <tr>
                <th><input type="checkbox" id="selected_all" onclick="selectAllCheckbox()"> <label for="selected_all">เลือก</label></th>
                <th>#</th>
                <th>Lab Number</th>
                <th>HN</th>
                <th>ชื่อสกุล</th>
                <th>เลขบัตรประชาชน</th>
                <th>วดป.เกิด</th>
                <th>อายุ</th>
                <th>สิทธิ(ในรพ.)</th>
                <th>ลบ</th>
            </tr>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {
                ?>
                <tr id="user<?=$item['row'];?>">
                    <td style="text-align: center;">
                        <input type="checkbox" name="ids[]" class="chkSelected" id="chk<?=$item['row'];?>" value="<?=$item['row'];?>">
                    </td>
                    <td><?=$i;?></td>
                    <td><a href="chk_lab.php?page=form&id=<?=$item['row'];?>" title="แก้ไขผลแลป"><?=$item['exam_no'];?></a></td>
                    <td><a href="javascript:void(0);" onclick="editUser('<?=$company['id'];?>','<?=$item['row'];?>')" title="แก้ไขรายละเอียด"><?=$item['hn'];?></a></td>
                    <td>
                        <label for="chk<?=$item['row'];?>"><?=$item['name'];?> <?=$item['surname'];?></label>
                    </td>
                    <td><?=$item['idcard'];?></td>
                    <td><?=$item['dbirth'];?></td>
                    <td><?=$item['agey'];?></td>
                    <td><?=$item['ptright'];?></td>
                    <td align="center"><a href="javascript:void(0);" onclick="confirm_del('<?=$item['row'];?>')">🚮</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <div style="margin-top:4px;">
            <button type="button" onclick="delFromCheckbox()">🚮 ลบทั้งหมดที่เลือก</button>
            <input type="hidden" name="page" value="del_multiple">
            <input type="hidden" name="part" value="<?=$part;?>">
        </div>
    </form>
    <script type="text/javascript">

        /**
         * @description ปุ่ม Check all
         */
        function selectAllCheckbox(){
            const items = document.getElementsByClassName('chkSelected');
            const selectAllBtn = document.getElementById('selected_all');
            
            for (let index = 0; index < items.length; index++) {
                items[index].checked = selectAllBtn.checked;
            }
        }

        function delFromCheckbox(){
            const items = document.getElementsByClassName('chkSelected');
            let countChecked = 0;
            for (let index = 0; index < items.length; index++) {
                const el = items[index];
                if(el.checked){
                    countChecked++;
                }
            }

            if(countChecked===0){
                Swal.fire('กรุณาเลือกรายการที่ต้องการลบอย่างน้อย 1 รายการ');
                return false;
            }else{
                Swal.fire({
                    title: "คุณมั่นใจที่จะลบข้อมูล?",
                    text: "เมื่อลบไปแล้วจะไม่สามารถกู้คืนข้อมูลได้อีก",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ยืนยันการลบ",
                    cancelButtonText: "ยกเลิก"
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        // เลือกข้อมูลที่ Checkbox เอาไว้แล้วส่งเป็น POST ids[]
                        document.getElementById('formUserList').submit();
                        
                    }
                });
            }
            
        }

        function editUser(companyId,user_id){
            loadAddUserForm(companyId, user_id).then((res)=>{
                document.getElementById('resFormContent').innerHTML = res;
                document.getElementById('myModal').style.display = '';
            });
        }

        function confirm_del(rowId){
            Swal.fire({
                title: "คุณมั่นใจที่จะลบข้อมูล?",
                text: "เมื่อลบไปแล้วจะไม่สามารถกู้คืนข้อมูลได้อีก",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ยืนยันการลบ",
                cancelButtonText: "ยกเลิก"
            }).then((result) => {
                if (result.isConfirmed) {
                    doDelUser(rowId).then((res)=>{
                        if(res.status===200){
                            Swal.fire("ลบข้อมูลเรียบร้อย").then(()=>{
                                location.reload();
                            });
                        }else{      
                            Swal.fire(res.message);
                        }
                    });
                }
            });
        }

        async function doDelUser(rowId){
            const formData = {
                "id": rowId,
                "action": "delUser"
            };
            let response = await fetch('chk_subapi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });
            const res = await response.json();
            return res;
        }

        function addUser(companyId, user_id){
            loadAddUserForm(companyId, user_id).then((res)=>{
                document.getElementById('resFormContent').innerHTML = res;
                document.getElementById('myModal').style.display = '';
            });
        }

        async function loadAddUserForm(companyId, user_id){
            const response = await fetch('chk_user_form.php?company_id='+companyId+'&user_id='+user_id);
            const body = await response.text();
            return body;
        }

        function closeFormAdd(){
            document.getElementById('myModal').style.display = 'none';
        }

        function chkUserFormSubmit(){
            event.preventDefault();

            const exam_no = document.getElementById('exam_no').value;
            const hn = document.getElementById('hn').value;
            const name = document.getElementById('name').value;
            const surname = document.getElementById('surname').value;
            const idcard = document.getElementById('idcard').value;
            const agey = document.getElementById('agey').value;

            if(hn==='' || name==='' || surname==='' || idcard==='' || agey==='' || exam_no===''){
                Swal.fire('กรุณากรอกข้อมูลให้ครบถ้วน');
                return false;
            }

            let form = document.getElementById('chkUserForm');
            let formData = {};
            for (let index = 0; index < form.elements.length; index++) {
                const element = form.elements[index];
                if(element.type!=="submit" && element.value !== ''){
                    formData[element.name] = element.value;
                }
            }

            doSaveUser(formData).then((res)=>{
                if(res.status===200){
                    Swal.fire("บันทึกข้อมูลเรียบร้อย").then(()=>{
                        location.reload();
                    })
                }else{
                    Swal.fire(res.message);
                }
            });
        }

        async function doSaveUser(formData){
            Swal.fire({
                title: "กำลังบันทึกข้อมูล...",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            let response = await fetch('chk_subapi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });
            const res = await response.json();
            return res;
        }

        function checkUser(){
            event.preventDefault();
            const hn = document.getElementById('hn').value;
            if(hn===''){
                Swal.fire("กรุณากรอก HN");
                return false;
            }
            doGetUser(hn).then((res)=>{
                if(res.status==200){
                    document.getElementById('name').value = res.data.yot+res.data.name;
                    document.getElementById('surname').value = res.data.surname;
                    document.getElementById('idcard').value = res.data.idcard;
                    document.getElementById('agey').value = res.data.age;
                    document.getElementById('dbirth').value = res.data.dbirth_en;
                }else{
                    Swal.fire(res.message);
                }
            });
        }

        async function doGetUser(hn){
            formData = {
                "hn": hn,
                "action": "getUser"
            };
            let response = await fetch('chk_subapi.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            const res = await response.json();
            return res;
        }
    </script>
    <?php

}else{
    ?>
    <p>ไม่พบข้อมูลนำเข้า</p>
    <?php
}
?>


<div id="myModal" class="modal" style="display:none;">
    <div id="myModalContainer">
        <div class="clearfix">
            <div id="myModalHeader"><a href="javascript:void(0);" onclick="closeFormAdd()"><span class="close">&times; ปิด</span></a></div>
        </div>
        <div id="resFormContent"></div>
    </div>
</div>


</body>
</html>