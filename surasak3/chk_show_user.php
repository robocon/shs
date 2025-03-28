<?php

include 'bootstrap.php';

$page = input('page');
$db = Mysql::load();
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

$sql = "SELECT a.`row`,a.`exam_no`,a.`name`,a.`surname`,a.`idcard`,a.`agey`,a.`part`, a.`HN` AS `hn`,b.`ptright`
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
    <h3>รายชื่อผู้ตรวจสุขภาพ - <?=$company['name'];?>(<?=$company['code'];?>)</h3>
    <div style="margin-bottom: 8px;">
        <button type="button" onclick="addUser('<?=$company['id'];?>','0')">+ เพิ่มรายชื่อ</button>
    </div>
    <form action="chk_show_user.php" method="post">
    <table class="chk_table">
        <tr>
            <th>เลือก</th>
            <th>#</th>
            <th>Lab Number</th>
            <th>HN</th>
            <th>ชื่อสกุล</th>
            <th>เลขบัตรประชาชน</th>
            <th>อายุ</th>
            <th>สิทธิ(ในรพ.)</th>
            <th>ลบ</th>
        </tr>
        <?php
        $i = 1;
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td style="text-align: center;">
                    <input type="checkbox" name="ids[]" class="id" value="<?=$item['row'];?>">
                </td>
                <td><?=$i;?></td>
                <td><a href="chk_lab.php?page=form&id=<?=$item['row'];?>" title="แก้ไขผลแลป"><?=$item['exam_no'];?></a></td>
                <td><a href="javascript:void(0);" onclick="editUser('<?=$company['id'];?>','<?=$item['row'];?>')" title="แก้ไขรายละเอียด"><?=$item['hn'];?></a></td>
                <td><?=$item['name'];?> <?=$item['surname'];?></td>
                <td><?=$item['idcard'];?></td>
                <td><?=$item['agey'];?></td>
                <td><?=$item['ptright'];?></td>
                <td align="center"><a href="chk_show_user.php?page=del&id=<?=$item['row'];?>&part=<?=$item['part'];?>" onclick="return confirm_del()">ลบ</a></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        <tr>
            <td>
                <label for="selected_all"><input type="checkbox" name="" id="selected_all"> เลือกทั้งหมด</label>
            </td>
            <td colspan="10" align="center">
                <button type="submit">ลบทั้งหมดที่เลือก</button>
                <input type="hidden" name="page" value="del_multiple">
                <input type="hidden" name="part" value="<?=$part;?>">
            </td>
        </tr>
    </table>
    </form>
    <script type="text/javascript">
        function editUser(companyId,user_id){
            loadAddUserForm(companyId, user_id).then((res)=>{
                document.getElementById('resFormContent').innerHTML = res;
                document.getElementById('myModal').style.display = '';
            });
        }

        function confirm_del(){
            var c = confirm('คุณยืนยันที่จะลบข้อมูล?'+"\n"+'เมื่อลบไปแล้วจะไม่สามารถกู้คืนข้อมูลได้อีก');
            var status = true;
            if( c === false ){
                status = false;
            }
            return status;
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

            console.log(formData);
            doSaveUser(formData).then((res)=>{
                console.log(res);
                if(res.status===200){

                }else{
                    Swal.fire(res.message);
                }
            });
        }

        async function doSaveUser(formData){
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
<?php
/*
if ( $page === 'del' ) {

    $id = input_get('id');

    if( $id === false ){
        echo "ไม่พบข้อมูล";
        exit;
    }

    $part = input_get('part');
    
    $sql = "DELETE FROM `opcardchk` WHERE `row` = '$id' ";
    $delete = $db->delete($sql);

    $msg = 'ลบข้อมูลเรียบร้อย';
    if( $delete !== true ){
		$msg = errorMsg('delete', $delete['id']);
    }

    redirect('chk_show_user.php?part='.$part, $msg);
    exit;
    
}elseif ( $page === 'del_multiple' ) {

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
*/